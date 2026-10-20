<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once '../db.php';  
$result = mysql_query("SELECT * FROM tbl_preparedquotation ORDER BY Quotation_id DESC")or die(mysql_error());

//get data and store in a json array
$u=1;
while ($rrow = mysql_fetch_array($result)) {
    
    $client_id=$rrow['customer_id'];
           $customer=mysql_query("SELECT * FROM quotation_customer WHERE customer_id='$client_id'") or die(mysql_error());
           $ng=mysql_fetch_array($customer);
           
           
       
          
    $stock[] = array(     
       
        'SN'=>$u++,
        'Quote_name'=>$rrow['Quotation_name'],
        'Quote_number'=>$rrow['Quotation_number'],
        'Quote_date'=>$rrow['Quotation_date'],
        'customer_name'=>$ng['customer_name'],                      
        'PO_approval'=>$rrow['approved_po'],
        'Work_status'=>$rrow['Work_status'],
       
        
    );
}

echo json_encode($stock);

?>
  
