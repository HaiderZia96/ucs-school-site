<!--Bootstrap Js-->
<script src="{{asset('/Main/frontend/js/bootstrap.js')}}"></script>
{{-- JQuery Js --}}
<script src="{{asset('/Main/frontend/js/jquery.min.js')}}"></script>
{{-- Toastr script --}}
<script src="{{asset('/Main/frontend/js/toastr.js')}}"></script>

<!--Counte down Js-->
<script src="{{asset('/Main/frontend/js/jquery.js')}}"></script>
<script src="{{asset('/Main/frontend/js/jquery.countTo.js')}}"></script>
<script src="{{asset('/Main/frontend/js/jquery.plugin.js')}}"></script>
<script src="{{asset('/Main/frontend/js/jquery.countdown.js')}}"></script>
<script src="{{asset('/Main/frontend/js/jquery.jCounter.js')}}"></script>

{{-- counter Time  --}}
<script src="{{asset('/Main/frontend/js/flipclock.js')}}"></script>

<!--Carousel Js-->
<script src="{{asset('/Main/frontend/js/owl.carousel.min.js')}}"></script>
<!--Video Slider Js-->
<script src="{{asset('/Main/frontend/js/vide-slider.js')}}"></script>
    <!--fancybox-->
  <script src="{{asset('/Main/frontend/js/fancybox.min.js')}}"></script>
<!-- data table script   -->
<script src="{{asset('/Main/frontend/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
</script>
<!-- Counts JS -->
<script src="{{asset('/Main/frontend/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('/Main/frontend/js/jquery.waypoints.js')}}"></script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="https://kit.fontawesome.com/bdfe7d1c26.js" crossorigin="anonymous"></script>  
<script>
    $('#owl-first-home').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay:false,
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            },
            1300: {
                items: 4
            },
        }
    })
</script> 
<script>
    $('#owl-second-home').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        autoplay:true,
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            },
            1300: {
                items: 3
            },
        }
    })
</script>
<script type="text/javascript">
    // jQuery counterUp
    $('[data-toggle="counterUp"]').counterUp({
        delay: 10,
        time: 1500
    });
</script>

{{-- Toastr Message --}}
<script>
    //Toastr Message
    @if(Session::has('message'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.success("{{ session('message') }}");
        @endif
            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.error("{{ session('error') }}");
        @endif
            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.warning("{{ session('warning') }}");
        @endif
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.error("{{ $error }}");
        @endforeach
        @endif
    </script>
@stack('js')