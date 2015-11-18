$(document).ready(function(){
	showColumn();
	$(window).resize(function(){
		showColumn();
	})
	$('#menu a').click(function(){
		if($(this).attr('href').substring(0, 4) != 'java'){
			changeShow(0);
		}
	})
});