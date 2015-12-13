$(document).ready(function(){
	$('#addSub').click(function(){
		var fname = $.trim($('#name').val());
		var groupid = $.trim($('#id').val());
		if(fname == ''){
			alert('请输入栏目名称');
			return;
		}

		if(groupid.length > 0){
			$.post('modifyGroup', {name: encodeURIComponent(fname), id: groupid}, function(data){
				alert('修改成功');
				location.href = 'group';
			});			
		}else{
			$.post('addGroup', {name: encodeURIComponent(fname)}, function(data){
				alert('添加成功');
				location.href = 'group';
			});
		}
	})
	
	$('.delSub').click(function(){
		if(window.confirm('您确定要删除这个会员组吗？')){
			var groupid = $(this).parent().find('input:hidden').val();
			$.post('delGroup', {id: groupid}, function(data){
				alert('删除成功');
			}).complete(function(){
				location.reload();
			})
		}
	})
})