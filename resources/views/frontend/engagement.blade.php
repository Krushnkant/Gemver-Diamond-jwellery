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
            <div class="engagement_button">
                <button  id="settingProductBtn" class="engagement_start_diamond" data-id="{{ $MenuPage->category_id }}">{{ $MenuPage->main_first_button_name }}</button>
                <button  class="engagement_start_setting ms-2 ms-md-3" id="settingDiamondBtn" data-id="{{ $MenuPage->category_id }}">{{ $MenuPage->main_second_button_name }}</button>
            </div>
        </div>
    </div> -->
</div>
<div class="container">
    <div class="choose_your_setting_section">
        <div class="choose_your_setting_heading text-center mb-3 mb-md-4 mb-lg-5">
            Choose Your Setting  Style
        </div>
        <div class="owl-carousel owl-theme engagement-section">
                @if($MenuPage->menupageshapestyle)
                @foreach($MenuPage->menupageshapestyle as $menupageshapestyle)
                <div class="item">
                    <div class="text-center mb-3 choose_your_setting_col" id="shopProductBtn" data-id="{{ $menupageshapestyle->category_id }}">
                        <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                        <div class="choose_sub_heading mt-3 ">
                            {{ $menupageshapestyle->title }}
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
        </div>
        <!-- <div class="row ">
            @if($MenuPage->menupageshapestyle)
            @foreach($MenuPage->menupageshapestyle as $menupageshapestyle)
            <div class="col-6 col-sm-4 col-md-4 col-lg-2 text-center mb-3 choose_your_setting_col" id="shopProductBtn" data-id="{{ $menupageshapestyle->category_id }}">
                <img src="{{ url('images/shopstyle_image/'.$menupageshapestyle->image) }}" alt="">
                <div class="choose_sub_heading mt-3 ">
                    {{ $menupageshapestyle->title }}
                </div>
            </div>
            @endforeach
            @endif
            
        </div> -->
    </div>
</div>


<div class="shop_dimond_by_shape1 choose_your_setting_section pt-0">
        <div class="container">
            <div class="">
                <div class="choose_your_setting_heading text-center mb-2 mb-lg-3">{{ $MenuPage->section2_title }}</div>
                {{-- <div class="choose_your_setting_paragraph text-center mb-3 mb-md-4 mb-xl-5">
                    Whatever the occasion, we've got a beatiful piece of jewellery for you.
                </div> --}}
            </div>
            <div>
                <div class="owl-carousel owl-theme products_item">
                    
                <?php 
                    $shape_no = 1;
                    $supported_video = array(
                        'mov',
                        'mp4',
                        '3gp'
                    );
                    $index = 0;
                    
                ?>
                    @foreach($products as $product) 
                     
                    <?php
                    
                        $video_array = array();
                        $images_array = array();
                        $images = explode(",",$product->images);
                        foreach($images as $key => $value){
                        $ext = pathinfo($value, PATHINFO_EXTENSION);
                        if(in_array($ext, $supported_video)){
                            $video_array[] = $value;
                        }else{
                            $images_array[] = $value;
                        } 
                        //dump($index);
                        }
                        $new_array = array_merge($video_array,$images_array);   
                        $image = URL($new_array['0']);
                        $sale_price = $product->sale_price;
                        $url =  URL('/product-details/'.$product->id.'/'.$product->variant_id); 
                        $supported_image = array(
                        'jpg',
                        'jpeg',
                        'png'
                        );
                     
                    
                    ?>
                    <div class="hover_effect_part wire_bangle_shop_radio product-data mt-0">
                    <div class="wire_bangle_img_radio_button">
                        <div class="wire_bangle_img mb-3 position-relative">
                            <a class="wire_bangle_hover_a" href="{{ $url }}">
                                <?php 
                                   $ext = pathinfo($image, PATHINFO_EXTENSION); 
                                   if(in_array($ext, $supported_image)) {  
                                ?>
                                
                                <img src="{{ $image }}" alt="">
                                <?php }else{ ?>
                                   
                                    <video  loop="true" autoplay="autoplay"  muted style="width:100%; height:200px;" name="media"><source src="{{ $image }}" type="video/mp4"></video>
                                <?php } ?>
                            </a>
                        </div>
                        <div class="wire_bangle_description p-3"><div class="wire_bangle_heading mb-2">{{ $product->primary_category->category_name }}
                        <input type="hidden" class="variant_id" value="{{ $product->variant_id }}">    
                        <input type="hidden" class="item_type" value="0">    
                        <span type="button" class="btn btn-default add-to-wishlist-btn" data-toggle="tooltip" data-placement="right" title="Wishlist">
                            <?php 
                            if(is_wishlist($product->variant_id,0)){
                            ?>
                                <i class="fas fa-heart text-danger"></i>
                            <?php }else{ ?>
                                <i class="far fa-heart"></i> 
                            <?php }
                            ?>
                        </span>
                        </div>
                            <div class="wire_bangle_sub_heading wire_bangle_description"><a href="{{ $url }}">{{ $product->product_title }}</a></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="wire_bangle_price wire_bangle_price_part">
                                        $ {{ $sale_price }}
                                    </span>
                                    
                                     <?php if($product->regular_price != ""){  ?>
                                    <span class="ms-2 wire_bangle_dublicate_price product_detail_regular_price">$<span class="regular_price"> {{ $product->regular_price }}</span></span>
                                    <?php } ?>
                                </div>

                                <?php 
                                $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$product->id)->groupBy('attribute_id')->get();
                                foreach($ProductVariantVariant as $productvariants){
                                if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                                ?>
                                <span class="wire_bangle_color mb-xxl-0 wire_bangle_color_img_part text-center wire_bangle_color_ring_part d-inline-block"><div class="wire_bangle_color_part">
                                <?php
                                    $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$product->id)->groupBy('attribute_term_id')->get();
                                    $ia = 1;
                                    foreach($product_attribute as $attribute_term){
                                        $attributeurl =  URL('/product-details/'.$product->id.'/'.$attribute_term->product_variant_id); 
                                     ?>
                                    <span class="form-check d-inline-block">
                                        <a href="{{ $attributeurl }}">
                                        <img src="{{ url('images/attrTermThumb/'.$attribute_term->attribute_terms[0]->attrterm_thumb) }}" alt="{{ $attribute_term->attribute_terms[0]->attrterm_name }}"  class="wire_bangle_color_img pe-auto">
                                        </a>
                                        <div class="wire_bangle_color_input_label"></div>
                                    </span>
                                <?php        
                                    $ia++;    
                                }
                                ?>
                                </div></span>
                                <?php
                                    } 
                                }
                                ?>
                                
                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $shape_no++;  ?>
                    @endforeach 
                    
                </div>
            </div>
            <div class="text-center mt-3 mt-xl-5">
                <a  class="explore-category-btn btn-hover-effect btn-hover-effect-black diamond-btn buy_lab_diamonds_btn view_all_rings_btn">View All Rings</a>
            </div>
        </div>
    </div>

