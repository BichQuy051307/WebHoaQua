<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Web trái cây Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/template/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/template/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/template/images/favicon.png') }}" />
</head>
<style>
    body {
        background-image: url("../img/bg.jpg");
        width: 100%;
        height: 100%;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo" style="text-align: center;">
                                <img src="{{ asset('assets/template/images/logo.png') }}" alt="logo">
                            </div>
                            <form class="pt-3">
                                @csrf
                                <div class="alert alert-danger login-faile-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <div class="alert alert-warning user-incorrect-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <div class="alert alert-danger user-block-msg" style="display:none">
                                    <ul></ul>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="email"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password"
                                        placeholder="Password">
                                </div>
                                <div class="mt-3 d-flex justify-content-center">
                                    <a class="btn-login btn btn-info font-weight-medium"
                                        onClick='javascript:void(0)'>Đăng nhập</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/template/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('assets/template/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/template/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/template/js/template.js') }}"></script>
    <!-- endinject -->
</body>


<script type="text/javascript">
    // detect enter keypress
    $(document).keypress(async function(e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == '13') {
            await handleLogin()
        }
    });
    $('.btn-login').click(async function() {
        await handleLogin();
    });

    function handleLogin() {
        var form_data = new FormData();
        form_data.append("_token", '{{ csrf_token() }}');
        form_data.append("email", $('#email').val());
        form_data.append("password", $('#password').val());

        $.ajax({
            type: 'post',
            url: '/admin/login',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                switch (response.is) {
                    case 'login-failed':
                        $(".login-faile-msg").find("ul").html('');
                        $(".login-faile-msg").css('display', 'block');
                        $(".user-incorrect-msg").css('display', 'none');
                        $(".user-block-msg").css('display', 'none');
                        $.each(response.error, function(key, value) {
                            $(".login-faile-msg").find("ul").append('<li>' + value + '</li>');
                        });
                        break;
                    case 'block':
                        $(".user-block-msg").find("ul").html('');
                        $(".user-block-msg").css('display', 'block');
                        $(".user-incorrect-msg").css('display', 'none');
                        $(".login-faile-msg").css('display', 'none');

                        $(".user-block-msg").find("ul").append('<li>' + response.block + '</li>');
                        break;
                    case 'incorrect': 
                        $(".user-incorrect-msg").find("ul").html('');
                        $(".user-incorrect-msg").css('display', 'block');
                        $(".login-faile-msg").css('display', 'none');
                        $(".user-block-msg").css('display', 'none');

                        $(".user-incorrect-msg").find("ul").append('<li>' + response.incorrect + '</li>');
                        break;
                    
                    default:
                        let href = '/admin/dashboard';
                        if (response.is === 'login-staff-success') {
                            href = '/admin/category';
                        }
                        window.location.href = href;
                        break;
                }
            }
        });
    }
</script>
</html>
