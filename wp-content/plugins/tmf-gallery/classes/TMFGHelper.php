<?php 
class TMFGHelper {
	
	public static function createDir($path){
		$created = true;
		if (!file_exists($path)) {
			$created = wp_mkdir_p($path);
		}
		return $created;
	}
	
	public static function removeDir($path){
		$removed = true;
		if (file_exists($path)) {
			$removed = rmdir($path);
		}
		return $removed;
	}
	
	public static function recursiveRemoveDir($filepath){
		if (is_dir($filepath) && !is_link($filepath))
		{
			if ($dh = opendir($filepath))
			{
				while (($sf = readdir($dh)) !== false)
				{
					if ($sf == '.' || $sf == '..')
					{
						continue;
					}
					if (!TMFGHelper::recursiveRemoveDir($filepath.'/'.$sf))
					{
						throw new TMFGException($filepath.'/'.$sf.' could not be deleted.', TMFGException::SEVERITY_ERROR);
					}
				}
				closedir($dh);
			}
			return rmdir($filepath);
		}
		if(file_exists($filepath))
			return unlink($filepath);
		else
			return false;
	}
	
	public static function getMaxFileSizeFromPHPINI(){
		$max_upl_size = strtolower( ini_get( 'upload_max_filesize' ) );
		$max_upl_kbytes = 0;
		if (strpos($max_upl_size, 'k') !== false)
			$max_upl_kbytes = $max_upl_size;
		if (strpos($max_upl_size, 'm') !== false)
			$max_upl_kbytes = $max_upl_size * 1024;
		if (strpos($max_upl_size, 'g') !== false)
			$max_upl_kbytes = $max_upl_size * 1024 * 1024;

		return $max_upl_kbytes;
	}
	
	public static function getMaxFileSize(){
		$settingFileSize = get_option(TMFG::optionPrefix.'fileSizeLimit', TMFGHelper::getDefaultMaxFileSizeLimit());
		if($settingFileSize == '' || $settingFileSize > TMFGHelper::getMaxFileSizeFromPHPINI()){
			return TMFGHelper::getMaxFileSizeFromPHPINI();
		}
		return $settingFileSize;
	}
	
	public static function isWPMU(){
		if(function_exists('is_multisite')){
			return is_multisite();
		}else{
			return false;
		}
	}
	
	public static function getGalleryDirectory(){
		if(TMFGHelper::isWPMU()){
			$uploadDirs = wp_upload_dir();
			$dir = $uploadDirs['basedir'].'/'.TMFG::dirName;
		}else{
			$dir = WP_CONTENT_DIR.'/'.TMFG::dirName;
		}
		return $dir;
	}
	
	public static function getGalleryDirectoryUrl(){
		if(TMFGHelper::isWPMU()){
			$uploadDirs = wp_upload_dir();
			$url = $uploadDirs['baseurl'].'/'.TMFG::dirName;
		}else{
			$url = WP_CONTENT_URL.'/'.TMFG::dirName;
		}
		return $url;
	}
	
	public static function getUploadDirectory(){
		$dir = TMFGHelper::getGalleryDirectory().'/'.'upload';
		if(!TMFGHelper::createDir( $dir )){
			throw new TMFGException('Directory could not be created: '.$dir, TMFGException::SEVERITY_ERROR);
		}
		return $dir;
	}
	
	public static function getMediasDirectory(){
		$dir = TMFGHelper::getGalleryDirectory().'/'.'medias';
		if(!TMFGHelper::createDir( $dir )){
			throw new TMFGException('Directory could not be created: '.$dir, TMFGException::SEVERITY_ERROR);
		}
		return $dir;
	}
	
	public static function getMediasDirectoryUrl(){
		return TMFGHelper::getGalleryDirectoryUrl().'/'.'medias';
	}
	
	public static function getDefaultImageFormats(){
		$aResult = array();
		
		$aResult['original']['name'] = __('Original', TMFG::i18nDomain);
		$aResult['original']['action'] = 'no';
		$aResult['system-thumbnail']['name'] = __('Thumbnail', TMFG::i18nDomain);
		$aResult['system-thumbnail']['action'] = 'scale';
		$aResult['system-thumbnail']['scale']['X'] = '150';
		$aResult['system-thumbnail']['scale']['Y'] = '100';
		
		return $aResult; 
	}
	
	public static function getDefaultManageViewList(){
		$aResult = array();
		
		$aResult['items'] = '5';
		
		return $aResult; 
	}
	
	public static function getDefaultManageViewGallery(){
		$aResult = array();
		
		$aResult['items'] = '20';
		
		return $aResult; 
	}
	
	public static function getDefaultBatchUploadFlashOptions(){
		$aResult = array();
		
		$aResult['debug'] = '0';
		$aResult['queueLimit'] = '0';
		
		return $aResult; 
	}
	
	public static function getDefaultSupportedFileExtensions(){
		return '*.jpg;*.gif;*.png';
	}
	
	public static function getDefaultBatchUpload(){
		return 'flash';
	}
	
	public static function getDefaultManageView(){
		return 'gallery';
	}
	
	public static function getDefaultMaxFileSizeLimit(){
		return TMFGHelper::getMaxFileSizeFromPHPINI();
	}
	
	public static function getFileHandler($mimetype, $aFileData){
		if(strpos($mimetype, 'image') === 0){
			return new TMFGFileHandlerImage($aFileData);
		}else{
			return new TMFGFileHandler($aFileData);
		}
	}
	
	public static function getMimeType($filepath){
		if(function_exists('finfo_open')){
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimetype = finfo_file($finfo, $filepath);
			finfo_close($finfo);
			return $mimetype;
		}elseif(function_exists('system')){
			$mimetype = system('file -i -b '.$filepath);
			$mimetype = explode(';', $mimetype);
			$mimetype = $mimetype[0];
			return $mimetype;
		}
		
		return false;
	}
}
?>