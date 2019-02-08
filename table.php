<html>
<head>
    <title>Table page</title>
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="body.css">
    <link rel="stylesheet" href="userBackground.css">
</head>

<body>
<?php
    session_start();
    if (isset($_SESSION['id'])) {
        echo '<div>';
        if ($_SESSION['admin'] == 1)
            echo '<a class="button28" href="admin.php">Панель администратора</a>';
        echo '<a class="button28" href="exit.php">Выход</a>';
        echo '</div>';

        echo '<div><a class="button28" href="tableRecordPage.php">Добавить запись</a></div>';
    } else {
        echo '<div><a class="button28" href="loginPage.php">Вход</a><a class="button28" href="registration.php">Регистрация</a></div>';
    }
?>

<table>
    <tr>
        <td class="tableTitle" rowspan="2">Месяц</td>
        <td class="tableTitle" rowspan="2">Дата</td>
        <td class="tableTitle" colspan="4">Павильон № 1</td>
        <td class="tableTitle" colspan="4">Павильон № 2</td>
        <td class="tableTitle" colspan="4">Павильон № 3</td>
    </tr>

    <tr>
        <td class="tableTitle">Курс, кафедра</td>
        <td class="tableTitle">ФИО</td>
        <td class="tableTitle">Вид работы</td>
        <td class="tableTitle">Ред.</td>
        <td class="tableTitle">Курс, кафедра</td>
        <td class="tableTitle">ФИО</td>
        <td class="tableTitle">Вид работы</td>
        <td class="tableTitle">Ред.</td>
        <td class="tableTitle">Курс, кафедра</td>
        <td class="tableTitle">ФИО</td>
        <td class="tableTitle">Вид работы</td>
        <td class="tableTitle">Ред.</td>
    </tr>

    <?php
        require_once("DateWork.php");
        require_once("DBwork.php");

        $link = mysqli_connect(DBwork::$ip, DBwork::$login, DBwork::$pass, "employment_schedule") or die (mysqli_error());

        $query = mysqli_query($link, "SELECT MIN(date_start), MAX(date_end) FROM pavilions WHERE date_end >= NOW()");

        if (!($row = mysqli_fetch_array($query)))
            exit;

        $min_date = $row["MIN(date_start)"];
        $max_date = $row["MAX(date_end)"];
        $max_date = DateWork::addDaysToDate($max_date, 15);

        $query = mysqli_query($link, "SELECT * FROM pavilions");

        $all_schedule = array();

        foreach ($query as $key => $val) {
            $all_schedule[] = $val;
        }

        $rowspan = array(0, 0, 0);

        $backColor = array(0, 0, 0);

        for($current_date = $min_date; strtotime($current_date) < strtotime($max_date);
            $current_date = DateWork::addDaysToDate($current_date, 1)) {
            echo "<tr>";
            echo "<td>" . DateWork::dateToMonth($current_date) . "</td>";
            echo "<td>" . $current_date . "</td>";

            for ($j = 0; $j < 3; $j++)
            {
                foreach ($all_schedule as $key => $val)
                {
                    if (($val["date_start"] == $current_date) and ($val["pavilion_id"] == $j))
                    {
                        if($backColor[$j] % 2 == 0)
                        {
                            $user_back = "userBack_1";
                        }
                        else
                        {
                            $user_back = "userBack_2";
                        }

                        $backColor[$j]++;

                        $rowspan[$j] = $val["days"];

                        $fio_q = mysqli_query($link, "SELECT fio FROM users WHERE user_id=" . $val["owner_id"]);
                        $fio_row = mysqli_fetch_array($fio_q);

                        echo '
                            <td class="'.$user_back.'" rowspan="' . $rowspan[$j] . '">' . $val["class"] . '</td>
                            <td class="'.$user_back.'" rowspan="' . $rowspan[$j] . '">' . $fio_row["fio"] . '</td>
                            <td class="'.$user_back.'" rowspan="' . $rowspan[$j] . '">' . $val["work_type"] . '</td>
                            ';

                        if (isset($_SESSION['admin']) && ($_SESSION['admin'] == 1))
                        {
                            echo '
                                <form method="post" action="editTableRecordPage.php">
                                  <input type="hidden" name="fieldId" value="' . $val["id"] . '">
                                  <td class="'.$user_back.'" rowspan="' . $rowspan[$j] . '"><input type="submit" value="+"></td>
                                </form>
                                 ';
                        } else
                        {
                            echo '<td class="'.$user_back.'" rowspan="' . $rowspan[$j] . '">-</td>';
                        }
                    }
                }

                if ($rowspan[$j] == 0)
                {
                    echo '
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>                   
                    ';

                    if (isset($_SESSION['id']) && (strtotime(date('Y-m-d')) <= strtotime($current_date)))
                    {
                        echo '
                            <form action="tableRecordPage.php">
                                <input type="hidden" name="date_start" value="' . $current_date . '">
                                <input type="hidden" name="pav" value="' . ($j + 1) . '">
                                <td><input type="submit" value="+"></td>
                            </form>
                                ';
                    } else
                    {
                        echo '<td>-</td>';
                    }
                } else
                {
                    $rowspan[$j]--;
                }
            }

            echo "</tr>";
        }

        mysqli_close($link);
    ?>
</table>
<?php
    if (isset($_SESSION['id']))
        echo '<div><a class="button28" href="tableRecordPage.php">Добавить запись</a></div>';
?>
</body>
</html>