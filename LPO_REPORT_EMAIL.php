<?php
 include 'authorized/db.php';
 $css='<style>
    table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
table, th, td {
    border: 1px solid #f2f2f2;
}
</style>';

                   $to ='joaqim@sincrositewatch.com';
                    $subject = $Description_of_Finding;
                    $from ='sas@sincrositewatch.com';
                    $CC='joaqimmaftah@yahoo.com';
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
                    $message.='<body>';
                    $message.='<head>';
                    $message.=$css;
                    $message.='</head>';
                    $message .= '<p style="text-bold;">Dear Team,</p>';
                    $message .= '<p style="">Below are LPO Report Summary for Last week</p>'; 
                                        $message .='<table class="table cart table-bordered">
 <caption>PURCHASE ORDER WEEKLY UPDATE</caption>
 <tr>
     <th colspan="3" style="text-align: center;">Week Days</th>
  <th colspan="3" style="text-align: center;">Operational Director Status</th>
  <th colspan="3" style="text-align: center;">Account Manager Status</th>  
 </tr>
 <tr>
     <th>Week Day</th>
  <th>Date</th>
  <th>LPO Opened</th>
  <th>Approved</th>
    <th>Reject</th>
  <th>Pending</th>
  <th>Approved</th>
    <th>Reject</th>
  <th>Pending</th>

 </tr>
                    </thead>
                    <tbody>';
                    $date = '03/05/2017';
// parse about any English textual datetime description into a Unix timestamp 
$ts = strtotime($date);
// find the year (ISO-8601 year number) and the current week
$year = date('o', $ts);
$week = date('W', $ts);
// print week for the current date
for($i = 1; $i <= 5; $i++) {
    $ts = strtotime($year.'W'.$week.$i);
    $juma= date("l", $ts);
    $tareh= date("d/m/Y", $ts);
    $treport=date("Ymd", $ts);

$gt= mysql_query("SELECT * FROM tbl_purchase_order WHERE open_dreport='$treport'") or die(mysql_error());
   $poopedn= mysql_num_rows($gt);
   $gt2= mysql_query("SELECT * FROM tbl_purchase_order WHERE check_dreport='$treport' AND checked_status='Approved'") or die(mysql_error());
   $oppr= mysql_num_rows($gt2);
   $gtr= mysql_query("SELECT * FROM tbl_purchase_order WHERE check_dreport='$treport' AND checked_status='Reject'") or die(mysql_error());
   $opreject= mysql_num_rows($gtr);
   $gtpending= mysql_query("SELECT * FROM tbl_purchase_order WHERE (checked_status!='Approved' OR checked_status!='Reject') AND open_dreport<='$treport'") or die(mysql_error());
   $oppending= mysql_num_rows($gtpending);
   $oppendingT=$oppending-($opreject+$oppr);
   //////////////////////////////////////////////////////////////////////
   $gtt2= mysql_query("SELECT * FROM tbl_purchase_order WHERE approv_dreport='$treport' AND Approved_status='Approved'") or die(mysql_error());
   $acpr= mysql_num_rows($gtt2);
   $gttr= mysql_query("SELECT * FROM tbl_purchase_order WHERE approv_dreport='$treport' AND Approved_status='Reject'") or die(mysql_error());
   $acreject= mysql_num_rows($gttr);
   $gttpending= mysql_query("SELECT * FROM tbl_purchase_order WHERE (Approved_status!='Approved' OR Approved_status!='Reject') AND open_dreport<='$treport'") or die(mysql_error());
   $acpending= mysql_num_rows($gttpending);
   $acpendingT=$acpending-($opreject+$oppr);
                      $message.=' <tr>
     <td>'.$juma.'</td>
     <td>'.$tareh.'</td>
  <td>'.$poopedn.'</td>
  <td>'.$oppr.'</td>
   <td>'.$opreject.'</td>
  <td>'.$oppendingT.'</td>
 <td>'.$acpr.'</td>
   <td>'.$acreject.'</td>
  <td>'.$acpendingT.'</td>
 </tr>';
  }
     $message .= '</tbody>
                </table>';
                    $message .= '<p style="">Regards,<br>sas(Sincro Automation System)</p>';
                    $message .= '<p style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</p>';
                    $message .= '<p style="color:#f40;">*This script was design and developed by Joaqim John Maftah (2012-2014)</p>';
                    $message .= '</body></html>';
                    // Sending email
                    if (mail($to, $subject, $message, $headers)) {
 
                    } else {
                       
                    }
    
?>