<?php

require_once __DIR__ . '/../config/config.php';

echo "<pre>";
var_dump($_POST);
echo "</pre><hr>";

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



echo renderReviews();

?>

<br>
<br>
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