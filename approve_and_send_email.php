<?php
require_once __DIR__ . '/mysql_compat.php';

include '../db.php';
$tpf_code=$_POST['tpf_code'];
$qtn_code=$_POST['qtn_code'];
$tpf_name=$_POST['tpf_name'];

 //send email code goes here
    $emailing='boniface.salim@sincrositewatch.com,mwapinga.joseph@sincrositewatch.com,enanosya.mwaijande@sincrositewatch.com,robin.west@sincrositewatch.com,zacharia.mselle@sincrositewatch.com,tumaini.magessa@sincrositewatch.com,amina.njiku@sincrositewatch.com,edward.mayunga@sincrositewatch.com,pastory.hamaro@sincrositewatch.com,annastela@sincrositewatch.com,joaqimmaftah@yahoo.com';
    $to = $emailing;
    $subject = 'TPF and Quotation Notifications!';
    $from = 'sas@sincrositewatch.com';
    $datee=date("M d Y");
$update_status=mysql_query("UPDATE tbl_tpf_qt SET aproved_status='Approved',approve_date='$datee' WHERE Quotation_No='$qtn_code' AND tpf_no='$tpf_code'") or die(mysql_error());
  

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
    $message .= '<p>Kindly be advised the QT No. '.$qtn_code.' of '.$tpf_name.' has been approved with TPF Ref No '.$tpf_code.' <br/> You are required to act on this approved immediatly.</p>';
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
        

?>
 
<?php

?>

