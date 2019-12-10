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

$sql = "SELECT ProdName, Price FROM Products";
$result = mysqli_query($conn, $sql);
// echo "<br>";
// echo "<table border='1' style='width:100%'>";
// echo "<tr>";

// echo "<th>Product Name</th>";
// echo "<th>Price</th>";

// echo "</tr>";
// while ($row = mysqli_fetch_assoc($result)) {
//     echo "<tr>";
//     foreach ($row as $field => $value) { 
//         echo "<td>" . $value . "</td>";
//     }
//     echo "</tr>";
// }
// echo "</table>";
?>

<?php include "footer.php"; ?>