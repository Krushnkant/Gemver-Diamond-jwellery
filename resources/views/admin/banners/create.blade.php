<form class="form-valide" action="" id="BannerCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    
    <div class="form-group">
        <label class="col-form-label" for="title">Title 
        </label>
        <input type="text" class="form-control input-flat" id="title" name="title">
        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="description">Shot Line 
        </label>
        <input type="text" class="form-control input-flat" id="description" name="description">
        <div id="description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="">
        <div id="catthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Mobile Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="bannerIconFiles" multiple="multiple">
        <input type="hidden" name="bannerImg" id="bannerImg" value="">
        <div id="bannerthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="button_name">Button Name 
        </label>
        <input type="text" class="form-control input-flat" id="button_name" name="button_name">
        <div id="button_name-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <!--<div class="form-group">-->
    <!--    <label class="col-form-label" for="button_url">Button URL -->
    <!--    </label>-->
    <!--    <input type="text" class="form-control input-flat" id="button_url" name="button_url">-->
    <!--    <div id="button_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>-->
    <!--</div>-->
    
    <!-- <div class="form-group"  >
        <label class="col-form-label" for="button_url">Select Category URL
        </label>
        <select id='button_url' name="button_url" class="form-control">
        <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ URL('/shop/'.$category['id'])}}">{{ $category['category_name'] }}</option>
            @endforeach
        </select>
    </div> -->

    <div class="form-group">
        <select class="form-control" id="BannerInfo" name="BannerInfo">
            @foreach($application_dropdowns as $application_dropdown)
            <option value="{{ $application_dropdown->id }}" @if($application_dropdown->id==1) selected @endif>{{ $application_dropdown->title }}</option>
            @endforeach
        </select>
    </div>

    <div id="infoBox" class=""></div>
    <div id="productDropdownBox" class="pb-2"></div>


    <button type="button" class="btn btn-outline-primary mt-4" id="save_newBannerBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary mt-4" id="save_closeBannerBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

