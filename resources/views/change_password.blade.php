@extends('layouts.home')

@section('title')
   	Đổi mật khẩu 
@endsection

@section('js')
<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>
@endsection

@section('home')
<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-main-container em-col2-left-layout">
				<div class="row">
					<div class="col-sm-18 col-sm-push-6 em-col-main clearfix">
						<div class="alert alert-danger error-mesage" style="display:none; width: 100%; font-size: 13px;">
							<ul></ul>
						</div>

						<div class="alert alert-success success-mesage" style="display:none; width: 100%; font-size: 13px;">
							<ul></ul>
						</div>

						<div class="alert alert-warning unsuccess-mesage" style="display:none; width: 100%; font-size: 13px;">
							<ul></ul>
						</div>
						<div class="account-create">
							<form method="post" id="form-validate">
								<div class="fieldset">
									<ul class="form-list">
										<li class="fields">
											<label for="password" class="required"><em>*</em>Mật khẩu cũ</label>
											<div class="input-box">
												<input type="password" id="getOldPass" class="input-text">
											</div>
										</li>
										<li class="fields">
											<label for="password" class="required"><em>*</em>Mật khẩu mới</label>
											<div class="input-box">
												<input type="password" id="getNewPass" class="input-text">
											</div>
										</li>
										<li class="fields">
											<label for="password" class="required"><em>*</em>Nhập lại mật khẩu</label>
											<div class="input-box">
												<input type="password" id="getReNewPass" class="input-text">
											</div>
										</li>
									</ul>
								</div>
								<div class="fieldset">
									<div class="buttons-set">
										<a href="{{ url('/') }}" class="btn btn-danger">Trở về</a>
										<button type="button" class="btn btn-info btn-save"><span><span>Lưu thay đổi</span></span>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="col-sm-6 col-sm-pull-18 em-col-left em-sidebar">
						<div id="menuleftText" class="all_categories">
							<div class="menuleftText-title">
								<div class="menuleftPerson"><span class="em-text-upercase">Quản lý tài khoản</span>
								</div>
							</div>
							</div><!-- /.menuleftText -->

							<div class="menuleft">
								<div id="menu-default" class="mega-menu em-menu-icon">
									<div class="megamenu-wrapper wrapper-5_4607">
										<div class="em_nav" id="toogle_menu_5_4607">
											<ul class="vnav em-menu-icon effect-menu em-menu-long">
												<li class="menu-item-link menu-item-depth-0 fa fa-child">
													<a class="em-menu-link" href="{{ url('/my/account/'.Auth::user()->id) }}"> <span>  Thông tin tài khoản </span> </a>
												</li><!-- /.menu-item-link -->

												<li class="menu-item-link menu-item-depth-0 fa fa-shopping-cart">
													<a class="em-menu-link" href="{{ url('/order/history/'.Auth::user()->id) }}"> <span> Đơn hàng của tôi </span> </a>
												</li><!-- /.menu-item-link -->

												<li class="menu-item-link menu-item-depth-0 fa fa-heart">
													<a class="em-menu-link" href="{{ url('/wishlist') }}"> <span> Sản phẩm yêu thích </span> </a>
												</li><!-- /.menu-item-link -->

												<li class="menu-item-link menu-item-depth-0 fa fa-recycle">
													<a class="em-menu-link" href="{{ url('/change/password') }}"> 
													<span style="color : #ffffff; border-color: #fdbd8d; background-color: #ff0099;"> Đổi mật khẩu </span> </a>
												</li><!-- /.menu-item-link -->
											</ul><!-- /.vnav -->
										</div>
									</div><!-- /.megamenu-wrapper -->
								</div>
							</div><!-- /.menuleft -->

							<div class="em-wrapper-area02"></div>
							@if(isset($promotion))
							<div class="em-wrapper-banners hidden-xs">
								<div class="em-effect06">
									<a class="em-eff06-04" href="javascript:void(0)">
									<img class="img-responsive retina-img" src="{{asset('/images/promotions/'.$promotion->image)}}" />
									</a>
								</div>
							</div><!--  /.em-wrapper-banners -->
							@endif
							
						</div><!-- /.block-layered-nav -->

					</div><!-- /.em-sidebar -->
				</div>
            </div><!-- /.em-main-container -->
        </div>
    </div>
</div><!-- /.em-wrapper-main -->
<script src="{{asset('home/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript">
	$('.btn-save').click(function(){
		var form_data = new FormData();
		form_data.append("_token", '{{csrf_token()}}');
		form_data.append("old_pass", $('#getOldPass').val());
		form_data.append("new_pass", $('#getNewPass').val());
		form_data.append("re_new_pass", $('#getReNewPass').val());

		$.ajax({
			type : 'post',
			url : '/change/password',
			data : form_data,
			dataType : 'json',
			contentType: false,
			processData: false,
			success : function(response){
				if(response.is === 'failed'){
					$(".error-mesage").find("ul").html('');
					$(".error-mesage").css('display','block');
					$(".success-mesage").css('display','none');
					$(".unsuccess-mesage").css('display','none');

					$.each(response.error, function( key, value ) {
						$(".error-mesage").find("ul").append('<li><i class="fa fa-exclamation-triangle"></i> '+value+'</li>');
					});

					window.scroll({
						top: 0,
						behavior: 'smooth'
					});
				}
				if(response.is === 'success'){
					$(".success-mesage").find("ul").html('');
					$(".success-mesage").css('display','block');
					$(".error-mesage").css('display','none');
					$(".unsuccess-mesage").css('display','none');

					$(".success-mesage").find("ul").append('<li><i class="fa fa-check"></i> '+response.complete+'</li>');

					window.scroll({
						top: 0,
						behavior: 'smooth'
					});

					setTimeout(function () {
						window.location.href="/";
					},800);
				}
				if(response.is === 'unsuccess'){
					$(".unsuccess-mesage").find("ul").html('');
					$(".unsuccess-mesage").css('display','block');
					$(".error-mesage").css('display','none');
					$(".success-mesage").css('display','none');

					$(".unsuccess-mesage").find("ul").append('<li><i class="fa fa-exclamation-triangle"></i> '+response.uncomplete+'</li>');

					window.scroll({
						top: 0,
						behavior: 'smooth'
					});
				}
			}
		});
	});
</script>            
@endsection



