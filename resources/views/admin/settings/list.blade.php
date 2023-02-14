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
            <div class="col-md-10">
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
                                        <th><h4 class="text-white mt-0 mb-0">Setting</h4></th>
                                        <th colspan="2" class="text-right">
                                            <button id="editInvoiceBtn" class="btn btn-outline-white btn-sm" data-toggle="modal" data-target="#InvoiceModal">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                <tr>
                                        <th style="width: 50%">Company Name</th>
                                        <td><span id="company_name_val">{{ $Settings->company_name }}</span></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Company Logo</th>
                                        <td>
                                            @if(isset($Settings->company_logo))
                                                <img src="{{ url('images/company/'.$Settings->company_logo) }}" width="150px" height="" alt="Company Logo" id="company_logo_val">
                                            @else
                                                <img src="{{ url('images/placeholder_image.png') }}" width="150px" height="" alt="Company Logo" id="company_logo_val">
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 50%">Company Favicon</th>
                                        <td>
                                            @if(isset($Settings->company_favicon))
                                                <img src="{{ url('images/company/'.$Settings->company_favicon) }}" width="30px" height="" alt="Company Favicon" id="company_favicon_val">
                                            @else
                                                <img src="{{ url('images/placeholder_image.png') }}" width="30px" height="" alt="Company Favicon" id="company_favicon_val">
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="width: 50%">Company Address</th>
                                        <td><span id="company_address_val">{{ $Settings->company_address }}</span></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Company Mobile No.</th>
                                        <td><span id="company_mobile_no_val">{{ $Settings->company_mobile_no }}</span></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Company Email</th>
                                        <td><span id="company_email_val">{{ $Settings->company_email }}</span></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Company Send Email</th>
                                        <td><span id="company_send_email_val">{{ $Settings->send_email }}</span></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Youtube URL</th>
                                        <td><span id="youtub_url_val">{{ $Settings->youtub_url }}</span></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Instagram URL</th>
                                        <td><span id="instagram_url_val">{{ $Settings->instagram_url }}</span></td>
                                    </tr>
                                    <!--<tr>-->
                                    <!--    <th style="width: 50%">Tiktok URL</th>-->
                                    <!--    <td><span id="tiktok_url_val">{{ $Settings->tiktok_url }}</span></td>-->
                                    <!--</tr>-->
                                    <tr>
                                        <th style="width: 50%">Pinterest URL</th>
                                        <td><span id="twiter_url_val">{{ $Settings->twiter_url }}</span></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Facebook URL</th>
                                        <td><span id="facebook_url_val">{{ $Settings->facebook_url }}</span></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Max Order Price</th>
                                        <td><span id="max_order_price_val">{{ $Settings->max_order_price }}</span></td>
                                    </tr>

                                    <!-- <tr>
                                        <th style="width: 50%">Comapny Address Map</th>
                                        <td><span id="facebook_url_val">{{ $Settings->company_address_map }}</span></td>
                                    </tr> -->
                                    

                                   
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <span class="display-5"><i class="icon-diamond gradient-4-text"></i></span>
                                           
                                            <p>Round,Heart,Cushion</p>
                                            <button id="diamondcron1" class="btn gradient-4 btn-lg border-0 btn-rounded px-5">Cron Run <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <span class="display-5"><i class="icon-diamond gradient-4-text"></i></span>
                                           
                                            <p>Asscher,Emerald,Oval</p>
                                            <button id="diamondcron2" class="btn gradient-4 btn-lg border-0 btn-rounded px-5">Cron Run <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <span class="display-5"><i class="icon-diamond gradient-4-text"></i></span>
                                            
                                            <p>Radiant,Marquise,Princess,Pear</p>
                                            <button id="diamondcron3"  class="btn gradient-4 btn-lg border-0 btn-rounded px-5">Cron Run <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <span class="display-5"><i class="icon-diamond gradient-4-text"></i></span>
                                    
                                            <p>Other</p>
                                            <button id="diamondcron4" class="btn gradient-4 btn-lg border-0 btn-rounded px-5">Cron Run <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                           
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 

    <div class="modal fade" id="InvoiceModal">
        <div class="modal-dialog modal-dialog-centered mw-100 w-50" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="InvoiceForm" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Update Settings</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="attr-cover-spin" class="cover-spin"></div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label class="col-form-label" for="Company Name">Company Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="company_name" name="company_name" placeholder="">
                                <div id="company_name-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label class="col-form-label" for="Company Mobile No.">Company Mobile No. <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="company_mobile_no" name="company_mobile_no" placeholder="">
                                <div id="company_mobile_no-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="Company Email">Company Email <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="company_email" name="company_email" placeholder="">
                            <div id="company_email-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="Company Email">Company Send Email <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="company_send_email" name="company_send_email" placeholder="">
                            <div id="company_send_email-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="Logo">Company Logo <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control-file" id="company_logo" name="company_logo" placeholder="">
                            <div id="company_logo-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            <img src="{{ url('images/placeholder_image.png') }}" class="" id="company_logo_image_show" height="50px" width="50px" style="margin-top: 5px">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="favicon">Company Favicon <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control-file" id="company_favicon" name="company_favicon" placeholder="">
                            <div id="company_favicon-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            <img src="{{ url('images/placeholder_image.png') }}" class="" id="company_favicon_image_show" height="50px" width="50px" style="margin-top: 5px">
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="Company Address">Company Address <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control input-flat" id="company_address" name="company_address" placeholder=""></textarea>
                            <div id="company_address-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="Youtube URL">Youtube URL 
                            </label>
                            <input type="text" class="form-control input-flat" id="youtub_url" name="youtub_url" placeholder="">
                            <div id="youtub_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="Instagram URL">Instagram URL 
                            </label>
                            <input type="text" class="form-control input-flat" id="instagram_url" name="instagram_url" placeholder="">
                            <div id="instagram_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="twiter_url">Pinterest URL
                            </label>
                            <input type="text" class="form-control input-flat" id="twiter_url" name="twiter_url" placeholder="">
                            <div id="twiter_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
                        <!--    <label class="col-form-label" for="Tiktok URL">Tiktok URL-->
                        <!--    </label>-->
                        <!--    <input type="text" class="form-control input-flat" id="tiktok_url" name="tiktok_url" placeholder="">-->
                        <!--    <div id="tiktok_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>-->
                        <!--</div>-->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="Facebook URL">Facebook URL
                            </label>
                            <input type="text" class="form-control input-flat" id="facebook_url" name="facebook_url" placeholder="">
                            <div id="facebook_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="max_order_price">Max Order Price
                            </label>
                            <input type="number" class="form-control input-flat" id="max_order_price" name="max_order_price" placeholder="">
                            <div id="max_order_price-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="Company Address Map">Company Address Map<span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control input-flat" id="company_address_map" name="company_address_map" placeholder=""></textarea>
                            <div id="company_address_map-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveInvoiceBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
