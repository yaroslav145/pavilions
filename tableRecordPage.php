<html>
    <head>
        <title>Login page</title>
        <link rel="stylesheet" href="button.css">
        <link rel="stylesheet" href="body.css">
        <link rel="stylesheet" href="div.css">
        <link rel="stylesheet" href="win.css">
    </head>

    <body>
        <div class="win">
            <form method="post" action="addTableRecord.php">
                <div>Дата начала</div>
                <div><input type="date" name="date_start" value="<?php if(isset($_GET["date_start"])) {echo $_GET["date_start"];}?>"></div>
                <div>Продолжительность использования(дней),</div>
                <div>суббота и воскресенье не считаюся рабочим днем</div>
                <?php
                    echo '<div><input type="text" name="days" size="3" value="';
                    if (isset($_GET["days"]))
                    {
                        echo $_GET["days"];
                    }
                    echo '"></div>';
                ?>
                <div>Павильон</div>
                <div>
                    <input type="radio" name="pav" value=1 <?php if(isset($_GET["pav"]) && ($_GET["pav"] == 1)) {echo "checked";}?>>1
                    <input type="radio" name="pav" value=2 <?php if(isset($_GET["pav"]) && ($_GET["pav"] == 2)) {echo "checked";}?>>2
                    <input type="radio" name="pav" value=3 <?php if(isset($_GET["pav"]) && ($_GET["pav"] == 3)) {echo "checked";}?>>3
                </div>
                <div>Курс</div>
                <div>
                    <select name="course" ">
                    <?php
                        for($i = 1; $i <= 6; ++$i)
                        {
                            echo '<option ';
                            if(isset($_GET["course"]) && ($_GET["course"] == $i)) {echo 'selected';}
                            echo ' value="'.$i.'">'.$i.'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div>Кафедра</div>
                <div><input type="text" size="30" name="class" value="<?php if(isset($_GET["class"])) {echo $_GET["class"];}?>"></div>
                <div>Вид работы</div>
                <div><input type="text" size="30" name="workType" value="<?php if(isset($_GET["wt"])) {echo $_GET["wt"];}?>"></div>
                <div><input type="submit" value="Добавить"></div>
                <?php if(isset($_GET["message"])) {echo $_GET["message"];}?>
            </form>
        </div>
    </body>
</html>