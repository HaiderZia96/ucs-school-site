@section('title', 'News of UCSF | Event in UCSF | News and Events In UCSF')
@section('description', 'News and events at UCSF provide the latest updates on the school. This section lists all the activities, seminars, & other necessary events the school conducts. Read more!')
@section('keywords', 'News of UCSF, Event In UCSF, News and Events In UCSF')

@extends('Main.frontend.web')
@section('content')
    <div class="news-or-events-wrapper"> {{-- news wrapper starts here --}}
        <div class="top-banner">
            <div class="back-camb-overlay">
                <img class="back-camb" src="{{asset('Main/frontend/images/camb-two.jpg')}}">
            </div>
            <div class="perfect-left">
                <h1><span>NEWS &</span></h1>
                <h1><span>EVENTS</span></h1>
            </div>
            {{-- <div class="icon-vertical text-center d-flex flex-column me-4">
                <a href="https://www.instagram.com/unioffaisalabad/"><i class="fa fa-instagram mb-sm-2 mt-sm-3  mt-1" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/unioffaisalabad"><i class="fa fa-facebook mb-sm-2 mt-sm-2 mt-1" aria-hidden="true"></i></a>
                <a href="https://twitter.com/unioffaisalabad"><i class="fa fa-twitter mb-sm-2 mt-sm-2 mt-1" aria-hidden="true"></i></a>
                <a href="https://www.youtube.com/universityoffaisalabadofficial"><i class="fa fa-youtube mb-sm-2 mt-sm-2 mt-1" aria-hidden="true"></i></a>
            </div> --}}
        </div>
        <div class="news-explore">
            <div class="container">
                <div class="row py-3">
                    <div class="col-lg-8">
                        <div class="news-letter-news mt-3">
                            @if(count($allPressRelease) > 0)
                                @foreach ($allPressRelease as $newsevent)
                                    <div class="card h-100 mx-0 mx-sm-3 my-4">
                                        <div class="main-card">
                                            <img src="{{URL('/')}}/Main/frontend/images/NewsAndEvents/{{$newsevent->thumbnail }}" class="news-and-events">
                                        </div>
                                        <div class="card-body mt-4 mb-3 ps-4 text-adjust-card">
                                            <div class="d-sm-flex d-inline">
                                                <div class="d-inline me-2 me-md-5 text-sm-center">
                                                    <h3 class="mb-0">{{date('d', strtotime($newsevent->event_date)) }}</h3>
                                                    <p class="d-flex text-black mb-sm-3 mb-0">{{date('M', strtotime($newsevent->event_date)) }}-<span>{{date('Y', strtotime($newsevent->event_date)) }}</span></p>
                                                </div>
                                                @if (isset($newsevent->name))
                                                    <h2 class="card-title">{{ \Illuminate\Support\Str::limit($newsevent->name, 120) }}</h2>
                                                @endif
                                            </div>
                                            <p class="card-text text-black"> {{ \Illuminate\Support\Str::limit($newsevent->short_description, 300, $end='...') }}</p>
                                            <a href="{{ route('news-and-events-detail',$newsevent->slug) }}" class="btn bg-red press-button"><i class="fa fa-angle-right me-2 angle-tag" aria-hidden="true"></i> READ MORE</a>

                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h1>No News Found</h1>
                            @endif
                            {{-- end card  --}}
                        </div>
                        <div class="d-flex justify-content-center" style="overflow: hidden;">
                            {{ $allPressRelease->withQueryString()->links() }}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <form class="d-lg-inline justify-content-center form-filters mt-3 " method="GET" action="{{route('news-and-events')}}" >
                            <div class="mb-3">
                                <label for="categories" class="form-label"></label>
                                <select name="slug" class="form-control" id="slug" value="" >
                                    <option value="0">Select Category</option>
                                    @foreach($allcategories as $newsevent)
                                        <option  value="{{$newsevent['slug']}}" {{(isset(request()->slug) && $newsevent->slug == request()->slug ? 'selected': '' )}}>{{$newsevent['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label"></label>
                                <select name="date" class="form-control" id="date" value="" >
                                    <option value="0">Select Year</option>
                                    @foreach($allNewsEventDate as $newseventdate)
                                        <option value="{{date('M-Y', strtotime($newseventdate['event_date']))}}"{{(isset(request()->date) && date('M-Y', strtotime($newseventdate->event_date)) == request()->date ? 'selected': '' )}}>{{date('M  Y', strtotime($newseventdate['event_date'])) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tags" class="form-label"></label>
                                <select name="tag" class="form-control" id="tag" value="" >
                                    <option value="0">Select Tag</option>
                                    @foreach($alltags as $alltag)
                                        <option value="{{$alltag['slug']}}" {{(isset(request()->tag) && $alltag->slug == request()->tag ? 'selected': '' )}}>{{$alltag['name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-4  filter-button">
                                <button type="submit" class="btn btn-primary search px-4 me-1 mb-2">Search</button>
                                <button type="delete" class="btn btn-danger reset px-4 mb-2" onclick="Remove_options()">Reset</button>
                            </div>
                        </form>
                        {{-- category  --}}
                        <div class="recent-post mt-5">
                            <div class="bg-colr py-2">
                                <h6 class="ms-4 mb-0">Categories</h6>
                            </div>
                            @foreach ($allcategories as $newsevent)
                                <div class="yearly-tags pb-2 pt-3">
                                    @if (isset($newsevent->name))
                                        {{-- <a href="{{'https://tuf.edu.pk/n/news-and-events?slug='.$newsevent->slug}}"><i class="fa fa-long-arrow-right text-red me-3"></i>{{ $newsevent->name}}</a> --}}
                                        <a href="{{url('/news-and-events?slug='.$newsevent->slug)}}"><i class="fa fa-long-arrow-right text-red px-1 me-3"></i>{{$newsevent->name}}</a>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        {{-- Archeive  --}}
                        <div class="recent-post mt-3 mb-5">
                            <div class="bg-colr py-2">
                                <h6 class="ms-4 mb-0">Archives</h6>
                            </div>
                            <div class="archeive-posts">
                                @foreach ($allNewsEventDate as $newseventdate)
                                    <div class="yearly-tags pb-2 pt-3">
                                        {{-- <a href="{{ request()->fullUrlWithQuery(['date' => date('M-Y', strtotime($newseventdate->event_date))]) }}"><i class="fa fa-long-arrow-right text-red me-3"></i>{{date('M  Y', strtotime($newseventdate->event_date)) }}</a> --}}
                                        <a href="{{url('/news-and-events?date='.date('M-Y', strtotime($newseventdate->event_date)))}}"><i class="fa fa-long-arrow-right text-red px-1 me-3"></i>{{date('M  Y', strtotime($newseventdate->event_date)) }}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="recent-post mt-3">
                            <div class="bg-colr py-2">
                                <h6 class="ms-4 mb-0">Tags</h6>
                            </div>
                            <div class="yearly-tag pb-2 pt-3">

                                @foreach ($alltags as $alltag)
                                    @if (isset($alltag->name))
                                        {{-- <a href="{{ request()->fullUrlWithQuery(['tag' => $alltag->slug]) }}" class="btn bg-red text-white mb-2 me-2">{{ $alltag->name}}</a> --}}
                                        <a href="{{url('/news-and-events?tag='.$alltag->slug)}}" class="btn bg-red anchor-tag mx-1 mb-2 ">{{ $alltag->name}}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div> {{-- news wrapper ends here --}}
        @endsection
        @push('js')
            {{-- <script type="text/javascript">
                $('#search').on('keyup',function() {
                    var value=$(this).val();
                    $.ajax({
                        method:'GET'
                        url : "{{route('press-release-searches')}}",
                        data:{'search':value}       ,
                        dataType:'json',
                        success:function(data){
                            $('#newsss').html(data.table_data);
                        }
                    });
                });
            </script> --}}
            <script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.category-slides').owlCarousel({
                    loop: true,
                    dots: false,
                    responsiveClass: true,
                    autoplay:true,
                    autoplayTimeout:2000,
                    margin:02,
                    responsive:{
                        0:{
                            items:2,
                        },
                        600:{
                            items:3,
                        },
                        1000:{
                            items:5,
                        }
                    }
                })
            </script>
            <script>
                function Remove_options()
                {
                    $('#slug')
                        .empty()
                        .append('<option selected="selected" value="0" >Select Category</option>');
                    $('#date')
                        .empty()
                        .append('<option selected="selected" value="0">Select Year</option>');
                    $('#tag')
                        .empty()
                        .append('<option selected="selected" value="0">Select Tag</option>');
                }
            </script>
    @endpush
