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
                   Sign up
                </div>
                <div>
                <form method="post" id="registerForm">
                    {{ csrf_field() }}     
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter your Name <span class="text-danger">*</span></label>
                        <input type="name" class="form-control" name="name" id="name" placeholder="Enter your name">
                        <div id="name-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="mb-3 email_text">
                        <label for="email" class="form-label">Enter your Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email">
                        <div id="email-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="mb-3 password_text">
                        <label for="password" class="form-label">Enter Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="**********">
                        <div id="password-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                   <div class="login_btn mt-3 mt-md-4 mt-xl-5">
                        <button class="login_button" type="submit" id="RegisterSubmit">Sign up <i class="fa fa-spinner fa-spin loadericonfa" style="display:none;"></i></button>
                   </div>
                </form>   
                   <div class="sign_up_now_text mt-3 mt-xxl-5 text-center"> 
                        Already have an account?
                        <a href="{{ url('/login') }}" class="sign_up_now_color">
                            <span class="sign_up_now_color">Log In</span>
                        </a>
                   </div>
                </div>
            </div>
       </div>
    </div>
</div>

<!--register page JS start -->
<script type="text/javascript">
    $('#registerForm').on('submit', function (e) {
        $("#name-error").html("");
        $("#email-error").html("");
        $("#password-error").html("");
        var thi = $(this);
        $('#RegisterSubmit').find('.loadericonfa').show();
        $('#RegisterSubmit').prop('disabled',true);
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: "{{ route('frontend.postregister') }}",
            data: formData,
            success: function (res) {
                console.log(res);
                if(res.status == 'failed'){
                    $('#RegisterSubmit').find('.loadericonfa').hide();
                    $('#RegisterSubmit').prop('disabled',false);
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
                    if (res.errors.password) {
                        $('#password-error').show().text(res.errors.password);
                    } else {
                        $('#password-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#RegisterSubmit').prop('disabled',false);
                    toastr.success("You have Successfully Register",'Success',{timeOut: 5000});
                    location.href ="{{ url('/login') }}";
                    //return redirect()->back();
                }

                if(res.status == 400){
                    $('#RegisterSubmit').find('.loadericonfa').hide();
                    $('#RegisterSubmit').prop('disabled',false);
                    toastr.error("Opps! You have entered invalid credentials",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#RegisterSubmit').find('.loadericonfa').hide();
                $('#RegisterSubmit').prop('disabled',false);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
</script>
<!--register page JS end -->
  

@endsection()
