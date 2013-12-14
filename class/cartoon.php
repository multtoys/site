<?php
require_once "main.php";

class Cartoon extends Main {

	public function __construct($db) {
		parent::__construct("A_CATALOG", $db);
	}

//получение всех записей и их сортировка по приоритету по возрастанию
	public function getAllSortPriority() {
		return $this->getAll("Priority");
	}



}

?>