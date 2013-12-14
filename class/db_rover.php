<?php
require_once "config.php";
require_once "validator.php";

class DataBase {

	private $config;
	private $connect;
	private $valid;
	
	public function __construct() {
		$this->config = new Config();
		$this->valid = new Validator();
		$this->connect = new mysqli($this->config->host, $this->config->user, $this->config->passsword, $this->config->db);
		$this->connect->query("SET NAMES 'utf8'");
	}

	private function query($zapros) {
		return $this->connect->query($zapros);
	}
	
//получение массива выборки из базы данных
	private function choice($table_name, $field_list, $condition='', $sort='', $asc=true, $limit='') {
		//подготовка названия полей для запроса
		$fields = '';
		$flag = 0;
		for ($i=0; $i<count($field_list); $i++) {
			if (($field_list[$i] != '*') && (!stripos($field_list[$i],"COUNT(") && (!stripos($field_list[$i],"SUM(") && (!stripos($field_list[$i],"AVG(") && (!stripos($field_list[$i],"MIN(") && (!stripos($field_list[$i],"MAX(")) $field_list[$i] = "`".$field_list[$i]."`";
			else {
				$fields = $field_list[$i];
				$flag = 1;
				break;
			}
		}
		if ($flag == '0') $fiels = implode(",", $field_list);
		//подготовка названия таблицы для запроса
		$table_name = "`".$table_name."`";
		//подготовка способа сортировки для запроса
		switch ($sort) {
			case "": {
				if (!$sort) $sort = "ORDER BY `ID`";
				break;
			}
			case "RAND()": {
				$sort = "ORDER BY ".$sort;
				break;
			}
			default: {
				$sort = "ORDER BY `".$sort."`";
				if (!$asc) $sort .= "DESC";
			}
		}
		//подготовка количества записей в выборке для запроса
		if (($limit) && ($this->valid->validId($limit))) $limit = "LIMIT ".$limit;
		else $limit = '';
		//подготовка условия выборки для запроса
		if ($condition) $zapros = "SELECT ".$fields." FROM ".$table_name." WHERE ".$condition." ".$sort." ".$limit;
		else $zapros = "SELECT ".$fields." FROM ".$table_name." ".$sort." ".$limit;
		//формирование массива выборки
		$result = $this->query($zapros);
		if (!$result) return false;
		$data_arr = array();
		$i = 0;
		while ($record = $result->fetch_assoc()) {
			$data_arr[$i] = $record;
			$i++;
		}
		$result->close();
		return $data_arr;
	}

//определяет существование записи с ID в таблице
	private function existId($table_name, $id) {
		if (!$this->valid->validId($id)) return false;
		$result = $this->choice($table_name, array("ID"), "`ID`='".$id."'");
		if (count($result) === 0) return false;
		return true;
	}
	
//вставить запись в базу данных
	public function dataIn($table_name, $fields_values) {
		//подготовка названия таблицы для запроса
		$table_name = "`".$table_name."`";
		//подготовка названия полей для запроса
		$fields = implode(",", array_keys($fields_values));
		//подготовка значений полей для запроса
		foreach ($fields_values as $value) $value = addslashes($value);
		$values = implode(",", $fields_values);
		$zapros = "INSERT INTO ".$table_name." (".$fields.") VALUES (".$values.")";
		return $this->query($zapros);
	}
	
//обновление записи базы данных
	private function update($table_name, $fields_upd, $condition='') {
		//подготовка названия таблицы для запроса
		$table_name = "`".$table_name."`";
		//подготовка названий полей и новых значений для запроса
		$i = 0;
		$new_fields = array();
		foreach ($fields_values as $field => $value) {
			$new_fields[$i] = "`".$field."`=`".addslashes($value)."`";
			$i++;
		}
		$fields_values = implode(",", $new_fields); 
		//подготовка условия выборки для запроса
		if ($condition) {
			$zapros = "UPDATE ".$table_name." SET ".$fields_values." WHERE ".$condition;
			return $this->query($zapros);
		}
		else return false;
	}
	
//обновление записи базы данных по ID этой записи
	private function updateViaId($table_name, $id, $fields_upd) {
		return $this->update($table_name, $fields_upd, "`ID`='".$id."'");
	}

//установить в одно поле записи значение
	public function setData($table_name, $setfield, $setvalue, $inputfield, $inputvalue) {
		return $this->update($table_name, array($setfield=>$setvalue), "`".$inputfield."`='".addslashes($inputvalue)."'");
	}
	
//удалить запись из базы данных
	public function dataOff($table_name, $condition='') {
		//подготовка названия таблицы для запроса
		$table_name = "`".$table_name."`";
		//подготовка условия выборки для запроса
		if ($condition) {
			$zapros = "DELETE FROM ".$table_name." WHERE ".$condition;
			return $this->query($zapros);
		}
		else return false;
	}

//удалить запись по ID этой записи
	public function dataOffViaId($table_name, $id) {
		if (!$this->existId($table_name, $id)) return false;
		return $this->DataOff($table_name, "`ID`='".$id."'");
}
	
//удалить все записи из базы данных
	public function wipeout($table_name) {
		//подготовка названия таблицы для запроса
		$table_name = "`".$table_name."`";
		$zapros = "TRUNCATE TABLE ".$table_name;
		return $this->query($zapros);
	}

//получение всех записей и их сортировка
	public function receiveAll($table_name, $sort='', $asc=true) {
		return $this->choice($table_name, array("*"), "", $sort, $asc);
}

//получение информации из записи, если известно значение другого поля в этой записи
	public function receiveData($table_name, $output, $inputfield, $inputvalue) {
		$result = $this->choice($table_name, array($output), "`".$inputfield."`='".addslashes($inputvalue)."'");
		if (count($result) != 1) return false;
		return $result[0][$output];
	}

//получение информации из записи по ID этой записи
	public function receiveDataViaId($table_name, $output, $id) {
		if (!$this->existId($table_name, $id)) return false;
		return $this->receiveData($table_name, $output, "`ID`='".$id."'");
}

//получение всей записи по ID этой записи
	public function receiveFullDataViaId($table_name, $id) {
		if (!$this->existId($table_name, $id)) return false;
		$arr = $this->receiveData($table_name, array("*"), "`ID`='".$id."'");
		return $arr[0];
}

//получение всех записей по значению поля
	public function receiveAllData($table_name, $inputfield, $inputvalue, $sort='', $asc=true) {
		return $this->choice($table_name, array("*"), "`".$inputfield."`='".addslashes($inputvalue))."'", $sort, $asc);
	}

//получение случайных записей
	public function receiveRandomData($table_name, $quantity) {
		return $this->choice($table_name, array("*"), "", "RAND()", "", $quantity);
}

//получение количества записей в базе
	public function countData($table_name) {
		$result = $this->choice($table_name, array("COUNT('ID')"));
		return $result[0]["COUNT('ID')"];
}
	
//установить в поле записи значение по ID этой записи
	public function setDataViaId($table_name, $setfield, $setvalue, $id) {
		if (!$this->existId($table_name, $id)) return false;
		return $this->update($table_name, array($setfield=>$setvalue), "`ID`='".$id."'");
	}

//проверка наличия значения в поле записи базы данных
	public function ifExists($table_name, $field, $value, $condition='') {
		$result = $this->choice($table_name, array("ID"), "`".$field."`='".addslashes($value)."' AND ".$condition);
		if (count($result) === 0) return false;
		return true;
	}

//получение ID последней вставленной записи
	public function idOfLast($table_name) {
		$result = $this->choice($table_name, array("MAX('ID')"));
		return $result[0]["MAX('ID')"];
	}

	public function __destruct() {
		if ($this->connect) $this->connect->close();
	}
}

?>