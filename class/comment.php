<?php
require_once "main.php";

class Feedback extends Main {

	public function __construct($db) {
		parent::__construct("J_FEEDBACK", $db);
	}

//получение всех отзывов и их сортировка по дате по убыванию
	public function getAllSortDate() {
		return $this->getAll("Date", false);
	}



}

?>