<?php
require_once __DIR__ . '/../config/config.php';


$id = $_GET['id'] ?? false;


if(!$id) {
	echo 'id не передан';
	exit();
}

$sql = "SELECT * FROM images WHERE id = $id";

$image = show($sql);

$views = $image[views] + 1;

$sql = "UPDATE `images` SET `views` = $views WHERE `images`.`id` = $id";
execQuery($sql);

echo render(TEMPLATES_DIR . 'imageView.tpl', [
    'title' => 'Просмотр',
    'h3' => $image[title],
    'url' => $image[url],
    'alt' => $image[title],
    'views' => "$views"
]);
?>
