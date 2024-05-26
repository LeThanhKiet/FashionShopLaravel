<div class="col-lg-3 col-md-6 offset-md-6 offset-lg-0">
    <div class="cart_area">
        <div class="middel_links">
        </div>
        <div class="cart_link">
            <a href="#"><i class="fa fa-shopping-basket"></i>
                @php
                    $totalPrice = 0;
                    $cart_products = \App\Http\Services\CartService::getProduct();
                @endphp
                @php
                if (isset($carts))
                {
                    echo count($carts).' sản phẩm';
                }
                else{
                    echo 'Trống';
                }
                @endphp
            </a>
            <!--mini cart-->
            <div class="mini_cart">
                @foreach($cart_products as $product)
                <div class="cart_item top">
                    <div class="cart_img">
                        <a href="{{ $product->id_product }}-{{ Str::slug($product->name, '-') }}.html">
                            <img src="{{ $product->image }}" alt="">
                        </a>
                    </div>
                    <div class="cart_info">
                        <a href="{{ $product->id_product }}-{{ Str::slug($product->name, '-') }}.html">{{ $product->name }}</a>

{{--                        <span>{{ $carts[$product->id] }} x {{ number_format($product->price) }}</span>--}}
                        @php
                            $totalPrice += $carts[$product->id] * $product->price;
                            @endphp
                    </div>
                </div>
                @endforeach
                <div class="cart__table">
                    <table>
                        <tbody>
                        <tr>
                            <td class="text-left">Tổng tiền :</td>
                            <td class="text-right">{{ number_format($totalPrice) }} VND</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="cart_button view_cart">
                    <a href="/carts">Xem giỏ hàng</a>
                </div>
                <div class="cart_button checkout">
                    <a href="/checkout">Thanh toán</a>
                </div>
            </div>
            <!--mini cart end-->
        </div>
    </div>
</div>
