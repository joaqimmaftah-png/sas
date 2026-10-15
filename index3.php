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
//if($row==1) {
//    session_start();
//  $_SESSION['emp_file_no']= $emp_file_no;
// $_SESSION['access_lever']=$access_lever;
// $_SESSION['usertype']=$usertype;
// $_SESSION['store_access']=$store_access;
// $_SESSION['hod_system_access']=$hod_system_access;
// $_SESSION['asset_tracker']=$asset_tracker;
// $_SESSION['cash_request']=$cash_request;
// $_SESSION['operation_director_access']=$operation_acce;
// $_SESSION['account_access']=$account_access;
// $_SESSION['opm_sys']=$opm;
//  $_SESSION['noc_operator']=$noc_operator;
// $_SESSION['Solar']=$Solar;
// $_SESSION['manage_fuel']=$manage_fuel;
// $_SESSION['manage_fuel_acc']=$manage_fuel_acc;
// 
//if($usertype=='HR' AND $emp_file_no==$_SESSION['emp_file_no']){ 
//        header("Location:home_hrms.php");
//              
//}
//elseif($usertype=='staff' AND $emp_file_no==$_SESSION['emp_file_no']){ 
////     header("Location:https://sincrositewatchtz.com/user_accounts.php");
//    echo '<script type="text/javascript">
//           window.location = "user_accounts.php"
//      </script>';
//}
else {

}
 
}

}
//else{
//session_start();
//unset($_SESSION["emp_file_no"]);
//}