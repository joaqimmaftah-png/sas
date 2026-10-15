
<?php
include_once '../db.php';
$tpf_name = $_POST['tpf_code'];
$tpf_qt_id=$_POST['qt_code'];
$approve_status = 'Waiting for closing reference';
$update_issue=  mysql_query("UPDATE tbl_tpf_qt set status='$approve_status' WHERE Quotation_No='$tpf_qt_id' AND tpf_no='$tpf_name'") or die(mysql_error());
if($update_issue){
    
    
     //send email code goes here
     $emailing='joaqim@sincrositewatch.com';
    $to = $emailing;
    $subject = 'Material Supplying!';
    $from = 'sas@sincrositewatch.com';
$nj=mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_no='$tpf_name' and Quotation_No='$tpf_qt_id'") or die(mysql_error());
$listlink=mysql_fetch_array($nj);
$tpf_attachment=$listlink['tpf_attachment'];
$tpf_namess=$listlink['tpf_name'];
$linkk='<a href="http://sas.sincrositewatch.com/'.$tpf_attachment.'">'.$tpf_namess.'</a>';

  

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
    $id=1;
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p>Dear Team,</p>';
    $message .= '<p>Kindly be advised that materials for TPF Ref No TPF-00140 of AC ALTERNATOR REWINDING AND SUPPLY OF AVR - KISEMVULE have been prepared and sent today to site.</p>';
     $message .= '<p>TPF attachment:'.$linkk.'</p>';
    $message .= '<p>Regards,<br/>SAS(Sincro Automation System)</p>';
    $message .= '<p></p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo 'Your mail has been sent successfully.';
    } 
    
    
    
    else{
        echo 'Unable to send email. Please try again.';
    }
    
//send email code
    
}
