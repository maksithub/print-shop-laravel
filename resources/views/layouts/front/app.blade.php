<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
    
            gtag('config', '{{ env('GOOGLE_ANALYTICS') }}');
        </script>

        <title>1hourprint Printing Service</title>

        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.min.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-electro.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl-carousel.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style-custom.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/colors/flat-blue.css')}}" media="all" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/starability-all.css')}}" media="all" />



        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" href="assets/images/fav_icon.png">
        <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js') }}"></script>
    </head>

    <body class="@yield('body_class')">
        <div id="page" class="hfeed site">
            <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
            <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

            @include('layouts.front.header.header', ['page'=>'home'])

            @yield('content')
            
            @include('layouts.front.footer.footer')

        </div><!-- #page -->

        <script type="text/javascript" src="{{asset('assets/js/tether.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap-hover-dropdown.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/echo.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/wow.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/jquery.easing.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/electro.js')}}"></script>

        @yield('js')
    </body>
</html>
