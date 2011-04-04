<?php 
class TMFGException extends Exception{
	
	const SEVERITY_NOTICE = E_NOTICE;
	const SEVERITY_ERROR = E_ERROR;
	const SEVERITY_WARNING = E_WARNING;
	
	protected $severity;
	
	public function __construct($message, $severity, $code = 1){
		parent::__construct($message, $code);
		$this->severity = $severity;
	}
	
//	public function __toString(){
//		return $this->getServerityText().'|'.$this->getFile().':'.$this->getLine().'|'.$this->message;
//	}
	
	public function getServerityText(){
		switch($this->severity){
			case self::SEVERITY_ERROR:
				return 'ERROR';
				break;
			case self::SEVERITY_NOTICE:
				return 'NOTICE';
				break;
			case self::SEVERITY_WARNING:
				return 'WARNING';
				break;
			default:
				return $this->severity;
		}
	}
}
?>