<?php
require_once __DIR__ . '/../../mysql_compat.php';


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once __DIR__ . '/../db.php';

if(isset($_POST['insertpastemployee'])){
    $comname=$_POST['comname'];
$sdatee=$_POST['sdatee'];
$enddate=$_POST['enddate'];
$department=$_POST['department'];
$position=$_POST['position'];
$role=$_POST['role'];
$employee_no=$_POST['employee_no'];
    
$add_employment_history=mysql_query("INSERT INTO tbl_employment_history(`company_name`, `start_date`, `end_date`, `department`, `position`, `role`,`employee_no`)"
        . "VALUE('$comname','$sdatee','$enddate','$department','$position','$role','$employee_no')") or die(mysql_error());
echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully Added!</strong>
</div>';
}

    if(isset($_POST['history_update'])){
        $comname=$_POST['comname'];
$sdatee=$_POST['sdatee'];
$enddate=$_POST['enddate'];
$department=$_POST['department'];
$position=$_POST['position'];
$role=$_POST['role'];

        $update_employment_history=  mysql_query("UPDATE tbl_employment_history SET `company_name`='$comname', `start_date`='$sdatee', `end_date`='$enddate', `department`='$department', "
                . "`position`='$position', `role`='$role' WHERE history_id='".$_POST['history_update']."'") or die(mysql_error());
        echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully Update!</strong>
</div>';
    }