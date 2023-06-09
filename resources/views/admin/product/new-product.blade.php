@extends('layouts.admin') 

@section('content')
<div class="row">
    @csrf
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm sản phẩm</h4>
                <form
                    class="forms-sample"
                    onsubmit="submitForm(event)"
                >
                    <div class="form-group">
                        <label for="name"
                            >Tên sản phẩm</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                        />
                    </div>

                    <div class="form-group">
                        <label for="code">Mã</label>
                        <input
                            type="text"
                            class="form-control"
                            id="code"
                        />
                    </div>

                    <div class="form-group">
                        <label for="category"
                            >Danh mục</label
                        >
                        <select id="category" class="form-control" style="width: 100%; margin-top: 0px;">
								@if(isset($list_categories))
									@foreach($list_categories as $value)
										<option value="{{ $value->id }}">{{ $value->name }}</option>
									@endforeach
								@endif
						</select><br>
                    </div>

                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input
                            type="file"
                            name="img[]"
                            class="file-upload-default"
                        />
                        <div
                            class="input-group col-xs-12"
                        >
                            <input
                                type="text"
                                class="form-control file-upload-info"
                                disabled
                                placeholder="Upload Image"
                            />
                            <span
                                class="input-group-append"
                            >
                                <button
                                    class="file-upload-browse btn btn-primary text-white"
                                    type="button"
                                >
                                    Upload
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description"
                            >Mô tả</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="description"
                        />
                    </div>

                    <div class="form-group">
                        <label for="unit"
                            >Đơn vị tính</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="unit"
                        />
                    </div>

                    <div class="form-group">
                        <label for="price"
                            >Giá gốc</label
                        >
                        <input
                            type="number"
                            class="form-control"
                            id="price"
                        />
                    </div>

                    <div class="form-group">
                        <label for="priceSale"
                            >Giá bán</label
                        >
                        <input
                            type="number"
                            class="form-control"
                            id="priceSale"
                        />
                    </div>

                    <div class="form-group">
                        <label for="quantity"
                            >Số lượng</label
                        >
                        <input
                            type="number"
                            class="form-control"
                            id="quantity"
                        />
                    </div>

                    <div class="form-group">
                        <label for="status"
                            >Trạng thái</label
                        >
						<select class="form-control" id="status">
							<option value="1">Công khai</option>
							<option value="0">Riêng tư</option>
						</select><br>
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary me-2 text-white btn-save"
                    >
                        Thêm mới
                    </button>
                    <a
                        href="/admin/product"
                        class="btn btn-danger text-white"
                        >Hủy</a
                    >
                </form>
            </div>
        </div>
    </div>
</div>
@endsection('content')

@section('js')
<script src="{{ asset('assets/template/js/file-upload.js') }}"></script>
<script type="text/javascript">
    function submitForm(event) {
        event.preventDefault();
    }
    $(".btn-save").click(function () {
        var form_data = new FormData();
        var name = $("#name").val();
        var image = $("input[type=file]")[0].files[0];
        var code = $("#code").val();
        var unit = $("#unit").val();
        var description = $("#description").val();
        var category_id = $("#category").val();
        var quantity = $("#quantity").val();
        var price = $("#price").val();
        var price_sale = $("#priceSale").val();
        var status = $("#status").val();
        if (!name) {
            swal({
                title: "Lỗi!",
                text: "Tên sản phẩm là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        if (!code) {
            swal({
                title: "Lỗi!",
                text: "Mã sản phẩm là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        if (!description) {
            swal({
                title: "Lỗi!",
                text: "Mô tả là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        if (!category_id) {
            swal({
                title: "Lỗi!",
                text: "Danh mục sản phẩm là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        if (!quantity) {
            swal({
                title: "Lỗi!",
                text: "Số lượng sản phẩm là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        if (!unit) {
            swal({
                title: "Lỗi!",
                text: "Đơn vị tính là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        if (!price) {
            swal({
                title: "Lỗi!",
                text: "Giá sản phẩm là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        if (!price_sale) {
            swal({
                title: "Lỗi!",
                text: "Giá bán là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        if (!image) {
            swal({
                title: "Lỗi!",
                text: "Hình ảnh là bắt buộc",
                icon: "warning",
                buttons: true,
                buttons: ["Ok"],
                timer: 3000,
            });
            return;
        }
        form_data.append("_token", "{{csrf_token()}}");
        form_data.append("name", name.trim());
        form_data.append("image", image);
        form_data.append("code", code.trim());
        form_data.append("unit", unit.trim());
        form_data.append("description", description.trim());
        form_data.append("category_id", +category_id);
        form_data.append("quantity", +quantity);
        form_data.append("price_sale", +price_sale);
        form_data.append("price", +price);
        form_data.append("status", +status);
        $.ajax({
            type: "post",
            url: "/admin/product",
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.is === "success") {
                    setTimeout(function () {
                        window.location.href = "/admin/product";
                    }, 1600);
                    swal({
                        title: "Hoàn thành!",
                        text: "Thêm sản phẩm thành công",
                        icon: "success",
                        buttons: true,
                        buttons: ["Ok"],
                        timer: 1500,
                    });
                }
                if (response.is === "unsuccess") {
                    swal({
                        title: "Lỗi!",
                        text: "Không thêm được sản phẩm",
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
