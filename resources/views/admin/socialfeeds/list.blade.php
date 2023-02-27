@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Social Feed</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                            @if(isset($action) && $action=='create')
                            Add socialfeed
                            @elseif(isset($action) && $action=='edit')
                            Edit socialfeed
                            @else
                            socialfeed List
                            @endif
                        </h4>--}}

                        <div class="action-section">
                            <div class="d-flex">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.socialfeed.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" id="AddsocialfeedBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}

                           
                            </div>
                        </div>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="socialfeed" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Image</th>
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
                            @include('admin.socialfeeds.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.socialfeeds.create')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeletesocialfeedModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Social Feed</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Social Feed?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="Removesocialfeedubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- socialfeed JS start -->

<script type="text/javascript">

$(document).ready(function() {
    socialfeed_table(true);
    $('#category_id').select2({
        width: '100%',
        placeholder: "Select...",
        allowClear: true,
        autoclose: false,
        closeOnSelect: false,
    });
});

$('body').on('click', '#AddsocialfeedBtn', function () {
    location.href = "{{ route('admin.socialfeed.add') }}";
});

$('body').on('click', '#save_closesocialfeedBtn', function () {
    save_socialfeed($(this),'save_close');
});

$('body').on('click', '#save_newsocialfeedBtn', function () {
    save_socialfeed($(this),'save_new');
});

$('body').on('click', '#saveDraftBtn', function () {
    save_socialfeed($(this),'save_draf');
});

function save_socialfeed(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
    }
    
    var formData = new FormData($("#socialfeedCreateForm")[0]);
    formData.append('action',action);
    formData.append('btn_type',btn_type);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.socialfeed.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();

                if (res.errors.category_id){
                    $('#category-error').show().text(res.errors.category_id);
                } else {
                    $('#category-error').hide();
                }

                if (res.errors.title) {
                    $('#title-error').show().text(res.errors.title);
                } else {
                    $('#title-error').hide();
                }

                if (res.errors.catImg) {
                    $('#catthumb-error').show().text(res.errors.catImg);
                } else {
                    $('#catthumb-error').hide();
                }

                if (res.errors.description) {
                    $('#description-error').show().text(res.errors.description);
                } else {
                    $('#description-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.socialfeed.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Social Feed Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Social Feed Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.socialfeed.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Social Feed Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("socialfeed Updated",'Success',{timeOut: 5000});
                    }
                }
              
            }

            if(res.status == 400){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }

        },
        error: function (data) {
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}

function socialfeed_table(is_clearState=false){
    if(is_clearState){
        $('#socialfeed').DataTable().state.clear();
    }

    $('#socialfeed').DataTable({
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
            "url": "{{ url('admin/allsocialfeedlist') }}",
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
        ],
        "columns": [
            {data: 'sr_no', name: 'sr_no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'blog_thumb', name: 'blog_thumb', orderable: false, searchable: false, class: "text-center"},
            {data: 'title', name: 'title', class: "text-left"},
            {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

function chagesocialfeedStatus(socialfeed_id) {
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/changesocialfeedstatus') }}" +'/' + socialfeed_id,
        success: function (res) {
            if(res.status == 200 && res.action=='deactive'){
                $("#socialfeedtatuscheck_"+socialfeed_id).val(2);
                $("#socialfeedtatuscheck_"+socialfeed_id).prop('checked',false);
                toastr.success("Social Feed Deactivated",'Success',{timeOut: 5000});
            }
            if(res.status == 200 && res.action=='active'){
                $("#socialfeedtatuscheck_"+socialfeed_id).val(1);
                $("#socialfeedtatuscheck_"+socialfeed_id).prop('checked',true);
                toastr.success("Social Feed activated",'Success',{timeOut: 5000});
            }
        },
        error: function (data) {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}



$('body').on('click', '#deletesocialfeedBtn', function (e) {
    // e.preventDefault();
    var socialfeed_id = $(this).attr('data-id');
    $("#DeletesocialfeedModal").find('#Removesocialfeedubmit').attr('data-id',socialfeed_id);
});

$('body').on('click', '#Removesocialfeedubmit', function (e) {
    $('#Removesocialfeedubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var socialfeed_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/socialfeed') }}" +'/' + socialfeed_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeletesocialfeedModal").modal('hide');
                $('#Removesocialfeedubmit').prop('disabled',false);
                $("#Removesocialfeedubmit").find('.removeloadericonfa').hide();
                socialfeed_table();
                toastr.success("Social Feed Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeletesocialfeedModal").modal('hide');
                $('#Removesocialfeedubmit').prop('disabled',false);
                $("#Removesocialfeedubmit").find('.removeloadericonfa').hide();
                socialfeed_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeletesocialfeedModal").modal('hide');
            $('#Removesocialfeedubmit').prop('disabled',false);
            $("#Removesocialfeedubmit").find('.removeloadericonfa').hide();
            socialfeed_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('#DeletesocialfeedModal').on('hidden.bs.modal', function () {
    $(this).find("#Removesocialfeedubmit").removeAttr('data-id');
});

$('body').on('click', '#editsocialfeedBtn', function () {
    var socialfeed_id = $(this).attr('data-id');
    var url = "{{ url('admin/socialfeed') }}" + "/" + socialfeed_id + "/edit";
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
                url: "{{ url('admin/socialfeed/createSlug/') }}"+"/"+value, 
                success: function(data) {
                    $('#slug').val(data);
                }
            });
        });

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
<!-- socialfeed JS end -->
@endsection

