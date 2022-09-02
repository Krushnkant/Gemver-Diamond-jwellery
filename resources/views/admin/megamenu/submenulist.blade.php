@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/megamenus') }}">Mega Menu</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $MegaMenus->title }}</a></li>
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
                            Sub Menu List
                        </h4>--}}
                        <div class="col-lg-12">

                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th colspan="3"><h4 class="text-white mb-0">Sub Menu Title</h4></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($SubMenus as $SubMenu)    
                                <tr>
                                    <th style="width: 50%">{{ $SubMenu->title }}</th>
                                   
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <button id="editSubMenuBtn" data-id="{{ $SubMenu->id }}" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#SubMenuModal">
                                                Edit
                                            </button>

                                            <button id="manageSubMenuBtn" data-id="{{ $SubMenu->id }}" data-mega-id="{{ $SubMenu->mega_menu_id }}" class="btn btn-outline-dark btn-sm view-submenu" >
                                                Manage
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

    <div class="modal fade" id="SubMenuModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="SubMenuForm" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">Update Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div id="attr-cover-spin" class="cover-spin"></div>
                    <div class="form-group">
                        <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
                        </label>
                        <input type="hidden" class="form-control input-flat" id="sub_menu_id" name="sub_menu_id" >
                        <input type="text" class="form-control input-flat" id="title" name="title" placeholder="Title">
                        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveSubMenuBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('js')
<!-- settings JS start -->
<script type="text/javascript">

    $('body').on('click', '#editSubMenuBtn', function () {
        var sub_menu_id = $(this).attr('data-id');
        $.get("{{ url('admin/submenus') }}" +'/' + sub_menu_id +'/edit', function (data) {
            $('#sub_menu_id').val(data.id);
            $('#title').val(data.title);
            
        })
    });
    
    
    $('body').on('click', '#saveSubMenuBtn', function () {
        $('#saveSubMenuBtn').prop('disabled',true);
        $('#saveSubMenuBtn').find('.loadericonfa').show();
        var formData = new FormData($("#SubMenuForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateSubMenu') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveSubMenuBtn').prop('disabled',false);
                    $('#saveSubMenuBtn').find('.loadericonfa').hide();
                    if (res.errors.title) {
                        $('#title-error').show().text(res.errors.title);
                    } else {
                        $('#title-error').hide();
                    }
                }

                if(res.status == 200){
                    $("#SubMenuModal").modal('hide');
                    $('#saveSubMenuBtn').prop('disabled',false);
                    $('#saveSubMenuBtn').find('.loadericonfa').hide();
                   // $("#MegaMenuVal").html(res.title + " %");
                    location.reload();
                    toastr.success("Sub Menu Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#SubMenuModal").modal('hide');
                    $('#saveSubMenuBtn').prop('disabled',false);
                    $('#saveSubMenuBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#SubMenuModal").modal('hide');
                $('#saveSubMenuBtn').prop('disabled',false);
                $('#saveSubMenuBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    
    $('#SubMenuModal').on('shown.bs.modal', function (e) {
        $("#title").focus();
    });

    $('#menu_thumb').change(function(){
        $('#menu_thumb-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#menu_thumb-error').show().text("Please provide a Valid Extension Logo(e.g: .jpg .png)");
            var default_image = "{{ url('public/images/placeholder_image.png') }}";
            $('#menu_thumb_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#menu_thumb_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('body').on('click', '#manageSubMenuBtn', function () {
        var sub_mega_id = $(this).attr('data-mega-id');
        var sub_menu_id = $(this).attr('data-id');
        var url = "{{ url('admin/submenus/manage/') }}" + "/" + sub_menu_id + "/" + sub_mega_id;
        window.open(url,"_blank");
    });

</script>
<!-- settings JS end -->
@endsection
