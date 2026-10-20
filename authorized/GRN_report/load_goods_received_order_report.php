<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once '../db.php';

$fromm=$_GET['from'];
$too=$_GET['to'];
$from=date("Ymd", strtotime($fromm));
$to=date("Ymd", strtotime($too)); 


if($fromm==''){
    $result = mysql_query("SELECT * FROM tbl_goods_received_order ORDER BY goods_id DESC") or mysql_error();
}

else{ 
   $result = mysql_query("SELECT * FROM tbl_goods_received_order  WHERE report_date BETWEEN '$from' AND '$to'") or mysql_error(); 
    
}   

 
$i=1;
while ($rows=  mysql_fetch_array($result)){
    
    $goods_id=$rows['goods_id'];
    $Title=$rows['Title'];
    $supplier=$rows['supplier'];
    $delivery_number=$rows['delivery_number'];
    $date=$rows['date'];
    $delivary_note=$rows['delivary_note'];
    $invoice_number=$rows['invoice_number'];
    $invoice_date=$rows['invoice_date'];
   
    
    $stock[] = array( 
       
        
        'SN'=>$i++,
        'Title'=>$Title,
        'Supplier'=>$supplier,
        'Delivery_number'=>$delivery_number,
        'Date'=>date('Y-m-d',strtotime($date)),
        'Delivery_note'=>$delivary_note,
        'Invoice_number'=>$invoice_number,
        'Invoice_date'=>date('Y-m-d',strtotime($invoice_date))
       
        
       
    );     
    
} 

echo json_encode($stock);

?>  







