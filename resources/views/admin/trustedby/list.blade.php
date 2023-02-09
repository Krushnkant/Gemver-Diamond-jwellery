@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/attributes') }}">Attributes </a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Trusted By</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Trusted By </h4>

                        <div class="action-section">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.trustedby.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#trustedbyModal" id="AddtrustedbyBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                        {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                        </div>
                        <div class="table-responsive">
                            <table id="trustedby" class="table zero-configuration customNewtable" style="width:100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Thumb</th>
                                <th>Trusted By</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Thumb</th>
                                <th>Trusted By</th>
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

    <div class="modal fade" id="trustedbyModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="trustedbyForm" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add New Trusted By</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div id="attr-cover-spin" class="cover-spin"></div>
                                {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <label class="col-form-label" for="displayattributename">Thumbnail
                                    </label>
                                    <input type="file" class="form-control-file" id="trustedbythumb" onchange="" name="trustedbythumb">
                                    <div id="trustedbythumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="trustedbythumb_image_show" height="50px" width="50px" style="margin-top: 5px">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="redirect_url">Redirect Url 
                                    </label>
                                    <input type="text" class="form-control input-flat" id="redirect_url" name="redirect_url" placeholder="">
                                    <div id="redirect_url-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>

                               
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="trustedby_id" id="trustedby_id">

                        <button type="button" class="btn btn-outline-primary" id="save_newtrustedbyBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closetrustedbyBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeletetrustedbyModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Trusted By?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemovetrustedbySubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- Trusted By JS start -->
<script type="text/javascript">
    $(document).ready(function() {
        trustedby_table(true);
    });

    function save_trustedby(btn,btn_type){
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();
        var attr_id = $(location).attr("href").split('/').pop();
        var action  = $(btn).attr('data-action');

        var formData = new FormData($("#trustedbyForm")[0]);
        formData.append('action',action);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/addorupdatetrustedby') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
            
                    if (res.errors.trustedbythumb) {
                        $('#trustedbythumb-error').show().text(res.errors.trustedbythumb);
                    } else {
                        $('#trustedbythumb-error').hide();
                    }
                }

                if(res.status == 200){
                    if(btn_type == 'save_close'){
                        $("#trustedbyModal").modal('hide');
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        if(res.action == 'add'){
                            trustedby_table(true);
                            toastr.success("Trusted By Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            trustedby_table();
                            toastr.success("Trusted By Updated",'Success',{timeOut: 5000});
                        }
                    }

                    if(btn_type == 'save_new'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $("#trustedbyModal").find('form').trigger('reset');
                        $("#trustedbyModal").find("#save_newtrustedbyBtn").removeAttr('data-action');
                        $("#trustedbyModal").find("#save_closetrustedbyBtn").removeAttr('data-action');
                        $("#trustedbyModal").find("#save_newtrustedbyBtn").removeAttr('data-id');
                        $("#trustedbyModal").find("#save_closetrustedbyBtn").removeAttr('data-id');
                        $('#trustedby_id').val("");
                        $('#trustedbyname-error').html("");
                        $('#trustedbythumb-error').html("");
                        var default_image = "{{ url('images/placeholder_image.png') }}";
                        $('#trustedbythumb_image_show').attr('src', default_image);
                        $("#trustedbyname").focus();
                        if(res.action == 'add'){
                            trustedby_table(true);
                            toastr.success("Trusted By Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            trustedby_table();
                            toastr.success("Trusted By Updated",'Success',{timeOut: 5000});
                        }
                    }
                }

                if(res.status == 400){
                    $("#trustedbyModal").modal('hide');
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    trustedby_table();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#trustedbyModal").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                trustedby_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#save_newtrustedbyBtn', function () {
        save_trustedby($(this),'save_new');
    });

    $('body').on('click', '#save_closetrustedbyBtn', function () {
        save_trustedby($(this),'save_close');
    });

    function trustedby_table(is_clearState=false){
        if(is_clearState){
            $('#trustedby').DataTable().state.clear();
        }

        $('#trustedby').DataTable({
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
                "url": "{{ url('admin/alltrustedbyslist') }}",
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
                {data: 'trustedbythumb', name: 'trustedbythumb', orderable: false, searchable: false, class: "text-center"},
                {data: 'redirect_url', name: 'redirect_url', class: "text-left"},
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }

    function chagetrustedbyStatus(trustedby_id) {
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/chagetrustedbystatus') }}" +'/' + trustedby_id,
            success: function (res) {
                if(res.status == 200 && res.action=='deactive'){
                    $("#trustedbytatuscheck_"+trustedby_id).val(2);
                    $("#trustedbytatuscheck_"+trustedby_id).prop('checked',false);
                    toastr.success("Trusted By Deactivated",'Success',{timeOut: 5000});
                }
                if(res.status == 200 && res.action=='active'){
                    $("#trustedbytatuscheck_"+trustedby_id).val(1);
                    $("#trustedbytatuscheck_"+trustedby_id).prop('checked',true);
                    toastr.success("Trusted By activated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#AddtrustedbyBtn', function (e) {
        $("#trustedbyModal").find('.modal-title').html("Add New Trusted By");
    });

    $('body').on('click', '#edittrustedbyBtn', function () {
        var trustedby_id = $(this).attr('data-id');
        $.get("{{ url('admin/trustedby') }}" +'/' + trustedby_id +'/edit', function (data) {
            $('#trustedbyModal').find('.modal-title').html("Edit " + data.redirect_url);
            $('#trustedbyModal').find('#save_newtrustedbyBtn').attr("data-action","update");
            $('#trustedbyModal').find('#save_closetrustedbyBtn').attr("data-action","update");
            $('#trustedbyModal').find('#save_newtrustedbyBtn').attr("data-id",trustedby_id);
            $('#trustedbyModal').find('#save_closetrustedbyBtn').attr("data-id",trustedby_id);
            $('#trustedby_id').val(data.id);
            $('#trustedbyname').val(data.redirect_url);
            $('#description').val(data.description);
            $('#sorting').val(data.sorting);
            if(data.trustedbythumb==null){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#trustedbythumb_image_show').attr('src', default_image);
            }
            else{
                var trustedbythumb = "{{ url('images/trustedbythumb') }}" +"/" + data.trustedbythumb;
                $('#trustedbythumb_image_show').attr('src', trustedbythumb);
            }
        })
    });

    $('#trustedbyModal').on('shown.bs.modal', function (e) {
        $("#trustedbyname").focus();
    });

    $('#trustedbyModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find("#save_newtrustedbyBtn").removeAttr('data-action');
        $(this).find("#save_closetrustedbyBtn").removeAttr('data-action');
        $(this).find("#save_newtrustedbyBtn").removeAttr('data-id');
        $(this).find("#save_closetrustedbyBtn").removeAttr('data-id');
        $('#trustedby_id').val("");
        $('#trustedbyname-error').html("");
        $('#trustedbythumb-error').html("");
        var default_image = "{{ url('images/placeholder_image.png') }}";
        $('#trustedbythumb_image_show').attr('src', default_image);
    });

    $('body').on('click', '#deletetrustedbyBtn', function (e) {
        // e.preventDefault();
        var trustedby_id = $(this).attr('data-id');
        $("#DeletetrustedbyModal").find('#RemovetrustedbySubmit').attr('data-id',trustedby_id);
        $.get("{{ url('admin/trustedby') }}" +'/' + trustedby_id +'/edit', function (data) {
            $('#DeletetrustedbyModal').find('.modal-title').html("Remove " + data.redirect_url);
        })
    });

    $('body').on('click', '#RemovetrustedbySubmit', function (e) {
        $('#RemovetrustedbySubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var trustedby_id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/trustedby') }}" +'/' + trustedby_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeletetrustedbyModal").modal('hide');
                    $('#RemovetrustedbySubmit').prop('disabled',false);
                    $("#RemovetrustedbySubmit").find('.removeloadericonfa').hide();
                    trustedby_table();
                    toastr.success("Trusted By Deleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeletetrustedbyModal").modal('hide');
                    $('#RemovetrustedbySubmit').prop('disabled',false);
                    $("#RemovetrustedbySubmit").find('.removeloadericonfa').hide();
                    trustedby_table();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeletetrustedbyModal").modal('hide');
                $('#RemovetrustedbySubmit').prop('disabled',false);
                $("#RemovetrustedbySubmit").find('.removeloadericonfa').hide();
                trustedby_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('#DeletetrustedbyModal').on('hidden.bs.modal', function () {
        $(this).find("#RemovetrustedbySubmit").removeAttr('data-id');
    });

    $('#trustedbythumb').change(function(){
        $('#trustedbythumb-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#trustedbythumb-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ url('images/placeholder_image.png') }}";
            $('#trustedbythumb_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#trustedbythumb_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<!-- Trusted By JS end -->
@endsection
