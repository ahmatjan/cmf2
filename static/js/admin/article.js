$(document).ready(function(){
	$('#addAttach').click(function(){
		$('#attachments').append('<div><label>&nbsp;</label><input type="file" name="attachment[]" /><input type="text" name="filename[]" placeholder="附件名称" /><a href="javascript: void(0);">×</a></div>');
	})
	$('#attachments').click(function(event){
		var o = event.target;
		if($(o).html() == '×'){
			$(o).parent().remove();
		}
	})
	$('#folder option').removeAttr('selected');
	$('#group option').removeAttr('selected');
	$('#oldFolders input').each(function(){
		$('#folder option[value=' + $(this).val() + ']').attr('selected', 'selected');
	})
	$('#oldGroups input').each(function(){
		$('#group option[value=' + $(this).val() + ']').attr('selected', 'selected');
	})
	$('#oldAttachments a').click(function(){
		$(this).parent().remove();
	})
	$('#addSub').click(function(){
		if($.trim($('#title').val()) == ''){
			alert('请输入标题');
			return;
		}
		if($('#group option:selected').length == 0){
			alert('请至少选择一个可见组');
			return;
		}
		if($('#folder option:selected').length == 0){
			alert('请至少选择一个栏目');
			return;
		}
		$('form').get(0).submit();
	})
	$('.deleteaudit').click(function(){
		if(window.confirm('取消审核后您要重新审核才能发布，您确定要取消审核吗？')){
			$.post('delarticle', {id: $(this).parent().find('input:hidden').val(), type: 'deleteaudit'}, function(data){
				alert('取消成功');
				location.reload();
			});
		}
	})
	$('.delete').click(function(){
		if(window.confirm('您确定要删除这篇文章吗？')){
			$.post('delarticle', {id: $(this).parent().find('input:hidden').val(), type: 'delete'}, function(data){
				alert('删除成功');
				location.reload();
			});
		}
	})
	$('.modify').click(function(){
		location.href = 'articlemodify?id=' + $(this).parent().find('input:hidden').val();
	})
	$('.addaudit').click(function(){
		showAudit($(this).parent().find('input:hidden').val(), false);
	})
	$('.audit').click(function(){
		showAudit($(this).parent().find('input:hidden').val(), true);
	})
	
	$('#rlt0').click(function(){
		$('#nextAudit').css('display', 'none');
	});
	$('#rlt1').click(function(){
		$('#nextAudit').css('display', 'block');
	});
	
	$('#auditSub').click(function(){
		if($('#rltDiv').css('display') == 'block'){
			if($('#rlt0').prop('checked') && $.trim($('#comment').val()) == ''){
				alert('请输入附言');
				return;
			}
		}
		$('form').get(0).submit();
	})
	$('.seeaudit').click(function(){
		$.post('seeaudit', {id: $(this).parent().find('input:hidden').val()},function(data){
			if(data == ''){
				$('#seeauditDiv ul').html('<li>无审核记录</li>');
			}else{
				var str = '';
				var backData = $.parseJSON(data);
				for(var i = 0; i < backData.length; i++){
					str += '<li><span class="time">' + backData[i].time + '</span><span class="info"><i>' + backData[i].auditer + '</i>' + (backData[i].status == 1 ? '驳回了申请' : (backData[i].status == 2 ? '通过申请' : '接受了申请但未审核')) + '</span>' + (backData[i].comment == '' ? '' : ('<span class="comment">附言：' + backData[i].comment + '</span>')) + '</li>'
				}
				$('#seeauditDiv ul').html(str);
			}
			$('#seeauditDiv').css('display', 'block');
			var left = $(window).width() / 2 - $('#seeauditDiv').width() / 2;
			var top =  $(window).height() / 2 - $('#seeauditDiv').height() / 2;
			$('#seeauditDiv').css('left', left + 'px').css('top', top + 'px');
		})
	})
	$('.popDiv .close').click(function(){
		$('.popDiv').css('display', 'none');
	})
})

function showAudit(id, flag){
	if(flag){
		$('#rltDiv').css('display', 'block');
		$('#rlt1').prop('checked', true);
		if($('#auditer option:first').val() != 0){
			$('#auditer').prepend('<option value="0">无需审核，直接通过</option>');
		}
	}else{
		$('#rltDiv').css('display', 'none');
		if($('#auditer option:first').val() == 0){
			$('#auditer option:first').remove();
		}
	}
	$('#audittype').val(flag);
	$('#auditDiv').css('display', 'block');
	$('#auditDiv #artid').val(id);
	var left = $(window).width() / 2 - $('#auditDiv').width() / 2;
	var top =  $(window).height() / 2 - $('#auditDiv').height() / 2;
	$('#auditDiv').css('left', left + 'px').css('top', top + 'px');
}