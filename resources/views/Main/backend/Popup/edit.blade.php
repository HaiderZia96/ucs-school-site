@extends('admin.layouts.app')
@section('title','Edit Popup')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Edit Popup</p>
            <a class="btn btn-sm btn-warning" href="{{route('popup.index')}}">View All</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('popup.update',$popup->id)}}"  method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!--Label For News/Events Title-->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"> Title</label>
                                    <input type="text" class="form-control rounded-0 @error('title') is-invalid @enderror" name="title" onkeyup="listingslug(this.value)"  value="{{(isset($popup->title) ? $popup->title : '')}}" placeholder="Enter Title">
                                    @error('title')
                                    <div class="alert text-danger m-0 p-0">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Slug -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="slug">Slug</label>
                                    <input type="text" class="form-control rounded-0 @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{(isset($popup->slug) ? $popup->slug : '')}}">
                                </div>
                                <!--Label For image-->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Popup Image</label>
                                    <input type="file" class="form-control rounded-0 @error('image') is-invalid @enderror" name="image" value="{{old('image')}}" placeholder="Attach image">
                                    @error('image')
                                    <div class="alert text-danger m-0 p-0">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--Status-->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-control rounded-0" id="status" name="status">
                                        <option value="">Please Select</option>
                                        <option value="1" @if(isset($popup->status) && $popup->status == 1) selected @endif>Active</option>
                                        <option value="0" @if(isset($popup->status) && $popup->status == 0) selected @endif>In Active</option>
                                    </select>
                                    @error('status')
                                    <div class="alert text-danger m-0 p-0">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Position</label>
                                    <input type="number" class="form-control rounded-0 @error('position') is-invalid @enderror" name="position" value="{{(isset($popup->position) ? $popup->position : '')}}" placeholder="Enter Position">
                                    @error('position')
                                    <div class="alert text-danger m-0 p-0">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Detail</label>
                                    <div class="md-form md-outline input-with-post-icon datepicker" id="select-date-input">
                                        <textarea name="description" id="description" class="form-control rounded-0" cols="30" rows="5">{{(isset($popup->description) ? $popup->description : '')}}</textarea>
                                    </div>
                                    @error('description')
                                    <div class="alert text-danger m-0 p-0">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-right">
                                <input type="submit" class="btn btn-sm btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckeditor/ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset('ckeditor/samples/js/sample.js') }}"></script>

    <!-- detail page -->
    <script type="text/javascript">
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{route('popup.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        function slugify(text) {
            return text
                .toString()                     // Cast to string
                .toLowerCase()                  // Convert the string to lowercase letters
                .normalize('NFD')       // The normalize() method returns the Unicode Normalization Form of a given string.
                .trim()                         // Remove whitespace from both sides of a string
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '')   // Remove all non-word chars
                .replace(/\-\-+/g, '-');        // Replace multiple - with single -
        }

        function listingslug(text) {
            document.getElementById("slug").value = slugify(text);
        }
    </script>
@endpush
