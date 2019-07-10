<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Курс php</title>
    </head>
    <body>
        <?php
        echo "<h1>Практическое задание № 3</h1>";

        echo '<h3>задание № 1</h3>';
        //1. С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без остатка.

        $i = 0;
        while ($i <= 100) {
            If ($i%3 == 0){
                echo $i . ' ';
            }
            $i++;
        }

        echo '<h3>задание № 2</h3>';

        /*2. С помощью цикла do…while написать функцию для вывода чисел от 0 до 10, чтобы результат выглядел так:
        0 – ноль.
        1 – нечетное число.
        2 – четное число.
        3 – нечетное число.
        …
        10 – четное число.
        */

        $i = 0;
        do {
            If ($i == 0) {
                Echo $i . ' - ноль<br>';
            }
            Elseif ($i%2 == 0){
                Echo $i . ' - чётное число<br>';
            }
            Else {
                Echo $i . ' - нечётное число<br>';
            }
            $i++;
        } while ($i <= 10);

        echo '<h3>задание № 3</h3>';
        /*
        3. Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в качестве значений – массивы с названиями городов из соответствующей области. Вывести в цикле значения массива, чтобы результат был таким:
        Московская область:
        Москва, Зеленоград, Клин
        Ленинградская область:
        Санкт-Петербург, Всеволожск, Павловск, Кронштадт
        Рязанская область … (названия городов можно найти на maps.yandex.ru)
        */

        $arrRegions = [];
        $arrRegions['Московская обл.'] = ['Москва', 'Зеленоград', 'Клин'];
        $arrRegions['Мурманская обл.'] = ['Апатиты', 'Мурманск', 'Кандалакша'];
        $arrRegions['Магаданская обл.'] = ['Магадан', 'Сокол', 'Палатка'];

        foreach ($arrRegions as $regionName => $arrTowns) {
            echo $regionName . ': ' . implode(', ', $arrTowns) . '<br>';
        }

        echo '<h3>задания № 4, 5, 9 три в одном</h3>';
        /*
        4. Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
        Написать функцию транслитерации строк.
        */


        function translitRuToEn($string){
        $alfabet = [
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'ye',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'shch',
            'ъ' => '"',
            'ы' => 'y',
            'ь' => '\'',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
        ];
        $string = mb_strtolower($string);
        // функция mb_strtolower() не сработала на мобильном сервере
        $newStr = '';
            for ($i = 0; $i <= iconv_strlen($string) - 1; $i++){
                if (iconv_substr($string,$i, 1) == ' '){
                    $newStr = $newStr . '_';
                } elseif (array_key_exists(iconv_substr($string, $i, 1), $alfabet)) {
                    $newStr = $newStr . $alfabet[iconv_substr($string, $i, 1)];
                }
                else {
                    $newStr = $newStr . iconv_substr($string, $i, 1);
                }
            }
            Echo $newStr;
        }
        translitRuToEn('А роза упала на лапу Азога');

        echo '<h3>задания № 6</h3>';

        $menu4 = [
        	[
        		'title' => 'Главная',
        		'link' => '/'
        	],
        	[
        		'title' => 'Контакты',
        		'link' => '/contancts'
        	],
        	[
        		'title' => 'Статьи',
        		'link' => '/articles',
        		'children' => [
        			[
        				'title' => 'Котики',
        				'link' => '/articles/cats'
        			],
        			[
        				'title' => 'Собачки',
        				'link' => '/articles/dogs',
        				'children' => [
        					[
        						'title' => 'Доберманы',
        						'link' => '/articles/dogs/dobermani'
        					],
        					[
        						'title' => 'Корги',
        						'link' => '/articles/dogs/corgi',
        						'children' => [/* */]
        					]
        				]
        			]
        		]
        	]
        ];

        function getMenu($menu, $strMenu='') {
            $strMenu = '<ul>';
            foreach ($menu as $key => $value) {
                $strMenu = $strMenu . '<li><a href="'. $value['link'] . '">' . $value['title'] . '</a></li>';
                if (array_key_exists('children', $value)) {
                    $strMenu = $strMenu . getMenu($value['children'], $strMenu);
                }
            }
            $strMenu = $strMenu . '</ul>';
            return $strMenu;
        }

        echo getMenu($menu4);

        echo '<h3>задания № 7</h3>';
        $str='';
        For($i=0; $i<=9; $str=$str . ' ' . $i++){}
        echo $str; //не нашёл способа поместить команду в условия цикла
         ?>

         <ul>
             <li>1</li>
             <li>2</li>
             <li>3
                 <ul>
                     <li><a href="#">3.1</a></li>
                 </ul>
             </li>
         </ul>
    </body>
</html>
