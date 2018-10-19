<?php
 
include('mpdf/mpdf.php');
 
$comp 	= $_POST['company'];
$desc 	= $_POST['description'];
$date 	= $_POST['date'];
 
$html .= "
<html>
<head>
<style>
body {font-family: sans-serif;
    font-size: 10pt;
}
td { vertical-align: top; 
    border-left: 0.6mm solid #000000;
    border-right: 0.6mm solid #000000;
	align: center;
}
table thead td { background-color: #EEEEEE;
    text-align: center;
    border: 0.6mm solid #000000;
}
td.lastrow {
    background-color: #FFFFFF;
    border: 0mm none #000000;
    border-bottom: 0.6mm solid #000000;
    border-left: 0.6mm solid #000000;
	border-right: 0.6mm solid #000000;
}
 
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name='myheader'>
<div style='text-align: right;'>
$date
</div>
</htmlpageheader>
<htmlpagefooter name='myfooter'>
<div style='border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; '>
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>
 
<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
<sethtmlpagefooter name='myfooter' value='on' />
mpdf-->
 <img src='images/logo_1.png' width='200' height='100' style='float:left;'><br>
&nbsp;&nbsp;&nbsp;<strong>Fashionhaul Boutique</strong><br>
&nbsp;&nbsp;&nbsp;77 Don Campos Ave.,Dasmariñas, Cavite<br>
&nbsp;&nbsp;&nbsp;Facebook: Fashion HAUL Boutique<br>
&nbsp;&nbsp;&nbsp;Contact: 0917 584 9253<br><br><br>

Hello $comp, <br><br>

$desc
<br><br><br><br><br><br>
Approved by:
<br><br>
The management
</body>
</html>
";
 
$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullpage');
 
$mpdf->Output();
 
?>