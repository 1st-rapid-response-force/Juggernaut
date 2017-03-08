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
    <link rel="shortcut icon" href="img/favicon.ico">

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

<body>
@include('flash::message')
@yield('content')

<!-- Javascript -->
@yield('before-scripts-end')
<script src="/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/core.min.js"></script>
<script src="/plugins/sweetalert/sweetalert.min.js"></script>
@include('sweet::alert')
@yield('after-scripts-end')

</body>
</html>