<form class="form-valide" action="" id="WelcomeMailCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">

  
    
    <div class="form-group">
        <label class="col-form-label" for="message"> Message <span class="text-danger">*</span>
        </label>
        <textarea  class="summernote"  id="message" name="message" class="form-control">{{ $setting->welcome_mail_message }}</textarea>
        <div id="message-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>
    
    <div id="infoBox" class=""></div>
    <div id="productDropdownBox" class="pb-2"></div>
    <button type="button" class="btn btn-outline-primary mt-4" id="save_newWelcomeMailBtn" data-action="add">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    {{-- <button type="button" class="btn btn-primary mt-4" id="save_closeNewsLatterBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button> --}}

    </div>
</form>

