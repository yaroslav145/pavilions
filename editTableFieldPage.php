<?php
    session_start();

    $field_id = $_POST["fieldId"];
    $_SESSION["lastEditFieldId"] = $field_id;

    $link = mysqli_connect("localhost", "root", "", "employment_schedule") or die (mysqli_error());

    $query = mysqli_query($link, "SELECT * FROM pavilions WHERE id=".$field_id);

    mysqli_close($link);

    $row = mysqli_fetch_array($query);

    $row["pavilion_id"]++;

    if(($_SESSION['id'] != $row["owner_id"]) && ($_SESSION['admin'] != 1))
        header("Location: table.php");
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
                <div><input type="date" name="date" value="<?php echo $row["date"];?>"></div>
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
            </form>
            <form method="post" action="deleteTableField.php">
                <div><input type="submit" value="Удалить"></div>
            </form>
        </div>
    </body>
</html>
