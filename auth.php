<?php
	$login = $_POST["login"];
	$pass = $_POST["pass"];
	
	$link = mysqli_connect("localhost", "root", "", "employment_schedule") or die (mysqli_error());
	
	$query = mysqli_query($link, "SELECT * FROM users WHERE login = '".$login."' AND password = '".$pass."'");

    mysqli_close($link);

	if(mysqli_num_rows($query) > 0)
	{	
		$row = mysqli_fetch_array($query);

        session_start();
        $_SESSION['admin'] = $row["admin"];
        $_SESSION['id'] = $row["user_id"];

		if($_SESSION['admin'] == 1)
        {
            header("Location: admin.php");
        }
		else
        {
            header("Location: table.php");
        }
	}
	else
	{
		header("Location: loginPage.php?bad=1");
	}
?>