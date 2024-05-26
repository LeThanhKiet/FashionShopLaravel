@extends('client.main')

@section('content')
    <!--shopping cart area start -->
    <div class="shopping_cart_area">
        <div class="container">
            @include('alert')

            @if(count($productModels) != 0)
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                @php $total = 0; @endphp
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product_remove">Xóa</th>
                                        <th class="product_thumb">Ảnh</th>
                                        <th class="product_name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product_quantity">Số lượng</th>
                                        <th class="product_total">Tổng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productModels as $productModel)
                                        @php
                                            $totalModel = 0;
                                            $price = $productModel->price;
                                            $priceEnd = $price * $carts[$productModel->id];
                                            $totalModel += $priceEnd;
                                        @endphp
                                    <tr>
                                        <td class="product_remove"><a href="/carts/delete/{{$productModel->id}}"><i class="fa fa-trash-o"></i></a></td>
                                        <td class="product_thumb"><a href="#">
                                                <img style="width: 50%; height: 50%" src="{{$productModel->image}}" alt=""></a></td>
                                        <td class="product_name"><a href="#">{{$productModel->name}}</a></td>
                                        <td class="product-price">{{ number_format($price, 0, '', '.') }} VND</td>
                                        <td class="product_quantity">
                                            <input min="1" max="100" value="{{$carts[$productModel->id]}}" type="number" name="product_quantity[{{$productModel->id}}]">
                                        </td>
                                        <td class="product_total">@php echo number_format($priceEnd).' VND'; @endphp</td>
                                        @php $total += $totalModel; @endphp
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <button type="submit">Cập nhật giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--coupon code area start-->
                <div class="coupon_area">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code left">
                                <h3>Mã giảm giá</h3>
                                <div class="coupon_inner">
                                    <p>Nhập mã giảm giá nếu có</p>
                                    <input placeholder="Mã giảm giá" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>Tổng tiền giỏ hàng</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>Tiền hàng</p>
                                        <p class="cart_amount">@php echo number_format($total). 'VND'; @endphp</p>
                                    </div>
                                    <div class="cart_subtotal ">
                                        <p>Phí giao hàng (miễn phí)</p>
                                        <p class="cart_amount"><span>Tổng:</span>{{number_format($total)}} VND</p>
                                    </div>
                                    <hr>
                                    <div class="cart_subtotal">
                                        <p>Tổng tiền phải trả</p>
                                        <p class="cart_amount">{{ number_format($total) }} VND</p>
                                    </div>
                                    <div class="checkout_btn">
                                        <a href="/checkout">Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end-->

            </form>
            @else
                <div class="text-center"><h2>Giỏ hàng trống</h2></div>
            @endif
        </div>
    </div>
    <!--shopping cart area end -->
@endsection
