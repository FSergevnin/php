<?php

require_once __DIR__ . '/../config/config.php';

$id = $_GET['id'] ?? false;


if(!$id) {
	echo 'id не передан';
	exit();
}

$sql = "SELECT * FROM news WHERE id = $id";

$newsItem = show($sql);

if(!$newsItem) {
	$newsItem = [
		'title' => '404',
		'content' => 'Новость не найдена'
	];
}

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => $newsItem['title'],
	'content' => $newsItem['content'],
	'h1' => $newsItem['title']
]);