document.write("<script type='text/javascript' src='/tour/static/js/swfupload/swfupload.js'><\/script>");
document.write("<script type='text/javascript' src='/tour/static/js/swfupload/swfupload.queue.js'><\/script>");
document.write("<script type='text/javascript' src='/tour/static/js/swfupload/fileprogress.js'><\/script>");
document.write("<script type='text/javascript' src='/tour/static/js/swfupload/handlers.js'><\/script>");

var uploadObj;

$(document).ready(function(){
	if($('#uploadPanel').length <= 0){
		var uPanel = $('<div id="uploadPanel"><span>已上传文件</span><div class="uploaded"></div><div class="buttons"><span id="upBtn"></span><input id="cancelBtn" type="button" value="取消上传" /></div></div>');
		uPanel.find('.uploaded').click(function(event){
			var nowItem = event.target;
		});
		uPanel.appendTo('body');
		uploadObj = new SWFUpload({
			// Backend Settings
			upload_url: "/upload",
			post_params: {"PHPSESSID" : "fie55f6v75l0kko1kdcm3l5e85"},

			// File Upload Settings
			file_size_limit : "102400",	// 100MB
			file_types : "*.*",
			file_types_description : "All Files",
			file_upload_limit : "10",
			file_queue_limit : "0",

			// Event Handler Settings (all my handlers are in the Handler.js file)
			file_dialog_start_handler : fileDialogStart,
			file_queued_handler : fileQueued,
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,

			// Button Settings
			button_image_url : "XPButtonUploadText_61x22.png",
			button_placeholder_id : "upBtn",
			button_width: 61,
			button_height: 22,
			
			// Flash Settings
			flash_url : "/static/js/swfupload/swfupload.swf",
			

			custom_settings : {
				progressTarget : "fsUploadProgress1",
				cancelButtonId : "cancelBtn"
			},
			
			// Debug Settings
			debug: false
		});
	}
	$('li.upload input').focus(function(){
		var files = $(this).val().split(',');
		 
		$('#uploadPanel .uploaded').html();
		$('#uploadPanel').css('display', 'block');
		
	})
})