@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="position-relative">
                <img src="{{asset('frontend/image/about_us.png') }}" alt="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">{{ $Product->product_title }}</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">product detail</a>
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#"> Bracelets</a> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">{{ $Product->product_title }}</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="wire_bangle_page container">
        <div class="row" >
            <div class="col-md-6 wire_bangle_padding mb-4" id="vimage">
                <div class="slider slider-single mb-5">
                    <?php 
                    foreach($Product->product_variant as $variant){
                        $images = explode(",",$variant->images);
                        foreach($images as $image){
                    ?>
                    <div class="product_slider_main_item">
                        <img src="{{ URL($image) }}" alt="">
                    </div>     
                    <?php 
                        }
                    }
                    ?> 
                </div>
                <div class="slider slider-nav">
                <?php 
                    foreach($Product->product_variant as $variant){
                        $images = explode(",",$variant->images);
                        foreach($images as $image){
                    ?>
                    
                    <div class="product_slider_item">
                        <h3><img src="{{ URL($image) }}" alt=""></h3>
                    </div>    
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6 wire_bangle_padding_2">
                <div class="wire_bangle_content">
                    <div class="">
                        
                        <div class="wire_bangle_heading mb-2 mb-xl-4 pb-xxl-2">{{ $Product->product_title }}</div>
                        <div class="d-flex mb-2 mb-xl-4 pb-xxl-2">
                            <span class="wire_bangle_price ">$<span class="sale_price">{{ $Product->product_variant['0']->sale_price }} </span>
                                @if($Product->product_variant['0']->regular_price != '' || $Product->product_variant['0']->regular_price != 0 )
                                <sub class="ms-2 wire_bangle_dublicate_price ">$<span class="regular_price"> {{ $Product->product_variant['0']->regular_price }} </span></sub>
                                @endif
                            </span>
 
                        </div>

                        <p class="blog_box_paragraph mb-xl-4">{!! Str::limit($Product->desc, 170, ' ...<a style="color: #BB9761;" href="#description">Read More </a>');  !!}</p>
                        <div class="d-flex mb-md-4 flex-wrap mb-3 mb-md-0">
                            <span class="wire_bangle_input">
                                <div class="wire_bangle_number number-input">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                    <input class="qty" min="0" placeholder="0" name="qty" id="qty" value="1" type="number">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                </div>
                            </span>
                            <span class="inquiry_now_btn ms-3 ms-md-5">
                                <button class="select_setting_btn diamond-btn" type="button" >inquiry now</button>
                                <div id="inquiry-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </span>
                            <div class="modal fade inquiry_now_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col-6 ps-0 text-start">
                                                <div class="mb-xl-4 mb-3 product_heading">product inquiry</div>
                                            </div>
                                            <div class="col-6 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success" id="success-alert" style="display: none;">
                                        </div>
                                        <div class="row" id="variantstr"> 
                                        </div>
                                        <div class="row" id="specificationstr"> 
                                        </div>
                                        <form action="" method="post" id="InquiryCreateForm" name="InquiryCreateForm">
                                        @csrf
                                        <input type="hidden" class="d-block mb-3 wire_bangle_input" id='SKU' name="SKU" value="">
            
                                        <div class="row mb-0">
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="name" placeholder="your name" class="d-block wire_bangle_input">
                                                <div id="name-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="mobile_no" id="mobile_no" placeholder="phone" class="d-block wire_bangle_input">
                                                <div id="mobile_no-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="email" id="email" placeholder="username123@gmail.com" class="d-block wire_bangle_input">
                                                <div id="email-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-12 ps-0 mb-3">
                                                <textarea  name="inquiry" id="inquiry" class="d-block wire_bangle_input" placeholder="Message"></textarea>
                                                <!-- <input type="text" name="inquiry" id="inquiry" placeholder="Message" class="d-block wire_bangle_input"> -->
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
                        <form action="" class="mb-4 mb-lg-5" >
                            <input type="hidden" value="{{ $Product->id }}" name="product_id" id="product_id">
                           
                           <!-- <?php
                            $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$Product->id)->groupBy('attribute_id')->get();
                            foreach($ProductVariantVariant as $productvariants){
                               // $categories = \App\Models\Attribute::where('estatus',1)->where('id',$Product->id)->get();
                             if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                            ?>
                            <div class="col-md-6 wire_bangle_padding mb-4">{{ $productvariants->attribute->attribute_name }}</div>
                                <div class="wire_bangle_color mb-xxl-0 pb-md-2 wire_bangle_color_img_part">
                                <?php 
                                $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$Product->id)->groupBy('attribute_term_id')->get();
                                $ia = 1;
                                ?>    
                                @foreach($product_attribute as $attribute_term)
                                
                                    <span class="form-check d-inline-block">
                                        <input class="form-check-input variant variantfirst"  {{ (in_array( $attribute_term->attribute_terms[0]->id , $attribute_term_ids)) ? "checked" : ""  }} value="{{ $attribute_term->attribute_terms[0]->id }}"  type="radio" name="AtributeVariant{{ $productvariants->attribute->attribute_name }}" id="" title="{{ $attribute_term->attribute_terms[0]->attrterm_name }}">
                                        <img src="{{ url('images/attrTermThumb/'.$attribute_term->attribute_terms[0]->attrterm_thumb) }}" alt="{{ $attribute_term->attribute_terms[0]->attrterm_name }}"  class="wire_bangle_color_img">
                                        <div class="wire_bangle_color_input_label"></div>
                                    </span>
                                <?php $ia++ ?>    
                                @endforeach
                            </div>
                            <?php 
                                }else{ 
                               
                            ?>
                                
                            <?php 
                               } 
                            }  
                            ?> -->

                            <?php
                            $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$Product->id)->groupBy('attribute_id')->get();
                            foreach($ProductVariantVariant as $productvariants){
                               // $categories = \App\Models\Attribute::where('estatus',1)->where('id',$Product->id)->get();
                             if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                            ?>
                            <div class="wire_bangle_color_heading mb-2">{{ $productvariants->attribute->attribute_name }}</div>
                                <div class="wire_bangle_color mb-xxl-4 pb-md-2 wire_bangle_color_img_part">
                                <?php 
                                $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$Product->id)->groupBy('attribute_term_id')->get();
                                $ia = 1;
                                ?>    
                                @foreach($product_attribute as $attribute_term)
                                    <span class="form-check d-inline-block">
                                        <input class="form-check-input variant"  {{ $ia == "1" ? "checked" : ""  }} value="{{ $attribute_term->attribute_terms[0]->id }}"  type="radio" name="AtributeVariant{{ $productvariants->attribute->attribute_name }}" id="" title="{{ $attribute_term->attribute_terms[0]->attrterm_name }}">
                                        <img src="{{ url('images/attrTermThumb/'.$attribute_term->attribute_terms[0]->attrterm_thumb) }}" alt="{{ $attribute_term->attribute_terms[0]->attrterm_name }}"  class="wire_bangle_color_img">
                                        <div class="wire_bangle_color_input_label"></div>
                                    </span>
                                <?php $ia++ ?>    
                                @endforeach
                            </div>
                            <?php 
                            }else{ 
                             $iv = 1;
                            ?>
                                <div class="wire_bangle_color_heading mb-2">{{ $productvariants->attribute->attribute_name }}</div>
                                <div class="wire_bangle_carat">
                                <?php 
                                 $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$Product->id)->groupBy('attribute_term_id')->get();
                                ?>    
                                @foreach($product_attribute as $attribute_term)
                                <span class="form-check d-inline-block position-relative me-2  ps-0 mb-3">
                                        <input class="form-check-input variant" {{ $iv == "1" ? "checked" : ""  }} value="{{ $attribute_term->attribute_terms[0]->id }}"  type="radio" name="AtributeVariant{{ $productvariants->attribute->attribute_name }}" id="AtributeVariant{{ $attribute_term->attribute_terms[0]->id }}">
                                        <label class="form-check-label wire_bangle_carat_label" for="AtributeVariant{{ $attribute_term->attribute_terms[0]->id }}">
                                        {{ $attribute_term->attribute_terms[0]->attrterm_name }}
                                    </label>
                                    </span>
                                    <?php $iv++ ?>    
                                @endforeach    
                                
                            </div>
                            <?php 
                               } 
                            }  
                            ?>


                            <div class="variantmulti" id="variantmulti">

                            </div>
                            <div class="mb-4 " id="speci_multi">
                            </div>
                            <!--<button class="select_setting_btn btn-hover-effect btn-hover-effect-black diamond-bt">select setting</button>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-xl-0 pt-xxl-0 mb-xxl-4" id="description">
            <div class="col-md-2">
                <div class="description_heading">
                    description
                </div>
            </div>
            <div class="col-md-10">
                <p class="description_paragraph">{{ $Product->desc }}</p>
            </div>
        </div>
        <div class="accordion wire_bangle_accordion detailsspeci" id="accordionExample">
            <div class="accordion-item">
                <div class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                         Details
                    </button>
                </div>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row" id="specification">
                            <?php
                            $product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$Product->product_variant[0]->id)->groupBy('attributes.id')->get();
                            foreach($product_attributes_specification as $product_attribute_specification){  
                                $product_attribute_terms = explode(',',$product_attribute_specification->attribute_term_id);
                                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                                $product_attribute_term_name = implode(' - ',$product_attributes_term_val);
                            ?>

                            <div class="col-md-6 px-0" >
                                <div class="mt-4 wire_bangle_share">
                                    {{ $product_attribute_specification->attribute_name }} &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $product_attribute_term_name }}</span>
                                </div>
                            </div>

                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="gemver_diamonds_section p-0" id="spe_desc">
          
        </div>

        <div class="order-includes-heading mb-md-3 mb-xl-4 mb-2 px-3 mt-4 mt-md-4 text-center text-xl-start d-block d-xl-none">
            Your Order Includes
        </div>

        <div class="row mt-md-0 mt-xl-5 align-items-center">
                <div class="col-md-6 col-lg-4 pe-4">
                    <div class="order-include-img">
                        <img src="{{ url('frontend/image/order-includes.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-8 col-lg-6">
                    <div class="order-includes-heading mb-lg-4 mb-2 px-3 mt-lg-3 mt-2 text-center text-lg-start d-none d-xl-block">
                        Your Order Includes
                    </div>
                    <div class="row mt-4 mt-md-0">
                        <div class="col-lg-6 order-box-part mb-3 px-0 px-md-3">
                            <div class="order-box">
                            <span class="order-img">
                                <img src="{{ url('frontend/image/order_1.png') }}" alt="">   
                            </span>
                            <span class="order-text text-start">
                                    Qulity packaging
                            </span>
                            </div>    
                        </div>
                        <div class="col-lg-6 order-box-part mb-3 px-0 px-md-3">
                            <div class="order-box">
                            <span class="order-img">
                                <img src="{{ url('frontend/image/order_2.png') }}" alt="">   
                            </span>
                            <span class="order-text text-start">
                                    Free Shipping
                            </span>
                            </div>   
                        </div>
                        <div class="col-lg-6 order-box-part mb-3 px-0 px-md-3">
                            <div class="order-box">
                            <span class="order-img">
                                <img src="{{ url('frontend/image/order_3.png') }}" alt="">   
                            </span>
                            <span class="order-text text-start">
                                    30 Days free returns
                            </span>
                            </div>    
                        </div>
                        <div class="col-lg-6 order-box-part mb-3 px-0 px-md-3">
                            <div class="order-box">
                            <span class="order-img">
                                <img src="{{ url('frontend/image/order_4.png') }}" alt="">   
                            </span>
                            <span class="order-text text-start">
                                    Valuation certificate
                            </span>
                            </div>      
                        </div>
                        <div class="col-lg-6 order-box-part mb-3 px-0 px-md-3">
                            <div class="order-box">
                            <span class="order-img">
                                <img src="{{ url('frontend/image/order_5.png') }}" alt="">   
                            </span>
                            <span class="order-text text-start">
                                    Lifetime warrenty
                            </span>
                            </div>      
                        </div>
                        <div class="col-lg-6 order-box-part mb-3 px-0 px-md-3">
                            <div class="order-box">
                            <span class="order-img">
                                <img src="{{ url('frontend/image/order_6.png') }}" alt="">   
                            </span>
                            <span class="order-text text-start">
                                    Concierge Service
                            </span>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @if(count($ProductRelated) > 0)
    <div class="container">
        <div class="shop_by_category">
            <div class="row">
                <div class="col-md-12 text-center d-flex justify-content-center align-items-center position-relative">
                    <div>
                        <h2 class="heading-h2 mb-xl-5 mb-3 mt-md-0">Related Product </h2>
                    </div>
                    <!-- <div class="category-line-img d-none d-md-block">
                        <img src="{{ asset('frontend/image/category-line.png') }}" alt="">
                    </div> -->
                </div>
                <div class="owl-carousel owl-theme product-detail mb-5">
                    @foreach($ProductRelated as $Related)
                    <?php
                   // dd($ProductRelated);
                     $images = explode(",",$Related->images);
                     $image = URL($images['0']);
                     $sale_price = $Related->sale_price;
                     $url =  URL('/product-details/'.$Related->id.'/'.$Related->variant_id); 
                    
                    ?>
                    <div class="hover_effect_part wire_bangle_shop_radio">
                    <div class="wire_bangle_img_radio_button">
                        <div class="wire_bangle_img mb-3 position-relative">
                            <a class="wire_bangle_hover_a" href="{{ $url }}"><img src="{{ $image }}" alt=""></a>
                        </div>
                        <div class="wire_bangle_description p-3"><div class="wire_bangle_heading mb-2">{{ $Related->primary_category->category_name }}</div>
                            <div class="wire_bangle_sub_heading wire_bangle_description"><a href="{{ $url }}">{{ $Related->product_title }}</a></div>
                            <div class="d-flex justify-content-between pt-2 align-items-center">
                                <span class="wire_bangle_price wire_bangle_price_part">
                                    $ {{ $sale_price }}
                                </span>
                                <?php 
                                $ProductVariantVariant = \App\Models\ProductVariantVariant::with('attribute','attribute_terms')->where('estatus',1)->where('product_id',$Related->id)->groupBy('attribute_id')->get();
                                foreach($ProductVariantVariant as $productvariants){
                                if($productvariants->attribute_terms['0']->attrterm_thumb != ''){
                                ?>
                                <span class="wire_bangle_color mb-xxl-0 wire_bangle_color_img_part text-center wire_bangle_color_ring_part d-inline-block"><div class="wire_bangle_color_part">
                                <?php
                                    $product_attribute = \App\Models\ProductVariantVariant::with('attribute_terms')->where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_id',$Related->id)->groupBy('attribute_term_id')->get();
                                    $ia = 1;
                                    foreach($product_attribute as $attribute_term){
                                ?>
                                    <span class="form-check d-inline-block">
                                        <input class="form-check-input variant variantfirst"   value="{{ $attribute_term->attribute_terms[0]->id }}"  type="radio" name="AtributeVariant{{ $productvariants->attribute->attribute_name }}" id="" title="{{ $attribute_term->attribute_terms[0]->attrterm_name }}">
                                        <img src="{{ url('images/attrTermThumb/'.$attribute_term->attribute_terms[0]->attrterm_thumb) }}" alt="{{ $attribute_term->attribute_terms[0]->attrterm_name }}"  class="wire_bangle_color_img">
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
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
    @endif

    <div>
   
<script> 



$(document).ready(function(){

    //filter_data_variant();
    filter_data();
    
    function filter_data_variant1()
    {
        var action = 'fetch_data';
        var variant = get_filter('variant');
        var product_id = $('#product_id').val();
        var terms_id = <?php echo json_encode($attribute_term_ids); ?>;
        $.ajax({
            url:"{{ url('/product-details-variants') }}",
            method:"POST",
            data:{action:action,variant:variant,terms_id:terms_id,product_id:product_id,_token: '{{ csrf_token() }}'},
            success:function(data){ 
            $('#variantmulti').html(data.variantmulti);
              filter_data();  
            }
        }); 
    }


    
    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var variant = get_filter('variant');
        var product_id = $('#product_id').val();
        $.ajax({
            url:"{{ url('/product-details-filter') }}",
            method:"POST",
            data:{action:action,variant:variant,product_id:product_id,_token: '{{ csrf_token() }}'},
            success:function(data){
                //console.log(data);
                if(data.result == 'data not found'){
                    $("#inquiry-error").html("product not available");
                    $("#inquiry-error").show();
                    $(".select_setting_btn").prop('disabled', true);
                }else{
                    $("#inquiry-error").html("");
                    $("#inquiry-error").hide();
                    $(".select_setting_btn").prop('disabled', false);

                    $('.sale_price').html(data.result.sale_price);
                    $('.regular_price').html(data.result.regular_price); 
                    $('#SKU').val(data.result.SKU);
                    if(data.speci != ""){
                        $(".detailsspeci").show();
                        $('#specification').html(data.speci);
                    }else{
                        $(".detailsspeci").hide();
                    }
                    
                    $('#speci_multi').html(data.speci_multi);
                    $('#vimage').html(data.vimage);
                    $('#spe_desc').html(data.spe_desc);
                    $('#variantstr').html(data.variantstr);
                
                    selectjs();
                    sliderjs();
                } 
            }
        });
    }
    
    function selectjs(){ 
    $('select').each(function() {
        var $this = $(this),
        numberOfOptions = $(this).children('option').length;

        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
            //if ($this.children('option').eq(i).is(':selected')){
            //  $('li[rel="' + $this.children('option').eq(i).val() + '"]').addClass('is-selected')
            //}
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function() {
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
            //console.log($this.val());
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });

      });
    }

    function sliderjs(){ 
        $('.slider-single').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            nav: false,
            fade: false,
            adaptiveHeight: true,
            infinite: false,
            useTransform: true,
            speed: 400,
            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        });
        $('.slider-nav')
        .on('init', function(event, slick) {
            $('.slider-nav .slick-slide.slick-current').addClass('is-active');
        })
        .slick({
            slidesToShow: 5,
            slidesToScroll: 5,
            dots: false,
            nav: false,
            focusOnSelect: false,
            infinite: false,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                }
            }, {
                breakpoint: 575,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                }
            }]
        });
        $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
            $('.slider-nav').slick('slickGoTo', currentSlide);
            var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
            $('.slider-nav .slick-slide.is-active').removeClass('is-active');
            $(currrentNavSlideElem).addClass('is-active');
        });

        $('.slider-nav').on('click', '.slick-slide', function(event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data('slick-index');

            $('.slider-single').slick('slickGoTo', goToSingleSlide);
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
    //$('.variant').click(function(){
    $('body').on('click', '.variant', function () {    
        filter_data();
    });

    $('body').on('click', '.variantfirst', function () {    
        //filter_data_variant();
    });

});




