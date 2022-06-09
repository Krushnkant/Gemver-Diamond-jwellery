@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Lifetime Warranty</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Lifetime Warranty
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="LifetimeWarrantyForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="lifetime_warranty_contant">Lifetime Warranty Contant<span class="text-danger">*</span>
                                </label>
                                <textarea class="summernote" id="lifetime_warranty_contant" name="lifetime_warranty_contant"></textarea>
                                <div id="lifetime_warranty_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="saveLifetimeWarrantyBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        $.get("{{ url('admin/lifetime_warranty/lifetime_warranty/edit') }}", function (data) {
           $('#lifetime_warranty_contant').summernote('code', data.lifetime_warranty);
        
        })
    });

    $('body').on('click', '#saveLifetimeWarrantyBtn', function () {
        $('#saveLifetimeWarrantyBtn').prop('disabled',true);
        $('#saveLifetimeWarrantyBtn').find('.loadericonfa').show();
        var formData = new FormData($("#LifetimeWarrantyForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateLifetimeWarranty') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveLifetimeWarrantyBtn').prop('disabled',false);
                    $('#saveLifetimeWarrantyBtn').find('.loadericonfa').hide();
                    if (res.errors.lifetime_warranty_contant) {
                        $('#lifetime_warranty_contant-error').show().text(res.errors.lifetime_warranty_contant);
                    } else {
                        $('#lifetime_warranty_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveLifetimeWarrantyBtn').prop('disabled',false);
                    $('#saveLifetimeWarrantyBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.lifetime_warranty_contant + " %");
                    toastr.success("Lifetime Warranty Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveLifetimeWarrantyBtn').prop('disabled',false);
                    $('#saveLifetimeWarrantyBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveLifetimeWarrantyBtn').prop('disabled',false);
                $('#saveLifetimeWarrantyBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
