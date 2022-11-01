@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Settings</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Settings List
                        </h4>--}}
                        <div class="col-lg-12">

                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th colspan="3"><h4 class="text-white mb-0">Settings</h4></th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <th style="width: 50%">About Us</th>
                                    <!-- <td><span id="UserDiscountPerVal">test</span></td> -->
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.infopage.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Customer Value</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.customer_value.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="width: 50%">Conflict Free Diamonds</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.conflict_free_diamonds.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="width: 50%">Diamond Anatomy</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.diamond_anatomy.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="width: 50%">Free Engraving</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.free_engraving.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Free Resizing</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.free_resizing.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Free Shipping</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.free_shipping.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="width: 50%">Home Setting</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.homesettings.create') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="width: 50%">Lifetime Upgrade</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.lifetime_upgrade.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Lifetime Warranty</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.lifetime_warranty.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Learn About Lab Made Diamonds</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.learn_about_lab_made_diamonds.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Market Need</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.market_need.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Payment Options</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.payment_options.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th style="width: 50%">Privacy Policy</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.privacy_policy.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Return Days</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.return_days.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Terms & Condition</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.terms_condition.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th style="width: 50%">Why Friendly</th>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <a href="{{ route('admin.why_friendly.list') }}" target="_blank" class="btn btn-outline-dark btn-sm" >
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                            
                                </tbody>
                            </table>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    


@endsection

