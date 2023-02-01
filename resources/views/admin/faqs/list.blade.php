@extends('admin.layout')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Faqs</a></li>
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
                            @if(isset($action) && $action=='create')
                                Add Faq
                            @elseif(isset($action) && $action=='edit')
                                Edit Faq
                            @else
                            Faqs List
                            @endif
                        </h4>--}}

                        <div class="action-section">
                            <?php $page_id = \App\Models\ProjectPage::where('route_url','admin.faqs.list')->pluck('id')->first(); ?>
                            @if(getUSerRole()==1 || (getUSerRole()!=1 && is_write($page_id)) )
                                <button type="button" class="btn btn-primary" id="AddFaqBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            @endif
                           
                        </div>

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Faqform" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        @if(isset($action) && $action=='create')
                            @include('admin.faqs.create')
                        @endif

                        @if(isset($action) && $action=='edit')
                            @include('admin.faqs.edit')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteFaqModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Faq</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Faq?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveFaqSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- Social Platform JS start -->
<script type="text/javascript">

$(document).ready(function() {
    faqs_table(true);
    CKEDITOR.replace('answer',{
    filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});

CKEDITOR.config.height = '300';


});

$("#menu_page_id").select2({
        width: '100%',
        multiple: true,
        placeholder: "Select...",
        allowClear: true,
        autoclose: false,
        closeOnSelect: false,
});

$('body').on('click', '#AddFaqBtn', function () {
    location.href = "{{ route('admin.faq.add') }}";
});

$('body').on('click', '#save_newFaqBtn', function () {
    save_faq($(this),'save_new');
});

$('body').on('click', '#save_closeFaqBtn', function () {
    save_faq($(this),'save_close');
});

function save_faq(btn,btn_type){
    
    $(btn).prop('disabled',true);
    $(btn).find('.loadericonfa').show();
    $('#name-error').hide().text("");
    $('#custom_fields-error').hide().text("");

    var action  = $(btn).attr('data-action');
    var answer = CKEDITOR.instances['answer'].getData();
    for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();   
    }
    var formData = new FormData($("#FaqForm")[0]);
    formData.append('action',action);
    formData.append('answer',answer);

    $.ajax({
            type: 'POST',
            url: "{{ route('admin.faqs.save') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == "failed") {
                    $(btn).prop('disabled',false);
                    $(btn).find('.loadericonfa').hide();

                    if (res.errors.answer) {
                        $('#question-error').show().text(res.errors.question);
                    } else {
                        $('#question-error').hide();
                    }

                    if (res.errors.answer) {
                        $('#answer-error').show().text(res.errors.answer);
                    } else {
                        $('#answer-error').hide();
                    }

                    if (res.errors.menu_page_id) {
                        $('#menu_page_id-error').show().text(res.errors.menu_page_id);
                    } else {
                        $('#menu_page_id-error').hide();
                    }
                }
                else if (res.status == 200) {
                    if (btn_type == 'save_close') {
                        $(btn).prop('disabled', false);
                        $(btn).find('.loadericonfa').hide();
                        location.href = "{{ route('admin.faqs.list')}}";
                        if (res.action == 'add') {
                            toastr.success("Faq Added", 'Success', {timeOut: 5000});
                        }
                        if (res.action == 'update') {
                            toastr.success("Faq Updated", 'Success', {timeOut: 5000});
                        }
                    }
                    if (btn_type == 'save_new') {
                        $(btn).prop('disabled', false);
                        $(btn).find('.loadericonfa').hide();
                        location.href = "{{ route('admin.faq.add')}}";
                        if (res.action == 'add') {
                            toastr.success("Faq Added", 'Success', {timeOut: 5000});
                        }
                        if (res.action == 'update') {
                            toastr.success("Faq Updated", 'Success', {timeOut: 5000});
                        }
                    }
                }
            },
            error: function (data) {
                console.log(data);
                $(btn).prop('disabled', false);
                $(btn).find('.loadericonfa').hide();
                toastr.error("Please try again", 'Error', {timeOut: 5000});
            }
    });
}



function faqs_table(is_clearState=false){
    if(is_clearState){
        $('#Faqform').DataTable().state.clear();
    }

    $('#Faqform').DataTable({
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
            "url": "{{ url('admin/allFaqslist') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: '{{ csrf_token() }}'},
            // "dataSrc": ""
        },
        'columnDefs': [
            { "width": "50px", "targets": 0 },
            { "width": "120px", "targets": 1 },
            { "width": "100px", "targets": 2 },
            { "width": "100px", "targets": 3 },
        ],
        "columns": [
            {data: 'id', question: 'id', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'question', name: 'question'},
            {data: 'answer', name: 'answer', class: "text-left multirow"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}

$('body').on('click', '#editFaqBtn', function () {
    var faq_id = $(this).attr('data-id');
    var url = "{{ url('admin/faq') }}" + "/" + faq_id + "/edit";
    window.open(url,"_blank");
});

$('body').on('click', '#deleteFaqBtn', function (e) {

    // e.preventDefault();
    var faq_id = $(this).attr('data-id');
    $("#DeleteFaqModal").find('#RemoveFaqSubmit').attr('data-id',faq_id);
});

$('#DeleteFaqModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveFaqSubmit").removeAttr('data-id');
});

$('body').on('click', '#RemoveFaqSubmit', function (e) {
    $('#RemoveFaqSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var faq_id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/faq') }}" +'/' + faq_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteFaqModal").modal('hide');
                $('#RemoveFaqSubmit').prop('disabled',false);
                $("#RemoveFaqSubmit").find('.removeloadericonfa').hide();
                faqs_table();
                toastr.success("Faq Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteFaqModal").modal('hide');
                $('#RemoveFaqSubmit').prop('disabled',false);
                $("#RemoveFaqSubmit").find('.removeloadericonfa').hide();
                faqs_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteFaqModal").modal('hide');
            $('#RemoveFaqSubmit').prop('disabled',false);
            $("#RemoveFaqSubmit").find('.removeloadericonfa').hide();
            faqs_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});
</script>
<!-- Social Platform JS end -->
@endsection

