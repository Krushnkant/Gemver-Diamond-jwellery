@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Value</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Customer Value
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="CustomerValueForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="customer_value_contant">Customer Value Contant <span class="text-danger">*</span>
                                </label>
                                <textarea id="customer_value_contant" name="customer_value_contant"></textarea>
                                <div id="customer_value_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="saveCustomerValueBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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

        CKEDITOR.replace('customer_value_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.config.height = '300';

        $.get("{{ url('admin/infopage/aboutus/edit') }}", function (data) {
            CKEDITOR.instances['customer_value_contant'].setData(data.customer_value);
          // $('#customer_value_contant').summernote('code', data.customer_value);
        })
    });

    $('body').on('click', '#saveCustomerValueBtn', function () {
        $('#saveCustomerValueBtn').prop('disabled',true);
        $('#saveCustomerValueBtn').find('.loadericonfa').show();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData($("#CustomerValueForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateCustomerValue') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveCustomerValueBtn').prop('disabled',false);
                    $('#saveCustomerValueBtn').find('.loadericonfa').hide();
                    if (res.errors.customer_value_contant) {
                        $('#customer_value_contant-error').show().text(res.errors.customer_value_contant);
                    } else {
                        $('#customer_value_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveCustomerValueBtn').prop('disabled',false);
                    $('#saveCustomerValueBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.customer_value_contant + " %");
                    toastr.success("Customer Value Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveCustomerValueBtn').prop('disabled',false);
                    $('#saveCustomerValueBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveCustomerValueBtn').prop('disabled',false);
                $('#saveCustomerValueBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
