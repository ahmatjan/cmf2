var msg;
$(document).ready(function(){
	$('#type').change(function(){
		switch($(this).val()){
			case '0':
			case '2':
			case '4':
				$('#valueLi').addClass('hidden');
				$('#typeLi').addClass('hidden');
				break;
			case '1':
				$('#valueLi').removeClass('hidden');
				$('#typeLi').addClass('hidden');
				break;
			case '3':
				$('#valueLi').addClass('hidden');
				$('#typeLi').removeClass('hidden');
				break;
		}
	});
	$('#addSub').click(function(){
		var name = $.trim($('#name').val());
		if(name == ''){
			alert('请输入名称');
			$('#name').focus();
			return;
		}
		var valueField = $('ul.add .value:visible');
		var postData = {name: name, type: $('#type').val(), display: $('#display').val(), search: $('#search0').prop('checked')?0:1, inlist: $('#inlist0').prop('checked')?0:1, value: valueField.length > 0 ? valueField.val() : 0, table:$('#table').val()};
		$(this).attr('disabled', true);
		$.post('/tour/Sys/fieldsAdd', postData);
		msg = '添加成功';
		setTimeout("reload()", 1000);
		
	})
	$('.delete').click(function(){
		if(window.confirm('删除此字段后，该数据表中此字段的内容将无法找回。您确定要删除吗？')){
			var postData = {id: $(this).parent().find('.id').val(), table: $('#table').val()};
			$.post('/tour/Sys/fieldsDelete', postData);
			msg = '删除成功';
			setTimeout("reload()", 1000);
		}
	})
	$('.modify').click(function(){
		if($(this).html() == '修改'){
			$(this).html('提交');
			var firstTd = $(this).parent().parent().find('td:first');
			var secondTd = $(this).parent().parent().find('td:eq(1)');
			var thirdTd = $(this).parent().parent().find('td:eq(2)');
			var rlt = thirdTd.html();
			var td4 = $(this).parent().parent().find('td:eq(3)');
			var display = td4.html();
			var type = thirdTd.html();
			var td5 = $(this).parent().parent().find('td:eq(4)');
			var td6 = $(this).parent().parent().find('td:eq(5)');
			firstTd.html('<input type="text" class="order" value="' + firstTd.html() + '" />');
			secondTd.html('<input type="text" class="name" value="' + secondTd.html() + '" />');
			thirdTd.html('<select class="type">' + $('#type').html() + '</select><div class="valueDiv"><label for="value">长度：</label><input type="number" size="4" style="width: 60px;" class="value" min="1" max="1000" value="20" /></div><div class="typeDiv"><select class="value">' + $('#typeLi .value').html() + '</select></div>');
			var strpos = rlt.indexOf('(');
			var _t, _v;
			if(strpos > 0){
				_t = rlt.substring(0, strpos);
				_v = rlt.substring(strpos + 1, rlt.length - 1);
			}else{
				_t = rlt;
			}
			var opt = thirdTd.find('select:first').get(0).options;
			for(var i = 0; i < opt.length; i++){
				if(opt[i].text == _t){
					thirdTd.find('select:first').val(opt[i].value);
					break;
				}
			}
			
			if(_t == '文本'){
				thirdTd.find('input.value').val(_v);
			}else if(_t == '选择'){
				opt = thirdTd.find('select:last').get(0).options;
				for(var i = 0; i < opt.length; i++){
					if(opt[i].text.substring(0, _v.length) == _v){
						thirdTd.find('select:last').val(opt[i].value);
						break;
					}
				}
			}
			
			td4.html('<select class="display">' + $('#display').html() + '</select>');
			opt = td4.find('select').get(0).options;
			td5.html('<select class="search"><option value="0">否</option><option ' + (td5.html() == '是' ? 'selected':'')  +' value="1">是</option>');
			td6.html('<select class="inlist"><option value="0">否</option><option ' + (td6.html() == '是' ? 'selected':'')  +' value="1">是</option>');
			for(var i = 0; i < opt.length; i++){
				if(opt[i].text == display){
					td4.find('select').val(opt[i].value);
					break;
				}
			}
			setShown(thirdTd);
			thirdTd.find('select').change(function(){
				setShown(thirdTd);
			})
		}else{
			var btn = this;
			var name = $.trim($(this).parent().parent().find('.name').val());
			if(name == ''){
				alert('请输入名称');
				$(this).parent().parent().find('.name').focus();
				return;
			}
			var valueField = $(this).parent().parent().find('.value:visible');
			var postData = {name: encodeURIComponent(name), type: $(this).parent().parent().find('.type').val(), display: $(this).parent().parent().find('.display').val(), search: $(this).parent().parent().find('.search').val(), inlist: $(this).parent().parent().find('.inlist').val(), value: (valueField.length > 0 ? valueField.val() : 0), table:$('#table').val(),order:$(this).parent().parent().find('.order').val(), id:$(this).parent().find('.id').val()};
			$.post('/tour/Sys/fieldsModify', postData);
			$(btn).html('修改');
			var firstTd = $(btn).parent().parent().find('td:first');
			var secondTd = $(btn).parent().parent().find('td:eq(1)');
			var thirdTd = $(btn).parent().parent().find('td:eq(2)');
			var td4 = $(btn).parent().parent().find('td:eq(3)');
			var td5 = $(btn).parent().parent().find('td:eq(4)');
			var td6 = $(btn).parent().parent().find('td:eq(5)');
			firstTd.html(firstTd.find('input').val());
			secondTd.html(secondTd.find('input').val());
			if(thirdTd.find('select:first').val() == '3'){
				var text = thirdTd.find('select:last').get(0).options[thirdTd.find('select:last').get(0).selectedIndex].text;
				text = text.substring(0, text.indexOf('('));
				thirdTd.html(thirdTd.find('select:first').get(0).options[thirdTd.find('select:first').get(0).selectedIndex].text + '(' + text + ')')
			}else if(thirdTd.find('select:first').val() == 1){
				thirdTd.html(thirdTd.find('select:first').get(0).options[thirdTd.find('select:first').get(0).selectedIndex].text + '(' + thirdTd.find('input.value').val() + ')')
			}else{
				setHtml(thirdTd);
			}
			setHtml(td4);
			setHtml(td5);
			setHtml(td6);
		}
	})
})
function setHtml(td){
	var slt = td.find('select').get(0);
	td.html(slt.options[slt.selectedIndex].text);
}

function reload(){
	$('#addSub').removeAttr('disabled');
	alert(msg); 
	location.reload();
}

function setShown(td){
	var type = td.find('select').val();
	switch(type){
		case '1':
			td.find('.valueDiv').css('display', 'block');
			td.find('.typeDiv').css('display', 'none');
			break;
		case '3':
			td.find('.typeDiv').css('display', 'block');
			td.find('.valueDiv').css('display', 'none');
			break;
		default:
			td.find('.valueDiv').css('display', 'none');
			td.find('.typeDiv').css('display', 'none');
			break;
	}
}