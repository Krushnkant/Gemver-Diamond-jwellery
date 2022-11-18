<form class="form-valide" action="" id="CategoryCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    <div class="form-group">
        <label class="col-form-label" for="Serial_No">Serial No <span class="text-danger">*</span>
        </label>
        <input type="number" class="form-control input-flat" id="sr_no" name="sr_no" placeholder="" value="{{ isset($sr_no)?$sr_no+1:1 }}">
        <div id="srno-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group mt-3 mb-3">
        <div class="form-check">
                <label class="form-check-label">
                <input type="checkbox" name="is_custom" id="is_custom" class="form-check-input primaryBox"  value="0">Do you want to add customized product category?</label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="category_name">Category Name <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="category_name" name="category_name">
        <div id="categoryname-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <!-- <div class="form-group"  id="attribute_variation">
        <label class="col-form-label" for="attribute_variation">Select Attribute for Variation
        </label>
        <select id='attribute_id_variation' name="attribute_id_variation[]" class="">
            
            @foreach($attributes as $attr)
                <option value="{{ $attr['id'] }}">{{ $attr['attribute_name'] }}</option>
            @endforeach
        </select>
    </div> -->

    @if(isset($categories) && !empty($categories))
    <div class="form-group parent_category" >
        <label class="col-form-label" for="parent_category_id">Parent Category
        </label>
        <select id='parent_category_id'  name="parent_category_id" class="form-control">
            <option></option>
            @foreach($categories as $cat)
                <option value="{{ $cat['id'] }}">{{ $cat['category_name'] }}</option>
            @endforeach
        </select>
        
    </div>
    @endif



    <!-- <div class="form-group" id="attribute_required_specification">
        <label class="col-form-label" for="attribute_required_specification">Select Attribute for Required Specification
        </label>
        <select id='attribute_id_req_spec' name="attribute_id_req_spec[]" class="">
            @foreach($specifications as $spec)
                <option value="{{ $spec['id'] }}">{{ $spec['attribute_name'] }}</option>
            @endforeach
        </select>
    </div>



    <div class="form-group"  id="attribute_optional_specification">
        <label class="col-form-label" for="attribute_optional_specification">Select Attribute for Optional Specification
        </label>
        <select id='attribute_id_opt_spec' name="attribute_id_opt_spec[]" class="">
            @foreach($specifications as $spec)
                <option value="{{ $spec['id'] }}">{{ $spec['attribute_name'] }}</option>
            @endforeach
        </select>
    </div> -->

   
    
       

    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="">
        <div id="categorythumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="meta_title">Meta Title 
        </label>
        <input type="text" class="form-control input-flat" id="meta_title" name="meta_title">
    </div>
    

    <div class="form-group">
        <label class="col-form-label" for="meta_description">Meta Description 
        </label>
        <textarea type="text" class="form-control input-default" id="meta_description" name="meta_description"></textarea>
    </div>

   
    <button type="button" class="btn btn-outline-primary mt-4" id="save_newCategoryBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary mt-4" id="save_closeCategoryBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>




