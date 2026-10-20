<?php
require_once __DIR__ . '/../mysql_compat.php';

include_once '../db.php';
$query = "SELECT * FROM tbl_car_monitoring  ORDER BY car_id DESC";
$resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($rrow = mysql_fetch_array($resultT, MYSQL_ASSOC)) {
    
    $vehicle_reg_num=$rrow['vehicle_reg_num'];
    $queryy = "SELECT * FROM tbl_car_faults where vehicle_reg_num='$vehicle_reg_num'";
    $rows= mysql_query($queryy) or die("SQL Error 1: " . mysql_error());
    $row=mysql_fetch_array($rows);
     $date_reported_accounts=$row['date_reported_accounts'];
    $today=date("d.m.Y");
    $date1 = new DateTime($date_reported_accounts);
    $date2 = new DateTime($today);
    $diff = $date2->diff($date1)->format("%a");
    $stock[] = array(  
        'check'=>'<input type="checkbox" name="" onchange="gotoaction(this.value)" value="'.$rrow['car_id'].'">',
        'vehicle_reg_num'=>$rrow['vehicle_reg_num'],
        'vehicle_type'=>$rrow['vehicle_type'],
        'owner'=>$rrow['owner'],
        'driver_name'=>$rrow['driver_name'], 
        'driver_contact'=>$rrow['driver_contact'],       
        'vehicle_centre'=>$rrow['vehicle_centre'],       
        'fault_description'=>$row['fault_description'],        
        'fault_reported_date'=>$row['fault_reported_date'],
        'date_reported_accounts'=>$row['date_reported_accounts'],      
        'overlapped_days'=>$diff,
        'operation_conditions'=>$row['operation_conditions'],       
        'planned_resolution_date'=>$row['planned_resolution_date'],
        'actual_resolution_date'=>$row['actual_resolution_date'],       
        'reasons_remark'=>$row['reasons_remark'],
        'status'=>$row['status']
        
        
    );
}
echo json_encode($stock);
?>
