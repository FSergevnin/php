<?php

function showProduct($id)
{
	$id = (int)$id;
	$sql = "SELECT * FROM `products` WHERE id = $id";
	return show($sql);
}

function createCatalog() {

	$sql = "SELECT * FROM `products`";

	$result = '';

	$assocResult = getAssocResult($sql);

	foreach ($assocResult as $row) {
		$result .= render(TEMPLATES_DIR . 'catalogItem.tpl', [
			'id' => $row[id],
			'src' => $row[image],
			'alt' => $row[name],
			'name' => $row[name],
			'price' => $row[price],

		]);
	}

	return $result;
}




function updateProduct($id, $name, $price, $description)
{
	$link = createConnection();

	$id = (int)$id;
	$price = (float)$price;
	$name = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($name)));
	$description = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($description)));

	$sql = "UPDATE `products` SET `name`='$name', `price`='$price', `description`='$description' WHERE `id` = $id";

	$result = mysqli_query($link, $sql);

	mysqli_close($link);
	return $result;
}

function deleteProduct($id)
{
	$id = (int)$id;

	$sql = "DELETE FROM `products` WHERE `id` = $id";

	return execQuery($sql);
}

function getProductsByIds($ids)
{
	$sql = "SELECT * FROM `products` WHERE `id` IN (" . implode(', ', $ids) . ")";
	return getAssocResult($sql);
}
