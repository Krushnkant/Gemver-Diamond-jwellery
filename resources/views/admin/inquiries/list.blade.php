@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Inqiries</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">
                        Inqiries List
                        </h4>--}}
                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Inquiryform" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product Info</th>
                                        <th>Diamond Info</th>
                                        <th>Specification Info</th>
                                        <th>Contact Info</th>
                                        <th>Qty</th>
                                        <th>Inquiry Message</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product Info</th>
                                        <th>Diamond Info</th>
                                        <th>Specification Info</th>
                                        <th>Contact Info</th>
                                        <th>Qty</th>
                                        <th>Inquiry Message</th>
                                        <th>Date</th>
                                        <th>Action</th>
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

    <div class="modal fade" id="DeleteInquiryModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Inqiries</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Inquiry?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveInquirySubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- Social Platform JS start -->
<script type="text/javascript">


$(document).ready(function() {
    Inquiry_table(true);
});

function Inquiry_table(is_clearState=false){
    if(is_clearState){
        $('#Inquiryform').DataTable().state.clear();
    }

    $('#Inquiryform').DataTable({
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
            "url": "{{ url('admin/allinquirieslist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}'},
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "5%", "targets": 0 },
            { "width": "15%", "targets": 1 },
            { "width": "15%", "targets": 2 },
            { "width": "10%", "targets": 3 },
            { "width": "15%", "targets": 4 },
            { "width": "5%", "targets": 5 },
            { "width": "15%", "targets": 6 },
            { "width": "10%", "targets": 7 },
            { "width": "10%", "targets": 8 },

        ],
        "columns": [
            {data: 'id', user: 'id', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'product_info', name: 'product_info',class: "text-left multirow", orderable: false},
            {data: 'diamond_info', name: 'diamond_info',class: "text-left multirow", orderable: false},
            {data: 'spe_info', name: 'spe_info',class: "text-left multirow", orderable: false},
            {data: 'customer_info', name: 'customer_info',class: "text-left multirow", orderable: false},
            {data: 'qty', name: 'qty', class: "text-left", orderable: false},
            {data: 'message', name: 'message', class: "text-left multirow", orderable: false},
            {data: 'created_at', name: 'created_at', class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}



$('body').on('click', '#deleteInquiryBtn', function (e) {
    // e.preventDefault();
    var Inquiry_id = $(this).attr('data-id');

    $("#DeleteInquiryModal").find('#RemoveInquirySubmit').attr('data-id',Inquiry_id);
});

$('#DeleteInquiryModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveInquirySubmit").removeAttr('data-id');
});

$('body').on('click', '#RemoveInquirySubmit', function (e) {
    $('#RemoveInquirySubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var Inquiry_id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/Inquirys') }}" +'/' + Inquiry_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteInquiryModal").modal('hide');
                $('#RemoveInquirySubmit').prop('disabled',false);
                $("#RemoveInquirySubmit").find('.removeloadericonfa').hide();
                Inquiry_table();
                toastr.success("Inquiry Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteInquiryModal").modal('hide');
                $('#RemoveInquirySubmit').prop('disabled',false);
                $("#RemoveInquirySubmit").find('.removeloadericonfa').hide();
                Inquiry_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteInquiryModal").modal('hide');
            $('#RemoveInquirySubmit').prop('disabled',false);
            $("#RemoveInquirySubmit").find('.removeloadericonfa').hide();
            Inquiry_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});
</script>
<!-- Social Platform JS end -->
@endsection

