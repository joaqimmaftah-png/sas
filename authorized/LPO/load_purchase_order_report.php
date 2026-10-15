<?php
include_once '../db.php';

$fromm=$_GET['from'];
$too=$_GET['to'];
$from=date("Ymd", strtotime($fromm));
$to=date("Ymd", strtotime($too)); 


if($fromm==''){
    $result = mysql_query("SELECT * FROM tbl_purchase_order ORDER BY purchase_id DESC") or mysql_error();
}

else{
   $result = mysql_query("SELECT * FROM tbl_purchase_order WHERE open_dreport BETWEEN '$from' AND '$to'") or mysql_error(); 
}

 
//$result= mysql_query("SELECT * FROM tbl_purchase_order ORDER BY purchase_id DESC")or die(mysql_error());
$i=1;
while ($rows=  mysql_fetch_array($result)){
    
    $purchase_id=$rows['purchase_id'];
    $plo_title=$rows['order_details'];
    $customer=$rows['customer_id'];
    $po_date=$rows['date'];
//    $po_amount=
    $currenc=$rows['currency'];
    $op_status=$rows['Approved_status'];
    $account=$rows['checked_status'];
    
    $supp=  mysql_query("SELECT * FROM tbl_customer WHERE customer_id='$customer'")or die(mysql_error());
    $rew=  mysql_fetch_array($supp);
    $supplier=$rew['customer_name'];
    
    $po_amount=  mysql_query("SELECT SUM(subtotal) FROM tbl_items WHERE item='$purchase_id'")or die(mysql_error());
    $rnm=  mysql_fetch_array($po_amount);
    
    $subtotal = $rnm['SUM(subtotal)'];
    
    
    
    
    $stock[] = array( 
       
        
        'SN'=>$u++,
        'P.O_no'=>$purchase_id,
        'Title'=>$plo_title,
        'Supplier'=>$supplier,
        'PLO_Date'=>$po_date,
        'PLO_amount'=>$subtotal,
        'Currency'=>$currenc,
        'OP_status'=>$op_status,
        'Accounts_status'=>$account
        
       
    );     
    
}

echo json_encode($stock);

?>