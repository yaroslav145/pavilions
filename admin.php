<?php
    session_start();

    if(!isset($_SESSION['id']))
        exit;
?>

<html>
    <head>
        <title>Admin page</title>
        <link rel="stylesheet" href="button.css">
        <link rel="stylesheet" href="body.css">
    </head>

    <style>
        .container {
            text-align: center;
            display: inline-block;
            vertical-align: middle;
            margin-top: 20%;
        }

        div
        {
            margin: 20px;
        }
    </style>


    <body>
        <div class="container">
            <div><a class="button28" href="exit.php">Выход</a></div>
            <div><a class="button28" href="regCode.php">Сгенерировать</a></div>

            <?php
                if(isset($_GET["code"]))
                {
                    echo $_GET["code"];
                }
            ?>

            <div><a class="button28" href="table.php">Таблица</a></div>
        </div>
    </body>
</html>