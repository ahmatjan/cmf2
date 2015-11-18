$(document).ready(function(){
	$('#tree i').click(function(){
		var className = this.className;
		if(className == 'close'){
			this.className = 'open';
			$(this).parent().children('ul').css('display', 'block');
		}else if(className == 'open'){
			this.className = 'close';
			$(this).parent().children('ul').css('display', 'none');
		}
	})
})