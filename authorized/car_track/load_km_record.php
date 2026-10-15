<?php

include_once '../db.php';
$select_from_service=mysql_query("SELECT * FROM tbl_car_services_history  ORDER BY services_hostory_id DESC") or die(mysql_error());
// get data and store in a json array
while ($row1=  mysql_fetch_array($select_from_service)) {
    $vehicle_reg_numm=$row1['vehicle_reg_num'];
    
    $summ=  mysql_query("SELECT * FROM tbl_car_services WHERE vehicle_reg_num='$vehicle_reg_numm'") or die(mysql_error());
    $rows = mysql_fetch_array($summ);
    $query = "SELECT * FROM tbl_car_informations WHERE vehicle_reg_num='$vehicle_reg_numm'";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    $rrow=  mysql_fetch_array($resultT);
    
    $replaced_part_ref=$rows['replaced_part_ref'];
    
    $quer3 = "SELECT * FROM tbl_car_monitoring where vehicle_reg_num='$vehicle_reg_numm'";
    $rows3= mysql_query($quer3) or die("SQL Error 1: " . mysql_error());
    $rw=mysql_fetch_array($rows3);
    $driver_contact=$rw['driver_contact'];
    $stock[] = array(  
        'check'=>'<a href="#">View</a>',
        'vehicle_reg_num'=>$rrow['vehicle_reg_num'],
        'make'=>$rrow['make'],
        'model'=>$rrow['model'],
        'Drivername'=>$rw['driver_name'], 
        'Drivercontact'=>$driver_contact,
        'location'=>$rw['vehicle_centre'], 
        'last_served_date'=>$row1['last_served_date'],       
        'last_km'=>$row1['last_km'],        
        'current_km'=>$row1['current_km']     
        
        
   
    );
}
echo json_encode($stock);
?>
