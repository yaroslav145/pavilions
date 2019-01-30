<?php
    session_start();

    if(!isset($_SESSION['id']))
        exit;

    $date = $_POST["date"];
    $pav = $_POST["pav"];
    $class = $_POST["class"];
    $workType = $_POST["workType"];

    $link = mysqli_connect("localhost", "root", "", "employment_schedule") or die (mysqli_error());

    $pav--;

    $query = mysqli_query($link, "SELECT * FROM pavilions WHERE date='".$date."' AND pavilion_id=".$pav);

    if((mysqli_num_rows($query) == 0) && ($pav <= 2) && (($pav >= 0)))
    {
        $query = mysqli_query($link, "INSERT INTO pavilions (date, class, work_type, owner_id, pavilion_id, id) VALUES('" . $date . "', '" . $class . "', '" . $workType . "', '" . $_SESSION["id"] . "', '" . $pav . "', NULL)");

        header("Location: table.php");
    }
    else
    {
        header("Location: tableRecordPage.php?class=".$class."&wt=".$workType);
    }

    mysqli_close($link);
?>