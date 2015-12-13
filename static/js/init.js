var webFolder = '/cmf/';

$(document).ready(function(){
	$('a[target=right]').click(function(){
		changeShow(2);
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
	$('#right').css('width', width - 280+ 'px');
}

function changeVerify(){
	$('#imgCode').attr('src', webFolder + 'code?id=' + Math.random());
}

function changeShow(type){
	var _middlepart = $('#middlepart', window.top.document);
	var _rightpart = $('#rightpart', window.top.document);
	switch(type){
		case 0:
			_middlepart.removeClass('hidden');
			_rightpart.addClass('hidden');
			break;
		case 1:
			_middlepart.addClass('hidden');
			_rightpart.removeClass('hidden');
			break;
		case 2:
			_middlepart.removeClass('hidden');
			_rightpart.removeClass('hidden');
			break;
	}
	showColumn();
}

function showColumn(){
	var _middlepart = $('#middlepart', window.top.document);
	var _rightpart = $('#rightpart', window.top.document);
	var width = $(window.top.document).width() - 105;
	var height = $(window).height();
	if(_middlepart.get(0).className.indexOf('hidden') >= 0){
		_rightpart.css('width', width + 'px');
	}else if(_rightpart.get(0).className.indexOf('hidden') >= 0){
		_middlepart.css('width', width + 'px');
	}else{
		_middlepart.css('width', '500px');
		_rightpart.css('width', width - 500 + 'px');
	}
	_middlepart.css('height', height + 'px');
	_rightpart.css('height', height + 'px');
}