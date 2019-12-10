<?php include "header.php"; ?>

<?php


if(isset($_SESSION["login_user"])){
	$conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
		
		$login = $_SESSION["login_user"];
		$query = "SELECT DISTINCT ProdName, Price FROM Products JOIN ShopsFor ON Products.PID = ShopsFor.PID AND ShopsFor.UserName = '".$login."' Order BY ProdName ASC;";	
		
		$result = mysqli_query($conn, $query);		
		$number = mysqli_num_rows($result);
          $row = mysqli_fetch_row($result);
          $conn->close();

        echo "<br>";
        echo "<table border='1' style='width:100%'>";
        echo "<tr>";
        
        echo "<th>Product Name</th>";
        echo "<th>Price</th>";
        echo "<th> Button </th>";

        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $field => $value) { 
                echo "<td>" . $value . "</td>";
            }
            echo "<td><button> Add to Cart </button></td>";
            echo "</tr>";
        }
        echo "</table>";		
    }
}
?>


<?php include "footer.php"; ?>