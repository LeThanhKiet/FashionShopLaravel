@extends('admin.main')

@section('content')
    <div class="container-fluid">
        @include('alert')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <form action="/admin/goods/attribute/add" method="POST" id="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="menu">Chọn tên thuộc tính</label>
                                <select name="id_list" id="">
                                    <option value="3">Color</option>
                                    <option value="4">Size</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="menu">Nhập giá trị thuộc tính</label>
                                <input type="text" value="{{ old('name_element') }}" name="name_element" class="form-control" >
                            </div>

                        </div>

                        @csrf
                        <button type="submit">Thêm mới</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
