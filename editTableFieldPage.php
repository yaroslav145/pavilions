<?php
    session_start();

    $field_id = $_POST["fieldId"];
    $_SESSION["lastEditFieldId"] = $field_id;

    require_once( "DBwork.php" );

    $link = mysqli_connect(DBwork::$ip, DBwork::$login, DBwork::$pass, "employment_schedule") or die (mysqli_error());

    $query = mysqli_query($link, "SELECT * FROM pavilions WHERE id=".$field_id);

    mysqli_close($link);

    $row = mysqli_fetch_array($query);

    $row["pavilion_id"]++;

    if($_SESSION['admin'] != 1)
        header("Location: table.php");

    /*<form method="post" action="editTableRecord.php">
                <div><input type="date" name="date_start" value="<?php echo $row["date_start"];?>"></div>
                <div><input type="date" name="date_end" value="<?php echo $row["date_end"];?>"></div>
                Павильон
                <div>
                    <input type="radio" name="pav" value=1 <?php if($row["pavilion_id"] == 1) {echo "checked";}?>>1
                    <input type="radio" name="pav" value=2 <?php if($row["pavilion_id"] == 2) {echo "checked";}?>>2
                    <input type="radio" name="pav" value=3 <?php if($row["pavilion_id"] == 3) {echo "checked";}?>>3
                </div>
                Курс, кафедра
                <div><input type="text" size="30" name="class" value="<?php echo $row["class"];?>"></div>
                Вид работы
                <div><input type="text" size="30" name="workType" value="<?php echo $row["work_type"];?>"></div>
                <div><input type="submit" value="Изменить"></div>
            </form>*/
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
            <form method="post" action="deleteTableField.php">
                <div><input type="submit" value="Удалить"></div>
            </form>
        </div>
    </body>
</html>
