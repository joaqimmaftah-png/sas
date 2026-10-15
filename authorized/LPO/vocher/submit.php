<?php
include_once 'authorized/db.php';

if(isset($_POST['voucher'])){
$bcount=$_POST['bcount'];
$chqno=$_POST['chqno'];
$payto=strtoupper($_POST['payto']);
$vdate=$_POST['vdate'];
$vnumber=$_POST['vnumber'];
$currency=$_POST['currency'];
$amount=$_POST['amount'];
$descr=$_POST['descr'];
/////////////////////////////
$bcountssw=$_POST['bcountssw'];
$bname=$_POST['bname'];
$bbranch=$_POST['bbranch'];
$swift=$_POST['swift'];
$address=$_POST['address'];
$pdate=$_POST['pdate'];
$aban=$_POST['aban'];

if((!empty($descr)) && (!empty($amount))){

     $purchase1 = mysql_query("SELECT * FROM payment_voucher") or die(mysql_error());
      $rowz = mysql_fetch_array($purchase1);
      $voucher_no=$rowz['voucher_no'];
    if($voucher_no==$vnumber){
                 
} 
else{      
 $discount=  mysql_query("INSERT INTO `payment_voucher`(`paid_to`, `voucher_no`, `bank_acc_no`, `chq_number`,`bank_name`, `bank_branch`, `swift_code`, `iban`, `address`, `payment_date`,`created_date`)"
         . " VALUES ('$payto','$vnumber','$bcount','$chqno','$bname','$bbranch','$swift','$aban','$address','$pdate','$vdate')") or die(mysql_error());
 for ($i = 0; $i < sizeof($descr); $i++) {
     $currences=$currency[0];
                        $insert = mysql_query("INSERT INTO `tbl_vocher_items`(`description`, `amount`, `voucher_no`,currency) "
                                . "VALUES ('$descr[$i]','$amount[$i]','$vnumber','$currences')") or die(mysql_error());
                    }
                     echo '<script type="text/javascript">
           window.location = "http://daimainfotech.com/sas/LPO.php?action=voucher&message=1"
      </script>';    
            
}
                    
                    
}
 else {
 echo '<script type="text/javascript">
           window.location = "http://daimainfotech.com/sas/LPO.php?action=voucher"
      </script>'; 
}
}
?>