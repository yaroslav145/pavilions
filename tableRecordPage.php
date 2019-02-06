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
                <div><input type="date" name="date_start" value="<?php if(isset($_GET["date_start"])) {echo $_GET["date_start"];}?>"></div>
                <div><input type="date" name="date_end" value="<?php if(isset($_GET["date_end"])) {echo $_GET["date_end"];}?>"></div>
                Павильон
                <div>
                    <input type="radio" name="pav" value=1 <?php if(isset($_GET["pav"]) && ($_GET["pav"] == 1)) {echo "checked";}?>>1
                    <input type="radio" name="pav" value=2 <?php if(isset($_GET["pav"]) && ($_GET["pav"] == 2)) {echo "checked";}?>>2
                    <input type="radio" name="pav" value=3 <?php if(isset($_GET["pav"]) && ($_GET["pav"] == 3)) {echo "checked";}?>>3
                </div>
                Курс, кафедра
                <div><input type="text" size="30" name="class" value="<?php if(isset($_GET["class"])) {echo $_GET["class"];}?>"></div>
                Вид работы
                <div><input type="text" size="30" name="workType" value="<?php if(isset($_GET["wt"])) {echo $_GET["wt"];}?>"></div>
                <div><input type="submit" value="Добавить"></div>
                <?php if(isset($_GET["class"])) {echo "Занято";}?>
            </form>
        </div>
    </body>
</html>