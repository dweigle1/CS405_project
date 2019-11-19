<?php include "header.php"; ?><h2>Add a new staff member</h2>

    <form method="post">
    	<label for="firstname">First Name</label>
    	<input type="text" name="firstname" id="firstname">
    	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" id="lastname">
	<label for="UserName"> UserName </label>
        <input type="text" name="UserName" id="UserName">
	<label for="password">Password </label>
	<input type="password" name="password" id="password">
	<input type="submit" name="submit" value="Submit">
    </form>

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
	   
	    $sql = "INSERT INTO Users (UserName, FirstName, LastName, Password, Role) VALUES ('".$_POST["UserName"]."', '".$_POST["firstname"]."', '".$_POST["lastname"]."', '".$_POST["password"]."', 'Staff')";
	    mysqli_free_result($result); 
	    if (mysqli_query($conn, $sql)) {
               echo "New record created successfully, Your UserName is: ".$_POST["UserName"]."";
            } else {
               echo "Error: UserName Already exists! Try again ";
	    }
		
            $conn->close();
       	        
	    }
}
?>
<?php include "footer.php";?>
