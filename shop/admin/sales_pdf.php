<?php
ob_start();
include('include/config.php');

$to = $_POST['to'];
$fr	= $_POST['from'];

$dd = date( 'm-d-Y');

$todate = strtotime($to); 
$td = date('M d, Y', $todate);
$ts = date('m-d-Y', $todate);

$frdate = strtotime($fr); 
$fd = date('M d, Y', $frdate);
$fs = date('m-d-Y', $frdate);

$date	= $_POST['date'];

if($todate < $frdate)
{
	echo"<script type='text/javascript'>
				alert('Invalid date.');
				window.location='sales.php';
				</script>";
}
else
{
	$sqld = "select users.name as username,users.email as useremail,users.contactno as usercontact,
	  users.shippingAddress as shippingaddress,users.shippingCity as shippingcity,users.shippingState as shippingstate,
	  users.shippingPincode as shippingpincode,products.productName as productname,products.shippingCharge as shippingcharge,
	  orders.quantity as quantity,orders.orderDate as orderdate,products.productPrice as productprice,orders.id as id  
	  from orders join users on  orders.userId=users.id join products on products.id=orders.productId WHERE
	  ddate >= '$fs' AND ddate <= '$ts'";
	$result = mysql_query($sqld);
	$num=mysql_num_rows($result);
	if($num>0)
	{

  /*-------------------- for genearte pdf start -----------------*/
include('mpdf/mpdf.php');

$mpdf = new mPDF('c', 'A4-L'); 

$html = '
<body>

<div style="text-align: right;">'.$date.'</div>




 <img src="images/logo_1.png" width="200" height="100" style="float:left;"><br>
 &nbsp;&nbsp;&nbsp;<strong>
 <strong>Fashionhaul Boutique</strong><br>
&nbsp;&nbsp;&nbsp;77 Don Campos Ave.,Dasmariñas, Cavite<br>
&nbsp;&nbsp;&nbsp;Facebook: Fashion HAUL Boutique<br>
&nbsp;&nbsp;&nbsp;Contact: 0917 584 9253<br><br><br>
<div style="text-align: center;"><b>Sales Report<br><br>
('.$fd.' - '. $td .')</b>
</div>
<br><br>
	<div class="table-responsive">
        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" border="1" cellpadding="8">
            <thead>
                <tr>
                    <td>Name.</td>
                    <td>Email / Contact No</td> 
                    <td>Shipping Address</td>
                    <td>Product</td>                      
                    <td>Qty</td>
					<td>Amount</td>
                </tr>
            </thead>
            
            <tbody>'; ?>
    <?php
      $sql        = "select users.name as username,users.email as useremail,users.contactno as usercontact,
	  users.shippingAddress as shippingaddress,users.shippingCity as shippingcity,users.shippingState as shippingstate,
	  users.shippingPincode as shippingpincode,products.productName as productname,products.shippingCharge as shippingcharge,
	  orders.quantity as quantity,orders.orderDate as orderdate,products.productPrice as productprice,orders.id as id  
	  from orders join users on  orders.userId=users.id join products on products.id=orders.productId WHERE
	  ddate >= '$fs' AND ddate <= '$ts' AND paymentMethod!='null'";
      $result     = mysql_query($sql);
	  $b = 0;
      while($row  = mysql_fetch_array($result))
      {  
		$a = $row['quantity']*$row['productprice']+$row['shippingcharge'];
		$b += $a;
        $html .= '<tr>
        <td>'.$row['username'].'</td> 
        <td>'.$row['useremail'].'</td>
        <td>'.$row['shippingaddress'].'</td>                    
        <td>'.$row['productname'].'</td>
		 <td>'.$row['quantity'].'</td>
		 <td>'.$a.'</td>
        </tr>	
		</body>';
        } 
		
      $html .= '</tbody></table><br><br>
	  <div style="text-align: center;">TOTAL:<b>
	  ' . $b. '</b></div>';
       //echo $html; die;  
      $file_name ="webpreparations-".time().".pdf";
      $stylesheet = '<style>'.file_get_contents('css/well.css').'</style>';  // Read the css file
      $mpdf->WriteHTML($stylesheet,1);  //             
      $mpdf->WriteHTML($html,2); 
       
	$mpdf->Output();

    /*-------------------- for genearte pdf close -----------------*/
	}
	else
	{
		echo"<script type='text/javascript'>
				alert('No records found.');
				window.location='sales.php';
				</script>";
	}
}

?>
 