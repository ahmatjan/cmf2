var nowValue;
var nowMultiValue;
$(document).ready(function(){
	$('a.download').click(function(){
		$(this).attr('href', '../upload/' + $(this).parent().find('input.value').val());
	});
	$('#auditForm li').each(function(){
		if(this.className == 'audit1'){
			$('#tabs').append('<li><a href="javascript:void(0);" class="auditbystudent_' + $(this).find('.id').val() + '">' + $(this).text() + '</a></li>');
		}else{
			var oldValue = $.trim($(this).find('.value').val());
			if(oldValue == ''){
				$(this).find('.audit').html('未审核').addClass('disabledBtn');
				$(this).find('.confirm').html('未复核').addClass('disabledBtn');
			}else{
				var oldAudit = $.trim($(this).find('.isaudit').val());
				if(oldAudit == '1'){
					$(this).find('.audit').html('已审核').addClass('disabledBtn');
					var oldConfirm = $.trim($(this).find('.isconfirm').val());
					if(oldConfirm == '1'){
						$(this).find('.confirm').html('已复核').addClass('disabledBtn');	
					}else{
						$(this).find('.confirm').html('未复核').removeClass('disabledBtn');	
					}
				}else{
					$(this).find('.audit').html('未审核').removeClass('disabledBtn');
					$(this).find('.confirm').html('未复核').addClass('disabledBtn');
				}
			}
		}
	})
	$('#tabs li').click(function(){
		$('#tabs li').removeClass('now');
		$(this).addClass('now');
		if($(this).find('a').get(0).className == 'audits'){
			$('#audits').css('display', 'block');
			$('#users').css('display', 'none');
			nowMultiValue = null;
		}else{
			$('#audits').css('display', 'none');
			$('#users').css('display', 'block');
			nowMultiValue = $('#audits input.id[value=' + $(this).find('a').get(0).className.substring(15) + ']').parent().find('.value');
			$('#users .value').val('');
			$('#users .isaudit').val('0');
			$('#users .isconfirm').val('0');
			$('#users .audit').html('未审核').addClass('disabledBtn');
			$('#users .confirm').html('未复核').addClass('disabledBtn');
			if(nowMultiValue != ''){
				var tmpValue = eval('(' + nowMultiValue.val() + ')');
				for(var i = 0; i < tmpValue.length; i++){
					var nowLi = $('#users .id[value=' + tmpValue[i][0] + ']').parent();
					nowLi.find('.value').val(tmpValue[i][1]);
					nowLi.find('.isaudit').val(tmpValue[i][2]);
					nowLi.find('.isconfirm').val(tmpValue[i][3]);
				}
			}
			$('#users li').each(function(){
				var oldValue = $.trim($(this).find('.value').val());
				if(oldValue == ''){
					$(this).find('.audit').html('未审核').addClass('disabledBtn');
					$(this).find('.confirm').html('未复核').addClass('disabledBtn');
				}else{
					var oldAudit = $.trim($(this).find('.isaudit').val());
					if(oldAudit == '1'){
						$(this).find('.audit').html('已审核').addClass('disabledBtn');
						var oldConfirm = $.trim($(this).find('.isconfirm').val());
						if(oldConfirm == '1'){
							$(this).find('.confirm').html('已复核').addClass('disabledBtn');	
						}else{
							$(this).find('.confirm').html('未复核').removeClass('disabledBtn');	
						}
					}else{
						$(this).find('.audit').html('未审核').removeClass('disabledBtn');
						$(this).find('.confirm').html('未复核').addClass('disabledBtn');
					}
				}
			})
		}
	})
	$('.value').click(function(){
		nowValue = $(this);
		$(this).val('');
		$('#uploadDiv').css('display', 'block');
		var left = $(window).width() / 2 - $('#uploadDiv').width() / 2;
		var top = Math.max(100, $(window).height() / 2 - $('#uploadDiv').height() / 2 - 200);
		$('#uploadDiv').css('left', left + 'px').css('top', top + 'px');
	});
	
	$('.audit').click(function(){
		if(this.className.indexOf('disabledBtn') >= 0) return;
		$(this).parent().find('.isaudit').val(1);
		$(this).html('已审核').addClass('disabledBtn');
		$(this).parent().find('.confirm').removeClass('disabledBtn');
		if($(this).parent().parent().attr('id') == 'audits'){
			$.post('/tour/audit/setaudit', {type: 'audit', pid: $('#pid').val(), aoid: $(this).parent().find('.id').val()});
		}else{
			setValue();
			$.post('/tour/audit/saveaudit', {pid: $('#pid').val(), aoid: nowMultiValue.parent().find('.id').val(), value: nowMultiValue.val()});
		}
	});
	$('.confirm').click(function(){
		if(this.className.indexOf('disabledBtn') >= 0) return;
		$(this).parent().find('.isconfirm').val(1);
		$(this).html('已复核').addClass('disabledBtn');
		if($(this).parent().parent().attr('id') == 'audits'){
			$.post('/tour/audit/setaudit', {type: 'confirm', pid: $('#pid').val(), aoid: $(this).parent().find('.id').val()});
		}else{
			setValue();
			$.post('/tour/audit/saveaudit', {pid: $('#pid').val(), aoid: nowMultiValue.parent().find('.id').val(), value: nowMultiValue.val()});
		}
	});
	
    $('#uploadFile').uploadify({
        'swf'      : '/static/images/uploadify.swf',
        'uploader' : '/audit/upload',
		'onUploadSuccess': function(file, data, response) {
			var str = nowValue.val();
			if(str == ''){
				str = data;
			}else{
				str += ',' + data;
			}
			nowValue.val(str);
			if(nowMultiValue) setValue();
        },
		'onQueueComplete' : function(queueData) {
            $('#uploadDiv').css('display', 'none');
        }
    });
	$('#auditSub').click(function(){
		$('form').get(0).submit();
	})
})

function setValue(){
	var str = '';
	$('#users li').each(function(){
		if($(this).find('.value').val() != ''){
			str += ",[" + $(this).find('.id').val() + ",'" + $(this).find('.value').val() + "'," + ($(this).find('.isaudit').val() == '' ? '0' : $(this).find('.isaudit').val()) + ',' + ($(this).find('.isconfirm').val() == '' ? '0' : $(this).find('.isconfirm').val()) + ']';
		}
	});
	if(str != ''){
		str = str.substring(1);
	}
	nowMultiValue.val("[" + str + "]");
}