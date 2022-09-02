<form class="form-valide" action="" id="StepFourCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <input type="hidden" name="step_id" value="{{ isset($step)?($step->id):'' }}">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 class="card-title">
                        Header Info        
                    </h4>
                </div>  
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_title" name="step4_title" value="{{ isset($step)?($step->step4_title):'' }}">
                        <div id="step4_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_shotline"> Shotline <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_shotline" name="step4_shotline" value="{{ isset($step)?($step->step4_shotline):'' }}">
                        <div id="step4_shotline-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
            
                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_icon">Step 4 Icon  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step4_icon" id="step4_icon">
                        <div id="step4_icon-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step4_icon))  {{ url('images/steps/'.$step->step4_icon) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step4_icon_show" height="250px" width="250px" style="margin-top: 5px">
                    </div>
                </div> -->
            
                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_header_image">Step 4 Header Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step4_header_image" id="step4_header_image">
                        <div id="step4_header_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step4_header_image))  {{ url('images/steps/'.$step->step4_header_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step4_header_image_show" height="250px" width="250px" style="margin-top: 5px">
                    </div>
                </div> -->
            
               
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 class="card-title">
                        First Section        
                    </h4>
                </div>  
               
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section1_title">Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section1_title" name="step4_section1_title" value="{{ isset($step)?($step->step4_section1_title):'' }}">
                        <div id="step4_section1_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section1_description">Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section1_description" name="step4_section1_description" class="form-control">{{ isset($step)?($step->step4_section1_description):'' }}</textarea>
                        <div id="step4_section1_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                    <h4 class="card-title">
                        Point 1        
                    </h4>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section2_image"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step4_section2_image" id="step4_section2_image">
                        <div id="step4_section2_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step4_section2_image))  {{ url('images/steps/'.$step->step4_section2_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step4_section2_image_show" height="250px" width="250px" style="margin-top: 5px">
                    </div>
                </div>
            

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section2_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section2_title" name="step4_section2_title" value="{{ isset($step)?($step->step4_section2_title):'' }}">
                        <div id="step4_section2_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section2_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section2_description" name="step4_section2_description" class="form-control">{{ isset($step)?($step->step4_section2_description):'' }}</textarea>
                        <div id="step4_section2_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

               

               

                

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                    <h4 class="card-title">
                        Point 2        
                    </h4>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section3_image"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step4_section3_image" id="step4_section3_image">
                        <div id="step4_section3_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step4_section3_image))  {{ url('images/steps/'.$step->step4_section3_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step4_section3_image_show" height="250px" width="250px" style="margin-top: 5px">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section3_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section3_title" name="step4_section3_title" value="{{ isset($step)?($step->step4_section3_title):'' }}">
                        <div id="step4_section3_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section3_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section3_description" name="step4_section3_description" class="form-control">{{ isset($step)?($step->step4_section3_description):'' }}</textarea>
                        <div id="step4_section3_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                
            
                


                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section4_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section4_title" name="step4_section4_title" value="{{ isset($step)?($step->step4_section4_title):'' }}">
                        <div id="step4_section4_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section4_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section4_description" name="step4_section4_description" class="form-control">{{ isset($step)?($step->step4_section4_description):'' }}</textarea>
                        <div id="step4_section4_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                    <h4 class="card-title">
                        Point 3        
                    </h4>
                </div>


                

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section5_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section5_title" name="step4_section5_title" value="{{ isset($step)?($step->step4_section5_title):'' }}">
                        <div id="step4_section5_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section5_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section5_description" name="step4_section5_description" class="form-control">{{ isset($step)?($step->step4_section5_description):'' }}</textarea>
                        <div id="step4_section5_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section5_image"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step4_section5_image" id="step4_section5_image">
                        <div id="step4_section5_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step4_section5_image))  {{ url('images/steps/'.$step->step4_section5_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step4_section5_image_show" height="250px" width="250px" style="margin-top: 5px">
                    </div>
                </div>
            

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section6_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section6_title" name="step4_section6_title" value="{{ isset($step)?($step->step4_section6_title):'' }}">
                        <div id="step4_section6_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section6_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section6_description" name="step4_section6_description" class="form-control">{{ isset($step)?($step->step4_section6_description):'' }}</textarea>
                        <div id="step4_section6_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
            
                

                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section7_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section7_title" name="step4_section7_title" value="{{ isset($step)?($step->step4_section7_title):'' }}">
                        <div id="step4_section7_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section7_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section7_description" name="step4_section7_description" class="form-control">{{ isset($step)?($step->step4_section7_description):'' }}</textarea>
                        <div id="step4_section7_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div> -->

                </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 class="card-title">
                        Second Section        
                    </h4>
                </div> 

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section8_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section8_title" name="step4_section8_title" value="{{ isset($step)?($step->step4_section8_title):'' }}">
                        <div id="step4_section8_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section8_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section8_description" name="step4_section8_description" class="form-control">{{ isset($step)?($step->step4_section8_description):'' }}</textarea>
                        <div id="step4_section8_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                    <h4 class="card-title">
                        Point 1        
                    </h4>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section9_image"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step4_section9_image" id="step4_section9_image">
                        <div id="step4_section9_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step4_section9_image))  {{ url('images/steps/'.$step->step4_section9_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step4_section9_image_show" height="250px" width="250px" style="margin-top: 5px">
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section9_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section9_title" name="step4_section9_title" value="{{ isset($step)?($step->step4_section9_title):'' }}">
                        <div id="step4_section9_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section9_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section9_description" name="step4_section9_description" class="form-control">{{ isset($step)?($step->step4_section9_description):'' }}</textarea>
                        <div id="step4_section9_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section10_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section10_title" name="step4_section10_title" value="{{ isset($step)?($step->step4_section9_title):'' }}">
                        <div id="step4_section10_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section10_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  class="summernote"  id="step4_section10_description" name="step4_section10_description" class="form-control">{{ isset($step)?($step->step4_section10_description):'' }}</textarea>
                        <div id="step4_section10_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                    <h4 class="card-title">
                        Point 2       
                    </h4>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section11_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section11_title" name="step4_section11_title" value="{{ isset($step)?($step->step4_section11_title):'' }}">
                        <div id="step4_section11_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section11_image1"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step4_section11_image1" id="step4_section11_image1">
                        <div id="step4_section11_image1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step4_section11_image1))  {{ url('images/steps/'.$step->step4_section11_image1) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step4_section11_image1_show" height="50px" width="50px" style="margin-top: 5px">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section11_title1"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section11_title1" name="step4_section11_title1" value="{{ isset($step)?($step->step4_section11_title1):'' }}">
                        <div id="step4_section11_title1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section11_image2"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step4_section11_image2" id="step4_section11_image2">
                        <div id="step4_section11_image2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step4_section11_image2))  {{ url('images/steps/'.$step->step4_section11_image2) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step4_section11_image2_show" height="50px" width="50px" style="margin-top: 5px">
                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 class="card-title">
                    Know More Section        
                    </h4>
                </div> 

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step4_section11_title2"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step4_section11_title2" name="step4_section11_title2" value="{{ isset($step)?($step->step4_section11_title2):'' }}">
                        <div id="step4_section11_title2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary mt-4" id="save_closeStepFourBtn" data-action="@if(isset($step->step4_title) && $step->step4_title != '') update @else add @endif">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
    </div>
</form>