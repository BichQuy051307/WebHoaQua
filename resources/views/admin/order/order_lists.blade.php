@extends('layouts.admin') @section('content')
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Danh sách đơn hàng</p>
                <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                        <thead>
                            <tr>
                                <th class="col-sm-1 text-center">
                                    Mã đơn hàng
                                </th>
                                <th class="col-sm-2 text-center">Họ và tên</th>
                                <th class="col-sm-2 text-center">Email</th>
                                <th class="col-sm-2 text-center">
                                    Số điện thoại
                                </th>
                                <th class="col-sm-2 text-center">
                                    Thời gian đặt hàng
                                </th>
                                <th class="col-sm-1 text-center">
                                    Tổng thanh toán
                                </th>
                                <th class="col-sm-2 text-center">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($orders)) @foreach ($orders as $value)
                            <tr>
                                <td class="col-sm-1 text-center">
                                    <a
                                        href="/admin/order/{{$value->order_id}}"
                                        >{{$value->order_id}}</a
                                    >
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->name}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->email}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->phone}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->created_at}}
                                </td>

                                <td class="col-sm-1">
                                    {{number_format(($value->amount+$value->score_awards)*1000 ,0 ,'.' ,'.')}}
                                    VND
                                </td>
                                <td class="col-sm-2 text-center">
                                    @if($value->status == 0)
                                    <span
                                        class="btn btn-warning"
                                        style="
                                            color: #fff;
                                            padding: 8px 20px;
                                            border-radius: 5px;
                                            text-transform: uppercase;
                                        "
                                        >Đang chờ</span
                                    >
                                    @else @if($value->status == 1)
                                    <span
                                        class="btn"
                                        style="
                                            color: #fff;
                                            padding: 8px 20px;
                                            border-radius: 5px;
                                            text-transform: uppercase;
                                            background: #288b00;
                                        "
                                        >Đang giao hàng</span
                                    >
                                    @else @if($value->status == 2)
                                    <span
                                        class="btn btn-info"
                                        style="
                                            color: #fff;
                                            padding: 8px 20px;
                                            border-radius: 5px;
                                            text-transform: uppercase;
                                            background: #288b00;
                                        "
                                        >Đã giao hàng</span
                                    >
                                    @else @if($value->status == 3)
                                    <span
                                        class="btn btn-danger"
                                        style="
                                            color: #fff;
                                            padding: 8px 20px;
                                            border-radius: 5px;
                                            text-transform: uppercase;
                                        "
                                        >Đã hủy</span
                                    >
                                    @endif @endif @endif @endif
                                </td>
                            </tr>
                            @endforeach @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @section('js')
<script type="text/javascript">
    // show
    $(".btn-show").click(function () {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "get",
            url: "/admin/order/" + id,
            data: {
                _token: $('[name="_token"]').val(),
            },
            success: function (response) {
                $("#showName").val(response.name),
                    $("#showPrice").val(response.price),
                    $("#showThumbnail").attr(
                        "src",
                        "/images/orders/" + response.thumbnail
                    ),
                    $("#showExpirationPeriod").val(response.expiration_period),
                    $("#showDescription").val(response.description),
                    $("#showCreatedAt").val(response.created_at),
                    $("#showUpdatedAt").val(response.updated_at);
            },
        });

        $("#showOrder").modal("show");
    });

    $(".btn-edit").click(function () {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "get",
            url: "/admin/order/" + id,
            data: {
                _token: $('[name="_token"]').val(),
            },
            success: function (response) {
                $("#editID").val(response.id),
                    $("#editName").val(response.name),
                    $("#editPriceId").val(response.price),
                    $("#editExpirationPeriod").val(response.expiration_period),
                    $("#Thumbnail").attr(
                        "src",
                        "/images/orders/" + response.thumbnail
                    ),
                    $("#editSlug").val(response.slug),
                    $("#editDescription").val(response.description);
            },
        });

        $("#editOrder").modal("show");
    });

    $(".btn-update").click(function () {
        var category_id = $("#editID").val();
        var form_data = new FormData();
        form_data.append("_token", "{{csrf_token()}}");
        form_data.append("id", $("#editID").val());
        form_data.append("name", $("#editName").val());
        form_data.append("price", $("#editPriceId").val());
        form_data.append("expiration_period", $("#editExpirationPeriod").val());
        form_data.append("thumbnail", $("input[type=file]")[0].files[0]);
        form_data.append("description", $("#editDescription").val());

        $.ajax({
            type: "post",
            url: "/admin/update_category",
            data: form_data,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.is === "failed") {
                    $.each(response.error, function (key, value) {
                        message = value;
                    });

                    swal({
                        title: "Thất bại!",
                        text: message,
                        icon: "error",
                        buttons: true,
                        buttons: ["Ok"],
                        timer: 3000,
                    });
                }
                if (response.is === "success") {
                    swal({
                        title: "Hoàn thành!",
                        text: response.complete,
                        icon: "success",
                        buttons: true,
                        buttons: ["Ok"],
                        timer: 1000,
                    });

                    setTimeout(function () {
                        window.location.href = "/admin/order/";
                    }, 1000);
                }
                if (response.is === "unsuccess") {
                    swal({
                        title: "Thất bại!",
                        text: response.uncomplete,
                        icon: "error",
                        buttons: true,
                        buttons: ["Ok"],
                        timer: 5000,
                    });
                }
            },
        });
    });

    // delete
    $(".btn-delete").click(function () {
        if (confirm("Bạn có muốn xóa không?")) {
            var _this = $(this);
            var id = $(this).attr("data-id");
            $.ajax({
                type: "delete",
                url: "/admin/order/" + id,
                data: {
                    _token: $('[name="_token"]').val(),
                },
                success: function (response) {
                    _this.parent().parent().remove();
                    window.location.reload();
                },
            });
        }
    });
</script>
@endsection('js')
