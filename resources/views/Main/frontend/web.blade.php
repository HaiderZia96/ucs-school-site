<!DOCTYPE html>
<html lang="en">
<head>
    @include('Main.frontend.head')
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJ63XN9"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MMTJBLQL"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>


<!---UCS Header Starts Here---->
<!-- Top Bar -->
@include('Main.frontend.header')

<!--UCS Header Ends Here--->

<!-- Page Content  -->
<div class="wrapper">
    @yield('content')
</div>
<!-- Footer -->
@include('Main.frontend.footer')
<!-- End Footer -->
<!-- script Content  -->
@include('Main.frontend.scripts')
