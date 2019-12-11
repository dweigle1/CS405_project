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

if(isset($_SESSION["login_user"])){
    
	$conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
	} else{
		
		$login = $_SESSION["login_user"];
		$sql = "SELECT DISTINCT Products.ProdName, Products.Price, Promotions.Discount as SalePrice FROM Products JOIN ShopsFor ON Products.PID = ShopsFor.PID AND ShopsFor.UserName = '".$login."' Left JOIN Promotions ON Promotions.PID = Products.PID Order BY ProdName ASC";	
		$result = mysqli_query($conn, $sql);
        $conn->close();

        echo "<br>";
        echo "<table border='1' style='width:100%'>";
        echo "<tr>";
        
        echo "<th>Product Name</th>";
        echo "<th>Price</th>";
        echo "<th>Discounted Price</th>";

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
}

?>

<form method="post" class="form-inline">
    <input class="form-control mr-sm-2" type="text" placeholder="Enter the Address" aria-label="placeOrder" name="placeOrder">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Submit Order</button>
</form>

<?php

if(isset($_POST["placeOrder"])){
    $conn = new mysqli($host, $username, $password, $dbname);
    $sql = "SELECT MAX(OrderID) FROM Orders;";	
    $result = mysqli_query($conn, $sql);
    $conn->close();
    $row = mysqli_fetch_assoc($result);
    $orderID = $row["MAX(OrderID)"] + 1;
    $today = date("y/m/d");
    $conn = new mysqli($host, $username, $password, $dbname);
    $sql = "INSERT INTO Orders ([OrderID], [status], [timeOrdered], [UserName], [Address]) VALUES (".$orderID.", 'Pending', ".$today.", ".$login.", ".$_POST["placeOrder"]")";
    mysqli_free_result($result); 
    if (mysqli_query($conn, $sql)) {
        echo "Successfully inserted product information!";
    } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    $conn->close();
}
?>



<?php include "footer.php"; ?>