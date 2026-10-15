<?php
include_once 'authorized/db.php';
$employeenumber=$_POST['employeenumber'];
$password=md5($_POST['oldpass']);
$prove=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$retypepass=$_POST['retypepass'];
if($newpass==$retypepass){
    $a=mysql_query("SELECT * FROM  tbl_user_accounts WHERE emp_file_no='$employeenumber'") or die(mysql_error());
    $b=mysql_fetch_array($a);
    $pass1=$b['password'];
    $newpass1=  md5($_POST['newpass']);
    if($pass1==$password){
        $c=  mysql_query("UPDATE tbl_user_accounts SET password='$newpass1' WHERE emp_file_no='$employeenumber'") or die(mysql_error());
       if($c){
               echo '<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfull! Password Changed</strong> 
</div>';
       } 
        
    }  else {
         echo '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>You have Entered the wrong Password <span class="fg-blue bold">'.$prove.'</span></strong> 
</div>';
    }
} else {
    echo '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>New Password and Retype Password Do Not Match</strong> 
</div>';
}


