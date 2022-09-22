@extends('frontend.layout.layout')

@section('content')

<div class="container">
    <div class="Login_page_box my-5">
       <div class="row align-items-center">
            <div class="col-md-6 px-0">
                <img src="{{ url('frontend/image/login_img.png') }}" alt="">
            </div>
            <div class="col-md-6 login_padding mt-3 mt-md-0">
                <div class="login_page_heading text-center mb-3 mb-md-5">
                  Login In
                </div>
                <div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter your Name</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Emilyjohn1212@gmail.com">
                    </div>
                    <div class="mb-3 password_text">
                        <label for="exampleFormControlInput1" class="form-label">Enter your Email</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="**********">
                    </div>
                    <div class="mb-3 password_text">
                        <label for="exampleFormControlInput1" class="form-label">Enter Password</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="**********">
                        <div class="forgot_password_text text-end mt-3">
                            Forgot Password?
                        </div>
                    </div>
                   <div class="login_btn mt-3 mt-xl-5">
                        <button type="button" class="login_button">Sign up</button>
                   </div>
                   <div class="sign_up_now_text mt-3 mt-xxl-5 text-center"> 
                        Don’t have an account? 
                        <span class="sign_up_now_color">Sign up now</span>
                   </div>
                </div>
            </div>
       </div>
    </div>
</div>
  

@endsection()
