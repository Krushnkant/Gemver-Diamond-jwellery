@extends('frontend.layout.layout')

@section('content')
        <div class="background-sub-slider">
            <div class="position-relative">
                <img src="{{ asset('frontend/image/about_us.png') }}" alt="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">Diamond Details</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">Diamond Details</a>
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
                <div class="wire_bangle_content">
                    <div class="">
                        <div class="wire_bangle_heading mb-2 mb-xl-4 pb-xxl-2">{{ $Diamond->Weight }} Carat {{ $Diamond->Shape }}  Diamond</div>
                        <div class="d-flex mb-2 pb-xxl-2">
                            <span class="wire_bangle_price">${{ $Diamond->Sale_Amt }}
                                <!-- <sub class="ms-2 wire_bangle_dublicate_price">$480</sub> -->
                            </span>

                        </div>
                    
                            <div class="wire_bangle_share mb-4 mb-xxl-5">
                                <div class="row">
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            carat &nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">{{ $Diamond->Weight }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            color&nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">{{ $Diamond->Color }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            shape&nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">{{ $Diamond->Shape }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            cut grade&nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">{{ $Diamond->Cut }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            clarity&nbsp;:&nbsp;
                                            <span class="wire_bangle_color_theme">{{ $Diamond->Clarity }}</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 ps-md-0">
                                        <div class="mt-4 wire_bangle_share">
                                            Certification&nbsp;:&nbsp;
                                            @if($Diamond->Certificate_url != "")
                                            <span class="wire_bangle_color_theme"><a href="{{ $Diamond->Certificate_url }}" target="_blank">{{ $Diamond->Lab }}</a></span>
                                            @else
                                            <span class="wire_bangle_color_theme"><a href="{{ $Diamond->Certificate_url }}" target="_blank">{{ $Diamond->Lab }}</a></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $Diamond->id }}" name="diamond_id" id="diamond_id">
                            <div class="modal fade inquiry_now_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable text-center">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col-6 ps-0 text-start">
                                                <div class="mb-xl-4 mb-3 product_heading">Diamond inquiry</div>
                                            </div>
                                            <div class="col-6 text-end pe-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <div class="alert alert-success" id="success-alert" style="display: none;"></div>
                                        <div class="row">
                                        <div class="d-flex align-items-center mb-3 col-md-6 px-0">
                                                <span class="wire_bangle_color_heading  d-inline-block">Amount :</span>
                                                <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Sale_Amt }}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3 col-md-6 px-0">
                                                <span class="wire_bangle_color_heading  d-inline-block">Stone No :</span>
                                                <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Stone_No }}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3 col-md-6 px-0">
                                                <span class="wire_bangle_color_heading  d-inline-block">Shape :</span>
                                                <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Shape }}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3 col-md-6 px-0">
                                                <span class="wire_bangle_color_heading  d-inline-block">Weight :</span>
                                                <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Weight }}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3 col-md-6 px-0">
                                                <span class="wire_bangle_color_heading  d-inline-block">Color :</span>
                                                <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Color }}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3 col-md-6 px-0">
                                                <span class="wire_bangle_color_heading  d-inline-block">Clarity :</span>
                                                <span class="ms-2 d-inline-block wire_bangle_color_heading ">{{ $Diamond->Clarity }}</span>
                                            </div>
                                        </div>
                                        <form action="" method="post" id="InquiryCreateForm" name="InquiryCreateForm">
                                        @csrf
            
                                        <input type="hidden" class="d-block mb-3 wire_bangle_input" id='stone_no' name="stone_no" value="{{ $Diamond->Stone_No }}">
                                        
                                        <div class="row mb-0 mb-xxl-4">
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

                          
                           
                            <button class="select_setting_btn  btn-hover-effect btn-hover-effect-black diamond-bt mb-2 me-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">inquiry now</button>
                            @foreach($Category as $cat)
                            
                            <button  data-id="{{ $cat->id }}" class="select_setting_btn  btn-hover-effect btn-hover-effect-black diamond-bt mt-1 save_addToCart me-2">add to {{ $cat->category_name }}</button>

                            @endforeach
                       
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
                            <div class="col-md-6 px-0">
                                <div class="wire_bangle_share">
                                    stock number &nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $Diamond->Stone_No }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="wire_bangle_share">
                                    cut&nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $Diamond->Cut }}</span>
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

                            <div class="col-md-6 px-0">
                                <div class="mt-4 wire_bangle_share">
                                    shape&nbsp;:&nbsp;
                                    <span class="wire_bangle_color_theme">{{ $Diamond->Shape }}</span>
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
$('body').on('click', '.save_addToCart', function () {
    var category_id = $(this).attr("data-id");
    save_cart($(this),category_id);
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


});
</script>
@endsection

    