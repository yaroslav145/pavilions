<?php
    $link = mysqli_connect("localhost", "root", "", "employment_schedule") or die (mysqli_error());

    $rand_str = substr(md5(microtime()),rand(0,26),15);
    $query = mysqli_query($link, "INSERT INTO reg_codes (code_id, code) VALUES(NULL, '".$rand_str."')");

    mysqli_close($link);

    header("Location: admin.php?code=".$rand_str);
?>