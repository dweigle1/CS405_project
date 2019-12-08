<?php include "header.php"; ?>


Your item is <?php echo $_POST["itemName"]; ?><br>

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

if(isset($_POST["itemName"])){
	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
	    $sql = "SELECT [Price], [Category], [ProdName] FROM $dbname WHERE [ProdName] Like '%.$_POST("list"),%' OR Keyword Like '%.$_POST("list"),%'";
      //mysqli_free_result($result); 
      
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

	    // if (mysqli_query($conn, $sql)) {
      //          echo "Successfully pulled product information!";
      //       } else {
      //          echo "Error: " . $sql . "" . mysqli_error($conn);
      //       }
      //       $conn->close();
       	        
	    }
}
?>
<?php include "footer.php";?>