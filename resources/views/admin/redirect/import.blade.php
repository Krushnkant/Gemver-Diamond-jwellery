<form class="form-valide" action="" id="FileCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
    
    <div class="form-group">
        <input type="file" name="file" class="form-control" id="customFile">
        <label class="custom-file-label" for="customFile">Choose file</label>
        <div id="file-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>
    
     <button type="button" class="btn btn-outline-primary mt-4" id="save_newFileBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
     <button type="button" class="btn btn-primary mt-4" id="save_closeFileBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
     
    </div>
</form>
