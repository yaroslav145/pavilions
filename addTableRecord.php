<?php
    session_start();

    if(!isset($_SESSION['id']))
        exit;

    $date_start = $_POST["date_start"];
    $date_end = $_POST["date_end"];
    $pav = $_POST["pav"];
    $class = $_POST["class"];
    $workType = $_POST["workType"];

    require_once( "DBwork.php" );

    $link = mysqli_connect(DBwork::$ip, DBwork::$login, DBwork::$pass, "employment_schedule") or die (mysqli_error());

    $pav--;

    $query = mysqli_query($link, "SELECT * FROM pavilions WHERE date_start='".$date_start."' AND pavilion_id=".$pav);

    if((mysqli_num_rows($query) == 0) && ($pav <= 2) && (($pav >= 0)))
    {
        $query = mysqli_query($link, "INSERT INTO pavilions (date_start, date_end, class, work_type, owner_id, pavilion_id, id) VALUES('" . $date_start . "', '" . $date_end . "', '" . $class . "', '" . $workType . "', '" . $_SESSION["id"] . "', '" . $pav . "', NULL)");

        header("Location: table.php");
    }
    else
    {
        header("Location: tableRecordPage.php?class=".$class."&wt=".$workType);
    }

    mysqli_close($link);
?>