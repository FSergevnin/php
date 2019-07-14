<?php

require_once __DIR__ . '/../config/config.php';

// $variables = [
// 	'title' => 'Главная страница',
// 	'h1' => 'Добро пожаловать',
// 	'content' => '<div class="privet"><img src="/img/1.jpg"></div>'
// ];
// $templateName = TEMPLATES_DIR . 'index.tpl';


// echo render($templateName, $variables);

foreach (scandir(WWW_DIR . IMG_DIR) as $fileName) {
		if (substr($fileName, -4, 4) == '.jpg' || substr($fileName, -4, 4) == '.png' || substr($fileName, -4, 4) == '.gif') {
			$strGallary .= '<img class = "miniImg" src="' . IMG_DIR . $fileName . '" alt = "' . $fileName . '" width="350">';
		}
}


$variables = [
	'title' => 'Галерея',
	'h1' => 'Смотреть обязательно',
 	'content' => $strGallary
];

echo render(TEMPLATES_DIR . 'index.tpl', $variables);
