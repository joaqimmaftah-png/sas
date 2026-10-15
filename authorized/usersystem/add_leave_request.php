<?php
include '../db.php';
$emp_file_no = $_POST['employee_no'];
$leave_type = $_POST['leave_type'];
$fs = $_POST['fs'];
$hod = $_POST['hod'];
$enddate = $_POST['enddate'];
$sdate = $_POST['sdate'];
$d1 = date('Ymd',strtotime($sdate));
$d2 = date('Ymd', strtotime($enddate));
$date1=  strtotime($d1);
$date2=  strtotime($d2);

if($date2>$date1){
    $n=($date2-$date1)/(60*60*24);
}
else{
    $n=30;
}





/////////////////////////////////
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
    $y=date('Y');
    $validate = mysql_query("SELECT SUM(no_of_days) FROM tbl_leaves WHERE emp_file_no='$emp_file_no' AND report_date='$y' AND hod_status='Approved' AND fs_status='Approved' AND hrm_status='Approved'") or die(mysql_error());
    $row = mysql_fetch_array($validate);
    $no_used = $row['SUM(no_of_days)'];
    $no_day_remain=28-$no_used;
    
    
    
   if($no_day_remain>=$n){
       
      echo ''; 
         $relatives = "INSERT INTO tbl_leaves(leave_type,start_date,end_date,no_of_days,emp_file_no,`hod_status`,fs_status, `hrm_status`,hod_email,fs_email,hr_email, startdate,enddate,report_date)"
                . "VALUES('$leave_type','$sdate','$enddate','$n','$emp_file_no','$hod_status','$fs_status','$hrm_status','$emailh','$emailf','operations@sincrositewatch.com', '$d1', '$d2', '$y')";
        $show = mysql_query($relatives) or die(mysql_error());
        
        
        ////////////////////////////Start email////////////////////////////////////////
        
                if($show){
//Start email to fs
          if(!empty($emailf)){
              $to =$emailf.',operations@sincrositewatch.com';
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
              $to = $emailh.',operations@sincrositewatch.com';
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
        /////////////////////////////end email////////////////////////////////////////
        
        
        
   } 
   
   
   else {
   echo '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error check date!..</strong> You Have Only '.$no_day_remain.' Days Remain. From '.$d1.' to '.$d2.'
</div>';    
}
    
    
///////////////////////////////////
?>
