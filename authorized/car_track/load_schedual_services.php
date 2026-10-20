<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once '../db.php';
$select_from_service=mysql_query("SELECT * FROM tbl_car_services   ORDER BY services_id DESC") or die(mysql_error());
// get data and store in a json array
while ($rows=  mysql_fetch_array($select_from_service)) {
    $vehicle_reg_numm=$rows['vehicle_reg_num'];
    $services=$rows['services'];
    $replaced_part_ref=$rows['replaced_part_ref'];
    $summ=  mysql_query("SELECT * FROM tbl_car_services_history WHERE vehicle_reg_num='$vehicle_reg_numm'") or die(mysql_error());
    $row1 = mysql_fetch_array($summ);
    $query = "SELECT * FROM tbl_car_informations WHERE vehicle_reg_num='$vehicle_reg_numm'";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    $rrow=  mysql_fetch_array($resultT);
    
    $quer3 = "SELECT * FROM tbl_car_monitoring where vehicle_reg_num='$vehicle_reg_numm'";
    $rows3= mysql_query($quer3) or die("SQL Error 1: " . mysql_error());
    $rw=mysql_fetch_array($rows3);
    
    if($services=='YES'){
         $f="color:red";
    }
    else{
         $f="";
    }
   
    $stock[] = array(  
        'check'=>'<span style="'.$f.'"><a href="#">View</a></span>',
        'vehicle_reg_num'=>'<span style="'.$f.'">'.$rrow['vehicle_reg_num'].'</span>',
        'make'=>'<span style="'.$f.'">'.$rrow['make'].'</span>',
        'model'=>'<span style="'.$f.'">'.$rrow['model'].'</span>',
        'Drivername'=>'<span style="'.$f.'">'.$rw['driver_name'].'</span>', 
        'location'=>'<span style="'.$f.'">'.$rw['vehicle_centre'].'</span>', 
        'last_served_date'=>'<span style="'.$f.'">'.$rows['service_date'].'</span>',       
        'last_km'=>'<span style="'.$f.'">'.$row1['last_km'].'</span>',        
        'current_km'=>'<span style="'.$f.'">'.$row1['current_km'].'</span>',      
        'due_services'=>'<span style="'.$f.'">'.$services.'</span>',
        'replaced_parts'=>'<span style="'.$f.'"><a href="?ref='.$replaced_part_ref.'">'.$replaced_part_ref.'</a></span>'
        
   
    );
}
echo json_encode($stock);
?>
