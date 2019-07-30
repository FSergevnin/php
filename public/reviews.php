<?php

require_once __DIR__ . '/../config/config.php';



$author = $_POST['author'] ?? '';
$text = $_POST['text'] ?? '';
$messages = '';

if ($author && $text) {
	if (createReview($author, $text)) {
		$messages .= "Комментарий добавлен";
		$author = '';
		$text = '';
	} else {
		$messages .= "Что-то пошло не так";
	}
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!$author) {
		$messages .= "Введите имя<br>";
	}
	if (!$text) {
		$messages .= "Добавьте Комментарий<br>";
	}
}



echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Отзывы',
	'h1' => 'О нас пишут',
	'content' => renderReviews()
]);
?>

<br>
<div class="messages">
	<?= $messages ?>
</div>
<br>
<form method="POST">
	Имя:<br>
	<input type="text" name="author" value="<?= $author ?>"><br>
	Комментарий: <br>
	<textarea name="text"><?= $text ?></textarea><br>
	<br>
	<input type="submit">
</form>
