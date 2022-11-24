@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">Shop</div>
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
                    $supported_image = array(
                        'jpg',
                        'jpeg',
                        'png'
                    ); 
                    foreach($Product->product_variant as $variant){
                        $images = explode(",",$variant->images);
                        foreach($images as $image){
                        $ext = pathinfo($image, PATHINFO_EXTENSION); 
                        if(in_array($ext, $supported_image)){ 
                       ?>
                            <div class="product_slider_main_item">
                                <img src="{{ URL($image) }}" alt="">
                            </div>
                            <?php }else{ ?> 
                            <div class="product_slider_main_item">
                                <video controls="" autoplay="" style="width:100%; height:100%;" name="media"><source src="{{ URL($image) }}" type="video/mp4"></video>
                            </div>    
                            <?php 
                         }
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
                        <div class="wire_bangle_heading mb-0 pb-0">{{ $Product->product_title }}</div>
                        <div class=" review_star mb-2">
                            <span class="">
                                <span class="me-1 total_review_star">4.5</span>
                                
                                <i class="fa-solid fa-star"></i>
                            </span>
                        </div>
                        <div class="d-flex mb-2 mb-xl-2 pb-xxl-2">
                            <span class="wire_bangle_price ">$<span class="sale_price">{{ $Product->product_variant['0']->sale_price }} </span>
                                @if($Product->product_variant['0']->regular_price != '' || $Product->product_variant['0']->regular_price != 0 )
                                <sub class="ms-2 wire_bangle_dublicate_price ">$<span class="regular_price"> {{ $Product->product_variant['0']->regular_price }} </span>
                                </sub>
                                <sub class="price_discount ms-2"><span class="discount_percent">{{ $Product->product_variant['0']->auto_discount_percent }}</span>% Off</sub>
                                @endif
                            </span>
 
                        </div>
                       
                        <!-- <p class="blog_box_paragraph mb-xl-4">{!! Str::limit($Product->desc, 170, ' ...<a style="color: #BB9761;" href="#description">Read More </a>');  !!}</p> -->
                        
                        <form action="" class="mb-2" >
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
                                <div class="wire_bangle_color wire_bangle_color_img_part">
                                <?php 
                                $product_attribute = \App\Models\ProductVariantVariant::leftJoin('attribute_terms', function($join) {
                                    $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                                  })->with('attribute_terms')->where('product_variant_variants.estatus',1)->where('product_variant_variants.attribute_id',$productvariants->attribute_id)->where('product_id',$Product->id)->groupBy('attribute_term_id')->orderBy('attribute_terms.sorting','asc')->get();
                                //dd($product_attribute);
                                $ia = 1;
                                ?>    
                                @foreach($product_attribute as $attribute_term)
                                    <span class="form-check d-inline-block">
                                        <input class="form-check-input variant"  @if(in_array($attribute_term->id,$attribute_term_ids)) checked @endif  value="{{ $attribute_term->id }}"  type="radio" name="AtributeVariant{{ $productvariants->attribute_name }}" id="" title="{{ $attribute_term->attrterm_name }}">
                                        <img src="{{ url('images/attrTermThumb/'.$attribute_term->attrterm_thumb) }}" alt="{{ $attribute_term->attrterm_name }}"  class="wire_bangle_color_img">
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
                                 $product_attribute = \App\Models\ProductVariantVariant::leftJoin('attribute_terms', function($join) {
                                    $join->on('product_variant_variants.attribute_term_id', '=', 'attribute_terms.id');
                                  })->with('attribute_terms')->where('product_variant_variants.estatus',1)->where('product_variant_variants.attribute_id',$productvariants->attribute_id)->where('product_id',$Product->id)->groupBy('attribute_term_id')->orderBy('attribute_terms.sorting','asc')->get();
                                ?>    
                                @foreach($product_attribute as $attribute_term)
                                <span class="form-check d-inline-block position-relative me-2  ps-0 mb-3">
                                        <input class="form-check-input variant" @if(in_array($attribute_term->attribute_terms[0]->id,$attribute_term_ids)) checked @endif value="{{ $attribute_term->attribute_terms[0]->id }}"  type="radio" name="AtributeVariant{{ $productvariants->attribute->attribute_name }}" id="AtributeVariant{{ $attribute_term->attribute_terms[0]->id }}">
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
                            <div class="d-flex flex-wrap" id="speci_multi143">
                            
                            <?php

                            $ProductVariantSpecification = \App\Models\ProductAttribute::leftJoin("attributes", "attributes.id", "=", "product_attributes.attribute_id")->where('product_id',$Product->id)->where('is_dropdown',1)->groupBy('product_attributes.attribute_id')->get();
                            
                             $spe = '';
                             foreach($ProductVariantSpecification as $productvariants)
                             {

                             $spe .='<div class="me-4"> <div class="wire_bangle_color_heading mb-2">'.$productvariants->attribute_name.'</div><span class="wire_bangle_select me-3 d-inline-block">
                                       <select name="AtributeSpecification'.$productvariants->id.'" id="AtributeSpecification'.$productvariants->id.'" class="specification">
                                         <option value="">-- '.$productvariants->attribute_name .'--</option>';   
                            
                                 $product_attribute = \App\Models\ProductAttribute::where('attribute_id',$productvariants->attribute_id)->where('product_id',$Product->id)->groupBy('attribute_id')->get();
                                   // dd($product_attribute);
                                foreach($product_attribute as $attribute_term){
                                    $term_array = explode(',',$attribute_term->terms_id);
                                    
                                    $product_attributes = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id',$term_array)->get();
                                    //dd($product_attributes);
                                     $v = 1;
                                     foreach($product_attributes as $term){
                                     $spe .='<option data-spe="'.$productvariants->attribute_name .'" data-term="'.$term->attrterm_name .'" value="'. $term->id .'">'.$term->attrterm_name .'</option>'; 
                                    
                                    }
                                 }   
                                $spe .='</select>
                                    <div id="AtributeSpecification'.$productvariants->id.'-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </span> </div>';
                                }
                             
                            echo $spe;
                             ?>
                            </div>
                            <!-- @if($Product->design_number != "")
                            <div class="row">
                                <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0"> 
                                    <span class="d-block col-6 col-sm-3 col-md-4 ps-0">Design Number</span>
                                    <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Product->design_number }}</span>
                                </div>
                            </div>
                            @endif -->
                            <!-- <div class="" id="specificationproduct123">
                            </div>  -->
                            <?php
                            $product_attributes_specification = \App\Models\ProductAttribute::leftJoin("attributes", "attributes.id", "=", "product_attributes.attribute_id")->where('is_dropdown',0)->where('use_variation',0)->where('product_id',$Product->id)->groupBy('attributes.id')->get();
                            //dd($product_attributes_specification);
                            foreach($product_attributes_specification as $product_attribute_specification){  
                                $product_attribute_terms = explode(',',$product_attribute_specification->terms_id);
                                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                                $product_attribute_term_name = implode(' | ',$product_attributes_term_val);
                            ?>
                            <div class="" id="specificationproduct143">
                                <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0"> 
                                    <span class="d-block col-6 col-sm-4 col-md-5 col-xl-4 ps-0 wire_bangle_heading_part_1">{{ $product_attribute_specification->attribute_name }}</span>
                                    <span class="wire_bangle_color_theme d-block col-6 col-sm-8 col-md-7 col-xl-8">{{ $product_attribute_term_name }}</span>
                                </div>
                            </div>    
                            <?php
                            }
                            ?>
                            </form>
                            
                            
                            <div class="d-sm-flex">
                                <span class="inquiry_now_btn d-sm-inline-block">
                                    <button class="select_setting_btn diamond-btn mb-2 mt-2" type="button"  >inquiry now</button>
                                    <div id="inquiry-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </span>
                                <span class="inquiry_now_btn product-data d-sm-inline-block">
                                    <input type="hidden" class="variant_id" value="{{ $Product->id }}"> 
                                    <input type="hidden" class="item_type" value="0"> 
                                    <button class="select_cart_btn diamond-btn mb-2 mt-2 ms-sm-3" type="button">Add To Cart</button>
                                    <div id="inquiry-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </span>
                            </div>
                            
                           
                            
                            <div class="modal fade inquiry_now_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content p-3 p-md-4">
                                        <div class="row">
                                            <div class="col-8 ps-0 text-start">
                                                <div class="mb-xl-4 mb-3 product_heading">product inquiry</div>
                                            </div>
                                            <div class="col-4 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                       
                                        <div class="alert alert-success" id="success-alert" style="display: none;">
                                        </div>
                                        <div class="row mb-2 mb-xl-3">
                                            <div class="col-3 col-sm-2">
                                                <div class="product_img">
                                                    <img src="{{ asset('frontend/image/round.png') }}" id="inquiry_image" alt="">  
                                                </div>
                                            </div>
                                            <div class="col-9 col-sm-10">
                                                <div class="text-start popup_product_heading mb-2">Product Name</div>
                                                <div class="row" id="variantstr"> 
                                                </div>
                                                <div class="row" id="specificationstr"> 
                                                </div>
                                            </div>
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
                                                <input type="email" name="email" id="email" placeholder="enter your email" class="d-block wire_bangle_input">
                                                <div id="email-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="number" name="mobile_no" id="mobile_no" placeholder="mobile number" class="d-block wire_bangle_input">
                                                <div id="mobile_no-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="number" name="whatsapp_number" id="whatsapp_number" placeholder="whatsapp number" class="d-block wire_bangle_input">
                                                <div id="whatsapp_number-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                           
                                            <div class="mb-md-3 col-md-12 ps-0 mb-3">
                                                <textarea  name="inquiry" id="inquiry" class="d-block wire_bangle_input" placeholder="Message"></textarea>
                                                <!-- <input type="text" name="inquiry" id="inquiry" placeholder="Message" class="d-block wire_bangle_input"> -->
                                                <div id="inquiry-error" class="invalid-feedback animated fadeInDown text-start mt-2" style="display: none;">Please select any value</div>
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
                            <!--<button class="select_setting_btn btn-hover-effect btn-hover-effect-black diamond-bt">select setting</button>-->

                           
                            
                            <div class="row product-border mt-xl-4">
                                <div class="col-6 col-xxl-4 ps-0 text-start text-xl-center product-delivery-start">
                                    <div class="mt-md-3">
                                        <p>Estimated Date of Shipment <br>
                                            <b>{{ date('dS M , Y', strtotime ('+2 day')) }} </b>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-xxl-5 offset-xxl-2 text-start text-xl-center ps-0 ps-lg-3 pe-0 product-delivery-end">
                                    <div class="mt-md-3">
                                        <p>Estimated Date of Delivery <br>
                                           <b>{{ date('dS M , Y', strtotime ('+15 day')) }} </b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                           
                            

                            <div class="">
                                <button class="select_contact_btn diamond-btn get_opinion_btn" type="button">
                                    <i class="fa-solid fa-user me-2"></i>
                                     Get a gemologist opinion
                                </button>
                                <div id="inquiry-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="row detail_label my-2 my-md-4 py-0 mt-4">
                                <div class="col-4 col-md-4 d-flex align-items-center justify-content-center detail_label_col">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                                        <path d="M14.1575 0.0417425L0.848077 0C0.627869 0.000233189 0.416405 0.0836041 0.258216 0.232506C0.100138 0.381407 0.00766281 0.584171 0.000468788 0.798137C-0.00684743 1.0121 0.071712 1.22037 0.219357 1.37905L4.07735 5.48494C4.1739 5.58743 4.23903 5.71406 4.26542 5.85061L5.30239 11.3251H5.30251C5.35097 11.5791 5.51888 11.7963 5.75623 11.9122C5.99359 12.0281 6.27305 12.0293 6.5115 11.9155C6.63012 11.8576 6.73314 11.7736 6.81242 11.6699L14.8293 1.36355C14.956 1.19984 15.0156 0.996246 14.9965 0.792309C14.9773 0.588373 14.8809 0.398556 14.7259 0.259902C14.5708 0.121263 14.3684 0.043488 14.1577 0.0418552L14.1575 0.0417425ZM14.2918 1.20148L5.06055 5.65214C4.87801 5.74006 4.65673 5.66753 4.56615 5.49018C4.47572 5.31271 4.5502 5.09759 4.73275 5.00953L13.9477 0.558873C14.1303 0.470838 14.3515 0.543364 14.4421 0.720717C14.5326 0.898185 14.458 1.11331 14.2755 1.20136L14.2918 1.20148Z" fill="#0B1727"/>
                                    </svg>
                                    <div class="ms-2">
                                        <a href="#" class="select_hint_btn hint-box">
                                           Drop hint
                                        </a>
                                    </div>
                                </div>
                                <div class="col-4 col-md-4 d-flex align-items-center justify-content-center detail_label_col">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="12" viewBox="0 0 17 12" fill="none">
                                        <path d="M1.90735e-06 1.70596V10.5689C-0.000118256 10.736 0.0307674 10.9017 0.0914536 11.0585L4.97854 6.4254L1.90735e-06 1.70596ZM6.85929 7.36884L0.088068 0.949302C0.193209 0.671647 0.386051 0.431547 0.640408 0.261579C0.894781 0.0917484 1.19821 0.000343935 1.50929 0H15.4905C15.8016 0.000344494 16.105 0.0917484 16.3594 0.261579C16.6138 0.431524 16.8066 0.671626 16.9117 0.949302L10.1405 7.36884C9.70506 7.78062 9.11504 8.012 8.49981 8.012C7.88459 8.012 7.29457 7.78062 6.8591 7.36884H6.85929ZM17 1.70596V10.5689C17.0001 10.736 16.9692 10.9017 16.9085 11.0585L12.0215 6.4254L17 1.70596ZM6.41648 7.78832V7.78821C6.96956 8.31149 7.719 8.60533 8.50028 8.60533C9.28156 8.60533 10.031 8.31148 10.5841 7.78821L11.5783 6.84559L16.5649 11.5731C16.2819 11.8463 15.8947 12.0001 15.4907 12H1.50951C1.10555 12.0001 0.718521 11.8462 0.435436 11.5731L5.42206 6.84559L6.41648 7.78832Z" fill="#0B1727"/>
                                    </svg>
                                    <div class="ms-2">
                                        <a href="mailto:{{ $settings->company_email }}" class="select_hint_btn">
                                           Email
                                        </a>
                                    </div>
                                </div>
                                <div class="col-4 col-md-4 d-flex align-items-center justify-content-center detail_label_col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                    <path d="M4.50935 10.5079C4.50935 10.5079 6.86477 12.5488 9.49561 12.9477C9.49561 12.9477 11.331 13.362 12.6005 11.8582C12.6005 11.8582 13.4571 11.229 12.6617 10.2162L10.6734 8.25222C10.6734 8.25222 10.1993 7.69981 9.43449 8.19088L8.65446 8.95812C8.40971 9.18825 8.0427 9.23427 7.76733 9.06559C6.86483 8.51307 5.01418 7.19342 3.97411 5.26009C3.82111 4.96851 3.86699 4.61561 4.09648 4.38539L4.63187 3.84827C4.63187 3.84827 5.53426 3.05031 4.64713 2.145L2.67398 0.196301C2.67398 0.196301 1.97034 -0.310076 1.26682 0.303766C1.26682 0.303766 -0.430958 1.73077 0.104404 4.13995C0.11966 4.13984 0.165446 6.687 4.50935 10.5079Z" fill="#0B1727"/>
                                    </svg>
                                    <div class="ms-2">
                                        <a href="tel:{{ $settings->company_mobile_no }}" class="select_hint_btn">
                                           Call
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade inquiry_now_modal" id="opinionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col-6 ps-0 text-start">
                                                <div class="mb-xl-4 mb-3 product_heading"> Get a gemologist opinion</div>
                                            </div>
                                            <div class="col-6 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success" id="opinionsuccess-alert" style="display: none;">
                                        </div>
                                        
                                        <form action="" method="post" id="opinionCreateForm" name="opinionCreateForm">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $Product->id }}"> 
                                        <div class="row mb-0">
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="name" placeholder="your name" class="d-block wire_bangle_input">
                                                <div id="opinionname-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                          
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="email"  placeholder="enter your email" class="d-block wire_bangle_input">
                                                <div id="opinionemail-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-12 ps-0 mb-3">
                                                <textarea  name="message"  class="d-block wire_bangle_input" placeholder="Message"></textarea>
                                                
                                                <div id="opinionmessage-error" class="invalid-feedback animated fadeInDown text-start mt-2" style="display: none;">Please select any value</div>
                                            </div>
                                        </div>
 
                                        <button class="send_inquiry_btn product_detail_inquiry_btn" id="save_newopinionBtn" >send 
                                            <div class="spinner-border loadericonfa spinner-border-send-inquiry" role="status" style="display:none;">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                      </form>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade inquiry_now_modal" id="hintModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col-6 ps-0 text-start">
                                                <div class="mb-xl-4 mb-3 product_heading"> Drop a Hint</div>
                                            </div>
                                            <div class="col-6 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success" id="hintsuccess-alert" style="display: none;">
                                        </div>
                                        
                                        <form action="" method="post" id="hintCreateForm" name="hintCreateForm">
                                        @csrf
                                        <input type="hidden" class="d-block mb-3 wire_bangle_input SKU"  name="SKU" value=""> 
                                        <div class="row mb-0">
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="hintname" placeholder="your name" class="d-block wire_bangle_input">
                                                <div id="hintname-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                          
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="hintemail"  placeholder="enter your email" class="d-block wire_bangle_input">
                                                <div id="hintemail-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>

                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="friendname" placeholder="your friend name" class="d-block wire_bangle_input">
                                                <div id="hintfriendname-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                          
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="friendemail"  placeholder="enter your friend email" class="d-block wire_bangle_input">
                                                <div id="hintfriendemail-error" class="invalid-feedback animated fadeInDown text-start" style="display: none;"></div>
                                            </div>
                                            <div class="mb-3 col-md-12 ps-0 mb-3">
                                                <textarea  name="message"  class="d-block wire_bangle_input" placeholder="Message"></textarea>
                                                
                                                <div id="hintmessage-error" class="invalid-feedback animated fadeInDown text-start mt-2" style="display: none;"></div>
                                            </div>
                                        </div>


 
                                        <button class="send_inquiry_btn product_detail_inquiry_btn" id="save_newhintBtn" >send 
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
        <div class="row mt-xl-5 pt-xxl-0 mb-xxl-4 mt-3" id="description">
            <div class="col-md-12">
                <div class="description_heading">
                    Description
                </div>
            </div>
            <div class="col-md-12">
                <p class="description_paragraph">{{ $Product->desc }}</p>
            </div>
        </div>
        <div class="accordion wire_bangle_accordion detailsspecii" id="accordionExample">
            <div class="accordion-item">
                <div class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                         Details
                    </button>
                </div>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row" id="specification143">
                            @if($Product->product_title != "")
                            <div class="col-xl-6 px-0" >
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">Product Name </span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Product->product_title }}</span>
                                </div>
                            </div>
                            @endif

                            @if($Product->design_number != "")
                            <div class="col-xl-6 px-0" >
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">Design Number </span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Product->design_number }}</span>
                                </div>
                            </div>
                            @endif
                            <?php
                            $product_attributes_specification = \App\Models\ProductAttribute::leftJoin("attributes", "attributes.id", "=", "product_attributes.attribute_id")->where('is_dropdown',0)->where('use_variation',0)->where('product_id',$Product->id)->groupBy('attributes.id')->get();
                            //dd($product_attributes_specification);
                            foreach($product_attributes_specification as $product_attribute_specification){  
                                $product_attribute_terms = explode(',',$product_attribute_specification->terms_id);
                                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                                $product_attribute_term_name = implode(' | ',$product_attributes_term_val);
                            ?>

                            <div class="col-xl-6 px-0 wire_bangle_share_my" >
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">{{ $product_attribute_specification->attribute_name }} </span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $product_attribute_term_name }}</span>
                                </div>
                            </div>

                            <?php
                                }
                            ?>

                        </div>
                        <div class="row" id="specificationproduct123">
                        </div>    

                    </div>
                </div>
            </div>
        </div>

        <div class=" mt-md-5 mt-4 px-3 mb-md-5 mb-4">

            <div class="review_description_heading order-includes-heading">
                Reviews
            </div>
            {{-- <div class="review_description_heading mb-3">
                10 Reviews For Cenforce
            </div> --}}
            <div class="row resview_list">   
                
              {{--  <div class="col-md-6 mb-4 ps-0 pe-0 pe-md-3">
                    <div class="review_box">
                        <div class="row">
                            <div class="col-6 ps-0 review_heading">
                                Elizajones
                            </div>
                            <div class="col-6 text-end review_star pe-0">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <div class="review_description_paragraph">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla eligendi expedita enim quae possimus ab magni facilis dicta, illum quas ipsum quis deleniti iusto eum quibusdam et? Ullam, ad dolorum.
                        </div>
                        <div class="review_thumb_part mt-3">
                            <img src="{{ asset('frontend/image/round.png') }}" id="inquiry_image" alt="" class="review_thumb_part_img">    
                            <img src="{{ asset('frontend/image/round.png') }}" id="inquiry_image" alt="" class="review_thumb_part_img">  
                            <img src="{{ asset('frontend/image/round.png') }}" id="inquiry_image" alt="" class="review_thumb_part_img">  
                            <img src="{{ asset('frontend/image/round.png') }}" id="inquiry_image" alt="" class="review_thumb_part_img">  
                            <img src="{{ asset('frontend/image/round.png') }}" id="inquiry_image" alt="" class="review_thumb_part_img"> 
                        </div>
                    </div>
                </div>--}}
                
            </div>
            {{-- <div class="text-end">
                <button type="button" class="btn show_more_btn">Show more</button>
            </div>  --}}
        </div>

        <!-- <div class="gemver_diamonds_section p-0 dbdfbdf" id="spe_desc">
          
        </div> -->
        @if(isset($OrderIncludes->orderincludesdata))
        <div class="order-includes-heading mb-3 px-3 mt-4 mt-md-4 text-center text-xl-start d-block d-xl-none">
             {{ $OrderIncludes->title }}
        </div>

        <div class="row mt-md-0 mt-xl-4 align-items-center">
                <!-- <div class="col-md-6 col-lg-4 pe-4">
                    <div class="order-include-img">
                        <img src="{{ url('frontend/image/order-includes.png') }}" alt="">
                    </div>
                </div> -->
                <div class="col-md-12 col-lg-12 col-lg-12 px-3 px-md-0 px-xxl-3 order-part">
                    <div class="order-includes-heading mb-lg-5 mb-2 mt-lg-3 mt-2 px-xl-3 px-xxl-0 text-center text-lg-center d-none d-xl-block">
                        {{ $OrderIncludes->title }}
                    </div>
                    <div class="row mt-2 mt-md-0 justify-content-center">
                        @foreach($OrderIncludes->orderincludesdata as $orderincludesdata)
                        <div class="col-md-4 col-xxl-2 order-box-part mb-3 px-0 px-md-3 order-include-col">
                            <div class="order-box">
                            <span class="order-img d-block mb-2">
                                <img src="{{ url('images/order_image/'.$orderincludesdata->image) }}" alt="">   
                            </span>
                            <span class="order-text text-center d-block">
                                {{ $orderincludesdata->title }}
                            </span>
                            </div>    
                        </div>
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    
    @if(count($ProductRelated) > 0)
    <div class="container">
        <div class="shop_by_category pt-0">
            <div class="row">
                <div class="col-md-12 text-center d-flex justify-content-center align-items-center position-relative">
                    <div>
                        <h2 class="heading-h2 mb-xl-5 mb-3 mt-md-0">Related Product </h2>
                    </div>
                    <!-- <div class="category-line-img d-none d-md-block">
                        <img src="{{ asset('frontend/image/category-line.png') }}" alt="">
                    </div> -->
                </div>
                <div class="owl-carousel owl-theme product-detail mb-5 px-0">
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
                        <div class="wire_bangle_description p-3"><div class="wire_bangle_heading mb-2">{{ $Related->primary_category->category_name }}
                            <input type="hidden" class="variant_id" value="{{ $Related->variant_id }}">    
                            <input type="hidden" class="item_type" value="0">    
                            <span type="button" class="btn btn-default add-to-wishlist-btn" data-toggle="tooltip" data-placement="right" title="Wishlist">
                                <?php if(is_wishlist($Related->variant_id,0)){ ?>
                                    <i class="fas fa-heart text-danger"></i>
                                <?php }else{ ?>
                                    <i class="far fa-heart"></i> 
                                <?php }
                                ?>
                            </span>
                        </div>
                            <div class="wire_bangle_sub_heading wire_bangle_description"><a href="{{ $url }}">{{ $Related->product_title }}</a></div>
                            <div class="d-flex justify-content-between pt-2 align-items-center">
                                <div>
                                    <span class="wire_bangle_price wire_bangle_price_part">
                                        $ {{ $sale_price }}
                                    </span>
                                    <span class="ms-2 wire_bangle_dublicate_price product_detail_regular_price">$<span class="regular_price">{{ $Related->regular_price }}</span></span>
                                </div>
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
                                        $attributeurl =  URL('/product-details/'.$Related->id.'/'.$attribute_term->product_variant_id); 
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
    selectjs();
    sliderjs();
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
                //var result123 = $(data.result.images).text().split(',');
            
                if(data.result == 'data not found'){
                    $("#inquiry-error").html("product not available");
                    $("#inquiry-error").show();
                    $(".select_setting_btn").prop('disabled', true);
                    $(".select_setting_btn").css("background-color", "#808080");
                    $(".select_cart_btn").prop('disabled', true);
                    $(".select_cart_btn").css("background-color", "#808080");
                }else{
                    $("#inquiry-error").html("");
                    $("#inquiry-error").hide();
                    $(".select_setting_btn").prop('disabled', false);
                    $(".select_setting_btn").css("background-color", "");
                    $(".select_cart_btn").prop('disabled', false);
                    $(".select_cart_btn").css("background-color", "");
                   
                    $('.discount_percent').html(data.result.auto_discount_percent);
                    $('.sale_price').html(data.result.sale_price);
                    $('.regular_price').html(data.result.regular_price); 
                    $('#SKU').val(data.result.SKU);
                    $('.SKU').val(data.result.SKU);
                    $('.variant_id').val(data.result.variant_id);
                    // var sale_amount = data.result.sale_price;
                    // var max_order_amount = "{{ $settings->max_order_price }}";
                    // if(sale_amount > max_order_amount){
                    //     $('.select_cart_btn').prop('disabled',true);
                    // }else{
                    //     $('.select_cart_btn').prop('disabled',false);
                    // }
                    $('#specificationproduct123').html(data.specificationstr123);
                    $('.resview_list').html(data.review_list);
                   
                    $('.total_review_star').html(data.result.product_rating);
                   // console.log($('.wire_bangle_share_my').next());
                    //$('.wire_bangle_share_my').next().html(data.specificationstr123);
                    
                    if(data.speci != ""){
                        $(".detailsspeci").show();
                        $('#specification').html(data.speci);
                        $('#specificationproduct').html(data.specificationstr);
                    }else{
                        $(".detailsspeci").hide();
                    }
                    
                    $('#speci_multi').html(data.speci_multi);
                    $('#vimage').html(data.vimage);
                    $('#spe_desc').html(data.spe_desc);
                    $('#variantstr').html(data.variantstr);
                    var img = data.result.images.split(",");
                    $img_in = "{{ url('/') }}"+"/"+img[0];
                    $('#inquiry_image').attr('src', $img_in);
                    // selectjs();
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

});

