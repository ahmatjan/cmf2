$(document).ready(function(){
	$('#addSub').click(function(){
		var fname = $.trim($('#name').val());
		if(fname == ''){
			alert('请输入类别名称');
			return;
		}
		if($('#id').length > 0){
			$.post('modifytype', {name: encodeURIComponent(fname), id: $('#id').val()}, function(data){
				alert('修改成功');
				location.href = 'type';
			});			
		}else{
			$.post('addtype', {name: encodeURIComponent(fname)}, function(data){
				alert('添加成功');
				location.href = 'type';
			});
		}
	})
	
	$('.delSub').click(function(){
		if(window.confirm('您确定要删除这个类别吗？')){
			$.post('deltype', {id: $(this).parent().find('input:hidden').val()}, function(data){
				alert('删除成功');
				location.reload();
			})
		}
	})
})