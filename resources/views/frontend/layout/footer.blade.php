<footer class="footer-part-section mt-0">
    <div class="container">
        <div class="row mb-md-5">
            <div class="col-lg-3">
                <div class="footer-logo mb-3">
                    <img src="{{ URL('images/company/'.$settings->company_logo) }}" alt="">
                </div>
            </div>
            <div class="col-lg-9">
                <div>
                    <div class="footer-part-heading mb-3">Trusted By</div>
                    <div class="col-md-12 text-center">
                        <div id="trustby-slider" class="owl-carousel owl-theme">
                            <?php $trustedbies = \App\Models\TrustedBy::where('estatus', 1)->get('trustedbythumb'); ?>
                            @foreach($trustedbies as $trusted)
                            <div class="item">
                                <img src="{{ URL('images/trustedbyThumb/'.$trusted->trustedbythumb) }}" width="170" height="70" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="line"></div>
        <div class="row mt-4 mt-md-5">
            <div class="col-md-2 footer-col mb-md-0">
                <div class="footer-heading mb-4 mb-md-4 d-flex justify-content-between"> 
                    about
                   <div class="footer-angle d-block d-md-none">
                   <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 50 30" fill="none" class="float-end">
                        <path d="M0.686462 0.753148C1.60174 -0.251049 3.08575 -0.251049 4.00103 0.753148L25 23.7919L45.9991 0.753148C46.9144 -0.251049 48.3982 -0.251049 49.3135 0.753148C50.2288 1.75735 50.2288 3.38551 49.3135 4.38971L26.6572 29.2468C25.7419 30.2511 24.2582 30.2511 23.3428 29.2468L0.686462 4.38971C-0.228821 3.38551 -0.228821 1.75735 0.686462 0.753148Z" fill="#212121"/>
                    </svg>
                   </div>
                </div>
                <?php $footer1 = \App\Models\FooterPage::where('page_id', 1)->get(['title','value']); ?>
                <ul class="footer-ul-part d-md-block">
                    @foreach($footer1 as $fo1)
                    <li>
                        <a href="{{ url($fo1->value)}}">{{ ($fo1->title != "")?$fo1->title:$fo1->value }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-2 footer-col mb-md-0">
                <div class="footer-heading mb-4 mb-md-4 d-flex justify-content-between">
                    Why Gemver?
                <div class="footer-angle d-block d-md-none">
                   <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 50 30" fill="none" class="float-end">
                        <path d="M0.686462 0.753148C1.60174 -0.251049 3.08575 -0.251049 4.00103 0.753148L25 23.7919L45.9991 0.753148C46.9144 -0.251049 48.3982 -0.251049 49.3135 0.753148C50.2288 1.75735 50.2288 3.38551 49.3135 4.38971L26.6572 29.2468C25.7419 30.2511 24.2582 30.2511 23.3428 29.2468L0.686462 4.38971C-0.228821 3.38551 -0.228821 1.75735 0.686462 0.753148Z" fill="#212121"/>
                    </svg>
                   </div>
                </div>
                <?php $footer2 = \App\Models\FooterPage::where('page_id', 2)->get(['title','value']); ?>
                <ul class="footer-ul-part d-md-block">
                    @foreach($footer2 as $fo2)
                    <li>
                        <a href="{{ url($fo2->value)}}">{{ ($fo2->title != "")?$fo2->title:$fo2->value }}</a>
                    </li>
                    
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 footer-col mb-md-0">
                <div class="footer-heading mb-4 mb-md-4 d-flex justify-content-between">
                    contact
                    <div class="footer-angle d-block d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 50 30" fill="none" class="float-end">
                        <path d="M0.686462 0.753148C1.60174 -0.251049 3.08575 -0.251049 4.00103 0.753148L25 23.7919L45.9991 0.753148C46.9144 -0.251049 48.3982 -0.251049 49.3135 0.753148C50.2288 1.75735 50.2288 3.38551 49.3135 4.38971L26.6572 29.2468C25.7419 30.2511 24.2582 30.2511 23.3428 29.2468L0.686462 4.38971C-0.228821 3.38551 -0.228821 1.75735 0.686462 0.753148Z" fill="#212121"/>
                    </svg>
                   </div>
                </div>
                <?php $footer3 = \App\Models\FooterPage::where('page_id', 3)->get(['title','value']); ?>
                <ul class="footer-ul-part d-md-block">
                    @foreach($footer3 as $fo3)
                    <li>
                        <a href="{{ url($fo3->value)}}">{{ ($fo3->title != "")?$fo3->title:$fo3->value }}</a>
                    </li>
                    @endforeach
                    <li>
                        <a href="tel:+91{{ $settings->company_mobile_no }}"><i class="fa fa-phone"></i> +91 {{ $settings->company_mobile_no }}</a>
                    </li>
                    <li >
                        <a class="text-transform: lowercase;" href="mailto:{{ $settings->company_email }}"><i class="fa fa-envelope"></i> {{ $settings->company_email }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-address-card"></i> {{ $settings->company_address }}</a>
                    </li>
                </ul>
                <div class="mb-2 mb-md-4">
                    <div class="footer-part-heading mb-2">Follow Us</div>
                    <ul class="footer-social-media-icons">
                        @if($settings->instagram_url != "")
                        <li>
                            <a href="{{ $settings->instagram_url}}" target="_blank">
                                <img src="{{ asset('frontend/image/instagram.png') }}" alt="Instagram">
                            </a>
                        </li>
                        @endif
                        @if($settings->youtub_url != "")
                        <li>
                            <a href="{{ $settings->youtub_url}}" target="_blank">
                                <img src="{{ asset('frontend/image/youtube.png') }}" alt="Youtube">
                            </a>
                        </li>
                        @endif
                        @if($settings->facebook_url != "")
                        <li>
                            <a href="{{ $settings->facebook_url}}" target="_blank">
                                <img src="{{ asset('frontend/image/facebook.png') }}" alt="Facebook">
                            </a>
                        </li>
                        @endif
                        @if($settings->twiter_url != "")
                        <li class="me-0">
                            <a href="{{ $settings->twiter_url}}" target="_blank">
                                <img src="{{ asset('frontend/image/pinterest.png') }}" alt="Pinterest">
                            </a>
                        </li>
                        @endif 
                    </ul>
                </div>
            </div>
            <div class="col-md-5 footer-col mb-2 mb-md-4">
                <div class="footer-heading mb-4 mb-md-4 d-flex justify-content-between">
                    Newsletter
                </div>
                <p class="footer-paragraph mb-3">Sign up to receive infrequent emails about sample sales, special deals, and new releases.</p>
                <div class="mb-4 mb-md-5">
                    <form action="test" method="post" id="NewsLatterForm">
                        @csrf
                        <div class="alert alert-success" id="success-alert-newslatter" style="display: none;">
                        </div>
                        <div class="d-flex">
                            <span class="email_input mb-0 d-inline-block"> 
                                <input type="text" required="required" name="newslatteremail" id="newslatteremail" placeholder="email address">
                            </span>
                            <span class="ms-2">
                                <button type="submit" id="save_newNewsLatterBtn" class="submit_btn">submit</button>
                            </span>
                        </div>
                        <div id="newslatteremail-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </form>    
                </div>
                <div class="footer-paymentbox mb-4">
                    <div class="footer-heading mb-2 mb-md-2 d-flex justify-content-between">
                        Payments Accepted
                    </div>
                    <img src="{{ asset('frontend/image/payment_method.png') }}" alt="Payments Accepted" loading="lazy">
                </div>
            </div>
        </div>
        <input type="hidden" value="{{asset('frontend/')}}" id="asset" name="asset">
        <div class="footer-copyright-text text-center">
            ©2023 Gemver. All Rights Reserved
        </div>
    </div>
</footer>

    <a href="https://api.whatsapp.com/send?phone=+91{{ $settings->company_mobile_no }}&text=Hello" target="_blank" class="chat-icon-part">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 24 24" width="24px" height="24px">    <path d="M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z"/></svg>
    </a>

    

    <a class="bottom-to-top-btn scrollToTop" href="" style="">
        <svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#0B1727"></path></svg>
    </a>

<script type="text/javascript">
$( document ).ready(function() { 
       
$('body').on('click', '#save_newNewsLatterBtn', function () {
    save_newslatter($(this),'save_new');
});

function save_newslatter(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#NewsLatterForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('frontend.newslatter.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
           
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                if (res.errors.newslatteremail) {
                    $('#newslatteremail-error').show().text(res.errors.newslatteremail);
                } else {
                    $('#newslatteremail-error').hide();
                }

            }
            if(res.status == 200){
                $('#newslatteremail-error').hide();
                document.getElementById("NewsLatterForm").reset();
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                //location.href="{{ route('frontend.contactus')}}";
                var success_message = 'Thank You For subscribe';
                $('#success-alert-newslatter').text(success_message);
                $("#success-alert-newslatter").fadeTo(2000, 500).slideUp(500, function() {
                  $("#success-alert-newslatter").slideUp(1000);
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
