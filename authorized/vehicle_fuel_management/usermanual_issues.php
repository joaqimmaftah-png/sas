<?php
$webhook_secret = 'ZWCNMAP3FC3C2ATTK3A4TAGX7U36UFLW';
include_once '../db.php';
require_once '../telerivet.php';
$request_oil = $_POST['request_oil'];
$vehicle_id = $_POST['vehicle_id'];
$status = $_POST['status'];
 $issueddate = date("d.m.Y");
 $orderno=intval($_POST['orderno']);
$fstation=$_POST['fstation'];
$vendors=$_POST['vendors'];
$km=intval($_POST['km']);
$N = mysql_query("SELECT * FROM tbl_fuel_vehicles WHERE vehicle_id='$vehicle_id'") or die(mysql_error());
$n = mysql_fetch_array($N);
$fuel_balance = $n['fuel_balance'];
$reg=$n['vehicle_reg_num'];
$driver_phone_num=$n['driver_phone_num'];
$remainbalance = $fuel_balance-$request_oil;
$vendor_number=$n['vendor_number'];
$driver=$n['driver'];
$montt = date("M");
$dateform = date("dmY");
 $r=mysql_query("SELECT * FROM tbl_fuel_vehicle_list WHERE driver_phone_num='$driver_phone_num' AND issued_date='$issueddate'") or die(mysql_error());
 $R=mysql_query("SELECT SUM(issued_amount),SUM(km) FROM tbl_fuel_vehicle_list WHERE driver_phone_num='$driver_phone_num' AND issued_date='$issueddate'") or die(mysql_error());
 $sumrequestedperday=$R['SUM(issued_amount)'];
 $sumkm=$R['SUM(km)'];
 if(is_int($km) AND is_int($orderno)){
     $correctval=$km;
     $corrective_order=$orderno;
 }  else {
    $correctval='';  
    $corrective_order=''; 
}



if (!empty($request_oil) AND !empty($vehicle_id)){
    if($fuel_balance>=$request_oil){     
       $p = mysql_query("INSERT INTO tbl_fuel_vehicle_list(`vehicle_id`,`vehicle_reg_num`,`issued_amount`,`issued_date`,`km`,`driver_phone_num`,`status`,order_number)"
                        . " VALUE('$vehicle_id','$reg','$request_oil','$issueddate','$km','$driver_phone_num','$status','$orderno')") or die(mysql_error());
        if($p){        
         $d = mysql_query("UPDATE tbl_fuel_vehicles SET fuel_balance='$remainbalance',vehicle_km='$sumkm' WHERE driver_phone_num='$driver_phone_num'") or die(mysql_error());
         echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>Your balance is  ' . "$remainbalance" . ' Litres
</div>';
        if(!empty($driver_phone_num)){
           $messagess = "Your fuel balance is " . $remainbalance . " litres for the month of " . $montt . "";
                    $YOUR_API_KEY = 'NDISzydQeMTZeoDcloLesCKOnHxZMHch ';
                    $project_id = 'PJ919596e81c9128f7';
                    $tr = new Telerivet_API($YOUR_API_KEY);
                    $project = $tr->initProjectById($project_id);
                    $sent_msg = $project->sendMessage(array(
                        'content' => $messagess,
                        'to_number' => $driver_phone_num
                    )); 
        }if(!empty($vendor_number)) {
                $messagesss = $dateform."-".$request_oil."-".$orderno."-".$km."-".$reg."-".$driver."-".$fstation;
                    $YOUR_API_KEY = 'NDISzydQeMTZeoDcloLesCKOnHxZMHch ';
                    $project_id = 'PJ919596e81c9128f7';                   
                    $tr = new Telerivet_API($YOUR_API_KEY);
                    $project = $tr->initProjectById($project_id);
                    $sent_msg = $project->sendMessage(array(
                        'content' => $messagesss,
                        'to_number' => $vendor_number
                    )); 
            } 
         
        }
    }  else {
         echo '<div class="alert alert-danger fade in error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error!</strong>Your balance is Only ' . "$fuel_balance" . ' Litres 
</div>';
         $uu = "Your balance is Only  " . $fuel_balance;
          $YOUR_API_KEY = 'NDISzydQeMTZeoDcloLesCKOnHxZMHch ';
                    $project_id = 'PJ919596e81c9128f7';
                    $tr = new Telerivet_API($YOUR_API_KEY);
                    $project = $tr->initProjectById($project_id);
                    $sent_msg = $project->sendMessage(array(
                        'content' => $uu,
                        'to_number' => $driver_phone_num
                    )); 
    }
}
else {
    echo '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Error!Either Fuel Amount or Vehicle Registration is Empty</strong> 
</div>';
}

