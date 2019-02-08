<?php
    session_start();

    if($_SESSION['admin'] != 1)
        header("Location: table.php");

    require_once("DateWork.php");
    require_once( "DBwork.php" );
    require_once("XSSWork.php");

    $link = mysqli_connect(DBwork::$ip, DBwork::$login, DBwork::$pass, "employment_schedule") or die (mysqli_error());

    $date_start = mysqli_real_escape_string($link, $_POST["date_start"]);
    $date_start = XSSWork::noXSS($date_start);

    $days = mysqli_real_escape_string($link, $_POST["days"]);
    $days = XSSWork::noXSS($days);

    $course = mysqli_real_escape_string($link, $_POST["course"]);
    $course = XSSWork::noXSS($course);

    $pav = mysqli_real_escape_string($link, $_POST["pav"]);
    $pav = XSSWork::noXSS($pav);

    $class = mysqli_real_escape_string($link, $_POST["class"]);
    $class = XSSWork::noXSS($class);

    $workType = mysqli_real_escape_string($link, $_POST["workType"]);
    $workType = XSSWork::noXSS($workType);

    if(($days < 1) || ($days > 100) || ($pav < 1) || ($pav > 3))
    {
        echo "Неверно установлены параметры";
        exit;
    }

    if(($pav == 1) || ($pav == 2))
    {
        /*if($days != 6)
        {
            header("Location: editTableRecordPage.php?message=В 1 и 2 павильоне можно зарезервировать только 6 дней");
            exit;
        }*/
    }


    $pav--;


    $date_end = DateWork::addDaysToDate($date_start, $days - 1);

    $query = mysqli_query($link, "SELECT * FROM pavilions WHERE
    (('".$date_start."' between date_start and date_end) or 
    ('".$date_end."' between date_start and date_end) or 
    (date_start between '".$date_start."' and '".$date_end."')) AND 
    pavilion_id='".$pav."' AND id <> '" . $_SESSION["lastEditFieldId"] . "'");


    if(mysqli_num_rows($query) == 0)
    {
        $query = mysqli_query($link, "SELECT * FROM pavilions WHERE id='" . $_SESSION["lastEditFieldId"] . "'");

        if(mysqli_num_rows($query) == 1)
        {
            $row = mysqli_fetch_array($query);

            $query = mysqli_query($link, "UPDATE pavilions SET date_start='".$date_start."', date_end='".$date_end."',
            class='".($course.", ". $class)."', pavilion_id='".$pav."', work_type='".$workType."', days='".$days."', work_type='".$workType."'
            WHERE id='".$_SESSION["lastEditFieldId"]."'");

            $_SESSION["lastEditFieldId"] = -1;
        }
    }
    else
    {
        header("Location: editTableRecordPage.php?message=Занято");
        exit;
    }


    mysqli_close($link);

    header("Location: table.php");
?>