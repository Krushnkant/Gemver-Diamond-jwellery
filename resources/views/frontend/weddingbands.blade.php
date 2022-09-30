@extends('frontend.layout.layout')

@section('content')

<div class="engagement_bg_slider">
    <img src="{{ asset('frontend/image/engagement-bg.png') }}" alt="">
    <div class="container engagement_text_part">
        <div class="engagement_text_part">
            <h1 class="heading-h1 engagement_heading text-start mb-3">Wedding Bands</h1>
            <p class="engagement_paragraph mb-4">
                A wedding band is a symbol of commitment; a
                promise, a pledge, and a vow.
            </p>
        </div>
    </div>
</div>
<div class="container">
    <div class="choose_your_setting_section">
        <div class="choose_your_setting_heading text-center mb-2 mb-md-3">
            Choose Your Setting Style
        </div>
        <p class="choose_your_setting_paragraph text-center mb-3 mb-md-4 mb-xl-5">
            Whatever the occasion, we've got a beatiful piece of jewellery for you.
        </p>

        <div class="row">
            <div class="col-sm-4 col-md-4 col-xl-2 text-center mb-3 mb-xl-0">
                <img src="{{ asset('frontend/image/ring_setting_1.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Solitaire
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-xl-2 text-center mb-3 mb-xl-0">
                <img src="{{ asset('frontend/image/ring_setting_2.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Halo
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-xl-2 text-center mb-3 mb-xl-0">
                <img src="{{ asset('frontend/image/ring_setting_3.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Three Stone
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-xl-2 text-center mb-3 mb-xl-0">
                <img src="{{ asset('frontend/image/ring_setting_4.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Vintage
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-xl-2 text-center mb-3 mb-xl-0">
                <img src="{{ asset('frontend/image/ring_setting_5.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Bridal Sets
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-xl-2 text-center mb-3 mb-xl-0">
                <img src="{{ asset('frontend/image/ring_setting_5.png') }}" alt="">
                <div class="choose_sub_heading mt-3">
                    Bridal Sets
                </div>
            </div>
        </div>
    </div>
</div>

<div class="create_your_own_section custom_made_wedding_bands_section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="text-center">
                    <div class="">
                        <div class="choose_your_setting_heading text-center text-center mb-3 mb-xl-3">
                            Custom-Made Wedding Bands
                        </div>
                        <p class="custom_engagement_paragrph custom_made_paragraph">  
                            Design your perfect wedding band. Select from our range of wedding bands styles, customise it with diamonds, the precious metal of your choice and preferred metal finishing.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <img src="{{ asset('frontend/image/wedding_bands.png') }}" alt="">
            </div>  
        </div>
    </div> 
</div>


    <div class="shop_dimond_by_shape1 choose_your_setting_section">
        <div class="container">
            <div class="">
                <div class="choose_your_setting_heading text-center mb-2 mb-lg-3">Top Selling Wedding Bands</div>
                <div class="choose_your_setting_paragraph text-center mb-3 mb-md-4 mb-xl-5">
                    Whatever the occasion, we've got a beatiful piece of jewellery for you.
                </div>
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
                                <i class="fas fa-heart"></i>
                            <?php }else{ ?>
                                <i class="far fa-heart"></i> 
                            <?php }
                            ?>
                        </span>
                        </div>
                            <div class="wire_bangle_sub_heading wire_bangle_description"><a href="{{ $url }}">{{ $product->product_title }}</a></div>
                            <div class="d-flex justify-content-between  align-items-center">
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
        </div>
    </div>


<div class="container mb-5 pb-5">
    <div class="row">
        <div class="col-md-6 order-2 order-md-1">
            <div class="choose_your_setting_box text-center">
                <div class="">
                    <div class="custom_made_heading text-center mb-2 mb-xl-3">
                        Ready to Ship
                    </div>
                    <p class="custom_engagement_paragrph">
                        Ready to ship brings you engagement ring you
                        can get when you are in a rush.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 order-1 order-md-2 mb-3 mb-md-0">
            <img src="{{ asset('frontend/image/ready_to_ship.png') }}" alt="">
        </div>  
    </div>
</div>

@endsection