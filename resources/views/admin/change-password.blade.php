@extends('layouts.master_admin') 

@section('controll')
Thay đổi mật khẩu
@endsection

@section('content')
<div class="container box box-body pad">
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-danger error-msg" style="display:none">
				<ul></ul>
			</div>

			<div class="alert alert-success success-msg" style="display:none">
				<ul></ul>
			</div>

			<div class="alert alert-warning unsuccess-msg" style="display:none">
				<ul></ul>
			</div>


			<div class="col-xs-2">
				<label for="">Mật khẩu cũ</label>
			</div>
			<div class="col-xs-10">
				<input name="old_pass" type="password" class="form-control" id="getOldPass"><br>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-2">
				<label for="">Mật khẩu mới</label>
			</div>
			<div class="col-xs-10">
				<input name="new_pass" type="password" class="form-control" id="getNewPass"><br>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-2">
				<label for="">Nhập lại mật khẩu</label>
			</div>
			<div class="col-xs-10">
				<input name="re_new_pass" type="password" class="form-control" id="getReNewPass" ><br>
			</div>
		</div>

		<div class="col-xs-12" style="text-align: center;">
			<button type="button" class="btn btn-success btn-save" >Lưu thay đổi</button>
			<a href="/admin/dashboard" class="btn btn-danger">Trở về</a>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.btn-save').click(function(){

		var form_data = new FormData();
		form_data.append("_token", '{{csrf_token()}}');
		form_data.append("old_pass", $('#getOldPass').val());
		form_data.append("new_pass", $('#getNewPass').val());
		form_data.append("re_new_pass", $('#getReNewPass').val());

		$.ajax({
			type : 'post',
			url : '/admin/change/password',
			data : form_data,
			dataType : 'json',
			contentType: false,
			processData: false,
			success : function(response){
				if(response.is === 'failed'){
					$(".error-msg").find("ul").html('');
					$(".error-msg").css('display','block');
					$(".success-msg").css('display','none');
					$(".unsuccess-msg").css('display','none');

					$.each(response.error, function( key, value ) {
						$(".error-msg").find("ul").append('<li>'+value+'</li>');
					});
				}
				if(response.is === 'success'){
					$(".success-msg").find("ul").html('');
					$(".success-msg").css('display','block');
					$(".error-msg").css('display','none');
					$(".unsuccess-msg").css('display','none');

					$(".success-msg").find("ul").append('<li>'+response.complete+'</li>');

					setTimeout(function () {
						window.location.href="/admin/dashboard/";
					},1000);
				}
				if(response.is === 'unsuccess'){
					$(".unsuccess-msg").find("ul").html('');
					$(".unsuccess-msg").css('display','block');
					$(".error-msg").css('display','none');
					$(".success-msg").css('display','none');

					$(".unsuccess-msg").find("ul").append('<li>'+response.uncomplete+'</li>');
				}
			}
		});
	});
</script>
@endsection