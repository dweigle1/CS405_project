<?php include "header.php"; ?>

<?php
$host = "158.69.195.142";
$username = "test";
$password = "X8g$4eX5MJ6A";
$dbname = "TOYZ";

$ip_server = $_SERVER['SERVER_ADDR']; 

if($ip_server == "158.69.195.142")
{
	$username = "root";
}

if(isset($_SESSION["login_user"])){
    
	$conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
	} else{
		
		echo '<form method="post" class="form-inline">
			<input class="form-control mr-sm-2" type="text" placeholder="Enter the Address" aria-label="placeOrder" name="placeOrder">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Submit Order</button>
		</form>';
		
		$login = $_SESSION["login_user"];
		$sql = "SELECT Products.ProdName, Products.Price, Promotions.Discount as SalePrice FROM Products JOIN ShopsFor ON Products.PID = ShopsFor.PID AND ShopsFor.UserName = '".$login."' Left JOIN Promotions ON Promotions.PID = Products.PID Order BY ProdName ASC";	
		$result = mysqli_query($conn, $sql);
        $conn->close();

        echo "<br>";
        echo "<table border='1' style='width:80%; margin: 0 auto;' class='table'>";
        echo "<tr><thead class='thead-dark'>";
        
        echo "<th>Product Name</th>";
        echo "<th>Price</th>";

        echo "</tr></thead>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>". $row["ProdName"] ."</td>";
			echo "<td>". ($row["SalePrice"] == NULL ? $row["Price"] : $row["SalePrice"]) ."</td>";
            echo "</tr>";
        }
        echo "</table>";		
    }
}

?>

<?php

if(isset($_POST["placeOrder"]))
{
	##Create SQL Connection
    $conn = new mysqli($host, $username, $password, $dbname);
	
	##Get new OrderID
    $sql = "SELECT MAX(OrderID) FROM Orders;";	
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
	$orderID = $row["MAX(OrderID)"] + 1;
	mysqli_free_result($result);
	
	##Insert Order info into Orders
    $today = date("Y-m-d H:i:s");
    $sql = "INSERT INTO Orders (OrderID, status, timeOrdered, UserName, Address) VALUES ('".$orderID."', 'Pending', '".$today."', '".$login."', '".$_POST["placeOrder"]."')";
	mysqli_query($conn, $sql);
	
	##Insert cart into OrderProducts
	$sql = "select PID, count(*) AS Cnt from ShopsFor WHERE UserName = '" . $login . "' group by PID;";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_row($result)) 
	{
		$sql = "INSERT INTO OrderProducts (OrderID, Quantity, PID) VALUES ('" . $orderID ."', '" . $row[1] . "', '" . $row[0] . "');";
		mysqli_query($conn, $sql);
	}
	mysqli_free_result($result);
	
    ##Delete cart
	$sql = "DELETE FROM ShopsFor WHERE UserName = '".$login."'";
	mysqli_query($conn, $sql);
	
	echo "Successfully inserted product information!";
	
    $conn->close();
	##header("Refresh:0");
}
?>



<?php include "footer.php"; ?>