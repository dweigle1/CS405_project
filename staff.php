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
	    $sql = "INSERT INTO Products (PID, Quantity, Price, Category, ProdName, Keyword) 
				VALUES ('".$_POST["pid"]."', '".$_POST["quantity"]."', '".$_POST["price"]."', '".$_POST["category"]."',
						'".$_POST["pname"]."', '".$_POST["keyword"]."')";
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
		<label for="pid">Product ID</label>
		<input type="text" name="pid" id="pid">
	</div>
	
	<div>
		<label for="quantity">Quantity</label>
		<input type="number" name="quantity" id="quantity">
	</div>
	
	<div>
		<label for="price">Price</label>
		<input type="number" name="price" id="price">
	</div>
	
	<div>
		<label for="category">Category</label>
		<input type="text" name="category" id="category">
	</div>

	<div>
		<label for="pname">Product Name</label>
		<input type="text" name="pname" id="pname">
	</div>
	
	<div>
		<label for="keyword">Keyword</label>
		<input type="text" name="keyword" id="keyword">
	</div>

	<input type="submit" name="add" value="Add Item">
</form>


<h1>Current Inventory</h1>

<?php
$conn = new mysqli($host, $username, $password, $dbname);

if(isset($_POST["update"])){
	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
	    $sql = "INSERT INTO Products (PID, Quantity, Price, Category, ProdName, Keyword) 
				VALUES ('".$_POST["pid"]."', '".$_POST["quantity"]."', '".$_POST["price"]."', '".$_POST["category"]."',
						'".$_POST["pname"]."', '".$_POST["keyword"]."')";
	    mysqli_free_result($result); 
	    if (mysqli_query($conn, $sql)) {
               echo "Successfully inserted product information!";
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
       	        
	    }
}

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