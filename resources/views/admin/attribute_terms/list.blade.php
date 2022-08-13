@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/attributes') }}">Attributes </a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Attribute Terms</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Attribute Terms of {{ $attributeName }}</h4>

                        <div class="action-section">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.attributes.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AttributeTermModal" id="AddAttrTermBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                        {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                        </div>
                        <div class="table-responsive">
                            <table id="attributesTerm" class="table zero-configuration customNewtable" style="width:100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Thumb</th>
                                <th>Attribute Term</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Thumb</th>
                                <th>Attribute Term</th>
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

    <div class="modal fade" id="AttributeTermModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form-valide" action="" id="attributeTermForm" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formtitle">Add New Term</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div id="attr-cover-spin" class="cover-spin"></div>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-form-label" for="attributetermname">Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control input-flat" id="attributetermname" name="attributetermname" placeholder="">
                                    <div id="attributetermname-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="displayattributename">Thumbnail
                                    </label>
                                    <input type="file" class="form-control-file" id="attrTermThumb" onchange="" name="attrtermthumb">
                                    <div id="attrTermThumb-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                    <img src="{{ url('images/placeholder_image.png') }}" class="" id="attrtermthumb_image_show" height="50px" width="50px" style="margin-top: 5px">
                                </div>

                                @if($isDescription == 1)
                                <div class="form-group">
                                    <label class="col-form-label" for="description">Description 
                                    </label>
                                    <textarea class="form-control input-flat" id="description" name="description" ></textarea>
                                    <div id="description-error" class="invalid-feedback animated fadeInDown" style="display: none;"></div>
                                </div>
                                @endif
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="attributeterm_id" id="attributeterm_id">

                        <button type="button" class="btn btn-outline-primary" id="save_newAttrTermBtn">Save & New <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                        <button type="button" class="btn btn-primary" id="save_closeAttrTermBtn">Save & Close <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteAttributeTermModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Term?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveAttributeTermSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- attribute terms JS start -->
<script type="text/javascript">
    $(document).ready(function() {
        attribute_term_table(true);
    });

    function save_attribute_term(btn,btn_type){
        $(btn).prop('disabled',true);
        $(btn).find('.loadericonfa').show();
        var attr_id = $(location).attr("href").split('/').pop();
        var action  = $(btn).attr('data-action');

        var formData = new FormData($("#attributeTermForm")[0]);
        formData.append('attr_id',attr_id);
        formData.append('action',action);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/addorupdateattributeTerm') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.status == 'failed'){
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    if (res.errors.attributetermname) {
                        $('#attributetermname-error').show().text(res.errors.attributetermname);
                    } else {
                        $('#attributetermname-error').hide();
                    }

                 

                    if (res.errors.attrtermthumb) {
                        $('#attrTermThumb-error').show().text(res.errors.attrtermthumb);
                    } else {
                        $('#attrTermThumb-error').hide();
                    }
                }

                if(res.status == 200){
                    if(btn_type == 'save_close'){
                        $("#AttributeTermModal").modal('hide');
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        if(res.action == 'add'){
                            attribute_term_table(true);
                            toastr.success("Attribute Term Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            attribute_term_table();
                            toastr.success("Attribute Term Updated",'Success',{timeOut: 5000});
                        }
                    }

                    if(btn_type == 'save_new'){
                        $(btn).prop('disabled',false);
                        $(btn).find('.loadericonfa').hide();
                        $("#AttributeTermModal").find('form').trigger('reset');
                        $("#AttributeTermModal").find("#save_newAttrTermBtn").removeAttr('data-action');
                        $("#AttributeTermModal").find("#save_closeAttrTermBtn").removeAttr('data-action');
                        $("#AttributeTermModal").find("#save_newAttrTermBtn").removeAttr('data-id');
                        $("#AttributeTermModal").find("#save_closeAttrTermBtn").removeAttr('data-id');
                        $('#attributeterm_id').val("");
                        $('#attributetermname-error').html("");
                        $('#attrTermThumb-error').html("");
                        var default_image = "{{ url('images/placeholder_image.png') }}";
                        $('#attrtermthumb_image_show').attr('src', default_image);
                        $("#attributetermname").focus();
                        if(res.action == 'add'){
                            attribute_term_table(true);
                            toastr.success("Attribute Term Added",'Success',{timeOut: 5000});
                        }
                        if(res.action == 'update'){
                            attribute_term_table();
                            toastr.success("Attribute Term Updated",'Success',{timeOut: 5000});
                        }
                    }
                }

                if(res.status == 400){
                    $("#AttributeTermModal").modal('hide');
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();
                    attribute_term_table();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#AttributeTermModal").modal('hide');
                $(btn).prop('disabled',false);
                $(btn).find('.loadericonfa').hide();
                attribute_term_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#save_newAttrTermBtn', function () {
        save_attribute_term($(this),'save_new');
    });

    $('body').on('click', '#save_closeAttrTermBtn', function () {
        save_attribute_term($(this),'save_close');
    });

    function attribute_term_table(is_clearState=false){
        if(is_clearState){
            $('#attributesTerm').DataTable().state.clear();
        }

        $('#attributesTerm').DataTable({
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
                "url": "{{ url('admin/allattributesTermlist') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: '{{ csrf_token() }}',attr_id: $(location).attr("href").split('/').pop() },
                // "dataSrc": ""
            },
            'columnDefs': [
                { "width": "50px", "targets": 0 },
                { "width": "145px", "targets": 1 },
                { "width": "230px", "targets": 2 },
                { "width": "50px", "targets": 3 },
                { "width": "120px", "targets": 4 },
                { "width": "120px", "targets": 5 },
            ],
            "columns": [
                {data: 'id', name: 'id', class: "text-center", orderable: false ,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'attrterm_thumb', name: 'attrterm_thumb', orderable: false, searchable: false, class: "text-center"},
                {data: 'attrterm_name', name: 'attrterm_name', class: "text-left"},
                {data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center"},
                {data: 'created_at', name: 'created_at', searchable: false, class: "text-left"},
                {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
            ]
        });
    }

    function chageAttributeTermStatus(attributeterm_id) {
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/chageattributeTermstatus') }}" +'/' + attributeterm_id,
            success: function (res) {
                if(res.status == 200 && res.action=='deactive'){
                    $("#AttributeTermtatuscheck_"+attributeterm_id).val(2);
                    $("#AttributeTermtatuscheck_"+attributeterm_id).prop('checked',false);
                    toastr.success("Attribute Term Deactivated",'Success',{timeOut: 5000});
                }
                if(res.status == 200 && res.action=='active'){
                    $("#AttributeTermtatuscheck_"+attributeterm_id).val(1);
                    $("#AttributeTermtatuscheck_"+attributeterm_id).prop('checked',true);
                    toastr.success("Attribute Term activated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    }

    $('body').on('click', '#AddAttrTermBtn', function (e) {
        $("#AttributeTermModal").find('.modal-title').html("Add New Term");
    });

    $('body').on('click', '#editAttributeTermBtn', function () {
        var attributeterm_id = $(this).attr('data-id');
        $.get("{{ url('admin/attributeTerm') }}" +'/' + attributeterm_id +'/edit', function (data) {
            $('#AttributeTermModal').find('.modal-title').html("Edit " + data.attrterm_name);
            $('#AttributeTermModal').find('#save_newAttrTermBtn').attr("data-action","update");
            $('#AttributeTermModal').find('#save_closeAttrTermBtn').attr("data-action","update");
            $('#AttributeTermModal').find('#save_newAttrTermBtn').attr("data-id",attributeterm_id);
            $('#AttributeTermModal').find('#save_closeAttrTermBtn').attr("data-id",attributeterm_id);
            $('#attributeterm_id').val(data.id);
            $('#attributetermname').val(data.attrterm_name);
            $('#description').val(data.description);
            if(data.attrterm_thumb==null){
                var default_image = "{{ url('images/placeholder_image.png') }}";
                $('#attrtermthumb_image_show').attr('src', default_image);
            }
            else{
                var attrterm_thumb = "{{ url('images/attrTermThumb') }}" +"/" + data.attrterm_thumb;
                $('#attrtermthumb_image_show').attr('src', attrterm_thumb);
            }
        })
    });

    $('#AttributeTermModal').on('shown.bs.modal', function (e) {
        $("#attributetermname").focus();
    });

    $('#AttributeTermModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find("#save_newAttrTermBtn").removeAttr('data-action');
        $(this).find("#save_closeAttrTermBtn").removeAttr('data-action');
        $(this).find("#save_newAttrTermBtn").removeAttr('data-id');
        $(this).find("#save_closeAttrTermBtn").removeAttr('data-id');
        $('#attributeterm_id').val("");
        $('#attributetermname-error').html("");
        $('#attrTermThumb-error').html("");
        var default_image = "{{ url('images/placeholder_image.png') }}";
        $('#attrtermthumb_image_show').attr('src', default_image);
    });

    $('body').on('click', '#deleteAttributeTermBtn', function (e) {
        // e.preventDefault();
        var attributeterm_id = $(this).attr('data-id');
        $("#DeleteAttributeTermModal").find('#RemoveAttributeTermSubmit').attr('data-id',attributeterm_id);
        $.get("{{ url('admin/attributeTerm') }}" +'/' + attributeterm_id +'/edit', function (data) {
            $('#DeleteAttributeTermModal').find('.modal-title').html("Remove " + data.attrterm_name);
        })
    });

    $('body').on('click', '#RemoveAttributeTermSubmit', function (e) {
        $('#RemoveAttributeTermSubmit').prop('disabled',true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var attributeterm_id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/attributeTerm') }}" +'/' + attributeterm_id +'/delete',
            success: function (res) {
                if(res.status == 200){
                    $("#DeleteAttributeTermModal").modal('hide');
                    $('#RemoveAttributeTermSubmit').prop('disabled',false);
                    $("#RemoveAttributeTermSubmit").find('.removeloadericonfa').hide();
                    attribute_term_table();
                    toastr.success("Attribute Term Deleted",'Success',{timeOut: 5000});
                }

                if(res.status == 400){
                    $("#DeleteAttributeTermModal").modal('hide');
                    $('#RemoveAttributeTermSubmit').prop('disabled',false);
                    $("#RemoveAttributeTermSubmit").find('.removeloadericonfa').hide();
                    attribute_term_table();
                    toastr.error("Please try again",'Error',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#DeleteAttributeTermModal").modal('hide');
                $('#RemoveAttributeTermSubmit').prop('disabled',false);
                $("#RemoveAttributeTermSubmit").find('.removeloadericonfa').hide();
                attribute_term_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('#DeleteAttributeTermModal').on('hidden.bs.modal', function () {
        $(this).find("#RemoveAttributeTermSubmit").removeAttr('data-id');
    });

    $('#attrTermThumb').change(function(){
        $('#attrTermThumb-error').hide();
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            $('#attrTermThumb-error').show().text("Please provide a Valid Extension Image(e.g: .jpg .png)");
            var default_image = "{{ url('images/placeholder_image.png') }}";
            $('#attrtermthumb_image_show').attr('src', default_image);
        }
        else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#attrtermthumb_image_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<!-- attribute terms JS end -->
@endsection
