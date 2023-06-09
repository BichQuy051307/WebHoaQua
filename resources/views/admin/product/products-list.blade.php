@extends('layouts.admin') @section('content')
<div style="margin-bottom: 30px; text-align: end">
    <a href="/admin/new/product" class="btn btn-info btn-add text-white"
        >Thêm sản phẩm</a
    >
</div>
<div class="row">
    @csrf
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Danh sách  sản phẩm</p>
                <div class="table-responsive">
                    <table id="list-products" class="table">
                        <thead>
                            <tr>
                                <th class="col-sm-1 text-center">#</th>
                                <th class="col-sm-2 text-center">Tên sản phẩm</th>
                                <th class="col-sm-2 text-center">Ảnh bìa</th>
                                <th class="col-sm-1 text-center">Đơn vị tính</th>
                                <th class="col-sm-1 text-center">Giá</th>
                                <th class="col-sm-1 text-center">Giá bán</th>
                                <th class="col-sm-1 text-center">Số lượng</th>
                                <th class="col-sm-1 text-center">Đã bán</th>
                                <th class="col-sm-1 text-center">Trạng thái</th>
                                <th class="col-sm-1 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($products)) @foreach ($products as $value)
                            <tr>
                                <td class="col-sm-1 text-center">
                                    {{$value->id}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->name}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    <img
                                        style="
                                            width: 100px;
                                            height: 200px;
                                            border-radius: 0;
                                        "
                                        src="{{url('images/products/'.$value->image)}}"
                                        alt=" text-center"
                                    />
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->unit}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->price}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->price_sale}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->quantity}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    {{$value->bought}}
                                </td>
                                <td class="col-sm-1 text-center">
                                    @if($value->status == 1)
                                    <button
                                        style="
                                            color: #fff;
                                            padding: 8px 20px;
                                            border-radius: 2px;
                                            border: 1px solid #fff;
                                            text-transform: uppercase;
                                            background: rgb(0, 168, 0);
                                        "
                                    >
                                        Công khai
                                    </button>
                                    @else
                                    <button
                                        style="
                                            color: #fff;
                                            padding: 8px 20px;
                                            border-radius: 2px;
                                            border: 1px solid #fff;
                                            text-transform: uppercase;
                                            background: rgb(138, 137, 137);
                                        "
                                    >
                                        Riêng tư
                                    </button>
                                    @endif
                                </td>
                                <td class="col-sm-2 text-center">
                                    <a
                                        href="/admin/product/{{$value->id}}"
                                        class="btn btn-warning btn-edit"
                                    >
                                        <i
                                            class="mdi mdi-table-edit"
                                            style="color: #fff"
                                        ></i>
                                    </a>
                                    <a
                                        href="#"
                                        data-id="{{$value->id}}"
                                        type="button"
                                        class="btn btn-danger btn-delete"
                                    >
                                        <i
                                            class="mdi mdi-delete-forever"
                                            style="color: #fff"
                                        ></i>
                                    </a>
                                </td>
                                <style>
                                    button i::before {
                                        padding-top: 5px;
                                    }
                                </style>
                            </tr>
                            @endforeach @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content') @section('js')

<script>
    $(document).ready(function() {//xác định khi tài liệu HTML đã được tải xong.
        //chọn phần tử có id là "list-products"
        $('#list-products').DataTable( {
            "lengthMenu": [[5, 10, 25, 50, 70, -1], [5, 10,25, 50,, "All"]]//là danh sách lựa chọn. Giá trị đầu tiên là số lượng hàng hiển thị trên bảng, và giá trị thứ hai là văn bản tương ứng với lựa chọn đó. Số -1 có nghĩa là hiển thị tất cả hàng.
        } );
    } );
</script>

<script type="text/javascript">
    // show
    $(".btn-show").click(function () {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "get",
            url: "/admin/product/" + id,
            data: {
                _token: $('[name="_token"]').val(),
            },
            success: function (response) {
                $("#showName").val(response.name),
                    $("#showPrice").val(response.price),
                    $("#showImage").attr(
                        "src",
                        "/images/categories/" + response.image
                    ),
                    $("#showExpirationPeriod").val(response.expiration_period),
                    $("#showDescription").val(response.description),
                    $("#showCreatedAt").val(response.created_at),
                    $("#showUpdatedAt").val(response.updated_at);
            },
        });

        $("#showCategory").modal("show");
    });

    $(".btn-edit").click(function () {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "get",
            url: "/admin/product/" + id,
            data: {
                _token: $('[name="_token"]').val(),
            },
            success: function (response) {
                $("#editID").val(response.id),
                    $("#editName").val(response.name),
                    $("#editPriceId").val(response.price),
                    $("#editExpirationPeriod").val(response.expiration_period),
                    $("#image").attr(
                        "src",
                        "/images/categories/" + response.image
                    ),
                    $("#editSlug").val(response.slug),
                    $("#editDescription").val(response.description);
            },
        });

        $("#editCategory").modal("show");
    });

    $(".btn-update").click(function () {
        var category_id = $("#editID").val();
        var form_data = new FormData();
        form_data.append("_token", "{{csrf_token()}}");
        form_data.append("id", $("#editID").val());
        form_data.append("name", $("#editName").val());
        form_data.append("price", $("#editPriceId").val());
        form_data.append("expiration_period", $("#editExpirationPeriod").val());
        form_data.append("image", $("input[type=file]")[0].files[0]);
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
                        window.location.href = "/admin/product/";
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
                url: "/admin/product/" + id,
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
