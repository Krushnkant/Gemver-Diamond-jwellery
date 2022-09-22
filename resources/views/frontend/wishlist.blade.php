@extends('frontend.layout.layout')

@section('content')
<div class="background-sub-slider">
            <div class="">
                <!-- <img src="{{ asset('frontend/image/about_us.png') }}" alt=""> -->
                <div class="about_us_background">
                    <div class="sub_heading mb-lg-3"> Wishlist</div>
                    <div class="about_us_link">
                        <a href="{{ URL('/') }}">home</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="14" viewBox="0 0 17 14" fill="none" class="mx-2">
                            <path d="M4.30029 4.32471L6.97613 7L4.30029 9.67529L5.44971 10.8247L9.27388 7L5.44971 3.17529L4.30029 4.32471Z" fill="white"/>
                            <path d="M8.30029 4.32471L10.9761 7L8.30029 9.67529L9.44971 10.8247L13.2739 7L9.44971 3.17529L8.30029 4.32471Z" fill="white"/>
                        </svg>
                        <a href="#">Wishlist </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container ">
    
        <div class="row mb-5">
            
            <!-- <div class="wire_bangle_line mb-md-5"></div> -->
            <div class="tab-content1 clearfix">
               @if(isset($wishlist_data) && count($wishlist_data))
                
                <div class="tab-pane">
                    <table class="table table-bordered table-hover table_part_product">
                    <thead>
                        <tr class="table-active">
                            <th>Remove</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th></th>
                           
                            
                        </tr>
                    </thead>
                    <tbody class="">
                       @foreach ($wishlist_data as $data)
                       <?php 
                        if($data['item_type'] == 0){
                            $item = \App\Models\ProductVariant::with('product','product_variant_variants.attribute_term.attribute')->where('estatus',1)->where('id',$data['item_id'])->first();
                            $item_name = $item->product->product_title;
                            $sale_price = $item->sale_price;
                            $item_image = explode(',',$item->images);
                        }else{
                            $item = \App\Models\Diamond::where('id',$data['item_id'])->first();
                            $item_name = $item->Weight;
                            $sale_price = $item->Sale_Amt;
                            $item_image = explode(',',$item->Stone_Img_url);
                        }
                    
                         
                       ?>
                        <tr class="cartpage product-data">
                            <td style="font-size: 20px;">
                                <a href="" class="delete_wishlist_data"><li class="fa fa-trash"></li></a>
                            </td>
                            <td class="cart-image">
                                <input type="hidden" class="variant_id" value="{{ $data['item_id'] }}">
                                <input type="hidden" class="item_type" value="{{ $data['item_type'] }}">
                                <img src="{{ asset($item_image[0]) }}" height="100px" width="100px" alt="">
                            </td>
                            <td class="cart-product-name-info">
                                <span >{{ $item_name }}</span><br>
                                @foreach ($item->product_variant_variants as $vitem)
                                <span >{{ $vitem->attribute_term->attribute->attribute_name }} : {{ $vitem->attribute_term->attrterm_name }}</span>
                                @endforeach

                                <div class="d-flex flex-wrap" id="speci_multi143">
                            
                                <?php

                                if($data['item_type'] == 0){
                                    $ProductVariantSpecification = \App\Models\ProductAttribute::leftJoin("attributes", "attributes.id", "=", "product_attributes.attribute_id")->where('product_id',$item->product->id)->where('is_dropdown',1)->groupBy('product_attributes.attribute_id')->get();
                                    $spe = '';
                                    foreach($ProductVariantSpecification as $productvariants)
                                    {
                                    ?>
                                    <div class="me-4"> <span class="wire_bangle_select mb-3 me-3 d-inline-block">
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
                                        </span> 
                                    </div>
                                    <?php
                                    }
                                }
                                ?>
                                </div>
                            </td>
                            <td class="cart-product-sub-total">
                                <span class="cart-sub-total-price">{{ number_format($sale_price, 2) }}</span>
                            </td>
                            
                            <td style="font-size: 20px;">
                                <a class="btn btn-primary select_cart_btn">Add To Cart</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>  
                    </table>
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
        url: '/delete-from-wishlist',
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
      $(document).find('.specification').each(function() {
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
              url: "/add-to-cart", 
              method: "POST", 
              data: { 
                  'variant_id': variant_id, 
                  'quantity': quantity, 
                  'item_type': item_type, 
                  'arrspe': arrspe 
              },
              success: function (response) {
                  toastr.success(response.status,'Success',{timeOut: 5000});
                  cartload();
              },
          });
  
      }
      });

});
     
   </script>



   @endsection