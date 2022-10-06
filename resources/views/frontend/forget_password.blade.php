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
                    Forget Password
                </div>
                <div>
                <form method="post" id="ForgetForm">
                        {{ csrf_field() }} 
                    <div class="mb-3">
                        <label for="email" class="form-label">Enter your Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email">
                        <div id="email-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                   <div class="login_btn mt-3 mt-md-4 mt-xl-5">
                        <button class="login_button" type="submit" id="forgetSubmit">Submit <i class="fa fa-spinner fa-spin loadericonfa" style="display:none;"></i></button>
                   </div>
                   <div class="sign_up_now_text mt-3 mt-xxl-5 text-center"> 
                        <a href="{{ url('/login') }}" class="sign_up_now_text mt-3 mt-xxl-5 text-center">
                            Continue to Log In
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
    $('#ForgetForm').on('submit', function (e) {
        $("#email-error").html("");
        $("#password-error").html("");
        var thi = $(this);
        $('#forgetSubmit').find('.loadericonfa').show();
        $('#forgetSubmit').prop('disabled',true);
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: "{{ route('frontend.postforgetpassword') }}",
            data: formData,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#forgetSubmit').find('.loadericonfa').hide();
                    $('#forgetSubmit').prop('disabled',false);
                    if (res.errors.email) {
                        $('#email-error').show().text(res.errors.email);
                    } else {
                        $('#email-error').hide();
                    }
                }
                if(res.status == 200){
                    $('#forgetSubmit').prop('disabled',false);
                    toastr.success("You have Successfully loggedin",'Success',{timeOut: 5000});
                    location.href ="{{ url('/messagebox') }}";
                    //return redirect()->back();
                }

                if(res.status == 400){
                    $('#forgetSubmit').find('.loadericonfa').hide();
                    $('#forgetSubmit').prop('disabled',false);
                    toastr.error("Opps! You have entered invalid credentials",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#forgetSubmit').find('.loadericonfa').hide();
                $('#forgetSubmit').prop('disabled',false);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
</script>
<!--login page JS end -->
  

@endsection()
