@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
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
                <div class="step-progressbar-side-heading mb-3 mb-lg-0">Create Your {{ $Category->category_name }}</div>
            </div>
            <div class="col-lg-10">
                <div class="flex-container step-progressbar">
                    <div class="flex-row text-center">
                        <div class="flex-col-xs-12">
                        @if($check_variant == 1)
                            <ul class="tab-steps--list">
                            
                                <li class="active" data-step="1">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose setting
                                    </div>
                                    <span><a href="{{ url('/product-setting-edit/'. $CatId .'/edit') }}" class="step-heading-link mt-2 d-inline-block">edit</a></span>
                                </li>

                                <li class="active" data-step="2">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/diamon_img.jpeg') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                </li>
                                
                                <li data-step="3">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        complete the {{ $Category->category_name }}
                                    </div>
                                </li>
                            </ul>
                            @else
                            <ul class="tab-steps--list">
                                <li class="active" data-step="1">
                                    <div class="step-img">
                                        <img src="{{ url('frontend/image/diamon_img.jpeg') }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose diamond
                                    </div>
                                </li>
                                <li  data-step="2">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        choose setting
                                    </div>
                                    <a href="{{ url('/product-setting/'. $CatId) }}" class="step-heading-link mt-2 d-block">browse lab diamonds</a>
                                </li>
                                
                                <li data-step="3">
                                    <div class="step-img">
                                        <img src="{{ url($Category->category_thumb) }}" alt="">
                                    </div>
                                    <div class="step-heading mt-2">
                                        complete the {{ $Category->category_name }}
                                    </div>
                                </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="mb-lg-5 pb-lg-5 mb-4">
        @if($check_variant == 1)
            <ul class="d-block d-lg-flex progressbar_ul">
                   <li class="step-progressbar-part ">
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
                                            ${{ $ProductVariantPrice }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </li>
                    <li class="step-progressbar-part active">
                        <div class="step-progressbar-step-part active">

                            <span class="step-progressbar-img ms-3">
                                <img src="{{ url('frontend/image/step_1.png') }}" alt="">
                            </span>
                            <div>
                                <span class="step-progressbar-text">
                                    choose diamonds
                                </span>
                                    
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
                @else  
                <ul class="d-block d-lg-flex progressbar_ul">
                   <li class="step-progressbar-part active">
                        <div class="step-progressbar-step-part">
        
                            <span class="step-progressbar-img ms-3">
                                <img src="{{ url('frontend/image/step_1.png') }}" alt="">
                            </span>
                            <div>
                                <span class="step-progressbar-text">
                                    choose diamonds
                                </span>
                                   
                            </div>
                        </div>
                    </li>
                    
                    <li class="step-progressbar-part ">
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
                                        <a href="{{ url('/product-setting/'. $CatId) }}" class="edit_text">Browse Settings</a>
                                    </span>
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
            @endif
        </div>
        <div class="row">
            <div class="col-md-6 wire_bangle_padding mb-4">
                <div class="">
                    <div class="slider slider-single mb-5">
                        @if($Diamond->Stone_Img_url != '')
                        <div class="product_slider_main_item">
                            <img src="{{ $Diamond->Stone_Img_url }}" alt="">
                        </div>
                        @endif
                        <div class="product_slider_main_item video-player-btn-item video-player-diamond-btn">
                            <iframe src="{{ $Diamond->Video_url }}"></iframe>
                        </div>
                    </div>
                    <div class="slider slider-nav">
                        @if($Diamond->Stone_Img_url != '')
                        <div class="product_slider_item">
                            <h3><img src="{{ $Diamond->Stone_Img_url }}" alt=""></h3>
                        </div>
                        @endif
                        <div class="product_slider_item video-player-btn">
                            <h3><img src="{{ url('frontend/image/360.png') }}" alt=""></h3>
                        </div>
                    </div>
                      <!-- <div class="view_360_btn text-center mt-3">
                        <button class="select_setting_btn btn-hover-effect btn-hover-effect-black" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">view in 360 degree</button>
                        <div class="modal fade inquiry_now_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                    <div class="modal-content inquiry_now_modal_iframe">
                                        <div class="ms-auto me-0 mb-3"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                                        <iframe width="100%" height="100%" src="{{ $Diamond->Video_url }}"></iframe>
                                    </div>
                                </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-md-6 wire_bangle_padding_2">
                <div class="wire_bangle_content">
                    <div class="">
                        <div class="wire_bangle_heading mb-2 pb-xxl-2">{{ $Diamond->Weight }} Carat {{ $Diamond->Shape }}  Diamond</div>
                        <div class="d-flex mb-2 pb-xxl-2">
                            <span class="wire_bangle_price">${{ $Diamond->Sale_Amt }}
                                <!-- <sub class="ms-2 wire_bangle_dublicate_price">$480</sub> -->
                            </span>

                        </div>
                        <form action="" class="mb-4 mb-lg-5">
                            <div class="wire_bangle_share mb-4">
                                <div class="row">
                                    <div class="col-xl-12 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                           <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1"> carat </span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Weight }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1"> color</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Color }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1"> shape</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Shape }}</span>
                                        </div>
                                    </div>
                                    @if($Diamond->Cut != "")
                                    <div class="col-xl-12 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1"> cut grade</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Cut }}</span>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-xl-12 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1"> clarity</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Clarity }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1"> Certified</span>
                                            @if($Diamond->Certificate_url != "")
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8"><u><a href="{{ $Diamond->Certificate_url }}" target="_blank">{{ $Diamond->Lab }}</a></u></span>
                                            @else
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Lab }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $Diamond->id }}" name="diamond_id" id="diamond_id">
                            <button id="save_newProductBtn" class="select_setting_btn  btn-hover-effect btn-hover-effect-black diamond-bt">add to {{ $Category->category_name }}</button>
                            <div class="mt-3">
                                <p>Estimated date of shipment <br>
                                <b>{{ date('dS M , Y', strtotime ('+15 day')) }} </b>
                                </p>
                            </div>
                            <div class=" mt-3">
                                <button class="select_contact_btn diamond-btn get_opinion_btn" type="button"> Get a gemologist opinion</button>
                                <div id="inquiry-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                        </form>

                            

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
                                        <input type="hidden" name="product_id" value="{{ $Diamond->id }}"> 
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
                                                <textarea  name="message"  class="d-block wire_bangle_input" placeholder="message"></textarea>
                                                
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
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion wire_bangle_accordion mt-md-5" id="accordionExample">
            <div class="accordion-item">
                <div class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        diamond detail
                    </button>
                </div>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-xl-6 px-0">
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">stock number</span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Stone_No }}</span>
                                </div>
                            </div>
                            @if($Diamond->Cut != "")
                            <div class="col-xl-6 px-0">
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">cut</span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Cut }}</span>
                                </div>
                            </div>
                            @endif
                            <div class="col-xl-6 px-0">
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">carat weight </span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Weight }}</span>
                                </div>
                            </div>
                            <div class="col-xl-6 px-0">
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">color </span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Color }}</span>
                                </div>
                            </div>

                            <div class="col-xl-6 px-0">
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">shape</span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Shape }}</span>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
       
        </div>

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
                <div class="col-md-12 col-lg-12 col-lg-12 px-3 px-md-0 order-part">
                    <div class="order-includes-heading mb-lg-4 mb-2 mt-lg-3 mt-2 px-xl-3 px-xxl-0 text-center text-lg-start d-none d-xl-block">
                        {{ $OrderIncludes->title }}
                    </div>
                    <div class="row mt-2 mt-md-0">
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

        @if(count($DiamondRelated) > 0)
    <div class="container">
        <div class="shop_by_category pt-0">
            <div class="row">
                <div class="col-md-12 text-center d-flex justify-content-center align-items-center position-relative">
                    <div>
                        <h2 class="heading-h2 mb-xl-5 mb-3 mt-md-0">Related Diamonds </h2>
                    </div>
                    <!-- <div class="category-line-img d-none d-md-block">
                        <img src="{{ asset('frontend/image/category-line.png') }}" alt="">
                    </div> -->
                </div>
                <div class="owl-carousel owl-theme product-detail mb-5">
                    @foreach($DiamondRelated as $Diamond)
                    <?php
                      $url =  URL('/diamond-details/'.$CatId.'/'.$Diamond->id);
                      if($Diamond->Stone_Img_url != ""){
                          $Diamond_image = $Diamond->Stone_Img_url;
                      }else{
                          if($Diamond->Shape == strtoupper('round')){
                              $Diamond_image = url('frontend/image/1.png');    
                          }elseif($Diamond->Shape == strtoupper('oval')){
                              $Diamond_image = url('frontend/image/2.png');
                          }elseif($Diamond->Shape == strtoupper('emerald')){
                              $Diamond_image = url('frontend/image/3.png');
                          }elseif($Diamond->Shape == strtoupper('princess')){
                              $Diamond_image = url('frontend/image/6.png');
                          }elseif($Diamond->Shape == strtoupper('cushion')){
                              $Diamond_image = url('frontend/image/7.png');
                          }elseif($Diamond->Shape == strtoupper('marquise')){
                              $Diamond_image = url('frontend/image/8.png');
                          }elseif($Diamond->Shape == strtoupper('pear')){
                              $Diamond_image = url('frontend/image/9.png');
                          }elseif($Diamond->Shape == strtoupper('HEART')){
                              $Diamond_image = url('frontend/image/10.png');
                          }elseif($Diamond->Shape == strtoupper('asscher')){
                              $Diamond_image = url('frontend/image/asscher.png');
                          }elseif($Diamond->Shape == strtoupper('radiant')){
                              $Diamond_image = url('frontend/image/radiant.png');
                          }else{
                              $Diamond_image = url('frontend/image/edit_box_2.png');
                          }
                      }

                    ?>
                   
                    
                    <div class="round_cut_lab_diamonds_box hover_on_mask">
                        <div class="round_cut_lab_diamonds_img">
                            <img src="{{ $Diamond_image }}" alt="">
                            <a href="{{ $url }}">
                            <div class="round_cut_lab_diamonds_layer">
                                <ul>
                                    
                                    <li>
                                        <span class="round_product_part_1">CARATE  :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Weight }}</span>
                                    </li>
                                    <li>
                                        <span class="round_product_part_1"> CLARITY :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Clarity }} </span>
                                    </li>
                                    <li>
                                        <span class="round_product_part_1">SHAPE :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Shape }} </span>
                                    </li>
                                    
                                    <li>
                                        <span class="round_product_part_1">COLOR  :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Color }} </span>
                                    </li>
                                    @if($Diamond->Cut != "")
                                    <li>
                                        <span class="round_product_part_1"> CUT  :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Cut }} </span>
                                    </li>
                                    @endif
                                    <li>
                                        <span class="round_product_part_1"> POLISH  :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Polish }} </span>
                                    </li>
                                    <li>
                                        <span class="round_product_part_1"> SYMMETRY  :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Symm }} </span>
                                    </li>
                                    
                                    <li>
                                        <span class="round_product_part_1"> MEASUREMENT  :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Measurement }} </span>
                                    </li>
                                    <li>
                                        <span class="round_product_part_1"> CERTIFIED :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Lab }} </span>
                                    </li>
                                    <li>
                                        <span class="round_product_part_1">LOT :</span>
                                        <span class="round_product_part_2">{{ $Diamond->Stone_No }} </span>
                                    </li>
                                </ul>
                            </div>
                            </a>
                        </div>

                        <div class="mt-4 round_cut_lab_diamonds_layer_part pt-0">
                            <div class="round_cut_lab_diamonds_info_heading mb-2">
                                <a href="{{ $url }}">{{ $Diamond->Shape }}</a>
                            </div>
                            <div class="round_cut_lab_diamonds_info_main_heading"><a href="'.$url.'">{{ $Diamond->Shape .' '. round($Diamond->Weight,2) }} ct</a></div>
                            <div class="round_cut_lab_diamonds_info_clarity mb-2">
                                <span>{{ $Diamond->Clarity }} clarity |</span>
                                <span>{{ $Diamond->Color }} color |</span>
                                <span>{{ $Diamond->Lab }} certified</span>
                            </div>
                            <div class="round_cut_lab_diamonds_info_price d-flex justify-content-between">
                                ${{ $Diamond->Sale_Amt }} 
                            </div>
                        </div>
                    </div>
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
    @endif
        
    </div>

<script type="text/javascript">
$( document ).ready(function() {    
$('body').on('click', '#save_newProductBtn', function () {
    save_cart($(this),'save_new');
});

$('body').on('click', '.select_contact_btn', function () {
    jQuery("#opinionModal").modal('show');
});

function save_cart(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();

    var diamond_id = $('#diamond_id').val();
    var ip_address = '{{ \Request::ip(); }}';
    var category_id = '{{ $Category->id }}';
    
    $.ajax({
        type: 'POST',
        url: "{{ route('frontend.cart.save') }}",
        data: {diamond_id:diamond_id,ip_address:ip_address,category_id:category_id,_token: '{{ csrf_token() }}'},

        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();    
            }
            if(res.status == 200){
                var check_variant = '{{ $check_variant }}';
                if(check_variant == 0){
                    $url = "{{ url('product-setting') }}" +'/' + category_id
                }else{
                    $url = "{{ url('product_complete') }}" +'/' + category_id
                }
                
                window.location = $url;
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

    