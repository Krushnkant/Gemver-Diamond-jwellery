@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Darf Product</a></li>
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
                            Darf Product List
                        </h4>
                        <div class="table-responsive">
                            <table id="DarfProduct" class="table zero-configuration customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Product Title</th>
                                    <th>Categories</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Product Title</th>
                                    <th>Categories</th>
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

    <div class="modal fade" id="DeleteProductModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Draf Product</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Draf Product?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveProductSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        product_table(true);
    });

    function product_table(is_clearState=false){
        if(is_clearState){
            $('#DarfProduct').DataTable().state.clear();
        }

        $('#DarfProduct').DataTable({
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
                "url": "{{ url('admin/alldrafproductlist') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: '{{ csrf_token() }}'},
                // "dataSrc": ""
            },
            'columnDefs': [
                { "width": "50px", "targets": 0 },
                { "width": "120px", "targets": 1 },
                { "width": "170px", "targets": 2 },
                { "width": "240px", "targets": 3 },
                { "width": "120px", "targets": 4 },
                { "width": "120px", "targets": 5 },
                { "width": "120px", "targets": 6 }
            ],
            "columns": [
                {data: 'id', name: 'id', class: "text-center", orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'image', name: 'image', orderable: false, searchable: false, class: "text-center"},
                {data: 'product_title', name: 'product_title', class: "text-left multirow"},
                {data: 'categories', name: 'categories', class: "text-left", orderable: false},
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }
    
    $('body').on('click', '#editProductBtn', function () {
        var product_id = $(this).attr('data-id');
        {{--location.href = "{{ url('admin/products') }}" + "/" + product_id + "/edit";--}}
        var url = "{{ url('admin/products') }}" + "/" + product_id + "/edit";
        window.open(url,"_blank");
    });

    $('body').on('click', '#deleteProductBtn', function (e) {
        // e.preventDefault();
        var variant_id = $(this).attr('data-id');
        $("#DeleteProductModal").find('#RemoveProductSubmit').attr('data-id',variant_id);
    });

    $('body').on('click', '#RemoveProductSubmit', function (e) {
        $('#RemoveProductSubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var variant_id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/products') }}" +'/' + variant_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeleteProductModal").modal('hide');
                    $('#RemoveProductSubmit').prop('disabled',false);
                    $("#RemoveProductSubmit").find('.removeloadericonfa').hide();
                    product_table();
                    toastr.success("Product Deleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeleteProductModal").modal('hide');
                    $('#RemoveProductSubmit').prop('disabled',false);
                    $("#RemoveProductSubmit").find('.removeloadericonfa').hide();
                    product_table();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeleteProductModal").modal('hide');
                $('#RemoveProductSubmit').prop('disabled',false);
                $("#RemoveProductSubmit").find('.removeloadericonfa').hide();
                product_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

</script>
@endsection
