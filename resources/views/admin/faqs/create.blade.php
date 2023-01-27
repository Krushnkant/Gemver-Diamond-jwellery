<form class="form-valide" action="" id="FaqForm" method="post">
    <div id="cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}

    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center mt-2">
        <div class="form-group">
            <label class="col-form-label" for="menu_page_id">Menu Page <span class="text-danger">*</span>
            </label>
            <select class="form-control" id="menu_page_id" name="menu_page_id[]" multiple>
                @foreach($menu_pages as $menu_page)
                <option value="{{ $menu_page->id }}" >{{ $menu_page->main_title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="Question">Question <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="question" name="question">
            <label id="question-error" class="error invalid-feedback animated fadeInDown" for="question" style="color: red"></label>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="Answer">Answer <span class="text-danger">*</span>
            </label>
            
            <textarea id="answer" name="answer" class="form-control input-flat"></textarea>
            <label id="answer-error" class="error invalid-feedback animated fadeInDown" for="answer" style="color: red"></label>
        </div>
    </div>

    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
        <button type="button" class="btn btn-outline-primary mt-4" id="save_newFaqBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
        <button type="button" class="btn btn-primary mt-4" id="save_closeFaqBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
    </div>
</form>
