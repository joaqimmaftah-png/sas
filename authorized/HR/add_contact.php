<?php
require_once __DIR__ . '/../../mysql_compat.php';

    include_once __DIR__ . '/../db.php';
     $email = $_POST['email'];
     $email2 = $_POST['email2'];
    $phone = $_POST['phone'];
    $phone2 = $_POST['phone2'];
    $employee_no = $_POST['employee_no'];
    $postal_addr = $_POST['poster'];
        $ss=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee_no'") or die(mysql_error());
    $row= mysql_num_rows($ss);
        if($row!=0){
            $sss=  mysql_query("SELECT * FROM  tbl_contact WHERE emp_file_no='$employee_no'") or die(mysql_error());
    $roww= mysql_num_rows($sss);
    if($roww==0){
    $insert = "INSERT INTO tbl_contact(emp_file_no,phone,phone2, postal_addr,email,email2)"
            . " VALUES('$employee_no','$phone','$phone2','$postal_addr','$email','$email2')";
    mysql_query($insert) or die(mysql_error());
        
     if($insert){
           echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully!</strong>
</div>';
     }
    }
    }
     else {
      echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>No Employee With Employee Id <span class="fg-red">'.$employee_no.'</span>, Please Register Employee First!</strong>
</div>';  
     }
?>
