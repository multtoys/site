<?php
session_start();
if (!isset($_SESSION['items'])) $_SESSION['items'] = 0;
$n_item = $_SESSION['items'];

require_once('general.html'); //Общий для всех страниц - head
?>
<link rel='stylesheet' type='text/css' href='styles/single.css' />
<?php

require_once('general2.html'); //Общий для всех страниц - overheader and header
require_once('basket.php'); //Общий для всех страниц - вход в корзину
require_once('toyitembody.html'); 		//Только для страницы с игрушкой
require_once('general3.html'); //Общий для всех страниц - footer

?>