<form class="form-valide" action="" id="ShopByStyleCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
 
    <div class="form-group"  >
        <label class="col-form-label" for="category_id">Select Category
        </label>
        <select id='category_id' name="category_id" class="form-control">
        <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category['id'] }}"  >{{ $category['category_name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="title" name="title">
        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="">
        <div id="categorythumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group" >
        <label class="col-form-label" for="setting">Select Setting <span class="text-danger">*</span>
        </label>
        <select id='setting' name="setting" class="">
            <option value="product-setting">Start with a Setting</option>
            <option value="diamond-setting">Start with a Lab Diamond</option>
        </select>
        <div id="attribute_id_variation-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

   
    <div class="form-group" id="attribute_variation" >
        <label class="col-form-label" for="attribute_variation">Select Attribute for Variation <span class="text-danger">*</span>
        </label>
        <select id='attribute_id_variation' name="attribute_id_variation" class="">
            <option></option>
            @foreach($attributes as $attr)
                <option value="{{ $attr['id'] }}">{{ $attr['attribute_name'] }}</option>
            @endforeach
        </select>
        <div id="attribute_id_variation-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group" id="attribute_diamond" style="display: none;">
        <label class="col-form-label" for="attribute_variation">Select Attribute for Variation <span class="text-danger">*</span>
        </label>
        <select id='attribute_id_diamond' name="attribute_id_variation" class="">
            <option value="shape">Shape</option>
        </select>
        <div id="attribute_id_variation-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group" id="attribute_variation_term" >
        <label class="col-form-label" for="attribute_variation">Select Attribute for Variation Term <span class="text-danger">*</span>
        </label>
        <select id='attribute_id_variation_term' name="attribute_id_variation_term" class="">
            <option></option>
        </select>
        <div id="attribute_id_variation_term-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group" id="attribute_diamond_term" style="display: none;">
        <label class="col-form-label" for="attribute_variation">Select Attribute for Variation Term <span class="text-danger">*</span>
        </label>
        <select id='attribute_id_diamond_term' name="attribute_id_variation_term" class="">
             <option value="round">Round</option>
             <option value="oval">Oval</option>
        </select>
        <div id="attribute_id_variation_term-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>


    <button type="button" class="btn btn-outline-primary" id="save_newShopByStyleBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary" id="save_closeShopByStyleBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

