<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="@yield('description')">
<meta name="keywords" content="@yield('keywords')">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JZ7M31RS6Z"></script>
<script> window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date()); gtag('config', 'G-JZ7M31RS6Z');
</script>
<title>@yield('title')</title>

    <!--Bootstrap Css--->
    <link href="{{asset('/Main/frontend/css/bootstrap.css')}}" rel="stylesheet">

    <!---Owl Carousel Css-->
    <link rel="stylesheet" href="{{asset('Main/frontend/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('Main/frontend/css/owl.theme.default.css')}}">


    <!--- Font Awesome---->
    <link rel="stylesheet" href="{{asset('/Main/frontend/css/font-awesome.css')}}">

    <!---count down Css-->
    <link rel="stylesheet" href="{{asset('/Main/frontend/css/jquery.countdown.css')}}">
    <link rel="stylesheet" href="{{asset('/Main/frontend/css/color.css')}}">


    <!---count down Timer-->
    <link rel="stylesheet" href="{{asset('/Main/frontend/css/flipclock.css')}}">

    <link rel="stylesheet" href="{{asset('/Main/frontend/css/custom-fonts.css')}}">

    <!--Custom Css-->
    <link href="{{asset('/Main/frontend/css/style.css')}}" rel="stylesheet">


    <!---Custom Datatable Css-->
    <link rel="stylesheet" href="{{asset('/Main/frontend/css/jquery.dataTable.min.css')}}">

    {{-- Toastr css --}}
    <link rel="stylesheet" href="{{asset('Main/frontend/css/toastr.css')}}">


<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"> -->
    <!-- Fancybox -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!-- <link rel="stylesheet" href="{{asset('Main/frontend/css/fancybox.min.css')}}"> -->

<script>
    (function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-MMTJBLQL');
</script>
