<?php

include_once '../db.php';


$query = "SELECT * FROM tbl_rca where alarm_date  ORDER BY rcs_id DESC";
$resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
$u=1;
while ($rrow = mysql_fetch_array($resultT, MYSQL_ASSOC)) {
    $site_id=$rrow['site_id'];
    $show_driver=  mysql_query("SELECT * FROM tbl_site_db WHERE site_id='$site_id'") or die(mysql_error());
    $showing=mysql_fetch_array($show_driver);
    $site_name=$showing['site_name'];
    $ward=$showing['ward'];
    $district=$showing['district'];
    $region=$showing['region'];
    $superid=$showing['field_supervisor'];
     $tech_id=$showing['tech_name'];
     $noc_id=$rrow['noc_operator'];
     $rca_id=$rrow['rcs_id'];
     
     
     $status=$rrow['tt_status'];
     if($status=='closed'){
         $f="";
     }
 else {
         
         $f="color:red";
     }
     
     $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$tech_id'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $phone= $de['phone'];
                 $dq=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$superid'") or die(mysql_error());
                $da=  mysql_fetch_array($dq);
                 $phone2= $da['phone'];
//     $tech_name=$showing['tech_phone'];
     
     $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$superid'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
                $field_supervisor=$first_name." ".$surname;
                ////////////////////////////////////////////////
                $tbl_customerr = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$tech_id'") or die(mysql_error());
                $rowss = mysql_fetch_array($tbl_customerr);
                $first_namea = $rowss['first_name'];
                $surnamea = $rowss['surname'];
                $tech_name=$first_namea." ".$surnamea;
                
                $tbl_uo = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$noc_id'") or die(mysql_error());
                $re = mysql_fetch_array($tbl_uo);
                $f1 = $re['first_name'];
                $s1 = $re['surname'];
                $noc_operator=$f1." ".$s1;
     
    $stock[] = array( 
        'link'=>$u++,
        'site_id'=>$rrow['site_id'],        
        'site_name'=>$site_name,
        'ward'=>$ward,
        'district'=>$district, 
        'region'=>$region,
        'field_supervisor'=>$field_supervisor,
        'tech_name'=>$tech_name,
        'tech_phone'=>$phone,
         'noc_operator'=>$noc_operator,
         'alarm_date'=>$rrow['alarm_date'],
         'alarm_time'=>$rrow['alarm_time'],
         'oos_date'=>$rrow['oos_date'],
        'oos_time'=>$rrow['oos_time'],       
        'date_reported'=>$rrow['date_reported'],        
        'time_reported'=>$rrow['time_reported'],
        'time_in'=>$rrow['time_in'],      
        'time_out'=>$rrow['time_out'],
        'fault_clear_date'=>$rrow['fault_clear_date'],       
        'clear_time'=>$rrow['clear_time'],
        'ac_down_time'=>$rrow['ac_down_time'],
        'dc_down_time'=>$rrow['dc_down_time'],
        'faults_alarm'=>$rrow['faults_alarm'],
        'primary_cause'=>$rrow['primary_cause'],
        'route_cause'=>$rrow['route_cause'],
        'faults_resolution'=>$rrow['faults_resolution'],
        'tt_status'=>$rrow['tt_status'],
        'tt_closed_by'=>$rrow['tt_closed_by'],
        'remarks'=>$rrow['remarks'],
        'tigo_reference'=>$rrow['tigo_reference'],
        'sincro_reference'=>$rrow['sincro_reference']
        
        
   
    );
}
echo json_encode($stock);
?>
