<?php include "header.php"; ?>

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

if(isset($_POST["Search"])){
	$conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
		
		$Search = $_POST["Search"];
		$query = "SELECT ProdName, Price FROM Products WHERE ProdName LIKE '%".$Search."%' OR Keyword LIKE '%".$Search."%'";	
		
		$result = mysqli_query($conn, $query);		
		$number = mysqli_num_rows($result);
          $row = mysqli_fetch_row($result);
          $conn->close();		
    }
}
?>

<?php include "footer.php";?>