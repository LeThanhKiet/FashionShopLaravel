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
                                        <h4 class="h4 text-gray-900 mb-4">Chỉnh sửa sản phẩm</h4>
                                    </div>
                                    @include('alert')
                                    <form class="user" id="form" action="" method="post">

                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Tên sản phẩm</label>
                                            <input type="" name="name" class="form-control form-control-user" value="{{ $product->name }}"
                                                   id="exampleInputPassword" placeholder="Nhập tên sản phẩm">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Giá </label>
                                            <input type="number" min="0" name="price" value="100000" step="10000"
                                                   class="form-control form-control-user"
                                                   id="exampleInputPassword">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Tên loại </label>
                                            <select class="form-control" name="id_category">
                                                <option style = "background: #ecf0f1"
                                                    selected value="{{ $product->id_category }}">{{ \App\Models\Category::getCategoryName($product->id_category)->name }}</option>
                                                {{--<option value="{{ $product->id_category }}">(Loại hiện tại) - {{ \App\Models\Product::getCategory($product->id_category) }}</option>--}}
                                                @foreach($categories as $category)
                                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Mô tả</label>
                                            <textarea name="description" id="editor1" rows="10" cols="80" >
                                                     {{$product->description}}
                                            </textarea>

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Hình ảnh </label>
                                            <br>
                                            <input id="ckfinder-input-1" name="image" type="text" style="width:60%" value="{{$product->image}}">

                                        </div>
                                        @csrf

                                    </form>
                                    <button id="ckfinder-popup-1" class="button-a button-a-background">Chọn ảnh</button>
                                    <br>
                                    <br>
                                    <div class="form-group" style="margin-bottom: 100px">
                                        <a style="float: left" href="/admin/goods/product"
                                           class="btn btn-primary btn-user btn-block col-lg-3">Trở về</a>
                                        <button type="submit" style="float: right;margin-top: 10px" form="form"
                                                class="btn btn-primary btn-user btn-block col-lg-3">
                                            Lưu chỉnh sửa
                                        </button>
                                    </div>
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
@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
    </script>
    <script src="/ckfinder/ckfinder.js"></script>
    <script>


        var button1 = document.getElementById('ckfinder-popup-1');

        button1.onclick = function () {
            selectFileWithCKFinder('ckfinder-input-1');
        };

        function selectFileWithCKFinder(elementId) {
            CKFinder.popup({
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function (finder) {
                    finder.on('files:choose', function (evt) {
                        var file = evt.data.files.first();
                        var output = document.getElementById(elementId);
                        output.value = file.getUrl();
                    });

                    finder.on('file:choose:resizedImage', function (evt) {
                        var output = document.getElementById(elementId);
                        output.value = evt.data.resizedUrl;
                    });
                }
            });
        }
    </script>
    <script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js" type="text/javascript"></script>


@endsection
