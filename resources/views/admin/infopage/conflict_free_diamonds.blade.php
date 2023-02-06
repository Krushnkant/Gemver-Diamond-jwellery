@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Conflict Free Diamonds</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            Conflict Free Diamonds
                        </h4>--}}
                        <div class="col-lg-12">

                        <form class="form-valide" action="" id="ConflictFreeDiamondsForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="conflict_free_diamonds_contant">Conflict Free Diamonds Contant <span class="text-danger">*</span>
                                </label>
                                <textarea id="conflict_free_diamonds_contant" name="conflict_free_diamonds_contant"></textarea>
                                <div id="conflict_free_diamonds_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                               <button type="button" class="btn btn-primary mt-4" id="saveConflictFreeDiamondsBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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

        CKEDITOR.replace('conflict_free_diamonds_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.config.height = '300';

        $.get("{{ url('admin/infopage/aboutus/edit') }}", function (data) {
            CKEDITOR.instances['conflict_free_diamonds_contant'].setData(data.customer_value);
            $('#meta_title').val(data.conflict_free_diamonds_meta_title);
           $('#meta_description').val(data.conflict_free_diamonds_meta_description);
           //$('#conflict_free_diamonds_contant').summernote('code', data.conflict_free_diamonds);
        })
    });

    $('body').on('click', '#saveConflictFreeDiamondsBtn', function () {
        $('#saveConflictFreeDiamondsBtn').prop('disabled',true);
        $('#saveConflictFreeDiamondsBtn').find('.loadericonfa').show();
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData($("#ConflictFreeDiamondsForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateConflictFreeDiamonds') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveConflictFreeDiamondsBtn').prop('disabled',false);
                    $('#saveConflictFreeDiamondsBtn').find('.loadericonfa').hide();
                    if (res.errors.conflict_free_diamonds_contant) {
                        $('#conflict_free_diamonds_contant-error').show().text(res.errors.conflict_free_diamonds_contant);
                    } else {
                        $('#conflict_free_diamonds_contant-error').hide();
                    }
                }

                if(res.status == 200){
                    $('#saveConflictFreeDiamondsBtn').prop('disabled',false);
                    $('#saveConflictFreeDiamondsBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.conflict_free_diamonds_contant + " %");
                    toastr.success("Conflict Free Diamonds Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $('#saveConflictFreeDiamondsBtn').prop('disabled',false);
                    $('#saveConflictFreeDiamondsBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $('#saveConflictFreeDiamondsBtn').prop('disabled',false);
                $('#saveConflictFreeDiamondsBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });
 
</script>

@endsection
