$(document).ready(function(){
	$('#logCode').click(function(){
		changeVerify();
	})
	$('#logSub').click(function(){
		var username = $.trim($('#username').val());
		if(username == ''){
			alert('请输入用户名');
			$('#username').focus();
			return;
		}
		var password = $.trim($('#password').val());
		if(password == ''){
			alert('请输入密码');
			$('#password').focus();
			return;
		}
		var vcode = $.trim($('#vcode').val());
		if(vcode == ''){
			alert('请输入验证码');
			$('#vcode').focus();
			return;
		}
		$(this).attr('disabled', true);
		$.post(webFolder + 'User/doAdminLogin.html', {username: username, password: password, code: vcode}, function(data){
			$('#logSub').removeAttr('disabled');
			switch(data){
				case 'success':
					if(top.location == location){
						location.href = webFolder + 'admin';
					}else{
						location.reload();
					}
					break;
				case 'badcode':
					changeVerify();
					alert('验证码错误，请重试');
					break;
				case 'badpwd':
					changeVerify();
					alert('用户名/密码错误，请重试');
					break;
				default:
					alert('提交过程发生错误，请联系管理员');
			}
		})
	})
})