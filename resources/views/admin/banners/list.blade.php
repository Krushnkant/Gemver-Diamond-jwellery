@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Banner</a></li>
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
                            Add Banner
                            @elseif(isset($action) && $action=='edit')
                            Edit Banner
                            @else
                            Banner List
                            @endif
                        </h4>--}}

                        <div class="action-section">
                            <div class="d-flex">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.banners.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" id="AddBannerBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            


                            </div>
                        </div>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Banner" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
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
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && $action=='create')
                            @include('admin.banners.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.banners.edit')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteBannerModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Banner</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Banner?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="Removebannersubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- blog JS start -->
<script type="text/javascript">

$(document).ready(function() {
    banner_table(true);
    $('#BannerInfo').select2({
        width: '100%',
        placeholder: "Select...",
        allowClear: true,
        autoclose: false,
        closeOnSelect: false,
    });

    $('#value').select2({
        width: '100%',
        placeholder: "Select Category",
        allowClear: false
    });
    $('#product').select2({
        width: '100%',
        placeholder: "Select Product",
        allowClear: true
    });



});

$('#BannerInfo').change(function() {
    var bannerInfo = $(this).val();
    if(bannerInfo == 2 || bannerInfo == 3 || bannerInfo == 4 ){
        $('#attr-cover-spin').show();
        $.ajax ({
            type:"POST",
            url: "{{ route('admin.banners.getBannerInfoVal') }}",
            data : {bannerInfo: bannerInfo, "_token": "{{csrf_token()}}"},
            success: function(data) {
                // console.log(data.categories);
                $('#infoBox').html(data.html);
                $("#productDropdownBox").html("");
                if(bannerInfo == 2 || bannerInfo == 3){
                    category_dropdown(data.categories);
                    $('#value').select2({
                        width: '100%',
                        placeholder: "Select Category",
                        allowClear: false
                    });
                }
            },
            complete: function(){
                $('#attr-cover-spin').hide();
            }
        });
    } else {
        $('#infoBox').html('');
        $("#productDropdownBox").html("");
    }
});

function category_dropdown(categories) {
    var list = $("#value");
    $.each(categories, function(index, item) {
        list.append(new Option(item.category_name, item.id));
    });
}

$('body').on("change",".category_dropdown_catalog",function(){
    $("#attr-cover-spin").fadeIn();
    var category_id = $(this).val();

    $.get("{{ url('admin/banners/getproducts') }}" + '/' + category_id, function (data) {
        if (data) {
            var html =`<div class="form-group" id="">
                    <label class="col-form-label" for="product">Select Product</label>
                    <select id="product" name="product" class="">
                        <option></option>
                    </select>
                    <div id="product-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>`;

            $("#productDropdownBox").html(html);
            $.each(data, function(index, item) {
                $("#product").append(new Option(item.product_title, item.id));
            });
            $('#product').select2({
                width: '100%',
                placeholder: "Select Product",
                allowClear: true
            });
            $("#attr-cover-spin").fadeOut();
        } else {
            $("#productDropdownBox").html("");
            $("#attr-cover-spin").fadeOut();
        }
    });
});

$('body').on('click', '#AddBannerBtn', function () {
    location.href = "{{ route('admin.banners.add') }}";
});

$('body').on('click', '#save_closeBannerBtn', function () {
    save_banner($(this),'save_close');
});

$('body').on('click', '#save_newBannerBtn', function () {
    save_banner($(this),'save_new');
});

function save_banner(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#BannerCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.banners.save') }}",
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

                if (res.errors.catImg) {
                    $('#catthumb-error').show().text(res.errors.catImg);
                } else {
                    $('#catthumb-error').hide();
                }

                if (res.errors.bannerImg) {
                    $('#bannerthumb-error').show().text(res.errors.bannerImg);
                } else {
                    $('#bannerthumb-error').hide();
                }

                if (res.errors.value) {
                    if($("#BannerInfo").val() == 2) {
                        $('#value-error').show().text("Please provide a Category");
                    }
                    else if($("#BannerInfo").val() == 3) {
                        $('#value-error').show().text("Please provide a Category");
                    }
                    else if($("#BannerInfo").val() == 4) {
                        $('#value-error').show().text("Please provide a Banner URL");
                    }
                } else {
                    $('#value-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.banners.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Banner Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Banner Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.banners.add')}}";
                    if(res.action == 'add'){
                        toastr.success("Banner Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Banner Updated",'Success',{timeOut: 5000});
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

function banner_table(is_clearState=false){
    if(is_clearState){
        $('#Banner').DataTable().state.clear();
    }

    $('#Banner').DataTable({
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
            "url": "{{ url('admin/allbannerlist') }}",
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
            { "width": "120px", "targets": 6 },
        ],
        "columns": [
            {data: 'sr_no', name: 'sr_no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'banner_thumb', name: 'banner_thumb', orderable: false, searchable: false, class: "text-center"},
            {data: 'title', name: 'title', class: "text-left"},
            {data: 'description', name: 'description', class: "text-left"},
            {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

function chagebannerstatus(blog_id) {
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/changebannerstatus') }}" +'/' + blog_id,
        success: function (res) {
            if(res.status == 200 && res.action=='deactive'){
                $("#bannerstatuscheck_"+blog_id).val(2);
                $("#bannerstatuscheck_"+blog_id).prop('checked',false);
                toastr.success("Banner Deactivated",'Success',{timeOut: 5000});
            }
            if(res.status == 200 && res.action=='active'){
                $("#bannerstatuscheck_"+blog_id).val(1);
                $("#bannerstatuscheck_"+blog_id).prop('checked',true);
                toastr.success("Banner activated",'Success',{timeOut: 5000});
            }
        },
        error: function (data) {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}



$('body').on('click', '#deleteBannerBtn', function (e) {
    // e.preventDefault();
    var banner_id = $(this).attr('data-id');
    $("#DeleteBannerModal").find('#Removebannersubmit').attr('data-id',banner_id);
});

$('body').on('click', '#Removebannersubmit', function (e) {
    $('#Removebannersubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var banner_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/banners') }}" +'/' + banner_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteBannerModal").modal('hide');
                $('#Removebannersubmit').prop('disabled',false);
                $("#Removebannersubmit").find('.removeloadericonfa').hide();
                banner_table();
                toastr.success("Banner Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteBannerModal").modal('hide');
                $('#Removebannersubmit').prop('disabled',false);
                $("#Removebannersubmit").find('.removeloadericonfa').hide();
                banner_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteBannerModal").modal('hide');
            $('#Removebannersubmit').prop('disabled',false);
            $("#Removebannersubmit").find('.removeloadericonfa').hide();
            banner_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('#DeleteBannerModal').on('hidden.bs.modal', function () {
    $(this).find("#Removebannersubmit").removeAttr('data-id');
});

$('body').on('click', '#editBannerBtn', function () {
    var blog_id = $(this).attr('data-id');
    var url = "{{ url('admin/banners') }}" + "/" + blog_id + "/edit";
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

</script>
<!-- blog JS end -->
@endsection

