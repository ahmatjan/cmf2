$(document).ready(function(){
	$('#addSub').click(function(){
		var fname = $.trim($('#name').val());
		var fparent = $.trim($('#parent').val());
		if(fname == ''){
			alert('请输入栏目名称');
			return;
		}
		if($('#id').length > 0){
			$.post('modifyfolder', {name: encodeURIComponent(fname), parent: fparent, id: $('#id').val()}, function(data){
				alert('修改成功');
				location.href = 'folder';
			});			
		}else{
			$.post('addfolder', {name: encodeURIComponent(fname), parent: fparent}, function(data){
				alert('添加成功');
				location.href = 'folder';
			});
		}
	})
	
	$('.delSub').click(function(){
		if(window.confirm('您确定要删除这个栏目吗？')){
			$.post('delfolder', {id: $(this).parent().find('input:hidden').val()}, function(data){
				alert('删除成功');
				location.reload();
			})
		}
	})
})