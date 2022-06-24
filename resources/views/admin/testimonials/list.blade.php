@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Testimonial</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Testimonial List</h4>

                        <div class="action-section">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url',\Illuminate\Support\Facades\Route::currentRouteName())->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TestimonialModel" id="AddTestimonialBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                        </div>

                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item testimonial_page_tabs" data-tab="all_testimonial_tab"><a class="nav-link active show" data-toggle="tab" href="">All</a>
                                </li>
                                <li class="nav-item testimonial_page_tabs" data-tab="active_testimonial_tab"><a class="nav-link" data-toggle="tab" href="">Active</a>
                                </li>
                                <li class="nav-item testimonial_page_tabs" data-tab="deactive_testimonial_tab"><a class="nav-link" data-toggle="tab" href="">Deactive</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane fade show active table-responsive" id="all_testimonial_tab">
                            <table id="all_testimonials" class="table zero-configuration testimonialNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Other</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Country</th>
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

    <div class="modal fade" id="TestimonialModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="testimonialform" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add Testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="attr-cover-spin" class="cover-spin"></div>
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label class="col-form-label" for="profilePic"> Profile Image
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
                            <label class="col-form-label" for="country">Country <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="country" name="country" placeholder="">
                            <div id="country-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        
                        <div class="form-group ">
                            <label class="col-form-label" for="description">Description <span class="text-danger">*</span>
                            </label>
                            <textarea class="summernote" id="description" name="description"></textarea>
                            <div id="description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="testimonial_id" id="testimonial_id">
{{--                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>--}}
                        <button type="button" class="btn btn-outline-primary" id="save_newTestimonialBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closeTestimonialBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteTestimonialModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Testimonial</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Testimonial?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveTestimonialSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        testimonial_page_tabs('',true);
    });

    function get_testimonials_page_tabType(){
        var tab_type;
        $('.testimonial_page_tabs').each(function() {
            var thi = $(this);
            if($(thi).find('a').hasClass('show')){
                tab_type = $(thi).attr('data-tab');
            }
        });
        return tab_type;
    }

    function save_testimonial(btn,btn_type){
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();

        var action  = $(btn).attr('data-action');

        var formData = new FormData($("#testimonialform")[0]);

        formData.append('action',action);

        var tab_type = get_testimonials_page_tabType();

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/addorupdatetestimonial') }}",
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

                    if (res.errors.country) {
                        $('#country-error').show().text(res.errors.country);
                    } else {
                        $('#country-error').hide();
                    }

                    if (res.errors.description) {
                        $('#description-error').show().text(res.errors.country);
                    } else {
                        $('#description-error').hide();
                    }

                }

                if(res.status == 200){
                    if(btn_type == 'save_close'){
                        $("#TestimonialModel").modal('hide');
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $('#description').summernote('code', '');
                        $("#TestimonialModel").find('form').trigger('reset');
                        if(res.action == 'add'){
                            testimonial_page_tabs(tab_type,true);
                            toastr.success("Testimonial Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            testimonial_page_tabs(tab_type);
                            toastr.success("Testimonial Updated",'Success',{timeOut: 5000});
                        }
                    }

                    if(btn_type == 'save_new'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $("#TestimonialModel").find('form').trigger('reset');
                        $("#TestimonialModel").find("#save_newTestimonialBtn").removeAttr('data-action');
                        $("#TestimonialModel").find("#save_closeTestimonialBtn").removeAttr('data-action');
                        $("#TestimonialModel").find("#save_newTestimonialBtn").removeAttr('data-id');
                        $("#TestimonialModel").find("#save_closeTestimonialBtn").removeAttr('data-id');
                        $('#testimonial_id').val("");
                        $('#profilepic-error').html("");
                        $('#name-error').html("");
                        $('#country-error').html("");
                        $('#description-error').html("");

                        var default_image = "{{ asset('images/default_avatar.jpg') }}";
                        $('#profilepic_image_show').attr('src', default_image);
                        $("#name").focus();
                        if(res.action == 'add'){
                            testimonial_page_tabs(tab_type,true);
                            toastr.success("Testimonial Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            testimonial_page_tabs(tab_type);
                            toastr.success("Testimonial Updated",'Success',{timeOut: 5000});
                        }
                    }
                }

                if(res.status == 400){
                    $("#TestimonialModel").modal('hide');
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    testimonial_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#TestimonialModel").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                testimonial_page_tabs(tab_type);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#save_newTestimonialBtn', function () {
        save_testimonial($(this),'save_new');
    });

    $('body').on('click', '#save_closeTestimonialBtn', function () {
        save_testimonial($(this),'save_close');
    });

    $('#TestimonialModel').on('shown.bs.modal', function (e) {
        $("#name").focus();
    });

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

    $('#TestimonialModel').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find("#save_newTestimonialBtn").removeAttr('data-action');
        $(this).find("#save_closeTestimonialBtn").removeAttr('data-action');
        $(this).find("#save_newTestimonialBtn").removeAttr('data-id');
        $(this).find("#save_closeTestimonialBtn").removeAttr('data-id');
        $('#profilepic-error').html("");
        $('#name-error').html("");
        $('#description-error').html("");
        $('#country-error').html("");
        var default_image = "{{ url('images/default_avatar.jpg') }}";
        $('#profilepic_image_show').attr('src', default_image);
    });

    $('#DeleteTestimonialModel').on('hidden.bs.modal', function () {
        $(this).find("#RemoveTestimonialSubmit").removeAttr('data-id');
    });

    function testimonial_page_tabs(tab_type='',is_clearState=false) {
        if(is_clearState){
            $('#all_testimonials').DataTable().state.clear();
        }
        
        $('#all_testimonials').DataTable({
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
                "url": "{{ url('admin/alltestimonialslist') }}",
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
                {data: 'country', name: 'country', class: "text-left multirow", orderable: false},
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }

    
    $(".testimonial_page_tabs").click(function() {
        var tab_type = $(this).attr('data-tab');
        testimonial_page_tabs(tab_type,true);
    });

    function changetestimonialStatus(user_id) {
        var tab_type = get_testimonials_page_tabType();

        $.ajax({
            type: 'GET',
            url: "{{ url('admin/changetestimonialstatus') }}" +'/' + user_id,
            success: function (res) {
                console.log(res);
                if(res.status == 200 && res.action=='deactive'){
                    $("#testimonialstatuscheck_"+user_id).val(2);
                    $("#testimonialstatuscheck_"+user_id).prop('checked',false);
                    testimonial_page_tabs(tab_type);
                    toastr.success("Testimonial Deactivated",'Success',{timeOut: 5000});
                }
                if(res.status == 200 && res.action=='active'){
                    $("#testimonialstatuscheck_"+user_id).val(1);
                    $("#testimonialstatuscheck_"+user_id).prop('checked',true);
                    testimonial_page_tabs(tab_type);
                    toastr.success("testimonial activated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#AddTestimonialBtn', function (e) {

        $("#TestimonialModel").find('.modal-title').html("Add Testimonial");
        $('#description').summernote('code', '');
    });

    $('body').on('click', '#editTestimonialBtn', function () {
        var testimonial_id = $(this).attr('data-id');
        
        $.get("{{ url('admin/testimonials') }}" +'/' + testimonial_id +'/edit', function (data) {
           
            $('#TestimonialModel').find('.modal-title').html("Edit testimonial");
            $('#TestimonialModel').find('#save_closeTestimonialBtn').attr("data-action","update");
            $('#TestimonialModel').find('#save_newTestimonialBtn').attr("data-action","update");
            $('#TestimonialModel').find('#save_closeTestimonialBtn').attr("data-id",testimonial_id);
            $('#TestimonialModel').find('#save_newTestimonialBtn').attr("data-id",testimonial_id);
            $('#testimonial_id').val(data.id);
            if(data.image==null){
                var default_image = "{{ asset('images/default_avatar.jpg') }}";
                $('#profilepic_image_show').attr('src', default_image);
            }
            else{
                var profile_pic = "{{ asset('images/testimonials') }}" +"/" + data.image;
                $('#profilepic_image_show').attr('src', profile_pic);
            }
            $('#name').val(data.name);
            $('#position').val(data.position);
            $('#country').val(data.country);
            $('#description').summernote('code', data.description);
        })
    });

    $('body').on('click', '#deleteTestimonialBtn', function (e) {
        // e.preventDefault();
        var delete_testimonial_id = $(this).attr('data-id');
        $("#DeleteTestimonialModel").find('#RemoveTestimonialSubmit').attr('data-id',delete_testimonial_id);
    });

    $('body').on('click', '#RemoveTestimonialSubmit', function (e) {
        $('#RemoveTestimonialSubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var remove_user_id = $(this).attr('data-id');

        var tab_type = get_testimonials_page_tabType();

        $.ajax({
            type: 'GET',
            url: "{{ url('admin/testimonials') }}" +'/' + remove_user_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeleteTestimonialModel").modal('hide');
                    $('#RemoveTestimonialSubmit').prop('disabled',false);
                    $("#RemoveTestimonialSubmit").find('.removeloadericonfa').hide();
                    testimonial_page_tabs(tab_type);
                    toastr.success("TestimonialDeleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeleteTestimonialModel").modal('hide');
                    $('#RemoveTestimonialSubmit').prop('disabled',false);
                    $("#RemoveTestimonialSubmit").find('.removeloadericonfa').hide();
                    testimonial_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeleteTestimonialModel").modal('hide');
                $('#RemoveTestimonialSubmit').prop('disabled',false);
                $("#RemoveTestimonialSubmit").find('.removeloadericonfa').hide();
                testimonial_page_tabs(tab_type);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });


</script>

@endsection

