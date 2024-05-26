@extends('client.main')
@section('header')
    <link rel="shortcut icon" type="image/x-icon" href="/template/client/img/favicon.ico">

    <!-- JS
    ============================================ -->

    <!-- Plugins JS -->
    <script src="/template/client/js/plugins.js"></script>

    <!-- Main JS -->
    <script src="/template/client/js/main.js"></script>
    <!-- CSS
    ========================= -->
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/template/client/css/plugins.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="/template/client/css/style.css">

    <meta name="csrf-token" product="{{ csrf_token() }}">
@endsection

@section('product')
    <div class="shop_area shop_reverse">
        <div class="container">
            <div class="shop_inner_area">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <!--sidebar widget start-->
                        <div class="sidebar_widget">
                            <div class="widget_list widget_filter">
                                <h2>Filter by price</h2>
                                <form action="#">
                                    <div id="slider-range"></div>
                                    <button type="submit">Filter</button>
                                    <input type="text" name="text" id="amount" />

                                </form>
                            </div>
                            <div class="widget_list widget_categories">
                                <h2>Product categories</h2>
                                <ul>
                                    <li><a href="#">Categories1 <span>6</span></a> </li>
                                    <li><a href="#"> Categories2 <span>10</span></a> </li>
                                    <li><a href="#">Categories3 <span>4</span></a> </li>
                                    <li><a href="#"> Categories4 <span>4</span></a> </li>
                                    <li><a href="#">Categories5 <span>3</span></a> </li>

                                </ul>
                            </div>

                            <div class="widget_list widget_categories">
                                <h2>Manufacturer</h2>
                                <ul>
                                    <li><a href="#">Calvin Klein <span>6</span></a> </li>
                                    <li><a href="#"> Chanel <span>10</span></a> </li>
                                    <li><a href="#">Christian Dior <span>4</span></a> </li>
                                    <li><a href="#"> ferragamo <span>4</span></a> </li>
                                    <li><a href="#">hermes <span>10</span></a> </li>
                                    <li><a href="#">louis vuitton <span>8</span></a> </li>
                                    <li><a href="#">Tommy Hilfiger <span>7</span></a> </li>
                                    <li><a href="#">Versace <span>6</span></a> </li>

                                </ul>
                            </div>
                            <div class="widget_list widget_categories">
                                <h2>Select By Color</h2>
                                <ul>
                                    <li><a href="#">Black <span>6</span></a> </li>
                                    <li><a href="#"> Blue <span>10</span></a> </li>
                                    <li><a href="#">Brown <span>4</span></a> </li>
                                    <li><a href="#"> Green <span>4</span></a> </li>
                                    <li><a href="#">Pink <span>7</span></a> </li>
                                    <li><a href="#">White<span>8</span></a> </li>
                                    <li><a href="#">Yellow <span>5</span></a> </li>

                                </ul>
                            </div>
                            <div class="widget_list tag-cloud">
                                <h2>Popular Tags</h2>
                                <div class="tag_widget">
                                    <ul>
                                        <li><a href="#">Creams</a></li>
                                        <li><a href="#">Eyebrow Pencil</a></li>
                                        <li><a href="#">Eyeliner</a></li>
                                        <li><a href="#">Eye Shadow</a></li>
                                        <li><a href="#">Lotions</a></li>
                                        <li><a href="#">Mascara</a></li>
                                        <li><a href="#">Oils</a></li>
                                        <li><a href="#">Powders</a></li>
                                        <li><a href="#">Shampoos</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!--sidebar widget end-->
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <!--shop wrapper start-->
                        <!--shop toolbar start-->
                        <div class="shop_title">
                            <h1>shop</h1>
                        </div>
                        <div class="shop_toolbar_wrapper">
                            <div class="shop_toolbar_btn">

                                <button data-role="grid_3" type="button" class="active btn-grid-3" data-toggle="tooltip" title="3"></button>

                                <button data-role="grid_4" type="button"  class=" btn-grid-4" data-toggle="tooltip" title="4"></button>

                                <button data-role="grid_5" type="button"  class="btn-grid-5" data-toggle="tooltip" title="5"></button>

                                <button data-role="grid_list" type="button"  class="btn-list" data-toggle="tooltip" title="List"></button>
                            </div>
                            <div class=" niceselect_option">

                                <form class="select_option" action="#">
                                    <select name="orderby" id="short">

                                        <option selected value="1">Sort by average rating</option>
                                        <option  value="2">Sort by popularity</option>
                                        <option value="3">Sort by newness</option>
                                        <option value="4">Sort by price: low to high</option>
                                        <option value="5">Sort by price: high to low</option>
                                        <option value="6">Product Name: Z</option>
                                    </select>
                                </form>


                            </div>
                            <div class="page_amount">
                                <p>Showing 1–9 of 21 results</p>
                            </div>
                        </div>
                        <!--shop toolbar end-->

                        <div class="row shop_wrapper">
                            @foreach($products as $product)

                                <div class="col-lg-4 col-md-4 col-12 ">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="{{ $product->image }}" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img src="{{ $product->image }}" alt=""></a>

                                            <div class="quick_button">
                                                <a href="shop/product/{{ $product->id }}"title="quick_view">Xem sản phẩm</a>
                                            </div>

                                            <div class="double_base">
                                                <div class="product_sale">
                                                    <span>-7%</span>
                                                </div>
                                                <div class="label_product">
                                                    <span>new</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product_content grid_content">
                                            <h3><a href="product-details.html">{{ $product->name }}</a></h3>
                                            <span class="current_price">£60.00</span>
                                            <span class="old_price">£86.00</span>
                                        </div>


                                        <div class="product_content list_content">
                                            <h3><a href="product-details.html">Marshall Portable  Bluetooth</a></h3>
                                            <div class="product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product_price">
                                                <span class="current_price">£60.00</span>
                                                <span class="old_price">£86.00</span>
                                            </div>
                                            <div class="product_desc">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores eligendi quia fugiat minus doloribus distinctio assumenda pariatur, quidem laborum quae quasi suscipit. Cupiditate dolor blanditiis rerum aliquid temporibus, libero minus nihil, veniam suscipit? Autem repellendus illo, amet praesentium fugit, velit natus? Dolorum perferendis reiciendis in quam porro ratione eveniet, tempora saepe ducimus, alias?</p>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            @endforeach
                        </div>

                        <div class="shop_toolbar t_bottom">
                            <div class="pagination">
                                <ul>
                                    <li class="current">1</li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li class="next"><a href="#">next</a></li>
                                    <li><a href="#">>></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--shop toolbar end-->
                        <!--shop wrapper end-->
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('footer')

@endsection
