<?php

class TMFGClassLoader{
	
	private $_namingConvention;
	
	/**
	 * Enter description here ...
	 * @param TMFGClassNamingConvention $className
	 */
	public function __construct(TMFGClassNamingConvention $className){
		$this->_namingConvention = $className;
		$this->_registerAutoloadCallbacks();
	}
	
	public function autoload($class){
		if(!$this->_namingConvention->isValid($class)){
			return;
		}
			
		$file2Include = $this->_namingConvention->getPath($class);
		
		if(file_exists($file2Include))
			require_once($file2Include);	
	}
	
	public function autoloadProxy($class){
		if(function_exists("__autoload")) {
			__autoload($class);
		}
	}
	
	private function _registerAutoloadCallbacks(){
		spl_autoload_register(array($this, 'autoload'));
		spl_autoload_register(array($this, 'autoloadProxy'));
	}
}

/**
 * Defines the Naming Convention that is used when autoloading PhotoQ classes.
 * @author manu
 *
 */
class TMFGClassNamingConvention{
	/**
	 * Prefixed to the part of path defined by classname
	 * @var unknown_type
	 */
	private $_pathPrefix;
	
	/**
	 * Prefix without trailing underscores. Identifies PhotoQ classes.
	 * @var unknown_type
	 */
	private $_identifier;
	
	/**
	 * Length of prefix.
	 * @var integer
	 */
	private $_identifierLen;
	
	/**
	 * Search for this in classname and replace with $_replace
	 * @var array
	 */
	private $_search;
	
	/**
	 * Replace $_search in classname with this.
	 * @var array
	 */
	private $_replace;
	
	/**
	 * 
	 * @param string $pathPrefix
	 * @param string $prefix
	 * @param string $delimiter
	 */
	function __construct($pathPrefix, $prefix, $delimiter){
		
		$this->_pathPrefix = $pathPrefix;
		$this->_identifier = rtrim($prefix,'_');
		$this->_identifierLen = strlen($this->_identifier);
		$this->_search = array($prefix, $delimiter);
		$this->_replace = array('', '/');
		
	}
	
	/**
	 * Constructs the path to include from from the name of the class.
	 * @param string $class
	 */
	function getPath($class){
		return $this->_pathPrefix . $this->_getDirname($class) . $class . '.php';
	}
	
	/**
	 * Checks whether a class name corresponds to the naming convention.
	 * Returns true if the identifier in the classname matches the identifier of
	 * the naming convention. An identifier is the part of the prefix up to and
	 * not including the last underscore.
	 * @param string $class
	 * @return boolean
	 */
	function isValid($class){
		return substr($class, 0,$this->_identifierLen) === $this->_identifier;
	}
	
	/**
	 * Gets the name of the directory from which to include $class from.
	 * Removes prefix, replaces underscores with slashes, sets all intermediate dirs to
	 * lowercase and discards the filename part of the path.
	 * @param string $class class that we want to include
	 * @return string
	 */
	private function _getDirname($class){
		$dirname = strtolower(dirname(str_replace($this->_search, $this->_replace, $class))).'/';
		if($dirname === './')
			$dirname = '';
		return $dirname;
	}

}

$tmfgLoader = new TMFGClassLoader(new TMFGClassNamingConvention(TMFG_PATH.'classes/', 'TMFG_', '_'));

function loadExternalPhotoQLibraries(){
		if (!class_exists("OptionController"))
			require_once(TMFG_PATH.'lib/phpThumb/ThumbLib.inc.php');
}
loadExternalPhotoQLibraries();
?>