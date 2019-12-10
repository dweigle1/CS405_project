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
	    $sql = "INSERT INTO Promotions (PID, Discount) 
				VALUES ('".$_POST["PID"]."', '".$_POST["discount"]."')";
	    mysqli_free_result($result); 
	    if (mysqli_query($conn, $sql)) {
               echo "Successfully inserted promotion!";
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
       	        
	    }
}
if(isset($_POST["delete"])){
	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
	    $sql = "DELETE FROM Promotions WHERE PID='".$_POST["PID"]."';";
	    mysqli_free_result($result); 
	    if (mysqli_query($conn, $sql)) {
               echo "Successfully ended promotion!";
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
       	        
	    }
}
?>

<h1>Edit Promotions</h1>

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
		<input type="text" name="PID" id="PID">
	</div>
	
	<div>
		<label for="quantity">Discounted price</label>
		<input type="number" step="0.01" name="discount" id="discount">
	</div>
	

	<input type="submit" name="add" value="Add Promotion">
	<input type="submit" name="delete" value="Delete Promotion">
</form>


<h1>Current Inventory</h1>

<?php
$conn = new mysqli($host, $username, $password, $dbname);


$sql = "SELECT  Products.PID, Products.Quantity, Products.Category, Products.ProdName, Products.Keyword, Products.Price, Promotions.Discount FROM Products Left Join Promotions ON Promotions.PID = Products.PID";
$result = mysqli_query($conn, $sql);
echo "<br>";
echo "<table border='1' style='width:100%'>";
echo "<tr>";

echo "<th>PID</th>";
echo "<th>Quantity</th>";
echo "<th>Category</th>";
echo "<th>Product Name</th>";
echo "<th>Keyword</th>";
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


?>


<?php include "footer.php"; ?>