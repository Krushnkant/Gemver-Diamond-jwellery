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
   <div class="engagement-slider-sub-text px-3 mt-3 mt-lg-0">
        <div class="custom_made_heading mb-3 mb-xl-4">Fine jewellery</div>
        <p class="custom_engagement_paragrph mb-3 mb-xl-4">
            Create your unique engagement ring from either the setting or a diamond. Start from our engagement ring setting and add a diamond or gemstone of your choice, or select from our extensive range of loose diamonds and complete it with a ring setting in your preferred choice of precious metal.
        </p>
        <div class="d-flex flex-wrap justify-content-center">
            <a href="#" class="engagement_start_diamond me-2 me-lg-3">Shop now</a>
            <!-- <a href="#" class="engagement_start_diamond ">Start with Setting</a> -->
        </div>
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

    <div class="choose-your-section"> 
        <div class="container">
            <div class="row">
                <div class="choose_your_setting_heading text-center mb-2 mb-md-3">
                    Choose Your jewellery 
                </div>
                <p class="choose_your_setting_paragraph wedding_bands_paragraph text-center mb-3 mb-md-4 mb-xl-5">
                    Whatever the occasion, we've got a beatiful piece of jewellery for you.
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

    <div class="mt-xxl-5">
        <div class="container">
            <div class="row two_part_box_section">
                <div class="col-md-6 order-2 order-md-1 design_engagemnt_image lab-diamond-img px-0">
                    <img src="{{ url('images/aboutus/'.$MenuPage->section1_image) }}" alt="">
                </div> 
                <div class="col-md-6 order-1 order-md-2 mb-3 mb-md-0 px-0">
                    <div class="choose_your_setting_box text-center py-4">
                        <div class="">
                            <div class="custom_made_heading text-center mb-2 mb-xl-3">
                                {{ $MenuPage->section1_title }}
                            </div>
                            <p class="custom_engagement_paragrph">
                                {{ $MenuPage->section1_description }}
                            </p>
                            <div class="engagement_button">
                                <a href="{{ url('shop') }}" class="engagement_start_diamond mt-3 mt-xl-5 labDiamondBtn create_yout_own_engagemtnt_ring_btn buy_now_btn d-inline-block">Explore Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container gifts-box-padding">
        <div class="choose_your_setting_heading text-center mb-3 mb-xl-3">{{ $MenuPage->section3_title }}</div>
        <p class="dainty-ring-gifts-paragraph mt-3 mb-4 mb-xl-4">  
            {{ $MenuPage->section3_description }}   
        </p>
        <div class="owl-carousel owl-theme gifts-slider">
            <div class="item gifts-item">
                <div class="banner_part_img_parent">
                    <figure class="mb-0 custom-image-part shadow-none">
                        <div class="mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section31_category->slug }}">
                            <img src="{{ url('images/aboutus/'.$MenuPage->section31_image) }}" alt="">
                        </div>
                    </figure>
                </div>
            </div>
            <div class="item gifts-item">
                 <div class="banner_part_img_parent">
                    <figure class="mb-0 custom-image-part shadow-none">
                        <div class="mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section32_category->slug }}">
                            <img src="{{ url('images/aboutus/'.$MenuPage->section32_image) }}" alt="">
                        </div>
                    </figure>
                 </div>
            </div>
            <div class="item gifts-item">
                <div class="banner_part_img_parent">
                    <figure class="mb-0 custom-image-part shadow-none">
                        <div class="mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section33_category->slug }}">
                            <img src="{{ url('images/aboutus/'.$MenuPage->section33_image) }}" alt="">
                        </div>
                    </figure>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-4 mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section31_category->slug }}">
                <img src="{{ url('images/aboutus/'.$MenuPage->section31_image) }}" alt="">
            </div>
            <div class="col-md-4 mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section32_category->slug }}">
                <img src="{{ url('images/aboutus/'.$MenuPage->section32_image) }}" alt="">
            </div>
            <div class="col-md-4 mb-3 mb-md-0 shopProductBtn dainty-ring-gifts-icon" data-id="{{ $MenuPage->section33_category->slug }}">
                <img src="{{ url('images/aboutus/'.$MenuPage->section33_image) }}" alt="">
            </div>
        </div> -->
        
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