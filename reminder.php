<?php

$webhook_secret = 'ZWCNMAP3FC3C2ATTK3A4TAGX7U36UFLW';

if ($_POST['secret'] !== $webhook_secret) {
    header('HTTP/1.1 403 Forbidden');
    echo "Invalid webhook secret";
} else {
    if ($_POST['event'] == 'incoming_message') {
        include '../db.php';
        require_once '../../telerivet.php';
        $content = $_POST['content'];
        $from_number = $_POST['from_number'];
        $phone_id = $_POST['phone_id'];
        $chagua = explode("-", $content);
        $requestamount = $chagua[1];
        $ordernamba = intval($chagua[2]);
        $kmused=intval($chagua[3]);
        $N = mysql_query("SELECT * FROM tbl_fuel_vehicles WHERE driver_phone_num='$from_number'") or die(mysql_error());
        $n = mysql_fetch_array($N);
        $fuel_balance = $n['fuel_balance'];
        $vendor_number = $n['vendor_number'];
        $fuel_amounts=$n['fuel_amounts'];
        $vendor = $n['vendor'];
        $vehicle_id = $n['vehicle_id'];
        $reg = $n['vehicle_reg_num'];
        $driver_phone_num = $n['driver_phone_num'];
        $remainbalance = $fuel_balance - $requestamount;
        $issueddate = date("d.m.Y");
        $status = "Request Using Phnone Number";
        $montt = date("M");
        $r=mysql_query("SELECT * FROM tbl_fuel_vehicle_list WHERE driver_phone_num='$from_number' AND issued_date='$issueddate'") or die(mysql_error());
        $R=mysql_query("SELECT SUM(fuel_balance) FROM tbl_fuel_vehicle_list WHERE driver_phone_num='$from_number' AND issued_date='$issueddate'") or die(mysql_error());
        $sumrequestedperday=$R['SUM(fuel_balance)'];
        $todayreain=$fuel_amounts-$sumrequestedperday;
                if(is_int($kmused) AND is_int($ordernamba)){
     $correctval=$kmused;
     $corrective_order=$ordernamba;
 }  else {
    $correctval='';  
    $corrective_order=''; 
 }
        
        
        

       

        if (!empty($requestamount) AND !empty($from_number)) {
            if ($fuel_balance >= $requestamount) {
                if($fuel_amounts>=$requestamount){
                    if($todayreain>=$requestamount){
             $p = mysql_query("INSERT INTO tbl_fuel_vehicle_list(`vehicle_id`,`vehicle_reg_num`,`issued_amount`,`issued_date`,km,`driver_phone_num`,`status`,order_number)"
                        . " VALUE('$vehicle_id','$reg','$requestamount','$issueddate','$correctval','$driver_phone_num','$status','$ordernamba')") or die(mysql_error());
                if ($p) {
                    $messagess = "Your fuel balance is " . $remainbalance . " litres for the month of " . $montt . "";
                    $d = mysql_query("UPDATE tbl_fuel_vehicles SET fuel_balance='$remainbalance' WHERE driver_phone_num='$from_number'") or die(mysql_error());
                    // do something with the message, e.g. send an autoreply            
                    header("Content-Type: application/json");
                    echo json_encode(array(
                        'messages' => array(
                            array('content' => $messagess)
                        )
                    ));
                    //auto send messages 

                    $YOUR_API_KEY = 'NDISzydQeMTZeoDcloLesCKOnHxZMHch';
                    $project_id = 'PJ919596e81c9128f7';
                    $mm = $_POST['content'];
                    $tr = new Telerivet_API($YOUR_API_KEY);
                    $project = $tr->initProjectById($project_id);
                    $sent_msg = $project->sendMessage(array(
                        'content' => $mm,
                        'to_number' => $vendor_number
                    ));

                    //end tuma message          
                }
            } 
            }
                
 else {
     $messagess = "Fail!Your Maximum fuel balance is only ".$fuel_amounts." per day.You Balance Today is ".$todayreain."";
                    // do something with the message, e.g. send an autoreply            
                  $YOUR_API_KEY = 'NDISzydQeMTZeoDcloLesCKOnHxZMHch';
                    $project_id = 'PJ919596e81c9128f7';
                    
                    $tr = new Telerivet_API($YOUR_API_KEY);
                    $project = $tr->initProjectById($project_id);
                    $sent_msg = $project->sendMessage(array(
                        'content' => $messagess,
                        'to_number' => $from_number
                    ));
 }
            
            
        }     
            else {
                if (!empty($fuel_balance)) {
                    $uu = "Request Failed! Your balance is Only ".$fuel_balance. " Litres,Either balance or Message Format not Correct";
                    // do something with the message, e.g. send an autoreply            
                    header("Content-Type: application/json");
                    echo json_encode(array(
                        'messages' => array(
                            array('content' => $uu)
                        )
                    ));
                    
                    if($uu){
                    $YOUR_API_KEY = 'NDISzydQeMTZeoDcloLesCKOnHxZMHch';
                    $project_id = 'PJ919596e81c9128f7';
                    $messageformat="Correct Format is 04112015-70-13208-470-T612SIN-JOAQIM-TSN BAMAGA";
                    $tr = new Telerivet_API($YOUR_API_KEY);
                    $project = $tr->initProjectById($project_id);
                    $sent_msg = $project->sendMessage(array(
                        'content' => $messageformat,
                        'to_number' => $from_number
                    ));
                    }
                }
            }

            
            
            
            
            
        }
//if event end  
 else {
 
 
                
        }
    }
}
?>
    





