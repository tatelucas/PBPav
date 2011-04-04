<?php 
/*
Plugin Name: TMF Gallery
Plugin URI: http://wordpress.org/extend/plugins/tmf-gallery/
Description: Another gallery plugin for every type of media (image, video, music)
Author: fanningert
Version: 0.3.7
Author URI: http://www.fanninger.at
License: GPL2
*/

setTMFGPath();
if(shouldLoadTMFG()){
	autoloadTMFGClasses();
	TMFG::$urlPath = getTMFGUrlPath();
	TMFG::$hookFile = __FILE__;
	TMFG::$version = getTMFGVersion();
	
	$tmfg = new TMFG();	
}

function getTMFGVersion(){
	$plugin_data = implode('', file(__FILE__));
	if(preg_match("|Version:(.*)|i", $plugin_data, $version)){
		$version =	trim($version[1]);
	}else{
		$version = '0';
	}
	return $version;
}

function getTMFGUrlPath(){
	return WP_PLUGIN_URL . '/' . basename(dirname(__FILE__));
}

function shouldLoadTMFG(){
	return isTMFGCustomRequest() || is_admin();
}

function isTMFGCustomRequest(){
	return isset($_REQUEST['TMFGHandler']);
}

function setTMFGPath(){
	if(!defined('TMFG_PATH')){
		//convert backslashes (windows) to slashes
		$cleanPath = str_replace('\\', '/', dirname(__FILE__));
		define('TMFG_PATH', $cleanPath.'/');
	}
}

function autoloadTMFGClasses(){
	require_once(TMFG_PATH.'classes/TMFGClassLoader.php');
}
?>