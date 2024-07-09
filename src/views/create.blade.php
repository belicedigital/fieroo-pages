{{-- @extends('layouts.app')
@section('title', trans('crud.new', ['obj' => trans('entities.page')]))
@section('title_header', trans('crud.new', ['obj' => trans('entities.page')]))
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
                <div class="card card-tabs">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="it-tab" data-toggle="pill" href="#it-pages-tab"
                                    role="tab" aria-controls="it-pages-tabe" aria-selected="true">IT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="en-tab" data-toggle="pill" href="#en-pages-tab" role="tab"
                                    aria-controls="en-pages-tab" aria-selected="false">EN</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="it-pages-tab" role="tabpanel"
                                    aria-labelledby="it-tab">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.title') }}</strong>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ old('title') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('forms.description') }}</strong>
                                                <textarea name="description" class="form-control" value="{{ old('description') }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('forms.content') }}</strong>
                                                <textarea name="content" class="form-control summernote" value="{{ old('content') }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="is_published" name="is_published">
                                                    <label for="is_published">{{ trans('forms.publish') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="en-pages-tab" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('tables.title') }}</strong>
                                                <input type="text" name="title_en" class="form-control"
                                                    value="{{ old('title_en') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('forms.description') }}</strong>
                                                <textarea name="description_en" class="form-control" value="{{ old('description_en') }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>{{ trans('forms.content') }}</strong>
                                                <textarea name="content_en" class="form-control summernote" value="{{ old('content_en') }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="is_published_en" name="is_published_en">
                                                    <label for="is_published_en">{{ trans('forms.publish') }}</label>
                                                </div>
                                            </div>
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
            $('input[name="title"]').on('keyup change', function(e) {
                $('input[name="title_en"]').val($(this).val() + '_EN');
            });
            $('textarea').on('keyup change', function(e) {
                var _name = $(this).attr('name');
                $('textarea[name="' + _name + '_en"]').val($(this).val() + '_EN');
            });
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

@section('title', trans('crud.new', ['obj' => trans('entities.page')]))
@section('title_header', trans('crud.new', ['obj' => trans('entities.page')]))

@section('path', trans('entities.pages'))
@section('current', trans('crud.new', ['obj' => trans('entities.page')]))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <ul class="nav nav-pills card-header-tabs mb-2" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-it" role="tab"
                                aria-selected="true">IT</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link " data-bs-toggle="tab" data-bs-target="#form-tabs-en" role="tab"
                                aria-selected="false">EN</button>
                        </li>
                    </ul>
                    <form id="myForm" action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="form-tabs-it" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-label"
                                            for="title"><strong>{{ trans('tables.title') }}</strong></label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ old('title') }}" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-label"><strong>{{ trans('forms.description') }}</strong></label>
                                        <div id="description" name="description" class="quillEditor"></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-label"><strong>{{ trans('forms.content') }}</strong></label>
                                        <div id="content" name="content" class="quillEditor"></div>
                                    </div>
                                    <div class="col-md-6 select2-primary">
                                        <label class="switch switch-primary switch-sm me-0">
                                            <span class="switch-label"><strong>{{ trans('forms.publish') }}</strong></span>
                                            <input name="is_published" id="is_published" class='switch-input'
                                                type="checkbox">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"></span>
                                                <span class="switch-off"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="form-tabs-en" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-label"
                                            for="title_en"><strong>{{ trans('tables.title') }}</strong></label>
                                        <input type="text" name="title_en" id="title_en" class="form-control"
                                            value="{{ old('title_en') }}" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-label"><strong>{{ trans('forms.description') }}</strong></label>
                                        <div id="description_en" name="description_en" class="quillEditor"></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        <label class="form-label"><strong>{{ trans('forms.content') }}</strong></label>
                                        <div id="content_en" name="content_en" class="quillEditor"></div>
                                    </div>
                                    <div class="col-md-6 select2-primary">
                                        <label class="switch switch-primary switch-sm me-0">
                                            <span class="switch-label"><strong>{{ trans('forms.publish') }}</strong></span>
                                            <input name="is_published_en" id="is_published_en" class='switch-input'
                                                type="checkbox">
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"></span>
                                                <span class="switch-off"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" id="create-page"
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
        const editors = document.querySelectorAll('.quillEditor');
        initEditors(editors, 'myForm', {}, {
            input: 'title',
            textarea: ['description', 'content'],
        })
        // autoCompileTrans({
        //     input: 'title',
        //     textarea: ['description', 'content'],
        // })

        //document.addEventListener('DOMContentLoaded', () => {
        // const titleInput = document.querySelector('input[name="title"]');
        // const titleEnInput = document.querySelector('input[name="title_en"]');

        // titleInput.addEventListener('keyup', (e) => {
        //     titleEnInput.value = titleInput.value + '_EN';
        // });

        // titleInput.addEventListener('change', (e) => {
        //     titleEnInput.value = titleInput.value + '_EN';
        // });

        /* const textareas = document.querySelectorAll('textarea');
         
                 textareas.forEach(textarea => {
                 textarea.addEventListener('keyup', (e) => {
                 const name = textarea.getAttribute('name');
                 const targetTextarea = document.querySelector(`textarea[name="${name}_en"]`);
                 if (targetTextarea) {
                 targetTextarea.value = textarea.value + '_EN';
                 }
                 });
         
                 textarea.addEventListener('change', (e) => {
                 const name = textarea.getAttribute('name');
                 const targetTextarea = document.querySelector(`textarea[name="${name}_en"]`);
                 if (targetTextarea) {
                 targetTextarea.value = textarea.value + '_EN';
                 }
                 });
                 }); */
        // });

        // Set editors
        // const editDesc = createFullEditor('#description-editor');
        // const editCont = createFullEditor('#content-editor');
        // const editDescEn = createFullEditor('#description_en-editor');
        // const editContEn = createFullEditor('#content_en-editor');

        // Sincronizzazione del contenuto degli editor di Quill
        editDesc.on('text-change', () => {
            const descriptionContent = editDesc.root.innerHTML
            editDescEn.root.innerHTML = descriptionContent.replace(/(<\/[\w\s="':;]+>)$/, '_EN$1');
        });

        editCont.on('text-change', () => {
            const contentContent = editCont.root.innerHTML
            editContEn.root.innerHTML = contentContent.replace(/(<\/[\w\s="':;]+>)$/, '_EN$1');
        });

        const form = document.getElementById('myForm');
        form.addEventListener('submit', () => {
            const desc = editDesc.getContents();
            document.getElementById('description').value = JSON.stringify(desc);;
            const cont = editCont.getContents();
            document.getElementById('content').value = JSON.stringify(cont);;
            const descEn = editDescEn.getContents();
            document.getElementById('description_en').value = JSON.stringify(descEn);;
            const contEn = editContEn.getContents();
            document.getElementById('content_en').value = JSON.stringify(contEn);;
        })
    </script>
@endsection
