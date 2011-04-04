<?php 

class TMFGRequestHandler implements TMFGHookable {
	
	private $uploadErrors = array(
        0=>"There is no error, the file uploaded with success",
        1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini",
        2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        3=>"The uploaded file was only partially uploaded",
        4=>"No file was uploaded",
        6=>"Missing a temporary folder"
	);
	
	public function hookIntoWordPress(){
		$this->_checkNonce();
		$this->_flashBugfix();
		
		switch($this->_getAction()){
			case 'flash-upload':
				//Save Media-Files
				/*
				 * 1. Generate a token
				 * 2. Generate directory (name is the token)
				 * 3. Save file to disk
				 * 4. Save file data into the DB
				 */
				
				$upload_name = "async-upload";
				
				// Validate the upload
				if (!isset($_FILES[$upload_name])) {
					throw new TMFGException("No upload found in \$_FILES for " . $upload_name, TMFGException::SEVERITY_ERROR);
				} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
					throw new TMFGException($this->uploadErrors[$_FILES[$upload_name]["error"]], TMFGException::SEVERITY_ERROR);
				} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
					throw new TMFGException('Upload failed is_uploaded_file test.', TMFGException::SEVERITY_ERROR);
				} else if (!isset($_FILES[$upload_name]['name'])) {
					throw new TMFGException('File has no name.', TMFGException::SEVERITY_ERROR);
				}
				
				//Get Mimetype			
				if(($mimetype = TMFGHelper::getMimeType($_FILES[$upload_name]['tmp_name'])) == null){
					$mimetype = $_FILES[$upload_name]['type'];
				}
				
				//Create Image Formats
				$fileHandler = TMFGHelper::getFileHandler($mimetype, $_FILES[$upload_name]);
				if(get_class($fileHandler) == 'TMFGFileHandlerImage'){
					$fileHandler->createImageFormats();
				}
				
				break;
		}
		
		die();
	}
	
	private function _getAction(){
		return $_REQUEST['tmfg_action'];
	}
	
	private function _checkNonce(){
		if(function_exists('wp_verify_nonce'))
			if (! wp_verify_nonce($_REQUEST['tmfg_nonce'], 'tmfg_nonce') ) die('Security check');
	}
	
	private function _flashBugfix(){
		// Flash often fails to send cookies with the POST or upload, so we need to pass it in GET or POST instead
		if ( is_ssl() && empty($_COOKIE[SECURE_AUTH_COOKIE]) && !empty($_REQUEST['auth_cookie']) )
			$_COOKIE[SECURE_AUTH_COOKIE] = $_REQUEST['auth_cookie'];
		elseif ( empty($_COOKIE[AUTH_COOKIE]) && !empty($_REQUEST['auth_cookie']) )
			$_COOKIE[AUTH_COOKIE] = $_REQUEST['auth_cookie'];
		if ( empty($_COOKIE[LOGGED_IN_COOKIE]) && !empty($_REQUEST['logged_in_cookie']) )
			$_COOKIE[LOGGED_IN_COOKIE] = $_REQUEST['logged_in_cookie'];
	}
}
?>