<!-- settings JS start -->
<script type="text/javascript">
    $('#InvoiceModal').on('shown.bs.modal', function (e) {
        $("#prefix_invoice_no").focus();
    });

    $('#InvoiceModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#prefix_invoice_no-error').html("");
        $('#invoice_no-error').html("");
        $('#company_name-error').html("");
        $('#company_logo-error').html("");
        $('#company_favicon-error').html("");
        $('#company_address-error').html("");
        $('#company_mobile_no-error').html("");
        $('#company_email-error').html("");
        $('#company_send_email-error').html("");
        $('#youtub_url-error').html("");
        $('#instagram_url-error').html("");
        $('#twiter_url-error').html("");
        $('#tiktok_url-error').html("");
        $('#facebook_url-error').html("");
        $('#company_address_map-error').html("");
        $('#max_order_price-error').html("");
        var default_image = "{{ url('images/placeholder_image.png') }}";
        $('#company_logo_image_show').attr('src', default_image);
    });

    $('body').on('click', '#editInvoiceBtn', function () {
        $.get("{{ url('admin/settings/edit') }}", function (data) {
           
            $('#prefix_invoice_no').val(data.prefix_invoice_no);
            $('#invoice_no').val(data.invoice_no);
            $('#company_name').val(data.company_name);
            $('#company_address').val(data.company_address);
            $('#company_mobile_no').val(data.company_mobile_no);
            $('#company_email').val(data.company_email);
            $('#company_send_email').val(data.send_email);
            $('#youtub_url').val(data.youtub_url);
            $('#instagram_url').val(data.instagram_url);
            $('#twiter_url').val(data.twiter_url);
            $('#tiktok_url').val(data.tiktok_url);
            $('#facebook_url').val(data.facebook_url);
            $('#company_address_map').val(data.company_address_map);
            $('#max_order_price').val(data.max_order_price);
            if(data.company_logo==null){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#company_logo_image_show').attr('src', default_image);
            }
            else{
                var company_logo = "{{ url('images/company') }}" +"/" + data.company_logo;
                $('#company_logo_image_show').attr('src', company_logo);
            }

            if(data.company_favicon==null){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#company_favicon_image_show').attr('src', default_image);
            }
            else{
                var company_favicon = "{{ url('images/company') }}" +"/" + data.company_favicon;
                $('#company_favicon_image_show').attr('src', company_favicon);
            }
        })
    });

    $('body').on('click', '#saveInvoiceBtn', function () {
        $('#saveInvoiceBtn').prop('disabled',true);
        $('#saveInvoiceBtn').find('.loadericonfa').show();
        var formData = new FormData($("#InvoiceForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateInvoiceSetting') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveInvoiceBtn').prop('disabled',false);
                    $('#saveInvoiceBtn').find('.loadericonfa').hide();
                    if (res.errors.prefix_invoice_no) {
                        $('#prefix_invoice_no-error').show().text(res.errors.prefix_invoice_no);
                    } else {
                        $('#prefix_invoice_no-error').hide();
                    }

                    if (res.errors.invoice_no) {
                        $('#invoice_no-error').show().text(res.errors.invoice_no);
                    } else {
                        $('#invoice_no-error').hide();
                    }

                    if (res.errors.company_name) {
                        $('#company_name-error').show().text(res.errors.company_name);
                    } else {
                        $('#company_name-error').hide();
                    }

                    if (res.errors.company_logo) {
                        $('#company_logo-error').show().text(res.errors.company_logo);
                    } else {
                        $('#company_logo-error').hide();
                    }

                    if (res.errors.company_address) {
                        $('#company_address-error').show().text(res.errors.company_address);
                    } else {
                        $('#company_address-error').hide();
                    }

                    if (res.errors.company_mobile_no) {
                        $('#company_mobile_no-error').show().text(res.errors.company_mobile_no);
                    } else {
                        $('#company_mobile_no-error').hide();
                    }

                    if (res.errors.company_email) {
                        $('#company_email-error').show().text(res.errors.company_emai);
                    } else {
                        $('#company_email-error').hide();
                    }

                    if (res.errors.company_send_email) {
                        $('#company_send_email-error').show().text(res.errors.company_send_email);
                    } else {
                        $('#company_send_email-error').hide();
                    }

                    // if (res.errors.youtub_url) {
                    //     $('#youtub_url-error').show().text(res.errors.youtub_url);
                    // } else {
                    //     $('#youtub_url-error').hide();
                    // }

                    // if (res.errors.instagram_url) {
                    //     $('#instagram_url-error').show().text(res.errors.instagram_url);
                    // } else {
                    //     $('#instagram_url-error').hide();
                    // }

                    // if (res.errors.twiter_url) {
                    //     $('#twiter_url-error').show().text(res.errors.twiter_url);
                    // } else {
                    //     $('#twiter_url-error').hide();
                    // }

                    // if (res.errors.tiktok_url) {
                    //     $('#tiktok_url-error').show().text(res.errors.tiktok_url);
                    // } else {
                    //     $('#tiktok_url-error').hide();
                    // }

                    // if (res.errors.facebook_url) {
                    //     $('#facebook_url-error').show().text(res.errors.facebook_url);
                    // } else {
                    //     $('#facebook_url-error').hide();
                    // }
                }

                if(res.status == 200){
                    $("#InvoiceModal").modal('hide');
                    $('#saveInvoiceBtn').prop('disabled',false);
                    $('#saveInvoiceBtn').find('.loadericonfa').hide();

                    $("#company_name_val").html(res.Settings.company_name);
                    var logo = "{{ url('images/company') }}" + "/" + res.Settings.company_logo;
                    if(res.Settings.company_logo!="" && res.Settings.company_logo!=null) {
                        $('#company_logo_val').attr('src', logo);
                    }

                    var favicon = "{{ url('images/company') }}" + "/" + res.Settings.company_favicon;
                    if(res.Settings.company_favicon!="" && res.Settings.company_favicon!=null) {
                        $('#company_favicon_val').attr('src', favicon);
                    }
                   
                    $("#company_address_val").html(res.Settings.company_address);
                    $("#company_mobile_no_val").html(res.Settings.company_mobile_no);
                    $("#company_email_val").html(res.Settings.company_email);
                    $("#company_send_email_val").html(res.Settings.send_email);
                    $("#youtub_url_val").html(res.Settings.youtub_url);
                    $("#instagram_url_val").html(res.Settings.instagram_url);
                    $("#twiter_url_val").html(res.Settings.twiter_url);
                    $("#tiktok_url_val").html(res.Settings.tiktok_url);
                    $("#facebook_url_val").html(res.Settings.facebook_url);
                    $("#company_address_map").html(res.Settings.company_address_map);
                    $("#max_order_price_val").html(res.Settings.max_order_price);
                    toastr.success("Settings Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#InvoiceModal").modal('hide');
                    $('#saveInvoiceBtn').prop('disabled',false);
                    $('#saveInvoiceBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#InvoiceModal").modal('hide');
                $('#saveInvoiceBtn').prop('disabled',false);
                $('#saveInvoiceBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('#company_logo').change(function(){
        $('#company_logo-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#company_logo-error').show().text("Please provide a Valid Extension Logo(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#company_logo_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#company_logo_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#company_favicon').change(function(){
        $('#company_favicon-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#company_favicon-error').show().text("Please provide a Valid Extension Logo(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#company_favicon_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#company_favicon_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });


    $('body').on('click', '#diamondcron1', function () {
        $('#diamondcron1').prop('disabled',true);
        $('#diamondcron1').find('.loadericonfa').show();
        
        $.ajax({
            type: 'get',
            url: "{{ url('admin/importnewdiamond') }}",
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 200){
                    $('#diamondcron1').prop('disabled',false);
                    $('#diamondcron1').find('.loadericonfa').hide();
                    toastr.success("Round Heart Cushion Updated",'Success');
                }

                if(res.status == 400){
                   
                    $('#diamondcron1').prop('disabled',false);
                    $('#diamondcron1').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error');
                }
            },
            error: function (data) {
               
                $('#diamondcron1').prop('disabled',false);
                $('#diamondcron1').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error');
            }
        });
    });

    $('body').on('click', '#diamondcron2', function () {
        $('#diamondcron2').prop('disabled',true);
        $('#diamondcron2').find('.loadericonfa').show();
        
        $.ajax({
            type: 'get',
            url: "{{ url('admin/importnewdiamond1') }}",
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 200){
                    $('#diamondcron2').prop('disabled',false);
                    $('#diamondcron2').find('.loadericonfa').hide();
                    toastr.success("Asscher Emerald Oval Updated",'Success');
                }

                if(res.status == 400){
                   
                    $('#diamondcron2').prop('disabled',false);
                    $('#diamondcron2').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error');
                }
            },
            error: function (data) {
               
                $('#diamondcron2').prop('disabled',false);
                $('#diamondcron2').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error');
            }
        });
    });

    $('body').on('click', '#diamondcron3', function () {
        $('#diamondcron3').prop('disabled',true);
        $('#diamondcron3').find('.loadericonfa').show();
        
        $.ajax({
            type: 'get',
            url: "{{ url('admin/importnewdiamond2') }}",
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 200){
                    $('#diamondcron3').prop('disabled',false);
                    $('#diamondcron3').find('.loadericonfa').hide();
                    toastr.success("Radiant Marquise Princess Pear Updated",'Success');
                }

                if(res.status == 400){
                   
                    $('#diamondcron3').prop('disabled',false);
                    $('#diamondcron3').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error');
                }
            },
            error: function (data) {
               
                $('#diamondcron3').prop('disabled',false);
                $('#diamondcron3').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error');
            }
        });
    });

    $('body').on('click', '#diamondcron4', function () {
        $('#diamondcron4').prop('disabled',true);
        $('#diamondcron4').find('.loadericonfa').show();
        
        $.ajax({
            type: 'get',
            url: "{{ url('admin/importnewdiamond3') }}",
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 200){
                    $('#diamondcron4').prop('disabled',false);
                    $('#diamondcron4').find('.loadericonfa').hide();
                    toastr.success("Other Updated",'Success');
                }

                if(res.status == 400){
                   
                    $('#diamondcron4').prop('disabled',false);
                    $('#diamondcron4').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error');
                }
            },
            error: function (data) {
               
                $('#diamondcron4').prop('disabled',false);
                $('#diamondcron4').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error');
            }
        });
    });
</script>
<!-- settings JS end -->
@endsection
