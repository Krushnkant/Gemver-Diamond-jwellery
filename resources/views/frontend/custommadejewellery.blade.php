@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <a href="{{ url('shop/'.$MenuPage->main_banner_category_id) }}"> 
    <div class="d-block d-md-none mobile-view-img">  
        <?php $mobile_view_image = ($MenuPage->banner_mobile_image)?$MenuPage->banner_mobile_image:$MenuPage->banner_image; ?>
        <img src="{{ url('images/aboutus/'.$mobile_view_image) }}" alt="">
   </div>
   <div class="d-none d-md-block desktop-view-img">
        <img src="{{ url('images/aboutus/'.$MenuPage->banner_image) }}" alt="">
   </div>
    </a>
   
    <!-- <div class="container engagement_text_part">
        <div class="engagement_text_part">
            <h1 class="heading-h1 engagement_heading text-start mb-3">{{ $MenuPage->main_title }}</h1>
            <p class="engagement_paragraph mb-4">
                {{ $MenuPage->main_shotline }}
            </p>
        </div>
    </div> -->
</div>



    <?php $num = 1; ?>
   
    @foreach($MenuPage->menupageshapestyle as $menupageshapestyle)
    @if($num == 1)
        <div class="custom-made-section"> 
            <div class="container text-center">
                <div class="row two_part_box_section">
                    <div class="col-md-6 ps-md-0 pe-md-4 order-1 order-md-2 mb-3 mb-md-0">
                        <div class="choose_your_setting_box text-center custom-made-bg">
                            <div class="">
                                <div class="custom_made_heading text-start mb-2 mb-xl-3">
                                    {{ $menupageshapestyle->title }}
                                </div>
                                <p class="custom_engagement_paragrph mb-4 text-start ms-0">
                                    {{ $menupageshapestyle->subdiscription }}
                                </p>
                                <div class="engagement_button text-center d-md-flex flex-nowrap">
                                    <button class="engagement_start_diamond d-block me-md-3 mx-auto ms-md-0" id="settingDiamondBtn" data-id="{{ $menupageshapestyle->category->slug }}">Start with Diamond</button>
                                    <button class="engagement_start_setting d-block mx-auto ms-md-0" id="settingProductBtn" data-id="{{ $menupageshapestyle->category->slug }}">Start with Setting</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 order-1 order-md-2 design_engagemnt_image lab-diamond-img pe-md-0 order-1 order-md-2">
                       <div class="banner_part_img_parent">
                        <figure class="mb-0 custom-image-part">
                            <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                        </figure>
                       </div>
                    </div> 
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
                            <a href="#" class="lab_grown_diamond_heading">{{ $MenuPage->section51_title }}</a>
                            <img src="{{ url('images/aboutus/'.$MenuPage->section51_image) }}" alt="{{ $MenuPage->section51_title }}" class="fancy_color_img me-0">
                        </li>
                        <li class="two main-img-li">
                            <a href="#" class="lab_grown_diamond_heading">{{ $MenuPage->section52_title }}</a>
                            <img src="{{ url('images/aboutus/'.$MenuPage->section52_image) }}" alt="{{ $MenuPage->section51_title }}" class="fancy_color_img me-0">
                        </li>
                        <li class="main-img-li">
                            <a href="#" class="lab_grown_diamond_heading">{{ $MenuPage->section53_title }}</a>
                            <img src="{{ url('images/aboutus/'.$MenuPage->section53_image) }}" alt="{{ $MenuPage->section51_title }}" class="fancy_color_img me-0">
                        </li>
                    </ul>
                </div>
                    <!-- <div class="col-12 col-md-8 image_view_column banner_part_img_parent first_image_part h-100 pe-0 ps-0 ps-md-2">
                        <figure class="position-relative mb-0 me-md-2">
                            <img src="{{ url('frontend/image/banner_3.jpg') }}" alt="asscher" class="fancy_color_img me-0">
                            <div class="lab_grown_diamonds_text our_engagement_label">Lab grown diamonds</div>
                        </figure>
                    </div>
                    <div class="col-12 col-md-4 image_view_column_part banner_part_img_parent engagement_part px-0 px-md-1 d-flex flex-column justify-content-between">
                        <figure class="position-relative mb-0 image_view_column_part_1"> 
                            <img src="{{ url('frontend/image/banner_3.jpg') }}" alt="asscher" class="fancy_color_img">
                            <div class="lab_grown_diamonds_text">Lab grown diamonds</div>
                        </figure>
                        <figure class="mb-0 position-relative image_view_column_part_2">
                            <img src="{{ url('frontend/image/banner_3.jpg') }}" alt="asscher" class="fancy_color_img mt-0">
                            <div class="lab_grown_diamonds_text three-lab-grown">Lab grown diamonds</div>
                        </figure>
                    </div> -->
               </div>
            </div>
        </div>
        @endif

        
        <div class="shop_dimond_by_shape explore_diamonds_section custom-made-section custom-made-section">
            <div class="container">
                <div class="mb-4 text-center ">
                    <div class="choose_your_setting_heading text-center mb-2 mb-md-3 explore_diamonds_heading">Explore Diamonds By Shape</div>
                    <div class="choose_your_setting_paragraph text-center mb-3 mb-md-4 mb-xl-5">
                        Whatever the occasion, we've got a beatiful piece of jewellery for you.
                    </div>
                </div>
                <div>
                    <div class="owl-carousel owl-theme shop-dimond-by-shape-slider explore_diamonds_section">
                        <div class="item">
                            <a href="{{ url('/lab-diamond/round') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/round.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">round</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/oval') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/oval.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">oval</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/princess') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/princess.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">princess</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/cushion') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/cushion.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">cushion</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/marquise') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/marquise.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">marquise</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/pear') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/pear.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">pear</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/radiant') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/radiant.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">radiant</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/heart') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/heart.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">heart</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/emerald') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/emerald.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">emerald</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/asscher') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/asscher.png') }}" alt="">
                                <div class="shop_by_diamond_shpae_name">asscher</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <?php

        $arr = ["Even", "Odd"];
      
        
        
        
        ?>
        @if($arr[$num % 2] == 'Even')
        <div class=""> 
            <div class="container custom-made-section-padding text-center">
                <div class="row two_part_box_section">
                    <div class="banner_part_img_parent col-md-6 order-2 order-md-1 design_engagemnt_image lab-diamond-img">
                        <figure class="mb-0 custom-image-part">
                            <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                        </figure>
                    </div>

                    <div class="col-md-6 order-1 ps-md-4 order-md-2 mb-3 mb-md-0">
                        <div class="choose_your_setting_box text-start custom-made-bg">
                            <div class="">
                                <div class="custom_made_heading text-start mb-2 mb-xl-3">
                                    {{ $menupageshapestyle->title }}
                                </div>
                                <p class="custom_engagement_paragrph mb-4 text-start ms-0">
                                    {{ $menupageshapestyle->subdiscription }}
                                </p>
                                <div class="engagement_button text-center d-md-flex flex-nowrap">
                                    <button class="engagement_start_diamond d-block me-md-3 mx-auto ms-md-0" id="settingDiamondBtn" data-id="{{ $menupageshapestyle->category->slug }}">Start with Diamond</button>
                                    <button class="engagement_start_setting d-block mx-auto ms-md-0"id="settingProductBtn" data-id="{{ $menupageshapestyle->category->slug }}">Start with Setting</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else

        <div class="my-3 my-xl-4"> 
            <div class="container text-center">
                <div class="row two_part_box_section ring-part-section">
                    
                    <div class="col-md-6 ps-md-0 pe-md-4 mb-3 mb-md-0">
                        <div class="choose_your_setting_box text-center custom-made-bg">
                            <div class="">
                                <div class="custom_made_heading text-start mb-2 mb-xl-3">
                                    {{ $menupageshapestyle->title }}
                                </div>
                                <p class="custom_engagement_paragrph mb-4 ms-0 text-start">
                                    {{ $menupageshapestyle->subdiscription }}
                                </p>
                                <div class="engagement_button text-center d-md-flex flex-nowrap">
                                    <button class="engagement_start_diamond d-block me-md-3 mx-auto ms-md-0" id="settingDiamondBtn" data-id="{{ $menupageshapestyle->category->slug }}">Start with Diamond</button>
                                    <button class="engagement_start_setting d-block mx-auto ms-md-0"id="settingProductBtn" data-id="{{ $menupageshapestyle->category->slug }}">Start with Setting</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <div class="banner_part_img_parent col-md-6 design_engagemnt_image lab-diamond-img pe-md-0">
                        <figure class="mb-0 custom-image-part">
                            <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
    <?php $num++; ?>
    @endforeach

    <div class="container choose_your_setting_faq">
        <div class="row">
            <div class="col-md-8 mb-md-5 pb-md-5 offset-md-2 pb-4">
                @if(count($faqs) > 0)
                    <div class="choose_your_setting_heading text-center mb-3 mb-md-4 mb-lg-4">
                        FAQs
                    </div> 
                    @foreach($faqs as $faq)
                        <button class="accordion active mb-2">
                            {{ $faq->question }}
                        </button>
                            <div class="panel" style="display: none;">
                                <p>{{ $faq->answer }}</p>
                            </div>
                        @endforeach
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {    
            $('body').on('click', '#settingProductBtn', function () {
                var category_id = $(this).attr('data-id');
                var url = "{{ url('product-setting/') }}" + "/" + category_id;
                window.open(url,"_blank");
            });
        
            $('body').on('click', '#settingDiamondBtn', function () {
                var category_id = $(this).attr('data-id');
                var url = "{{ url('diamond-setting/') }}" + "/" + category_id;
                window.open(url,"_blank");
            });
        
        });
        </script>
@endsection