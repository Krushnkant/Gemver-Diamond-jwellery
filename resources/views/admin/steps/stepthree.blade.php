<form class="form-valide" action="" id="StepThreeCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <input type="hidden" name="step_id" value="{{ isset($step)?($step->id):'' }}">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_title">Step 3 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_title" name="step3_title" value="{{ isset($step)?($step->step3_title):'' }}">
                <div id="step3_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
            <div class="form-group">
                <label class="col-form-label" for="step3_shotline">Step 3 Shotline <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_shotline" name="step3_shotline" value="{{ isset($step)?($step->step3_shotline):'' }}">
                <div id="step3_shotline-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_icon">Step 3 Icon  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_icon" id="step3_icon">
                <div id="step3_icon-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_icon))  {{ url('images/steps/'.$step->step3_icon) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_icon_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div> -->
    
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_header_image">Step 3 Header Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_header_image" id="step3_header_image">
                <div id="step3_header_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_header_image))  {{ url('images/steps/'.$step->step3_header_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_header_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>
    
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section1_title">Section 1 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section1_title" name="step3_section1_title" value="{{ isset($step)?($step->step3_section1_title):'' }}">
                <div id="step3_section1_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>
    
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section1_description">Section 1 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section1_description" name="step3_section1_description" class="form-control">{{ isset($step)?($step->step3_section1_description):'' }}</textarea>
                <div id="step3_section1_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section2_title">Section 2 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section2_title" name="step3_section2_title" value="{{ isset($step)?($step->step3_section2_title):'' }}">
                <div id="step3_section2_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section2_description">Section 2 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section2_description" name="step3_section2_description" class="form-control">{{ isset($step)?($step->step3_section2_description):'' }}</textarea>
                <div id="step3_section1_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section2_image"> Section 2 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_section2_image" id="step3_section2_image">
                <div id="step3_section2_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_section2_image))  {{ url('images/steps/'.$step->step3_section2_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_section2_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section3_title">Section 3 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section3_title" name="step3_section3_title" value="{{ isset($step)?($step->step3_section3_title):'' }}">
                <div id="step3_section3_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section3_description">Section 3 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section3_description" name="step3_section3_description" class="form-control">{{ isset($step)?($step->step3_section3_description):'' }}</textarea>
                <div id="step3_section3_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section3_image"> Section 3 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_section3_image" id="step3_section3_image">
                <div id="step3_section3_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_section3_image))  {{ url('images/steps/'.$step->step3_section3_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_section3_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>
    
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section4_title">Section 4 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section4_title" name="step3_section4_title" value="{{ isset($step)?($step->step3_section4_title):'' }}">
                <div id="step3_section4_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section4_description">Section 4 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section4_description" name="step3_section4_description" class="form-control">{{ isset($step)?($step->step3_section4_description):'' }}</textarea>
                <div id="step3_section4_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section4_image"> Section 4 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_section4_image" id="step3_section4_image">
                <div id="step3_section4_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_section4_image))  {{ url('images/steps/'.$step->step3_section4_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_section4_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section5_title">Section 5 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section5_title" name="step3_section5_title" value="{{ isset($step)?($step->step3_section5_title):'' }}">
                <div id="step3_section5_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section5_description">Section 5 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section5_description" name="step3_section5_description" class="form-control">{{ isset($step)?($step->step3_section5_description):'' }}</textarea>
                <div id="step3_section5_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section5_image"> Section 5 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_section5_image" id="step3_section5_image">
                <div id="step3_section5_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_section5_image))  {{ url('images/steps/'.$step->step3_section5_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_section5_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section6_title">Section 6 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section6_title" name="step3_section6_title" value="{{ isset($step)?($step->step3_section6_title):'' }}">
                <div id="step3_section6_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section6_description">Section 6 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section6_description" name="step3_section6_description" class="form-control">{{ isset($step)?($step->step3_section6_description):'' }}</textarea>
                <div id="step3_section6_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section6_image"> Section 6 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_section6_image" id="step3_section6_image">
                <div id="step3_section6_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_section6_image))  {{ url('images/steps/'.$step->step3_section6_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_section6_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section7_title">Section 7 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section7_title" name="step3_section7_title" value="{{ isset($step)?($step->step3_section7_title):'' }}">
                <div id="step3_section7_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section7_description">Section 7 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section7_description" name="step3_section7_description" class="form-control">{{ isset($step)?($step->step3_section7_description):'' }}</textarea>
                <div id="step3_section7_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section8_title">Section 8 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section8_title" name="step3_section8_title" value="{{ isset($step)?($step->step3_section8_title):'' }}">
                <div id="step3_section8_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section8_description">Section 8 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section8_description" name="step3_section8_description" class="form-control">{{ isset($step)?($step->step3_section8_description):'' }}</textarea>
                <div id="step3_section8_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section8_image"> Section 8 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_section8_image" id="step3_section8_image">
                <div id="step3_section8_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_section8_image))  {{ url('images/steps/'.$step->step3_section8_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_section8_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>



        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section9_title">Section 9 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section9_title" name="step3_section9_title" value="{{ isset($step)?($step->step3_section9_title):'' }}">
                <div id="step3_section9_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section9_description">Section 9 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section9_description" name="step3_section9_description" class="form-control">{{ isset($step)?($step->step3_section9_description):'' }}</textarea>
                <div id="step3_section9_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section9_image"> Section 9 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_section9_image" id="step3_section9_image">
                <div id="step3_section9_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_section9_image))  {{ url('images/steps/'.$step->step3_section9_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_section9_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section10_title">Section 10 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section10_title" name="step3_section10_title" value="{{ isset($step)?($step->step3_section10_title):'' }}">
                <div id="step3_section10_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section10_description">Section 10 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section10_description" name="step3_section10_description" class="form-control">{{ isset($step)?($step->step3_section10_description):'' }}</textarea>
                <div id="step3_section10_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section10_image"> Section 10 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_section10_image" id="step3_section10_image">
                <div id="step3_section10_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_section10_image))  {{ url('images/steps/'.$step->step3_section10_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_section10_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section11_title">Section 11 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step3_section11_title" name="step3_section11_title" value="{{ isset($step)?($step->step3_section11_title):'' }}">
                <div id="step3_section11_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section11_description">Section 11 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step3_section11_description" name="step3_section11_description" class="form-control">{{ isset($step)?($step->step3_section11_description):'' }}</textarea>
                <div id="step3_section11_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step3_section11_image"> Section 11 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step3_section11_image" id="step3_section11_image">
                <div id="step3_section11_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step3_section11_image))  {{ url('images/steps/'.$step->step3_section11_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step3_section11_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>

        </div>

        <button type="button" class="btn btn-primary mt-4" id="save_closeStepThreeBtn" data-action="@if(isset($step->step3_title) && $step->step3_title != '') update @else add @endif">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>