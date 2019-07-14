<?php

require_once __DIR__ . '/../config/config.php';

foreach (scandir(WWW_DIR . IMG_DIR) as $fileName) {
		if (substr($fileName, -4, 4) == '.jpg' || substr($fileName, -4, 4) == '.png' || substr($fileName, -4, 4) == '.gif') {
			$strGallary .= '<a href="' . IMG_DIR . $fileName . '" target="_blank"><img class = "miniImg" src="' . IMG_DIR . $fileName . '" alt = "' . $fileName . '" width="350"></a>';
		}
}


$variables = [
	'title' => 'Галерея',
	'h1' => 'Смотреть обязательно',
 	'content' => $strGallary
];

echo render(TEMPLATES_DIR . 'index.tpl', $variables);
