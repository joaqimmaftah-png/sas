<?php
require_once __DIR__ . '/../../mysql_compat.php';

if (isset($_GET['action']) == 'cash_account') {
    if (isset($_GET['cash_approve'])) {

        $cash_approve = $_GET['cash_approve'];
        $approved_by = $_SESSION["emp_file_no"];
        $approved_date = date("d-m-Y H:i:s");
$cashlist = mysql_query("UPDATE cash_request SET received_by='$approved_by',received_by_date='$approved_date',received_by_status='Pending Retirement',request_status='Pending Retirement' where cash_id='$cash_approve'") or die(mysql_error());
        echo '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>Approved &nbsp;
</div>';


        //SEND EMAILS
        /////////////////////////////////////////////////////////
        $css = '<style>
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
        $CASH_id = $_GET['View_cash'] + 1;
        $CASH = $_GET['View_cash'];
        $identificationnumber = 'SSWRQ' . sprintf("%04d", $CASH);
        $cashlist = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH'") or die(mysql_error());
        $roww = mysql_fetch_array($cashlist);

        $request_by = $roww['request_by'];
        $approved_by = $roww['approved_by'];
        $received_by = $roww['received_by'];
        $approved_date = $roww['approved_date'];
        $received_by_date = $roww['received_by_date'];
        $request_date = $roww['request_date'];
        $approved_by_status = $roww['approved_by_status'];
        $request_status = $roww['request_status'];
        $received_by_status = $roww['received_by_status'];
        $rejection_reasons = $roww['rejection_reasons'];
        $company_name = $roww['company_name'];
        $invoice_number = $roww['invoice_number'];
        $pname = $roww['pname'];



        $jd = 1;
        $att = mysql_query("SELECT * FROM cash_request_item WHERE reference='$CASH_id'") or die(mysql_error());
        $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$CASH_id'") or die(mysql_error());
        $totals = mysql_fetch_array($sumitem);
        $jumla = $totals['SUM(total)'];
        /////////////////////////////////////////////////////////
        //SEND EMAILS
        $ids = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH'")or die(mysql_error());
        $yn = mysql_fetch_array($ids);
        $fmn = $yn['request_by'];

        $idss = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$fmn'")or die(mysql_error());
        $ynn = mysql_fetch_array($idss);
        $fmm = $ynn['email'];


        $pinformationn = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$fmn'")or die(mysql_error());
        $yuniss = mysql_fetch_array($pinformationn);
        $fm = $yuniss['first_name'];
        $lm = $yuniss['surname'];

        $fullnamee = $fm . " " . $lm;
        $emailing = $fmm . ",joaqim@sincrositewatch.com";
        $to = $emailing;
        $subject = 'Cash Request Notification!';
        $from = 'sas@sincrositewatch.com';
        $jinalamenager = $fullnamee;
        $jinalamwombaji = 'Diana Senyoni';
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers

        $headers .= 'From: ' . $from . "\r\n" .
                'Reply-To: ' . $from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<p style="text-bold;">Dear ' . $jinalamenager . ',</p>';
        $message .= '<p style="">Make sure you entrust the receipt of the transaction for the Cash Request No.'.$identificationnumber.' to account Office for further process.<br>Thanks You</p>';
        $message.=$css;
        $message .='<table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Details</th>                            
                            <th>Unit Price</th>
                            <th>Quantity</th> 
                            <th>Units</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>';

        while ($show_item = mysql_fetch_array($att)) {
            $detail = $show_item['detail'];
            $charge_to = $show_item['charge_to'];
            $reference = $show_item['reference'];
            $qq = $show_item['quantity'];
            $units_price = $show_item['units_price'];
            $un = $show_item['units'];
            $total = $show_item['total'];
            $message.=' <tr>
                                <td class="product">' . $jd++ . '</td>
                                <td class="price">' . $request_date . '</td>
                                <td class="price">' . $detail . '</td>
                                <td class="product">' . $units_price . '</td> 
                                <td class="product">' . $qq . '</td> 
                                <td class="product">' . $un . '</td> 
                                <td class="quantity text-right">' . number_format($total, 2) . '</td>
                            </tr>';
        }
        $message.=' <tr>
                            <td class="total-quantity" colspan="5"></td>
                            <td class="price text-right" >TOTAL</td>
                            <td class="amount text-right">' . number_format($jumla, 2) . '</td>
                        </tr>';
        $message .= '</tbody>
                </table>';
        $message .= '<p style="color:#080;font-size:18px;"><a href="http://sas.sincrositewatch.com/" target="_blank">Click this link to approve or reject the request!</a></p>';
        $message .= '<p style="">Regards,</p>';
        $message .= '<p style="">' . $jinalamwombaji . ' </p>';
        $message .= '<h4 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h4>';
        $message .= '</body></html>';
        // Sending email
        if (mail($to, $subject, $message, $headers)) {
            $message = '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>you will be notified by email 
</div>';
        } else {
            $message = 'Unable to send email. Please try again.';
        }
//END SEND EMAIL
    }
    
    if(isset($_GET['gen_ptv'])){
        $selectpcv=  mysql_query("SELECT * FROM cash_request ORDER BY pcv DESC") or die(mysql_error());
        $row=  mysql_fetch_array($selectpcv);
        $DSEN123=$row['pcv']+1;
        
        
        
    }

    if (isset($_POST['reject_request'])) {
        $rejecting = $_POST['cash_idd'];
        $reason = $_POST['reason'];
        $identificationnumber = 'SSWRQ' . sprintf("%04d", $CASH);
        $approved_by = $_SESSION["emp_file_no"];
        $approved_date = date("d-m-Y H:i:s");
        $cashlist = mysql_query("UPDATE cash_request SET received_by='$approved_by',received_by_date='$approved_date',received_by_status='Reject',request_status='Reject',rejection_reasons='$reason' where cash_id='$rejecting'") or die(mysql_error());
        echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>Rejecting Request &nbsp;
</div>';


        //SEND EMAILS
        /////////////////////////////////////////////////////////
        $css = '<style>
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
        $CASH_id = $_POST['cash_idd'] + 1;
        $CASH = $_POST['cash_idd'];
        $identificationnumber = 'SSWRQ' . sprintf("%04d", $CASH);
        $cashlist = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH'") or die(mysql_error());
        $roww = mysql_fetch_array($cashlist);

        $request_by = $roww['request_by'];
        $approved_by = $roww['approved_by'];
        $received_by = $roww['received_by'];
        $approved_date = $roww['approved_date'];
        $received_by_date = $roww['received_by_date'];
        $request_date = $roww['request_date'];
        $approved_by_status = $roww['approved_by_status'];
        $request_status = $roww['request_status'];
        $received_by_status = $roww['received_by_status'];
        $rejection_reasons = $roww['rejection_reasons'];
        $company_name = $roww['company_name'];
        $invoice_number = $roww['invoice_number'];
        $pname = $roww['pname'];



        $jd = 1;
        $att = mysql_query("SELECT * FROM cash_request_item WHERE reference='$CASH_id'") or die(mysql_error());
        $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$CASH_id'") or die(mysql_error());
        $totals = mysql_fetch_array($sumitem);
        $jumla = $totals['SUM(total)'];
        /////////////////////////////////////////////////////////

        $ids = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH'")or die(mysql_error());
        $yn = mysql_fetch_array($ids);
        $fmn = $yn['request_by'];

        $idss = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$fmn'")or die(mysql_error());
        $ynn = mysql_fetch_array($idss);
        $fmm = $ynn['email'];


        $pinformationn = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$fmn'")or die(mysql_error());
        $yuniss = mysql_fetch_array($pinformationn);
        $fm = $yuniss['first_name'];
        $lm = $yuniss['surname'];

        $fullnamee = $fm . " " . $lm;
        $emailing = $fmm . ",joaqim@sincrositewatch.com";
        $to = $emailing;
        $subject = 'Cash Request Notification!';
        $from = 'sas@sincrositewatch.com';
        $jinalamenager = $fullnamee;
        $jinalamwombaji = "sas";
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers

        $headers .= 'From: ' . $from . "\r\n" .
                'Reply-To: ' . $from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        // Compose a simple HTML email message
        $message = '<html><body>';

        $message .= '<p style="text-bold;">Dear ' . $jinalamenager . ',</p>';
        $message .= '<p style="">You Cash Request No.'.$identificationnumber.' has been rejected by Accountants: Reason:' . $reason . '</p>';
        $message.=$css;
        $message .='<table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Details</th>                            
                            <th>Unit Price</th>
                            <th>Quantity</th> 
                            <th>Units</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>';

        while ($show_item = mysql_fetch_array($att)) {
            $detail = $show_item['detail'];
            $charge_to = $show_item['charge_to'];
            $reference = $show_item['reference'];
            $qq = $show_item['quantity'];
            $units_price = $show_item['units_price'];
            $un = $show_item['units'];
            $total = $show_item['total'];
            $message.=' <tr>
                                <td class="product">' . $jd++ . '</td>
                                <td class="price">' . $request_date . '</td>
                                <td class="price">' . $detail . '</td>
                                <td class="product">' . $units_price . '</td> 
                                <td class="product">' . $qq . '</td> 
                                <td class="product">' . $un . '</td> 
                                <td class="quantity text-right">' . number_format($total, 2) . '</td>
                            </tr>';
        }
        $message.=' <tr>
                            <td class="total-quantity" colspan="5"></td>
                            <td class="price text-right" >TOTAL</td>
                            <td class="amount text-right">' . number_format($jumla, 2) . '</td>
                        </tr>';
        $message .= '</tbody>
                </table>';
        $message .= '<p style="color:#080;font-size:18px;"><a href="http://sas.sincrositewatch.com/" target="_blank">Click this link to approve or reject the request!</a></p>';
        $message .= '<p style="">Regards,</p>';
        $message .= '<p style="">' . $jinalamwombaji . ' </p>';
        $message .= '<h4 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h4>';
        $message .= '</body></html>';
        // Sending email
        if (mail($to, $subject, $message, $headers)) {
            $message = '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>you will be notified by email 
</div>';
        } else {
            $message = 'Unable to send email. Please try again.';
        }
//END SEND EMAIL
    }


    if (isset($_GET['approve_receipt'])) {
        $cash_approve = $_GET['approve_receipt'];
        $approved_by = $_SESSION["emp_file_no"];
        $approved_date = date("d-m-Y H:i:s");
        $cashlist = mysql_query("UPDATE cash_request SET received_by='$approved_by',received_by_date='$approved_date',received_by_status='Closed',request_status='Closed' where cash_id='$cash_approve'") or die(mysql_error());


        //SEND EMAILS
        /////////////////////////////////////////////////////////
        $css = '<style>
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
        $CASH_id = $_GET['approve_receipt']+1;
        
        $CASH = $_GET['approve_receipt'];
        $identificationnumber = 'SSWRQ' . sprintf("%04d", $CASH);
        $cashlist = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH'") or die(mysql_error());
        $roww = mysql_fetch_array($cashlist);

        $request_by = $roww['request_by'];
        $approved_by = $roww['approved_by'];
        $received_by = $roww['received_by'];
        $approved_date = $roww['approved_date'];
        $received_by_date = $roww['received_by_date'];
        $request_date = $roww['request_date'];
        $approved_by_status = $roww['approved_by_status'];
        $request_status = $roww['request_status'];
        $received_by_status = $roww['received_by_status'];
        $rejection_reasons = $roww['rejection_reasons'];
        $company_name = $roww['company_name'];
        $invoice_number = $roww['invoice_number'];
        $pname = $roww['pname'];



        $jd = 1;
        $att = mysql_query("SELECT * FROM cash_request_item WHERE reference='$CASH_id'") or die(mysql_error());
        $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$CASH_id'") or die(mysql_error());
        $totals = mysql_fetch_array($sumitem);
        $jumla = $totals['SUM(total)'];
        /////////////////////////////////////////////////////////
        //SEND EMAILS
        $ids = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH'")or die(mysql_error());
        $yn = mysql_fetch_array($ids);
        $fmn = $yn['request_by'];

        $idss = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$fmn'")or die(mysql_error());
        $ynn = mysql_fetch_array($idss);
        $fmm = $ynn['email'];


        $pinformationn = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$fmn'")or die(mysql_error());
        $yuniss = mysql_fetch_array($pinformationn);
        $fm = $yuniss['first_name'];
        $lm = $yuniss['surname'];

        $fullnamee = $fm . " " . $lm;
        $emailing = $fmm . ",joaqim@sincrositewatch.com";
        $to = $emailing;
        $subject = 'Cash Request Notification!';
        $from = 'sas@sincrositewatch.com';
        $jinalamenager = $fullnamee;
        $jinalamwombaji = 'sas';
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers

        $headers .= 'From: ' . $from . "\r\n" .
                'Reply-To: ' . $from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<p style="text-bold;">Dear ' . $jinalamenager . ',</p>';
        $message .= '<p style="">Your receipt of the transaction for the Cash Request No.'.$identificationnumber.' Received.<br>Thanks You</p>';
        $message.=$css;
        $message .='<table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Details</th>                            
                            <th>Unit Price</th>
                            <th>Quantity</th> 
                            <th>Units</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>';

        while ($show_item = mysql_fetch_array($att)) {
            $detail = $show_item['detail'];
            $charge_to = $show_item['charge_to'];
            $reference = $show_item['reference'];
            $qq = $show_item['quantity'];
            $units_price = $show_item['units_price'];
            $un = $show_item['units'];
            $total = $show_item['total'];
            $message.=' <tr>
                                <td class="product">' . $jd++ . '</td>
                                <td class="price">' . $request_date . '</td>
                                <td class="price">' . $detail . '</td>
                                <td class="product">' . $units_price . '</td> 
                                <td class="product">' . $qq . '</td> 
                                <td class="product">' . $un . '</td> 
                                <td class="quantity text-right">' . number_format($total, 2) . '</td>
                            </tr>';
        }
        $message.=' <tr>
                            <td class="total-quantity" colspan="5"></td>
                            <td class="price text-right" >TOTAL</td>
                            <td class="amount text-right">' . number_format($jumla, 2) . '</td>
                        </tr>';
        $message .= '</tbody>
                </table>';
        $message .= '<p style="color:#080;font-size:18px;"><a href="http://sas.sincrositewatch.com/" target="_blank">Click this link to approve or reject the request!</a></p>';
        $message .= '<p style="">Regards,</p>';
        $message .= '<p style="">' . $jinalamwombaji . ' </p>';
        $message .= '<h4 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h4>';
        $message .= '</body></html>';
        // Sending email
        if (mail($to, $subject, $message, $headers)) {
            $message = '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>you will be notified by email 
</div>';
        } else {
            $message = 'Unable to send email. Please try again.';
        }
//END SEND EMAIL
    }
    ?>
    <div class="container">
        <div class="grid">               
            <div id="invoice-container" class="invoice-container">

                <div class="row">
                    <div class="col-sm-12 menusss">
                        <ul class="pagination">
                            <li>
                                <a href="" class="btn btn-default"><i class="fa fa-home"></i>&nbsp;Home </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#manage_cash_request" class="btn btn-default"><i class="fa fa-list"></i>&nbsp;Show Request</a>
                            </li>
                            <li >
                                <a href="?action=cash_account&cash_approve=<?php echo $_GET['View_cash']; ?>&View_cash=<?php echo $_GET['View_cash']; ?>" class="btn btn-default"><i class="fa fa-check-square"></i>&nbsp;Approve </a>
                            </li>
                            <li >
                                <a href="?action=cash_account&gen_ptv=<?php echo $_GET['View_cash']; ?>&View_cash=<?php echo $_GET['View_cash']; ?>"  class="btn btn-default" class="btn btn-default"><i class="fa fa-check-square"></i>&nbsp;Gen Petty Cash Vocher</a>
                            </li>
                            <li >
                                <a href="#reject_modal"  data-toggle="modal"  data-cash_id="<?php echo $_GET['View_cash']; ?>" class="btn btn-danger reject_modall" ><i class="fa fa-remove fa-fw"></i>Reject</a>
                            </li>
                            <li >
                                <a href="" class="btn btn-default"><i class="fa fa-arrows"></i>&nbsp;Send to Up level</a>
                            </li>
                            <li >
                                <a href="?action=cash_account&approve_receipt=<?php echo $_GET['View_cash']; ?>&View_cash=<?php echo $_GET['View_cash']; ?>" class="btn btn-default"><i class="fa fa-check"></i>&nbsp;Approve Receipt</a>
                            </li>
                            <li >
                                <a href="javascript:window.print()" class="btn btn-default"><i class="fa fa-print"></i>&nbsp;Print</a>
                            </li>
                        </ul>


                    </div>



                </div>
                <div class="row">
                    <?php
                     $CASH_id = $_GET['View_cash'] + 1;
    $CASH = $_GET['View_cash'];
    $identificationnumber = 'SSWRQ' . sprintf("%04d", $CASH);
    $cashlist = mysql_query("SELECT * FROM cash_request WHERE cash_id='$CASH' ") or die(mysql_error());
    $roww = mysql_fetch_array($cashlist);

    $request_by = $roww['request_by'];
    $approved_by = $roww['approved_by'];
    $received_by = $roww['received_by'];
    $approved_date = $roww['approved_date'];
    $received_by_date = $roww['received_by_date'];
    $request_date = $roww['request_date'];
    $approved_by_status = $roww['approved_by_status'];
    $request_status = $roww['request_status'];
    $received_by_status = $roww['received_by_status'];
    $rejection_reasons = $roww['rejection_reasons'];
    $company_name = $roww['company_name'];
        $invoice_number = $roww['invoice_number'];
        $pname = $roww['pname'];
        $title = $roww['title'];

    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'")or die(mysql_error());
    $yunis = mysql_fetch_array($pinformation);
    $fm = $yunis['first_name'];
    $lm = $yunis['surname'];

    $opinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$approved_by'")or die(mysql_error());
    $op = mysql_fetch_array($opinfo);
    $fop = $op['first_name'];
    $lop = $op['surname'];

    $accinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$received_by'")or die(mysql_error());
    $acc = mysql_fetch_array($accinfo);
    $facc = $acc['first_name'];
    $lacc = $acc['surname'];
    $jd = 1;
    $att = mysql_query("SELECT * FROM cash_request_item WHERE reference='$CASH_id'") or die(mysql_error());
    $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$CASH_id'") or die(mysql_error());
    $totals = mysql_fetch_array($sumitem);
    $jumla = $totals['SUM(total)'];
                    ?>
                    <div class="col-sm-3">
                        <img src="assets/invoice.jpg" alt="logo">

                    </div>
                    <div class="col-sm-6">
                        <h2 class="text-center" ><strong>SINCRO SITEWATCH LTD</strong></h2>
                        <p class="text-center small">Plot No. 1337 Msonge Street, Mikocheni A,PO Box 80407,DSM<br>
                            Tel: +255 22 2700971 , Fax: +255 22 2700970,<br>
                            wwww.sincrositewatch.com</p> 
                    </div>
                    <div class="col-sm-3">
                         <?php
                        if(!empty($company_name)){                       
                        ?>
                        <strong>PROFORMA ATTACHMENT</strong><br>
                        <strong>Company Name:</strong><?php echo $company_name;?><br>
                        <strong>Invoice Number:</strong><?php echo $invoice_number;?><br>
<?php }?>
                         <?php
                        if(!empty($pname)){                       
                        ?>
                        <strong>PROJECT NUMBER: </strong><?php echo $pname;?><br>

                        
<?php }?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">


                    </div>
                    <div class="col-sm-6">
                        <h2 class="text-center" ><span><strong>REQUISITION</strong></span><br>
                            <span><?php echo $title.'-'.$identificationnumber='SSWRQ'.sprintf("%04d",$_GET['View_cash']); ' - ';?></span>
                            </h2>
                    </div>
                    <div class="col-sm-3">
                        <p class="text-right small"><strong></strong></p>
                        <p class="text-right"></p>
                    </div>
                </div>
                <p class="small"></p>

                <table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Details</th>                            
                            <th>Unit Price</th>
                            <th>Quantity</th> 
                            <th>Units</th>
                            <th class="text-right">Total</th>


                        </tr>
                    </thead>
                    <tbody>
    <?php  
    while ($show_item = mysql_fetch_array($att)) {

        $detail = $show_item['detail'];
        $charge_to = $show_item['charge_to'];
        $reference = $show_item['reference'];
        $qq = $show_item['quantity'];
        $units_price = $show_item['units_price'];
        $un = $show_item['units'];
        $total = $show_item['total'];
        ?>
                            <tr>
                                <td class="product"><?php echo $jd++; ?></td>
                                <td class="price"><?php echo $request_date; ?></td>
                                <td class="price"><?php echo $detail; ?></td>
                                <td class="product"><?php echo $units_price; ?></td> 
                                <td class="product"><?php echo $qq; ?></td> 
                                <td class="product"><?php echo $un; ?></td> 
                                <td class="quantity text-right"><?php echo number_format($total, 2); ?></td>
                            </tr>
    <?php } ?>



                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="5">TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>
                                      <?php
                          $attv = mysql_query("SELECT * FROM cash_request_item WHERE reference='$CASH_id'") or die(mysql_error());
                           $vb = mysql_fetch_array($attv);
        $cquoitem=$vb['quoitem'];
        
//        
//       if($cquoitem>0){
           
        $sumneed = mysql_query("SELECT * FROM tbl_quotationitem where Item_id='$cquoitem'") or die(mysql_error());
        $jumlaquov= mysql_fetch_array($sumneed);
        $totalamount = $jumlaquov['Net_Price'];
        $Quotation_id = $jumlaquov['Quotation_id'];
        $quotation_items=mysql_query("SELECT * FROM tbl_quotationitem where Quotation_id='$Quotation_id'") or die(mysql_error());
        $m=mysql_query("SELECT SUM(Net_Price) FROM tbl_quotationitem where Quotation_id='$Quotation_id'") or die(mysql_error());
        
         $v=mysql_query("SELECT * FROM tbl_preparedquotation where Quotation_id='$Quotation_id'") or die(mysql_error());
          $gf=  mysql_fetch_array($v);
          $quotation_number=$gf['Quotation_number'];
          $qt_title=$gf['Quotation_name'];
          
           $bbc=mysql_query("SELECT * FROM tbl_purchase_order where project='$quotation_number'") or die(mysql_error());
           $jumlayapo=0;
           while($cnn = mysql_fetch_array($bbc)){
              $poitem=$cnn['item'];  
               $vat=$cnn['VAT']; 
               
                $calcdiscount = mysql_query("SELECT * FROM lpo_discount where itemid='$poitem'") or die(mysql_error());
                     $disc=  mysql_fetch_array($calcdiscount);
                     $amount=$disc['amount'];
                     $percent=$disc['percent'];
                     
               
                   $sumpurchse=mysql_query("SELECT SUM(subtotal) FROM tbl_items where item='$poitem'") or die(mysql_error());
                   $itv= mysql_fetch_array($sumpurchse);
                    $totalamountpo=(($itv['SUM(subtotal)'])*($vat/100));
                    $subtotal=$itv['SUM(subtotal)'];
                    $discountprcent=$subtotal-$amount;
                      $VAT = $discountprcent * ($vat/100);
                    $JUMLA = $discountprcent + $VAT;
//             $jumlayote=0;
//            while ($itv= mysql_fetch_array($sumpurchse)) {
               // $totalamountpo=$itv['SUM(subtotal)'];
                //$jumlayapo +=$totalamountpo;
                $jumlayapo +=$JUMLA;
                  
//             }
            
           }
           $poamount= number_format($jumlayapo,2);
            $poj=$jumlayapo;
            
//           
//           while ($all_items = mysql_fetch_array($quotation_items)) {
//                
//            }
           
          
        $tee=  mysql_fetch_array($m);
        $quotation_sum=$tee['SUM(Net_Price)'];
        $jumlayote=0;
        while ($all_items = mysql_fetch_array($quotation_items)) {
            $itemslist=$all_items['Item_id'];
            $sumtotal=mysql_query("SELECT SUM(total) FROM cash_request_item where quoitem='$itemslist'") or die(mysql_error());
//             $jumlayote=0;
            while ($yee = mysql_fetch_array($sumtotal)) {
                 $sumtotalamount=$yee['SUM(total)'];
                 $jumlayote +=$sumtotalamount;
                  
             }
//             $percent=$poamount;
//             $percent=  number_format((($jumlayote+$poamount)/$quotation_sum)*100,2);
        }
       
        $percent=  number_format((($jumlayote+$poj)/$quotation_sum)*100,2);
        
        
                        ?>
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="5"><?php echo $qt_title.'-'.$quotation_number?>:Total Quotation Amount</td>
                            <td class="amount text-right"><?php echo number_format($quotation_sum,2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="5">Total Payment already Requested </td>
                            <td class="amount text-right"><?php echo number_format($jumlayote,2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="5">Total PO Amount</td>
                            <td class="amount text-right"><?php echo $poamount; ?></td>
                        </tr>
                         <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="5">Percent</td>
                            <td class="amount text-right"><?php echo $percent.'%'; ?></td>
                        </tr>
                        <?php
//                        }
                        ?>

                    </tbody> 
                </table>
                <p>

                <div class="col-sm-12">

                </div>
                <div class="col-sm-4">
                    REQUISITION OFFICER<br>
                    NAME: <?php echo $fm . ' ' . $lm; ?><br>
                    STATUS: <strong><?php echo $request_status; ?></strong><br>
                    DATE: <strong><?php echo $request_date; ?></strong>

                </div>
                <div class="col-sm-4">

                    OPERATION DIRECTOR<br>
                    NAME: <?php echo $fop . ' ' . $lop; ?><br>
                    STATUS: <strong><?php echo $approved_by_status; ?></strong><br>
                    DATE: <strong><?php echo $approved_date; ?></strong>



                </div>
                <div class="col-sm-4">

                    ACCOUNTANT<br>
                    NAME: <?php echo $facc . ' ' . $lacc; ?><br>
                    STATUS: <strong><?php echo $received_by_status; ?></strong><br>
                    DATE: <strong><?php echo $received_by_date; ?></strong>


                </div>
                </p>
                <hr>
                <div class="col-sm-12">
    <?php
    if (!empty($rejection_reasons)) {
        ?>
                        <strong class="fg-active-cobalt">Rejected Reasons:</strong><?php echo $rejection_reasons; ?>
        <?php
    }
    ?>


                </div>
                <hr>

            </div>


        </div>
    </div>



    <?php
}
?>



<!--reject_modal-->
<div id="reject_modal" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" id="">

            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <h4 class="modal-title" id="myModalLabel">REJECT REQUEST</h4>
                </div>

                <div class="modal-body ">
                    <div id="kubwa">
                    </div>       
                    <div role="tabpanel">
                        <div id="show_data">

                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">                        
                            <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Cash_id:</span></span>
                            <input name="cash_idd"  class="form-control editable"  id="show_cash_id" value=""  aria-describedby="sizing-addon1" type="text">   

                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Rejection Reason:</span></span>
                            <textarea name="reason"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" ></textarea>                            
                        </div>

                        <hr>
                        <div class="input-group" style="width:100%; margin:10px 0">
                            <button type="submit"  name="reject_request" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>

                        </div>

                    </div>                  
                </div>
            </form>
        </div>
    </div>
</div>

<!-------------------------------------------------------------myModalpayroll------------------------------------------->

<!-- Modal -->
<!--<div id="petty_cash_vocher" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

     Modal content
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PETTY CASH VOUCHER FORM</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-lg-12">
                  maishaaa
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>-->


<!--end petty cash vocher-->
<div id="manage_cash_request" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Manage Cash Request</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <div class="example">
                            <table   id="table6" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Request ID</th> 
                                        <th class="text-left">Requested by</th>  
                                        <th class="text-left">Request Date</th>
                                        <th class="text-left">Manager Status</th>
                                        <th class="text-left">Account Status</th>
                                    </tr>
                                </thead>

                                <tbody>
<?php
$cashlist = mysql_query("SELECT * FROM cash_request ORDER BY cash_id DESC") or die(mysql_error());
while ($roww = mysql_fetch_array($cashlist)) {
    $request_date = $roww['request_date'];
    $request_by = $roww['request_by'];
    $approved_by_status = $roww['approved_by_status'];
    $received_by_status = $roww['received_by_status'];
    $cash_id = $roww['cash_id'];
    $identificationnumber='SSWRQ'.sprintf("%04d",$cash_id);
    $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_id' ORDER BY reference LIMIT 1") or die(mysql_error());
    $rs = mysql_fetch_array($trcc);
    $detail = $rs['detail'];
    $tss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'") or die(mysql_error());
    $jstt = mysql_fetch_array($tss);
    ?>
                                        <tr>
                                            <td class="right">
                                                
                                                                                               <?php
                                                if($_SESSION["emp_file_no"]=='SSW 147' || $_SESSION["emp_file_no"]=='SSW 050' || $_SESSION["emp_file_no"]=='SSW 211'){
                                                ?>
                                                <a href="?action=cash_account&View_cash=<?php echo $cash_id; ?>">View</a>
                                                <?php
                                                }
                                                ?>
                                                
                                                 <?php
                                                if($_SESSION["emp_file_no"]=='SSW 122'){
                                                ?>
                                                <a href="?action=cash_request&View_cash=<?php echo $cash_id; ?>">View</a>
                                                <?php
                                                }
                                                ?>
                                                
                                             
                                            </td>
                                            <td class="right"><?php echo $identificationnumber; ?></td>
                                            <td class="right"><?php echo $jstt['first_name'] . ' ' . $jstt['surname']; ?></td>
                                            <td class="right"><?php echo $request_date; ?></td>
                                            <td class="right"><?php echo $approved_by_status; ?></td>
                                            <td class="right"><?php echo $received_by_status; ?></td>
                                        </tr> 
    <?php
}
?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!--/////////////////Attendance////////////////////////////-->