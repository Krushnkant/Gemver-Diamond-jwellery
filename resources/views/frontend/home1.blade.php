<?php
$settings = \App\Models\Settings::first();
?>

<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <title>{{ $settings->company_name }}  {{  isset($meta_title) ? " | ".$meta_title:"" }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL('images/company/'.$settings->company_favicon) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="canonical" href="{{ url()->full() }}" />
    <meta name="title" content="{{ isset($meta_title) ? $meta_title:"" }}"/>
    <meta name="description" content="{{ isset($meta_description) ? $meta_description :"" }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}"> -->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!-- TrustBox script -->
    {{-- <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script> --}}
    <!-- End TrustBox script -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-962R43V393"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-962R43V393');
    </script>
    
</head>
<body>


 {{-- <div class="header-loader">
    <div class="loader-btn" role="status"> 
    <img src="{{ asset('frontend/image/page-loader.gif') }}" alt="">
    </div>
</div> --}}
<input type="hidden" name="web_url" value="{{ url("/") }}" id="web_url">
<div class="">
{{-- @include('frontend.layout.header') --}}
<?php 
$dddd =  "Glide with the shine of beautiful Jewels"; 
?>

<div class="home-page-slider-header @if(Request::route()->getName() != 'frontend.home') sub_header @endif">
    <div class="home-page-bg">
        <div class="container">
            <div class="row mt-0 mb-0 align-items-center">
                <div class="col-md-4 col-lg-4 col-xl-3 text-center">
                    <div class="home-page-header">
                        <a class="header-icon-part" href="tel:+91{{ $settings->company_mobile_no }}"><span class="me-3 header-icon"><i class="fa-solid fa-phone me-2"></i> Call Us </span></a>
                        <a class="header-icon-part" href="mailto:{{ $settings->company_email }}"><span class="me-3 header-icon"><i class="fa-solid fa-envelope me-2"></i> Email </span></a>
                        <a class="header-icon-part" href="https://api.whatsapp.com/send?phone=+91{{ $settings->company_mobile_no }}&text=Hello" target="_blank"><span class="header-icon"><i class="fa-brands fa-whatsapp"></i> Chat </span></a>
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 col-xl-8 text-end">
                    <div class="home-page-header navbar_header">
                        <?php
                        $offers = \App\Models\Offer::where('estatus', 1)->get();
                        ?>
                        <div class="">
                            <div class="owl-carousel owl-theme animation-slider-text"> 
                                @foreach($offers as $offer)
                                <div class=" header-icon item">
                                    {{ $offer->title }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-part">
        <div class="container">
            <div class="row align-items-center header_row">
                <div class="col-12 col-lg-12 header_col d-flex justify-content-between">
                    <div class="logo-image header-logo mx-lg-auto mb-0">
                        <a href="{{ URL('/') }}">
                            <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/company_logo_5824141664853670.png" alt="">
                        </a>
                    </div>
                    <span class="d-flex align-items-center justify-content-end header_logo_cart">
                        <div class="search-icon-part me-3 d-lg-block mobile-menu-search-box-part">
                            <div class="position-relative ">
                                <input type="text"  value="" class="form-control" id="main_search" autocomplete="off">
                                <svg xmlns="http://www.w3.org/2000/svg" class="search-box-icon" id="searchBtn" width="22" height="22" version="1.1" viewBox="0 0 700 700">
                                    <path d="m450.6 347.61c29.238-37.629 43.031-84.992 38.574-132.44s-26.828-91.406-62.562-122.93c-35.734-31.527-82.141-48.25-129.77-46.762-47.629 1.4844-92.902 21.07-126.6 54.77-33.699 33.695-53.285 78.969-54.77 126.6-1.4883 47.629 15.234 94.035 46.762 129.77 31.527 35.734 75.492 58.105 122.94 62.562 47.445 4.457 94.805-9.3359 132.43-38.574l125.9 125.89c5.9102 5.8047 14.457 8.0391 22.453 5.8711 7.9961-2.168 14.242-8.4141 16.41-16.41 2.168-7.9961-0.066407-16.543-5.8711-22.453zm-287.27-114.28c0-37.129 14.75-72.738 41.008-98.992 26.254-26.258 61.863-41.008 98.992-41.008 37.133 0 72.742 14.75 98.996 41.008 26.254 26.254 41.004 61.863 41.004 98.992 0 37.133-14.75 72.742-41.004 98.996s-61.863 41.004-98.996 41.004c-37.117-0.039062-72.703-14.801-98.949-41.047-26.246-26.246-41.008-61.832-41.051-98.953z"/>
                                </svg>
                            </div>
                            <div class="mega-menu-part " id="mega-menu-scrollbar" style="display: none;">
                                <div class="mega-menu-spinner serach-load" style="display: none;align-items: center;justify-content: center;">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <ul class="main_search_section">

                                </ul>
                            </div>
                        </div>
                        <div class="cart-icon-part">
                            <span class="position-relative dropdown d-lg-none search-box-icon">
                                <a href="#" class="mobile-search-close">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="search-box-icon" width="22" height="22" version="1.1" viewBox="0 0 700 700">
                                        <path d="m450.6 347.61c29.238-37.629 43.031-84.992 38.574-132.44s-26.828-91.406-62.562-122.93c-35.734-31.527-82.141-48.25-129.77-46.762-47.629 1.4844-92.902 21.07-126.6 54.77-33.699 33.695-53.285 78.969-54.77 126.6-1.4883 47.629 15.234 94.035 46.762 129.77 31.527 35.734 75.492 58.105 122.94 62.562 47.445 4.457 94.805-9.3359 132.43-38.574l125.9 125.89c5.9102 5.8047 14.457 8.0391 22.453 5.8711 7.9961-2.168 14.242-8.4141 16.41-16.41 2.168-7.9961-0.066407-16.543-5.8711-22.453zm-287.27-114.28c0-37.129 14.75-72.738 41.008-98.992 26.254-26.258 61.863-41.008 98.992-41.008 37.133 0 72.742 14.75 98.996 41.008 26.254 26.254 41.004 61.863 41.004 98.992 0 37.133-14.75 72.742-41.004 98.996s-61.863 41.004-98.996 41.004c-37.117-0.039062-72.703-14.801-98.949-41.047-26.246-26.246-41.008-61.832-41.051-98.953z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="close-icon" width="15" height="15" viewBox="0 0 50 50" fill="none">
                                        <path d="M0.474356 0.97997L0.708614 0.708614C1.56755 -0.150322 2.91162 -0.228386 3.85875 0.474356L4.1301 0.708614L25 21.5774L45.87 0.708614C46.8149 -0.236193 48.3465 -0.236193 49.2913 0.708614C50.2362 1.65342 50.2362 3.18529 49.2913 4.1301L28.4226 25L49.2913 45.87C50.1504 46.7287 50.2284 48.0729 49.5255 49.02L49.2913 49.2913C48.4326 50.1504 47.0884 50.2284 46.1413 49.5255L45.87 49.2913L25 28.4226L4.1301 49.2913C3.18529 50.2362 1.65342 50.2362 0.708614 49.2913C-0.236193 48.3465 -0.236193 46.8149 0.708614 45.87L21.5774 25L0.708614 4.1301C-0.150322 3.27117 -0.228386 1.9271 0.474356 0.97997L0.708614 0.708614L0.474356 0.97997Z" fill="#212121"/>
                                    </svg>
                                    </a>
                            </span>
                            <span class="position-relative dropdown">
                                <a href="{{ URL('/wishlist') }}" class="btn btn-secondary dropdown-toggle" id="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M12.9281 1.28566C13.3235 1.28566 16.7942 1.40862 16.7942 5.66679C16.7942 9.74438 13.7221 12.4739 8.99974 16.3748C4.27727 12.4743 1.20579 9.74505 1.20579 5.66679C1.20579 1.40863 4.67606 1.28566 5.07153 1.28566C6.81061 1.28566 8.12232 2.68565 8.13085 2.69429L8.99491 3.64184L9.86484 2.69972C9.87804 2.685 11.1891 1.28566 12.9282 1.28566M12.9282 0C10.6253 0 9.00016 1.80327 9.00016 1.80327C9.00016 1.80327 7.37437 0 5.07148 0C2.99149 0 0 1.38785 0 5.66712C0.000203061 10.5688 3.708 13.6402 9.00026 18C14.2917 13.6399 18 10.5689 18 5.66712C18 1.38818 15.0077 0.000554306 12.9281 0.000554306L12.9282 0Z" fill="#2E2E2E" />
                                    </svg>
                                </a>
                            </span>
                            <span class="position-relative dropdown shopping-part">
                                <a href="{{ URL('/cart') }}" class="btn btn-secondary dropdown-toggle" id="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cart-icon-svg" width="20" height="18" version="1.1" viewBox="0 0 700 700">
                                        <g>
                                            <path d="m162.24 481.46c5.1797 17.312 21.398 29.398 39.457 29.398h296.59c18.059 0 34.301-12.086 39.457-29.398l88.992-297.62c2.7773-9.3555 1.0273-19.203-4.8086-27.02-5.8086-7.8164-14.77-12.297-24.523-12.297h-110.34c-21.184-57.145-76.02-95.387-137.06-95.387-62.742 0-116.41 39.762-137.06 95.387h-110.37c-9.7539 0-18.691 4.4805-24.523 12.297-5.8125 7.8398-7.5859 17.664-4.7852 27.043zm187.76-413.65c50.914 0 96.832 30.496 116.97 76.742h-233.91c19.645-45.129 64.68-76.742 116.95-76.742zm-256.97 100.19c2.2617-3.0352 5.7383-4.8086 9.543-4.8086h104.81c-2.332 10.312-3.5469 21.047-3.5469 32.035 0 5.1562 4.1992 9.332 9.332 9.332s9.332-4.1758 9.332-9.332c0-11.059 1.4219-21.793 4.082-32.035h246.8c2.707 10.383 4.0586 21.117 4.0586 32.035 0 5.1562 4.1992 9.332 9.332 9.332 5.1328 0 9.332-4.1758 9.332-9.332 0-10.875-1.1914-21.605-3.5234-32.035h104.79c3.8047 0 7.3047 1.75 9.5664 4.7852 2.2617 3.0586 2.9414 6.8828 1.8672 10.523l-88.969 297.59c-2.8477 9.4727-11.715 16.078-21.605 16.078h-296.54c-9.8945 0-18.762-6.625-21.605-16.078l-88.922-297.57c-1.0977-3.6406-0.42187-7.4883 1.8672-10.523z" />
                                            <path d="m203.91 298.36h292.18c5.1562 0 9.332-4.1758 9.332-9.332s-4.1992-9.332-9.332-9.332l-292.18-0.003907c-5.1562 0-9.332 4.1758-9.332 9.332 0 5.1602 4.1758 9.3359 9.332 9.3359z" />
                                            <path d="m474.46 344.56h-248.9c-5.1562 0-9.332 4.1758-9.332 9.332s4.1992 9.332 9.332 9.332h248.9c5.1562 0 9.332-4.1758 9.332-9.332s-4.1758-9.332-9.332-9.332z" />
                                            <path d="m460.93 409.43h-221.85c-5.1562 0-9.332 4.1758-9.332 9.332s4.1992 9.332 9.332 9.332h221.85c5.1562 0 9.332-4.1758 9.332-9.332 0.003907-5.1562-4.1992-9.332-9.332-9.332z" />
                                        </g>
                                    </svg>
                                    <span class="cart-icon-label basket-item-count-cart">0</span>
                                </a>
                            </span>
                            <span class="position-relative dropdown">
                                @if(session()->has('customer'))
                                <a href="#" class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20" fill="none">
                                        <path d="M7.50004 0.9C5.33142 0.9 3.57653 2.78765 3.57653 5.09089C3.57653 7.39412 5.33142 9.28177 7.50004 9.28177C9.66865 9.28177 11.4235 7.39412 11.4235 5.09089C11.4235 2.78765 9.66865 0.9 7.50004 0.9ZM7.50004 1.9181C9.1324 1.9181 10.4589 3.32731 10.4589 5.09089C10.4589 6.85443 9.13256 8.26367 7.50004 8.26367C5.86767 8.26367 4.54116 6.85447 4.54116 5.09089C4.54116 3.32734 5.86751 1.9181 7.50004 1.9181ZM4.05888 10.7181C2.30941 10.7181 0.9 12.236 0.9 14.0908V18.5908C0.9 18.8654 1.10972 19.1 1.38245 19.1H13.6177C13.8904 19.1 14.1 18.8655 14.1 18.591V14.091C14.1 12.2362 12.6906 10.7182 10.9411 10.7182L4.05888 10.7181ZM10.9412 11.7362C12.1572 11.7362 13.1353 12.7725 13.1353 14.0907V18.0815H1.86474V14.0907C1.86474 12.7725 2.84283 11.7362 4.05888 11.7362H10.9412Z" fill="#2E2E2E" stroke="#2E2E2E" stroke-width="0.2" />
                                    </svg>
                                </a>
                                @else
                                <a href="{{ URL('/login') }}" class="btn btn-secondary dropdown-toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20" fill="none">
                                        <path d="M7.50004 0.9C5.33142 0.9 3.57653 2.78765 3.57653 5.09089C3.57653 7.39412 5.33142 9.28177 7.50004 9.28177C9.66865 9.28177 11.4235 7.39412 11.4235 5.09089C11.4235 2.78765 9.66865 0.9 7.50004 0.9ZM7.50004 1.9181C9.1324 1.9181 10.4589 3.32731 10.4589 5.09089C10.4589 6.85443 9.13256 8.26367 7.50004 8.26367C5.86767 8.26367 4.54116 6.85447 4.54116 5.09089C4.54116 3.32734 5.86751 1.9181 7.50004 1.9181ZM4.05888 10.7181C2.30941 10.7181 0.9 12.236 0.9 14.0908V18.5908C0.9 18.8654 1.10972 19.1 1.38245 19.1H13.6177C13.8904 19.1 14.1 18.8655 14.1 18.591V14.091C14.1 12.2362 12.6906 10.7182 10.9411 10.7182L4.05888 10.7181ZM10.9412 11.7362C12.1572 11.7362 13.1353 12.7725 13.1353 14.0907V18.0815H1.86474V14.0907C1.86474 12.7725 2.84283 11.7362 4.05888 11.7362H10.9412Z" fill="#2E2E2E" stroke="#2E2E2E" stroke-width="0.2" />
                                    </svg>
                                </a>
                                @endif
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{ URL('account') }}">My Account </a></li>
                                    <li><a class="dropdown-item" href="{{ URL('orders') }}">My Orders </a></li>
                                    <li><a class="dropdown-item" href="{{ URL('frontend/logout') }}">Logout</a></li>
                                </ul>
                            </span>

                        </div>
                        <div id="nav-icon1" class="d-block d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </span>
                </div>
                <div class="col-6 col-lg-12 text-center header">
                    <div class="mobile-menu text-end text-lg-center">

                        <ul class="mobile-sub-menu">
                            <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <?php
                            $megamenu = \App\Models\MegaMenu::where('estatus', 1)->where('id', 4)->first();
                            //dd($megamenu->sub_menu);
                            if ($megamenu != "") {
                            ?>
                                <li class="{{ (request()->segment(1) == 'lab-diamond') ? 'active' : '' }} lab_grown_diamond_li lab_grown_diamond_part"><a href="{{ url($megamenu->redirect_url) }}">{{ $megamenu->title }}

                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                        <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white " />
                                    </svg>
                                    <div class="mega-menu ">
                                        <div class="sub-pack">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                                <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000" />
                                            </svg>
                                        </div>
                                        <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>

                                        <!-- Loose Diamond -->
                                        <div class="mega-menu-three-part">
                                            <div class="submenu-box  mt-4">
                                                <div class="d-block mb-2">
                                                    <span class="menus_title menus_title_part">loose lab diamonds</span>
                                                </div>
                                                <ul class="mega-menu-two-colum">
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/ROUND') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/round.png" alt="ROUND" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">round</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/HEART') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/heart.png" alt="HEART" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">heart</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/PRINCESS') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/princess.png" alt="PRINCESS" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">princess</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/PEAR') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/pear.png" alt="PEAR" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">pear</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/OVAL') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/oval.png" alt="OVAL" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">oval</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/CUSHION') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/cushion.png" alt="CUSHION" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">cushion</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/EMERALD') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/emerald.png" alt="EMERALD" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">emerald</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/MARQUISE') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/marquise.png" alt="MARQUISE" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">marquise</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/ASSCHER') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/asscher.png" alt="ASSCHER" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">asscher</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/RADIANT') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/radiant.png" alt="RADIANT" class="diamond-mega-menu-img "></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">radiant</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="submenu-box mt-4">
                                                <div class="d-block mb-2">
                                                    <span class="menus_title menus_title_part">Fancy Color</span>
                                                </div>
                                                <ul class="mega-menu-two-colum loose-lab-diamonds-diamond">
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Yellow') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/yellow.png" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Yellow</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Orange') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/orange.png" alt="Orange" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Orange</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Pink') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/pink.png" alt="Pink" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Pink</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Blue') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/blue.png" alt="Blue" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Blue</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Green') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/green.png" alt="Green" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Green</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Brown') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/brown.png" alt="Brown" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Brown</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Red') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/red.png" alt="Red" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Red</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/White') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/white.png" alt="White" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">White</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Violet') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/violet.png" alt="Violet" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Violet</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Purple') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/purple.png" alt="Purple" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Purple</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Olive') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/olive.png" alt="Olive" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Olive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/lab-diamond/fancy-color/Black') }}" class="d-flex">
                                                            <span class="d-inline-block"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/black.png" alt="Black" class="diamond-mega-menu-img"></span>
                                                            <span class="ms-2 ms-md-2 d-inline-block">Black</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                
                                            </div>
                                            <div class="submenu-box mt-4">
                                                <ul>
                                                    <li class="menu-part-img two_part_padding ">
                                                        <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/menu_thumb_1699481661837983.png" alt="">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                            <?php
                            $megamenu = \App\Models\MegaMenu::with('sub_menu.sub_category.category')->where('estatus', 1)->where('id', 1)->first();
                            //dd($megamenu->sub_menu);
                            if ($megamenu != "") {
                            ?>
                                <li class="">
                                    <a href="{{ url($megamenu->redirect_url) }}">
                                        {{ $megamenu->title }}
                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-menu-icon">
                                        <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="white" />
                                    </svg>

                                    <div class="mega-menu">
                                        <div class="sub-pack">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                                <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000" />
                                            </svg>
                                        </div>
                                        <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <?php
                                        $menu_no = 1;
                                        $menu_colum = "two";
                                        foreach ($megamenu->sub_menu as $sub1) {
                                            if (count($sub1->sub_category) > 0) {
                                                if ($menu_no == 1) {
                                                    $menu_colum = "two";
                                                } else if ($menu_no == 2) {
                                                    $menu_colum = "three";
                                                } else if ($menu_no == 3) {
                                                    $menu_colum = "four";
                                                } else {
                                                    $menu_colum = "four";
                                                }
                                                $menu_no = ++$menu_no;
                                            }
                                        }

                                        ?>
                                        <div class="mega-menu-{{ $menu_colum }}-part  ">
                                            <?php
                                            $ma = 0;
                                            foreach ($megamenu->sub_menu as $sub) {
                                                
                                                if (count($sub->sub_category) > 0) {
                                                    $twocolum = "";
                                                    if (count($sub->sub_category) > 5) {
                                                        if($sub->title == "Shop by Shapes"){
                                                            $twocolum = 'mega-menu-two-colum';
                                                        }
                                                    }
                                                    ?>
                                                    <div class="submenu-box mt-4">
                                                        <div class="d-block mb-2">
                                                            <span class="menus_title menus_title_part">{{ $sub->title }}</span>
                                                        </div>
                                                        
                                                            
                                                    
                                                        <ul class="{{ $twocolum }}">

                                                            <?php
                                                            $blimg = 0; 
                                                            $catblImage = array();
                                                            if($ma == 0){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_9828301672918173.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_7871611672917819.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_5525391672918181.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_4642411672918193.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_4642411672918193.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_4767231674620329.png";
                                                            }
                                                            if($ma == 1){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_6749171660109013.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_9780251660109034.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_8555191660109053.png";
                                                            }
                                                            if($ma == 2){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/round.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/princess.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/emerald.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/cushion.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/asscher.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/oval.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/pear.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/marquise.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/radiant.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/heart.png";
                                                            }
                                                            foreach ($sub->sub_category as $car){
                                                                if ($car->icon != "") {
                                                                    $icon = url('images/categoryicon/' . $car->icon);
                                                                } else {
                                                                    $icon = url($car->category->category_thumb);
                                                                }
                                                            
                                                                ?>
                                                                <li>
                                                                    <a href="{{ URL('/shop/'.$car->category->slug)}}">
                                                                        <img src="<?php echo $catblImage[$blimg]; ?>" alt="" class="diamond-mega-menu-img "> <span class="ms-3 ms-lg-2">{{ $car->title }}</span>
                                                                    </a>
                                                                </li>
                                                                <?php
                                                                $blimg++;
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <?php

                                                }
                                                $ma++;
                                            }
                                            ?>
                                            <div class="submenu-box">
                                                <ul class="">
                                                    <li class="menu-part-img"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/menu_thumb_3742411676291719.png" alt=" "></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            <?php } ?>
                            <?php
                            $megamenu = \App\Models\MegaMenu::with('sub_menu.sub_category.category')->where('estatus', 1)->where('id', 2)->first();
                            //dd($megamenu->sub_menu);
                            if ($megamenu != "") {
                            ?>

                                <li class=""><a href="{{ url($megamenu->redirect_url) }}">{{ $megamenu->title }}
                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-menu-icon">
                                        <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="white" />
                                    </svg>

                                    <div class="mega-menu">
                                        <div class="sub-pack">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                                <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000" />
                                            </svg>
                                        </div>
                                        <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <?php
                                        $menu_no = 1;
                                        $menu_colum = "two";
                                        foreach ($megamenu->sub_menu as $sub1) {
                                            if (count($sub1->sub_category) > 0) {
                                                if ($menu_no == 1) {
                                                    $menu_colum = "two";
                                                } else if ($menu_no == 2) {
                                                    $menu_colum = "three";
                                                } else if ($menu_no == 3) {
                                                    $menu_colum = "four";
                                                } else {
                                                    $menu_colum = "four";
                                                }
                                                $menu_no = ++$menu_no;
                                            }
                                        }

                                        ?>
                                        <div class="mega-menu-{{ $menu_colum }}-part ">
                                            <?php
                                            $mab = 0;
                                            foreach ($megamenu->sub_menu as $sub) {
                                                if (count($sub->sub_category) > 0) {
                                                    $twocolum = "";
                                                    if (count($sub->sub_category) > 5) {
                                                        if($sub->title == "Shop by Shapes"){
                                                            $twocolum = 'mega-menu-two-colum';
                                                        }
                                                    }
                                                    ?>
                                                    <div class="submenu-box">
                                                        <div class="d-block mb-2">
                                                            <span class="menus_title menus_title_part">{{ $sub->title }}</span>
                                                        </div>
                                                        <ul class="{{ $twocolum }}">

                                                            <?php
                                                            $bmlimg = 0; 
                                                            $catblImage = array();
                                                            if($mab == 0){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_6622111660110086.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_9259931660110124.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_5284571660111310.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_3432521660110185.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_9077991676280678.jpg";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_7576081674628903.png";
                                                            }
                                                            if($mab == 1){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_6749171660109013.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_9780251660109034.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_8555191660109053.png";
                                                            }
                                                            if($mab == 2){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/round.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/princess.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/emerald.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/cushion.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/asscher.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/oval.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/pear.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/marquise.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/radiant.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/heart.png";
                                                            }
                                                            foreach ($sub->sub_category as $car) {
                                                                if ($car->icon != "") {
                                                                    $icon = url('images/categoryicon/' . $car->icon);
                                                                } else {
                                                                    $icon = url($car->category->category_thumb);
                                                                }
                                                                ?>
                                                                <li>
                                                                    <a href="{{ URL('/shop/'.$car->category->slug)}}">
                                                                        <img src="<?php echo $catblImage[$bmlimg]; ?>" alt="" class="diamond-mega-menu-img "> <span class="ms-3 ms-lg-2">{{ $car->title }}</span>
                                                                    </a>
                                                                </li>
                                                                <?php
                                                                $bmlimg++;
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                <?php
                                                }
                                                $mab++;
                                            }
                                            ?>
                                            <div class="submenu-box">
                                                <ul class="">
                                                    <li class="menu-part-img"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/menu_thumb_6670721676016983+(1).jpg" alt=" "></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            <?php } ?>

                            <?php
                            $megamenu = \App\Models\MegaMenu::with('sub_menu.sub_category.category')->where('estatus', 1)->where('id', 3)->first();
                            //dd($megamenu->sub_menu);
                            if ($megamenu != "") {
                            ?>

                                <li class=""><a href="{{ url($megamenu->redirect_url) }}">Fine Jewelry

                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-menu-icon">
                                        <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="white" />
                                    </svg>

                                    <div class="mega-menu">
                                        <div class="sub-pack">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                                <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000" />
                                            </svg>
                                        </div>
                                        <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <?php
                                        $menu_no = 1;
                                        $menu_colum = "two";
                                        foreach ($megamenu->sub_menu as $sub1) {
                                            if (count($sub1->sub_category) > 0) {
                                                if ($menu_no == 1) {
                                                    $menu_colum = "two";
                                                } else if ($menu_no == 2) {
                                                    $menu_colum = "three";
                                                } else if ($menu_no == 3) {
                                                    $menu_colum = "four";
                                                } else {
                                                    $menu_colum = "four";
                                                }
                                                $menu_no = ++$menu_no;
                                            }
                                        }

                                        ?>
                                        <div class="mega-menu-{{ $menu_colum }}-part ">
                                            <?php
                                            $mac = 0;
                                            foreach ($megamenu->sub_menu as $sub) {
                                                if (count($sub->sub_category) > 0) {
                                                    $twocolum = "";
                                                    if (count($sub->sub_category) > 5) {
                                                        $twocolum = 'mega-menu-two-colum';
                                                    }
                                                    ?>
                                                    <div class="submenu-box">
                                                        <div class="d-block mb-2">
                                                            <span class="menus_title menus_title_part">{{ $sub->title }}</span>
                                                        </div>
                                                        <ul class="{{ $twocolum }}">
                                                            <?php
                                                            $bmlimg = 0; 
                                                            $catblImage = array();
                                                            if($mac == 0){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_5349901672919033.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_1226821672919072.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_7867541672919100.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_3961631674620274.png";
                                                            }
                                                            if($mac == 1){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_5878051660123541.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_2528891660123507.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_3282321674620510.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_2528891660123507.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_7870951672979287.png";
                                                            }
                                                            if($mac == 2){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_9049881672979067.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_7924401672979184.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_9679511672979080.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_4579961674620502.png";
                                                            }
                                                            if($mac == 3){
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_2996601671797733.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_8206631671797745.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_1961571671797759.png";
                                                                $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/icon_8126381671797770.png";
                                                            }
                                                            foreach ($sub->sub_category as $car) {
                                                                if ($car->icon != "") {
                                                                    $icon = url('images/categoryicon/' . $car->icon);
                                                                } else {
                                                                    $icon = url($car->category->category_thumb);
                                                                }
                                                                ?>
                                                                <li>
                                                                    <a href="{{ URL('/shop/'.$car->category->slug)}}">
                                                                        <img src="<?php echo $catblImage[$bmlimg]; ?>" alt="" class="diamond-mega-menu-img "> <span class="ms-3 ms-lg-2">{{ $car->title }}</span>
                                                                    </a>
                                                                </li>
                                                                <?php
                                                                $bmlimg++;
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                                $mac++;
                                            }
                                            ?>
                                            <div class="submenu-box">
                                                <ul class="">
                                                    <li class="menu-part-img"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/menu_thumb_9684031660711063.jpg" alt=" "></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            <?php } ?>
                            
                            <?php
                            $megamenu = \App\Models\MegaMenu::where('estatus', 1)->where('id', 5)->first();
                            if ($megamenu != "") {
                            ?>

                                <li class="{{ (request()->segment(1) == 'diamond-setting' || request()->segment(1) == 'product-setting' || request()->segment(1) == 'diamond-details' || request()->segment(1) == 'custom-product-details') ? 'active' : '' }}"><a href="{{ url($megamenu->redirect_url) }}">{{ $megamenu->title }}

                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                        <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white " />
                                    </svg>
                                    <div class="mega-menu ">
                                        <div class="sub-pack">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                                <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000" />
                                            </svg>
                                        </div>
                                        <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="mega-menu-four-part ">

                                            <?php
                                            $categories = \App\Models\Category::where('estatus', 1)->where('is_custom', 1)->get();
                                            $img_no = 1;
                                            $cat_no = 1;

                                            $mimg = array();
                                            $mimg[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_3621501660106614.jpg";
                                            $mimg[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_5420841660112759.jpg";
                                            $mimg[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_4880971660112835.jpg";
                                            $cmg = 0;
                                            foreach ($categories as $car) {

                                                if ($img_no == 1) {
                                                    $defalt_image = $car->category_thumb;
                                                }
                                                $img_no++;
                                                ?>
                                                <div class="submenu-box1">
                                                    <ul>
                                                        <li>
                                                            <span class="menus_title ">create your own {{ $car->category_name }}</span>
                                                        </li>
                                                        <li>
                                                            <a href="{{ URL('/product-setting/'.$car->slug)}}" class="d-flex">
                                                                <img src="<?php echo $mimg[$cmg]; ?>" alt=" " class="mega-menu-img "> <span class="ms-3 ms-lg-2">Start with a Setting</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ URL('/diamond-setting/'.$car->slug)}}" class="d-flex"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/mega-menu-img-2.png" alt=" " class="mega-menu-img "><span class="ms-3 ms-lg-2">Start with a Lab Diamond</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <?php 
                                                $cmg++;
                                                $cat_no++;
                                            } ?>

                                            <div class="submenu-box1">
                                                <ul>
                                                    <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/menu_thumb_7747141661838002+(1).png" alt="">
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            <?php } ?>

                            <?php
                            $megamenu = \App\Models\MegaMenu::where('estatus', 1)->where('id', 6)->first();

                            if ($megamenu != "") {
                            ?>

                                <li class="{{ (request()->is('infopage*')) ? 'active' : '' }}">
                                    <a href="{{ url($megamenu->redirect_url) }}">{{ $megamenu->title }}

                                    </a>
                                    <svg xmlns="http://www.w3.org/2000/svg " width="12 " height="8 " viewBox="0 0 12 8 " fill="none " class="mobile-menu-icon ">
                                        <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z " fill="white " />
                                    </svg>
                                    <div class="mega-menu">
                                        <div class="sub-pack">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" fill="none" class="mobile-sub-menu-icon">
                                                <path d="M5.99997 7.09417L11.0083 2.08584L9.8308 0.90667L5.99997 4.74L2.16997 0.90667L0.991638 2.085L5.99997 7.09417Z" fill="#000" />
                                            </svg>
                                        </div>
                                        <div id="nav-icon1" class="mega-menu-mobile-icon d-block d-lg-none open">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="mega-menu-four-part">
                                            <ul>
                                                <li>
                                                    <span class="menus_title">About Us </span>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.aboutus')}}"> <span class="ms-2 ms-lg-0">About Us</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.customervalues')}}"><span class="ms-2 ms-lg-0">Customer Values</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.marketneed')}}"><span class="ms-2 ms-lg-0">Market Need</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('gemver-difference') }}"><span class="ms-2 ms-lg-0">Why Gemver?</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.testimonials')}}"> <span class="ms-2 ms-lg-0">Testimonials</span></a>
                                                </li>
                                            </ul>

                                            <ul>
                                                <li>
                                                    <span class="menus_title">Diamond Anatomy </span>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.diamondanatomy')}}#cut"> <span class="ms-2 ms-lg-0">Cut</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.diamondanatomy')}}#color"><span class="ms-2 ms-lg-0">Color</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.diamondanatomy')}}#clarity"><span class="ms-2 ms-lg-0">Clarity</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.diamondanatomy')}}#carat"><span class="ms-2 ms-lg-0">Carat</span></a>
                                                </li>
                                            </ul>

                                            <ul>
                                                <li>
                                                    <span class="menus_title">Learn More </span>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.learnaboutlabmadediamonds')}}"> <span class="ms-2 ms-lg-0">Learn About Lab Diamonds</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.conflictfreediamonds')}}"><span class="ms-2 ms-lg-0">Ethical And Conflict Free Diamonds</span></a>
                                                </li>


                                            </ul>

                                            <ul>
                                                <li>
                                                    <span class="menus_title">Pages </span>
                                                </li>
                                                
                                                
                                                <li>
                                                    <a href="{{ Route('frontend.blogs')}}"><span class="ms-2 ms-lg-0">Blogs</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{ Route('frontend.contactus')}}"><span class="ms-2 ms-lg-0">Contact Us</span></a>
                                                </li>

                                            </ul>

                                            <ul>
                                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/menu_thumb_9080121659943098.png" alt="">
                                            </ul>

                                        </div>
                                    </div>

                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @if(count($banners) > 0)
        <div class="owl-carousel owl-theme home-page-slider">
            @foreach($banners as $banner)
                @if($banner->button_name == "")
                    @if($banner->application_dropdown_id == 1)
                        <a href="#">
                            @elseif($banner->application_dropdown_id == 2)
                            <?php 
                            $product_variant = \App\Models\ProductVariant::where('estatus',1)->where('product_id',$banner->product_variant_id)->first(['slug']);
                            //$banner_url = URL('product-details/'.$banner->value.'/'.$banner->product_variant_id);
                            $banner_url = URL('product-details/'.$product_variant->slug);
                            ?>
                        <a href="{{ ($banner_url != '') ? $banner_url : '#'; }}">
                    @elseif($banner->application_dropdown_id == 3)
                        <?php 
                        $category = \App\Models\Category::where('estatus',1)->where('id',$banner->value)->first(['slug']);
                        $banner_url = URL('shop/'.$category->slug);
                        ?>
                        <a href="{{ ($banner_url != '') ? $banner_url : '#'; }}">
                    @elseif($banner->application_dropdown_id == 4)
                        <?php 
                            $banner_url = $banner->value;
                        ?>
                    <a href="{{ ($banner_url != '') ? $banner_url : '#'; }}">
                    @endif
                @endif  
                <div class="item">
                        <div class="background-slider ">
                            <div class="background-smoke-slider position-relative">
                                <div class="d-block d-md-none mobile-view-img">
                                    <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/bg-img-04.jpg" alt=" " >
                                </div>
                                <div class="d-none d-md-block desktop-view-img">
                                    <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_5262271675507815.png" alt=" " >
                                </div>
                                <div class="">
                                    <div class="background-text-part px-3 px-lg-4 container">
                                        <!-- <img src="{{ asset('frontend/image/line.png') }} " alt=" " class="line-image d-none mx-auto "> -->
                                        <h1 class="heading-h1 home_page_heading">{!! $banner->title !!}</h1>
                                        <div class="paragraph mt-0 mt-md-5 ">
                                        {!! $banner->description !!}
                                        </div>
                                        @if($banner->button_name != "")
                                        @if($banner->application_dropdown_id == 1)
                                        <button  class="explore-ring-btn mt-3 mt-md-4 mt-xxl-4 btn-hover-effect  shop-now-button" >
                                            {{ $banner->button_name }}
                                        </button>
                                        @elseif($banner->application_dropdown_id == 2)
                                        <?php 
                                            
                                            $product_variant = \App\Models\ProductVariant::where('estatus',1)->where('product_id',$banner->product_variant_id)->first(['slug']);
                                            //$banner_url = URL('product-details/'.$banner->value.'/'.$banner->product_variant_id);
                                            if(isset($product_variant->slug)){
                                                $banner_url = URL('product-details/'.$product_variant->slug);
                                            }else{
                                                $banner_url = "";
                                            }
                                        ?>
                                        <button  class="explore-ring-btn mt-3 mt-md-4 mt-xxl-4 btn-hover-effect banner-url shop-now-button" data-value='{{ ($banner_url != "") ? $banner_url : '#'; }}'>
                                            {{ $banner->button_name }}
                                        </button>
                                        @elseif($banner->application_dropdown_id == 3)
                                        <?php 
                                            $category = \App\Models\Category::where('estatus',1)->where('id',$banner->value)->first(['slug']);
                                            $banner_url = URL('shop/'.$category->slug);
                                        ?>
                                        <button  class="explore-ring-btn mt-3 mt-md-4 mt-xxl-4 btn-hover-effect banner-url shop-now-button" data-value='{{ ($banner_url != "") ? $banner_url : '#'; }}'>
                                            {{ $banner->button_name }}
                                        </button>
                                        @elseif($banner->application_dropdown_id == 4)
                                        <?php 
                                            $banner_url = $banner->value;
                                        ?>
                                        <button  class="explore-ring-btn mt-3 mt-md-4 mt-xxl-4 btn-hover-effect banner-url shop-now-button" data-value='{{ ($banner_url != "") ? $banner_url : '#'; }}'>
                                            {{ $banner->button_name }}
                                        </button>
                                        @endif
                                        @endif
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @if($banner->button_name == "")
                </a>
                @endif 
            @endforeach
        </div>
    @endif
    <!-- </div> -->
    
    @if(count($categories) > 0)
    <?php
        $catImage = array();
        $catImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/cat1.png";
        $catImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/cat2.png";
        $catImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/cat3.jpg";
        $catImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/cat4.png";
        $catImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/cat5.png";
        $catImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_9374251676277899.png";
        $catImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_2763951676278030.png";
        $catImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_1354941676277958.png";
    ?>
    <div class="container">
        <div class="shop_by_category shop_by_category_padding">
            <div class="row">
                <div class="col-md-12 text-center d-flex justify-content-center align-items-center position-relative">
                    <div class="mb-3 mt-md-0">
                        <h2 class="heading-h2">{{ $homesetting->section_category_title }}</h2>
                        <!-- <button class="explore-category-btn btn-hover-effect btn-hover-effect-black mb-5 mb-md-0">explore ring</button> -->
                        <div class="sub_title">
                           {{ $homesetting->section_category_shotline }}
                        </div>
                    </div>
                </div>
                <div class="owl-carousel owl-theme shop-by-category mb-5">
                    <?php 
                    $img = 0; ?>
                    @foreach($categories as $category)
                    <div class="item">
                        <a href="{{ URL('/shop/'.$category->slug)}}">
                            <div class="catrgery_box">
                                <span class="catrgory_img">
                                    <img src="<?php echo $catImage[$img]; ?>" alt="{{ $category->category_name }}" >
                                </span>
                                <span class="catrgery_heading">{{ $category->category_name }}</span>
                            </div>
                        </a>
                    </div>
                    <?php 
                    $img++; ?>
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="">
        <div class="shop-colorful-bg">
            <div class="container">
                <div class="row text-center py-5 align-items-center">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="shop-colorful-img">
                        <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/diamond-part.png" alt="" >
                    </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-7 offset-xl-1 text-center text-md-start pt-5 pt-md-0">
                        <h2 class="heading-h2 mb-0 text-center text-md-start">{{ number_format(count($diamonds)) }} Diamonds available <br> in the Store</h2>
                        <div class="sub_title text-center text-md-start">
                            {{ $dddd }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop_dimond_by_shape1">
        <div class="container">
            <div class="mb-3 mt-md-0 text-center">
                <h2 class="heading-h2">{{ $homesetting->section_product_title }}</h2>
                <div class="sub_title">
                   {{ $homesetting->section_product_shotline }}
                </div>
            </div>
            <div>
                <div class="owl-carousel owl-theme products_item">
                <?php 
                    $shape_no = 1;
                    $supported_video = array(
                        'mov',
                        'mp4',
                        '3gp'
                    );
                    $index = 0;
                    $pimg = 0;
                    ?>
                    @foreach($products as $product) 
                     
                    <?php

                        $proImage = array();
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_1608621669799130+(1).png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_4684831669799809.png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_4796651669894301.png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_5336831669802112+(1).png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_5799281669798749+(2).png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_5999771669808139.png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_6719491669888568.png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_6954861669894181.png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_7627821669803103+(1).png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_7681201669798824.png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_7854681669893580.png";
                        $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/ProductImg_7997451669895620.png";

                        $video_array = array();
                        $images_array = array();
                        $images = explode(",",$product->images);
                        foreach($images as $key => $value){
                        $ext = pathinfo($value, PATHINFO_EXTENSION);
                        if(in_array($ext, $supported_video)){
                            $video_array[] = $value;
                        }else{
                            $images_array[] = $value;
                        } 
        
                        }
                        $new_array = array_merge($video_array,$images_array);   
                        $image = URL($new_array['0']);
                        $sale_price = $product->sale_price;
                        $url =  URL('product-details/'.$product->slug); 
                        $supported_image = array(
                        'jpg',
                        'jpeg',
                        'png'
                        );

                        $alt_text = "";
                        if($product->alt_text != ""){
                            $alt_texts = explode(",",$product->alt_text);
                            $alt_text = $alt_texts['0'];
                        }
                    
                    ?>
                    <div class="hover_effect_part wire_bangle_shop_radio product-data">
                    <div class="wire_bangle_img_radio_button">
                        <div class="wire_bangle_img position-relative">
                            <a class="wire_bangle_hover_a" href="{{ $url }}">
                                <?php 
                                   $ext = pathinfo($image, PATHINFO_EXTENSION); 
                                   if(in_array($ext, $supported_image)) {  
                                ?>
                                
                                <img src="<?php echo $proImage[$pimg]; ?>" alt="{{ $alt_text }}">
                                <?php }else{ ?>
                                   
                                    <video  loop="true" autoplay="autoplay"  muted style="width:100%; height:200px;" name="media"><source src="{{ $image }}" type="video/mp4"></video>
                                <?php } ?>
                            </a>
                        </div>
                        <div class="wire_bangle_description p-2">
                            <?php 
                                $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$product->id)->groupBy('attribute_id')->get();
                                foreach($ProductVariantVariant as $productvariants){
                                    if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                                        ?>
                                        <span class="wire_bangle_color wire_bangle_color_img_part text-center wire_bangle_color_ring_part">
                                            <div class="wire_bangle_color_part mb-2">
                                            <?php
                                                $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms','product_variant')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$product->id)->groupBy('attribute_term_id')->get();
                                                $ia = 1;
                                                $ai = 0;
                                                $attrImage = array();
                                                $attrImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/attrTermThumb_1148411660373331.jpg";
                                                $attrImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/attrTermThumb_1440301660373349.jpg";
                                                $attrImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/attrTermThumb_9487801660373373.jpg";
                                                foreach($product_attribute as $attribute_term){
                                                    $attributeurl =  URL('/product-details/'.$attribute_term->product_variant->slug); 
                                                    ?>
                                                    <span class="form-check d-inline-block">
                                                        <a href="{{ $attributeurl }}">
                                                        <img src="<?php echo $attrImage[$ai]; ?>" alt="{{ $attribute_term->attribute_terms[0]->attrterm_name }}"  class="wire_bangle_color_img pe-auto" >
                                                        </a>
                                                        <div class="wire_bangle_color_input_label"></div>
                                                    </span>
                                                    <?php        
                                                    $ia++;
                                                    $ai++;    
                                                }
                                            ?>
                                            </div>
                                        </span>
                                        <?php
                                    } 
                                }
                            ?>
                            <div class="wire_bangle_heading mb-2">
                                {{ $product->primary_category->category_name }}
                                <input type="hidden" class="variant_id" value="{{ $product->variant_id }}">    
                                <input type="hidden" class="item_type" value="0">    
                                <span type="button" class="btn btn-default add-to-wishlist-btn" data-toggle="tooltip" data-placement="right" title="Wishlist">
                                    <?php 
                                        if(is_wishlist($product->variant_id,0)){
                                            ?>
                                            <i class="fas fa-heart heart-icon-part"></i>
                                            <?php 
                                        }else{ 
                                            ?>
                                            <i class="far fa-heart"></i> 
                                            <?php 
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="wire_bangle_sub_heading wire_bangle_description"><a href="{{ $url }}">{{ $product->product_title }}</a></div>
                            <div class="d-flex justify-content-between  align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="wire_bangle_price wire_bangle_price_part">
                                        ${{ $sale_price }}
                                    </span>
                                    
                                     <?php if($product->regular_price != ""){  ?>
                                    <span class="ms-2 wire_bangle_dublicate_price product_detail_regular_price">$<span class="regular_price">{{ $product->regular_price }}</span></span>
                                    <?php } ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $pimg++; $shape_no++;  ?>
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
    <div class="diamond_margin">
        <div class="container">
            <div class="shop_dimond_by_shape">
                <div class="mb-4 mb-md-0 pb-md-5 text-center ">
                    <h2 class="heading-h2 shop_diamond_by_shape_heading">{{ $homesetting->section_diamond_title }}</h2>
                    <div class="sub_title shop_diamond_paragraph">
                        {{ $homesetting->section_diamond_shotline }}
                    </div>
                </div>
                <div>
                    <div class="owl-carousel owl-theme shop-dimond-by-shape-slider">
                        <div class="item">
                            <a href="{{ url('/lab-diamond/round') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/round1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">round</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/oval') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/oval1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">oval</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/princess') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/princess1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">princess</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/cushion') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/cushion1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">cushion</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/marquise') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/marquise1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">marquise</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/pear') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/pear1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">pear</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/radiant') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/radiant1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">radiant</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/heart') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/heart1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">heart</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/emerald') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/emerald1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">emerald</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/asscher') }}" class="shop-dimond-by-shape-img">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/asscher1.png" alt="" >
                                <div class="shop_by_diamond_shpae_name">asscher</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="engagement_ring_section px-0">
        <div class="container engagement_diamond_section">
            <div class="row">
                <div class="col-lg-5 col-xl-4 col-md-5 col-sm-5 pe-lg-4">
                    <div class="engagement_diamond_img">
                        <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/Step_9119221660801490.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-xl-8 col-md-7 col-sm-7 mt-4 mt-sm-0 mt-md-0 mt-lg-0">
                    <h2 class="mb-md-4 heading-h2">{{ strtolower($step->main_title) }}</h2>
                    <p class="engagement_diamond_paragraph_part mb-4">
                        {{ $step->main_shotline }}
                    </p>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-3 mb-lg-5 d-flex d-lg-block align-items-lg-start px-0">
                            <div class="position-relative">
                                <div class="engagement_diamond_box mb-3">
                                    <a href="{{ url('/step/'.$step->slug.'/one'); }}"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/diamond_1_part.png" alt="" ></a>
                                </div> 
                                <a href="{{ url('/step/'.$step->slug.'/one'); }}">
                                    <div class="engagement_diamond_sub_heading mt-0">{{ $step->step1_title }}</div>
                                </a>
                            </div>
                            <div>
                                <p class="customer_stories_paragraph engagement_diamond_paragraph ms-3 ms-lg-0 mb-0">
                                    {{ $step->step1_shotline }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-3 mb-lg-5 d-flex d-lg-block align-items-lg-start px-0">
                            <div class="position-relative">
                                    <div class="engagement_diamond_box mb-3">
                                        <a href="{{ url('/step/'.$step->slug.'/two'); }}"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/diamond_2_part.png" alt="" ></a>
                                    </div> 
                                    <a href="{{ url('/step/'.$step->slug.'/two'); }}"><div class="engagement_diamond_sub_heading mt-0">{{ $step->step2_title }}</div></a>
                            </div>
                            <p class="customer_stories_paragraph engagement_diamond_paragraph ms-3 ms-lg-0 mb-0">
                                {{ $step->step2_shotline }}
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-3 mb-lg-5 d-flex d-lg-block align-items-lg-start px-0">
                            <div class="position-relative">
                                <div class="engagement_diamond_box mb-3">
                                    <a href="{{ url('/step/'.$step->slug.'/three'); }}"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/diamond_3_part.png" alt="" ></a>
                                </div> 
                                <a href="{{ url('/step/'.$step->slug.'/three'); }}"><div class="engagement_diamond_sub_heading mt-0">{{ $step->step3_title }}</div></a>
                            </div>
                            <p class="customer_stories_paragraph engagement_diamond_paragraph ms-3 ms-lg-0 mb-0">
                            {{ $step->step3_shotline }}
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-3 mb-lg-5 d-flex d-lg-block align-items-lg-start px-0">
                            <div class="position-relative">
                                <div class="engagement_diamond_box mb-3">
                                    <a href="{{ url('/step/'.$step->slug.'/four'); }}"><img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/diamond_4_part.png" alt="" ></a>
                                </div>
                                <a href="{{ url('/step/'.$step->slug.'/four'); }}"><div class="engagement_diamond_sub_heading mt-0">{{ $step->step4_title }}</div></a>
                            </div>
                            <p class="customer_stories_paragraph engagement_diamond_paragraph ms-3 ms-lg-0 mb-0">
                                {{ $step->step4_shotline }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="customise_own_ring_section">
        <div class="row">
            <div class="col-md-6 text-center text-md-start px-4 engagement_ring_col_part px-0 mt-md-0 py-4 order-2 order-md-1">
                <div class="engagement_ring_diamond_part">
                    <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-md-start">{{ $homesetting->section_customise_title }}</h2>
                    <div class="customer_stories_paragraph  mb-3 mb-lg-5">{{ $homesetting->section_customise_description }}</div>
                    <a style="" class="explore-category-btn diamond-btn buy_lab_diamonds_btn black_hover_btn" href="{{ url('shop/'.$homesetting->category->slug) }}"> {{ $homesetting->section_customise_label }}</a>
                </div>
            </div>
            <div class="col-md-6 pe-0 px-0 order-1 order-md-2">
                <div class="own_ring_img">
                    <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_3284881676018051.png" alt="" width="100%" >
                </div>
            </div>
        </div>
    </div>

    <div class="smiling_gemver_banner">
        <div class="container">
            <h2 class="mb-4 mb-md-5 heading-h2 text-center smiling_gemver_heading">{{ $homesetting->section_smiling_difference_title }}</h2>
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 diff-item-box">
                    <div class="diff-box">
                        <div class="smiling_box_icon mb-2 mb-mb-3 mt-2">
                            <img src="{{ asset('frontend/image/smiling_1.png') }}" alt="" > 
                        </div>
                        <div class="ms-3 ms-md-0">
                            <div class="smiling_box_heading">
                                {{ $SmilingDifference[0]->title }}   
                            </div>
                            <div class="smiling_box_paragraph">
                                {{ $SmilingDifference[0]->shotline }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 diff-item-box">
                    <div class="diff-box">
                        <div class="smiling_box_icon mb-2 mb-mb-3 mt-2">
                            <img src="{{ asset('frontend/image/smiling_2.png') }}" alt="" > 
                        </div>
                        <div class="ms-3 ms-md-0">
                            <div class="smiling_box_heading">
                                {{ $SmilingDifference[1]->title }}
                                </div>
                                <div class="smiling_box_paragraph">
                                {{ $SmilingDifference[1]->shotline }}
                            </div>
                       </div>
                   </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 diff-item-box">
                    <div class="diff-box">
                        <div class="smiling_box_icon mb-2 mb-mb-3 mt-2">
                            <img src="{{ asset('frontend/image/smiling_3.png') }}" alt="" > 
                        </div>
                        <div class="ms-3 ms-md-0">
                            <div class="smiling_box_heading">
                            {{ $SmilingDifference[2]->title }}
                            </div>
                            <div class="smiling_box_paragraph">
                            {{ $SmilingDifference[2]->shotline }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 diff-item-box">
                    <div class="diff-box">
                        <div class="smiling_box_icon mb-2 mb-mb-3 mt-2">
                            <img src="{{ asset('frontend/image/smiling_4.png') }}" alt="" > 
                        </div>
                       <div class="ms-3 ms-md-0">
                        <div class="smiling_box_heading">
                            {{ $SmilingDifference[3]->title }} 
                            </div>
                            <div class="smiling_box_paragraph">
                            {{ $SmilingDifference[3]->shotline }}
                            </div>
                       </div>
                   </div>
                </div>
            </div>
            <div class="mt-3 text-center">
                <a  class="explore-category-btn btn-hover-effect btn-hover-effect-black diamond-btn buy_lab_diamonds_btn mt-md-4" href="{{ url('gemver-difference') }}">{{ $homesetting->section_smiling_difference_title }}</a>
            </div>
        </div> 
    </div>

    @if(count($BlogBanners) > 0)
        <div class="ads-banner-section">
            <div class="container">
                <h2 class="mb-4 mb-md-5 heading-h2 text-center smiling_gemver_heading">{{ $homesetting->section_blog_banner_title }}</h2>
                <div class="row">
                    <?php 
                        $bimg = 0; 
                        $catbImage = array();
                        $catbImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_2402781674619366.png";
                        $catbImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_4798191674619313.png";
                    ?>
                    @foreach($BlogBanners as $BlogBanner)
                    <?php 
                        $blogcount = count($BlogBanners);
                        $url = "";
                        if($BlogBanner['dropdown_id'] == 1){
                            $category = \App\Models\Category::where('estatus',1)->where('id',$BlogBanner['value'])->first();
                            $url = url('shop/'.$category->slug); 
                        }elseif($BlogBanner['dropdown_id'] == 2){
                            $Product = \App\Models\Product::where('id',$BlogBanner['value'])->first();
                            $cat_id = explode(',',$Product->primary_category_id);
                            $var_id = $Product->product_variant[0]->id;
                            $slug = $Product->product_variant[0]->slug;
                            $url = url('product-details/'.$slug);
                        }
                        if($blogcount == 1){
                        $blogcol = 12; 
                        }else if($blogcount == 2){
                        $blogcol = 6;
                        }else if($blogcount == 3){
                        $blogcol = 4;    
                        }else if($blogcount == 4){
                        $blogcol = 3;    
                        }else if($blogcount == 5){
                        $blogcol = 2;    
                        }else if($blogcount == 6){
                        $blogcol = 2;    
                        }
                    ?>
                    <div class="col-md-{{ $blogcol }} col-sm-12 banner_part">
                        <a href="{{ $url }}" class="banner_part_img_parent">
                            <figure>
                                <img class="" src="<?php echo $catbImage[$bimg]; ?>" alt="" >
                            </figure>
                        </a>
                    </div>
                    <?php 
                    $bimg++; ?>
                    @endforeach 
                </div>
            </div>
        </div>
    @endif

    @if(count($testimonials) > 0)
        <div class="testimonial-section">
            <div class="container">
                <div class="customer_stories">
                    <div class="row">
                        <div class="col-lg-5 customer_stories_bg">
                            <div class="">
                                <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-lg-start">{{ $homesetting->section_stories_title }}</h2>
                                <div class="customer_stories_paragraph mb-3 mb-lg-0 text-center text-lg-start mb-3">{{ $homesetting->section_stories_description }}</div>
                                <div class="customer_stories_img">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div id="customer-stories" class="owl-carousel owl-theme customer-stories">
                                <?php
                                    $testImage = array();
                                    $testImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/Testimonial_5165681659330678.jpg";
                                    $testImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/Testimonial_8839381659330649.jpg";
                                    
                                    $timg = 0;
                                ?>
                                @foreach($testimonials as $testimonial)
                                    <div class="item">
                                        <div class="customer-stories-quotes">
                                            <div class="customer-stories-paragraph">
                                                {!! $testimonial->description !!}
                                            </div>
                                            <div class="mt-4">
                                                <div class="testimonial-author-img">
                                                    <img src="<?php echo $testImage[$timg]; ?>" alt="{{ $testimonial->name }}" >
                                                </div>
                                                <div class="author-info">
                                                    <div class="customer-name mt-2 mb-1">{{ $testimonial->name }}</div>
                                                    <div class="customer-country">{{ $testimonial->country }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    $timg++; ?>
                                @endforeach    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(count($shopbystyle) > 0)
        <div class="engagement_ring_section shop_by_style_slider shop_by_style_slider_home shop_by_style_slider_part">
            <div class="container">
                <div class="col-md-12 text-center d-flex justify-content-center align-items-center position-relative">
                        <div class="mb-3 mt-md-0">
                            <h2 class="heading-h2">{{ $homesetting->section_shop_by_style_title }}</h2>
                            <div class="sub_title">
                                {{ $homesetting->section_shop_by_style_shotline }}
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-12 text-center   ">
                        <div class="owl-carousel owl-theme shop-by-style-slider">
                        <?php 
                            $blimg = 0; 
                            $catblImage = array();
                            $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_7480571672055001.png";
                            $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_7014281674621271.png";
                            $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_6647951672055032.png";
                            $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_4959271672055078.png";
                            $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_4766161672054951.png";
                            $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_3373781672055056.png";
                            $catblImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_1565071672985314+(1).png";
                        ?>
                            @foreach($shopbystyle as $shopby)
                            <div class="item">
                                <a href="{{ ($shopby->setting)?$shopby->setting:'#' }}" class="engagement_ring_img" target="_blank" >
                                    <img src="<?php echo $catblImage[$blimg]; ?>" alt="" >
                                    <div class="shop_by_style_heading text-center">
                                        {{ $shopby->title }}
                                    </div>
                                </a>
                            </div>
                            <?php 
                            $blimg++; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="gemver_diamonds_section px-0">
            <div class="px-3">
                <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-md-start">{{ $homesetting->section_why_gemver_title }}</h2>
                <div class="customer_stories_paragraph mb-3 mb-md-5 text-center text-md-start">{{ $homesetting->section_why_gemver_description }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-md-0 px-0 ps-md-3 position-relative order-2 order-md-1">
                    <div class="gemver_diamods_bg">
                        <div class="diamonds_part">
                            <div class="diamonds_heading mb-3">
                                 {{ $homesetting->section_why_gemver_title1 }}
                            </div>
                            <p class="diamonds_paragraph">{{ $homesetting->section_why_gemver_description1 }}</p>
                            <button type="button"  data-value='{{ ($homesetting->section_why_gemver_button_url1) ? $homesetting->section_why_gemver_button_url1 : '#'; }}'  class="explore-category-btn btn-hover-effect btn-hover-effect-black inquiry_btn_gemver_diamonds customize-button-url">{{ $homesetting->section_why_gemver_button_title1 }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0 px-0 px-md-3 position-relative order-1 order-md-2">
                    <div class="gemver_diamods_bg">
                        <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_6332151676894651.png" alt="" width="100%" >
                    </div>
                </div>
                <div class="col-md-6 mt-3 px-0 ps-md-3 position-relative order-3">
                    <div class="gemver_diamods_bg">
                        <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/categoryThumb_9488321661071659.jpg" alt="" width="100%" >
                    </div>
                </div>
                <div class="col-md-6 mt-md-3 px-0 px-md-3 position-relative order-4">
                    <div class="gemver_diamods_bg">

                        <div class="diamonds_part">
                            <div class="diamonds_heading mb-3">
                            {{ $homesetting->section_why_gemver_title2 }}
                                <!-- Inquiry for bulb order  -->
                            </div>
                            <p class="diamonds_paragraph">
                                {{ $homesetting->section_why_gemver_description2 }}
                            </p>
                            <button type="button" class="explore-category-btn btn-hover-effect btn-hover-effect-black inquiry_btn_gemver_diamonds" data-bs-toggle="modal" data-bs-target="#exampleModal">inquiry now</button>
                        </div>

                        <div class="modal fade inquiry_now_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content p-3 p-md-4">
                                        <div class="row">
                                            <div class="col-8 col-sm-6 ps-0 text-start">
                                                <!-- <div class="mb-xl-4 mb-3 product_heading">bulk order inquiry</div> -->
                                            </div>
                                            <div class="col-4 col-sm-6 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success" id="success-alert" style="display: none;"></div>
                                        <div class="row">
                                      
                                        <form action="" method="post" id="InquiryCreateForm" name="InquiryCreateForm" class="px-0">
                                        @csrf
                                        
                                        <div class="row mb-4 mb-xxl-4">
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="name" placeholder="your name" class="d-block wire_bangle_input">
                                                <div id="name-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="email" id="email" placeholder="enter your email" class="d-block wire_bangle_input">
                                                <div id="email-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            
                                            <div class="mb-3 col-md-6 ps-0">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <select class="d-block wire_bangle_input" name="country_code_mobile"> 
                                                            <option>+91 </option>
                                                            <option>+1 </option>
                                                            <option>+94 </option>
                                                        </select>
                                                    </div>
                                                    <input type="text" name="mobile_no" id="mobile_no" placeholder="mobile number" class="d-block form-control">
                                                    <div id="mobile_no-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6 ps-0">
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <select class="d-block wire_bangle_input" name="country_code_whatsapp"> 
                                                            <option>+91 </option>
                                                            <option>+1 </option>
                                                            <option>+94 </option>
                                                        </select>
                                                    </div>
                                                    <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="whatsapp number" class="form-control">
                                                    <div id="whatsapp_number-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                                </div>
                                            </div>
                                            <div class="mb-6 col-md-12 ps-0">
                                                <textarea name="inquiry" id="inquiry" class="d-block wire_bangle_input" placeholder="Message"></textarea>
                                                <div id="inquiry-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            
                                            </div>  
                                            <button class="send_inquiry_btn product_detail_inquiry_btn" id="save_newInquiryBtn" >send inquiry 
                                            <div class="spinner-border loadericonfa spinner-border-send-inquiry" role="status" style="display:none;">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                           </button>
                                      </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{--
    <div class="Instagram-post-section px-0">
        <h2 class="heading-h2 text-center mb-4">Instagram</h2>
        @if(isset($contents["data"]))
        <div class="owl-carousel owl-theme Instagram-post-slider row mx-0">
           
            @foreach($contents["data"] as $post)
            <?php
                $username = isset($post["username"]) ? $post["username"] : "";
                $caption = isset($post["caption"]) ? $post["caption"] : "";
                $media_url = isset($post["media_url"]) ? $post["media_url"] : "";
                $permalink = isset($post["permalink"]) ? $post["permalink"] : "";
                $media_type = isset($post["media_type"]) ? $post["media_type"] : ""; 
                $thumbnail_url = isset($post["thumbnail_url"]) ? $post["thumbnail_url"] : ""; 
            ?>
            <a href="{{ $permalink }}" target='_blank'>
            <div class="custom-col item">
                <div class="instafeed_inner">
                    <?php
                    if($media_type=="VIDEO"){
                        // echo "<video controls style='width:100%; display: block !important;height:300px;'>
                        //     <source src='{$media_url}' type='video/mp4'>
                        //     Your browser does not support the video tag.
                        // </video>";
                        echo "<img src='{$thumbnail_url}' style='height:300px;'  />";
                    }
 
                    else{
                        echo "<img src='{$media_url}' style='height:300px;' />";
                    }
                    ?>
                    
                </div>
            </div>
            </a>
            @endforeach
            
        </div>
        @else
            <div class="text-center"> No Post Found</div>
        @endif
    </div>
    --}}
  
<!-- @include('frontend.layout.footer') -->
<footer class="footer-part-section mt-0">
    <div class="container">
        <div class="row mb-md-5">
            <div class="col-lg-3">
                <div class="footer-logo mb-3">
                    <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/company_logo_5824141664853670.png" alt="">
                </div>
            </div>
            <div class="col-lg-9">
                <div>
                    <div class="footer-part-heading mb-3">Trusted By</div>
                    <div class="col-md-12 text-center">
                        <div id="trustby-slider" class="owl-carousel owl-theme">
                            <?php 
                            $trustedbies = \App\Models\TrustedBy::where('estatus', 1)->get(); 
                            $proImage = array();
                            $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/trustedbyThumb_9721241675919432.png";
                            $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/trustedbyThumb_9887731675919445.png";
                            $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/trustedbyThumb_2543821675919457.png";
                            $proImage[] = "https://wvimagebucket.s3.ap-south-1.amazonaws.com/trustedbyThumb_2205561675919462.png";
                            $pimg = 0;
                            ?>
                            @foreach($trustedbies as $trusted)
                            <div class="item">
                                <img src="<?php echo $proImage[$pimg]; ?>" alt="">
                            </div>
                            <?php 
                            $pimg++; ?>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="line"></div>
        <div class="row mt-4 mt-md-5">
            <div class="col-md-2 footer-col mb-md-0">
                <div class="footer-heading mb-4 mb-md-4 d-flex justify-content-between"> 
                    about
                   <div class="footer-angle d-block d-md-none">
                   <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 50 30" fill="none" class="float-end">
                        <path d="M0.686462 0.753148C1.60174 -0.251049 3.08575 -0.251049 4.00103 0.753148L25 23.7919L45.9991 0.753148C46.9144 -0.251049 48.3982 -0.251049 49.3135 0.753148C50.2288 1.75735 50.2288 3.38551 49.3135 4.38971L26.6572 29.2468C25.7419 30.2511 24.2582 30.2511 23.3428 29.2468L0.686462 4.38971C-0.228821 3.38551 -0.228821 1.75735 0.686462 0.753148Z" fill="#212121"/>
                    </svg>
                   </div>
                </div>
                <?php $footer1 = \App\Models\FooterPage::where('page_id', 1)->get(); ?>
                <ul class="footer-ul-part d-md-block">
                    @foreach($footer1 as $fo1)
                    <li>
                        <a href="{{ url($fo1->value)}}">{{ ($fo1->title != "")?$fo1->title:$fo1->value }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-2 footer-col mb-md-0">
                <div class="footer-heading mb-4 mb-md-4 d-flex justify-content-between">
                    Why Gemver?
                <div class="footer-angle d-block d-md-none">
                   <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 50 30" fill="none" class="float-end">
                        <path d="M0.686462 0.753148C1.60174 -0.251049 3.08575 -0.251049 4.00103 0.753148L25 23.7919L45.9991 0.753148C46.9144 -0.251049 48.3982 -0.251049 49.3135 0.753148C50.2288 1.75735 50.2288 3.38551 49.3135 4.38971L26.6572 29.2468C25.7419 30.2511 24.2582 30.2511 23.3428 29.2468L0.686462 4.38971C-0.228821 3.38551 -0.228821 1.75735 0.686462 0.753148Z" fill="#212121"/>
                    </svg>
                   </div>
                </div>
                <?php $footer2 = \App\Models\FooterPage::where('page_id', 2)->get(); ?>
                <ul class="footer-ul-part d-md-block">
                    @foreach($footer2 as $fo2)
                    <li>
                        <a href="{{ url($fo2->value)}}">{{ ($fo2->title != "")?$fo2->title:$fo2->value }}</a>
                    </li>
                    
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 footer-col mb-md-0">
                <div class="footer-heading mb-4 mb-md-4 d-flex justify-content-between">
                    contact
                    <div class="footer-angle d-block d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 50 30" fill="none" class="float-end">
                        <path d="M0.686462 0.753148C1.60174 -0.251049 3.08575 -0.251049 4.00103 0.753148L25 23.7919L45.9991 0.753148C46.9144 -0.251049 48.3982 -0.251049 49.3135 0.753148C50.2288 1.75735 50.2288 3.38551 49.3135 4.38971L26.6572 29.2468C25.7419 30.2511 24.2582 30.2511 23.3428 29.2468L0.686462 4.38971C-0.228821 3.38551 -0.228821 1.75735 0.686462 0.753148Z" fill="#212121"/>
                    </svg>
                   </div>
                </div>
                <?php $footer3 = \App\Models\FooterPage::where('page_id', 3)->get(); ?>
                <ul class="footer-ul-part d-md-block">
                    @foreach($footer3 as $fo3)
                    <li>
                        <a href="{{ url($fo3->value)}}">{{ ($fo3->title != "")?$fo3->title:$fo3->value }}</a>
                    </li>
                    @endforeach
                    <li>
                        <a href="tel:+91{{ $settings->company_mobile_no }}"><i class="fa fa-phone"></i> +91 {{ $settings->company_mobile_no }}</a>
                    </li>
                    <li >
                        <a class="text-transform: lowercase;" href="mailto:{{ $settings->company_email }}"><i class="fa fa-envelope"></i> {{ $settings->company_email }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-address-card"></i> {{ $settings->company_address }}</a>
                    </li>
                </ul>
                <div class="mb-2 mb-md-4">
                    <div class="footer-part-heading mb-2">Follow Us</div>
                    <ul class="footer-social-media-icons">
                        @if($settings->instagram_url != "")
                        <li>
                            <a href="{{ $settings->instagram_url}}" target="_blank">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/instagram.png" alt="Instagram">
                            </a>
                        </li>
                        @endif
                        @if($settings->youtub_url != "")
                        <li>
                            <a href="{{ $settings->youtub_url}}" target="_blank">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/youtube.png" alt="Youtube">
                            </a>
                        </li>
                        @endif
                        @if($settings->facebook_url != "")
                        <li>
                            <a href="{{ $settings->facebook_url}}" target="_blank">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/facebook.png" alt="Facebook">
                            </a>
                        </li>
                        @endif
                        @if($settings->twiter_url != "")
                        <li class="me-0">
                            <a href="{{ $settings->twiter_url}}" target="_blank">
                                <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/pinterest.png" alt="Pinterest">
                            </a>
                        </li>
                        @endif 
                    </ul>
                </div>
            </div>
            <div class="col-md-5 footer-col mb-2 mb-md-4">
                <div class="footer-heading mb-4 mb-md-4 d-flex justify-content-between">
                    Newsletter
                </div>
                <p class="footer-paragraph mb-3">Sign up to receive infrequent emails about sample sales, special deals, and new releases.</p>
                <div class="mb-4 mb-md-5">
                    <form action="test" method="post" id="NewsLatterForm">
                        @csrf
                        <div class="alert alert-success" id="success-alert-newslatter" style="display: none;">
                        </div>
                        <div class="d-flex">
                            <span class="email_input mb-0 d-inline-block"> 
                                <input type="text" required="required" name="newslatteremail" id="newslatteremail" placeholder="email address">
                            </span>
                            <span class="ms-2">
                                <button type="submit" id="save_newNewsLatterBtn" class="submit_btn">submit</button>
                            </span>
                        </div>
                        <div id="newslatteremail-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </form>    
                </div>
                <div class="footer-paymentbox mb-4">
                    <div class="footer-heading mb-2 mb-md-2 d-flex justify-content-between">
                        Payments Accepted
                    </div>
                    <img src="https://wvimagebucket.s3.ap-south-1.amazonaws.com/payment_method.png" alt="Payments Accepted">
                </div>
            </div>
        </div>
        <input type="hidden" value="{{asset('frontend/')}}" id="asset" name="asset">
        <div class="footer-copyright-text text-center mt-md-4 pt-md-3 ">
            ©2023 Gemver. All Rights Reserved
        </div>
    </div>
</footer>

    <a href="https://api.whatsapp.com/send?phone=+91{{ $settings->company_mobile_no }}&text=Hello" target="_blank" class="chat-icon-part">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 24 24" width="24px" height="24px">    <path d="M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z"/></svg>
    </a>

    

    <a class="bottom-to-top-btn scrollToTop" href="" style="">
        <svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#0B1727"></path></svg>
    </a>

<script type="text/javascript">
$( document ).ready(function() {    
$('body').on('click', '#save_newNewsLatterBtn', function () {
    save_newslatter($(this),'save_new');
});

function save_newslatter(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#NewsLatterForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('frontend.newslatter.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
           
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                if (res.errors.newslatteremail) {
                    $('#newslatteremail-error').show().text(res.errors.newslatteremail);
                } else {
                    $('#newslatteremail-error').hide();
                }

            }
            if(res.status == 200){
                $('#newslatteremail-error').hide();
                document.getElementById("NewsLatterForm").reset();
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                //location.href="{{ route('frontend.contactus')}}";
                var success_message = 'Thank You For subscribe';
                $('#success-alert-newslatter').text(success_message);
                $("#success-alert-newslatter").fadeTo(2000, 500).slideUp(500, function() {
                  $("#success-alert-newslatter").slideUp(1000);
                });
            }

        },
        error: function (data) {
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}
});
</script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>   
<!-- <script src="{{ asset('frontend/js/all.min.js') }}"></script>    -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script>

<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/js/toastr.init.js') }}"></script>
<script>    
    $(document).ready(function(){
        $(document).on('click','.banner-url',function(){
            var banner_url = $(this).attr("data-value");
            window.location.href = banner_url;
        });

        $(document).on('click','.customize-button-url',function(){
            var banner_url = $(this).attr("data-value");
            window.location.href = banner_url;
        });

        $('body').on('click', '#save_newInquiryBtn', function () {
            save_inquiry($(this),'save_new');
        });
        function save_inquiry(btn,btn_type){
            $(btn).prop('disabled',true);
            $(btn).find('.loadericonfa').show();
            var action  = $(btn).attr('data-action');
            var formData = new FormData($("#InquiryCreateForm")[0]);
            
            $.ajax({
                type: 'POST',
                url: "{{ route('frontend.inquiry.save') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                   
                    if(res.status == 'failed'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();

                        if (res.errors.name) {
                            $('#name-error').show().text(res.errors.name);
                        } else {
                            $('#name-error').hide();
                        }
                        if (res.errors.email) {
                            $('#email-error').show().text(res.errors.email);
                        } else {
                            $('#email-error').hide();
                        }

                        if (res.errors.mobile_no) {
                            $('#mobile_no-error').show().text(res.errors.mobile_no);
                        } else {
                            $('#mobile_no-error').hide();
                        }
                        if (res.errors.inquiry) {
                            $('#inquiry-error').show().text(res.errors.inquiry);
                        } else {
                            $('#inquiry-error').hide();
                        } 
                    }
                    if(res.status == 200){
                        $('#inquiry-error').hide();
                        $('#mobile_no-error').hide();
                        $('#email-error').hide();
                        $('#name-error').hide();
                        document.getElementById("InquiryCreateForm").reset();
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        //location.href="{{ route('frontend.contactus')}}";
                        var success_message = 'Thank You For Bulk Order Inquiry';
                        $('#success-alert').text(success_message);
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                          $("#success-alert").slideUp(1000);
                          //location.reload();
                          //window.location.href = "{{ url('/') }}";
                        });
                    }

                },
                error: function (data) {
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            });
        }
    });
</script>
<script>
    $(document).ready(function() {   
        $("#main_search").keyup(function() {
            search_data($(this).val());
        });

        function search_data(keyword)
        {
        
            var action = "search";
            $.ajax({
            // url:"{{ url('/product-filter') }}",
            // url: ENDPOINT + "/search_products",
                url:"{{ url('/search_products') }}",
                method:"POST",
                data:{action:action,keyword:keyword,_token: '{{ csrf_token() }}'},
                beforeSend: function() {
                    $('.serach-load').show();
                },
                success:function(response){
                    if(response != ""){
                        $('#mega-menu-scrollbar').show();
                        $('.main_search_section').html(response);
                        $('.serach-load').hide(); 
                    }else{
                        $('#mega-menu-scrollbar').hide();
                        $('.main_search_section').html(response);
                        $('.serach-load').hide();   
                    }
                    // if(scroll == 1){
                    //     if (response['artilces'] == "") {
                    //         $('.auto-load').html("We don't have more data to display ");
                    //         return;
                    //     }
                    //     $('.auto-load').hide();   
                    //     $("#data-wrapper").append(response['artilces']);
                    // }else{
                    //     if (response['artilces'] == "") {
                    //         $('#data-wrapper').html("No Result Found");
                    //         $('.auto-load').hide();
                    //         return;
                    //     }
                    //     $("#data-wrapper").html(response['artilces']);  
                    //     $('.auto-load').hide(); 
                    // }  
                    
                }
            });
        }

        $('body').on('click', '#searchBtn', function () {
            var main_search = $("#main_search").val();
            location.href = "{{ url('shop') }}?s="+main_search;
        });
   });
   </script>

</body>
</html>

