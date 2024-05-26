<!-- Main Wrapper Start -->
<!--Offcanvas menu area start-->
<div class="off_canvars_overlay">

</div>

<!--Offcanvas menu area end-->

<!--header area start-->
<header class="header_area header_shop">
    <!--header top start-->
    <!--header middel start-->
    <div class="header_middel">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-5">
                    <div class="logo d-none d-md-block">
                        <a href="/"><img src="assets/img/logo/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="search_bar">
                        <div class="search_bar">
                            <form action="/search" method="get">
                                <input placeholder="Tìm kiếm ở đây..." type="text" id="keyword" name="keyword" autocomplete="off">
                                <button type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @include('client.cart')
            </div>
        </div>
    </div>
    <!--header middel end-->

    <!--header bottom start-->
    <div class="header_bottom sticky-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 d-none d-md-block">
                    <div class="header_static">
                        <div class="main_menu_inner">
                            <div class="main_menu">
                                <nav>
                                    <ul>
                                        <li><a href="/">Trang chủ</a></li>
                                        <li class="mega_items"><a href="/shop">Danh mục <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                @php
                                                    $categories = \Illuminate\Support\Facades\DB::table('categories')->get();
                                                @endphp
                                                @foreach($categories as $category)
                                                    <li><a href="c-{{ $category->id }}-{{ Str::slug($category->name, '-') }}"> {{ $category->name }} </a></li>
                                                    <hr>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="/carts">Giỏ hàng</a></li>
                                        <li><a href="/checkout">Thanh toán</a></li>
                                        <li><a href="{{route('about')}}">Về chúng tôi </a></li>
                                        <li><a href="{{route('contact')}}">Liên lạc</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="ml-auto py-0 d-flex flex-row">
                            @if (Auth::check())
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Hi:
                                        {{ Auth::user()->name }}</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="{{ route('user.information') }}" class="dropdown-item">Thông tin cá nhân</a>
                                        <a href="{{ route('order') }}" class="dropdown-item">Đơn hàng</a>
                                        <a href="{{ route('user.change-password') }}" class="dropdown-item">Đổi mật khẩu</a>
                                        <a href="{{ route('logoutUser') }}" class="dropdown-item">{{ __('Đăng xuất') }}</a>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('loginUser') }}?redirect_uri={{ url()->full() }}" class="nav-item nav-link">{{  __('Đăng nhập') }} </a>
                                <a href="{{ route('registerUser') }}" class="nav-item nav-link">{{ __('Đăng ký') }}</a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Mobile Header Start -->
                <div class="col-12 d-block d-md-none">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="/"><img src="assets/img/logo/logo.png" alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="/">Trang chủ</a></li>
                                <li class="nav-item"><a class="nav-link" href="/shop">Danh mục</a></li>
                                <li class="nav-item"><a class="nav-link" href="/carts">Giỏ hàng</a></li>
                                <li class="nav-item"><a class="nav-link" href="/checkout">Thanh toán</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('about')}}">Về chúng tôi</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Liên lạc</a></li>
                            </ul>
                            <div class="ml-auto py-0 d-flex flex-row">
                                @if (Auth::check())
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Hi: {{ Auth::user()->name }}</a>
                                        <div class="dropdown-menu rounded-0 m-0">
                                            <a href="{{ route('user.information') }}" class="dropdown-item">Thông tin cá nhân</a>
                                            <a href="{{ route('order') }}" class="dropdown-item">Đơn hàng</a>
                                            <a href="{{ route('user.change-password') }}" class="dropdown-item">Đổi mật khẩu</a>
                                            <a href="{{ route('logoutUser') }}" class="dropdown-item">{{ __('Đăng xuất') }}</a>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('loginUser') }}?redirect_uri={{ url()->full() }}" class="nav-item nav-link">{{ __('Đăng nhập') }}</a>
                                    <a href="{{ route('registerUser') }}" class="nav-item nav-link">{{ __('Đăng ký') }}</a>
                                @endif
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- Mobile Header End -->
            </div>
        </div>
    </div>
    <!--header bottom end-->
</header>
<!--header area end-->

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        @if(isset($name))
                        <li><a href="/">Trang chủ</a></li>
                        <li>/</li>
                        <li>{{ $name }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->
