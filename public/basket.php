<?php
require_once __DIR__ . '/../config/config.php';

if (isset($_GET[id])) {
    $productId = (int)$_GET[id];

    $amount = $_COOKIE['basket'][$productId];

    setcookie("basket[$productId]", ++$amount);
}

if (isset($_GET[id])) {
    header("Location: /basket.php");
}
$basket = createBasket();

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Корзина',
	'h1' => 'Товары готовые к покупке',
	'content' => $basket
]);

echo empty($_SESSION['login'])
    ? '<br><a href="/login.php" class="btn">Войти</a>'
    : '<br><a href="/createOrder.php" class="btn">Оформить заказ</a>';
 ?>
