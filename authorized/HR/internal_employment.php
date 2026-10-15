<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../model/db.php';
$comname=$_POST['comname'];
$sdatee=$_POST['sdatee'];
$enddate=$_POST['enddate'];
$department=$_POST['department'];
$position=$_POST['position'];


    
if(isset($_POST['internaladd'])){
    $employee_no=$_POST['employee_no'];
    $add_employment_history=mysql_query("INSERT INTO  tbl_internal_employment(`company_loc`, `department`, `position`, `start_date`, `end_start`,employee_no)"
        . "VALUE('$comname','$department','$position','$sdatee','$enddate','$employee_no')") or die(mysql_error());
echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully Added!</strong>
</div>';
    
}

if(isset($_POST['editing'])){
    $internal=$_POST['internal'];
    $update=  mysql_query("UPDATE tbl_internal_employment SET company_loc='$comname',department='$department',position='$position',"
            . "start_date='$sdatee',end_start='$enddate' WHERE internal_id='$internal'") or die(mysql_error());
   echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully Added!</strong>
</div>' ;
}


