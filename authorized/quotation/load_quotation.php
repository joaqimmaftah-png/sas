<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once '../db.php';
$resultT = mysql_query("SELECT * FROM quotation ORDER BY Quotation_id DESC") or die("SQL Error 1: " . mysql_error());
//get data and store in a json array
$u=1;
while ($rrow = mysql_fetch_array($resultT, MYSQL_ASSOC)) {
    $rdi=$rrow['Customer_name'];
           $customer=mysql_query("SELECT * FROM quotation_customer WHERE customer_id='$rdi'") or die(mysql_error());
           $ng=mysql_fetch_array($customer);
          
    $stock[] = array( 
        'link'=>'<a href="#" data-toggle="modal" class="editdata" data-target="#Modaledit"  '
        .'data-Cname="'.$ng['customer_name'].'"'
        .'data-a="'.$rrow['Customer_name'].'"'
        .'data-b="'.$rrow['Quotation_Date'].'"'
        .'data-c="'.$rrow['Quote_ref'].'"'
        .'data-d="'.$rrow['Sitename'].'"'
        .'data-e="'.$rrow['Description'].'"'
        .'data-f="'.$rrow['Amount'].'"'
        .'data-g="'.$rrow['Currency'].'"'
        .'data-h="'.$rrow['Approval_status'].'"'
        .'data-i="'.$rrow['Work_status'].'"'
        .'data-j="'.$rrow['Invoice_status'].'"'
        .'data-k="'.$rrow['Invoice_date'].'"'
        .'data-l="'.$rrow['Invoice_ref'].'"'
        .'data-m="'.$rrow['Invoice_amount'].'"'
        .'data-n="'.$rrow['Payment_status'].'"'
        .'data-o="'.$rrow['Comments'].'"'
        .'data-p="'.$rrow['Quotation_id'].'"'
        
        . '">Edit</a>',
        'id'=>$u++,
        'Quotation_Date'=>$rrow['Quotation_Date'],
        'Quote_ref'=>$rrow['Quote_ref'],       
        'Sitename'=>$rrow['Sitename'],
        'Description'=>$rrow['Description'],
        'Amount'=>$rrow['Amount'],
        'Currency'=>$rrow['Currency'],
        'Approval_status'=>$rrow['Approval_status'],
        'Customer_name'=>$ng['customer_name'],
        'Work_status'=>$rrow['Work_status'],
        'Invoice_status'=>$rrow['Invoice_status'],
        'Invoice_date'=>$rrow['Invoice_date'],
        'Invoice_ref'=>$rrow['Invoice_ref'],
        'Invoice_amount'=>$rrow['Invoice_amount'],
        'Payment_status'=>$rrow['Payment_status'],
        'Comments'=>$rrow['Comments']
            
    );
}
echo json_encode($stock);
?>