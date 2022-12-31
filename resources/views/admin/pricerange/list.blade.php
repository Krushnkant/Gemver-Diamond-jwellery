@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Price Range</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">User List</h4>--}}

                        <div class="action-section row">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <?php $page_id = \App\Models\ProjectPage::where('route_url',\Illuminate\Support\Facades\Route::currentRouteName())->pluck('id')->first(); ?>
                                @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PriceRangeModel" id="AddPriceRangeBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                @endif
                                
                            </div>
                            
                        </div>

                        <div class="tab-pane fade show active table-responsive" id="all_user_tab">
                            <table id="all_pricerange" class="table zero-configuration customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Start Price</th>
                                    <th>End Price</th>
                                    <th>Percentage/Amount</th>
                                    <th> Status</th>
                                    <th> Date</th>
                                    <th>Other</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                <th>No</th>
                                    <th>Start Price</th>
                                    <th>End Price</th>
                                    <th>Percentage/Amount</th>
                                    <th> Status</th>
                                    <th>Date</th>
                                    <th>Other</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PriceRangeModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="pricerangeform" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add Price Range</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="attr-cover-spin" class="cover-spin"></div>
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label class="col-form-label" for="start_price">Start Price <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control input-flat" id="start_price" name="start_price" min="0" onkeypress="return isNumber(event)" placeholder="">
                            <div id="start_price-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label" for="end_price">End Price <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control input-flat" id="end_price" name="end_price" min="0" onkeypress="return isNumber(event)"  placeholder="">
                            <div id="end_price-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="type">Type</label>
                            <select class="form-control" id="type" name="type">
                                    <option value="1" selected="">Percentage</option>
                                    <option value="2">Fixed</option>
                            </select>
                        </div>
                        
                        <div class="form-group ">
                       
                            <label class="col-form-label" id="Amount_label" for="percentage">Percentage (%) <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="percentage" name="percentage" placeholder="">
                            <div id="percentage-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="pricerange_id" id="pricerange_id">
                        <button type="button" class="btn btn-outline-primary" id="save_newPriceRangeBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closePriceRangeBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeletePriceRangeModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Price Range</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Price Range?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemovePriceRangeSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- user list JS start -->
