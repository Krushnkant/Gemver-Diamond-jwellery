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
                        <div class="wire_bangle_heading mb-2 mb-xl-4 pb-xxl-2">{{ $Diamond->Weight }} Carat {{ $Diamond->Shape }}  Diamond</div>
                        <div class="d-flex mb-2 pb-xxl-2">
                            <span class="wire_bangle_price">${{ $Diamond->Sale_Amt }}
                                <!-- <sub class="ms-2 wire_bangle_dublicate_price">$480</sub> -->
                            </span>

                        </div>
                        <form action="" class="mb-4 mb-lg-5">
                            <div class="wire_bangle_share mb-4 mb-xxl-5">
                                <div class="row">
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                           <span class="d-block col-6 col-sm-3 col-md-4 ps-0"> carat </span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Weight }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0"> color</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Color }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0"> shape</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Shape }}</span>
                                        </div>
                                    </div>
                                    @if($Diamond->Cut != "")
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0"> cut grade</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Cut }}</span>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0"> clarity</span>
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8">{{ $Diamond->Clarity }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-3 wire_bangle_share wire_bangle_share_part row ps-0">
                                            <span class="d-block col-6 col-sm-3 col-md-4 ps-0"> Certification</span>
                                            @if($Diamond->Certificate_url != "")
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8"><a href="{{ $Diamond->Certificate_url }}" target="_blank">{{ $Diamond->Lab }}</a></span>
                                            @else
                                            <span class="wire_bangle_color_theme d-block col-6 col-sm-9 col-md-8"><a href="{{ $Diamond->Certificate_url }}" target="_blank">{{ $Diamond->Lab }}</a></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $Diamond->id }}" name="diamond_id" id="diamond_id">
                            <button id="save_newProductBtn" class="select_setting_btn  btn-hover-effect btn-hover-effect-black diamond-bt">add to {{ $Category->category_name }}</button>
                        </form>
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
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0">stock number</span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Stone_No }}</span>
                                </div>
                            </div>
                            @if($Diamond->Cut != "")
                            <div class="col-xl-6 px-0">
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0">cut</span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Cut }}</span>
                                </div>
                            </div>
                            @endif
                            <div class="col-xl-6 px-0">
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0">carat weight </span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Weight }}</span>
                                </div>
                            </div>
                            <div class="col-xl-6 px-0">
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0">color </span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Color }}</span>
                                </div>
                            </div>

                            <div class="col-xl-6 px-0">
                                <div class="mt-4 wire_bangle_share row">
                                    <span class="col-5 col-sm-3 col-xl-3 ps-0">shape</span>
                                    <span class="wire_bangle_color_theme col-7 col-sm-9 col-xl-9">{{ $Diamond->Shape }}</span>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
    </div>

<script type="text/javascript">
$( document ).ready(function() {    
$('body').on('click', '#save_newProductBtn', function () {
    save_cart($(this),'save_new');
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

    