@extends('frontend.layout.layout')

@section('content')

        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">Gemver Difference</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">Gemver Difference</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container about_us_product">
        @if($GenverDifference->section1_description != '')
        <div class="row gemver_difference_us_product_row pb-xl-5 mb-5 px-0 px-md-3">
            <div class="col-md-5 col-lg-6">
                <div class="gemver_diffrence_img mb-3">
                    <img src="{{ url('images/aboutus/'. $GenverDifference->section1_image)}}" alt="">
                </div>
            </div>
            <div class="col-md-7 col-lg-6">
                <div class="gemver_diffrence_box">
                    <div class="text-center text-md-start gemver_diffrence_heading mb-0 mb-md-0 mb-xl-3">{{ $GenverDifference->section1_title }}</div>
                    <p class="gemver_diffrence_paragraph  text-center text-md-start">{!! $GenverDifference->section1_description !!}</p>
                </div>
            </div>
        </div>
        @endif
        @if($GenverDifference->section2_description != '')
        <div class="row gemver_difference_us_product_row pb-xl-5 mb-5 px-0 px-md-3">
            <div class="col-md-5 col-lg-6">
                <div class="gemver_diffrence_img mb-3">
                    <img src="{{ url('images/aboutus/'. $GenverDifference->section2_image)}}" alt="">
                </div>
            </div>
            <div class="col-md-7 col-lg-6">
                <div class="gemver_diffrence_box">
                    <div class="text-center text-md-start gemver_diffrence_heading mb-0 mb-md-0 mb-xl-3">{{ $GenverDifference->section2_title }}</div>
                    <p class="gemver_diffrence_paragraph  text-center text-md-start">{!! $GenverDifference->section2_description !!}</p>
                </div>
            </div>
        </div>
        @endif
        <div class="row gemver_difference_us_product_row pb-xl-5 mb-5 px-0 px-md-3">
            <div class="col-md-5 col-lg-6">
                <div class="gemver_diffrence_img mb-3">
                    <img src="{{ url('images/aboutus/'. $GenverDifference->section3_image)}}" alt="">
                </div>
            </div>
            <div class="col-md-7 col-lg-6 order-2 order-md-1">
                <div class="gemver_diffrence_box">
                    <div class="text-center text-md-start gemver_diffrence_heading mb-0 mb-md-0 mb-xl-3">{{ $GenverDifference->section3_title }}</div>
                    <p class="gemver_diffrence_paragraph  text-center text-md-start">{!! $GenverDifference->section3_description !!}</p>
                </div>
            </div>
        </div>

        <div class="row gemver_difference_us_product_row pb-xl-5 mb-5 px-0 px-md-3">
            <div class="col-md-5 col-lg-6">
                <div class="gemver_diffrence_img mb-3">
                    <img src="{{ url('images/aboutus/'. $GenverDifference->section4_image)}}" alt="">
                </div>
            </div>
            <div class="col-md-7 col-lg-6">
                <div class="gemver_diffrence_box">
                    <div class="text-center text-md-start gemver_diffrence_heading mb-0 mb-md-0 mb-xl-3">{{ $GenverDifference->section4_title }}</div>
                    <p class="gemver_diffrence_paragraph  text-center text-md-start">{!! $GenverDifference->section4_description !!}</p>
                </div>
            </div>
        </div>
       
    </div>
    @endsection



 