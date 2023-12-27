<form class="form-valide" action="" id="redirectForm" method="post">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
        <div class="form-group">
            <label class="col-form-label" for="from_url">From URL <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="from_url" name="from_url">
            <div id="from_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="to_url">To URL <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="to_url" name="to_url">
            <div id="to_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>
        <button type="button" class="btn btn-outline-primary" id="save_newredirectBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
        <button type="button" class="btn btn-primary" id="save_closeredirectBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

