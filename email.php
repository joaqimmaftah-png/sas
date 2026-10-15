<?php

 //send email code goes here
     $emailing='zacharia.mselle@sincrositewatch.com,pastory.hamaro@sincrositewatch.com,joaqim@sincrositewatch.com,eva.mbawala@sincrositewatch.com';
    $to = $emailing;
    $subject = 'Leave Request Notification';
    $from = 'sas@sincrositewatch.com,pastory.hamaro@sincrositewatch.com';
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
    $message .= '<p>Dear Zacharia';
    $message .= '<p style="">Please! Assist to approve my Annual leave Request   from 24-11-2017 to 08-12-2017</p>';;
    $message .= '<p>Employee Name:Pastory Hamaro</p>';
    $message .= '<p>Regards,</p>';
    $message .= '<p>sas(Sincro Automation System)</p>';
    $message .= '<p><a href="http://www.daimainfotech.com/sas/">Click this link to Approve or Reject</a></p>';
    $message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '<p></p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo 'Your mail has been sent successfully.';
    } 
  