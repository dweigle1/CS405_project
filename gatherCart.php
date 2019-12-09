<?php include "header.php"; ?>

<?php

if(isset($_SESSION["login_user"])){
	echo $_SESSION["login_user"];
}
?>


<?php include "footer.php"; ?>