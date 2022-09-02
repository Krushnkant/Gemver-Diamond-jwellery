<form class="form-valide" action="" id="BannerCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    <input type="hidden" name="banner_id" value="{{ isset($banner)?($banner->id):'' }}">

    <div class="form-group">
        <label class="col-form-label" for="tilte">Title <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="title" name="title" value="{{ isset($banner)?($banner->title):'' }}">
        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="description">Shot Line <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="description" value="{{ isset($banner)?($banner->description):'' }}" name="description">
        <div id="description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

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
        
        <div class="form-group">
        <label class="col-form-label" for="button_name">Button Name 
        </label>
        <input type="text" class="form-control input-flat" id="button_name" value="{{ isset($banner)?($banner->button_name):'' }}" name="button_name">
        <div id="button_name-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>

        <!--<div class="form-group">-->
        <!--<label class="col-form-label" for="button_url">Button URL -->
        <!--</label>-->
        <!--<input type="text" class="form-control input-flat" id="button_url" value="{{ isset($banner)?($banner->button_url):'' }}" name="button_url">-->
        <!--<div id="button_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>-->
        <!--</div>-->
        
        <!-- <div class="form-group" >
        <label class="col-form-label" for="button_url">Select Category URL
        </label>
        <select id='button_url' name="button_url" class="form-control">
        <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ URL('/shop/'.$category['id'])}}" @if(isset($category) && URL('/shop/'.$category['id']) == $banner->button_url) selected @endif >{{ $category['category_name'] }}</option>
            @endforeach
        </select>
    </div> -->

        <div class="form-group">
            <select class="form-control" id="BannerInfo" name="BannerInfo">
                @foreach($application_dropdowns as $application_dropdown)
                    <option value="{{ $application_dropdown->id }}" @if($application_dropdown->id == $banner->application_dropdown_id) selected @endif>{{ $application_dropdown->title }}</option>
                @endforeach
            </select>
        </div>

        <div id="infoBox" class="">
            @if($banner->application_dropdown_id == 2)
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
            @elseif($banner->application_dropdown_id == 3)
                <div class="form-group" id="category_dropdown">
                    <label class="col-form-label" for="category">Select Category</label>
                    <select id="value" name="value" class="">
                        <option></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $banner->value) selected @endif>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <div id="value-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                </div>
        
            @elseif($banner->application_dropdown_id == 4)
                <div class="form-group">
                    <label class="col-form-label" for="bannerUrl">Banner URL</label>
                    <input type="text" class="form-control input-flat" id="value" name="value" value="{{ $banner->value }}">
                    <div id="value-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                </div>
            @endif
        </div>

        <div id="productDropdownBox" class="pb-2">
            @if($banner->application_dropdown_id == 2)
                <div class="form-group" id="">
                    <label class="col-form-label" for="product">Select Product</label>
                    <select id="product" name="product" class="">
                        <option></option>
                        @foreach($products as $product)
                            <option value="{{ $product['id'] }}" @if($product['id'] == $banner->product_variant_id) selected @endif>{{ $product['product_title'] }}</option>
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

