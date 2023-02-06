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
    <form class="form-valide" action="" id="AboutusForm" method="post">
    <div id="cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
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
                               <input type="file" class="form-control-file" id="first_section_image" name="first_section_image" placeholder="">
                              <div id="first_section-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                  <img src="{{ url('images/placeholder_image.png') }}" class="" id="first_section_image_show" height="200px" width="200px"   style="margin-top: 5px">
                              </div>
                            </div> 
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center"> 
                              <div class="form-group">
                                <label class="col-form-label" for="first_section_title">First Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="first_section_title" name="first_section_title" >
                                <div id="first_section_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                               </div>

                               <div class="form-group">
                                <label class="col-form-label" for="first_section_contant">First Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea  id="first_section_contant" name="first_section_contant"></textarea>
                                <div id="first_section_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                                <label class="col-form-label" for="second_section_title">Second Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="second_section_title" name="second_section_title" >
                                <div id="second_section_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="second_section_contant">Second Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea  id="second_section_contant" name="second_section_contant"></textarea>
                                <div id="second_section_contant-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             </div>
                           <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                            <div class="form-group">
                               <label class="col-form-label" for="Logo">Second Section Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="second_section_image" name="second_section_image" placeholder="">
                              <div id="second_section-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="second_section_image_show" height="200px" width="200px"  style="margin-top: 5px">
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
                      
                        <div class="col-lg-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  justify-content-center">
                           <div class="form-group row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <label class="col-form-label" for="">Title </label>
                                    <input type="text" class="form-control input-flat" id="title1" name="title1" placeholder="Enter Title">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <label class="col-form-label" for="">Title </label>
                                    <input type="text" class="form-control input-flat" id="title2" name="title2" placeholder="Enter Title">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     <label class="col-form-label" for="">Title </label>
                                    <input type="text" class="form-control input-flat" id="title3" name="title3" placeholder="Enter Title">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     <label class="col-form-label" for="">Title </label>
                                    <input type="text" class="form-control input-flat" id="title4" name="title4" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">  
                                    <label class="col-form-label" for="">Value </label>
                                    <input type="text" class="form-control input-flat" id="value1" placeholder="Enter Value" name="value1">
                                </div> 
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
                                    <label class="col-form-label" for="">Value </label> 
                                    <input type="text" class="form-control input-flat" id="value2" placeholder="Enter Value" name="value2">
                                </div> 
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">   
                                    <label class="col-form-label" for="">Value </label> 
                                    <input type="text" class="form-control input-flat" id="value3" placeholder="Enter Value" name="value3">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">  
                                    <label class="col-form-label" for="">Value </label>
                                    <input type="text" class="form-control input-flat" id="value4" placeholder="Enter Value" name="value4">
                                </div>
                            </div>
                            
                            <div id="title1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>

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
                            </div>

                           

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                               <!-- <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button> -->
                               <button type="button" class="btn btn-primary" id="saveAboutusBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                            </div>
                        </div>
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
    

        CKEDITOR.replace('second_section_contant',{
            toolbar_full: [
            { name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
            { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
            { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',
                'HiddenField' ] },
            '/',
            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
                '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
            { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
            '/',
            { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
            { name: 'colors', items : [ 'TextColor','BGColor' ] },
            { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
        ],
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('first_section_contant',{
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.config.height = '200';


        $.get("{{ url('admin/infopage/aboutus/edit') }}", function (data) {
            $('#first_section_title').val(data.first_section_title);
            $('#second_section_title').val(data.second_section_title);
            CKEDITOR.instances['first_section_contant'].setData(data.first_section_contant);
            CKEDITOR.instances['second_section_contant'].setData(data.second_section_contant);
           $('#title1').val(data.title1);
           $('#value1').val(data.value1);
           $('#title2').val(data.title2);
           $('#value2').val(data.value2);
           $('#title3').val(data.title3);
           $('#value3').val(data.value3);
           $('#title4').val(data.title4);
           $('#value4').val(data.value4);
           $('#meta_title').val(data.about_meta_title);
           $('#meta_description').val(data.about_meta_description);
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
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
            
        }
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
