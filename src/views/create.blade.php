@extends('layouts.app')
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
