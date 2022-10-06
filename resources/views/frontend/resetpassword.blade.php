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
                    RESET PASSWORD
                </div>
                <div>
                <form method="post" id="ResetForm">
                    {{ csrf_field() }}    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="password" class="form-control" id="password" name="password" placeholder="********" value="{{ old('password') }}">
                        <div id="password-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="mb-3 password_text">
                        <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="********" value="{{ old('confirm_password') }}">
                        <div id="confirm_password-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                       
                    </div>
                   <div class="login_btn mt-3 mt-md-4 mt-xl-5">
                        <button class="login_button" type="submit" id="resetSubmit">SAVE NEW PASSWORD <i class="fa fa-spinner fa-spin loadericonfa" style="display:none;"></i></button>
                   </div>
                  
                </form>   
                </div>
            </div>
       </div>
    </div>
</div>



<!--login page JS start -->
<script type="text/javascript">
    $('#ResetForm').on('submit', function (e) {
        $("#email-error").html("");
        $("#password-error").html("");
        var thi = $(this);
        $('#resetSubmit').find('.loadericonfa').show();
        $('#resetSubmit').prop('disabled',true);
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: "{{ route('frontend.postresetpassword') }}",
            data: formData,
            success: function (res) {
                console.log(res);
                if(res.status == 'failed'){
                    $('#resetSubmit').find('.loadericonfa').hide();
                    $('#resetSubmit').prop('disabled',false);
                   
                    if (res.errors.password) {
                        $('#password-error').show().text(res.errors.password);
                    } else {
                        $('#password-error').hide();
                    }

                    if (res.errors.confirm_password) {
                        $('#confirm_password-error').show().text(res.errors.confirm_password);
                    } else {
                        $('#confirm_password-error').hide();
                    }
                }
                if(res.status == 200){
                    $('#resetSubmit').prop('disabled',false);
                    toastr.success("You have Successfully Reset Password",'Success',{timeOut: 5000});
                    location.href ="{{ url('/') }}";
                    //return redirect()->back();
                }

                if(res.status == 400){
                    $('#resetSubmit').find('.loadericonfa').hide();
                    $('#resetSubmit').prop('disabled',false);
                    toastr.error("Opps! You have entered invalid credentials",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#resetSubmit').find('.loadericonfa').hide();
                $('#resetSubmit').prop('disabled',false);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
</script>
<!--login page JS end -->

@endsection()
