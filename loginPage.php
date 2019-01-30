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
			<form method="post" action="auth.php">
				Логин
                <div><input href="#" type="text" size="30" name="login"></div>
				Пароль
                <div><input href="#" type="password" size="30" name="pass"></div>
                <div><input type="submit" value="Вход"></div>
			</form>
			<?php
				if(isset($_GET["bad"]))
				{
					if($_GET["bad"] == 1)
					{
						echo "Неверный логин/пароль";
					}
				}
			?>
		</div>
	</body>
</html>