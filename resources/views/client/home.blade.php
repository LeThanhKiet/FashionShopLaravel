@extends('client.main')

@section('content')
    <style>
        .niceselect_option1{
            padding: 10px;
        }
        .form_filter {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 10px;
        }
        .select_filter{
            height: 40px;
            width: 25%;
            font-size: 15px;
            border: 1px solid #ccc;
            color: #747474;
        }
    </style>
    <!--shop  area start-->
    <div class="shop_area shop_reverse">
        <div class="container">
            <div class="shop_inner_area">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <!--sidebar widget start-->
                        <div class="sidebar_widget">
                            <div class="widget_list widget_filter">
                                <h2>Lọc theo khoảng giá</h2>
                                <form action="" method="get">
                                    <div id="slider-range"></div>
                                    <button type="submit">Filter</button>
                                    <input type="hidden" name="start_price" id="start_price" value="50">
                                    <input type="hidden" name="end_price" id="end_price" value="500">
                                    <input type="text" id="amount"/>

                                </form>
                            </div>
                            <div class="widget_list widget_categories">
                                <h2>Product categories</h2>
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="c-{{ $category->id }}-{{ Str::slug($category->name, '-') }}"> {{$category->name}}
                                                <span>{{ \App\Models\Product::getSumProductByCategoryId($category->id) }}</span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <!--sidebar widget end-->
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <!--shop wrapper start-->
                        <!--shop toolbar start-->
                        <div class="shop_title">
                            <h1></h1>
                        </div>
                        <div class="shop_toolbar_wrapper1">

                            <div class=" niceselect_option1">

                                <form class="form_filter" action="">

                                    <select name="orderby" id="sort" class="select_filter">
                                        <option selected value="">Lọc sản phẩm</option>
                                        <option value="{{ \Illuminate\Support\Facades\Request::url() }}?sort_by=asc">Từ thấp đến cao</option>
                                        <option value="{{ \Illuminate\Support\Facades\Request::url() }}?sort_by=desc">Từ cao đến thấp</option>
{{--                                        <option value="{{ \Illuminate\Support\Facades\Request::url() }}?sort_by=popularity">Bán chạy nhất</option>--}}
{{--                                        <option value="{{ \Illuminate\Support\Facades\Request::url() }}?sort_by=newest">Mới nhất</option>--}}
                                    </select>
                                    <div class="page_amount" style="float: right;">
                                        <p>Showing {{ $products->firstItem() }}– {{ $products->lastItem() }} of {{ $products->total() }} results</p>
                                    </div>
                                </form>



                            </div>

                        </div>

                        <!--shop toolbar end-->
                        <div class="row shop_wrapper">
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-4 col-12 ">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html"><img
                                                    src="{{ $product->image }}" alt=""></a>
                                            <a class="secondary_img" href="{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html"><img
                                                    src="{{ $product->image }}" alt=""></a>
                                            <div class="quick_button">
                                                <a href="{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html"
                                                   data-bs-toggle="modal" data-bs-target="#modal_box"
                                                   title="Xem sản phẩm">+ Xem sản phẩm </a>
                                            </div>

                                            <div class="double_base">
                                            </div>
                                        </div>

                                        <div class="product_content grid_content">
                                            <h3><a href="product-details.html">{{ $product->name }}</a></h3>
                                            <span class="current_price">{{ number_format($product->price) }} VND</span>
                                        </div>


                                        <div class="product_content list_content">
                                            <h3><a href="product-details.html">{{ $product->name }}</a></h3>

                                            <div class="product_price">
                                                <span class="current_price">{{ $product->price }}</span>
                                            </div>
                                            <div class="product_desc">
                                                <p>{{ $product->description }}</p>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="shop_toolbar t_bottom" style="height: 60px; justify-content: right">
                            <div class="pagination" style="height: 100%">
                                <div >
                                    {{ $products->appends($_GET)->links() }}
                                </div>
                            </div>
                        </div>
                        <!--shop toolbar end-->
                        <!--shop wrapper end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->

@endsection

@section('footer')
    <!-- Page level plugins -->
    <script type="text/javascript" src="/template/admin/vendor/jquery/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){

            $('#sort').on('change', function(){
                var url = $(this).val();
                if(url) {
                    window.location = url;
                }
                return false;
            });
        });

    </script>


@endsection
