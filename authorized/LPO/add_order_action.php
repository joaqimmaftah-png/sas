<?php
require_once __DIR__ . '/../../mysql_compat.php';

    include_once 'authorized/db.php';
    $descr=$_POST['descr'];
    $units=$_POST['units'];
    $amount=$_POST['amount'];
    $quantity=$_POST['quantity'];
    $customer=$_POST['customer'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $phone=$_POST['phone'];
     $contactname=$_POST['contactname'];
      $email=$_POST['email'];
    
//    $select_faultid=mysql_query("SELECT * FROM tbl_car_faults ORDER BY fault_id DESC") or die(mysql_error());
//    $Q=mysql_fetch_array($select_faultid);
//    $idd=$Q['fault_id']+1;
      
       
      if(!empty($customer && $email && $address)){
         
           $customers=mysql_query("INSERT INTO tbl_customer(`customer_name`,`address`,`city`,`phone_no`,`contact_name`,`email`)"
            . "VALUE('$customer','$address','$city','$phone','$contactname','$email')") or die(mysql_error());
           
           
           if($customers){
               ////////////////////////////////////
               $select_custid=mysql_query("SELECT * FROM tbl_customer ORDER BY customer_id DESC") or die(mysql_error());
               $Q=mysql_fetch_array($select_custid);
               $cust_id=$Q['customer_id'];
               
               ///////////////////////////////////////
               $selectid=  mysql_query("SELECT * FROM tbl_purchase_order ORDER BY purchase_id DESC") or die(mysql_error());
//          $row= mysql_num_rows($selectid);
//          $rows=$row+1;
               $row= mysql_fetch_array($selectid);
          $rows=$row['purchase_id']+1;
          $paddedNum = sprintf("%04d", $rows);
          $tareh=date('Y-m-d');
               ///////////////////////////////////////////////////
               
                $insertorder=mysql_query("INSERT INTO tbl_purchase_order(`ordered_by`, `Delivery_to`, `item`, `order_details`, `customer_id`,date)"
            . "VALUE('','','$paddedNum','','$cust_id','$tareh')") or die(mysql_error());
                //////////////////////////////////////////////////////////
                         for ($i = 0; $i < sizeof($descr); $i++) {
                             $subtotal=$quantity[$i]*$amount[$i];
                        $insert = mysql_query("INSERT INTO tbl_items(`description`,`quantity`,units,`unit_price`,`subtotal`,`item`)"
                                . "values('$descr[$i]','$quantity[$i]','$units[$i]','$amount[$i]','$subtotal','$paddedNum')") or die(mysql_error());
                    }
                    
                    header("location:?action=po_form&item=".$paddedNum);
                
                
                
           }
           
           
           
      }
    

       
?>