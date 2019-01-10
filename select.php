<?php
function select_to_db_cms_from_date($date_1, $date_2)
{
    $link = mysqli_connect("127.0.0.1", "ihar", "00005268", "testphp");//откытие соединения с бд
    if (!$link) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $sqlquery = "SELECT cms, SUM(quantity) AS total_count FROM test Where Date Between '$date_1' AND '$date_2' GROUP BY cms";
    if ($result = $link->query($sqlquery)) {

        while ($row = mysqli_fetch_array($result)) {
            echo 'cms=' . $row['cms'] . ' total_count= ' . $row['total_count'] . '', "\n";// выводим данные
        }
    }
    mysqli_close($link);
}

?>