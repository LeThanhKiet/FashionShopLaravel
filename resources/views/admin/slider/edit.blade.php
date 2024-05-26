@extends('admin.main')

@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="" method="POST" id="form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="menu">Tiêu Đề</label>
                                        <input type="text" name="name" value="{{ $slider->name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="menu">Đường Dẫn</label>
                                        <input type="text" name="url" value="{{ $slider->url }}" class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="menu">Sắp Xếp</label>
                                <input type="number" name="sort_by" value="{{ $slider->sort_by }}" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>Kích Hoạt</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                                        {{ $slider->active == 1 ? 'checked' : '' }}>
                                    <label for="active" class="custom-control-label">Có</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                                        {{ $slider->active == 0 ? 'checked' : '' }}>
                                    <label for="no_active" class="custom-control-label">Không</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="thumb"> Hình ảnh </label>
                                <br>
                                <input id="ckfinder-input-1" name="thumb" type="text" style="width:60%" value="{{ $slider->thumb }}">

                            </div>
                        </div>
                        @csrf
                    </form>
                    <div class="card-footer">
                        <button type="submit" style="float: right;margin-top: 10px" form="form"
                                class="btn btn-primary btn-user btn-block col-lg-3">
                            Cập nhật Slider
                        </button>
                    </div>
                    <button id="ckfinder-popup-1" class="button-a button-a-background">Chọn ảnh</button>
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
