<form class="form-valide" action="" id="ShopByStyleCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    <input type="hidden" name="shopbystyle_id" value="{{ isset($shopby)?($shopby->id):'' }}">
    

    <div class="form-group">
        <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="title" name="title" value="{{ isset($shopby)?($shopby->title):'' }}">
        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="{{ isset($shopby)?($shopby->image):'' }}">

        <?php
        if( isset($shopby) && isset($shopby->image) ){
        ?>
        <div class="jFiler-items jFiler-row oldImgDisplayBox">
            <ul class="jFiler-items-list jFiler-items-grid">
                <li id="ImgBox" class="jFiler-item" data-jfiler-index="1" style="">
                    <div class="jFiler-item-container">
                        <div class="jFiler-item-inner">
                            <div class="jFiler-item-thumb">
                                <div class="jFiler-item-status"></div>
                                <div class="jFiler-item-thumb-overlay"></div>
                                <div class="jFiler-item-thumb-image"><img src="{{ url($shopby->image) }}" draggable="false"></div>
                            </div>
                            <div class="jFiler-item-assets jFiler-row">
                                <ul class="list-inline pull-right">
                                    <li><a class="icon-jfi-trash jFiler-item-trash-action" onclick="removeuploadedimg('ImgBox', 'catImg','<?php echo $shopby->image;?>');"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <?php } ?>

        <div id="categorythumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>



    <div class="form-group" id="attribute_variation">
        <label class="col-form-label" for="attribute_variation">Select Attribute for Variation <span class="text-danger">*</span>
        </label>
        <select id='attribute_id_variation' name="attribute_id_variation" class="">
            <option></option>
            @foreach($attributes as $attr)
                <option value="{{ $attr['id'] }}" @if(isset($shopby) && $shopby->attributes == $attr['id']) selected @endif>{{ $attr['attribute_name'] }}</option>
            @endforeach
        </select>
        <div id="attribute_id_variation-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>


    <div class="form-group" id="attribute_variation_term">
        <label class="col-form-label" for="attribute_variation">Select Attribute for Variation Term <span class="text-danger">*</span>
        </label>
        <select id='attribute_id_variation_term' name="attribute_id_variation_term" class="">
            @foreach($attributes_term as $attr_term)
                <option value="{{ $attr_term['id'] }}" @if(isset($shopby) && $shopby->attribute_terms == $attr_term['id']) selected @endif>{{ $attr_term['attrterm_name'] }}</option>
            @endforeach
        </select>
        <div id="attribute_id_variation_term-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <button type="button" class="btn btn-outline-primary" id="save_newShopByStyleBtn" data-action="update">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary" id="save_closeShopByStyleBtn" data-action="update">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
    </div>
</form>

