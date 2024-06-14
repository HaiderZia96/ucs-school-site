@extends('Main.frontend.web')
@section('content')
    <div class="prospectus-wrapper mt-sm-5 mt-3">
        <div class="container g-0">
            <div class="row">
                @foreach($prospectuses as $prospectus)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="{{route('download-prospectus',$prospectus->slug)}}" target="_blank" class="card h-100 text-decoration-none">
                            <img class="img-fluid pros-image" src="{{route('get-prospectus-image',$prospectus->slug)}}" alt="{{$prospectus->name}}">
                            <div class="card-body text-center my-2">
                                <h4 class="card-title text-dark">{{$prospectus->name}}</h4>
                                <p class="card-text text-dark">{{substr($prospectus->sub_details,0,150).'...'}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
