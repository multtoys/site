<?php
$n_item = $_SESSION['items'];
$ind = $n_item % 10;
if ($n_item == 0) $n_item="нет";
if (($n_item >= 10) && ($n_item <= 20)) $suff="ек";
else {
	switch($ind) {
		case 1: {
			$suff="ка";
			break;
		}
		case 2: {
			$suff="ки";
			break;
		}
		case 3: {
			$suff="ки";
			break;
		}
		case 4: {
			$suff="ки";
			break;
		}
		default: {
			$suff="ек";
		}
	}
}

echo "<td>
			<a href='order.php' title='Ваша корзина'><img height='34px' width='34px' src='pictures/busket.png' alt='Корзина' /></a>
			<a id='inmenu' href='order.php' title='Ваша корзина'>
				<span>В корзине <b>$n_item</b> игруш$suff</span>
			</a>
		</td>
	</tr>
</table>
</div>";
?>