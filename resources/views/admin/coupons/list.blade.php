@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Coupon List</a></li>
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
                                Add New Coupon
                            @elseif(isset($action) && $action=='edit')
                                Edit Coupon
                            @else
                                Coupon List
                            @endif
                        </h4>

                        <div class="action-section">
                            <div class="d-flex">
                                <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.coupons.list')->pluck('id')->first(); ?>
                                @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                    <button type="button" class="btn btn-primary" id="AddCouponBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                @endif
                                {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                            </div>
                        </div>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Coupon" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Coupon Code</th>
                                        <th>Discount Type</th>
                                        <th>Limitations</th>
                                        <th>Expiry Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Coupon Code</th>
                                        <th>Discount Type</th>
                                        <th>Limitations</th>
                                        <th>Expiry Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && $action=='create')
                            @include('admin.coupons.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.coupons.edit')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteCouponModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Coupon</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Coupon?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveCouponSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- Coupon JS start -->
<script type="text/javascript">
$('body').on('click', '#AddCouponBtn', function () {
    location.href = "{{ route('admin.coupons.add') }}";
});

$('body').on('click', '#save_closeCouponBtn', function () {
    save_coupon($(this),'save_close');
});

$('body').on('click', '#save_newCouponBtn', function () {
    save_coupon($(this),'save_new');
});

function save_coupon(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#CouponForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.coupons.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();

                if (res.errors.coupon_code) {
                    $('#coupon_code-error').show().text(res.errors.coupon_code);
                } else {
                    $('#coupon_code-error').hide();
                }

                if (res.errors.coupon_amount) {
                    $('#coupon_amount-error').show().text(res.errors.coupon_amount);
                } else {
                    $('#coupon_amount-error').hide();
                }

                if (res.errors.usage_per_user) {
                    $('#usage_per_user-error').show().text(res.errors.usage_per_user);
                } else {
                    $('#usage_per_user-error').hide();
                }

                if (res.errors.expiry_date) {
                    $('#expiry_date-error').show().text(res.errors.expiry_date);
                } else {
                    $('#expiry_date-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.coupons.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Coupon Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Coupon Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.coupons.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Coupon Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Coupon Updated",'Success',{timeOut: 5000});
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

$(document).ready(function() {
    coupon_table(true);
});

function coupon_table(is_clearState=false){
    if(is_clearState){
        $('#Coupon').DataTable().state.clear();
    }

    $('#Coupon').DataTable({
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
            "url": "{{ url('admin/allcouponlist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}'},
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "50px", "targets": 0 },
            { "width": "120px", "targets": 1 },
            { "width": "170px", "targets": 2 },
            { "width": "240px", "targets": 3 },
            { "width": "150px", "targets": 4 },
            { "width": "100px", "targets": 5 },
        ],
        "columns": [
            {data: 'no', name: 'no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'coupon_code', name: 'coupon_code', class: "text-left"},
            {data: 'discount_type_id', name: 'discount_type_id', class: "text-left"},
            {data: 'limitations', name: 'limitations', class: "text-left", orderable: false},
            {data: 'expiry_date', name: 'expiry_date', class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

$('body').on('click', '#editCouponBtn', function () {
    var Coupon_id = $(this).attr('data-id');
    var url = "{{ url('admin/coupons') }}" + "/" + Coupon_id + "/edit";
    window.open(url,"_blank");
});

$('body').on('click', '#deleteCouponBtn', function (e) {
    // e.preventDefault();
    var Coupon_id = $(this).attr('data-id');
    $("#DeleteCouponModal").find('#RemoveCouponSubmit').attr('data-id',Coupon_id);
});

$('#DeleteCouponModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveCouponSubmit").removeAttr('data-id');
});

$('body').on('click', '#RemoveCouponSubmit', function (e) {
    $('#RemoveCouponSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var Coupon_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/coupons') }}" +'/' + Coupon_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteCouponModal").modal('hide');
                $('#RemoveCouponSubmit').prop('disabled',false);
                $("#RemoveCouponSubmit").find('.removeloadericonfa').hide();
                coupon_table();
                toastr.success("Coupon Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteCouponModal").modal('hide');
                $('#RemoveCouponSubmit').prop('disabled',false);
                $("#RemoveCouponSubmit").find('.removeloadericonfa').hide();
                coupon_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteCouponModal").modal('hide');
            $('#RemoveCouponSubmit').prop('disabled',false);
            $("#RemoveCouponSubmit").find('.removeloadericonfa').hide();
            coupon_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('body').on('change', '#discount_type_id', function () {
    if($(this).val() == 1){
        $("#Coupon_Amount_label").html("Coupon Percentage (%) <span class='text-danger'>*</span>");
    }
    else if($(this).val() == 2){
        $("#Coupon_Amount_label").html("Coupon Amount <span class='text-danger'>*</span>");
    }
});
</script>
<!-- Coupon JS end -->
@endsection

