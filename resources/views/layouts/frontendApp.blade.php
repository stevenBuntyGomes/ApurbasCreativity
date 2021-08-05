<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<!-- Mirrored from marketifythemes.com/html/waxon/index-kenburn.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Jun 2021 15:42:27 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Name of your web site">
<meta name="author" content="Marketify">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Waxon | Home</title>

<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">
{{-- frontend css starts --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/colors.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/darkMode.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/rtl.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    {{-- frontend css ends --}}
<!--[if lt IE 9]> <script type="text/javascript" src="js/modernizr.custom.js"></script> <![endif]-->

</head>
<body>
<div class="waxon_tm_preloader">
    <div class="spinner_wrap">
        <div class="spinner"></div>
    </div>
</div>
<div class="waxon_tm_all_wrap" data-magic-cursor="show" data-color="black">


            <main class="py-4">
                @yield('frontendContent')
            </main>


    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

</div>


    {{-- frontend js part starts --}}
    <script src="{{ asset('js/typed.js') }}"></script>
    <script data-cfasync="false" src="{{ asset('cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/plugins.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5bpEs3xlB8vhxNFErwoo3MXR64uavf6Y&amp;callback=initMap"></script>
    <script src="{{ asset('js/init.js') }}"></script>
    @yield('typed')

</body>

<!-- Mirrored from marketifythemes.com/html/waxon/index-kenburn.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Jun 2021 15:43:07 GMT -->
</html>
