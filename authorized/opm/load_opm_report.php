<?php
include_once '../db.php';

//get data and store in a json array
$u=1;

$fromm=$_GET['from'];
$too=$_GET['to'];
$from=date("Ymd", strtotime($fromm));
$to=date("Ymd", strtotime($too)); 


if($fromm==''){
    $result = mysql_query("SELECT * FROM `tbl_action_list` ORDER BY opm_id DESC") or mysql_error();
}

else{
   $result = mysql_query("SELECT * FROM `tbl_action_list` WHERE reportdate BETWEEN '$from' AND '$to' ORDER BY opm_id DESC") or mysql_error(); 
}

//$result=mysql_query("SELECT * FROM `tbl_action_list` ORDER BY opm_id DESC") or die(mysql_error());
while ($ng=mysql_fetch_array($result)){ 
$Responsible=$ng['Responsible'];
$snlist=$ng['sn'];
$opm_id=$ng['opm_id'];  
  $tbl_r = mysql_query("SELECT * FROM tbl_operational_monitor where opm_id='$opm_id'") or die(mysql_error());
  $rowss = mysql_fetch_array($tbl_r);
             $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_namee = $rows['first_name'];
                $surnamee = $rows['surname'];
                $fullname=$first_namee.' '.$surnamee;
     $sel=  mysql_query("SELECT * FROM `tbl_action_update` WHERE sn='$snlist' LIMIT 1")or die(mysql_error());
     $selT=  mysql_fetch_array($sel);   
    
     
     if(!empty($selT['dates'])){         
         $date=date('Y-m-d', strtotime($selT['dates']));
     } 
     else {
         $date='';
     }
     
     $exec_date=$date;
     $end_date=date('Y-m-d', strtotime($ng['End_Date']));
     
     if ($exec_date>$end_date){
         
        $up_status='Overdue';
            
     }
     else
     {
        $up_status='Not overdue';
     }
                
    $stock[] = array(    

        'SN'=>$u++,
        'action'=>$ng['Action'],
        'finding'=> htmlentities($rowss['Description_of_Finding']),
        'requirements'=>$ng['Requirements'],
        'responsible'=>$fullname,
        'start_date'=>date('Y-m-d', strtotime($ng['Start_Date'])),
        'end_date'=>date('Y-m-d', strtotime($ng['End_Date'])),
        'executed_date'=>$date,
        'status'=>$ng['Updatee'],
        'update_status'=>$up_status,     
        'remarks'=>$selT['remarks']           
               
    );   
    }        

echo json_encode($stock);

?>


 