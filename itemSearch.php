<?php include "header.php"; ?>

<h2>Item Search</h2>

<div style="float:right;">
	To View your cart, click here.
	<form method="post">
      <label for="itemCart">Cart</label>
      <input type="submit" name="submit" value="Cart">
    </form>
</div>



    <form method="post">
      <label for="itemName">Item Name</label>
      <input type="text" name="itemName" id="itemName">
      <input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>
<?php include "footer.php";?>