</script>

<script type="text/javascript">
$( document ).ready(function() {
    
$('body').on('click', '.select_setting_btn', function () {
    var valid = true;
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
            var html = '<div class="d-flex align-items-center mb-md-2 col-md-6"><span class="wire_bangle_color_heading  d-inline-block">'+ value.key +' :</span><span class="ms-2 d-inline-block wire_bangle_color_heading ">'+ value.value +'</span></div>';
            $('#specificationstr').append(html);
        });
        jQuery("#exampleModal").modal('show');
    }
});

$('body').on('click', '.select_contact_btn', function () { 
    jQuery("#opinionModal").modal('show');
}); 

$('body').on('click', '.hint-box', function () {
    var valid = true;
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
    jQuery("#hintModal").modal('show');
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

                // if (res.errors.whatsapp_number) {
                //     $('#whatsapp_number-error').show().text(res.errors.whatsapp_number);
                // } else {
                //     $('#whatsapp_number-error').hide();
                // }


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




$('body').on('click', '#save_newopinionBtn', function () {
    save_opinion($(this),'save_new');
});

function save_opinion(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#opinionCreateForm")[0]);
  
    $.ajax({
        type: 'POST',
        url: "{{ route('frontend.opinion.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                if (res.errors.name) {
                    $('#opinionname-error').show().text(res.errors.name);
                } else {
                    $('#opinionname-error').hide();
                }
                if (res.errors.email) {
                    $('#opinionemail-error').show().text(res.errors.email);
                } else {
                    $('#opinionemail-error').hide();
                }
                if (res.errors.message) {
                    $('#opinionmessage-error').show().text(res.errors.message);
                } else {
                    $('#opinionmessage-error').hide();
                } 
            }
            if(res.status == 200){
                $('#opinionmessage-error').hide();
               
                $('#opinionemail-error').hide();
                $('#opinionname-error').hide();
                document.getElementById("opinionCreateForm").reset();
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                //location.href="{{ route('frontend.contactus')}}";
                var success_message = 'Thank You For Opinion';
                $('#opinionsuccess-alert').text(success_message);
                $("#opinionsuccess-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#opinionsuccess-alert").slideUp(1000);
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

$('body').on('click', '#save_newhintBtn', function () {
    save_hint($(this),'save_new');
});

function save_hint(btn,btn_type){
    
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#hintCreateForm")[0]);
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
        url: "{{ route('frontend.hint.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();

                if (res.errors.hintname) {
                    $('#hintname-error').show().text(res.errors.hintname);
                } else {
                    $('#hintname-error').hide();
                }
                if (res.errors.hintemail) {
                    $('#hintemail-error').show().text(res.errors.hintemail);
                } else {
                    $('#hintemail-error').hide();
                }

                if (res.errors.friendname) {
                    $('#friendname-error').show().text(res.errors.friendname);
                } else {
                    $('#friendname-error').hide();
                }
                if (res.errors.friendemail) {
                    $('#friendemail-error').show().text(res.errors.friendemail);
                } else {
                    $('#friendemail-error').hide();
                }

            
                // if (res.errors.inquiry) {
                //     $('#inquiry-error').show().text(res.errors.inquiry);
                // } else {
                //     $('#inquiry-error').hide();
                // } 
            }
            if(res.status == 200){

                
                $('#hintemail-error').hide();
                $('#hintname-error').hide();
                document.getElementById("hintCreateForm").reset();
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                //location.href="{{ route('frontend.contactus')}}";
                var success_message = 'Thank You For send hint';
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


$('.select_cart_btn').click(function (e) {
      
    e.preventDefault();

    var valid = true;
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
        var btn = $(this);
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var thisdata = $(this);

        var variant_id = $(this).closest('.product-data').find('.variant_id').val();
        var item_type = $(this).closest('.product-data').find('.item_type').val();
        var quantity = 1;
 
        $.ajax({
            url: "{{ url('/add-to-cart') }}",  
            method: "POST", 
            data: { 
                'variant_id': variant_id, 
                'quantity': quantity, 
                'item_type': item_type, 
                'arrspe': arrspe 
            },
            success: function (response) {
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                toastr.success(response.status,'Success',{timeOut: 5000});
                cartload();
                //alertify.set('notifier','position','top-right');
                //alertify.success(response.status);
            },
        });

    }
  });
});
</script>

<script>
$(document).ready(function(){
 
 var _token = $('input[name="_token"]').val();

 //load_data('', _token);

 function load_data(id="", _token)
 {

  var variant_id = $('.variant_id').val();
  $.ajax({
   url:"{{ route('frontend.load_data') }}",
   method:"POST",
   data:{id:id,variant_id:variant_id,type:0, _token:_token},
   success:function(data)
   {
    console.log(data);
    $('#load_more_button').remove();
    $('.resview_list').append(data);
   }
  })
 }

 $(document).on('click', '#load_more_button', function(){
  var id = $(this).data('id');
  $('#load_more_button').html('<b>Loading...</b>');
  load_data(id, _token);
 });

});
</script>

@endsection
  