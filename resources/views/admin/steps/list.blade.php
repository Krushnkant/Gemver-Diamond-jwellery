@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Step</a></li>
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
                            @if(isset($action) && $action=='create')
                            Add Step
                            @elseif(isset($action) && $action=='edit')
                            Edit Step
                            @elseif(isset($action) && $action=='stepone')
                            Step One
                            @elseif(isset($action) && $action=='steptwo')
                            Step Two
                            @elseif(isset($action) && $action=='stepthree')
                            Step Three
                            @elseif(isset($action) && $action=='stepfour')
                            Step Four
                            @else
                            Step List
                            @endif
                        </h4>
                        @if(isset($action) && $action=='list')
                        <div class="action-section">
                            <div class="d-flex">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.steps.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" id="AddStepBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            </div>
                        </div>
                        @endif
                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Step" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Step</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Step</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && ($action=='create' || $action=='edit') )
                            @include('admin.steps.create')
                        @endif
                        @if(isset($action) && ($action=='stepone'))
                            @include('admin.steps.stepone')
                        @endif
                        @if(isset($action) && ($action=='steptwo'))
                            @include('admin.steps.steptwo')
                        @endif
                        @if(isset($action) && ($action=='stepthree'))
                            @include('admin.steps.stepthree')
                        @endif
                        @if(isset($action) && ($action=='stepfour'))
                            @include('admin.steps.stepfour')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteStepModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Step</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Step?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveStepSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- step JS start -->
<script type="text/javascript">

$(document).ready(function() {
    step_table(true);
});

$('body').on('click', '#AddStepBtn', function () {
    location.href = "{{ route('admin.steps.add') }}";
});

$('body').on('click', '#save_closeStepBtn', function () {
    save_step($(this),'save_close');
});

$('body').on('click', '#save_newStepBtn', function () {
    save_step($(this),'save_new');
});



