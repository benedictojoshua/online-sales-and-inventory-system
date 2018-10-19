<?php
include('includes/config.php');

$idw= trim($_GET['pid']);

$queryd=mysql_query("UPDATE users SET status='Verified' WHERE id='$idw'");
echo "<script type='text/javascript'> 
                                alert('Your account has been verified! You can now login in the Fashion HAUL Boutique website. Thank you!'); 
                                window.close();
                            </script>";
?>
