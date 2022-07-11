@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Diamond</a></li>
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
                            Add Diamond CSV File
                            @else
                            Diamond List
                            @endif
                        </h4>

                        <div class="action-section">
                            <div class="d-flex">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.diamonds.list')->pluck('id')->first(); ?>
                            @if(isset($action) && $action!='create')
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" id="AddDiamondBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            @endif
                            </div>
                        </div>
                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Diamond" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Image</th>
                                        <th>Stone No</th>
                                        <th>Stock Status</th>
                                        <th>Shape</th>
                                        <th>Clarity</th>
                                        <th>Color</th>
                                        <th>Location</th>
                                        <th>Amt</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Image</th>
                                        <th>Stone No</th>
                                        <th>Stock Status</th>
                                        <th>Shape</th>
                                        <th>Clarity</th>
                                        <th>Color</th>
                                        <th>Location</th>
                                        <th>Amt</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            @endif
                            @if(isset($action) && $action=='create')
                                @include('admin.diamonds.importFile')
                            @endif
    
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<!-- blog JS start -->
<script type="text/javascript">

$(document).ready(function() {
    diamond_table(true);
});

$('body').on('click', '#AddDiamondBtn', function () {
    location.href = "{{ route('admin.importview') }}";
});

function diamond_table(is_clearState=false){
    if(is_clearState){
        $('#Diamond').DataTable().state.clear();
    }

    $('#Diamond').DataTable({
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
            "url": "{{ url('admin/alldiamondlist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}' },
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "50px", "targets": 0 },
            { "width": "120px", "targets": 1 },
            { "width": "170px", "targets": 2 },
            { "width": "100px", "targets": 3 },
            { "width": "70px", "targets": 4 },
            { "width": "120px", "targets": 5 },
            { "width": "120px", "targets": 6 },
            { "width": "120px", "targets": 7 },
            { "width": "120px", "targets": 8 },
            { "width": "120px", "targets": 9 },
            { "width": "120px", "targets": 10 },
        ],
        "columns": [
            {data: 'sr_no', name: 'sr_no', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'diamond_thumb', name: 'diamond_thumb', orderable: false, searchable: false, class: "text-center"},
            {data: 'Stone_No', name: 'Stone_No', class: "text-left"},
            {data: 'StockStatus', name: 'StockStatus', class: "text-left"},
            {data: 'Shape', name: 'Shape', class: "text-left"},
            {data: 'Clarity', name: 'Clarity', class: "text-left"},
            {data: 'Color', name: 'Color', class: "text-left"},
            {data: 'Location', name: 'Location', class: "text-left"},
            {data: 'Amt', name: 'Amt', class: "text-left"},
            {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
            {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
        ]
    });
}

$('body').on('click', '#save_closeDiamondBtn', function () {
    save_diamond($(this),'save_close');
});

$('body').on('click', '#save_newDiamondBtn', function () {
    save_diamond($(this),'save_new');
});

function save_diamond(btn,btn_type){
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    var action  = $(btn).attr('data-action');
    var formData = new FormData($("#DiamondCreateForm")[0]);
    formData.append('action',action);
    $.ajax({
        type: 'POST',
        url: "{{ route('admin.diamonds.save') }}",
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
                    location.href="{{ route('admin.diamond.list')}}";
                    if(res.action == 'add'){
                        toastr.success("Diamond Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Diamond Updated",'Success',{timeOut: 5000});
                    }
                }
                if(btn_type == 'save_new'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    location.href="{{ route('admin.importview')}}";
                    if(res.action == 'add'){
                        toastr.success("Diamond Added",'Success',{timeOut: 5000});
                    }
                    if(res.action == 'update'){
                        toastr.success("Diamond Updated",'Success',{timeOut: 5000});
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


function chageDiamondStatus(diamond_id) {
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/changediamondstatus') }}" +'/' + diamond_id,
        success: function (res) {
            if(res.status == 200 && res.action=='deactive'){
                $("#DiamondStatuscheck_"+diamond_id).val(2);
                $("#DiamondStatuscheck_"+diamond_id).prop('checked',false);
                toastr.success("Diamond Deactivated",'Success',{timeOut: 5000});
            }
            if(res.status == 200 && res.action=='active'){
                $("#DiamondStatuscheck_"+diamond_id).val(1);
                $("#DiamondStatuscheck_"+diamond_id).prop('checked',true);
                toastr.success("Diamond activated",'Success',{timeOut: 5000});
            }
        },
        error: function (data) {
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
}

</script>
<!-- blog JS end -->
@endsection

