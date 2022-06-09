@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Lifetime Upgrade</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Lifetime Upgrade
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="LifetimeUpgradeForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="lifetime_upgrade_contant">Lifetime Upgrade Contant<span class="text-danger">*</span>
                                </label>
                                <textarea class="summernote" id="lifetime_upgrade_contant" name="lifetime_upgrade_contant"></textarea>
                                <div id="lifetime_upgrade_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="saveLifetimeUpgradeBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        $.get("{{ url('admin/lifetime_upgrade/lifetime_upgrade/edit') }}", function (data) {
           $('#lifetime_upgrade_contant').summernote('code', data.lifetime_upgrade);
        
        })
    });

    $('body').on('click', '#saveLifetimeUpgradeBtn', function () {
        $('#saveLifetimeUpgradeBtn').prop('disabled',true);
        $('#saveLifetimeUpgradeBtn').find('.loadericonfa').show();
        var formData = new FormData($("#LifetimeUpgradeForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateLifetimeUpgrade') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveLifetimeUpgradeBtn').prop('disabled',false);
                    $('#saveLifetimeUpgradeBtn').find('.loadericonfa').hide();
                    if (res.errors.lifetime_upgrade_contant) {
                        $('#lifetime_upgrade_contant-error').show().text(res.errors.lifetime_upgrade_contant);
                    } else {
                        $('#lifetime_upgrade_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveLifetimeUpgradeBtn').prop('disabled',false);
                    $('#saveLifetimeUpgradeBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.lifetime_upgrade_contant + " %");
                    toastr.success("Lifetime Upgrade Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveLifetimeUpgradeBtn').prop('disabled',false);
                    $('#saveLifetimeUpgradeBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveLifetimeUpgradeBtn').prop('disabled',false);
                $('#saveLifetimeUpgradeBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
