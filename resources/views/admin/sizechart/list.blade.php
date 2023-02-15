@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/attributes') }}">Attributes </a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Size Chart</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Size Chart </h4>

                        <div class="action-section">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.sizechart.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sizechartModal" id="AddsizechartBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                        {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                        </div>
                        <div class="table-responsive">
                            <table id="sizechart" class="table zero-configuration customNewtable" style="width:100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Thumb</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Thumb</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sizechartModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="sizechartForm" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add New Size Chart</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div id="attr-cover-spin" class="cover-spin"></div>
                                {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <label class="col-form-label" for="displayattributename">Thumbnail
                                    </label>
                                    <input type="file" class="form-control-file" id="sizechartthumb" onchange="" name="thumb">
                                    <div id="sizechartthumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="sizechartthumb_image_show" height="50px" width="50px" style="margin-top: 5px">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="title">Title 
                                    </label>
                                    <input type="text" class="form-control input-flat" id="title" name="title" placeholder="">
                                    <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>

                               
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="sizechart_id" id="sizechart_id">

                        <button type="button" class="btn btn-outline-primary" id="save_newsizechartBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closesizechartBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeletesizechartModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Size Chart?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemovesizechartSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- Size Chart JS start -->
<script type="text/javascript">
    $(document).ready(function() {
        sizechart_table(true);
    });

    function save_sizechart(btn,btn_type){
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();
        var attr_id = $(location).attr("href").split('/').pop();
        var action  = $(btn).attr('data-action');

        var formData = new FormData($("#sizechartForm")[0]);
        formData.append('action',action);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/addorupdatesizechart') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
            
                    if (res.errors.thumb) {
                        $('#thumb-error').show().text(res.errors.thumb);
                    } else {
                        $('#thumb-error').hide();
                    }

                    if (res.errors.title) {
                        $('#title-error').show().text(res.errors.title);
                    } else {
                        $('#title-error').hide();
                    }
                }

                if(res.status == 200){
                    if(btn_type == 'save_close'){
                        $("#sizechartModal").modal('hide');
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        if(res.action == 'add'){
                            sizechart_table(true);
                            toastr.success("Size Chart Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            sizechart_table();
                            toastr.success("Size Chart Updated",'Success',{timeOut: 5000});
                        }
                    }

                    if(btn_type == 'save_new'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $("#sizechartModal").find('form').trigger('reset');
                        $("#sizechartModal").find("#save_newsizechartBtn").removeAttr('data-action');
                        $("#sizechartModal").find("#save_closesizechartBtn").removeAttr('data-action');
                        $("#sizechartModal").find("#save_newsizechartBtn").removeAttr('data-id');
                        $("#sizechartModal").find("#save_closesizechartBtn").removeAttr('data-id');
                        $('#sizechart_id').val("");
                        $('#sizechartname-error').html("");
                        $('#sizechartthumb-error').html("");
                        var default_image = "{{ url('images/placeholder_image.png') }}";
                        $('#sizechartthumb_image_show').attr('src', default_image);
                        $("#sizechartname").focus();
                        if(res.action == 'add'){
                            sizechart_table(true);
                            toastr.success("Size Chart Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            sizechart_table();
                            toastr.success("Size Chart Updated",'Success',{timeOut: 5000});
                        }
                    }
                }

                if(res.status == 400){
                    $("#sizechartModal").modal('hide');
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    sizechart_table();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#sizechartModal").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                sizechart_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#save_newsizechartBtn', function () {
        save_sizechart($(this),'save_new');
    });

    $('body').on('click', '#save_closesizechartBtn', function () {
        save_sizechart($(this),'save_close');
    });

    function sizechart_table(is_clearState=false){
        if(is_clearState){
            $('#sizechart').DataTable().state.clear();
        }

        $('#sizechart').DataTable({
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
                "url": "{{ url('admin/allsizechartslist') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: '{{ csrf_token() }}',attr_id: $(location).attr("href").split('/').pop() },
                // "dataSrc": ""
            },
            'columnDefs': [
                { "width": "50px", "targets": 0 },
                { "width": "145px", "targets": 1 },
                { "width": "230px", "targets": 2 },
                { "width": "50px", "targets": 3 },
                { "width": "120px", "targets": 4 },
                { "width": "120px", "targets": 5 },
            ],
            "columns": [
                {data: 'id', name: 'id', class: "text-center", orderable: false ,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'title', name: 'title', class: "text-left"},
                {data: 'sizechartthumb', name: 'sizechartthumb', orderable: false, searchable: false, class: "text-center"},
                
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }

    function chagesizechartStatus(sizechart_id) {
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/chagesizechartstatus') }}" +'/' + sizechart_id,
            success: function (res) {
                if(res.status == 200 && res.action=='deactive'){
                    $("#sizecharttatuscheck_"+sizechart_id).val(2);
                    $("#sizecharttatuscheck_"+sizechart_id).prop('checked',false);
                    toastr.success("Size Chart Deactivated",'Success',{timeOut: 5000});
                }
                if(res.status == 200 && res.action=='active'){
                    $("#sizecharttatuscheck_"+sizechart_id).val(1);
                    $("#sizecharttatuscheck_"+sizechart_id).prop('checked',true);
                    toastr.success("Size Chart activated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#AddsizechartBtn', function (e) {
        $("#sizechartModal").find('.modal-title').html("Add New Size Chart");
    });

    $('body').on('click', '#editsizechartBtn', function () {
        var sizechart_id = $(this).attr('data-id');
        $.get("{{ url('admin/sizechart') }}" +'/' + sizechart_id +'/edit', function (data) {
            $('#sizechartModal').find('.modal-title').html("Edit " + data.title);
            $('#sizechartModal').find('#save_newsizechartBtn').attr("data-action","update");
            $('#sizechartModal').find('#save_closesizechartBtn').attr("data-action","update");
            $('#sizechartModal').find('#save_newsizechartBtn').attr("data-id",sizechart_id);
            $('#sizechartModal').find('#save_closesizechartBtn').attr("data-id",sizechart_id);
            $('#sizechart_id').val(data.id);
            $('#title').val(data.title);
            if(data.thumb==null){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#sizechartthumb_image_show').attr('src', default_image);
            }
            else{
                var sizechartthumb = "{{ url('images/sizechart_thumb') }}" +"/" + data.thumb;
                $('#sizechartthumb_image_show').attr('src', sizechartthumb);
            }
        })
    });

    $('#sizechartModal').on('shown.bs.modal', function (e) {
        $("#sizechartname").focus();
    });

    $('#sizechartModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find("#save_newsizechartBtn").removeAttr('data-action');
        $(this).find("#save_closesizechartBtn").removeAttr('data-action');
        $(this).find("#save_newsizechartBtn").removeAttr('data-id');
        $(this).find("#save_closesizechartBtn").removeAttr('data-id');
        $('#sizechart_id').val("");
        $('#sizechartname-error').html("");
        $('#sizechartthumb-error').html("");
        var default_image = "{{ url('images/placeholder_image.png') }}";
        $('#sizechartthumb_image_show').attr('src', default_image);
    });

    $('body').on('click', '#deletesizechartBtn', function (e) {
        // e.preventDefault();
        var sizechart_id = $(this).attr('data-id');
        $("#DeletesizechartModal").find('#RemovesizechartSubmit').attr('data-id',sizechart_id);
        $.get("{{ url('admin/sizechart') }}" +'/' + sizechart_id +'/edit', function (data) {
            $('#DeletesizechartModal').find('.modal-title').html("Remove " + data.title);
        })
    });

    $('body').on('click', '#RemovesizechartSubmit', function (e) {
        $('#RemovesizechartSubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var sizechart_id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/sizechart') }}" +'/' + sizechart_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeletesizechartModal").modal('hide');
                    $('#RemovesizechartSubmit').prop('disabled',false);
                    $("#RemovesizechartSubmit").find('.removeloadericonfa').hide();
                    sizechart_table();
                    toastr.success("Size Chart Deleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeletesizechartModal").modal('hide');
                    $('#RemovesizechartSubmit').prop('disabled',false);
                    $("#RemovesizechartSubmit").find('.removeloadericonfa').hide();
                    sizechart_table();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeletesizechartModal").modal('hide');
                $('#RemovesizechartSubmit').prop('disabled',false);
                $("#RemovesizechartSubmit").find('.removeloadericonfa').hide();
                sizechart_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('#DeletesizechartModal').on('hidden.bs.modal', function () {
        $(this).find("#RemovesizechartSubmit").removeAttr('data-id');
    });

    $('#sizechartthumb').change(function(){
        $('#sizechartthumb-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#sizechartthumb-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ url('images/placeholder_image.png') }}";
            $('#sizechartthumb_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#sizechartthumb_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<!-- Size Chart JS end -->
@endsection
