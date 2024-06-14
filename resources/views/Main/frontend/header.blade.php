<div class="header-top">
    {{-- <div class="img-back-head">
        <img src="{{asset('Main/frontend/images/bg_header.jpg')}}">
    </div> --}}
    <div class="container g-0">

        <div class="row border-header pb-0">
            <div class="col-md-6 col-sm-6">
                <div class="header-top-info">
                    <ul class="mb-0">
                        <li><i class="fa fa-phone me-2" aria-hidden="true"></i>041-1188661-62</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="header-top-social footer-social">
                    <ul class="d-flex mb-0 ">
                        <li>  <img src="{{asset('Main/frontend/images/pak.jpg')}}" class="me-2 mb-1" style="width:20px"></li>
                        <li ><a href="" class="plat-stud me-3">Platform for students</a></li>
                        <li><a href="" class="plat-parents me-3">Platform for parents</a></li>
                        <li><a href="" class="plat-dl me-3">DL platform</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container g-0">
      <div class="row mx-2 g-0">
        <div class="col-md-3 col-sm-6">
        <div class="ucs-logo py-3">
            <a href="{{route('home')}}"><img src="{{asset('Main/frontend/images/ucs_logo.png')}}" width="100px" height="81px"></a>
        </div></div>
        <div class="col-md-3 col-sm-6">
          <div class="d-inline future-text">
             <h3 class="mb-0 pt-4">Truly Different</h3>
             <h3 class="mb-0">Future Ready School</h3>
          </div></div>
          <div class="col-md-6 col-sm-12">
            <div class="ucs-logo d-lg-flex mt-3">
                <img src="{{asset('Main/frontend/images/kembridz.png')}}"  class="ms-md-3">
               <img src="{{asset('Main/frontend/images/BISEFSD_logo.png')}}" width="90%"   class="ms-md-3">
                {{-- <img src="{{asset('Main/frontend/images/erasmus.png')}}" class="ms-md-3"> --}}
            </div></div>
      </div>
</div>
</div></div>
<div id="sticky-wrapper" class="sticky-wrapper" >
    <div class="container">
    <nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('about')}}">About the school</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admission')}}">Admission</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://career.ucsf.edu.pk/">Jobs</a>
      </li>
      {{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUpcoming" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Upcoming Events
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownUpcoming">
          <li><a class="dropdown-item enroll disabled" href="#"><b>How to enroll?</b></a></li>
          <li><a class="dropdown-item" href="{{route('news-and-events')}}">Admission process</a></li>
          <li><a class="dropdown-item" href="#">Tution fees</a></li>
          <li><a class="dropdown-item" href="#">Admission office</a></li>
          <li><a class="dropdown-item news disabled" href="#"><b>News</b></a></li>
          <li><a class="dropdown-item" href="#">Parent-School Contact</a></li>
          <li><a class="dropdown-item" href="#">Parent-School Contact</a></li>
          <li><a class="dropdown-item" href="#">Additional Services</a></li>
        </ul>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="{{route('news-and-events')}}">News & Events</a>
      </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('prospectus')}}">Prospectus</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('calendar')}}">Calendar</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
      </li>
    </ul>
  </div>
</nav>
    </div>
</div>
