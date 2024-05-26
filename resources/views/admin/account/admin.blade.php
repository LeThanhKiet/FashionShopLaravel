@extends('admin.main')
@section('header')
    <!-- Custom styles for this page -->
    <link href="/template/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    @include('alert')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                <hr>
                <a href="/admin/account/add" class = "btn btn-primary">Thêm</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="35%">Tài khoản</th>
                            <th width="35%">Tên</th>
                            <th width="20%">Created At</th>
                            <th width="10%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>

                        {!!\App\Http\Controllers\Admin\AccountController::listAdmin($data)!!}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <!-- Page level plugins -->
    <script src="/template/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/template/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/template/admin/js/demo/datatables-demo.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function removeRow(id, url) {
            if (confirm('Xóa mà không thể khôi phục. Bạn có chắc ?')) {
                $.ajax({
                    type: 'DELETE',
                    datatype: 'JSON',
                    data: { id },
                    url: url,
                    success: function (result) {
                        if (result.error === false) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert('Xóa lỗi vui lòng thử lại');
                        }
                    }
                })
            }
        }
    </script>
@endsection
