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

if(isset($_POST["Search"])){
	$conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
		
		$Search = $_POST["Search"];
        $sql = "SELECT Products.ProdName, Products.Price, Promotions.Discount FROM Products Left Join Promotions ON Promotions.PID = Products.PID WHERE Products.ProdName LIKE '%".$Search."%' OR Keyword LIKE '%".$Search."%'";	
		
		$result = mysqli_query($conn, $sql);
        $conn->close();

        echo "<br>";
        echo "<table border='1' style='width:100%'>";
        echo "<tr>";
        
        echo "<th>Product Name</th>";
        echo "<th>Price</th>";
        echo "<th>Discounted Price</th>";
        echo "<th> Add to Cart </th>";

        echo "</tr>";
        $a=array();
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $field => $value) { 
                echo "<td>" . $value . "</td>";
                array_push($a,$value);
            }
            echo "<td><form method='post'><input type='submit' value='$a[0]' name='addToCart'>Add to Cart</input></form></td>";
            echo "</tr>";
        }
        echo "</table>";		
    }
}
?>



<?php
if(isset($_POST["addToCart"])){
    echo $_POST["addToCart"];
}
?>


<?php include "footer.php";?>