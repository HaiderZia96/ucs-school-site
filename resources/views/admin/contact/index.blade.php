@extends('admin.layouts.app')
@section('title','Categories')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Contact us</p>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm dataTable">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Number</th>
                            <th scope="col">Message</th>
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
                order:[[0,'asc']],
                ajax: "{{route('get-contact')}}",
                columns: [
                    { data:'id',orderable:false },
                    { data:'name' },
                    { data:'email' },
                    { data:'number' },
                    { data:'message'},   
                ]
                
            });
        });
    </script>
@endpush
