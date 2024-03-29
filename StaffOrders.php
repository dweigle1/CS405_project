<?php include "header.php"; ?>

<?php
$host = "158.69.195.142";
$username = "test";
$password = "X8g$4eX5MJ6A";
$dbname = "TOYZ";
$ip_server = $_SERVER['SERVER_ADDR'];


if ($ip_server == $host)
	$username = "root";

$conn = new mysqli($host,$username,$password, $dbname);
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
} else {

function ship($OrderID,$conn)
{
	$sql = "UPDATE Orders SET status = 'Shipped' WHERE OrderID = '$OrderID'";
	$result = mysqli_query($conn, $sql);
	$sql = "SELECT PID, Quantity FROM OrderProducts WHERE OrderID = '$OrderID'";

 	$result = mysqli_query($conn, $sql);
    
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)){
			$soldQuantity = $row["Quantity"];
			$PID = $row["PID"];
			$sql = "SELECT Quantity FROM Products WHERE PID = '$PID'";
			$result = mysqli_query($conn, $sql);
    			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)){
					$Quantity = $row["Quantity"];
				}
			}
			$newQuantity = $Quantity - $soldQuantity;

			$sql = "UPDATE Products SET Quantity = '$newQuantity' WHERE PID = '$PID' ";
			$result = mysqli_query($conn, $sql);
		}
	}
}

function hasInv($pid,$num,$conn)
{
	
    $check = 1;
    $sql = "SELECT Quantity FROM Products WHERE PID = '$pid'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
       while ($row = mysqli_fetch_assoc($result)){
       	if ($row["Quantity"] < $num){
		$check = 0;
	}
	}
    }
    return $check;
 
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
      if($_POST["HasEnough"])
            ship($_POST["OrderID"],$conn);
      else
            echo "Order not possible";
}


function showComponents($OrderID,$conn)
{
	
    $check = 1;
    $price = 0;
    
    $sql = "SELECT ProdName, Price, o.Quantity, o.PID FROM OrderProducts o, Products p WHERE o.OrderID = '$OrderID' and o.PID = p.PID";
    
    $result = mysqli_query($conn, $sql);
     
    echo "<table border='1' style='width:100%' class='table'>";
    echo "<thead class='thead-dark'><tr>";
    echo "<th>Product Name</th>";
    echo "<th>Price</th>";
    echo "<th>Discount per item</th>";
    echo "<th>Quantity</th>";
    echo "</tr></thead>";

    if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
		$pid = $row["PID"];
		$discount = 0;
		$discountQ = mysqli_query($conn,"SELECT Discount FROM Promotions WHERE PID = '$pid'");
		
		if (mysqli_num_rows($discountQ) > 0) {	
			$discount = mysqli_fetch_assoc($discountQ)["Discount"]; 		
		}
            	//echo "Product Name: " . $row["ProdName"]. " - Price: " . $row["Price"]. " - Quantity: " . $row["Quantity"]. "<br>";
		echo "<tr>";
		echo "<td>" . $row["ProdName"]. "</td>";
		echo "<td>" . $row["Price"]. "</td>";
		echo "<td>" . $discount . "</td>";
		echo "<td>" . $row["Quantity"]. "</td>";

		echo "</tr>";
		$price += ($row["Price"] * $row["Quantity"]) - ($row["Quantity"] * $discount);

            	$check *= hasInv($row["PID"],$row["Quantity"],$conn);
	    }
	echo "</table>";
	    
	echo "<table border='1' style='width:50%' class='table'>";
	echo "<thead class='thead-dark'><tr>";
	echo "<th>Total Price</th>";
	echo "<td>" . $price . "</td>";
	echo "</tr></thead>";
	echo "</table>";
        //echo "Total Price: " . $price. "<br>";
    }
?>
<form action="StaffOrders.php" method="post" class="form-inline">
	<input type="hidden" name = "OrderID" value = "<?= $OrderID?>">
	<input type="hidden" name = "HasEnough" value = "<?= $check ?>">
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ship Order</button>
</form>

<?php
     
    return $check;

	 
}


$check = 1;
$sql = "SELECT OrderID, UserName, Address FROM Orders WHERE Status = 'Pending' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
	$check = 1;
	
	echo "<br>";
	echo "<table border='1' style='width:50%' class='table'>";
	echo "<thead class='thead-dark'><tr>";
	echo "<th>OrderID</th>";
	echo "<th>User</th>";
	echo "<th>Address</th>";
	echo "</tr></thead>";
	echo "<tr>";
	echo "<td>" . $row["OrderID"]. "</td>";
	echo "<td>" . $row["UserName"]. "</td>";
	echo "<td>" . $row["Address"]. "</td>";
	echo "</tr>";
        echo "</table>";
	 
	$check = showComponents($row["OrderID"],$conn);
	/*
        ?>
        <form action ="ShipOrder.php" method = "POST">
            <input type="hidden" name = "OrderID" value = "<?= $row["OrderID"]?>">
            <input type="hidden" name = "HasEnough" value = "<?= $check?>">
	    <input type="hidden" name = "Connection" value = "<?= $conn?>">
            <input type="Ship It">
        </form>
	<?php 
	*/
    }
} else {
    echo "No Pending Orders";
}
 
}
?>

<?php include "footer.php"; ?>
