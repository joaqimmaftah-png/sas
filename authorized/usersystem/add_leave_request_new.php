<?php
include '../db.php';
$enddate = $_POST['enddate'];
$sdate = $_POST['sdate'];
$diff = $enddate - $sdate;
$explod1 = explode(".", $sdate);
$startday = $explod1[0];
$startmon = $explod1[1];
$startyear = $explod1[2];


$explod2 = explode(".", $enddate);
$endday = $explod2[0];
$endmon = $explod2[1];
$endyear = $explod2[2];

$noday = $endday - $startday;
$nomonth = $endmon - $startmon;
$noyear = $endyear - $startyear;


if ($noday > 0 AND $nomonth == 0 AND $noyear == 0) {
    $pday=$noday;
    $enddate = date('Ymd',strtotime($_POST['enddate']));
    $sdate = date('Ymd', strtotime($_POST['sdate']));
    $emp_file_no = $_POST['employee_no'];
    $leave_type = $_POST['leave_type'];
    $fs = $_POST['fs'];
    $hod = $_POST['hod'];
    $no1=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$fs'") or die(mysql_error());
    $ww=  mysql_fetch_array($no1);
    $no2=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$hod'") or die(mysql_error());
    $ww2=  mysql_fetch_array($no2);
    $hodname=$ww2['first_name'];
    $fsname=$ww['first_name'];
    $no3=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
    $ww3=  mysql_fetch_array($no3);
    $yourname=$ww3['first_name'];
    
    $t = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$fs'") or die(mysql_error());
    $e = mysql_fetch_array($t);
    $emailf = $e['email'];
    $f = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$hod'") or die(mysql_error());
    $v = mysql_fetch_array($f);
    $emailh = $v['email'];
    $hod_status = 'Pending';
    $hrm_status = 'Pending';
    $fs_status = 'Pending';
    $b = mysql_query("SELECT * FROM tbl_leave_type WHERE leave_type_id='$leave_type'") or die(mysql_error());
    $a = mysql_fetch_array($b);
    $leavename = $a['leave_type'];
    
        $validate = mysql_query("SELECT SUM(no_of_days) FROM tbl_leaves WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
    $row = mysql_fetch_array($validate);
    $no_days1 = $row['SUM(no_of_days)'];
    $no_days = $no_days1 + $pday;
    $day_remain = 32 - $no_days1;
     if ($no_days > 32 || $day_remain<=0) {  
         echo '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error!..</strong> You Have Only '.$day_remain.' Days Remain
</div>';
     }else{
         echo ''; 
         $relatives = "INSERT INTO tbl_leaves(leave_type,start_date,end_date,no_of_days,emp_file_no,`hod_status`,fs_status, `hrm_status`,hod_email,fs_email,hr_email)"
                . "VALUES('$leave_type','$sdate','$enddate','$pday','$emp_file_no','$hod_status','$fs_status','$hrm_status','$emailh','$emailf','eva.mbawala@sincrositewatch.com')";
        $show = mysql_query($relatives) or die(mysql_error());  
        
        if($show){
//Start email to fs
          if(!empty($emailf)){
              $to =$emailf.',eva.mbawala@sincrositewatch.com';
    $subject = 'Leave Request Note';
    $from = 'sas@sincrositewatch.com';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers

    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p style="text-bold;">Dear '.$fsname.'</p>';
    $message .= '<p style="">Please! Assist to approve my leave Request for '.$leavename.'  from '.$sdate.' to '.$enddate.'</p>';
    $message .= '<p style="color:#080;font-size:18px;"><a href="www.daimainfotech.com/sas" target="_blank">Click this link to approve or reject the request!</a></p>';
    $message .= '<p style="">Regards,</p>';
    $message .= '<p style="">'.$yourname.'</p>';
    $message .= '<p style=""><br></p>';
    $message .= '<h4 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h4>';   
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
         echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Thanks!..</strong> Your mail has been sent successfully to your Supervisor and Head of Department.
</div>'; 
    } else{
        echo 'Unable to send email. Please try again.';
    }
          }
//start email to hod
          if(!empty($emailh)){
              $to = $emailh.',eva.mbawala@sincrositewatch.com';
    $subject = 'Leave Request Note';
    $from = 'sincro_automation_system@sincrositewatch.com';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers

    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<h4 style="color:#f40;">Dear '.$hodname.'</h4>';
    $message .= '<p style="">Please! Assist to approve my leave Request for '.$leavename.' from '.$sdate.' to '.$enddate.'</p>';
     $message .= '<p style="color:#080;font-size:18px;"><a href="www.daimainfotech.com/sas" target="_blank">Click this link to Approve or reject The Request!</a></p>';
    $message .= '<p style="">Regards,</p>';
    $message .= '<p style="">'.$yourname.'</p>';
    $message .= '<p style=""><br></p>';
    $message .= '<h4 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h4>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo ''; 
    } else{
        echo '';
    }
          }
//end email to hod
        }
         
     }   
} 


