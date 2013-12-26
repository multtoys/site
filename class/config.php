<?php

class Config {

	public $sitename = 'MyFirstShop.local';
	public $address = 'http://myfirstshop.local';
	
	public $host_denver = 'localhost';
	public $host_mapp = 'localhost:8888';
	
	public $dir_text = "classes/text/";
	public $dir_tmpl = "templates/";
	
	public $db = 'toyshop';
	public $db_prefix = '';			//Нужно - не нужно... Чёрт его знает. Лектор считает, что очень нужно.
	
	public $user = 'root';
	public $password_denver = '';
	public $password_mapp = 'root';
	public $pass_prefix = 'multik';
	
	public $admin_name = 'Stoyan';
	public $admin_email = 'stoyan.k-n@yandex.ru';
	
	
	public $min_phone = 15;
	public $max_phone = 17;

}

?>