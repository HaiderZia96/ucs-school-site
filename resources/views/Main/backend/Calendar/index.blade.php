@extends('admin.layouts.app')
@section('title','All Calendars')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Calendars</p>
            <a class="btn btn-sm btn-success" href="{{route('calendar.create')}}">Add New</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm dataTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Archived</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function (){
            var t = $('.dataTable').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                // "dom": '<"top"<"left-col"B><"right-col"f>><"top-Panding-col"l>rtip',
                "lengthMenu": [[10, 20, 30, 500, 1000, 100000, 100000000], [10, 20, 30, 500, 1000, 100000, "All"]],
                processing: true,
                serverSide: true,
                order:[[0,'desc']],
                ajax: "{{ route('getCalendars') }}",
                columns: [
                    { data: 'id',orderable:false },
                    { data: 'name' },
                    { data: 'status' },
                    { data: 'archived' },
                    { data: null }
                ],
                columnDefs: [

                    {
                        render: function ( data, type, row,meta,name ) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        searchable:false,
                        orderable:true,
                        targets: 0
                    },
                    {
                        render: function (data,type,row,meta) {
                            var edit ='{{ route("calendar.edit", ":id") }}';
                            edit = edit.replace(':id', data.id);
                            var del ='{{ route("calendar.delete", ":id") }}';
                            del = del.replace(':id', data.id);
                            var sdel ='{{ route("calendar.destroy", ":id") }}';
                            sdel = sdel.replace(':id', data.id);
                            var restore ='{{ route("calendar.restore", ":id") }}';
                            restore = restore.replace(':id', data.id);
                            var moveDown ='{{ route("calendar.down", ":id") }}';
                            moveDown = moveDown.replace(':id', data.id);
                            var moveUp ='{{ route("calendar.up", ":id") }}';
                            moveUp = moveUp.replace(':id', data.id);

                            if(data.deleted_at =='1'){
                                return '<div class="d-flex">'+
                                    '<a href="'+moveDown+'" class="btn btn-sm btn-warning mx-2"><i class="fa fa-arrow-down"></i></a>'+
                                    '<a href="'+moveUp+'" class="btn btn-sm btn-success mx-2"><i class="fa fa-arrow-up"></i></a>'+
                                    @can('calendar-restore')
                                        '<a href="'+restore+'" class="btn btn-sm btn-warning mx-2">restore</a>'+
                                    @endcan
                                        @can('calendar-delete')
                                        '<form action="'+del+'" method="POST">'+
                                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                                    '<input type="hidden" name="_method" value="delete" />'+
                                    '<button type="submit" class="btn btn-sm btn-danger mx-2" onclick="return confirm(Are you sure?)"><i class="fa fa-trash"></i></button>'+
                                    '</form>'+
                                    @endcan
                                        '</div>';
                            }
                            if(data.deleted_at=='0'){
                                return  '<div class="d-flex">'+
                                    '<a href="'+moveDown+'" class="btn btn-sm btn-warning mx-2"><i class="fa fa-arrow-down"></i></a>'+
                                    '<a href="'+moveUp+'" class="btn btn-sm btn-success mx-2"><i class="fa fa-arrow-up"></i></a>'+
                                    @can('calendar-edit')
                                        '<a href="'+edit+'" class="btn btn-sm btn-warning mx-2"><i class="fa fa-edit"></i></a>'+
                                    @endcan
                                        @can('calendar-softdelete')
                                        '<form action="'+sdel+'" method="POST">'+
                                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                                    '<input type="hidden" name="_method" value="delete" />'+
                                    '<button type="submit" class="btn btn-sm btn-danger mx-2" onclick="return confirm(Are you sure?)"><i class="fa fa-trash"></i></button>'+
                                    '</form>'+
                                    @endcan
                                        '</div>';
                            }
                        },
                        searchable:false,
                        orderable:false,
                        targets: -1
                    }
                ]
            });
        });
    </script>
@endpush
