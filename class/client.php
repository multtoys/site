<?php
require_once "main.php";

class Client extends Main {

	public function __construct($db) {
		parent::__construct("A_CLIENT", $db);
	}

//добавить клиента в базу данных
	public function addClient($name, $phone, $email="") {
		if (!$this->isValid($phone, $email)) return false;
		return $this->addData(array("Created"=>date("d.m.Y"), "Changed"=>date("d.m.Y") "Name"=>$name, "Phone"=>$phone, "Mail"=>$email));
	}

//изменить данные клиента по ID
	public function editClient($name="", $phone="", $email="") {
		if (!$this->isValid($phone, $email)) return false;
		if ($name != "") return $this->editData($id, array("Changed"=>date("d.m.Y") "Name"=>$name));
		if ($phone != "") return $this->editData($id, array("Changed"=>date("d.m.Y") "Phone"=>$phone));
		if ($email != "") return $this->editData($id, array("Changed"=>date("d.m.Y") "Mail"=>$email));
	}

//проверка наличия клиента в базе данных
	public function ifExists($name, $phone, $email="") {
		if (!$this->isValid($phone, $email)) return false;
		if ($email != "") $condition = "`Phone`='".addslashes($phone)."' AND `Mail`='".addslashes($email)."'"));
		 else $condition = "`Phone`='".addslashes($phone)."'"));
		 return $this->ifExists("Name", $name, $condition);
	}

//проверка правильности телефона и емейла (хотя Джава должна была проверить.)
	private function isValid($phone, $email) {
		if (($phone != "") && (!$this->valid->validPhone($phone))) return false;
		if (($email != "") && (!$this->valid->validMail($email))) return false;
		return true;
	}
	
	
}

?>