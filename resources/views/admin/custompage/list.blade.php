@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Custom Page</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                       

                        <div class="action-section">
                            <div class="d-flex">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.custompage.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" id="AddcustompageBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}

                           
                            </div>
                        </div>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="custompage" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && $action=='create')
                            @include('admin.custompage.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.custompage.create')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeletecustompageModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Custom Page</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Custom Page?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemovecustompageSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- custompage JS start -->

<script type="text/javascript">

$(document).ready(function() {
    

  

    custompage_table(true);
   
});

$('body').on('click', '#AddcustompageBtn', function () {
    location.href = "{{ route('admin.custompage.add') }}";
});

$('body').on('click', '#save_closecustompageBtn', function () {
    save_custompage($(this),'save_close');
});

$('body').on('click', '#save_newcustompageBtn', function () {
    save_custompage($(this),'save_new');
});

$('body').on('click', '#saveDraftBtn', function () {
    save_custompage($(this),'save_draf');
});

function save_custompage(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
    }
    
    var formData = new FormData($("#custompageCreateForm")[0]);
    formData.append('action',action);
    formData.append('btn_type',btn_type);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.custompage.addorupdatecustompage') }}",
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

                if (res.errors.description) {
                    $('#description-error').show().text(res.errors.description);
                } else {
                    $('#description-error').hide();
                }

                if (res.errors.slug) {
                    $('#slug-error').show().text(res.errors.slug);
                } else {
                    $('#slug-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.custompage.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Custom Page Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Custom Page Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.custompage.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Custom Page Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("custompage Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_draf'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.custompage.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Custom Page Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Custom Page Updated",'Success',{timeOut: 5000});
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

function custompage_table(is_clearState=false){
    if(is_clearState){
        $('#custompage').DataTable().state.clear();
    }

    $('#custompage').DataTable({
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
            "url": "{{ url('admin/allcustompagelist') }}",
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
            { "width": "120px", "targets": 4 },
        ],
        "columns": [
            {data: 'sr_no', name: 'sr_no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'title', name: 'title', class: "text-left"},
            {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

function chagecustompageStatus(custompage_id) {
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/changecustompagestatus') }}" +'/' + custompage_id,
        success: function (res) {
            if(res.status == 200 && res.action=='deactive'){
                $("#custompageStatuscheck_"+custompage_id).val(2);
                $("#custompageStatuscheck_"+custompage_id).prop('checked',false);
                toastr.success("custompage Deactivated",'Success',{timeOut: 5000});
            }
            if(res.status == 200 && res.action=='active'){
                $("#custompageStatuscheck_"+custompage_id).val(1);
                $("#custompageStatuscheck_"+custompage_id).prop('checked',true);
                toastr.success("custompage activated",'Success',{timeOut: 5000});
            }
        },
        error: function (data) {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}



$('body').on('click', '#deletecustompageBtn', function (e) {
    // e.preventDefault();
    var custompage_id = $(this).attr('data-id');
    $("#DeletecustompageModal").find('#RemovecustompageSubmit').attr('data-id',custompage_id);
});

$('body').on('click', '#RemovecustompageSubmit', function (e) {
    $('#RemovecustompageSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var custompage_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/custompages') }}" +'/' + custompage_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeletecustompageModal").modal('hide');
                $('#RemovecustompageSubmit').prop('disabled',false);
                $("#RemovecustompageSubmit").find('.removeloadericonfa').hide();
                custompage_table();
                toastr.success("Custom Page Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeletecustompageModal").modal('hide');
                $('#RemovecustompageSubmit').prop('disabled',false);
                $("#RemovecustompageSubmit").find('.removeloadericonfa').hide();
                custompage_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeletecustompageModal").modal('hide');
            $('#RemovecustompageSubmit').prop('disabled',false);
            $("#RemovecustompageSubmit").find('.removeloadericonfa').hide();
            custompage_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('#DeletecustompageModal').on('hidden.bs.modal', function () {
    $(this).find("#RemovecustompageSubmit").removeAttr('data-id');
});

$('body').on('click', '#editcustompageBtn', function () {
    var custompage_id = $(this).attr('data-id');
    var url = "{{ url('admin/custompage') }}" + "/" + custompage_id + "/edit";
    window.open(url,"_blank");
});

function removeuploadedimg(divId ,inputId, imgName){
    if(confirm("Are you sure you want to remove this file?")){
        $("#"+divId).remove();
        $("#"+inputId).removeAttr('value');
        var filerKit = $("#catIconFiles").prop("jFiler");
        filerKit.reset();
    }
}

$(document).on('change', '#title', function () {
            var value = this.value;
            $.ajax({
                type:"get",
                async: false,
                url: "{{ url('admin/custompage/createSlug/') }}"+"/"+value, 
                success: function(data) {
                    $('#slug').val(data);
                }
            });
        });

  // CKEDITOR.replace('description', {
    //     filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
    //     filebrowserUploadMethod: 'form'
    // });

    //CKEDITOR.config.height = '500';
  

   CKEDITOR.replace('description',{
    toolbar: [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
    { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
 
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
    '/',
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
    { name: 'others', items: [ '-' ] },
    { name: 'about', items: [ 'About' ] }
],
    filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});

CKEDITOR.config.height = '500';        

</script>
<!-- custompage JS end -->
@endsection
