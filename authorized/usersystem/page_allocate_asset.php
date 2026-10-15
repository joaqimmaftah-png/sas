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

$hod=$exp[0];
$department_id=$exp[1];

$asdignid=$_POST['assigners'];
$hod1=$_POST['hod1'];

$status= $_POST['status'];
$notes=$_POST['notes'];
$locations= $_POST['locations'];
$employeename=$_POST['employeename'];
$issue_date=$_POST['issue_date'];
$end_date=$_POST['issue_date'];




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


//if($row!=0 AND $hod1==$hod AND $employeename==$employe_no){
//    
//  $updatestatus=mysql_query("UPDATE `tbl_employee_asset` SET `issue_date`='$issue_date',"
//            . "`status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
//           
//    $upp=  mysql_query("UPDATE `tbl_fixed_asset` SET `status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
//   
//    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
//    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
//    <strong>Success!</strong> Changes has been saved
//</div>';
//}
//elseif ($row!=0 AND $hod1!=$hod AND $employeename==$employe_no) { 
//    $upp=  mysql_query("UPDATE `tbl_fixed_asset` SET `status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
//    
//           $updatestatus=mysql_query("UPDATE `tbl_employee_asset` SET `location_id`='$locations',`issue_date`='$issue_date',`end_date`='$dateissued',`hod_name`='$hod',`registerid`='$asdignid',"
//            . "`department_id`='$department_id',`status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
//            echo '<div class="alert alert-success fade in" style="margin-top:18px;">
//    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
//    <strong>Success!</strong> Changes has been saved!
//</div>';
//}
//elseif ($row!=0 AND $hod1!=$hod AND $employeename!=$employe_no) {
//   $updatestatus=mysql_query("UPDATE `tbl_employee_asset` SET `issue_date`='$issue_date',"
//            . "`status`='Reallocated' WHERE `asset_id`='$asseid'") or die(mysql_error()); 
//  
//    $upp=  mysql_query("UPDATE `tbl_fixed_asset` SET `status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
//    
//           $insert=  mysql_query("INSERT INTO `tbl_employee_asset`(`employe_no`, `location_id`, `issue_date`,`hod_name`, `registerid`, `department_id`, `asset_id`, `status`,`asset_category_id`) "
//            . "VALUES ('$employeename','$locations','$dateissued','$hod','$asdignid','$department_id','$asseid','$status','$cat')") or die(mysql_error());   
//           
//           
//           
//           
//           echo '<div class="alert alert-success fade in" style="margin-top:18px;">
//    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
//    <strong>Success!</strong> Changes has been saved!
//</div>';
//         
//}


$updatestatus=mysql_query("UPDATE `tbl_employee_asset` SET `issue_date`='$issue_date',"
            . "`status`='Reallocated' WHERE `asset_id`='$asseid'") or die(mysql_error()); 
  
    $upp=  mysql_query("UPDATE `tbl_fixed_asset` SET `status`='$status' WHERE `asset_id`='$asseid'") or die(mysql_error());
    
           $insert=  mysql_query("INSERT INTO `tbl_employee_asset`(`employe_no`, `location_id`, `issue_date`,`hod_name`, `registerid`, `department_id`, `asset_id`, `status`,`asset_category_id`) "
            . "VALUES ('$employeename','$locations','$dateissued','$hod','$asdignid','$department_id','$asseid','$status','$cat')") or die(mysql_error());   
           
           
           if($insert){
                echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Success!</strong> Changes has been saved!
</div>';
           }
 else {    
    echo 'you try to allocate empty asset';
 }
?>


 <script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
                $('.success').delay(4000).fadeOut('normal');
            });
        </script>