@extends('front/layouts/masterlayout')
@section('content')
@section('title', 'Đặt lại mật khẩu')
@include('front.components.top-bar')

<div class="container-fluid justify-content-center d-flex align-items-center">
    <div class="row px-xl-5">
        <div class="col-lg-12" style=" width: 971px;">
            <div class="mb-4">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="code" value="{{$code}}">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            {!! $alert::my_alert() !!}
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Email</label>
                            <input disabled class="form-control" name="email"
                                type="email" value="{{$email}}">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Mật khẩu mới</label>
                            <input class="form-control @error('password') is-invalid @enderror" name="password"
                                type="password" placeholder="">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Nhập lại mật khẩu mới</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                type="password" placeholder="">
                            @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <button type="submit"
                                class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đặt lại mật khẩu</button>
                        </div>
                        <div class="col-md-12 form-group">
                            <a href="{{ route('loginUser') }}">Đăng nhập</a> -
                            <a href="{{ route('registerUser') }}">Đăng ký</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
