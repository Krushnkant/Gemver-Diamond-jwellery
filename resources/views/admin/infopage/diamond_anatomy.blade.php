@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Diamond Anatomy</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <form class="form-valide" action="" id="DiamondAnatomyForm" method="post">
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
                               <label class="col-form-label" for="Logo">Header Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="header_image" name="header_image" placeholder="">
                              <div id="header_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                  <img src="{{ url('images/placeholder_image.png') }}" class="" id="header_image_show" height="100px" width="100px"   style="margin-top: 5px">
                              </div>
                            </div> 
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center"> 
                              <div class="form-group">
                                <label class="col-form-label" for="header_title">Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="header_title" name="header_title" >
                                <div id="header_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                               </div>

                               <div class="form-group">
                                <label class="col-form-label" for="header_shotline">Shotline <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="header_shotline" name="header_shotline"></textarea>
                                <div id="header_shotline-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                                <label class="col-form-label" for="section1_title">Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section1_title" name="section1_title" >
                                <div id="section1_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="section1_description">Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section1_description" name="section1_description"></textarea>
                                <div id="section1_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                               <label class="col-form-label" for="section2_image">Section Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="section2_image" name="section2_image" placeholder="">
                              <div id="section2_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="section2_image_show" height="100px" width="100px"  style="margin-top: 5px">
                              </div>
                           </div>
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section2_title">Second Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section2_title" name="section2_title" >
                                <div id="section2_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="section2_description">Second Section Contant <span class="text-danger">*</span>
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
                        <div class="col-lg-3 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                            <div class="form-group">
                               <label class="col-form-label" for="Logo">Section Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="section3_image" name="section3_image" placeholder="">
                              <div id="section3_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="section3_image_show" height="100px" width="100px"  style="margin-top: 5px">
                              </div>
                           </div>
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section3_title">Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section3_title" name="section3_title" >
                                <div id="section3_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="section3_description">Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section3_description" name="section3_description"></textarea>
                                <div id="section3_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                               <label class="col-form-label" for="section5_image">Section Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="section5_image" name="section5_image" placeholder="">
                              <div id="section5_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="section5_image_show" height="100px" width="100px"  style="margin-top: 5px">
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
                               <label class="col-form-label" for="section6_image">Second Section Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="section6_image" name="section6_image" placeholder="">
                              <div id="section6_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="section6_image_show" height="100px" width="100px"  style="margin-top: 5px">
                              </div>
                           </div>
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section6_title">Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section6_title" name="section6_title" >
                                <div id="section6_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="section6_description">Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section6_description" name="section6_description"></textarea>
                                <div id="section6_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                               <label class="col-form-label" for="section7_image">Second Section Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="section7_image" name="section7_image" placeholder="">
                              <div id="section7_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="section7_image_show" height="100px" width="100px"  style="margin-top: 5px">
                              </div>
                           

                           <div class="form-group">
                               <label class="col-form-label" for="section7_image2">Second Section Image 2<span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="section7_image2" name="section7_image2" >
                              <div id="section7_image2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="section7_image2_show" height="100px" width="100px"  style="margin-top: 5px">
                              </div>
                           </div>


                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section7_title">Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section7_title" name="section7_title" >
                                <div id="section7_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                             </div>
                             
                             <div class="form-group">
                                <label class="col-form-label" for="section7_description">Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section7_description" name="section7_description"></textarea>
                                <div id="section7_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                               <label class="col-form-label" for="section8_image">Section Image <span class="text-danger">*</span>
                               </label>
                               <input type="file" class="form-control-file" id="section8_image" name="section8_image" placeholder="">
                              <div id="section8_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                <img src="{{ url('images/placeholder_image.png') }}" class="" id="section8_image_show" height="100px" width="100px"  style="margin-top: 5px">
                              </div>
                           </div>

                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
                              <div class="form-group">
                                <label class="col-form-label" for="section8_title">Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section8_title" name="section8_title" >
                                <div id="section8_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                             
                            <div class="form-group">
                                <label class="col-form-label" for="section8_description">Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section8_description" name="section8_description"></textarea>
                                <div id="section8_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                                <label class="col-form-label" for="section9_title">Section Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control input-flat" id="section9_title" name="section9_title" >
                                <div id="section9_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="section9_description">Section Contant <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="section9_description" name="section9_description"></textarea>
                                <div id="section9_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                        </div>

                        
                           
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
                        <button type="button" class="btn btn-primary" id="saveDiamondAnatomyBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
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
        $.get("{{ url('admin/infopage/diamond_anatomies/edit') }}", function (data) {
           $('#header_title').val(data.header_title);
           $('#header_shotline').val(data.header_shotline);
           $('#section1_title').val(data.section1_title);
           $('#section1_description').val(data.section1_description);
           $('#section2_title').val(data.section2_title);
           $('#section2_description').val(data.section2_description);
           $('#section3_title').val(data.section3_title);
           $('#section3_description').val(data.section3_description);
           $('#section4_title').val(data.section4_title);
           $('#section4_description').val(data.section4_description);
           $('#section6_title').val(data.section6_title);
           $('#section6_description').val(data.section6_description);
           $('#section7_title').val(data.section7_title);
           $('#section7_description').val(data.section7_description);
           $('#section8_title').val(data.section8_title);
           $('#section8_description').val(data.section8_description);
           $('#section9_title').val(data.section9_title);
           $('#section9_description').val(data.section9_description);
           $('#meta_title').val(data.meta_title);
           $('#meta_description').val(data.meta_description);
            if(data.header_image!=null){
                var header_image = "{{ url('images/aboutus') }}" +"/" + data.header_image;
                $('#header_image_show').attr('src', header_image);
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

            if(data.section5_image!=null){
                var section5_image = "{{ url('images/aboutus') }}" +"/" + data.section5_image;
                $('#section5_image_show').attr('src', section5_image);
            }

            if(data.section6_image!=null){
                var section6_image = "{{ url('images/aboutus') }}" +"/" + data.section6_image;
                $('#section6_image_show').attr('src', section6_image);
            }

            if(data.section7_image!=null){
                var section7_image = "{{ url('images/aboutus') }}" +"/" + data.section7_image;
                $('#section7_image_show').attr('src', section7_image);
            }

            if(data.section7_image2!=null){
                var section7_image2 = "{{ url('images/aboutus') }}" +"/" + data.section7_image2;
                $('#section7_image2_show').attr('src', section7_image2);
            }

            if(data.section8_image!=null){
                var section8_image = "{{ url('images/aboutus') }}" +"/" + data.section8_image;
                $('#section8_image_show').attr('src', section8_image);
            }
        })
    });

    $('body').on('click', '#saveDiamondAnatomyBtn', function () {
        $('#saveDiamondAnatomyBtn').prop('disabled',true);
        $('#saveDiamondAnatomyBtn').find('.loadericonfa').show();
        var formData = new FormData($("#DiamondAnatomyForm")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateDiamondAnatomy') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveDiamondAnatomyBtn').prop('disabled',false);
                    $('#saveDiamondAnatomyBtn').find('.loadericonfa').hide();
                    if (res.errors.header_title) {
                        $('#header_title-error').show().text(res.errors.header_title);
                    } else {
                        $('#header_title-error').hide();
                    }

                    if (res.errors.header_shotline) {
                        $('#header_shotline-error').show().text(res.errors.header_shotline);
                    } else {
                        $('#header_shotline-error').hide();
                    }

                    if (res.errors.header_image) {
                        $('#header_image-error').show().text(res.errors.header_image);
                    } else {
                        $('#header_image-error').hide();
                    }

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

                    if (res.errors.section5_image) {
                        $('#section5_image-error').show().text(res.errors.section5_image);
                    } else {
                        $('#section5_image-error').hide();
                    }

                    if (res.errors.section6_title) {
                        $('#section6_title-error').show().text(res.errors.section6_title);
                    } else {
                        $('#section6_title-error').hide();
                    }

                    if (res.errors.section6_description) {
                        $('#section6_description-error').show().text(res.errors.section6_description);
                    } else {
                        $('#section6_description-error').hide();
                    }

                    if (res.errors.section6_image) {
                        $('#section6_image-error').show().text(res.errors.section6_image);
                    } else {
                        $('#section6_image-error').hide();
                    }

                    if (res.errors.section7_title) {
                        $('#section7_title-error').show().text(res.errors.section7_title);
                    } else {
                        $('#section7_title-error').hide();
                    }

                    if (res.errors.section7_description) {
                        $('#section7_description-error').show().text(res.errors.section7_description);
                    } else {
                        $('#section7_description-error').hide();
                    }

                    if (res.errors.section7_image) {
                        $('#section7_image-error').show().text(res.errors.section7_image);
                    } else {
                        $('#section7_image-error').hide();
                    }

                    if (res.errors.section7_image2) {
                        $('#section7_image2-error').show().text(res.errors.section7_image2);
                    } else {
                        $('#section7_image2-error').hide();
                    }

                    if (res.errors.section8_title) {
                        $('#section8_title-error').show().text(res.errors.section8_title);
                    } else {
                        $('#section8_title-error').hide();
                    }

                    if (res.errors.section8_description) {
                        $('#section8_description-error').show().text(res.errors.section8_description);
                    } else {
                        $('#section8_description-error').hide();
                    }

                    if (res.errors.section8_image) {
                        $('#section8_image-error').show().text(res.errors.section8_image);
                    } else {
                        $('#section8_image-error').hide();
                    }

                    if (res.errors.section9_title) {
                        $('#section9_title-error').show().text(res.errors.section9_title);
                    } else {
                        $('#section9_title-error').hide();
                    }

                    if (res.errors.section9_description) {
                        $('#section9_description-error').show().text(res.errors.section9_description);
                    } else {
                        $('#section9_description-error').hide();
                    }

                   
                }

                if(res.status == 200){
                    $("#UserAboutModal").modal('hide');
                    $('#saveDiamondAnatomyBtn').prop('disabled',false);
                    $('#saveDiamondAnatomyBtn').find('.loadericonfa').hide();
                    $("#UserDiscountPerVal").html(res.aboutus_contant + " %");
                    toastr.success("Diamond Anatomy Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#UserAboutModal").modal('hide');
                    $('#saveDiamondAnatomyBtn').prop('disabled',false);
                    $('#saveDiamondAnatomyBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#UserAboutModal").modal('hide');
                $('#saveDiamondAnatomyBtn').prop('disabled',false);
                $('#saveDiamondAnatomyBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });


    $('#header_image').change(function(){
        
        $('#header_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#header_image-error').show().text("Please provide a Valid Extension Header Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#header_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#header_image_show').attr('src', e.target.result);
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
