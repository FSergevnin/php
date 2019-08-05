<?php
require_once __DIR__ . '/../config/config.php';


$id = $_GET['id'] ?? false;


if(!$id) {
	echo 'id не передан';
	exit();
}

$product = showProduct($id);

echo render(TEMPLATES_DIR . 'productView.tpl', [
    'title' => 'Карточка товара',
    'h3' => $product[name],
    'url' => $product[image],
    'alt' => $product[name],
    'description' => $product[description],
    'price' => "$product[price]",
    'id' => $product[id],
]);
?>
