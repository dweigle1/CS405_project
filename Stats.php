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

<form method="post">
	
	<input type="submit" name="Week" value="Show this week's stats">
	<input type="submit" name="Month" value="Show this month's stats">
	<input type="submit" name="Month" value="Show this year's stats">
</form>

<?php
$conn = new mysqli($host, $username, $password, $dbname);

select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 12 MONTH) and CURRENT_TIMESTAMP;


	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
		
	    if(isset($_POST["Week"])){
			$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 WEEK) and CURRENT_TIMESTAMP;";
	
}
		if(isset($_POST["Month"])){
			$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 MONTH) and CURRENT_TIMESTAMP;";
	
}
		if(isset($_POST["Year"])){
			$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 YEAR) and CURRENT_TIMESTAMP;";
	
}
		
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


