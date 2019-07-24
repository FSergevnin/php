<!doctype>
<html>
<head>
	<title>{{TITLE}}</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<header>
		<ul>
			<li><a href="/">Главная</a></li>
			<li><a href="/contacts.php">Контакты</a></li>
			<li><a href="/gallery.php">Галерея</a></li>
			<li><a href="/catalog.php">Каталог</a></li>
			<li><a href="/basket.php">Корзина</a></li>
		</ul>
	</header>
	<img src="{{URL}}" alt="{{ALT}}" style="max-width: 500px; max-height: 500px">
    <h3>{{H3}}</h3>
    <p>Цена &#8381;{{PRICE}}</p>
	<a href="basket.php?id={{ID}}">Добавить в корзину</a><br>
	<p>Описание: {{DESCRIPTION}}</p>

    <a href="editProduct.php?id={{ID}}">Изменить</a><br>
    <a href="deleteProduct.php?id={{ID}}">Удалить</a><br>
	<a href="./catalog.php">назад</a>


</body>
</html>
