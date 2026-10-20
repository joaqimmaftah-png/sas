<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once '../db.php';

$fromm=$_GET['from'];
$too=$_GET['to'];
$from=date("Ymd", strtotime($fromm));
$to=date("Ymd", strtotime($too)); 


if($fromm==''){ 
    $query = "SELECT * FROM tbl_attendence ORDER BY attendence_id DESC";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
}

else{
       
    $query = "SELECT * FROM tbl_attendence WHERE reportdate BETWEEN '$from' AND '$to' ORDER BY attendence_id DESC";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
}  


// get data and store in a json array
$h=1;
while ($rrow = mysql_fetch_array($resultT, MYSQL_ASSOC)) {
    $attendence_id=$rrow['attendence_id'];
    $emp_file_no=$rrow['emp_file_no'];
    $time_in=$rrow['time_in'];
    $time_out=$rrow['time_out'];
    $time_spend=$rrow['time_spend'];
    $remark=$rrow['remark'];
    $date_entry=$rrow['date1'];
    $new_date = date('Y-m-d', strtotime($date_entry));
    
//    if(empty($time_out)){
//        $jumla='';
//    }
// else {
//       $to_time = strtotime($time_out);
//$from_time = strtotime($time_in);
//$jumla= round(abs($to_time - $from_time) / 3600,2). " Hours"; 
//    }
    
//    $sed=mysql_query("SELECT * FROM tbl_class_a_site WHERE s_id='$site_id'") or die(mysql_error());
//$ds=  mysql_fetch_array($sed);
//$sitename=$ds['sitename'];
    
  
     $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $phone= $de['phone'];
                 $dq=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                $da=  mysql_fetch_array($dq);
                 $phone2= $da['phone'];
               //     $tech_name=$showing['tech_phone'];

                $tbl_customerr = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$emp_file_no'") or die(mysql_error());
                $rowss = mysql_fetch_array($tbl_customerr);
                $first_namea = $rowss['first_name'];
                $surnamea = $rowss['surname'];
                $tech_name=$first_namea." ".$surnamea;
                
                $f="color:black";
    $stock[] = array( 
//        'Action'=>'<a href="#" class="view-rca" style="'.$f.'" data-toggle="modal" data-target="#editrca">View</a>',
        'No'=>$h++,        
        'id_no'=>$emp_file_no,
        'employee_name'=>$tech_name,
        'entry_date'=>$new_date, 
        'time_in'=>$time_in,
        'time_out'=>$time_out,
        'remarks'=>$remark,
        'total'=>$time_spend
          
    );
}
echo json_encode($stock);
?>
