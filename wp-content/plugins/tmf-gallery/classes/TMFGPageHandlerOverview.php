<?php 
class TMFGPageHandlerOverview extends TMFGPageHandler{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function handle(){
		$this->showPage('overview');
	}
	
	public function handlePanels(){}
}
?>