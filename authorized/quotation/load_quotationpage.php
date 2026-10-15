

<?php
include_once '../db.php';
$result = mysql_query("SELECT * FROM tbl_preparedquotation ORDER BY Quotation_id DESC")or die(mysql_error());

//get data and store in a json array
$u=1;
while ($rrow = mysql_fetch_array($result)) {
    $rdi=$rrow['customer_id'];
           $customer=mysql_query("SELECT * FROM quotation_customer WHERE customer_id='$rdi'") or die(mysql_error());
           $ng=mysql_fetch_array($customer);   
          
    $stock[] = array( 
        'link'=>'<a href="?action=editquotation&quid='.$rrow['Quotation_id'].'">Edit</a>',
        
        
        'link1'=>'<a href="printpage.php?Qprint='.$rrow['Quotation_id'].'"  target="_blank">View</a>',
        'SN'=>$u++,
        'Quote_number'=>$rrow['Quotation_number'],
        'Quote_name'=>$rrow['Quotation_name'],
        'Quote_date'=>$rrow['Quotation_date'],
        'customer_name'=>$ng['customer_name']
        
        
       
    );
}
echo json_encode($stock);
?>

