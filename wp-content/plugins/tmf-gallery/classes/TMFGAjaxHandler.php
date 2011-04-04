<?php
class TMFGAjaxHandler implements TMFGHookable{
	
	public function hookIntoWordPress(){
		add_action('wp_ajax_tmfg_get_gallery_tree', array($this, 'actionAjaxGetGalleryTree'));
		add_action('wp_ajax_tmfg_get_gallery_detail', array($this, 'actionAjaxGetGalleryDetail'));
		add_action('wp_ajax_tmfg_gallery_create', array($this, 'actionAjaxGetGalleryCreate'));
		add_action('wp_ajax_tmfg_gallery_delete', array($this, 'actionAjaxGetGalleryDelete'));
		add_action('wp_ajax_tmfg_gallery_edit', array($this, 'actionAjaxGetGalleryEdit'));
		add_action('wp_ajax_tmfg_gallery_move', array($this, 'actionAjaxGetGalleryMove'));
		add_action('wp_ajax_tmfg_gallery_get_files', array($this, 'actionAjaxGalleryGetFiles'));
	}
	
	private function _initAjaxCall(){
		global $current_user;
		if ( !is_user_logged_in() )
			die('-1');
	}
	
	public function actionAjaxGetGalleryTree(){
		$this->_initAjaxCall();
		
		$queue = TMFGQueue::getInstance();
		echo $queue->getGalleryTree(0, (($_REQUEST['only-view'] == 'x')? true:false));
		die();
	}
	
	public function actionAjaxGetGalleryDetail(){
		$this->_initAjaxCall();
		
		$queue = TMFGQueue::getInstance();
		echo $queue->getGalleryDetail($_POST['id']);
		die();
	}
	
	public function actionAjaxGetGalleryCreate(){
		$this->_initAjaxCall();
	
		$queue = TMFGQueue::getInstance();
		echo $queue->createGallery($_POST['name'], $_POST['description'], $_POST['parent']);
		die();
	}
	
	public function actionAjaxGetGalleryDelete(){
		$this->_initAjaxCall();
		
		$queue = TMFGQueue::getInstance();
		echo $queue->delGallery($_POST['id']);
		die();
	}
	
	public function actionAjaxGetGalleryEdit(){
		$this->_initAjaxCall();
		
		$queue = TMFGQueue::getInstance();
		echo $queue->updateGallery($_POST['id'], $_POST['name'], $_POST['description'], $_POST['parent']);	
		die();
	}
	
	public function actionAjaxGetGalleryMove(){
		$this->_initAjaxCall();

		$queue = TMFGQueue::getInstance();
		echo $queue->moveGallery($_POST['id'], $_POST['target']);	
		die();
	}
}
?>