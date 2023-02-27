@extends('admin.auth.layout')

@section('content')

    <div class="row admin-login-row">
        <div class="col-xl-8 offset-xl-2 h-100 align-self-center">
            <div class="admin-login-box card justify-content-center mb-0">
                <div class="row">   
                    <div class="col-lg-6 pr-lg-0">
                        <div class="form-input-content">
                            <div class="login-form mb-0 ">
                                <div class="card-body pt-5 mt-5 admin-card-body">
                                    @if(\Illuminate\Support\Facades\Session::has('success'))
                                        <div class="alert alert-danger">
                                            {{ \Illuminate\Support\Facades\Session::get('success') }}
                                            @php
                                                \Illuminate\Support\Facades\Session::forget('success');
                                            @endphp
                                        </div>
                                    @endif
                                   <div class="gemver-logo">
                                        <img src="{{ asset('frontend/image/admin_banner/logo.png') }}">
                                   </div>
                                    <h4 class="create-account-heading">Admin Login</h4>

                                    <form method="post" action="" class="mt-5 mb-5 login-input" id="LoginForm">
                                        {{ csrf_field() }}
                                        <div class="form-group custom-form-label">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Id"  value="{{ old('email') }}" autocomplete="off">
                                            <div id="email-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                        <div class="form-group custom-form-label">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control password-input" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
                                            <div id="password-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                        <button class="btn login-form__btn submit w-100 sign-up-btn" type="submit" id="loginSubmit">Login<i class="fa fa-spinner fa-spin loadericonfa" style="display:none;"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pl-lg-0">
                        <div class="owl-carousel owl-theme signup-slider">
                                <div class="item">
                                    <img src="{{ asset('frontend/image/admin_banner/admin_banner_5.png') }}">
                                </div>
                                <div class="item">
                                    <img src="{{ asset('frontend/image/admin_banner/admin_banner_1.png') }}">
                                </div>
                                <div class="item">
                                    <img src="{{ asset('frontend/image/admin_banner/admin_banner_4.png') }}">
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
