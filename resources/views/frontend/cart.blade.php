@extends('frontend.layout.layout')

@section('content')
<div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3"> Cart</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">Cart </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="my-xl-5 my-4">
                <div class="my_cart_heading mb-3">My Cart</div>
                <div class="row">
                    <!-- <div class="wire_bangle_line mb-md-5"></div> -->
                    <div class="tab-content1 clearfix px-0">
                        @if(isset($cart_data) && count($cart_data))
                        <div class="tab-pane table-responsive">
                            <table class="table table-bordered table-hover table_part_product mb-4 my_cart_table">
                            <thead>
                                <tr class="table-active">
                                    <th>Product Name</th>
                                    <th>Amount</th>
                                    <th class="text-center">QTY</th>
                                    <th style="width:16%;">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <?php 
                                    $total = 0;
                                    $total_qty = 0;
                                // dd($cart_data);
                                ?> 
                                @foreach($cart_data as $data)
                                <?php
                                $diamond_name = "";
                                if(isset($data['item_type']) && $data['item_type'] == 2){
                                    $item = \App\Models\ProductVariant::with('product','product_variant_variants.attribute_term.attribute')->where('estatus',1)->where('id',$data['item_id'])->first();
                                    $item_name = $item->product->product_title;
                                    $sale_price = $item->sale_price;
                                    $item_image = explode(',',$item->images); 
                                    if(session()->has('customer')){
                                    $specifications = json_decode($data['specification'],true);
            
                                    }else{
                                    $specifications = $data['specification'];
                                    }

                                    $diamond = \App\Models\Diamond::where('id',$data['diamond_id'])->first();
                                    $diamond_name = $diamond->Shape.' '. round($diamond->Weight,2) .' ct <br>';
                                    $diamond_name .= '<span>'. $diamond->Clarity .' clarity |</span>
                                            <span>'. $diamond->Color .' color |</span>
                                            <span>'. $diamond->Lab .' certified</span>';
                                    $sale_price_diamond = $diamond->Sale_Amt;
                                    $item_image_diamond = explode(',',$diamond->Stone_Img_url); 
                                    $url =  "";

                                    $sale_price = $sale_price + $sale_price_diamond;

                                }elseif(isset($data['item_type']) && $data['item_type'] == 0){
                                    $item = \App\Models\ProductVariant::with('product','product_variant_variants.attribute_term.attribute')->where('estatus',1)->where('id',$data['item_id'])->first();
                                    $item_name = $item->product->product_title;
                                    $sale_price = $item->sale_price;
                                    $item_image = explode(',',$item->images); 
                                    if(session()->has('customer')){
                                    $specifications = json_decode($data['specification'],true);
                                    }else{
                                    $specifications = $data['specification'];
                                    }

                                    


                                    $url =  URL('/product-details/'.$item['product_id'].'/'.$item['id']); 
                                }else{
                                    $item = \App\Models\Diamond::where('id',$data['item_id'])->first();
                                    $item_name = $item->Shape.' '. round($item->Weight,2) .' ct <br>';
                                    $item_name .= '<span>'. $item->Clarity .' clarity |</span>
                                            <span>'. $item->Color .' color |</span>
                                            <span>'. $item->Lab .' certified</span>';
                                    $sale_price = $item->Sale_Amt;
                                    $item_image = explode(',',$item->Stone_Img_url); 
                                    $url =  "";
                                }
                                
                                ?>
                                <tr class="cartpage">
                                    <td class="cart-product-name-info">
                                        <input type="hidden" class="variant_id" value="{{ $data['item_id'] }}">
                                        <input type="hidden" class="diamond_id" value="{{ $data['diamond_id'] }}">
                                        <input type="hidden" class="item_type" value="{{ $data['item_type'] }}">
                                        <a class="delete_cart_data">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="me-4 delete_icon_svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                                                <path d="M15.8841 2.28729H11.5213V1.90616C11.5213 1.40064 11.3204 0.91577 10.9631 0.558274C10.6056 0.200773 10.1207 0 9.61519 0H7.11624C6.61072 0 6.12585 0.200762 5.76835 0.558274C5.411 0.915774 5.21008 1.4006 5.21008 1.90616V2.28729H0.847359C0.622665 2.28729 0.407267 2.37652 0.248317 2.53547C0.0895105 2.69428 0.000281597 2.90981 0.000281597 3.13436C-0.00562751 3.36083 0.0816781 3.57975 0.241816 3.73991C0.402101 3.90005 0.620869 3.9875 0.847363 3.98159H1.75795L1.7581 13.6812C1.7581 14.636 2.1373 15.5518 2.81259 16.227C3.48772 16.9021 4.40345 17.2815 5.35836 17.2815H11.3942C12.3491 17.2815 13.2648 16.9021 13.9401 16.227C14.6152 15.5518 14.9946 14.636 14.9946 13.6812V3.98159H15.8841C16.1105 3.9875 16.3293 3.90005 16.4896 3.73991C16.6498 3.57977 16.7371 3.36086 16.7312 3.13436C16.7312 2.90982 16.6419 2.69427 16.4831 2.53547C16.3242 2.37652 16.1088 2.28729 15.8841 2.28729H15.8841ZM6.90449 1.90616C6.90449 1.78915 6.99933 1.69431 7.11633 1.69431H9.61529C9.67143 1.69431 9.72535 1.71662 9.76509 1.75636C9.80482 1.7961 9.82713 1.84987 9.82713 1.90615V2.28729H6.90449L6.90449 1.90616ZM13.3003 13.6813C13.3003 14.1868 13.0996 14.6715 12.742 15.029C12.3845 15.3865 11.8997 15.5873 11.3942 15.5873H5.35836C4.85285 15.5873 4.36798 15.3865 4.01063 15.029C3.65313 14.6715 3.45221 14.1868 3.45221 13.6813V3.98162H13.3001L13.3003 13.6813Z" fill="#E10000"/>
                                                <path d="M5.46437 13.9987C5.68906 13.9987 5.90446 13.9095 6.06341 13.7507C6.22222 13.5918 6.31145 13.3764 6.31145 13.1517V5.95106C6.31145 5.64851 6.14998 5.36873 5.88792 5.21746C5.62585 5.06619 5.30291 5.06619 5.04071 5.21746C4.77865 5.36873 4.61719 5.64851 4.61719 5.95106V13.1517C4.61719 13.3764 4.70642 13.5918 4.86537 13.7507C5.02418 13.9095 5.23971 13.9987 5.46441 13.9987H5.46437Z" fill="#E10000"/>
                                                <path d="M8.36656 13.9987C8.59126 13.9987 8.80665 13.9095 8.9656 13.7507C9.12441 13.5918 9.21364 13.3764 9.21364 13.1517V5.95106C9.21364 5.64851 9.05217 5.36873 8.79011 5.21746C8.52804 5.06619 8.2051 5.06619 7.94306 5.21746C7.68099 5.36873 7.51953 5.64851 7.51953 5.95106V13.1517C7.51953 13.3764 7.60876 13.5918 7.76757 13.7507C7.92652 13.9095 8.14191 13.9987 8.36661 13.9987H8.36656Z" fill="#E10000"/>
                                                <path d="M11.267 13.9987C11.4917 13.9987 11.7072 13.9095 11.866 13.7507C12.025 13.5918 12.1142 13.3764 12.1142 13.1517V5.95106C12.1142 5.64851 11.9527 5.36873 11.6907 5.21746C11.4284 5.06619 11.1055 5.06619 10.8434 5.21746C10.5814 5.36873 10.4199 5.64851 10.4199 5.95106V13.1517C10.4199 13.3764 10.5092 13.5918 10.668 13.7507C10.8269 13.9095 11.0423 13.9987 11.267 13.9987H11.267Z" fill="#E10000"/>
                                            </svg>
                                        </a>
                                        <span class="product_img">
                                            <img src="{{ asset($item_image[0]) }}" height="100px" width="100px" alt="">
                                        </span>
                                        <span class="product_part">
                                            <span class="cart_product_specification d-block">
                                                <a href="{{ $url }}" class="cart_product_name">{!! $item_name !!}</a>
                                                @if(isset($data['item_type']) && $data['item_type'] == 0)    
                                                    @foreach($item->product_variant_variants as $vitem)
                                                        <span class="cart_product_specification d-block">{{ $vitem->attribute_term->attribute->attribute_name }} : {{ $vitem->attribute_term->attrterm_name }}</span> 
                                                    @endforeach
                                                
                                                    @if(isset($specifications))
                                                        @foreach ($specifications as $specification)
                                                            <span class="cart_product_specification d-block">{{ $specification['key'] }} : {{ $specification['value'] }}</span>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </span>
                                        </span>

                                       @if($data['item_type'] == 2)
                                        <span class="product_img">
                                            <img src="{{ asset($item_image_diamond[0]) }}" height="100px" width="100px" alt="">
                                        </span>
                                        <span class="product_part">
                                            <span class="cart_product_specification d-block">
                                                <a href="{{ $url }}" class="cart_product_name">{!! $diamond_name !!}</a>
                                            </span>
                                        </span>
                                       @endif
                                    </td>
                                    <td class="amount_price">
                                        <i class="fa fa-usd" aria-hidden="true"></i><span class="cart-sub-total-price price_jq">{{ $sale_price }}</span>
                                        

                                    </td>
                                    
                                    <td class="text-center">
                                        {{-- <span class="cart-sub-total-price">{{ $data['item_quantity'] }}</span> --}}
                                        <span class="wire_bangle_input" >
                                            <div class="wire_bangle_number number-input">
                                                <button  class="sp-minus"></button>
                                                <input class="qty qty-input" min="0" placeholder="0" name="qty" id="qty" value="{{ $data['item_quantity'] }}" type="number">
                                                <button  class="plus sp-plus "></button>
                                            </div>
                                        </span>
                                    </td>
                                    <td class="total_amount">
                                        <i class="fa fa-usd" aria-hidden="true"></i><span class="cart-total-price ">{{ $sale_price * (int)$data['item_quantity'] }}</span>
                                    </td>
                                    
                                  
                                </tr>
                                <?php
                                $total = $total + $sale_price * $data['item_quantity'];
                                $total_qty = $total_qty + $data['item_quantity'];
                                ?>
                                @endforeach
                                {{-- <tr class="cartpage">
                                   
                                    <td class="cart-product-name-info">
                                    
                                    </td>
                                    <td class="text-center total_qty">
                                        {{ $total_qty }}
                                    </td>
                                    <td class="amount_price">
                                    
                                    </td>
                                    <td class="total_amount">
                                        <i class="fa fa-usd" aria-hidden="true"></i><span class="cart-maintotal-price ">{{ $total }}</span>
                                    </td>
                                </tr> --}}
                            </tbody>  
                            </table>
                        </div>
                        @else
                            <div class="row">
                                <div class="col-md-12 mycard py-5 text-center">
                                    <div class="mycards">
                                        <h4>Your cart is currently empty.</h4>
                                    
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>   
            </div>
        </div>
        @if(isset($cart_data) && count($cart_data))
        <div class="row mb-5">
            <div class="col-md-6">
                <button type="button" class="continue_shopping_btn mb-3" >Continue Shopping</button>
            </div>
            <div class="col-md-6 text-end">
                <div class="order_summary_box">
                    <div class="row">
                        <div class="col-8 ps-0">
                            <input type="text" placeholder="Enter your code" class="enter_yout_code_input" name="coupon_code" id="coupon_code">
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-primary apply_btn redeem" >Apply <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        </div>
                    </div>
                    <div class="order_summary_heading text-start mt-4">
                        Order Summary
                    </div>
                    <div class="row mt-4">
                        <div class="col-6 text-start ps-0 order_table_heading">
                            Subtotal
                        </div>
                        <div class="col-md-6 text-end order_summary_price ">
                            $<span class="cart-maintotal-price ">{{ $total }}</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-start ps-0 order_table_heading">
                            Coupan Discount
                        </div>
                        <?php 
                            if(session()->has('coupon')){
                                if(session('coupon.discount_type_id') == 1){
                                    $coupan_discount_per  =  session('coupon.coupon_amount');
                                    $coupan_discount_amount = ($total * $coupan_discount_per)/100;

                                }else{
                                    $coupan_discount_amount  =  session('coupon.coupon_amount');
                                }
                            
                            }else{
                                $coupan_discount_amount  =  0;    
                            }  
                            ?>
                        <input type="hidden" id="coupan_discount_amount" value="{{ $coupan_discount_amount }}">
                        <div class="col-6 text-end order_summary_price ">
                            $<span class="cart-maintotal-price coupan_discount_amount">{{ $coupan_discount_amount }}</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-start ps-0 order_table_heading">
                            Delivery Charge
                        </div>
                        <div class="col-6 text-end order_summary_price">
                            0
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-start ps-0 order_table_heading">
                            Total Amount
                        </div>
                        <div class="col-6 text-end order_summary_price">
                            $<span class="cart-maintotal-price final_price">{{ $total - $coupan_discount_amount  }}</span>
                        </div>
                    </div>
                    @if($setting->max_order_price >  $total - $coupan_discount_amount)
                    <button type="button" class="btn btn-dark w-100 mt-3 proceed_to_checkout_btn" id="proceed_to_checkout_btn">Proceed to checkout</button>
                    @else
                    <button type="button" class="btn btn-dark w-100 mt-3 " id="proceed_to_checkout_btn">Proceed to checkout</button>
                    @endif
            
                </div>
            </div>
           
        </div>
        @endif

    </div>
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"  />
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   
    <script type="text/javascript">
     // Delete Cart Data
     $(document).ready(function () {

$('.delete_cart_data').click(function (e) {
    e.preventDefault();

    var variant_id = $(this).closest(".cartpage").find('.variant_id').val();
   
    var data = {
        '_token': $('input[name=_token]').val(),
        "product_id": variant_id,
    };

    // $(this).closest(".cartpage").remove();

    $.ajax({
        url: '/delete-from-cart',
        type: 'DELETE',
        data: data,
        success: function (response) {
            window.location.reload();
        }
    });
});


$('body').on('change', '.qty', function () {  
    
    var sum = 0;
    var total = 0;
    var maintotal = 0;
    var qtytotal = 0;
    $('.price_jq').each(function () {
        var price = $(this);
        var count = price.closest('tr').find('.qty');
        var amount = Number(price.html());
        var qty = Number(count.val());
        sum = amount * qty;
        total = total + sum;
        console.log(price.closest('tr').find('.cart-total-price'));
        price.closest('tr').find('.cart-total-price').html(sum);
        qtytotal = qtytotal + qty;
    })

    $('.cart-maintotal-price').html(total);
    $('.total_qty').html(qtytotal);

    if("{{ session()->has('coupon') }}"){
        if("{{ session('coupon.discount_type_id') }}" == 1){
            var coupan_discount_per  =  "{{ session('coupon.coupon_amount') }}";
            var coupan_discount_amount = total * coupan_discount_per/100;
        }else{
            var coupan_discount_amount  =  "{{ session('coupon.coupon_amount') }}";
        }
    }else{
        var coupan_discount_amount  =  0;    
    } 
    //var coupan_discount_amount = $('#coupan_discount_amount').val();
    $('.coupan_discount_amount').html(coupan_discount_amount);
    var main_total =  total - coupan_discount_amount;
    var max_order_amount = "{{ $setting->max_order_price }}";
    if(main_total < max_order_amount){
        $("#proceed_to_checkout_btn").addClass("proceed_to_checkout_btn");
    }else{
        $("#proceed_to_checkout_btn").removeClass("proceed_to_checkout_btn");
    }

    $('.final_price').html(main_total);
    var quantity = $(this).closest(".cartpage").find('.qty-input').val();
    var variant_id = $(this).closest(".cartpage").find('.variant_id').val();
    var diamond_id = $(this).closest(".cartpage").find('.diamond_id').val();
    var item_type = $(this).closest(".cartpage").find('.item_type').val();

   
    var data = {
        '_token': $('input[name=_token]').val(),
        'quantity':quantity,
        'variant_id':variant_id,
        'diamond_id':diamond_id,
        'item_type':item_type,
        'action':'update_qty'
    };

    $.ajax({
        url: "/add-to-cart", 
        method: "POST",
        data: data,
        success: function (response) {
           // console.log(response);
        }
    });
 
});

$('.sp-plus').on('click', function(){
    var count = $(this).closest('tr').find('.qty').val();
    var newVal = (parseInt(count,10) +1);
    $(this).closest('tr').find('.qty').val(newVal).trigger('change');
});

$('.sp-minus').on('click', function(){
    var count = $(this).closest('tr').find('.qty').val();
    var newVal = (parseInt(count,10) -1);
    $(this).closest('tr').find('.qty').val(newVal).trigger('change');
});

$('.redeem').click(function (e) {
    alert('redeem');
    e.preventDefault();
    var btn = $(this);
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();

    var coupon_code = $('#coupon_code').val();
    //var variant_id = $(this).closest(".cartpage").find('.variant_id').val();
   
    var data = {
        '_token': $('input[name=_token]').val(),
        "coupon_code": coupon_code,
    };
    $.ajax({
        url: '/redeem_coupon',
        type: 'Post',
        data: data,
        success: function (response) {
            if(response.status == 200){
                $(btn).find('.loadericonfa').hide();
                $(btn).prop('disabled',false);
                if(response.data.discount_type_id == 1){
                   var coupon_amount_per = response.data.coupon_amount;
                   var total  = $('.cart-maintotal-price').html();
                   var coupon_amount = (total * coupon_amount_per)/100;
                 
                }else{
                    var coupon_amount = response.data.coupon_amount;
                }
                $('#coupan_discount_amount').val(coupon_amount);
                toastr.success(response.message,'Success',{timeOut: 5000});
                $("#coupon_code").val('');
                $(".qty").change();
            }else{
                $(btn).find('.loadericonfa').hide();
                $(btn).prop('disabled',false);
                toastr.error(response.message,'Success',{timeOut: 5000});
            }
        }
    });
});

$('.proceed_to_checkout_btn').click(function (e) {
    e.preventDefault();
    var check_login = "{{ is_login() }}";
    if(check_login) {
        location.href="{{ url('/checkout') }}";
    } else {
        location.href="{{ url('/login') }}";
         "{{ Session::put('afterLogin','/cart');}}";
    }
});

$('.continue_shopping_btn').click(function () {
    location.href="{{ url('/') }}";
});

});
     
</script>





@endsection