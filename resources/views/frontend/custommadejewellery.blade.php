@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <div class="d-block d-md-none mobile-view-img">  
        <?php $mobile_view_image = ($MenuPage->banner_mobile_image)?$MenuPage->banner_mobile_image:$MenuPage->banner_image; ?>
        <img src="{{ url('images/aboutus/'.$mobile_view_image) }}" alt="">
   </div>
   <div class="d-none d-md-block desktop-view-img">
        <img src="{{ url('images/aboutus/'.$MenuPage->banner_image) }}" alt="">
   </div>
   
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
        <div class="my-3 mb-xl-4 mt-5 pt-4"> 
            <div class="container mb-xl-5 text-center">
                <div class="row two_part_box_section">
                    <div class="col-md-6 ps-md-0 order-1 order-md-2 mb-3 mb-md-0">
                        <div class="choose_your_setting_box text-center">
                            <div class="">
                                <div class="custom_made_heading text-center mb-2 mb-xl-3">
                                    {{ $menupageshapestyle->title }}
                                </div>
                                <p class="custom_engagement_paragrph mb-4">
                                    {{ $menupageshapestyle->subdiscription }}
                                </p>
                                <div class="engagement_button text-center">
                                    <button class="engagement_start_diamond d-block mx-auto mb-3" id="settingDiamondBtn" data-id="{{ $menupageshapestyle->category_id }}">Start with Diamond</button>
                                    <button class="engagement_start_setting d-block mx-auto"id="settingProductBtn" data-id="{{ $menupageshapestyle->category_id }}">Start with Setting</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 order-1 order-md-2 design_engagemnt_image lab-diamond-img pe-md-0 order-1 order-md-2">
                        <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                    </div> 
                </div>
            </div>
        </div>
        <div class="shop_dimond_by_shape explore_diamonds_section mt-3 my-md-5">
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
        <div class="my-3 my-xl-4"> 
            <div class="container mb-xl-5 text-center">
                <div class="row two_part_box_section">
                    <div class="col-md-6 order-2 order-md-1 design_engagemnt_image lab-diamond-img">
                        <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                    </div> 
                    <div class="col-md-6 order-1 order-md-2 mb-3 mb-md-0">
                        <div class="choose_your_setting_box text-center">
                            <div class="">
                                <div class="custom_made_heading text-center mb-2 mb-xl-3">
                                    {{ $menupageshapestyle->title }}
                                </div>
                                <p class="custom_engagement_paragrph mb-4">
                                    {{ $menupageshapestyle->subdiscription }}
                                </p>
                                <div class="engagement_button text-center">
                                    <button class="engagement_start_diamond d-block mx-auto mb-3" id="settingDiamondBtn" data-id="{{ $menupageshapestyle->category_id }}">Start with Diamond</button>
                                    <button class="engagement_start_setting d-block mx-auto"id="settingProductBtn" data-id="{{ $menupageshapestyle->category_id }}">Start with Setting</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="my-3 my-xl-4"> 
            <div class="container mb-xl-5 text-center">
                <div class="row two_part_box_section">
                    
                    <div class="col-md-6 ps-md-0 mb-3 mb-md-0">
                        <div class="choose_your_setting_box text-center">
                            <div class="">
                                <div class="custom_made_heading text-center mb-2 mb-xl-3">
                                    {{ $menupageshapestyle->title }}
                                </div>
                                <p class="custom_engagement_paragrph mb-4">
                                    {{ $menupageshapestyle->subdiscription }}
                                </p>
                                <div class="engagement_button text-center">
                                    <button class="engagement_start_diamond d-block mx-auto mb-3" id="settingDiamondBtn" data-id="{{ $menupageshapestyle->category_id }}">Start with Diamond</button>
                                    <button class="engagement_start_setting d-block mx-auto"id="settingProductBtn" data-id="{{ $menupageshapestyle->category_id }}">Start with Setting</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 design_engagemnt_image lab-diamond-img pe-md-0">
                        <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                    </div> 
                </div>
            </div>
        </div>
        @endif
    @endif
    <?php $num++; ?>
    @endforeach

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