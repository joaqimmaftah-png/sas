<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once __DIR__ . '/../db.php';
$employee_id=$_POST['employee_id'];
$salary=$_POST['basic_salary'];
$dearness=$_POST['dearness'];
$travell=$_POST['travell'];
$conveyance=$_POST['conveyance'];
$renthouse=$_POST['renthouse'];
$medical=$_POST['medical'];
$deduction=$_POST['deductiond'];
$reasons_reduct=$_POST['reasons_reduct'];
if($employee_id){
$insertinto=  mysql_query("UPDATE tbl_accounts SET salary='$salary',allowance='$dearness',travel_allowance='$travell',Conveyance_allowance='$conveyance',House_rent_allowance='$renthouse',Medical_allowance='$medical',deduction='$deduction',remark='$reasons_reduct' WHERE emp_file_no='$employee_id'") or die(mysql_error());
echo '<div class="alert alert-success  error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull!</strong>';
}

?>

