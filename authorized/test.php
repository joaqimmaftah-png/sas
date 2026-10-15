    <?php
    include 'authorized/db.php';
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
                            $CASH_id =14+1;
    $CASH =14;
$cashlist = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH'") or die(mysql_error());
                                $roww = mysql_fetch_array($cashlist);
                                        
                                        $request_by=$roww['request_by'];
                                        $approved_by=$roww['approved_by'];
                                        $received_by=$roww['received_by'];
                                        $approved_date=$roww['approved_date'];
                                        $received_by_date=$roww['received_by_date'];
                                        $request_date = $roww['request_date'];
                                        $approved_by_status=$roww['approved_by_status'];
                                        $request_status=$roww['request_status'];
                                        $received_by_status=$roww['received_by_status'];
                                        $rejection_reasons=$roww['rejection_reasons'];
                                        $company_name=$roww['company_name'];
                                        $invoice_number=$roww['invoice_number'];
                                         $pname = $roww['pname'];                       
    $jd = 1;
    $att = mysql_query("SELECT * FROM cash_request_item WHERE reference='$CASH_id'") or die(mysql_error());
     $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$CASH_id'") or die(mysql_error());
        $totals = mysql_fetch_array($sumitem);
        $jumla = $totals['SUM(total)'];
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
     
     while ($show_item = mysql_fetch_array($att)) { 
         $detail=$show_item['detail'];
        $charge_to=$show_item['charge_to'];
        $reference=$show_item['reference'];
         $qq=$show_item['quantity'];
          $units_price=$show_item['units_price'];
           $un=$show_item['units'];
        $total=$show_item['total'];
      $message.=' <tr>
                                <td class="product">'.$jd++.'</td>
                                <td class="price">'.$request_date.'</td>
                                <td class="price">'.$detail.'</td>
                                <td class="product">'.$units_price.'</td> 
                                <td class="product">'.$qq.'</td> 
                                <td class="product">'.$un.'</td> 
                                <td class="quantity text-right">'.number_format($total, 2).'</td>
                            </tr>';
  }
  $message.=' <tr>
                            <td class="total-quantity" colspan="5"></td>
                            <td class="price text-right" >TOTAL</td>
                            <td class="amount text-right">'.number_format(10000, 2).'</td>
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

