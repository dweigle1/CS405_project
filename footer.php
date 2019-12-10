<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>

<body>
	<div style="margin-top: 55px;">
	<?php
		session_start();
		if (isset($_SESSION['login_user']) && $_SESSION['login_user'] != '') {
			echo '<nav class="navbar fixed-bottom navbar-dark bg-dark footer-nav"><form action="#" 
				method="post"><input type="submit" name="logout" value="Logout" class="logout"/></form></nav>';
		}
		else
		{
			echo '<nav class="navbar fixed-bottom navbar-dark bg-dark footer-nav"><form action="#" 
				method="post"><input type="submit" name="login" value="Login" class="logout"/></form></nav>';
		}
	?>
	</div>
</body>

</html>