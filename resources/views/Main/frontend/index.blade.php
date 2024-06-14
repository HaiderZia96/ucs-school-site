@section('title', 'University Cambridge School Faisalabad | Best Schools in Faisalabad | Best Private Schools in Faisalabad')
@section('description', 'University Cambridge School (UCSF) is one of the leading schools in Faisalabad, providing quality education for students ranging from pre-school, Junior School, & Middle School to Senior School & O Level. Read more!')
@section('keywords', 'University Cambridge School, University Cambridge School Faisalabad, UCS Montessori Program, UCS Primary program, UCS Lower Secondary Program, UCS Secondary Program, Secondary School Certificate, Matriculation Program, O Level Program, Top Private School in Faisalabad, Best Schools in Faisalabad, Best Private Schools in Faisalabad, Best O-Level Schools in Faisalabad')

@extends('Main.frontend.web')
@section('content')
    <div class="news-ticker">
        <div class="new-section">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @if(count($categories) > 0)
                    @foreach($categories as $key => $category)
                        <li class="nav-item">
                            <button class="nav-link @if($key == 0) active @endif" data-bs-toggle="tab" data-bs-target="#{{$category->slug}}">
                                {{$category->name}}</button>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="tab-content" id="myTabContent">
                @if(count($categories) > 0)
                    @foreach($categories as $key => $category)
                        <div class="tab-pane fade show @if($key == 0) active @endif" id="{{$category->slug}}" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <a href="{{route('news-and-events','slug='.$category->slug)}}" class="text-info small">View All {{$category->name}}</a>
                                </div>
                            </div>
                            @foreach($category->newsEvents->take(3) as $news)
                                <div class="col-md-12 p-2">
                                    <a href="{{route('news-and-events-detail',$news->slug)}}" class="text-decoration-none">
                                        <p class="text-warning text-truncate small mb-0">{{$news->name}}</p>
                                        <p class="text-white small">{{substr($news->short_description,0,65).'...'}}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="news-hidden-section" style="display: none">
            <img src="{{asset('Main/frontend/images/news_images.png')}}" alt="">
        </div>
        <div class="new-ticker-toggle">
            <i class="fa fa-angle-right bg-dark text-white p-2"></i>
        </div>
    </div>
    <div class="container-fluid g-0">
        {{-- <div class="sidenav p-3">
            <a href="#logo" class="ucs-logo"><img src="{{asset('Main/frontend/images/ucs_logo.png')}}"></a>
        </div> --}}


        {{-- <div id="carouselUcs" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="ucs-upper-image ">
                    <img src="{{asset('Main/frontend/images/camb-two.jpg')}}">
                </div>
              </div>
              <div class="carousel-item">
                <div class="ucs-upper-image ">
                    <img src="{{asset('Main/frontend/images/camb-two.jpg')}}">
                </div>
              </div>
              <div class="carousel-item">
                <div class="ucs-upper-image ">
                    <img src="{{asset('Main/frontend/images/camb-two.jpg')}}">
                </div>
              </div>
            </div>
          </div> --}}
        <div class="overlay-ucs">
            <div class="ucs-upper-image ">
                <img src="{{asset('Main/frontend/images/camb-two.jpg')}}">
            </div>
            <div class="cambridge-portion ">
                <h2 class="new mb-0">Qualifications</h2>
                <h2 class="prog mb-0">Offered at</h2>
                <h2 class="senior mb-0">University Cambridge School</h2>
                <ul class="ucs-main-banner-text">
                    <li>UCS Montessori Program</li>
                    <li>UCS Primary program</li>
                    <li>UCS Lower Secondary Program</li>
                    <li>UCS Secondary Program
                        <ul class="ucs-main-banner-text">
                            <li>Matriculation</li>
                            <li>O Level</li>
                        </ul>

                    </li>
                </ul>
                <button type="button" class="btn btn-primary learn mt-3">Learn more <i class="fa fa-forward ms-1 mt-1" aria-hidden="true"></i></button>
            </div>
            <div class="girl-image">
                <img src="{{asset('Main/frontend/images/school_kids.png')}}" class="w-75 mt-5 ms-5">
            </div>
        </div>
    </div>
    <div class="home-wrapper mt-md-5">
        <div class="container">
            <div class="row mt-3 g-0">
                <div class="col-lg-6 col-md-6">
                    <div class="text-cambridge">
                        <h3>Welcome to International School</h3>
                        <h4>Vision Statement</h4>
                        <p class="me-md-4"> Our aim is to ensure that our students are confident and capable learners, with a strong sense of self worth who will be able to adjust and meet whatever demands are placed upon them.
                        </p>
                        <h4>Introduction</h4>
                        <p class="me-md-4">
                            In a rapidly changing world, where it is virtually impossible to predict what
                            abilities and skills will be required for the next generation, the
                            establishment of University Cambridge School in University Town by
                            Madina Foundation, a philanthropic organization, is a vital step towards
                            promoting quality education. Our aim is to ensure that our students are
                            confident and capable learners, with a strong sense of self worth who will be
                            able to adjust and meet whatever demands are placed upon them.
                        </p>
                        <p class="me-md-4">
                            We believe that strong partnership between parents and staff in academic
                            matters will help to guarantee the successful development of each student.
                            Parents are assured that their children will be supported and encouraged in
                            all areas of their schooling at University Cambridge School. We look forward
                            to working closely with you to help ensure the best possible outcome for
                            your child. It is one of our firmly-held beliefs that education is a wide-ranging
                            process, not confined to academic goals and that above all it should be an
                            enjoyable experience for the students.

                        </p>

                    </div>
                    <div class="d-sm-flex two-logo">
                        <img src="{{asset('Main/frontend/images/kembridz.png')}}" class="me-md-4">
{{--                        <img src="{{asset('Main/frontend/images/ib.png')}}" class="me-md-1 ">--}}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="building-flex text-center mb-5">
                        <img src="{{asset('Main/frontend/images/blocks.png')}}" class="img-fluid">
                        <img src="{{asset('Main/frontend/images/group_img_one_.png')}}" class="img-fluid group-image">
                    </div>
                </div>

            </div></div>
        <div class="container mt-md-5">
            <div class="row g-0 my-3">
                <div class="col-md-4">
                    <div class="video-section mx-sm-2">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/QVH69AJZ7sU?autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div></div>
                <div class="col-md-4">
                    <div class="video-section mx-sm-2">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/YfvZqPNaFAQ?autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="video-section mx-sm-2">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/EK97uJRr_mI?autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="container">
        <div class="endorse text-center">
                <h1>our endoresments</h1>
        </div>
        <div class="row g-0 justify-content-evenly text-center">

        <div class="col-lg-1 col-md-3 col-sm-4 col-6">
            <img src="{{asset('Main/frontend/images/ucas.jpg')}}" class="img-fluid">
        </div>
        <div class="col-lg-1 col-md-3 col-sm-4 col-6">
            <img src="{{asset('Main/frontend/images/sat.jpg')}}" class="img-fluid">
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <img src="{{asset('Main/frontend/images/ib.png')}}" class="img-fluid">
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <img src="{{asset('Main/frontend/images/ministar.jpg')}}" class="img-fluid">
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <img src="{{asset('Main/frontend/images/cam.jpg')}}" class="img-fluid">
        </div>
        <div class="col-lg-1 col-md-3 col-sm-4 col-6">
            <img src="{{asset('Main/frontend/images/act.jpg')}}" class="img-fluid">
        </div>
        <div class="col-lg-1 col-md-3 col-sm-4 col-6">
            <img src="{{asset('Main/frontend/images/vaslika.png')}}" class="img-fluid">
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <img src="{{asset('Main/frontend/images/erasmus.png')}}" class="img-fluid">
        </div>
        </div>
        </div>--}}
        <div class="container">
            <div class="row g-0">
                <div class="truely-text text-center">
                    <h1><span>Truely different</span></h1>
                </div>
                <div class="modern-text text-center">
                    <h5 class="my-4">Modern education in every sense of the world</h5>
                    <p> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                </div>
            </div>
        </div>


        <div class="abc-work ">
            <div class="container-fluid g-0">
                <div class="row g-0 justify-content-center mx-sm-5 mx-2">
                    <div class="owl-carousel owl-theme" id="owl-first-home">
                        <div class="item">
                            <div class="col-lg-12">
                                <div class="card me-lg-3 mt-2">
                                    <div class="image-one">
                                        <img src="{{asset('Main/frontend/images/truely_different/img1.JPG')}}" class="img-fluid" >
                                    </div>
                                    <div class="d-inline mt-2 mx-2">
                                        <h6>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</h6>
                                    </div>

                                </div>
                                <div class="turn">
                                    <div class="text p-4">It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words.</div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-lg-12">
                                <div class="card me-lg-3 mt-2">
                                    <div class="image ">
                                        <img src="{{asset('Main/frontend/images/truely_different/img2.JPG')}}" class="img-fluid">
                                    </div>
                                    <div class="d-inline mt-2 mx-2">
                                        <h6>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</h6>
                                    </div>
                                </div>
                                <div class="turn">
                                    <div class="text p-4">It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words.</div>
                                </div>
                            </div></div>

                        <div class="item">
                            <div class="col-lg-12">
                                <div class="card  me-lg-3 mt-2">
                                    <div class="image ">
                                        <img src="{{asset('Main/frontend/images/truely_different/img3.JPG')}}" class="img-fluid">
                                    </div>
                                    <div class="d-inline mt-2 mx-2">
                                        <h6>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</h6>
                                    </div>
                                </div>
                                <div class="turn">
                                    <div class="text p-4">It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words.</div>
                                </div>
                            </div></div>

                        <div class="item">
                            <div class="col-lg-12">
                                <div class="card  me-lg-3 mt-2">
                                    <div class="image ">
                                        <img src="{{asset('Main/frontend/images/truely_different/img4.JPG')}}" class="img-fluid">
                                    </div>
                                    <div class="d-inline mt-2 mx-2">
                                        <h6>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</h6>
                                    </div>
                                </div>
                                <div class="turn">
                                    <div class="text p-4">It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words.</div>
                                </div>
                            </div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="team-image my-3 g-0">
            <img src="{{asset('Main/frontend/images/truely_different/banner.png')}}" class="img-fluid">
        </div>
        <div class="latest-news mt-5 mb-3 g-0">
            <h5 class="text-center">Latest news from University Cambridge School</h5>
            <div class="latest-news-cards ">
                <div class="container-fluid g-0">
                    <div class="row g-0 justify-content-center mx-sm-5 mx-2">

                        {{-- News and events  --}}
                        <div class="owl-carousel owl-theme" id="owl-second-home">

                            @if(!empty($newsandevents) || isset($newsandevents))
                                {{-- {{dd($newsandevents)}} --}}
                                @foreach ($newsandevents as $events)
                                    <div class="item">
                                        <div class="col-lg-12 color-tag">
                                            <a href="{{ route('news-and-events-detail',$events->slug) }}">
                                                <div class="card h-100 my-2 me-2">
                                                    @if (isset($events->thumbnail))
                                                        <img src="{{URL('/')}}/Main/frontend/images/NewsAndEvents/{{$events->thumbnail }}" class="card-img-top" alt="...">
                                                    @endif
                                                    <div class="card-body" style="height: 120px">
                                                        @if (isset($events->event_date))
                                                            <p style="font-family:Roboto;color:black;">{{ \Illuminate\Support\Str::limit($events->event_date, 150, $end='...') }} </p>
                                                        @endif
                                                        @if (isset($events->short_description))
                                                            <p class="card-text">{{ \Illuminate\Support\Str::limit($events->short_description, 150, $end='...') }} </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else

                                <div>
                                    <p>No Post</p>
                                </div>
                            @endif
                        </div>
                        <div class="news-button text-center my-4" >
                            <a href="{{route('news-and-events')}}" class="btn tuf-tab-bg my-2 px-4"><i class="fa fa-angle-right me-1" aria-hidden="true"></i> MORE</a>
                        </div>


                        {{-- <div class="col-lg-4 col-md-6">
                        <div class="card one me-lg-3 mt-2">
                        <div class="image-one">
                        <img src="{{asset('Main/frontend/images/chairs.png')}}" class="img-fluid">
                        </div>
                        <div class="d-inline mt-2 mx-2">
                         <h4>Data One</h4>
                         <h6>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</h6>
                         <button type="button" class="btn btn-default green-read ps-0">Read more</button>
                        </div>
                        </div>
                        </div>



                        <div class="col-lg-4 col-md-6">
                            <div class="card two me-lg-3 mt-2">
                            <div class="image-two ">
                            <img src="{{asset('Main/frontend/images/chairs.png')}}" class="img-fluid">
                            </div>
                            <div class="d-inline mt-2 mx-2">
                             <h4>Data Two</h4>
                             <h6>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</h6>
                             <button type="button" class="btn btn-default green-read ps-0">Read more</button>
                            </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6">
                            <div class="card three me-lg-3 mt-2">
                            <div class="image-three ">
                            <img src="{{asset('Main/frontend/images/chairs.png')}}" class="img-fluid">
                            </div>
                            <div class="d-inline mt-2 mx-2">
                             <h4>Data Three</h4>
                             <h6>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</h6>
                             <button type="button" class="btn btn-default green-read ps-0">Read more</button>
                            </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Counter Section --}}
        <div class="chemical-counter pt-sm-5 pb-sm-2 py-2">
            <div class="container chemical-text">
                <div class="row text-center ">
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="counter">
                            <div class="ucs-counter">
                                <img src="{{asset('Main/frontend/images/ucs_logo.png')}}" class="img-fluid">
                                <h2 class="counter-num mt-2" data-toggle="counterUp" >4</h2>
                                <h5 class="counter-text">Best Cambridge Students in the world</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="counter">
                            <div class="ucs-counter">
                                <img src="{{asset('Main/frontend/images/ucs_logo.png')}}" class="img-fluid">
                                <h2 class="counter-num mt-2" data-toggle="counterUp" >11</h2>
                                <h5 class="counter-text">Cambridge subjects</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="counter">
                            <div class="ucs-counter">
                                <img src="{{asset('Main/frontend/images/ucs_logo.png')}}" class="img-fluid">
                                <h2 class="counter-num-one mt-2" data-toggle="counterUp" >31</h2>
                                <h5 class="counter-text">Satisfied students</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="counter">
                            <div class="ucs-counter">
                                <img src="{{asset('Main/frontend/images/ucs_logo.png')}}" class="img-fluid">
                                <h2 class="counter-num-two mt-2" data-toggle="counterUp" >30</h2>
                                <h5 class="counter-text">Cambridge Exams passing rate</h5>
                            </div>
                        </div>
                    </div></div>

            </div></div>


        <div class="regonize-section text-center mt-5 mb-3">
            <div class="container">
                {{-- <h3>Global recognition and awards as a confirmation of quality</h3> --}}
                {{-- <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p> --}}
                <div class="row g-0 my-3">
                    <div class="col-md-6">
                        <div class="video-section mx-sm-2">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/7mKYtjR9KmQ?autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div></div>
                    <div class="col-md-6">
                        <div class="video-section mx-sm-2">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/zppyYa00kZw?autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div></div>
                </div>
            </div>
        </div>

        <div class="download-section my-3">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="banner-one">
                        <div class="row justify-content-end align-items-center">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="banner-one-image">
                                    <img src="{{asset('Main/frontend/images/newsletter.png')}}" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="banner-one-text">
                                    <h1>UNIVERSITY</h1>
                                    <h1>CAMBRIDGE</h1>
                                    <h1>SCHOOL</h1>
                                    <h1>NEWS</h1>
                                    <p class="mt-3"><a href="{{route('news-and-events')}}" target="_blank" class="btn btn-news">VIEW NEWS</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner-two">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="banner-two-text">
                                    <h1>UNIVERSITY</h1>
                                    <h1>CAMBRIDGE</h1>
                                    <h1>SCHOOL</h1>
                                    <h1>PROSPECTUS</h1>
                                    <p class="mt-3"><a href="{{route('prospectus')}}" target="_blank" class="btn btn-prospectus">DOWNLOAD PROSPECTUS</a></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="banner-two-image">
                                    <img src="{{asset('Main/frontend/images/pros.jpg')}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="international-school text-center mt-5 mb-3">
                {{-- <h3>What do international School students and their parents say</h3> --}}
                <div class="owl-carousel owl-theme" id="owl-second-home">

                    <div class="item">
                        <div class="col-lg-12">
                            <div class="card text-center me-lg-3 mt-2 p-3">
                                <h6>Making it easier to enrol into universities abroad</h6>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et ac.</p>
                                <div class="avatar my-1">
                                    <span></span>
                                </div>
                                <h6>Milica Prvulj</h6>
                                <p>Milica Mom</p>
                            </div>
                        </div></div>

                    <div class="item">
                        <div class="col-lg-12">
                            <div class="card text-center me-lg-3 mt-2 p-3">
                                <h6>Making it easier to enrol into universities abroad</h6>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et ac.</p>
                                <div class="avatar my-1">
                                    <span></span>
                                </div>
                                <h6>Milica Prvulj</h6>
                                <p>Milica Mom</p>
                            </div>
                        </div></div>

                    <div class="item">
                        <div class="col-lg-12">
                            <div class="card text-center me-lg-3 mt-2 p-3">
                                <h6>Making it easier to enrol into universities abroad</h6>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et ac.</p>
                                <div class="avatar my-1">
                                    <span></span>
                                </div>
                                <h6>Milica Prvulj</h6>
                                <p>Milica Mom</p>
                            </div>
                        </div></div>
                </div>
            </div></div>

        <div class="enrollment mt-3 mb-5">
            <div class="container">
                <div class="d-flex">
                    <img src="{{asset('Main/frontend/images/ucs_logo.png')}}" class="img-fluid">
                    <div class="d-inline ms-sm-3 mt-3">
                        <h4 class="mb-0">Enrollment for class 2023/24 is underway!</h4>
                        <div class="d-flex">
                            <a href="#">Click here to register</a>
                            <i class="fa fa-forward ms-2 mt-2" aria-hidden="true" style="color: red"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(count($popups) > 0)
            @foreach($popups as $key => $popup)
                <div class="modal" id="modal-{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if(!empty($popup->image))
                                    <img src="{{ asset('front/assets/popups/'.$popup->image)}}" class="d-block w-100 img-responsive">
                                @else
                                    {!! $popup->description !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal 5 -->

            @endforeach
        @endif
        @endsection
        @push('js')

            <script>
                @if(count($popups) > 0)
                @foreach($popups as $key => $popup)
                @if($key == 0)
                $(document).ready(function () {
                    $("#modal-{{$key}}").modal('show');
                });
                @endif
                @endforeach
                @endif
                @if(count($popups) > 0)
                @foreach($popups as $key => $popup)
                $(document).ready(function () {
                    $(document).ready(function () {
                        $('#modal-{{$key}}').on('hidden.bs.modal', function () {
                            // Load up a new modal...
                            $('#modal-{{$key+1}}').modal('show')
                        });
                    });
                });
                @endforeach
                @endif
                $('.new-ticker-toggle').click(function (){
                    $('.new-section').toggle()
                    $('.news-hidden-section').toggle()
                    $('.news-ticker').toggleClass('w-22')
                })
            </script>
    @endpush
