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
                                <textarea class="summernote" id="terms_condition_contant" name="terms_condition_contant"></textarea>
                                <div id="terms_condition_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
        $.get("{{ url('admin/terms_condition/terms_condition/edit') }}", function (data) {
           $('#terms_condition_contant').summernote('code', data.terms_condition);
        
        })
    });

    $('body').on('click', '#saveTermsConditionBtn', function () {
        $('#saveTermsConditionBtn').prop('disabled',true);
        $('#saveTermsConditionBtn').find('.loadericonfa').show();
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
