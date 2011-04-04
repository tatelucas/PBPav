<form action="admin.php?page=tmfgallery_upload" method="post" enctype="multipart/form-data">
<?php if(get_option(TMFG::optionPrefix.'batchUpload', TMFGHelper::getDefaultBatchUpload()) == 'flash'){ ?>
	<div id="flash-upload-ui">
		Choose files to upload	<div id="flash-browse-button"></div> 
		<span><input id="cancel-upload" disabled="disabled" onclick="cancelUpload()" type="button" value="Cancel Upload" class="button" /></span>
		<br/>
		<span class="description"><strong><?php _e('File Size Limit', TMFG::i18nDomain); ?>:</strong> <?php echo TMFGHelper::getMaxFileSize(); ?> kByte</span><br/>
		<span class="description"><strong><?php _e('Supported File Extensions', TMFG::i18nDomain); ?>:</strong> <?php echo get_option(TMFG::optionPrefix.'supportedFileExtensions', TMFGHelper::getDefaultSupportedFileExtensions()); ?></span>
		<br/><br/>
		<div class="fieldset flash" id="SWFUploadFileListingFiles">
			<span class="legend">Upload Queue</span>
			<div id="SWFUploadFileListingFilesProgress"></div>
			<div class="clear"></div>
		</div>
		<?php 
			$batchUploadFlashOptions = get_option(TMFG::optionPrefix.'batchUploadFlashOptions', TMFGHelper::getDefaultBatchUploadFlashOptions());
			if($batchUploadFlashOptions['debug'] == '1'){
		?>
		<br/><div class="fieldset flash" id="fsUploadDebug">
			<span class="legend">Upload Debug Message</span>
			<pre id="fsUploadDebugMessage"></pre>
		</div> 
		<?php } ?>
	</div>
<?php } ?>
<?php if(get_option(TMFG::optionPrefix.'batchUpload', TMFGHelper::getDefaultBatchUpload()) == 'ajax'){ ?>
	<div id="html-upload-ui"></div> 
<?php } ?>
</form>