@extends('client.main')
@section('title', 'Đổi mật khẩu')
@section('content')
<div class="container-fluid justify-content-center d-flex align-items-center">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">@yield('title')</h4>
                <form action="" method="POST">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Mật khẩu cũ</label>
                            <input class="form-control @error('oldPassword') is-invalid @enderror" type="password"
                                name="oldPassword" value="{{ old('email') }}">
                            @error('oldPassword')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
                            <input class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                type="password" placeholder="">
                            @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <button  type="submit"
                                class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Thay đổi
                                </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection


