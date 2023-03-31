<?php
$settings = \App\Models\Settings::first();
?>

<!doctype html>
<html>

<head>
    <!-- Required meta tags -->
    <title>{{ $settings->company_name }}  {{  isset($meta_title) ? " | ".$meta_title:"" }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL('images/company/'.$settings->company_favicon) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="canonical" href="{{ url()->full() }}" />
    <meta name="title" content="{{ isset($meta_title) ? $meta_title:"" }}"/>
    <meta name="description" content="{{ isset($meta_description) ? $meta_description :"" }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    
    <!-- TrustBox script -->
    {{-- <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script> --}}

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-962R43V393"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-962R43V393');
    </script>

    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "g2tcy46q6v");
    </script>
</head>
<body>


 {{-- <div class="header-loader">
    <div class="loader-btn" role="status"> 
    <img src="{{ asset('frontend/image/page-loader.gif') }}" alt="">
    </div>
</div> --}}
<input type="hidden" name="web_url" value="{{ url("/") }}" id="web_url">
<div class="">
@include('frontend.layout.header')


    @if(count($banners) > 0)
        <div class="owl-carousel owl-theme home-page-slider">
            @foreach($banners as $banner)
                @if($banner->application_dropdown_id == 1)
                    <?php  $banner_url =  "#"?>
                @elseif($banner->application_dropdown_id == 2)
                    <?php 
                        $product_variant = \App\Models\ProductVariant::where('estatus',1)->where('product_id',$banner->product_variant_id)->first(['slug']);
                        $banner_url = isset($product_variant->slug)?URL('product-details/'.$product_variant->slug):"#";
                    ?>
                @elseif($banner->application_dropdown_id == 3)
                    <?php 
                        $category = \App\Models\Category::where('estatus',1)->where('id',$banner->value)->first(['slug']);
                        $banner_url = isset($category->slug)?URL('shop/'.$category->slug):"#";
                    ?>
                    
                @elseif($banner->application_dropdown_id == 4)
                    <?php $banner_url = $banner->value; ?>
                @endif
                
                @if($banner->button_name == "")
                    <a href="{{ ($banner_url != '') ? $banner_url : '#'; }}">
                @endif  
                <div class="item">
                    <div class="background-slider ">
                        <div class="background-smoke-slider position-relative">
                            <div class="d-block d-md-none mobile-view-img">
                                <img src="{{ asset(($banner->mobile_banner_thumb)?$banner->mobile_banner_thumb:$banner->banner_thumb) }}" alt=" " loading="lazy">
                            </div>
                            <div class="d-none d-md-block desktop-view-img">
                                <img src="{{ asset($banner->banner_thumb) }}" alt=" " loading="lazy">
                            </div>
                            <div class="">
                                <div class="background-text-part px-3 px-lg-4 container">
                                    <h1 class="heading-h1 home_page_heading">{!! $banner->title !!}</h1>
                                    <div class="paragraph mt-0 mt-md-5 ">
                                    {!! $banner->description !!}
                                    </div>
                                    @if($banner->button_name != "")
                                        @if($banner->application_dropdown_id == 1)
                                            <button  class="explore-ring-btn mt-3 mt-md-4 mt-xxl-4 btn-hover-effect  shop-now-button" >
                                                {{ $banner->button_name }}
                                            </button>
                                        @else
                                            <button  class="explore-ring-btn mt-3 mt-md-4 mt-xxl-4 btn-hover-effect banner-url shop-now-button" data-value='{{ ($banner_url != "") ? $banner_url : '#'; }}'>
                                                {{ $banner->button_name }}
                                            </button>
                                        @endif
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($banner->button_name == "")
                </a>
                @endif 
            @endforeach
        </div>
    @endif
    <!-- </div> -->
    
    @if(count($categories) > 0)
    <div class="container">
        <div class="shop_by_category shop_by_category_padding">
            <div class="row">
                <div class="col-md-12 text-center d-flex justify-content-center align-items-center position-relative">
                    <div class="mb-3 mt-md-0">
                        <h2 class="heading-h2">{{ $homesetting->section_category_title }}</h2>
                        <div class="sub_title">
                           {{ $homesetting->section_category_shotline }}
                        </div>
                    </div>
                </div>
                <div class="owl-carousel owl-theme shop-by-category mb-5">
                    @foreach($categories as $category)
                    <div class="item">
                        <a href="{{ URL('shop/'.$category->slug)}}">
                            <div class="catrgery_box">
                                <span class="catrgory_img">
                                    <img src="{{ url($category->category_thumb) }}" alt="{{ $category->category_name }}">
                                </span>
                                <span class="catrgery_heading">{{ $category->category_name }}</span>
                            </div>
                        </a>
                    </div>
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
    @endif
    <?php
    \DB::enableQueryLog();
    // $ProductVariantVariant = \App\Models\ProductVariantVariant::select('product_variant_variants.attribute_id')->leftJoin("attribute_terms",function($join){
    //         $join->on("product_variant_variants.attribute_term_id","=","attribute_terms.id")
    //             ->whereNotNull('attrterm_thumb');
    //     })->where('product_variant_variants.estatus',1)->where('product_variant_variants.product_id',4)->groupBy('product_variant_variants.attribute_id')->get();
    //     dd(\DB::getQueryLog());
    ?>
    <div class="">
        <div class="shop-colorful-bg">
            <div class="container">
                <div class="row text-center py-5 align-items-center">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="shop-colorful-img">
                        <img src="{{ asset('frontend/image/diamond-part.png') }}" alt="" loading="lazy">
                    </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-7 offset-xl-1 text-center text-md-start pt-5 pt-md-0">
                        <h2 class="heading-h2 mb-0 text-center text-md-start">{{ number_format($diamonds) }} Diamonds available <br> in the Store</h2>
                        <div class="sub_title text-center text-md-start">
                            Glide with the shine of beautiful Jewels
                        </div>
                        <div class="shop-colorful-bg-btn-div">
                            <a href="{{ url('/lab-diamond') }}" class="shopnow_diamond">Shop Now <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shop_dimond_by_shape1">
        <div class="container">
            <div class="mb-3 mt-md-0 text-center">
                <h2 class="heading-h2">{{ $homesetting->section_product_title }}</h2>
                <div class="sub_title">
                   {{ $homesetting->section_product_shotline }}
                </div>
            </div>
            <div>
                <div class="owl-carousel owl-theme products_item">
                <?php 
                    $shape_no = 1;
                    // $supported_video = array(
                    //     'mov',
                    //     'mp4',
                    //     '3gp'
                    // );
                    $index = 0;
                   
                    ?>
                    @foreach($products as $product) 
                     
                    <?php
                    
                       // $video_array = array();
                       // $images_array = array();
                        $images = explode(",",$product->images);
                        $image = URL($images['0']);
                        // foreach($images as $key => $value){
                        //     $ext = pathinfo($value, PATHINFO_EXTENSION);
                        //     if(in_array($ext, $supported_video)){
                        //         $video_array[] = $value;
                        //     }else{
                        //         $images_array[] = $value;
                        //     } 
                        // }
                        // $new_array = array_merge($video_array,$images_array);   
                        // $image = URL($new_array['0']);
                         
                        // $supported_image = array(
                        // 'jpg',
                        // 'jpeg',
                        // 'png'
                        // );

                        $sale_price = $product->sale_price;
                        $url =  URL('product-details/'.$product->slug); 

                        $alt_text = "";
                        if($product->alt_text != ""){
                            $alt_texts = explode(",",$product->alt_text);
                            $alt_text = $alt_texts['0'];
                        }
                    
                    ?>
                    <div class="hover_effect_part wire_bangle_shop_radio product-data">
                    <div class="wire_bangle_img_radio_button">
                        <div class="wire_bangle_img position-relative">
                            <a class="wire_bangle_hover_a" href="{{ $url }}">
                                <?php 
                                  // $ext = pathinfo($image, PATHINFO_EXTENSION); 
                                  // if(in_array($ext, $supported_image)) {  
                                ?>
                                
                                {{-- <img src="{{ $image }}" alt="{{ $alt_text }}" loading="lazy"> --}}
                                <?php // }else{ ?>
                                   
                                    {{-- <video  loop="true" autoplay="autoplay"  muted style="width:100%; height:200px;" name="media"><source src="{{ $image }}" type="video/mp4"></video> --}}
                                <?php // } ?>
                                <img src="{{ $image }}" alt="{{ $alt_text }}" loading="lazy">
                            </a>
                        </div>
                        <div class="wire_bangle_description p-2">
                            <?php 
                                //$ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('product_id',$product->id)->groupBy('attribute_id')->get();
                             
                                $ProductVariantVariant = \App\Models\ProductVariantVariant::select('slug','attrterm_thumb','attrterm_name')->leftJoin("attribute_terms",function($join){
                                        $join->on("product_variant_variants.attribute_term_id","=","attribute_terms.id")
                                            ->whereNotNull('attrterm_thumb');
                                    })->leftJoin('product_variants', 'product_variants.id', '=', 'product_variant_variants.product_variant_id')->where('product_variant_variants.estatus',1)->where('product_variant_variants.product_id',$product->id)->whereNotNull('attrterm_thumb')->groupBy('product_variant_variants.attribute_id','attribute_term_id')->get();
                                    if(count($ProductVariantVariant) > 0){
                                        ?>
                                        <span class="wire_bangle_color wire_bangle_color_img_part text-center wire_bangle_color_ring_part">
                                            <div class="wire_bangle_color_part mb-2">
                                            <?php
                                               // $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms','product_variant')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$product->id)->groupBy('attribute_term_id')->get();
                                                $ia = 1;
                                                foreach($ProductVariantVariant as $productvariants){
                                                    $attributeurl =  URL('product-details/'.$productvariants->slug); 
                                                    ?>
                                                    <span class="form-check d-inline-block">
                                                        <a href="{{ $attributeurl }}">
                                                        <img src="{{ url('images/attrTermThumb/'.$productvariants->attrterm_thumb) }}" alt="{{ $productvariants->attrterm_name }}"  class="wire_bangle_color_img pe-auto" loading="lazy">
                                                        </a>
                                                        <div class="wire_bangle_color_input_label"></div>
                                                    </span>
                                                    <?php        
                                                    $ia++;    
                                                }
                                            ?>
                                            </div>
                                        </span>
                                        <?php
                                    } 
                               
                            ?>
                            <div class="wire_bangle_heading mb-2">
                                {{ $product->primary_category->category_name }}
                                <input type="hidden" class="variant_id" value="{{ $product->variant_id }}">    
                                <input type="hidden" class="item_type" value="0">    
                                <span type="button" class="btn btn-default add-to-wishlist-btn" data-toggle="tooltip" data-placement="right" title="Wishlist">
                                    <?php 
                                        if(is_wishlist($product->variant_id,0)){
                                            ?>
                                            <i class="fas fa-heart heart-icon-part"></i>
                                            <?php 
                                        }else{ 
                                            ?>
                                            <i class="far fa-heart"></i> 
                                            <?php 
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="wire_bangle_sub_heading wire_bangle_description"><a href="{{ $url }}">{{ $product->product_title }}</a></div>
                            <div class="d-flex justify-content-between  align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="wire_bangle_price wire_bangle_price_part">
                                        ${{ $sale_price }}
                                    </span>
                                    
                                     <?php if($product->regular_price != ""){  ?>
                                    <span class="ms-2 wire_bangle_dublicate_price product_detail_regular_price">$<span class="regular_price">{{ $product->regular_price }}</span></span>
                                    <?php } ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $shape_no++;  ?>
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
    <div class="diamond_margin">
        <div class="container">
            <div class="shop_dimond_by_shape">
                <div class="mb-4 mb-md-0 pb-md-5 text-center ">
                    <h2 class="heading-h2 shop_diamond_by_shape_heading">{{ $homesetting->section_diamond_title }}</h2>
                    <div class="sub_title shop_diamond_paragraph">
                        {{ $homesetting->section_diamond_shotline }}
                    </div>
                </div>
                <div>
                    <div class="owl-carousel owl-theme shop-dimond-by-shape-slider">
                        <div class="item">
                            <a href="{{ url('/lab-diamond/round') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/round.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">round</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/oval') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/oval.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">oval</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/princess') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/princess.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">princess</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/cushion') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/cushion.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">cushion</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/marquise') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/marquise.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">marquise</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/pear') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/pear.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">pear</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/radiant') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/radiant.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">radiant</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/heart') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/heart.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">heart</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/emerald') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/emerald.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">emerald</div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ url('/lab-diamond/asscher') }}" class="shop-dimond-by-shape-img">
                                <img src="{{ asset('frontend/image/asscher.png') }}" alt="" loading="lazy">
                                <div class="shop_by_diamond_shpae_name">asscher</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="engagement_ring_section px-0">
        <div class="container engagement_diamond_section">
            <div class="row">
                <div class="col-lg-5 col-xl-4 col-md-5 col-sm-5 pe-lg-4">
                    <div class="engagement_diamond_img">
                        <img src="{{ url('images/steps/'.$step->main_image) }}" alt="" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-7 col-xl-8 col-md-7 col-sm-7 mt-4 mt-sm-0 mt-md-0 mt-lg-0">
                    <h2 class="mb-md-4 heading-h2">{{ strtolower($step->main_title) }}</h2>
                    <p class="engagement_diamond_paragraph_part mb-4">
                        {{ $step->main_shotline }}
                    </p>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-3 mb-lg-5 d-flex d-lg-block align-items-lg-start px-0">
                            <div class="position-relative">
                                <div class="engagement_diamond_box mb-3">
                                    <a href="{{ url('step/'.$step->slug.'/one'); }}"><img src="{{ asset('frontend/image/diamond_1_part.png') }}" alt="" loading="lazy"></a>
                                </div> 
                                <a href="{{ url('step/'.$step->slug.'/one'); }}">
                                    <div class="engagement_diamond_sub_heading mt-0">{{ $step->step1_title }}</div>
                                </a>
                            </div>
                            <div>
                                <p class="customer_stories_paragraph engagement_diamond_paragraph ms-3 ms-lg-0 mb-0">
                                    {{ $step->step1_shotline }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-3 mb-lg-5 d-flex d-lg-block align-items-lg-start px-0">
                            <div class="position-relative">
                                    <div class="engagement_diamond_box mb-3">
                                        <a href="{{ url('step/'.$step->slug.'/two'); }}"><img src="{{ asset('frontend/image/diamond_2_part.png') }}" alt="" loading="lazy"></a>
                                    </div> 
                                    <a href="{{ url('step/'.$step->slug.'/two'); }}"><div class="engagement_diamond_sub_heading mt-0">{{ $step->step2_title }}</div></a>
                            </div>
                            <p class="customer_stories_paragraph engagement_diamond_paragraph ms-3 ms-lg-0 mb-0">
                                {{ $step->step2_shotline }}
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-3 mb-lg-5 d-flex d-lg-block align-items-lg-start px-0">
                            <div class="position-relative">
                                <div class="engagement_diamond_box mb-3">
                                    <a href="{{ url('step/'.$step->slug.'/three'); }}"><img src="{{ asset('frontend/image/diamond_3_part.png') }}" alt="" loading="lazy"></a>
                                </div> 
                                <a href="{{ url('step/'.$step->slug.'/three'); }}"><div class="engagement_diamond_sub_heading mt-0">{{ $step->step3_title }}</div></a>
                            </div>
                            <p class="customer_stories_paragraph engagement_diamond_paragraph ms-3 ms-lg-0 mb-0">
                            {{ $step->step3_shotline }}
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3 mb-md-3 mb-lg-5 d-flex d-lg-block align-items-lg-start px-0">
                            <div class="position-relative">
                                <div class="engagement_diamond_box mb-3">
                                    <a href="{{ url('step/'.$step->slug.'/four'); }}"><img src="{{ asset('frontend/image/diamond_4_part.png') }}" alt="" loading="lazy"></a>
                                </div>
                                <a href="{{ url('step/'.$step->slug.'/four'); }}"><div class="engagement_diamond_sub_heading mt-0">{{ $step->step4_title }}</div></a>
                            </div>
                            <p class="customer_stories_paragraph engagement_diamond_paragraph ms-3 ms-lg-0 mb-0">
                                {{ $step->step4_shotline }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="customise_own_ring_section">
        <div class="row">
            <div class="col-md-6 px-4 engagement_ring_col_part px-0 mt-md-0 py-4 order-2 order-md-1">
                <div class="engagement_ring_diamond_part">
                    <h2 class="heading-h2">{{ $homesetting->section_customise_title }}</h2>
                    <div class="customer_stories_paragraph  mb-3 mb-lg-4">{{ $homesetting->section_customise_description }}</div>
                    <a style="" class="explore-category-btn buy_lab_diamonds_btn black_hover_btn" href="{{ url('shop/'.$homesetting->slug) }}"> {{ $homesetting->section_customise_label }}</a>
                </div>
            </div>
            <div class="col-md-6 pe-0 px-0 order-1 order-md-2">
                <div class="own_ring_img">
                    <img src="{{ url($homesetting->section_customise_image) }}" alt="" width="100%" loading="lazy">
                </div>
            </div>
        </div>
    </div>

    <div class="smiling_gemver_banner">
        <div class="container">
            <h2 class="mb-4 mb-md-5 heading-h2 text-center smiling_gemver_heading">{{ $homesetting->section_smiling_difference_title }}</h2>
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 diff-item-box">
                    <div class="diff-box">
                        <div class="smiling_box_icon mb-2 mb-mb-3 mt-2">
                            <img src="{{ asset('frontend/image/smiling_1.png') }}" alt="" loading="lazy"> 
                        </div>
                        <div class="ms-3 ms-md-0">
                            <div class="smiling_box_heading">
                                {{ $SmilingDifference[0]->title }}   
                            </div>
                            <div class="smiling_box_paragraph">
                                {{ $SmilingDifference[0]->shotline }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 diff-item-box">
                    <div class="diff-box">
                        <div class="smiling_box_icon mb-2 mb-mb-3 mt-2">
                            <img src="{{ asset('frontend/image/smiling_2.png') }}" alt="" loading="lazy"> 
                        </div>
                        <div class="ms-3 ms-md-0">
                            <div class="smiling_box_heading">
                                {{ $SmilingDifference[1]->title }}
                                </div>
                                <div class="smiling_box_paragraph">
                                {{ $SmilingDifference[1]->shotline }}
                            </div>
                       </div>
                   </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 diff-item-box">
                    <div class="diff-box">
                        <div class="smiling_box_icon mb-2 mb-mb-3 mt-2">
                            <img src="{{ asset('frontend/image/smiling_3.png') }}" alt="" loading="lazy"> 
                        </div>
                        <div class="ms-3 ms-md-0">
                            <div class="smiling_box_heading">
                            {{ $SmilingDifference[2]->title }}
                            </div>
                            <div class="smiling_box_paragraph">
                            {{ $SmilingDifference[2]->shotline }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 diff-item-box">
                    <div class="diff-box">
                        <div class="smiling_box_icon mb-2 mb-mb-3 mt-2">
                            <img src="{{ asset('frontend/image/smiling_4.png') }}" alt="" loading="lazy"> 
                        </div>
                       <div class="ms-3 ms-md-0">
                        <div class="smiling_box_heading">
                            {{ $SmilingDifference[3]->title }} 
                            </div>
                            <div class="smiling_box_paragraph">
                            {{ $SmilingDifference[3]->shotline }}
                            </div>
                       </div>
                   </div>
                </div>
            </div>
            <div class="mt-3 text-center">
                <a  class="explore-category-btn btn-hover-effect btn-hover-effect-black diamond-btn buy_lab_diamonds_btn mt-md-4" href="{{ url('gemver-difference') }}">{{ $homesetting->section_smiling_difference_title }}</a>
            </div>
        </div> 
    </div>

    @if(count($BlogBanners) > 0)
        <div class="ads-banner-section">
            <div class="container">
                <h2 class="mb-4 mb-md-5 heading-h2 text-center smiling_gemver_heading">{{ $homesetting->section_blog_banner_title }}</h2>
                <div class="row">
                    @foreach($BlogBanners as $BlogBanner)
                    <?php 
                        $blogcount = count($BlogBanners);
                        $url = "";
                        if($BlogBanner['dropdown_id'] == 1){
                            $category = \App\Models\Category::where('estatus',1)->where('id',$BlogBanner['value'])->first(['slug']);
                            $url = isset($category->slug)?url('shop/'.$category->slug):""; 
                        }elseif($BlogBanner['dropdown_id'] == 2){
                            $Product = \App\Models\Product::where('id',$BlogBanner['value'])->first(['id']);
                            //$cat_id = explode(',',$Product->primary_category_id);
                            //$var_id = $Product->product_variant[0]->id;
                            if(isset($Product->product_variant[0]->slug)){
                                $slug = $Product->product_variant[0]->slug;
                                $url = url('product-details/'.$slug);
                            }
                        }
                        if($blogcount == 1){
                        $blogcol = 12; 
                        }else if($blogcount == 2){
                        $blogcol = 6;
                        }else if($blogcount == 3){
                        $blogcol = 4;    
                        }else if($blogcount == 4){
                        $blogcol = 3;    
                        }else if($blogcount == 5){
                        $blogcol = 2;    
                        }else if($blogcount == 6){
                        $blogcol = 2;    
                        }
                    ?>
                    <div class="col-md-{{ $blogcol }} col-sm-12 banner_part">
                        <a href="{{ $url }}" class="banner_part_img_parent">
                            <figure>
                                <img class="" src="{{ url($BlogBanner['banner_thumb']) }}" alt="" loading="lazy">
                            </figure>
                        </a>
                    </div>
                    @endforeach 
                </div>
            </div>
        </div>
    @endif

    @if(count($testimonials) > 0)
        <div class="testimonial-section">
            <div class="container">
                <div class="customer_stories">
                    <div class="row">
                        <div class="col-lg-5 customer_stories_bg">
                            <div class="">
                                <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-lg-start">{{ $homesetting->section_stories_title }}</h2>
                                <div class="customer_stories_paragraph mb-3 mb-lg-0 text-center text-lg-start mb-3">{{ $homesetting->section_stories_description }}</div>
                                <div class="customer-stories-btn-div">
                                    <a href="{{ url('/infopage/testimonials') }}">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div id="customer-stories" class="owl-carousel owl-theme customer-stories">
                                @foreach($testimonials as $testimonial)
                                    <div class="item">
                                        <div class="customer-stories-quotes">
                                            <div class="customer-stories-paragraph">
                                                {!! $testimonial->description !!}
                                            </div>
                                            <div class="mt-4">
                                                <div class="testimonial-author-img">
                                                    <img src="{{ url('images/testimonials/'.$testimonial->image) }}" alt="{{ $testimonial->name }}" loading="lazy">
                                                </div>
                                                <div class="author-info">
                                                    <div class="customer-name mt-2 mb-1">{{ $testimonial->name }}</div>
                                                    <div class="customer-country">{{ $testimonial->country }}</div>
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
        </div>
    @endif

    @if(count($shopbystyle) > 0)
        <div class="engagement_ring_section shop_by_style_slider shop_by_style_slider_home shop_by_style_slider_part">
            <div class="container">
                <div class="col-md-12 text-center d-flex justify-content-center align-items-center position-relative">
                        <div class="mb-3 mt-md-0">
                            <h2 class="heading-h2">{{ $homesetting->section_shop_by_style_title }}</h2>
                            <div class="sub_title">
                                {{ $homesetting->section_shop_by_style_shotline }}
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-12 text-center   ">
                        <div class="owl-carousel owl-theme shop-by-style-slider">
                            @foreach($shopbystyle as $shopby)
                            <div class="item">
                                <a href="{{ ($shopby->setting)?$shopby->setting:'#' }}" class="engagement_ring_img" target="_blank" >
                                    <img src="{{ url($shopby->image) }}" alt="" loading="lazy">
                                    <div class="shop_by_style_heading text-center">
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
    @endif

    <div class="container">
        <div class="gemver_diamonds_section px-0">
            <div class="px-3">
                <h2 class="heading-h2 text-white heading-h2-yellow-color text-center text-md-start">{{ $homesetting->section_why_gemver_title }}</h2>
                <div class="customer_stories_paragraph mb-3 mb-md-5 text-center text-md-start">{{ $homesetting->section_why_gemver_description }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-md-0 px-0 ps-md-3 position-relative order-2 order-md-1">
                    <div class="gemver_diamods_bg">
                        <div class="diamonds_part">
                            <div class="diamonds_heading mb-3">
                                 {{ $homesetting->section_why_gemver_title1 }}
                            </div>
                            <p class="diamonds_paragraph">{{ $homesetting->section_why_gemver_description1 }}</p>
                            <button type="button"  data-value='{{ ($homesetting->section_why_gemver_button_url1) ? $homesetting->section_why_gemver_button_url1 : '#'; }}'  class="explore-category-btn btn-hover-effect btn-hover-effect-black inquiry_btn_gemver_diamonds customize-button-url">{{ $homesetting->section_why_gemver_button_title1 }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0 px-0 px-md-3 position-relative order-1 order-md-2">
                    <div class="gemver_diamods_bg">
                        <img src="{{ url($homesetting->section_why_gemver_image1) }}" alt="" width="100%" loading="lazy">
                    </div>
                </div>
                <div class="col-md-6 mt-3 px-0 ps-md-3 position-relative order-3">
                    <div class="gemver_diamods_bg">
                        <img src="{{ url($homesetting->section_why_gemver_image2) }}" alt="" width="100%" loading="lazy">
                    </div>
                </div>
                <div class="col-md-6 mt-md-3 px-0 px-md-3 position-relative order-4">
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

                        <div class="modal fade inquiry_now_modal" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content p-3 p-md-4">
                                        <div class="row">
                                            <div class="col-8 col-sm-6 ps-0 text-start">
                                                <!-- <div class="mb-xl-4 mb-3 product_heading">bulk order inquiry</div> -->
                                            </div>
                                            <div class="col-4 col-sm-6 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success" id="success-alert" style="display: none;"></div>
                                        <div class="row">
                                      
                                        <form action="" method="post" id="InquiryCreateForm" name="InquiryCreateForm" class="px-0">
                                        @csrf
                                        
                                        <div class="row mb-4 mb-xxl-4">
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="name" placeholder="your name" class="d-block wire_bangle_input">
                                                <div id="name-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="email" id="email" placeholder="enter your email" class="d-block wire_bangle_input">
                                                <div id="email-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            
                                            <div class="mb-3 col-md-6 ps-0">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <select class="d-block wire_bangle_input form-control" name="country_code_mobile" id="country_code_mobile"> 
                                                            <option value=""></option>
                                                            <option data-countryCode="GB" value="44">Norway (+47)</option>
                                                            <option data-countryCode="US" value="1">UK (+44)</option>
                                                           
                                                        </select>
                                                    </div>
                                                    <input type="text" name="mobile_no" id="mobile_no" placeholder="mobile number" class="d-block form-control">
                                                    <div id="mobile_no-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6 ps-0">
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <select class="" name="country_code_whatsapp" id="country_code_whatsapp"> 
                                                            <option></option>
                                                            <option data-countryCode="GB" value="44">Norway (+47)</option>
                                                            <option data-countryCode="US" value="1">UK (+44)</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="whatsapp number" class="form-control">
                                                    <div id="whatsapp_number-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                                </div>
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

    <div class="Instagram-post-section px-0">
        <h2 class="heading-h2 text-center mb-4">Instagram</h2>
        @if(isset($contents["data"]))
        <div class="owl-carousel owl-theme Instagram-post-slider row mx-0">
           
            @foreach($contents["data"] as $post)
            <?php
                $media_url = isset($post["media_url"]) ? $post["media_url"] : "";
                $permalink = isset($post["permalink"]) ? $post["permalink"] : "";
                $media_type = isset($post["media_type"]) ? $post["media_type"] : ""; 
                $thumbnail_url = isset($post["thumbnail_url"]) ? $post["thumbnail_url"] : ""; 
            ?>
            <a href="{{ $permalink }}" target='_blank'>
            <div class="custom-col item">
                <div class="instafeed_inner">
                    <?php
                    if($media_type=="VIDEO"){
                    
                        echo "<img src='{$thumbnail_url}' style='height:300px;'  />";
                    }
 
                    else{
                        echo "<img src='{$media_url}' style='height:300px;'  />";
                    }
                    ?>
                    
                </div>
            </div>
            </a>
            @endforeach
            
        </div>
        @else
            <div class="text-center"> No Post Found</div>
        @endif
    </div>
  
@include('frontend.layout.footer')
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/slick.js') }}"></script>   
<script src="{{ asset('frontend/js/all.min.js') }}"></script>   
<script src="{{ asset('frontend/js/jquery.cookie.min.js') }}"></script>   
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>   

<script>    
    $(document).ready(function(){
        $(document).on('click','.banner-url',function(){
            var banner_url = $(this).attr("data-value");
            window.location.href = banner_url;
        });

        $(document).on('click','.customize-button-url',function(){
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
                        if (res.errors.whatsapp_number) {
                            $('#whatsapp_number-error').show().text(res.errors.whatsapp_number);
                        } else {
                            $('#whatsapp_number-error').hide();
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
                        $('#whatsapp_number-error').hide();
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

        $('#exampleModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
            $(this).find("#save_newInquiryBtn").removeAttr('data-action');
            $(this).find("#save_closeInquiryBtn").removeAttr('data-action');
            $(this).find("#save_newInquiryBtn").removeAttr('data-id');
            $(this).find("#save_closeInquiryBtn").removeAttr('data-id');

            $('#inquiry-error').hide();
            $('#mobile_no-error').hide();
            $('#whatsapp_number-error').hide();
            $('#email-error').hide();
            $('#name-error').hide();
        });

        $("#main_search").keyup(function() {
            search_data($(this).val());
        });

        function search_data(keyword)
        {
        
            var action = "search";
            $.ajax({
            // url:"{{ url('/product-filter') }}",
            // url: ENDPOINT + "/search_products",
                url:"{{ url('/search_products') }}",
                method:"POST",
                data:{action:action,keyword:keyword,_token: '{{ csrf_token() }}'},
                beforeSend: function() {
                    $('.serach-load').show();
                },
                success:function(response){
                    if(response != ""){
                        $('#mega-menu-scrollbar').show();
                        $('.main_search_section').html(response);
                        $('.serach-load').hide(); 
                    }else{
                        $('#mega-menu-scrollbar').hide();
                        $('.main_search_section').html(response);
                        $('.serach-load').hide();   
                    }
                    // if(scroll == 1){
                    //     if (response['artilces'] == "") {
                    //         $('.auto-load').html("We don't have more data to display ");
                    //         return;
                    //     }
                    //     $('.auto-load').hide();   
                    //     $("#data-wrapper").append(response['artilces']);
                    // }else{
                    //     if (response['artilces'] == "") {
                    //         $('#data-wrapper').html("No Result Found");
                    //         $('.auto-load').hide();
                    //         return;
                    //     }
                    //     $("#data-wrapper").html(response['artilces']);  
                    //     $('.auto-load').hide(); 
                    // }  
                    
                }
            });
        }

        $('body').on('click', '#searchBtn', function () {
            var main_search = $("#main_search").val();
            location.href = "{{ url('shop') }}?s="+main_search;
        });

        $('#country_code_mobile').select2({
            width: '100%',
            placeholder: "Select Country Code",
            allowClear: false
        });

        $('#country_code_whatsapp').select2({
            width: '100%',
            placeholder: "Select Country Code",
            allowClear: false
        });

    });
</script>


</body>
</html>

