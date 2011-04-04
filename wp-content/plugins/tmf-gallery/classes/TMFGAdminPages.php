<?php 
class TMFGAdminPages implements TMFGHookable {
	
	public static $hookName = array();
	
	public function hookIntoWordPress(){
		add_action('admin_menu', array($this, 'actionSetupAdminPages'));
	}
	
	public function actionSetupAdminPages(){
		$this->_setupManagePage();
		$this->_setupSettingsPage();
	}
	
	private function _setupManagePage(){
		$handler = new TMFGPageHandlerOverview();
		add_menu_page( __('TMF Gallery - Gallery', TMFG::i18nDomain), __('Gallery', TMFG::i18nDomain), 'administrator', 'tmfgallery', array($handler, 'handle'), TMFG::$urlPath.'/images/folder_mono16x16.png', 30 );
		TMFGAdminPages::$hookName['overview'] = add_submenu_page('tmfgallery', __('TMF Gallery - Overview', TMFG::i18nDomain), __('Overview', TMFG::i18nDomain), 'administrator', 'tmfgallery', array ($handler, 'handle'));
		$handler->setHookName('overview');
		
		$handler = new TMFGPageHandlerAdd();
		TMFGAdminPages::$hookName['add'] = add_submenu_page('tmfgallery', __('TMF Gallery - Add Medias', TMFG::i18nDomain), __('Add Medias', TMFG::i18nDomain), 'administrator', 'tmfgallery_upload', array($handler, 'handle'));
		$handler->setHookName('add');
		
		$handler = new TMFGPageHandlerMedias();
		TMFGAdminPages::$hookName['medias'] = add_submenu_page('tmfgallery', __('TMF Gallery - Manage Medias', TMFG::i18nDomain), __('Manage Medias', TMFG::i18nDomain), 'administrator', 'tmfgallery_medias', array($handler, 'handle'));
		$handler->setHookName('medias');
		
		$handler = new TMFGPageHandlerGalleries();
		TMFGAdminPages::$hookName['galleries'] = add_submenu_page('tmfgallery', __('TMF Gallery - Manage Galleries', TMFG::i18nDomain), __('Manage Galleries', TMFG::i18nDomain), 'administrator', 'tmfgallery_galleries', array($handler, 'handle'));
		$handler->setHookName('galleries');
		
		$handler = new TMFGPageHandlerAbout();
		TMFGAdminPages::$hookName['about'] = add_submenu_page('tmfgallery', __('TMF Gallery - About', TMFG::i18nDomain), __('About', TMFG::i18nDomain), 'administrator', 'tmfgallery_about', array($handler, 'handle'));
		$handler->setHookName('about');
	}
	
	private function _setupSettingsPage(){
		$handler = new TMFGPageHandlerSettings();
		TMFGAdminPages::$hookName['settings'] = add_options_page( __('TMF Gallery', TMFG::i18nDomain), __('TMF Gallery', TMFG::i18nDomain), 'administrator', 'tmfgallery_settings', array($handler, 'handle'));
		$handler->setHookName('settings');
	}
}
?>