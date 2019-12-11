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
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	</form>



<?php include "footer.php"; ?>