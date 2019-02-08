<?php
    require_once( "DBwork.php" );
    $link = mysqli_connect(DBwork::$ip, DBwork::$login, DBwork::$pass, "employment_schedule") or die (mysqli_error());
        session_start();

    $query = mysqli_query($link, "SELECT * FROM pavilions WHERE id=".$_SESSION["lastEditFieldId"]);

    if($row = mysqli_fetch_array($query))
    {
        if($_SESSION['admin'] == 1)
        {
            $query = mysqli_query($link, "DELETE FROM pavilions WHERE id=".$_SESSION["lastEditFieldId"]);
            $_SESSION["lastEditFieldId"] = -1;
        }
    }

    mysqli_close($link);

    header("Location: table.php");
?>