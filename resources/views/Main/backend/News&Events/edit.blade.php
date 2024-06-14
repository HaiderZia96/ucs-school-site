@extends('admin.layouts.app')
@section('title','Edit News and Events')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Add New</p>
            <a class="btn btn-sm btn-warning" href="{{route('news-and-events.index')}}">View All</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('news-and-events.update', $editNewsEvents->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Event or News Category</label>
                                    <select class="form-control rounded-0" name="news_categories_id">
                                        <option value="">Please Select</option>
                                        @foreach($news_categories as $categories)
                                            @if ($categories->id)
                                                <option {{ $editNewsEvents->news_categories_id == $categories->id ? 'selected="selected"' : '' }} value="{{$categories->id}}">{{$categories->name}}</option>
                                            @else
                                                <option value="{{$events->id}}">{{$categories->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control rounded-0" name="name" value="{{(isset($editNewsEvents->name))?$editNewsEvents->name:old('name')}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date *</label>
                                    <input type="date" class="form-control rounded-0" name="event_date" value="{{(isset($editNewsEvents->event_date))?$editNewsEvents->event_date:old('event_date')}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tags</label>
                                    <select class="form-control rounded-0" id="tag" name="tag[]">
                                        <option value="">Please Select</option>
                                        @foreach($newstag as $newtag)
                                            <option value="{{$newtag->slug}}" @foreach($selectedtags as $selectedtag) {{ $newtag->slug == $selectedtag ? 'selected' : '' }} @endforeach>{{$newtag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Thumbnail *</label>
                                    <input type="hidden" id="thumbnail" name="old_thumbnail" class="form-control mb-0" value="{{(isset($editNewsEvents->thumbnail))?$editNewsEvents->thumbnail:old('thumbnail')}}">
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control mb-0">
                                    <p><small style="color:red;font-size:12px;">Previous image is already uploaded in case of changing image click on Upload Button.</small></p>
                                </div>
{{--                                <div class="col-md-6 mb-3">--}}
{{--                                    <label class="form-label">Cover Image *</label>--}}
{{--                                    <input type="hidden" id="cover_image" name="old_cover_image" class="form-control mb-0" value="{{(isset($editNewsEvents->cover_image))?$editNewsEvents->cover_image:old('cover_image')}}">--}}
{{--                                    <input type="file" id="cover_image" name="cover_image" class="form-control mb-0">--}}
{{--                                    <p><small style="color:red;font-size:12px;">Previous image is already uploaded in case of changing image click on Upload Button.</small></p>--}}
{{--                                </div>--}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Short Description</label>
                                    <textarea class="form-control mb-0" rows="2" cols="100" value="{{ old('short_description') }}" id="short_description"  name="short_description">{{ (isset($editNewsEvents->short_description))?$editNewsEvents->short_description:old('short_description') }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control mb-0" rows="2" cols="100" value="{{ old('news-ckeditor') }}" id="news-ckeditor"  name="description">{!! $editNewsEvents->description !!}</textarea>
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
    $('.campus-multiple').select2();
});
    $(document).ready(function() {
        var editor = CKEDITOR.replace( 'news-ckeditor', {
            filebrowserUploadUrl: "{{route('news-and-events-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    });
</script>
@endpush
