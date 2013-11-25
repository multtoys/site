<?php
session_start();
require_once('general.html'); //Общий для всех страниц - head
?>
<link rel='stylesheet' type='text/css' href='styles/order.css' />
<?php
require_once('general2.html'); //Общий для всех страниц - overheader and header
require_once('basket.php'); //Общий для всех страниц - вход в корзину
require_once('orderbody.html'); //Только для домашней страницы
require_once('general3.html'); //Общий для всех страниц - footer
?>