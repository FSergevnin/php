<?php

require_once __DIR__ . '/../config/config.php';

$sql = "SELECT * FROM `products`";

$catalog = createCatalog($sql);

echo render(TEMPLATES_DIR . 'catalog.tpl', [
	'title' => 'Каталог',
	'h1' => 'Товары для вас!',
	'content' => $catalog
]);

?>
