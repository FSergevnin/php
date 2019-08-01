<?php

require_once __DIR__ . '/../config/config.php';

if (empty($_SESSION['login'])) {
	header('Location: /login.php');
}

if (empty($_COOKIE['basket'])) {
	header('Location: /products/basket.php');
}

if (isset($_POST['address'])) {
	$userId = $_SESSION['login']['id'];
	$address = $_POST['address']; //TODO защитить от SQL инъекций
	$sql = "INSERT INTO `orders`(`userId`, `address`) VALUES ($userId, '$address')";
	$orderId = insert($sql);

	$cart = $_COOKIE['basket'];

	$ids = array_keys($cart);

	$products = getProductsByIds($ids);

	$sql = "INSERT INTO `orderProducts`(`orderId`, `productId`, `price`, `amount`) VALUES ";
	$sqlParts = [];
	foreach ($products as $product) {
		$productId = $product['id'];
		$amount = $cart[$product['id']];
		$price = $product['price'];
		$sqlParts[] = "($orderId, $productId, $price, $amount)";
	}

	$sql .= implode(', ', $sqlParts);

	if (execQuery($sql)) {
		echo 'OK';
		foreach ($cart as $productId => $amount) {
			setcookie("basket[$productId]", null, -1, '/');
		}
		header('Location: /myOrders.php');
	} else {
		echo 'Произошла ошибка';
	}
}


?>


<form method="POST">
	Адрес доставки: <input type="text" name="address"/>
	<input type="submit" name="">
</form>
