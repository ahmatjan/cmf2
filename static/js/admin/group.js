$(document).ready(function(){
	$('#addSub').click(function(){
		var fname = $.trim($('#name').val());
		if(fname == ''){
			alert('请输入栏目名称');
			return;
		}
		if($('#id').length > 0){
			$.post('modifygroup', {name: encodeURIComponent(fname), id: $('#id').val()}, function(data){
				alert('修改成功');
				location.href = 'group';
			});			
		}else{
			$.post('addgroup', {name: encodeURIComponent(fname)}, function(data){
				alert('添加成功');
				location.href = 'group';
			});
		}
	})
	
	$('.delSub').click(function(){
		if(window.confirm('您确定要删除这个会员组吗？')){
			$.post('delgroup', {id: $(this).parent().find('input:hidden').val()}, function(data){
				alert('删除成功');
				location.reload();
			})
		}
	})
})