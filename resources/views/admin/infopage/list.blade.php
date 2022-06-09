@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">About Us</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            About Us
                        </h4>--}}
                        <div class="col-lg-12">


                        <form class="form-valide" action="" id="AboutusForm" method="post">
                            <div id="cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                               <label class="col-form-label" for="Logo">First Section Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="first_section_image" name="first_section_image" placeholder="">
                              <div id="first_section-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                  <img src="{{ url('images/placeholder_image.png') }}" class="" id="first_section_image_show" height="50px" width="50px" style="margin-top: 5px">
                              </div>
                              
                              <div class="form-group">
                                <label class="col-form-label" for="first_section_title">First Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="first_section_title" name="first_section_title" >
                                <div id="first_section_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>

                             <div class="form-group">
                                <label class="col-form-label" for="first_section_contant">First Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="summernote" id="first_section_contant" name="first_section_contant"></textarea>
                                <div id="first_section_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>

                             <div class="form-group">
                               <label class="col-form-label" for="Logo">Second Section Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="second_section_image" name="second_section_image" placeholder="">
                              <div id="second_section-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                  <img src="{{ url('images/placeholder_image.png') }}" class="" id="second_section_image_show" height="50px" width="50px" style="margin-top: 5px">
                              </div>

                              <div class="form-group">
                                <label class="col-form-label" for="second_section_title">Second Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="second_section_title" name="second_section_title" >
                                <div id="second_section_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             <div class="form-group">
                                <label class="col-form-label" for="second_section_contant">Second Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="summernote" id="second_section_contant" name="second_section_contant"></textarea>
                                <div id="second_section_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <input type="text" class="form-control input-flat" id="title1" name="title1" placeholder="Enter Title">
                                </div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">   
                                    <input type="text" class="form-control input-flat" id="value1" placeholder="Enter Value" name="value1">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <input type="text" class="form-control input-flat" id="title2" name="title2" placeholder="Enter Title">
                                </div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">   
                                    <input type="text" class="form-control input-flat" id="value2" placeholder="Enter Value" name="value2">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <input type="text" class="form-control input-flat" id="title3" name="title3" placeholder="Enter Title">
                                </div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">   
                                    <input type="text" class="form-control input-flat" id="value3" placeholder="Enter Value" name="value3">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <input type="text" class="form-control input-flat" id="title4" name="title4" placeholder="Enter Title">
                                </div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">   
                                    <input type="text" class="form-control input-flat" id="value4" placeholder="Enter Value" name="value4">
                                </div> 
                            </div>
                            <div id="title1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="saveAboutusBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        $.get("{{ url('admin/infopage/aboutus/edit') }}", function (data) {
            $('#first_section_title').val(data.first_section_title);
            $('#second_section_title').val(data.second_section_title);
           $('#first_section_contant').summernote('code', data.first_section_contant);
           $('#second_section_contant').summernote('code', data.second_section_contant);
           $('#title1').val(data.title1);
           $('#value1').val(data.value1);
           $('#title2').val(data.title2);
           $('#value2').val(data.value2);
           $('#title3').val(data.title3);
           $('#value3').val(data.value3);
           $('#title4').val(data.title4);
           $('#value4').val(data.value4);
            if(data.first_section_image==null){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#first_section_image_show').attr('src', default_image);
            }
            else{
                var first_section_image = "{{ url('images/aboutus') }}" +"/" + data.first_section_image;
                $('#first_section_image_show').attr('src', first_section_image);
            }

            if(data.second_section_image==null){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#second_section_image_show').attr('src', default_image);
            }
            else{
                var second_section_image = "{{ url('images/aboutus') }}" +"/" + data.second_section_image;
                $('#second_section_image_show').attr('src', second_section_image);
            }
        })
    });

    $('body').on('click', '#saveAboutusBtn', function () {
        $('#saveAboutusBtn').prop('disabled',true);
        $('#saveAboutusBtn').find('.loadericonfa').show();
        var formData = new FormData($("#AboutusForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateAboutus') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveAboutusBtn').prop('disabled',false);
                    $('#saveAboutusBtn').find('.loadericonfa').hide();
                    if (res.errors.first_section_title) {
                        $('#first_section_title-error').show().text(res.errors.first_section_title);
                    } else {
                        $('#first_section_title-error').hide();
                    }

                    if (res.errors.second_section_title) {
                        $('#second_section_title-error').show().text(res.errors.second_section_title);
                    } else {
                        $('#second_section_title-error').hide();
                    }

                    if (res.errors.first_section_contant) {
                        $('#first_section_contant-error').show().text(res.errors.first_section_contant);
                    } else {
                        $('#first_section_contant-error').hide();
                    }

                    if (res.errors.second_section_contant) {
                        $('#second_section_contant-error').show().text(res.errors.second_section_contant);
                    } else {
                        $('#second_section_contant-error').hide();
                    }

                    if (res.errors.first_section_image) {
                        $('#first_section-error').show().text(res.errors.first_section_image);
                    } else {
                        $('#first_section-error').hide();
                    }

                    if (res.errors.second_section_image) {
                        $('#second_section-error').show().text(res.errors.second_section_image);
                    } else {
                        $('#second_section-error').hide();
                    }

                   
                }

                if(res.status == 200){
                    $("#UserAboutModal").modal('hide');
                    $('#saveAboutusBtn').prop('disabled',false);
                    $('#saveAboutusBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.aboutus_contant + " %");
                    toastr.success("About Us Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#UserAboutModal").modal('hide');
                    $('#saveAboutusBtn').prop('disabled',false);
                    $('#saveAboutusBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#UserAboutModal").modal('hide');
                $('#saveAboutusBtn').prop('disabled',false);
                $('#saveAboutusBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });


    $('#first_section_image').change(function(){
        
        $('#first_section_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#first_section_image-error').show().text("Please provide a Valid Extension First Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#first_section_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#first_section_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#second_section_image').change(function(){
        
        $('#second_section_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#second_section_image-error').show().text("Please provide a Valid Extension Second Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#second_section_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#second_section_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    
</script>
<!-- settings JS end -->
@endsection
