<?php include "header.php"; ?>

<?php


if(isset($_SESSION["login_user"])){
	echo $_SESSION["login_user"];

	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
} else{
	$sql = "SELECT DISTINCT ProdName, Price FROM Products JOIN ShopsFor ON Products.PID = ShopsFor.PID AND ShopsFor.UserName = '".$_SESSION["login_user"]."' Order BY ProdName ASC;";
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


<?php include "footer.php"; ?>