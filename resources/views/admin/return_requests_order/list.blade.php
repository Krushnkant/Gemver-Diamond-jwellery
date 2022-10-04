@extends('admin.layout')

@section('content')
<style>
    table#ReturnRequestOrder td.text-center span.label {
    display: block;
    width: max-content;
    margin: 0 auto;
    margin-bottom: 5px;
}
</style>
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Return Request Order List</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Return Request Order List</h4>

                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item order_page_tabs" data-tab="ALL_orders_tab"><a class="nav-link active show" data-toggle="tab" href="">ALL</a>
                                </li>
                                <li class="nav-item order_page_tabs" data-tab="RefundRequest_orders_tab"><a class="nav-link" data-toggle="tab" href="">Refund Request</a>
                                </li>
                                <li class="nav-item order_page_tabs" data-tab="PayRefund_orders_tab"><a class="nav-link" data-toggle="tab" href="">Pay Refund</a>
                                </li>
                                <li class="nav-item order_page_tabs" data-tab="Returned_orders_tab"><a class="nav-link" data-toggle="tab" href="">Returned</a>
                                </li>
                                
                            </ul>
                        </div>

                        <div class="table-responsive">
                            <table id="ReturnRequestOrder" class="table zero-configuration customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                   
                                    <th>No</th>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <!-- <th>Note</th> -->
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                   
                                    <th>No</th>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <!-- <th>Note</th> -->
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <div id="ordercoverspin" class="cover-spin"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ReturnReqVideoModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                    {{--<video width="400" controls>
                        <source src="" type="video/mp4" id="ReturnReqVideo">
                        Your browser does not support HTML video.
                    </video>--}}
                    <iframe id="ReturnReqVideo" class="embed-responsive-item" width="450" height="315" src="" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PayReturnAmountModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pay Return Amount</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to Pay this Return Amount?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-primary" id="PayReturnAmountSubmit" type="submit">Pay <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- orders JS start -->
<script type="text/javascript">
var table;

function get_orders_page_tabType(){
    var tab_type;
    $('.order_page_tabs').each(function() {
        var thi = $(this);
        if($(thi).find('a').hasClass('show')){
            tab_type = $(thi).attr('data-tab');
        }
    });
    return tab_type;
}