elseif ($noday < 0 AND $nomonth > 0 AND $noyear == 0) {
    $lastday = date('t', strtotime('today'));
    $lastmont = $lastday - $startday + 1;
    $pday = $lastmont + $endday;

    $enddate = date('Ymd', strtotime($_POST['enddate']));
    $sdate = date('Ymd', strtotime($_POST['sdate']));
    
    
    
    
    $emp_file_no = $_POST['employee_no'];
   
    $leave_type = $_POST['leave_type'];
    $fs = $_POST['fs'];
    $hod = $_POST['hod'];
    $t = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$fs'") or die(mysql_error());
    $e = mysql_fetch_array($t);
    $emailf = $e['email'];
    $f = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$hod'") or die(mysql_error());
    $v = mysql_fetch_array($f);
    $emailh = $v['email'];
    $hod_status = 'Pending';
    $hrm_status = 'Pending';
    $fs_status = 'Pending';
    $validate = mysql_query("SELECT SUM(no_of_days) FROM tbl_leaves WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
    $row = mysql_fetch_array($validate);
    $no_days1 = $row['SUM(no_of_days)'];
    $no_days = $no_days1 + $pday;
    $day_remain = 32 - $no_days1;
     if ($no_days > 32 || $day_remain<=0) {  
         echo '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error!..</strong> You Have Only '.$day_remain.' Days Remain
</div>';
     }else{
        echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Thanks!..</strong> Your mail has been sent successfully to your Supervisor and Head of Department.
</div>'; 
         $relatives = "INSERT INTO tbl_leaves(leave_type,start_date,end_date,no_of_days,emp_file_no,`hod_status`,fs_status, `hrm_status`,hod_email,fs_email)"
                . "VALUES('$leave_type','$sdate','$enddate','$pday','$emp_file_no','$hod_status','$fs_status','$hrm_status','$emailh','$emailf')";
        $show = mysql_query($relatives) or die(mysql_error()); 
        
                if($show){
//Start email to fs
          if(!empty($emailf)){
              $to = $emailf;
    $subject = 'Leave Request Note';
    $from = 'sincro_automation_system@sincrositewatch.com';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers

    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p style="text-bold;">Dear '.$fsname.'</p>';
    $message .= '<p style="">Please! Assist to approve my '.$leavename.' leave Request from '.$sdate.' to '.$enddate.'</p>';
    $message .= '<p style="color:#080;font-size:16px;"><a href="http://sincrositewatch.com/sas/" target="_blank">Click this link to approve or reject the request!</a></p>';
    $message .= '<p style="">Regards,</p>';
    $message .= '<p style="">'.$yourname.'</p>';
    $message .= '<h4 style="color:#f40;">NOTE: This email has been sent automatic from SAS (Sincro Automation System).</h4>';  
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
         echo ''; 
    } else{
        echo '';
    }
          }
//start email to hod
          if(!empty($emailh)){
              $to = $emailh;
    $subject = 'Leave Request Note';
    $from = 'sincro_automation_system@sincrositewatch.com';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers

    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<h4 style="color:#f40;">Dear '.$hodname.'</h4>';
    $message .= '<p style="">Please! Assist to approve my '.$leavename.' leave Request from '.$sdate.' to '.$enddate.'</p>';
     $message .= '<p style="color:#080;font-size:16px;"><a href="http://sincrositewatch.com/sas/" target="_blank">Click this link to approve or reject the request!</a></p>';
    $message .= '<p style="">Regards,</p>';
    $message .= '<p style="">'.$yourname.'</p>';
    $message .= '<p style=""></p>';
    $message .= '<h4 style="color:#f40;">NOTE: this email has been sent automatic from SAS (Sincro Automation System).</h4>';  
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
         echo ''; 
    } else{
         echo '<div class="alert alert-error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error!..</strong> Unable to send email. Please try again.
</div>'; 
       
    }
          }
//end email to hod
        }
         
     }
    
} 



elseif ($noday < 0 AND $nomonth < 0 AND $noyear == 0) {
   echo '<div class="alert alert-error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error!..</strong> Try to communicate with admin 0654491973 joaqim maftah.
</div>'; 
} 
elseif ($nomonth = 1 AND $noyear = 1) {
   echo '<div class="alert alert-error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error!..</strong> Try to communicate with admin 0654491973 joaqim maftah.
</div>'; 
} else {
    echo '<div class="alert alert-error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error!..</strong> Try to communicate with admin 0654491973 joaqim maftah.
</div>'; 
}
?>
