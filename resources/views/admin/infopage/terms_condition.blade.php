@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Terms & Condition</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Terms & Condition
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="TermsConditionForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="terms_condition_contant">Terms & Condition Contant<span class="text-danger">*</span>
                                </label>
                                <textarea id="terms_condition_contant" name="terms_condition_contant"></textarea>
                                <div id="terms_condition_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                               <button type="button" class="btn btn-primary" id="saveTermsConditionBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        CKEDITOR.replace('terms_condition_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.config.height = '300';
        $.get("{{ url('admin/terms_condition/terms_condition/edit') }}", function (data) {
            CKEDITOR.instances['terms_condition_contant'].setData(data.terms_condition);
            $('#meta_title').val(data.terms_condition_meta_title);
            $('#meta_description').val(data.terms_condition_meta_description);
           //$('#terms_condition_contant').summernote('code', data.terms_condition);
        
        })
    });

    $('body').on('click', '#saveTermsConditionBtn', function () {
        $('#saveTermsConditionBtn').prop('disabled',true);
        $('#saveTermsConditionBtn').find('.loadericonfa').show();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData($("#TermsConditionForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateTermsCondition') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveTermsConditionBtn').prop('disabled',false);
                    $('#saveTermsConditionBtn').find('.loadericonfa').hide();
                    if (res.errors.terms_condition_contant) {
                        $('#terms_condition_contant-error').show().text(res.errors.terms_condition_contant);
                    } else {
                        $('#terms_condition_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveTermsConditionBtn').prop('disabled',false);
                    $('#saveTermsConditionBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.terms_condition_contant + " %");
                    toastr.success("Terms & Condition Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){ 
                    $('#saveTermsConditionBtn').prop('disabled',false);
                    $('#saveTermsConditionBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                
                $('#saveTermsConditionBtn').prop('disabled',false);
                $('#saveTermsConditionBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });


    
</script>
<!-- settings JS end -->
@endsection
