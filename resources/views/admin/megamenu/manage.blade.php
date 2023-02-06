@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/megamenus') }}">Mega Menu</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('admin/submenus/'.$megaid) }}">Sub Menu</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $SubMenu->title }}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                             Menu Manage List
                        </h4>--}}
                        <div class="col-lg-12">

                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th colspan="2"><h4 class="text-white mb-0"> Sub Menu Items</h4></th>
                                    <th colspan="1" class="text-right">
                                        <button id="AddMenuManageBtn" class="btn btn-outline-white btn-sm" data-toggle="modal" data-target="#MenuManageModal">
                                            Add New Item
                                        </button>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($MenuCategories as $MenuCategory)    
                                <tr>
                                    <th style="width: 50%">{{ $MenuCategory->title }}</th>
                                    <td>
                                        @if(isset($MenuCategory->icon) && $MenuCategory->icon != "")
                                            <img src="{{ url('images/categoryicon/'.$MenuCategory->icon) }}" width="25px" height="25px" >
                                        @else
                                            <img src="{{ url('images/placeholder_image.png') }}" width="25px" height="25px" >
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <button id="editMenuManageBtn" data-id="{{ $MenuCategory->id }}" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#MenuManageModal">
                                                Edit
                                            </button>

                                            <button id="deleteMenuCategoryBtn" class="btn btn-outline-dark btn-sm " data-toggle="modal" data-target="#DeleteMenuCategoryModal" onclick="" data-id="{{ $MenuCategory->id }}">
                                                Delete
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                              
                                </tbody>
                            </table>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteMenuCategoryModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Sub Menu Item</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Sub Menu Item?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveMenuCategorySubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="MenuManageModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="MenuManageForm" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">Update Sub Menu Item</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div id="attr-cover-spin" class="cover-spin"></div>

                    <div class="form-group" >
                        <label class="col-form-label" for="category_id">Select Category <span class="text-danger">*</span>
                        </label>
                        <select id='category_id' name="category_id" class="form-control">
                        <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="title">Field Title <span class="text-danger">*</span>
                        </label>
                        <input type="hidden" class="form-control input-flat" id="manage_id" name="manage_id" >
                        <input type="hidden" class="form-control input-flat" id="menu_id" name="menu_id" value="{{ $id }}">
                        <input type="text" class="form-control input-flat" id="title" name="title" placeholder="">
                        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="icon">Icon 
                            </label>
                            <input type="file" class="form-control-file" id="icon" name="icon">
                            <div id="icon-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            <img src="{{ url('images/placeholder_image.png') }}" class="" id="icon_image_show" height="50px" width="50px" style="margin-top: 5px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveMenuManageBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('js')
<!-- settings JS start -->
<script type="text/javascript">

    $('#category_id').select2({
        width: '100%',
        placeholder: "Select Category",
        allowClear: true
    }).trigger('change');

    $('body').on('click', '#AddMenuManageBtn', function (e) {
        $('#MenuManageModal').find('form').trigger('reset');
        $('#manage_id').val("");
        var default_image = "{{ asset('images/placeholder_image.png') }}";
        $('#icon_image_show').attr('src', default_image);
        $("#MenuManageModal").find('.modal-title').html("Add Update Sub Menu Item ");

    });

    $('body').on('click', '#editMenuManageBtn', function () {
        var manage_id = $(this).attr('data-id');
        //alert(manage_id);
        $.get("{{ url('admin/submenusmanage') }}" +'/' + manage_id +'/edit', function (data) {
            //console.log(data);
            $('#manage_id').val(data.id);
            $('#category_id').find('option[value="' + data.category_id + '"]').attr('selected', 'selected').trigger('change');
            $('#title').val(data.title);
            if(data.icon==null){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#icon_image_show').attr('src', default_image);
            }else{
                var icon = "{{ url('images/categoryicon') }}" +"/" + data.icon;
                $('#icon_image_show').attr('src', icon);
            }
        })
    });
    
    
    $('body').on('click', '#saveMenuManageBtn', function () {
        $('#saveMenuManageBtn').prop('disabled',true);
        $('#saveMenuManageBtn').find('.loadericonfa').show();
        var formData = new FormData($("#MenuManageForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateMenuManage') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveMenuManageBtn').prop('disabled',false);
                    $('#saveMenuManageBtn').find('.loadericonfa').hide();
                    if (res.errors.title) {
                        $('#title-error').show().text(res.errors.title);
                    } else {
                        $('#title-error').hide();
                    }
                }

                if(res.status == 200){
                    $("#MenuManageModal").modal('hide');
                    $('#saveMenuManageBtn').prop('disabled',false);
                    $('#saveMenuManageBtn').find('.loadericonfa').hide();
                   // $("#MenuManageVal").html(res.title + " %");
                    location.reload();
                    toastr.success("Add Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#MenuManageModal").modal('hide');
                    $('#saveMenuManageBtn').prop('disabled',false);
                    $('#saveMenuManageBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#MenuManageModal").modal('hide');
                $('#saveMenuManageBtn').prop('disabled',false);
                $('#saveMenuManageBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    
    $('#MenuManageModal').on('shown.bs.modal', function (e) {
        $("#title").focus();
    });

    $('#icon').change(function(){
        $('#icon-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#icon-error').show().text("Please provide a Valid Extension Logo(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
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

    $('body').on('click', '#viewSubMenuBtn', function () {
        var manage_id = $(this).attr('data-id');
        var url = "{{ url('admin/submenus') }}" + "/" + manage_id;
        window.open(url,"_blank");
    });

    $('#category_id').on('change',function(){
        var optionsText = this.options[this.selectedIndex].text;
        $('#title').val(optionsText);
    });

$('body').on('click', '#deleteMenuCategoryBtn', function (e) {
    // e.preventDefault();
    var Menu_id = $(this).attr('data-id');
 

    $("#DeleteMenuCategoryModal").find('#RemoveMenuCategorySubmit').attr('data-id',Menu_id);
});

$('#DeleteMenuCategoryModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveMenuCategorySubmit").removeAttr('data-id');
});

$('body').on('click', '#RemoveMenuCategorySubmit', function (e) {
    $('#RemoveMenuCategorySubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var Menu_id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/submenusmanage') }}" +'/' + Menu_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteMenuCategoryModal").modal('hide');
                $('#RemoveMenuCategorySubmit').prop('disabled',false);
                $("#RemoveMenuCategorySubmit").find('.removeloadericonfa').hide();
                
                toastr.success("Menu Deleted",'Success',{timeOut: 5000});
                location.reload(true);
            }

            if(res.status == 400){
                $("#DeleteMenuCategoryModal").modal('hide');
                $('#RemoveMenuCategorySubmit').prop('disabled',false);
                $("#RemoveMenuCategorySubmit").find('.removeloadericonfa').hide();
               
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteMenuCategoryModal").modal('hide');
            $('#RemoveMenuCategorySubmit').prop('disabled',false);
            $("#RemoveMenuCategorySubmit").find('.removeloadericonfa').hide();
            
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

</script>
<!-- settings JS end -->
@endsection
