<?php 
abstract class TMFGPageHandler{
	
	protected $hookName;
	protected $pageName;
	
	public function __construct(){}
	
	public function setHookName($page){
		$this->hookName = TMFGAdminPages::$hookName[$page];
		$this->pageName = $page;
		
		$this->_regHooks();
	}
	
	public function getHookName(){
		return $this->hookName;
	}
	
	abstract public function handle();
	
	abstract public function handlePanels();
	
	public final function showPage($page){
		require_once(TMFG_PATH.'panels/page.'.$this->pageName.'.php');
	}
	
	public function addPanel($titel, $panel, $method, $view = 'normal'){
		add_meta_box('tmfg_panel_'.$panel, $titel, array($this, $method), $this->hookName, $view);
	}
	
	public function showPanel($sub){
		require_once(TMFG_PATH.'panels/panel.'.$sub.'.php');
	}
	
	public function loadJavascript(){
		wp_enqueue_script('jquery');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_script('utils');
		
		wp_enqueue_script('jquery-color');
		wp_enqueue_script('schedule');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-draggable');
		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_script('jquery-ui-dialog');
		
		wp_register_script("tmfg-ajax-core", TMFG::$urlPath."/js/ajax.core.js", array(), TMFG::$version);
		wp_localize_script("tmfg-ajax-core", "tmfg_core", array(
			'urlpath' => TMFG::$urlPath,
			'loading' => __('Loading Data', TMFG::i18nDomain)
		));
		wp_enqueue_script("tmfg-ajax-core");
	}
	
	public function loadStylesheet(){
		wp_register_style("tmfg-admin-core", TMFG::$urlPath."/css/admin.core.css", array(), TMFG::$version);
		wp_enqueue_style("tmfg-admin-core");
	}
	
	public function setScreenLayoutColumns($columns, $screen){
		return $columns;
	}
	
	protected function _regHooks(){
		add_action('load-'.$this->hookName, array($this, 'handlePanels'));
		add_action('admin_print_scripts-'.$this->hookName, array($this, 'loadJavascript'));
		add_action('admin_print_styles-'.$this->hookName, array($this, 'loadStylesheet'));
		add_filter('screen_layout_columns', array($this, 'setScreenLayoutColumns'), 10, 2);
	}
}
?>