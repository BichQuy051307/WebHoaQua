@extends('layouts.home')


@section('title')
Đăng nhập 
@endsection

@section('home')
<div class="row">
    <div class="em-col-main col-sm-24" style="margin-top : 50px; margin-bottom : 50px;">
        <div class="account-login">
            <form method="post" id="login-form">
                @csrf
                <div class="col2-set">
                    <div class="col-1 new-users">
                        <div class="content">
                            <h1>Đăng nhập</h1>
                            <br>
                            <p>Đăng nhập để theo dõi đơn hàng, lưu Danh sách sản phẩm yêu thích,</p>
                            <p>nhận nhiều ưu đãi hấp dẫn.  </p>
                        </div>
                    </div>
                    <div class="col-2 registered-users">
                        <div class="content">
                            <ul class="form-list">
                                <li>
                                    <div class="alert alert-warning login-faile-msg" style="display:none">
                                        <ul></ul>
                                    </div>

                                    <div class="alert alert-danger access-faile-msg" style="display:none">
                                        <ul></ul>
                                    </div>

                                    <div class="alert alert-danger user-block-msg" style="display:none">
                                        <ul></ul>
                                    </div>

                                    <div class="alert alert-warning user-incorrect-msg" style="display:none">
                                        <ul></ul>
                                    </div>
                                </li>
                            </ul>
                            
                            <ul class="form-list">
                                <li>
                                    <label for="email" class="required"><em>*</em>Email</label>
                                    <div class="input-box">
                                        <input type="text" name="email" id="email" class="input-text" />
                                    </div>
                                </li>
                                <li>
                                    <label for="pass" class="required"><em>*</em>Mật khẩu</label>
                                    <div class="input-box">
                                        <input type="password" class="input-text" id="password"/>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="buttons-set">
                            <button type="button" class="button btn-login"><span><span>Đăng nhập</span></span>
                            </button> Quên mật khẩu? Nhấn vào <a href="{{ url('/forgot/password') }}" style="color: #03A9F4;">đây</a>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.account-login -->
    </div>
</div>

<script type="text/javascript">
    $('.btn-login').click(function(){
        var form_data = new FormData();
        form_data.append("_token", '{{csrf_token()}}');
        form_data.append("email", $('#email').val());
        form_data.append("password", $('#password').val());

        $.ajax({
            type : 'post',
            url : '/login',
            data : form_data,
            dataType : 'json',
            contentType: false,
            processData: false,
            success : function(response){
                if(response.is === 'login-failed'){
                    $(".login-faile-msg").find("ul").html('');
                    $(".login-faile-msg").css('display','block');
                    $(".user-block-msg").css('display','none');
                    $(".user-incorrect-msg").css('display','none');
                    $(".access-faile-msg").css('display','none');

                    $.each(response.error, function( key, value ) {
                        $(".login-faile-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }

                if(response.is === 'access-faile'){
                    $(".access-faile-msg").find("ul").html('');
                    $(".access-faile-msg").css('display','block');
                    $(".user-block-msg").css('display','none');
                    $(".user-incorrect-msg").css('display','none');
                    $(".login-faile-msg").css('display','none');

                    $(".access-faile-msg").find("ul").append('<li>'+response.unaccess+'</li>');
                }

                if(response.is === 'block'){
                    $(".user-block-msg").find("ul").html('');
                    $(".user-block-msg").css('display','block');
                    $(".user-incorrect-msg").css('display','none');
                    $(".login-faile-msg").css('display','none');
                    $(".access-faile-msg").css('display','none');

                    $(".user-block-msg").find("ul").append('<li>'+response.block+'</li>');
                }

                if(response.is === 'incorrect'){
                    $(".user-incorrect-msg").find("ul").html('');
                    $(".user-incorrect-msg").css('display','block');
                    $(".user-block-msg").css('display','none');
                    $(".login-faile-msg").css('display','none');
                    $(".access-faile-msg").css('display','none');

                    $(".user-incorrect-msg").find("ul").append('<li>'+response.incorrect+'</li>');
                }
                
                if(response.is === 'login-success'){
                    setTimeout(function () {
                        window.location.href="/";
                    },200);
                }
            }
        });
    });
    
</script>
@endsection