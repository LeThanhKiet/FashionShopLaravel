@extends('client.main')
@section('content')
@section('title', 'Thông tin cá nhân')
<!-- Page Header Start -->

<!-- Page Header End -->

<div class="container-fluid pt-5 justify-content-center d-flex align-items-center">
    <input type="hidden" name="user_id" value="">
    <div class="row px-xl-5">
        <div class="col-lg-12 ">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">@yield('title')</h4>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <table id="tableInformation" class="table table-bordered mb-0">
                            <tr>
                                <td>Họ và tên:</td>
                                <td id=""> {{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <td>Địa chỉ email:</td>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <td>Số điện thoại:</td>
                                <td>{{ Auth::user()->phone }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="info">
                            <label class="custom-control-label" for="info" data-toggle="collapse"
                                data-target="#changeInformation">Thay đổi thông tin</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="collapse mb-4" id="changeInformation">
                <h4 class="font-weight-semi-bold mb-4">Thay đổi thông tin</h4>
                <form action="" method="POST">
                    @csrf
                    <div class="row-12">
                        <div class="col-md-12 form-group">
                            <label>Họ và tên</label>
                            <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}">
                            <div class="name"></div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Địa chỉ email</label>
                            <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}">
                            <div class="email"></div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" name="phone"
                                value="{{ Auth::user()->phone }}">
                            <div class="phone"></div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button id="btnChangeInformation" type="button" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Thay đổi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $('#btnChangeInformation').click(function(e) {
            e.preventDefault()
            var url = "{{ Request::url() }}"
            var _token = $('input[name="_token"]').val()
            var user_id = {{ Auth::user()->id }}
            var name = $('input[name="name"]').val()
            var email = $('input[name="email"]').val()
            var phone = $('input[name="phone"]').val()
            $.ajax({
                url: "{{ route('user.information.change-information') }}",
                method: "POST",
                data: {
                    user_id: user_id,
                    name: name,
                    email: email,
                    phone: phone,
                    _token: _token
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.errors) {
                        $(".name").html(``);
                        $(".phone").html(``);
                        $(".email").html(``);
                        let resp = response.errors;
                        for (index in resp) {
                            $("." + index).html(`<div class="alert alert-danger">${resp[index]}</div>`);
                        }
                    }
                    if (response.success) {
                        let resp = response.success

                        Swal.fire({
                            title: `${resp['success']}`,
                            icon: 'success',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000,
                        })
                        $(".name").html(``);
                        $(".phone").html(``);
                        $(".email").html(``);

                        $("#tableInformation").load(url + " #tableInformation")
                    }

                },
            });
        })
    </script>

@endsection

@endsection
