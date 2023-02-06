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
                                <textarea  id="lifetime_warranty_contant" name="lifetime_warranty_contant"></textarea>
                                <div id="lifetime_warranty_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
        CKEDITOR.replace('lifetime_warranty_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.config.height = '300';
        $.get("{{ url('admin/lifetime_warranty/lifetime_warranty/edit') }}", function (data) {
            CKEDITOR.instances['lifetime_warranty_contant'].setData(data.lifetime_warranty);
            $('#meta_title').val(data.lifetime_warranty_meta_title);
            $('#meta_description').val(data.lifetime_warranty_meta_description);
           //$('#lifetime_warranty_contant').summernote('code', data.lifetime_warranty);
        
        })
    });

    $('body').on('click', '#saveLifetimeWarrantyBtn', function () {
        $('#saveLifetimeWarrantyBtn').prop('disabled',true);
        $('#saveLifetimeWarrantyBtn').find('.loadericonfa').show();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
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
