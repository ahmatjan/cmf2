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
		$.post('/tour/Sys/auditAdd', {name: encodeURIComponent(name), type: $('#type').val()}, function(data){
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
			$(this).html('提交');
			var firstTd = $(this).parent().parent().find('td:first');
			var secondTd = $(this).parent().parent().find('td:eq(1)');
			var type=secondTd.html();
			firstTd.html('<input type="text" class="name" value="' + firstTd.html() + '" />');
			secondTd.html('<select class="type">' + $('#type').html() + '</select>');
			var opt = secondTd.find('select').get(0).options;
			for(var i = 0; i < opt.length; i++){
				if(opt[i].text == type){
					secondTd.find('select').val(opt[i].value);
					return;
				}
			}
		}else{
			var btn = this;
			var name = $.trim($(this).parent().parent().find('.name').val());
			if(name == ''){
				alert('请输入名称');
				return;
			}
			$(this).attr('disabled', true);
			$.post('/tour/Sys/auditModify', {name: encodeURIComponent(name), type:$(this).parent().parent().find('.type').val(), id:$(this).parent().find('input.id').val()}, function(data){
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
						var slt = secondTd.find('select').get(0);
						var opt = slt.options;
						secondTd.html(opt[slt.selectedIndex].text);
						break;
				}
			});
		}
	})
	$('.delete').click(function(){
		if(window.confirm('您确定要删除这个内容吗？')){
			$.post('/tour/Sys/auditDelete', {id: $(this).parent().find('input.id').val()}, function(data){
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