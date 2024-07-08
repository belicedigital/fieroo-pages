{{-- @extends('layouts.app')
@section('title', trans('crud.edit', ['item' => $page->title]))
@section('title_header', trans('crud.edit', ['item' => $page->title]))
@section('buttons')
    <a href="{{ url('admin/pages') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
        title="{{ trans('generals.back') }}"><i class="fas fa-chevron-left"></i></a>
@endsection
@section('content')
    <div class="container">
        @if ($errors->any())
            @include('admin.partials.errors', ['errors' => $errors])
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ trans('tables.title') }}</strong>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $page->title }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ trans('forms.description') }}</strong>
                                        <textarea name="description" class="form-control">{{ $page->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ trans('forms.content') }}</strong>
                                        <textarea name="content" class="form-control summernote">{{ $page->content }}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="is_published" name="is_published"
                                                {{ $page->is_published ? 'checked' : '' }}>
                                            <label for="is_published">{{ trans('forms.publish') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">{{ trans('generals.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                callbacks: {
                    onImageUpload: function(files) {
                        sendFile(files[0], $(this));
                    }
                }
            });
            // $('.note-btn-group.btn-group.note-insert').hide()
        });
    </script>
@endsection
 --}}
@extends('layouts/layoutMaster')
@section('title', trans('crud.edit', ['item' => $page->title]))
@section('title_header', trans('crud.edit', ['item' => $page->title]))
@section('buttons')
    <a href="{{ url('admin/pages') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
        title="{{ trans('generals.back') }}"><i class="fas fa-chevron-left"></i></a>
@endsection

@section('path', trans('entities.pages'))
@section('current', trans('crud.edit', ['item' => $page->title]))


@section('content')
    <div class='row'>
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="myForm" action="{{ route('pages.update', $page->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="row g-3">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label class="form-label fs-6 fw-bolder"
                                    for="formtabs-title">{{ trans('tables.title') }}</label>
                                <input type="text" name="title" id="formtabs-title" class="form-control"
                                    value="{{ $page->title }}" />
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label class="form-label fs-6 fw-bolder">{{ trans('forms.description') }}</label>
                                <div id="description" name="description">{!! $page->description !!}</div>
                                {{-- <textarea name="description" id="description" class="form-control" style="display: none;"></textarea> --}}
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label class="form-label fs-6 fw-bolder">{{ trans('forms.content') }}</label>
                                <div id="content" name="content">{!! $page->content !!}</div>
                                {{-- <textarea name="content" id="content" class="form-control" style="display: none;"></textarea> --}}
                            </div>
                            <div class="col-md-6 select2-primary">
                                <label class="switch switch-primary switch-sm me-0">
                                    <span class="switch-label fs-6 fw-bolder"">{{ trans('forms.publish') }}</span>
                                    <input name="is_published" id="is_published" class='switch-input' type="checkbox"
                                        {{ $page->is_published ? 'checked' : '' }}>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit"
                                class="btn btn-primary me-sm-3 me-1">{{ trans('generals.save') }}</button>
                            <a href="{{ url('admin/pages') }}"
                                class="btn btn-label-secondary">{{ trans('generals.cancel') }}</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/text-editor.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fullEditorDesc = createFullEditor('#description');
            const fullEditorCont = createFullEditor('#content');

            // Inizializza i campi
            var initDesc = {!! json_encode($page->description) !!};
            var desc = JSON.parse(initDesc);
            fullEditorDesc.setContents(desc);

            var initCont = {!! json_encode($page->content) !!};
            var cont = JSON.parse(initCont);
            fullEditorCont.setContents(cont);

            // Aggiorna i campi nascosti con il contenuto degli editor
            const form = document.getElementById('myForm');
            form.addEventListener('submit', () => {
                desc = fullEditorDesc.getContents();
                document.getElementById('description').value = JSON.stringify(desc);
                cont = fullEditorCont.getContents();
                document.getElementById('content').value = JSON.stringify(cont);
            });
        });
    </script>
@endsection
