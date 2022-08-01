<footer class="footer-part-section">
    <div class="container">
            <div class="row mb-md-5 pb-4 pb-md-3">
                <div class="col-lg-3">
                    <div class="footer-logo mb-3">
                        <img src="{{ URL('images/company/'.$settings->company_logo) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <div class="footer-part-heading mb-3">newsletter</div>
                        <p class="footer-paragraph mb-3">Sign up to receive infrequent emails about <br>sample sales, special deals, and new releases.</p>
                        <div>
                        <form action="test" method="post" id="NewsLatterForm">
                            @csrf
                            <div class="alert alert-success" id="success-alert-newslatter" style="display: none;">
                            </div>
                            <span class="email_input mb-3 mb-md-0 d-inline-block"> 
                                <input type="text" required="required" name="newslatteremail" id="newslatteremail" placeholder="email address">
                            </span>
                            <span class="ms-md-2">
                                <button type="submit" id="save_newNewsLatterBtn" class="submit_btn">submit</button>
                            </span>
                            <div id="newslatteremail-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </form>    
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-lg-end text-start mt-3 mt-lg-0">
                    <div class="footer-part-heading mb-3">stay in touch !</div>
                    <ul class="footer-social-media-icons">
                        @if($settings->instagram_url != "")
                        <li>
                            <a href="{{ $settings->instagram_url}}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.34659 0.075C8.67955 0.0136363 9.10455 0 12.5 0C15.8955 0 16.3205 0.0147727 17.6523 0.075C18.9841 0.135227 19.8932 0.347727 20.6886 0.655682C21.5216 0.970455 22.2773 1.4625 22.9023 2.09886C23.5386 2.72273 24.0295 3.47727 24.3432 4.31136C24.6523 5.10682 24.8636 6.01591 24.925 7.34545C24.9864 8.68068 25 9.10568 25 12.5C25 15.8955 24.9852 16.3205 24.925 17.6534C24.8648 18.983 24.6523 19.892 24.3432 20.6875C24.0295 21.5217 23.5378 22.2775 22.9023 22.9023C22.2773 23.5386 21.5216 24.0295 20.6886 24.3432C19.8932 24.6523 18.9841 24.8636 17.6545 24.925C16.3205 24.9864 15.8955 25 12.5 25C9.10455 25 8.67955 24.9852 7.34659 24.925C6.01705 24.8648 5.10795 24.6523 4.3125 24.3432C3.47832 24.0295 2.72252 23.5378 2.09773 22.9023C1.4618 22.278 0.969676 21.5226 0.655682 20.6886C0.347727 19.8932 0.136364 18.9841 0.075 17.6545C0.0136363 16.3193 0 15.8943 0 12.5C0 9.10455 0.0147727 8.67955 0.075 7.34773C0.135227 6.01591 0.347727 5.10682 0.655682 4.31136C0.97014 3.47737 1.46263 2.72195 2.09886 2.09773C2.72277 1.46193 3.47781 0.969822 4.31136 0.655682C5.10682 0.347727 6.01591 0.136364 7.34545 0.075H7.34659ZM17.5511 2.325C16.233 2.26477 15.8375 2.25227 12.5 2.25227C9.1625 2.25227 8.76705 2.26477 7.44886 2.325C6.22955 2.38068 5.56818 2.58409 5.12727 2.75568C4.54432 2.98295 4.12727 3.25227 3.68977 3.68977C3.27505 4.09324 2.95589 4.58441 2.75568 5.12727C2.58409 5.56818 2.38068 6.22955 2.325 7.44886C2.26477 8.76705 2.25227 9.1625 2.25227 12.5C2.25227 15.8375 2.26477 16.233 2.325 17.5511C2.38068 18.7705 2.58409 19.4318 2.75568 19.8727C2.95568 20.4148 3.275 20.9068 3.68977 21.3102C4.09318 21.725 4.58523 22.0443 5.12727 22.2443C5.56818 22.4159 6.22955 22.6193 7.44886 22.675C8.76705 22.7352 9.16136 22.7477 12.5 22.7477C15.8386 22.7477 16.233 22.7352 17.5511 22.675C18.7705 22.6193 19.4318 22.4159 19.8727 22.2443C20.4557 22.017 20.8727 21.7477 21.3102 21.3102C21.725 20.9068 22.0443 20.4148 22.2443 19.8727C22.4159 19.4318 22.6193 18.7705 22.675 17.5511C22.7352 16.233 22.7477 15.8375 22.7477 12.5C22.7477 9.1625 22.7352 8.76705 22.675 7.44886C22.6193 6.22955 22.4159 5.56818 22.2443 5.12727C22.017 4.54432 21.7477 4.12727 21.3102 3.68977C20.9067 3.27508 20.4156 2.95592 19.8727 2.75568C19.4318 2.58409 18.7705 2.38068 17.5511 2.325V2.325ZM10.9034 16.3534C11.7951 16.7246 12.7879 16.7747 13.7124 16.4951C14.6369 16.2156 15.4357 15.6238 15.9723 14.8207C16.5089 14.0177 16.7501 13.0533 16.6546 12.0922C16.5591 11.1311 16.133 10.2329 15.4489 9.55114C15.0128 9.11531 14.4855 8.7816 13.9049 8.57403C13.3244 8.36646 12.705 8.29018 12.0915 8.3507C11.4779 8.41122 10.8854 8.60702 10.3566 8.92401C9.82779 9.241 9.37585 9.6713 9.0333 10.1839C8.69075 10.6965 8.46612 11.2787 8.37559 11.8886C8.28505 12.4984 8.33085 13.1208 8.5097 13.7108C8.68855 14.3008 8.996 14.8439 9.40991 15.3008C9.82382 15.7578 10.3339 16.1173 10.9034 16.3534ZM7.95682 7.95682C8.55344 7.3602 9.26173 6.88694 10.0412 6.56405C10.8208 6.24116 11.6563 6.07497 12.5 6.07497C13.3437 6.07497 14.1792 6.24116 14.9588 6.56405C15.7383 6.88693 16.4466 7.3602 17.0432 7.95682C17.6398 8.55344 18.1131 9.26173 18.436 10.0412C18.7588 10.8208 18.925 11.6563 18.925 12.5C18.925 13.3437 18.7588 14.1792 18.436 14.9588C18.1131 15.7383 17.6398 16.4466 17.0432 17.0432C15.8383 18.2481 14.204 18.925 12.5 18.925C10.796 18.925 9.16174 18.2481 7.95682 17.0432C6.75189 15.8383 6.07497 14.204 6.07497 12.5C6.07497 10.796 6.75189 9.16174 7.95682 7.95682V7.95682ZM20.35 7.03182C20.4978 6.89235 20.6162 6.72464 20.6981 6.53861C20.7799 6.35258 20.8236 6.15201 20.8266 5.94878C20.8296 5.74556 20.7917 5.5438 20.7153 5.35547C20.6389 5.16713 20.5255 4.99603 20.3818 4.85232C20.2381 4.7086 20.067 4.59518 19.8786 4.51877C19.6903 4.44236 19.4885 4.40452 19.2853 4.40748C19.0821 4.41044 18.8815 4.45415 18.6955 4.53602C18.5095 4.61788 18.3417 4.73624 18.2023 4.88409C17.931 5.17162 17.7825 5.55355 17.7883 5.94878C17.7941 6.34402 17.9536 6.72145 18.2331 7.00096C18.5126 7.28046 18.8901 7.44003 19.2853 7.44579C19.6805 7.45156 20.0625 7.30306 20.35 7.03182V7.03182Z" fill="white"/>
                                </svg>
                            </a>
                        </li>
                        @endif
                        @if($settings->youtub_url != "")
                        <li>
                            <a href="{{ $settings->youtub_url}}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                    <path d="M12.5 2.51595e-06C9.58548 -0.00184586 6.76191 1.01481 4.51753 2.87418C2.27315 4.73355 0.749042 7.31874 0.208749 10.1828C-0.331545 13.0468 0.145938 16.0096 1.55864 18.5588C2.97133 21.1081 5.23044 23.0836 7.94533 24.1438C7.83595 23.1547 7.73595 21.6344 7.98752 20.5547C8.21564 19.5781 9.45314 14.3406 9.45314 14.3406C9.45314 14.3406 9.0797 13.5922 9.0797 12.4859C9.0797 10.7469 10.0875 9.45 11.3422 9.45C12.4078 9.45 12.9235 10.25 12.9235 11.2109C12.9235 12.2828 12.2406 13.8859 11.8875 15.3719C11.5938 16.6156 12.5125 17.6313 13.7391 17.6313C15.961 17.6313 17.6688 15.2875 17.6688 11.9063C17.6688 8.91406 15.5172 6.82188 12.4469 6.82188C8.89064 6.82188 6.80314 9.48906 6.80314 12.2453C6.80314 13.3203 7.2172 14.4719 7.73283 15.0984C7.77723 15.1457 7.80863 15.2036 7.82397 15.2666C7.8393 15.3296 7.83805 15.3955 7.82033 15.4578C7.72502 15.8516 7.51408 16.7016 7.47345 16.875C7.41877 17.1031 7.2922 17.1516 7.0547 17.0422C5.4922 16.3156 4.5172 14.0328 4.5172 12.1984C4.5172 8.25625 7.38283 4.63594 12.7766 4.63594C17.1125 4.63594 20.4828 7.725 20.4828 11.8547C20.4828 16.1625 17.7656 19.6297 13.9969 19.6297C12.7297 19.6297 11.5391 18.9719 11.1313 18.1938L10.3531 21.1656C10.0703 22.2516 9.30783 23.6125 8.79845 24.4422C10.5172 24.9736 12.3303 25.1278 14.1141 24.8942C15.8978 24.6606 17.6101 24.0447 19.134 23.0886C20.6579 22.1325 21.9575 20.8588 22.944 19.3544C23.9305 17.85 24.5806 16.1504 24.85 14.3717C25.1193 12.593 25.0016 10.7771 24.5048 9.04805C24.008 7.31902 23.1438 5.7176 21.9714 4.35318C20.7989 2.98876 19.3457 1.8935 17.7111 1.14221C16.0765 0.390924 14.299 0.0013161 12.5 2.51595e-06V2.51595e-06Z" fill="white"/>
                                </svg>
                            </a>
                        </li>
                        @endif
                        @if($settings->facebook_url != "")
                        <li>
                            <a href="{{ $settings->facebook_url}}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="25" viewBox="0 0 14 25" fill="none">
                                    <path d="M9.16671 8.33333V5.83333C9.16671 4.75 9.41671 4.16667 11.1667 4.16667H13.3334V0H10C5.83337 0 4.16671 2.75 4.16671 5.83333V8.33333H0.833374V12.5H4.16671V25H9.16671V12.5H12.8334L13.3334 8.33333H9.16671Z" fill="white"/>
                                </svg>
                            </a>
                        </li>
                        @endif
                        @if($settings->twiter_url != "")
                        <li class="me-0">
                            <a href="{{ $settings->twiter_url}}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                                    <path d="M25 4.97474C24.0806 5.38154 23.0802 5.67432 22.0496 5.78835C23.1196 5.13634 23.9208 4.10627 24.303 2.89141C23.299 3.50405 22.1991 3.93364 21.0522 4.16113C20.5728 3.63545 19.993 3.21667 19.3489 2.93088C18.7049 2.64509 18.0104 2.49842 17.3086 2.50001C14.4694 2.50001 12.186 4.86071 12.186 7.75765C12.186 8.16446 12.2341 8.57126 12.3122 8.96266C8.06093 8.7346 4.26932 6.65127 1.74859 3.46155C1.28928 4.26627 1.04859 5.18254 1.05156 6.11503C1.05156 7.93948 1.95589 9.54821 3.33494 10.4943C2.52225 10.4615 1.72859 10.2324 1.01851 9.82558V9.89029C1.01851 12.4451 2.77911 14.5624 5.12559 15.0493C4.68501 15.1667 4.23178 15.2268 3.77659 15.2281C3.4431 15.2281 3.12763 15.1942 2.80916 15.1479C3.45812 17.2313 5.34791 18.7445 7.59825 18.7938C5.83764 20.2083 3.63238 21.0404 1.23783 21.0404C0.808196 21.0404 0.411609 21.025 0 20.9757C2.27136 22.4704 4.96635 23.3333 7.86865 23.3333C17.2906 23.3333 22.4462 15.3267 22.4462 8.37711C22.4462 8.14905 22.4462 7.92099 22.4312 7.69293C23.4287 6.94404 24.303 6.01641 25 4.97474Z" fill="white"/>
                                </svg>
                            </a>
                        </li>
                        @endif
                    
                    </ul>
                </div>
            </div>
            <div class="line"></div>
            <div class="row mt-4 mt-md-5">
                <div class="col-sm-6 col-md-4 footer-col mb-4 mb-md-0">
                    <div class="footer-heading mb-4">about</div>
                    <ul>
                        <li>
                            <a href="#">our story</a>
                        </li>
                        <!-- <li>
                            <a href="#">our 3 pillars</a>
                        </li> -->
                        <li>
                            <a href="{{ Route('frontend.customervalues')}}">customer values</a>
                        </li>
                        <li>
                            <a href="{{ Route('frontend.testimonials') }}">testimonials</a>
                        </li>
                        <li>
                            <a href="{{ Route('frontend.blogs') }}">our blogs</a>
                        </li>
                        <li>
                            <a href="#">Virtual Experience</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-4 footer-col mb-4 mb-md-0">
                    <div class="footer-heading mb-4">Why Friendly ?</div>
                    <ul>
                        <li>
                            <a href="{{ Route('frontend.freeshipping') }}">Free Shipping </a>
                        </li>
                        <li>
                            <a href="{{ Route('frontend.returndays') }}">Free 30 day Returns</a>
                        </li>
                        <li>
                            <a href="{{ Route('frontend.lifetimeupgrade') }}">Lifetime Upgrade</a>
                        </li>
                        <li>
                            <a href="{{ Route('frontend.freeresizing') }}">Free Resizing</a>
                        </li>
                        <li>
                            <a href="{{ Route('frontend.lifetimewarranty') }}">Lifetime Warranty</a>
                        </li>
                        <li>
                            <a href="{{ Route('frontend.freeengraving') }}">Free Engraving</a>
                        </li>
                        <li>
                            <a href="{{ Route('frontend.paymentoptions') }}">Payment Options</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-4 footer-col mb-4 mb-md-0">
                    <div class="footer-heading mb-4">contact</div>
                    <ul>
                        <li>
                            <a href="{{ Route('frontend.contactus') }}">Contact Us</a>
                        </li>
                        <li>
                            <a href="tel:{{ $settings->phone_no }}">Call us</a>
                        </li>
                        <li>
                            <a href="#">Chat with us</a>
                        </li>
                        <li>
                            <a href="mailto:{{ $settings->company_email }}">Email us</a>
                        </li>
                    </ul>
                </div>
            </div>
            <input type="hidden" value="{{asset('frontend/')}}" id="asset" name="asset">
            <div class="footer-copyright-text text-center mt-md-5 pt-md-3 ">
                ©2022 {{ $settings->company_name }} . All Rights Reserved |
                <a href="{{ Route('frontend.termcondition') }}" class="mx-1">
                    Terms & Conditions |
                </a>
                <a href="{{ Route('frontend.privacypolicy') }}" class="mx-1">
                    Privacy Policy 
                </a>
            </div>
        </div>
    </footer>

    <a class="bottom-to-top-btn scrollToTop" href="" style="">
        <svg xmlns="http://www.w3.org/2000/svg" width="9" class="" height="13" viewBox="0 0 9 13" fill="none"><path d="M8.36767 6.49984L2.10726 0.239422L0.633301 1.7113L5.42497 6.49984L0.633301 11.2873L2.10622 12.7603L8.36767 6.49984Z" fill="#fff"></path></svg>
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
