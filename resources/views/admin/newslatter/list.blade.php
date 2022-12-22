@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">News Letter</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if(isset($action) && $action=='list')
                        <div class="action-section">
                            <div class="d-flex">
                                <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.newslatter.list')->pluck('id')->first(); ?>
                                @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                    <button type="button" class="btn btn-primary mr-2" id="AddNewsLatterBtn">Send Mail</button>
                                    <button type="button" class="btn btn-primary" id="AddWelcomeMailBtn">Welcome Mail</button>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="NewsLatterform" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && $action=='create')
                            @include('admin.newslatter.create')
                        @endif

                        @if(isset($action) && $action=='welcome_mail')
                            @include('admin.newslatter.welcome_mail')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<!-- Social Platform JS start -->
<script type="text/javascript">


$(document).ready(function() {
    NewsLatterform(true);
});

$('body').on('click', '#AddNewsLatterBtn', function () {
    location.href = "{{ route('admin.newslatter.add') }}";
});

$('body').on('click', '#AddWelcomeMailBtn', function () {
    location.href = "{{ route('admin.newslatter.welcome_mail') }}";
});

$('body').on('click', '#save_closeNewsLatterBtn', function () {
    save_newslatter($(this),'save_close');
});

$('body').on('click', '#save_newNewsLatterBtn', function () {
    save_newslatter($(this),'save_new');
});

function save_newslatter(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#NewsLatterCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.newslatter.save') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
               
    
                if (res.errors.subject) {
                    $('#subject-error').show().text(res.errors.subject);
                } else {
                    $('#subject-error').hide();
                }

                if (res.errors.message) {
                    $('#message-error').show().text(res.errors.message);
                } else {
                    $('#message-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.newslatter.list')}}";
                    toastr.success("Send Mail",'Success',{timeOut: 5000});
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.newslatter.add')}}";
                    toastr.success("Send Mail",'Success',{timeOut: 5000});
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


$('body').on('click', '#save_newWelcomeMailBtn', function () {
    save_welcome_mail($(this),'save_new');
});

function save_welcome_mail(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');

    var formData = new FormData($("#WelcomeMailCreateForm")[0]);
    formData.append('action',action);

    $.ajax({
        type: 'POST',
        url: "{{ route('admin.newslatter.save_welcome_mail') }}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if(res.status == 'failed'){
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();

                if (res.errors.message) {
                    $('#message-error').show().text(res.errors.message);
                } else {
                    $('#message-error').hide();
                }
            }

            if(res.status == 200){
                if(btn_type == 'save_close'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.newslatter.list')}}";
                    toastr.success("Welcome Mail Message",'Success',{timeOut: 5000});
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.newslatter.list')}}";
                    toastr.success("Welcome Mail Message",'Success',{timeOut: 5000});
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

function NewsLatterform(is_clearState=false){
    if(is_clearState){
        $('#NewsLatterform').DataTable().state.clear();
    }

    $('#NewsLatterform').DataTable({
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
            "url": "{{ url('admin/allnewslatterslist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}'},
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "10%", "targets": 0 },
            { "width": "50%", "targets": 1 },
            { "width": "10%", "targets": 2 },
        ],
        "columns": [
            {data: 'id', user: 'id', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'email', name: 'email', class: "text-left multirow" , orderable: false},
            {data: 'created_at', name: 'created_at', class: "text-left"},
        ]
    });
}



$('body').on('click', '#deleteContactBtn', function (e) {
    // e.preventDefault();
    var Contact_id = $(this).attr('data-id');

    $("#DeleteContactModal").find('#RemoveContactSubmit').attr('data-id',Contact_id);
});

$('#DeleteContactModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveContactSubmit").removeAttr('data-id');
});

$('body').on('click', '#RemoveContactSubmit', function (e) {
    $('#RemoveContactSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var Contact_id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/contacts') }}" +'/' + Contact_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteContactModal").modal('hide');
                $('#RemoveContactSubmit').prop('disabled',false);
                $("#RemoveContactSubmit").find('.removeloadericonfa').hide();
                Contact_table();
                toastr.success("Contact Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteContactModal").modal('hide');
                $('#RemoveContactSubmit').prop('disabled',false);
                $("#RemoveContactSubmit").find('.removeloadericonfa').hide();
                Contact_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteContactModal").modal('hide');
            $('#RemoveContactSubmit').prop('disabled',false);
            $("#RemoveContactSubmit").find('.removeloadericonfa').hide();
            Contact_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});
</script>
<!-- Social Platform JS end -->
@endsection

