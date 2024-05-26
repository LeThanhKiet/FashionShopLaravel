@extends('admin.main')
@section('header')
    <!-- Custom styles for this page -->
    <link href="/template/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách thuộc tính sản phẩm</h6>
                <hr>
                <a href="/admin/goods/attribute/add" class="btn btn-primary">Thêm mới thuộc tính</a>
            </div>
            @include('alert')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr >
                            <th style="width: 25%">Tên thuộc tính</th>
                            <th style="width: 65%">Giá trị thuộc tính</th>
                            <th style="width: 10%">Sửa / Xóa</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($colors as $color)
                                <tr>
                                    <th>{{ $color->name_list }}</th>
                                    <th>{{ $color->name_element }}</th>
                                    <th>
                                        <a href="/admin/goods/attribute/edit/3/{{ $color->id_element }}"><i class="fas fa-edit"></i></a>
                                        <a href="/admin/goods/attribute/delete/3/{{ $color->id_element }}"><i class="fas fa-trash-alt"></i></a>
                                    </th>
                                </tr>
                            @endforeach
                            <hr style="height: 10px;">
                            @foreach($sizes as $size)
                                <tr>
                                    <th>{{ $size->name_list }}</th>
                                    <th>{{ $size->name_element }}</th>
                                    <th>
                                        <a href="/admin/goods/attribute/edit/4/{{ $size->id_element }}"><i class="fas fa-edit"></i></a>
                                        <a href="/admin/goods/attribute/delete/4/{{ $size->id_element }}"><i class="fas fa-trash-alt"></i></a>
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
