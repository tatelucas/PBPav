<?php 
class TMFGPageHandlerAbout extends TMFGPageHandler{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function handle(){
		$this->showPage('about');
	}
	
	public function handlePanels(){
		$this->addPanel(__('Used Libraries', TMFG::i18nDomain), 'used_libraries', 'showPanelUsedLibraries', 'normal');
	}
	
	public function showPanelUsedLibraries(){
		$this->showPanel('about.usedlibraries');
	}
}
?>