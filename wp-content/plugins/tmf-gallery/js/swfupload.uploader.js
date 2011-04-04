var swfu;
var uplsize = 0;
var quotaAvailable = swfuUploadL10n.quotaAvailable;

window.onload = function() {
	var settings = {
		debug : swfuUploadL10n.debug,
		
		upload_url : swfuUploadL10n.upload_url,
		flash_url : swfuUploadL10n.flash_url,
		file_post_name : "async-upload",
		file_types : swfuUploadL10n.file_types,
		file_types_description : swfuUploadL10n.file_types_description,
		file_size_limit : swfuUploadL10n.file_size_limit,
		file_queue_limit : parseInt(swfuUploadL10n.file_queue_limit),
		http_success : [201, 202],
		
		post_params : { 
			auth_cookie : swfuUploadL10n.authCookie,
			logged_in_cookie : swfuUploadL10n.loggedInCookie,
			tmfg_action : 'flash-upload',
			tmfg_nonce : swfuUploadL10n.nonce,
			degraded_element_id : "html-upload-ui", // id of the element displayed when swfupload is unavailable
			swfupload_element_id : "flash-upload-ui" // id of the element displayed when swfupload is available
		},
		
		// Button settings
		button_image_url : swfuUploadL10n.button_image_url,
		button_width : swfuUploadL10n.button_width,
		button_height : swfuUploadL10n.button_height,
		button_placeholder_id : "flash-browse-button",
		button_text : '<span class="button">'+swfuUploadL10n.button_text+'<\/span>',
		button_text_style : '.button { text-align: center; font-weight: bold; font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif; font-size: 11px; text-shadow: 0 1px 0 #FFFFFF; color:#464646; }',
		button_text_left_padding : 0,
		button_text_top_padding : 3,
		
		// The event handler functions are defined in handlers.js
		file_queue_error_handler : fileQueueError,
		file_queued_handler : fileQueued, 
		file_dialog_complete_handler : fileDialogComplete, 
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,
		debug_handler : debugHandler,
		
		custom_settings : {
			load_image : swfuUploadL10n.load_image
		}
	};
	swfu = new SWFUpload(settings);
};