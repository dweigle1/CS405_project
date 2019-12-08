<?php include "header.php"; ?>

<h2>Item Search</h2>

<div style="float:right; margin-right: 30px">
	To View your cart, click here.
	<form action="gatherCart.php" method="post">
      <input type="submit" name="cart" value="Cart">
    </form>
</div>

<form action="gatherItems.php" method="post">
  <label for="itemName">Item Name</label>
  <input type="text" name="itemName" id="itemName">
  <input type="submit" name="list" value="Submit">
</form>




<?php include "footer.php";?>