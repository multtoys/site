<?php
require_once "config.php";
require_once "info_content.php";
require_once "comment.php";
require_once "messaqe.php";
require_once "cartoon.php";
require_once "image.php";
require_once "toy.php";
require_once "toy_image.php";
require_once "client.php";
require_once "basket.php";
require_once "order.php";

abstract class TemplateHandler {
	protected $config;
	protected $content;
	protected $comment;
	protected $message;
	protected $cartoon;
	protected $image;
	protected $toy;
	protected $toy_image;
	protected $client;
	protected $basket;
	protected $order;
	
	protected $data; //Это массив данных, которые были получены GET-запросом
	
	public function __construct($db) {
		session_start();
		$this->config = new Config($db);
		$this->content = new Content($db);
		$this->comment = new Feedback($db);
		$this->message = new Message();
		$this->cartoon = new Cartoon($db);
		$this->image = new Image($db);
		$this->toy = new Product($db);
		$this->toy_image = new ProductImage($db);
		$this->client = new Client($db);
		$this->basket = new basket($db);
		$this->order = new Order($db);
		
		$this->data = $this->dataSecurity($_GET);  //обработчик данных, преобразующий html коды в html-сущности.
		
	}
	
//Готовит массив шаблонов под замену и отправляет на замену в содержании файла-шаблона
	public function getContent() {
		$subst['%title_of_site%'] = $this->getTitle();
		$subst['%present_page_description%'] = $this->getDescription();
		$subst['%present_page_key_words%'] = $this->getKeyWords();
		$subst['%merry_go_round%'] = $this->getMerrygoround();
		$subst['%greeting%'] = $this->getGreeting();
		$subst['%multname_n%'] = $this->getMultnameN();
		
		return $this->getReplacedTemplate($subst, 'general');		
	}

	public function dataSecurity($data) {
		foreach ($data as $val) {
			if (is_array($val)) $this->dataSecurity($val);
			else $val = htmlspecialchars($val);
		}
		return $data;
	}
//Получает содержание файла-шаблона и сразу заменяет все вхождения адреса на адрес сайта 	
	protected function getReplacedAddress($file_name) {
		$content = file_get_contents($this->config->dir_tmpl.$file_name.".tpl");
		return str_replace("%site_url%", $this->config->address, $content);
	}
	
//Получает массив шаблонов под замену, массив замен и заменяет в содержании файла-шаблона
	protected function getReplacedTemplate($subst, $template_file) {
		$predecessor = array();
		$successor = array();
		$i = 0;
		foreach ($subst as $key => $value) {
			$predecessor[$i] = $key;
			$successor[$i] = $value;
			$i++;
		}
		return str_replace($predecessor, $successor, $this->getReplacedAddress($template_file));
	}
	
}

?>