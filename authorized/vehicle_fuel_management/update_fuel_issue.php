<?php
include '../db.php';
$vehiclereg=$_POST['vehiclereg']; 
$fulltank=$_POST['fulltank']; 
$vehiclekm=$_POST['vehiclekm'];
 $amountsissued=$_POST['amountsissued']; 
 $issued_date=$_POST['issued_date'];
 $balance=$_POST['balance'];
 $q=mysql_query("UPDATE tbl_fuel_vehicles SET fuel_amounts='$fulltank',vehicle_km='$vehiclekm',fuel_balance='$balance',issued_amount='$amountsissued',issued_date='$issued_date' WHERE vehicle_reg_num='$vehiclereg'") or die(mysql_error());
 echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully Updated</strong>
</div>';
?>
