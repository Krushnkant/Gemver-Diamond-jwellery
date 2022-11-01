@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/orders') }}">Order</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Order</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div id="ordercoverspin" class="cover-spin"></div>
        <div class="row orderedit-row">
            <div class="col-lg-12">
                <form action="" method="post" id="OrderForm">
                <div class="card">
                    
                    {{ csrf_field() }}
                    
                    <div class="card-body">
                        <h4 class="card-title">
                            Create Order
                        </h4>
                           <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 ">
                                @if(isset($users) && !empty($users))
                                <div class="form-group">
                                    <label class="col-form-label" for="customer_id">Cusromers <span class="text-danger">*</span>
                                    </label>
                                    <select id='customer_id' name="user_id" class="">
                                        <option></option>

                                        @foreach($users as $user)
                                            <option value="{{ $user['id'] }}">{{ $user['full_name'] }} [ {{ $user['premiumuserid'] }} ]</option>
                                            <!-- <option value="{{ $user['id'] }}">{{ $user['full_name'] }} [ {{ $user['id'] }} ]</option> -->
                                        @endforeach
                                    </select>
                                    <div id="user_id-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 ">
                                <div class="form-group">
                                    <label class="col-form-label" for="payment_date">Order Date <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control custom_date_picker" id="payment_date" name="payment_date" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"> <span class="input-group-append"><span class="input-group-text"><i class="mdi mdi-calendar-check"></i></span></span>
                                        <div id="payment_date-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                @if(isset($products) && !empty($products))
                                <div class="form-group custom_dropdown">
                                    <label class="col-form-label" for="item_id">Item <span class="text-danger">*</span>
                                    </label>
                                    <select id='item_id' name="item_id[]" class="ItemSelCheckbox" multiple>
                                        <option></option>
                                        @foreach($products as $product)
                                            <option value="{{ $product['id'] }}">{{ $product['product_title'] }} [ Net Quantity :  {{ $product->attribute_term->attrterm_name }} ]</option>
                                        @endforeach
                                    </select>
                                    <div id="item_id-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                @endif
                            </div>
                            <div>
                           
                    </div>
                    
                </div>

                <div class="card order-info " style="display:none;">
                    <div class="card-body">
                        <h3 class="card-title">Order Items</h3>
                        <div class="table-responsive">
                            <table class="table header-border table-striped">
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Item Net Price</th>
                                    <th>Quantity</th>
                                    <th>Item Total Net Price</th>
                                </tr>
                                </thead>
                                <tbody id="item_list">
                                
                                </tbody>
                                <tr>
                                    <td class="text-right" colspan="4"><h5>Sub Total</h5></td>
                                    <td></td>
                                    <td><h5>$ <input type="hidden" id="subamount" name="sub_totalcost" value=""><span id="sub_amount"> 0 </span></h5></td>
                                </tr>
                               
                                <tr>
                                    <td class="text-right" colspan="4">
                                        <h5>Coupan Discount</h5>
                                        <div class="form-group">
                                                
                                                <select id='coupon_id' name="coupon_id" class="" >
                                                    <option></option>
                                                    @foreach($coupons as $coupon)
                                                        <option value="{{ $coupon['id'] }}" data-type="{{ $coupon['discount_type_id'] }}" data-amount="{{ $coupon['coupon_amount'] }}">{{ $coupon['coupon_code'] }} </option>
                                                    @endforeach
                                                </select>
                                                <div id="coupon_id-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                            </div>
                                    </td>
                                    <td></td>
                                    <td>
                                        <h5>$ <input type="hidden" id="coupandiscount" name="coupan_discount" value="0"><span id="coupan_discount">  0 </span></h5>
                                       
                                            
                                          
                                   </td>
                                </tr>
                               
                                <tr>
                                    <td class="text-right" colspan="4"><h5>Order Total Cost</h5></td>
                                    <td></td>
                                    <td><h5>$ <input type="hidden" id="totalamount" name="payble_ordercost" value=""><span id="total_amount">  0 </span></h5></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                </form>
                <div class="card save-info" style="display:none;">
                    <div class="card-body publishbtnBox">
                        <div class="btn-row">
                          <button type="button" class="btn btn-outline-primary" id="saveOrderBtn" data-action="add">Create  <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

  
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<!-- order view page JS start -->
<script type="text/javascript">

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

    $('#customer_id').select2({
        width: '100%',
        placeholder: "Select Customer",
        allowClear: true
    }).trigger('change');

    $('#coupon_id').select2({
        width: '20%',
        placeholder: "Select Coupon",
        allowClear: true
    }).trigger('change');

    // $('#item_id').select2({
    //     width: '100%',
    //     placeholder: "Select item",
    //     allowClear: true
    // }).trigger('change');

    $('#item_id').select2({
    width: '100%',
    multiple: true,
    placeholder: "Select Item",
    allowClear: true,
    autoclose: false,
    closeOnSelect: false,
});



