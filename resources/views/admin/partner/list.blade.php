@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Partner</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">Partner List</h4>--}}

                        <div class="action-section row">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <?php $page_id = \App\Models\ProjectPage::where('route_url',\Illuminate\Support\Facades\Route::currentRouteName())->pluck('id')->first(); ?>
                                @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PartnerModel" id="AddPartnerBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                @endif
                                {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                            </div>

                            <div class="custom-tab-1 col-lg-4">
                                <ul class="nav nav-tabs mb-3">
                                    <li class="nav-item partner_page_tabs" data-tab="all_partner_tab"><a class="nav-link active show" data-toggle="tab" href="">All</a>
                                    </li>
                                    <li class="nav-item partner_page_tabs" data-tab="active_partner_tab"><a class="nav-link" data-toggle="tab" href="">Active</a>
                                    </li>
                                    <li class="nav-item partner_page_tabs" data-tab="deactive_partner_tab"><a class="nav-link" data-toggle="tab" href="">Deactive</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-pane fade show active table-responsive" id="all_partner_tab">
                            <table id="all_partners" class="table zero-configuration partnerNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                  
                                    <th>Status</th>
                                    <th>Other</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    
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

    <div class="modal fade" id="PartnerModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="partnerform" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add Partner</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="attr-cover-spin" class="cover-spin"></div>
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label class="col-form-label" for="profilePic">Logo
                            </label>
                            <input type="file" class="form-control-file" id="profile_pic" onchange="" name="profile_pic">
                            <div id="profilepic-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            <img src="{{ asset('images/default_avatar.jpg') }}" class="" id="profilepic_image_show" height="50px" width="50px" style="margin-top: 5px">
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="title" name="title" placeholder="">
                            <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                       
                        
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="partner_id" id="partner_id">
{{--                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>--}}
                        <button type="button" class="btn btn-outline-primary" id="save_newPartnerBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closePartnerBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeletePartnerModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Partner</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Partner?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemovePartnerSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        partner_page_tabs('',true);
    });

    function get_partners_page_tabType(){
        var tab_type;
        $('.partner_page_tabs').each(function() {
            var thi = $(this);
            if($(thi).find('a').hasClass('show')){
                tab_type = $(thi).attr('data-tab');
            }
        });
        return tab_type;
    }

    function save_partner(btn,btn_type){
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();

        var action  = $(btn).attr('data-action');

        var formData = new FormData($("#partnerform")[0]);

        formData.append('action',action);

        var tab_type = get_partners_page_tabType();

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/addorupdatepartner') }}",
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
                        $("#PartnerModel").modal('hide');
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        if(res.action == 'add'){
                            partner_page_tabs(tab_type,true);
                            toastr.success("Partner Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            partner_page_tabs(tab_type);
                            toastr.success("Partner Updated",'Success',{timeOut: 5000});
                        }
                    }

                    if(btn_type == 'save_new'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $("#PartnerModel").find('form').trigger('reset');
                        $("#PartnerModel").find("#save_newPartnerBtn").removeAttr('data-action');
                        $("#PartnerModel").find("#save_closePartnerBtn").removeAttr('data-action');
                        $("#PartnerModel").find("#save_newPartnerBtn").removeAttr('data-id');
                        $("#PartnerModel").find("#save_closePartnerBtn").removeAttr('data-id');
                        $('#partner_id').val("");
                        $('#profilepic-error').html("");
                        $('#name-error').html("");
                        $('#position-error').html("");

                        var default_image = "{{ asset('images/default_avatar.jpg') }}";
                        $('#profilepic_image_show').attr('src', default_image);
                        $("#name").focus();
                        if(res.action == 'add'){
                            partner_page_tabs(tab_type,true);
                            toastr.success("Partner Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            partner_page_tabs(tab_type);
                            toastr.success("Partner Updated",'Success',{timeOut: 5000});
                        }
                    }
                }

                if(res.status == 400){
                    $("#PartnerModel").modal('hide');
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    partner_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#PartnerModel").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                partner_page_tabs(tab_type);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#save_newPartnerBtn', function () {
        save_partner($(this),'save_new');
    });

    $('body').on('click', '#save_closePartnerBtn', function () {
        save_partner($(this),'save_close');
    });

    $('#PartnerModel').on('shown.bs.modal', function (e) {
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

    $('#PartnerModel').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find("#save_newPartnerBtn").removeAttr('data-action');
        $(this).find("#save_closePartnerBtn").removeAttr('data-action');
        $(this).find("#save_newPartnerBtn").removeAttr('data-id');
        $(this).find("#save_closePartnerBtn").removeAttr('data-id');
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

    $('#DeletePartnerModel').on('hidden.bs.modal', function () {
        $(this).find("#RemovePartnerSubmit").removeAttr('data-id');
    });

    function partner_page_tabs(tab_type='',is_clearState=false) {
        if(is_clearState){
            $('#all_partners').DataTable().state.clear();
        }
        
        $('#all_partners').DataTable({
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
                "url": "{{ url('admin/allpartnerslist') }}",
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
                {data: 'title', name: 'title', class: "text-left multirow", orderable: false},
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }

    
    $(".partner_page_tabs").click(function() {
        var tab_type = $(this).attr('data-tab');
        partner_page_tabs(tab_type,true);
    });

    function changepartnerStatus(user_id) {
        var tab_type = get_partners_page_tabType();

        $.ajax({
            type: 'GET',
            url: "{{ url('admin/changepartnerstatus') }}" +'/' + user_id,
            success: function (res) {
                console.log(res);
                if(res.status == 200 && res.action=='deactive'){
                    $("#partnerstatuscheck_"+user_id).val(2);
                    $("#partnerstatuscheck_"+user_id).prop('checked',false);
                    partner_page_tabs(tab_type);
                    toastr.success("Partner Deactivated",'Success',{timeOut: 5000});
                }
                if(res.status == 200 && res.action=='active'){
                    $("#partnerstatuscheck_"+user_id).val(1);
                    $("#partnerstatuscheck_"+user_id).prop('checked',true);
                    partner_page_tabs(tab_type);
                    toastr.success("partner activated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#AddPartnerBtn', function (e) {
        $("#PartnerModel").find('.modal-title').html("Add Partner");
    });

    $('body').on('click', '#editPartnerBtn', function () {
        var partner_id = $(this).attr('data-id');
        
        $.get("{{ url('admin/partners') }}" +'/' + partner_id +'/edit', function (data) {
           
            $('#PartnerModel').find('.modal-title').html("Edit partner");
            $('#PartnerModel').find('#save_closePartnerBtn').attr("data-action","update");
            $('#PartnerModel').find('#save_newPartnerBtn').attr("data-action","update");
            $('#PartnerModel').find('#save_closePartnerBtn').attr("data-id",partner_id);
            $('#PartnerModel').find('#save_newPartnerBtn').attr("data-id",partner_id);
            $('#partner_id').val(data.id);
            if(data.logo==null){
                var default_image = "{{ asset('images/default_avatar.jpg') }}";
                $('#profilepic_image_show').attr('src', default_image);
            }
            else{
                var profile_pic = "{{ asset('images/partners') }}" +"/" + data.logo;
                $('#profilepic_image_show').attr('src', profile_pic);
            }
            $('#title').val(data.title);
        })
    });

    $('body').on('click', '#deletePartnerBtn', function (e) {
        // e.preventDefault();
        var delete_partner_id = $(this).attr('data-id');
        $("#DeletePartnerModel").find('#RemovePartnerSubmit').attr('data-id',delete_partner_id);
    });

    $('body').on('click', '#RemovePartnerSubmit', function (e) {
        $('#RemovePartnerSubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var remove_user_id = $(this).attr('data-id');

        var tab_type = get_partners_page_tabType();

        $.ajax({
            type: 'GET',
            url: "{{ url('admin/partners') }}" +'/' + remove_user_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeletePartnerModel").modal('hide');
                    $('#RemovePartnerSubmit').prop('disabled',false);
                    $("#RemovePartnerSubmit").find('.removeloadericonfa').hide();
                    partner_page_tabs(tab_type);
                    toastr.success("PartnerDeleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeletePartnerModel").modal('hide');
                    $('#RemovePartnerSubmit').prop('disabled',false);
                    $("#RemovePartnerSubmit").find('.removeloadericonfa').hide();
                    partner_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeletePartnerModel").modal('hide');
                $('#RemovePartnerSubmit').prop('disabled',false);
                $("#RemovePartnerSubmit").find('.removeloadericonfa').hide();
                partner_page_tabs(tab_type);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });


</script>

@endsection

