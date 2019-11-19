<?php include "header.php"; ?><h2>Log in</h2>

    <form method="post">
    	<label for="userID">User Name</label>
    	<input type="text" name="userID" id="userID">
    	<label for="password">Password</label>
    	<input type="password" name="password" id="password">
    	<input type="submit" name="Login" value="log in">
    </form>

    <a href="index.php">Back to home</a>

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
		$query = "SELECT UserName, Password FROM Users WHERE UserName = '".$name."' AND  Password = '".$password."'";	
		//echo "$query";	
		
		$result = mysqli_query($conn, $query);		
		$number = mysqli_num_rows($result); 
		if($number > 0 ){
	       	   echo "Logged in!";	
	   	} else {
		   echo "The username or password are incorrect!";
	    
		}
            $conn->close();

            }
}
?>
