@extends('client.main')


@section('content')
    @include('alert')
    <div class="Checkout_section" id="accordion">
        <div class="container">
            <div class="checkout_form">
                <form action="" method="post" id="form">
                    <div class="row">
                        @csrf
                        {{--customer-information--}}
                        <div class="col-lg-6 col-md-6">
                            <h3>Chi tiết hóa đơn</h3>
                            <div class="row">

                                <div class="col-12 mb-20">
                                    <label>Họ tên: <span>*</span></label>
                                    <input type="text" id="customer_name" name="customer_name" value="" oninput="setName();" >
                                    <script type="text/javascript">
                                        function setName(){
                                            document.getElementById('name-1').value = document.getElementById('customer_name').value;
                                        }
                                    </script>
                                </div>

                                <div class="col-12 mb-20">
                                    <label> Email  <span>*</span></label>
                                    <input type="text" name="email" value="{{ old('email') }}" id="email" oninput="setEmail();" >
                                    <script type="text/javascript">
                                        function setEmail(){
                                            document.getElementById('email-1').value = document.getElementById('email').value;
                                        }
                                    </script>
                                </div>

                                <div class="col-lg-6 mb-20">
                                    <label> SĐT   <span>*</span></label>
                                    <input type="text" name = "phone" value="{{ old('phone') }}" id="phone" oninput="setPhone();" >
                                    <script type="text/javascript">
                                        function setPhone(){
                                            document.getElementById('phone-1').value = document.getElementById('phone').value;
                                        }
                                    </script>
                                </div>

                                <div class="col-lg-6 mb-20">
                                    <label> Địa chỉ nhận hàng  <span>*</span></label>
                                    <input type="text" name="address" value="{{ old('address') }}" id="address" oninput="setAddress();">
                                    <script type="text/javascript">
                                        function setAddress(){
                                            document.getElementById('address-1').value = document.getElementById('address').value;
                                        }
                                    </script>
                                </div>

                                <div class="col-12">
                                    <div class="order-notes">
                                        <label for="order_note">Ghi chú</label>
                                        <textarea id="order_note" placeholder="Ghi chú thêm về đơn hàng" style="height: 100px;" name="note" oninput="setNote();"></textarea>
                                        <script type="text/javascript">
                                            function setNote(){
                                                document.getElementById('note-1').value = document.getElementById('order_note').value;
                                            }
                                        </script>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{--end-customer-information--}}

                        {{--cart-information--}}
                        <div class="col-lg-6 col-md-6">
                            <h3>Đơn đặt hàng</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Tổng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $total = 0; @endphp
                                    @foreach($cart_products as $product)
                                        <tr>
                                            <td> {{$product->name}} <strong> × {{ $carts[$product->id] }}</strong></td>
                                            <td>
                                                @php
                                                    $total += $product->price*$carts[$product->id];
                                                @endphp
                                                {{ $product->price*$carts[$product->id] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="order_total">
                                        <th>Tổng đơn hàng</th>
                                        <td><strong>{{ $total }}</strong></td>
                                        <input type="hidden" name="total" value="{{ $total }}">

                                    </tr>
                                    </tfoot>
                                </table>
                            </div>


                        </div>
                        {{--end-cart-information--}}

                    </div>
                </form>

                {{--method-checkout--}}
                <div class="payment_method col-md-5">
                    <label for="order_button">Hình thức thanh toán</label>
                    <div class="order_button">
                        <button type="submit" form="form">
                            Ship COD
                        </button>

                        <div style="float: left; padding-right: 10px;">
                            <form action="{{route('checkout.momo_payment')}}" method="post">
                                @csrf
                                <button type="" >
                                    <input type="hidden" name="name_1" id="name-1" value="1">
                                    <input type="hidden" name="email_1" id="email-1" value="1">
                                    <input type="hidden" name="phone_1" id="phone-1" value="1">
                                    <input type="hidden" name="address_1" id="address-1" value="1">
                                    <input type="hidden" name="note_1" id="note-1" value="">
                                    @php

                                        $total_usd = round($total/23190, 2);
                                        \Illuminate\Support\Facades\Session::put('total', $total);
                                        \Illuminate\Support\Facades\Session::put('total_usd', $total_usd);
                                    @endphp
                                    <input type="hidden" name="totalMoney" value="{{ $total }}">
                                    <a class="">Online Momo</a>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                {{--end_method-checkout--}}
            </div>
        </div>
    </div>


@endsection

