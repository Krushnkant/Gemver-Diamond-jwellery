@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Learn About Lab Made Diamonds</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Learn About Lab Made Diamonds
                        </h4>--}}
                        <div class="col-lg-12">
                          <form class="form-valide" action="" id="LearnAboutLabMadeDiamondsForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-form-label" for="learn_about_lab_made_diamonds_contant">Learn About Lab Made Diamonds Contant <span class="text-danger">*</span>
                                </label>
                                <textarea  id="learn_about_lab_made_diamonds_contant" name="learn_about_lab_made_diamonds_contant"></textarea>
                                <div id="learn_about_lab_made_diamonds_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="saveLearnAboutLabMadeDiamondsBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        CKEDITOR.replace('learn_about_lab_made_diamonds_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.config.height = '300';
        $.get("{{ url('admin/infopage/aboutus/edit') }}", function (data) {
            CKEDITOR.instances['learn_about_lab_made_diamonds_contant'].setData(data.learn_about_lab_made_diamonds);
           //$('#learn_about_lab_made_diamonds_contant').summernote('code', data.learn_about_lab_made_diamonds);
        })
    });

    $('body').on('click', '#saveLearnAboutLabMadeDiamondsBtn', function () {
        $('#saveLearnAboutLabMadeDiamondsBtn').prop('disabled',true);
        $('#saveLearnAboutLabMadeDiamondsBtn').find('.loadericonfa').show();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData($("#LearnAboutLabMadeDiamondsForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateLearnAboutLabMadeDiamonds') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveLearnAboutLabMadeDiamondsBtn').prop('disabled',false);
                    $('#saveLearnAboutLabMadeDiamondsBtn').find('.loadericonfa').hide();
                    if (res.errors.learn_about_lab_made_diamonds_contant) {
                        $('#learn_about_lab_made_diamonds_contant-error').show().text(res.errors.learn_about_lab_made_diamonds_contant);
                    } else {
                        $('#learn_about_lab_made_diamonds_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveLearnAboutLabMadeDiamondsBtn').prop('disabled',false);
                    $('#saveLearnAboutLabMadeDiamondsBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.learn_about_lab_made_diamonds_contant + " %");
                    toastr.success("Learn About Lab Made Diamonds Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveLearnAboutLabMadeDiamondsBtn').prop('disabled',false);
                    $('#saveLearnAboutLabMadeDiamondsBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveLearnAboutLabMadeDiamondsBtn').prop('disabled',false);
                $('#saveLearnAboutLabMadeDiamondsBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
