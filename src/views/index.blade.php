{{-- @extends('layouts.app')
@section('title', trans('entities.pages'))
@section('title_header', trans('entities.pages'))
@section('buttons')
<a href="{{url('admin/pages/create')}}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="{{trans('generals.add')}}"><i class="fas fa-plus"></i></a>
@endsection
@section('content')
<div class="container-fluid">
    @if (Session::has('success'))
    @include('admin.partials.success')
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card card-tabs">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="it-tab" data-toggle="pill" href="#it-pages-tab" role="tab" aria-controls="it-pages-tab" aria-selected="true">IT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="en-tab" data-toggle="pill" href="#en-pages-tab" role="tab" aria-controls="en-pages-tab" aria-selected="false">EN</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-3">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="it-pages-tab" role="tabpanel" aria-labelledby="it-tab">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>{{trans('tables.title')}}</th>
                                        <th>{{trans('tables.slug')}}</th>
                                        <th>{{trans('tables.published')}}</th>
                                        <th class="no-sort">{{trans('tables.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($it_pages as $page)
                                    <tr data-page-id="{{$page->id}}">
                                        <td>{{$page->title}}</td>
                                        <td>{{$page->slug}}</td>
                                        <td>
                                            <input name="is_published" type="checkbox" {{$page->is_published ? 'checked' : ''}} data-toggle="toggle" data-on="{{trans('generals.yes')}}" data-off="{{trans('generals.no')}}" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group" role="group">
                                                <a data-toggle="tooltip" data-placement="top" title="{{trans('generals.edit')}}" class="btn btn-default" href="{{route('pages.edit', $page->id)}}"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('pages.destroy', $page->page_id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button data-toggle="tooltip" data-placement="top" title="{{trans('generals.delete')}}" class="btn btn-default"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="en-pages-tab" role="tabpanel" aria-labelledby="en-tab">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>{{trans('tables.title')}}</th>
                                        <th>{{trans('tables.slug')}}</th>
                                        <th>{{trans('tables.published')}}</th>
                                        <th class="no-sort">{{trans('tables.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($en_pages as $page)
                                    <tr data-page-id="{{$page->id}}">
                                        <td>{{$page->title}}</td>
                                        <td>{{$page->slug}}</td>
                                        <td>
                                            <input name="is_published" type="checkbox" {{$page->is_published ? 'checked' : ''}} data-toggle="toggle" data-on="{{trans('generals.yes')}}" data-off="{{trans('generals.no')}}" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group" role="group">
                                                <a data-toggle="tooltip" data-placement="top" title="{{trans('generals.edit')}}" class="btn btn-default" href="{{route('pages.edit', $page->id)}}"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('pages.destroy', $page->page_id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button data-toggle="tooltip" data-placement="top" title="{{trans('generals.delete')}}" class="btn btn-default"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('form button').on('click', function(e) {
        var $this = $(this);
        e.preventDefault();
        Swal.fire({
            title: "{!! trans('generals.confirm_remove') !!}",
            html: "{!! trans('generals.confirm_remove_both_sub') !!}",
            showCancelButton: true,
            confirmButtonText: "{{ trans('generals.confirm') }}",
            cancelButtonText: "{{ trans('generals.cancel') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                $this.closest('form').submit();
            }
        })
    });
    $(document).ready(function() {
        $('table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": false,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
            "oLanguage": {
                "sSearch": "{{trans('generals.search')}}",
                "oPaginate": {
                    "sFirst": "{{trans('generals.start')}}", // This is the link to the first page
                    "sPrevious": "«", // This is the link to the previous page
                    "sNext": "»", // This is the link to the next page
                    "sLast": "{{trans('generals.end')}}" // This is the link to the last page
                }
            }
        });
        $('input[type="checkbox"]').change(function() {
            let page_id = $(this).closest('tr').data('page-id')
            let base_url = '/admin/page-toggle-status'
            common_request.post(base_url, {
                id: page_id,
                value: $(this).is(':checked')
            })
            .then(response => {
                console.log(response)
                let data = response.data
                if(data.status) {
                    toastr.success(data.message)
                } else {
                    toastr.error(data.message)
                }
            })
            .catch(error => {
                toastr.error(error)
                console.log(error)
            })
        });
    });
</script>
@endsection
 --}}

@extends('layouts/layoutMaster')

@section('title', trans('entities.pages'))
@section('title_header', trans('entities.pages'))
@section('button')
    <a href="{{ url('admin/pages/create') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
        data-bs-original-title="{{ trans('generals.add') }}"><i class="fas fa-plus"></i></a>
@endsection
@section('path', trans('entities.pages'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <ul class="nav nav-pills card-header-tabs mb-2" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#it-pages-tab" aria-controls="it-pages-tab"
                                    aria-selected="true">IT</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#en-pages-tab" aria-controls="en-pages-tab"
                                    aria-selected="false">EN</button>
                            </li>
                        </ul>
                        {{-- <div class="head-label text-center">
                               <h3 class="card-title mb-0">{{ __('Pagine') }}</h3>
                           </div> --}}
                        {{-- <div class="dt-action-buttons text-end pt-3 pt-md-0">
                            <a href="{{ url('admin/pages/create') }}"
                                class="btn btn-secondary create-new btn-primary waves-effect waves-light"
                                data-toggle="tooltip" data-placement="bottom"><span><i class="fas fa-plus"></i>
                                    <span class="d-none d-sm-inline-block">{{ trans('generals.add') }}</span>
                                </span></a>
                        </div> --}}
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="it-pages-tab" role="tabpanel">
                            <div class="card-datatable table-responsive pt-0">
                                <table id="it-pages-table" class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('tables.title') }}</th>
                                            <th>{{ trans('tables.slug') }}</th>
                                            <th class="no-sort">{{ trans('tables.published') }}</th>
                                            <th class="no-sort">{{ trans('tables.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($it_pages as $page)
                                            <tr data-page-id="{{ $page->id }}">
                                                <td><span class="fw-medium">{{ $page->title }}</span></td>
                                                <td>{{ $page->slug }}</td>
                                                <td>
                                                    <label class="switch switch-primary switch-sm me-0">
                                                        <input name="is_published" class='switch-input' type="checkbox"
                                                            {{ $page->is_published ? 'checked' : '' }} data-toggle="toggle"
                                                            data-on="{{ trans('generals.yes') }}"
                                                            data-off="{{ trans('generals.no') }}" data-onstyle="success"
                                                            data-offstyle="danger" data-size="sm">
                                                        <span class="switch-toggle-slider">
                                                            <span class="switch-on"></span>
                                                            <span class="switch-off"></span>
                                                        </span>
                                                        <span class="switch-label"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group" role="group">
                                                        <a data-toggle="tooltip" data-placement="top"
                                                            title="{{ trans('generals.edit') }}" class="btn btn-default"
                                                            href="{{ route('pages.edit', $page->id) }}"><i
                                                                class="fa fa-edit"></i></a>
                                                        <form action="{{ route('pages.destroy', $page->page_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button data-toggle="tooltip" data-placement="top"
                                                                title="{{ trans('generals.delete') }}"
                                                                class="btn btn-default"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="en-pages-tab" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table id="en-pages-table" class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('tables.title') }}</th>
                                            <th>{{ trans('tables.slug') }}</th>
                                            <th class="no-sort">{{ trans('tables.published') }}</th>
                                            <th class="no-sort">{{ trans('tables.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($en_pages as $page)
                                            <tr data-page-id="{{ $page->id }}">
                                                <td><span class="fw-medium">{{ $page->title }}</span></td>
                                                <td>{{ $page->slug }}</td>
                                                <td>
                                                    <label class="switch switch-primary switch-sm me-0">
                                                        <input name="is_published" class='switch-input' type="checkbox"
                                                            {{ $page->is_published ? 'checked' : '' }} data-toggle="toggle"
                                                            data-on="{{ trans('generals.yes') }}"
                                                            data-off="{{ trans('generals.no') }}" data-onstyle="success"
                                                            data-offstyle="danger" data-size="sm">
                                                        <span class="switch-toggle-slider">
                                                            <span class="switch-on"></span>
                                                            <span class="switch-off"></span>
                                                        </span>
                                                        <span class="switch-label"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a data-toggle="tooltip" data-placement="top"
                                                            title="{{ trans('generals.edit') }}" class="btn btn-default"
                                                            href="{{ route('pages.edit', $page->id) }}"><i
                                                                class="fa fa-edit"></i></a>
                                                        <form action="{{ route('pages.destroy', $page->page_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button data-toggle="tooltip" data-placement="top"
                                                                title="{{ trans('generals.delete') }}"
                                                                class="btn btn-default"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <!-- Table -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection


@section('page-script')
    <script>
        $(document).ready(function() {
            $('.datatables-basic').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "order": [],
                "columnDefs": [{
                        "orderable": true,
                        "targets": [0, 1]
                    },
                    {
                        "orderable": false,
                        "targets": [2, 3]
                    }
                ],
                "lengthMenu": [5, 10, 25, 50],
                "pageLength": 10,
                "language": {
                    "search": "{{ trans('generals.search') }}",
                    "paginate": {
                        "first": "{{ trans('generals.start') }}",
                        "previous": "«",
                        "next": "»",
                        "last": "{{ trans('generals.end') }}"
                    }
                }
                /*
                "lengthMenu": "Mostra _MENU_ elementi per pagina",
                "zeroRecords": "Nessun risultato trovato",
                "info": "Mostra pagina _PAGE_ di _PAGES_",
                "infoEmpty": "Nessun dato disponibile",
                "infoFiltered": "(filtrato da _MAX_ elementi totali)",
                "search": "Cerca:"
                */
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('form button').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const confirmTitle = "{!! trans('generals.confirm_remove') !!}";
                    const confirmHtml = "{!! trans('generals.confirm_remove_both_sub') !!}";
                    const confirmButtonText = "{!! trans('generals.confirm') !!}";
                    const cancelButtonText = "{!! trans('generals.cancel') !!}";

                    Swal.fire({
                        title: confirmTitle,
                        html: confirmHtml,
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: confirmButtonText,
                        cancelButtonText: cancelButtonText
                    }).then((result) => {
                        if (result.isConfirmed) {
                            e.target.closest('form').submit();
                        }

                    });
                });
            });

            /* const dataTableElement = document.querySelector('table');
            if (dataTableElement) {
                $(dataTableElement).DataTable({
                    paging: true,
                    lengthChange: false,
                    searching: true,
                    ordering: true,
                    info: false,
                    autoWidth: false,
                    responsive: false,
                    columnDefs: [{
                        orderable: false,
                        targets: 'no-sort'
                    }],
                    oLanguage: {
                        sSearch: "{{ trans('generals.search') }}",
                        oPaginate: {
                            sFirst: "{{ trans('generals.start') }}",
                            sPrevious: "«",
                            sNext: "»",
                            sLast: "{{ trans('generals.end') }}"
                        }
                    }
                });
            } */

            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', async (event) => {
                    // Recupera il riferimento all'elemento checkbox
                    const checkbox = event.target;

                    // Trova l'ID della pagina associata a questo checkbox
                    const pageId = checkbox.closest('tr').dataset.pageId;

                    // URL per la richiesta POST
                    const baseUrl = '/admin/page-toggle-status';

                    try {
                        // Effettua la richiesta POST utilizzando `fetch`
                        const response = await fetch(baseUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                id: pageId,
                                value: checkbox.checked
                            })
                        });

                        // Controlla se la risposta è ok (status tra 200-299)
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        // Converte la risposta in JSON
                        const data = await response.json();

                        // Gestisce la risposta
                        if (data.status) {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }

                    } catch (error) {
                        // Gestione degli errori
                        toastr.error(error.message);
                        console.error('Error:', error);
                    }
                });
            });

        });
    </script>
@endsection
