<?php
include '../db.php';
   $desc=$_POST['description'];
   $requiredemail=$_POST['requiredemail'];
        $status = "Rejected";
        $comment='<a href="#" data-toggle="tooltip" title="'.$desc.'!">Rejected</a>';
         $select_asset = mysql_query("SELECT * FROM tbl_leaves WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
         $rrow = mysql_fetch_array($select_asset);
         $hrm_email=$rrow['hr_email'];
         $emp_file_no=$rrow['emp_file_no'];
         $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
         $de=  mysql_fetch_array($se);
         $employee_email=$de['email'];
         $asa=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
         $qw=  mysql_fetch_array($asa);
         $first_name=$qw['first_name'];
         
         if($hrm_email==$requiredemail){;
          $u = mysql_query("UPDATE tbl_leaves SET hrm_status='$status',hrm_comment='$comment' WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
          //////////////////////////////////////////////////////////
                       
    $to = $employee_email;
    $admin='joaqim@sincrositewatch.com';
    $subject = 'Leave Request Notification';
    $from = 'hrms@sincrositewatch.com';
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
    $message .= '<p>Your leave request has been Rejected  by HR</p>';
    $message .= '<p>Reason:'.$desc.'</p>';
    $message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo '';
    } else{
        echo '';
    }
          
          /////////////////////////////////////////////////////////////
         }
        
             
        
//        $u = mysql_query("UPDATE tbl_leaves SET hrm_status='$status' WHERE leave_id='$request_id'") or die(mysql_error());                                           
?>



<div>
    <div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Your have successful reject Leave Request! </strong>
</div>
</div>

<div role="tabpanel">
    <div id="rejection_sms">
       <div class="tab-content" style="padding:3px 0">
<div role="tabpanel" class="tab-pane active" id="customer">
<div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Employee Name:</span></span>
    <input name="fullname" id="customer_code" class="form-control" value="<?php echo $_POST['fullname'];?>" aria-describedby="sizing-addon1" readonly="" type="text">
</div>

<div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Leave Type:</span></span>
    <input name="datetime" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $_POST['leave_typee'];?>" aria-describedby="sizing-addon1" disabled="" type="text">
</div>

<div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Leave Date:</span></span>
    <input name="datetime" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $_POST['start_date'];?> - <?php echo $_POST['end_date'];?>" aria-describedby="sizing-addon1" disabled="" type="text">
</div>
    <div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Supervisor:</span></span>
        <input name="fsname" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $_POST['fsname'];?> | Status: <?php echo $_POST['fs_status'];?>" aria-describedby="sizing-addon1" disabled="" type="text">
</div>
    <div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Head Of Department:</span></span>
        <input name="hodname" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $_POST['hodname'];?> | Status: <?php echo $_POST['hod_status'];?>" aria-describedby="sizing-addon1" disabled="" type="text">
</div>
    <form action="" method="post" id="sub_rejection">
<div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Short description:</span></span>
<input name="description" id="description" class="form-control editable" value="<?php echo $_POST['description'];?>" aria-describedby="sizing-addon1"  type="text">

</div>
    <div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Click button to Reject:</span></span>
<input name="reject" class="form-control primary"  value="Reject" aria-describedby="sizing-addon1"  type="submit">
</div>
    </form> 
</div>


</div>
    </div>

</div>



