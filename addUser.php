<?php
    session_start();

    if(!isset($_SESSION['id']))
        exit;

    require_once( "DBwork.php" );

    $link = mysqli_connect(DBwork::$ip, DBwork::$login, DBwork::$pass, "employment_schedule") or die (mysqli_error());

    $login = mysqli_real_escape_string($link, $_POST["login"]);
    $pass = mysqli_real_escape_string($link, $_POST["pass"]);

    $fio = mysqli_real_escape_string($link, $_POST["fio"]);
    $fio = XSSWork::noXSS($fio);

    $code = mysqli_real_escape_string($link, $_POST["code"]);


    $query = mysqli_query($link, "SELECT * FROM users WHERE login = '".$login."'");

    if(mysqli_num_rows($query) == 0)
    {
        $query = mysqli_query($link, "SELECT * FROM reg_codes WHERE code = '".$code."'");

        if(mysqli_num_rows($query) > 0) {
            $query = mysqli_query($link, "INSERT INTO users (user_id, login, password, admin, fio) VALUES(NULL, '" . $login . "', '" . $pass . "', 0, '" . $fio . "')");

            $query = mysqli_query($link, "DELETE FROM reg_codes WHERE code = '".$code."'");

            header("Location: table.php");
        }
        else
        {
            echo "Неправильный регистрационный код";
        }
    }
    else
    {
        echo "Такое имя уже существует";
    }

    mysqli_close($link);
?>