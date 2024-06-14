@extends('admin.layouts.app')
@section('name','Create Prospectus')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Add New</p>
            <a class="btn btn-sm btn-warning" href="{{route('prospectus.index')}}">View All</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('prospectus.update',$editProspectus->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <!--Label For Name-->
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{(isset($editProspectus)?$editProspectus->name:old('name'))}}" onkeyup="listingslug(this.value)">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!--Label For Slug-->
                                    <label class="form-label" for="name">Slug</label>
                                    <input type="text" class="form-control rounded-0 @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{(isset($editProspectus)?$editProspectus->slug:old('slug'))}}">
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
                                    <label class="form-label" for="file">Prospectus</label>
                                    <input type="file" id="prospectus" name="prospectus"  class="form-control rounded-0 mb-0 @error('prospectus') is-invalid @enderror" >
                                    @if ($errors->has('prospectus'))
                                        <span class="text-danger">{{ $errors->first('prospectus') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!--Label For Status-->
                                    <label class="form-label" for="file">Status</label>
                                    <select  name="status" class="form-control rounded-0 mb-0 @error('status') is-invalid @enderror">
                                        <option value="">Please Select</option>
                                        <option value="1" @if(($editProspectus) && $editProspectus->status == 1) selected @endif>Active</option>
                                        <option value="2" @if(($editProspectus) && $editProspectus->status == 2) selected @endif>In-Active</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <!--Label For Sub Details-->
                                    <label class="form-label" for="file">Sub Details</label>
                                    <textarea name="sub_details" id="sub_details" rows="5" class="form-control rounded-0 mb-0 @error('sub_details') is-invalid @enderror">{{(isset($editProspectus) && $editProspectus->sub_details ? $editProspectus->sub_details : old('sub_details'))}}</textarea>
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