function save_step(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#StepCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.steps.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();

                if (res.errors.main_title) {
                    $('#main_title-error').show().text(res.errors.main_title);
                } else {
                    $('#main_title-error').hide();
                }

                if (res.errors.main_image) {
                    $('#main_image-error').show().text(res.errors.main_image);
                } else {
                    $('#main_image-error').hide();
                }

                if (res.errors.main_shotline) {
                    $('#main_shotline-error').show().text(res.errors.main_shotline);
                } else {
                    $('#main_shotline-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Step Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Step Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step Updated",'Success',{timeOut: 5000});
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

$('body').on('click', '#save_closeStepOneBtn', function () {
    save_stepone($(this),'save_close');
});

function save_stepone(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#StepOneCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.stepone.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                if (res.errors.step1_title) {
                    $('#step1_title-error').show().text(res.errors.step1_title);
                } else {
                    $('#step1_title-error').hide();
                }
                if (res.errors.step1_shotline) {
                    $('#step1_shotline-error').show().text(res.errors.step1_shotline);
                } else {
                    $('#step1_shotline-error').hide();
                }
                if (res.errors.step1_icon) {
                    $('#step1_icon-error').show().text(res.errors.step1_icon);
                } else {
                    $('#step1_icon-error').hide();
                }
                if (res.errors.step1_header_image) {
                    $('#step1_header_image-error').show().text(res.errors.step1_header_image);
                } else {
                    $('#step1_header_image-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Step One Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step One Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Step One Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step One Updated",'Success',{timeOut: 5000});
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


$('body').on('click', '#save_closeStepTwoBtn', function () {
    save_steptwo($(this),'save_close');
});

function save_steptwo(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#StepTwoCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.steptwo.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                if (res.errors.step2_title) {
                    $('#step2_title-error').show().text(res.errors.step2_title);
                } else {
                    $('#step2_title-error').hide();
                }
                if (res.errors.step2_shotline) {
                    $('#step2_shotline-error').show().text(res.errors.step2_shotline);
                } else {
                    $('#step2_shotline-error').hide();
                }
                if (res.errors.step2_icon) {
                    $('#step2_icon-error').show().text(res.errors.step2_icon);
                } else {
                    $('#step2_icon-error').hide();
                }
                if (res.errors.step2_header_image) {
                    $('#step2_header_image-error').show().text(res.errors.step2_header_image);
                } else {
                    $('#step2_header_image-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Step Two Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step Two Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Step Two Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step Two Updated",'Success',{timeOut: 5000});
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


$('body').on('click', '#save_closeStepThreeBtn', function () {
    save_stepthree($(this),'save_close');
});

function save_stepthree(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#StepThreeCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.stepthree.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                if (res.errors.step3_title) {
                    $('#step3_title-error').show().text(res.errors.step3_title);
                } else {
                    $('#step3_title-error').hide();
                }
                if (res.errors.step3_shotline) {
                    $('#step3_shotline-error').show().text(res.errors.step3_shotline);
                } else {
                    $('#step3_shotline-error').hide();
                }
                if (res.errors.step3_icon) {
                    $('#step3_icon-error').show().text(res.errors.step3_icon);
                } else {
                    $('#step3_icon-error').hide();
                }
                if (res.errors.step3_header_image) {
                    $('#step3_header_image-error').show().text(res.errors.step3_header_image);
                } else {
                    $('#step3_header_image-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Step Three Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step Three Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Step Three Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step Three Updated",'Success',{timeOut: 5000});
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

$('body').on('click', '#save_closeStepFourBtn', function () {
    save_stepfour($(this),'save_close');
});

function save_stepfour(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#StepFourCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.stepfour.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                if (res.errors.step4_title) {
                    $('#step4_title-error').show().text(res.errors.step4_title);
                } else {
                    $('#step4_title-error').hide();
                }
                if (res.errors.step4_shotline) {
                    $('#step4_shotline-error').show().text(res.errors.step4_shotline);
                } else {
                    $('#step4_shotline-error').hide();
                }
                if (res.errors.step4_icon) {
                    $('#step4_icon-error').show().text(res.errors.step4_icon);
                } else {
                    $('#step4_icon-error').hide();
                }
                if (res.errors.step4_header_image) {
                    $('#step4_header_image-error').show().text(res.errors.step4_header_image);
                } else {
                    $('#step4_header_image-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Step Four Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step Four Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.steps.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Step Four Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Step Four Updated",'Success',{timeOut: 5000});
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

function step_table(is_clearState=false){
    if(is_clearState){
        $('#Step').DataTable().state.clear();
    }

    $('#Step').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,
        'stateSave': function(){
            if(is_clearState){
                return false;
            }
            else{
                return true;
            }
        },
        "ajax":{
            "url": "{{ url('admin/allsteplist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}' },
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "50px", "targets": 0 },
            { "width": "120px", "targets": 1 },
            { "width": "170px", "targets": 2 },
            { "width": "100px", "targets": 3 },
            { "width": "70px", "targets": 4 },
            { "width": "120px", "targets": 5 },
            { "width": "70px", "targets": 6 },
        ],
        "columns": [
            {data: 'sr_no', name: 'sr_no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'category', name: 'category', orderable: false, searchable: false, class: "text-center"},
            {data: 'title', name: 'title', class: "text-left"},
            {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
            {data: 'step', name: 'step', orderable: false, searchable: false, class: "text-center"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

function chageStepStatus(step_id) {
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/changestepstatus') }}" +'/' + step_id,
        success: function (res) {
            if(res.status == 200 && res.action=='deactive'){
                $("#StepStatuscheck_"+step_id).val(2);
                $("#StepStatuscheck_"+step_id).prop('checked',false);
                toastr.success("Step Deactivated",'Success',{timeOut: 5000});
            }
            if(res.status == 200 && res.action=='active'){
                $("#StepStatuscheck_"+step_id).val(1);
                $("#StepStatuscheck_"+step_id).prop('checked',true);
                toastr.success("Step activated",'Success',{timeOut: 5000});
            }
        },
        error: function (data) {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}



$('body').on('click', '#deleteStepBtn', function (e) {
    // e.preventDefault();
    var step_id = $(this).attr('data-id');
    $("#DeleteStepModal").find('#RemoveStepSubmit').attr('data-id',step_id);
});

$('body').on('click', '#RemoveStepSubmit', function (e) {
    $('#RemoveStepSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var step_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/steps') }}" +'/' + step_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteStepModal").modal('hide');
                $('#RemoveStepSubmit').prop('disabled',false);
                $("#RemoveStepSubmit").find('.removeloadericonfa').hide();
                step_table();
                toastr.success("Step Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteStepModal").modal('hide');
                $('#RemoveStepSubmit').prop('disabled',false);
                $("#RemoveStepSubmit").find('.removeloadericonfa').hide();
                step_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteStepModal").modal('hide');
            $('#RemoveStepSubmit').prop('disabled',false);
            $("#RemoveStepSubmit").find('.removeloadericonfa').hide();
            step_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('#DeleteStepModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveStepSubmit").removeAttr('data-id');
});

$('body').on('click', '#editStepBtn', function () {
    var step_id = $(this).attr('data-id');
    var url = "{{ url('admin/steps') }}" + "/" + step_id + "/edit";
    window.open(url,"_blank");
});

$('body').on('click', '#addStepOneBtn', function () {
    var step_id = $(this).attr('data-id');
    var url = "{{ url('admin/stepone') }}" + "/" + step_id + "/edit";
    window.open(url,"_blank");
});

$('body').on('click', '#addStepTwoBtn', function () {
    var step_id = $(this).attr('data-id');
    var url = "{{ url('admin/steptwo') }}" + "/" + step_id + "/edit";
    window.open(url,"_blank");
});

$('body').on('click', '#addStepThreeBtn', function () {
    var step_id = $(this).attr('data-id');
    var url = "{{ url('admin/stepthree') }}" + "/" + step_id + "/edit";
    window.open(url,"_blank");
});

$('body').on('click', '#addStepFourBtn', function () {
    var step_id = $(this).attr('data-id');
    var url = "{{ url('admin/stepfour') }}" + "/" + step_id + "/edit";
    window.open(url,"_blank");
});

$('#main_image').change(function(){
        $('#main_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#main_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#main_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#main_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step1_icon').change(function(){
        $('#step1_icon-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step1_icon-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step1_icon_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step1_icon_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step1_header_image').change(function(){
        $('#step1_header_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step1_header_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step1_header_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step1_header_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step1_section1_image').change(function(){
        $('#step1_section1_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step1_section1_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step1_section1_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step1_section1_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step1_section2_image1').change(function(){
        $('#step1_section2_image1-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step1_section2_image1-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step1_section2_image1_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step1_section2_image1_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step1_section2_image2').change(function(){
        $('#step1_section2_image2-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step1_section2_image2-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step1_section2_image2_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step1_section2_image2_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});




$('#step2_icon').change(function(){
        $('#step2_icon-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step2_icon-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step2_icon_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step2_icon_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step2_header_image').change(function(){
        $('#step2_header_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step2_header_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step2_header_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step2_header_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step2_section1_image').change(function(){
        $('#step2_section1_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step2_section1_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step2_section1_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step2_section1_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step2_section2_image').change(function(){
        $('#step2_section2_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step2_section2_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step2_section2_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step2_section2_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step2_section4_image').change(function(){
        $('#step2_section4_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step2_section4_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step2_section4_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step2_section4_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step2_section5_image').change(function(){
        $('#step2_section5_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step2_section5_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step2_section5_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step2_section5_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step3_icon').change(function(){
        $('#step3_icon-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_icon-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_icon_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_icon_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step3_header_image').change(function(){
        $('#step3_header_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_header_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_header_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_header_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});


$('#step3_section2_image').change(function(){
        $('#step3_section2_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_section2_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_section2_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_section2_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step3_section3_image').change(function(){
        $('#step3_section3_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_section3_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_section3_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_section3_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step3_section4_image').change(function(){
        $('#step3_section4_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_section4_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_section4_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_section4_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step3_section5_image').change(function(){
        $('#step3_section5_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_section5_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_section5_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_section5_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step3_section6_image').change(function(){
        $('#step3_section6_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_section6_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_section6_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_section6_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step3_section8_image').change(function(){
        $('#step3_section8_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_section8_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_section8_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_section8_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});


$('#step3_section9_image').change(function(){
        $('#step3_section9_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_section9_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_section9_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_section9_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step3_section10_image').change(function(){
        $('#step3_section10_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_section10_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_section10_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_section10_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step3_section11_image').change(function(){
        $('#step3_section11_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step3_section11_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step3_section11_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step3_section11_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step4_icon').change(function(){
        $('#step4_icon-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step4_icon-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step4_icon_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step4_icon_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step4_header_image').change(function(){
        $('#step4_header_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step4_header_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step4_header_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step4_header_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step4_section2_image').change(function(){
        $('#step4_section2_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step4_section2_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step4_section2_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step4_section2_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});


$('#step4_section3_image').change(function(){
        $('#step4_section3_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step4_section3_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step4_section3_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step4_section3_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step4_section5_image').change(function(){
        $('#step4_section5_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step4_section5_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step4_section5_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step4_section5_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step4_section9_image').change(function(){
        $('#step4_section9_image-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step4_section9_image-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step4_section9_image_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step4_section9_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step4_section11_image1').change(function(){
        $('#step4_section11_image1-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step4_section11_image1-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step4_section11_image1_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step4_section11_image1_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

$('#step4_section11_image2').change(function(){
        $('#step4_section11_image2-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#step4_section11_image2-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#step4_section11_image2_show').attr('src', default_image);
        }else{
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#step4_section11_image2_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
});

</script>
<!-- step JS end -->
@endsection

