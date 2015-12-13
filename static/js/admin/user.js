$(document).ready(function(){
	$('#addSub').click(function(){
		var password = $('#password').val();
		var confirm = $('#confirm').val();

		if(confirm != password){
			alert('两次输入的密码不一致');
			return;
		}

		var username = $('#username').val();
		var sex = $('#sex').val();
		var company = $('#company').val();
		var department = $('#department').val();
		var job = $('#job').val();
		var email = $('#email').val();
		var contact = $('#contact').val();
		var truename = $('#truename').val();
		var type = $('#type').val();

		var group = new Array();
		var i = 0;
		$('#group option:selected').each(function(){
			group[i++] = $(this).attr('value');
		});

		$.post('addUser', {
			username: encodeURIComponent(username),
			sex: encodeURIComponent(sex),
			company: encodeURIComponent(company),
			department: encodeURIComponent(department),
			job: encodeURIComponent(job),
			email: encodeURIComponent(email),
			contact: encodeURIComponent(contact),
			truename: encodeURIComponent(truename),
			password: encodeURIComponent(password),
			type: type,
			group: group,
			id: $('#id').val()
		}, function(data){
			alert('添加成功');
			location.href = 'user';
		});			
	})

	$('#modifySub').click(function(){

		var password = $('#password').val();
		var confirm = $('#confirm').val();

		if(confirm != password){
			alert('两次输入的密码不一致');
			return;
		}

		var username = $('#username').val();
		var sex = $('#sex').val();
		var company = $('#company').val();
		var department = $('#department').val();
		var job = $('#job').val();
		var email = $('#email').val();
		var contact = $('#contact').val();
		var truename = $('#truename').val();
		var type = $('#type').val();


		var group = new Array();
		var i = 0;
		$('#group option:selected').each(function(){
			group[i++] = $(this).attr('value');
		});

		$.post('modifyUser', {
			username: encodeURIComponent(username),
			sex: encodeURIComponent(sex),
			company: encodeURIComponent(company),
			department: encodeURIComponent(department),
			job: encodeURIComponent(job),
			email: encodeURIComponent(email),
			contact: encodeURIComponent(contact),
			truename: encodeURIComponent(truename),
			password: encodeURIComponent(password),
			type: type,
			group: group,
			id: $('#id').val()
		}, function(data){
			alert('修改成功');
			location.href = 'user';
		});
	})

	//$('.delSub').click(function(){
	//	if(window.confirm('您确定要删除这个会员吗？')){
	//		$.post("{$siteInfo['webFolder']}admin/deluser", {id: $(this).parent().find('input:hidden').val()}, function(data){
	//			alert('删除成功');
	//			location.reload();
	//		})
	//	}
	//})
})