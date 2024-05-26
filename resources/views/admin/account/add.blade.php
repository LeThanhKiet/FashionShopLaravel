@extends('admin.main')
@section('content')
    <div class="container-fluid">
    @include('alert')
    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }} nhân viên</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <form action="/admin/account/add" method="POST" id="form">
                        <div class="card-body">

                            <div class="form-group col-md-3">
                                <label for="menu">Tên tài khoản</label>
                                <input type="text" value="{{ old('name_account') }}" name="name_account" class="form-control" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="menu">Họ tên</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="menu">Mật khẩu</label>
                                <input type="text" value="{{ old('pass_account') }}" name="pass_account" class="form-control" >
                            </div>

                        </div>

                        @csrf
                        <button type="submit" class="btn btn-primary">Thêm mới</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
