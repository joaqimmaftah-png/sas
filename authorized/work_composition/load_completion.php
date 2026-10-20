<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once '../db.php';
$select= mysql_query("SELECT * FROM site_survey") or die(mysql_error());
   
$h=1;
while ($rrow = mysql_fetch_array($select)) {
    $site_address=$rrow['site_address'];
    $custeomer_name=$rrow['custeomer_name'];
    $job_no=$rrow['job_no'];
    $site_id=$rrow['site_id'];
    $completion_no=$rrow['completion_no'];
    $created_date=$rrow['created_date'];
    $employee_code=$rrow['employee_code'];
    $selectv= mysql_query("SELECT * FROM tbl_employee where emp_file_no='$employee_code'") or die(mysql_error());
    $row=mysql_fetch_array($selectv);
    $fullname=$row['first_name'].' '.$row['surname'];
//    
    $stock[] = array( 
        'link'=>'<a href="?action=kprint&id='.$site_id.'">View</a>',
        'code'=>$h++,
        'customername'=>$custeomer_name,        
        'siteaddress'=>$site_address,
        'jobno'=>$job_no,
        'completionno'=>$completion_no,
        'filledby'=>$fullname, 
        'filled'=>$created_date    
    );
}
echo json_encode($stock);
?>
