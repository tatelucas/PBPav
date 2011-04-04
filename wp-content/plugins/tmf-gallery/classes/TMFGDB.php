<?php 
class TMFGDB implements TMFGSingleton{
	
	private static $_singletonInstance;
	
	private $_wpdb;
	private $_GALLERIES;
	private $_FILESTORE;
	
	private function __construct(){
		global $wpdb;
		$this->_wpdb = $wpdb;
		
		$this->_GALLERIES = $this->_wpdb->prefix.'tmfg_galleries';
		$this->_FILESTORE = $this->_wpdb->prefix.'tmfg_files';
	}
	
	public static function getInstance(){
		if (!isset(self::$_singletonInstance)) {
			self::$_singletonInstance = new self();
		}
		return self::$_singletonInstance;
	}
	
	public function getGalleryDetail($galleryID){
		if($galleryID < 0)
			throw new TMFGException(__('No permit gallery ID', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
			
		if($galleryID == 0){
			return array('id' => $galleryID, 'name' => __('Gallery Root', TMFG::i18nDomain));
		}else{
			$result = $this->_wpdb->get_row('SELECT id, name, description, parent FROM '.$this->_GALLERIES.' WHERE id = '.$galleryID, ARRAY_A);
			$this->_errorHandling($result);
			if($result['parent'] == 0){
				$result['parent-name'] = __('Gallery Root', TMFG::i18nDomain);
			}else{
				$parentResult = $this->_wpdb->get_row('SELECT name FROM '.$this->_GALLERIES.' WHERE id = '.$result['parent'], ARRAY_A);
				$this->_errorHandling($result);
				$result['parent-name'] = $parentResult['name'];
			}
			return $result;
		}
	}
	
	public function getGalleryLevel($parentID){
		if($parentID < 0)
			throw new TMFGException(__('No permit parent gallery ID', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
			
		$result = $this->_wpdb->get_results('SELECT id, name FROM '.$this->_GALLERIES.' WHERE parent = '.$parentID.' ORDER BY name', ARRAY_A);
		$this->_errorHandling($result);
		return $result;
	}
	
	public function delGallery($galleryID){
		if($parentID < 0){
			throw new TMFGException(__('No permit parent gallery ID', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		}
		
		$galleryDetail = $this->getGalleryDetail($galleryID);
		$result = $this->_wpdb->update($this->_GALLERIES, array('parent' => $galleryDetail['parent']), array('parent' => $galleryID));
		if(is_bool($result) && !$result)
			$this->_errorHandling(null);
		$result = $this->_wpdb->query('DELETE FROM '.$this->_GALLERIES.' WHERE id = '.$galleryID);
		if(is_bool($result) && !result)
			$this->_errorHandling(null);
		return $result;
	}
	
	public function addGallery($name, $description, $parentID){
		if($name == '')
			throw new TMFGException(__('No name given for the gallery', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		if($parentID < 0)
			throw new TMFGException(__('No permit parent gallery ID', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		
		$result = $this->_wpdb->insert($this->_GALLERIES, array('name' => $name, 'description' => $description, 'parent' => $parentID));
		if(is_bool($result) && !$result)
			$this->_errorHandling(null);
		return $result;
	}
	
	public function updGallery($galleryID, $name, $description, $parentID){
		if($galleryID < 0)
			throw new TMFGException(__('No permit gallery ID', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		if($name == '')
			throw new TMFGException(__('No name given for the gallery', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		if($parentID < 0)
			throw new TMFGException(__('No permit parent gallery ID', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		
		$result = $this->_wpdb->update($this->_GALLERIES, array('name' => $name, 'description' => $description, 'parent' => $parentID), array('id' => $galleryID));
		if(is_bool($result) && !$result)
			$this->_errorHandling(null);
		return $result;
	}
	
	public function moveGallery($galleryID, $target){
		if($galleryID < 0)
			throw new TMFGException(__('No permit gallery ID', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		if($parentID < 0)
			throw new TMFGException(__('No permit parent gallery ID', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		
		$result = $this->_wpdb->update($this->_GALLERIES, array('parent' => $target), array('id' => $galleryID));
		if(is_bool($result) && !$result)
			$this->_errorHandling(null);
		return $result;
	}
	
	private function _errorHandling($result){
		if(is_array($result))
			return;
		if( $result == null && $this->_wpdb->last_error != '' ){
			throw new TMFGException($this->_wpdb->last_error, TMFGException::SEVERITY_ERROR);
		}else if( $result == null ){
			throw new TMFGException(__('Unknown SQL Error', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		}else if(empty($result)){
			throw new TMFGException(__('No result', TMFG::i18nDomain), TMFGException::SEVERITY_ERROR);
		}else{}
	}
	
	public function createFileDBEntry($id, $name, $type, $size){
		$this->_wpdb->insert($this->_FILESTORE, array('id' => $id, 'name' => $name, 'type' => $type, 'size' => $size));
	}
	
	public function getFileDBEntry($id){
		$result = array();
		
		$rTemp = $this->_wpdb->get_row("SELECT id, name, type, size FROM ".$this->_FILESTORE." WHERE id = '".$id."'", ARRAY_A);
		$this->_errorHandling($rTemp);
		
		//Aufbereitung
		$result['id'] = $rTemp['id'];
		$result['filename'] = $rTemp['name'];
		$array_olf_filename = explode('.', $result['filename']);
		$result['name'] = $array_olf_filename[0];
		$result['extension'] = $array_olf_filename[1];
		$result['mimetype'] = $rTemp['type'];
		$result['size'] = $rTemp['size'];
		
		return $result;
	}
	
	public function getFileCount($gallery=0){
		$sql = "select count(*) as count FROM ".$this->_FILESTORE;
		
		$result = $this->_wpdb->get_row($sql, ARRAY_A);
		$this->_errorHandling($result);
		
		return $result['count'];
	}
	
	public function getFiles($gallery=0, $startOffset=0, $resultLimit=10, $order='name'){
	
		$sql = "SELECT * FROM ".$this->_FILESTORE." ORDER BY ".$order." LIMIT ".$startOffset.", ".$resultLimit;
		
		$result = $this->_wpdb->get_results($sql, ARRAY_A);
		$this->_errorHandling($result);

		return $result;
	}
	
	/* Create Table */
	public function createTables(){
		if ( $this->_wpdb->supports_collation() ) {
			if ( ! empty($this->_wpdb->charset) )
				$charset_collate = 'DEFAULT CHARACTER SET ' .$this->_wpdb->charset;
			if ( ! empty($this->_wpdb->collate) )
				$charset_collate .= ' COLLATE ' . $this->_wpdb->collate;
		}
		
		if($this->_wpdb->get_var("show tables like '".$this->_GALLERIES."'") != $this->_GALLERIES) {
			$sql = "CREATE TABLE " . $this->_GALLERIES . " ( ".
	  			   "id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT , ".
				   "name VARCHAR( 100 ) NOT NULL , ".
				   "description LONGTEXT NOT NULL , ".
				   "parent BIGINT UNSIGNED NOT NULL, ".
  				   "PRIMARY KEY (id) ) ".$charset_collate.";";

      		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      		dbDelta($sql);
		}
		
		if($this->_wpdb->get_var("show tables like '".$this->_FILESTORE."'") != $this->_FILESTORE) {
			$sql = "CREATE TABLE " . $this->_FILESTORE . " ( ".
	  			   "id varchar(32) NOT NULL, ".
				   "name varchar(100) NOT NULL, ".
				   "type varchar(150) NOT NULL, ".
				   "size bigint(20) unsigned NOT NULL, ".
  				   "PRIMARY KEY (id) ) ".$charset_collate.";";
			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      		dbDelta($sql);
		}
	}
}
?>