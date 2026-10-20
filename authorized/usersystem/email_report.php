    <?php
require_once __DIR__ . '/../../mysql_compat.php';

    include '../db.php';
   $emailing='joaqim@sincrositewatch.com';
      $to = $emailing;
    $subject = 'Daily TPF Report Summary';
    $from = 'sas@sincrositewatch.com';

     
     
     /////////////////////////////////////////////////////////
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
$date1="12-12-2016";
$date2="07-01-2017";
$date = new DateTime($date1);
$dt1=$date->format('d-m-Y');
$datee = new DateTime($date2);
$dt2=$datee->format('d-m-Y');

$cashlist = mysql_query("SELECT * FROM cash_request WHERE  approved_by_status!='Reject' AND received_by_status!='Reject'") or die(mysql_error());
$cashprovided=  mysql_query("SELECT * FROM cash_request WHERE approved_by_status!='Reject' AND received_by_status!='Reject' AND received_by_status='Pending Retirement'") or die(mysql_error());                               
while ($rz = mysql_fetch_array($cashprovided)) {
    $cash_id=$rz['cash_id'];
    $cash_idz=$cash_id+1;
    $atta = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idz'") or die(mysql_error());
    while ($rzz = mysql_fetch_array($atta)) {
        $referencez=$rzz['reference'];
            $sm = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$referencez'") or die(mysql_error());
        $tf = mysql_fetch_array($sm);
        $tatals = $tf['SUM(total)'];
        $jibuu+=$tatals;
    }
}  
                                       
    /////////////////////////////////////////////////////////

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
    $id=1;
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
   $message = '<html>';
    $message.='<body>';
    $message.='<head>';
    $message.=$css;
    $message.='</head>';
    $message .= '<p>Dear Team</p>';
    $message .= '<p style="color:#080;font-size:18px;">Below are Daily Tpf Report</p>';
     $message .='<table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>Num#</th>
                            <th>Requested ID</th>
                            <th>Requested For</th>                            
                            <th>Requested By</th>
                            <th>Requested Date</th> 
                            <th>Invoice#</th>
                            <th>Company Name</th>
                            <th>Project Name</th>
                            <th>Manager Status</th>
                            <th>Account Status</th>
                            <th class="text-right">Total Requested</th>
                            <th class="text-right">Cash Provided</th>
                        </tr>
                    </thead>
                    <tbody>';
     $jd = 1;
     while ($roww = mysql_fetch_array($cashlist)) { 
         
          $request_by=$roww['request_by'];
                                        $approved_by=$roww['approved_by'];
                                        $received_by=$roww['received_by'];                                        
                                        $approved_date=$roww['approved_date'];
                                        $received_by_date=$roww['received_by_date'];
                                        $request_date = $roww['request_date'];
                                        $approved_by_status=$roww['approved_by_status'];                                        
                                        $received_by_status=$roww['received_by_status'];                                       
                                        $company_name=$roww['company_name'];
                                        $invoice_number=$roww['invoice_number'];
                                         $pname = $roww['pname']; 
                                         $cash_id=$roww['cash_id'];
                                        $cash_idd=$cash_id+1;
                                        $identificationnumber='SSWRQ'.sprintf("%04d",$cash_id);
    
    $att = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd'") or die(mysql_error());
    $show_item = mysql_fetch_array($att);
    
    
     $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$cash_idd'") or die(mysql_error());
        $totals = mysql_fetch_array($sumitem);
        $jumla = $totals['SUM(total)'];
        
         
        while ( $show_item = mysql_fetch_array($att)) { 
         //////////////////////////////////////
           $reference=$show_item['reference'];
            $sumitem2 = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$cash_idd'") or die(mysql_error());
        $totals2 = mysql_fetch_array($sumitem2);
        $TOTALS = $totals2['SUM(total)'];
        $jibu+=$TOTALS;
         $tss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'") or die(mysql_error());
                                        $jstt = mysql_fetch_array($tss);
                                        $jinalako=$jstt['first_name'] . ' ' . $jstt['surname'];
        $output[0] = substr($show_item['detail'], 0, 40).'...';
         $detail=$output[0];
         $reference='SSWRQ'.sprintf("%04d",$show_item['reference']);
         
      $message.=' <tr>
                                <td class="product">'.$jd++.'</td>
                                    <td class="product">'.$reference.'</td>
                                <td class="price">'.$detail.'</td>
                                <td class="price">'.$jinalako.'</td>
                                <td class="product">'.$request_date.'</td> 
                                <td class="price">'.$invoice_number.'</td>
                                <td class="price">'.$company_name.'</td>
                                <td class="product">'.$pname.'</td> 
                                <td class="product">'.$approved_by_status.'</td> 
                                <td class="product">'.$received_by_status.'</td> 
                                <td class="quantity text-right">'.number_format($jumla, 2).'</td>
                                <td class="quantity text-right">'.number_format($jumla, 2).'</td>
                            </tr>';
  }
     }
  $message.=' <tr>
                            <td class="total-quantity" colspan="10"></td>
                            <td class="price text-right" >TOTAL</td>
                            <td class="amount text-right">'.number_format($jibu, 2).'</td>
                        </tr>';
  $message.=' <tr>
                            <td class="total-quantity" colspan="10"></td>
                            <td class="price text-right" >TOTAL</td>
                            <td class="amount text-right">'.number_format($jibuu, 2).'</td>
                        </tr>';
   $message .= '</tbody>
                </table>';
     $message .= '<p>Regards,<br>SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo 'Your mail has been sent successfully.';
    } else{
        echo 'Unable to send email. Please try again.';
    }
    ?>