$(document).ready(function() {
    ReturnRequestOrder_table('',true);

    $('#ReturnRequestOrder tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

});

function format ( d ) {
    // `d` is the original data object for the row
    return d.table1;
}

function ReturnRequestOrder_table(tab_type='',is_clearState=false){
  
    if(is_clearState){
        $('#ReturnRequestOrder').DataTable().state.clear();
    }

    table = $('#ReturnRequestOrder').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,
        'stateSave': function(){
            if(is_clearState){
                return false;
            }
            else{
                return true;
            }
        },
        "ajax":{
            "url": "{{ url('admin/allReturnRequestOrderlist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}', tab_type: tab_type},
            // "dataSrc": ""
        },
        'columnDefs': [
            
            { "width": "50px", "targets": 0 },
            { "width": "230px", "targets": 1 },
            { "width": "150px", "targets": 2 },
            { "width": "120px", "targets": 3 },
            { "width": "200px", "targets": 4 },
            { "width": "120px", "targets": 5 },
            { "width": "100px", "targets": 6 },
        ],
        "columns": [
            // {"className": 'details-control', "orderable": false, "data": null, "defaultContent": ''},
            {data: 'id', name: 'id', class: "text-center", orderable: false ,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'order_info', name: 'order_info', orderable: false, class: "text-left multirow"},
            {data: 'customer_info', name: 'customer_info', orderable: false, class: "text-left multirow"},
            // {data: 'note', name: 'note', orderable: false, class: "text-center"},
            {data: 'payment_status', name: 'payment_status', orderable: false, class: "text-center multirow"},
            {data: 'order_status', name: 'order_status', orderable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', orderable: false, class: "text-left multirow"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

function editOrder(orderId) {
    var url = "{{ url('admin/viewOrder') }}" + "/" + orderId;
    window.open(url,"_blank");
}

$('body').on('click', '.order_page_tabs', function () {
    var tab_type = $(this).attr('data-tab');
    ReturnRequestOrder_table(tab_type,true);
});

$('body').on('click', '#ApproveReturnRequestBtn', function () {
    $('#ordercoverspin').show();
    var tab_type = get_orders_page_tabType();
    var order_id = $(this).attr('data-id');

    $.ajax ({
        type:"POST",
        url: '{{ url("admin/change_order_status") }}',
        data: {order_id: order_id, action: 'approve',  "_token": "{{csrf_token()}}"},
        success: function(res) {
            if(res['status'] == 200){
                toastr.success("Order Returned",'Success',{timeOut: 5000});
            } else {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        complete: function(){
            $('#ordercoverspin').hide();
            ReturnRequestOrder_table(tab_type);
        },
        error: function() {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('body').on('click', '#RejectReturnRequestBtn', function () {
    $('#ordercoverspin').show();
    var tab_type = get_orders_page_tabType();
    var order_id = $(this).attr('data-id');

    $.ajax ({
        type:"POST",
        url: '{{ url("admin/change_order_status") }}',
        data: {order_id: order_id, action: 'reject',  "_token": "{{csrf_token()}}"},
        success: function(res) {
            if(res['status'] == 200){
                toastr.success("Order Delivered",'Success',{timeOut: 5000});
            } else {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        complete: function(){
            $('#ordercoverspin').hide();
            ReturnRequestOrder_table(tab_type);
        },
        error: function() {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

function getInvoiceData(order_id) {
    var url = "{{ url('admin/orders/pdf') }}" + "/" + order_id;
    window.open(url, "_blank");
}

$('body').on('click', '#VideoBtn', function () {
    var order_id = $(this).attr('data-id');
    $.get("{{ url('admin/orders') }}" +'/' + order_id +'/play_video', function (res) {
        $('#ReturnReqVideoModal').find('#ReturnReqVideo').attr('src',res['order_return_video']);
        // $('#ReturnReqVideoModal').find('#ReturnReqVideo').attr('type',res['type']);
    })
});

$('#ReturnReqVideoModal').on('hidden.bs.modal', function () {
    $(this).find("#ReturnReqVideo").attr('src','');
});

$('body').on('click', '#PayReturnAmountBtn', function (e) {
    // e.preventDefault();
    var Commission_id = $(this).attr('data-id');
    $("#PayReturnAmountModal").find('#PayReturnAmountSubmit').attr('data-id',Commission_id);
});

$('#PayReturnAmountModal').on('hidden.bs.modal', function () {
    $(this).find("#PayReturnAmountSubmit").removeAttr('data-id');
});

$('body').on('click', '#PayReturnAmountSubmit', function (e) {
    $('#PayReturnAmountSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    //var tab_type = get_monthly_commission_page_tabType();

    var Order_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/payment_status_update') }}" +'/' + Order_id,
        success: function (res) {
            if(res['status'] == 200){
                $("#PayReturnAmountModal").modal('hide');
                $('#PayReturnAmountSubmit').prop('disabled',false);
                $("#PayReturnAmountSubmit").find('.removeloadericonfa').hide();
                ReturnRequestOrder_table();
                toastr.success("Return Amount Paid",'Success',{timeOut: 5000});
            }

            if(res['status'] == 400){
                $("#PayReturnAmountModal").modal('hide');
                $('#PayReturnAmountSubmit').prop('disabled',false);
                $("#PayReturnAmountSubmit").find('.removeloadericonfa').hide();
                ReturnRequestOrder_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#PayReturnAmountModal").modal('hide');
            $('#PayReturnAmountSubmit').prop('disabled',false);
            $("#PayReturnAmountSubmit").find('.removeloadericonfa').hide();
            ReturnRequestOrder_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});
</script>
<!-- orders JS end -->
@endsection
