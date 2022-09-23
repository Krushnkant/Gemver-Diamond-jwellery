@extends('frontend.layout.layout')

@section('content')

<div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3"> Checkout</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">Address </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <div class="container my-5 address_form_part">
        <div class="row">
            <div class="col-md-12 col-lg-6">
               <div class="address_heading mb-4">Billing Details</div>
               <form action="">
                    <div class="row mb-3 mb-md-4">
                        <div class="col-md-6 ps-0 mb-3 mb-md-0">
                            <label for="" class="form-label form_heading">First name</label>
                            <input type="email" class="form-control" id="" placeholder="Emily">
                        </div>
                        <div class="col-md-6 pe-0 ps-0 ps-md-3">
                            <label for="" class="form-label form_heading">Last name</label>
                            <input type="email" class="form-control" id="" placeholder="John">
                        </div>
                    </div>
                    <div class="row mb-3 mb-md-4">
                        <div class="col-md-6 ps-0">
                            <label for="" class="form-label form_heading">Country / Region</label>
                            <input type="email" class="form-control" id="" placeholder="India">
                        </div>
                    </div>
                    <div class="row mb-3 mb-md-4">
                        <div class="col-md-12 ps-0">
                            <label for="" class="form-label form_heading">Street Address</label>
                            <input type="email" class="form-control mb-4" id="" placeholder="House number and street name">
                            <input type="email" class="form-control" id="" placeholder="House number and street name">
                        </div>
                    </div>
                    <div class="row mb-3 mb-md-4">
                        <div class="col-md-12 ps-0">
                            <label for="" class="form-label form_heading">Town / City</label>
                            <input type="email" class="form-control" id="" placeholder="Surat">
                        </div>
                    </div>
                    <div class="row mb-3 mb-md-4">
                        <div class="col-md-12 ps-0">
                            <label for="" class="form-label form_heading">STATE</label>
                            <input type="email" class="form-control" id="" placeholder="Gujarat">
                        </div>
                    </div>
                    <div class="row mb-3 mb-md-4">
                        <div class="col-md-12 ps-0">
                            <label for="" class="form-label form_heading">PIN CODE</label>
                            <input type="email" class="form-control" id="" placeholder="395010">
                        </div>
                    </div>
                    <div class="row mb-3 mb-md-4">
                        <div class="col-md-12 ps-0">
                            <label for="" class="form-label form_heading">Phone</label>
                            <input type="email" class="form-control" id="" placeholder="123-456-789">
                        </div>
                    </div>
                    <div class="row mb-3 mb-md-4">
                        <div class="col-md-12 ps-0">
                            <label for="" class="form-label form_heading">Email Address</label>
                            <input type="email" class="form-control" id="" placeholder="Emilyjohn1212@gmail.com">
                        </div>
                    </div>
               </form>
            </div>
            <div class="col-md-6 ps-5">
                <div class="your_order_box">
                    <div class="your_order_heading sub_heading mb-lg-3"> Your order</div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection()
