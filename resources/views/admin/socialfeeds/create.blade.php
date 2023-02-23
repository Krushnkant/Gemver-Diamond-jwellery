<form class="form-valide" action="" id="socialfeedCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 container justify-content-center">
    

    <div class="form-group">
        <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="title" name="title" value="{{ isset($socialfeed)?($socialfeed->title):'' }}">
        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="sub_title">Sub Title
        </label>
        <input type="text" class="form-control input-flat" id="sub_title" name="sub_title" value="{{ isset($socialfeed)?($socialfeed->sub_title):'' }}">
        <div id="sub_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="description">Description <span class="text-danger">*</span>
        </label>
        <textarea class="" id="description" name="description">{{ isset($socialfeed)?($socialfeed->description):'' }}</textarea>
        <div id="description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="{{ isset($socialfeed)?($socialfeed->blog_thumb):'' }}">
        <?php
        if( isset($socialfeed) && isset($socialfeed->blog_thumb) ){
        ?>
        <div class="jFiler-items jFiler-row oldImgDisplayBox">
            <ul class="jFiler-items-list jFiler-items-grid">
                <li id="ImgBox" class="jFiler-item" data-jfiler-index="1" style="">
                    <div class="jFiler-item-container">
                        <div class="jFiler-item-inner">
                            <div class="jFiler-item-thumb">
                                <div class="jFiler-item-status"></div>
                                <div class="jFiler-item-thumb-overlay"></div>
                                <div class="jFiler-item-thumb-image"><img src="{{ url($socialfeed->blog_thumb) }}" draggable="false"></div>
                            </div>
                            <div class="jFiler-item-assets jFiler-row">
                                <ul class="list-inline pull-right">
                                    <li><a class="icon-jfi-trash jFiler-item-trash-action" onclick="removeuploadedimg('ImgBox', 'catImg','<?php echo $socialfeed->blog_thumb;?>');"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <?php } ?>
        <div id="catthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group row">
        <label class="col-lg-12 col-form-label" for="">URL handle <span class="text-danger">*</span></label>
        <div class="col-lg-12">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">https://gemver.com/social-feeds/</div>
                </div>
                <input type="text" id="slug" class="form-control input-default" name="slug" value="{{ isset($socialfeed)?($socialfeed->slug):'' }}">
              </div>
            
        </div>

        <label id="Slug-error" class="error invalid-feedback animated fadeInDown" for=""></label>
    </div>
     
    <div class="form-group">
        <label class="col-form-label" for="meta_title">Meta Title 
        </label>
        <input type="text" class="form-control input-flat" id="meta_title" name="meta_title" value="{{ isset($socialfeed)?($socialfeed->meta_title):'' }}">
    </div>
    

    <div class="form-group">
        <label class="col-form-label" for="meta_description">Meta Description 
        </label>
        <textarea type="text" class="form-control input-default" id="meta_description" name="meta_description">{{ isset($socialfeed)?($socialfeed->meta_description):'' }}</textarea>
    </div>
    <input type="hidden" name="socialfeed_id" value="{{ isset($socialfeed)?($socialfeed->id):'' }}">
    <button type="button" class="btn btn-outline-primary mt-4" id="save_newsocialfeedBtn" data-action="{{ isset($socialfeed)?'update':'add' }}">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary mt-4" id="save_closesocialfeedBtn" data-action="{{ isset($socialfeed)?'update':'add' }}">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    
    </div>
</form>

