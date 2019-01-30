<?php
    $login = $_POST["login"];
    $pass = $_POST["pass"];
    $fio = $_POST["fio"];
    $code = $_POST["code"];

    $link = mysqli_connect("localhost", "root", "", "employment_schedule") or die (mysqli_error());

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