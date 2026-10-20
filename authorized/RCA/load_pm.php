<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once '../db.php';
$query = "SELECT * FROM tbl_pm_cm ORDER BY pm_id DESC";
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
     $pm_id=$rrow['pm_id'];
     
     $status=$rrow['status'];
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
        . 'data-a="'.$pm_id.'" '
        . 'data-b="'.$site_id.'" '
        . 'data-c="'.$site_name.'" '
        . 'data-d="'.$ward.'" '
        . 'data-e="'.$district.'" '
        . 'data-f="'.$region.'" '
        . 'data-g="'.$field_supervisor.'" '
        . 'data-h="'.$superid.'" '
        . 'data-i="'.$tech_id.'" '
        . 'data-j="'.$tech_name.'" '
        . 'data-k="'.$phone.'" '
        . 'data-l="'.$phone2.'" '        
        . 'data-n="'.$rrow['activity_date'].'" '
        . 'data-m="'.$rrow['time_in'].'" '
        . 'data-o="'.$rrow['time_out'].'" '
        . 'data-p="'.$rrow['opening_ticket'].'" '
        . 'data-q="'.$rrow['closing_ticket'].'" '
        . 'data-r="'.$rrow['access_type'].'" '
        . 'data-s="'.$rrow['Remarks'].'" '        
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
         'activity_date'=>'<span style="'.$f.'">'.$rrow['activity_date'].'</span>',
         'time_in'=>'<span style="'.$f.'">'.$rrow['time_in'].'</span>',
         'opening_ticket'=>'<span style="'.$f.'">'.$rrow['opening_ticket'].'</span>',
        'time_out'=>'<span style="'.$f.'">'.$rrow['time_out'].'</span>',       
        'closing_ticket'=>'<span style="'.$f.'">'.$rrow['closing_ticket'].'</span>',        
        'access_type'=>'<span style="'.$f.'">'.$rrow['access_type'].'</span>',
        'Remarks'=>'<span style="'.$f.'">'.$rrow['Remarks'].'</span>'      
    );
}
echo json_encode($stock);
?>
