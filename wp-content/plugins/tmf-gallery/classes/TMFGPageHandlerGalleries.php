<?php 
class TMFGPageHandlerGalleries extends TMFGPageHandler{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function handle(){
		$this->showPage('galleries');
	}
	
	public function handlePanels(){
		$this->addPanel(__('Galleries', TMFG::i18nDomain), 'galleries', 'showPanelGalleries', 'side');
		$this->addPanel(__('Gallery Detail', TMFG::i18nDomain), 'gallery_detail', 'showPanelGalleryDetail');
	}
	
	public final function showPanelGalleries(){
		$this->showPanel('gallery.tree');
	}
	
	public final function showPanelGalleryDetail(){
		$this->showPanel('gallery.detail');
	}
	
	public function setScreenLayoutColumns($columns, $screen){
		if($screen == $this->hookName){
			$columns[$screen] = 2;
		}
		return $columns;
	}
	
	public function loadStylesheet(){
		parent::loadStylesheet();
		
		wp_register_style("tmfg-jquery-ui", TMFG::$urlPath."/css/jquery-ui.css", array(), '1.8.3');
		wp_enqueue_style("tmfg-jquery-ui");
	}
	
	public function loadJavascript(){
		parent::loadJavascript();
		
		wp_register_script("tmfg-page-galleries", TMFG::$urlPath."/js/page.galleries.js", array(), TMFG::$version);
		wp_localize_script("tmfg-page-galleries", "tmfg", array(
			'action_not_supported' 		=> __('Action not supported', TMFG::i18nDomain),
			'confirm_create_gallery' 	=> __('Do you really want to create this gallery?', TMFG::i18nDomain),
			'confirm_save_gallery' 		=> __('Do you really want to save this gallery?', TMFG::i18nDomain),
			'confirm_delete_gallery' 	=> __('Do you really want to delete this gallery?', TMFG::i18nDomain),
			'confirm_move_gallery' 		=> __('Do you really want to move this gallery?', TMFG::i18nDomain),
			'error_move_gallery_child' 	=> __('Move in child galleries are not allowed.', TMFG::i18nDomain),
			'success_create_gallery'  	=> __('Gallery created.', TMFG::i18nDomain),
			'success_save_gallery' 		=> __('Gallery saved.', TMFG::i18nDomain),
			'success_delete_gallery' 	=> __('Gallery deleted.', TMFG::i18nDomain),
			'success_move_gallery' 		=> __('Gallery moved.', TMFG::i18nDomain)
		));
		wp_enqueue_script("tmfg-page-galleries");
	}
}
?>