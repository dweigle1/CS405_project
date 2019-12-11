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
        $sql = "SELECT Product.PID, Products.ProdName, Products.Price, Promotions.Discount FROM Products Left Join Promotions ON Promotions.PID = Products.PID WHERE Products.ProdName LIKE '%".$Search."%' OR Keyword LIKE '%".$Search."%'";	
		
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
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
            echo "<td><form method='post'><input type='submit' value='Add To Cart' name='addToCart - " .$row[0]. "'>Add to Cart</input></form></td>";
            echo "</tr>";
        }
        echo "</table>";		
    }
}
?>



<?php
if(isset($_POST["addToCart"])){
    foreach($_POST as $key => $value){
    if (strstr($key, 'item'))
    {
        $x = str_replace('item','',$key);
        inserttag($value, $x);
    }
}
}
?>


<?php include "footer.php";?>