@extends('admin.main')
@section('header')
    <!-- Custom styles for this page -->
    <link href="/template/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
        @csrf
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h3 class="h3 mb-2 text-gray-800">Chi tiết hóa đơn </h3>
                </div>
                <div class="card-body">
                    <h4>Nhân viên: {{ \Illuminate\Support\Facades\Auth::user()->name }}</h4>
                    <input type="hidden" name="id_staff" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

                    <h4>
                        <div class="col-sm-6 mb-3 mb-sm-0" style="padding-left: 0px;">
                            <label> Tên xưởng cung cấp </label>
                            <select class="form-control" name="id_supplier">
                                @foreach($ncc as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </h4>
                    <h4 class="totalMoney">Tổng tiền: </h4>
                </div>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" style="float: left">Danh sách hàng nhập</h6>
                    <button type="button" class="btn btn-primary add-item" style="float: right"> Thêm</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="width: 5%">Xóa</th>
                                <th style="width: 50%">Mẫu mã sản phẩm</th>
                                <th style="width: 25%">Số lượng</th>
                                <th style="width: 20%">Giá (VND)</th>
                            </tr>
                            </thead>
                            <tbody class="product_model">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="card shadow mb-4">
                <div class="card-header py-3 mb-md-3">
                    <a style="float: left" href="/admin/import/delete/"
                       class="btn btn-primary btn-user btn-block col-3">Trở về</a>
                    <button type="submit" class="btn btn-primary btn-user btn-block col-3" style="float: right;">Lưu
                    </button>

                </div>
            </div>

        </div>
    </form>
@endsection
@section('footer')
    <!-- Page level plugins -->
    <script src="/template/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/template/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    data: {id},
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
    <script>
        let productModelItem = `
        <tr class = "item">
        <td> <button type="button" class="btn btn-danger remove">&times;</button> </td>
        <td>
            <input type="text" id="txt_ide" list="ide" name="productModel[]"  autocomplete="off" class="form-control form-control-user"/>
            <datalist id="ide">
                @foreach($products as $product)
                    @php $productModels = \App\Models\ProductModel::getProductModelByProductId($product->id); @endphp
                    @foreach($productModels as $productModel)
                        <option value="{{ $productModel->name }}"></option>
                    @endforeach
                @endforeach
            </datalist>
        </td>
        <td>
            <input type="number" min="0" name="quantity[]"
                   class="form-control form-control-user quantity"
                   id="exampleInputPassword">
        </td>
        <td>
            <input type="number" min="0" name="price[]" value="100000" step="10000"
                   class="form-control form-control-user price" id = "productModelPrice"
                   id="exampleInputPassword">
        </td>
        </tr>
        `;
        $('.add-item').on('click', function () {
            $('.product_model').append(productModelItem);
        });

        $('.product_model').on('click', '.remove', function () {
            if (confirm('Xóa mẫu mã này?')) {
                $(this).parents('.item').remove();
            }
        });

    </script>
@endsection
