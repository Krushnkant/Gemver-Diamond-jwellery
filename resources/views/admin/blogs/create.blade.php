<form class="form-valide" action="" id="BlogCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    
    <div class="form-group">
        <label class="col-form-label" for="category_id">Select Category <span class="text-danger">*</span>
        </label>
        <select id='category_id' name="category_id" class="form-control">
        <option value="">Select Category</option>
            @foreach($blogcategory as $blog)
                <option value="{{ $blog['id'] }}">{{ $blog['category_name'] }}</option>
            @endforeach
        </select>
        <div id="category-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="title" name="title">
        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="description">Description <span class="text-danger">*</span>
        </label>
        <textarea class="summernote" id="description" name="description"></textarea>
        <div id="description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="">
        <div id="catthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>
    <button type="button" class="btn btn-outline-primary mt-4" id="save_newBlogBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary mt-4" id="save_closeBlogBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

