<form class="form-valide" action="" id="BlogCategoryCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
   
    <div class="form-group">
        <label class="col-form-label" for="category_name">Category Name <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="category_name" name="category_name">
        <div id="categoryname-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <button type="button" class="btn btn-outline-primary" id="save_newBlogCategoryBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary" id="save_closeBlogCategoryBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
    </div>
</form>

