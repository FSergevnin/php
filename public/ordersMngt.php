<?php

require_once __DIR__ . '/../config/config.php';

if(empty($_SESSION['login'])) {
	header('Location: /login.php');
}
if($_SESSION['login']['role'] === '0') {
	header('Location: /index.php');
}

$userId = (int)$_SESSION['login']['id'];

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Заказы',
	'h1' => 'Управление заказами',
	'content' => generateAllOrdersPage()
]);
