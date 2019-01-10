<?php
function poisk_cms()// Основная функция, осуществляет поиск cms=
{
    $mainfile = file("/home/ihar/PhpstormProjects/testrab/1week.log");
    $result = []; //Результирующий Массив(изначально пустой)
    // Цикл, разбивающий массив строк $mainfile на отдельный строки $line
    foreach ($mainfile as $line) {
        {
            //Регулярка, ищущая в $line(строка из массива полученных строк) значение cms=(значение до 15 символов) HTTP или &
            if (preg_match("/cms=(.{0,15})( HTTP|&)/", $line, $mathes)) {
                $res = $mathes[1];
                if (array_key_exists($res, $result)) {
                    $result[$res] += 1;
                } else {
                    //Проверка существования значения cms и либо создание нового ключа, либо увеличение уже существующего
                    $additional = array($mathes[1] => $value = 1);
                    $result += $additional;
                }
            }
        }
    }
    return ($result);
}

$link = mysqli_connect("127.0.0.1", "ihar", "00005268", "testphp");//откытие соединения с бд
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
echo "Соединение с MySQL установлено!" . PHP_EOL;
echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;
$result = poisk_cms();
$keys = (array_keys($result));//массив ключей кмс
$values = (array_values($result));// массив значений кмс
$i = 0;
$date = date("Y-m-d", strtotime('yesterday')); //Получение верашней даты
while ($i < count($keys)) {
    $sql = "INSERT INTO test (cms , quantity , date) VALUES ( '$keys[$i]' , '$values[$i]' , '$date')";
    if (mysqli_query($link, $sql)) {
        echo "New record created successfully\n";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
    $i++;
}
mysqli_close($link);
?>