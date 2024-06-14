@extends('admin.layouts.app')
@section('title','Create News and Event')
@section('content')
    <style>
        .cke_dialog_ui_input_file{
         height: 200px !important;
        }
    </style>
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Add New</p>
            <a class="btn btn-sm btn-warning" href="{{route('news-and-events.index')}}">View All</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('news-and-events.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Event or News Category</label>
                                    <select class="form-control rounded-0" name="news_categories_id">
                                        <option value="">Please Select</option>
                                        @foreach($newsCategories as $categories)
                                            <option value="{{$categories->id}}">{{$categories->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control rounded-0" name="name" value="{{old('name')}}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date *</label>
                                    <input type="date" class="form-control rounded-0" name="event_date" value="{{old('event_date')}}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tags</label>
                                    <select class="form-control rounded-0" id="tag" name="tag[]">
                                        <option value="">Please Select</option>
                                        @foreach($newstag as $newtag)
                                            <option value="{{$newtag->slug}}">{{$newtag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Thumbnail *</label>
                                    <input type="file" class="form-control rounded-0" name="thumbnail" value="{{old('thumbnail')}}">
                                </div>

{{--                                <div class="col-md-6 mb-3">--}}
{{--                                    <label class="form-label">Cover Image *</label>--}}
{{--                                    <input type="file" class="form-control rounded-0" name="cover_image" value="{{old('cover_image')}}">--}}
{{--                                </div>--}}

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control mb-0" rows="2" cols="100" value="{{ old('short_description') }}" id="short_description"  name="short_description"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control mb-0" rows="2" cols="100" value="{{ old('news-ckeditor') }}" id="news-ckeditor"  name="description"></textarea>
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
    </div>
@endsection
@push('js')
<script src="{{asset('ckeditor')}}/ckeditor.js"></script>
 <script src="{{asset('ckeditor')}}/ckfinder/ckfinder.js"></script>
 <script src="{{asset('ckeditor')}}/samples/js/sample.js"></script>
<script>
    $(document).ready(function() {
    $('.tag-multiple').select2();
});
    $(document).ready(function() {
        var editor = CKEDITOR.replace( 'news-ckeditor', {
            filebrowserUploadUrl: "{{route('news-and-events-upload', ['_token' => csrf_token() ])}}",
            extraPlugins: 'attach',
            toolbar: this.customToolbar,
            filebrowserUploadMethod: 'form'
        });
    });
</script>
@endpush
