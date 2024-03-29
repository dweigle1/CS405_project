<!DOCTYPE html>

<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['logout']))
{
	session_destroy();
	header ("Location: index.php");
}
else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login']))
{
	header ("Location: login.php");
}

?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>ToyzRus</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/custom-css.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark main-nav">
  <a class="navbar-brand" href="./">
  <img src="./images/logo.png" width="40" height="40" alt="">
  ToyzRus
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
  
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
      </li>
	  
	  <?php 
		if(isset($_SESSION["login_user"])){
			if($_SESSION["login_role"] == "Manager")
			{
				echo '<li class="nav-item"><a class="nav-link" href="./staff.php">Staff</a></li>';
				echo '<li class="nav-item"><a class="nav-link" href="./StaffOrders.php">Ship Orders</a></li>';
				echo '<li class="nav-item"><a class="nav-link" href="./promotions.php">Set Promotions</a></li>';
				echo '<li class="nav-item"><a class="nav-link" href="./Stats.php">Sales Statistics</a></li>';
			}
			else if($_SESSION["login_role"] == "Staff")
			{
				echo '<li class="nav-item"><a class="nav-link" href="./staff.php">Staff</a></li>';
				echo '<li class="nav-item"><a class="nav-link" href="./StaffOrders.php">View Orders</a></li>';
				
			}
			echo '<li class="nav-item active"><a class="nav-link" href="gatherCart.php">Cart <span class="sr-only">(current)</span></a></li>';
			 echo '<li class="nav-item active"><a class="nav-link" href="CustOrders.php">View Orders <span class="sr-only">(current)</span></a></li>';

		}
	?>
    </ul>
	
    <form action="gatherItems.php" method="post" class="form-inline">
		<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="Search">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form>
	<?php 
	if(isset($_SESSION["login_user"])){
		echo '<a class="navbar-brand" href="#"><img src="./images/user.png" width="40" height="40" alt=""></a>';
		echo '<span class="navbar-text" style="margin-bottom:5px; margin-left:-15px;">'; 
		echo $_SESSION["login_user"];
		echo '</span>';
	}
	?>
  </div>
</nav>
</html>

