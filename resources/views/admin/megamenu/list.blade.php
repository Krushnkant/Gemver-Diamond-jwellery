@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Mega Menu</a></li>
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
                            Mega Menu List
                        </h4>--}}
                        <div class="col-lg-12">

                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th colspan="3"><h4 class="text-white mb-0">Mega Menu - Header Menu Item</h4></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($MegaMenus as $MegaMenu)    
                                <tr>
                                    <th style="width: 50%">{{ $MegaMenu->title }}</th>
                                    <td>
                                        @if(isset($MegaMenu->menu_thumb) && $MegaMenu->menu_thumb != "")
                                            <img src="{{ url('images/megamenu/'.$MegaMenu->menu_thumb) }}" width="50px" height="50px" alt="Company Logo" id="company_logo_val">
                                        @else
                                            <img src="{{ url('images/placeholder_image.png') }}" width="50px" height="50px" alt="Company Logo" id="company_logo_val">
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($canWrite == true)
                                            <button id="editMegaMenuBtn" data-id="{{ $MegaMenu->id }}" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#MegaMenuModal">
                                                Edit
                                            </button>

                                            <button id="viewSubMenuBtn" data-id="{{ $MegaMenu->id }}" class="btn btn-outline-dark btn-sm view-submenu" >
                                                Sub Menu
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

    <div class="modal fade" id="MegaMenuModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="MegaMenuForm" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">Update Mega Menu</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div id="attr-cover-spin" class="cover-spin"></div>
                    <div class="form-group">
                        <label class="col-form-label" for="title">Title <span class="text-danger">*</span>
                        </label>
                        <input type="hidden" class="form-control input-flat" id="mega_menu_id" name="mega_menu_id" >
                        <input type="text" class="form-control input-flat" id="title" name="title" placeholder="Title">
                        <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="col-form-label" for="Logo">Sub Menu Image 
                            </label>
                            <input type="file" class="form-control-file" id="menu_thumb" name="menu_thumb">
                            <div id="menu_thumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                            <img src="{{ url('images/placeholder_image.png') }}" class="" id="menu_thumb_image_show" height="50px" width="50px" style="margin-top: 5px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveMegaMenuBtn">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('js')
<!-- settings JS start -->
<script type="text/javascript">

    $('body').on('click', '#editMegaMenuBtn', function () {
        var mega_menu_id = $(this).attr('data-id');
        //alert(mega_menu_id);
        $.get("{{ url('admin/megamenus') }}" +'/' + mega_menu_id +'/edit', function (data) {
            
            $('#mega_menu_id').val(data.id);
            $('#title').val(data.title);
            if(data.menu_thumb==""){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#menu_thumb_image_show').attr('src', default_image);
            }else{
                var menu_thumb = "{{ url('images/megamenu') }}" +"/" + data.menu_thumb;
                $('#menu_thumb_image_show').attr('src', menu_thumb);
            }
        })
    });
    
    
    $('body').on('click', '#saveMegaMenuBtn', function () {
        $('#saveMegaMenuBtn').prop('disabled',true);
        $('#saveMegaMenuBtn').find('.loadericonfa').show();
        var formData = new FormData($("#MegaMenuForm")[0]);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/updateMegaMenu') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $('#saveMegaMenuBtn').prop('disabled',false);
                    $('#saveMegaMenuBtn').find('.loadericonfa').hide();
                    if (res.errors.title) {
                        $('#title-error').show().text(res.errors.title);
                    } else {
                        $('#title-error').hide();
                    }
                }

                if(res.status == 200){
                    $("#MegaMenuModal").modal('hide');
                    $('#saveMegaMenuBtn').prop('disabled',false);
                    $('#saveMegaMenuBtn').find('.loadericonfa').hide();
                   // $("#MegaMenuVal").html(res.title + " %");
                    location.reload();
                    toastr.success("Menu Updated",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#MegaMenuModal").modal('hide');
                    $('#saveMegaMenuBtn').prop('disabled',false);
                    $('#saveMegaMenuBtn').find('.loadericonfa').hide();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#MegaMenuModal").modal('hide');
                $('#saveMegaMenuBtn').prop('disabled',false);
                $('#saveMegaMenuBtn').find('.loadericonfa').hide();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    
    $('#MegaMenuModal').on('shown.bs.modal', function (e) {
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

    $('body').on('click', '#viewSubMenuBtn', function () {
        var mega_menu_id = $(this).attr('data-id');
        var url = "{{ url('admin/submenus') }}" + "/" + mega_menu_id;
        window.open(url,"_blank");
    });

</script>
<!-- settings JS end -->
@endsection
