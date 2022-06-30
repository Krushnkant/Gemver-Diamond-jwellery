@extends('frontend.layout.layout')

@section('content')

        <!--<div class="background-slider">-->
        <!--    <div class="background-smoke-slider position-relative">-->
        <!--        <img src="{{ asset('frontend/image/smoke-2.png') }}" alt="">-->
        <!--        <div class="background-text-part">-->
        <!--            <img src="{{ asset('frontend/image/line.png') }}" alt="" class="line-image d-none d-md-block mx-auto">-->
        <!--            <h1 class="heading-h1 m-0 mt-md-3">Jewellery for each event.</h1>-->
        <!--            <div class="paragraph mt-0 mt-md-3">-->
        <!--                Tiniest piece of jewellery tells a great story-->
        <!--            </div>-->
        <!--            <button class="explore-ring-btn mt-3 mt-md-4 mt-xxl-5 btn-hover-effect">-->
        <!--                explore ring-->
        <!--            </button>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        
        @if(count($banners) > 0)
         <div class="owl-carousel owl-theme home-page-slider">
            @foreach($banners as $banner)  
            <div class="item">
                    <div class="background-slider ">
                        <div class="background-smoke-slider position-relative ">
                            <img src="{{ asset($banner->banner_thumb) }}" alt=" ">
                            <div class="container">
                                <div class="background-text-part ">
                                    <img src="{{ asset('frontend/image/line.png') }} " alt=" " class="line-image d-none d-md-block mx-auto ">
                                    <h1 class="heading-h1 m-0 mt-md-3 ">{{ $banner->title }}</h1>
                                    <div class="paragraph mt-0 mt-md-3 ">
                                    {{ $banner->description }}
                                    </div>
                                    @if($banner->button_name != "")
                                    <button  class="explore-ring-btn mt-3 mt-md-4 mt-xxl-5 btn-hover-effect banner-url" data-value='{{ ($banner->button_url != "") ? $banner->button_url : '#'; }}'>
                                        {{ $banner->button_name }}
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    
    @if(count($categories) > 0)
    <div class="container">
        <div class="shop_by_category pb-5 mb-5">
            <div class="row">
                <div class="col-md-12 text-center d-flex justify-content-center align-items-center position-relative mt-5">
                    <div>
                        <h2 class="heading-h2 mb-md-5 mb-3 mt-md-0">{{ $homesetting->section_category_title }}</h2>
                        <!-- <button class="explore-category-btn btn-hover-effect btn-hover-effect-black mb-5 mb-md-0">explore ring</button> -->
                    </div>
                    <div class="category-line-img d-none d-md-block">
                        <img src="{{ asset('frontend/image/category-line.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-12 pe-md-0 mb-5 mb-md-0 mx-auto">
                    <div class="row">
                    <?php
                    $col = 6;
                    if(count($categories) > 4){  
                        $col = 4;
                    }  
                    ?> 
                    @foreach($categories as $category)
                        <a href="{{ URL('/shop/'.$category->id)}}" class="col-md-3 px-0 position-relative shop_by_category_hover">
                            <img src="{{ url($category->category_thumb) }}" alt="{{ $category->category_name }}" width="100%">
                            <div class="category-heading">
                                {{ $category->category_name }}
                            </div>
                        </a>
                    @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="shop_dimond_by_shape">
        <div class="container">
            <h2 class="heading-h2 mb-4 mb-md-0 pb-md-4 text-center text-white">{{ $homesetting->section_diamond_title }}</h2>
            <div>
                <div class="owl-carousel owl-theme shop-dimond-by-shape-slider">
                    <div class="item">
                        <a href="{{ url('/lad-diamond/round') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/dimond-1.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/oval') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/dimond-2.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/princess') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/dimond-3.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/cushion') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/dimond-4.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/marquise') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/dimond-5.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/pear') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/dimond-6.png') }}" alt="">
                        </a>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    @if(count($testimonials) > 0)
    
    <div class="container">
        <div class="customer_stories">
            <div class="row">
                <div class="col-lg-5">
                    <div class="">
                        <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-lg-start">{{ $homesetting->section_stories_title }}</h2>
                        <div class="customer_stories_paragraph mb-3 mb-lg-0 text-center text-lg-start">{{ $homesetting->section_stories_description }}</div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="owl-carousel owl-theme customer-stories">
                    @foreach($testimonials as $testimonial)

                        <div class="item">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ url('images/testimonials/'.$testimonial->image) }}" alt="{{ $testimonial->name }}">
                                </div>
                                <div class="col-md-8 customer-stories-quotes d-flex flex-column justify-content-between">
                                    <div class="customer-stories-paragraph mt-3 mt-md-0">
                                    {!! $testimonial->description !!}
                                    </div>
                                    <div class="text-end mt-0 pt-0 mt-4">
                                        <div class="customer-name">{{ $testimonial->name }}</div>
                                        <div class="customer-country mt-2">{{ $testimonial->country }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
    <div class="engagement_ring_section">
        <div class="container">
            <h2 class="heading-h2 text-center text-white">{{ strtolower($step->main_title) }}</h2>
            <div class="engagement_ring_paragraph mb-3 pb-0 mb-xl-4 mb-xxl-5 pb-xxl-5">{{ $step->main_shotline }}</div>
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="engagement_ring_box">
                        <div class="engagement_ring_number">1</div>
                        <a href="{{ url('/step/'.$step->slug.'/one'); }}"><div class="engagement_ring_heading mb-4">{{ $step->step1_title }}</div></a>
                        <p class="engagement_ring_paragraph text-start">{{ $step->step1_shotline }}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="engagement_ring_box">
                        <div class="engagement_ring_number">2</div>
                        <a href="{{ url('/step/'.$step->slug.'/two'); }}"><div class="engagement_ring_heading mb-4">{{ $step->step2_title }}</div></a>
                        <p class="engagement_ring_paragraph text-start">{{ $step->step2_shotline }}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="engagement_ring_box">
                        <div class="engagement_ring_number">3</div>
                        <a href="{{ url('/step/'.$step->slug.'/three'); }}"><div class="engagement_ring_heading mb-4">{{ $step->step3_title }}</div></a>
                        <p class="engagement_ring_paragraph text-start">{{ $step->step3_shotline }}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="engagement_ring_box">
                        <div class="engagement_ring_number">4</div>
                        <a href="{{ url('/step/'.$step->slug.'/four'); }}"><div class="engagement_ring_heading mb-4">{{ $step->step4_title }}</div></a>
                        <p class="engagement_ring_paragraph text-start">{{ $step->step4_shotline }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="customise_own_ring_section">
            <div class="row">
                <div class="col-md-7 text-center text-md-start">
                    <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-md-start">{{ $homesetting->section_customise_title }}</h2>
                    <div class="customer_stories_paragraph  mb-3 mb-lg-5">{{ $homesetting->section_customise_description }}</div>
                    <button class="explore-category-btn btn-hover-effect btn-hover-effect-black diamond-btn"><a style="color: #BB9761;" href="{{ url('shop/'.$homesetting->section_customise_link) }}">start with a diamond</a></button>
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <div class="own_ring_img">
                        <img src="{{ url($homesetting->section_customise_image) }}" alt="" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="engagement_ring_section">
        <div class="container">
            <h2 class="heading-h2 text-center text-white mb-3 mb-md-5">Shop by style</h2>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="owl-carousel owl-theme shop-by-style-slider">
                        <div class="item">
                            <a href="" class="engagement_ring_img">
                                <img src="{{ asset('frontend/image/shop-1.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="" class="engagement_ring_img">
                                <img src="{{ asset('frontend/image/shop-2.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="" class="engagement_ring_img">
                                <img src="{{ asset('frontend/image/shop-3.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="" class="engagement_ring_img">
                                <img src="{{ asset('frontend/image/shop-1.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="" class="engagement_ring_img">
                                <img src="{{ asset('frontend/image/shop-2.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="" class="engagement_ring_img">
                                <img src="{{ asset('frontend/image/shop-3.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="" class="engagement_ring_img">
                                <img src="{{ asset('frontend/image/shop-1.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="" class="engagement_ring_img">
                                <img src="{{ asset('frontend/image/shop-2.png') }}" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="" class="engagement_ring_img">
                                <img src="{{ asset('frontend/image/shop-3.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="gemver_diamonds_section px-0">
            <div class="px-3">
                <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-md-start">{{ $homesetting->section_why_gemver_title }}</h2>
                <div class="customer_stories_paragraph mb-3 mb-md-5 text-center text-md-start">{{ $homesetting->section_why_gemver_description }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-4 mt-md-0 px-0 px-md-3 position-relative ">
                    <div class="gemver_diamods_bg">
                        <!-- <img src="{{ asset('frontend/image/smoke-bg.png') }}" alt="" width="100%"> -->
                        <div class="diamonds_part">
                            <div class="diamonds_heading mb-3">
                                 {{ $homesetting->section_why_gemver_title1 }}
                            </div>
                            <p class="diamonds_paragraph">{{ $homesetting->section_why_gemver_description1 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0 px-0 px-md-3 position-relative">
                    <div class="gemver_diamods_bg">
                        <img src="{{ url($homesetting->section_why_gemver_image1) }}" alt="" width="100%">
                    </div>
                </div>
                <div class="col-md-6 mt-4 px-0 px-md-3 position-relative">
                    <div class="gemver_diamods_bg">
                        <img src="{{ url($homesetting->section_why_gemver_image2) }}" alt="" width="100%">
                    </div>
                </div>
                <div class="col-md-6 mt-4 px-0 px-md-3 position-relative">
                    <div class="gemver_diamods_bg">

                        <div class="diamonds_part">
                            <div class="diamonds_heading mb-3">
                            {{ $homesetting->section_why_gemver_title2 }}
                            </div>
                            <p class="diamonds_paragraph">{{ $homesetting->section_why_gemver_description2 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     <script>
        
        $(document).ready(function(){
            
            $(document).on('click','.banner-url',function(){
                var banner_url = $(this).attr("data-value");
                window.location.href = banner_url;
            });
    
        });
        </script>
 @endsection
   