<script type="text/javascript">
    $(document).ready(function() {
        pricerange_page_tabs('',true);
    });

    

    function save_pricerange(btn,btn_type){
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();

        var action  = $(btn).attr('data-action');

        var formData = new FormData($("#pricerangeform")[0]);

        formData.append('action',action);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/addorupdatepricerange') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    
                    if (res.errors.start_price) {
                        $('#start_price-error').show().text(res.errors.start_price);
                    } else {
                        $('#start_price-error').hide();
                    }

                    if (res.errors.end_price) {
                        $('#end_price-error').show().text(res.errors.end_price);
                    } else {
                        $('#end_price-error').hide();
                    }

                    if (res.errors.percentage) {
                        $('#percentage-error').show().text(res.errors.percentage);
                    } else {
                        $('#percentage-error').hide();
                    }

    
                }

                if(res.status == 200){
                    if(btn_type == 'save_close'){
                        $("#PriceRangeModel").modal('hide');
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        if(res.action == 'add'){
                            pricerange_page_tabs();
                            toastr.success("Price Range Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            pricerange_page_tabs();
                            toastr.success("Price Range Updated",'Success',{timeOut: 5000});
                        }
                    }

                    if(btn_type == 'save_new'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $("#PriceRangeModel").find('form').trigger('reset');
                        $("#PriceRangeModel").find("#save_newPriceRangeBtn").removeAttr('data-action');
                        $("#PriceRangeModel").find("#save_closePriceRangeBtn").removeAttr('data-action');
                        $("#PriceRangeModel").find("#save_newPriceRangeBtn").removeAttr('data-id');
                        $("#PriceRangeModel").find("#save_closePriceRangeBtn").removeAttr('data-id');
                        $('#pricerange_id').val("");
                        $('#start_price-error').html("");
                        $('#end_price-error').html("");
                        $('#percentage-error').html("");
                      
                    
                        $("#start_price").focus();
                        if(res.action == 'add'){
                            pricerange_page_tabs();
                            toastr.success("Price Range Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            pricerange_page_tabs();
                            toastr.success("Price Range Updated",'Success',{timeOut: 5000});
                        }
                    }
                }

                if(res.status == 400){
                    $("#PriceRangeModel").modal('hide');
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    pricerange_page_tabs();
                    if(res.message == ""){
                      toastr.error("Please try again",'Error',{timeOut: 5000});
                    }else{
                        toastr.error(res.message,'Error',{timeOut: 5000});  
                    }
                }
            },
            error: function (data) {
                $("#PriceRangeModel").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                pricerange_page_tabs();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#save_newPriceRangeBtn', function () {
        save_pricerange($(this),'save_new');
    });

    $('body').on('click', '#save_closePriceRangeBtn', function () {
        save_pricerange($(this),'save_close');
    });

    $('#PriceRangeModel').on('shown.bs.modal', function (e) {
        $("#start_price").focus();
    });

   

    $('#PriceRangeModel').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find("#save_newPriceRangeBtn").removeAttr('data-action');
        $(this).find("#save_closePriceRangeBtn").removeAttr('data-action');
        $(this).find("#save_newPriceRangeBtn").removeAttr('data-id');
        $(this).find("#save_closePriceRangeBtn").removeAttr('data-id');
        $('#pricerange_id').val("");
        $('#start_price-error').html("");
        $('#end_price-error').html("");
        $('#percentage-error').html("");
        
    });

    $('#DeletePriceRangeModel').on('hidden.bs.modal', function () {
        $(this).find("#RemovePriceRangeSubmit").removeAttr('data-id');
    });

    function pricerange_page_tabs(tab_type='',is_clearState=false) {
        if(is_clearState){
            $('#all_pricerange').DataTable().state.clear();
        }

        $('#all_pricerange').DataTable({
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
                "url": "{{ url('admin/allpricerangeslist') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: '{{ csrf_token() }}' ,tab_type: tab_type},
                // "dataSrc": ""
            },
            'columnDefs': [
                { "width": "50px", "targets": 0 },
                { "width": "145px", "targets": 1 },
                { "width": "165px", "targets": 2 },
                { "width": "230px", "targets": 3 },
                { "width": "75px", "targets": 4 },
                { "width": "120px", "targets": 5 },
                { "width": "115px", "targets": 6 },
            ],
            "columns": [
                {data: 'id', name: 'id', class: "text-center", orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'profile_pic', name: 'profile_pic', class: "text-center multirow"},
                {data: 'contact_info', name: 'contact_info', class: "text-left multirow", orderable: false},
                {data: 'percentage', name: 'percentage', class: "text-left multirow", orderable: false},
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }


    function changePricerangeStatus(pricerange_id) {
        //var tab_type = get_users_page_tabType();
       
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/changepricerangestatus') }}" +'/' + pricerange_id,
            success: function (res) {
                if(res.status == 200 && res.action=='deactive'){
                    $("#PriceRangestatuscheck_"+pricerange_id).val(2);
                    $("#PriceRangestatuscheck_"+pricerange_id).prop('checked',false);
                    pricerange_page_tabs();
                    toastr.success("Price Range Deactivated",'Success',{timeOut: 5000});
                }
                if(res.status == 200 && res.action=='active'){
                    $("#PriceRangestatuscheck_"+pricerange_id).val(1);
                    $("#PriceRangestatuscheck_"+pricerange_id).prop('checked',true);
                    pricerange_page_tabs();
                    toastr.success("Price Range activated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#AddPriceRangeBtn', function (e) {
        $("#PriceRangeModel").find('.modal-title').html("Add Price Range");
    });

    $('body').on('click', '#editPriceRangeBtn', function () {
        var pricerange_id = $(this).attr('data-id');
        $.get("{{ url('admin/pricerange') }}" +'/' + pricerange_id +'/edit', function (data) {
            $('#PriceRangeModel').find('.modal-title').html("Edit Price Range");
            $('#PriceRangeModel').find('#save_closePriceRangeBtn').attr("data-action","update");
            $('#PriceRangeModel').find('#save_newPriceRangeBtn').attr("data-action","update");
            $('#PriceRangeModel').find('#save_closePriceRangeBtn').attr("data-id",pricerange_id);
            $('#PriceRangeModel').find('#save_newPriceRangeBtn').attr("data-id",pricerange_id);
            $('#pricerange_id').val(data.id);
            
            $('#start_price').val(data.start_price);
            $('#end_price').val(data.end_price);
            $('#percentage').val(data.percentage);
            
        })
    });

    $('body').on('click', '#deletePriceRangeBtn', function (e) {
        var delete_pricerange_id = $(this).attr('data-id');
        $("#DeletePriceRangeModel").find('#RemovePriceRangeSubmit').attr('data-id',delete_pricerange_id);
    });

    $('body').on('click', '#RemovePriceRangeSubmit', function (e) {
        $('#RemovePriceRangeSubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var remove_pricerange_id = $(this).attr('data-id');
          
        //var tab_type = get_users_page_tabType();

        $.ajax({
            type: 'GET',
            url: "{{ url('admin/pricerange') }}" +'/' + remove_pricerange_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeletePriceRangeModel").modal('hide');
                    $('#RemovePriceRangeSubmit').prop('disabled',false);
                    $("#RemovePriceRangeSubmit").find('.removeloadericonfa').hide();
                    pricerange_page_tabs();
                    toastr.success("Price Range Deleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeletePriceRangeModel").modal('hide');
                    $('#RemovePriceRangeSubmit').prop('disabled',false);
                    $("#RemovePriceRangeSubmit").find('.removeloadericonfa').hide();
                    pricerange_page_tabs();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeletePriceRangeModel").modal('hide');
                $('#RemovePriceRangeSubmit').prop('disabled',false);
                $("#RemovePriceRangeSubmit").find('.removeloadericonfa').hide();
                pricerange_page_tabs();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    
    $('body').on('change', '#type', function () {
        if($(this).val() == 1){
            $("#Amount_label").html("Percentage (%) <span class='text-danger'>*</span>");
        }
        else if($(this).val() == 2){
            $("#Amount_label").html("Amount <span class='text-danger'>*</span>");
        }
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<!-- user list JS end -->
@endsection

