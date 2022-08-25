@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
{{--                        <h4 class="card-title">Profile</h4>--}}

{{--                        <br>--}}

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row mb-2">
                                <div class="col-sm-12 text-right">
                                <button type="button" id="EditProfileBtn" class="btn btn-outline-dark" data-toggle="modal" data-target="#UserModal" data-id="{{ $user->id }}">Edit Profile</button>
                                </div>
                            </div>

                            <div class="media align-items-center mb-4">
                                @if(isset($user->profile_pic) && $user->profile_pic != "")
                                <img class="mr-3" src="{{ url($user->profile_pic) }}" width="80" height="80" alt="Profile" id="Profile_pic_val">
                                @else
                                <img class="mr-3" src="{{ url('images/default_avatar.jpg') }}" width="80" height="80" alt="Profile" id="Profile_pic_val">
                                @endif
                                <div class="media-body">
                                    <h3 class="mb-0" id="full_name_val">{{isset($user->full_name)?$user->full_name:''}}</h3>
                                </div>
                            </div>
                            @if($user->mobile_no != "")
                            <div class="row custom-row">
                                <div class="col-sm-4">
                                    <b>Mobile<span class="editorderListGem"></span></b>
                                </div>
                                <div class="col-sm-8" id="mobile_val">{{ isset($user->mobile_no)?$user->mobile_no:'' }}</div>
                            </div>
                            @endif
                            @if($user->email != "")
                            <div class="row custom-row">
                                <div class="col-sm-4">
                                    <b>E-mail<span class="editorderListGem"></span></b>
                                </div>
                                <div class="col-sm-8" id="email_val">{{ isset($user->email)?$user->email:'' }}</div>
                            </div>
                            @endif
                            @if($user->gender != "")
                            <div class="row custom-row">
                                <div class="col-sm-4">
                                    <b>Gender<span class="editorderListGem"></span></b>
                                </div>
                                <div class="col-sm-8" id="gender_val">{{ ($user->gender==1)?'Female':'Male' }}</div>
                            </div>
                            @endif
                            @if($user->dob != "")
                            <div class="row custom-row">
                                <div class="col-sm-4">
                                    <b>Date of Birth<span class="editorderListGem"></span></b>
                                </div>
                                <div class="col-sm-8" id="dob_val">{{ isset($user->dob)?$user->dob:'' }}</div>
                            </div>
                            @endif
                            <div class="row custom-row">
                                <div class="col-sm-4">
                                    <b>Password<span class="editorderListGem"></span></b>
                                </div>
                                <div class="col-sm-8" id="password_val">{{ isset($user->decrypted_password)?$user->decrypted_password:'' }}</div>
                            </div>
                        </div>

                    </div>
                    <div id="profilecoverspin" class="cover-spin"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="UserModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="userform" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Edit Profile</h5>
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
                            <img src="{{ url('images/default_avatar.jpg') }}" class="" id="profilepic_image_show" height="50px" width="50px" style="margin-top: 5px">
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="full_name">Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="full_name" name="full_name" placeholder="">
                            <div id="full_name-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
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
                            <input type="text" class="form-control input-flat" id="email" name="email" placeholder="">
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
                        <button type="button" class="btn btn-outline-primary" id="save_UserBtn" data-action="update" data-id="{{ $user->id }}">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
$('#profile_pic').change(function(){
    $('#profilepic-error').hide();
    var file = this.files[0];
    var fileType = file["type"];
    var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
    if ($.inArray(fileType, validImageTypes) < 0) {
        $('#profilepic-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
        var default_image = "{{ url('images/default_avatar.jpg') }}";
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
    $('#profilepic-error').html("");
    $('#full_name-error').html("");
    $('#mobileno-error').html("");
    $('#dob-error').html("");
    $('#gender-error').html("");
    $('#email-error').html("");
    $('#password-error').html("");
    var default_image = "{{ url('images/default_avatar.jpg') }}";
    $('#profilepic_image_show').attr('src', default_image);
});

$('body').on('click', '#EditProfileBtn', function () {
    var user_id = $(this).attr('data-id');
    $.get("{{ url('profile') }}" +'/' + user_id +'/edit', function (data) {
        $('#user_id').val(data.id);
        if(data.profile_pic==null){
            var default_image = "{{ url('images/default_avatar.jpg') }}";
            $('#profilepic_image_show').attr('src', default_image);
        }
        else{
            var profile_pic = data.profile_pic;
            $('#profilepic_image_show').attr('src', profile_pic);
        }
        $('#full_name').val(data.full_name);
        $('#mobile_no').val(data.mobile_no);
        $('#dob').val(data.dob);
        $('#email').val(data.email);
        $('#password').val(data.decrypted_password);
        $("input[name=gender][value=" + data.gender + "]").prop('checked', true);
    })
});

$('body').on('click', '#save_UserBtn', function () {
    var btn = $(this);
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();

    var formData = new FormData($("#userform")[0]);

    $.ajax({
        type: 'POST',
        url: "{{ url('profile/update') }}",
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
                    $('#full_name-error').show().text(res.errors.full_name);
                } else {
                    $('#full_name-error').hide();
                }

                if (res.errors.mobile_no) {
                    $('#mobileno-error').show().text(res.errors.mobile_no);
                } else {
                    $('#mobileno-error').hide();
                }

                if (res.errors.dob) {
                    $('#dob-error').show().text(res.errors.dob);
                } else {
                    $('#dob-error').hide();
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
            }

            if(res.status == 200){
                $("#UserModal").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                $("#full_name_val").html(res.user.full_name);
                $("#mobile_val").html(res.user.mobile_no);
                $("#email_val").html(res.user.email);
                if(res.user.gender == 1) {
                    $("#gender_val").html('Female');
                }
                else{
                    $("#gender_val").html('Male');
                }
                $("#dob_val").html(res.user.dob);
                $("#password_val").html(res.user.decrypted_password);
                if(res.user.profile_pic!=null) {
                    $('#Profile_pic_val').attr('src', "{{url('images/profile_pic')}}" +"/" + res.user.profile_pic);
                }
                toastr.success("Profile Updated",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#UserModal").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#UserModal").modal('hide');
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});
</script>
@endsection
