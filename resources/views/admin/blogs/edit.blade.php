<form class="form-valide" action="" id="BlogCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    <input type="hidden" name="blog_id" value="{{ isset($blog)?($blog->id):'' }}">

    <div class="form-group"  >
        <label class="col-form-label" for="category_id">Select Category <span class="text-danger">*</span>
        </label>
        <select id='category_id' name="category_id" class="form-control">
        <option value="">Select Category</option>
            @foreach($blogcategory as $blogs)
                <option value="{{ $blogs['id'] }}" @if(isset($blogs) && $blogs['id'] == $blog->category_id) selected @endif >{{ $blogs['category_name'] }}</option>
            @endforeach
        </select>
        <div id="category-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="category_name">Title <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="title" name="title" value="{{ isset($blog)?($blog->title):'' }}">
        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="description">Description <span class="text-danger">*</span>
        </label>
        <textarea class="summernote" id="description" name="description">{!! $blog->description !!}</textarea>
        <div id="description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>


    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="{{ isset($blog)?($blog->blog_thumb):'' }}">

        <?php
        if( isset($blog) && isset($blog->blog_thumb) ){
        ?>
        <div class="jFiler-items jFiler-row oldImgDisplayBox">
            <ul class="jFiler-items-list jFiler-items-grid">
                <li id="ImgBox" class="jFiler-item" data-jfiler-index="1" style="">
                    <div class="jFiler-item-container">
                        <div class="jFiler-item-inner">
                            <div class="jFiler-item-thumb">
                                <div class="jFiler-item-status"></div>
                                <div class="jFiler-item-thumb-overlay"></div>
                                <div class="jFiler-item-thumb-image"><img src="{{ url($blog->blog_thumb) }}" draggable="false"></div>
                            </div>
                            <div class="jFiler-item-assets jFiler-row">
                                <ul class="list-inline pull-right">
                                    <li><a class="icon-jfi-trash jFiler-item-trash-action" onclick="removeuploadedimg('ImgBox', 'catImg','<?php echo $blog->blog_thumb;?>');"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <?php } ?>

        <div id="blogthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="meta_title">Meta Title 
        </label>
        <input type="text" class="form-control input-flat" id="meta_title" name="meta_title" value="{{ isset($blog)?($blog->meta_title):'' }}">
    </div>
    

    <div class="form-group">
        <label class="col-form-label" for="meta_description">Meta Description 
        </label>
        <textarea type="text" class="form-control input-default" id="meta_description" name="meta_description">{{ isset($blog)?($blog->meta_description):'' }}</textarea>
    </div>

    <button type="button" class="btn btn-outline-primary mt-4" id="save_newBlogBtn" data-action="update">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary mt-4" id="save_closeBlogBtn" data-action="update">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
    </div>
</form>

