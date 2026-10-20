<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once '../db.php';
$query = "SELECT * FROM tbl_rca ORDER BY rcs_id DESC";
$resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
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
     $tname=$rrow['technian_name'];
     $phnumber=$rrow['technician_number'];
     
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
        'link'=>'<a href="#" class="view-rca" style="'.$f.'" '
        . 'data-a="'.$rca_id.'" '
        . 'data-b="'.$site_id.'" '
        . 'data-c="'.$site_name.'" '
        . 'data-d="'.$ward.'" '
        . 'data-e="'.$district.'" '
        . 'data-f="'.$region.'" '
        . 'data-g="'.$field_supervisor.'" '
        . 'data-h="'.$superid.'" '
        . 'data-i="'.$tech_id.'" '
        . 'data-j="'.$tname.'" '
        . 'data-k="'.$phnumber.'" '
        . 'data-l="'.$phone2.'" '        
        . 'data-n="'.$rrow['alarm_time'].'" '
        . 'data-m="'.$rrow['alarm_date'].'" '
        . 'data-o="'.$rrow['oos_date'].'" '
        . 'data-p="'.$rrow['oos_time'].'" '
        . 'data-q="'.$rrow['date_reported'].'" '
        . 'data-r="'.$rrow['time_reported'].'" '
        . 'data-s="'.$rrow['time_in'].'" '
        . 'data-t="'.$rrow['time_out'].'" '
        . 'data-u="'.$rrow['fault_clear_date'].'" '
        . 'data-v="'.$rrow['clear_time'].'" '
        . 'data-w="'.$rrow['ac_down_time'].'" '
        . 'data-x="'.$rrow['dc_down_time'].'" '
        . 'data-y="'.$rrow['faults_alarm'].'" '
        . 'data-z="'.$rrow['primary_cause'].'" '
        . 'data-aa="'.$rrow['route_cause'].'" '
        . 'data-ab="'.$rrow['faults_resolution'].'" '
        . 'data-ac="'.$rrow['tigo_reference'].'" '
        . 'data-ad="'.$rrow['sincro_reference'].'" '
        . 'data-ae="'.$rrow['tt_closed_by'].'" '
        . 'data-af="'.$rrow['tt_status'].'" '
        . 'data-ag="'.$rrow['remarks'].'" '        
        . 'data-toggle="modal" data-target="#editrca">View</a>',
        'site_id'=>'<span style="'.$f.'">'.$rrow['site_id'].'</span>',        
        'site_name'=>'<span style="'.$f.'">'.$site_name.'</span>',
        'ward'=>'<span style="'.$f.'">'.$ward.'</span>',
        'district'=>'<span style="'.$f.'">'.$district.'</span>', 
        'region'=>'<span style="'.$f.'">'.$region.'</span>',
        'field_supervisor'=>'<span style="'.$f.'">'.$field_supervisor.'</span>',
        'tech_name'=>'<span style="'.$f.'">'.$tech_name.'</span>',
        'tech_phone'=>'<span style="'.$f.'">'.$phone.'</span>',
         'noc_operator'=>'<span style="'.$f.'">'.$noc_operator.'</span>',
         'alarm_date'=>'<span style="'.$f.'">'.$rrow['alarm_date'].'</span>',
         'alarm_time'=>'<span style="'.$f.'">'.$rrow['alarm_time'].'</span>',
         'oos_date'=>'<span style="'.$f.'">'.$rrow['oos_date'].'</span>',
        'oos_time'=>'<span style="'.$f.'">'.$rrow['oos_time'].'</span>',       
        'date_reported'=>'<span style="'.$f.'">'.$rrow['date_reported'].'</span>',        
        'time_reported'=>'<span style="'.$f.'">'.$rrow['time_reported'].'</span>',
        'time_in'=>'<span style="'.$f.'">'.$rrow['time_in'].'</span>',      
        'time_out'=>'<span style="'.$f.'">'.$rrow['time_out'].'</span>',
        'fault_clear_date'=>'<span style="'.$f.'">'.$rrow['fault_clear_date'].'</span>',       
        'clear_time'=>'<span style="'.$f.'">'.$rrow['clear_time'].'</span>',
        'ac_down_time'=>'<span style="'.$f.'">'.$rrow['ac_down_time'].'</span>',
        'dc_down_time'=>'<span style="'.$f.'">'.$rrow['dc_down_time'].'</span>',
        'faults_alarm'=>'<span style="'.$f.'">'.$rrow['faults_alarm'].'</span>',
        'primary_cause'=>'<span style="'.$f.'">'.$rrow['primary_cause'].'</span>',
        'route_cause'=>'<span style="'.$f.'">'.$rrow['route_cause'].'</span>',
        'faults_resolution'=>'<span style="'.$f.'">'.$rrow['faults_resolution'].'</span>',
        'tt_status'=>'<span style="'.$f.'">'.$rrow['tt_status'].'</span>',
        'tt_closed_by'=>'<span style="'.$f.'">'.$rrow['tt_closed_by'].'</span>',
        'remarks'=>'<span style="'.$f.'">'.$rrow['remarks'].'</span>',
        'tigo_reference'=>'<span style="'.$f.'">'.$rrow['tigo_reference'].'</span>',
        'sincro_reference'=>'<span style="'.$f.'">'.$rrow['sincro_reference'].'</span>'
        
        
   
    );
}
echo json_encode($stock);
?>
