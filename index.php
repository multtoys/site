<?php
session_start();
if (!isset($_SESSION['items'])) $_SESSION['items'] = 0;
$n_item = $_SESSION['items'];

require_once('general.html'); //Общий для всех страниц - head
?>
"<link rel='stylesheet' type='text/css' href='styles/home.css' />
<?php
require_once('general2.html'); //Общий для всех страниц - overheader and header
echo <<<ITEMN
					<td><a href='order.php' title='Ваша корзина'><img src='pictures/busket.png' alt='Корзина' /></a><span>В корзине <b>$n_item</b> товаров</span></td>
				</tr>
			</table>
		</div>
ITEMN;
require_once('homebody.html'); 		//Только для домашней страницы
require_once('general3.html'); //Общий для всех страниц - footer
?>