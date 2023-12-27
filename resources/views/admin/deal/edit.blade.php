<form class="form-valide" action="" id="dealForm" method="post">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <input type="hidden" name="deal_id" value="{{ isset($deal)?($deal->id):'' }}">

    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
        <div class="form-group">
            <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="title" name="title" value="{{ isset($deal)?($deal->title):'' }}">
            <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="start_date">Start Date <span class="text-danger">*</span>
            </label>
            <div class="form-group">
                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ isset($deal)?($deal->start_date):'' }}"> 
                <div id="start_date-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-form-label" for="background_color">Background Color <span class="text-danger">*</span>
            </label>
            <input type="color" class="form-control input-flat" id="background_color" name="background_color" value="{{ isset($deal)?($deal->background_color):'' }}">
            <div id="background_color-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="text_color">Text Color <span class="text-danger">*</span>
            </label>
            <input type="color" class="form-control input-flat" id="text_color" name="text_color" value="{{ isset($deal)?($deal->text_color):'' }}">
            <div id="text_color-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="button_color">Button Color <span class="text-danger">*</span>
            </label>
            <input type="color" class="form-control input-flat" id="button_color" name="button_color" value="{{ isset($deal)?($deal->button_color):'' }}">
            <div id="button_color-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="text_button">Text Button  <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="text_button" name="text_button" value="{{ isset($deal)?($deal->text_button):'' }}">
            <div id="text_button-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="date_title"> Date Title<span class="text-danger">*</span>
            </label>
            <div class="form-group">
                <input type="text" class="form-control" id="date_title" name="date_title" value="{{ isset($deal)?($deal->date_title):'' }}"> 
                <div id="date_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="url_button">Button URL <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="url_button" name="url_button" value="{{ isset($deal)?($deal->url_button):'' }}">
            <div id="url_button-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
        </div>

        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
        <button type="button" class="btn btn-outline-primary" id="save_newdealBtn" data-action="update">Save  <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

