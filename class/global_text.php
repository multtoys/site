<?php
require_once "config.php";

abstract class GlobalText {
	
	private $ini_arr;
	
	public function __construct($file) {
		$config = new Config();
		$this->$ini_arr = parse_ini_file($config->dir_text.$file.".ini");
	}
	
	public function getTitle($kind_of_record) {
		return $this->ini_arr[$kind_of_record." TITLE"];
	}

	public function getText($kind_of_record) {
		return $this->ini_arr[$kind_of_record." TEXT"];
	}


}

?>