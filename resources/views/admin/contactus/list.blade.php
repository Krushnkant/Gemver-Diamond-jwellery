@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Contacts</a></li>
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
                         
                        Contacts List
                         
                        </h4>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Contactform" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Contact Info</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Contact Info</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteContactModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Contact</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Contact?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveContactSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- Social Platform JS start -->
<script type="text/javascript">


$(document).ready(function() {
    Contact_table(true);
});

function Contact_table(is_clearState=false){
    if(is_clearState){
        $('#Contactform').DataTable().state.clear();
    }

    $('#Contactform').DataTable({
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
            "url": "{{ url('admin/allcontactslist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}'},
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "5%", "targets": 0 },
            { "width": "20%", "targets": 1 },
            { "width": "50%", "targets": 2 },
            { "width": "10%", "targets": 3 },

        ],
        "columns": [
            {data: 'id', user: 'id', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'customer_info', name: 'customer_info',class: "text-left multirow"},
            {data: 'message', name: 'message', class: "text-left multirow"},
            {data: 'created_at', name: 'created_at', class: "text-left"},
            // {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
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

