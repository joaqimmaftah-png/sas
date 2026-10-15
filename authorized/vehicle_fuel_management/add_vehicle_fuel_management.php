<?php
include '../db.php';
$vehiclereg = $_POST['vehiclereg'];
$drivername = $_POST['drivername'];
$drivernamber =str_replace('','+',$_POST['drivernamber']);
$team = $_POST['team'];
$vendor = $_POST['vendor'];
$status = $_POST['status'];
$locations = $_POST['locations'];
 $a=mysql_query("INSERT INTO tbl_fuel_vehicles(`vehicle_reg_num`,`vendor`,`driver`,`driver_phone_num`,`team`,`locations`,`status`)VALUES('$vehiclereg','$vendor','$drivername','$drivernamber','$team','$locations','$status')") or die(mysql_error());
echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully Added</strong>';

?>

