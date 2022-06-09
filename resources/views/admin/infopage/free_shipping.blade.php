@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Free Shipping</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Free Shipping
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="FreeShippingForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="free_shipping_contant">Free Shipping Contant<span class="text-danger">*</span>
                                </label>
                                <textarea class="summernote" id="free_shipping_contant" name="free_shipping_contant"></textarea>
                                <div id="free_shipping_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="saveFreeShippingBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        $.get("{{ url('admin/free_shipping/free_shipping/edit') }}", function (data) {
           $('#free_shipping_contant').summernote('code', data.free_shipping);
        
        })
    });

    $('body').on('click', '#saveFreeShippingBtn', function () {
        $('#saveFreeShippingBtn').prop('disabled',true);
        $('#saveFreeShippingBtn').find('.loadericonfa').show();
        var formData = new FormData($("#FreeShippingForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateFreeShipping') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveFreeShippingBtn').prop('disabled',false);
                    $('#saveFreeShippingBtn').find('.loadericonfa').hide();
                    if (res.errors.free_shipping_contant) {
                        $('#free_shipping_contant-error').show().text(res.errors.free_shipping_contant);
                    } else {
                        $('#free_shipping_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveFreeShippingBtn').prop('disabled',false);
                    $('#saveFreeShippingBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.free_shipping_contant + " %");
                    toastr.success("Free Shipping Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveFreeShippingBtn').prop('disabled',false);
                    $('#saveFreeShippingBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveFreeShippingBtn').prop('disabled',false);
                $('#saveFreeShippingBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
