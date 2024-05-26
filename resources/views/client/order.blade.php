@extends('client.main')

@section('content')
    <h3 class="text-black-50 text-center mb-5"> Đơn hàng của tôi </h3>
    <div class="container">
        <div class="row">
            @if($orders->isEmpty())
                <p class="text-center">Chưa có đơn hàng nào.</p>
            @else

                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Tên</th>
                        <th>Tổng số tiền</th>
                        <th>Trạng thái vận chuyển</th>
                        <th>Ngày đặt hàng</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr >
                            <td>{{ $order->user_name }}</td>
                            <td>{{ number_format($order->total_money) }}</td>
                            @if($order->kind == 1)
                                <td class="text-warning">Chờ xác nhận</td>
                            @elseif($order->kind == 2)
                                <td class="text-primary">Đang vận chuyển</td>
                            @elseif($order->kind == 3)
                                <td class="text-success">Đã giao hàng</td>
                            @elseif($order->kind == 4)
                                <td class="text-danger">Đã hủy</td>
                            @endif
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
