@extends('admin.layouts.app')
@section('title','All Press Release')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">News And Events</p>
            <a class="btn btn-sm btn-success" href="{{route('news-and-events.create')}}">Add New</a>
        </div>
        <div class="widget-list">
            <div class="row">
                <div class="col-md-12 widget-holder my-5">
                    <div class="widget-body clearfix my-3">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm dataTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">category</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">Thumbnail</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function () {
            var t = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                order: [[0, 'desc']],
                ajax: "{{route('getNewsAndEvents')}}",
                columns: [
                    {data: 'id', orderable: false},
                    {data: 'name'},
                    {data: 'event_date'},
                    {data: 'news_categories_id'},
                    {data: 'tag'},
                    {data: null},
                    {data: null}
                ],
                columnDefs: [
                    {
                        render: function (data, type, row, meta) {
                            var Imagess = '{{ asset('Main/frontend/images/NewsAndEvents')}}/' + data.thumbnail;
                            return '<img src="' + Imagess + '" height="50" width="50" alt="No Image Uploaded"/>';
                        },
                        searchable: false,
                        orderable: false,
                        targets: 5
                    },
                    {
                        render: function (data, type, row, meta, name) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        searchable: false,
                        orderable: true,
                        targets: 0
                    },
                    {
                        render: function (data, type, row, meta) {
                            var edit = '{{ route("news-and-events.edit", ":id") }}';
                            edit = edit.replace(':id', data.id);
                            var del = '{{ route("news-and-events.delete", ":id") }}';
                            del = del.replace(':id', data.id);
                            var sdel = '{{ route("news-and-events.destroy", ":id") }}';
                            sdel = sdel.replace(':id', data.id);
                            var restore = '{{ route("news-and-events.restore", ":id") }}';
                            restore = restore.replace(':id', data.id);

                            if (data.deleted_at == '1') {
                                return '<div class="d-flex">' +
                                    @can('news-and-events-restore')
                                        '<a href="' + restore + '" class="btn btn-sm btn-warning mx-2">restore</a>' +
                                    @endcan
                                        @can('news-and-events-delete')
                                        '<form action="' + del + '" method="POST">' +
                                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                                    '<input type="hidden" name="_method" value="delete" />' +
                                    '<button type="submit" class="btn btn-sm btn-danger mx-2" onclick="return confirm(Are you sure?)"><i class="fa fa-trash"></i></button>' +
                                    '</form>' +
                                    @endcan
                                        '</div>';
                            }
                            if (data.deleted_at == '0') {
                                return '<div class="d-flex">' +
                                    @can('news-and-events-edit')
                                        '<a href="' + edit + '" class="btn btn-sm btn-warning mx-2"><i class="fa fa-edit"></i></a>' +
                                    @endcan
                                        @can('news-and-events-softdelete')
                                        '<form action="' + sdel + '" method="POST">' +
                                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                                    '<input type="hidden" name="_method" value="delete" />' +
                                    '<button type="submit" class="btn btn-sm btn-danger mx-2" onclick="return confirm(Are you sure?)"><i class="fa fa-trash"></i></button>' +
                                    '</form>' +
                                    @endcan
                                        '</div>';
                            }
                        },
                        searchable: false,
                        orderable: false,
                        targets: -1
                    }
                ]
            });
        });
    </script>
@endpush
