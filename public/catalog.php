<?php

require_once __DIR__ . '/../config/config.php';

$catalog = createCatalog();

echo render(TEMPLATES_DIR . 'catalog.tpl', [
	'title' => 'Каталог',
	'h1' => 'Товары для вас!',
	'content' => $catalog
]);



?>
