<?php
require_once "config.php";

class Validator {
	
	private $config;
	
	public function __construct() {
		$this->config = new Config();
	}

	public function validId($id) {
		if (($this->ifInteger($id)) && ($id > 0)) return true;
		return false;
	}
	
	public function validString($string, $min_length, $max_length) {
		if ((!is_string($string)) || (strlen($string)<$min_length) || (strlen($string)>$max_length)) return false;
		return true;
	}
	
	public function validPhone($phone) {
		if ($this->validString($phone, $this->config->min_phone, $this->config->max_phone)) {
			$pattern_phn = "~^\+\d{1,3}\(\d{2,5}\)\d{1,3}(\-\d{2}){2}$~";
			if (preg_match($pattern_phn, $phone)) return true;
		}
		return false;
	}
	
	public function validMail($email) {
		$pattern_eml ="~^([a-z0-9][\w\.-]*[a-z0-9])@((?:[a-z0-9]+[\.-]?)*[a-z0-9]\.[a-z]{2,})$~i";
		if (preg_match($pattern_eml, $email)) return true;
		return false;		
	}
	
	public function validHash($hash_md5) {
		
	}
	
	private function ifInteger($n) {
		if (is_int($n)) return true;
		if (is_string($n)) {
			if (preg_match("~^(0|(-?\s?[1-9]\d*))$~", $n)) return true;
		}
		return false;
	}
	
	private function isPositiveInt($n) {
		if ((!$this->ifInteger($n)) || ($n < 0)) return false;
		return true;
	}
	
	private function ifQuatesIn($string) {
		$quotes = array("\"", "'", "`", "&quot;", "&apos;");
		foreach ($quotes as $quot) {
			if (strpos($string, $quot) !== false) return true;
		}
		return false;
	}
}

?>