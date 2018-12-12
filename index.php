<!DOCTYPE html>
<meta charset="utf-8">
<body>
<form action="" method="post">
    </br>
    </br>
    <label>нижний край даты </label>
    <input input type="date" name="niz"/>
    </br>
    </br>
    <label>верхний край даты</label>
    <input input type="date" name="verh"/>
    </br>
    </br>
    <input type="submit" name="button_submit" value="Отправить"/>
</form>
<?php
include("main.php");
if (isset($_POST['button_submit'])) {
    if (validate_date($_POST['niz'], $_POST['verh'])) {
        poisk_cms($_POST['niz'], $_POST['verh']);
    }
}
?>
</body>
