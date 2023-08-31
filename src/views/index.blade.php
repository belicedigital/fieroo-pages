@extends('layouts.app')
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
                                    @foreach($it_pages as $page)
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
                                    @foreach($en_pages as $page)
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