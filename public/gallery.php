<?php

require_once __DIR__ . '/../config/config.php';


$sql = "SELECT * FROM `images` ORDER BY `images`.`views` DESC";
$gallery = createGallery($sql);

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Галерея',
	'h1' => 'Лучшие картиночки',
	'content' => $gallery
]);

?>
