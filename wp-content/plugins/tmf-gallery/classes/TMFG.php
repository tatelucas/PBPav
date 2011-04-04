<?php 
class TMFG{
	
	const i18nDomain = 'TMFG';
	const optionPrefix = 'tmfg_';
	const dirName = 'tmfg-gallery';
	public static $version;
	public static $urlPath;
	public static $hookFile;
	
	public function __construct(){
		$this->_setupPluginLocalization();
		
		$handlers = $this->_createWordPressCallbackHandlers();
		$this->_registerHandlersWithWordPress($handlers);
	}
	
	private function _setupPluginLocalization(){
		load_plugin_textdomain(TMFG::i18nDomain, '', 'tmf-gallery/lang/');
	}
	
	private function _createWordPressCallbackHandlers(){
		$handlers = array();
		
		$handlers[] = new TMFGSetup();
		
		if(isset($_REQUEST['tmfg_action'])){
			$handlers[] = new TMFGRequestHandler();
		}else{
			$handlers[] = new TMFGAjaxHandler();
			$handlers[] = new TMFGAdminPages();
		}
		
		return $handlers;
	}
	
	private function _registerHandlersWithWordPress(array $handlers){
		foreach($handlers as $handler){
			$this->_hookIntoWordPress($handler);
		}
	}
	
	private function _hookIntoWordPress(TMFGHookable $handler){
		$handler->hookIntoWordPress();	
	}
}
?>