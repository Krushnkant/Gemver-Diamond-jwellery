@extends('frontend.layout.layout')

@section('content')

<div class="container">
    <div class="Login_page_box my-5">
       <div class="row align-items-center">
            <div class="col-md-6 px-0">
                <img src="{{ url('frontend/image/login_img.png') }}" alt="">
            </div>
            <div class="col-md-6 login_padding mt-3 mt-md-0">
                <div class="login_page_heading text-center mb-3 mb-md-4 mb-xl-5">
                    Log In
                </div>
                <div>
                <form method="post" id="LoginForm">
                    {{ csrf_field() }}    
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                        <div id="email-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="mb-3 password_text">
                        <label for="exampleFormControlInput1" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
                        <div id="password-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <div class="forgot_password_text text-end mt-3">
                            <a href="{{ url('forget-password') }}" class="forgot_password_text">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
                   <div class="login_btn mt-3 mt-md-4 mt-xl-5">
                        <button class="login_button" type="submit" id="loginSubmit">Sign In <i class="fa fa-spinner fa-spin loadericonfa" style="display:none;"></i></button>
                   </div>
                   <div class="sign_up_now_text mt-3 mt-xxl-5 text-center"> 
                        Don’t have an account? 
                        <a href="{{ url('/register') }}" class="sign_up_now_color">
                            <span class="sign_up_now_color">Sign up now</span>
                        </a>
                   </div>
                </form>   
                </div>
            </div>
       </div>
    </div>
</div>



<!--login page JS start -->
<script type="text/javascript">
    $('#LoginForm').on('submit', function (e) {
        $("#email-error").html("");
        $("#password-error").html("");
        var thi = $(this);
        $('#loginSubmit').find('.loadericonfa').show();
        $('#loginSubmit').prop('disabled',true);
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: "{{ route('frontend.postlogin') }}",
            data: formData,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#loginSubmit').find('.loadericonfa').hide();
                    $('#loginSubmit').prop('disabled',false);
                    if (res.errors.email) {
                        $('#email-error').show().text(res.errors.email);
                    } else {
                        $('#email-error').hide();
                    }
                    if (res.errors.password) {
                        $('#password-error').show().text(res.errors.password);
                    } else {
                        $('#password-error').hide();
                    }
                }
                if(res.status == 200){
                    $('#loginSubmit').prop('disabled',false);
                    toastr.success("You have Successfully loggedin",'Success',{timeOut: 5000});
                    location.href ="{{ url('/account') }}";
                }

                if(res.status == 300){
                    $('#loginSubmit').find('.loadericonfa').hide();
                    $('#loginSubmit').prop('disabled',false);
                    toastr.error("Your Account is Deactive..Please Contact Admin",'Error',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#loginSubmit').find('.loadericonfa').hide();
                    $('#loginSubmit').prop('disabled',false);
                    toastr.error("Opps! You have entered invalid credentials",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#loginSubmit').find('.loadericonfa').hide();
                $('#loginSubmit').prop('disabled',false);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
</script>
<!--login page JS end -->

@endsection()
