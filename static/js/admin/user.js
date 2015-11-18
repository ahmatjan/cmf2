$(document).ready(function(){
	$('#addSub').click(function(){
		var nick = $('#nick').val();
		var truename = $('#truename').val();
		var password = $('#password').val();
		var confirm = $('#confirm').val();
		var type = $('#type').val();
		if(confirm != password){
			alert('两次输入的密码不一致');
			return;
		}
		var group = new Array();
		var i = 0;
		$('#group option:selected').each(function(){
			group[i++] = $(this).attr('value');
		});
		$.post('modifyuser', {nick: encodeURIComponent(nick),truename: encodeURIComponent(truename),password: password, type: type, group: group, id: $('#id').val()}, function(data){
			alert('修改成功');
			location.href = 'user';
		});			
	})
	
	$('#oldGroup input').each(function(){
		$('#group option[value=' + $(this).val() + ']').attr('selected', 'selected');
	})
	
	$('.delSub').click(function(){
		if(window.confirm('您确定要删除这个会员吗？')){
			$.post('deluser', {id: $(this).parent().find('input:hidden').val()}, function(data){
				alert('删除成功');
				location.reload();
			})
		}
	})
})