$("#payment_date").datepicker().datepicker('setDate', new Date());

      $('body').on('change', '.ItemSelCheckbox', function () {
            var retval = [];
            var retval = getSelectedOptions(this);
            var coupandiscount = 0;
            var qty = $("input[name='qty[]']").map(function(){return $(this).val();}).get();
            //var qty = $('.qty').val();
             
            if($('#coupon_id option:selected').val() != ""){
                var amount =  $('#coupon_id').find(':selected').attr('data-amount');
                var type =   $('#coupon_id').find(':selected').attr('data-type');
            
                // if(type == 1){
                // var coupandiscount = ((total * amount)/100);
                // }else{
                // var coupandiscount = amount;
                // }
            }

            // $('#coupan_discount').html(coupandiscount);
            // $('#coupandiscount').val(coupandiscount);

            if(retval.length != 0){
                $(".order-info").show();
                $(".save-info").show();
            }else{
                $(".order-info").hide();
                $(".save-info").hide();
            }
            
            $.ajax({
                type:"POST",
                async: false,
                url: "{{ url('admin/product/getiten') }}", // script to validate in server side
                data: {retval: retval,amount:amount,type:type,qty:qty,_token: '{{csrf_token()}}'},
                success: function(data) {
                    console.log(data);
                    //result = (data == "true") ? true : false;
                    // alert(result);
                    if(data.status == 200){
                        $("#item_list").html(data.html);
                        $("#sub_amount").html(data.sub_amount);
                        $("#subamount").val(data.sub_amount);
                        $("#total_amount").html(data.total_amount);
                        $("#totalamount").val(data.total_amount);
                        $("#SKU-error").show();
                    }else{
                        $("#SKU-error").html("");
                        $("#SKU-error").hide(); 
                    }
                }
            });
        });

        function getSelectedOptions(sel) {
            var opts = [],
                opt;
            var len = sel.options.length;
            for (var i = 0; i < len; i++) {
                opt = sel.options[i];

                if (opt.selected) {
                opts.push(opt.value);
                //alert(opt.value);
                }
            }

            return opts;
        }
  


$('body').on('click', '#saveOrderBtn', function () {
    $(this).prop('disabled',true);
    $(this).find('.loadericonfa').show();
    var btn = $(this);

    //var valid_order = validateOrderForm();

    //if(valid_order == true){
        var formData = new FormData($('#OrderForm')[0]);
        /*formData.append("cnt_orderItemForm", $('.orderItemForm').length);
        var cnt = 1;
        $('.orderItemForm').each(function () {
            var thi = $(this);
            var orderItemForm = $(this).serialize();
            formData.append("orderItemForm" + cnt, orderItemForm);
            cnt++;
        });*/

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.orders.saveorder') }}",
            data: formData,
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                
                if(res['status'] == 'failed'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    if (res.errors.user_id) {
                        $('#user_id-error').show().text(res.errors.user_id);
                    } else {
                        $('#user_id-error').hide();
                    }
                    if (res.errors.item_id) {
                        $('#item_id-error').show().text(res.errors.item_id);
                    } else {
                        $('#item_id-error').hide();
                    }

                    if (res.errors.payment_date) {
                        $('#payment_date-error').show().text(res.errors.payment_date);
                    } else {
                        $('#payment_date-error').hide();
                    }
                }
                if(res['status']==200){
                    location.href = "{{ route('admin.orders.list') }}";
                    toastr.success("Order Created",'Success',{timeOut: 5000});
                }
                
            },
            error: function (data) {
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    //}
    // else{
    //     $(btn).prop('disabled',false);
    //     $(btn).find('.loadericonfa').hide();
    // }
});


//$(".qty").change(function() {
$('body').on('change', '.qty', function () {  
    var sum = 0;
    var total = 0;
    $('.price_jq').each(function () {
        var price = $(this);
        var count = price.closest('tr').find('.qty');
        sum = (price.html() * count.val());
        total = total + sum;
        price.closest('tr').find('.cart_total_price').html(sum);
    })
    var coupandiscount = 0;
   
    if($('#coupon_id option:selected').val() != ""){
        var amount =  $('#coupon_id').find(':selected').attr('data-amount');
        var type =   $('#coupon_id').find(':selected').attr('data-type');
       
        if(type == 1){
        var coupandiscount = ((total * amount)/100);
        }else{
        var coupandiscount = amount;
        }
    }
    $('#coupan_discount').html(coupandiscount);
    $('#coupandiscount').val(coupandiscount);
    

    $('#sub_amount').html(total);
    $('#subamount').val(total);
    $('#total_amount').html(total - coupandiscount);
    $('#totalamount').val(total - coupandiscount);
});

$('body').on('change', '#coupon_id', function () {  

    var amount =  $(this).find(':selected').attr('data-amount');
    var type =  $(this).find(':selected').attr('data-type');
    var subamount = $('#subamount').val();
    var totalamount = $('#subamount').val();

    if($('#coupon_id option:selected').val() != ""){
    
    if(type == 1){
       var price = ((subamount * amount)/100);
    }else{
       var price = amount;
    }

    $('#coupan_discount').html(price);
    $('#coupandiscount').val(price);
    
    $('#total_amount').html(totalamount - price);
    $('#totalamount').val(totalamount - price);

   }else{
     $('#qty').trigger("change");
   }

});

</script>
<!-- order view page JS end -->
@endsection
