@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">User List</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">User List</h4>--}}

                        <div class="action-section row">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <?php $page_id = \App\Models\ProjectPage::where('route_url',\Illuminate\Support\Facades\Route::currentRouteName())->pluck('id')->first(); ?>
                                @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UserModal" id="AddUserBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                @endif
                                {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                            </div>
                            <div class="custom-tab-1 col-lg-4">
                                <ul class="nav nav-tabs nav-fill mb-3">
                                    <li class="nav-item user_page_tabs" data-tab="all_user_tab"><a class="nav-link active show" data-toggle="tab" href="">All</a>
                                    </li>
                                    <li class="nav-item user_page_tabs" data-tab="active_user_tab"><a class="nav-link" data-toggle="tab" href="">Active</a>
                                    </li>
                                    <li class="nav-item user_page_tabs" data-tab="deactive_user_tab"><a class="nav-link" data-toggle="tab" href="">Deactive</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        

                        <div class="tab-pane fade show active table-responsive" id="all_user_tab">
                            <table id="all_users" class="table zero-configuration customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Profile</th>
                                    <th>Contact Info</th>
                                    <th>Login Info</th>
                                    <th>User Status</th>
                                    <th>Registration Date</th>
                                    <th>Other</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Profile</th>
                                    <th>Contact Info</th>
                                    <th>Login Info</th>
                                    <th>User Status</th>
                                    <th>Registration Date</th>
                                    <th>Other</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="UserModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="userform" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="attr-cover-spin" class="cover-spin"></div>
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label class="col-form-label" for="profilePic">Profile Image
                            </label>
                            <input type="file" class="form-control-file" id="profile_pic" onchange="" name="profile_pic">
                            <div id="profilepic-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            <img src="{{ asset('images/default_avatar.jpg') }}" class="" id="profilepic_image_show" height="50px" width="50px" style="margin-top: 5px">
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="full_name">Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="full_name" name="full_name" placeholder="">
                            <div id="fullname-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="mobile_no">Mobile No <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="mobile_no" name="mobile_no" placeholder="">
                            <div id="mobileno-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="email">E-mail <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control input-flat" id="email" name="email" placeholder="">
                            <div id="email-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="password">Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control input-flat" id="password" name="password" placeholder="">
                            <div id="password-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="gender">Gender
                            </label>
                            <div>
                                <label class="radio-inline mr-3"><input type="radio" name="gender" value="1" checked> Female</label>
                                <label class="radio-inline mr-3"><input type="radio" name="gender" value="2"> Male</label>
                                <label class="radio-inline mr-3"><input type="radio" name="gender" value="3"> Other</label>
                            </div>
                            <div id="gender-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="dob">Date of Birth <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control custom_date_picker" id="dob" name="dob" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-end-date="0d"> <span class="input-group-append"><span class="input-group-text"><i class="mdi mdi-calendar-check"></i></span></span>
                                <div id="dob-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" id="user_id">
{{--                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>--}}
                        <button type="button" class="btn btn-outline-primary" id="save_newUserBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closeUserBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteUserModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove User</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this User?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveUserSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- user list JS start -->
<script type="text/javascript">
    $(document).ready(function() {
        user_page_tabs('',true);
    });

    function get_users_page_tabType(){
        var tab_type;
        $('.user_page_tabs').each(function() {
            var thi = $(this);
            if($(thi).find('a').hasClass('show')){
                tab_type = $(thi).attr('data-tab');
            }
        });
        return tab_type;
    }

    function save_user(btn,btn_type){
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();

        var action  = $(btn).attr('data-action');

        var formData = new FormData($("#userform")[0]);

        formData.append('action',action);

        var tab_type = get_users_page_tabType();

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/addorupdateuser') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    if (res.errors.profile_pic) {
                        $('#profilepic-error').show().text(res.errors.profile_pic);
                    } else {
                        $('#profilepic-error').hide();
                    }

                    if (res.errors.full_name) {
                        $('#fullname-error').show().text(res.errors.full_name);
                    } else {
                        $('#fullname-error').hide();
                    }

                    if (res.errors.mobile_no) {
                        $('#mobileno-error').show().text(res.errors.mobile_no);
                    } else {
                        $('#mobileno-error').hide();
                    }

                    if (res.errors.email) {
                        $('#email-error').show().text(res.errors.email);
                    } else {
                        $('#email-error').hide();
                    }

                    if (res.errors.password) {
                        $('#password-error').show().text(res.errors.password);
                    } else {
                        $('#password-error').hide();
                    }

                    if (res.errors.dob) {
                        $('#dob-error').show().text(res.errors.dob);
                    } else {
                        $('#dob-error').hide();
                    }
                }

                if(res.status == 200){
                    if(btn_type == 'save_close'){
                        $("#UserModal").modal('hide');
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        if(res.action == 'add'){
                            user_page_tabs(tab_type,true);
                            toastr.success("User Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            user_page_tabs(tab_type);
                            toastr.success("User Updated",'Success',{timeOut: 5000});
                        }
                    }

                    if(btn_type == 'save_new'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $("#UserModal").find('form').trigger('reset');
                        $("#UserModal").find("#save_newUserBtn").removeAttr('data-action');
                        $("#UserModal").find("#save_closeUserBtn").removeAttr('data-action');
                        $("#UserModal").find("#save_newUserBtn").removeAttr('data-id');
                        $("#UserModal").find("#save_closeUserBtn").removeAttr('data-id');
                        $('#user_id').val("");
                        $('#profilepic-error').html("");
                        $('#fullname-error').html("");
                        $('#mobileno-error').html("");
                        $('#email-error').html("");
                        $('#password-error').html("");
                        $('#dob-error').html("");
                        $('#gender-error').html("");
                        var default_image = "{{ asset('images/default_avatar.jpg') }}";
                        $('#profilepic_image_show').attr('src', default_image);
                        $("#full_name").focus();
                        if(res.action == 'add'){
                            user_page_tabs(tab_type,true);
                            toastr.success("User Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            user_page_tabs(tab_type);
                            toastr.success("User Updated",'Success',{timeOut: 5000});
                        }
                    }
                }

                if(res.status == 400){
                    $("#UserModal").modal('hide');
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    user_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#UserModal").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                user_page_tabs(tab_type);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#save_newUserBtn', function () {
        save_user($(this),'save_new');
    });

    $('body').on('click', '#save_closeUserBtn', function () {
        save_user($(this),'save_close');
    });

    $('#UserModal').on('shown.bs.modal', function (e) {
        $("#full_name").focus();
    });

    $('#profile_pic').change(function(){
        $('#profilepic-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#profilepic-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ asset('images/default_avatar.jpg') }}";
            $('#profilepic_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#profilepic_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#UserModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find("#save_newUserBtn").removeAttr('data-action');
        $(this).find("#save_closeUserBtn").removeAttr('data-action');
        $(this).find("#save_newUserBtn").removeAttr('data-id');
        $(this).find("#save_closeUserBtn").removeAttr('data-id');
        $('#user_id').val("");
        $('#profilepic-error').html("");
        $('#fullname-error').html("");
        $('#mobileno-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");
        $('#dob-error').html("");
        $('#gender-error').html("");
        var default_image = "{{ asset('images/default_avatar.jpg') }}";
        $('#profilepic_image_show').attr('src', default_image);
    });

    $('#DeleteUserModal').on('hidden.bs.modal', function () {
        $(this).find("#RemoveUserSubmit").removeAttr('data-id');
    });

    function user_page_tabs(tab_type='',is_clearState=false) {
        if(is_clearState){
            $('#all_users').DataTable().state.clear();
        }

        $('#all_users').DataTable({
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
                "url": "{{ url('admin/alluserslist') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: '{{ csrf_token() }}' ,tab_type: tab_type},
                // "dataSrc": ""
            },
            'columnDefs': [
                { "width": "50px", "targets": 0 },
                { "width": "145px", "targets": 1 },
                { "width": "165px", "targets": 2 },
                { "width": "230px", "targets": 3 },
                { "width": "75px", "targets": 4 },
                { "width": "120px", "targets": 5 },
                { "width": "115px", "targets": 6 },
            ],
            "columns": [
                {data: 'id', name: 'id', class: "text-center", orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'profile_pic', name: 'profile_pic', class: "text-center multirow"},
                {data: 'contact_info', name: 'contact_info', class: "text-left multirow", orderable: false},
                {data: 'login_info', name: 'login_info', class: "text-left multirow", orderable: false},
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }

    $(".user_page_tabs").click(function() {
        var tab_type = $(this).attr('data-tab');
        user_page_tabs(tab_type,true);
    });

    function changeUserStatus(user_id) {
        var tab_type = get_users_page_tabType();

        $.ajax({
            type: 'GET',
            url: "{{ url('admin/changeuserstatus') }}" +'/' + user_id,
            success: function (res) {
                if(res.status == 200 && res.action=='deactive'){
                    $("#Userstatuscheck_"+user_id).val(2);
                    $("#Userstatuscheck_"+user_id).prop('checked',false);
                    user_page_tabs(tab_type);
                    toastr.success("User Deactivated",'Success',{timeOut: 5000});
                }
                if(res.status == 200 && res.action=='active'){
                    $("#Userstatuscheck_"+user_id).val(1);
                    $("#Userstatuscheck_"+user_id).prop('checked',true);
                    user_page_tabs(tab_type);
                    toastr.success("User activated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#AddUserBtn', function (e) {
        $("#UserModal").find('.modal-title').html("Add User");
    });

    $('body').on('click', '#editUserBtn', function () {
        var user_id = $(this).attr('data-id');
        $.get("{{ url('admin/users') }}" +'/' + user_id +'/edit', function (data) {
            $('#UserModal').find('.modal-title').html("Edit User");
            $('#UserModal').find('#save_closeUserBtn').attr("data-action","update");
            $('#UserModal').find('#save_newUserBtn').attr("data-action","update");
            $('#UserModal').find('#save_closeUserBtn').attr("data-id",user_id);
            $('#UserModal').find('#save_newUserBtn').attr("data-id",user_id);
            $('#user_id').val(data.id);
            if(data.profile_pic==null){
                var default_image = "{{ asset('images/default_avatar.jpg') }}";
                $('#profilepic_image_show').attr('src', default_image);
            }
            else{
                var profile_pic =  data.profile_pic;
                $('#profilepic_image_show').attr('src', profile_pic);
            }
            $('#full_name').val(data.full_name);
            $('#mobile_no').val(data.mobile_no);
            $('#email').val(data.email);
            $('#password').val(data.decrypted_password);
            $('#dob').val(data.dob);
            $("input[name=gender][value=" + data.gender + "]").prop('checked', true);
        })
    });

    $('body').on('click', '#deleteUserBtn', function (e) {
        // e.preventDefault();
        var delete_user_id = $(this).attr('data-id');
        $("#DeleteUserModal").find('#RemoveUserSubmit').attr('data-id',delete_user_id);
    });

    $('body').on('click', '#RemoveUserSubmit', function (e) {
        $('#RemoveUserSubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var remove_user_id = $(this).attr('data-id');

        var tab_type = get_users_page_tabType();

        $.ajax({
            type: 'GET',
            url: "{{ url('admin/users') }}" +'/' + remove_user_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeleteUserModal").modal('hide');
                    $('#RemoveUserSubmit').prop('disabled',false);
                    $("#RemoveUserSubmit").find('.removeloadericonfa').hide();
                    user_page_tabs(tab_type);
                    toastr.success("User Deleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeleteUserModal").modal('hide');
                    $('#RemoveUserSubmit').prop('disabled',false);
                    $("#RemoveUserSubmit").find('.removeloadericonfa').hide();
                    user_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeleteUserModal").modal('hide');
                $('#RemoveUserSubmit').prop('disabled',false);
                $("#RemoveUserSubmit").find('.removeloadericonfa').hide();
                user_page_tabs(tab_type);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('body').on('click', '#permissionUserBtn', function (e) {
        // e.preventDefault();
        var user_id = $(this).attr('data-id');
        var url = "{{ url('admin/users') }}" + "/" + user_id + "/permission";
        window.open(url,"_blank");
    });
</script>
<!-- user list JS end -->
@endsection

