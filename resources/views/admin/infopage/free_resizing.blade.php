@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Free Resizing</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Free Resizing
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="FreeResizingForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="free_resizing_contant">Free Resizing Contant<span class="text-danger">*</span>
                                </label>
                                <textarea  id="free_resizing_contant" name="free_resizing_contant"></textarea>
                                <div id="free_resizing_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                               <button type="button" class="btn btn-primary" id="saveFreeResizingBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        CKEDITOR.replace('free_resizing_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.config.height = '300';
        $.get("{{ url('admin/free_resizing/free_resizing/edit') }}", function (data) {
            CKEDITOR.instances['free_resizing_contant'].setData(data.free_resizing);
            $('#meta_title').val(data.free_resizing_meta_title);
            $('#meta_description').val(data.free_resizing_meta_description);
           //$('#free_resizing_contant').summernote('code', data.free_resizing);
        
        })
    });

    $('body').on('click', '#saveFreeResizingBtn', function () {
        $('#saveFreeResizingBtn').prop('disabled',true);
        $('#saveFreeResizingBtn').find('.loadericonfa').show();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData($("#FreeResizingForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateFreeResizing') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveFreeResizingBtn').prop('disabled',false);
                    $('#saveFreeResizingBtn').find('.loadericonfa').hide();
                    if (res.errors.free_resizing_contant) {
                        $('#free_resizing_contant-error').show().text(res.errors.free_resizing_contant);
                    } else {
                        $('#free_resizing_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveFreeResizingBtn').prop('disabled',false);
                    $('#saveFreeResizingBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.free_resizing_contant + " %");
                    toastr.success("Free Resizing Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveFreeResizingBtn').prop('disabled',false);
                    $('#saveFreeResizingBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveFreeResizingBtn').prop('disabled',false);
                $('#saveFreeResizingBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
