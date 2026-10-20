<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once __DIR__ . '/../db.php';
$employee_no = $_POST['employee_no'];
$salary = $_POST['basic_salary'];
$dearness = $_POST['dearness'];
$travell = $_POST['travell'];
$conveyance = $_POST['conveyance'];
$renthouse = $_POST['renthouse'];
$medical = $_POST['medical'];
$ss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee_no'") or die(mysql_error());
$row = mysql_num_rows($ss);
if ($row != 0) {
    $sss = mysql_query("SELECT * FROM  tbl_accounts WHERE emp_file_no='$employee_no'") or die(mysql_error());
    $roww = mysql_num_rows($sss);
    if ($roww == 0) {
        $insertinto = mysql_query("INSERT INTO tbl_accounts(emp_file_no,salary,allowance,travel_allowance,Conveyance_allowance,House_rent_allowance,Medical_allowance)"
                . "VALUES('$employee_no','$salary','$dearness','$travell','$conveyance','$renthouse','$medical')") or die(mysql_error());
        if ($insertinto) {
            echo '<div class="alert alert-success  error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull!</strong>';
        }
    }  else {
        echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Employee With Employee Id: <span class="fg-red">'.$employee_no.'</span> Already Assigned to the Payroll</strong>
</div>'; 
    }
} else {
    echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>No Employee With Employee Id <span class="fg-red">' . $employee_no . '</span>, Please Register Employee First!</strong>
</div>';
}
?>