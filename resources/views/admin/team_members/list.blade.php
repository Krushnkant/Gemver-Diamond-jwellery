@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Team Member</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">Team Member List</h4>--}}

                        <div class="action-section">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url',\Illuminate\Support\Facades\Route::currentRouteName())->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TeamModel" id="AddTeamBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                        </div>

                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item team_page_tabs" data-tab="all_team_tab"><a class="nav-link active show" data-toggle="tab" href="">All</a>
                                </li>
                                <li class="nav-item team_page_tabs" data-tab="active_team_tab"><a class="nav-link" data-toggle="tab" href="">Active</a>
                                </li>
                                <li class="nav-item team_page_tabs" data-tab="deactive_team_tab"><a class="nav-link" data-toggle="tab" href="">Deactive</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane fade show active table-responsive" id="all_team_tab">
                            <table id="all_teams" class="table zero-configuration TeamNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Other</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Status</th>
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

    <div class="modal fade" id="TeamModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="teamform" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add Team Member</h5>
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
                            <label class="col-form-label" for="name">Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="name" name="name" placeholder="">
                            <div id="name-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="position">Position<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="position" name="position" placeholder="">
                            <div id="position-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="team_id" id="team_id">
{{--                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>--}}
                        <button type="button" class="btn btn-outline-primary" id="save_newTeamBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closeTeamBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteTeamModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Team Member</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Team Member?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveTeamSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        team_page_tabs('',true);
    });

    function get_teams_page_tabType(){
        var tab_type;
        $('.team_page_tabs').each(function() {
            var thi = $(this);
            if($(thi).find('a').hasClass('show')){
                tab_type = $(thi).attr('data-tab');
            }
        });
        return tab_type;
    }

    function save_team(btn,btn_type){
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();

        var action  = $(btn).attr('data-action');

        var formData = new FormData($("#teamform")[0]);

        formData.append('action',action);

        var tab_type = get_teams_page_tabType();

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/addorupdateteam') }}",
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

                    if (res.errors.name) {
                        $('#name-error').show().text(res.errors.name);
                    } else {
                        $('#name-error').hide();
                    }

                    if (res.errors.position) {
                        $('#position-error').show().text(res.errors.position);
                    } else {
                        $('#position-error').hide();
                    }

                }

                if(res.status == 200){
                    if(btn_type == 'save_close'){
                        $("#TeamModel").modal('hide');
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        if(res.action == 'add'){
                            team_page_tabs(tab_type,true);
                            toastr.success("Team Member Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            team_page_tabs(tab_type);
                            toastr.success("Team Member Updated",'Success',{timeOut: 5000});
                        }
                    }

                    if(btn_type == 'save_new'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $("#TeamModel").find('form').trigger('reset');
                        $("#TeamModel").find("#save_newTeamBtn").removeAttr('data-action');
                        $("#TeamModel").find("#save_closeTeamBtn").removeAttr('data-action');
                        $("#TeamModel").find("#save_newTeamBtn").removeAttr('data-id');
                        $("#TeamModel").find("#save_closeTeamBtn").removeAttr('data-id');
                        $('#team_id').val("");
                        $('#profilepic-error').html("");
                        $('#name-error').html("");
                        $('#position-error').html("");

                        var default_image = "{{ asset('images/default_avatar.jpg') }}";
                        $('#profilepic_image_show').attr('src', default_image);
                        $("#name").focus();
                        if(res.action == 'add'){
                            team_page_tabs(tab_type,true);
                            toastr.success("Team Member Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            team_page_tabs(tab_type);
                            toastr.success("Team Member Updated",'Success',{timeOut: 5000});
                        }
                    }
                }

                if(res.status == 400){
                    $("#TeamModel").modal('hide');
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    team_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#TeamModel").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                team_page_tabs(tab_type);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#save_newTeamBtn', function () {
        save_team($(this),'save_new');
    });

    $('body').on('click', '#save_closeTeamBtn', function () {
        save_team($(this),'save_close');
    });

    $('#TeamModel').on('shown.bs.modal', function (e) {
        $("#full_name").focus();
    });

    $('#profile_pic').change(function(){
        $('#profilepic-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#profilepic-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/default_avatar.jpg') }}";
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

    $('#TeamModel').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find("#save_newTeamBtn").removeAttr('data-action');
        $(this).find("#save_closeTeamBtn").removeAttr('data-action');
        $(this).find("#save_newTeamBtn").removeAttr('data-id');
        $(this).find("#save_closeTeamBtn").removeAttr('data-id');
        $('#user_id').val("");
        $('#profilepic-error').html("");
        $('#fullname-error').html("");
        $('#mobileno-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");
        $('#dob-error').html("");
        $('#gender-error').html("");
        var default_image = "{{ url('public/images/default_avatar.jpg') }}";
        $('#profilepic_image_show').attr('src', default_image);
    });

    $('#DeleteTeamModel').on('hidden.bs.modal', function () {
        $(this).find("#RemoveTeamSubmit").removeAttr('data-id');
    });

    function team_page_tabs(tab_type='',is_clearState=false) {
        if(is_clearState){
            $('#all_teams').DataTable().state.clear();
        }
        
        $('#all_teams').DataTable({
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
                "url": "{{ url('admin/allteamslist') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: '{{ csrf_token() }}' ,tab_type: tab_type},
                // "dataSrc": ""
            },
            // 'columnDefs': [
            //     { "width": "50px", "targets": 0 },
            //     { "width": "145px", "targets": 1 },
            //     { "width": "165px", "targets": 2 },
            //     { "width": "230px", "targets": 3 },
            //     { "width": "75px", "targets": 4 },
            //     { "width": "115px", "targets": 5 },
            // ],
            "columns": [
                {data: 'id', name: 'id', class: "text-center", orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'image', name: 'image', class: "text-center multirow"},
                {data: 'name', name: 'name', class: "text-left multirow", orderable: false},
                {data: 'position', name: 'position', class: "text-left multirow", orderable: false},
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }

    
    $(".team_page_tabs").click(function() {
        var tab_type = $(this).attr('data-tab');
        team_page_tabs(tab_type,true);
    });

    function changeTeamStatus(user_id) {
        var tab_type = get_teams_page_tabType();

        $.ajax({
            type: 'GET',
            url: "{{ url('admin/changeteamstatus') }}" +'/' + user_id,
            success: function (res) {
                console.log(res);
                if(res.status == 200 && res.action=='deactive'){
                    $("#Teamstatuscheck_"+user_id).val(2);
                    $("#Teamstatuscheck_"+user_id).prop('checked',false);
                    team_page_tabs(tab_type);
                    toastr.success("Team Member Deactivated",'Success',{timeOut: 5000});
                }
                if(res.status == 200 && res.action=='active'){
                    $("#Teamstatuscheck_"+user_id).val(1);
                    $("#Teamstatuscheck_"+user_id).prop('checked',true);
                    team_page_tabs(tab_type);
                    toastr.success("Team activated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#AddTeamBtn', function (e) {
        $("#TeamModel").find('.modal-title').html("Add User");
    });

    $('body').on('click', '#editTeamBtn', function () {
        var team_id = $(this).attr('data-id');
        
        $.get("{{ url('admin/teammembers') }}" +'/' + team_id +'/edit', function (data) {
           
            $('#TeamModel').find('.modal-title').html("Edit Team");
            $('#TeamModel').find('#save_closeTeamBtn').attr("data-action","update");
            $('#TeamModel').find('#save_newTeamBtn').attr("data-action","update");
            $('#TeamModel').find('#save_closeTeamBtn').attr("data-id",team_id);
            $('#TeamModel').find('#save_newTeamBtn').attr("data-id",team_id);
            $('#team_id').val(data.id);
            if(data.image==null){
                var default_image = "{{ asset('images/default_avatar.jpg') }}";
                $('#profilepic_image_show').attr('src', default_image);
            }
            else{
                var profile_pic = "{{ asset('images/teams') }}" +"/" + data.image;
                $('#profilepic_image_show').attr('src', profile_pic);
            }
            $('#name').val(data.name);
            $('#position').val(data.position);
        })
    });

    $('body').on('click', '#deleteTeamBtn', function (e) {
        // e.preventDefault();
        var delete_team_id = $(this).attr('data-id');
        $("#DeleteTeamModel").find('#RemoveTeamSubmit').attr('data-id',delete_team_id);
    });

    $('body').on('click', '#RemoveTeamSubmit', function (e) {
        $('#RemoveTeamSubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var remove_user_id = $(this).attr('data-id');

        var tab_type = get_teams_page_tabType();

        $.ajax({
            type: 'GET',
            url: "{{ url('admin/teammembers') }}" +'/' + remove_user_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeleteTeamModel").modal('hide');
                    $('#RemoveTeamSubmit').prop('disabled',false);
                    $("#RemoveTeamSubmit").find('.removeloadericonfa').hide();
                    team_page_tabs(tab_type);
                    toastr.success("Team MemberDeleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeleteTeamModel").modal('hide');
                    $('#RemoveTeamSubmit').prop('disabled',false);
                    $("#RemoveTeamSubmit").find('.removeloadericonfa').hide();
                    team_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeleteTeamModel").modal('hide');
                $('#RemoveTeamSubmit').prop('disabled',false);
                $("#RemoveTeamSubmit").find('.removeloadericonfa').hide();
                team_page_tabs(tab_type);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });


</script>

@endsection

