<?php include "header.php"; ?><h2>Add a user</h2>

    <form method="post">
    	<label for="firstname">First Name</label>
    	<input type="text" name="firstname" id="firstname">
    	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" id="lastname">
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
	    $result = mysqli_query($conn,"SELECT * FROM User");
	    $row = mysqli_num_rows($result);
	    $sql = "INSERT INTO User (Uid, FirstName, LastName, Password) VALUES ('".$row."', '".$_POST["firstname"]."', '".$_POST["lastname"]."', '".$_POST["password"]."')";
	    mysqli_free_result($result); 
	    if (mysqli_query($conn, $sql)) {
               echo "New record created successfully, Your User ID is: $row";
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
       	        
	    }
}
?>
<?php include "footer.php";?>
