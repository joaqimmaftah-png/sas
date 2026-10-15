<?php
include '../db.php';
$vehiclereg = $_POST['vehiclereg'];
$vehiclereg1 = $_POST['req'];
$drivername = $_POST['drivername'];
$drivernamber=str_replace(' ','+',$_POST['drivernamber']);
$team = $_POST['team'];
$vendor = $_POST['vendor'];
$status = $_POST['status'];
$locations = $_POST['locations'];
$balance=$_POST['balance'];
$fulltank=$_POST['fulltank'];
if(!empty($balance)){
    $q=  mysql_query("SELECT * FROM tbl_fuel_vehicles WHERE vehicle_id='$vehiclereg1'") or die(mysql_error());
    $W=  mysql_fetch_array($q);
    $lastbalance=$W['fuel_balance'];
    $sum=$balance;
$m=mysql_query("UPDATE tbl_fuel_vehicles SET vehicle_reg_num='$vehiclereg',vendor='$vendor',driver='$drivername',"
        . "driver_phone_num='$drivernamber',team='$team',locations='$locations',status='$status',fuel_balance='$sum',fuel_amounts='$fulltank' WHERE vehicle_id='$vehiclereg1'") or die(mysql_error());
echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="?action=vehicle_fuel_list" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully Updated</strong>
</div>';
}  else {
    $m=mysql_query("UPDATE tbl_fuel_vehicles SET vehicle_reg_num='$vehiclereg',vendor='$vendor',driver='$drivername',"
        . "driver_phone_num='$drivernamber',team='$team',locations='$locations',status='$status',fuel_amounts='$fulltank',fuel_balance='$sum' WHERE vehicle_id='$vehiclereg1'") or die(mysql_error());
echo '<div class="alert alert-success">
<a href="?action=vehicle_fuel_list" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull Updated</strong>
</div>';

}
?>
