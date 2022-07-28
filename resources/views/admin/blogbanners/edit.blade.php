<form class="form-valide" action="" id="BannerCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    <input type="hidden" name="banner_id" value="{{ isset($banner)?($banner->id):'' }}">


    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="{{ isset($banner)?($banner->banner_thumb):'' }}">

        <?php
        if( isset($banner) && isset($banner->banner_thumb) ){
        ?>
        <div class="jFiler-items jFiler-row oldImgDisplayBox">
            <ul class="jFiler-items-list jFiler-items-grid">
                <li id="ImgBox" class="jFiler-item" data-jfiler-index="1" style="">
                    <div class="jFiler-item-container">
                        <div class="jFiler-item-inner">
                            <div class="jFiler-item-thumb">
                                <div class="jFiler-item-status"></div>
                                <div class="jFiler-item-thumb-overlay"></div>
                                <div class="jFiler-item-thumb-image"><img src="{{ url($banner->banner_thumb) }}" draggable="false"></div>
                            </div>
                            <div class="jFiler-item-assets jFiler-row">
                                <ul class="list-inline pull-right">
                                    <li><a class="icon-jfi-trash jFiler-item-trash-action" onclick="removeuploadedimg('ImgBox', 'catImg','<?php echo $banner->banner_thumb;?>');"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <?php } ?>
        <div id="catthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>

        <div class="form-group"  id="button_url">
            <label class="col-form-label" for="button_url">Select Dropdown 
            </label>
            <select id='BannerInfo' name="dropdown_id" class="form-control">
                <option  value="3" @if(3 == $banner->dropdown_id) selected @endif >None</option>
                <option value="1" @if(1 == $banner->dropdown_id) selected @endif>Category</option>
                <option value="2" @if(2 == $banner->dropdown_id) selected @endif>Product</option>
            </select>
        </div>
        
        <div id="infoBox" class="">
            @if($banner->dropdown_id == 1)
                <div class="form-group" id="category_dropdown">
                    <label class="col-form-label" for="category">Select Category</label>
                    <select id="value" name="value" class="category_dropdown_catalog">
                        <option></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $banner->value) selected @endif>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <div id="value-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                </div>
              @elseif($banner->dropdown_id == 2)
                <div class="form-group" id="category_dropdown">
                    <label class="col-form-label" for="category">Select Product</label>
                    <select id="value" name="value" class="">
                        <option></option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" @if($product->id == $banner->value ) selected @endif>{{ $product->product_title }}</option>
                        @endforeach
                    </select>
                    <div id="product-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                </div>
            @endif
        </div>

        <div id="blogthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <button type="button" class="btn btn-outline-primary mt-4" id="save_newBannerBtn" data-action="update">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary mt-4" id="save_closeBannerBtn" data-action="update">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
    </div>
</form>

