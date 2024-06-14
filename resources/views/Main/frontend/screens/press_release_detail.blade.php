@if(!$newsEvents->isEmpty())
    <div class="news-and-events-wrapper"><!-- News and Events Wrapper starts here -->
        <div class="container pb-5"> <!--Container Starts here -->
                <div class="news-icon text-center my-3">
                        <img src="{{ asset('Main/frontend/images/events-icon.png') }}" alt="" class="img-fluid" width="75px" height="70px">
                    </div>
                <div class="events-top-text text-center my-3">
                    <h1 class="text-uppercase">News and Events</h1>
                </div>
            <div class="row justify-content-center"><!-- row start -->
            @foreach ($newsEvents as $events)
                 
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12"><!--col-starts-here -->
                        <div class="card news-events-cards h-100 mt-2 mb-2">  <!--card starts -->
                            @if (isset($events->event_date))
                                <div class="top-date-and-month">
                                    <div class="all-dates">
                                        <div class="month">{{date('M', strtotime($events->event_date)) }}</div>
                                        <div class="date">{{date('d', strtotime($events->event_date)) }}</div>
                                    </div>
                                </div>
                            @endif 
                            @if (isset($events->thumbnail))
                                <img src="{{URL('/')}}/Main/frontend/images/NewsAndEvents/{{$events->thumbnail }}" alt="news-and-events" class="card-img-top img-fluid"> <!-- card-top-image-starts -->
                            @endif
                              
                                <div class="card-body">
                                        <div class="department-and-campuses mt-2 mb-2">   <!--department-campuses-starts -->
                                                <div class="wings">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i><span>The University of Faisalabad</span>
                                                    @if (isset($events['departments']['title']))
                                                        <i class="fa fa-university" aria-hidden="true"></i> <span>{{ $events['departments']['title']  }}</span>
                                                    @endif
                                                </div>
                                        </div>  <!--department-campuses-ends -->
                                        @if (isset($events->short_description))
                                            <a class="card-text mt-3 mb-3" href="{{ route('news-and-events',$events->slug) }}">  <!--card text starts -->
                                                {{ \Illuminate\Support\Str::limit($events->short_description, 150, $end='...') }}

                                                <span class="read-more-link read-more">Read More<i class="fa fa-caret-right" aria-hidden="true"></i></span>
                                            </a><!--card text ends -->
                                          
                                        @endif
                                </div>
                        </div><!-- card ends here -->
                    </div><!-- col-ends-here -->
               
            @endforeach
            </div><!-- row ends -->
        </div><!--Container ends here -->
    </div><!-- News and Events Wrapper ends here -->
    @endif
