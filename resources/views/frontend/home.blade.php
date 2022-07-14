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
                                    <h1 class="heading-h1 m-0 mb-2 mt-md-3 ">{{ $banner->title }}</h1>
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
        <div class="shop_by_category">
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
                <!-- <div class="col-md-12 pe-md-0 mb-5 mb-md-0 mx-auto">
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
                </div> -->
             
                <div class="owl-carousel owl-theme shop-by-category mb-5">
                    @foreach($categories as $category)
                    <a href="{{ URL('/shop/'.$category->id)}}">
                        <div class="item">
                            <div class="catrgery_box">
                                <span class="catrgery_heading">{{ $category->category_name }}</span>
                                <span class="catrgory_img">
                                    <img src="{{ url($category->category_thumb) }}" alt="{{ $category->category_name }}">
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach 
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
                    
                <!-- <?php $shape_no = 1;  ?>
                    @foreach($diamondshape as $shape)  
                    <div class="item">
                        <a href="{{ url('/lad-diamond/'.$shape) }}" class="shop-dimond-by-shape-img">
                            <img src="{{ url('frontend/image/dimond-'.$shape_no.'.png') }}" alt="{{ $shape }}" title="{{ $shape }}">
                        </a>
                    </div>
                    <?php $shape_no++;  ?>
                    @endforeach -->
                    
                    <div class="item">
                        <a href="{{ url('/lad-diamond/round') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/round.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/oval') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/oval.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/princess') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/princess.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/cushion') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/cushion.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/marquise') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/marquise.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/pear') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/pear.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/radiant') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/radiant.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/heart') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/heart.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/emerald') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/emerald.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lad-diamond/asscher') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/asscher.png') }}" alt="">
                        </a>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    @if(count($testimonials) > 0)
    
    <div class="container">
        <div class="customer_stories pt-0">
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
    <div class="engagement_ring_section px-0">
        <!-- <div class="container">
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

        </div> -->
        <div class="container engagement_diamond_section">
            <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="engagement_diamond_img">
                            <img src="{{ asset('frontend/image/how_to_img.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h2 class="mb-md-4 engagement_diamond_heading">How to Buy Your Diamond Engagement Ring?</h2>
                        <p class="engagement_diamond_paragraph_part mb-md-4">
                            Creating your lab grown diamond jewelry is simple. Follow the steps mentioned below when customizing your engagement ring.
                        </p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="position-relative">
                                    <div class="engagement_diamond_box mb-3">
                                        <img src="{{ asset('frontend/image/diamond_1_part.png') }}" alt="">
                                    </div> 
                                    <div class="engagement_diamond_sub_heading mt-2">SET A BUDGET</div>
                                </div>
                                <p class="customer_stories_paragraph engagement_diamond_paragraph">
                                    Plan your budget before buying diamond jewelry, especially if it's your engagement ring.
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                            <div class="position-relative">
                                <div class="engagement_diamond_box mb-3">
                                        <img src="{{ asset('frontend/image/diamond_2_part.png') }}" alt="">
                                    </div> 
                                    <div class="engagement_diamond_sub_heading mt-2">cHOOSE A dIAMOND</div>
                            </div>
                                <p class="customer_stories_paragraph engagement_diamond_paragraph">
                                    Choose a lab diamond based on its 4C's: Cut, Color, Clarity and Carat Weight.
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="position-relative">
                                    <div class="engagement_diamond_box mb-3">
                                        <img src="{{ asset('frontend/image/diamond_3_part.png') }}" alt="">
                                    </div> 
                                    <div class="engagement_diamond_sub_heading mt-2">choose a ring setting</div>
                                </div>
                                <p class="customer_stories_paragraph engagement_diamond_paragraph">
                                    Choose various styles and settings ranging from halos, solitaires and three stones.
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="position-relative">
                                    <div class="engagement_diamond_box mb-3">
                                        <img src="{{ asset('frontend/image/diamond_4_part.png') }}" alt="">
                                    </div>
                                    <div class="engagement_diamond_sub_heading mt-2">Complete Your ring</div>
                                </div>
                                <p class="customer_stories_paragraph engagement_diamond_paragraph">
                                    Select your ring size, customize it with an engraving according to your preference and complete your ring.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="customise_own_ring_section pt-0 pb-0">
            <div class="row align-items-center">
                <div class="col-md-7 text-center text-md-start">
                    <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-md-start">{{ $homesetting->section_customise_title }}</h2>
                    <div class="customer_stories_paragraph  mb-3 mb-lg-5">{{ $homesetting->section_customise_description }}</div>
                    <button class="explore-category-btn btn-hover-effect btn-hover-effect-black diamond-btn"><a style="" href="{{ url('shop/'.$homesetting->section_customise_link) }}">start with a diamond</a></button>
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
                        @foreach($shopbystyle as $shopby)
                        <div class="item">
                            <a href=" @if($shopby->setting == 'product-setting') {{ url('product-setting/'.$shopby->category_id.'/'.$shopby->id) }} @else {{ url('diamond-setting/'.$shopby->category_id.'/'.$shopby->id) }} @endif " class="engagement_ring_img">
                                <img src="{{ url($shopby->image) }}" alt="">
                                <div class="shop_by_style_heading">
                                    {{ $shopby->title }}
                                </div>
                            </a>
                        </div>
                        @endforeach
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
                                <!-- Inquiry for bulb order  -->
                            </div>
                            <p class="diamonds_paragraph">
                                {{ $homesetting->section_why_gemver_description2 }}
                            </p>
                            <button type="button" class="explore-category-btn btn-hover-effect btn-hover-effect-black inquiry_btn_gemver_diamonds" data-bs-toggle="modal" data-bs-target="#exampleModal">inquiry now</button>
                        </div>

                        <div class="modal fade inquiry_now_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col-6 ps-0 text-start">
                                                <div class="mb-xl-4 mb-3 product_heading">bulk order inquiry</div>
                                            </div>
                                            <div class="col-6 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success" id="success-alert" style="display: none;"></div>
                                        <div class="row">
                                      
                                        <form action="" method="post" id="InquiryCreateForm" name="InquiryCreateForm" class="px-0">
                                        @csrf
            
                                        
                                        
                                        <div class="row mb-0 mb-xxl-4">
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="name" placeholder="your name" class="d-block wire_bangle_input">
                                                <div id="name-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="mobile_no" id="mobile_no" placeholder="phone" class="d-block wire_bangle_input">
                                                <div id="mobile_no-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-12 ps-0">
                                                <input type="text" name="email" id="email" placeholder="username123@gmail.com" class="d-block wire_bangle_input">
                                                <div id="email-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
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



    <!-- <div class="container">
        <div class="owl-carousel owl-theme excellent-slider mb-5">
        <div class="item">
            <div class="excellent_slider">
                <div class="row">
                    <div class="col-md-6 star mb-2">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="col-md-6 text-end mb-2">
                        <div class="date_part">4 days ago</div>
                    </div>
                    <div class="col-md-12 mb-2">
                        Everything was good
                    </div>
                    <div class="col-md-12 mb-2">
                        Everything was good. They had a wonderful selection of rings or earring or anyth...
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="excellent_slider">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="col-md-6 text-end mb-2">
                            <div class="date_part">4 days ago</div>
                        </div>
                        <div class="col-md-12 mb-2">
                            Everything was good
                        </div>
                        <div class="col-md-12 mb-2">
                            Everything was good. They had a wonderful selection of rings or earring or anyth...
                        </div>
                    </div>
                    
                </div>
        </div>
        <div class="item">
            <div class="excellent_slider">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="col-md-6 text-end mb-2">
                            <div class="date_part">4 days ago</div>
                        </div>
                        <div class="col-md-12 mb-2">
                            Everything was good
                        </div>
                        <div class="col-md-12 mb-2">
                            Everything was good. They had a wonderful selection of rings or earring or anyth...
                        </div>
                    </div>
                </div>
        </div>
        <div class="item">
            <div class="excellent_slider">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="col-md-6 text-end mb-2">
                        <div class="date_part">May 23</div>
                    </div>
                    <div class="col-md-12 mb-2">
                        Everything was good
                    </div>
                    <div class="col-md-12 mb-2">
                        Everything was good. They had a wonderful selection of rings or earring or anyth...
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="excellent_slider">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="col-md-6 text-end mb-2">
                        <div class="date_part">May 23</div>
                    </div>
                    <div class="col-md-12 mb-2">
                        Everything was good
                    </div>
                    <div class="col-md-12 mb-2">
                        Everything was good. They had a wonderful selection of rings or earring or anyth...
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div> -->
    
    
     <script>
        
        $(document).ready(function(){
            
            $(document).on('click','.banner-url',function(){
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
        <!-- dfbvnfjfdbfddfjkldfj -->
 @endsection
   