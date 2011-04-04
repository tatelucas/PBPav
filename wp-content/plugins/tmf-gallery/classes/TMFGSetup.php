<?php
/**
* Kurze Beschreibung
* 
* Detail Beschreibung
* 
* @author		Fanninger Thomas (thomas@fanninger.at)
* @copyright	Copyright 2010, Fanninger.at
* @version 	
* @since		31.07.2010
*/
class TMFGSetup implements TMFGHookable {

	public function hookIntoWordPress(){
		register_activation_hook( TMFG::$hookFile, array($this, 'activate') );
		register_deactivation_hook(  TMFG::$hookFile, array($this, 'deactivate') );
		
		if($this->_didVersionChange()){
			add_action('init', array($this, 'autoUpgrade'));
		}else{
			update_option('tmfg_version', TMFG::$version);
		}
	}
	
	public function activate(){
		$queue = TMFGQueue::getInstance();
		$queue->activatePlugin();
		
		if(get_option('tmfg_version') == ''){
			update_option('tmfg_version', TMFG::$version);
		}
	}
	
	public function deactivate(){}
	
	public function autoUpgrade(){
		update_option('tmfg_version', TMFG::$version);
	}
	
	private function _didVersionChange(){
		return (get_option('tmfg_version') == '' || TMFG::$version != get_option('tmfg_version'));
	}
}
?>