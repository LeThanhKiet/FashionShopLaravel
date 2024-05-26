<!doctype html>
<html class="no-js" lang="en">

@include('client.header')

<body>

@include('client.head')

@yield('content')

@include('client.footer')
@yield('footer')
@include('client.modal')

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.min.js"></script>

<script>
    $(document).ready(function () {
        $("#keyword").autocomplete({

            source: function (request, response) {
                $.ajax({
                    url: "/autocomplete-search",
                    dataType: "json",
                    data: {
                        query: request.term
                    },
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.name,
                                value: item.name
                            };
                        }));
                    }
                });
            },
            minLength: 1, // Số ký tự tối thiểu trước khi bắt đầu tìm kiếm
            select: function (event, ui) {
                $("#keyword").val(ui.item.value);
                return false;
            }
        });
    });
</script>

