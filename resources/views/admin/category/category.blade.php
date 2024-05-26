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
                <h6 class="m-0 font-weight-bold text-primary">Danh sách loại sản phẩm</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên loại</th>
                            <th style="width: 70px"><a href="/admin/goods/category/add">Thêm</a></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($loaisp as $item)
                        <tr>
                            <th>{{ $item->id }}</th>
                            <th>{{ $item->name }}</th>
                            <th>
                                <a href="/admin/goods/category/edit/{{ $item->id }}"><i class="fas fa-edit"></i></a>
                                <a href="/admin/goods/category/delete/{{ $item->id }}"
                                   onclick="confirm('Xóa danh mục mà không thể khôi phục. Bạn có chắc?')"><i class="fas fa-trash-alt"></i></a>
                            </th>
                        </tr>
                        @endforeach

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
            if (confirm('Xóa danh mục sản phẩm mà không thể khôi phục. Bạn có chắc?')) {
                $.ajax({
                    type: 'DELETE',
                    datatype: 'JSON',
                    data: { id },
                    url: url,
                    success: function (result) {
                        if (result.error === false) {
                            alert(result.message);
                            location.reload();
                        }else{
                            alert(result.message);
                        }
                    }
                })
            }
        }
    </script>
@endsection
