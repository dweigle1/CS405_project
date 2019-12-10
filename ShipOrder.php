<?php
$check = $_POST['HasEnough'];
$conn = $_POST['Connection'];
if ($check == 1) {
    $OrderID = $_POST['OrderID'];
    $sql = "SELECT ProdName, o.PID, Price, o.Quantity, p.Quantity FROM OrderProducts o, Products p WHERE o.OrderID = '$OrderID' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $newQuantity = $row["p.Quantity"]-$row["o.Quantity"];
            $sql = "UPDATE Products SET Quantity = "$newQuantity" WHERE PID = "$row["o.PID"]" ";
            mysqli_query($conn, $sql);

       }
    }
}
?>
