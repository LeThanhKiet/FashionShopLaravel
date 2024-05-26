@extends('admin.main')
@section('header')
    <!-- Custom styles for this page -->
    <link href="/template/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    @include('alert')
    <div class="container-fluid">
        <style>
            #th-name-product:hover{
                cursor: pointer;
            }
        </style>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách loại sản phẩm</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" align="center" style="text-align: center">
                        <thead>
                        <tr >
                            <th style="width: 15%">Ảnh</th>
                            <th style="width: 25%">Tên</th>
                            <th style="width: 15%">Loại</th>
                            <th style="width: 10%">Số lượng</th>
                            <th style="width: 15%">Số lượng mẫu mã</th>
                            <th style="width: 10%">Giá (VND)</th>
                            <th style="width: 5%"><a href="/admin/goods/product/add">Thêm</a></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $item)

                            <tr>
                                <th><img src="{{ $item->image }}"  style="width:50%;height:50%;"></th>
                                <th id = "th-name-product" onclick="location.href='product/detail/{{ $item->id }}'"> {{ $item->name }} </th>
                                <th>{{ \App\Models\Category::getCategoryName($item->id_category)->name }}</th>
                                <th>{{ \App\Models\ProductModel::getAllQuantity($item->id) }}</th>
                                <th>{{ \App\Models\ProductModel::getAllModel($item->id) }}</th>
                                <th>{{ \App\Models\Product::getPrice($item->id) }}</th>
                                <th>
                                    <a  href="/admin/goods/product/edit/{{$item->id}} ">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a  href="/admin/goods/product/delete/{{$item->id}}"
                                    onclick="confirm('Xóa sản phẩm sẽ bao gồm xóa mẫu mã sản phẩm. Bạn có chắc')" >
                                        <i class="far fa-trash-alt"></i>
                                    </a>
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
            if (confirm('Xóa sản phẩm bao gồm mẫu mã sán phẩm mà không thể khôi phục. Bạn có chắc?')) {
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
