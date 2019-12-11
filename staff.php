<?php include "header.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/login.css" />
	</head>

	<body>
		<div style="display: flex; justify-content: space-around;">
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

			if(isset($_POST["add"])){
				$conn = new mysqli($host, $username, $password, $dbname);
				if ($conn->connect_error) {
						   die("Connection failed: " . $conn->connect_error);
				} else{
					$sql = "INSERT INTO Products (PID, Quantity, Price, Category, ProdName, Keyword) 
							VALUES ('".$_POST["pid"]."', '".$_POST["quantity"]."', '".$_POST["price"]."', '".$_POST["category"]."',
									'".$_POST["pname"]."', '".$_POST["keyword"]."')";
					mysqli_free_result($result); 
					if (mysqli_query($conn, $sql)) {
						   echo "Successfully inserted product information!";
						} else {
						   echo "Error: " . $sql . "" . mysqli_error($conn);
						}
						$conn->close();
							
					}
			}
			?>
			<div>
				<h1 style="text-align: center; margin-bottom: -10px;">Current Inventory</h1>

				<?php
				$conn = new mysqli($host, $username, $password, $dbname);

				if(isset($_POST["update"])){
					$conn = new mysqli($host, $username, $password, $dbname);
					if ($conn->connect_error) {
							   die("Connection failed: " . $conn->connect_error);
					} else{
						$sql = "INSERT INTO Products (PID, Quantity, Price, Category, ProdName, Keyword) 
								VALUES ('".$_POST["pid"]."', '".$_POST["quantity"]."', '".$_POST["price"]."', '".$_POST["category"]."',
										'".$_POST["pname"]."', '".$_POST["keyword"]."')";
						mysqli_free_result($result); 
						if (mysqli_query($conn, $sql)) {
							   echo "Successfully inserted product information!";
							} else {
							   echo "Error: " . $sql . "" . mysqli_error($conn);
							}
							$conn->close();
						}
				}

				$sql = "SELECT * FROM Products";
				$result = mysqli_query($conn, $sql);
				echo "<br>";
				echo "<table border='1' style='margin: 0 auto;' class='table'>";
				echo "<thead class='thead-dark'><tr>";

				echo "<th>PID</th>";
				echo "<th>Quantity</th>";
				echo "<th>Price</th>";
				echo "<th>Category</th>";
				echo "<th>Product Name</th>";
				echo "<th>Keyword</th>";

				echo "</tr></thead>";
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					foreach ($row as $field => $value) { 
						echo "<td>" . $value . "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";


				?>
			</div>
			<div style="width: 25%;" class="formContent">
				<h1 style="text-align: center; margin-bottom: 5px;">Add Inventory</h1>

				<form method="post">
					<input type="text" name="pid" id="pid" placeholder="product id">
					
					<input type="number" name="quantity" id="quantity" placeholder="quantity">

					<input type="number" name="price" id="price" placeholder="price">

					<input type="text" name="category" id="category" placeholder="category">

					<input type="text" name="pname" id="pname" placeholder="product name">

					<input type="text" name="keyword" id="keyword" placeholder="keyword">

					<input type="submit" name="add" value="Add" class="login-input">
				</form>
				
				<h1 style="text-align: center; margin-top: -15px;">Update Inventory</h1>
				
				<form method="post">
					<input type="text" name="pid" id="pid" placeholder="product id">
					
					<input type="number" name="quantity" id="quantity" placeholder="quantity">

					<input type="submit" name="add" value="Add" class="login-input">
				</form>
			</div>
		</div>
		<?php include "footer.php"; ?>
	</body>
</html>