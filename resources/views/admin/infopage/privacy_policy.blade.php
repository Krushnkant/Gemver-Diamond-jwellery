@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Privacy Policy</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Privacy Policy
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="PrivacyPolicyForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="privacy_policy_contant">Privacy Policy Contant<span class="text-danger">*</span>
                                </label>
                                <textarea class="summernote" id="privacy_policy_contant" name="privacy_policy_contant"></textarea>
                                <div id="privacy_policy_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="savePrivacyPolicyBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        $.get("{{ url('admin/privacy_policy/privacy_policy/edit') }}", function (data) {
           $('#privacy_policy_contant').summernote('code', data.privacy_policy);
        
        })
    });

    $('body').on('click', '#savePrivacyPolicyBtn', function () {
        $('#savePrivacyPolicyBtn').prop('disabled',true);
        $('#savePrivacyPolicyBtn').find('.loadericonfa').show();
        var formData = new FormData($("#PrivacyPolicyForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updatePrivacyPolicy') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#savePrivacyPolicyBtn').prop('disabled',false);
                    $('#savePrivacyPolicyBtn').find('.loadericonfa').hide();
                    if (res.errors.privacy_policy_contant) {
                        $('#privacy_policy_contant-error').show().text(res.errors.privacy_policy_contant);
                    } else {
                        $('#privacy_policy_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#savePrivacyPolicyBtn').prop('disabled',false);
                    $('#savePrivacyPolicyBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.privacy_policy_contant + " %");
                    toastr.success("Privacy Policy Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#savePrivacyPolicyBtn').prop('disabled',false);
                    $('#savePrivacyPolicyBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#savePrivacyPolicyBtn').prop('disabled',false);
                $('#savePrivacyPolicyBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
