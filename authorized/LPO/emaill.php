<?php

 //send email code goes here
     $emailing='pastory.hamaro@sincrositewatch.com,annastela@sincrositewatch.com,joaqim@sincrositewatch.com';
    $to = $emailing;
    $subject = 'LPO Notification!';
    $from = 'sas@sincrositewatch.com';
    $datee=date("M d Y");


  

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
    $message .= '<p>Kindly be advised the LPO No. 07M0916P508 has been Prepared.You are required to act on this approved immediatly.</p>';
     $message .= '<p></p>';
    $message .= '<p>Regards,<br/>Sincro Automation System</p>';
    $message .= '<p></p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo 'Your mail has been sent successfully.';
    } 
  