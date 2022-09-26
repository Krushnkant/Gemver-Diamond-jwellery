@extends('frontend.layout.layout')

@section('content')

<div class="background-sub-slider">
            <div class="">
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3"> Checkout</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">Checkout </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <div class="container my-5 address_form_part">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="address_heading mb-4">Other Addresses</div>
                <div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-4 mb-4 radio_button_address">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" checked>
                    <label class="form-check-label d-flex" for="flexRadioDefault3">
                        <span class="ms-2">
                            <div class="radio_button_part">
                                Krushnkant Vadadoriya
                            </div>
                            <div class="radio_button_paragraph">
                                406, Anupam The Bussiness Hub, Nr. Dheeraj Sons, Yogichowk,SURAT,Gujrat,395006,India
                            </div>
                        </span>
                    </label>
                </div>
                <div class="form-check mb-4 radio_button_address">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked>
                    <label class="form-check-label d-flex" for="flexRadioDefault4">
                        <span class="ms-2">
                            <div class="radio_button_part">
                                WEB Vedant
                            </div>
                            <div class="radio_button_paragraph">
                                406, Anupam The Bussiness Hub, Nr. Dheeraj Sons, Yogichowk,SURAT,Gujrat,395006,India
                            </div>
                        </span>
                    </label>
                </div>
                <button type="button" class="mb-3 add_new_address_btn px-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="700pt" height="700pt" version="1.1" viewBox="0 0 700 700" class="plus_icon">
                        <path d="m350 520.01c-7.2461 0-13.125-5.8789-13.125-13.125v-213.76h-213.76c-7.2461 0-13.125-5.8789-13.125-13.125s5.8789-13.125 13.125-13.125h213.76v-213.76c0-7.2461 5.8789-13.125 13.125-13.125s13.125 5.8789 13.125 13.125v213.76h213.76c7.2461 0 13.125 5.8789 13.125 13.125s-5.8789 13.125-13.125 13.125h-213.76v213.76c0 7.2461-5.8789 13.125-13.125 13.125z"/>
                    </svg> -->
                     + Add New Address
                </button>   

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-md-6">
                                <div class="address_heading">Billing Details</div>
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>    
                            </div>
                            <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                            
                        </div>
                        <div class="modal-body">
                            <form action="">
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-6 mb-3 mb-md-0 popup_padding">
                                            <label for="" class="form-label form_heading">First name</label>
                                            <input type="email" class="form-control" id="" placeholder="Emily">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label form_heading">Last name</label>
                                            <input type="email" class="form-control" id="" placeholder="John">
                                        </div>
                                    </div>
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label for="" class="form-label form_heading">Email Address</label>
                                            <input type="email" class="form-control" id="" placeholder="Emilyjohn1212@gmail.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label form_heading">Phone</label>
                                            <input type="email" class="form-control" id="" placeholder="123-456-789">
                                        </div>
                                       
                                    </div>
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-12">
                                            <label for="" class="form-label form_heading">Street Address</label>
                                            <input type="email" class="form-control mb-3" id="" placeholder="House number and street name">
                                            <input type="email" class="form-control" id="" placeholder="House number and street name">
                                        </div>
                                    </div>
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label for="" class="form-label form_heading">Town / City</label>
                                            <input type="email" class="form-control" id="" placeholder="Surat">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label form_heading">STATE</label>
                                            <input type="email" class="form-control" id="" placeholder="Gujarat">
                                        </div>
                                    </div>
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label for="" class="form-label form_heading">Country / Region</label>
                                            <input type="email" class="form-control" id="" placeholder="India">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label form_heading">PIN CODE</label>
                                            <input type="email" class="form-control" id="" placeholder="395010">
                                        </div>
                                    </div>
                            </form>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                        </div>
                    </div>
                </div>

              

            <div class="col-md-12 col-lg-6 ps-md-3 ps-lg-5">
                <div class="your_order_box">
                    <div class="your_order_heading sub_heading mb-lg-3 mb-md-3 mb-lg-2 mb-xxl-4"> Your order</div>
                    <div class="row your_order_row">
                       <div class="col-6 px-0">
                            <div class="your_order_sub_heading">
                                Product
                            </div>   
                       </div>
                       <div class="col-6 text-end">
                            <div class="your_order_sub_heading">
                                Subtotal    
                            </div>   
                       </div>
                    </div>
                    <div class="row your_order_row">
                       <div class="col-6 px-0">
                            <div class="your_order_sub_heading">
                                New Product ✖ 1
                            </div>   
                       </div>
                       <div class="col-6 text-end">
                            <div class="your_order_sub_heading">
                                $ 999.00
                            </div>   
                       </div>
                    </div>
                    <div class="row your_order_row">
                       <div class="col-6 px-0">
                            <div class="your_order_sub_heading">
                                Subtotal
                            </div>   
                       </div>
                       <div class="col-6 text-end">
                            <div class="your_order_sub_heading">
                                $ 999.00 
                            </div>   
                       </div>
                    </div>
                    <div class="row your_order_row">
                       <div class="col-6 px-0">
                            <div class="your_order_sub_heading">
                                Total
                            </div>   
                       </div>
                       <div class="col-6 text-end">
                            <div class="your_order_sub_heading">
                                $ 999.00
                            </div>   
                       </div>
                    </div>
                    <!-- <div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-5 mb-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label d-flex" for="flexRadioDefault1">
                            <img src="{{ asset('frontend/image/cash_on_delivery.png') }}" alt="" class="radio_button_img">
                            <span class="ms-2">
                                <div class="radio_button_part">
                                    Cash on Delivery
                                </div>
                                <div class="radio_button_paragraph">
                                    Pay with cash upon delivery.
                                </div>
                            </span>
                        </label>
                        </div> -->
                        <div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-5 mb-4 ps-0">
                            <!-- <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked> -->
                            <label class="form-check-label d-flex" for="flexRadioDefault2">
                                <img src="{{ asset('frontend/image/paypal_icon.png') }}" alt="" class="radio_button_img">
                                <span class="ms-2">
                                    <div class="radio_button_part">
                                        Pay via by Paypal
                                    </div>
                                    <div class="radio_button_paragraph">
                                        Cards, Netbanking, Wallet & UPI 
                                    </div>
                                </span>
                            </label>
                        </div>
                    <div class="place_order_paragraph mt-4 mb-4">
                        Your personal data will be uesd to process your order, support your experience
                        throughout this website, and for other purposes described in our privacy policy.
                    </div>
                    <button type="button" class="btn btn-primary place_order_btn">Place Order</button>
                </div>
            </div>
        </div>
    </div>
@endsection()
