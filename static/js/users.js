$(document).ready(function(){
	$('.modify').click(function(){
		if($(this).html() == '修改'){
			$(this).html('提交');
			$(this).parent().parent().find('td:eq(1) input').removeAttr('disabled');
		}else{
			var btn = this;
			var right = new Array();
			var i = 0;
			$(this).parent().parent().find('input:checked').each(function(){
				right[i++] = $(this).val();
			});
			$.post('/tour/Sys/userright', {id: $(this).parent().find('.id').val(), right: right});
			$(this).html('修改');
			$(this).parent().parent().find('td:eq(1) input').attr('disabled', true);
		}
	})
})