@extends('frontend.layout.layout')
@section('content')
<div class="background-sub-slider">
            <div class="position-relative">
                <img src="{{ url('frontend/image/about_us.png') }}" alt="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">{{ $Category->category_name }} setting</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">{{ $Category->category_name }} setting</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="wire_bangle_page container">
        <!-- <div class="row mb-lg-5 pb-lg-5 mb-4  align-items-center step-progressbar-row">
            <div class="col-lg-2 text-center text-lg-start">
                <div class="step-progressbar-side-heading mb-3 mb-lg-0">Create Your Ring</div>
            </div>
            <div class="col-lg-10">
                <div class="flex-container step-progressbar">
                    <div class="flex-row text-center">
                        <div class="flex-col-xs-12">
                            <ul class="tab-steps--list">
                                <li class="active" data-step="1">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="choose setting">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose setting
                                    </div>
                                    <span><a href="{{ url('/product-setting-edit/'. $CatId .'/edit') }}" class="step-heading-link mt-2 d-inline-block">edit</a></span>
                                    
                                </li>
                                <li class="active" data-step="2">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/diamon_img.jpeg') }}" alt="choose diamond">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                    <span><a href="{{ url('/diamond-setting-edit/'. $CatId .'/edit') }}" class="step-heading-link mt-2 d-inline-block">edit</a></span>
                                </li>
                                <li class="active" data-step="3">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="complete the ring">
                                    </div>
                                    <div class="step-heading mt-2">
                                        complete the ring
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div> -->
        <div class="row mb-lg-5 pb-lg-5 mb-4 ">
            <ul class="d-block d-lg-flex ">
                <li class="step-progressbar-part">
                    <div class="step-progressbar-step-part">
                        <span class="step-progressbar-img ms-3">
                            <img src="{{ url('frontend/image/step_1.png') }}" alt="">
                        </span>
                           <div>
                            <span class="step-progressbar-text">
                                    choose diamonds
                                </span>
                                <div class="d-flex edit_price_text mt-1">
                                    <span class="me-2">
                                        <a href="{{ url('/product-setting-edit/'. $CatId .'/edit') }}" class="edit_text">Edit</a>
                                    </span>
                                    <span>
                                        |
                                    </span>
                                    <div class="d-flex ms-2">
                                        <span class="price_text me-2">
                                            price:
                                        </span>
                                        <span class="price_part">
                                            ${{ $Diamond->Sale_Amt }}
                                        </span>
                                    </div>
                                </div>
                           </div>
                    </div>
                  
                </li>
                <li class="step-progressbar-part active">
                    <div class="step-progressbar-step-part">
                        <span class="step-progressbar-img ms-3">
                            <img src="{{ url('frontend/image/step_2.png') }}" alt="">
                        </span>
                        <div>
                            <span class="step-progressbar-text">
                                choose settings
                            </span> 
                            <div class="d-flex edit_price_text mt-1">
                                <span class="me-2">
                                    <a href="{{ url('/diamond-setting-edit/'. $CatId .'/edit') }}" class="edit_text">Edit</a>
                                </span>
                                <span>
                                    |
                                </span>
                                <div class="d-flex ms-2">
                                    <span class="price_text me-2">
                                        price:
                                    </span>
                                    <span class="price_part">
                                        ${{ $Product->sale_price }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </li>
                <li class="step-progressbar-part">
                    <div class="step-progressbar-step-part">
                        <span class="step-progressbar-img ms-3">
                            <img src="{{ url('frontend/image/step_3.png') }}" alt="">
                        </span>
                        <div>
                            <span class="step-progressbar-text">
                            complete the {{ $Category->category_name }}
                            </span>
                           
                        </div>
                    </div>
                   
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6 wire_bangle_padding mb-4">
                <div class="">
                    <div class="slider slider-single mb-5">
                        <?php
                        $images = explode(',',$Product->images); 
                        foreach($images as $image){
                            $image = URL($image);
                        ?>
                        <div class="product_slider_main_item">
                            <img src="{{ $image }}" alt="">
                        </div>
                        <?php } ?>
                        <div class="product_slider_main_item">
                            <img src="{{ $Diamond->Stone_Img_url }}" alt="">
                        </div>
                    </div>
                    <div class="slider slider-nav">
                        <?php
                        $images = explode(',',$Product->images); 
                        foreach($images as $image){
                            $image = URL($image);
                        ?>
                        <div class="product_slider_item">
                            <h3><img src="{{ $image }}" alt=""></h3>
                        </div>
                        <?php } ?>
                        <div class="product_slider_item">
                            <h3><img src="{{ $Diamond->Stone_Img_url }}" alt=""></h3>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6 wire_bangle_padding_2">
                <div class="wire_bangle_content">
                    <div class="">
                        <div class="wire_bangle_heading mb-2 mb-xl-4 pb-xxl-2">{{ $Product->product->product_title }}</div>
                        <div class="d-flex mb-2 mb-xl-4 pb-xxl-2">
                            <span class="wire_bangle_price">${{ $Product->sale_price + $Diamond->Sale_Amt }}
                                <!-- <sub class="ms-2 wire_bangle_dublicate_price">$480</sub> -->
                            </span>
                        </div>
                        <div class="wire_bangle_edit_box  mb-3">
                            <div class="row">
                                <div class="col-2 col-sm-1 col-md-2 col-lg-1 px-0">
                                    <img src="{{ url('frontend/image/edit_box_1.png') }}" alt="" class="wire_bangle_edit_box_img">
                                </div>
                                <div class="col-8 col-sm-9 col-md-8 col-lg-9 ps-md-0 ps-lg-4">
                                    <div class="wire_bangle_edit_box_heading pb-2">
                                        {{ $Product->product->product_title }}
                                    </div>
                                    <div class="wire_bangle_edit_box_sub_heading pb-2">
                                    <?php 
                                           $product_attributes_variant = \App\Models\ProductVariantVariant::leftJoin("attributes", "attributes.id", "=", "product_variant_variants.attribute_id")->where('product_variant_variants.estatus',1)->where('product_variant_id',$Product->id)->groupBy('attributes.id')->get();
                                            $variantstr = '';
                                            foreach($product_attributes_variant as $product_attribute_variant){ 
                                                $product_attribute_terms = explode(',',$product_attribute_variant->attribute_term_id);
                                                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                                                $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
                                                $variantstr .= $product_attribute_term_name .' '; 
                                            }
                                            echo $variantstr;
                                            ?>    
                                        
                                    </div>
                                    <div>
                                        <span class="wire_bangle_edit_box_price">${{ $Product->sale_price }}</span>
                                        <span class="wire_bangle_edit_box_dublicate_price ms-2">${{ $Product->regular_price }}</span>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 pe-0 text-end">
                                    <a href="{{ url('/product-setting-edit/'. $CatId .'/edit') }}" class="edit_box">edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="wire_bangle_edit_box  mb-3">
                            <div class="row">
                                <div class="col-2 col-sm-1 col-md-2 col-lg-1 px-0">
                                    <img src="{{ url('frontend/image/edit_box_2.png') }}" alt="" class="wire_bangle_edit_box_img">
                                </div>
                                <div class="col-8 col-sm-9 col-md-8 col-lg-9 ps-md-0 ps-lg-4">
                                    <div class="wire_bangle_edit_box_heading pb-2">
                                       {{ $Diamond->Weight }} ct {{ $Diamond->Shape }} Lab Diamond
                                    </div>
                                    <div class="wire_bangle_edit_box_sub_heading pb-2">
                                      {{ $Diamond->Color }} Color | {{ $Diamond->Clarity }} Clarity | {{ $Diamond->Cut }} Cut
                                    </div>
                                    <div>
                                        <span class="wire_bangle_edit_box_price">${{ $Diamond->Sale_Amt }}</span>
                                        <!-- <span class="wire_bangle_edit_box_dublicate_price ms-2">$480</span> -->
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 pe-0 text-end">
                                    <a href="{{ url('/diamond-setting-edit/'. $CatId .'/edit') }}" class="edit_box">edit</a>
                                </div>
                            </div>
                        </div>
                        
                        
                            <div class="wire_bangle_carat">
                            <div class="mb-0">    
                            <?php     
                            $ProductVariantSpecification = \App\Models\ProductVariantSpecification::with('attribute_terms')->leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('product_variant_id',$Product->id)->where('is_specification',1)->where('is_dropdown',1)->groupBy('product_variant_specifications.attribute_id')->get();
                            $spe = '';
                            foreach($ProductVariantSpecification as $productvariants)
                            {
                            $spe .='<span class="wire_bangle_select mb-3 me-3 d-inline-block select_box_option">
                                <select name="AtributeSpecification'.$productvariants->attribute->id.'" id="AtributeSpecification'.$productvariants->id.'" class="specification">
                                    <option value="">-- '.$productvariants->attribute->attribute_name .'--</option>';   
                            
                                $product_attribute = \App\Models\ProductVariantSpecification::where('estatus',1)->where('attribute_id',$productvariants->attribute_id)->where('product_variant_id',$Product->id)->groupBy('attribute_term_id')->get();
                                $term_ids = explode(',',$cart->specification_term_id);  
                                foreach($product_attribute as $attribute_term){
                                    $term_array = explode(',',$attribute_term->attribute_term_id);
                                    $product_attributes = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id',$term_array)->get();
                                    $v = 1;
                                    foreach($product_attributes as $term){
                                        $spe .='<option value="'. $term->id .'"';
                                        if(in_array($term->id, $term_ids)){
                                            $spe .=' selected ';
                                        }
                                        $spe .='>'.$term->attrterm_name .'</option>'; 
                                    }
                                }   
                            $spe .='</select>
                            <div id="AtributeSpecification'.$productvariants->attribute->id.'-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </span>';
                            echo $spe;
                            }
                            ?>
                            
                            </div>
                            </div>

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
                                        <div class="row">
                                        <?php 
                                           $product_attributes_variant = \App\Models\ProductVariantVariant::leftJoin("attributes", "attributes.id", "=", "product_variant_variants.attribute_id")->where('product_variant_variants.estatus',1)->where('product_variant_id',$Product->id)->groupBy('attributes.id')->get();
                                            $variantstr = '';
                                            foreach($product_attributes_variant as $product_attribute_variant){ 
                                                $product_attribute_terms = explode(',',$product_attribute_variant->attribute_term_id);
                                                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                                                $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
                                                $variantstr .='<div class="d-flex align-items-center mb-3 col-md-6 px-0">
                                                                    <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_variant->attribute_name .' :</span>
                                                                    <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
                                                                </div>';
                                            }
                                            echo $variantstr;

                                            $product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$Product->id)->groupBy('attributes.id')->get();
                                            $str = '';
                                            foreach($product_attributes_specification as $product_attribute_specification){ 
                                                $product_attribute_terms = explode(',',$product_attribute_specification->attribute_term_id);
                                                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                                                $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
                                                
                                                $str .='<div class="d-flex align-items-center mb-3 col-md-6 px-0">
                                                            <span class="wire_bangle_color_heading  d-inline-block">'.$product_attribute_specification->attribute_name .' :</span>
                                                            <span class="ms-2 d-inline-block wire_bangle_color_heading ">'. $product_attribute_term_name .'</span>
                                                        </div>';    
                                        
                                            }
                                            echo $str;
                                        ?>
                                            
                                        </div>
                                        <form action="" method="post" id="InquiryCreateForm" name="InquiryCreateForm">
                                        @csrf
                                        <input type="hidden" class="d-block mb-3 wire_bangle_input" id='SKU' name="SKU" value="{{ $Product->SKU }}">
                                        <input type="hidden" class="d-block mb-3 wire_bangle_input" id='stone_no' name="stone_no" value="{{ $Diamond->Stone_No }}">
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
                                            <div class="mb-3 col-md-6 ps-0">
                                                <input type="text" name="inquiry" id="inquiry" placeholder="Inquiry" class="d-block wire_bangle_input">
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

                            <div class="d-flex mb-md-4 flex-wrap mb-3 mb-md-0">
                                <span class="wire_bangle_input">
                                    <div class="wire_bangle_number number-input">
                                        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                        <input class="qty" min="0" placeholder="0" name="qty" id="qty" value="1" type="number">
                                        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                    </div>
                                </span>
                                <span class="inquiry_now_btn ms-3 ms-md-5">
                                    <button class="select_setting_btn diamond-btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">inquiry now</button>
                                </span>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion wire_bangle_accordion" id="accordionExample">
        <div class="accordion-item mt-3">
                <div class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        {{ $Category->category_name }} Details
                    </button>
                </div>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                        <?php     
                            $product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attributes", "attributes.id", "=", "product_variant_specifications.attribute_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$Product->id)->groupBy('attributes.id')->get();
                            $str = '';
                            foreach($product_attributes_specification as $product_attribute_specification){ 
                                $product_attribute_terms = explode(',',$product_attribute_specification->attribute_term_id);
                                $product_attributes_term_val = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id', $product_attribute_terms)->get()->pluck('attrterm_name')->toArray();
                                $product_attribute_term_name = implode(' - ',$product_attributes_term_val); 
                                //$product_attributes_specification = \App\Models\ProductVariantSpecification::leftJoin("attribute_term", "attribute_term.id", "=", "product_variant_specifications.attribute_term_id")->where('product_variant_specifications.estatus',1)->where('is_dropdown',0)->where('product_variant_id',$vatid)->groupBy('attributes.id')->get();
                                $str .='<div class="col-md-6 px-0" >
                                        <div class="mt-4 wire_bangle_share">
                                        '.$product_attribute_specification->attribute_name .' &nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">'. $product_attribute_term_name .'</span>
                                        </div>
                                    </div>';
                        
                            }
                            echo $str;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item mt-3">
                <div class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Diamond Details
                    </button>
                </div>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6 px-0">
                                <div class="wire_bangle_share">
                                    stock number &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $Diamond->Stone_No }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="wire_bangle_share">
                                    cut &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $Diamond->Cut }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="mt-4 wire_bangle_share">
                                    shape &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $Diamond->Shape }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="mt-4 wire_bangle_share">
                                    clarity &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $Diamond->Clarity }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="mt-4 wire_bangle_share">
                                    carat weight &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $Diamond->Weight }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="mt-4 wire_bangle_share">
                                    color &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $Diamond->Color }}</span>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-5 align-items-center">
            <div class="col-md-4 pe-4">
                <div class="order-include-img">
                    <img src="{{ url('frontend/image/order-includes.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="order-includes-heading mb-4 px-3 mt-3 text-center text-md-start">
                    Your Order Includes
                </div>
                <div class="row">
                    <div class="col-md-6 order-box-part mb-3">
                        <div class="order-box">
                           <span class="order-img col-md-4">
                             <img src="{{ url('frontend/image/order_1.png') }}" alt="">   
                           </span>
                           <span class="order-text col-md-8 text-start">
                                Qulity packaging
                           </span>
                        </div>    
                    </div>
                    <div class="col-md-6 order-box-part mb-3">
                        <div class="order-box">
                           <span class="order-img col-md-4">
                             <img src="{{ url('frontend/image/order_2.png') }}" alt="">   
                           </span>
                           <span class="order-text col-md-8 text-start">
                                Free Shipping
                           </span>
                        </div>   
                    </div>
                    <div class="col-md-6 order-box-part mb-3">
                        <div class="order-box">
                           <span class="order-img col-md-4">
                             <img src="{{ url('frontend/image/order_3.png') }}" alt="">   
                           </span>
                           <span class="order-text col-md-8 text-start">
                                30 Days free returns
                           </span>
                        </div>    
                    </div>
                    <div class="col-md-6 order-box-part mb-3">
                        <div class="order-box">
                           <span class="order-img col-md-4">
                             <img src="{{ url('frontend/image/order_4.png') }}" alt="">   
                           </span>
                           <span class="order-text col-md-8 text-start">
                                Valuation certificate
                           </span>
                        </div>      
                    </div>
                    <div class="col-md-6 order-box-part mb-3">
                        <div class="order-box">
                           <span class="order-img col-md-4">
                             <img src="{{ url('frontend/image/order_5.png') }}" alt="">   
                           </span>
                           <span class="order-text col-md-8 text-start">
                                Lifetime warrenty
                           </span>
                        </div>      
                    </div>
                    <div class="col-md-6 order-box-part mb-3">
                        <div class="order-box">
                           <span class="order-img col-md-4">
                             <img src="{{ url('frontend/image/order_6.png') }}" alt="">   
                           </span>
                           <span class="order-text col-md-8 text-start">
                                Concierge Service
                           </span>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
$( document ).ready(function() {  

$('body').on('click', '.select_setting_btn', function () {
var valid = false;
var arrspe = [];
$(document).find('.specification').each(function() {
    var thi = $(this);
    var this_err = $(thi).attr('name') + "-error";
    if($(thi).val()=="" || $(thi).val()==null){
        $("#"+this_err).html("Please select any value");
        $("#"+this_err).show();
        valid = false;
    }else{
        $("#"+this_err).hide();
        valid = true;
    }
    })
    if(valid){
        $.map(arrspe, function(value) {
            var html = '<div class="d-flex align-items-center mb-3 col-md-6 px-0"><span class="wire_bangle_color_heading  d-inline-block">'+ value.key +' :</span><span class="ms-2 d-inline-block wire_bangle_color_heading ">'+ value.value +'</span></div>';
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

    var dataarray = [];
    $(".specification").each(function () {
      dataarray.push($(this).val());
   })
   
    var dataspecification = dataarray.join(",");
    var qty = $('#qty').val();
    formData.append('qty',qty);
    formData.append('specification_term_id',dataspecification);
     
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
                  //location.reload();
                  window.location.href = "{{ url('/') }}";
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

