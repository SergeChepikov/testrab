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
include("select.php");
if (isset($_POST['button_submit'])) {
    select_to_db_cms_from_date($_POST['niz'], $_POST['verh']);
}
?>
</body>
