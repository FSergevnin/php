<?php


function render($file, $variables = [])
{
	if (!is_file($file)) {
		echo 'Template file "' . $file . '" not found';
		exit();
	}

	if (filesize($file) === 0) {
		echo 'Template file "' . $file . '" is empty';
		exit();
	}


	$templateContent = file_get_contents($file);

	foreach ($variables as $key => $value) {
		if (!is_string($value)) {
			continue;
		}

		$key = '{{' . strtoupper($key) . '}}';
		$templateContent = str_replace($key, $value, $templateContent);
	}

	return $templateContent;
}


function createGallery($sql) {
	$result = '';

	$assocResult = getAssocResult($sql);

	foreach ($assocResult as $row) {
		$result .= render(TEMPLATES_DIR . 'galleryItem.tpl', [
			'id' => $row[id],
			'views' => $row[views],
			'src' => $row[url],
			'alt' => $row[title]

		]);
	}

	return $result;
}
