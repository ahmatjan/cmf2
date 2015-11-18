$(document).ready(function(){
	$('#addSub').click(function(){
		var name = $.trim($('#name').val());
		if(name == ''){
			alert('请输入名称');
			$('#name').focus();
			return;
		}
		var btn = this;
		$(this).attr('disabled', true);
		var content = $.trim($('#content').val());
		$.post('/tour/Sys/selectAdd', {name: encodeURIComponent(name), content: encodeURIComponent(content)}, function(data){
			$(btn).removeAttr('disabled');
			switch(data){
			case 'existed':
				alert('这个名称已经被使用，请选择其他名称');
				return;
			case 'success':
				alert('提交成功');
				location.reload();
				break;
			}
		})
	})
	$('.modify').click(function(){
		if($(this).html() == '修改'){
			var firstTd = $(this).parent().parent().find('td:first');
			firstTd.html('名称：<input type="text" class="name" value="' + firstTd.find('span').html() + '" /><br />备注：<input type="text" class="content" value="' + firstTd.find('em').html() + '" />')
			$(this).html('提交');
		}else{
			var btn = this;
			var name = $.trim($(this).parent().parent().find('.name').val());
			if(name == ''){
				alert('请输入名称');
				return;
			}
			$(this).attr('disabled', true);
			$.post('/tour/Sys/selectModify', {name: encodeURIComponent(name), content: encodeURIComponent($.trim($(this).parent().parent().find('.content').val())), id:$(this).parent().find('input.id').val()}, function(data){
				$(btn).removeAttr('disabled');
				switch(data){
					case 'existed':
						alert('已经有其他类型使用了这个名称，请重试');
						break;
					case 'success':
						$(btn).html('修改');
						var firstTd = $(btn).parent().parent().find('td:first');
						firstTd.html('<span>' + firstTd.find('.name').val() + '</span><br />(<em>' + firstTd.find('.content').val() + '</em>)');
						break;
				}
			});
		}
	})
	$('.delete').click(function(){
		if(window.confirm('您确定要删除这个类型吗？')){
			$.post('/tour/Sys/selectDelete', {id: $(this).parent().find('input.id').val()}, function(data){
				switch(data){
					case 'used':
						alert('这个类型已经被表格使用，不能删除！');
						break;
					case 'success':
						alert('删除成功');
						location.reload();
						break;
				}
			});
		}
	})
})