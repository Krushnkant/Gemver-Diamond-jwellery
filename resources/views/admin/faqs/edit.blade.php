<form class="form-valide" action="" id="FaqForm" method="post">
    <div id="cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <input type="hidden" name="faq_id" value="{{ isset($Faq)?($Faq['id']):'' }}">
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12  justify-content-center">
        <div class="form-group">
            <label class="col-form-label" for="Question">question <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control input-flat" id="question" value="{{ $Faq['question'] }}" name="question">
            <label id="question-error" class="error invalid-feedback animated fadeInDown" for="question"   style="color: red"></label>
        </div>

        <div class="form-group">
            <label class="col-form-label" for="Answer">Answer <span class="text-danger">*</span>
            </label>
            
            <textarea id="answer" name="answer" class="form-control input-flat">{{ $Faq['answer'] }}</textarea>
            <label id="answer-error" class="error invalid-feedback animated fadeInDown" for="answer" style="color: red"></label>
        </div>
    </div>

    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 justify-content-center mt-4">
        <button type="button" class="btn btn-outline-primary mt-4" id="save_newFaqBtn" data-action="update">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
        <button type="button" class="btn btn-primary mt-4" id="save_closeFaqBtn" data-action="update">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
    </div>
</form>
