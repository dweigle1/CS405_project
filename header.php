<!DOCTYPE html>

<?php
session_start();

if (!(isset($_SESSION['login_user']) && $_SESSION['login_user'] != '') && basename($_SERVER['PHP_SELF']) != 'login.php') {
	header ("Location: login.php");
}
else
{
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
    {
        session_start();
		session_destroy();
		header ("Location: login.php");
    }
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
  <a class="navbar-brand" href="./">ToyzRus</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
  
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
    </ul>
	
    <form class="form-inline">
		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form>
	<?php 
	if(isset($_SESSION["login_user"])){
		echo '<a class="navbar-brand" href="#"><img src="http://caro256.cs.uky.edu/CS405_project/images/user.png" width="40" height="40" alt=""></a>';
		echo '<span class="navbar-text">'; 
		echo $_SESSION["login_user"];
		echo '</span>';
	}
	?>
  </div>
</nav>
</html>

