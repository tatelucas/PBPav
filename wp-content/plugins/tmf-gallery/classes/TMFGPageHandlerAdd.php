<?php
class TMFGPageHandlerAdd extends TMFGPageHandler {
	
	public function handle(){
		$this->showPage('add');
	}
	
	public function handlePanels(){
		$this->addPanel(__('Upload Media File', TMFG::i18nDomain), 'add_upload', 'showPanelAddUpload', 'normal');
		
		$this->addPanel(__('Galleries', TMFG::i18nDomain), 'galleries', 'showPanelGalleries', 'side');
		$this->addPanel(__('Gallery Detail', TMFG::i18nDomain), 'galleries_detail', 'showPanelGalleryDetail', 'side');
	}
	
	public function setScreenLayoutColumns($columns, $screen){
		if($screen == $this->hookName){
			$columns[$screen] = 2;
		}
		return $columns;
	}
	
	public function showPanelAddUpload(){
		$this->showPanel('medias.upload');
	}
	
	public final function showPanelGalleries(){
		$this->showPanel('gallery.tree');
	}
	
	public final function showPanelGalleryDetail(){
		$this->showPanel('gallery.detailview');
	}

	public function loadStylesheet(){
		parent::loadStylesheet();
		
		wp_register_style("tmfg-jquery-ui", TMFG::$urlPath."/css/jquery-ui.css", array(), '1.8.3');
		wp_enqueue_style("tmfg-jquery-ui");
		
		wp_register_style("tmfg-page-add", TMFG::$urlPath."/css/admin.page.add.css", array(), TMFG::$version);
		wp_enqueue_style("tmfg-page-add");
	}
	
	public function loadJavascript(){
		parent::loadJavascript();
		
		if(get_option(TMFG::optionPrefix.'batchUpload', TMFGHelper::getDefaultBatchUpload()) == 'flash'){
			$batchUploadFlashOptions = get_option(TMFG::optionPrefix.'batchUploadFlashOptions', TMFGHelper::getDefaultBatchUploadFlashOptions());
			//wp_enqueue_script("swfobject");
			wp_enqueue_script('swfupload');
			wp_enqueue_script('swfupload-queue');
	
			wp_register_script('tmfg-swfu-handler', TMFG::$urlPath."/js/swfupload.handler.js", array('jquery', 'swfupload', 'swfupload-queue'), TMFG::$version);
			wp_localize_script('tmfg-swfu-handler', 'swfuHandlerL10n', array(
				'file' => __('The file', TMFG::i18nDomain),
				'isZero' => __('has a size of zero.', TMFG::i18nDomain),
				'exceed' => __('exceeds the upload file size limit of', TMFG::i18nDomain),
				'ini' => __('KB in your php.ini config file.', TMFG::i18nDomain),
				'tooMany' => __('You have attempted to queue too many files.', TMFG::i18nDomain),
				'invType' => __('has an invalid filetype.', TMFG::i18nDomain),
				'queueEmpty' => __('Upload Queue is empty', TMFG::i18nDomain),
				'queued' => __('photos queued for upload', TMFG::i18nDomain),
				'addMore' => __('Add more...', TMFG::i18nDomain),
				'uploading' => __('Uploading', TMFG::i18nDomain),
				'progressBarUrl' => plugins_url('tmf-gallery/images/progressbar_v12.jpg'),
				'cancelled' => __('cancelled', TMFG::i18nDomain),
				'select' => __('Select Photos...', TMFG::i18nDomain),
				'quotaExceed' => __( 'You have used your space quota. Please delete files before uploading.', TMFG::i18nDomain),
				'fileStatusTextQueued' => __('File is queued', TMFG::i18nDomain),
				'fileStatusTextInProgress' => __('File upload is in progress', TMFG::i18nDomain),
				'fileStatusTextError' => __('Error', TMFG::i18nDomain),
				'fileStatusTextComplete' => __('File upload completed', TMFG::i18nDomain),
				'fileStatusTextCancelled' => __('File upload chancelled', TMFG::i18nDomain),
				'fileStatusTextUnknown' => __('Unknown file status', TMFG::i18nDomain)
			));
			wp_enqueue_script('tmfg-swfu-handler');
			
			wp_register_script('tmfg-swfu-uploader', TMFG::$urlPath."/js/swfupload.uploader.js", array('jquery', 'tmfg-swfu-handler'), TMFG::$version);
			wp_localize_script('tmfg-swfu-uploader', 'swfuUploadL10n', array(
				'debug' => ($batchUploadFlashOptions['debug'] == '1')? 'true' : 'false',
				'file_queue_limit' => ($batchUploadFlashOptions['queueLimit'] == '')? '0':$batchUploadFlashOptions['queueLimit'],
				'button_text' => __('Select Files', TMFG::i18nDomain),
	  			'button_height' => __('23', TMFG::i18nDomain),
				'button_width' => __('132', TMFG::i18nDomain),
				'button_image_url' => includes_url('images/upload.png'),
				'upload_url' => $this->_getFlashUploadLink(), //get_bloginfo('url').'/wp-admin/admin.php',
				'flash_url' => includes_url('js/swfupload/swfupload.swf'),
				'file_types' => get_option(TMFG::optionPrefix.'supportedFileExtensions', '*.*'),
				'file_types_description' => __('Web Image Files...', TMFG::i18nDomain),
				'file_size_limit' => TMFGHelper::getMaxFileSize().' KB',
				'authCookie' => (is_ssl() ? $_COOKIE[SECURE_AUTH_COOKIE] : $_COOKIE[AUTH_COOKIE]),
				'loggedInCookie' => $_COOKIE[LOGGED_IN_COOKIE],
				'quotaAvailable' => is_multisite() ? get_upload_space_available()/1024 : -1,
				'load_image' => plugins_url('css/images/loading.gif'),
				'nonce' => wp_create_nonce('tmfg_nonce')
			));
			wp_enqueue_script('tmfg-swfu-uploader');
		}
		
		wp_register_script('tmfg-page-add', TMFG::$urlPath."/js/page.add.js", array('jquery'), TMFG::$version);
		wp_enqueue_script('tmfg-page-add');
	}
	
	private function _getFlashUploadLink(){
		$uploadLink = get_bloginfo('url').'/wp-admin/admin.php?page=tmfgallery_upload';
		//flash doesn't seem to like encoded ampersands, so convert them back here
		return str_replace('&#038;', '&', $uploadLink);
	}
}
?>