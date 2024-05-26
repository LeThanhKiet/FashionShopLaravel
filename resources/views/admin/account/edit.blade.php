@extends('admin.main')
@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-12    col-lg-12 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="h4 text-gray-900 mb-4">Chỉnh sửa tài khoản</h4>
                                    </div>
                                    @include('alert')
                                    <form class="user" action="" method="post">

                                        <div class="form-group">
                                            <input type="hidden" value="{{$user->id}}">
                                            <label for="exampleInputEmail"> Tên tài khoản</label>
                                            <input type="" name="username" class="form-control form-control-user"
                                                   id="exampleInputPassword" value="{{$user->username}}">

                                            <label for="exampleInputEmail"> Họ tên </label>

                                            <input type="" name="name" class="form-control form-control-user"
                                                   id="exampleInputPassword"
                                                   value="{{$user->name}}">

                                            <label for="exampleInputEmail"> Mật khẩu (giữ nguyên thì để trống) </label>
                                            <input type="" name="password" class="form-control form-control-user"
                                                   id="exampleInputPassword" placeholder="Mật khẩu">

                                            <a style="float: left" href="/admin/account/admin"
                                               class="btn btn-primary btn-user btn-block col-lg-3">Trở về</a>
                                            <button type="submit" style="float: right;margin-top: 10px" class="btn btn-primary btn-user btn-block col-lg-3">
                                                Lưu
                                            </button>

                                        </div>
                                        @csrf
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
