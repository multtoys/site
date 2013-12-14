<?php
require_once "config.php";
require_once "validator.php";
require_once "db_rover.php";

abstract class Main {
	
	private $db;
	private $table_name;
	protected $config;
	protected $valid;

	protected function __construct($table_name, $db) {			//Возможно, что '$db' - это объект класса 'db_rover'.   ??????????
		$this->db = $db;
		$this->table_name = $table_name;
		$this->config = new Config();
		$this->valid = new Validator();
	}

//вставить запись в базу данных
	protected function addData($fields_values) {
		return $this->db->dataIn($this->table_name, $fields_values);
	}
	
//обновление записи базы данных по ID этой записи
	protected function editData($id, $fields_upd) {
		return $this->db->updateViaId($this->table_name, $id, $fields_upd);
	}

//установить в одно поле записи значение по ID этой записи
	protected function setData($id, $setfield, $setvalue) {
		return $this->db_->setDataViaId($this->table_name, $setfield, $setvalue, $id);
	}
	
//удалить запись по ID этой записи
	protected function delData($id) {
		return $this->db->dataOffViaId($this->table_name, $id);
	}
	
//удалить все записи из базы данных
	protected function delAll() {
		return $this->db->wipeout($this->table_name);
	}
	
//получение всех записей и их сортировка
	protected function getAll($sort='', $asc=true) {
		return $this->db->receiveAll($this->table_name, $sort, $asc);
}

//получение информации из записи, если известно значение другого поля в этой записи
	protected function getDataViaField($output, $inputfield, $inputvalue) {
		return $this->db->receiveData($this->table_name, $output, $inputfield, $inputvalue);
	}

//получение информации из записи по ID этой записи
	protected function getDataViaId($id, $output) {
		return $this->db->receiveDataViaId($this->table_name, $output, $id);
}

//получение всей записи по ID этой записи
	protected function get($id) {
		return $this->db->receiveFullDataViaId($this->table_name, $id);
	}

//получение всех записей по значению поля
	protected function getAllViaField($inputfield, $inputvalue, $sort='', $asc=true) {
		return $this->db->receiveAllData($this->table_name, $inputfield, $inputvalue, $sort, $asc);
	}

//получение случайных записей
	protected function getRandomData($quantity) {
		return $this->db->receiveRandomData($this->table_name, $quantity);
}

//получение ID последней вставленной записи
	protected function idOfLast() {
		return $this->db->idOfLast($this->table_name);
	}

//получение количества записей в базе
	protected function countData() {
		return $this->db->countData($this->table_name);
}

//проверка наличия значения в поле записи базы данных
	protected function ifExists($field, $value, $condition='') {
		return $this->db->ifExists($this->table_name, $field, $value, $condition);
	}
}

?>