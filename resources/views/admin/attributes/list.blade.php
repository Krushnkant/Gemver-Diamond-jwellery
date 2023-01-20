@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Attributes </a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--<h4 class="card-title">Attributes </h4>--}}

                        <div class="action-section">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url',\Illuminate\Support\Facades\Route::currentRouteName())->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AttributeModal" id="AddBtn_AttrSpec"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                            {{--                            <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                        </div>

                        <!-- <div class="custom-tab-1">
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item attribute_page_tabs" data-tab="attribute_tab"><a class="nav-link active show" data-toggle="tab" href="">Attribute</a>
                                </li>
                                <li class="nav-item attribute_page_tabs" data-tab="specification_tab"><a class="nav-link" data-toggle="tab" href="">Specification</a>
                                </li>
                            </ul>
                        </div> -->

                        <div class="tab-pane fade show active table-responsive" id="attributes_tab">
                            <table id="attributes_page_table" class="table zero-configuration customNewtable" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Attribute Name</th>
                                    <th>Display Attribute Name</th>
                                    <th>Terms</th>
                                    <th>Use Been Filter</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Attribute Name</th>
                                    <th>Display Attribute Name</th>
                                    <th>Terms</th>
                                    <th>Use Been Filter</th>
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

    <div class="modal fade" id="AttributeModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="attributesform" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add New Attribute</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="attr-cover-spin" class="cover-spin"></div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-form-label" for="attributename" id="label_attributename">Attribute Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="attributename" name="attributename" placeholder="">
                            <div id="attributename-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="displayattributename" id="label_displayattributename">Display Attribute Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control input-flat" id="display_attrname" name="display_attrname" placeholder="">
                            <div id="display_attrname-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                        </div>
                        <div class="form-group" id="is_filter_div">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" id="is_filter" class="form-check-input" value="0" name="is_filter">Use Filter ?
                                </label>
                            </div>
                        </div>
                        <div class="form-group" id="is_dropdown_div" style="display:none;">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" id="is_dropdown" class="form-check-input" value="0"  name="is_dropdown">Use Dropdown ?
                                </label>
                            </div>
                        </div>
                        <div class="form-group" id="is_description_div" style="display:none;">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" id="is_description" class="form-check-input" value="0"  name="is_description">Use Term Description ?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="attribute_id" id="attribute_id">
                        {{--                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>--}}
                        <button type="button" class="btn btn-outline-primary" id="save_newAttrBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closeAttrBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteAttributeModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Attribute</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Attribute?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveAttributeSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- attribute JS start -->
    <script type="text/javascript">
        function get_attributes_page_tabType(){
            var tab_type;
            $('.attribute_page_tabs').each(function() {
                var thi = $(this);
                if($(thi).find('a').hasClass('show')){
                    tab_type = $(thi).attr('data-tab');
                }
            });
            return tab_type;
        }

        function save_attribute(btn,btn_type){
            $(btn).prop('disabled',true);
            $(btn).find('.loadericonfa').show();
            var formData = $("#attributesform").serializeArray();

            var tab_type = get_attributes_page_tabType();

            formData.push({ name: "tab_type", value: tab_type });

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/addorupdateattribute') }}",
                data: formData,
                success: function (res) {
                    if(res.status == 'failed'){
                        $(btn).find('.loadericonfa').hide();
                        $(btn).prop('disabled',false);
                        if (res.errors.attributename) {
                            $('#attributename-error').show().text(res.errors.attributename);
                        } else {
                            $('#attributename-error').hide();
                        }

                        if (res.errors.display_attrname) {
                            $('#display_attrname-error').show().text(res.errors.display_attrname);
                        } else {
                            $('#display_attrname-error').hide();
                        }
                    }

                    if(res.status == 200){
                        if(btn_type == 'save_close'){
                            $("#AttributeModal").modal('hide');
                            $(btn).find('.loadericonfa').hide();
                            $(btn).prop('disabled',false);
                            if(res.action == 'add'){
                                attribute_page_tabs(tab_type,true);
                                toastr.success("Attribute Added",'Success',{timeOut: 5000});
                            }
                            if(res.action == 'update'){
                                attribute_page_tabs(tab_type);
                                toastr.success("Attribute Updated",'Success',{timeOut: 5000});
                            }
                        }

                        if(btn_type == 'save_new'){
                            $(btn).find('.loadericonfa').hide();
                            $(btn).prop('disabled',false);
                            $("#AttributeModal").find('form').trigger('reset');
                            $('#attribute_id').val("");
                            $('#attributename-error').html("");
                            $('#display_attrname-error').html("");
                            $("#AttributeModal").find("#save_newAttrBtn").removeAttr('data-action');
                            $("#AttributeModal").find("#save_closeAttrBtn").removeAttr('data-action');
                            $("#AttributeModal").find("#save_newAttrBtn").removeAttr('data-id');
                            $("#AttributeModal").find("#save_closeAttrBtn").removeAttr('data-id');
                            $("#attributename").focus();
                            if(res.action == 'add'){
                                attribute_page_tabs(tab_type,true);
                                toastr.success("Attribute Added",'Success',{timeOut: 5000});
                            }
                            if(res.action == 'update'){
                                attribute_page_tabs(tab_type);
                                toastr.success("Attribute Updated",'Success',{timeOut: 5000});
                            }
                        }
                    }

                    if(res.status == 400){
                        $("#AttributeModal").modal('hide');
                        $(btn).find('.loadericonfa').hide();
                        $(btn).prop('disabled',false);
                        attribute_page_tabs(tab_type);
                        toastr.error("Please try again",'Error',{timeOut: 5000});
                    }
                },
                error: function (data) {
                    $("#AttributeModal").modal('hide');
                    $(btn).find('.loadericonfa').hide();
                    $(btn).prop('disabled',false);
                    attribute_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            });
        }

        $('body').on('click', '#save_newAttrBtn', function () {
            save_attribute($(this),'save_new');
        });

        $('body').on('click', '#save_closeAttrBtn', function () {
            save_attribute($(this),'save_close');
        });

        $('#AttributeModal').on('shown.bs.modal', function (e) {
            $("#attributename").focus();
        });

        $('#AttributeModal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
            $(this).find("#save_newAttrBtn").removeAttr('data-action');
            $(this).find("#save_closeAttrBtn").removeAttr('data-action');
            $(this).find("#save_newAttrBtn").removeAttr('data-id');
            $(this).find("#save_closeAttrBtn").removeAttr('data-id');
            $('#attribute_id').val("");
            $('#attributename-error').html("");
        });

        $('#DeleteAttributeModal').on('hidden.bs.modal', function () {
            $(this).find("#RemoveAttributeSubmit").removeAttr('data-id');
        });

        $(document).ready(function() {
            attribute_page_tabs('',true);
        });

        function attribute_page_tabs(tab_type='',is_clearState=false) {
            if(is_clearState){
                $('#attributes_page_table').DataTable().state.clear();
            }

            $('#attributes_page_table').DataTable({
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
                    "url": "{{ url('admin/allattributeslist') }}",
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
                    { "width": "75px", "targets": 5 },
                    { "width": "120px", "targets": 6 },
                    { "width": "115px", "targets": 7 },
                ],
                "columns": [
                    {data: 'id', name: 'id', class: "text-center" , orderable: false ,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'attribute_name', name: 'attribute_name', class: "text-left"},
                    {data: 'display_attrname', name: 'display_attrname', class: "text-left"},
                    {data: 'terms', name: 'terms', class: "text-left", orderable: false},
                    {data: 'is_filter', name: 'is_filter', class: "text-left", orderable: false},
                    {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                    {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
                    {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
                ]
            });
        }

        $(".attribute_page_tabs").click(function() {
            var tab_type = $(this).attr('data-tab');
            attribute_page_tabs(tab_type,true);
        });

        $('body').on('click', '#AddBtn_AttrSpec', function () {
            var edit_attribute_id = $(this).attr('data-id');
            var tab_type = get_attributes_page_tabType();
           
            if(tab_type=='attribute_tab'){
                $("#is_dropdown_div").hide();
                $("#is_description_div").hide();
                $('#AttributeModal').find('.modal-title').html("Add Attribute");
                $('#AttributeModal').find('#label_attributename').html("Attribute Name <span class='text-danger'>*</span>");
                $('#AttributeModal').find('#label_displayattributename').html("Display Attribute Name <span class='text-danger'>*</span>");
            }
            else{
                $("#is_dropdown_div").show();
                $("#is_description_div").show();
                $('#AttributeModal').find('.modal-title').html("Add Attribute");
                $('#AttributeModal').find('#label_attributename').html("Attribute Name <span class='text-danger'>*</span>");
                $('#AttributeModal').find('#label_displayattributename').html("Display Attribute Name <span class='text-danger'>*</span>");
            }
        });

        $('body').on('click', '#editAttributeBtn', function () {
            var edit_attribute_id = $(this).attr('data-id');
            var tab_type = get_attributes_page_tabType();
            if(tab_type=='attribute_tab'){
                $("#is_dropdown_div").hide();
                $("#is_description_div").hide();
                $('#AttributeModal').find('.modal-title').html("Edit Attribute");
            }
            else{
                $("#is_dropdown_div").show();
                $("#is_description_div").show();
                $('#AttributeModal').find('.modal-title').html("Edit Attribute");
            }

            $.get("{{ url('admin/attribute') }}" +'/' + edit_attribute_id +'/edit', function (data) {
                $('#AttributeModal').find('#save_newAttrBtn').attr("data-action","update");
                $('#AttributeModal').find('#save_closeAttrBtn').attr("data-action","update");
                $('#AttributeModal').find('#save_newAttrBtn').attr("data-id",edit_attribute_id);
                $('#AttributeModal').find('#save_closeAttrBtn').attr("data-id",edit_attribute_id);
                $('#attribute_id').val(data.id);
                $('#attributename').val(data.attribute_name);
                $('#display_attrname').val(data.display_attrname);
                if(data.is_filter == 1){
                    $('#is_filter').val(1);
                    $('#is_filter').attr('checked', true);
                }else {
                    $('#is_filter').val(0);
                    $('#is_filter').attr('checked', false);
                }

                if(data.is_dropdown == 1){
                    $('#is_dropdown').val(1);
                    $('#is_dropdown').attr('checked', true);
                }else {
                    $('#is_dropdown').val(0);
                    $('#is_dropdown').attr('checked', false);
                }

                if(data.is_description == 1){
                    $('#is_description').val(1);
                    $('#is_description').attr('checked', true);
                }else {
                    $('#is_description').val(0);
                    $('#is_description').attr('checked', false);
                }
            });
        });

        $('body').on('click', '#deleteAttributeBtn', function (e) {
            // e.preventDefault();
            var delete_attribute_id = $(this).attr('data-id');
            $("#DeleteAttributeModal").find('#RemoveAttributeSubmit').attr('data-id',delete_attribute_id);
            var tab_type = get_attributes_page_tabType();
            if(tab_type=='attribute_tab'){
                $('#DeleteAttributeModal').find('.modal-title').html("Remove Attribute");
                $('#DeleteAttributeModal').find('.modal-body').html("Are you sure you wish to remove this Attribute?");
            }
            else{
                $('#DeleteAttributeModal').find('.modal-title').html("Remove Attribute");
                $('#DeleteAttributeModal').find('.modal-body').html("Are you sure you wish to remove this Attribute?");
            }
        });

        $('body').on('click', '#RemoveAttributeSubmit', function (e) {
            $('#RemoveAttributeSubmit').prop('disabled',true);
            $(this).find('.removeloadericonfa').show();
            e.preventDefault();
            var remove_attribute_id = $(this).attr('data-id');

            var tab_type = get_attributes_page_tabType();

            $.ajax({
                type: 'GET',
                url: "{{ url('admin/attribute') }}" +'/' + remove_attribute_id +'/delete',
                success: function (res) {
                    if(res.status == 200){
                        $("#DeleteAttributeModal").modal('hide');
                        $('#RemoveAttributeSubmit').prop('disabled',false);
                        $("#RemoveAttributeSubmit").find('.removeloadericonfa').hide();
                        attribute_page_tabs(tab_type);
                        // redrawAfterDelete();
                        toastr.success("Attribute Deleted",'Success',{timeOut: 5000});
                    }

                    if(res.status == 400){
                        $("#DeleteAttributeModal").modal('hide');
                        $('#RemoveAttributeSubmit').prop('disabled',false);
                        $("#RemoveAttributeSubmit").find('.removeloadericonfa').hide();
                        attribute_page_tabs(tab_type);
                        toastr.error("Please try again",'Error',{timeOut: 5000});
                    }
                },
                error: function (data) {
                    $("#DeleteAttributeModal").modal('hide');
                    $('#RemoveAttributeSubmit').prop('disabled',false);
                    $("#RemoveAttributeSubmit").find('.removeloadericonfa').hide();
                    attribute_page_tabs(tab_type);
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            });
        });

        function chageAttributeStatus(attribute_id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/chageattributestatus') }}" +'/' + attribute_id,
                success: function (res) {
                    if(res.status == 200 && res.action=='deactive'){
                        $("#Attributestatuscheck_"+attribute_id).val(2);
                        $("#Attributestatuscheck_"+attribute_id).prop('checked',false);
                        toastr.success("Attribute Deactivated",'Success',{timeOut: 5000});
                    }
                    if(res.status == 200 && res.action=='active'){
                        $("#Attributestatuscheck_"+attribute_id).val(1);
                        $("#Attributestatuscheck_"+attribute_id).prop('checked',true);
                        toastr.success("Attribute activated",'Success',{timeOut: 5000});
                    }
                },
                error: function (data) {
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            });
        }


        $(document).on('change', '#is_filter', function(e) {
            if ($(this).is(':checked')) {
                $(this).val(1);
                $(this).attr('checked', true);
            }
            else {
                $(this).val(0);
                $(this).attr('checked', false);
            }
        });

        $(document).on('change', '#is_dropdown', function(e) {
            if ($(this).is(':checked')) {
                $(this).val(1);
                $(this).attr('checked', true);
            }else {
                $(this).val(0);
                $(this).attr('checked', false);
            }
        });

        $(document).on('change', '#is_description', function(e) {
            if ($(this).is(':checked')) {
                $(this).val(1);
                $(this).attr('checked', true);
            }else {
                $(this).val(0);
                $(this).attr('checked', false);
            }
        });

        /*function redrawAfterDelete() {
            var info = $('#attributes_page_table').DataTable().page.info();
            console.log(info.page);
            console.log(info.recordsTotal);
            console.log(info.page);
            console.log(info.length);

            if (info.page > 0) {


                // when we are in the second page or above
                if (info.recordsTotal-1 > info.page*info.length) {
                    // after removing 1 from the total, there are still more elements
                    // than the previous page capacity
                    $('#attributes_page_table').DataTable().draw( false )
                } else {
                    // there are less elements, so we navigate to the previous page
                    $('#attributes_page_table').DataTable().page( 'previous' ).draw( 'page' )
                }
            }
        }*/

        
        

    </script>
    <!-- attribute JS end-->
@endsection

