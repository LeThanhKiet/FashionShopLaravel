@extends('admin.main')
@section('header')
    <!-- Custom styles for this page -->
    <link href="/template/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/template/admin/css/styles.css" rel="stylesheet" />
@endsection
@section('content')

    <!-- Product section-->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h3 class="h3 mb-2 text-gray-800">Chi tiết sản phẩm {{$product->id}}</h3>
            </div>
            <div class="card-body">
                <h4>Tên sản phẩm: {{ $product->name }}</h4>
                <h4>Loại sản phẩm: {{ \Illuminate\Support\Facades\DB::table('categories')->where('id', $product->id_category)->first()->name }}</h4>
                <h4>Số lượng: {{ \App\Models\ProductModel::getAllQuantity($product->id) }}</h4>
            </div>
        </div>
        @include('alert')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" style="float: left">Danh sách mẫu mã sản phẩm </h6>
                <button type="button" class="btn btn-primary" style="margin-left: 10px; float: right;">
                    <a href="{{ route('detail', ['id' => $product->id]) }}" style="color: white; text-decoration: none;">Cập nhập sản phẩm</a>
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalEdit"
                        style="margin-left: 10px; float: right;">
                    Sửa mẫu mã
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        style="float: right;">
                    Thêm mới mẫu mã
                </button>

                <!-- Modal -->
                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm mẫu mã sản phẩm</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('alert')
                                <form class="user" id="form" action="" method="post">
                                    <input type="hidden" name="add" id="addrequest">
                                    <div class="form-group">
                                        <label for="exampleInputName"> Tên sản phẩm</label>
                                        <input type="text" readonly = true name="name"
                                               class="form-control form-control-user"
                                               id="exampleInputName" value="{{ $product->name }}">
                                    </div>
                                    <input type="hidden" name="totalQuantity" value="{{ \App\Models\ProductModel::getAllQuantity($product->id) }}">
                                    <div class="form-group row">
                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Màu sắc</label>
                                            <select class="form-control" name="color">
                                                @foreach(\App\Models\ListOfValue::color() as $item)
                                                    <option value="{{$item->name_element}}">{{$item->name_element}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail"> Size</label>
                                            <select class="form-control" name="size">
                                                @foreach(\App\Models\ListOfValue::size() as $item)
                                                    <option value="{{$item->name_element}}">{{$item->name_element}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 ">
                                            <label for="exampleInputEmail"> Giá </label>
                                            <input type="number" min="0" name="price" value="{{ $product->price }}" step="10000"
                                                   class="form-control form-control-user"
                                                   id="exampleInputPassword">
                                        </div>
                                    </div>

                                    <label for="exampleInputEmail"> Ảnh </label>
                                    <input type="text" min="0" name="image"
                                           class="form-control form-control-user"
                                           id="ckfinder-input-1">
                                    @csrf

                                </form>
                                <button id="ckfinder-popup-1" class="button-a button-a-background">Chọn ảnh</button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" form="form" class="btn btn-primary"  onclick="requestadd();">Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="width: 5%">STT</th>
                            <th style="width: 20%">Ảnh</th>
                            <th style="width: 25%">Tên</th>
                            <th style="width: 10%">Màu</th>
                            <th style="width: 10%">Size</th>
                            <th style="width: 10%">Số lượng</th>
                            <th style="width: 15%">Giá (VND)</th>
                            <th style="width: 25%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $x=0
                        @endphp
                        @foreach($data as $item)
                            @php
                                $x+=1
                            @endphp
                            <tr>
                                <th>{{$x}}</th>
                                <th> <img src="{{ $item->image }}"  style="width:50%;height:50%;"> </th>
                                <th> {{$item->name}}</th>
                                <th> {{$item->color}}</th>
                                <th> {{$item->size}}</th>
                                <th>{{$item->quantity}}</th>
                                <th>{{$item->price}}</th>
                                <th>
                                    <a href="/admin/goods/product/detailDelete/{{ $item->id }}"
                                       onclick="confirm('Xóa mẫu mã mà không thể khôi phục. Bạn có chắc?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>

                                </th>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa mẫu mã sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="user" id="formedit" action="" method="post">
                            <div class="form-group">
                                <label for="exampleInputName"> Tên sản phẩm</label>
                                <input type="text" readonly = true name="name"
                                       class="form-control form-control-user"
                                       id="exampleInputName" value="{{ $product->name }}">
                            </div>

                            <div class="form-group row">
                                <div class="form-group">
                                    <label for="exampleInputEmail"> Màu sắc</label>
                                    <select class="form-control" name="color">
                                        @foreach(\App\Models\ListOfValue::color() as $item)
                                            <option value="{{$item->name_element}}">{{$item->name_element}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail"> Size</label>
                                    <select class="form-control" name="size">
                                        @foreach(\App\Models\ListOfValue::size() as $item)
                                            <option value="{{$item->name_element}}">{{$item->name_element}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 ">
                                    <label for="exampleInputEmail"> Giá </label>
                                    <input type="number" min="0" name="price" value="{{ $product->price }}" step="10000"
                                           class="form-control form-control-user"
                                           id="exampleInputPassword">
                                </div>
                            </div>
                            <input type="hidden" name="idmodel">
                            <label for="exampleInputEmail"> Ảnh </label>
                            <input type="text" min="0" name="image"
                                   class="form-control form-control-user"
                                   id="ckfinder-input-2" value="">
                            <input type="hidden" name="edit" id="editrequest">
                            @csrf

                        </form>
                        <button id="ckfinder-popup-2" class="button-a button-a-background">Chọn ảnh</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="formedit"  class="btn btn-primary" onclick="requestedit();">Sửa</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Edit -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a style="float: left" href="{{ route('product') }}"
                   class="btn btn-primary btn-user btn-block col-lg-1">Trở về</a>
{{--                <a style="float: right" href=""--}}
{{--                   class="btn btn-primary btn-user btn-block col-lg-3">Lưu</a>--}}
            </div>
        </div>

    </div>
    <!-- Related items section-->

@endsection
@section('footer')
    <!-- Page level plugins -->
    <script src="/template/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/template/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/template/admin/js/demo/datatables-demo.js"></script>
    {{--    ckfinder--}}
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
    </script>
    <script src="/ckfinder/ckfinder.js"></script>
    <script>
        function requestadd() {
            document.getElementById('addrequest').value = 'add';

        }
    </script>
    <script>
        function requestedit() {
            document.getElementById('editrequest').value = 'edit';
        }
    </script>
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
    <script>

        var button1 = document.getElementById('ckfinder-popup-2');
        button1.onclick = function () {
            selectFileWithCKFinder('ckfinder-input-2');
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function removeRow(id, url) {
            if (confirm('Xóa mẫu mã mà không thể khôi phục. Bạn có chắc?')) {
                $.ajax({
                    type: 'DELETE',
                    datatype: 'JSON',
                    data: { id },
                    url: url,
                    success: function (result) {
                        if (result.error === false) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert('Xóa lỗi vui lòng thử lại');
                        }
                    }
                })
            }
        }
    </script>
    <script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js" type="text/javascript"></script>
@endsection
