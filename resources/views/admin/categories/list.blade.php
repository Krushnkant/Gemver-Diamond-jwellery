@extends('admin.layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">
                        @if(isset($action) && $action=='create')
                        Add Category
                        @elseif(isset($action) && $action=='edit')
                        Edit Category
                        @else
                        Category List
                        @endif
                    </h4>--}}

                    <div class="action-section">
                        <div class="d-flex">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.categories.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                            <button type="button" class="btn btn-primary" id="AddCategoryBtn"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                            @endif
                            {{-- <button class="btn btn-danger" onclick="deleteMultipleAttributes()"><i
                                    class="fa fa-trash" aria-hidden="true"></i></button>--}}


                        </div>
                    </div>

                    @if(isset($action) && $action=='list')
                    <div class="table-responsive">
                        <table id="Category" class="table zero-configuration customNewtable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Parent Category Name</th>
                                    <th>Total Products</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Parent Name</th>
                                    <th>Total Products</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @endif

                    @if(isset($action) && $action=='create')
                    @include('admin.categories.create')
                    @endif

                    @if(isset($action) && $action=='edit')
                    @include('admin.categories.edit')
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteCategoryModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove Category</h5>
            </div>
            <div class="modal-body">
                <b>Are you sure you wish to remove this Category?</b> <br>
                This category made be used products,menu category,home banner,banner,menu page shap style... it will be
                remove all.
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                <button class="btn btn-danger" id="RemoveCategorySubmit" type="submit">Remove <i
                        class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- category JS start -->
