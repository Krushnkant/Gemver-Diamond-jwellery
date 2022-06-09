@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Blog Category</a></li>
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
                            Add Blog Category
                            @elseif(isset($action) && $action=='edit')
                            Edit Blog Category
                            @else
                            Blog Category List
                            @endif
                        </h4>

                        <div class="action-section">
                            <div class="d-flex">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.blogcategories.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" id="AddBlogCategoryBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}

                           
                            </div>
                        </div>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="BlogCategory" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && $action=='create')
                            @include('admin.blogcategories.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.blogcategories.edit')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteBlogCategoryModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Blog Category</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Blog Category?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveBlogCategorySubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- category JS start -->
<script type="text/javascript">



$(document).ready(function() {
    category_table(true);
});

$('body').on('click', '#AddBlogCategoryBtn', function () {
    location.href = "{{ route('admin.blogcategories.add') }}";
});

$('body').on('click', '#save_closeBlogCategoryBtn', function () {
    save_category($(this),'save_close');
});

$('body').on('click', '#save_newBlogCategoryBtn', function () {
    save_category($(this),'save_new');
});

function save_category(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#BlogCategoryCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.blogcategories.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();

                if (res.errors.category_name) {
                    $('#categoryname-error').show().text(res.errors.category_name);
                } else {
                    $('#categoryname-error').hide();
                }
                
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.blogcategories.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Blog Category Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Blog Category Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.blogcategories.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Blog Category Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Blog Category Updated",'Success',{timeOut: 5000});
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

function category_table(is_clearState=false){
    if(is_clearState){
        $('#BlogCategory').DataTable().state.clear();
    }

    $('#BlogCategory').DataTable({
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
            "url": "{{ url('admin/allblogcategorylist') }}",
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
        ],
        "columns": [
            {data: 'sr_no', name: 'sr_no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'category_name', name: 'category_name', class: "text-left"},
            {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

function chageCategoryStatus(category_id) {
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/changeblogcategorystatus') }}" +'/' + category_id,
        success: function (res) {
            if(res.status == 200 && res.action=='deactive'){
                $("#BlogCategoryStatuscheck_"+category_id).val(2);
                $("#BlogCategoryStatuscheck_"+category_id).prop('checked',false);
                toastr.success("Blog Category Deactivated",'Success',{timeOut: 5000});
            }
            if(res.status == 200 && res.action=='active'){
                $("#BlogCategoryStatuscheck_"+category_id).val(1);
                $("#BlogCategoryStatuscheck_"+category_id).prop('checked',true);
                toastr.success("Blog Category activated",'Success',{timeOut: 5000});
            }
        },
        error: function (data) {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}



$('body').on('click', '#deleteBlogCategoryBtn', function (e) {
    // e.preventDefault();
    var category_id = $(this).attr('data-id');
    $("#DeleteBlogCategoryModal").find('#RemoveBlogCategorySubmit').attr('data-id',category_id);
});

$('body').on('click', '#RemoveBlogCategorySubmit', function (e) {
    $('#RemoveBlogCategorySubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var category_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/blogcategories') }}" +'/' + category_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteBlogCategoryModal").modal('hide');
                $('#RemoveBlogCategorySubmit').prop('disabled',false);
                $("#RemoveBlogCategorySubmit").find('.removeloadericonfa').hide();
                category_table();
                toastr.success("Blog Category Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteBlogCategoryModal").modal('hide');
                $('#RemoveBlogCategorySubmit').prop('disabled',false);
                $("#RemoveBlogCategorySubmit").find('.removeloadericonfa').hide();
                category_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteBlogCategoryModal").modal('hide');
            $('#RemoveBlogCategorySubmit').prop('disabled',false);
            $("#RemoveBlogCategorySubmit").find('.removeloadericonfa').hide();
            category_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('#DeleteBlogCategoryModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveBlogCategorySubmit").removeAttr('data-id');
});

$('body').on('click', '#editBlogCategoryBtn', function () {
    var category_id = $(this).attr('data-id');
    var url = "{{ url('admin/blogcategories') }}" + "/" + category_id + "/edit";
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

$( document ).ready(function() {
    
    @if(isset($action) && $action=='create')

    $("#attribute_id_variation > option").removeAttr("selected");
    $("#attribute_id_variation").val('');
    $("#attribute_id_variation").find('option').prop("disabled", false);
    $("#attribute_id_variation").select2({
        width: '100%',
        multiple: true,
        placeholder: "Select...",
        allowClear: true,
        autoclose: false,
        closeOnSelect: false,
    });

    $("#attribute_id_req_spec > option").removeAttr("selected");
    $("#attribute_id_req_spec").val('');
    $("#attribute_id_req_spec").find('option').prop("disabled", false);
    $('#attribute_id_req_spec').select2({
        width: '100%',
        multiple: true,
        placeholder: "Select...",
        allowClear: true,
        autoclose: false,
        closeOnSelect: false,
    });

    $("#attribute_id_opt_spec > option").removeAttr("selected");
    $("#attribute_id_opt_spec").val('');
    $("#attribute_id_opt_spec").find('option').prop("disabled", false);
    $('#attribute_id_opt_spec').select2({
        width: '100%',
        multiple: true,
        placeholder: "Select...",
        allowClear: true,
        autoclose: false,
        closeOnSelect: false,
    });

  @endif
});



function attribute_id_req_spec(value){
    $("#attribute_id_opt_spec").find('option').prop("disabled", false);
    //this returns all the selected item
    var attribute_id_req_spec= value;
    // console.log(attribute_id_req_spec);
    //Gets the last selected item
    // var lastSelectedItem = e.params.data.id;
    $.each(attribute_id_req_spec , function(index, val) {
        // console.log(index, val);
        $("#attribute_id_opt_spec").find('option[value='+ val +']').prop("disabled", true);
    });
}

function attribute_id_opt_spec(value){
    $("#attribute_id_req_spec").find('option').prop("disabled", false);
    //this returns all the selected item
    var attribute_id_opt_spec= value;
    // console.log(attribute_id_req_spec);
    //Gets the last selected item
    // var lastSelectedItem = e.params.data.id;
    $.each(attribute_id_opt_spec , function(index, val) {
        // console.log(index, val);
        $("#attribute_id_req_spec").find('option[value='+ val +']').prop("disabled", true);
    });
}

$("#attribute_id_req_spec").on("select2:select select2:unselect", function (e) {
    attribute_id_req_spec($(this).val());
});

$("#attribute_id_opt_spec").on("select2:select select2:unselect", function (e) {
    attribute_id_opt_spec($(this).val());
});
</script>
<!-- category JS end -->
@endsection

