@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Request Certificate</a></li>
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
                            Request Certificate List
                        </h4>--}}
                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Certificateform" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product Title</th>
                                        <th>Contact Info</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product Title</th>
                                        <th>Contact Info</th>
                                        <th>Message</th>
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


@endsection

@section('js')
<!-- Social Platform JS start -->
<script type="text/javascript">


$(document).ready(function() {
    Inquiry_table(true);
});

function Inquiry_table(is_clearState=false){
    if(is_clearState){
        $('#Certificateform').DataTable().state.clear();
    }

    $('#Certificateform').DataTable({
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
            "url": "{{ url('admin/allcertificateslist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}'},
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "5%", "targets": 0 },
            { "width": "10%", "targets": 1 },
            { "width": "10%", "targets": 2 },
            { "width": "20%", "targets": 3 },
            { "width": "10%", "targets": 4 },
            { "width": "10%", "targets": 5 },
        ],
        "columns": [
            {data: 'id', user: 'id', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'product_info', name: 'product_info',class: "text-left multirow", orderable: false},
            {data: 'customer_info', name: 'customer_info',class: "text-left multirow", orderable: false},
            {data: 'message', name: 'message', class: "text-left multirow", orderable: false},
            {data: 'created_at', name: 'created_at', class: "text-left"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}




</script>
<!-- Social Platform JS end -->
@endsection

