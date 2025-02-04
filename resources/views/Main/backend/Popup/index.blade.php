@extends('admin.layouts.app')
@section('title','Popups')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Popups</p>
            <a class="btn btn-sm btn-success" href="{{route('popup.create')}}">Add New</a>
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
                            <th scope="col">Position</th>
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
                processing: true,
                serverSide: true,
                order:[[0,'desc']],
                ajax: "{{route('getPopUp')}}",
                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    { data: 'status',searchable:false},
                    { data: 'position' },
                    { data: null}
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
                        render: function (data,type,row,meta,record) {
                            var edit ='{{ route("popup.edit", ":id") }}';
                            edit = edit.replace(':id', data.id);
                            var sdel ='{{ route("popup.destroy", ":id") }}';
                            sdel = sdel.replace(':id', data.id);
                            var restore ='{{ route("popup.restore", ":id") }}';
                            restore = restore.replace(':id', data.id);
                            var del ='{{ route("popup.delete", ":id") }}';
                            del = del.replace(':id', data.id);
                            var show =  data.image
                            console.warn(data.deleted_at)
                            if(data.deleted_at =='1'){
                                return '<div class="d-flex">'+
                                    @can('popup-restore')
                                        '<a href="'+restore+'" class="btn btn-sm btn-warning mx-2"><i class="fa fa-undo"></i></a>'+
                                    @endcan

                                        @can('popup-delete')
                                        '<form action="'+del+'" method="POST">'+
                                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                                    '<input type="hidden" name="_method" value="delete" />'+
                                    '<button type="submit" class="btn btn-sm btn-danger mx-2" onclick="return confirm(`Are you sure?`)"><i class="fa fa-trash"></i></button>'+
                                    '</form>'+
                                    @endcan
                                        '</div>';
                            }
                            if(data.deleted_at=='0'){
                                return  '<div class="d-flex ">'+
                                    // showData Button
                                    show+
                                    @can('popup-edit')
                                        '<a href="'+edit+'" class="btn btn-sm btn-warning mx-2"><i class="fa fa-edit"></i></a>'+
                                    @endcan
                                        @can('popup-softdelete')
                                        '<form action="'+sdel+'" method="POST">'+
                                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                                    '<input type="hidden" name="_method" value="delete" />'+
                                    '<button type="submit" class="btn btn-sm btn-danger mx-2" onclick="return confirm(`Are you sure?`)"><i class="fa fa-trash"></i></button>'+
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
