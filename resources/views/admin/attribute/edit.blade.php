@extends('admin.main')
@section('header')
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
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
                                        <h4 class="h4 text-gray-900 mb-4">Chỉnh sửa thuộc tính</h4>
                                    </div>
                                    @include('alert')
                                    <form class="user" id="form" action="" method="post">

                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Loại thuộc tính</label>
                                            <input type="" class="form-control form-control-user" readonly="true"
                                                   value="{{ \Illuminate\Support\Facades\DB::table('list_of_values')
                                                                ->where('id_list', $id_list)
                                                                ->where('id_element', $id_element)
                                                                ->first()->name_list }}"
                                                   id="exampleInputPassword" placeholder="Tên thuộc tính" >
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Giá trị thuộc tính</label>
                                            <input type="" name="name_element" class="form-control form-control-user"
                                                   value="{{ \Illuminate\Support\Facades\DB::table('list_of_values')
                                                                ->where('id_list', $id_list)
                                                                ->where('id_element', $id_element)
                                                                ->first()->name_element }}"
                                                    id="exampleInputPassword" placeholder="Giá trị thuộc tính">
                                        </div>

                                        @csrf
                                        <a href="{{ route('attribute') }}" class="btn btn-primary"> Quay lại </a>
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


@endsection

