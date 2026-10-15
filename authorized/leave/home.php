    <?php
    $messagez="";
     include_once 'authorized/db.php';
     //contact
$contactinfo = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'")or die(mysql_error());
$contact = mysql_fetch_array($contactinfo);
$phone = $contact['phone'];
$phone2 = $contact['phone2'];
$postal_addr = $contact['postal_addr'];
$email = $contact['email'];
$email2 = $contact['email2'];
$fax = 'Null';


if(isset($_POST['requiredemail'])){

//   $desc=$_POST['description'];
   $requiredemail=$_POST['requiredemail'];
         $status = "Approved";
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
         
         if($hod_email==$requiredemail){
          $u = mysql_query("UPDATE tbl_leaves SET hod_status='$status',hod_comment='' WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
          //////////////////////////////////////////////////////////
                       
    $to = $employee_email.',eva.mbawala@sincrositewatch.com';
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
    $message .= '<p>Your leave request has been successful approved by  Head of department</p>';
    $message .= '<p>Date Approved:'.$new_date.'</p>';
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
         
         
         if($fs_email==$requiredemail){
              $u = mysql_query("UPDATE tbl_leaves SET fs_status='$status',supervisor_comm='' WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
               //////////////////////////////////////////////////////////                      
    $to = $employee_email.',eva.mbawala@sincrositewatch.com';;
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
    $message .= '<p>Your leave request has been successful Approved by  Supervisor</p>';
    $message .= '<p>Date Approved:'.$new_date.'</p>';
    $message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        $messagez='<div class="alert alert-success">
  <strong>Success!</strong>Approved</a>.
</div>';
    } else{
        echo '';
    }
          
          /////////////////////////////////////////////////////////////
         }
}

if(isset($_POST['requiredemailz'])){

//   $desc=$_POST['description'];
   $requiredemail=$_POST['requiredemailz'];
         $status = "Rejected";
         $comment=$_POST['comment'];
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
         
         if($hod_email==$requiredemail){
          $u = mysql_query("UPDATE tbl_leaves SET hod_status='$status',hod_comment='$comment' WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
          //////////////////////////////////////////////////////////
                       
    $to = $employee_email.',eva.mbawala@sincrositewatch.com';
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
    $message .= '<p>Your leave request has been rejected by  Head of department</p>';
    $message .= '<p>Date Approved:'.$new_date.'</p>';
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
         
         
         if($fs_email==$requiredemail){
              $u = mysql_query("UPDATE tbl_leaves SET fs_status='$status',supervisor_comm='$comment' WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
               //////////////////////////////////////////////////////////                      
    $to = $employee_email.',eva.mbawala@sincrositewatch.com';;
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
    $message .= '<p>Your leave request has been rejected by  Supervisor</p>';
    $message .= '<p>Date Approved:'.$new_date.'</p>';
    $message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        $messagez='<div class="alert alert-success">
  <strong>Success!</strong>Approved</a>.
</div>';
    } else{
        echo '';
    }
          
          /////////////////////////////////////////////////////////////
         }
}
    ?>           



                    <div class="col-lg-12">
                        <div class="margin10">
                            <div id="show_message">
                            <?php echo $messagez;?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-hover table-bordered" id="leave">
                            <thead>
                                <tr>
                                    <th class="text-left">Approve/Reject</th>
                                    <th class="text-left">Employee Name</th>
                                    <th class="text-left">Leave Type</th> 
                                    <th class="text-left">Start Date</th>
                                    <th class="text-left">End Date</th> 
                                    <th class="text-left">Days</th>
                                    <th class="text-left">Supervisor Status</th> 
                                    <th class="text-left">HOD Status</th> 
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $select_asset = mysql_query("SELECT * FROM tbl_leaves WHERE hod_email='$email' OR fs_email='$email' ORDER BY leave_id DESC") or die(mysql_error());
                                while ($roww = mysql_fetch_array($select_asset)) {
                                    $leave_id = $roww['leave_id'];
                                    $leave_type = $roww['leave_type'];
                                    $start_date = $roww['start_date'];
                                    $end_date = $roww['end_date'];
                                    $hod_comment = $roww['hod_comment'];
                                    $supervisor_comm = $roww['supervisor_comm'];
                                    $no_of_days = $roww['no_of_days'];
                                    $hod_status = $roww['hod_status'];
                                    $hrm_status = $roww['hrm_status'];
                                    $emp_file_noo = $roww['emp_file_no'];
                                    $a = mysql_query("SELECT * FROM tbl_leave_type WHERE leave_type_id='$leave_type'") or die(mysql_error());
                                    $b = mysql_fetch_array($a);
                                    $leave_typee = $b['leave_type'];
                                    $fs_status = $roww['fs_status'];
                                    $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_noo' ")or die(mysql_error());
                                    $majina = mysql_fetch_array($jina);
                                    $firstname = $majina['first_name'];
                                    $sirname = $majina['surname'];
                                    $fullname = $firstname . " " . $sirname;
                                    ?>
                                    <tr>
                                        <td>
                                            <ul class="showlist">

                                                <li> <a href="#" onclick="approved('authorized/leave/leave_approved.php?leave_id=<?php echo $leave_id; ?>&requiredemail=<?php echo $email; ?>')"  data-toggle="modal" data-target="#approve"><i class="fa fa-check"></i>&nbsp;Approve</a></li>
                                                <li> <a href="#" onclick="rejection('authorized/leave/leave_reject.php?leave_id=<?php echo $leave_id; ?>&requiredemail=<?php echo $email; ?>')"  data-toggle="modal" data-target="#reject"><i class="fa fa-arrow-down fg-green"></i>&nbsp;Reject</a></li>

                                            </ul>        
                                        </td>
                                        <td class="right"><?php echo $fullname; ?></td>
                                        <td class="right"><?php echo $leave_typee; ?></td>
                                        <td class="right"><?php echo $start_date; ?></td>
                                        <td class="right"><?php echo $end_date; ?></td>  
                                        <td class="right"><?php echo $no_of_days; ?></td> 
                                        <td class="right"> 
                                            <?php
                                            if (empty($supervisor_comm)) {
                                                ?>
                                                <a href="#"><?php echo $fs_status; ?></a>
                                                <?php
                                            } else {
                                                echo $supervisor_comm;
                                            }
                                            ?>

                                        </td>
                                        <td class="">
                                            <?php
                                            if (empty($hod_comment)) {
                                                ?>
                                                <a href="#"><?php echo $hod_status; ?></a>
                                                <?php
                                            } else {
                                                echo $hod_comment;
                                            }
                                            ?>

                                        </td>                                                              
                                        
                                    <td>
                                      <a href="?action=edit_the_leave&item=<?php echo $roww['leave_id'];?>">Edit</a>
                                    </td> 
                                        
                                        

                                    </tr> 
                                <?php
                                }
                                ?>
                            </tbody>

                            <tfoot></tfoot>
                        </table>
                    </div>
               <!--//////////////////////End Attendence//////////////////////////////-->
<!-- Modal -->
<div id="approve" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Approve Leave Request</h4>
            </div>
            <div class="modal-body">
                <div id="call_approving">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel</button>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Reject -->
<div id="reject" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Reject Leave Request</h4>
            </div>
            <div class="modal-body">
                <div id="call_rejection">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>