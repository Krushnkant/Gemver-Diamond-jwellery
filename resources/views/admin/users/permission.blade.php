@extends('admin.layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('admin/users') }}">User</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">User Permission</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Permission Data</h4>

                        <br>

                        <div class="col-lg-8 col-md-8 col-sm-12 offset-lg-2 offset-md-2 table-responsive" id="">
                            <form method="post" id="permissionForm" action="">
                            {{ csrf_field() }}
                            <table id="" class="table table-striped customNewtable userPermissionFormTable" style="">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Page</th>
                                    <th class="text-center">Read</th>
                                    <th class="text-center">Write</th>
                                    <th class="text-center">Remove</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $i=1; ?>
                                @foreach($user_permissions as $user_permission)
                                    <input type="hidden" value="{{ $user_permission->user_id }}" name="permission_user_id">
                                    <input type="hidden" class="project_page_ids" value="{{ $user_permission->project_page_id }}">
                                    <tr>
                                        <th class="text-center">{{ $i }}</th>
                                        <td>{{ $user_permission->project_page->label }}</td>
                                        <td class="text-center"><input type="checkbox" class="form-check-input permissionCheckBox" value="{{ $user_permission->can_read }}" name="canReadArr[]" {{ $user_permission->can_read==1?"checked":'' }} ></td>
                                        <td class="text-center"><input type="checkbox" class="form-check-input permissionCheckBox" value="{{ $user_permission->can_write }}" name="canWriteArr[]" {{ $user_permission->can_write==1?"checked":'' }} ></td>
                                        <td class="text-center"><input type="checkbox" class="form-check-input permissionCheckBox" value="{{ $user_permission->can_delete }}" name="canDeleteArr[]" {{ $user_permission->can_delete==1?"checked":'' }} ></td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-center"><button type="submit" id="savePermissionBtn" class="btn btn-primary">Save <i class="fa fa-circle-o-notch fa-spin loadericonfa" style="display:none;"></i></button></td>
                                </tr>
                                </tbody>
                            </table>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<!-- user Permission JS start-->
<script type="text/javascript">
    $('#permissionForm').on('submit', function (e) {
        $("#savePermissionBtn").find('.loadericonfa').show();
        $('#savePermissionBtn').prop('disabled',true);
        e.preventDefault();

        var permissionArray =[];
        $( ".project_page_ids" ).each(function() {
            var page_id = $(this).val();
            var can_read = $(this).next().find('input[name="canReadArr[]"]').val();
            var can_write = $(this).next().find('input[name="canWriteArr[]"]').val();
            var can_delete = $(this).next().find('input[name="canDeleteArr[]"]').val();

            var temp = {page_id: page_id, can_read: can_read, can_write: can_write, can_delete: can_delete};
            permissionArray.push(temp);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // console.log(permissionArray);

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.users.savepermission')  }}",
            data: {"user_id": $("input[name='permission_user_id']").val(), "permissionData": permissionArray},
            // processData: false,
            // contentType: false,
            success: function (res) {
                if(res.status == 200){
                    $("#savePermissionBtn").find('.loadericonfa').hide();
                    $('#savePermissionBtn').prop('disabled',false);
                    toastr.success("User Permission Updated",'Success',{timeOut: 5000});
                }
            },
            error: function (data) {
                $("#savePermissionBtn").find('.loadericonfa').hide();
                $('#savePermissionBtn').prop('disabled',false);
                toastr.error("Please try again",'Error',{timeOut: 5000});
            }
        });
    });

    $('.permissionCheckBox').click(function() {
        var thi = $(this);
        if ($(this).is(':checked')) {
            $(thi).attr('checked', true);
            $(thi).val(1);
        } else {
            $(thi).attr('checked', false);
            $(thi).val(0);
        }
    });
</script>
<!-- user Permission JS end-->
@endsection
