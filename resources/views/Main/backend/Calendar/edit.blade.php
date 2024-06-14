@extends('admin.layouts.app')
@section('title','Edit Calendar')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Edit</p>
            <a class="btn btn-sm btn-warning" href="{{route('calendar.index')}}">View All</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('calendar.update',$editCalendar->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <!--Label For Name-->
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{(isset($editCalendar)?$editCalendar->name:old('name'))}}" onkeyup="listingslug(this.value)">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!--Label For Slug-->
                                    <label class="form-label" for="name">Slug</label>
                                    <input type="text" class="form-control rounded-0 @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{(isset($editCalendar)?$editCalendar->slug:old('slug'))}}">
                                    @if ($errors->has('slug'))
                                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!--Label For Image-->
                                    <label class="form-label" for="file">Image</label>
                                    <input type="file" id="image" name="image"  class="form-control rounded-0 mb-0 @error('image') is-invalid @enderror" >
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!--Label For Prospectus-->
                                    <label class="form-label" for="file">Calendar</label>
                                    <input type="file" id="calendar" name="calendar"  class="form-control rounded-0 mb-0 @error('calendar') is-invalid @enderror" >
                                    @if ($errors->has('calendar'))
                                        <span class="text-danger">{{ $errors->first('calendar') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!--Label For Status-->
                                    <label class="form-label" for="file">Status</label>
                                    <select  name="status" class="form-control rounded-0 mb-0 @error('status') is-invalid @enderror">
                                        <option value="">Please Select</option>
                                        <option value="1" @if(($editCalendar) && $editCalendar->status == 1) selected @endif>Active</option>
                                        <option value="2" @if(($editCalendar) && $editCalendar->status == 2) selected @endif>In-Active</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!--Label For Status-->
                                    <label class="form-label" for="file">Archived</label>
                                    <select  name="archived" class="form-control rounded-0 mb-0 @error('archived') is-invalid @enderror">
                                        <option value="">Please Select</option>
                                        <option value="1" @if(($editCalendar) && $editCalendar->archived == 1) selected @endif>Yes</option>
                                        <option value="2" @if(($editCalendar) && $editCalendar->archived == 2) selected @endif>No</option>
                                    </select>
                                    @if ($errors->has('archived'))
                                        <span class="text-danger">{{ $errors->first('archived') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <!--Label For Sub Details-->
                                    <label class="form-label" for="file">Sub Details</label>
                                    <textarea name="sub_details" id="sub_details" rows="5" class="form-control rounded-0 mb-0 @error('sub_details') is-invalid @enderror">{{(isset($editCalendar) && $editCalendar->sub_details ? $editCalendar->sub_details : old('sub_details'))}}</textarea>
                                    @if ($errors->has('sub_details'))
                                        <span class="text-danger">{{ $errors->first('sub_details') }}</span>
                                    @endif
                                </div>
                                <div class="form-group row text-right">
                                    <input type="submit" class="btn btn-sm btn-success" value="Save">
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- partener page -->
    <!-- Details page -->

    <script>
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
