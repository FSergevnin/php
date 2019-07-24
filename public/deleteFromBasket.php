<?php
require_once __DIR__ . '/../config/config.php';

$id = $_GET['id'] ?? false;

if (!$id) {
	echo '404';
	exit();
}


deleteFromBasket($id);



header("Location: /basket.php");

 ?>
