<?php 
class TMFGQueue implements TMFGSingleton{
	
	private static $_singletonInstance;
	
	private $_db;
	
	private function __construct(){
		$this->_db = TMFGDB::getInstance();
	}
	
	public static function getInstance(){
		if (!isset(self::$_singletonInstance)) {
			self::$_singletonInstance = new self();
		}
		return self::$_singletonInstance;
	}
	
	public function activatePlugin(){
		$this->_db->createTables();
	}
	
	public function delGallery($galleryID){
		return $this->_db->delGallery($galleryID);
	}
	
	public function createGallery($name, $description = '', $parent){
		return $this->_db->addGallery($name, $description, $parent);
	}
	
	public function updateGallery($id, $name, $description = '', $parent){
		return $this->_db->updGallery($id, $name, $description, $parent);
	}
	
	public function moveGallery($id, $target){
		return $this->_db->moveGallery($id, $target);
	}
	
	public function getGalleryTree($parentID = 0, $onlyView = false){
		$gLevel = $this->_db->getGalleryLevel($parentID);
		
		if($parentID == 0){
			//Root-Element
			$content .= '<li id="tmfg-gallery-tree-elem-0" class="tmfg-gallery-tree-root gallery">';
			$content .= '<div id="tmfg-gallery-tree-container-0" class="container">';
			$content .= '<div style="float: right;">';
			if($onlyView){
				$content .= '<a id="tmfg-selg-0" href="#" class="ui-icon ui-icon-search" title="'.__('Select Gallery', TMFG::i18nDomain).'">'.__('Select Gallery', TMFG::i18nDomain).'</a>';
			}else{
				$content .= '<a id="tmfg-newg-0" href="#" class="ui-icon ui-icon-document" title="'.__('New Child Gallery', TMFG::i18nDomain).'">'.__('New Child Gallery', TMFG::i18nDomain).'</a>';
			}
			$content .= '</div>';
			$content .= '<div>'.__('Gallery-Root', TMFG::i18nDomain).'</div>';
			$content .= '<div class="clear"></div>';
			$content .= '</div>';
		}
		
		if(is_array($gLevel) && count($gLevel) > 0){
			$content .= '<ul class="tmfg-gallery-tree-child">';
			foreach($gLevel as $gallery){
				$content .= '<li id="tmfg-gallery-tree-elem-'.$gallery['id'].'" class="gallery">';
				$content .= '<div id="tmfg-gallery-tree-container-'.$gallery['id'].'" class="container">';
				$content .= '<div style="float: right;">';
				if($onlyView){
					$content .= '<a id="tmfg-selg-'.$gallery['id'].'" href="#" class="ui-icon ui-icon-search" title="'.__('Select Gallery', TMFG::i18nDomain).'">'.__('Select Gallery', TMFG::i18nDomain).'</a>';
				}else{
					$content .= '<a id="tmfg-movg-'.$gallery['id'].'" href="#" class="ui-icon ui-icon-arrow-4" title="'.__('Move Gallery', TMFG::i18nDomain).'">'.__('Move Gallery', TMFG::i18nDomain).'</a>';
					$content .= '<a id="tmfg-newg-'.$gallery['id'].'" href="#" class="ui-icon ui-icon-document" title="'.__('New Child Gallery', TMFG::i18nDomain).'">'.__('New Child Gallery', TMFG::i18nDomain).'</a>';
					$content .= '<a id="tmfg-editg-'.$gallery['id'].'" href="#" class="ui-icon ui-icon-wrench" title="'.__('Edit Gallery', TMFG::i18nDomain).'">'.__('Edit Gallery', TMFG::i18nDomain).'</a>';
					$content .= '<a id="tmfg-delg-'.$gallery['id'].'" href="#" class="ui-icon ui-icon-trash" title="'.__('Delete Gallery', TMFG::i18nDomain).'">'.__('Delete Gallery', TMFG::i18nDomain).'</a>';
				}
				$content .= '</div>';
				$content .= '<div>'.$gallery['name'].'</div>';
				$content .= '<div class="clear"></div>';
				$content .= '</div>';
				$content .= $this->getGalleryTree($gallery['id'], $onlyView);
				$content .= '</li>';
			}
			$content .= '</ul>';
		}
		
		if($parentID == 0){
			$content .= '</li>';
		}
		return $content;
	}
	
	public function getGalleryDetail($ID){
		return json_encode($this->_db->getGalleryDetail($ID));
	}
}
?>