<?php

require_once '../config/config.php';


$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';


if ($login && $password) {
	//преобразуем пароль в хэш
	$passwordXeh = md5($password);
	//получаем пользователя из базы по логин-паролю
	$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$passwordXeh'";

    $user = show($sql);

	//если пользователь найден. Записываем его в сессию
	if($user) {
		$_SESSION['login'] = $user;

        header("Location: /basket.php"); // TODO: после успешной авторизации должен выкидывать туда откуда пришёл, а пока в корзину
	} else {
		$message = 'Неверная пара логин-пароль';
	}
}

 ?>

<div><?= $message ?></div>
<form method="post">
    <pre>
        <input type="text" name="login" value="<?= $login ?>">
        <input type="password" name="password" value="<?= $password ?>">
        <input type="submit" name="aut" value="Войти">
    </pre>

</form>
