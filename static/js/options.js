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
		$.post('/tour/Sys/optionsAdd', {name: encodeURIComponent(name), status: $('#status0').prop('checked') ? 0 : 1, type: $('#type').val()}, function(data){
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
			var secondTd = $(this).parent().parent().find('td:eq(1)');
			
			firstTd.html('<input type="text" class="name" value="' + firstTd.html() + '" />');
			if($(this).parent().parent().find('td:eq(2)').html() == '未使用'){
				secondTd.html('<select name="status" class="status"><option value="0">禁用</option><option value="1" ' + (secondTd.html() == '启用' ? 'selected' : '') + '>启用</option></select>');
			}else{
				secondTd.html('启用<input type="hidden" class="status" value="1" />');
			}
			$(this).html('提交');
		}else{
			var btn = this;
			var name = $.trim($(this).parent().parent().find('.name').val());
			if(name == ''){
				alert('请输入名称');
				return;
			}
			$(this).attr('disabled', true);
			$.post('/tour/Sys/optionsModify', {name: encodeURIComponent(name), status: $(this).parent().parent().find('.status').val(),type:$('#type').val(), id:$(this).parent().find('input.id').val()}, function(data){
				$(btn).removeAttr('disabled');
				switch(data){
					case 'existed':
						alert('已经有其他内容使用了这个名称，请重试');
						break;
					case 'success':
						$(btn).html('修改');
						var firstTd = $(btn).parent().parent().find('td:first');
						var secondTd = $(btn).parent().parent().find('td:eq(1)');
						firstTd.html(name);
						secondTd.html(secondTd.find('.status').val() == 0 ? '禁用' : '启用');
						break;
				}
			});
		}
	})
	$('.delete').click(function(){
		if(window.confirm('您确定要删除这个内容吗？')){
			$.post('/tour/Sys/optionsDelete', {id: $(this).parent().find('input.id').val()}, function(data){
				switch(data){
					case 'used':
						alert('这个内容已经被数据使用，不能删除！');
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