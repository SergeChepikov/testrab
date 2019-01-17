<?php

class ConsolidateTable
{

    //  public $date_1;    public $date_2;    public $link;
    public function __construct($dateOne, $dateSecond, $link)
    {
        $this->dateOne    = $dateOne;
        $this->dateSecond = $dateSecond;
        $this->link       = $link;
        var_dump($dateOne->dateOne);
        var_dump($dateSecond->dateSecond);

    }

    public function inputTable()
    {
        echo gettype($this->dateSecond);
        if ($this->dateSecond == null) {
            $this->dateSecond = date("Y-m-d", strtotime('today'));
        }
        $sqlQuery
                 = "SELECT cms, SUM(quantity) AS total_count FROM test Where Date Between '$this->dateOne' AND '$this->dateSecond' GROUP BY cms";
        $summary = 0;
        if ($result = $this->link->query($sqlQuery)) {
            echo "<table style='background-color: #c9d7f1'>";
            while ($row = mysqli_fetch_array($result)) {
                $summary += $row['total_count'];

                echo "<tr><td>", 'cms='
                    . $row['cms'], "</td>", "<td>", ' total_count= '
                    . $row['total_count'] . '', "</td></tr>";// выводим данные

            }
            echo "</table>";
            echo "summary = ", "$summary";
        }

    }

}