<form method="post">
    <input type="number" name="fistNumber" value="" placeholder="первое число">
    <input type="number" name="secondNumber" value="" placeholder="второе число">
    <input type="submit" name="plus" value="+">
    <input type="submit" name="minus" value="-">
    <input type="submit" name="multiplication" value="*">
    <input type="submit" name="division" value="/">
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = "$_POST[fistNumber] $_POST[action] $_POST[secondNumber] = ";
    if (is_numeric($_POST[fistNumber]) && is_numeric($_POST[secondNumber])){
        switch ($_POST[action]) {
            case '+':
                echo $result . ($_POST[fistNumber] + $_POST[secondNumber]);
                break;
            case '-':
                echo $result . ($_POST[fistNumber] - $_POST[secondNumber]);
                break;
            case '*':
                echo $result . ($_POST[fistNumber] * $_POST[secondNumber]);
                break;
            case '/':
                if ($_POST[secondNumber] == 0) {
                    echo 'Ошибка. Деление на ноль';
                }
                else {
                    echo $result . ($_POST[fistNumber] / $_POST[secondNumber]);
                }
                break;
            default:
                echo 'что-то пошло не так';
                break;
            }
        }
}

?>
