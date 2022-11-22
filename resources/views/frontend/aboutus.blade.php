@extends('frontend.layout.layout')

@section('content')

        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">about us</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">about us</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container about_us_product mt-2 mt-md-5">
        @if($Infopage->first_section_contant != '')
        <div class="row about_us_product_row align-items-center px-0 px-md-3">
            <div class="col-md-6 order-2 order-md-1 mt-4 mt-md-0">
                <div class="about_us_product_padding">
                    <h3 class="h3-heading text-center text-md-start d-none d-md-block">{{ $Infopage->first_section_title }}</h3>
                    <p class="customer_stories_paragraph  text-center text-md-start">{!! $Infopage->first_section_contant !!}</p>
                </div>
            </div>
            <div class="col-md-6 order-1 order-md-2">
                <h3 class="h3-heading text-center text-md-start mb-3 d-block d-md-none">{{ $Infopage->first_section_title }}</h3>
                <div class="about_us_img">
                    <img src="{{ url('images/aboutus/'. $Infopage->first_section_image)}}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="about_us_bg_part py-5">
        <div class="container">
            @endif
            @if($Infopage->second_section_contant != '')
            <div class="row about_us_product_row mt-4 align-items-center px-0 px-md-3">
                <div class="col-md-6">
                    <div class="about_us_img">
                        <h3 class="h3-heading text-center text-md-start d-block d-md-none mb-4">{{ $Infopage->second_section_title }}</h3>
                        <img src="{{ url('images/aboutus/'. $Infopage->second_section_image)}}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about_us_product_padding">
                        <h3 class="h3-heading text-center text-md-start d-none d-md-block">{{ $Infopage->second_section_title }}</h3>
                        <p class="customer_stories_paragraph  text-center text-md-start">{!! $Infopage->second_section_contant !!}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>



    <div class="container my-5">
        <div class="about_us_box">
            <div class="row">
                @if($Infopage->title1 != "")
                <div class="col-sm-6 col-lg-3 mb-3">
                    <div class="position-relative about_box_bg">
                        <div class="about_box_content">
                            <div class="about_us_sub_heading mb-2 mb-lg-0 mb-xxl-3">
                            {{ $Infopage->value1 }}
                            </div>
                            <div class="about_us_sub_paragraph">
                            {{ $Infopage->title1 }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($Infopage->title2 != "")
                <div class="col-sm-6 col-lg-3 mb-3">
                    <div class="position-relative about_box_bg">
                        <div class="about_box_content">
                            <div class="about_us_sub_heading mb-2 mb-lg-0 mb-xxl-3">
                            {{ $Infopage->value2 }}
                            </div>
                            <div class="about_us_sub_paragraph">
                            {{ $Infopage->title3 }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($Infopage->title3 != "")
                <div class="col-sm-6 col-lg-3 mb-3">
                    <div class="position-relative about_box_bg">
                        <div class="about_box_content">
                            <div class="about_us_sub_heading mb-2 mb-lg-0 mb-lg-3">
                            {{ $Infopage->value3 }}
                            </div>
                            <div class="about_us_sub_paragraph">
                            {{ $Infopage->title3 }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($Infopage->title4 != "")
                <div class="col-sm-6 col-lg-3 mb-3">
                    <div class="position-relative about_box_bg">
                        <div class="about_box_content">
                            <div class="about_us_sub_heading mb-2 mb-lg-0 mb-xxl-3">
                            {{ $Infopage->value4 }}
                            </div>
                            <div class="about_us_sub_paragraph">
                            {{ $Infopage->title4 }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endsection



 