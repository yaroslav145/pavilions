<html>
	<head>
		<title>Table page</title>
        <link rel="stylesheet" href="button.css">
        <link rel="stylesheet" href="table.css">
        <link rel="stylesheet" href="body.css">
	</head>

	<body>
         <?php
            session_start();
            if(isset($_SESSION['id']))
            {
                echo '<div>';
                    if($_SESSION['admin'] == 1)
                        echo '<a class="button28" href="admin.php">Панель администратора</a>';
                    echo '<a class="button28" href="exit.php">Выход</a>';
                echo '</div>';

                echo '<div><a class="button28" href="tableRecordPage.php">Добавить запись</a></div>';
            }
            else
            {
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

                $query = mysqli_query($link, "SELECT MIN(date_start), MAX(date_end) FROM pavilions");

                if(!($row = mysqli_fetch_array($query)))
                    exit;

                $min_date = $row["MIN(date_start)"];
                $max_date = $row["MAX(date_end)"];

                $days_count = dateWork::getDaysCountBetwenDates($min_date, $max_date) + 1;

                $current_date = $min_date;

                $query = mysqli_query($link, "SELECT * FROM pavilions");

                for($i = 0; $i < $days_count; $i++)
                {
                    echo "<tr>";
                    echo "<td>".DateWork::dateToMonth($current_date)."</td>";
                    echo "<td>".$current_date."</td>";

                    $current_date = DateWork::addDaysToDate($current_date, 1);

                    for($j = 0; $j < 3; $j++) {

                        $rowspan = 0;

                        foreach ($query as $key => $val) {
                            if(($val["date_start"] == $current_date) and ($val["pavilion_id"] == $j)) {
                                $rowspan = dateWork::getDaysCountBetwenDates($val["date_start"], $val["date_end"]) + 1;
                            }
                        }

                        if($rowspan != 0) {
                            $fio_q = mysqli_query($link, "SELECT fio FROM users WHERE user_id=" . $val["owner_id"]);
                            $fio_row = mysqli_fetch_array($fio_q);

                            echo '
                                <td rowspan="'.$rowspan.'">' . $val["class"] . '</td>
                                <td rowspan="'.$rowspan.'">' . $fio_row["fio"] . '</td>
                                <td rowspan="'.$rowspan.'">' . $val["work_type"] . '</td>
                            ';


                            if($_SESSION['admin'] == 1)
                            {
                                echo '
                                    <form method="post" action="editTableFieldPage.php">
                                      <input type="hidden" name="fieldId" value="'.$val["id"].'">
                                      <td><input type="submit" value="+"></td>
                                    </form>
                                     ';
                            }
                            else
                            {
                                echo '<td>-</td>';
                            }
                        }
                        else
                        {
                            echo '
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>                   
                            ';

                            if(isset($_SESSION['id']))
                            {
                                echo '
                                    <form action="tableRecordPage.php">
                                        <input type="hidden" name="date" value="' . $val["date_start"] . '">
                                        <input type="hidden" name="pav" value="' . ($j + 1) . '">
                                        <td><input type="submit" value="+"></td>
                                    </form>
                                ';
                            }
                            else
                            {

                            }
                        }
                    }

                    echo "</tr>";
                }


                mysqli_close($link);
            ?>
		</table>
	</body>
</html>