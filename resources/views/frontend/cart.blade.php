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

    <div class="container ">
    
        <div class="row mb-5">
            
            <!-- <div class="wire_bangle_line mb-md-5"></div> -->
            <div class="tab-content1 clearfix">
               @if(isset($cart_data) && count($cart_data))
                
                <div class="tab-pane">
                    <table class="table table-bordered table-hover table_part_product">
                    <thead>
                        <tr class="table-active">
                            <th>Image</th>
                            <th>Product Name</th>
                            <th class="text-center">Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="">
                       <?php 
                           $total = 0;
                           $total_qty = 0;
                       ?> 
                       @foreach ($cart_data as $data)
                       <?php 
                    
                       if(isset($data['item_type']) && $data['item_type'] == 0){
                        $item = \App\Models\ProductVariant::with('product','product_variant_variants.attribute_term.attribute')->where('estatus',1)->where('id',$data['item_id'])->first();
                        $item_name = $item->product->product_title;
                        $sale_price = $item->sale_price;
                        $item_image = explode(',',$item->images); 
                        if(session()->has('customer')){
                         $specifications = json_decode($data['specification'],true);
                        
                        }else{
                         $specifications = $data['specification'];
                        }
                       }else{
                        $item = \App\Models\Diamond::where('id',$data['item_id'])->first();
                        $item_name = $item->Weight;
                        $sale_price = $item->Sale_Amt;
                        $item_image = explode(',',$item->Stone_Img_url); 
                       }
                    
                       $url =  URL('/product-details/'.$item['product_id'].'/'.$item['id']); 
                       ?>
                        <tr class="cartpage">
                            <td class="cart-image">
                                <input type="hidden" class="variant_id" value="{{ $data['item_id'] }}">
                                <img src="{{ asset($item_image[0]) }}" height="100px" width="100px" alt="">
                            </td>
                            <td class="cart-product-name-info">
                                <a href="{{ $url }}">{{ $item_name }}</a><br>
                                @foreach ($item->product_variant_variants as $vitem)
                                <span >{{ $vitem->attribute_term->attribute->attribute_name }} : {{ $vitem->attribute_term->attrterm_name }}</span> 
                                @endforeach
                                <br>
                                @if(isset($specifications))
                                    @foreach ($specifications as $specification)
                                       <span>{{ $specification['key'] }} : {{ $specification['value'] }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">
                                {{-- <span class="cart-sub-total-price">{{ $data['item_quantity'] }}</span> --}}
                                <span class="wire_bangle_input" >
                                    <div class="wire_bangle_number number-input">
                                        <button  class="sp-minus "></button>
                                        <input class="qty qty-input" min="0" placeholder="0" name="qty" id="qty" value="{{ $data['item_quantity'] }}" type="number">
                                        <button  class="plus sp-plus "></button>
                                    </div>
                                </span>
                            </td>
                            <td class="">
                                <i class="fa fa-usd" aria-hidden="true"></i><span class="cart-sub-total-price price_jq">{{ $sale_price }}</span>
                            </td>
                            <td class="">
                                <i class="fa fa-usd" aria-hidden="true"></i><span class="cart-total-price ">{{ $sale_price * $data['item_quantity'] }}</span>
                            </td>
                            <td style="font-size: 20px;">
                                <a class="delete_wishlist_data"><li class="fa fa-trash"></li></a>
                            </td>
                        </tr>
                        <?php
                        $total = $total + $sale_price * $data['item_quantity'];
                        $total_qty = $total_qty + $data['item_quantity'];
                        ?>
                        @endforeach
                        <tr class="cartpage">
                            <td class="cart-image">
                               
                            </td>
                            <td class="cart-product-name-info">
                               
                            </td>
                            <td class="text-center total_qty">
                                {{ $total_qty }}
                            </td>
                            <td class="">
                               
                            </td>
                            <td class="">
                                <i class="fa fa-usd" aria-hidden="true"></i><span class="cart-maintotal-price ">{{ $total }}</span>
                            </td>
                            
                            <td style="font-size: 20px;">
                               
                            </td>
                        </tr>
                        
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
        url: '/delete-from-wishlist',
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
        price.closest('tr').find('.cart-total-price').html(sum);
        qtytotal = qtytotal + qty;
    })

    $('.cart-maintotal-price').html(total);
    $('.total_qty').html(qtytotal);
 
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



});
     
</script>



@endsection