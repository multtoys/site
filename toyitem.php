<?php
session_start();
if (!isset($_SESSION['items'])) $_SESSION['items'] = 0;
if (isset($_GET['add_x'])) $_SESSION['items']++;

require_once('general.html'); //Общий для всех страниц - head
?>
<link rel='stylesheet' type='text/css' href='styles/single.css' />
<link rel='stylesheet' type='text/css' href='styles/catalogues.css' />
<?php

require_once('general2.html'); //Общий для всех страниц - overheader and header
require_once('basket.php'); //Общий для всех страниц - вход в корзину
require_once('toyitembody.html'); 		//Только для страницы с игрушкой

if ($_SESSION['items'] == 0) {
	echo "<td colspan='2' style='text-align: right;'><form name='order' action='order.php' method='post' >
				<input class='dim' type='image' src='pictures/order_button.png' name='to_order' disabled />
			</form></td>
			</tr>
		</table>
		</div>";
}
else {
	$num = $_SESSION['items'];
	echo "<td colspan='2' style='text-align: right;'><form name='order' action='order.php' method='post' >
				<input type='image' src='pictures/order_button.png' name='to_order' />
			</form></td>
			</tr>
		</table>
		</div>";
}

require_once('general3.html'); //Общий для всех страниц - footer
?>