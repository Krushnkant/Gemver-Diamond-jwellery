@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Payment Options</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Payment Options
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="PaymentOptionsForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="payment_options_contant">Payment Options Contant<span class="text-danger">*</span>
                                </label>
                                <textarea id="payment_options_contant" name="payment_options_contant"></textarea>
                                <div id="payment_options_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group ">
                                <label class="col-form-label" for="meta_title">Meta Title 
                                </label>
                                <input type="text" class="form-control input-flat" id="meta_title" name="meta_title">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="meta_description">Meta Description 
                                </label>
                                <textarea type="text" class="form-control input-default" id="meta_description" name="meta_description"></textarea>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="savePaymentOptionsBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                            </div>
                        </form>


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
    $( document ).ready(function() {
        CKEDITOR.replace('payment_options_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.config.height = '300';
        $.get("{{ url('admin/payment_options/payment_options/edit') }}", function (data) {
            CKEDITOR.instances['payment_options_contant'].setData(data.payment_options);
            $('#meta_title').val(data.payment_options_meta_title);
            $('#meta_description').val(data.payment_options_meta_description);
           //$('#payment_options_contant').summernote('code', data.payment_options);
        
        })
    });

    $('body').on('click', '#savePaymentOptionsBtn', function () {
        $('#savePaymentOptionsBtn').prop('disabled',true);
        $('#savePaymentOptionsBtn').find('.loadericonfa').show();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData($("#PaymentOptionsForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updatePaymentOptions') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#savePaymentOptionsBtn').prop('disabled',false);
                    $('#savePaymentOptionsBtn').find('.loadericonfa').hide();
                    if (res.errors.payment_options_contant) {
                        $('#payment_options_contant-error').show().text(res.errors.payment_options_contant);
                    } else {
                        $('#payment_options_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#savePaymentOptionsBtn').prop('disabled',false);
                    $('#savePaymentOptionsBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.payment_options_contant + " %");
                    toastr.success("Payment Options Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#savePaymentOptionsBtn').prop('disabled',false);
                    $('#savePaymentOptionsBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#savePaymentOptionsBtn').prop('disabled',false);
                $('#savePaymentOptionsBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
