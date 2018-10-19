<?php

include('includes/config.php');

$conf = $_GET['confirm'];

mysql_query("update orders set paymentMethod='Paypal' where confirmation='$conf'");

		header('location:my-cart2.php');

?>