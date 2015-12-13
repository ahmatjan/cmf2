$(document).ready(function(){
	$('ul.menuList a').click(function(){
		if($(this).find('input').length> 0){
			setShown(this);
		}
	})
})

function setShown(item){
	if(item.className == 'close'){
		item.className = 'open';
		$('#type_' + $(item).find('input').val()).css('display', 'block');
	}else{
		item.className = 'close';
		$('#type_' + $(item).find('input').val()).css('display', 'none');
	}
}