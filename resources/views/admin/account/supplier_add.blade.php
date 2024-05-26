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
                                        <h4 class="h4 text-gray-900 mb-4">Tạo mới nhà cung cấp</h4>
                                    </div>
                                    @include('alert')
                                    <form class="user" id="form" action="" method="post">

                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Tên nhà cung cấp</label>
                                            <input type="" name="name" class="form-control form-control-user"
                                                   id="exampleInputPassword" placeholder="Nhập tên nhà cung cấp">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Mô tả </label>
                                            <input type="" name="description" class="form-control form-control-user"
                                                   id="exampleInputPassword" placeholder="Nhập mô tả">
                                        </div>
                                        @csrf
                                        <button class="btn btn-primary">Thêm</button>
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
@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
    </script>





@endsection
