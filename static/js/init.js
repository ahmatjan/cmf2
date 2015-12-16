var webFolder = '/cmf/';

$(document).ready(function(){
	$('a[target=right]').click(function(){
	})
	resizeWindow();
	$(window).resize(function(){
		resizeWindow();
	})
});

function resizeWindow(){
	var height = $(window).height();
	//$('#left').css('height', height + 'px');
	//$('#right').css('height', height + 'px');
	var leftheight = $('#left').height();
	$('#right').css('height',leftheight+'px');
	var width = $(window).width();
	$('#right').css('width',920+ 'px');
}

function changeVerify(){
	$('#imgCode').attr('src', webFolder + 'code?id=' + Math.random());
}