<?php
session_start();
if (!isset($_SESSION['items'])) $_SESSION['items'] = 0;
if (isset($_GET['add'])) $_SESSION['items']++;

require_once('general.html'); //Общий для всех страниц - head
?>
<link rel='stylesheet' type='text/css' href='styles/single.css' />
<link rel='stylesheet' type='text/css' href='styles/catalogues.css' />
<?php

require_once('general2.html'); //Общий для всех страниц - overheader and header
require_once('basket.php'); //Общий для всех страниц - вход в корзину
require_once('toyitembody.html'); 		//Только для страницы с игрушкой

if ($_SESSION['items'] == 0) {
	echo "<form name='order' action='order.php' method='post' >
				<input type='submit' name='to_order' value='В корзине 0 товаров. Оформить заказ' disabled />
			</form>
		</div>";
}
else {
	$num = $_SESSION['items'];
	echo "<form name='order' action='order.php' method='post' >
				<input type='submit' name='to_order' value='В корзине $num товаров. Оформить заказ' />
			</form>
		</div>";
}

require_once('general3.html'); //Общий для всех страниц - footer
?>