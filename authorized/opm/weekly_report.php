<?php

include '../db.php';

/////////////////////////////////////////////////////////Emails config////////////////////////////////////////
              $scri='<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
  
                    $to = 'joaqim@sincrositewatch.com';
                    $subject = $Description_of_Finding;
                    $from ='sas@sincrositewatch.com';
                    $CC='joaqim@sincrositewatch.com';
                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Create email headers
                    $headers .= 'From: ' . $from . "\r\n" .
                            'Reply-To: ' . $from . "\r\n" .
                            'CC: ' . $CC. "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                    // Compose a simple HTML email message
                    $message = '<html>';
                    $message.='<head>';
                    $message.=$scri;
                    $message.='</head>';
                    $message.='<body>';                   
                    $message .= '<p style="text-bold;">Dear ,</p>';
                    $message .= '<p style=""> You holding our task element of  from   open by  for  days.Please <a href="http://www.daimainfotech.com/sas/">Click this link to Update your task(s)</a></p>'; 
                    $message .='  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:40%">
      Free Space
    </div>
    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:10%">
      Warning
    </div>
    <div class="progress-bar progress-bar-danger" role="progressbar" style="width:20%">
      Danger
    </div>
  </div>';
                    $message .= '<p style="">Regards,<br>sas(Sincro Automation System)</p>';
                    $message .= '<p style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</p>';
                    $message .= '<p style="color:#f40;">*This script was design and developed by Joaqim John Maftah (2012-2014) from University of Dododma</p>';
                    $message .= '</body></html>';
                    // Sending email
                    if (mail($to, $subject, $message, $headers)) {
 
                    } else {
                       
                    }
   
 /////////////////////////////////////////End of email////////////////////////////////////////////////////////// 