<?php
    require_once( "DBwork.php" );
    $link = mysqli_connect(DBwork::$ip, DBwork::$login, DBwork::$pass, "employment_schedule") or die (mysqli_error());

    $date_start = mysqli_real_escape_string($link, $_POST["date_start"]);
    $date_end = mysqli_real_escape_string($link, $_POST["date_end"]);
    $pav = mysqli_real_escape_string($link, $_POST["pav"]);
    $class = mysqli_real_escape_string($link, $_POST["class"]);
    $workType = mysqli_real_escape_string($link, $_POST["workType"]);

    session_start();

    $pav--;

    $query = mysqli_query($link, "SELECT * FROM pavilions WHERE id=".$_SESSION["lastEditFieldId"]);

    if((mysqli_num_rows($query) == 1) && ($pav <= 2) && (($pav >= 0)))
    {
        $row = mysqli_fetch_array($query);

        if(($row["owner_id"] == $_SESSION["id"]) ||($_SESSION['admin'] == 1))
        {
            $query = mysqli_query($link, "UPDATE pavilions SET date_start='".$date_start."', date_end='".$date_end."', class='".$class."', pavilion_id='".$pav."', work_type='".$workType."' 
            WHERE id=".$_SESSION["lastEditFieldId"]);
        }
    }

    mysqli_close($link);

    header("Location: table.php");
?>