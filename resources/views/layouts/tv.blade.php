<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="YLWS TV" />
    <meta name="description" content="Your Loveworld Specials Tv">
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>{{$page_title ?? ''}}</title>
    <!-- Stylesheets & Fonts -->
    <link href="{{asset('master/css/plugins.css')}}" rel="stylesheet">
    <link href="{{asset('master/css/style.css')}}" rel="stylesheet">
    @yield('styles')
</head>

<body>
<div id="root"></div>
 <!-- Topbar -->

@yield('content')



    <!-- CALL TO ACTION -->







<script src="{{asset('master/js/jquery.js')}}"></script>
<script src="{{asset('master/js/plugins.js')}}"></script>

<!--Template functions-->
<script src="{{asset('master/js/functions.js')}}"></script>
@yield('scripts')
</body>

</html>

