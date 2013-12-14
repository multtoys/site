<?php
require_once "main.php";

class Product extends Main {

	public function __construct($db) {
		parent::__construct("A_PRODUCT", $db);
	}

//получение всех записей по ID мультфильма и их сортировка по приоритету по возрастанию
	public function getAllByCatalog($cartoon_id) {
		return $this->getAllViaField("Catalog_ID", $cartoon_id, "Priority")("Priority");
	}




}

?>