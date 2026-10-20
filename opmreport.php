<?php
require_once __DIR__ . '/mysql_compat.php';

include 'authorized/db.php';

$css='<style>
    table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
table, th, td {
    border: 1px solid #f2f2f2;
}
</style>';

 $gtu=mysql_query("SELECT DISTINCT(Responsible) FROM tbl_action_list ORDER BY Responsible") or die(mysql_error());
            while ($ab = mysql_fetch_array($gtu)) {
                $emplid=$ab['Responsible'];
                $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emplid'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $addresses[] = $de['email'];
            }
        $too = implode(", ", $addresses);

  $to = $too.'robin.west@sincrositewatch.com';
//   $to = $too.'robin.west@sincrositewatch.com';
$subject = 'REPORT SUMMARY OPERATIONAL MONITORING SYSTEM';
$from = 'sas@sincrositewatch.com';
$cc='zacharia.mselle@sincrositewatch.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
     'Cc: '.$cc."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html>';
 $message.='<head>';
 $message.=$css;
 $message.='</head>';
  $message.='<body>';
$message .= '<h3 style="color:#f40;">Hi Team!</h3>';
$message .= '<p>Kindly find summary report for our Operational Monitoring System</p>';
$message .= '<hr>';
$message .= '<table> <thead> <tr> <th>SN</th> <th>Issue</th> <th>Key Owner</th> <th>Action</th> <th>Requirement</th> <th>Start Date</th> <th>End Date</th> <th>Responsible</th> <th>Status</th> </tr> </thead> <tbody>';
                       $date=date('Ymd', strtotime('-7 days'));
$tn = mysql_query("SELECT * FROM tbl_operational_monitor order by opm_id DESC") or die(mysql_error());
$i=1;
while ($sq = mysql_fetch_array($tn)) {
    $opm_id=$sq['opm_id'];    
      $gtt3=mysql_query("SELECT * FROM tbl_action_list WHERE  reportdate>='$date' AND opm_id='$opm_id'") or die(mysql_error());
      $nmb=mysql_num_rows($gtt3);
      while($nmc=mysql_fetch_array($gtt3)){         
          $reportds=$nmc['reportdate'];     
      $Responsible=$nmc['Responsible'];
   $Action=$nmc['Action'];
   $Requirements=$nmc['Requirements'];
   $opm_idzz=$nmc['opm_id'];
    $reportdatez=$nmc['reportdate'];
    $E=$nmc['End_Date'];
    $F=$nmc['Start_Date'];
    $up=$nmc['Updatee'];
    $key_owner=$sq['key_owner'];
   
    $leo=date('Ymd');
    if($reportds<$leo && $up!="Closed"){
       $color="background:red"; 
    }
 else {
        $color=""; 
    }
    
    
     $ts = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $rowss = mysql_fetch_array($ts);
                $fuz = $rowss['first_name'].' '.$rowss['surname'];
    
    
     $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
                $jinalake=$first_name.' '.$surname;
$message .= '<tr style="'.$color.'">
                            <td>'.$i++.'</td>
                            <td>'.$sq['Description_of_Finding'].'</td>
                            <td>'.$jinalake.'</td>
                            <td>'.$Action.'</td>
                            <td>'.$Requirements.'</td>
                            <td>'.$F.'</td>
                            <td>'.$E.'</td>
                            <td>'.$fuz.'</td>
                            <td>'.$up.'</td>
             </tr>';
}}
$message .= "</tbody></table>";
$message .= "</body></html>";
 
// Sending email
if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
?>