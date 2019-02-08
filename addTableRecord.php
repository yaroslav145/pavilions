<?php
    session_start();

    if(!isset($_SESSION['id']))
        exit;

    require_once("DateWork.php");
    require_once( "DBwork.php" );

    $link = mysqli_connect(DBwork::$ip, DBwork::$login, DBwork::$pass, "employment_schedule") or die (mysqli_error());

    $date_start = mysqli_real_escape_string($link, $_POST["date_start"]);
    $days = mysqli_real_escape_string($link,$_POST["days"]);
    $pav = mysqli_real_escape_string($link,$_POST["pav"]);
    $class = mysqli_real_escape_string($link,$_POST["class"]);
    $workType = mysqli_real_escape_string($link,$_POST["workType"]);

    if(($days < 1) || ($pav < 1) || ($pav > 3) || (strtotime(date('Y-m-d')) > strtotime($date_start)))
    {
        echo "Неверно установлены параметры, возможно вы указали дату меньше сегодняшней";
        exit;
    }



    $pav--;

    $date_end = DateWork::addDaysToDate($date_start, $days - 1);

    $query = mysqli_query($link, "SELECT * FROM pavilions WHERE
    (('".$date_start."' between date_start and date_end) or 
    ('".$date_end."' between date_start and date_end) or 
    (date_start between '".$date_start."' and '".$date_end."')) AND 
    pavilion_id=".$pav);

    if(mysqli_num_rows($query) == 0)
    {
        $query = mysqli_query($link, "INSERT INTO pavilions (date_start, date_end, class, work_type, owner_id, pavilion_id, id, days) VALUES('" . $date_start . "', '" . $date_end . "', '" . $class . "', '" . $workType . "', '" . $_SESSION["id"] . "', '" . $pav . "', NULL, '" . $days . "')");

        header("Location: table.php");
    }
    else
    {
        header("Location: tableRecordPage.php?class=".$class."&wt=".$workType."&days=".$days."&date_start=".$date_start."&pav=".($pav + 1));
    }

    mysqli_close($link);
?>