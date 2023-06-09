@extends('layouts.admin') @section('content')
<div style="margin-bottom: 30px; text-align: end">
    <a href="/admin/new/category" class="btn btn-info btn-add text-white"
        >Thêm danh mục</a
    >
</div>
<div class="row">
    @csrf
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Danh sách danh mục</p>
                <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                        <thead>
                            <tr>
                                <th class="col-sm-1 text-center">#</th>
                                <th class="col-sm-3 text-center">
                                    Tên danh mục
                                </th>
                                <th class="col-sm-2 text-center">
                                    Slug
                                </th>
                                <th class="col-sm-2 text-center">
                                    Mô tả danh mục
                                </th>
                                <th class="col-sm-2 text-center">Ngày tạo</th>
                                <th class="col-sm-2 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($categories)) @foreach ($categories as
                            $value)
                            <tr>
                                <td class="col-sm-1 text-center">
                                    {{$value->id}}
                                </td>
                                <td class="col-sm-3 text-center">
                                    {{$value->name}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->slug}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->description}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    {{$value->created_at}}
                                </td>
                                <td class="col-sm-2 text-center">
                                    <a
                                        href="/admin/category/{{$value->id}}"
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

@endsection @section('js')
<script type="text/javascript">
    $(".btn-edit").click(function () {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "get",
            url: "/admin/category/" + id,
            data: {
                _token: $('[name="_token"]').val(),
            },
            success: function (response) {
                $("#editID").val(response.id),
                    $("#editName").val(response.name),
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
                        window.location.href = "/admin/category/";
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
                url: "/admin/category/" + id,
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
