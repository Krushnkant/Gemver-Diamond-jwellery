@extends('frontend.layout.layout')

@section('content')

    <div class="background-sub-slider">
        <div class="">
            <div class="about_us_background">
                <h1 class="sub_heading mb-lg-3">about us</h1>
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
    <!-- </div> -->

    <div class="container about_us_product mt-2 mt-md-5">
        @if($Infopage->first_section_contant != '')
        <div class="row about_us_product_row align-items-center px-0 px-md-3">
            <div class="col-md-6">
                <div class="about_us_img">
                    <img src="{{ url('images/aboutus/'. $Infopage->first_section_image)}}" alt="">
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <div class="about_us_product_padding">
                    <h3 class="h3-heading">{{ $Infopage->first_section_title }}</h3>
                    <div class="about_content">{!! $Infopage->first_section_contant !!}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="about_us_box">
            <div class=" owl-carousel owl-theme about-us-slider">
                @if($Infopage->title1 != "")
                <div class="mb-3 item">
                    <div class="position-relative about_box_bg">
                        <div class="about_box_content">
                            <div class="about_us_sub_heading mb-2">
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
                <div class="mb-3 item">
                    <div class="position-relative about_box_bg">
                        <div class="about_box_content">
                            <div class="about_us_sub_heading mb-2">
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
                <div class="mb-3 item">
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
                <div class="mb-3 item">
                    <div class="position-relative about_box_bg">
                        <div class="about_box_content">
                            <div class="about_us_sub_heading mb-2">
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
                        <h3 class="h3-heading">{{ $Infopage->second_section_title }}</h3>
                        <div class="about_content">{!! $Infopage->second_section_contant !!}</div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
   
    <div class="container py-5">
        <div class="row our_mission_box">
            <div class="col-md-6 offset-md-3">
                <img src="{{ URL('images/company/'.$settings->company_favicon) }}" alt="Our Mission">
                <h2 class="heading-h2 mb-4 mt-2">{{ $Infopage->about_our_mission_title }}</h2>
                <p class="center-block mb-xs-0 max-w800">{{ $Infopage->about_our_mission_contant }}</p>
            </div>
        </div>
    </div>
    @if(isset($socialfeed) && $socialfeed != "")
    <div class="container py-5 mb-5">
        <div class="row">
            <div class="col-md-5 dedication-section-img">
                <div class="about_us_img">
                    <img src="{{ url($socialfeed->blog_thumb) }}" alt="" width="">
                </div>
            </div>
            <div class="col-md-7 py-4 dedication-section-content">
                <div class="">
                    <span class="">{{ $socialfeed->sub_title  }}</span>
                    <h2 class="heading-h2 mb-4 mt-2">{{ $socialfeed->title  }}</h2>
                    <div class="about_content">
                        {!! $socialfeed->description  !!}
                    </div>
                    <div class="btn-section">
                        <a href="#">View All <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- HTML For All Social Activity Page -->
    <!-- <div class="container py-5 mb-5">
        <div class="social-act-list-box">
            <div class="social-act-blog">
                <div class="row">
                    <div class="col-md-5 dedication-section-img">
                        <div class="about_us_img">
                            <img src="https://pegasusinc.in/assets/images/project/gal3.jpg" alt="" width="">
                        </div>
                    </div>
                    <div class="col-md-7 py-4 dedication-section-content">
                        <div class="">
                            <h2 class="heading-h2 mb-4 mt-2">Our Dedication to Giving</h2>
                            <div class="about_content">
                                <p>we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price</p>

                                <p>In 2015, we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price. we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price.</p>
                            </div>
                            <div class="btn-section">
                                <a href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social-act-blog">
                <div class="row">
                    <div class="col-md-5 dedication-section-img">
                        <div class="about_us_img">
                            <img src="https://pegasusinc.in/assets/images/project/gal3.jpg" alt="" width="">
                        </div>
                    </div>
                    <div class="col-md-7 py-4 dedication-section-content">
                        <div class="">
                            <h2 class="heading-h2 mb-4 mt-2">Our Dedication to Giving</h2>
                            <div class="about_content">
                                <p>we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price</p>

                                <p>In 2015, we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price. we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price.</p>
                            </div>
                            <div class="btn-section">
                                <a href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social-act-blog">
                <div class="row">
                    <div class="col-md-5 dedication-section-img">
                        <div class="about_us_img">
                            <img src="https://pegasusinc.in/assets/images/project/gal3.jpg" alt="" width="">
                        </div>
                    </div>
                    <div class="col-md-7 py-4 dedication-section-content">
                        <div class="">
                            <h2 class="heading-h2 mb-4 mt-2">Our Dedication to Giving</h2>
                            <div class="about_content">
                                <p>we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price</p>
                                <p>In 2015, we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price. we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price.</p>
                                <p>In 2015, we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price. we provide a wide range of Lab Grown diamonds and jewelry in every shape, size, and color at a reasonable price.</p>
                            </div>
                            <div class="btn-section">
                                <a href="#">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-box text-center mt-5">
            <a href="#" class="load-more-btn">Load More</a>
        </div>
    </div> -->
    @endsection



 