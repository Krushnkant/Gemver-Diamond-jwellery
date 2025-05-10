@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/orders') }}">Order</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Order</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div id="ordercoverspin" class="cover-spin"></div>
        <div class="row orderedit-row">
            <div class="col-lg-12">

                <div class="card">
                    <form action="" method="post" id="OrderForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="order_id" value="{{ $Order->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row custom-row">
                                    <div class="col-sm-12 orderinfoBox">
                                        <div class="row custom-row">
                                            <div class="col-sm-12">
                                                <h3 class="card-title">Order Info</h3>
                                            </div>
                                        </div>
                                        <div class="row custom-row">
                                            <div class="col-sm-4">
                                                <b>Order ID<span class="editorderListGem">:</span></b>
                                            </div>
                                            <div class="col-sm-8">{{ $Order->custom_orderid }}</div>
                                        </div>
                                        <div class="row custom-row">
                                            <div class="col-sm-4">
                                                <b>Customer <span class="editorderListGem">:</span></b>
                                            </div>
                                            <div class="col-sm-8">{{($delivery_address['CustomerName']) != null ? $delivery_address['CustomerName'] : $Order->user->full_name }}</div>
                                        </div>
                                        <div class="row custom-row">
                                            <div class="col-sm-4">
                                                <b>Created On <span class="editorderListGem">:</span></b>
                                            </div>
                                            <div class="col-sm-8">{{ date('d-m-Y h:i A', strtotime($Order->created_at)) }}</div>
                                        </div>
                                        <div class="row custom-row">
                                            <div class="col-sm-4">
                                                <b>Order Status <span class="editorderListGem">:</span></b>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control" id="order_status" name="order_status">
                                                        @if($Order->order_status == 1)
                                                            <option value="1" selected>New Order</option>
                                                            <option value="2">Ship Now</option>
                                                            <option value="8">Cancel</option>
                                                        @elseif($Order->order_status == 2)
                                                            <option value="2" selected>Shipped</option>
                                                            <option value="3">Delivered</option>
                                                            <option value="8">Cancel</option>
                                                        @elseif($Order->order_status == 3)
                                                            <option value="3" selected>Delivered</option>
                                                            <option value="4">Return Request</option>
                                                        @elseif($Order->order_status == 6)
                                                            <option value="6" selected>Returned</option>
                                                        @elseif($Order->order_status == 4)
                                                            <option value="4" selected>Return Request</option>
                                                            <option value="6">Approve</option>
                                                            <option value="3">Reject</option>
                                                        @elseif($Order->order_status == 5)
                                                            <option value="5" selected>Return In Transit</option>
                                                            <option value="6">Returned</option>
                                                        @elseif($Order->order_status == 7 || $Order->order_status == 8)
                                                            <option value="{{ $Order->order_status }}" selected>Cancel</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row custom-row tracking" style="{{ ($Order->order_status != 2)?'display: none':'' }}">
                                            <div class="col-sm-4">
                                                <b>Tracking URL  <span class="editorderListGem">:</span></b>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control input-flat" id="tracking_url" name="tracking_url" value="{{ $Order->tracking_url }}" placeholder="Enter Tracking URL">
                                                <label id="tracking_url-error" class="error invalid-feedback animated fadeInDown" for="tracking_url" ></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row custom-row">
                                    <div class="col-sm-12 paymentinfoBox">
                                        <div class="row custom-row">
                                            <div class="col-sm-12">
                                                <h3 class="card-title">Payment Info</h3>
                                            </div>
                                        </div>
                                        <div class="row custom-row">
                                            <div class="col-sm-4">
                                                <b>Payment Method <span class="editorderListGem">:</span></b>
                                            </div>
                                            <div class="col-sm-8">{{ getPaymentType($Order->payment_type) }}</div>
                                        </div>
                                        <div class="row custom-row">
                                            <div class="col-sm-4">
                                                <b>Transaction Id <span class="editorderListGem">:</span></b>
                                            </div>
                                            <div class="col-sm-8">{{ $Order->payment_transaction_id }}</div>
                                        </div>
                                        <div class="row custom-row">
                                            <div class="col-sm-4">
                                                <b>Payment Status <span class="editorderListGem">:</span></b>
                                            </div>
                                            <div class="col-sm-8">
                                                <!-- <select class="form-control" id="payment_status" name="payment_status" @if($Order->order_status == 4) disabled @endif> -->
                                                {{-- <select class="form-control" id="payment_status" name="payment_status">    
                                                    <option value="1" @if($Order->payment_status == 1) selected @endif>Pending</option>
                                                    <option value="2" @if($Order->payment_status == 2) selected @endif>Success</option>
                                                    <option value="3" @if($Order->payment_status == 3) selected @endif>Refunded</option>
                                                    <option value="4" @if($Order->payment_status == 4) selected @endif>Cancelled</option>
                                                    <option value="5" @if($Order->payment_status == 5) selected @endif>Refund Request</option>
                                                    <option value="6" @if($Order->payment_status == 6) selected @endif>Pay Refund</option>
                                                    <option value="7" @if($Order->payment_status == 7) selected @endif>Failed</option>
                                                </select> --}}
                                                <?php 
                                                $payment_status = 0;
                                                if(isset($Order->payment_status)) {
                                                    $payment_status = getPaymentStatus($Order->payment_status);
                                                    $payment_type = getPaymentType($Order->payment_type);
                                                    $payment_status = '<span class="'.$payment_status['class'].'">'.$payment_status['payment_status'].'</span>';
                                                }
                                                 
                                                ?>
                                                {!! $payment_status !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12" id="shippingAddressBox">
                                <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <h3 class="card-title">Shipping Address</h3>
                                    </div>
                                </div>
                                <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <b>Customer Name <span class="text-danger">*</span></b>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control input-flat" id="CustomerName" name="CustomerName" value="{{ $delivery_address['CustomerName'] }}" @if($Order->order_status == 4) disabled @endif> -->
                                        <input type="text" class="form-control input-flat" id="CustomerName" name="CustomerName" value="{{ ($delivery_address['CustomerName']) != null ? $delivery_address['CustomerName'] : $Order->user->full_name }}">
                                        <label id="CustomerName-error" class="error invalid-feedback animated fadeInDown" for="CustomerName"></label>
                                    </div>
                                </div>
                                <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <b>Phone <span class="text-danger">*</span></b>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control input-flat" id="CustomerMobile" name="CustomerMobile" value="{{ $delivery_address['CustomerMobile'] }}" @if($Order->order_status == 4) disabled @endif> -->
                                        <input type="text" class="form-control input-flat" id="CustomerMobile" name="CustomerMobile" value="{{ ($delivery_address['CustomerMobile']) != null ? $delivery_address['CustomerMobile'] : $Order->user->mobile_no}}" >
                                        <label id="CustomerMobile-error" class="error invalid-feedback animated fadeInDown" for="CustomerMobile"></label>
                                    </div>
                                </div>
                                <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <b>Address 1 <span class="text-danger">*</span></b>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control input-flat" id="DelAddress1" name="DelAddress1" value="{{ $delivery_address['DelAddress1'] }}" @if($Order->order_status == 4) disabled @endif> -->
                                        <input type="text" class="form-control input-flat" id="DelAddress1" name="DelAddress1" value="{{ $delivery_address['DelAddress1'] }}">
                                        <label id="DelAddress1-error" class="error invalid-feedback animated fadeInDown" for="DelAddress1"></label>
                                    </div>
                                </div>
                                <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <b>Address 2 <span class="text-danger">*</span></b>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control input-flat" id="DelAddress2" name="DelAddress2" value="{{ $delivery_address['DelAddress2'] }}" @if($Order->order_status == 4) disabled @endif> -->
                                        <input type="text" class="form-control input-flat" id="DelAddress2" name="DelAddress2" value="{{ $delivery_address['DelAddress2'] }}">
                                        <label id="DelAddress2-error" class="error invalid-feedback animated fadeInDown" for="DelAddress2"></label>
                                    </div>
                                </div>
                                {{-- <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <b>Landmark <span class="text-danger">*</span></b>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control input-flat" id="Landmark" name="Landmark" value="{{ $delivery_address['Landmark'] }}" @if($Order->order_status == 4) disabled @endif> -->
                                        <input type="text" class="form-control input-flat" id="Landmark" name="Landmark" value="{{ $delivery_address['Landmark'] }}">
                                        <label id="Landmark-error" class="error invalid-feedback animated fadeInDown" for="Landmark"></label>
                                    </div>
                                </div> --}}
                                <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <b>City <span class="text-danger">*</span></b>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control input-flat" id="City" name="City" value="{{ $delivery_address['City'] }}" @if($Order->order_status == 4) disabled @endif> -->
                                        <input type="text" class="form-control input-flat" id="City" name="City" value="{{ $delivery_address['City'] }}" >
                                        <label id="City-error" class="error invalid-feedback animated fadeInDown" for="City"></label>
                                    </div>
                                </div>
                                <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <b>State <span class="text-danger">*</span></b>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control input-flat" id="State" name="State" value="{{ $delivery_address['State'] }}" @if($Order->order_status == 4) disabled @endif> -->
                                        <input type="text" class="form-control input-flat" id="State" name="State" value="{{ $delivery_address['State'] }}" >
                                        <label id="State-error" class="error invalid-feedback animated fadeInDown" for="State"></label>
                                    </div>
                                </div>
                                <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <b>Country <span class="text-danger">*</span></b>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control input-flat" id="Country" name="Country" value="{{ $delivery_address['Country'] }}" @if($Order->order_status == 4) disabled @endif> -->
                                        <input type="text" class="form-control input-flat" id="Country" name="Country" value="{{ $delivery_address['Country'] }}" >
                                        <label id="Country-error" class="error invalid-feedback animated fadeInDown" for="Country"></label>
                                    </div>
                                </div>
                                <div class="row custom-row">
                                    <div class="col-sm-4">
                                        <b>ZIP Code <span class="text-danger">*</span></b>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- <input type="text" class="form-control input-flat" id="Pincode" name="Pincode" value="{{ $delivery_address['Pincode'] }}" @if($Order->order_status == 4) disabled @endif> -->
                                        <input type="text" class="form-control input-flat" id="Pincode" name="Pincode" value="{{ $delivery_address['Pincode'] }}" >
                                        <label id="Pincode-error" class="error invalid-feedback animated fadeInDown" for="Pincode"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Order Items</h3>
                        <div class="table-responsive">
                            <table class="table header-border table-striped">
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    {{-- <td>Item Status</td> --}}
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Item Net Price</th>
                                    <th>Quantity</th>
                                    <th>Item Total Net Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($Order->order_item as $order_item)
                                <?php $item_details = json_decode($order_item->item_details,true);
                                      $ProductVariant = \App\Models\ProductVariant::where('id',$item_details['variantId'])->first(); ?>
                                     
                                <tr>
                                    <td>{{ $i }}</td>
                                    {{-- <td style="width: 15%">
                                        <?php $cnt_items = count_order_items($Order->id); ?>
                                        @if($order_item->order_status == 4)
                                            <button type="button" name="ApproveReturnRequestOrderItemBtn" class="btn btn-success btn-xs ApproveReturnRequestOrderItemBtn" data-id="{{ $order_item->id }}">Approve <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                                            <button type="button" name="RejectReturnRequestOrderItemBtn" class="btn btn-danger btn-xs RejectReturnRequestOrderItemBtn" data-id="{{ $order_item->id }}">Reject <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                                        @elseif($order_item->order_status == 7 || $order_item->order_status == 8)
                                            <span class="label label-danger">Cancelled</span>
                                        @elseif(($Order->order_status == 1 || $Order->order_status == 2) && $cnt_items > 1)
                                            <button type="button" name="CancelOrderItemBtn" class="btn btn-primary btn-xs CancelOrderItemBtn" data-id="{{ $order_item->id }}">Cancel <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                                        @elseif($Order->order_status == 3 && $cnt_items > 1)
                                            <button type="button" name="ReturnRequestOrderItemBtn" class="btn btn-primary btn-xs ReturnRequestOrderItemBtn" data-id="{{ $order_item->id }}">Return Request <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                                        @elseif($Order->order_status == 6 && $cnt_items > 1)
                                            <span class="label label-light">Returned</span>
                                        @else
                                            <?php $order_item_status = getOrderStatus($order_item->order_status); ?>
                                            <span class="{{ $order_item_status['class'] }}">{{ $order_item_status['order_status'] }}</span>
                                        @endif
                                    </td> --}}
                                    @if(isset($item_details['ItemType']) && $item_details['ItemType'] == 0)
                                    <td>@if(isset($item_details['ProductImage']))<img src="{{ url($item_details['ProductImage']) }}" width="50px" height="50px">@endif</td>
                                    @elseif(isset($item_details['ItemType']) && $item_details['ItemType'] == 1)
                                    <td>@if(isset($item_details['ProductImage']))<img src="{{ $item_details['ProductImage'] }}" width="50px" height="50px">@endif</td>
                                    @else
                                    <td>@if(isset($item_details['ProductImage'])) <img src="{{ url($item_details['ProductImage']) }}" width="50px" height="50px"> <img src="{{ $item_details['DiamondImage'] }}" width="50px" height="50px">@endif</td>
                                    @endif

                                    <td class="multirow">
                                        
                                        @if(isset($item_details['ItemType']) && $item_details['ItemType'] == 0)
                                        @if(isset($item_details['ProductTitle']))
                                        <span>{{ $item_details['ProductTitle'] }}</span>
                                        @endif
                                        @elseif(isset($item_details['ItemType']) && $item_details['ItemType'] == 1)
                                           
                                            @if(isset($item_details['ProductTitle']))
                                            <span>{{ $item_details['ProductTitle'] }}</span>
                                                @if(isset($item_details['spe']))
                                                    @foreach($item_details['spe'] as $listData)
                                                        <span>Term : {{ isset($listData['term_name']) ? $listData['term_name'] :"" }}</span>
                                                        <span>Term Name : {{ isset($listData['term']) ? $listData['term'] :"" }}</span>
                                                    @endforeach
                                                @endif
                                            @endif
                                        @else    
                                    
                                            @if(isset($item_details['ProductTitle']))
                                            <span>{{ $item_details['ProductTitle'] }}</span><span>{{ $item_details['DiamondTitle'] }}</span>
                                            @endif
                                        @endif

                                        {{-- <span>{{ $item_details['attribute'] }}: {{ $item_details['attributeTerm'] }}</span> --}}
                                    </td>
                                    <td>{{ $item_details['orderItemPrice'] }}</td>
                                    <td>{{ $item_details['itemQuantity'] }}</td>
                                    <td>{{ $item_details['totalItemAmount'] }}</td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                <tr>
                                    <td class="text-right" colspan="4"><h5>Sub Total</h5></td>
                                    <td></td>
                                    <td><h5>$ {{ $Order->sub_totalcost }}</h5></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="4"><h5>Shipping Cost</h5></td>
                                    <td></td>
                                    <td><h5>$ {{ $Order->shipping_charge }}</h5></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="4">
                                        <h5>Coupon Discount</h5>
                                    </td>
                                    <td></td>
                                    <td><h5>$ {{ $Order->discount_amount }}</h5></td>
                                </tr>
                                {{-- <tr>
                                    <td class="text-right" colspan="4"><h5>Refund Amount</h5></td>
                                    <td></td>
                                    <td><h5>$ {{ $Order->total_refund_amount }}</h5></td>
                                </tr> --}}
                                <tr>
                                    <td class="text-right" colspan="4"><h5>Order Total Cost</h5></td>
                                    <td></td>
                                    <td><h5>$ {{ $Order->total_ordercost }}</h5></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body publishbtnBox">
                        <div class="btn-row">
{{--                            @if($Order->order_status == 4)--}}
{{--                                <button type="button" class="btn btn-success mr-2" data-id="{{ $Order->id }}" id="ApproveReturnRequestBtn">Approve</button>--}}
{{--                                <button type="button" class="btn btn-danger" data-id="{{ $Order->id }}" id="RejectReturnRequestBtn">Reject</button>--}}
{{--                            @else--}}
                                <button type="submit" id="saveOrderBtn" name="saveOrderBtn" class="btn btn-primary">Save Order <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
{{--                            @endif--}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="OrderItemModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                    <button class="btn btn-danger" id="OrderItemSubmit" type="submit"></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<!-- order view page JS start -->
<script type="text/javascript">
$('body').on('click', '#saveOrderBtn', function () {
    $(this).prop('disabled',true);
    $(this).find('.loadericonfa').show();
    var btn = $(this);

    var valid_order = validateOrderForm();

    if(valid_order == true){
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
            url: "{{ route('admin.orders.save') }}",
            data: formData,
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                console.log(res)
                if(res['status']==200){
                    location.href = "{{ route('admin.orders.list') }}";
                    toastr.success("Order Updated",'Success',{timeOut: 5000});
                }
                else{
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }
    else{
        $(btn).prop('disabled',false);
        $(btn).find('.loadericonfa').hide();
    }
});

function validateOrderForm() {
    $("#OrderForm").validate({
        rules: {
            CustomerName : {
                required: true,
            },
            CustomerMobile: {
                required: true,
                number: true,
            },
            DelAddress1: {
                required: true,
            },
            DelAddress2: {
                required: true,
            },
            Landmark: {
                required: true,
            },
            City: {
                required: true,
            },
            State: {
                required: true,
            },
            Country: {
                required: true,
            },
            Pincode: {
                required: true,
            },
        },

        messages : {
            CustomerName: {
                required: "Please provide a Customer Name"
            },
            CustomerMobile: {
                required: "Please provide a Customer Mobile Number",
                number: "Please provide only numbers for Customer Mobile Number",
            },
            DelAddress1: {
                required: "Please provide Delivery Address1",
            },
            DelAddress2: {
                required: "Please provide Delivery Address2",
            },
            Landmark: {
                required: "Please provide Landmark",
            },
            City: {
                required: "Please provide City",
            },
            State: {
                required: "Please provide State",
            },
            Country: {
                required: "Please provide Country",
            },
            Pincode: {
                required: "Please provide Pincode",
            },
        }
    });

    var valid = true;
    if (!$("#OrderForm").valid()) {
        valid = false;
    }

    return valid;
}

$('body').on('click', '.ApproveReturnRequestOrderItemBtn', function () {
    var item_id = $(this).attr('data-id');
   $("#OrderItemModal").find(".modal-title").html("Approve Return Request");
   $("#OrderItemModal").find(".modal-body").html("Are you sure you wish to Approve Return Request?");
   $("#OrderItemModal").find("#OrderItemSubmit").html('Approve <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i>');
   $("#OrderItemModal").find("#OrderItemSubmit").attr('data-id',item_id);
   $("#OrderItemModal").find("#OrderItemSubmit").attr('data-action','approve');
   $("#OrderItemModal").modal('show');
});

$('body').on('click', '.RejectReturnRequestOrderItemBtn', function () {
    var item_id = $(this).attr('data-id');
    $("#OrderItemModal").find(".modal-title").html("Reject Return Request");
    $("#OrderItemModal").find(".modal-body").html("Are you sure you wish to Reject Return Request?");
    $("#OrderItemModal").find("#OrderItemSubmit").html('Reject <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i>');
    $("#OrderItemModal").find("#OrderItemSubmit").attr('data-id',item_id);
    $("#OrderItemModal").modal('show');
    $("#OrderItemModal").find("#OrderItemSubmit").attr('data-action','reject');
});

$('body').on('click', '.CancelOrderItemBtn', function () {
    var item_id = $(this).attr('data-id');
    $("#OrderItemModal").find(".modal-title").html("Cancel Order Item");
    $("#OrderItemModal").find(".modal-body").html("Are you sure you wish to Cancel Order Item?");
    $("#OrderItemModal").find("#OrderItemSubmit").html('Cancel <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i>');
    $("#OrderItemModal").find("#OrderItemSubmit").attr('data-id',item_id);
    $("#OrderItemModal").modal('show');
    $("#OrderItemModal").find("#OrderItemSubmit").attr('data-action','cancel');
});

$('body').on('click', '.ReturnRequestOrderItemBtn', function () {
    var item_id = $(this).attr('data-id');
    $("#OrderItemModal").find(".modal-title").html("Return Request Order Item");
    $("#OrderItemModal").find(".modal-body").html("Are you sure you wish to Return Request Order Item?");
    $("#OrderItemModal").find("#OrderItemSubmit").html('Return Request <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i>');
    $("#OrderItemModal").find("#OrderItemSubmit").attr('data-id',item_id);
    $("#OrderItemModal").modal('show');
    $("#OrderItemModal").find("#OrderItemSubmit").attr('data-action','return_request');
});

$('body').on('click', '#OrderItemSubmit', function () {
    var item_id = $(this).attr('data-id');
    var item_action = $(this).attr('data-action');
    $(this).prop('disabled',true);
    $(this).find('.removeloadericonfa').show();

    $.ajax({
        type: 'POST',
        url: "{{ url('admin/change_order_item_status') }}",
        data: {'_token': $('meta[name="csrf-token"]').attr('content'), item_id: item_id, item_action: item_action},
        // processData: false,
        // contentType: false,
        success: function (res) {
            if(res['status'] == 200){
                $("#OrderItemModal").modal('hide');
                $('#OrderItemSubmit').prop('disabled',false);
                $('#OrderItemSubmit').find('.removeloadericonfa').hide();
                window.location.reload();
                toastr.success("Order Item Updated",'Success',{timeOut: 5000});
            }

            if(res['status'] == 400){
                $("#OrderItemModal").modal('hide');
                $('#OrderItemSubmit').prop('disabled',false);
                $('#OrderItemSubmit').find('.removeloadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#OrderItemModal").modal('hide');
            $('#OrderItemSubmit').prop('disabled',false);
            $('#OrderItemSubmit').find('.removeloadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$("#order_status").change(function() {
    var order_status = $('option:selected', this).val();
    if(order_status == 2){
        $(".tracking").show();
    }else{
        $(".tracking").hide(); 
    }
});
</script>
<!-- order view page JS end -->
@endsection
