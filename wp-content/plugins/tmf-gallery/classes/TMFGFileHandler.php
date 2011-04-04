<?php 
class TMFGFileHandler{

	protected $_db;
	protected $_sourceID;
	protected $_fileData = array();
	
	public static function getInstance($HTTPFileData){
		return new self($source);
	}

	public function __construct($source){
		$this->_db = TMFGDB::getInstance();
		
		if(is_array($source)){
			$this->_sourceID = md5(uniqid());
			if(!TMFGHelper::createDir( TMFGHelper::getMediasDirectory().'/'.$this->_sourceID )){
				throw new TMFGException('Directoy creation!', TMFGException::SEVERITY_ERROR);
			}
			
			$this->_fileData['id'] = $this->_sourceID;
			
			$this->_fileData['filename'] = $source['name'];
			$this->_fileData['extension'] = end(explode('.', $this->_fileData['filename']));
			$this->_fileData['name'] = basename($this->_fileData['filename'], '.'.$this->_fileData['extension']);
			$this->_fileData['size'] = $source['size'];
			
			$this->_fileData['filepath'] = $this->_getFilePath();
			
			//Move file
			if(!@move_uploaded_file($source['tmp_name'], $this->_fileData['filepath'])){
				//TODO Delete created directory
				throw new TMFGException('Possible file upload attack!', TMFGException::SEVERITY_ERROR);
			}
			
			$this->_fileData['mimetype'] = $this->_getMimeType();
			
			$this->_createFileDBEntry();
		}else{
			$this->_sourceID = $source;
			$this->_getFileDBEntry();
			
			$this->_fileData['filepath'] = $this->_getFilePath();
		}
		
		$this->_fileData['fileurl'] = TMFGHelper::getMediasDirectoryUrl().'/'.$this->_sourceID.'/original.'.$this->_fileData['extension'];
	}
	
	protected function _createFileDBEntry(){
		$this->_db->createFileDBEntry($this->_fileData['id'], $this->_fileData['filename'], $this->_fileData['mimetype'], $this->_fileData['size']);
	}
	
	protected function _getFileDBEntry(){
		$this->_fileData = $this->_db->getFileDBEntry($this->_sourceID);
	}
	
	protected function _updFileDBEntry(){
		//TODO: Implementation
	}
	
	protected function _getFilePath(){
		return TMFGHelper::getMediasDirectory().'/'.$this->_sourceID.'/original.'.$this->_fileData['extension'];
	}
	
	public function getTitel(){
		return $this->_fileData['name'];
	}
	
	public function getID(){
		return $this->_fileData['id'];
	}
	
	protected function _getMimeType(){
		if(function_exists('finfo_open')){
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimetype = finfo_file($finfo, $this->_fileData['filepath']);
			finfo_close($finfo);
			return $mimetype;
		}elseif(function_exists('system')){
			$mimetype = system('file -i -b '.$this->_fileData['filepath']);
			$mimetype = explode(';', $mimetype);
			$mimetype = $mimetype[0];
			return $mimetype;
		}
		
		return false;
	}
	
	public function getOriginal(){
		return $this->getImageFormatFilePath('original');
	}
	
	public function getOriginalUrl(){
		return $this->getImageFormatFileUrl('original');
	}
	
	public function getThumbnail(){
		return $this->getImageFormatFilePath('system-thumbnail');
	}
	
	public function getThumbnailUrl(){
		return $this->getImageFormatFileUrl('system-thumbnail');
	}
	
	public function setThumbnail($filePath){
		$this->setImageFormatFile('system-thumbnail', $filePath);
	}
	
	public function setImageFormatFile($name, $filePath){
		if(!@move_uploaded_file($filePath, $this->getImageFormatFilePath($name))){
			throw new TMFGException("Don't possible to write new image into target", TMFGException::SEVERITY_ERROR);
		}
	}
	
	public function getImageFormatFilePath($name){
		return str_replace('/original.', '/'.$name.'.', $this->_fileData['filepath']);
	}
	
	public function getImageFormatFileUrl($name){
		return str_replace('/original.', '/'.$name.'.', $this->_fileData['fileurl']);
	}
}
?>