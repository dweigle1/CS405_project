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

if(isset($_POST["add"])){
	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
	    $sql = "INSERT INTO Promotions (Coupon, Discount) 
				VALUES ('".$_POST["pid"]."', '".$_POST["quantity"]."')";
	    mysqli_free_result($result); 
	    if (mysqli_query($conn, $sql)) {
               echo "Successfully inserted product information!";
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
       	        
	    }
}
?>

<h1>Add Inventory</h1>

<style>
div {
    display: inline-block;
}

div label {
    display: block;
}
</style>

<form method="post">
	<div>
		<label for="pid">Coupon Code</label>
		<input type="text" name="Coupon" id="coupon">
	</div>
	
	<div>
		<label for="quantity">Discount (between 0 and 1... unless you live dangerously</label>
		<input type="float" name="Discount" id="discount">
	</div>
	

	<input type="submit" name="add" value="Add Promotion">
</form>


<h1>Current Inventory</h1>

<?php
$conn = new mysqli($host, $username, $password, $dbname);


$sql = "SELECT * FROM Products";
$result = mysqli_query($conn, $sql);
echo "<br>";
echo "<table border='1' style='width:100%'>";
echo "<tr>";

echo "<th>PID</th>";
echo "<th>Quantity</th>";
echo "<th>Price</th>";
echo "<th>Category</th>";
echo "<th>Product Name</th>";
echo "<th>Keyword</th>";

echo "</tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($row as $field => $value) { 
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}
echo "</table>";


?>


<?php include "footer.php"; ?>