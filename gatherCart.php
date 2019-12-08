<?php include "header.php"; ?>

<?php

if(isset($_SESSION["login_user"])){
	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
	    $sql = "SELECT DISTINCT [ProdName], [Price] FROM Products Right Join ShopsFor ON ShopsFor.PID = Products.PID WHERE ShopsFor.UserName  = '.$_SESSION["login_user"].'";
      mysqli_free_result($result); 
      
      $result = mysqli_query($conn, $sql);

      echo "<br>";
      echo "<table border='1' style='width:100%'>";
      echo "<tr>";

      echo "<th>Product Name</th>";
      echo "<th>Price</th>";
      echo "<th>Category</th>";

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