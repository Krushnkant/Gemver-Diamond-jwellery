@extends('admin.layout')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="error-content">
                    <div class="card mb-0">
                        <div class="card-body text-center pt-5">
                            <h2 class="error-text text-primary">403</h2>
                            <h4 class="mt-4 mb-4 text-danger"><i class="fa fa-ban "></i> Permission Denied</h4>
                            <p>You don't have permission to open this page.</p>
                            <p>Contact Admin to get Permission.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
