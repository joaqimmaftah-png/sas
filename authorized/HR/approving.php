<?php
include '../db.php';
//   $desc=$_POST['description'];
   $u = mysql_query("UPDATE tbl_leaves SET hrm_status='Approved' WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
        $select_asset = mysql_query("SELECT * FROM tbl_leaves WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
         $rrow = mysql_fetch_array($select_asset);
         $hod_email=$rrow['hod_email'];
         $fs_email=$rrow['fs_email'];
         $emp_file_no=$rrow['emp_file_no'];
         $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
         $de=  mysql_fetch_array($se);
         $employee_email=$de['email'];
         $asa=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
         $qw=  mysql_fetch_array($asa);
         $first_name=$qw['first_name'];    
   
//////////////////////////////////////////////////////////
                       
    $to = $employee_email;
    $admin='joaqim@sincrositewatch.com';
    $subject = 'Leave Request Note';
    $from = 'sas@sincrositewatch.com';
    $new_date=  date("d M y");
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
    $id=1;
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$admin."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
      $message = '<html><body>';
    $message .= '<p>Dear:'.$first_name.'</p>';
    $message .= '<p>Your leave request has been successful approved by HR</p>';
    $message .= '<p>Date Approved:'.$new_date.'</p>';
    $message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo '<div class="alert alert-success">
  <strong>Success!</strong>Approved</a>.
</div>';
    } else{
        echo '';
    }
          
          /////////////////////////////////////////////////////////////
                
?>


