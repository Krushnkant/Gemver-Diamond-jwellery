@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Redirect List</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            @if(isset($action) && $action=='create')
                                Add New Redirect
                            @elseif(isset($action) && $action=='edit')
                                Edit Redirect
                            @elseif(isset($action) && $action=='import')
                                Import Excel    
                            @else
                            Redirect List
                            @endif
                        </h4>

                        <div class="action-section">
                            <div class="d-flex">
                                <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.redirect.list')->pluck('id')->first(); ?>
                                @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                    <button type="button" class="btn btn-primary" id="AddredirectBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                @endif
                                &nbsp;&nbsp;<button type="button" class="btn btn-primary" id="ImportBtn">Import</button>
                                &nbsp;&nbsp;<button type="button" class="btn btn-primary" id="ExportBtn">Export</button>
                                {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                            </div>
                        </div>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="redirect" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>From URL</th>
                                        <th>To URL</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>From URL</th>
                                        <th>To URL</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && $action=='create')
                            @include('admin.redirect.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.redirect.edit')
                        @endif

                        @if(isset($action) && $action=='import')
                            @include('admin.redirect.import')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteredirectModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove redirect</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this redirect?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="Removeredirectubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- redirect JS start -->
<script type="text/javascript">
$('body').on('click', '#AddredirectBtn', function () {
    location.href = "{{ route('admin.redirect.add') }}";
});

$('body').on('click', '#ImportBtn', function () {
    location.href = "{{ route('admin.redirect.importview') }}";
});

$('body').on('click', '#ExportBtn', function () {
    location.href = "{{ route('admin.redirect.export') }}";
});

$('body').on('click', '#save_closeredirectBtn', function () {
    save_redirect($(this),'save_close');
});

$('body').on('click', '#save_newredirectBtn', function () {
    save_redirect($(this),'save_new');
});

function save_redirect(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#redirectForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.redirect.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();

                if (res.errors.from_url) {
                    $('#from_url-error').show().text(res.errors.from_url);
                } else {
                    $('#from_url-error').hide();
                }

                if (res.errors.to_url) {
                    $('#to_url-error').show().text(res.errors.to_url);
                } else {
                    $('#to_url-error').hide();
                }

               
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.redirect.list')}}";
                    if(res.action == 'add'){
                        toastr.success("redirect Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("redirect Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.redirect.add')}}";
                    if(res.action == 'add'){
                        toastr.success("redirect Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("redirect Updated",'Success',{timeOut: 5000});
                    }
                }
            }

        },
        error: function (data) {
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}

$(document).ready(function() {
    redirect_table(true);
});

function redirect_table(is_clearState=false){
    if(is_clearState){
        $('#redirect').DataTable().state.clear();
    }

    $('#redirect').DataTable({
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
            "url": "{{ url('admin/allredirectlist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}'},
            // "dataSrc": ""
        },
        "buttons": [
            {
                extend: 'excel',
                text: 'Export to Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0, 1, 2, 3] // Include the columns you want to export
                }
            }
        ],
        'columnDefs': [
            { "width": "50px", "targets": 0 },
            { "width": "120px", "targets": 1 },
            { "width": "170px", "targets": 2 },
            { "width": "100px", "targets": 3 },
        ],
        "columns": [
            {data: 'no', name: 'no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'from_url', name: 'from_url', class: "text-left"},
            {data: 'to_url', name: 'to_url', class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

$('body').on('click', '#editredirectBtn', function () {
    var redirect_id = $(this).attr('data-id');
    var url = "{{ url('admin/redirect') }}" + "/" + redirect_id + "/edit";
    window.open(url,"_blank");
});

$('body').on('click', '#deleteredirectBtn', function (e) {
    // e.preventDefault();
    var redirect_id = $(this).attr('data-id');
    $("#DeleteredirectModal").find('#Removeredirectubmit').attr('data-id',redirect_id);
});

$('#DeleteredirectModal').on('hidden.bs.modal', function () {
    $(this).find("#Removeredirectubmit").removeAttr('data-id');
});

$('body').on('click', '#Removeredirectubmit', function (e) {
    $('#Removeredirectubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var redirect_id = $(this).attr('data-id');
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/redirect') }}" +'/' + redirect_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteredirectModal").modal('hide');
                $('#Removeredirectubmit').prop('disabled',false);
                $("#Removeredirectubmit").find('.removeloadericonfa').hide();
                redirect_table();
                toastr.success("redirect Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteredirectModal").modal('hide');
                $('#Removeredirectubmit').prop('disabled',false);
                $("#Removeredirectubmit").find('.removeloadericonfa').hide();
                redirect_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteredirectModal").modal('hide');
            $('#Removeredirectubmit').prop('disabled',false);
            $("#Removeredirectubmit").find('.removeloadericonfa').hide();
            redirect_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});

$('body').on('click', '#save_closeFileBtn', function () {
    save_file($(this),'save_close');
});

$('body').on('click', '#save_newFileBtn', function () {
    save_file($(this),'save_new');
});

function save_file(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#FileCreateForm")[0]);
    formData.append('action',action);
    $.ajax({
        type: 'POST',
        url: "{{ route('admin.redirect.import.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                if (res.errors.file) {
                    $('#file-error').show().text(res.errors.file);
                } else {
                    $('#file-error').hide();
                }

            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.redirect.list')}}";
                    if(res.action == 'add'){
                        toastr.success(" Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success(" Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.redirect.importview')}}";
                    if(res.action == 'add'){
                        toastr.success(" Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success(" Updated",'Success',{timeOut: 5000});
                    }
                }
            }

        },
        error: function (data) {
            $(btn).prop('disabled',false);
            $(btn).find('.loadericonfa').hide();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}

</script>
<!-- redirect JS end -->
@endsection

