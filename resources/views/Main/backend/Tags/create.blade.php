@extends('admin.layouts.app')
@section('title','Create & View Tags')
@section('content')


        <div class="container-fluid">
            <div class="d-flex justify-content-between py-4">
                <p class="page-title">Create New Tags</p>
                <a class="btn btn-sm btn-warning" href="{{route('tags.create')}}">View All</a>
            </div>
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('tags.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" name="role_status" value="1">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Tag *</label>
                                        <input type="text" class="form-control rounded-0" name="name"
                                               value="{{old('name')}}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="submit" class="btn btn-sm btn-success" value="Add New">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-body clearfix mt-5">
                <div class="table-responsive">
                    <table class="table table-striped table-sm dataTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Updated By</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
@endsection
@push('js')
<script>
    $(function (){
        var t = $('.dataTable').DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "dom": '<"top"<"left-col"B><"right-col"f>><"top-Panding-col"l>rtip',
        "lengthMenu": [[10, 20, 30, 500, 1000, 100000, 100000000], [10, 20, 30, 500, 1000, 100000, "All"]],
            processing: true,
            serverSide: true,
            order:[[0,'desc']],
            ajax: "{{route('getTags')}}",
            columns: [
                { data: 'id',orderable:false },
                { data: 'name' },
                { data: 'slug' },
                { data: 'created_by' },
                { data: 'updated_by' },
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
                    render: function (data,type,row,meta) {
                        var edit ='{{ route("tags.edit", ":id") }}';
                        edit = edit.replace(':id', data.id);
                        var del ='{{ route("tags.delete", ":id") }}';
                        del = del.replace(':id', data.id);
                        var sdel ='{{ route("tags.destroy", ":id") }}';
                        sdel = sdel.replace(':id', data.id);
                        var restore ='{{ route("tags.restore", ":id") }}';
                        restore = restore.replace(':id', data.id);

                        if(data.deleted_at =='1'){
                            return '<div class="d-flex">'+
                            @can('tags-restore')
                                '<a href="'+restore+'" class="btn btn-sm btn-warning mx-2">restore</a>'+
                            @endcan
                            @can('tags-delete')
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
                            @can('tags-edit')
                                '<a href="'+edit+'" class="btn btn-sm btn-warning mx-2"><i class="fa fa-edit"></i></a>'+
                            @endcan
                            @can('tags-softdelete')
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
