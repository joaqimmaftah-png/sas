<?php

include_once '../db.php';
$queryy = "SELECT * FROM site_attendance_update ORDER BY confim_id DESC";
$resultTT = mysql_query($queryy) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
$h=1;
while ($rrowz = mysql_fetch_array($resultTT, MYSQL_ASSOC)) {
    $tech=$rrowz['employee'];
    $timesent=$rrowz['sent_time'];
    $timeverified=$rrowz['update_time'];
    $token=$rrowz['token_number'];
     $d=$rrowz['date'];
    $reportdate=date('Ymd',strtotime($d));
    $query = "SELECT * FROM site_attendence WHERE tech_no='$tech' AND reportdate='$reportdate'";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    $rrow = mysql_fetch_array($resultT, MYSQL_ASSOC);
    $att_id=$rrow['att_id'];
    $tech_no=$rrow['tech_no'];
    $time_in=$rrow['time_in'];
    $time_out=$rrow['time_out'];
    $date_entry=$rrow['date_entry'];
    $long_in=$rrow['lon_n'];
    $lat_in=$rrow['lat_in'];
    $site_id=$rrow['site_id'];
    
    
    $day1hours = $time_in;
$day2hours = $time_out;
$day1 = explode(":", $day1hours);
$day2 = explode(":", $day2hours);

$totalmins = 0;
$totalmins += $day1[0] * 60;
$totalmins += $day1[1];
$totalmins += $day2[0] * 60;
$totalmins += $day2[1];

$hours = $totalmins / 60;
$minutes = $totalmins % 60;

$totalhours = "$hours.$minutes";
    
    
    
     if(empty($time_out)){
        $jumla='';
    }
 else {
       $to_time = strtotime($time_out);
$from_time = strtotime($time_in);
$jumla= round(abs($to_time - $from_time) / 3600,2). " Hours"; 
    }
    
    $sed=mysql_query("SELECT * FROM tbl_class_a_site WHERE s_id='$site_id'") or die(mysql_error());
$ds=  mysql_fetch_array($sed);
$sitename=$ds['sitename'];
    
  
     $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$tech_no'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $phone= $de['phone'];
                 $dq=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$tech_no'") or die(mysql_error());
                $da=  mysql_fetch_array($dq);
                 $phone2= $da['phone'];
               //     $tech_name=$showing['tech_phone'];

                $tbl_customerr = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$tech_no'") or die(mysql_error());
                $rowss = mysql_fetch_array($tbl_customerr);
                $first_namea = $rowss['first_name'];
                $surnamea = $rowss['surname'];
                $tech_name=$first_namea." ".$surnamea;
                
                $f="color:black";
    $stock[] = array( 
        
        'No'=>$h++,        
        'id_no'=>$tech_no,
        'employee_name'=>$tech_name,
        'sitename'=>$sitename,
        'entry_date'=>date('d-m-Y',strtotime($date_entry)), 
        'timesent'=>$timesent,
        'timeverified'=>$timeverified,
        'latitude'=>$lat_in,
        'token'=>$token,
         'longitude'=>$long_in      
    );
}
echo json_encode($stock);
?>
