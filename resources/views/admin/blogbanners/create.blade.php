<form class="form-valide" action="" id="BannerCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    

    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="">
        <div id="catthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group"  id="button_url">
        <label class="col-form-label" for="button_url">Select Dropdown
        </label>
        <select id='BannerInfo' name="dropdown_id" class="form-control">
            <option value="3">None</option>
            <option value="1">Category</option>
            <option value="2">Product</option>
        </select>
    </div>

    <div id="infoBox" class=""></div>
    <div id="productDropdownBox" class="pb-2"></div>

    <button type="button" class="btn btn-outline-primary mt-4" id="save_newBannerBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary mt-4" id="save_closeBannerBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

