<?php
    session_start();

    if($_SESSION['admin'] != 1)
        header("Location: table.php");

    require_once( "DBwork.php" );
    $link = mysqli_connect(DBwork::$ip, DBwork::$login, DBwork::$pass, "employment_schedule") or die (mysqli_error());

    if(isset($_POST["fieldId"]))
    {
        $field_id = mysqli_real_escape_string($link, $_POST["fieldId"]);
        $_SESSION["lastEditFieldId"] = $field_id;
    }
    else
    {
        $field_id = $_SESSION["lastEditFieldId"];
    }

    $query = mysqli_query($link, "SELECT * FROM pavilions WHERE id='".$field_id."'");

    mysqli_close($link);

    $row = mysqli_fetch_array($query);
?>


<html>
    <head>
        <title>Edit page</title>
        <link rel="stylesheet" href="button.css">
        <link rel="stylesheet" href="body.css">
        <link rel="stylesheet" href="div.css">
        <link rel="stylesheet" href="win.css">
    </head>

    <body>
        <div class="win">
            <form method="post" action="editTableRecord.php">
                <div>Дата начала</div>
                <div><input type="date" name="date_start" value="<?php echo $row["date_start"];?>"></div>
                <div>Продолжительность использования(дней),</div>
                <div>суббота и воскресенье не считаюся рабочим днем</div>
                <?php
                    echo '<div><input type="text" name="days" size="3" value="';
                    echo $row["days"];
                    echo '"></div>';
                ?>
                <div>Павильон</div>
                <div>
                    <input type="radio" name="pav" value=1 <?php if($row["pavilion_id"] == 0) {echo "checked";}?>>1
                    <input type="radio" name="pav" value=2 <?php if($row["pavilion_id"] == 1) {echo "checked";}?>>2
                    <input type="radio" name="pav" value=3 <?php if($row["pavilion_id"] == 2) {echo "checked";}?>>3
                </div>
                <div>Курс</div>
                <div>
                    <select name="course">
                    <?php
                        for($i = 1; $i <= 6; ++$i)
                        {
                            echo '<option ';
                            if($row["class"][0] == $i) {echo 'selected';}
                            echo ' value="'.$i.'">'.$i.'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div>Кафедра</div>

                <div><input type="text" size="30" name="class" value="<?php
                $row["class"] = mb_substr($row["class"], 3);
                echo $row["class"];?>"></div>

                <div>Вид работы</div>
                <div><input type="text" size="30" name="workType" value="<?php echo $row["work_type"];?>"></div>
                <div><input type="submit" value="Сохранить"></div>
            </form>

            <form method="post" action="deleteTableField.php">
                <div><input type="submit" value="Удалить"></div>
            </form>
            <?php if(isset($_GET["message"])) {echo '<div background="red">'.$_GET["message"].'</div>';}?>
        </div>
    </body>
</html>
