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
?>

<?php
$conn = new mysqli($host, $username, $password, $dbname);


	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
	    
		$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products LEFT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID;";
		$result = mysqli_query($conn, $sql);
		echo "<br>";
		echo "<table border='1' style='width:100%'>";
		echo "<tr>";

		echo "<th>OrderID</th>";
		echo "<th>timeOrdered</th>";
		echo "<th>ProdName</th>";
		echo "<th>Quantity</th>";

		echo "</tr>";
		while ($row = mysqli_fetch_assoc($result)) {
    	echo "<tr>";
    	foreach ($row as $field => $value) { 
        echo "<td>" . $value . "</td>";
		}
    	echo "</tr>";
		}
		echo "</table>";
		
       	        
	    }




?>