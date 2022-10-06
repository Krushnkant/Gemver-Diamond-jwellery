@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Gemver Difference</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <form class="form-valide" action="" id="GemverDifferenceForm" method="post">
    <div id="cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
   
   

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      
                        <div class="row col-lg-12">
                           
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section1_title"> Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section1_title" name="section1_title" >
                                <div id="section1_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="section1_description"> Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section1_description" name="section1_description"></textarea>
                                <div id="section1_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                            </div>
                            <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                   <label class="col-form-label" for="section1_image"> Image <span class="text-danger">*</span>
                                   </label>
                                   <input type="file" class="form-control-file" id="section1_image" name="section1_image" placeholder="">
                                  <div id="section1_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section1_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                  </div>
                               </div>
                            </div>
                           
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      
                        <div class="row col-lg-12">
                        <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                            <div class="form-group">
                               <label class="col-form-label" for="Logo"> Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="section2_image" name="section2_image" placeholder="">
                              <div id="section2_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="section2_image_show" height="100px" width="100px"  style="margin-top: 5px">
                              </div>
                           </div>
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section2_title"> Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section2_title" name="section2_title" >
                                <div id="section2_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="section2_description"> Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section2_description" name="section2_description"></textarea>
                                <div id="section2_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      
                        <div class="row col-lg-12">
                       
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section3_title"> Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section3_title" name="section3_title" >
                                <div id="section3_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="section3_description"> Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section3_description" name="section3_description"></textarea>
                                <div id="section3_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                            </div>

                            <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                   <label class="col-form-label" for="Logo"> Image <span class="text-danger">*</span>
                                   </label>
                                   <input type="file" class="form-control-file" id="section3_image" name="section3_image" placeholder="">
                                  <div id="section3_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section3_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                  </div>
                               </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row col-lg-12">
                            <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                                <div class="form-group">
                                   <label class="col-form-label" for="Logo">Section Image <span class="text-danger">*</span>
                                   </label>
                                   <input type="file" class="form-control-file" id="section4_image" name="section4_image" placeholder="">
                                  <div id="section4_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="section4_image_show" height="100px" width="100px"  style="margin-top: 5px">
                                  </div>
                               </div>
                               
                           
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section4_title">Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section4_title" name="section4_title" >
                                <div id="section4_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="section4_description">Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section4_description" name="section4_description"></textarea>
                                <div id="section4_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                        </div>

                        
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                        <button type="button" class="btn btn-primary" id="saveGenverDifference">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('js')
<!-- settings JS start -->
<script type="text/javascript">
    $( document ).ready(function() {
        $.get("{{ url('admin/infopage/gemver_difference/edit') }}", function (data) {

           $('#section1_title').val(data.section1_title);
           $('#section1_description').val(data.section1_description);
           $('#section2_title').val(data.section2_title);
           $('#section2_description').val(data.section2_description);
           $('#section3_title').val(data.section3_title);
           $('#section3_description').val(data.section3_description);
           $('#section4_title').val(data.section4_title);
           $('#section4_description').val(data.section4_description);

           if(data.section1_image!=null){
                var section1_image = "{{ url('images/aboutus') }}" +"/" + data.section1_image;
                $('#section1_image_show').attr('src', section1_image);
            }
          
            if(data.section2_image!=null){
                var section2_image = "{{ url('images/aboutus') }}" +"/" + data.section2_image;
                $('#section2_image_show').attr('src', section2_image);
            }

            if(data.section3_image!=null){
                var section3_image = "{{ url('images/aboutus') }}" +"/" + data.section3_image;
                $('#section3_image_show').attr('src', section3_image);
            }

            if(data.section4_image!=null){
                var section4_image = "{{ url('images/aboutus') }}" +"/" + data.section4_image;
                $('#section4_image_show').attr('src', section4_image);
            }

        })
    });

    $('body').on('click', '#saveGenverDifference', function () {
        $('#saveGenverDifference').prop('disabled',true);
        $('#saveGenverDifference').find('.loadericonfa').show();
        var formData = new FormData($("#GemverDifferenceForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateGemverDifference') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveGenverDifference').prop('disabled',false);
                    $('#saveGenverDifference').find('.loadericonfa').hide();
                   
                    if (res.errors.section1_title) {
                        $('#section1_title-error').show().text(res.errors.section1_title);
                    } else {
                        $('#section1_title-error').hide();
                    }

                    if (res.errors.section1_description) {
                        $('#section1_description-error').show().text(res.errors.section1_description);
                    } else {
                        $('#section1_description-error').hide();
                    }

                    if (res.errors.section1_image) {
                        $('#section1_image-error').show().text(res.errors.section1_image);
                    } else {
                        $('#section1_image-error').hide();
                    }

                    if (res.errors.section2_title) {
                        $('#section2_title-error').show().text(res.errors.section2_title);
                    } else {
                        $('#section2_title-error').hide();
                    }

                    if (res.errors.section2_description) {
                        $('#section2_description-error').show().text(res.errors.section2_description);
                    } else {
                        $('#section2_description-error').hide();
                    }

                    if (res.errors.section2_image) {
                        $('#section2_image-error').show().text(res.errors.section2_image);
                    } else {
                        $('#section2_image-error').hide();
                    }

                    if (res.errors.section3_title) {
                        $('#section3_title-error').show().text(res.errors.section3_title);
                    } else {
                        $('#section3_title-error').hide();
                    }

                    if (res.errors.section3_description) {
                        $('#section3_description-error').show().text(res.errors.section3_description);
                    } else {
                        $('#section3_description-error').hide();
                    }

                    if (res.errors.section3_image) {
                        $('#section3_image-error').show().text(res.errors.section3_image);
                    } else {
                        $('#section3_image-error').hide();
                    }

                    if (res.errors.section4_title) {
                        $('#section4_title-error').show().text(res.errors.section4_title);
                    } else {
                        $('#section4_title-error').hide();
                    }

                    if (res.errors.section4_description) {
                        $('#section4_description-error').show().text(res.errors.section4_description);
                    } else {
                        $('#section4_description-error').hide();
                    }

                    if (res.errors.section4_image) {
                        $('#section4_image-error').show().text(res.errors.section4_image);
                    } else {
                        $('#section4_image-error').hide();
                    } 
                }

                if(res.status == 200){
                    
                    $('#saveGenverDifference').prop('disabled',false);
                    $('#saveGenverDifference').find('.loadericonfa').hide();
                 
                    toastr.success("Genver Difference Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                   
                    $('#saveGenverDifference').prop('disabled',false);
                    $('#saveGenverDifference').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
             
                $('#saveGenverDifference').prop('disabled',false);
                $('#saveGenverDifference').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });


    $('#section1_image').change(function(){
        $('#section1_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section1_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section1_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section1_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });


    

    $('#section2_image').change(function(){
        
        $('#section2_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section2_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section2_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section2_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });


    $('#section3_image').change(function(){
        
        $('#section3_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section3_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section3_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section3_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section4_image').change(function(){
        
        $('#section4_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/svg+xml"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section4_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png .svg)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section4_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section4_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section5_image').change(function(){
        
        $('#section5_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section5_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section5_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section5_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section6_image').change(function(){
        
        $('#section6_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section6_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section6_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section6_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section7_image').change(function(){
        
        $('#section7_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section7_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section7_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section7_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#section8_image').change(function(){
        
        $('#section8_image-error').hide();
        var file = this.files[0];
      
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#section8_image-error').show().text("Please provide a Valid Extension Section Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#section8_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#section8_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    
</script>
<!-- settings JS end -->
@endsection
