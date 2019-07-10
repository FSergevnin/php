<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Курс php</title>
    </head>
    <body>
        <?php
            echo "<h1>Практическое задание № 2</h1>";
            $a = 5;
            $b = 1;

            echo "a = $a <br>";
            echo "b = $b <br>";
            echo '<h3>задание № 1</h3>';

            if ($a >= 0 && $b >= 0) {
                echo 'a - b = ' . ($a - $b);
            }
            elseif ($a < 0 && $b < 0) {
                echo 'a * b = ' . ($a * $b);
            }
            else {
                echo 'a + b = ' . ($a + $b);
            }

            echo '<h3>задание № 2</h3>';

            $a = (int)$a;
            switch ($a) {
                case 0:
                    echo '0 ';
                case 1:
                    echo '1 ';
                case 2:
                    echo '2 ';
                case 3:
                    echo '3 ';
                case 4:
                    echo '4 ';
                case 5:
                    echo '5 ';
                case 6:
                    echo '6 ';
                case 7:
                    echo '7 ';
                case 8:
                    echo '8 ';
                case 9:
                    echo '9 ';
                case 10:
                    echo '10 ';
                case 11:
                    echo '11 ';
                case 12:
                    echo '12 ';
                case 13:
                    echo '13 ';
                case 14:
                    echo '14 ';
                case 15:
                    echo '15';
                    break;
                default:
                    echo 'значение переменной должно быть в диапазоне 0 - 15';
                    break;
            }

            echo '<h3>задание № 3</h3>';

            function sumVariable($a, $b) {
                return $a + $b;
            }

            function diffVariable($a, $b) {
                return $a - $b;
            }

            function multVariable($a, $b) {
                return $a * $b;
            }

            function divVariable($a, $b) {
                if ($b != 0) {
                    $c = $a / $b;
                }
                else {
                    $c = 'Ошибка. Деление на ноль';
                }
                return $c;
            }

            echo 'сумма переменных = ' . sumVariable($a, $b) . '<br>';
            echo 'разность переменных = ' . diffVariable($a, $b) . '<br>';
            echo 'произведение переменных = ' . multVariable($a, $b) . '<br>';
            echo 'частное переменных = ' . divVariable($a, $b) . '<br>';

            echo '<h3>задание № 4</h3>';

            function mathOperation($arg1, $arg2, $operation) {
                switch ($operation) {
                    case 'сумма':
                        return sumVariable($arg1, $arg2);
                    case 'вычитание':
                        return diffVariable($arg1, $arg2);
                    case 'умножение':
                        return multVariable($arg1, $arg2);
                    case 'деление':
                        return divVariable($arg1, $arg2);
                    default:
                        return 'укажите одну из операций: сумма, вычитание, умножение, деление';
                        break;
                }
            }

            echo mathOperation(154, 0, 'сумма');

            echo '<h3>задание № 5</h3>';

            echo 'см. подвал';

            echo '<h3>задание № 6</h3>';

            function power($val, $pow) {
                if ($pow == 0 && $val == 0) {
                    return 'неопредено';
                }
                elseif ($pow <> (int)$pow){
                    return 'возведение в дробную степень недоступно';
                }

                if ($pow <> abs($pow)) {
                    $pow = abs($pow);
                    $sing = -1;
                }
                else {
                    $sing = 1;
                }

                if ($pow > 1) {
                    $val = $val * power($val, $pow-1);
                }
                elseif ($pow == 0 && $val <> 0) {
                    $val = 1;
                }

                if ($sing == 1) {
                    return $val;
                }
                else {
                    return 1/$val;
                }

            }

            echo power(3, -7);

            echo '<h3>задание № 7</h3>';

            function timeWriter(){
                $currentTime = date('H:i');
                $timeStr = substr($currentTime, 0, 2);

                if (substr($currentTime, 0, 2) > 10 && substr($currentTime, 0, 2) < 15) {
                    $timeStr = $timeStr . ' часов';
                }
                else {
                    switch (substr($currentTime, 1, 1)) {
                        case '0':
                            $timeStr = $timeStr . ' часов';
                            break;
                        case '1':
                            $timeStr = $timeStr . ' час';
                            break;
                        case '2':
                        case '3':
                        case '4':
                            $timeStr = $timeStr . ' часа';
                            break;
                        case '5':
                        case '6':
                        case '7':
                        case '8':
                        case '9':
                            $timeStr = $timeStr . ' часов';
                            break;
                        default:
                            return 'ошибка формата времени';
                    }
                }
                $timeStr = $timeStr . ' ' . substr($currentTime, 3, 2);

                if (substr($currentTime, 3, 2) > 10 && substr($currentTime, 3, 2) < 15) {
                    $timeStr = $timeStr . ' минут';
                }
                else {
                    switch (substr($currentTime, 4, 1)) {
                        case '0':
                            $timeStr = $timeStr . ' минут';
                            break;
                        case '1':
                            $timeStr = $timeStr . ' минута';
                            break;
                        case '2':
                        case '3':
                        case '4':
                            $timeStr = $timeStr . ' минуты';
                            break;
                        case '5':
                        case '6':
                        case '7':
                        case '8':
                        case '9':
                            $timeStr = $timeStr . ' минут';
                            break;
                        default:
                            return 'ошибка формата времени';
                    }
                }

                return $timeStr;
            }

             echo timeWriter()
         ?>
    </body>
    <footer>
        <?php
            echo '<hr>';
            echo 'текущий год в подвале ' . date(Y);
        ?>
    </footer>
</html>
