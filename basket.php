<?php
$n_item = $_SESSION['items'];
echo "<td>
			<a href='order.php' title='Ваша корзина'>
				<img height='34px' width='34px' src='pictures/busket.png' alt='Корзина' />
			</a>
			<a id='inmenu' href='order.php' title='Ваша корзина'>
				<span>В корзине <b>$n_item</b> товаров</span>
			</a>
		</td>
	</tr>
</table>
</div>";
?>