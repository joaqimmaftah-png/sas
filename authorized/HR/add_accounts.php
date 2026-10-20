<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once __DIR__ . '/../db.php';
        $employee_no=$_POST['employe_no'];
        $usertype=$_POST['usertype'];
        $password=$_POST['password'];
        $status=$_POST['status'];
        $password1=md5($password);
        $update=mysql_query("UPDATE tbl_user_accounts SET password='$password1',usertype='$usertype',status='$status' WHERE emp_file_no='$employee_no'") or die(mysql_error());
        if($update){
           echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully!</strong>
</div>';
        }

?>

