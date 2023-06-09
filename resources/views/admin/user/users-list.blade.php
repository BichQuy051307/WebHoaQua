@extends('layouts.admin') @section('content')
<div class="row">
    @csrf
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Danh sách người dùng</p>
                <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                        <thead>
                            <tr>
                                <th class="col-sm-2 text-center">#</th>
                                <th class="col-sm-2 text-center">Avatar</th>
                                <th class="col-sm-2 text-center">
                                    Tên người dùng
                                </th>
                                <th class="col-sm-2 text-center">Email</th>
                                <th class="col-sm-2 text-center">Địa chỉ</th>
                                <th class="col-sm-2 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($users)) @foreach ($users as $value)
                            <tr>
                                <td class="col-sm-2 text-center">
                                    {{$value->id}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    @if($value->avatar)
                                    <img
                                        style="
                                            width: 50px;
                                            height: 50px;
                                            border-radius: 100%;
                                        "
                                        src="{{$value->avatar}}"
                                    />
                                    @else
                                    <img
                                        style="
                                            width: 50px;
                                            height: 50px;
                                            border-radius: 100%;
                                        "
                                        src="https://s3-us-west-1.amazonaws.com/s3-lc-upload/assets/default_avatar.jpg"
                                    />
                                    @endif
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->name}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->email}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->address}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{-- <a
                                        href="/admin/user/{{$value->id}}"
                                        class="btn btn-warning btn-edit"
                                    >
                                        <i
                                            class="mdi mdi-table-edit"
                                            style="color: #fff"
                                        ></i>
                                    </a> --}}
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

@endsection @section('js')
<script type="text/javascript">
    // show
    $(".btn-show").click(function () {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "get",
            url: "/admin/user/" + id,
            data: {
                _token: $('[name="_token"]').val(),
            },
            success: function (response) {
                $("#showName").val(response.name),
                    $("#showPrice").val(response.price),
                    $("#showThumbnail").attr(
                        "src",
                        "/images/users/" + response.thumbnail
                    ),
                    $("#showExpirationPeriod").val(response.expiration_period),
                    $("#showDescription").val(response.description),
                    $("#showCreatedAt").val(response.created_at),
                    $("#showUpdatedAt").val(response.updated_at);
            },
        });

        $("#showUser").modal("show");
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
                        window.location.href = "/admin/user/";
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
                url: "/admin/user/" + id,
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
