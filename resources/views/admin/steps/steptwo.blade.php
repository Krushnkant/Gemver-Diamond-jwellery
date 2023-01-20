<form class="form-valide" action="" id="StepTwoCreateForm" method="post" enctype="multipart/form-data">

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
                        <label class="col-form-label" for="step2_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step2_title" name="step2_title" value="{{ isset($step)?($step->step2_title):'' }}">
                        <div id="step2_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_shotline"> Shotline <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step2_shotline" name="step2_shotline" value="{{ isset($step)?($step->step2_shotline):'' }}">
                        <div id="step2_shotline-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_icon">Step 2 Icon  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step2_icon" id="step2_icon">
                        <div id="step2_icon-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step2_icon))  {{ url('images/steps/'.$step->step2_icon) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step2_icon_show" height="250px" width="250px" style="margin-top: 5px">
                    </div>
                </div> -->

                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_header_image">Step 2 Header Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step2_header_image" id="step2_header_image">
                        <div id="step2_header_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step2_header_image))  {{ url('images/steps/'.$step->step2_header_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step2_header_image_show" height="250px" width="250px" style="margin-top: 5px">
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
                      Point 1        
                    </h4>
                </div>    

               

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section1_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step2_section1_title" name="step2_section1_title" value="{{ isset($step)?($step->step2_section1_title):'' }}">
                        <div id="step2_section1_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section1_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea    id="step2_section1_description" name="step2_section1_description" class="form-control">{{ isset($step)?($step->step2_section1_description):'' }}</textarea>
                        <div id="step2_section1_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section1_image"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step2_section1_image" id="step2_section1_image">
                        <div id="step2_section1_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step2_section1_image))  {{ url('images/steps/'.$step->step2_section1_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step2_section1_image_show" height="250px" width="250px" style="margin-top: 5px">
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
                      Point 2        
                    </h4>
                </div>    

               

                

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section2_image"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step2_section2_image" id="step2_section2_image">
                        <div id="step2_section2_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step2_section2_image))  {{ url('images/steps/'.$step->step2_section2_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step2_section2_image_show" height="250px" width="250px" style="margin-top: 5px">
                    </div>
                    
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section2_title1"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step2_section2_title1" name="step2_section2_title1" value="{{ isset($step)?($step->step2_section2_title1):'' }}">
                        <div id="step2_section2_title1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section2_description1"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea    id="step2_section2_description1" name="step2_section2_description1" class="form-control">{{ isset($step)?($step->step2_section2_description1):'' }}</textarea>
                        <div id="step2_section2_description1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section2_title2"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step2_section2_title2" name="step2_section2_title2" value="{{ isset($step)?($step->step2_section2_title2):'' }}">
                        <div id="step2_section2_title2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section2_description2"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  id="step2_section2_description2" name="step2_section2_description2" class="form-control">{{ isset($step)?($step->step2_section2_description2):'' }}</textarea>
                        <div id="step2_section2_description2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section2_title3"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step2_section2_title3" name="step2_section2_title3" value="{{ isset($step)?($step->step2_section2_title3):'' }}">
                        <div id="step2_section2_title3-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section2_description3"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  id="step2_section2_description3" name="step2_section2_description3" class="form-control">{{ isset($step)?($step->step2_section2_description3):'' }}</textarea>
                        <div id="step2_section2_description3-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                      Point 3       
                    </h4>
                </div>    

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section3_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step2_section3_title" name="step2_section3_title" value="{{ isset($step)?($step->step2_section3_title):'' }}">
                        <div id="step2_section3_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section3_image"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step2_section3_image" id="step2_section3_image">
                        <div id="step2_section3_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step2_section3_image))  {{ url('images/steps/'.$step->step2_section3_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step2_section3_image_show" height="250px" width="350px" style="margin-top: 5px">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section3_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  id="step2_section3_description" name="step2_section3_description" class="form-control">{{ isset($step)?($step->step2_section3_description):'' }}</textarea>
                        <div id="step2_section3_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                      Point 4      
                    </h4>
                </div>    

                

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section4_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step2_section4_title" name="step2_section4_title" value="{{ isset($step)?($step->step2_section4_title):'' }}">
                        <div id="step2_section4_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section4_image"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step2_section4_image" id="step2_section4_image">
                        <div id="step2_section4_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step2_section4_image))  {{ url('images/steps/'.$step->step2_section4_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step2_section4_image_show" height="250px" width="350px" style="margin-top: 5px">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section4_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea   id="step2_section4_description" name="step2_section4_description" class="form-control">{{ isset($step)?($step->step2_section4_description):'' }}</textarea>
                        <div id="step2_section4_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                      Point 5      
                    </h4>
                </div>    

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section5_title"> Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control input-flat" id="step2_section5_title" name="step2_section5_title" value="{{ isset($step)?($step->step2_section5_title):'' }}">
                        <div id="step2_section5_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section5_image"> Image  <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control-image" name="step2_section5_image" id="step2_section5_image">
                        <div id="step2_section5_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        <img src="@if(isset($step) && !empty($step->step2_section5_image))  {{ url('images/steps/'.$step->step2_section5_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step2_section5_image_show" height="250px" width="350px" style="margin-top: 5px">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="col-form-label" for="step2_section5_description"> Description <span class="text-danger">*</span>
                        </label>
                        <textarea  id="step2_section5_description" name="step2_section5_description" class="form-control">{{ isset($step)?($step->step2_section5_description):'' }}</textarea>
                        <div id="step2_section5_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>
                </div>

                

            </div>
        </div>
    </div>
 
    <button type="button" class="btn btn-primary mt-4" id="save_closeStepTwoBtn" data-action="@if(isset($step->step2_title) && $step->step2_title != '') update @else add @endif">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form> 