@section('js')
<!-- settings JS start -->
<script type="text/javascript">
    $('body').on('click', '#editUserDiscountPerBtn', function () {
        $.get("{{ url('admin/settings/user_discount_percentage/edit') }}", function (data) {
            $('#user_discount_percentage').val(data.user_discount_percentage);
        })
    });

    $('body').on('click', '#editShippingCostBtn', function () {
        $.get("{{ url('admin/settings/shipping_cost/edit') }}", function (data) {
            $('#shipping_cost').val(data.shipping_cost);
        })
    });

    $('body').on('click', '#editPremiumUserMembershipFeeBtn', function () {
        $.get("{{ url('admin/settings/premium_user_membership_fee/edit') }}", function (data) {
            $('#premium_user_membership_fee').val(data.premium_user_membership_fee);
        })
    });

    $('body').on('click', '#saveUserDiscountPerBtn', function () {
        $('#saveUserDiscountPerBtn').prop('disabled',true);
        $('#saveUserDiscountPerBtn').find('.loadericonfa').show();
        var formData = new FormData($("#UserDiscountPerForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateUserDiscountPercentage') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveUserDiscountPerBtn').prop('disabled',false);
                    $('#saveUserDiscountPerBtn').find('.loadericonfa').hide();
                    if (res.errors.user_discount_percentage) {
                        $('#user_discount_percentage-error').show().text(res.errors.user_discount_percentage);
                    } else {
                        $('#user_discount_percentage-error').hide();
                    }
                }

                if(res.status == 200){
                    $("#UserDiscountPerModal").modal('hide');
                    $('#saveUserDiscountPerBtn').prop('disabled',false);
                    $('#saveUserDiscountPerBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.user_discount_percentage + " %");
                    toastr.success("Settings Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#UserDiscountPerModal").modal('hide');
                    $('#saveUserDiscountPerBtn').prop('disabled',false);
                    $('#saveUserDiscountPerBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#UserDiscountPerModal").modal('hide');
                $('#saveUserDiscountPerBtn').prop('disabled',false);
                $('#saveUserDiscountPerBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('body').on('click', '#saveShippingCostBtn', function () {
        $('#saveShippingCostBtn').prop('disabled',true);
        $('#saveShippingCostBtn').find('.loadericonfa').show();
        var formData = new FormData($("#ShippingCostForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateShippingCost') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveShippingCostBtn').prop('disabled',false);
                    $('#saveShippingCostBtn').find('.loadericonfa').hide();
                    if (res.errors.shipping_cost) {
                        $('#shipping_cost-error').show().text(res.errors.shipping_cost);
                    } else {
                        $('#shipping_cost-error').hide();
                    }
                }

                if(res.status == 200){
                    $("#ShippingCostModal").modal('hide');
                    $('#saveShippingCostBtn').prop('disabled',false);
                    $('#saveShippingCostBtn').find('.loadericonfa').hide();
                    $("#ShippingCostVal").html('$ ' + res.shipping_cost);
                    toastr.success("Settings Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#ShippingCostModal").modal('hide');
                    $('#saveShippingCostBtn').prop('disabled',false);
                    $('#saveShippingCostBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#ShippingCostModal").modal('hide');
                $('#saveShippingCostBtn').prop('disabled',false);
                $('#saveShippingCostBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('body').on('click', '#savePremiumUserMembershipFeeBtn', function () {
        $('#savePremiumUserMembershipFeeBtn').prop('disabled',true);
        $('#savePremiumUserMembershipFeeBtn').find('.loadericonfa').show();
        var formData = new FormData($("#PremiumUserMembershipFeeForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updatePremiumUserMembershipFee') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#savePremiumUserMembershipFeeBtn').prop('disabled',false);
                    $('#savePremiumUserMembershipFeeBtn').find('.loadericonfa').hide();
                    if (res.errors.premium_user_membership_fee) {
                        $('#premium_user_membership_fee-error').show().text(res.errors.premium_user_membership_fee);
                    } else {
                        $('#premium_user_membership_fee-error').hide();
                    }
                }

                if(res.status == 200){
                    $("#PremiumUserMembershipFeeModal").modal('hide');
                    $('#savePremiumUserMembershipFeeBtn').prop('disabled',false);
                    $('#savePremiumUserMembershipFeeBtn').find('.loadericonfa').hide();
                    $("#PremiumUserMembershipFeeVal").html('$ ' + res.premium_user_membership_fee);
                    toastr.success("Settings Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#PremiumUserMembershipFeeModal").modal('hide');
                    $('#savePremiumUserMembershipFeeBtn').prop('disabled',false);
                    $('#savePremiumUserMembershipFeeBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#PremiumUserMembershipFeeModal").modal('hide');
                $('#savePremiumUserMembershipFeeBtn').prop('disabled',false);
                $('#savePremiumUserMembershipFeeBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('#UserDiscountPerModal').on('shown.bs.modal', function (e) {
        $("#user_discount_percentage").focus();
    });

    $('#ShippingCostModal').on('shown.bs.modal', function (e) {
        $("#shipping_cost").focus();
    });

    $('#PremiumUserMembershipFeeModal').on('shown.bs.modal', function (e) {
        $("#premium_user_membership_fee").focus();
    });

    $('#UserDiscountPerModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#user_discount_percentage-error').html("");
    });

    $('#ShippingCostModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#shipping_cost-error').html("");
    });

    $('#PremiumUserMembershipFeeModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#premium_user_membership_fee-error').html("");
    });

    $('body').on('click', '#editMinOrderAmountBtn', function () {
        $.get("{{ url('admin/settings/min_order_amount/edit') }}", function (data) {
            $('#min_order_amount').val(data.min_order_amount);
        })
    });

    $('body').on('click', '#saveMinOrderAmountBtn', function () {
        $('#saveMinOrderAmountBtn').prop('disabled',true);
        $('#saveMinOrderAmountBtn').find('.loadericonfa').show();
        var formData = new FormData($("#MinOrderAmountForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateMinOrderAmount') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveMinOrderAmountBtn').prop('disabled',false);
                    $('#saveMinOrderAmountBtn').find('.loadericonfa').hide();
                    if (res.errors.min_order_amount) {
                        $('#min_order_amount-error').show().text(res.errors.min_order_amount);
                    } else {
                        $('#min_order_amount-error').hide();
                    }
                }

                if(res.status == 200){
                    $("#MinOrderAmountModal").modal('hide');
                    $('#saveMinOrderAmountBtn').prop('disabled',false);
                    $('#saveMinOrderAmountBtn').find('.loadericonfa').hide();
                    $("#MinOrderAmountVal").html('$ ' + res.min_order_amount);
                    toastr.success("Settings Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#MinOrderAmountModal").modal('hide');
                    $('#saveMinOrderAmountBtn').prop('disabled',false);
                    $('#saveMinOrderAmountBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#MinOrderAmountModal").modal('hide');
                $('#saveMinOrderAmountBtn').prop('disabled',false);
                $('#saveMinOrderAmountBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('#MinOrderAmountModal').on('shown.bs.modal', function (e) {
        $("#min_order_amount").focus();
    });

    $('#MinOrderAmountModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#min_order_amount-error').html("");
    });
</script>
<!-- settings JS end -->
@endsection
