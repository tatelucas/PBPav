<?php 
class TMFGPageHandlerSettings extends TMFGPageHandler{
	
	public function __construct(){
		parent::__construct();
		if( is_admin() ){
			add_action('admin_init', array($this, 'registerSettings'));
		}
	}
	
	public function handle(){
		$this->showPage('settings');
	}
	
	public function handlePanels(){
		$this->addPanel(__('Controls', TMFG::i18nDomain), 'controls', 'showPanelControls', 'side');
		$this->addPanel(__('Image Formats', TMFG::i18nDomain), 'imageformats', 'showPanelImageFormats');
		$this->addPanel(__('General Options', TMFG::i18nDomain), 'generaloptions', 'showPanelGeneralOptions');
	}
	
	public final function showPanelControls(){
		$this->showPanel('controls');
	}
	
	public final function showPanelGeneralOptions(){
		$this->showPanel('generaloptions');
	}
	
	public final function showPanelImageFormats(){
		$this->showPanel('imageformats');
	}
	
	public function registerSettings(){
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'supportedFileExtensions');
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'fileSizeLimit');
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'batchUpload');
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'batchUploadFlashOptions');	//Array
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'batchUploadJSOptions');	//Array
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'manageView');
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'manageViewList');			//Array
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'manageViewGallery');		//Array
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'disp_subphotos');
		register_setting( 'tmfg-settings-group', TMFG::optionPrefix.'image_formats');			//Array
	}
	
	public function setScreenLayoutColumns($columns, $screen){
		if($screen == $this->hookName){
			$columns[$screen] = 2;
		}
		return $columns;
	}
	
	protected function _regHooks(){
		parent::_regHooks();
		
	}
	
	public function loadJavascript(){
		parent::loadJavascript();
		
		wp_register_script('tmfg-page-settings', TMFG::$urlPath."/js/page.settings.js", array('jquery'), TMFG::$version);
		wp_localize_script('tmfg-page-settings', 'tmfgSettingsL10n', array(
			'optionPrefix'	=> TMFG::optionPrefix,
			'cropImage'		=> __('Crop Image', TMFG::i18nDomain),
			'scaleImage' 	=> __('Scale Image', TMFG::i18nDomain),
			'scaleXImage'	=> __('Scale Image X', TMFG::i18nDomain),
			'scaleYImage'	=> __('Scale Image Y', TMFG::i18nDomain),
			'no'			=> __('No', TMFG::i18nDomain)
		));
		wp_enqueue_script('tmfg-page-settings');
	}
}
?>