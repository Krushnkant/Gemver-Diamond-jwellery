@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <img src="{{ url('images/aboutus/'.$MenuPage->banner_image) }}" alt="">
    <div class="container engagement_text_part">
        <div class="engagement_text_part">
            <h1 class="heading-h1 engagement_heading text-start mb-3">{{ $MenuPage->main_title }}</h1>
            <p class="engagement_paragraph mb-4">
                {{ $MenuPage->main_shotline }}
            </p>
            <div class="engagement_button">
                <button   class="engagement_start_diamond labDiamondBtn">{{ $MenuPage->main_first_button_name }}</button>
            </div>
        </div>
    </div>
</div>


<div class="">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0 design_engagemnt_image lab-diamond-img">
                    <img src="{{ url('images/aboutus/'.$MenuPage->section1_image) }}" alt="">
                </div> 
                <div class="col-md-6">
                    <div class="choose_your_setting_box text-center">
                        <div class="">
                            <div class="custom_made_heading text-center mb-2 mb-xl-3">
                                {{ $MenuPage->section1_title }}
                            </div>
                            <p class="custom_engagement_paragrph">
                                {{ $MenuPage->section1_description }}
                            </p>
                            <div class="engagement_button mt-3 mt-sm-0 mt-md-3 mt-xl-4 text-start text-sm-center">
                                <button class="engagement_start_diamond d-block d-sm-inline-block mx-auto" id="settingDiamondBtn" data-id="{{ $MenuPage->category_id }}">Start with Diamond</button>
                                <button class="engagement_start_setting ms-lg-3 mt-3 d-block d-sm-inline-block mx-auto" id="settingProductBtn" data-id="{{ $MenuPage->category_id }}">Start with Setting</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop_dimond_by_shape explore_diamonds_section mt-3 ">
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
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/oval') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/oval.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/princess') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/princess.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/cushion') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/cushion.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/marquise') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/marquise.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/pear') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/pear.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/radiant') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/radiant.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/heart') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/heart.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/emerald') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/emerald.png') }}" alt="">
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{ url('/lab-diamond/asscher') }}" class="shop-dimond-by-shape-img">
                            <img src="{{ asset('frontend/image/asscher.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="fancy_color_diamonds shop_dimond_by_shape px-0">
    <div class="container">
        <div class="choose_your_setting_heading text-center mb-2 mb-md-5">Fancy Colour Diamonds</div>
        <div class="owl-carousel owl-theme fancy-color-diamonds">
            @if($MenuPage->menupageshapestyle)
            @foreach($MenuPage->menupageshapestyle as $menupageshapestyle)
            <div class="item fancy-color-diamonds-item" id="shopProductBtn" data-id="{{ $menupageshapestyle->category_id }}">
                <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="" class="fancy-color-duiamonds-img">
                <div class="fancy-color-heading mt-3">
                    {{ $menupageshapestyle->title }}
                </div>
            </div>
            @endforeach
            @endif
            
        </div>
    </div>
</div>

    <div class="smiling_gemver_banner shop_dimond_by_shape smiling_gemver_banner_section">
      <div class="container">
      <div class="choose_your_setting_heading text-center mb-4 mb-md-5">Smiling  Gemver Difference</div>
        <!-- <h2 class="mb-4 mb-md-5 heading-h2 text-center smiling_gemver_heading">Smiling  Gemver Difference</h2> -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                   <div class="smiling_box_icon mb-2 mb-mb-3">
                        <img src="{{ asset('frontend/image/smiling_1.png') }}" alt=""> 
                   </div>
                    <div class="smiling_box_heading mb-2 mb-mb-3">
                        {{ $SmilingDifference[0]->title }}   
                    </div>
                    <div class="smiling_box_paragraph">
                        {{ $SmilingDifference[0]->shotline }}
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                   <div class="smiling_box_icon mb-2 mb-mb-3">
                        <img src="{{ asset('frontend/image/smiling_2.png') }}" alt=""> 
                   </div>
                    <div class="smiling_box_heading mb-2 mb-mb-3">
                    {{ $SmilingDifference[1]->title }}
                    </div>
                    <div class="smiling_box_paragraph">
                    {{ $SmilingDifference[1]->shotline }}
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                   <div class="smiling_box_icon mb-2 mb-mb-3">
                        <img src="{{ asset('frontend/image/smiling_3.png') }}" alt=""> 
                   </div>
                    <div class="smiling_box_heading mb-2 mb-mb-3">
                    {{ $SmilingDifference[2]->title }}
                    </div>
                    <div class="smiling_box_paragraph">
                    {{ $SmilingDifference[2]->shotline }}
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                   <div class="smiling_box_icon mb-2 mb-mb-3">
                        <img src="{{ asset('frontend/image/smiling_4.png') }}" alt=""> 
                   </div>
                    <div class="smiling_box_heading mb-2 mb-mb-3">
                    {{ $SmilingDifference[3]->title }} 
                    </div>
                    <div class="smiling_box_paragraph">
                    {{ $SmilingDifference[3]->shotline }}
                    </div>
                </div>
                
            </div>
      </div>
      
    </div>


    <div class="container mb-5 mb-md-5 pb-md-5 mt-5">
    <div class="row">
        <div class="col-md-6 order-2 order-md-1">
            <div class="choose_your_setting_box text-center">
                <div class="">
                    <div class="custom_made_heading text-center mb-2 mb-xl-3">
                        {{ $MenuPage->section4_title }}
                    </div>
                    <p class="custom_engagement_paragrph">
                        {{ $MenuPage->section4_description }}
                    </p>
                    <div class="engagement_button">
                        <button class="engagement_start_diamond mt-3 mt-xl-4 labDiamondBtn">Explore Lab grown</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 order-1 order-md-2 mb-3 mb-md-0 lab-diamond-img">
            <img src="{{ url('images/aboutus/'.$MenuPage->section4_image) }}" alt="">
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
    
        $('body').on('click', '.labDiamondBtn', function () {
            var url = "{{ url('lab-diamond') }}";
            window.open(url,"_blank");
        });

        $('body').on('click', '#shopProductBtn', function () {
            var category_id = $(this).attr('data-id');
            var url = "{{ url('shop/') }}" + "/" + category_id;
            window.open(url,"_blank");
        });
    
    });
    </script>

@endsection