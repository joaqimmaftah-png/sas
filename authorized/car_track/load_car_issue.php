<?php
include_once '../db.php';
$queryy = "SELECT * FROM tbl_car_faults_list  ORDER BY fault_id DESC";
$resultTT = mysql_query($queryy) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
$j=1;
while ($roww = mysql_fetch_array($resultTT, MYSQL_ASSOC)) {
    $fault_idd=$roww['fault_id'];
    $query = "SELECT * FROM tbl_car_faults  where fault_id='$fault_idd'";
$resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    $row = mysql_fetch_array($resultT);
    $f="color:black";
    $vehicle_reg_num=$row['vehicle_reg_num'];
    $fault_id=$row['fault_id'];
    $queryy = "SELECT * FROM tbl_car_monitoring where vehicle_reg_num='$vehicle_reg_num'";
    $rows= mysql_query($queryy) or die("SQL Error 1: " . mysql_error());
    $rrow=mysql_fetch_array($rows);
     
    $stock[] = array( 
        'Action'=>'<a href="#"  class="view-info" style="'.$f.'" '
        . 'data-a="'.$rrow['vehicle_reg_num'].'" '
        . 'data-b="'.$rrow['vehicle_type'].'" '
        . 'data-c="'.$rrow['owner'].'" '
        . 'data-d="'.$rrow['driver_name'].'" '
        . 'data-e="'.$rrow['driver_contact'].'" '
        . 'data-o="'.$rrow['vehicle_centre'].'" '
        . 'data-f="'.$roww['fault_description'].'" '
        . 'data-g="'.$row['fault_reported_date'].'" '
        . 'data-h="'.$row['date_reported_accounts'].'" '
        . 'data-i="'.$row['operation_conditions'].'" '
        . 'data-j="'.$row['planned_resolution_date'].'" '       
        . 'data-k="'.$row['actual_resolution_date'].'" '
        . 'data-l="'.$row['reasons_remark'].'" '
        . 'data-m="'.$row['status'].'" '
        . 'data-n="'.$fault_id.'" '
        . 'data-p="'.$row['cash_ref'].'" '
        . 'data-q="'.$row['amount_request'].'" '
        . 'data-toggle="modal" data-target="#edit_issue">View</a>',
        'check'=>$j++,
        'vehicle_reg_num'=>$rrow['vehicle_reg_num'],
        'vehicle_type'=>$rrow['vehicle_type'],
        'owner'=>$rrow['owner'],
        'driver_name'=>$rrow['driver_name'], 
        'driver_contact'=>$rrow['driver_contact'],       
        'vehicle_centre'=>$rrow['vehicle_centre'],       
        'fault_description'=>$roww['fault_description'],       
        'fault_reported_date'=>$row['fault_reported_date'],
        'date_reported_accounts'=>$row['date_reported_accounts'],      
        'operation_conditions'=>$row['operation_conditions'],       
        'planned_resolution_date'=>$row['planned_resolution_date'],
        'actual_resolution_date'=>$row['actual_resolution_date'],       
        'reasons_remark'=>$row['reasons_remark'],
        'status'=>$row['status']
        
        
    );
}
echo json_encode($stock);
?>