<script type="text/javascript">

    $('#parent_category_id').select2({
        width: '100%',
        placeholder: "Select parent category",
        allowClear: true
    }).trigger('change');


    // $('#attribute_id_variation').select2({
    //     width: '100%',
    //     multiple: true,
    //     placeholder: "Select...",
    //     allowClear: true,
    //     autoclose: false,
    //     closeOnSelect: false,
    // });

    // $('#attribute_id_req_spec').select2({
    //     width: '100%',
    //     multiple: true,
    //     placeholder: "Select...",
    //     allowClear: true,
    //     autoclose: false,
    //     closeOnSelect: false,
    // });

    // $('#attribute_id_opt_spec').select2({
    //     width: '100%',
    //     multiple: true,
    //     placeholder: "Select...",
    //     allowClear: true,
    //     autoclose: false,
    //     closeOnSelect: false,
    // });

    $(document).ready(function () {
        attribute_id_req_spec($("#attribute_id_req_spec").val());
        attribute_id_opt_spec($("#attribute_id_opt_spec").val());
        category_table(true);
    });

    $('body').on('click', '#AddCategoryBtn', function () {
        location.href = "{{ route('admin.categories.add') }}";
    });

    $('body').on('click', '#save_closeCategoryBtn', function () {
        save_category($(this), 'save_close');
    });

    $('body').on('click', '#save_newCategoryBtn', function () {
        save_category($(this), 'save_new');
    });

    function save_category(btn, btn_type) {
        $(btn).prop('disabled', true);
        $(btn).find('.loadericonfa').show();
        var action = $(btn).attr('data-action');
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        var formData = new FormData($("#CategoryCreateForm")[0]);
        formData.append('action', action);

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.categories.save') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 'failed') {
                    $(btn).prop('disabled', false);
                    $(btn).find('.loadericonfa').hide();

                    if (res.errors.sr_no) {
                        $('#srno-error').show().text(res.errors.sr_no);
                    } else {
                        $('#srno-error').hide();
                    }

                    if (res.errors.category_name) {
                        $('#categoryname-error').show().text(res.errors.category_name);
                    } else {
                        $('#categoryname-error').hide();
                    }

                    if (res.errors.catImg) {
                        $('#categorythumb-error').show().text(res.errors.catImg);
                    } else {
                        $('#categorythumb-error').hide();
                    }

                    if (res.errors.category_description) {
                        $('#category_description-error').show().text(res.errors.category_description);
                    } else {
                        $('#category_description-error').hide();
                    }
                }

                if (res.status == 200) {
                    if (btn_type == 'save_close') {
                        $(btn).prop('disabled', false);
                        $(btn).find('.loadericonfa').hide();
                        location.href = "{{ route('admin.categories.list')}}";
                        if (res.action == 'add') {
                            toastr.success("Category Added", 'Success', { timeOut: 5000 });
                        }
                        if (res.action == 'update') {
                            toastr.success("Category Updated", 'Success', { timeOut: 5000 });
                        }
                    }
                    if (btn_type == 'save_new') {
                        $(btn).prop('disabled', false);
                        $(btn).find('.loadericonfa').hide();
                        location.href = "{{ route('admin.categories.add')}}";
                        if (res.action == 'add') {
                            toastr.success("Category Added", 'Success', { timeOut: 5000 });
                        }
                        if (res.action == 'update') {
                            toastr.success("Category Updated", 'Success', { timeOut: 5000 });
                        }
                    }
                }

            },
            error: function (data) {
                $(btn).prop('disabled', false);
                $(btn).find('.loadericonfa').hide();
                toastr.error("Please try again", 'Error', { timeOut: 5000 });
            }
        });
    }

    function category_table(is_clearState = false) {
        if (is_clearState) {
            $('#Category').DataTable().state.clear();
        }

        $('#Category').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            'stateSave': function () {
                if (is_clearState) {
                    return false;
                }
                else {
                    return true;
                }
            },
            "ajax": {
                "url": "{{ url('admin/allcategorylist') }}",
                "dataType": "json",
                "type": "POST",
                "data": { _token: '{{ csrf_token() }}' },
                // "dataSrc": ""
            },
            'columnDefs': [
                { "width": "50px", "targets": 0 },
                { "width": "120px", "targets": 1 },
                { "width": "170px", "targets": 2 },
                { "width": "170px", "targets": 3 },
                { "width": "100px", "targets": 4 },
                { "width": "70px", "targets": 5 },
                { "width": "120px", "targets": 6 },
                { "width": "120px", "targets": 7 },
            ],
            "columns": [
                {
                    data: 'sr_no', name: 'sr_no', class: "text-center", orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'category_thumb', name: 'category_thumb', orderable: false, searchable: false, class: "text-center" },
                { data: 'category_name', name: 'category_name', class: "text-left" },
                { data: 'parent_category_name', name: 'parent_category_name', class: "text-left" },
                { data: 'total_products', name: 'total_products', class: "text-center" },
                { data: 'estatus', name: 'estatus', orderable: false, searchable: false, class: "text-center" },
                { data: 'created_at', name: 'created_at', searchable: false, class: "text-left" },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center" },
            ]
        });
    }

    function chageCategoryStatus(category_id) {
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/changecategorystatus') }}" + '/' + category_id,
            success: function (res) {
                if (res.status == 200 && res.action == 'deactive') {
                    $("#CategoryStatuscheck_" + category_id).val(2);
                    $("#CategoryStatuscheck_" + category_id).prop('checked', false);
                    toastr.success("Category Deactivated", 'Success', { timeOut: 5000 });
                }
                if (res.status == 200 && res.action == 'active') {
                    $("#CategoryStatuscheck_" + category_id).val(1);
                    $("#CategoryStatuscheck_" + category_id).prop('checked', true);
                    toastr.success("Category activated", 'Success', { timeOut: 5000 });
                }
            },
            error: function (data) {
                toastr.error("Please try again", 'Error', { timeOut: 5000 });
            }
        });
    }



    $('body').on('click', '#deleteCategoryBtn', function (e) {
        // e.preventDefault();
        var category_id = $(this).attr('data-id');
        $("#DeleteCategoryModal").find('#RemoveCategorySubmit').attr('data-id', category_id);
    });

    $('body').on('click', '#RemoveCategorySubmit', function (e) {
        $('#RemoveCategorySubmit').prop('disabled', true);
        $(this).find('.removeloadericonfa').show();
        e.preventDefault();
        var category_id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{ url('admin/categories') }}" + '/' + category_id + '/delete',
            success: function (res) {
                if (res.status == 200) {
                    $("#DeleteCategoryModal").modal('hide');
                    $('#RemoveCategorySubmit').prop('disabled', false);
                    $("#RemoveCategorySubmit").find('.removeloadericonfa').hide();
                    category_table();
                    toastr.success("Category Deleted", 'Success', { timeOut: 5000 });
                }

                if (res.status == 400) {
                    $("#DeleteCategoryModal").modal('hide');
                    $('#RemoveCategorySubmit').prop('disabled', false);
                    $("#RemoveCategorySubmit").find('.removeloadericonfa').hide();
                    category_table();
                    toastr.error("Please try again", 'Error', { timeOut: 5000 });
                }

                if (res.status == 300) {
                    $("#DeleteCategoryModal").modal('hide');
                    $('#RemoveCategorySubmit').prop('disabled', false);
                    $("#RemoveCategorySubmit").find('.removeloadericonfa').hide();
                    category_table();
                    toastr.error("You cannot delete this category as long as it has child categories.", 'Error', { timeOut: 5000 });
                }
            },
            error: function (data) {
                $("#DeleteCategoryModal").modal('hide');
                $('#RemoveCategorySubmit').prop('disabled', false);
                $("#RemoveCategorySubmit").find('.removeloadericonfa').hide();
                category_table();
                toastr.error("Please try again", 'Error', { timeOut: 5000 });
            }
        });
    });

    $('#DeleteCategoryModal').on('hidden.bs.modal', function () {
        $(this).find("#RemoveCategorySubmit").removeAttr('data-id');
    });

    $('body').on('click', '#editCategoryBtn', function () {
        var category_id = $(this).attr('data-id');
        var url = "{{ url('admin/categories') }}" + "/" + category_id + "/edit";
        window.open(url, "_blank");
    });

    $('body').on('click', '#viewpopCategoryBtn', function () {
        var category_id = $(this).attr('data-id');
        var url = "{{ url('admin/categorysteppopup') }}" + "/" + category_id;
        window.open(url, "_blank");
    });

    function removeuploadedimg(divId, inputId, imgName) {
        if (confirm("Are you sure you want to remove this file?")) {
            $("#" + divId).remove();
            $("#" + inputId).removeAttr('value');
            var filerKit = $("#catIconFiles").prop("jFiler");
            filerKit.reset();
        }
    }

    $(document).ready(function () {

        @if (isset($action) && $action == 'create')

            $("#attribute_id_variation > option").removeAttr("selected");
        $("#attribute_id_variation").val('');
        $("#attribute_id_variation").find('option').prop("disabled", false);
        $("#attribute_id_variation").select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        $("#attribute_id_req_spec > option").removeAttr("selected");
        $("#attribute_id_req_spec").val('');
        $("#attribute_id_req_spec").find('option').prop("disabled", false);
        $('#attribute_id_req_spec').select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        $("#attribute_id_opt_spec > option").removeAttr("selected");
        $("#attribute_id_opt_spec").val('');
        $("#attribute_id_opt_spec").find('option').prop("disabled", false);
        $('#attribute_id_opt_spec').select2({
            width: '100%',
            multiple: true,
            placeholder: "Select...",
            allowClear: true,
            autoclose: false,
            closeOnSelect: false,
        });

        @endif
    });



    function attribute_id_req_spec(value) {
        $("#attribute_id_opt_spec").find('option').prop("disabled", false);
        //this returns all the selected item
        var attribute_id_req_spec = value;
        // console.log(attribute_id_req_spec);
        //Gets the last selected item
        // var lastSelectedItem = e.params.data.id;
        $.each(attribute_id_req_spec, function (index, val) {
            // console.log(index, val);
            $("#attribute_id_opt_spec").find('option[value=' + val + ']').prop("disabled", true);
        });
    }

    function attribute_id_opt_spec(value) {
        $("#attribute_id_req_spec").find('option').prop("disabled", false);
        //this returns all the selected item
        var attribute_id_opt_spec = value;
        // console.log(attribute_id_req_spec);
        //Gets the last selected item
        // var lastSelectedItem = e.params.data.id;
        $.each(attribute_id_opt_spec, function (index, val) {
            // console.log(index, val);
            $("#attribute_id_req_spec").find('option[value=' + val + ']').prop("disabled", true);
        });
    }



    $("#attribute_id_req_spec").on("select2:select select2:unselect", function (e) {
        attribute_id_req_spec($(this).val());
    });

    $("#attribute_id_opt_spec").on("select2:select select2:unselect", function (e) {
        attribute_id_opt_spec($(this).val());
    });


    $(document).on('change', '#is_custom', function () {
        if ($(this).is(':checked')) {
            $(this).val(1);
            $(this).attr('checked', true);
            $(".parent_category").hide();

        }
        else {
            $(this).val(0);
            $(this).attr('checked', false);
            $(".parent_category").show();
        }
    });

    $(document).on('change', '#category_name', function () {
        var value = this.value;
        $.ajax({
            type: "get",
            async: false,
            url: "{{ url('admin/categories/createSlug/') }}" + "/" + value,
            success: function (data) {
                $('#slug').val(data);
            }
        });
    });

    CKEDITOR.replace('category_description', {
        toolbar: [
            { name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
            { name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
            { name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
            { name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'] },

            { name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
            { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
            { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
            { name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
            '/',
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize', 'ShowBlocks'] },
            { name: 'others', items: ['-'] },
            { name: 'about', items: ['About'] }
        ],
        filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

    CKEDITOR.config.height = '300';
</script>
<!-- category JS end -->
@endsection