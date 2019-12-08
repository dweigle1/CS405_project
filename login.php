<?php include "header.php"; ?>
<link rel="stylesheet" href="css/login.css" />
	
	<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="../CS405_project/images/logo.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form method="post">
      <input type="text" id="userID" class="fadeIn second" name="userID" placeholder="username">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth login-input" value="Log In" name="Login">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="../CS405_project/create.php">Create Account</a>
    </div>

  </div>
</div>

    <?php include "footer.php"; ?>
<?php
$host = "158.69.195.142";
$username = "test";
$password = "password";
$dbname = "TOYZ";

$ip_server = $_SERVER['SERVER_ADDR']; 

if($ip_server == "158.69.195.142")
{
	$username = "root";
}

if(isset($_POST["Login"])){
	$conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
		
		$name = $_POST["userID"];
		$password = $_POST["password"];
		$query = "SELECT UserName, Role FROM Users WHERE UserName = '".$name."' AND  Password = '".$password."'";	
		
		$result = mysqli_query($conn, $query);		
		$number = mysqli_num_rows($result);
		$row = mysqli_fetch_row($result);
		
		$conn->close();
		if($number > 0 ){
			session_start();
			$_SESSION['login_user'] = $row[0];
			$_SESSION['login_role'] = $row[1];
	       	header("Location: ../CS405_project/"); 
			exit();
	   	} else {
		   echo "The username or password you entered was incorrect!";
		}
    }
}
?>
