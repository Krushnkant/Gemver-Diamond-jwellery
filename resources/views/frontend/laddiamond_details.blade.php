@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">{{ $Diamond->Weight }} Carat {{ $Diamond->Shape }}  Diamond</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="{{ url('/lab-diamond/'.$Diamond->Shape) }}">Lab Diamonds</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">{{ $Diamond->Weight }} Carat {{ $Diamond->Shape }}  Diamond</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="wire_bangle_page container">
        
        <div class="row">
            <div class="col-md-6 wire_bangle_padding mb-4">
                <div class="">
                    <div class="slider slider-single mb-5">
                        @if($Diamond->Stone_Img_url != '')
                        <div class="product_slider_main_item">
                            <img src="{{ $Diamond->Stone_Img_url }}" alt="">
                        </div>
                        @endif
                        <div class="product_slider_main_item video-player-btn-item">
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
                <div class="wire_bangle_content mb-4 mb-md-0">
                    <div class="diamond-data">
                        <div class="wire_bangle_heading mb-2 pb-xxl-2">{{ $Diamond->Weight }} Carat {{ $Diamond->Shape }}  Diamond</div>
                        <div class="d-flex mb-2 pb-xxl-2">
                            <span class="wire_bangle_price">${{ $Diamond->Sale_Amt }}
                                <!-- <sub class="ms-2 wire_bangle_dublicate_price">$480</sub> -->
                            </span>

                        </div>
                    
                            <div class="wire_bangle_share mb-4">
                                <div class="row">
                                    <div class="col-xl-12 px-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                           <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1"> carat </span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Weight }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 px-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1">color</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Color }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 px-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1">shape</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Shape }}</span>
                                        </div>
                                    </div>
                                    @if($Diamond->Cut != "")
                                    <div class="col-xl-12 px-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1">cut grade</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Cut }}</span>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-xl-12 px-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1">clarity</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Clarity }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 px-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0 wire_bangle_heading_part_1">Certified</span>
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
                            <input type="hidden" value="1" id="item_type">
                            <div class="modal fade inquiry_now_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content p-3 p-md-4">
                                        <div class="row">
                                            <div class="col-8 ps-0 text-start">
                                                <div class="mb-xl-4 mb-3 product_heading">Diamond inquiry</div>
                                            </div>
                                            <div class="col-4 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success" id="success-alert" style="display: none;"></div>
                                        <div class="row mb-2 mb-xl-3">
                                            <div class="col-3 col-sm-2">
                                                <div class="product_img">
                                                    <img src="{{ $Diamond->Stone_Img_url }}" alt="">  
                                                </div>
                                            </div>
                                            <div class="col-9 col-sm-10">
                                                <div class="text-start popup_product_heading mb-2">Product Name</div>
                                                <div class="row">
                                                    <div class="d-flex align-items-center mb-1 mb-md-2 col-md-6 px-0">
                                                        <span class="wire_bangle_color_heading  d-inline-block">Amount :</span>
                                                        <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Sale_Amt }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-1 mb-md-2 col-md-6 px-0">
                                                        <span class="wire_bangle_color_heading  d-inline-block">Stone No :</span>
                                                        <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Stone_No }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-1 mb-md-2 col-md-6 px-0">
                                                        <span class="wire_bangle_color_heading  d-inline-block">Shape :</span>
                                                        <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Shape }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-1 mb-md-2 col-md-6 px-0">
                                                        <span class="wire_bangle_color_heading  d-inline-block">Weight :</span>
                                                        <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Weight }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-1 mb-md-2 col-md-6 px-0">
                                                        <span class="wire_bangle_color_heading  d-inline-block">Color :</span>
                                                        <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Color }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-1 mb-md-2 col-md-6 px-0">
                                                        <span class="wire_bangle_color_heading  d-inline-block">Clarity :</span>
                                                        <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Clarity }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <form action="" method="post" id="InquiryCreateForm" name="InquiryCreateForm">
                                        @csrf
            
                                        <input type="hidden" class="d-block mb-3 wire_bangle_input" id='stone_no' name="stone_no" value="{{ $Diamond->Stone_No }}">
                                        
                                        <div class="row mb-4">
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
            
                            <div class="d-flex flex-wrap">
                            <button class="select_setting_btn  btn-hover-effect btn-hover-effect-black diamond-bt mb-2 me-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">inquiry now</button>
                            <button class="select_setting_btn  add-to-cart btn-hover-effect btn-hover-effect-black diamond-bt mb-2 me-2" type="button" >add to cart
                                <div class="spinner-border loadericonfa spinner-border-send-inquiry" role="status" style="display:none;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                            @foreach($Category as $cat)
                            
                            <button  data-id="{{ $cat->id }}" class="select_setting_btn  btn-hover-effect btn-hover-effect-black diamond-bt mb-2 mt-1 save_addToCart me-2">add to {{ $cat->category_name }}</button>

                            @endforeach
                            </div>
                            

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


                            <div class=" mt-3">
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
                                            <input type="hidden" name="product_id" value="{{ $Diamond->id }}"> 
                                            <input type="hidden" class="d-block mb-3 wire_bangle_input" id='stone_no' name="stone_no" value="{{ $Diamond->Stone_No }}">
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
        <div class="accordion wire_bangle_accordion mt-md-5 px-3" id="accordionExample">
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
                                <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">stock number </span>
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
                                <span class="col-5 col-sm-3 col-xl-3 ps-0 wire_bangle_heading_part_1">carat weight</span>
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
        <?php 
        $diamond_reviews = \App\Models\Review::where('status',1)->where('type',1)->where('item_id',$Diamond->id)->get();
        ?>
        <div class="mt-md-5 mt-4 px-3 mb-md-5 mb-4">
            <div class="review_description_heading order-includes-heading">
                Reviews
            </div>
            <div class="review_description_heading mb-3">
                {{ count($diamond_reviews) }} Reviews For Cenforce
            </div>
            <div class="row resview_list">   
                
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
                <div class="owl-carousel owl-theme product-detail mb-5 px-0">
                    @foreach($DiamondRelated as $Diamond)
                    <?php
                      $url =  URL('/laddiamond-details/'.$Diamond->id);
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
                        </div>

                        <div class="mt-4 round_cut_lab_diamonds_layer_part pt-0">
                            <div class="round_cut_lab_diamonds_info_heading mb-2">
                                <a href="{{ $url }}">{{ $Diamond->Shape }}</a>
                                <input type="hidden" class="diamond_id" value="{{ $Diamond->id }}">    
                                <input type="hidden" class="item_type" value="1">    
                                <span type="button" class="btn btn-default add-to-wishlist-btn-diamond add-to-wishlist-btn" data-toggle="tooltip" data-placement="right" title="Wishlist">
                                @if(is_wishlist($Diamond->id,1))    
                                    <i class="fas fa-heart text-danger"></i> 
                                @else
                                    <i class="far fa-heart "></i>
                                @endif
                                </span>
                            </div>
                            <div class="round_cut_lab_diamonds_info_main_heading"><a href="{{ $url }}">{{ $Diamond->Shape .' '. round($Diamond->Weight,2) }} ct</a></div>
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
<script type="text/javascript">
$( document ).ready(function() {    
$('body').on('click', '.save_addToCart', function () {
    var category_id = $(this).attr("data-id");
    save_cart($(this),category_id);
});

$('body').on('click', '.select_contact_btn', function () {
    jQuery("#opinionModal").modal('show');
});

function save_cart(btn,category_id){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
   
    var diamond_id = $('#diamond_id').val();
    var ip_address = '{{ \Request::ip(); }}';
    
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
                $url = "{{ url('product-setting') }}" +'/' + category_id
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
                var success_message = 'Thank You For Diamond Inquiry';
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

$('.add-to-cart').click(function (e) {
      e.preventDefault();
        var btn = $(this);
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var thisdata = $(this);
        console.log($(this).closest('.diamond-data'));
        var diamond_id = $(this).closest('.diamond-data').find('#diamond_id').val();
        var item_type = $(this).closest('.diamond-data').find('#item_type').val();
        var quantity = 1;
        $.ajax({
            url: "{{ url('/add-to-cart') }}",  
            method: "POST", 
            data: { 
                'variant_id': diamond_id, 
                'quantity': quantity, 
                'item_type': item_type 
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
      
$('body').on('click', '#save_newhintBtn', function () {
    save_hint($(this),'save_new');
});

function save_hint(btn,btn_type){
    
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#hintCreateForm")[0]);
    var dataarray = [];
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

$('body').on('click', '#save_newopinionBtn', function () {
    save_opinion($(this),'save_new');
});

function save_opinion(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#opinionCreateForm")[0]);
    formData.append('type',2);
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
});
</script>

<script>
$(document).ready(function(){
 
 var _token = $('input[name="_token"]').val();

 load_data('', _token);

 function load_data(id="", _token)
 {

  var variant_id = $('#diamond_id').val();
  $.ajax({
   url:"{{ route('frontend.load_data') }}",
   method:"POST",
   data:{id:id,variant_id:variant_id,type:1, _token:_token},
   success:function(data)
   {
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

    