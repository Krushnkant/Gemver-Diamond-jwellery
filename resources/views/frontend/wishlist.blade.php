@extends('frontend.layout.layout')

@section('content')
<div class="background-sub-slider">
    <div class="">
        <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
        <div class="about_us_background">
            <div class="sub_heading mb-lg-3"> Wish List</div>
            <div class="about_us_link">
                <a href="{{ URL('/') }}">home</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                    <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                    <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                </svg>
                <a href="#">Wish List </a>
            </div>
        </div>
    </div>

</div>
</div>

    <div class="container">
        @if(session()->has('customer')) 
        <div class="row my-5">
            <div class="col-md-12">
                <div class="my_account_heading">
                    Hi {{ session("customer.full_name") }}
                </div>
                <p>Welcome to your Account</p>
            </div>
        </div>
        <ul class="nav nav-pills my-4 my_account_tab" id="pills-tab" role="tablist">
            <li class="nav-item " role="presentation">
                <a href="{{ url('/orders') }}" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="21" viewBox="0 0 17 21" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.442129 9.18474L0.454905 9.18049L5.08119 7.52421L6.07983 8.65632L2.50281 9.93643L8.50009 12.763L14.4974 9.93643L10.9366 8.662L11.9271 7.52707L16.5453 9.18065L16.5581 9.1849C16.5662 9.18836 16.5736 9.19119 16.5817 9.1948L16.5999 9.20251L16.6187 9.21163L16.6281 9.21651C16.6322 9.21855 16.6355 9.22075 16.6396 9.2228L16.6504 9.22909L16.6564 9.23255C16.6934 9.25362 16.7278 9.27909 16.7601 9.30725L16.7736 9.3192L16.7851 9.32973L16.7924 9.33744L16.8025 9.34735L16.8147 9.36071L16.8288 9.37691L16.8348 9.38399C16.8402 9.39028 16.8456 9.39673 16.8503 9.40302L16.8625 9.41859L16.8685 9.42771L16.8805 9.44469L16.8886 9.45806L16.8981 9.47284L16.9089 9.49108L16.9109 9.49454C16.9149 9.50225 16.919 9.51011 16.9223 9.51703L16.931 9.53402L16.9337 9.54031C16.9411 9.55587 16.9478 9.57207 16.9539 9.58827L16.9579 9.59881C16.9633 9.61579 16.9693 9.63262 16.9741 9.65023L16.9769 9.66218C16.9802 9.67492 16.9836 9.68829 16.9863 9.70087L16.9896 9.72052L16.9923 9.73609L16.9943 9.74883L16.9962 9.76927L16.9982 9.79113L16.9988 9.80104L16.9994 9.81441L17 9.83548V16.2036C17 16.4706 16.8559 16.7144 16.6283 16.8334L8.80097 20.9281L8.69726 20.9719L8.57265 20.9986L8.44534 21L8.31938 20.9767L8.20019 20.9288L0.371711 16.8333C0.144145 16.7142 0 16.4705 0 16.2034V9.82403L0.000601229 9.81349L0.00120246 9.79793L0.00255522 9.77968L0.00390799 9.76915L0.00526075 9.75782L0.00661351 9.74304L0.0106718 9.72055L0.0139786 9.7009C0.0166841 9.68816 0.019991 9.67479 0.0234479 9.66221L0.0261534 9.65026C0.0315643 9.63264 0.0369754 9.61566 0.0423866 9.59884L0.0464449 9.5883C0.0524572 9.5721 0.0592209 9.55591 0.0665861 9.54034L0.0753039 9.52272L0.0780094 9.51706C0.0813161 9.50998 0.0853744 9.50228 0.0894327 9.49457L0.0995039 9.47759L0.108221 9.46344L0.113632 9.45494L0.120396 9.44441L0.128513 9.43246L0.137982 9.4183L0.144746 9.40981L0.150157 9.40273C0.154816 9.39644 0.160227 9.39 0.165638 9.38371L0.178414 9.36814L0.193294 9.35257L0.200058 9.34486L0.208776 9.33637L0.217494 9.32725L0.232975 9.3131L0.240341 9.3068C0.272656 9.27866 0.307078 9.25334 0.344052 9.23211L0.354122 9.22581L0.360886 9.22235C0.364945 9.22031 0.368252 9.21811 0.37231 9.21606L0.383733 9.2104L0.400567 9.20191L0.410638 9.19767L0.418755 9.19421C0.426871 9.19075 0.434012 9.18835 0.442129 9.18474ZM8.02434 10.3409C8.15225 10.4861 8.33202 10.5685 8.52064 10.5678C8.70912 10.5672 8.88904 10.484 9.01621 10.3382L12.707 6.1111C12.8868 5.9054 12.9332 5.60738 12.8254 5.3523C12.7184 5.0966 12.4766 4.93164 12.2093 4.93164H10.6418L11.2054 0.803928C11.2331 0.601693 11.1758 0.397397 11.0479 0.243126C10.92 0.0888548 10.7341 0 10.5388 0H6.49856C6.30391 0 6.11814 0.0886937 5.99022 0.243126C5.86231 0.397397 5.80504 0.601677 5.8327 0.803928L6.3956 4.93164H4.79031C4.52231 4.93164 4.28062 5.09724 4.17284 5.35371C4.06583 5.6102 4.11362 5.90819 4.29534 6.11392L8.02434 10.3409Z" fill="#BB9761"/>
                    </svg>
                    <span class="ms-2 d-none d-sm-inline-block">
                         Order 
                    </span>
                </a>
            </li>
            <li class="nav-item " role="presentation">
                <a href="{{ url('/cart') }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9257 0.209157C11.0597 0.0752338 11.2413 0 11.4307 0C11.6201 0 11.8018 0.0752338 11.9357 0.209157L16.7243 4.99828H18.5714C18.9503 4.99828 19.3137 5.14881 19.5816 5.41675C19.8495 5.68468 20 6.04809 20 6.42701V8.57012C20 8.94904 19.8495 9.31244 19.5816 9.58038C19.3137 9.84832 18.9503 9.99885 18.5714 9.99885H17.8571L16.6036 18.7734C16.5549 19.1139 16.3851 19.4254 16.1253 19.6507C15.8655 19.876 15.5332 20 15.1893 20H4.81071C4.46684 20 4.1345 19.876 3.8747 19.6507C3.6149 19.4254 3.44509 19.1139 3.39643 18.7734L2.14286 9.99885H1.42857C1.04969 9.99885 0.686328 9.84832 0.418419 9.58038C0.15051 9.31244 0 8.94904 0 8.57012V6.42701C0 6.04809 0.15051 5.68468 0.418419 5.41675C0.686328 5.14881 1.04969 4.99828 1.42857 4.99828H3.32857C3.33929 4.98613 3.35 4.97399 3.36214 4.96256L8.11429 0.209871C8.249 0.0797436 8.42943 0.00773938 8.61672 0.00936701C8.804 0.0109946 8.98315 0.086124 9.11559 0.218574C9.24802 0.351023 9.32314 0.530195 9.32477 0.7175C9.3264 0.904805 9.2544 1.08526 9.12429 1.21999L5.34643 4.99899H14.7036L10.925 1.21927C10.7911 1.08531 10.7159 0.90364 10.7159 0.714215C10.7159 0.52479 10.7918 0.343121 10.9257 0.209157ZM11.4286 12.142C11.4286 11.9525 11.5038 11.7708 11.6378 11.6368C11.7717 11.5029 11.9534 11.4276 12.1429 11.4276C12.3323 11.4276 12.514 11.5029 12.6479 11.6368C12.7819 11.7708 12.8571 11.9525 12.8571 12.142V16.4282C12.8571 16.6176 12.7819 16.7993 12.6479 16.9333C12.514 17.0673 12.3323 17.1425 12.1429 17.1425C11.9534 17.1425 11.7717 17.0673 11.6378 16.9333C11.5038 16.7993 11.4286 16.6176 11.4286 16.4282V12.142ZM7.85714 11.4276C7.6677 11.4276 7.48602 11.5029 7.35207 11.6368C7.21811 11.7708 7.14286 11.9525 7.14286 12.142V16.4282C7.14286 16.6176 7.21811 16.7993 7.35207 16.9333C7.48602 17.0673 7.6677 17.1425 7.85714 17.1425C8.04658 17.1425 8.22826 17.0673 8.36222 16.9333C8.49617 16.7993 8.57143 16.6176 8.57143 16.4282V12.142C8.57143 11.9525 8.49617 11.7708 8.36222 11.6368C8.22826 11.5029 8.04658 11.4276 7.85714 11.4276Z" fill="#0B1727"/>
                    </svg>
                    <span class="ms-2 d-none d-sm-inline-block">
                       Cart 
                    </span>
                </a>
            </li>
            <li class="nav-item active" role="presentation">
                <a href="{{ url('/wishlist') }}" >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none">
                    <path d="M14.5496 0C11.1471 0 10 2.80557 10 2.80557C10 2.80557 8.8542 0 5.45038 0C2.04877 0 0 3.01286 0 5.496C0 9.65743 10 16 10 16C10 16 20 9.65886 20 5.49686C20 3.01283 17.952 0 14.5496 0Z" fill="#0B1727"/>
                </svg>
                    <span class="ms-2 d-none d-sm-inline-block"> 
                        Wishlist 
                    </span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ url('/address') }}"  id="address-part-tab" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="21" viewBox="0 0 16 21" fill="none">
                        <path d="M15.0977 4.04917C13.125 0.424746 8.31326 -1.03386 4.36771 0.778387C0.422161 2.59068 -1.09351 7.16532 0.83115 10.635C1.69725 12.182 5.06535 17.5745 6.84571 20.4033C7.35102 21.1989 8.5779 21.1989 9.05906 20.4033C10.8393 17.5743 14.1835 12.1821 15.0977 10.635C16.3247 8.60183 16.2766 6.19292 15.0977 4.04921V4.04917ZM7.97644 10.5245C6.07593 10.5245 4.51202 9.11009 4.51202 7.34205C4.51202 5.59621 6.05174 4.15959 7.97644 4.15959C9.90114 4.15959 11.4409 5.59602 11.4409 7.34205C11.4407 9.08803 9.90097 10.5245 7.97644 10.5245Z" fill="#0B1727"/>
                    </svg>
                    <span class="ms-2 d-none d-sm-inline-block">
                       Address 
                    </span>
                </a>
            </li>
            <li class="nav-item " role="presentation">
                <a href="{{ url('/account') }}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M18.5 6V5H1.5V6H18H18.5ZM1 19H0V20H20V19H19H1ZM16.5 7H17.5V16H16.5V7ZM9.5 7H10.5V16H9.5V7ZM11.5 7H15.5V16H11.5V7ZM1.5 18H18.5V17H1.5V18ZM2.5 7H3.5V16H2.5V7ZM4.5 7H8.5V16H4.5V7ZM10 0L0 2.85V4H20V2.9L10 0ZM6.5 3C6.2 3 6 2.8 6 2.5C6 2.2 6.2 2 6.5 2C6.8 2 7 2.2 7 2.5C7 2.8 6.8 3 6.5 3ZM10 3C9.45 3 9 2.55 9 2C9 1.45 9.45 1 10 1C10.55 1 11 1.45 11 2C11 2.55 10.55 3 10 3ZM13.5 3C13.2 3 13 2.8 13 2.5C13 2.2 13.2 2 13.5 2C13.8 2 14 2.2 14 2.5C14 2.8 13.8 3 13.5 3Z" fill="#0B1727"/>
                    </svg>
                    <span class="ms-2 d-none d-sm-inline-block">
                        Account 
                    </span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ url('/frontend/logout') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                        <path d="M9.0021 0C8.39497 0 7.7644 0.722488 7.77864 1.33336V9.33349C7.76901 10.038 8.32167 10.6668 9.0021 10.6668C9.68252 10.6668 10.2352 10.038 10.2256 9.33349V1.33336C10.2444 0.526485 9.60923 0 9.0021 0ZM4.6959 3.33339C4.58364 3.35913 4.47484 3.4014 4.37394 3.45839C0.511127 5.55381 -0.672222 9.85583 0.349226 13.417C1.37104 16.9771 4.57337 20 8.96162 20C13.2877 20 16.5305 17.1346 17.6149 13.625C18.6979 10.1155 17.5401 5.86033 13.5901 3.49953C13.0312 3.16143 12.2263 3.37959 11.8993 3.95786C11.5727 4.53601 11.7834 5.36977 12.3423 5.70791C15.4213 7.54768 16.0546 10.367 15.2802 12.8745C14.5058 15.382 12.2615 17.4578 8.96162 17.4578C5.64427 17.4578 3.42718 15.2575 2.68354 12.6661C1.93972 10.0747 2.62303 7.2687 5.50044 5.70753C5.98813 5.43253 6.24628 4.78416 6.08744 4.23326C5.92876 3.6822 5.36977 3.28623 4.81626 3.33263C4.77601 3.3307 4.73562 3.3307 4.69552 3.33263L4.6959 3.33339Z" fill="#0B1727"/>
                    </svg>
                    <span class="ms-2 d-none d-sm-inline-block">
                      Logout
                    </span>
                </a>
            </li>
        </ul>
        @endif
    
        <div class="row mb-5">
            
            <div class="tab-content1 clearfix">
               @if(isset($wishlist_data) && count($wishlist_data))
                
                <div class="tab-pane wishlist-page my-5">
                    <div class="wishlist-heading  my-3 mb-md-4 pt-md-2 ps-4">Your Wishlist</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table_part_product wishlist_table">
                        <thead>
                            <tr class="table-active">
                                <th>Product Name</th>
                            
                                <th class="amount_col">Amount</th>
                                <th style=""></th>
                            </tr>
                        </thead>
                        <tbody class="">
                        @foreach ($wishlist_data as $data)
                            <?php 
                            $item_terms = '';
                            if($data['item_type'] == 0){
                                $item = \App\Models\ProductVariant::with('product','product_variant_variants.attribute_term.attribute')->where('estatus',1)->where('id',$data['item_id'])->first();
                                $item_name = $item->product->product_title;
                                $sale_price = $item->sale_price;
                                $regular_price = $item->regular_price;
                                $auto_discount_percent = $item->auto_discount_percent;
                                $item_image = explode(',',$item->images);
                            }else{
                                $item = \App\Models\Diamond::where('id',$data['item_id'])->first();
                                $item_name = $item->Shape.' '. round($item->Weight,2) .' ct';
                                $item_terms = $item->Clarity .' Clarity | '. $item->Color .' Color | '. $item->Lab .' Certified';
                                /*$item_name .= '<span>'. $item->Clarity .' clarity |</span>
                                        <span>'. $item->Color .' color |</span>
                                        <span>'. $item->Lab .' certified</span>';*/

                                $sale_price = $item->Sale_Amt;
                                $item_image = explode(',',$item->Stone_Img_url);
                                $regular_price = 0;
                                $auto_discount_percent = 0;
                            }
                            ?>
                            <tr class="cartpage product-data">
                            
                                <td class="cart-image">
                                    <input type="hidden" class="variant_id" value="{{ $data['item_id'] }}">
                                    <input type="hidden" class="item_type" value="{{ $data['item_type'] }}">
                                    <div class="product_img">
                                        <img src="{{ asset($item_image[0]) }}" height="100px" width="100px" alt="">
                                    </div>

                                    <div class="ms-3">
                                        <a href="#" class="cart_product_name mb-2">{!! $item_name !!}</a>
                                        @if($data['item_type'] != 1)
                                            @foreach ($item->product_variant_variants as $vitem)
                                                <span class="cart_product_specification d-block">
                                                    {{ $vitem->attribute_term->attribute->attribute_name }}: {{ $vitem->attribute_term->attrterm_name }}
                                                </span>
                                            @endforeach
                                        @endif

                                        @if(isset($data['item_type']) && $data['item_type'] == 1)
                                            <span class="cart_product_specification d-block">
                                                {!! $item_terms !!}
                                            </span>
                                        @endif
                                        <div class="d-flex flex-wrap mt-2" id="speci_multi143">
                                            <?php
                                            if($data['item_type'] == 0){
                                                $ProductVariantSpecification = \App\Models\ProductAttribute::leftJoin("attributes", "attributes.id", "=", "product_attributes.attribute_id")->where('product_id',$item->product->id)->where('is_dropdown',1)->groupBy('product_attributes.attribute_id')->get();
                                                $spe = '';
                                                foreach($ProductVariantSpecification as $productvariants)
                                                {
                                                ?>
                                                <div class="me-4"> 
                                                    <span class="wire_bangle_select mb-3 me-3 d-inline-block">
                                                        <div class="select">
                                                            <select name="AtributeSpecification{{ $productvariants->id }}" id="AtributeSpecification{{ $productvariants->id }}" class="specification">
                                                                <option value="">--{{ $productvariants->attribute_name }}--</option>  
                                                                <?php
                                                                $product_attribute = \App\Models\ProductAttribute::where('attribute_id',$productvariants->attribute_id)->where('product_id',$item->product->id)->groupBy('attribute_id')->get();
                                                                
                                                                foreach($product_attribute as $attribute_term){
                                                                    $term_array = explode(',',$attribute_term->terms_id);
                                                                    $product_attributes = \App\Models\AttributeTerm::where('estatus',1)->whereIn('id',$term_array)->get();
                                                                
                                                                    $v = 1;
                                                                    foreach($product_attributes as $term){
                                                                        ?>            
                                                                        <option data-spe="{{ $productvariants->attribute_name }}" data-term="{{ $term->attrterm_name }}" value="{{ $term->id }}">{{ $term->attrterm_name }}</option>
                                                                        <?php        
                                                                    }
                                                                }
                                                                ?>        
                                                            </select>
                                                            <div id="AtributeSpecification{{ $productvariants->id }}-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                                        </div>
                                                    </span>
                                                </div>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                </td>
                            
                                <td class="cart-product-sub-total">
                                    <span class="cart-sub-total-price amount_price">${{ number_format($sale_price, 2) }}</span>
                                    @if($regular_price > 0)
                                    <span class="cart-dublicate-price">
                                        ${{ number_format($regular_price, 2) }}
                                    </span>
                                    @endif
                                    @if($regular_price > 0)
                                    <div class="cart-offer-price">
                                        {{ $auto_discount_percent }}% off
                                    </div>
                                    @endif
                                </td>
                                
                                <td style="font-size: 20px;">
                                    <a class="btn btn-primary select_cart_btn move_to_cart_btn">Move To Cart</a>
                                    <a href="" class="btn btn-primary delete_wishlist_data remove_btn ms-3">
                                        Remove
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>  
                        </table>
                    </div>
                </div>
                @else
                    <div class="row">
                        <div class="col-md-12 mycard py-5 text-center">
                            <div class="mycards">
                                <h4>Your wishlist is currently empty.</h4>
                            </div>
                        </div>
                    </div>
                @endif
        </div>   

        </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"  />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   
    <script type="text/javascript">
     // Delete Cart Data
     $(document).ready(function () {

$('.delete_wishlist_data').click(function (e) {
    e.preventDefault();

    var variant_id = $(this).closest(".cartpage").find('.variant_id').val();

    var data = {
        '_token': $('input[name=_token]').val(),
        "variant_id": variant_id,
    };

    // $(this).closest(".cartpage").remove();

    $.ajax({
        url: "{{ url('/delete-from-wishlist') }}",
        type: 'DELETE',
        data: data,
        success: function (response) {
            window.location.reload();
        }
    });
});


$('.select_cart_btn').click(function (e) {
      
      e.preventDefault();
  
      var valid = true;
      var arrspe = [];
      $('#specificationstr').html('');
      $(this).closest('.product-data').find('.specification').each(function() {
          var thi = $(this);
          var this_err = $(thi).attr('name') + "-error";
          if($(thi).val()=="" || $(thi).val()==null){
              $("#"+this_err).html("select any value");
              $("#"+this_err).show();
              valid = false;
          }else{
              var element = $(this).find('option:selected'); 
              var DataSpe = element.attr("data-spe");
              var DataTerm = element.attr("data-term");
              arrspe.push({'key' : DataSpe,'value' : DataTerm });
              $("#"+this_err).hide();
              valid = true;
          }
      })
  
      if(valid){
          
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          var thisdata = $(this);
  
          var variant_id = $(this).closest('.product-data').find('.variant_id').val();
          var item_type = $(this).closest('.product-data').find('.item_type').val();
          var quantity = 1;
          $.ajax({
              url: "{{ url('/add-to-cart') }}", 
              method: "POST", 
              data: { 
                  'variant_id': variant_id, 
                  'quantity': quantity, 
                  'item_type': item_type, 
                  'arrspe': arrspe 
              },
              success: function (response) {
                    var datawish = {
                        '_token': $('input[name=_token]').val(),
                        "variant_id": variant_id,
                        "item_type": item_type,
                    };

                    $.ajax({
                        url: "{{ url('/delete-from-wishlist') }}",
                        type: 'DELETE',
                        data: datawish,
                        success: function (response) {
                            toastr.success(response.status,'Success',{timeOut: 5000});
                            cartload();
                            window.location.reload();
                        }
                    });
                  
              },
          });
  
      }
      });

});
     
   </script>



   @endsection