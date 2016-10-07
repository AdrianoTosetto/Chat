<?php
	setcookie("userLogin","",time() - 1);
	echo "<h3>Saindo...</h3>";
 	echo '<meta http-equiv="refresh" content="3;url=login.php">';
?>