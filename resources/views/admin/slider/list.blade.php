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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="width: 50px">ID</th>
                            <th>Tiêu Đề</th>
                            <th>Link</th>
                            <th>Ảnh</th>
                            <th>Cập Nhật</th>
                            <th style="width: 100px">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $key => $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->name }}</td>
                                <td>{{ $slider->url }}</td>
                                <td><a href="{{ $slider->thumb }}" target="_blank">
                                        <img src="{{ $slider->thumb }}" height="40px">
                                    </a>
                                </td>
                                <td>{{ $slider->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slider->id }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm"
                                       onclick="removeRow({{ $slider->id }}, '/admin/sliders/destroy')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {!! $sliders->links() !!}
@endsection

@section('footer')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function removeRow(id, url) {
            if (confirm('Xóa mà không thể khôi phục. Bạn có chắc?')) {
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
@endsection
