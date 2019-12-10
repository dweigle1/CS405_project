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
		$query = "SELECT ProdName, Price FROM Products WHERE ProdName LIKE '%".$Search."%' OR Keyword LIKE '"%.$Search.%"'";	
		
		$result = mysqli_query($conn, $query);		
		$number = mysqli_num_rows($result);
          $row = mysqli_fetch_row($result);
          $conn->close();
        
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



		
		
    }
}
?>
<?php
if(isset($_POST["Search"])){
     echo $_POST["Search"];
}
?>

<?php include "footer.php";?>