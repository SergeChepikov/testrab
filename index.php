<!DOCTYPE html>
<meta charset="utf-8">
<body>
<div>
    <form action="" method="post">
        </br>
        </br>
        <label>Начало диапазона подсчёта вхождений </label>
        <input input type="date" name="niz"/>
        </br>
        </br>
        <label>Конец диапазона вхождений</label>
        <input input type="date" name="verh"/>
        </br>
        </br>
        <input type="submit" name="button_submit" value="Отправить"/>
    </form>
</div>
<?php
include("consolidateTableInput.php");
{
    $link = mysqli_connect("127.0.0.1", "ihar", "00005268",
        "testphp");//откытие соединения с бд
    if ( ! $link) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }


    if (isset($_POST['button_submit'])) {
        $Querry = new ConsolidateTable($_POST['niz'], $_POST['verh'], $link);
        $Querry->inputTable();
    }
    mysqli_close($link);
}

?>
</body>
