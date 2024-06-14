@section('title', 'University Cambridge School Academic Calendar | UCSF Academic Calendar')
@section('description', 'The Academic Calendar of UCS aims to provide students with a schedule to get information about the commencement of classes, examinations, attendance & submission of results. Read more!')
@section('keywords', 'University Cambridge School Academic Calendar, UCSF Academic Calendar')


@extends('Main.frontend.web')
@section('content')
    <div class="prospectus-wrapper about-wrapper mt-sm-5 mt-3">
        <div class="container g-0">
            <div class="row">
                <div class="col-md-9 mb-3">
                    <div class="row">
                        @if(count($calendars) > 0)
                        @foreach($calendars as $calendar)
                            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                                <a href="{{route('download-calendar',$calendar->slug)}}" target="_blank" class="card h-100 text-decoration-none">
                                    <img class="img-fluid pros-image" src="{{route('get-calendar-image',$calendar->slug)}}" alt="{{$calendar->name}}">
                                    <div class="card-body text-center my-2">
                                        <h4 class="card-title text-dark">{{$calendar->name}}</h4>
                                        <p class="card-text text-dark">{{substr($calendar->sub_details,0,150).'...'}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        @else
                            <h3>No Calendar Found</h3>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="News">
                        <h3 class="widget-title">Archived Calendars</h3>
                        <ul class="px-2">
                            <li class="ps-0 py-2">
                                @foreach($archivedCalendars as $calendar)
                                    <div class="d-flex">
                                        <a href="{{route('download-calendar',$calendar->slug)}}" target="_blank" class="blog-img">
                                            <img class="pros-image me-2" src="{{route('get-calendar-image',$calendar->slug)}}" alt="{{$calendar->name}}">
                                        </a>
                                        <div class="d-inline ">
                                            <a href="{{route('download-calendar',$calendar->slug)}}" class="mb-0">
                                                <span id="comp-under">{{$calendar->name}}</span>
                                            </a>
                                            <p>{{substr($calendar->sub_details,0,40).'...'}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
