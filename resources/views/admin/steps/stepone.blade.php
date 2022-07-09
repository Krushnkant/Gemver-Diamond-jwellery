<form class="form-valide" action="" id="StepOneCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <input type="hidden" name="step_id" value="{{ isset($step)?($step->id):'' }}">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_title">Step 1 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step1_title" name="step1_title" value="{{ isset($step)?($step->step1_title):'' }}">
                <div id="step1_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_shotline">Step 1 Shotline <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step1_shotline" name="step1_shotline" value="{{ isset($step)?($step->step1_shotline):'' }}">
                <div id="step1_shotline-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_icon">Step 1 Icon  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step1_icon" id="step1_icon" >
                <div id="step1_icon-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step1_icon))  {{ url('images/steps/'.$step->step1_icon) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step1_icon_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div> -->

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_header_image">Step 1 Header Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step1_header_image" id="step1_header_image">
                <div id="step1_header_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step1_header_image))  {{ url('images/steps/'.$step->step1_header_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step1_header_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_section1_title">Section 1 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step1_section1_title" name="step1_section1_title" value="{{ isset($step)?($step->step1_section1_title):'' }}">
                <div id="step1_section1_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_section1_description">Section 1 Description <span class="text-danger">*</span>
                </label>
                <textarea  id="step1_section1_description" name="step1_section1_description" class="form-control">{{ isset($step)?($step->step1_section1_description):'' }}</textarea>
                <div id="step1_section1_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_section1_image">Section 1 Image  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step1_section1_image" id="step1_section1_image">
                <div id="step1_section1_image-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step1_section1_image))  {{ url('images/steps/'.$step->step1_section1_image) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step1_section1_image_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_section2_title">Section 2 Title <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step1_section2_title" name="step1_section2_title" value="{{ isset($step)?($step->step1_section2_title):'' }}">
                <div id="step1_section2_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_section2_image1">Section 2 Image 1  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step1_section2_image1" id="step1_section2_image1">
                <div id="step1_section2_image1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step1_section2_image1))  {{ url('images/steps/'.$step->step1_section2_image1) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step1_section2_image1_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_section2_title1">section 2 title 1 <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step1_section2_title1" name="step1_section2_title1" value="{{ isset($step)?($step->step1_section2_title1):'' }}">
                <div id="step1_section2_title1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_section2_image2">Section 2 Image 2  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control-image" name="step1_section2_image2" id="step1_section2_image2">
                <div id="step1_section2_image2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                <img src="@if(isset($step) && !empty($step->step1_section2_image2))  {{ url('images/steps/'.$step->step1_section2_image2) }} @else {{ asset('images/default_avatar.jpg') }} @endif" class="" id="step1_section2_image2_show" height="50px" width="50px" style="margin-top: 5px">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="col-form-label" for="step1_section2_title2">section 2 title 2 <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control input-flat" id="step1_section2_title2" name="step1_section2_title2" value="{{ isset($step)?($step->step1_section2_title2):'' }}">
                <div id="step1_section2_title2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>
        </div>
        <button type="button" class="btn btn-primary mt-4" id="save_closeStepOneBtn" data-action="@if(isset($step->step1_title) && $step->step1_title != '') update @else add @endif">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>    