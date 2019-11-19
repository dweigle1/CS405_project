<?php include header.php ?>

<?php
$host = "158.69.195.142";
$username = "test";
$password = "password";
$dbname = "TOYZ";
$ip_server = $_SERVER['SERVER_ADDR'];

if ($ip_server == $host)
	$username = "root";

$conn = new mysqli($host,$username,$password, $dbname);
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
} else {


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


function showComponents($OrderID,$conn)
{
    $check = 1;
    $price = 0;
    
    $sql = "SELECT ProdName, Price, o.Quantity, o.PID FROM OrderProducts o, Products WHERE o.OrderID = '$OrderID' ";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "Product Name: " . $row["ProdName"]. " - Price: " . $row["Price"]. " - Quantity: " . $row["o.Quantity"]. "<br>";
            $price += $row["Price"] * $row["o.Quantity"];
            $check *= hasInv($row["PID"],$row["o.Quantity"],$conn);
        }
        echo "Total Price: " . $price. "<br>";
    }
     
    return $check;
}


$check = 1;
$sql = "SELECT OrderID, UserName FROM Orders WHERE Status = 'Pending' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $check = 1;
        echo "Order ID: " . $row["OrderID"]. " - Customer: " . $row["UserName"]. "<br>";
        $check = showComponents($row["OrderID"],$conn);
        ?>
        <form action ="ShipOrder.php" method = "POST">
            <input type="hidden" name = "OrderID" value = "<?= $row["OrderID"]?>">
            <input type="hidden" name = "HasEnough" value = "<?= $check?>">
	    <input type="hidden" name = "Connection" value = "<?= $conn?>">
            <input type="Ship It">
        </form>
        <?php 

    }
} else {
    echo "No Pending Orders";
}
 
}
?>

<?php include footer.php ?>
