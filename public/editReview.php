<?php

require_once __DIR__ . '/../config/config.php';

$id = $_GET['id'] ?? false;

if (!$id) {
	echo '404';
	exit();
}


$review = showReview($id);

if (!$review) {
	echo '404';
	exit();
}

echo "<pre>";
var_dump($_POST);
echo "</pre><hr>";

$author = $_POST['author'] ?? $review['author'];
$text = $_POST['text'] ?? $review['text'];
$messages = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ($author && $text) {
		if (updateReview($id, $author, $text)) { 
			$messages .= "Комментарий изменен";
		} else {
			$messages .= "Что-то пошло не так";
		}
	} else {
		if (!$author) {
			$messages .= "Введите имя<br>";
		}
		if (!$text) {
			$messages .= "Добавьте Комментарий<br>";
		}
	}	
}

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