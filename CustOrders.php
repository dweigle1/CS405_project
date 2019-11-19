<?php
$sql = "SELECT * FROM Orders";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Order ID: " . $row["OrderID"]. " - Date Ordered: " . $row["timeOrdered"]. " - Status: " . $row["status"]. "<br>";
    }
} else {
    echo "No Orders";
}
?>