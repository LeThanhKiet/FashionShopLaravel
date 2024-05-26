@extends('admin.main')
@section('header')
<!-- Custom styles for this page -->
<link href="/template/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h3 class="h3 mb-2 text-gray-800">Thông tin đơn hàng</h3>
        </div>
        <div class="card-body">
            <h4>
            @php
            if (!isset($order->id_saler))
            {

            }
            else {
                echo 'Nhân viên:'.\Illuminate\Support\Facades\DB::table('users')->where('id', $order->id_saler)->first()->name ?? 'Unknown User';
            }
            @endphp
            </h4>
            <h4>Khách hàng: {{ \Illuminate\Support\Facades\DB::table('users')->where('id', $order->id_customer)->first()->name ?? 'Unknown User'}}</h4>
            <h4>SĐT Khách: {{  \Illuminate\Support\Facades\DB::table('users')->where('id', $order->id_customer)->first()->phone ?? ''}} </h4>
            <h4>Địa chỉ: {{ \Illuminate\Support\Facades\DB::table('users')->where('id', $order->id_customer)->first()->address?? '' }} </h4>
            <h4>Thời gian: {{ $order->created_at  }} </h4>
            <h4>Tổng tiền: {{number_format($order->total_money)}} VND</h4>
            <h4>Ghi chú: {{$order->note}}</h4>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="float: left">Danh sách chi tiết hóa đơn {{ $order->id }} </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 5%">STT</th>
                        <th style="">Sản phẩm</th>
                        <th style="width: 15%">Số lượng</th>
                        <th style="width: 10%">Đơn giá</th>

                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $x=0
                    @endphp
                    @foreach($orderDetails as $item)
                        @php
                            $x+=1
                        @endphp
                        <tr>
                            <th>{{$x}}</th>
                            <th>{{ \Illuminate\Support\Facades\DB::table('product_models')->where('id', $item->id_model)->first()->name }}</th>
                            <th> {{$item->quantity}}</th>
                            <th>{{ \Illuminate\Support\Facades\DB::table('product_models')->where('id', $item->id_model)->first()->price }}</th>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a style="display: inline-block; float: left" href="{{ route('order') }}"
               class="btn btn-primary btn-user btn-block col-lg-1">Trở về</a>


            <a style="display: inline-block;  float: right" href="/admin/order/detailUpdate/{{$order->id}}"
               class="btn btn-primary btn-user btn-block col-lg-2">Xác nhận vận chuyển</a>

            <a style="display: inline-block; margin-right: 10px; float: right; " href="/admin/order/detailUpdateCancel/{{$order->id}}"
               class="btn btn-primary btn-user btn-block col-lg-2">Hủy đơn hàng</a>
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

@endsection
