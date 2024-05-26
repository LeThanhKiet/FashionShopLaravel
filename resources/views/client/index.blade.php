@extends('client.main')

@section('content')
    <!--slider area start-->
    <div class="slider_area slider_style home_three_slider owl-carousel">
        @foreach($sliders as $slider)

            <div class="single_slider" data-bgimg="{{ $slider->thumb }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="slider_content content_two">
                                <p>{{ $slider->name }}</p>
                                <a href="{{$slider->url}}">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
    <!--slider area end-->

    <!--product section area start-->
    <section class="product_section womens_product">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Sản phẩm của chúng tôi</h2>
                        <p>Các sản phẩm thiết kế hiện đại,mới nhất</p>
                    </div>
                </div>
            </div>
            <div class="product_area">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="clothing" role="tabpanel">
                        <div class="product_container">
                            <div class="row product_column4">
                                @foreach($products as $product)
                                <div class="col-lg-3">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html"><img src="{{ $product->image }}" alt=""></a>

                                            <div class="quick_button">
                                                <a href="{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html" title="quick_view">Xem sản phẩm</a>

                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <h3><a href="{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html">{{ $product->name }}</a></h3>
                                            <span class="current_price">{{ number_format($product->price) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product section area end-->

    <section class="banner_section banner_section_three">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-6 col-md-6">
                    <div class="banner_area">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="assets/img/bg/banner11.jpg" alt="#"></a>
                            <div class="banner_content">
                                <h1>Handbag <br> Men’s Collection</h1>
                                <a href="shop.html">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="banner_area">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="assets/img/bg/banner12.jpg" alt="#"></a>
                            <div class="banner_content">
                                <h1>Sneaker <br> Men’s Collection</h1>
                                <a href="shop.html">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--product section area start-->
    <section class="product_section womens_product bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Sản phẩm thịnh hành</h2>
                        <p>Sản phẩm ấn tượng và bán chạy nhất</p>
                    </div>
                </div>
            </div>
            <div class="product_area">
                <div class="row">
                    <div class="product_carousel product_three_column4 owl-carousel">
                        @foreach($products as $product)
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a class="primary_img" href="{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html"><img src="{{ $product->image }}" alt=""></a>
                                    <div class="quick_button">
                                        <a href="{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html" title="quick_view">Xem sản phẩm</a>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <h3><a href="{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html">{{ $product->name }}</a></h3>
                                    <span class="current_price">{{ number_format($product->price) }} VND</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--product section area end-->
@endsection
















































