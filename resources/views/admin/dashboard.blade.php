@extends('admin.layout')

@section('content')
{{--    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>--}}
    <!-- row -->
    <?php $page_id = \App\Models\ProjectPage::where('route_url',\Illuminate\Support\Facades\Route::currentRouteName())->pluck('id')->first(); ?>
    @if(getUSerRole()==1 || (getUSerRole()!=1 && is_read($page_id)) )
   
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="container-fluid mt-3">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="card gradient-1">
                                    <div class="card-body">
                                        <h3 class="card-title text-white">Today Orders</h3>
                                        <div class="d-inline-block">
                                            <h2 class="text-white"> {{ $today_order_amount }} </h2>
                                            <p class="text-white mb-0">Yesterday Orders</p>
                                            <h4 class="text-white mb-0"> {{ $yesterday_order_amount }} </h4>
                                        </div>
                                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card gradient-2">
                                    <div class="card-body">
                                        <h3 class="card-title text-white">Today Sales</h3>
                                        <div class="d-inline-block">
                                            <h2 class="text-white">$ {{ $today_order_sum }} </h2>
                                            <p class="text-white mb-0">Yester Sales</p>
                                            <h4 class="text-white mb-0">$ {{ $yesterday_order_sum }} </h4>
                                        </div>
                                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card gradient-3">
                                    <div class="card-body">
                                        <h3 class="card-title text-white">Today Inquiry</h3>
                                        <div class="d-inline-block">
                                            <h2 class="text-white"> {{ $today_inquiry_count }} </h2>
                                            <p class="text-white mb-0">Today Opinion</p>
                                            <h4 class="text-white mb-0"> {{ $today_opinion_count }} </h4>
                                        </div>
                                        <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card gradient-4">
                                    <div class="card-body">
                                        <h3 class="card-title text-white">New Users</h3>
                                        <div class="d-inline-block">
                                            <h2 class="text-white"> {{ $today_user_count }} </h2>
                                            <p class="text-white mb-0"> All Users</p>
                                            <h4 class="text-white mb-0"> {{ $yesterday_user_count }} </h4>
                                        </div>
                                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
        
                       

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body pb-0 d-flex justify-content-between">
                                                <div>
                                                    <h4 class="mb-1">Orders</h4>
                                                    <p>Total Orders of the Month</p>
                                                    <h3 class="m-0"> {{ $chattotalorders->charttotalorder }} </h3>
                                                </div>
                                                {{-- <div>
                                                    <ul>
                                                        <li class="d-inline-block mr-3"><a class="text-dark" href="#">Day</a></li>
                                                        <li class="d-inline-block mr-3"><a class="text-dark" href="#">Week</a></li>
                                                        <li class="d-inline-block"><a class="text-dark" href="#">Month</a></li>
                                                    </ul>
                                                </div> --}}
                                            </div>
                                            <div class="chart-wrapper">
                                                <canvas id="chart_orders"></canvas>
                                            </div>
                                            {{-- <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="w-100 mr-2">
                                                        <h6>Pixel 2</h6>
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-danger" style="width: 40%"></div>
                                                        </div>
                                                    </div>
                                                    <div class="ml-2 w-100">
                                                        <h6>iPhone X</h6>
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body pb-0 d-flex justify-content-between">
                                                <div>
                                                    <h4 class="mb-1">Product Sales</h4>
                                                    <p>Total Earnings of the Month</p>
                                                    <h3 class="m-0">$ {{ $chattotalsalesorders->charttotalamount }}</h3>
                                                </div>
                                                {{-- <div>
                                                    <ul>
                                                        <li class="d-inline-block mr-3"><a class="text-dark" href="#">Day</a></li>
                                                        <li class="d-inline-block mr-3"><a class="text-dark" href="#">Week</a></li>
                                                        <li class="d-inline-block"><a class="text-dark" href="#">Month</a></li>
                                                    </ul>
                                                </div> --}}
                                            </div>
                                            <div class="chart-wrapper">
                                                <canvas id="chart_sales_order"></canvas>
                                            </div>
                                            {{-- <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="w-100 mr-2">
                                                        <h6>Pixel 2</h6>
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-danger" style="width: 40%"></div>
                                                        </div>
                                                    </div>
                                                    <div class="ml-2 w-100">
                                                        <h6>iPhone X</h6>
                                                        <div class="progress" style="height: 6px">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                     
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Today Order List</h4>
                
                                        <div class="custom-tab-1">
                                            <ul class="nav nav-tabs mb-3">
                                                {{-- <li class="nav-item order_page_tabs" data-tab="ALL_orders_tab"><a class="nav-link active show" data-toggle="tab" href="">ALL</a>
                                                </li> --}}
                                                <li class="nav-item order_page_tabs" data-tab="NewOrder_orders_tab"><a class="nav-link active show" data-toggle="tab" href="">New Order</a>
                                                </li>
                                                <li class="nav-item order_page_tabs" data-tab="Returned_orders_tab"><a class="nav-link" data-toggle="tab" href="">Returned</a>
                                                </li>
                                            </ul>
                                        </div>
                
                                        <div class="tab-pane fade show active table-responsive" id="ALL_orders_tab">
                                            <table id="Order" class="table zero-configuration customNewtable" style="width:100%">
                                                <thead>
                                                <tr>
                                                 
                                                    <th>No</th>
                                                    <th>Order</th>
                                                    <th>Customer</th>
                                                    <th>Payment Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                 
                                                    <th>No</th>
                                                    <th>Order</th>
                                                    <th>Customer</th>
                                                    <th>Payment Status</th>
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

    </div>

    <div class="modal fade" id="TrackingModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="trackingform" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add Tracking URL</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="attr-cover-spin" class="cover-spin"></div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-form-label" for="tracking_url" >Tracking URL <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="tracking_url" name="tracking_url" placeholder="">
                            <div id="tracking_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="order_id" id="order_id">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="AddTrackingBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @endif
    @endsection
    @section('js')
    <!-- user list JS start -->
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

        
    });
    function editOrder(orderId) {
        var url = "{{ url('admin/viewOrder') }}" + "/" + orderId;
        window.open(url,"_blank");
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
            "url": "{{ url('admin/TodayallOrderlist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}', tab_type: tab_type},
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "20px", "targets": 0 },
            { "width": "150px", "targets": 1 },
            { "width": "230px", "targets": 2 },
            { "width": "130px", "targets": 3 },
            { "width": "150px", "targets": 4 },
            { "width": "120px", "targets": 5 },
            
        ],
        "columns": [
            
            {data: 'id', name: 'id', class: "text-center", orderable: false ,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'order_info', name: 'order_info', orderable: false, class: "text-left multirow"},
            {data: 'customer_info', name: 'customer_info', orderable: false, class: "text-left multirow"},
            {data: 'payment_status', name: 'payment_status', orderable: false, class: "text-center multirow"},
            {data: 'created_at', name: 'created_at', orderable: false, class: "text-left multirow"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

$('body').on('click', '#editTrackingBtn', function () {
    var order_id = $(this).attr('data-id');
    $('#order_id').val(order_id);
});



$('body').on('click', '#AddTrackingBtn', function () {
    $(this).prop('disabled',true);
    $(this).find('.loadericonfa').show();
    var btn = $(this);

    var formData = new FormData($('#trackingform')[0]);
  
    var tab_type = get_orders_page_tabType();
    //var order_id = $(this).attr('data-id');

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.updatetrackingurl') }}",
            data: formData,
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                
                if(res['status'] == 'failed'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    if (res.errors.tracking_url) {
                        $('#tracking_url-error').show().text(res.errors.tracking_url);
                    } else {
                        $('#tracking_url-error').hide();
                    }
                   
                }
                if(res['status']==200){
                    //location.href = "{{ route('admin.orders.list') }}";
                    $("#TrackingModal").modal('hide');
                    order_table(tab_type);
                    toastr.success("Tracking URL Updated",'Success',{timeOut: 5000});
                }

                if(res['status'] == 400){
                    $("#TrackingModal").modal('hide');
                    $(btn).find('.loadericonfa').hide();
                    $(btn).prop('disabled',false);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
                
            },
            error: function (data) {
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
       });    
});

  //Sales chart
  (function($) {
    "use strict"

    const currentYear = new Date().getFullYear();
    const currentMonth = new Date().getMonth() + 1;
    var total_dayss = [];
    var total_days = daysInMonth(currentMonth,currentYear);
    for(var i = 1; i <= total_days; i++){
        total_dayss.push(i);
    }

    var level1 = "{{ $string_version_1 }}";
    var numbersArray1 = level1.split(',');

    //console.log(total_dayss);
    let ctx = document.getElementById("chart_orders");
    ctx.height = 280;
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: total_dayss,
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: numbersArray1,
                label: "Orders",
                backgroundColor: '#847DFA',
                borderColor: '#847DFA',
                borderWidth: 0.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: '#847DFA',
            }]
        },
        options: {
            responsive: !0,
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },


            },
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });


    


})(jQuery);

 //Sales chart
 (function($) {
    "use strict"

    const currentYear = new Date().getFullYear();
    const currentMonth = new Date().getMonth() + 1;
    var total_dayss = [];
    var total_days = daysInMonth(currentMonth,currentYear);
    for(var i = 1; i <= total_days; i++){
        total_dayss.push(i);
    }

    var level1 = "{{ $string_version_2 }}";
    var numbersArray1 = level1.split(',');

    //console.log(total_dayss);
    let ctx = document.getElementById("chart_sales_order");
    ctx.height = 280;
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: total_dayss,
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: numbersArray1,
                label: "Sales Order amount",
                backgroundColor: '#F196B0',
                borderColor: '#F196B0',
                borderWidth: 0.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: '#F196B0',
            }]
        },
        options: {
            responsive: !0,
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },


            },
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: false,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }]
            },
            title: {
                display: false,
            }
        }
    });


    


})(jQuery);

function daysInMonth (month, year) {
    return new Date(year, month, 0).getDate();
}
</script>
@endsection
