<?php 
class TMFGFileHandlerImage extends TMFGFileHandler{
	
	public function __construct($source){
		parent::__construct($source);
	}
	
	public function createImageFormatFile($name){
		$arrayImageFormats = get_option(TMFG::optionPrefix.'image_formats', TMFGHelper::getDefaultImageFormats());
		if(array_key_exists($name, $arrayImageFormats)){
			$this->_createImageFile($name, $arrayImageFormats[$name]);
		}else{
			throw new TMFGException('No image format found with the name '.$name, TMFGException::SEVERITY_ERROR);
		}
	}
	
	public function createImageFormats(){
		$arrayImageFormats = get_option(TMFG::optionPrefix.'image_formats', TMFGHelper::getDefaultImageFormats());
		foreach($arrayImageFormats as $key => $value){
			$this->_createImageFile($key, $value);
		}
	}
	
	private function _createImageFile($name, $imageFormatData){
		try{
			$thumb = PhpThumbFactory::create($this->_getFilePath());
		}catch(Exception $e){
			throw new TMFGException($e->getMessage(), TMFGException::SEVERITY_ERROR);
		}
		switch($imageFormatData['action']){
			case 'crop':
				$thumb->cropFromCenter(intval($imageFormatData['crop']['X']), intval($imageFormatData['crop']['Y']));
				break;
			case 'scale':
				$thumb->adaptiveResize(intval($imageFormatData['scale']['X']), intval($imageFormatData['scale']['Y']));
				break;
			case 'scaleX':
				$thumb->resize(intval($imageFormatData['scaleX']), 0);
				break;
			case 'scaleY':
				$thumb->resize(0, intval($imageFormatData['scaleY']));
				break;
			default:
				return;
				break;
		}
		
		//TODO: Place for effect-hooks
		
		$thumb->save($this->getImageFormatFilePath($name));
	}
	
}
?>