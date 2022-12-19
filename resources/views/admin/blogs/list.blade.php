@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Blog</a></li>
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
                            Add Blog
                            @elseif(isset($action) && $action=='edit')
                            Edit Blog
                            @else
                            Blog List
                            @endif
                        </h4>--}}

                        <div class="action-section">
                            <div class="d-flex">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.blogs.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" id="AddBlogBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}

                           
                            </div>
                        </div>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Blog" class="table zero-configuration customNewtable" style="width:100%">
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
                            @include('admin.blogs.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.blogs.edit')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteBlogModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Blog</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Blog?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveBlogSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- blog JS start -->
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    

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
   


    blog_table(true);
    $('#category_id').select2({
        width: '100%',
        placeholder: "Select...",
        allowClear: true,
        autoclose: false,
        closeOnSelect: false,
    });
});

$('body').on('click', '#AddBlogBtn', function () {
    location.href = "{{ route('admin.blogs.add') }}";
});

$('body').on('click', '#save_closeBlogBtn', function () {
    save_blog($(this),'save_close');
});

$('body').on('click', '#save_newBlogBtn', function () {
    save_blog($(this),'save_new');
});

function save_blog(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
    }
    
    var formData = new FormData($("#BlogCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.blogs.save') }}",
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
                    location.href="{{ route('admin.blogs.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Blog Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Blog Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.blogs.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Blog Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Blog Updated",'Success',{timeOut: 5000});
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

function blog_table(is_clearState=false){
    if(is_clearState){
        $('#Blog').DataTable().state.clear();
    }

    $('#Blog').DataTable({
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
            "url": "{{ url('admin/allbloglist') }}",
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

function chageBlogStatus(blog_id) {
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/changeblogstatus') }}" +'/' + blog_id,
        success: function (res) {
            if(res.status == 200 && res.action=='deactive'){
                $("#BlogStatuscheck_"+blog_id).val(2);
                $("#BlogStatuscheck_"+blog_id).prop('checked',false);
                toastr.success("Blog Deactivated",'Success',{timeOut: 5000});
            }
            if(res.status == 200 && res.action=='active'){
                $("#BlogStatuscheck_"+blog_id).val(1);
                $("#BlogStatuscheck_"+blog_id).prop('checked',true);
                toastr.success("Blog activated",'Success',{timeOut: 5000});
            }
        },
        error: function (data) {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}



$('body').on('click', '#deleteBlogBtn', function (e) {
    // e.preventDefault();
    var blog_id = $(this).attr('data-id');
    $("#DeleteBlogModal").find('#RemoveBlogSubmit').attr('data-id',blog_id);
});

$('body').on('click', '#RemoveBlogSubmit', function (e) {
    $('#RemoveBlogSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var blog_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/blogs') }}" +'/' + blog_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteBlogModal").modal('hide');
                $('#RemoveBlogSubmit').prop('disabled',false);
                $("#RemoveBlogSubmit").find('.removeloadericonfa').hide();
                blog_table();
                toastr.success("Blog Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteBlogModal").modal('hide');
                $('#RemoveBlogSubmit').prop('disabled',false);
                $("#RemoveBlogSubmit").find('.removeloadericonfa').hide();
                blog_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteBlogModal").modal('hide');
            $('#RemoveBlogSubmit').prop('disabled',false);
            $("#RemoveBlogSubmit").find('.removeloadericonfa').hide();
            blog_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('#DeleteBlogModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveBlogSubmit").removeAttr('data-id');
});

$('body').on('click', '#editBlogBtn', function () {
    var blog_id = $(this).attr('data-id');
    var url = "{{ url('admin/blogs') }}" + "/" + blog_id + "/edit";
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
                url: "{{ url('admin/blogs/createSlug/') }}"+"/"+value, 
                success: function(data) {
                    $('#slug').val(data);
                }
            });
        });

</script>
<!-- blog JS end -->
@endsection

