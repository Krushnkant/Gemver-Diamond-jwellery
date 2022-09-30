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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Order List</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order List</h4>

                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item order_page_tabs" data-tab="ALL_orders_tab"><a class="nav-link active show" data-toggle="tab" href="">ALL</a>
                                </li>
                                <li class="nav-item order_page_tabs" data-tab="NewOrder_orders_tab"><a class="nav-link" data-toggle="tab" href="">New Order</a>
                                </li>
                                <li class="nav-item order_page_tabs" data-tab="OutforDelivery_orders_tab"><a class="nav-link" data-toggle="tab" href="">Out for Delivery</a>
                                </li>
                                <li class="nav-item order_page_tabs" data-tab="Delivered_orders_tab"><a class="nav-link" data-toggle="tab" href="">Delivered</a>
                                </li>
                                <li class="nav-item order_page_tabs" data-tab="ReturnRequest_orders_tab"><a class="nav-link" data-toggle="tab" href="">Return Request</a>
                                </li>
                                <li class="nav-item order_page_tabs" data-tab="Returned_orders_tab"><a class="nav-link" data-toggle="tab" href="">Returned</a>
                                </li>
                                <li class="nav-item order_page_tabs" data-tab="Cancelled_orders_tab"><a class="nav-link" data-toggle="tab" href="">Cancelled</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane fade show active table-responsive" id="ALL_orders_tab">
                            <table id="Order" class="table zero-configuration customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <!-- <th>Note</th> -->
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <!-- <th>Note</th> -->
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <!-- <th>Action</th> -->
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
    var user_id = "{{$id}}";
$(document).ready(function() {
    order_table('',true);
})
function order_table(tab_type='',is_clearState=false){
    
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
            "url": "{{ url('admin/user_wise_orders') }}"+'/'+user_id,
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
            // { "width": "150px", "targets": 4 },
            { "width": "120px", "targets": 5 },
            { "width": "200px", "targets": 6 },
            // { "width": "120px", "targets": 7 },
            // { "width": "100px", "targets": 8 },
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
            // {data: 'note', name: 'note', orderable: false, class: "text-center"},
            {data: 'payment_status', name: 'payment_status', orderable: false, class: "text-center multirow"},
            {data: 'order_status', name: 'order_status', orderable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', orderable: false, class: "text-left multirow"},
            // {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}
</script>
<!-- orders JS end -->
@endsection
