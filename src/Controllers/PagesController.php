<?php

namespace Fieroo\Pages\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Fieroo\Pages\Models\Page;
use Illuminate\Support\Str;
use Validator;
use DB;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_pages = DB::table('pages_translations')->get();
        $it_pages = [];
        $en_pages = [];
        foreach($all_pages as $page) {
            if($page->locale === 'it') {
                array_push($it_pages, $page);
            } else {
                array_push($en_pages, $page);
            }
        }
        return view('pages::index', ['it_pages' => $it_pages, 'en_pages' => $en_pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation_data = [
            'title' => ['required', 'string', 'max:255'],
        ];

        $validator = Validator::make($request->all(), $validation_data);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $page = Page::create();

            $page_translations = DB::table('pages_translations')->insert([
                [
                    'page_id' => $page->id,
                    'locale' => 'it',
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'description' => $request->description,
                    'content' => $request->content,
                    'is_published' => $request->is_published ? true : false
                ],
                [
                    'page_id' => $page->id,
                    'locale' => 'en',
                    'title' => $request->title_en,
                    'slug' => Str::slug($request->title_en,'-'),
                    'description' => $request->description_en,
                    'content' => $request->content_en,
                    'is_published' => $request->is_published_en ? true : false
                ]
            ]);

            $entity_name = trans('entities.page');
            return redirect('admin/pages')->with('success', trans('forms.created_success',['obj' => $entity_name]));
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = DB::table('pages_translations')->where('id', '=', $id)->first();
        if(is_null($page) || !is_object($page)) {
            abort(404);
        }
        return view('pages::edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation_data = [
            'title' => ['required', 'string', 'max:255'],
        ];

        $validator = Validator::make($request->all(), $validation_data);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $page_old = DB::table('pages_translations')->where('id', '=', $id)->first();

            $new_dom  = new \DOMDocument();
            $new_dom->loadHTML($request->content);
            $new_dom->preserveWhiteSpace = false;
            $new_imgs = [];
            foreach($new_dom->getElementsByTagName('img') as $image) {
                $src = $image->getAttribute('src');
                array_push($new_imgs, $src);
            }

            $old_dom  = new \DOMDocument();
            $old_dom->loadHTML($page_old->content);
            $old_dom->preserveWhiteSpace = false;
            foreach($old_dom->getElementsByTagName('img') as $image) {
                $src = $image->getAttribute('src');
                if(!in_array($src, $new_imgs) && file_exists(public_path($src))) {
                    unlink(public_path($src));
                }
            }

            $page_translations = DB::table('pages_translations')->where('id', '=', $id)->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title,'-'),
                'description' => $request->description,
                'content' => $request->content,
                'is_published' => $request->is_published ? true : false
            ]);

            $entity_name = trans('entities.page');
            return redirect('admin/pages')->with('success', trans('forms.updated_success',['obj' => $entity_name]));
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function changePublished(Request $request)
    {
        $response = [
            'status' => false,
            'message' => trans('api.error_general')
        ];

        try {
            $validation_data = [
                'id' => ['required', 'exists:pages_translations,id'],
                'value' => ['required', 'boolean']
            ];
    
            $validator = Validator::make($request->all(), $validation_data);
    
            if ($validator->fails()) {
                $response['message'] = trans('api.error_validation');
                return response()->json($response);
            }

            $upd_page_published = DB::table('pages_translations')->where('id', '=', $request->id)->update([
                'is_published' => $request->value
            ]);

            $response['status'] = true;
            $obj = trans('entities.page');
            $response['message'] = trans('forms.updated_success', ['obj' => $obj]);
            return response()->json($response);
        } catch(\Exception $e){
            $response['message'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function uploadImg(Request $request)
    {
        $response = [
            'status' => false,
            'message' => trans('api.error_general')
        ];

        try {
            $validation_data = [
                'file' => ['required', 'mimes:jpg,jpeg,png,bmp,tiff,pdf'],
            ];

            $validator = Validator::make($request->all(), $validation_data);
    
            if ($validator->fails()) {
                $response['message'] = trans('api.error_validation');
                return response()->json($response);
            }

            if($request->hasFile('file')) {
                $rename_file = time().'.'.$request->file->getClientOriginalExtension();
                $request->file->move(public_path('/img'), $rename_file);
                $response['path'] = '/img/'.$rename_file;
            }

            $response['status'] = true;
            return response()->json($response);
        } catch(\Exception $e){
            $response['message'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function page($pageSlug)
    {
        $page = DB::table('pages_translations')->where('slug', '=', $pageSlug)->first();
        return view('pages::show', ['page' => $page]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::findOrFail($id)->delete();
        $entity_name = trans('entities.page');
        return redirect('admin/pages')->with('success', trans('forms.deleted_success',['obj' => $entity_name]));
    }
}
