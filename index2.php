<?php
require_once __DIR__ . '/mysql_compat.php';

if(isset($_POST['login'])) {

include 'authorized/db.php';
$emp=$_POST['emp'];
$password1=$_POST['password'];
$password=md5($password1);

$result = mysql_query("SELECT * FROM tbl_user_accounts WHERE emp_file_no='$emp' and password = '$password'");
$row  = mysql_num_rows($result);
$show=  mysql_fetch_array($result);
$emp_file_no=$show['emp_file_no'];
$usertype=$show['usertype'];
$access_lever=$show['access_lever'];
$store_access=$show['store_access'];
$hod_system_access=$show['hod_system_access'];
$asset_tracker=$show['asset_tracker'];
$cash_request=$show['cash_request'];
$operation_acce=$show['operation_director_access'];
$account_access=$show['account_access'];
$opm=$show['opm_sys'];
$noc_operator=$show['noc_operator'];
$Solar=$show['Solar'];
$manage_fuel=$show['manage_fuel'];
$manage_fuel_acc=$show['manage_fuel_acc'];
if($row==1) {
    session_start();
  $_SESSION['emp_file_no']= $emp_file_no;
 $_SESSION['access_lever']=$access_lever;
 $_SESSION['usertype']=$usertype;
 $_SESSION['store_access']=$store_access;
 $_SESSION['hod_system_access']=$hod_system_access;
 $_SESSION['asset_tracker']=$asset_tracker;
 $_SESSION['cash_request']=$cash_request;
 $_SESSION['operation_director_access']=$operation_acce;
 $_SESSION['account_access']=$account_access;
 $_SESSION['opm_sys']=$opm;
  $_SESSION['noc_operator']=$noc_operator;
 $_SESSION['Solar']=$Solar;
 $_SESSION['manage_fuel']=$manage_fuel;
 $_SESSION['manage_fuel_acc']=$manage_fuel_acc;
 
if($usertype=='HR' AND $emp_file_no==$_SESSION['emp_file_no']){ 
        header("Location:home_hrms.php");
              
}
elseif($usertype=='staff' AND $emp_file_no==$_SESSION['emp_file_no']){ 
//     header("Location:https://sincrositewatchtz.com/user_accounts.php");
    echo '<script type="text/javascript">
           window.location = "user_accounts.php"
      </script>';
}
else {
 
  
//     echo '<script type="text/javascript">
//           window.location = ""
//      </script>';
}
 
}

}else{
session_start();
unset($_SESSION["emp_file_no"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SINCRO AUTOMATION SYSTEM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
 
    <div class="row" style="margin-top: 4%;">
     <div class="col-lg-3"></div>
     <div class="col-lg-6">
            <div class="middlePage">
<div class="page-header">
    <h1 class="logo"><img class="img-responsive" src="head.png"></h1>
</div>
        </div>
         
          <div class="modal-content">
      <div class="modal-header">
<!--        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<h5 class="modal-title"><i class="glyphicon glyphicon-lock"></i>&nbsp;Login SAS V2.1</h5>
      </div>
      <div class="modal-body">
       <?php
          if(isset($_GET['error'])=='1'){              
          
          ?>
          <div class="alert alert-danger">
  <strong>Error!</strong> Wrong Username or Password. Try again or Reset password.
</div>
          <?php
          }
          ?>
         <form action="" method='post'>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="email" type="text" class="form-control" name="emp" placeholder="Username (SSW 001)">
    </div>
      <br>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" class="form-control" name="password" placeholder="Password">
    </div>
      <br>
    <div class="input-group">
        <button type="submit"  name="login" class="btn btn-info ">Sign In</button>&nbsp;
      <button  name="singlebutton" class="btn btn-default  ">Reset</button>
    </div>
      

  </form> 
      </div>
      <div class="modal-footer">
        Forgot Password? <a href="#">Reset Password</a>
      </div>
    </div>
        
     </div>
     <div class="col-lg-3"></div>
    
 </div>

  
</div>

</body>
</html>


