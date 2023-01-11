@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Returns Days</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Returns Days
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="ReturnsDaysForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="returns_days_contant">Returns Days Contant<span class="text-danger">*</span>
                                </label>
                                <textarea  id="returns_days_contant" name="returns_days_contant"></textarea>
                                <div id="returns_days_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="saveReturnsDaysBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        CKEDITOR.replace('returns_days_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.config.height = '300';
        $.get("{{ url('admin/infopage/aboutus/edit') }}", function (data) {
            CKEDITOR.instances['returns_days_contant'].setData(data.return_days);
           //$('#returns_days_contant').summernote('code', data.return_days);
        
        })
    });

    $('body').on('click', '#saveReturnsDaysBtn', function () {
        $('#saveReturnsDaysBtn').prop('disabled',true);
        $('#saveReturnsDaysBtn').find('.loadericonfa').show();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData($("#ReturnsDaysForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateReturnDays') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveReturnsDaysBtn').prop('disabled',false);
                    $('#saveReturnsDaysBtn').find('.loadericonfa').hide();
                    if (res.errors.returns_days_contant) {
                        $('#returns_days_contant-error').show().text(res.errors.returns_days_contant);
                    } else {
                        $('#returns_days_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveReturnsDaysBtn').prop('disabled',false);
                    $('#saveReturnsDaysBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.returns_days_contant + " %");
                    toastr.success("Returns Days Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveReturnsDaysBtn').prop('disabled',false);
                    $('#saveReturnsDaysBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveReturnsDaysBtn').prop('disabled',false);
                $('#saveReturnsDaysBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
