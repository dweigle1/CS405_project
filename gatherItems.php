<?php include "header.php"; ?>


Your item is <?php echo $_POST["itemName"]; ?><br>

Your item has been <?php echo $_POST["submit"]; ?><br>
<?php
$itemList = array();

if(isset($_POST["submit"])){
	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
	   
	    $sql = "SELECT * FROM Products WHERE ProdName like '".$_POST["itemName"]."'";
	    mysqli_free_result($result); 
	    if (mysqli_query($conn, $sql)) {
               echo "Worked";
            } else {
               echo "Error: Query failed ";
	    }
		
            $conn->close();
       	        
	    }
}

?>
<?php include "footer.php";?>