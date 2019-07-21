<?php

require_once __DIR__ . '/../config/config.php';

$id = $_GET['id'] ?? false;

if (!$id) {
	echo '404';
	exit();
}


$product = showProduct($id);

if (!$product) {
	echo '404';
	exit();
}


$name = $_POST['name'] ?? $product['name'];
$price = $_POST['price'] ?? $product['price'];
$description = $_POST['description'] ?? $product['description'];
$messages = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ($name && $price && $description) {
		if (updateProduct($id, $name, $price, $description)) {
			$messages .= "Товар изменён";
		} else {
			$messages .= "Что-то пошло не так";
		}
	} else {
		if (!$name) {
			$messages .= "Введите название товара<br>";
		}
        if (!$price) {
			$messages .= "Укажите цену товара<br>";
		}
		if (!$description) {
			$messages .= "Добавьте описание товара<br>";
		}
	}
}

?>

<br>
<br>
<br>
<div class="messages">
	<?= $messages ?>
</div>
<br>
<form method="POST">
	Название товара:<br>
	<input type="text" name="name" value="<?= $name ?>"><br>
    Цена товара:<br>
	<input type="text" name="price" value="<?= $price ?>"><br>
	Описание товара: <br>
	<textarea name="description"><?= $description ?></textarea><br>
	<br>
	<input type="submit">
</form>
