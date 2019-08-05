<?php

function showProduct($id)
{
	$discount = getMaxDiscount();
	$id = (int)$id;
	$sql = "SELECT * FROM `products` WHERE id = $id";
	$product = show($sql);

	if (isset($discount)) {
		$product[name] .= ' Cкидка ' . $discount . '%';
		$product[price] *= 1 - $discount / 100;
	}

	return $product;
}

function getMaxDiscount() {
	$sql = "SELECT `discount` FROM `discounts` WHERE dateStart < NOW() AND dateFinish > NOW() ORDER BY `discount` DESC LIMIT 1";
	$assocResult = show($sql);
	if (isset($assocResult)) {
		return $assocResult[discount];
	}
}

function createCatalog() {
	$discount = getMaxDiscount();

	$sql = "SELECT * FROM `products`";

	$result = '';

	$assocResult = getAssocResult($sql);

	foreach ($assocResult as $row) {
		if (isset($discount)) {
			$name = $row[name] . ' Cкидка ' . $discount . '%';
			$price = $row[price] * (1 - $discount / 100);
		}
		else {
			$name = $row[name];
		}
		$result .= render(TEMPLATES_DIR . 'catalogItem.tpl', [
			'id' => $row[id],
			'src' => $row[image],
			'alt' => $row[name],
			'name' => $name,
			'price' => "$price"

		]);
	}

	return $result;
}

function updateProduct($id, $name, $price, $description)
{
	$link = createConnection();

	$id = (int)$id;
	$price = (float)$price;
	$name = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($name)));
	$description = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($description)));

	$sql = "UPDATE `products` SET `name`='$name', `price`='$price', `description`='$description' WHERE `id` = $id";

	$result = mysqli_query($link, $sql);

	mysqli_close($link);
	return $result;
}

function deleteProduct($id)
{
	$id = (int)$id;

	$sql = "DELETE FROM `products` WHERE `id` = $id";

	return execQuery($sql);
}

function getProductsByIds($ids)
{
	$sql = "SELECT * FROM `products` WHERE `id` IN (" . implode(', ', $ids) . ")";
	return getAssocResult($sql);
}
/**
 * Генерирует страницу моих заказов
 * @return string
 */
function generateMyOrdersPage()
{
	//получаем id пользователя и и получаем все заказы пользователя
	$userId = $_SESSION['login']['id'];
	$orders = getAssocResult("SELECT * FROM `orders` WHERE `userId` = $userId ORDER BY `dateCreate` DESC");

	$result = '';
	foreach ($orders as $order) {
		$orderId = $order['id'];

		//получаем продукты, которые есть в заказе
		//TODO вытащить из цикла
		$products = getAssocResult("
			SELECT *, `op`.`price` FROM `orderProducts` as op
			JOIN `products` as p ON `p`.`id` = `op`.`productId`
			WHERE `op`.`orderId` = $orderId
		");

		$content = '';
		$orderSum = 0;
		//генерируем элементы таблицы товаров в заказе
		foreach ($products as $product) {
			$count = $product['amount'];
			$price = $product['price'];
			$productSum = $count * $price;
			$content .= render(TEMPLATES_DIR . 'orderTableRow.tpl', [
				'name' => $product['name'],
				'id' => $product['id'],
				'count' => $count,
				'price' => $price,
				'sum' => "$productSum"
			]);
			$orderSum += $productSum;
		}

		$statuses = [
			1 => 'Не обработан',
			2 => 'Отменен',
			3 => 'Оплачен',
			4 => 'Доставлен',
		];

		$buttons = (int)$order['status'] === 1 ? "<a class='btn' onclick='changeOrderStatus($orderId, 2)'>Отменить</a>" : '';

		//генерируем полную таблицу заказа
		$result .= render(TEMPLATES_DIR . 'orderTable.tpl', [
			'id' => $orderId,
			'content' => $content,
			'sum' => "$orderSum",
			'status' => $statuses[$order['status']],
			'buttons' => $buttons
		]);
	}
	return $result;
}

function changeOrderStatus($orderId, $newStatus)
{
	$orderId = (int)$orderId;
	$newStatus = (int)$newStatus;
	$sql = "UPDATE `orders` SET `status`= $newStatus WHERE `id` = $orderId";
	return execQuery($sql);
}

/**
 * Генерирует страницу из 20 последних заказов
 * @return string
 */
function generateAllOrdersPage()
{
	$orders = getAssocResult("SELECT * FROM `orders` ORDER BY `dateCreate` DESC LIMIT 20");

	$result = '';
	foreach ($orders as $order) {
		$orderId = $order['id'];

		//получаем продукты, которые есть в заказе
		//TODO вытащить из цикла
		$products = getAssocResult("
			SELECT *, `op`.`price` FROM `orderProducts` as op
			JOIN `products` as p ON `p`.`id` = `op`.`productId`
			WHERE `op`.`orderId` = $orderId
		");

		$content = '';
		$orderSum = 0;
		//генерируем элементы таблицы товаров в заказе
		foreach ($products as $product) {
			$count = $product['amount'];
			$price = $product['price'];
			$productSum = $count * $price;
			$content .= render(TEMPLATES_DIR . 'orderTableRow.tpl', [
				'name' => $product['name'],
				'id' => $product['id'],
				'count' => $count,
				'price' => $price,
				'sum' => "$productSum"
			]);
			$orderSum += $productSum;
		}

		$statuses = [
			1 => 'Не обработан',
			2 => 'Отменен',
			3 => 'Оплачен',
			4 => 'Доставлен',
		];

		$buttons = (int)$order['status'] === 1 ? "<a class='btn' onclick='changeOrderStatus($orderId, 2)'>Отменить</a><a class='btn' onclick='changeOrderStatus($orderId, 3)'>Подтвердить оплату</a>" : '';
		$buttons = (int)$order['status'] === 3 ? "<a class='btn' onclick='changeOrderStatus($orderId, 2)'>Отменить</a><a class='btn' onclick='changeOrderStatus($orderId, 4)'>Подтвердить доставку</a>" : '';
		//генерируем полную таблицу заказа
		$result .= render(TEMPLATES_DIR . 'orderTable.tpl', [
			'id' => $orderId,
			'content' => $content,
			'sum' => "$orderSum",
			'status' => $statuses[$order['status']],
			'buttons' => $buttons
		]);
	}
	return $result;
}
