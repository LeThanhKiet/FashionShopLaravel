@extends('client.main')

@section('content')
    <!--product details start-->
    <div class="product_details">

        <div class="container">
            @include('alert')
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="product-details-tab">

                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="#">
                                <img id="zoom1" src="{{ $product->image }}" data-zoom-image="{{ $product->image }}" alt="big-1">
                            </a>
                        </div>

                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">


                                    @if(!empty($product_models_color))
                                        @foreach($product_models_color as $product_model)
                                            <li>
                                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{ $product_model->image }}" data-zoom-image="{{ $product_model->image }}">
                                                    <img src="{{ $product_model->image }}" alt="zo-th-1"/>
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                    <p>Sản phẩm chưa có hàng</p>
                                    @endif

                            </ul>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function getId() {
                        var selectBox = document.getElementById("productModel");
                        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                        document.getElementById("product_model_id").value = selectedValue;

                    }
                </script>
                <div class="col-lg-7 col-md-7">
                    <div class="product_d_right">
                        <form action="/addcart" method="post">
                            <h1>{{ $product->name }}</h1>
                            <div class="product_price">
                                <span class="current_price">{{ number_format($product->price) }} VND</span>
                            </div>
                            <div class="product_variant color">
                                <h3>Mẫu mã</h3>
                                <select class="niceselect_option" id="productModel" name="product_color" onchange="getId();" >
                                    <option selected value="{{ old('product_color') }}">Lựa chọn </option>
                                @foreach($product_models as $productModel)

                                    <option value="{{ $productModel->id  }}"> màu {{ $productModel->color }} - size {{ $productModel->size }}  - Còn {{ $productModel->quantity }} cái</option>
                                @endforeach

                                </select>


                            </div>

{{--                            <div class="product_variant color">--}}
{{--                                <h3>color</h3>--}}
{{--                                <select class="niceselect_option" id="color" name="product_color">--}}
{{--                                    @foreach($colors as $color)--}}
{{--                                        <option value="{{ $color->color  }}">{{ $color->color  }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="product_variant size">--}}
{{--                                <h3>size</h3>--}}
{{--                                <select class="niceselect_option" id="size" name="product_size">--}}
{{--                                        @foreach($sizes as $size)--}}
{{--                                            <option value="{{ $size->size  }}">{{ $size->size  }}</option>--}}
{{--                                        @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="product_variant quantity">
                                <?php if(count($product_models) != 0) { ?>
                                    <label>Số lượng</label>
                                    <input min="1" max="100" value="1" type="number" name="quantity">
                                    {{--sản phẩm--}}
                                    <input id="product_model_id" type="hidden" name="product_model_id" value="{{$product_models[0]->id}}">

                                    <button class="button" type="submit">Thêm vào giỏ hàng</button>
                                    <?php } else { ?>
                                    <button class="button" type="">Liên hệ <a href="tel:01234567890">01234567890</a></button>
                                    <?php } ?>
                            </div>
                            <div class=" product_d_action">

                            </div>
                            <hr>
                            <div class="product_desc">
                                <p> {!! $product->description !!} </p>
                            </div>
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product details end-->

@endsection
