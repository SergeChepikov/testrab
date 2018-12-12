<?php
// ФУнкция проверки дат date_1 и date_2 на корректность формату dd-mm-YY
function validate_date($check_date_1, $check_date_2)
{
    if (
            (preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $check_date_1)) or (empty($check_date_1)) and
            (preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $check_date_2)) or (empty($check_date_2))
    ) {
        $res_check = true;

    } else {
        $res_check = false;
        echo "Ошибка, неверно введён формат даты,";
    }
    return $res_check;
}

// Превращение даты формата dd/M/YY, прочтённую из логфайла в M-dd-YY(требуется в случае, если полученные date_1 или date_2 пустые
function proverka_empty($date, $element)
{
    if (preg_match("/[0-9][0-9]\\/(.{3})\\/[0-9][0-9][0-9][0-9]/", $element, $preobr_date)) {
        $tire = "-";
        if (preg_match("/(.{3})(?=(.{5})$)/", $preobr_date[0], $mouth)) {
            $mouth[0] = $mouth[0] . $tire;
        }
        if (preg_match("/^[0-9][0-9]/", $preobr_date[0], $day)) {
            $day[0] = $day[0] . $tire;
        }
        if (preg_match("/(.{4})$/", $preobr_date[0], $year)) {
        }
        $date = $mouth[0] . $day[0] . $year[0];
        return $date;
    }
}

// Основная функция, принимающая значения дат из инпутов(либо null), осуществляет поиск в диапазоне принмимающих дат
function poisk_cms($date_1, $date_2)
{
    $mainfile = file("files/task.log");
    //Проверка даты1 на пустоту
    if (empty($date_1)) {
        $date_1 = proverka_empty($date_1, $mainfile[0]);
    }
    //Проверка даты1 на пустоту
    if (empty($date_2)) {
        $date_2 = proverka_empty($date_2, array_pop($mainfile));
    }
    $summary = 0;    //Суммарное кол-во вхождений (изначально 0)
    $result = []; //Результирующий Массив(изначально пустой)
    $start = new DateTime("$date_1"); // начало проверки диапазона дат
    $end = new DateTime("$date_2"); // конец проверки диапазона дат
    $step = new DateInterval('P1D'); //	шаг проверки диапазона дат
    $period = new DatePeriod($start, $step, $end); // Диапазон дат для проверки
    // Цикл, разбивающий массив строк $mainfile на отдельный строки $line
    foreach ($mainfile as $line) {
        {
            //Регулярка, ищущая в $line(строка из массива полученных строк) значение cms=(значение до 15 символов) HTTP или &
            if (preg_match("/cms=(.{0,15})( HTTP|&)/", $line, $mathes)) {
                //Цикл, сверяющий строку с найденым значением cms=(значение до 15 символов) HTTP или & с диапазоном дат поиска
                foreach ($period as $datetime) {
                    $test = $datetime->format('d\\\/M\\\/Y');
                    if (preg_match("/$test/", $line)) {
                        $res = $mathes[1];
                        $summary++; // Подсчёт суммарного кол-ва вхождений cms=(значение до 15 символов) HTTP или &
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
        }
    }
    // Вывод итогового значения
    echo "Всего=$summary<br>";
    print_r($result);
    echo "<br>";
}

?>