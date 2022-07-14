@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Offers</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Offers</h4>

                        <div class="action-section">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url',\Illuminate\Support\Facades\Route::currentRouteName())->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#OfferModal" id="AddBtn_AttrSpec"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            
                        </div>

                 

                        <div class="tab-pane fade show active table-responsive" id="offers_tab">
                            <table id="offers_page_table" class="table zero-configuration customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Expiry Date</th>
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

    <div class="modal fade" id="OfferModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="offersform" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add New Offer</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="attr-cover-spin" class="cover-spin"></div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-form-label" for="title" id="label_title">Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="title" name="title" placeholder="">
                            <div id="title-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="expiry_date" id="label_expiry_date">Expiry Date
                            </label>
                            <input type="date" class="form-control input-flat" id="expiry_date" name="expiry_date" placeholder="">
                            <div id="expiry_date-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="offer_id" id="offer_id">
                        
                        <button type="button" class="btn btn-outline-primary" id="save_newOfferBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closeOfferBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteOfferModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Offer</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Offer?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveOfferSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- offer JS start -->
    <script type="text/javascript">
      
      
        function save_offer(btn,btn_type){
            $(btn).prop('disabled',true);
            $(btn).find('.loadericonfa').show();
            var formData = $("#offersform").serializeArray();

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/addorupdateoffer') }}",
                data: formData,
                success: function (res) {
                    if(res.status == 'failed'){
                        $(btn).find('.loadericonfa').hide();
                        $(btn).prop('disabled',false);
                        if (res.errors.title) {
                            $('#title-error').show().text(res.errors.title);
                        } else {
                            $('#title-error').hide();
                        }

                        if (res.errors.expiry_date) {
                            $('#expiry_date-error').show().text(res.errors.expiry_date);
                        } else {
                            $('#expiry_date-error').hide();
                        }
                    }

                    if(res.status == 200){
                        if(btn_type == 'save_close'){
                            $("#OfferModal").modal('hide');
                            $(btn).find('.loadericonfa').hide();
                            $(btn).prop('disabled',false);
                            if(res.action == 'add'){
                                offer_page_tabs();
                                toastr.success("Offer Added",'Success',{timeOut: 5000});
                            }
                            if(res.action == 'update'){
                                offer_page_tabs();
                                toastr.success("Offer Updated",'Success',{timeOut: 5000});
                            }
                        }

                        if(btn_type == 'save_new'){
                            $(btn).find('.loadericonfa').hide();
                            $(btn).prop('disabled',false);
                            $("#OfferModal").find('form').trigger('reset');
                            $('#offer_id').val("");
                            $('#title-error').html("");
                            $("#OfferModal").find("#save_newOfferBtn").removeAttr('data-action');
                            $("#OfferModal").find("#save_closeOfferBtn").removeAttr('data-action');
                            $("#OfferModal").find("#save_newOfferBtn").removeAttr('data-id');
                            $("#OfferModal").find("#save_closeOfferBtn").removeAttr('data-id');
                            $("#title").focus();
                            if(res.action == 'add'){
                                offer_page_tabs();
                                toastr.success("Offer Added",'Success',{timeOut: 5000});
                            }
                            if(res.action == 'update'){
                                offer_page_tabs();
                                toastr.success("Offer Updated",'Success',{timeOut: 5000});
                            }
                        }
                    }

                    if(res.status == 400){
                        $("#OfferModal").modal('hide');
                        $(btn).find('.loadericonfa').hide();
                        $(btn).prop('disabled',false);
                       
                        toastr.error("Please try again",'Error',{timeOut: 5000});
                    }
                },
                error: function (data) {
                    $("#OfferModal").modal('hide');
                    $(btn).find('.loadericonfa').hide();
                    $(btn).prop('disabled',false);
            
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            });
        }

        $('body').on('click', '#save_newOfferBtn', function () {
            save_offer($(this),'save_new');
        });

        $('body').on('click', '#save_closeOfferBtn', function () {
            save_offer($(this),'save_close');
        });

        $('#OfferModal').on('shown.bs.modal', function (e) {
            $("#title").focus();
        });

        $('#OfferModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
            $(this).find("#save_newOfferBtn").removeAttr('data-action');
            $(this).find("#save_closeOfferBtn").removeAttr('data-action');
            $(this).find("#save_newOfferBtn").removeAttr('data-id');
            $(this).find("#save_closeOfferBtn").removeAttr('data-id');
            $('#offer_id').val("");
            $('#title-error').html("");
        });

        $('#DeleteOfferModal').on('hidden.bs.modal', function () {
            $(this).find("#RemoveOfferSubmit").removeAttr('data-id');
        });

        $(document).ready(function() {
            offer_page_tabs('',true);
        });

        function offer_page_tabs(tab_type='',is_clearState=false) {
            if(is_clearState){
                $('#offers_page_table').DataTable().state.clear();
            }

            $('#offers_page_table').DataTable({
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
                    "url": "{{ url('admin/allofferlist') }}",
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
                    { "width": "120px", "targets": 4 },
                    { "width": "115px", "targets": 5 },
                ],
                "columns": [
                    {data: 'id', name: 'id', class: "text-center" , orderable: false ,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'title', name: 'title', class: "text-left"},
                    {data: 'expiry_date', name: 'expiry_date', class: "text-left"},
                    {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                    {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
                    {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
                ]
            });
        }


        // $('body').on('click', '#AddBtn_AttrSpec', function () {
        //     var edit_offer_id = $(this).attr('data-id');
        //     var tab_type = get_offers_page_tabType();
           
            
        //         $('#OfferModal').find('.modal-title').html("Add Attribute");
        //         $('#OfferModal').find('#label_title').html("Attribute Name <span class='text-danger'>*</span>");
        //         $('#OfferModal').find('#label_displaytitle').html("Display Attribute Name");
           
        // });

        $('body').on('click', '#editOfferBtn', function () {
            var edit_offer_id = $(this).attr('data-id');
          
            // if(tab_type=='attribute_tab'){
            //     $("#is_dropdown_div").hide();
            //     $("#is_description_div").hide();
            //     $('#OfferModal').find('.modal-title').html("Edit Attribute");
            // }
            // else{
            //     $("#is_dropdown_div").show();
            //     $("#is_description_div").show();
            //     $('#OfferModal').find('.modal-title').html("Edit Specification");
            // }

            $.get("{{ url('admin/offers') }}" +'/' + edit_offer_id +'/edit', function (data) {
              
                $('#OfferModal').find('#save_newOfferBtn').attr("data-action","update");
                $('#OfferModal').find('#save_closeOfferBtn').attr("data-action","update");
                $('#OfferModal').find('#save_newOfferBtn').attr("data-id",edit_offer_id);
                $('#OfferModal').find('#save_closeOfferBtn').attr("data-id",edit_offer_id);
                $('#offer_id').val(data.id);
                $('#title').val(data.title);
                $('#expiry_date').val(data.expiry_date);
                
                
            });
        });

        $('body').on('click', '#deleteOfferBtn', function (e) {
            // e.preventDefault();
            var delete_offer_id = $(this).attr('data-id');
            $("#DeleteOfferModal").find('#RemoveOfferSubmit').attr('data-id',delete_offer_id);
            
           
            $('#DeleteOfferModal').find('.modal-title').html("Remove Offer");
            $('#DeleteOfferModal').find('.modal-body').html("Are you sure you wish to remove this Offer?");
            
        });

        $('body').on('click', '#RemoveOfferSubmit', function (e) {
            $('#RemoveOfferSubmit').prop('disabled',true);
            $(this).find('.removeloadericonfa').show();
            e.preventDefault();
            var remove_offer_id = $(this).attr('data-id');


            $.ajax({
                type: 'GET',
                url: "{{ url('admin/offers') }}" +'/' + remove_offer_id +'/delete',
                success: function (res) {
                    if(res.status == 200){
                        $("#DeleteOfferModal").modal('hide');
                        $('#RemoveOfferSubmit').prop('disabled',false);
                        $("#RemoveOfferSubmit").find('.removeloadericonfa').hide();
                        offer_page_tabs();
                        toastr.success("Offer Deleted",'Success',{timeOut: 5000});
                    }

                    if(res.status == 400){
                        $("#DeleteOfferModal").modal('hide');
                        $('#RemoveOfferSubmit').prop('disabled',false);
                        $("#RemoveOfferSubmit").find('.removeloadericonfa').hide();
                        offer_page_tabs();
                        toastr.error("Please try again",'Error',{timeOut: 5000});
                    }
                },
                error: function (data) {
                    $("#DeleteOfferModal").modal('hide');
                    $('#RemoveOfferSubmit').prop('disabled',false);
                    $("#RemoveOfferSubmit").find('.removeloadericonfa').hide();
                   
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            });
        });

        function chageOfferStatus(offer_id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/chageofferstatus') }}" +'/' + offer_id,
                success: function (res) {
                    if(res.status == 200 && res.action=='deactive'){
                        $("#Offerstatuscheck_"+offer_id).val(2);
                        $("#Offerstatuscheck_"+offer_id).prop('checked',false);
                        offer_page_tabs();
                        toastr.success("Offer Deactivated",'Success',{timeOut: 5000});
                    }
                    if(res.status == 200 && res.action=='active'){
                        $("#Offerstatuscheck_"+offer_id).val(1);
                        $("#Offerstatuscheck_"+offer_id).prop('checked',true);
                        offer_page_tabs();
                        toastr.success("Offer activated",'Success',{timeOut: 5000});
                    }
                },
                error: function (data) {
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            });
        }

    </script>
    <!-- attribute JS end-->
@endsection

