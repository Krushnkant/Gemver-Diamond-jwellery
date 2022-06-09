<?php
$settings = \App\Models\Settings::first();
?>

<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <title>{{ $settings->company_name }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL('images/company/'.$settings->company_favicon) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    
</head>
<body>



<div class="">
@include('frontend.layout.header')
@yield('content')
@include('frontend.layout.footer')
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>        

</body>
</html>