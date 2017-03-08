<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{{ csrf_token() }}" />

    <title>Strategic Development Group - @yield('title')</title>

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- CORE CSS -->
    @yield('before-styles-end')
    <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

    <!-- PLUGINS -->
    <link href="/plugins/animate/animate.min.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/plugins/sweetalert/sweetalert.css">

    <!-- THEME CSS -->
    <link href="/css/theme.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    @yield('after-styles-end')
</head>

<body class="fixed-header">
@include('frontend.includes.nav')
@include('flash::message')
@yield('content')



@include('frontend.includes.footer')
@include('frontend.includes.sign-up')


<!-- Javascript -->
@yield('before-scripts-end')
<script src="/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/core.min.js"></script>
<script src="/js/plugins.js"></script>
<script src="/plugins/sweetalert/sweetalert.min.js"></script>
@include('sweet::alert')
@yield('after-scripts-end')

</body>
</html>