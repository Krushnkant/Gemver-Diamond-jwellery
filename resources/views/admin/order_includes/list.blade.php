@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Order Includes</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            @if(isset($action) && $action=='create')
                            Add Order Includes
                            @elseif(isset($action) && $action=='edit')
                            Edit Order Includes
                            @else
                            Order Includes List
                            @endif
                        </h4>

                       

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="OrderIncludes" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && $action=='create')
                            @include('admin.order_includes.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.order_includes.edit')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteOrderIncludesModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Order Includes</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Order Includes?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveOrderIncludesSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- category JS start -->
<script type="text/javascript">

$(document).ready(function() {
    orderinludes_table(true);
});

$('body').on('click', '#AddOrderIncludesBtn', function () {
    location.href = "{{ route('admin.order_includes.add') }}";
});

$('body').on('click', '#save_closeOrderIncludesBtn', function () {
    save_orderincludes($(this),'save_close');
});

$('body').on('click', '#save_newOrderIncludesBtn', function () {
    save_orderincludes($(this),'save_new');
});

function save_orderincludes(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#OrderIncludesCreateForm")[0]);
    formData.append('action',action);
   
    $.ajax({
        type: 'POST',
        url: "{{ route('admin.order_includes.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();


                if (res.errors.title) {
                    $('#title-error').show().text(res.errors.title);
                } else {
                    $('#title-error').hide();
                }

                if (res.errors.catImg) {
                    $('#categorythumb-error').show().text(res.errors.catImg);
                } else {
                    $('#categorythumb-error').hide();
                }

               

            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.order_includes.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Order Includes Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Order Includes Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.order_includes.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Order Includes Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Order Includes Updated",'Success',{timeOut: 5000});
                    }
                }
            }

        },
        error: function (data) {
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}

function orderinludes_table(is_clearState=false){
    if(is_clearState){
        $('#OrderIncludes').DataTable().state.clear();
    }

    $('#OrderIncludes').DataTable({
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
            "url": "{{ url('admin/allorderinludeslist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}' },
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "50px", "targets": 0 },
            { "width": "120px", "targets": 1 },
            { "width": "170px", "targets": 2 },
            { "width": "70px", "targets": 3 },
            { "width": "120px", "targets": 4 },
            { "width": "120px", "targets": 5 },
        ],
        "columns": [
            {data: 'sr_no', name: 'sr_no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'image', name: 'image', orderable: false, searchable: false, class: "text-center"},
            {data: 'title', name: 'title', class: "text-left"},
            {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

function chageOrderIncludesStatus(orderincludes_id) {
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/changeshopbystylestatus') }}" +'/' + orderincludes_id,
        success: function (res) {
            if(res.status == 200 && res.action=='deactive'){
                $("#OrderIncludescheck_"+orderincludes_id).val(2);
                $("#OrderIncludescheck_"+orderincludes_id).prop('checked',false);
                toastr.success("Order Includes Deactivated",'Success',{timeOut: 5000});
            }
            if(res.status == 200 && res.action=='active'){
                $("#OrderIncludescheck_"+orderincludes_id).val(1);
                $("#OrderIncludescheck_"+orderincludes_id).prop('checked',true);
                toastr.success("Order Includes activated",'Success',{timeOut: 5000});
            }
        },
        error: function (data) {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}

$('body').on('click', '#deleteOrderInludesBtn', function (e) {
    // e.preventDefault();
    var orderincludes_id = $(this).attr('data-id');
    $("#DeleteOrderIncludesModal").find('#RemoveOrderIncludesSubmit').attr('data-id',orderincludes_id);
});

$('body').on('click', '#RemoveOrderIncludesSubmit', function (e) {
    $('#RemoveOrderIncludesSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var orderincludes_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/shopbystyle') }}" +'/' + orderincludes_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteOrderIncludesModal").modal('hide');
                $('#RemoveOrderIncludesSubmit').prop('disabled',false);
                $("#RemoveOrderIncludesSubmit").find('.removeloadericonfa').hide();
                orderinludes_table();
                toastr.success("Order Includes Deleted",'Success',{timeOut: 5000});
            }
            if(res.status == 400){
                $("#DeleteOrderIncludesModal").modal('hide');
                $('#RemoveOrderIncludesSubmit').prop('disabled',false);
                $("#RemoveOrderIncludesSubmit").find('.removeloadericonfa').hide();
                orderinludes_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteOrderIncludesModal").modal('hide');
            $('#RemoveOrderIncludesSubmit').prop('disabled',false);
            $("#RemoveOrderIncludesSubmit").find('.removeloadericonfa').hide();
            orderinludes_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('#DeleteOrderIncludesModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveOrderIncludesSubmit").removeAttr('data-id');
});

$('body').on('click', '#editShopByStyleBtn', function () {
    var orderincludes_id = $(this).attr('data-id');
    var url = "{{ url('admin/shopbystyle') }}" + "/" + orderincludes_id + "/edit";
    window.open(url,"_blank");
});

function removeuploadedimg(divId ,inputId, imgName){
    if(confirm("Are you sure you want to remove this file?")){
        $("#"+divId).remove();
        $("#"+inputId).removeAttr('value');
        var filerKit = $("#catIconFiles").prop("jFiler");
        filerKit.reset();
    }
}



$('body').on('click', '#Add', function(){    
      var html = '';
      html += '<div class="row col-lg-12"><div class="col-lg-4 ">'+
        '<div class="form-group ">'+
        '<input type="file" class="form-control-file" id="image" onchange="" name="image[]">'+
        '</div>'+
        '</div>'+
        '<div class="col-lg-4 ">'+
        '<div class="form-group">'+
       
        '<input type="text" class="form-control input-flat" id="subtitle" name="subtitle[]">'+
        '<div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>'+
        '</div>'+
        '</div>'+
        '<div class="col-md-2">'+
            '<button type="button"  class="minus_btn btn mb-1 btn-dark">-</button>'+
        '</div>'+
        '</div></div>';
               
        $(".add-value").append(html);
    });

    

    $('body').on('click', '.minus_btn', function(){
        var tthis = $(this).parent().parent();
        var ddd = tthis.remove()
    });





</script>
<!-- category JS end -->
@endsection

