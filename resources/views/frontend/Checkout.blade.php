@extends('frontend.layout.layout')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-dropdown.select2-dropdown--below {
            width: 0px !important;
        }

        .select2-dropdown.select2-dropdown--above {
            width: 0px !important;
        }

        .select2-container--default .select2-selection--single {
            height: 43px !important;
            padding: 8px 12px;
            border: 1px solid #F0F0F0;
            border-radius: 5px;
            font-size: 14px;
            color: #808080;
            box-shadow: none;
        }

        /* Adjust the rendered text line height */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px !important;
            /* Or use 46px for vertical centering */
            padding-left: 8px;
        }

        /* Arrow alignment */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            top: 0 !important;
        }
    </style>
    <div class="background-sub-slider">
        <div class="">
            <div class="about_us_background">
                <h1 class="sub_heading mb-lg-3"> Checkout</h1>
                <div class="about_us_link">
                    <a href="{{ URL('/') }}">home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none"
                        class="mx-2">
                        <path
                            d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z"
                            fill="white" />
                        <path
                            d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z"
                            fill="white" />
                    </svg>
                    <a href="#">Checkout </a>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="container my-5 address_form_part">

        <form action="{{ route('make.payment') }}" method="post" id="paymentForm">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12 col-lg-6 ">
                    <div class="address_heading mb-4">Other Addresses</div>
                    <div class="other_address row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-4 mb-4 radio_button_address">
                                <input class="form-check-input check_address" type="radio" name="check_address"
                                    id="check_address" checked value="new">
                                <label class="form-check-label d-flex" for="check_address">
                                    <span class="ms-2">
                                        <div class="radio_button_part">
                                            Add New Address
                                        </div>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-4 mb-4 radio_button_address">
                                <input class="form-check-input check_address" type="radio" name="check_address"
                                    id="check_address" value="existing">
                                <label class="form-check-label d-flex" for="check_address">
                                    <span class="ms-2">
                                        <div class="radio_button_part">
                                            Select Existing Address
                                        </div>
                                    </span>
                                </label>
                            </div>
                        </div>


                        {{-- <button type="button" class="mb-3 add_new_address_btn px-0" data-bs-toggle="modal" data-bs-target="#addressModal">
                     + Add New Address
                </button>  --}}

                        <div class="col-md-12 col-lg-6" id="other_address" style="display: none;">
                            @if ($address)
                                @foreach ($address as $addr)
                                    <div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-4 mb-4 radio_button_address">
                                        <input class="form-check-input new_address" type="radio" name="new_address"
                                            id="new_address" value="{{ $addr->id }}">
                                        <label class="form-check-label d-flex" for="new_address">
                                            <span class="ms-2">
                                                <div class="radio_button_part">
                                                    {{ $addr->first_name }} {{ $addr->last_name }}
                                                </div>
                                                <div class="radio_button_paragraph">
                                                    {{ $addr->address }},{{ $addr->city }},{{ $addr->state }},{{ $addr->pincode }},{{ $addr->country }}
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div id="add_address">

                        <div class="row mb-3 mb-md-4">
                            <div class="col-md-6 mb-3 mb-md-0 popup_padding">
                                <label for="" class="form-label form_heading">First Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="Enter Your First Name">
                                <div id="first_name-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                                <input type="hidden" name="user_id" value="{{ session('customer.id') }}"
                                    class="form-control" id="user_id">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label form_heading">Last Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Enter Your Last Name">
                                <div id="last_name-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                            </div>
                        </div>
                        <div class="row mb-3 mb-md-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="" class="form-label form_heading">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter Your Email Address">
                                <div id="email-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label form_heading">Phone <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                    placeholder="Enter Your Phone">
                                <div id="mobile_no-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                            </div>

                        </div>
                        <div class="row mb-3 mb-md-4">
                            <div class="col-md-12">
                                <label for="" class="form-label form_heading">Street Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control mb-3" id="address" name="address"
                                    placeholder="Enter Your Address">
                                <div id="address-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                                <input type="text" class="form-control" id="address2" name="address2"
                                    placeholder="Enter Your Address">
                                <div id="address2-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                            </div>
                        </div>
                        <div class="row mb-3 mb-md-4">
                            {{-- <div class="col-md-4 mb-3 mb-md-0">
                                <label for="" class="form-label form_heading">Country <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="country-dropdown" name="country">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option data-value="{{ $country->id }}" value="{{ $country->name }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="country-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                            </div>

                            <div class="col-md-4">
                                <label for="" class="form-label form_heading">State <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="state-dropdown" name="state">
                                </select>
                                <div id="state-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label form_heading">City <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="city-dropdown" name="city">
                                </select>
                                <div id="city-error" class="invalid-feedback animated fadeInDown" style="display: none;">
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <label class="form-label form_heading">Country <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="country-dropdown" name="country">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option data-value="{{ $country->id }}" value="{{ $country->name }}">
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <div id="country-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label form_heading">State <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="state-dropdown" name="state">
                                    <option value="">Select Country First</option>
                                </select>
                                <div id="state-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label form_heading">City <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="city-dropdown" name="city">
                                    <option value="">Select State First</option>
                                </select>
                                <div id="city-error" class="invalid-feedback animated fadeInDown" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mb-md-4">

                            <div class="col-md-12">
                                <label for="" class="form-label form_heading">ZIP Code <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="pincode" name="pincode"
                                    placeholder="Enter Your ZIP Code">
                                <div id="pincode-error" class="invalid-feedback animated fadeInDown"
                                    style="display: none;"></div>
                            </div>
                        </div>

                        {{-- <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             <button type="button" id="save_closeAddressBtn" class="btn btn-primary chnage_address_btn">Save changes <div class="spinner-border loadericonfa spinner-border-send-inquiry" role="status" style="display:none;">
                                 <span class="visually-hidden">Loading...</span>
                                 </div>
                             </button>
                         </div> --}}



                    </div>
                    {{-- <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                               <form id="AddressCreateForm" method="post">
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-6 mb-3 mb-md-0 popup_padding">
                                            <label for="" class="form-label form_heading">First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter Your First Name">
                                            <div id="first_name-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                            <input type="hidden" name="user_id" value="{{ session('customer.id') }}" class="form-control" id="user_id" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label form_heading">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Your Last Name">
                                            <div id="last_name-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label for="" class="form-label form_heading">Email Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email Address">
                                            <div id="email-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label form_heading">Phone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Your Phone">
                                            <div id="mobile_no-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                       
                                    </div>
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-12">
                                            <label for="" class="form-label form_heading">Street Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-3" id="address" name="address" placeholder="Enter Your Address">
                                            <div id="address-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                            <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter Your Address">
                                            <div id="address2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label for="" class="form-label form_heading">City <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter Your City">
                                            <div id="city-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label form_heading">State <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter Your State">
                                            <div id="state-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mb-md-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label for="" class="form-label form_heading">Country <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Your Country">
                                            <div id="country-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label form_heading">ZIP Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Your ZIP Code">
                                            <div id="pincode-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="save_closeAddressBtn" class="btn btn-primary chnage_address_btn">Save changes <div class="spinner-border loadericonfa spinner-border-send-inquiry" role="status" style="display:none;">
                                            <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
                          
                        </div>
                </div> --}}

                </div>




                <div class="col-md-12 col-lg-6 ps-md-3 ps-lg-5">
                    <div class="your_order_box">

                        <input type="hidden" name="address_id" value="" id="address_id">
                        <div class="your_order_heading sub_heading mb-lg-3 mb-md-3 mb-lg-2 mb-xxl-4"> Your order</div>
                        <div class="row your_order_row">
                            <div class="col-6 px-0">
                                <div class="your_order_sub_heading order-title">
                                    Product
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="your_order_sub_heading order-price">
                                    Subtotal
                                </div>
                            </div>
                        </div>
                        <div class="row your_order_row">
                            <?php
                            $total = 0;
                            ?>
                            @foreach ($carts as $cart)
                                <?php
                                
                                if (isset($cart['item_type']) && $cart['item_type'] == 2) {
                                    $item = \App\Models\ProductVariant::with('product', 'product_variant_variants.attribute_term.attribute')->where('estatus', 1)->where('id', $cart['item_id'])->first();
                                    $item_name = $item->product->product_title;
                                    $sale_price = $item->sale_price;
                                    $item_image = explode(',', $item->images);
                                    if (session()->has('customer')) {
                                        $specifications = json_decode($cart['specification'], true);
                                    } else {
                                        $specifications = $cart['specification'];
                                    }
                                
                                    $diamond = \App\Models\Diamond::where('id', $cart['diamond_id'])->first();
                                    $diamond_name = $diamond->Shape . ' ' . round($diamond->Weight, 2) . ' ct ';
                                
                                    $sale_price_diamond = $diamond->Sale_Amt;
                                    $item_image_diamond = explode(',', $diamond->Stone_Img_url);
                                    $url = '';
                                
                                    $sale_price = $sale_price + $sale_price_diamond;
                                } elseif (isset($cart['item_type']) && $cart['item_type'] == 0) {
                                    $item = \App\Models\ProductVariant::with('product', 'product_variant_variants.attribute_term.attribute')->where('estatus', 1)->where('id', $cart['item_id'])->first();
                                    $item_name = $item->product->product_title;
                                    $sale_price = $item->sale_price;
                                    $item_image = explode(',', $item->images);
                                    if (session()->has('customer')) {
                                        $specifications = json_decode($cart['specification'], true);
                                    } else {
                                        $specifications = $cart['specification'];
                                    }
                                
                                    $url = URL('/product-details/' . $item['slug']);
                                } else {
                                    $item = \App\Models\Diamond::where('id', $cart['item_id'])->first();
                                    $item_name = $item->Shape . ' ' . round($item->Weight, 2) . ' ct';
                                
                                    $sale_price = $item->Sale_Amt;
                                    $item_image = explode(',', $item->Stone_Img_url);
                                    $url = '';
                                }
                                
                                ?>
                                <div class="col-12 px-0 mb-3">
                                    <div class="row">
                                        <div class="col-6 px-0">
                                            <div class="your_order_sub_heading order-title">
                                                @php
                                                    $isCertified =
                                                        isset($cart['wants_certificate']) &&
                                                        $cart['wants_certificate'] == 1;
                                                    $certPrice =
                                                        $isCertified &&
                                                        isset($cart['certificate_price']) &&
                                                        is_numeric($cart['certificate_price'])
                                                            ? number_format((float) $cart['certificate_price'], 2)
                                                            : null;
                                                @endphp

                                                {{-- Display item name and quantity --}}
                                                @if (isset($cart['item_type']) && $cart['item_type'] == 2)
                                                    {{ $item_name }} | {{ $diamond_name }} ✖
                                                    {{ $cart['item_quantity'] }}
                                                @else
                                                    {{ $item_name }} ✖ {{ $cart['item_quantity'] }}
                                                @endif

                                                {{-- Show certification message if applicable --}}
                                                @if ($isCertified && $certPrice)
                                                    <div class="text-success mt-1 small">
                                                        @if (!empty($settings->certificate_description))
                                                            {{ $settings->certificate_description }}
                                                        @else
                                                            Diamond Certificate added for this item.
                                                        @endif
                                                        +
                                                        ${{ $certPrice * $cart['item_quantity'] }}
                                                        (${{ $certPrice }} * {{ $cart['item_quantity'] }} Qty)
                                                    </div>
                                                @endif

                                                {{-- Hidden fields for form submission --}}
                                                <input type="hidden" name="item[]" value="{{ $item->id }}">
                                                <input type="hidden" name="diamond_id[]"
                                                    value="{{ $cart['diamond_id'] }}">
                                                <input type="hidden" name="qty[]"
                                                    value="{{ $cart['item_quantity'] }}">
                                                <input type="hidden" name="item_type[]"
                                                    value="{{ $cart['item_type'] }}">
                                                <input type="hidden" name="certificate_price[]"
                                                    value="{{ isset($cart['certificate_price']) ? $cart['certificate_price'] * $cart['item_quantity'] : '' }}">
                                            </div>
                                        </div>

                                        <?php
                                        $certificatePrice = isset($cart['certificate_price']) && is_numeric($cart['certificate_price']) ? $cart['certificate_price'] * $cart['item_quantity'] : 0;
                                        ?>
                                        <div class="col-6 text-end">
                                            <div class="your_order_sub_heading order-price">
                                                $ {{ $sale_price * $cart['item_quantity'] + $certificatePrice }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $total = $total + $sale_price * $cart['item_quantity'] + $certificatePrice;
                                ?>
                            @endforeach

                        </div>
                        <div class="row your_order_row">
                            <div class="col-6 px-0">
                                <div class="your_order_sub_heading order-title">
                                    Subtotal
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="your_order_sub_heading order-price">
                                    $ {{ $total }}
                                    <input class="form-check-input" type="hidden" name="sub_totalcost"
                                        id="sub_totalcost" value="{{ $total }}">
                                </div>
                            </div>
                        </div>
                        <div class="row your_order_row">
                            <div class="col-6 px-0">
                                <div class="your_order_sub_heading order-title">
                                    Coupon Discount
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="your_order_sub_heading order-price">
                                    <?php
                                    if (session()->has('coupon')) {
                                        if (session('coupon.discount_type_id') == 1) {
                                            $coupan_discount_per = session('coupon.coupon_amount');
                                            $coupan_discount_amount = ($total * $coupan_discount_per) / 100;
                                        } else {
                                            $coupan_discount_amount = session('coupon.coupon_amount');
                                        }
                                    } else {
                                        $coupan_discount_amount = 0;
                                    }
                                    ?>
                                    $ {{ $coupan_discount_amount }}
                                </div>
                                <input class="form-check-input" type="hidden" name="coupan_discount"
                                    id="coupan_discount" value="{{ $coupan_discount_amount }}">
                                <input class="form-check-input" type="hidden" name="coupan_code_id" id="coupan_code_id"
                                    value="{{ session('coupon.id') }}">
                            </div>
                        </div>
                        @php
                            $withDiscountAmount = $total - $coupan_discount_amount;
                            $minOrderAmount = isset($settings->min_order_amount_for_free_shipping)
                                ? $settings->min_order_amount_for_free_shipping
                                : 0;
                            $defaultShipping = isset($settings->default_shipping_amount)
                                ? $settings->default_shipping_amount
                                : 0;

                            // Apply free shipping if order qualifies
                            $shippingCharge = $withDiscountAmount > $minOrderAmount ? 0 : $defaultShipping;

                            $finalPrice = $withDiscountAmount + $shippingCharge;
                        @endphp
                        <div class="row your_order_row">
                            <div class="col-6 px-0">
                                <div class="your_order_sub_heading order-title">
                                    Shipping Charge
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="your_order_sub_heading order-price">
                                    ${{ $shippingCharge }}
                                    <input class="form-check-input" type="hidden" name="shipping_charge"
                                        id="shipping_charge" value="{{ $shippingCharge }}">
                                </div>
                            </div>
                        </div>
                        <div class="row your_order_row">
                            <div class="col-6 px-0">
                                <div class="your_order_sub_heading order-title">
                                    Total
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="your_order_sub_heading order-price">
                                    $ {{ $finalPrice }}
                                    <input class="form-check-input" type="hidden" name="payble_ordercost"
                                        id="payble_ordercost" value="{{ $finalPrice }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-5 mb-4 ps-0">
                            <!-- <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked> -->
                            <label class="form-check-label d-flex" for="flexRadioDefault2">
                                <img src="{{ asset('frontend/image/paypal_icon.png') }}" alt=""
                                    class="radio_button_img">
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
                            By placing your order you agree to our
                            <a href="{{ Route('frontend.termcondition') }}"> Terms & Conditions,</a>
                            <a href="{{ Route('frontend.privacypolicy') }}">Privacy</a> and
                            <a href="{{ Route('frontend.returndays') }}">Return Policies</a>
                        </div>
                        <button type="submit" class="btn btn-primary place_order_btn">Place Order
                            <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i>
                        </button>

                    </div>
                </div>

                <div class="row mt-5 checkout_box">
                    <div class="col-sm-6 col-lg-3 checkout_box_col">
                        <div class="checkout_box_part_img">
                            <img src="{{ asset('frontend/image/checkout-true.png') }}" alt="">
                        </div>
                        <div class="checkout_box_part_paragraph mt-3">
                            Insured Shipping WorldWide <br>
                            Delivered At Your Door Step
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 checkout_box_col mt-3 mt-lg-0">
                        <div class="checkout_box_part_img">
                            <img src="{{ asset('frontend/image/checkout-calendar.png') }}" alt="">
                        </div>
                        <div class="checkout_box_part_paragraph mt-3">
                            Estimated date of shipment<br>
                            {{ date('dS M, Y', strtotime('+' . env('SHIPMENT_DAYS', 0) . ' day')) }}
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 checkout_box_col mt-3 mt-lg-0">
                        <div class="checkout_box_part_img">
                            <img src="{{ asset('frontend/image/calendar-message.png') }}" alt="">
                        </div>
                        <div class="checkout_box_part_paragraph mt-3">
                            Send in your queries at<br>
                            <a href="mailto:{{ $settings->company_email }}"> {{ $settings->company_email }}</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 checkout_box_col mt-3 mt-lg-0">
                        <div class="checkout_box_part_img">
                            <img src="{{ asset('frontend/image/calendar-phone.png') }}" alt="">
                        </div>
                        <div class="checkout_box_part_paragraph mt-3">
                            Call us at <br>
                            <a href="tel:+91{{ $settings->company_mobile_no }}">+91
                                {{ $settings->company_mobile_no }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript">
        // $('.place_order_btn').click(function (e) {
        //     e.preventDefault();
        //     var btn = $(this);
        //     $(btn).prop('disabled',true);
        //     $(btn).find('.loadericonfa').show();

        //     var address_id = $('input[name="check_address"]:checked').val();
        //     var sub_totalcost = $('#sub_totalcost').val();
        //     var coupan_discount = $('#coupan_discount').val();
        //     var coupan_code_id = $('#coupan_code_id').val();
        //     var payble_ordercost = $('#payble_ordercost').val();
        //    // var item = $('#item').val();
        //     var item = $("input[name='item[]']").map(function(){return $(this).val();}).get();
        //     var qty = $("input[name='qty[]']").map(function(){return $(this).val();}).get();

        //     var data = {
        //         '_token': $('input[name=_token]').val(),
        //         "address_id": address_id,
        //         "sub_totalcost": sub_totalcost,
        //         "coupan_discount": coupan_discount,
        //         "coupan_code_id": coupan_code_id,
        //         "payble_ordercost": payble_ordercost,
        //         "item_id": item,
        //         "qty": qty,
        //     };
        //     $.ajax({
        //         url: 'orders/saveorder',
        //         type: 'Post',
        //         data: data,
        //         success: function (response) {

        //             if(response.status == 'failed'){
        //                 $(btn).prop('disabled',false);
        //                 $(btn).find('.loadericonfa').hide();
        //                 if (response.errors.address_id) {
        //                     toastr.error(response.errors.address_id,'Success',{timeOut: 5000});
        //                 }
        //             }else if(response.status == 200){
        //                 $(btn).find('.loadericonfa').hide();
        //                 $(btn).prop('disabled',false);
        //                 if(response.data.discount_type_id == 1){
        //                    var coupon_amount_per = response.data.coupon_amount;
        //                    var total  = $('.cart-maintotal-price').html();
        //                    var coupon_amount = (total * coupon_amount_per)/100;

        //                 }else{
        //                     var coupon_amount = response.data.coupon_amount;
        //                 }
        //                 $('#coupan_discount_amount').val(coupon_amount);
        //                 toastr.success(response.message,'Success',{timeOut: 5000});
        //                 $("#coupon_code").val('');
        //                 $(".qty").change();
        //             }else{
        //                 $(btn).find('.loadericonfa').hide();
        //                 $(btn).prop('disabled',false);
        //                 toastr.error(response.message,'Success',{timeOut: 5000});
        //             }
        //         }
        //     });
        // });


        $('body').on('click', '#save_closeAddressBtn', function() {
            save_address($(this), 'save_close');
        });

        function save_address(btn, btn_type) {
            $(btn).prop('disabled', true);
            $(btn).find('.loadericonfa').show();
            var action = $(btn).attr('data-action');

            var formData = new FormData($("#AddressCreateForm")[0]);
            formData.append('action', action);

            $.ajax({
                type: 'POST',
                url: "{{ route('address.save') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 'failed') {
                        $(btn).prop('disabled', false);
                        $(btn).find('.loadericonfa').hide();
                        if (res.errors.first_name) {
                            $('#first_name-error').show().text(res.errors.first_name);
                        } else {
                            $('#first_name-error').hide();
                        }

                        if (res.errors.last_name) {
                            $('#last_name-error').show().text(res.errors.last_name);
                        } else {
                            $('#last_name-error').hide();
                        }

                        if (res.errors.email) {
                            $('#email-error').show().text(res.errors.email);
                        } else {
                            $('#email-error').hide();
                        }
                        if (res.errors.mobile_no) {
                            $('#mobile_no-error').show().text(res.errors.mobile_no);
                        } else {
                            $('#mobile_no-error').hide();
                        }
                        if (res.errors.address) {
                            $('#address-error').show().text(res.errors.address);
                        } else {
                            $('#address-error').hide();
                        }
                        if (res.errors.country) {
                            $('#country-error').show().text(res.errors.country);
                        } else {
                            $('#country-error').hide();
                        }
                        if (res.errors.state) {
                            $('#state-error').show().text(res.errors.state);
                        } else {
                            $('#state-error').hide();
                        }
                        if (res.errors.city) {
                            $('#city-error').show().text(res.errors.city);
                        } else {
                            $('#city-error').hide();
                        }
                        if (res.errors.pincode) {
                            $('#pincode-error').show().text(res.errors.pincode);
                        } else {
                            $('#pincode-error').hide();
                        }
                    }
                    if (res.status == 200) {

                        $(btn).prop('disabled', false);
                        $(btn).find('.loadericonfa').hide();
                        // location.href="{{ url('admin.blogbanners.list') }}";
                        toastr.success("Address Added", 'Success', {
                            timeOut: 5000
                        });
                        $("#addressModal").find('form').trigger('reset');
                        $('#first_name-error').html("");
                        $('#last_name-error').html("");
                        $('#email-error').html("");
                        $('#mobile_no-error').html("");
                        $('#address-error').html("");
                        $('#country-error').html("");
                        $('#state-error').html("");
                        $('#city-error').html("");
                        $('#pincode-error').html("");
                        $('#address_id').val(res.address.id);

                        $("#first_name").focus();
                        $(".other_address").append(
                            '<div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-4 mb-4 radio_button_address"><input class="form-check-input" type="radio" name="check_address" id="check_address" class="check_address" value="' +
                            res.address.id +
                            '" checked><label class="form-check-label d-flex" for="flexRadioDefault3"><span class="ms-2"><div class="radio_button_part">' +
                            res.address.first_name + ' ' + res.address.last_name +
                            '</div><div class="radio_button_paragraph">' + res.address.address + ',' + res
                            .address.city + ',' + res.address.state + ',' + res.address.pincode + ',' + res
                            .address.country + '</div></span></label></div>');
                        $("#addressModal").modal('hide');
                    }

                },
                error: function(data) {
                    $(btn).prop('disabled', false);
                    $(btn).find('.loadericonfa').hide();
                    toastr.error("Please try again", 'Error', {
                        timeOut: 5000
                    });
                }
            });
        }

        $(document).ready(function() {


            $("#paymentForm").validate({

                rules: {
                    check_address: {
                        required: true,
                    },

                },
                messages: {
                    check_address: {
                        required: "Check Address Type",
                    },

                },
                submitHandler: function(form) {
                    $('.place_order_btn').prop('disabled', false);
                    $('.place_order_btn').find('.loadericonfa').hide();

                    var formData = new FormData($("#paymentForm")[0]);
                    // formData.append('action',action);

                    if ($('input[name=check_address]:checked').val() == 'new') {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('address.save') }}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(res) {

                                if (res.status == 'failed') {

                                    if (res.errors.first_name) {
                                        $('#first_name-error').show().text(res.errors
                                            .first_name);
                                    } else {
                                        $('#first_name-error').hide();
                                    }

                                    if (res.errors.last_name) {
                                        $('#last_name-error').show().text(res.errors
                                            .last_name);
                                    } else {
                                        $('#last_name-error').hide();
                                    }

                                    if (res.errors.email) {
                                        $('#email-error').show().text(res.errors.email);
                                    } else {
                                        $('#email-error').hide();
                                    }
                                    if (res.errors.mobile_no) {
                                        $('#mobile_no-error').show().text(res.errors
                                            .mobile_no);
                                    } else {
                                        $('#mobile_no-error').hide();
                                    }
                                    if (res.errors.address) {
                                        $('#address-error').show().text(res.errors.address);
                                    } else {
                                        $('#address-error').hide();
                                    }
                                    if (res.errors.country) {
                                        $('#country-error').show().text(res.errors.country);
                                    } else {
                                        $('#country-error').hide();
                                    }
                                    if (res.errors.state) {
                                        $('#state-error').show().text(res.errors.state);
                                    } else {
                                        $('#state-error').hide();
                                    }
                                    if (res.errors.city) {
                                        $('#city-error').show().text(res.errors.city);
                                    } else {
                                        $('#city-error').hide();
                                    }
                                    if (res.errors.pincode) {
                                        $('#pincode-error').show().text(res.errors.pincode);
                                    } else {
                                        $('#pincode-error').hide();
                                    }
                                }
                                if (res.status == 200) {
                                    $('.place_order_btn').prop('disabled', false);
                                    $('.place_order_btn').find('.loadericonfa').hide();
                                    // location.href="{{ url('admin.blogbanners.list') }}";
                                    //toastr.success("Address Added",'Success',{timeOut: 5000});
                                    $("#addressModal").find('form').trigger('reset');
                                    $('#first_name-error').html("");
                                    $('#last_name-error').html("");
                                    $('#email-error').html("");
                                    $('#mobile_no-error').html("");
                                    $('#address-error').html("");
                                    $('#country-error').html("");
                                    $('#state-error').html("");
                                    $('#city-error').html("");
                                    $('#pincode-error').html("");
                                    $('#address_id').val(res.address.id);


                                    // $("#first_name").focus();
                                    // $(".other_address").append('<div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-4 mb-4 radio_button_address"><input class="form-check-input" type="radio" name="check_address" id="check_address" class="check_address" value="'+ res.address.id +'" checked><label class="form-check-label d-flex" for="flexRadioDefault3"><span class="ms-2"><div class="radio_button_part">'+ res.address.first_name +' '+ res.address.last_name +'</div><div class="radio_button_paragraph">'+ res.address.address +','+ res.address.city +','+ res.address.state +','+ res.address.pincode +','+ res.address.country +'</div></span></label></div>');
                                    // $("#addressModal").modal('hide');

                                    form.submit();
                                }

                            },
                            error: function(data) {
                                $(btn).prop('disabled', false);
                                $(btn).find('.loadericonfa').hide();
                                toastr.error("Please try again", 'Error', {
                                    timeOut: 5000
                                });
                            }
                        });
                    } else {

                        if ($('input[name=new_address]:checked').val() == undefined) {
                            toastr.error("Please Choose Address Required", 'Success', {
                                timeOut: 5000
                            });
                        } else {
                            form.submit();
                        }

                    }
                }
            })

            // $('#paymentForm').validate({  
            // ignore: [],    
            // errorElement: 'span',
            //     errorPlacement: function (error, element) {
            // },
            // highlight: function (element, errorClass, validClass) {
            //     toastr.error("Please Choose Address Required",'Success',{timeOut: 5000});
            // },
            // unhighlight: function (element, errorClass, validClass) {
            //     $(element).removeClass('is-invalid');
            // },
            // rules: {  
            //   check_address: 'required',  
            // },  
            // messages: {  
            //   check_address: 'This field is required',
            // },  
            // submitHandler: function(form) { 
            //     console.log("fgdgdfd")
            //     var formData = new FormData($("#paymentForm")[0]);
            //     formData.append('action',action);

            //     // $.ajax({
            //     //     type: 'POST',
            //     //     url: "{{ route('address.save') }}",
            //     //     data: formData,
            //     //     processData: false,
            //     //     contentType: false,
            //     //     success: function (res) {
            //     //         alert('demo');
            //     //         if(res.status == 'failed'){
            //     //             $(btn).prop('disabled',false);
            //     //             $(btn).find('.loadericonfa').hide();
            //     //             if (res.errors.first_name) {
            //     //                 $('#first_name-error').show().text(res.errors.first_name);
            //     //             } else {
            //     //                 $('#first_name-error').hide();
            //     //             }

            //     //             if (res.errors.last_name) {
            //     //                 $('#last_name-error').show().text(res.errors.last_name);
            //     //             } else {
            //     //                 $('#last_name-error').hide();
            //     //             }

            //     //             if (res.errors.email) {
            //     //                 $('#email-error').show().text(res.errors.email);
            //     //             } else {
            //     //                 $('#email-error').hide();
            //     //             }
            //     //             if (res.errors.mobile_no) {
            //     //                 $('#mobile_no-error').show().text(res.errors.mobile_no);
            //     //             } else {
            //     //                 $('#mobile_no-error').hide();
            //     //             }
            //     //             if (res.errors.address) {
            //     //                 $('#address-error').show().text(res.errors.address);
            //     //             } else {
            //     //                 $('#address-error').hide();
            //     //             }
            //     //             if (res.errors.country) {
            //     //                 $('#country-error').show().text(res.errors.country);
            //     //             } else {
            //     //                 $('#country-error').hide();
            //     //             }
            //     //             if (res.errors.state) {
            //     //                 $('#state-error').show().text(res.errors.state);
            //     //             } else {
            //     //                 $('#state-error').hide();
            //     //             }
            //     //             if (res.errors.city) {
            //     //                 $('#city-error').show().text(res.errors.city);
            //     //             } else {
            //     //                 $('#city-error').hide();
            //     //             }
            //     //             if (res.errors.pincode) {
            //     //                 $('#pincode-error').show().text(res.errors.pincode);
            //     //             } else {
            //     //                 $('#pincode-error').hide();
            //     //             }  
            //     //         }
            //     //         if(res.status == 200){
            //     //             $(btn).prop('disabled',false);
            //     //             $(btn).find('.loadericonfa').hide();
            //     //         // location.href="{{ url('admin.blogbanners.list') }}";
            //     //             toastr.success("Address Added",'Success',{timeOut: 5000});
            //     //             $("#addressModal").find('form').trigger('reset');
            //     //             $('#first_name-error').html("");
            //     //             $('#last_name-error').html("");
            //     //             $('#email-error').html("");
            //     //             $('#mobile_no-error').html("");
            //     //             $('#address-error').html("");
            //     //             $('#country-error').html("");
            //     //             $('#state-error').html("");
            //     //             $('#city-error').html("");
            //     //             $('#pincode-error').html("");
            //     //             $('#address_id').val(res.address.id);


            //     //             $("#first_name").focus();
            //     //             $(".other_address").append('<div class="form-check mt-3 mt-md-3 mt-lg-3 mt-xxl-4 mb-4 radio_button_address"><input class="form-check-input" type="radio" name="check_address" id="check_address" class="check_address" value="'+ res.address.id +'" checked><label class="form-check-label d-flex" for="flexRadioDefault3"><span class="ms-2"><div class="radio_button_part">'+ res.address.first_name +' '+ res.address.last_name +'</div><div class="radio_button_paragraph">'+ res.address.address +','+ res.address.city +','+ res.address.state +','+ res.address.pincode +','+ res.address.country +'</div></span></label></div>');
            //     //             $("#addressModal").modal('hide');

            //     //             form.submit(); 
            //     //         } 

            //     //     },
            //     //     error: function (data) {
            //     //         $(btn).prop('disabled',false);
            //     //         $(btn).find('.loadericonfa').hide();
            //     //         toastr.error("Please try again",'Error',{timeOut: 5000});
            //     //     }
            //     // });

            // }  
        });

        $('.new_address').on('change', function() {
            var address_id = $('input[name=new_address]:checked').val();
            $('#address_id').val(address_id);
        });

        $('.check_address').on('change', function() {
            var check_address = $('input[name=check_address]:checked').val();
            if (check_address == 'existing') {
                $('#other_address').show();
                $('#add_address').hide();
            } else {
                $('#other_address').hide();
                $('#add_address').show();
            }
        });
        // });  

        $(document).ready(function() {
            // Initialize Select2 for all dropdowns
            $('#country-dropdown').select2({
                width: '100%',
                dropdownAutoWidth: true,
                placeholder: "Select Country",
                allowClear: true
            });

            $('#state-dropdown').select2({
                width: '100%',
                dropdownAutoWidth: true,
                placeholder: "Select State",
                allowClear: true
            }).prop('disabled', true); // Initially disabled

            $('#city-dropdown').select2({
                width: '100%',
                dropdownAutoWidth: true,
                placeholder: "Select City",
                allowClear: true
            }).prop('disabled', true); // Initially disabled

            // When country is selected or cleared
            $('#country-dropdown').on('change', function() {
                var country_id = $(this).find(':selected').data('value');

                // If country is cleared
                if (!country_id) {
                    $('#state-dropdown')
                        .html('<option value="">Select State</option>')
                        .prop('disabled', true)
                        .trigger('change');

                    $('#city-dropdown')
                        .html('<option value="">Select City</option>')
                        .prop('disabled', true)
                        .trigger('change');

                    return;
                }

                // Disable while loading
                $('#state-dropdown').prop('disabled', true);
                $('#city-dropdown').html('<option value="">Select City</option>').prop('disabled', true);

                // AJAX to load states
                $.ajax({
                    url: "{{ url('get-states-by-country') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown').html('<option value="">Select State</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append(
                                '<option data-value="' + value.id + '" value="' +
                                value.name + '">' + value.name + '</option>'
                            );
                        });
                        $('#state-dropdown').prop('disabled', false).trigger('change');
                    }
                });
            });

            // When state is selected or cleared
            $('#state-dropdown').on('change', function() {
                var state_id = $(this).find(':selected').data('value');

                // If state is cleared
                if (!state_id) {
                    $('#city-dropdown')
                        .html('<option value="">Select City</option>')
                        .prop('disabled', true)
                        .trigger('change');
                    return;
                }

                $('#city-dropdown').html('<option value="">Loading...</option>').prop('disabled', true)
                    .trigger('change');

                // AJAX to load cities
                $.ajax({
                    url: "{{ url('get-cities-by-state') }}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dropdown').html('<option value="">Select City</option>');
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown").append(
                                '<option data-value="' + value.id + '" value="' +
                                value.name + '">' + value.name + '</option>'
                            );
                        });
                        $('#city-dropdown').prop('disabled', false).trigger('change');
                    }
                });
            });
        });
        // $('#country-dropdown').on('change', function() {
        //     //var country_id = this.value;
        //     var country_id = $(this).find(':selected').data('value');

        //     $("#state-dropdown").html('');
        //     $.ajax({
        //         url: "{{ url('get-states-by-country') }}",
        //         type: "POST",
        //         data: {
        //             country_id: country_id,
        //             _token: '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         success: function(result) {
        //             $('#state-dropdown').html('<option value="">Select State</option>');
        //             $.each(result.states, function(key, value) {
        //                 $("#state-dropdown").append('<option data-value="' + value.id +
        //                     '" value="' + value.name + '">' + value.name + '</option>');
        //             });
        //             $('#city-dropdown').html('<option value="">Select State First</option>');
        //         }
        //     });
        // });
        // $('#state-dropdown').on('change', function() {
        //     //var state_id = this.value;
        //     var state_id = $(this).find(':selected').data('value');
        //     $("#city-dropdown").html('');
        //     $.ajax({
        //         url: "{{ url('get-cities-by-state') }}",
        //         type: "POST",
        //         data: {
        //             state_id: state_id,
        //             _token: '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         success: function(result) {
        //             $('#city-dropdown').html('<option value="">Select City</option>');
        //             $.each(result.cities, function(key, value) {
        //                 $("#city-dropdown").append('<option data-value="' + value.name +
        //                     '" value="' + value.id + '">' + value.name + '</option>');
        //             });
        //         }
        //     });
        // });
    </script>

@endsection()