<div class="container engegement_ring_box_part">
    <div class="row two_part_box_section">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="choose_your_setting_box text-center">
                <div class="">
                    <div class="custom_made_heading text-center mb-0 mb-xl-3">
                        {{ $MenuPage->section1_title }}
                    </div>
                    <p class="custom_engagement_paragrph">
                        {{ $MenuPage->section1_description }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 design_engagemnt_image">
            <img src="{{ url('images/aboutus/'.$MenuPage->section1_image) }}" alt="">
        </div>  
    </div>
</div>


<div class="create_your_own_section mb-5 my-md-5">
   <div class="container">
    <div class="row">
            <div class="col-md-12">
                <div class="choose_your_setting_heading text-center mb-5">
                    {{ $MenuPage->section3_title }}
                </div>
                <div class="row">
                    <div class="col-md-4 position-relative create_your_own_icon">
                        <div class="create_your_own_image">
                            <img src="{{ url('images/aboutus/'.$MenuPage->section31_image) }}" alt="">
                        </div>
                        <div class="text-center create_your_own_heading mb-3">
                            {{ $MenuPage->section31_title }}
                        </div>
                        <p class="create_your_own_paragraph">
                            {{ $MenuPage->section31_description }}
                        </p>
                        <div class="create_your_own_icon_part">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="32" viewBox="0 0 31 32" fill="none">
                                <path d="M30.0254 12.416V19.3008H0.787109V12.416H30.0254ZM19.127 0.667969V31.7227H11.7148V0.667969H19.127Z" fill="#0B1727"/>
                            </svg>
                        </div>
                    </div>
                   
                    <div class="col-md-4 position-relative">
                        <div class="create_your_own_image">
                            <img src="{{ url('images/aboutus/'.$MenuPage->section32_image) }}" alt="">
                        </div>
                        <div class="text-center create_your_own_heading mb-3">
                            {{ $MenuPage->section32_title }}
                        </div>
                        <p class="create_your_own_paragraph">
                            {{ $MenuPage->section32_description }}
                        </p>
                        <div class="create_your_own_icon_part">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="20" viewBox="0 0 26 20" fill="none">
                                <path d="M25.9414 0.318359V6.55859H0.0722656V0.318359H25.9414ZM25.9414 12.8574V19.0977H0.0722656V12.8574H25.9414Z" fill="#0B1727"/>
                            </svg>
                        </div>
                    </div>
                   
                    <div class="col-md-4 position-relative">
                        <div class="create_your_own_image">
                            <img src="{{ url('images/aboutus/'.$MenuPage->section33_image) }}" alt="">
                        </div>
                        <div class="text-center create_your_own_heading mb-3">
                            {{ $MenuPage->section33_title }}
                        </div>
                        <p class="create_your_own_paragraph">
                            {{ $MenuPage->section33_description }}
                        </p>
                    </div>
                </div>
            </div>  
        </div>
   </div>
</div>

<div class="container pb-5">
    <div class="row two_part_box_section">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="choose_your_setting_box text-center">
                <div class="">
                    <div class="custom_made_heading text-center mb-0 mb-xl-3">
                        {{ $MenuPage->section4_title }}
                    </div>
                    <p class="custom_engagement_paragrph">
                        {{ $MenuPage->section4_description }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 design_engagemnt_image">
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

    $('body').on('click', '#shopProductBtn', function () {
        var category_id = $(this).attr('data-id');
        var url = "{{ url('shop/') }}" + "/" + category_id;
        window.open(url,"_blank");
    });

});
</script>
@endsection