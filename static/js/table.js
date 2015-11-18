$(document).ready(function(){
	$('.delete').click(function(){
		if(window.confirm('您确定要删除这条记录吗')){
			$.post('/tour/table/delete' + $('#tableName').val().substring(4), {id: $(this).parent().find('.id').val()}, function(){
				alert('删除成功');
				location.reload();
			})
		}
	})
	$('#selectAll').click(function(){
		$('input:checkbox').prop('checked', $(this).prop('checked'));
	})
	$('#sendsms').click(function(){
		var ids = '';
		$('input:checked').each(function(){
			if($(this).attr('id') != 'selectAll'){
				if(ids == ''){
					ids = $(this).parent().parent().find('.id').val();
				}else{
					ids += ',' + $(this).parent().parent().find('.id').val();
				}
			}
		});
		$('#excelForm #ids').val(ids);
		$('#excelForm').attr('action', '/table/sms').get(0).submit();
	})
	$('#export').click(function(){
		var ids = '';
		$('input:checked').each(function(){
			if($(this).attr('id') != 'selectAll'){
				if(ids == ''){
					ids = $(this).parent().parent().find('.id').val();
				}else{
					ids += ',' + $(this).parent().parent().find('.id').val();
				}
			}
		});
		$('#excelForm #ids').val(ids);
		$('#excelForm').attr('action', '/table/exportuser').get(0).submit();
	})
	if($('.oldData').length > 0){
		$('.oldData input:hidden').each(function(){
			$('#' + this.className).val($(this).val());
		})
	}
	if($('.oldUsers').length > 0){
		$('.oldUsers input').each(function(){
			var nowOption = $('#pusers option[value="' + $(this).val() + '"]');
			$('#users').prepend('<li>' + nowOption.html() + '<input type="hidden" name="puids[]" value="' + nowOption.val() + '" /><input type="button" class="deluser" value="删除" /></li>');
			nowOption.remove();
		})
		if($('#pusers option').length < 1){
			$('#pusers').parent().css('display', 'none');
		}			
	}
	$('#addSub').click(function(){
		var flag = true;
		var emptyInput;
		$('input:text').each(function(){
			if($.trim($(this).val()) == ''){
				emptyInput = this;
				flag = false;
				return;
			}
		})
		if(!flag){
			if(!window.confirm('您还有尚未填写的内容，您确定现在就要提交吗？')){
				emptyInput.focus();
				return;
			}
		}
		$('form').get(0).submit();
	})
	$('#users').click(function(event){
		var nowItem = event.target;
		if($(nowItem).attr('id') == 'adduser'){
			var nowOption = $('#pusers option:eq(' + $('#pusers').get(0).selectedIndex + ')');
			$('#users').prepend('<li>' + nowOption.html() + '<input type="hidden" name="puids[]" value="' + nowOption.val() + '" /><input type="button" class="deluser" value="删除" /></li>');
			nowOption.remove();
			if($('#pusers option').length < 1){
				$('#pusers').parent().css('display', 'none');
			}
		}else{
			if(nowItem.className == 'deluser'){
				$('#pusers').append('<option value="' + $(nowItem).parent().find('input:hidden').val() + '">' + $(nowItem).parent().text() + '</option>').parent().css('display', 'block');
				$(nowItem).parent().remove();
			}
		}
	})
})