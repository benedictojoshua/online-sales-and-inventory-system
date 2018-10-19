<?php

include('includes/config.php');

$conf = $_GET['confirm'];

mysql_query("delete from orders where confirmation = '$conf'");
		header('location:my-cart2.php');

?>