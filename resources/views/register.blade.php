@extends('layouts.home') @section('title') Đăng ký   @endsection
@section('home')
<div class="row">
    <div class="em-col-main col-sm-24">
        <div class="account-create">
            <div class="page-title">
                <h2>Đăng ký tài khoản</h2>
            </div>
            <form id="form-validate">
                @csrf
                <div
                    class="error-mesage"
                    style="
                        display: none;
                        width: 100%;
                        font-size: 13px;
                        color: #ff0000;
                    "
                >
                    <ul></ul>
                </div>

                <div
                    class="success-mesage"
                    style="
                        display: none;
                        width: 100%;
                        font-size: 13px;
                        color: #12f403;
                    "
                >
                    <ul></ul>
                </div>

                <div
                    class="unsuccess-mesage"
                    style="
                        display: none;
                        width: 100%;
                        font-size: 13px;
                        color: #ff9800;
                    "
                >
                    <ul></ul>
                </div>

                <div class="fieldset">
                    <ul class="form-list">
                        <li class="fields">
                            <div class="field">
                                <label for="email" class="required"
                                    ><em>*</em>Email</label
                                >
                                <div class="input-box">
                                    <input
                                        type="text"
                                        name="email"
                                        id="email"
                                        class="input-text"
                                    />
                                </div>
                            </div>
                        </li>

                        <li class="fields">
                            <div class="field">
                                <label for="name" class="required"
                                    ><em>*</em>Tên đăng nhập</label
                                >
                                <div class="input-box">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="input-text"
                                    />
                                </div>
                            </div>
                        </li>

                        <li class="fields">
                            <div class="field">
                                <label for="password" class="required"
                                    ><em>*</em>Mật khẩu</label
                                >
                                <div class="input-box">
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="input-text"
                                    />
                                </div>
                            </div>
                        </li>

                        <li class="fields">
                            <div class="field">
                                <label for="address">Địa chỉ</label>
                                <div class="input-box">
                                    <input
                                        type="text"
                                        name="address"
                                        id="address"
                                        class="input-text"
                                    />
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="fieldset">
                    <div class="buttons-set">
                        <p style="font-size: 13px">
                            Tôi đồng ý với các
                            <a
                                href="#"
                                style="color: #03a9f4"
                                >điều khoản sử dụng</a
                            >
                            của Fuji Fruit và cho phép Fuji Fruit sử dụng thông
                            tin của tôi khi hoàn tất thao tác này.
                        </p>

                        <button
                            type="button"
                            class="button btn-register"
                            style="font-size: 14px; font-weight: 600"
                        >
                            <span><span>ĐĂNG KÝ</span></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".btn-register").click(function () {
        var form_data = new FormData();
        form_data.append("_token", "{{csrf_token()}}");
        form_data.append("email", $("#email").val());
        form_data.append("name", $("#name").val());
        form_data.append("password", $("#password").val());
        form_data.append("address", $("#address").val());

        $.ajax({
            type: "post",
            url: "/register",
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.is === "login-success") {
                    setTimeout(function () {
                        window.location.href = "/";
                    }, 200);
                }
                if (response.is === "unsuccess") {
                    $(".unsuccess-mesage").find("ul").html("");
                    $(".unsuccess-mesage").css("display", "block");
                    $(".error-mesage").css("display", "none");
                    $(".success-mesage").css("display", "none");

                    $(".unsuccess-mesage")
                        .find("ul")
                        .append(
                            '<li><i class="fa fa-exclamation-triangle"></i> ' +
                                response.uncomplete +
                                "</li>"
                        );

                    window.scroll({
                        top: 0,
                        behavior: "smooth",
                    });
                }
            },
        });
    });
</script>
@endsection
