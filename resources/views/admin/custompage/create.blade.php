<form class="form-valide" action="" id="custompageCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 container justify-content-center">
    
    

    <div class="form-group">
        <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="title" name="title" value="{{ isset($custompage)?($custompage->title):'' }}">
        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="description">Description <span class="text-danger">*</span>
        </label>
        <textarea class="" id="description" name="description">{{ isset($custompage)?($custompage->content):'' }}</textarea>
        <div id="description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group ">
        <label class="col-form-label" for="slug">Slug <span class="text-danger">*</span></label>
     
        <input type="text" id="slug" class="form-control input-flat" name="slug" value="{{ isset($custompage)?($custompage->slug):'' }}">
        <label id="slug-error" class="error invalid-feedback animated fadeInDown" for=""></label>
    </div>
     
    <div class="form-group">
        <label class="col-form-label" for="meta_title">Meta Title 
        </label>
        <input type="text" class="form-control input-flat" id="meta_title" name="meta_title" value="{{ isset($custompage)?($custompage->meta_title):'' }}">
    </div>
    

    <div class="form-group">
        <label class="col-form-label" for="meta_description">Meta Description 
        </label>
        <textarea type="text" class="form-control input-default" id="meta_description" name="meta_description">{{ isset($custompage)?($custompage->meta_description):'' }}</textarea>
    </div>
    <input type="hidden" name="custompage_id" value="{{ isset($custompage)?($custompage->id):'' }}">
    <button type="button" class="btn btn-outline-primary mt-4" id="save_newcustompageBtn" data-action="{{ isset($custompage)?'update':'add' }}">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary mt-4" id="save_closecustompageBtn" data-action="{{ isset($custompage)?'update':'add' }}">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    
    </div>
</form>

