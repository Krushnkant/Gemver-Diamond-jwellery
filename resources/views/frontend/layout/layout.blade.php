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
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!-- TrustBox script -->
<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
<!-- End TrustBox script -->
    
</head>
<body>


<div class="header-loader">
    <!-- <div class="spinner-border loader-btn" role="status"> -->
    <div class="loader-btn" role="status"> 
    <!-- <span class="sr-only">Loading...</span> -->
    <img src="{{ asset('frontend/image/loader.gif') }}" alt="">
    </div>
</div>

<div class="">
@include('frontend.layout.header')
@yield('content')
@include('frontend.layout.footer')
<div class="modal fade inquiry_now_modal" id="myStep" tabindex="-1" aria-labelledby="myStepLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col-6 ps-0 text-start">
                                                <div class="mb-xl-4 mb-3 product_heading"></div>
                                            </div>
                                            <div class="col-6 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>

                                        <div class="row">
                                        <h2>CREATE YOUR OWN ENGAGEMENT RING</h2>
                                            <div class="col-6 ps-0 text-start">
                                            <h3>Step 1</h3>
                                                <img src="https://assets.friendlydiamonds.com/fdl/images/frontend/v2/setting-popup/ring_setting.png" alt="Choose Setting">
                                            </div>

                                            <div class="col-6 ps-0 text-start">
                                            <h3>Step 2</h3>
                                                <img src="https://assets.friendlydiamonds.com/fdl/images/frontend/v2/setting-popup/diamond.png" alt="Choose Setting">
                                            </div>

                                            <div class="col-6 ps-0 text-start">
                                            <h3>Step 3</h3>
                                                <img src="https://assets.friendlydiamonds.com/fdl/images/frontend/v2/setting-popup/ring.png" alt="Choose Setting">
                                            </div>

                                            
            
                                        </div>

                                        
                                      
                                        
                                    </div>
                                </div>
                            </div>

<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>   
<script src="{{ asset('frontend/js/all.min.js') }}"></script>   
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script>


</body>
</html>

