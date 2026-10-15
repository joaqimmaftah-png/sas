<?php
      include '../db.php';
     $position = $_POST['position'];
    $department = $_POST['department'];
     $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
   $comments = $_POST['comments'];
    $designation = $_POST['designation'];
    $employee_no = $_POST['employee_no'];
            $ss=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee_no'") or die(mysql_error());
    $row= mysql_num_rows($ss);
        if($row!=0){
            $sss=  mysql_query("SELECT * FROM  tbl_assign_to_department WHERE emp_file_no='$employee_no'") or die(mysql_error());
    $roww= mysql_num_rows($sss);   
    if($roww==0){
        /////////////////////////////////////////////////
    $insertS = "INSERT INTO tbl_assign_to_department(emp_file_no,department_id,position_id,designation,start_date,end_date,comments)"
            . " VALUES('$employee_no','$department','$position','$designation','$sdate','$edate','$comments')";
    mysql_query($insertS) or die(mysql_error());
    ///////////////////////////jaza ndani kwenye internal employment///////////////////////////
    $departments = mysql_query("SELECT * FROM tbl_department WHERE department_id='$department'") or die(mysql_error());
$positioning = mysql_query("SELECT * FROM tbl_position WHERE position_id='$position'") or die(mysql_error());
$dep = mysql_fetch_array($departments);
$pos = mysql_fetch_array($positioning);
$department_name = $dep['department_name'];
$position_name = $pos['position_name'];
        $add_employment_history=mysql_query("INSERT INTO  tbl_internal_employment(`company_loc`, `department`, `position`, `start_date`, `end_start`,employee_no)"
        . "VALUE('$comments','$department_name','$position_name','$sdate','$edate','$edate')") or die(mysql_error());
    
    ////////////////////////////////////////////////////////////
    if($insertS){
         echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully!</strong>
</div>';
    }
        }else {
             echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Employee With Employee Id: <span class="fg-red">'.$employee_no.'</span> Already Assigned to the department</strong>
</div>'; 
}
        }
        else {
             echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>No Employee With Employee Id <span class="fg-red">'.$employee_no.'</span>, Please Register Employee First!</strong>
</div>'; 
}
        
        ?>

