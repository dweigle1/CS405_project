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
?>

<form method="post">
	
	<input type="submit" name="Week" value="Show this week's stats">
	<input type="submit" name="Month" value="Show this month's stats">
	<input type="submit" name="Year" value="Show this year's stats">
</form>

<?php
$conn = new mysqli($host, $username, $password, $dbname);

	$conn = new mysqli($host, $username, $password, $dbname);
	if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
	} else{
		
	    if(isset($_POST["Week"])){
			$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 WEEK) and CURRENT_TIMESTAMP;";
			$sql2 = "select TimeOrdered, Quantity FROM Orders where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 WEEK) and CURRENT_TIMESTAMP;";
		$SELECTEDORDER = 'Week';
	
}
		if(isset($_POST["Month"])){
			$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 MONTH) and CURRENT_TIMESTAMP;";
			$sql2 = "select TimeOrdered, Quantity FROM Orders where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 WEEK) and CURRENT_TIMESTAMP;";
	$SELECTEDORDER = 'Month';
			
	
}
		if(isset($_POST["Year"])){
			$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 YEAR) and CURRENT_TIMESTAMP;";
			$sql2 = "select TimeOrdered, Quantity FROM Orders where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 WEEK) and CURRENT_TIMESTAMP;";
	$SELECTEDORDER = 'Year';
	
}
		
		$result = mysqli_query($conn, $sql);
		$chart_data="";
		
		echo "<br>";
		echo "<table border='1' style='width:100%'>";
		echo "<tr>";

		echo "<th>OrderID</th>";
		echo "<th>timeOrdered</th>";
		echo "<th>ProdName</th>";
		echo "<th>Quantity</th>";

		echo "</tr>";
		while ($row = mysqli_fetch_assoc($result)) {
			
			echo "<tr>";
    	foreach ($row as $field => $value) { 
			
        echo "<td>" . $value . "</td>";
		}
    	echo "</tr>";
		}
		echo "</table>";
		
		while ($row = mysqli_fetch_array($result)) { 
       	$productname[]  = $row['ProdName']  ;
        $sales[] = $row['Quantity'];
	    }
	}

	
?>


<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div style="width:60%;hieght:20%;text-align:center">
            <div>Sales Stats</div>
            <canvas  id="chartjs_bar"></canvas> 
        </div>    
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
</html>  

