@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home Setting</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Home Setting
                        </h4>

                        <form class="form-valide" action="" id="HomeCreateForm" method="post" enctype="multipart/form-data">

                            <div id="attr-cover-spin" class="cover-spin"></div>
                            {{ csrf_field() }}
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 container justify-content-center">
                            
                            <div class="form-group">
                                <label class="col-form-label" for="section_category_title">Section Category Title 
                                </label>
                                <input type="text" class="form-control input-flat" id="section_category_title" name="section_category_title" value="{{ $homesettings->section_category_title }}">
                                <div id="section_category_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_diamond_title">Section Diamond Title 
                                </label>
                                <input type="text" class="form-control input-flat" id="section_diamond_title" name="section_diamond_title" value="{{ $homesettings->section_diamond_title }}">
                                <div id="section_diamond_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_stories_title">Section Stories Title 
                                </label>
                                <input type="text" class="form-control input-flat" id="section_stories_title" name="section_stories_title" value="{{ $homesettings->section_stories_title }}">
                                <div id="section_stories_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_stories_description">Section Stories Description 
                                </label>
                                <textarea  id="section_stories_description" class="form-control" name="section_stories_description">{{ $homesettings->section_stories_description }}</textarea>
                                <div id="section_stories_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_customise_title">Section Customise Title 
                                </label>
                                <input type="text" class="form-control input-flat" id="section_customise_title" name="section_customise_title" value="{{ $homesettings->section_customise_title }}">
                                <div id="section_customise_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_customise_description">Section Customise Description 
                                </label>
                                <textarea  id="section_customise_description" class="form-control" name="section_customise_description">{{ $homesettings->section_customise_description }}</textarea>
                                <div id="section_customise_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group"  id="button_url">
                                <label class="col-form-label" for="button_url">Select Category URL
                                </label>
                                <select id='button_url' name="button_url" class="form-control">
                                <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category['id'] }}" @if(isset($homesettings) && $homesettings['section_customise_link'] == $category['id']) selected @endif >{{ $category['category_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="homeIconFiles">Section Customise Image  
                                </label>
                                <input type="file" name="files[]" id="homeIconFiles" multiple="multiple">
                                <input type="hidden" name="homeImg" id="homeImg" value="">
                                <div id="homethumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_why_gemver_title">Section Why Gemver Title 
                                </label>
                                <input type="text" class="form-control input-flat" id="section_why_gemver_title" name="section_why_gemver_title" value="{{ $homesettings->section_why_gemver_title }}">
                                <div id="section_why_gemver_title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_why_gemver_description">Section Why Gemver Description 
                                </label>
                                <textarea  id="section_why_gemver_description" class="form-control" name="section_why_gemver_description">{{ $homesettings->section_why_gemver_description }}</textarea>
                                <div id="section_why_gemver_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_why_gemver_title1">Section Why Gemver Title 1
                                </label>
                                <input type="text" class="form-control input-flat" id="section_why_gemver_title1" name="section_why_gemver_title1" value="{{ $homesettings->section_why_gemver_title1 }}">
                                <div id="section_why_gemver_title1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_why_gemver_description1">Section Why Gemver Description 1
                                </label>
                                <textarea  id="section_why_gemver_description1" class="form-control" name="section_why_gemver_description1">{{ $homesettings->section_why_gemver_description1 }}</textarea>
                                <div id="section_why_gemver_description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="Thumbnail">Section Why Gemver Image  1
                                </label>
                                <input type="file" name="files[]" id="homeIconFiles1" multiple="multiple">
                                <input type="hidden" name="homeImg1" id="homeImg1" value="">
                                <div id="homethumb1-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>



                            <div class="form-group">
                                <label class="col-form-label" for="section_why_gemver_title2">Section Why Gemver Title 2
                                </label>
                                <input type="text" class="form-control input-flat" id="section_why_gemver_title2" name="section_why_gemver_title2" value="{{ $homesettings->section_why_gemver_title2 }}">
                                <div id="section_why_gemver_title2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="section_why_gemver_description2">Section Why Gemver Description 2
                                </label>
                                <textarea  id="section_why_gemver_description2" class="form-control" name="section_why_gemver_description2">{{ $homesettings->section_why_gemver_description2 }}</textarea>
                                <div id="section_why_gemver_description2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="Thumbnail">Section Why Gemver Image 2
                                </label>
                                <input type="file" name="files[]" id="homeIconFiles2" multiple="multiple">
                                <input type="hidden" name="homeImg2" id="homeImg2" value="">
                                <div id="homethumb2-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>

                            <button type="button" class="btn btn-outline-primary" id="save_newHomeBtn" data-action="add">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-primary" id="save_closeHomeBtn" data-action="add">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
@endsection

@section('js')
<script src="{{ url('js/HomeSettingImgJs.js') }}" type="text/javascript"></script>
<script type="text/javascript">



$('body').on('click', '#save_closeHomeBtn', function () {
    save_home($(this),'save_close');
});

$('body').on('click', '#save_newHomeBtn', function () {
    save_home($(this),'save_new');
});

function save_home(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#HomeCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.homesettings.edit') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
           
            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.homesettings.create')}}";
                    if(res.action == 'add'){
                        toastr.success("Home Setting Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Home Setting Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.homesettings.create')}}";
                    if(res.action == 'add'){
                        toastr.success("Home Setting Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Home Setting Updated",'Success',{timeOut: 5000});
                    }
                }
            }

        },
        error: function (data) {
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}


function removeuploadedimg(divId ,inputId, imgName){
    if(confirm("Are you sure you want to remove this file?")){
        $("#"+divId).remove();
        $("#"+inputId).removeAttr('value');
        var filerKit = $("#catIconFiles").prop("jFiler");
        filerKit.reset();
    }
}

</script>

@endsection

