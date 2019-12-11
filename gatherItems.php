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
        $sql = "SELECT Products.PID, Products.ProdName, Products.Price, Promotions.Discount FROM Products Left Join Promotions ON Promotions.PID = Products.PID WHERE Products.ProdName LIKE '%".$Search."%' OR Keyword LIKE '%".$Search."%'";	
		
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
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>". $row["ProdName"] ."</td>";
            echo "<td>". $row["Price"] ."</td>";
            echo "<td>". $row["Discount"] ."</td>";
            echo "<td><form method='post'><input type='submit' value='Add To Cart' name='addToCart - " .$row["PID"]. "'></input></form></td>";
            echo "</tr>";
        }
        echo "</table>";		
    }
}
?>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    foreach($_POST as $key => $value)
    {
        if (strpos($key, 'addToCart_-_') !== false)
        {
            $x = str_replace('addToCart_-_','',$key);
            $login = $_SESSION["login_user"];
            $conn = new mysqli($host, $username, $password, $dbname);
            if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
            } else{

            $Search = $_POST["Search"];
            $sql = "INSERT INTO ShopsFor (UserName, PID) VALUES ('".$login."', ".$x.")";
            mysqli_free_result($result); 
            if (mysqli_query($conn, $sql)) {
                echo "Successfully inserted product information!";
            } else {
                echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
            }
        }
    }
}


    
?>

<?php include "footer.php";?>