@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/categories') }}">Categories</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Step Popup</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">Step Popup</h4>--}}

                        <div class="action-section">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.attributes.list')->pluck('id')->first(); ?>
                           
                        </div>
                        <div class="table-responsive">
                            <table id="attributesTerm1" class="table zero-configuration customNewtable" style="width:100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                             @php 
                             $no = 1;
                             @endphp 
                             @foreach($steps as $key => $step)  
                             @php 
                                if(isset($step->icon) && $step->icon!=null){
                                    $image = asset('images/steppopup/'.$step->icon);
                                }
                                else{
                                    $image = asset('images/default_avatar.jpg');
                                }
                             @endphp
                             
                            <tr>
                                <th>{{ $no }}</th>
                                <th><img src="{{ $image }}" width="50px" height="50px" alt=""></th>
                                <th>{{ $step->title }}</th>
                                <th>{{ date('d-m-Y h:i A', strtotime($step->created_at)) }}</th>
                                <th><button id="editAttributeTermBtn" class="btn btn-gray text-blue btn-sm" data-toggle="modal" data-target="#StepPopupModal" data-id="{{ $step->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></button></th>
                            </tr>
                            @php 
                             $no = ++$no;
                             @endphp
                            @endforeach
                            </tbody>
                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="StepPopupModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="StepForm" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add Step Popup</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div id="attr-cover-spin" class="cover-spin"></div>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="title" name="title" placeholder="">
                                    <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="">Icon <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" class="form-control-file" id="icon" onchange="" name="icon">
                                    <div id="icon-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="icon_image_show" height="50px" width="50px" style="margin-top: 5px">
                                </div>

                            
                            <div class="form-group">
                                <label class="col-form-label" for="description">Description  <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control input-flat" id="description" name="description" ></textarea>
                                <div id="description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                       
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="step_id" id="step_id">

                        <button type="button" class="btn btn-outline-primary" id="save_newStepBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closeStepBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteStepPopupModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Term?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveAttributeTermSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- Step Popups JS start -->
<script type="text/javascript">
   

    function save_attribute_term(btn,btn_type){
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();
        var attr_id = $(location).attr("href").split('/').pop();
        var action  = $(btn).attr('data-action');

        var formData = new FormData($("#StepForm")[0]);
        formData.append('attr_id',attr_id);
        formData.append('action',action);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/addorupdatestepPopup') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    if (res.errors.title) {
                        $('#title-error').show().text(res.errors.title);
                    } else {
                        $('#title-error').hide();
                    }

                    if (res.errors.icon) {
                        $('#icon-error').show().text(res.errors.icon);
                    } else {
                        $('#icon-error').hide();
                    }

                    if (res.errors.description) {
                        $('#description-error').show().text(res.errors.description);
                    } else {
                        $('#description-error').hide();
                    }
                }

                if(res.status == 200){
                    if(btn_type == 'save_close'){
                        $("#StepPopupModal").modal('hide');
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        if(res.action == 'add'){
                            location.reload(true);
                            toastr.success("Step Popup Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            location.reload(true);
                            toastr.success("Step Popup Updated",'Success',{timeOut: 5000});
                        }
                    }

                    if(btn_type == 'save_new'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $("#StepPopupModal").find('form').trigger('reset');
                        $("#StepPopupModal").find("#save_newStepBtn").removeAttr('data-action');
                        $("#StepPopupModal").find("#save_closeStepBtn").removeAttr('data-action');
                        $("#StepPopupModal").find("#save_newStepBtn").removeAttr('data-id');
                        $("#StepPopupModal").find("#save_closeStepBtn").removeAttr('data-id');
                        $('#step_id').val("");
                        $('#attributetermname-error').html("");
                        $('#attrTermThumb-error').html("");
                        var default_image = "{{ url('images/placeholder_image.png') }}";
                        $('#attrtermthumb_image_show').attr('src', default_image);
                        $("#attributetermname").focus();
                        if(res.action == 'add'){
                           
                            toastr.success("Step Popup Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            
                            toastr.success("Step Popup Updated",'Success',{timeOut: 5000});
                        }
                    }
                }

                if(res.status == 400){
                    $("#StepPopupModal").modal('hide');
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                  
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#StepPopupModal").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
               
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#save_newStepBtn', function () {
        save_attribute_term($(this),'save_new');
    });

    $('body').on('click', '#save_closeStepBtn', function () {
        save_attribute_term($(this),'save_close');
    });

   
    $('body').on('click', '#AddAttrTermBtn', function (e) {
        $("#StepPopupModal").find('.modal-title').html("Add New Step");
    });

    $('body').on('click', '#editAttributeTermBtn', function () {
        var step_id = $(this).attr('data-id');
        $.get("{{ url('admin/steppopup') }}" +'/' + step_id +'/edit', function (data) {
           // $('#StepPopupModal').find('.modal-title').html("Edit " + data.attrterm_name);
            $('#StepPopupModal').find('#save_newStepBtn').attr("data-action","update");
            $('#StepPopupModal').find('#save_closeStepBtn').attr("data-action","update");
            $('#StepPopupModal').find('#save_newStepBtn').attr("data-id",step_id);
            $('#StepPopupModal').find('#save_closeStepBtn').attr("data-id",step_id);
            $('#step_id').val(data.id);
            $('#title').val(data.title);
            $('#description').val(data.description);
            if(data.icon==null){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#icon_image_show').attr('src', default_image);
            }
            else{
                var attrterm_thumb = "{{ url('images/steppopup') }}" +"/" + data.icon;
                $('#icon_image_show').attr('src', attrterm_thumb);
            }
        })
    });

    $('#StepPopupModal').on('shown.bs.modal', function (e) {
        $("#title").focus();
    });

    $('#StepPopupModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find("#save_newStepBtn").removeAttr('data-action');
        $(this).find("#save_closeStepBtn").removeAttr('data-action');
        $(this).find("#save_newStepBtn").removeAttr('data-id');
        $(this).find("#save_closeStepBtn").removeAttr('data-id');
        $('#step_id').val("");
        $('#title-error').html("");
        $('#icon-error').html("");
        var default_image = "{{ url('images/placeholder_image.png') }}";
        $('#icon_image_show').attr('src', default_image);
    });

   

    

    $('#icon').change(function(){
        $('#icon-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#icon-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ url('images/placeholder_image.png') }}";
            $('#icon_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#icon_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<!-- Step Popups JS end -->
@endsection
