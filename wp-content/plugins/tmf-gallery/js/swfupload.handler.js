function debugHandler(message){
	jQuery('#fsUploadDebugMessage').append(message.replace(/</g,"&lt;").replace(/>/g,"&gt;")+"\r\n");
}

function fileQueueError(file, error_code, message) {
	try {
		var error_name = "";

		switch (error_code) {
			case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
				error_name = swfuHandlerL10n.file + " " + file.name + " " + swfuHandlerL10n.isZero;
				break;
			case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
				error_name = swfuHandlerL10n.file + " " + file.name + swfuHandlerL10n.exceed + " " + this.getSetting('file_size_limit') + swfuHandlerL10n.ini;
				break;
			case SWFUpload.ERROR_CODE_QUEUE_LIMIT_EXCEEDED:
				error_name = swfuHandlerL10n.tooMany;
				break;
			case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
				error_name = swfuHandlerL10n.file + " " + file.name + " " + swfuHandlerL10n.invType;
				break;
			default:
				error_name = message;
				break;
		}

		alert(error_name);
		
	} catch (ex) {
		this.debug(ex);
	}
}

function getFileStatusString(file){
	switch(file.filestatus){
		case SWFUpload.FILE_STATUS.QUEUED:
			return swfuHandlerL10n.fileStatusTextQueued;
		case SWFUpload.FILE_STATUS.IN_PROGRESS:
			return swfuHandlerL10n.fileStatusTextInProgress;
		case SWFUpload.FILE_STATUS.ERROR:
			return swfuHandlerL10n.fileStatusTextError;
		case SWFUpload.FILE_STATUS.COMPLETE:
			return swfuHandlerL10n.fileStatusTextComplete;
		case SWFUpload.FILE_STATUS.CANCELLED:
			return swfuHandlerL10n.fileStatusTextCancelled;
		default:
			return swfuHandlerL10n.fileStatusTextUnknown;
	}
}

function fileQueued(file) {
	try {
		uplsize = Math.round(file.size/1024);
		jQuery("#SWFUploadFileListingFilesProgress")
			.append("<div class='progressWrapper' id='" + file.id + "'>" +
					"<a id='" + file.id + "deletebtn' class='cancelbtn ui-icon ui-icon-circle-close' href='javascript:swfu.cancelUpload(\"" + file.id + "\");'></a>" +
					"<span id='" + file.id + "loader' class='ui-icon ui-icon-loading-image' style='display: none;'></span>" +
					"<div class='progressTitle'>" + file.name +" <br/><span id='" + file.id + "progress' class='description'>" + uplsize + " kByte</span><br/>" +
					"<span id='" + file.id + "status' class='description'>" + getFileStatusString(file) + "</span></div>" +
					"</div>");
	
	} catch (ex) {
		this.debug(ex);
	}	
}

function fileDialogComplete(queuelength) {
	try {
		if (queuelength > 0) {
			jQuery("#cancel-upload").removeAttr('disabled');
			//start auto upload
			this.startUpload();
		}
	} catch (ex) {
		this.debug(ex);
	}	
}

function uploadFileCancelled(file, queuelength) {
	jQuery("#" + file.id + "status").html( getFileStatusString(file) );
}

function uploadStart(file) {
	try{
		if(quotaAvailable != -1){
			quotaAvailable -= Math.round(file.size/1024);
			if(quotaAvailable <= 0)
				return false;	
		}
		jQuery("#" + file.id + "loader").show();
		jQuery("#" + file.id + "status").html( getFileStatusString(file) );
	} catch (ex) {
		this.debug(ex);
	}
	return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	jQuery("#" + file.id + "status").html( getFileStatusString(file) );
}

function uploadError(file, error_code, message) {
	try {
		switch (error_code) {
			case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
				try {
					jQuery("#"+file.id).text(file.name + " - " + swfuHandlerL10n.cancelled)
						.attr("class","SWFUploadFileItem uploadCancelled")
							.slideUp("fast",function(){
				   				jQuery(this).remove();
				 			});
					uplsize -= Math.round(file.size/1024);
					jQuery("#queueinfo").text(this.getStats().files_queued + " " + swfuHandlerL10n.queued + "( " + uplsize + "KB )");
					if(!this.getStats().files_queued){
						jQuery("#" + swfu.movieName + "UploadBtn").css("display","none");
						jQuery("#SWFUploadFileListingFiles").empty();
						jQuery(".browsebtn").text(swfuHandlerL10n.select);
					}
				}catch (ex1) {
					this.debug(ex1);
				}
				break;
			case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
				this.debug("Upload stopped: File name: " + file.name);
				break;
			case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
				jQuery("#" + file.id + "status").html( "Upload Error: " + message );
				this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
				jQuery("#" + file.id + "status").html( "Upload Failed." );
				this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.IO_ERROR:
				jQuery("#" + file.id + "status").html( "Server (IO) Error" );
				this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
				jQuery("#" + file.id + "status").html( "Security Error" );
				this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
				alert("Upload limit exceeded.");
				this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
				alert(swfuHandlerL10n.quotaExceed);
				this.debug("Error Code: File Validation Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
				cancelEntireQueue();
				break;
			default:
				alert(message);
				break;
		}
	} catch (ex3) {
		this.debug(ex3);
	}
}

function uploadSuccess(file, server_data) {
	try {
		jQuery("#" + file.id + "loader").hide();
		jQuery("#" + file.id + "status").html( getFileStatusString(file) );
		if(file.filestatus == SWFUpload.FILE_STATUS.COMPLETE){
			jQuery("#" + file.id + "deletebtn").replaceWith('<span class="ui-icon ui-icon-circle-check"></span>');
		}else{
			jQuery("#" + file.id + "deletebtn").replaceWith('<span class="ui-icon ui-icon-alert"></span>');
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadComplete(file) {
	try {
		/*  I want the next upload to continue automatically so I'll call startUpload here */
		if (this.getStats().files_queued > 0) {
			this.startUpload();
		} else {
//			jQuery("#queueinfo").text(swfuHandlerL10n.allUp);
//			jQuery("#commonInfo").slideDown('slow');
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function cancelUpload() {
	try{
		var queuelength = swfu.getStats().files_queued;
		if(queuelength){	
			if(confirm(swfuHandlerL10n.cancelConfirm)){
				cancelEntireQueue();
			}
		}else
			window.location = window.location.href;
	} catch (ex) {
		this.debug(ex);
	}
}

function cancelEntireQueue(){
	var queuelength = swfu.getStats().files_queued;
	swfu.stopUpload();
	for(var index=0; index<queuelength; index++) {
		swfu.cancelUpload();
	}
}

function cancelUpload() {
	swfu.cancelQueue();
}