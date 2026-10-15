<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include '../db.php';
$assetnamee= $_POST['assetname'];
$explore=  explode('@', $assetnamee);
$regi= $_POST['hod'];
$exp= explode('@',$regi);
$cat=$explore[0];
$asseid=$explore[1];
$asdignid=$_POST['assigners'];
$assname=$_POST['assetnames'];
$hod=$exp[0];
$department_id=$exp[1];
$descriptional= $_POST['descriptional'];
$modeli= $_POST['modeli'];
$vendor=$_POST['vendor'];
$barcode= $_POST['barcode'];
$serialno= $_POST['serialno'];
$status= $_POST['status'];
$purchase_price= $_POST['purchase_price'];
$mode_of_payment=$_POST['mode_of_payment'];
$purchase=$_POST['purchase'];
$warranty=$_POST['warranty'];
$notes=$_POST['notes'];
$locations= $_POST['locations'];
$employeename=$_POST['employeename'];
$issue_date=$_POST['issue_date'];
$end_date=$_POST['end_date'];



$selectasset = mysql_query("SELECT * FROM tbl_fixed_asset WHERE asset_id='$asseid'") or die(mysql_error());
$assetss = mysql_fetch_array($selectasset);
$asset_name = $assetss['asset_name'];

$emplott = mysql_query("SELECT * from  tbl_employee WHERE emp_file_no='$employeename' ") or die(mysql_error());
$joh = mysql_fetch_array($emplott);
$jina = $joh['first_name'] . ' ' . $joh['surname'];

$checkfirst= mysql_query("SELECT * FROM tbl_employee_asset WHERE asset_id='$asseid' AND status!='Reallocated'") or die(mysql_error());
$row= mysql_numrows($checkfirst);
$mn=mysql_fetch_array($checkfirst);
$employe_no=$mn['employe_no'];
$dateissued=date("d.m.Y");


if($row==0 AND $employeename!=''){
    if(!empty($issue_date) AND !empty($locations) AND !empty($department_id)){
        $insert=  mysql_query("INSERT INTO `tbl_employee_asset`(`employe_no`, `location_id`, `issue_date`, `end_date`, `hod_name`, `registerid`, `department_id`, `asset_id`, `status`) "
            . "VALUES ('$employeename','$locations','$issue_date','$end_date','$hod','$asdignid','$department_id','$asseid','$status')") or die(mysql_error());    
    $upp=  mysql_query("UPDATE `tbl_fixed_asset` SET `asset_name`='$assname',`description`='$descriptional',`vendor`='$vendor',`model`='$modeli',`serial_number`='$serialno',"
             . "`barcode`='$barcode',`note`='$notes',`purchase_price`='$purchase_price',`purchase`='$purchase',"
             . "`warranty`='$warranty',`cat`='$cat',`model_of_payment`='$mode_of_payment',`status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
    
    echo '<div class="alert alert-success">
  <strong>Success!</strong>'.$jina.' has assigned with Asset Name: <strong>'.$asset_name.'</strong>, Issue Date <strong>'.$issue_date.'</strong>
</div>';
    }
 else {
 
       echo '<div class="alert alert-warning error">
  <strong>Warning!</strong> Issue Date,Location and HOD field cant be empty.
</div>'; 
    }
    
}
elseif ($row!=0 AND $employeename==$employe_no) {
    $updatestatus=mysql_query("UPDATE `tbl_employee_asset` SET `location_id`='$locations',`issue_date`='$issue_date',`end_date`='$end_date',`hod_name`='$hod',`registerid`='$asdignid',"
            . "`department_id`='$department_id',`status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
    
    
    $upp=  mysql_query("UPDATE `tbl_fixed_asset` SET `asset_name`='$assname',`description`='$descriptional',`vendor`='$vendor',`model`='$modeli',`serial_number`='$serialno',"
             . "`barcode`='$barcode',`note`='$notes',`purchase_price`='$purchase_price',`purchase`='$purchase',"
             . "`warranty`='$warranty',`cat`='$cat',`model_of_payment`='$mode_of_payment',`status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
   
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Success!</strong> Changes has been saved! Thanks You.
</div>';
   
}
elseif ($row!=0 AND $employeename!=$employe_no) {
       $updatestatus=mysql_query("UPDATE `tbl_employee_asset` SET `location_id`='$locations',`issue_date`='$issue_date',`end_date`='$dateissued',`hod_name`='$hod',`registerid`='$asdignid',"
            . "`department_id`='$department_id',`status`='Reallocated' WHERE `asset_id`='$asseid'") or die(mysql_error());
    
       $insert=  mysql_query("INSERT INTO `tbl_employee_asset`(`employe_no`, `location_id`, `issue_date`, `end_date`, `hod_name`, `registerid`, `department_id`, `asset_id`, `status`) "
            . "VALUES ('$employeename','$locations','$dateissued','$end_date','$hod','$asdignid','$department_id','$asseid','$status')") or die(mysql_error());    
       
    $upp=  mysql_query("UPDATE `tbl_fixed_asset` SET `asset_name`='$assname',`description`='$descriptional',`vendor`='$vendor',`model`='$modeli',`serial_number`='$serialno',"
             . "`barcode`='$barcode',`note`='$notes',`purchase_price`='$purchase_price',`purchase`='$purchase',"
             . "`warranty`='$warranty',`cat`='$cat',`model_of_payment`='$mode_of_payment',`status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
   
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Success!</strong> Changes has been saved! Thanks You.
</div>';
}
 else {    
     $upp=  mysql_query("UPDATE `tbl_fixed_asset` SET `asset_name`='$assname',`description`='$descriptional',`vendor`='$vendor',`model`='$modeli',`serial_number`='$serialno',"
             . "`barcode`='$barcode',`note`='$notes',`purchase_price`='$purchase_price',`purchase`='$purchase',"
             . "`warranty`='$warranty',`cat`='$cat',`model_of_payment`='$mode_of_payment',`status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Success!</strong> Changes has been saved! Thanks.
</div>';
    
 
}
?>


 <script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
                $('.success').delay(4000).fadeOut('normal');
            });
        </script>