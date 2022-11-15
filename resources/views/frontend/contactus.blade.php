@extends('frontend.layout.layout')

@section('content')

<div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3">contact us</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/')}}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">contact us</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="container my-3 my-lg-5">
            <div class="row  mb-4 mb-lg-5 pb-lg-4">
                <div class="col-md-6 pe-md-0">
                    <div class="inquiry_now_modal contact_us_box p-3 p-xl-5">
                        <div class="contact_us_heading mb-3">get in touch</div>
                        <p class="contact_us_paragraph mb-md-5">Follow a four-step process to create a one-of-a-kind jewelry piece according to your preference and style.</p>
                        <div class="alert alert-success" id="success-alert" style="display: none;">
                             Product have added to your wishlist.
                        </div>
                        <form  method="post" id="ContactCreateForm" name="ContactCreateForm">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" id="name" placeholder="your name" class="d-block wire_bangle_input w-100">
                                <div id="name-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                            <div class="mb-3">
                                <input type="number" name="mobile_no" id="mobile_no" placeholder="your mobile number" class="d-block wire_bangle_input w-100">
                                <div id="mobile_no-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" id="email" placeholder="your email address" class="d-block wire_bangle_input w-100">
                                <div id="email-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="subject" id="subject" placeholder="your subject" class="d-block wire_bangle_input w-100">
                                <div id="subject-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                            <div class="mb-3">
                                <textarea type="text" rows="8" name="message" id="message" placeholder="your message" class="d-block wire_bangle_input w-100"></textarea>
                                <div id="message-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                            <button type="submit" id="save_newContactBtn" class="send_inquiry_btn btn-hover-effect btn-hover-effect-black d-flex align-items-center justify-content-center">send 
                            <div class="spinner-border loadericonfa" role="status" style="display:none;">
                                <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 ps-md-0 contact-us-map mt-4 overflow-hidden">
                    <div class="contact_us_bg p-3 p-xl-5">
                        <div class="contact_us_part mb-2 mb-md-4">
                            <div class="contact_us_sub_heading mb-2">
                                address
                            </div>
                            <div class="contact_us_sub_paragraph">
                                {{ $settings->company_address }}
                            </div>
                        </div>
                        <div class="contact_us_part mb-2 mb-md-4">
                            <div class="contact_us_sub_heading mb-2">
                                phone no.
                            </div>
                            <div class="contact_us_sub_paragraph">
                               {{ $settings->company_mobile_no }}
                            </div>
                        </div>
                        <div class="contact_us_part mb-2 mb-md-4">
                            <div class="contact_us_sub_heading mb-2">
                                email
                            </div>
                            <div class="contact_us_sub_paragraph">
                            {{ $settings->company_email }}
                            </div>
                        </div>
                          <div class="contact-google-map">
                            <div class="">
                                <div class="contact-google-map">
                                    <!-- <iframe src="{{ $settings->company_address_map }}" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                                    {!! $settings->company_address_map !!}
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
$('body').on('click', '#save_newContactBtn', function () {
    save_contact($(this),'save_new');
});

function save_contact(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#ContactCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('frontend.contact.save') }}",
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

                if (res.errors.subject) {
                    $('#subject-error').show().text(res.errors.subject);
                } else {
                    $('#subject-error').hide();
                }
                if (res.errors.message) {
                    $('#message-error').show().text(res.errors.message);
                } else {
                    $('#message-error').hide();
                } 
            }
            if(res.status == 200){
                $('#message-error').hide();
                $('#subject-error').hide();
                $('#mobile_no-error').hide();
                $('#email-error').hide();
                $('#name-error').hide();
                document.getElementById("ContactCreateForm").reset();
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                //location.href="{{ route('frontend.contactus')}}";
                var success_message = 'Thank You For Contact Inquiry';
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
  

@endsection()

