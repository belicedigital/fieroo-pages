{{-- @extends('layouts.app')
@section('title', $page->title)
@section('title_header', $page->title)
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{$page->description}}</h5>
                </div>
                <div class="card-body">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts/layoutMaster')
@section('title', $page->title)
@section('title_header', $page->title)

@section('path', trans('entities.pages'))
@section('current', $page->title)


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <div id="description"> --}}
                    {!! $page->description !!}
                    {{-- </div> --}}
                </div>
                {{-- <div class="card-body" id="content"> --}}
                <div class="card-body">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
@endsection

@section('page-style')
    <style>
        /* Regole CSS per le immagini all'interno dell'editor */
        p img {
            max-width: 100%;
            /* Imposta la larghezza massima dell'immagine al 100% del suo contenitore */
            height: auto;
            /* Mantiene il rapporto originale delle dimensioni dell'immagine */
        }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
@endsection

{{-- @section('page-script')
    <script src="{{ asset('assets/js/text-editor.js') }}"></script>
    <script>
        readHTMLQuill({
            description: {!! $page->description !!},
            content: {!! $page->content !!},
        })
    </script>
@endsection --}}
