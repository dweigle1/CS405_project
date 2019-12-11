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
		$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 WEEK) and DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL -1 day);";	
			$sql2 = "select Products.ProdName, SUM(OrderProducts.Quantity)
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where (timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 WEEK) and DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL -1 day)) Group by Products.ProdName;";
		
		
	    if(isset($_POST["Week"])){
			$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 WEEK) and DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL -1 day);";	
			$sql2 = "select Products.ProdName, SUM(OrderProducts.Quantity)
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where (timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 WEEK) and DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL -1 day)) Group by Products.ProdName;";
	
}
		if(isset($_POST["Month"])){
			$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 MONTH) and DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL -1 day);";
			$sql2 = "select Products.ProdName, SUM(OrderProducts.Quantity)
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where (timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 MONTH) and DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL -1 day)) Group by Products.ProdName;";
	
}
		if(isset($_POST["Year"])){
			$sql = "select Orders.OrderID, timeOrdered, Products.ProdName, OrderProducts.Quantity
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 YEAR) and DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL -1 day);";
			$sql2 = "select Products.ProdName, SUM(OrderProducts.Quantity)
 from Products RIGHT JOIN (Orders LEFT JOIN OrderProducts 
 ON Orders.OrderID = OrderProducts.OrderID) 
 ON Products.PID = OrderProducts.PID where (timeOrdered between DATE_SUB(current_timestamp(), INTERVAL 1 YEAR) and DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL -1 day)) Group by Products.ProdName;";
	
}
		
		$result = mysqli_query($conn, $sql);
		
		
		echo "<br>";
		echo "<table border='1' style='width:80%; margin: 0 auto;' class='table'>";
		echo "<thead class='thead-dark'><tr>";

		echo "<th>OrderID</th>";
		echo "<th>timeOrdered</th>";
		echo "<th>ProdName</th>";
		echo "<th>Quantity</th>";

		echo "</tr></thead>";
		while ($row = mysqli_fetch_assoc($result)) {
			
			echo "<tr>";
    	foreach ($row as $field => $value) { 
        echo "<td>" . $value . "</td>";
		}
    	echo "</tr>";
		}
		echo "</table>";
	}

		
		
		//////// 		////////		Below here lies the graph stuff       ////////		////////			
	

$qresult = mysqli_query($conn, $sql2);

$rows2 = array();
$table = array();
$table['cols'] = array(
        array('label' => 'ProductName', 'type' => 'string'),
        array('label' => 'Quantity', 'type' => 'number')
);

$rows2 = array();
while ($r = $qresult->fetch_assoc()) {
        $temp = array();
        $temp[] = array('v' => (string) $r['ProdName']);
    // Values of each slice
    $temp[] = array('v' => (int) $r['SUM(OrderProducts.Quantity)']);
    $rows2[] = array('c' => $temp);
}

$table['rows'] = $rows2;
$jsonTable = json_encode($table);
?>

<html>
  <head>
    <!--Load the Ajax API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
        title: 'Sales Statistics',
        seriesType:'bars',
        series:1
        //width: 800,
        //height: 600
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
  </head>

  <body>
    <!--this is the div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
