@extends('frontend.layout.layout')

@section('content')
    <?php 
    $banner_img = ($MenuPage->banner_mobile_image) ? $MenuPage->banner_mobile_image : $MenuPage->banner_image; 
    ?>

    <div class="engagement_bg_slider" style="background: url(<?php echo 'images/aboutus/'.$banner_img; ?>);">
        <div class="container">
            <div class="engagement-slider-sub-text px-3">
                <h1 class="custom_made_heading">{{ $MenuPage->main_title }}</h1>
                <p class="custom_engagement_paragrph">
                    {{ $MenuPage->main_shotline }}
                </p>
                <div class="">
                    <a href="{{ url('shop/'.$MenuPage->main_banner_category_id) }}" class="engagement_start_diamond me-2 me-lg-3">{{ $MenuPage->main_first_button_name }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="choose-your-section"> 
        <div class="container">
            <div class="row">
                <div class="choose_your_setting_heading text-center mb-2 mb-md-3">
                    {{ $MenuPage->main_title }} 
                </div>
                <p class="choose_your_setting_paragraph wedding_bands_paragraph text-center mb-3 mb-md-4 mb-xl-5">
                    {{ $MenuPage->main_title }} 
                </p>
                @if($MenuPage->menupageshapestyle)
                <div class="owl-carousel owl-theme finejewellery-slider mb-0">

                @foreach($MenuPage->menupageshapestyle as $menupageshapestyle)
                    <div class="item finejewellery-img mb-xl-4 choose_your_setting_col design_engagemnt_image banner_part_img_parent" id="shopProductBtn" data-id="{{ $menupageshapestyle->category->slug }}">
                        <figure>
                            <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                        </figure>
                        <div class="finejewellery-box mt-3">
                            <div class="finejewellery-heading text-center mb-2">
                                {{ $menupageshapestyle->title }}
                            </div>
                            <p class="finejewellery-paragraph my-0">
                                {{ $menupageshapestyle->subdiscription }}
                            </p> 
                        </div>
                    </div> 
                @endforeach
                </div>

                @endif 
                  
            </div>
        </div>
    </div>

    @if(isset($MenuPage->section51_title) && $MenuPage->section51_title != "")
    <div class="container">
            <div class="choose_your_setting_section pt-0">
                <div class="choose_your_setting_heading text-center mb-3 mb-md-4 mb-lg-5 our_engagement_picks_part">
                    {{ $MenuPage->section5_title }}
                </div> 
            <div class="row">
                <div class="col-12">
                <ul class="main-img">
                    <li class="feature main-img-li">
                        <a class="fancy_color_img first_img" href="{{ url('shop/'.$MenuPage->section51_category) }}">
                            <div  class="lab_grown_diamond_heading">{{ $MenuPage->section51_title }}</div>
                            <img src="{{ url('images/aboutus/'.$MenuPage->section51_image) }}" alt="{{ $MenuPage->section51_title }}" class=" me-0">
                        </a>
                    </li>
                    <li class="two main-img-li">
                        <a class="fancy_color_img second_img"  href="{{ url('shop/'.$MenuPage->section52_category) }}">
                            <div class="lab_grown_diamond_heading">{{ $MenuPage->section52_title }}</div>
                            <img src="{{ url('images/aboutus/'.$MenuPage->section52_image) }}" alt="{{ $MenuPage->section52_title }}" class=" me-0">
                        </a>
                    </li>
                    <li class="main-img-li">
                        <a class="fancy_color_img third_img" href="{{ url('shop/'.$MenuPage->section53_category) }}">
                            <div  class="lab_grown_diamond_heading">{{ $MenuPage->section53_title }}</div>
                            <img src="{{ url('images/aboutus/'.$MenuPage->section53_image) }}" alt="{{ $MenuPage->section53_title }}" class=" me-0">
                        </a>
                    </li>
                </ul>
            </div>
           </div>
        </div>
    </div>
    @endif

    <div class="mt-xxl-5">
        <div class="container">
            <div class="row two_part_box_section">
                <div class="col-md-6 design_engagemnt_image lab-diamond-img px-md-0">
                    <img src="{{ url('images/aboutus/'.$MenuPage->section1_image) }}" alt="">
                </div> 
                <div class="col-md-6 mb-3 mb-md-0 px-md-0">
                    <div class="choose_your_setting_box text-center py-4">
                        <div class="">
                            <div class="custom_made_heading text-center mb-2 mb-xl-3">
                                {{ $MenuPage->section1_title }}
                            </div>
                            <p class="custom_engagement_paragrph">
                                {{ $MenuPage->section1_description }}
                            </p>
                            <div class="engagement_button">
                                <a href="{{ $MenuPage->section1_button_url }}" class="engagement_start_diamond mt-3 mt-xl-5 labDiamondBtn create_yout_own_engagemtnt_ring_btn buy_now_btn d-inline-block">{{ $MenuPage->section1_button_title }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container gifts-box-padding">
        <div class="row">
            <div class="col-sm-12">
                <div class="choose_your_setting_heading text-center mb-3 mb-xl-3">{{ $MenuPage->section3_title }}</div>
                <p class="dainty-ring-gifts-paragraph mt-3 mb-4 mb-xl-4">  
                    {{ $MenuPage->section3_description }}   
                </p>
                <div class="owl-carousel owl-theme gifts-slider">
                    <div class="item gifts-item">
                        <div class="banner_part_img_parent">
                            <figure class="mb-0 custom-image-part shadow-none">
                                <div class="mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section31_category->slug }}">
                                    <div class="lab_grown_diamond_heading fj_lab_grown_diamond_heading">{{ $MenuPage->section31_title }}</div>
                                    <img src="{{ url('images/aboutus/'.$MenuPage->section31_image) }}" alt="">
                                </div>
                            </figure>
                        </div>
                    </div>
                    <div class="item gifts-item">
                         <div class="banner_part_img_parent">
                            <figure class="mb-0 custom-image-part shadow-none">
                                <div class="mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section32_category->slug }}">
                                    <div class="lab_grown_diamond_heading fj_lab_grown_diamond_heading">{{ $MenuPage->section32_title }}</div>
                                    <img src="{{ url('images/aboutus/'.$MenuPage->section32_image) }}" alt="">
                                </div>
                            </figure>
                         </div>
                    </div>
                    <div class="item gifts-item">
                        <div class="banner_part_img_parent">
                            <figure class="mb-0 custom-image-part shadow-none">
                                <div class="mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section33_category->slug }}">
                                    <div class="lab_grown_diamond_heading fj_lab_grown_diamond_heading">{{ $MenuPage->section33_title }}</div>
                                    <img src="{{ url('images/aboutus/'.$MenuPage->section33_image) }}" alt="">
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container choose_your_setting_faq">
        <div class="row">
            <div class="col-md-8 mb-md-5 pb-md-5 offset-md-2 pb-4">
                @if(count($faqs) > 0)
                    <div class="choose_your_setting_heading text-center mb-3 mb-md-4 mb-lg-4">
                        FAQs
                    </div> 
                    @foreach($faqs as $faq)
                        <button class="accordion mb-2">
                            {{ $faq->question }}
                        </button>
                            <div class="panel" style="display: none;">
                                 {!! $faq->answer !!}
                            </div>
                        @endforeach
                @endif
            </div>
        </div>
    </div>
     
    <script type="text/javascript">
        $(document).ready(function() {    
            $('body').on('click', '#shopProductBtn', function () {
                var category_id = $(this).attr('data-id');
                var url = "{{ url('shop/') }}" + "/" + category_id;
                window.open(url,"_blank");
            });

            $('body').on('click', '.shopProductBtn', function () {
                var category_id = $(this).attr('data-id');
                var url = "{{ url('shop/') }}" + "/" + category_id;
                window.open(url,"_blank");
            });
        
        });
    </script>

@endsection