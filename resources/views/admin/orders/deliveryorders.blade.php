@extends('admin.layout')

@section('content')
<style>
    table#Order td.text-center span.label {
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Delivery Order List</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Delivery Order List</h4>

                        <!-- <div class="custom-tab-1">
                            <ul class="nav nav-tabs mb-3">
                                
                                <li class="nav-item order_page_tabs" data-tab="OutforDelivery_orders_tab"><a class="nav-link active show" data-toggle="tab" href="">Out for Delivery</a>
                                </li>
                                
                            </ul>
                        </div> -->

                        <div class="tab-pane fade show active table-responsive" id="ALL_orders_tab">
                            <table id="Order" class="table zero-configuration customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Note</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                   
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Note</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                 
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
    order_table('',true);

    $('#Order tbody').on('click', 'td.details-control', function () {
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

    //$(".orderNoteBox").on('change cut paste', function(e) {
    $(document).on("change",".orderNoteBox",function() {    
        
        var otp = $(this).val();
        var orderid = $(this).attr('data-id');
        if(otp.length % 4 == 0){
        $('#ordercoverspin').show();
        $.ajax ({
            type:"POST",
            url: '{{ url("admin/checkorderotp") }}',
            data: { _token: '{{ csrf_token() }}',orderid: orderid, otp: otp},
            
            success: function(res) {
                if(res['status'] == 200){
                    toastr.success("Success",'Success',{timeOut: 5000});
                    var order_id = res['order_id'];
                    var order_status = 3;
                    var payment_status = 2;
                    var action = 'order_status';

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.orders.save') }}",
                        data: {order_id: order_id, order_status: order_status,payment_status:payment_status,action:action},
                        dataType: 'json',
                       
                        success: function (res) {
                            console.log(res)
                            if(res['status']==200){
                               // location.href = "{{ route('admin.orders.list') }}";
                                //toastr.success("Order Updated",'Success',{timeOut: 5000});
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
                } else {
                    toastr.error("Wrong OTP",'Error',{timeOut: 5000});
                }
            },
            complete: function(){
                $('#ordercoverspin').hide();
                order_table('',true);
            }
        });
     }

    });
});

function format ( d ) {
    // `d` is the original data object for the row
    return d.table1;
}

function order_table(tab_type='',is_clearState=false){
    if(is_clearState){
        $('#Order').DataTable().state.clear();
    }

    table = $('#Order').DataTable({
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
            "url": "{{ url('admin/allDeliveryOrderlist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}', tab_type: tab_type},
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "20px", "targets": 0 },
            { "width": "50px", "targets": 1 },
            { "width": "230px", "targets": 2 },
            { "width": "230px", "targets": 3 },
            { "width": "150px", "targets": 4 },
            { "width": "120px", "targets": 5 },
            { "width": "200px", "targets": 6 },
            { "width": "120px", "targets": 7 },
           
        ],
        "columns": [
            {"className": 'details-control', "orderable": false, "data": null, "defaultContent": ''},
            {data: 'id', name: 'id', class: "text-center", orderable: false ,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'order_info', name: 'order_info', orderable: false, class: "text-left multirow"},
            {data: 'customer_info', name: 'customer_info', orderable: false, class: "text-left multirow"},
            {data: 'note', name: 'note', orderable: false, class: "text-center"},
            {data: 'payment_status', name: 'payment_status', orderable: false, class: "text-center multirow"},
            {data: 'order_status', name: 'order_status', orderable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', orderable: false, class: "text-left multirow"},
          
        ]
    });
}

function editOrder(orderId) {
    var url = "{{ url('admin/viewOrder') }}" + "/" + orderId;
    window.open(url,"_blank");
}

$('body').on('click', '.order_page_tabs', function () {
    var tab_type = $(this).attr('data-tab');
    order_table(tab_type,true);
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
            order_table(tab_type);
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
            order_table(tab_type);
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
</script>
<!-- orders JS end -->
@endsection
