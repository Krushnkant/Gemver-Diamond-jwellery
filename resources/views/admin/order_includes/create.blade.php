<form class="form-valide" action="" id="OrderIncludesCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    <input type="hidden" name="orderincludes_id" value="{{ isset($orderincludes)?($orderincludes->id):'' }}">


    <div class="form-group">
        <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="title" name="title" value="{{ isset($orderincludes)?($orderincludes->title):'' }}">
        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="Thumbnail">Thumbnail  <span class="text-danger">*</span>
        </label>
        <input type="file" name="files[]" id="catIconFiles" multiple="multiple">
        <input type="hidden" name="catImg" id="catImg" value="{{ isset($orderincludes)?($orderincludes->image):'' }}">
        <?php
        if( isset($orderincludes) && isset($orderincludes->image) ){
        ?>
        <div class="jFiler-items jFiler-row oldImgDisplayBox">
            <ul class="jFiler-items-list jFiler-items-grid">
                <li id="ImgBox" class="jFiler-item" data-jfiler-index="1" style="">
                    <div class="jFiler-item-container">
                        <div class="jFiler-item-inner">
                            <div class="jFiler-item-thumb">
                                <div class="jFiler-item-status"></div>
                                <div class="jFiler-item-thumb-overlay"></div>
                                <div class="jFiler-item-thumb-image"><img src="{{ url($orderincludes->image) }}" draggable="false"></div>
                            </div>
                            <div class="jFiler-item-assets jFiler-row">
                                <ul class="list-inline pull-right">
                                    <li><a class="icon-jfi-trash jFiler-item-trash-action" onclick="removeuploadedimg('ImgBox', 'catImg','<?php echo $orderincludes->image;?>');"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <?php } ?>
        <div id="categorythumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>
     
    <div class="row add-value">
        <div class="row col-lg-12">
        <div class="col-lg-4 ">
            <div class="form-group ">
                <input type="file" class="form-control-file" id="image[]" onchange="" name="image[]">
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="form-group">
             
                <input type="text" class="form-control input-flat" id="subtitle" name="subtitle[]">
                <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
           </div>
        </div>
        <div class="col-lg-2 ">
            <div class="form-group">
                
            <button type="button" class="btn btn-outline-primary " id="Add" data-action="add">+ </button>
                
           </div>
        </div>
        </div>
        @if(isset($orderincludes->orderincludesdata))
        @foreach($orderincludes->orderincludesdata as $orderincludedata)

        <div class="row col-lg-12">
            <div class="col-lg-4 ">
                <div class="form-group ">
                    <input type="file" class="form-control-file" id="image[]" onchange="" name="image[]">
                    <img src="{{ asset('images/order_image/'.$orderincludedata->image) }}" class="" id="profilepic_image_show" height="50px" width="50px" style="margin-top: 5px">
                </div>
            </div>
            <div class="col-lg-4 ">
                <div class="form-group">
                    <input type="text" class="form-control input-flat" id="subtitle" value="{{ $orderincludedata->title }}" name="subtitle[]">
                    <div id="subtitle-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    
                </div>
            </div>
            <div class="col-lg-2 ">
                <button type="button" class="minus_btn btn mb-1 btn-dark" >- </button> 
            </div>
        </div>
             
        @endforeach
        @endif
    </div>
    


    <button type="button" class="btn btn-outline-primary mt-4" id="save_newOrderIncludesBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>


    </div>
</form>

