


<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once '../db.php';
$result = mysql_query("SELECT * FROM `tblinvoice` ORDER BY Invoice_id DESC")or die(mysql_error());

//get data and store in a json array
$u=1;
while ($rrow = mysql_fetch_array($result)) {
    $nvid=$rrow['Invoice_id'];
    $invdate=$rrow['Invoice_date'];
    $invnum=$rrow['Invoice_number'];
    $invdescr=$rrow['Invoice_description'];
    $vat=$rrow['Vat'];
    $curr=$rrow['Currency'];
    $Quotation_id=$rrow['Quotation_id'];
    
    ////////
    $result2 = mysql_query("SELECT * FROM `tbl_preparedquotation`  WHERE Quotation_id='$Quotation_id'")or die(mysql_error());
    $rrow2 = mysql_fetch_array($result2);
    $Quotation_name=$rrow2['Quotation_name'];
    
          
    $stock[] = array( 
        'link'=>'<a href="?action=editinvoicepage&invid='.$rrow['Invoice_id'].'">Edit</a>',
        'link1'=>'<a href="printpageinvoice.php?Iprint='.$rrow['Invoice_id'].'" target="_blank">View</a>',
        'SN'=>$u++,
        'Invoice_date'=>$rrow['Invoice_date'],
        'Invoice_number'=>$rrow['Invoice_number'],
        'Invoice_descrip'=>$invdescr,
        'invoicename'=>$Quotation_name,
        'Vat'=>$rrow['Vat'],
        'Currency'=>$rrow['Currency']
        
        
       
    );
}
echo json_encode($stock);
?>
