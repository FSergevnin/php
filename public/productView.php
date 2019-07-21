<?php
require_once __DIR__ . '/../config/config.php';


$id = $_GET['id'] ?? false;


if(!$id) {
	echo 'id не передан';
	exit();
}

$sql = "SELECT * FROM products WHERE id = $id";

$product = show($sql);

echo render(TEMPLATES_DIR . 'productView.tpl', [
    'title' => 'Карточка товара',
    'h3' => $product[name],
    'url' => $product[image],
    'alt' => $product[name],
    'description' => $product[description],
    'price' => $product[price]
]);
?>
