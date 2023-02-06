@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Free Engraving</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Free Engraving
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="FreeEngravingForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="free_engraving_contant">Free Engraving Contant<span class="text-danger">*</span>
                                </label>
                                <textarea  id="free_engraving_contant" name="free_engraving_contant"></textarea>
                                <div id="free_engraving_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                               <button type="button" class="btn btn-primary" id="saveFreeEngravingBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        CKEDITOR.replace('free_engraving_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.config.height = '300';

        $.get("{{ url('admin/free_engraving/free_engraving/edit') }}", function (data) {
            console.log(data);
            CKEDITOR.instances['free_engraving_contant'].setData(data.free_engraving);
            $('#meta_title').val(data.free_engraving_meta_title);
            $('#meta_description').val(data.free_engraving_meta_description);
           //$('#free_engraving_contant').summernote('code', data.free_engraving);
        })
    });

    $('body').on('click', '#saveFreeEngravingBtn', function () {
        $('#saveFreeEngravingBtn').prop('disabled',true);
        $('#saveFreeEngravingBtn').find('.loadericonfa').show();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData($("#FreeEngravingForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateFreeEngraving') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveFreeEngravingBtn').prop('disabled',false);
                    $('#saveFreeEngravingBtn').find('.loadericonfa').hide();
                    if (res.errors.free_engraving_contant) {
                        $('#free_engraving_contant-error').show().text(res.errors.free_engraving_contant);
                    } else {
                        $('#free_engraving_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveFreeEngravingBtn').prop('disabled',false);
                    $('#saveFreeEngravingBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.free_engraving_contant + " %");
                    toastr.success("Privacy Policy Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveFreeEngravingBtn').prop('disabled',false);
                    $('#saveFreeEngravingBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveFreeEngravingBtn').prop('disabled',false);
                $('#saveFreeEngravingBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
