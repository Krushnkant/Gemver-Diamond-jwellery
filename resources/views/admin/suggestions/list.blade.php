@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Suggestions</a></li>
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
                         
                        Suggestions List
                         
                        </h4>--}}

                        @if(isset($action) && $action=='list')
                            <div class="table-responsive">
                                <table id="Suggestionform" class="table zero-configuration customNewtable" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>User</th>
                                        <th>Suggestion</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>User</th>
                                        <th>Suggestion</th>
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

    <div class="modal fade" id="DeleteSuggestionModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Suggestion</h5>
                </div>
                <div class="modal-body">
                    Are you sure you wish to remove this Suggestion?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-danger" id="RemoveSuggestionSubmit" type="submit">Remove <i class="fa fa-circle-o-notch fa-spin removeloadericonfa" style="display:none;"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- Social Platform JS start -->
<script type="text/javascript">


$(document).ready(function() {
    suggestion_table(true);
});

function suggestion_table(is_clearState=false){
    if(is_clearState){
        $('#Suggestionform').DataTable().state.clear();
    }

    $('#Suggestionform').DataTable({
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
            "url": "{{ url('admin/allSuggestionslist') }}",
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
            {data: 'id', user: 'id', class: "text-center", orderable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'user', name: 'user'},
            {data: 'suggestion', name: 'suggestion', class: "text-left multirow"},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center"},
        ]
    });
}



$('body').on('click', '#deleteSuggestionBtn', function (e) {

    // e.preventDefault();
    var Suggestion_id = $(this).attr('data-id');
    $("#DeleteSuggestionModal").find('#RemoveSuggestionSubmit').attr('data-id',Suggestion_id);
});

$('#DeleteSuggestionModal').on('hidden.bs.modal', function () {
    $(this).find("#RemoveSuggestionSubmit").removeAttr('data-id');
});

$('body').on('click', '#RemoveSuggestionSubmit', function (e) {
    $('#RemoveSuggestionSubmit').prop('disabled',true);
    $(this).find('.removeloadericonfa').show();
    e.preventDefault();
    var Suggestion_id = $(this).attr('data-id');
    
    $.ajax({
        type: 'GET',
        url: "{{ url('admin/suggestion') }}" +'/' + Suggestion_id +'/delete',
        success: function (res) {
            if(res.status == 200){
                $("#DeleteSuggestionModal").modal('hide');
                $('#RemoveSuggestionSubmit').prop('disabled',false);
                $("#RemoveSuggestionSubmit").find('.removeloadericonfa').hide();
                suggestion_table();
                toastr.success("Suggestion Deleted",'Success',{timeOut: 5000});
            }

            if(res.status == 400){
                $("#DeleteSuggestionModal").modal('hide');
                $('#RemoveSuggestionSubmit').prop('disabled',false);
                $("#RemoveSuggestionSubmit").find('.removeloadericonfa').hide();
                suggestion_table();
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        },
        error: function (data) {
            $("#DeleteSuggestionModal").modal('hide');
            $('#RemoveSuggestionSubmit').prop('disabled',false);
            $("#RemoveSuggestionSubmit").find('.removeloadericonfa').hide();
            suggestion_table();
            toastr.error("Please try again",'Error',{timeOut: 5000});
        }
    });
});
</script>
<!-- Social Platform JS end -->
@endsection

