@extends('layouts.admin') 

@section('content') 
@if(isset($category))
<div class="row">
    @csrf
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cập nhật danh mục</h4>
                <form class="forms-sample" onsubmit="submitForm(event)">
                    @csrf
                    <input
                        name="id"
                        type="hidden"
                        class="form-control"
                        id="categoryId"
                        value="{{$category->id}}"
                    />
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            value="{{$category->name}}"
                        />
                    </div>

                    <div class="form-group">
                        <label for="name">Slug</label>
                        <input
                            type="text"
                            class="form-control"
                            id="slug"
                            value="{{$category->slug}}"
                            disabled
                        />
                    </div>
                    <div class="form-group">
                        <label for="name">Mô tả</label>
                        <input
                            type="text"
                            class="form-control"
                            id="description"
                            value="{{$category->description}}"
                        />
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary me-2 text-white btn-save"
                    >
                        Cập nhật
                    </button>
                    <a href="/admin/category" class="btn btn-danger text-white"
                        >Hủy</a
                    >
                </form>
            </div>
        </div>
    </div>
</div>
@endif 
@endsection 

@section('js')
<script type="text/javascript">
    function submitForm(event) {
        event.preventDefault();
    }
    $(".btn-save").click(function () {
        var form_data = new FormData();
        var id = $("#categoryId").val();
        var name = $("#name").val();
        var slug = $("#slug").val();
        var description = $("#description").val();
        if (!name) {
            swal({
                title: "Lỗi!",
                text: "Tên danh mục là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        form_data.append("_token", "{{csrf_token()}}");
        form_data.append("id", id);
        form_data.append("name", name);
        form_data.append("slug", slug);
        form_data.append("description", description);
        $.ajax({
            type: "post",
            url: "/admin/update-category",
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.is === "success") {
                    setTimeout(function () {
                        window.location.href = "/admin/category";
                    }, 1600);
                    swal({
                        title: "Hoàn thành!",
                        text: "Cập nhật danh mục thành công",
                        icon: "success",
                        buttons: true,
                        buttons: ["Ok"],
                        timer: 1500,
                    });
                }
                if (response.is === "unsuccess") {
                    swal({
                        title: "Lỗi!",
                        text: "Không cập nhật được danh mục",
                        icon: "warning",
                        buttons: true,
                        buttons: ["Ok"],
                        timer: 3000,
                    });
                    return;
                }
            },
        });
    });
</script>
@endsection('js')
