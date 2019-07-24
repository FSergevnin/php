<?php

function createBasket() {

	$basket = $_COOKIE['basket'];

    $strId = '';
//собираем строку из id для запроса
    foreach ($basket as $id => $value) {
        if ($value > 0) {
            if ($strId == ''){
                $strId .= $id;
            }
            else {
                $strId .= ', ' . $id;
            }
        }
    }

    $sql = 'SELECT * FROM `products` WHERE id IN (' . $strId . ')' ;

	$result = '';

	$assocResult = getAssocResult($sql);

	foreach ($assocResult as $row) {
        $cntProducts += $basket[$row[id]];
        $fullPrice += $basket[$row[id]] * $row[price];
		$result .= render(TEMPLATES_DIR . 'basketItem.tpl', [
			'id' => $row[id],
			'src' => $row[image],
			'alt' => $row[name],
			'name' => $row[name],
			'price' => $row[price],
            'amount' => $basket[$row[id]]

		]);
	}
    $result = "<h3>В корзине $cntProducts товар(а) на сумму $fullPrice руб.</h3> $result";
	return $result;
}
 ?>