</script>


<script type="text/javascript">
$( document ).ready(function() {
    
$('body').on('click', '.select_setting_btn', function () {
    var valid = false;
    var arrspe = [];
    $('#specificationstr').html('');
    $(document).find('.specification').each(function() {
        var thi = $(this);
        var this_err = $(thi).attr('name') + "-error";
        if($(thi).val()=="" || $(thi).val()==null){
            $("#"+this_err).html("Please select any value");
            $("#"+this_err).show();
            valid = false;
        }else{
            var element = $(this).find('option:selected'); 
            var DataSpe = element.attr("data-spe");
            var DataTerm = element.attr("data-term");
            arrspe.push({'key' : DataSpe,'value' : DataTerm });
            $("#"+this_err).hide();
            valid = true;
        }
    })

    if(valid){
        $.map(arrspe, function(value) {
            var html = '<div class="d-flex align-items-center mb-3 col-md-6"><span class="wire_bangle_color_heading  d-inline-block">'+ value.key +' :</span><span class="ms-2 d-inline-block wire_bangle_color_heading ">'+ value.value +'</span></div>';
           $('#specificationstr').append(html);
        });
        jQuery("#exampleModal").modal('show');
    }
});    
      
$('body').on('click', '#save_newInquiryBtn', function () {
    save_inquiry($(this),'save_new');
});

function save_inquiry(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#InquiryCreateForm")[0]);
    //var dataspecification = $("input:radio.specification:checked").val();
    // $(".specification").each(function( index ) {
    //  console.log( index + ": " + $( this ).text() );
    // });

    var dataarray = [];

    // $('.specification').each(function (index) {
    //     if(this.selected){
    //         dataarray.push($(this).val());
    //     }
    //  });
    $(".specification").each(function () {
      dataarray.push($(this).val());
   })
   
    var dataspecification = dataarray.join(",");
    
    var qty = $('#qty').val();
    formData.append('specification_term_id',dataspecification);
    formData.append('qty',qty);
     
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
                var success_message = 'Thank You For Product Inquiry';
                $('#success-alert').text(success_message);
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                  $("#success-alert").slideUp(1000);
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

@endsection
  