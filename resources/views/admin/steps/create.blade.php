<form class="form-valide" action="" id="StepCreateForm" method="post" enctype="multipart/form-data">

    <div id="attr-cover-spin" class="cover-spin"></div>
    {{ csrf_field() }}
    <input type="hidden" name="step_id" value="{{ isset($step)?($step->id):'' }}">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group" id="category_id">
        <label class="col-form-label" for="category_id">Select Category
        </label>
        <select id='category_id' name="category_id" class="form-control">
        <option >Select Category</option>
            @foreach($category as $cat)
                <option value="{{ $cat['id'] }}"  @if(isset($step) && $cat['id'] == $step->category_id) selected @endif>{{ $cat['category_name'] }}</option>
            @endforeach
        </select>
        <div id="category_id-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="main_title">Main Title <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="main_title" name="main_title" value="{{ isset($step)?($step->main_title):'' }}">
        <div id="main_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <div class="form-group">
        <label class="col-form-label" for="main_shotline">Main Shotline <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control input-flat" id="main_shotline" name="main_shotline" value="{{ isset($step)?($step->main_shotline):'' }}">
        <div id="main_shotline-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
    </div>

    <button type="button" class="btn btn-outline-primary" id="save_newStepBtn" data-action="{{ isset($step)?'update':'add'}}">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
    <button type="button" class="btn btn-primary" id="save_closeStepBtn" data-action="{{ isset($step)?'update':'add'}}">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

    </div>
</form>

