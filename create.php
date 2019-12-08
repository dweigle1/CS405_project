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
      <input type="text" id="UserName" class="fadeIn second" name="UserName" placeholder="username">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
	  <input type="text" id="firstname" class="fadeIn second" name="firstname" placeholder="first name">
	  <input type="text" id="lastname" class="fadeIn second" name="lastname" placeholder="last name">
	  <select name="role">
		  <option value="Customer">Customer</option>
		  <option value="Staff">Staff</option>
		  <option value="Manager">Manager</option>
		</select> 
      <input type="submit" class="fadeIn fourth login-input" value="Create Account" name="submit">
    </form>

  </div>
</div>

    <a href="index.php">Back to home</a>
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

if(isset($_POST["submit"])){
	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
	   
	    $query = "INSERT INTO Users (UserName, FirstName, LastName, Password, Role) VALUES ('".$_POST["UserName"]."', '".$_POST["firstname"]."', '".$_POST["lastname"]."', '".$_POST["password"]."', '".$_POST["role"]."')";
	    $result = mysqli_query($conn, $query);
		
		$conn->close();
	    if ($result) {
            session_start();
			$_SESSION['login_user'] = $_POST["UserName"];
			$_SESSION['login_role'] = 'Customer';
	       	header("Location: ../CS405_project/"); 
			exit();
        } 
		else {
            echo "Error: UserName Already exists! Try again ";
	    }
	}
}
?>
<?php include "footer.php";?>
