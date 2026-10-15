<?php
if (isset($_GET['view'])) {
    if (isset($_GET['store_approve'])) {
    $request_id = $_GET['view'];
    $request_idss=$_GET['view'];
    $sst = mysql_query("SELECT * FROM tbl_request_spare where request_id='$request_idss'") OR die(mysql_error());
    $wsss = mysql_fetch_array($sst);
    $s = $wsss['requester'];
    
    
    $Request_title = $wsss['Request_title'];
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    $tw = mysql_fetch_array($att);
    $titles=$tw['item'];
    
    if(!empty($Request_title)){
        $showtitle=$Request_title;
    }
    else{
        $showtitle=$titles;
    }
    
     $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$s'")or die(mysql_error());
    $yunis = mysql_fetch_array($pinformation);
    $fm = $yunis['first_name'];
    $lm = $yunis['surname'];
    $fullnaamee=$fm . ' ' . $lm;
    
    $idss = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$s'")or die(mysql_error());
                                    $ynn = mysql_fetch_array($idss);
                                    $fmm = $ynn['email'];
    
    
    
    
        $dbt=date("Y-m-d");
    $updatestatus = mysql_query("UPDATE tbl_request_spare SET store_status='Approved',store_date='$dbt' where request_id='$request_id'");
    
    
    
   if ($updatestatus) {
       //send email code goes here
    $emailing=$fmm.'joaqim@sincrositewatch.com';
    $to = $emailing;
    $subject = 'Material Request Notification!';
    $from = 'sas@sincrositewatch.com';
  

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
    $message .= '<p style="">Dear '.$fullnaamee.',</p>';
    $message .= '<p style="">Your Material Requisition for '.$showtitle.' has been Approved by your head of department</p>';   
      $message .= '<p><span>Regards,</span><br/>sas</p>';
$message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
             $message = '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>Approved 
</div>';
    } else{
        echo 'Unable to send email. Please try again.';
    }
    
//send email code
       
       
       
       
       
  
    }
    
    
    
}
 if (isset($_GET['store_reject'])) {
    $request_id = $_GET['view'];
    $updatestatus = mysql_query("UPDATE tbl_request_spare SET store_status='Reject' where request_id='$request_id'");
    if ($updatestatus) {
        
    $request_idss=$_GET['view'];
    $sst = mysql_query("SELECT * FROM tbl_request_spare where request_id='$request_idss'") OR die(mysql_error());
    $wsss = mysql_fetch_array($sst);
    $s = $wsss['requester'];
    
    
    $Request_title = $wsss['Request_title'];
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    $tw = mysql_fetch_array($att);
    $titles=$tw['item'];
    
    if(!empty($Request_title)){
        $showtitle=$Request_title;
    }
    else{
        $showtitle=$titles;
    }
    
     $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$s'")or die(mysql_error());
    $yunis = mysql_fetch_array($pinformation);
    $fm = $yunis['first_name'];
    $lm = $yunis['surname'];
    $fullnaamee=$fm . ' ' . $lm;
    
    $idss = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$s'")or die(mysql_error());
                                    $ynn = mysql_fetch_array($idss);
                                    $fmm = $ynn['email'];
        
                                    
                                    //send email code goes here
    $emailing=$fmm.'joaqim@sincrositewatch.com';
    $to = $emailing;
    $subject = 'Material Request Notification!';
    $from = 'sas@sincrositewatch.com';
  

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
//    $id=1;
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p style="">Dear '.$fullnaamee.',</p>';
    $message .= '<p style="">Your Material Requisition for '.$showtitle.' has been Rejected by Store Manager</p>';   
      $message .= '<p><span>Regards,</span><br/>sas</p>';
$message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
             $message = '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>Rejected
</div>';
    } else{
        echo 'Unable to send email. Please try again.';
    }
    
//send email code
                                    
        
    }
}
    
    
    ?>

    <div class="container">
        <div class="grid"> 
            <div class="row">
                 <div class="col-lg-12">                                     
                 <ul class="pagination">
   <li>
                <a href="daimainfotech.com/sas/user_accounts.php" class="btn btn-default"><i class="fa fa-home"></i>&nbsp;Home </a>
            </li>
            <li >
                <a class="btn btn-default" href="?action=process_request&store_approve=<?php echo $_GET['view'];?>&view=<?php echo $_GET['view'];?>"  ><i class="fa fa-check"></i>&nbsp; Approve</a>
            </li>
            <li >
                <a class="btn btn-default" href="?action=process_request&store_reject=<?php echo $_GET['view'];?>&view=<?php echo $_GET['view'];?>"  ><i class="fa fa-arrow-down"></i>&nbsp; Reject</a>
            </li>
             <li >
                <a class="btn btn-default"  href="#"  data-toggle="modal" data-target="#myModalcar_req"  ><i class="fa fa-barcode"></i>&nbsp;Request List</a>
            </li>
</ul>    
            </div>
</div>
            <div id="invoice-container" class="invoice-container">
 
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $message;?>
                    </div>
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

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <?php
                     $request_idss=$_GET['view'];
    $sst = mysql_query("SELECT * FROM tbl_request_spare where request_id='$request_idss'") OR die(mysql_error());
    $wsss = mysql_fetch_array($sst);
    $s = $wsss['requester'];
    $Request_title = $wsss['Request_title'];
    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$s'")or die(mysql_error());
                                    $yunis = mysql_fetch_array($pinformation);
                                    $fm = $yunis['first_name'];
                                    $lm = $yunis['surname']; 
                    ?>

                    </div>
                    <div class="col-sm-6">
                        <h2 class="text-center" ><strong>MATERIAL REQUISITION FORM</strong></h2>
                        <h2 class="text-center" >Title:<?php echo $Request_title; ?></h2>
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
                            <th>Item</th>
                            <th>Description</th>
                            <th>Specification</th> 
                            <th>Department</th>
                            <th>Quantity</th>                                                                                     
                            <th>Units</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">Total</th>


                        </tr>
                    </thead>
                    <tbody>
    <?php
    $request_id = $_GET['view'];
    $jd = 1;
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    
 
    
    while ($show_item = mysql_fetch_array($att)) {
        $list_id = $show_item['list_id'];
        $item = $show_item['item'];
        $specification = $show_item['specification'];
        $description = $show_item['description'];
        $unit_price = $show_item['unit_price'];
        $quantity = $show_item['quantity'];
        $unit = $show_item['unit'];
        $request_id = $show_item['request_id'];
        $subtotal = $show_item['subtotal'];
        $department = $show_item['department'];
        $sumitem = mysql_query("SELECT SUM(subtotal) FROM request_item_list where request_id='$request_id'") or die(mysql_error());
        $totals = mysql_fetch_array($sumitem);
        $jumla = $totals['SUM(subtotal)'];
        $VAT = 0;
        ?>
                            <tr>
                                <td class="product"><?php echo $jd++; ?></td>
                                <td class="price"><?php echo $item; ?></td>
                                <td class="product"><?php echo $description; ?></td>  
                                <td class="amount"><?php echo $specification; ?></td>
                                <td class="quantity"><?php echo $department; ?></td>                                   
                                <td class="price text-center"><?php echo $quantity; ?></td>
                                <td class="quantity text-center"><?php echo $unit; ?></td>
                                <td class="quantity text-right"><?php echo number_format($unit_price, 2); ?></td>
                                <td class="amount text-right"><?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        <?php
                        }
                        ?>

                        <tr>
                            <td class="total-quantity"></td>
                            <td class="price text-right" colspan="7">SUB TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity"></td>
                            <td class="price text-right" colspan="7">VAT(18%)</td>
                            <td class="amount text-right"><?php echo $VAT; ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="7">TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>

                    </tbody>
                </table>
                <p>
                <div class="col-sm-12">


                </div>
                <div class="col-sm-4">
                    REQUISITION OFFICER<br>
                    NAME: <strong><?php echo $fm . ' ' . $lm; ?></strong> Signature...................<br>
                    SIGNATURE: <strong>--------------------------</strong> Signature................<br>
                    DATE: <strong>--------------------------</strong> Signature..................

                </div>
                <div class="col-sm-4">
                    HEAD OF DEPARTMENT<br>
                    NAME: <strong>--------------------------</strong> Signature...................<br>
                    SIGNATURE: <strong>--------------------------</strong> Signature................<br>
                    DATE: <strong>--------------------------</strong> Signature..................

                </div>
                <div class="col-sm-4">
                    STORE DEPARTMENT<br>
                    NAME: <strong>--------------------------</strong> Signature...................<br>
                    SIGNATURE: <strong>--------------------------</strong> Signature................<br>
                    DATE: <strong>--------------------------</strong> Signature..................

                </div>
                </p>
                <hr>
            </div>


        </div>
    </div>



    <?php
}
?>

<?php
if (isset($_GET['view_request'])) {
    if (isset($_GET['hod_approve'])) {
    $request_id = $_GET['view_request'];
    $updatestatus = mysql_query("UPDATE tbl_request_spare SET hod_status='Approved' where request_id='$request_id'");
    if ($updatestatus) {
         
        $request_idss=$_GET['view_request'];
    $sst = mysql_query("SELECT * FROM tbl_request_spare where request_id='$request_idss'") OR die(mysql_error());
    $wsss = mysql_fetch_array($sst);
    $s = $wsss['requester'];
    
    
    $Request_title = $wsss['Request_title'];
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    $tw = mysql_fetch_array($att);
    $titles=$tw['item'];
    
    if(!empty($Request_title)){
        $showtitle=$Request_title;
    }
    else{
        $showtitle=$titles;
    }
    
     $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$s'")or die(mysql_error());
    $yunis = mysql_fetch_array($pinformation);
    $fm = $yunis['first_name'];
    $lm = $yunis['surname'];
    $fullnaamee=$fm . ' ' . $lm;
    
    $idss = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$s'")or die(mysql_error());
                                    $ynn = mysql_fetch_array($idss);
                                    $fmm = $ynn['email'];
                                    
                                    
                                                                        //send email code goes here
    $emailing=$fmm.',joaqim@sincrositewatch.com';
    $to = $emailing;
    $subject = 'Material Request Notification!';
    $from = 'sas@sincrositewatch.com';
  

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
//    $id=1;
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p style="">Dear '.$fullnaamee.',</p>';
    $message .= '<p style="">Your Material Requisition for '.$showtitle.' has been Rejected by Head of department</p>';   
      $message .= '<p><span>Regards,</span><br/>sas</p>';
$message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
             $message = '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>Approved
</div>';
    } else{
        echo 'Unable to send email. Please try again.';
    }
    
//send email code
        
        
        
    }
}
 if (isset($_GET['hod_reject'])) {
    $request_id = $_GET['view_request'];
    $updatestatus = mysql_query("UPDATE tbl_request_spare SET hod_status='Reject' where request_id='$request_id'");
    if ($updatestatus) {
       
    $request_idss=$_GET['view_request'];
    $sst = mysql_query("SELECT * FROM tbl_request_spare where request_id='$request_idss'") OR die(mysql_error());
    $wsss = mysql_fetch_array($sst);
    $s = $wsss['requester'];
    
    
    $Request_title = $wsss['Request_title'];
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    $tw = mysql_fetch_array($att);
    $titles=$tw['item'];
    
    if(!empty($Request_title)){
        $showtitle=$Request_title;
    }
    else{
        $showtitle=$titles;
    }
    
     $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$s'")or die(mysql_error());
    $yunis = mysql_fetch_array($pinformation);
    $fm = $yunis['first_name'];
    $lm = $yunis['surname'];
    $fullnaamee=$fm . ' ' . $lm;
    
    $idss = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$s'")or die(mysql_error());
                                    $ynn = mysql_fetch_array($idss);
                                    $fmm = $ynn['email'];
                                    
                                    
                                                                        //send email code goes here
      
                                                                        
                                                                        //send email code goes here
    $emailing=$fmm.',joaqim@sincrositewatch.com';
    $to = $emailing;
    $subject = 'Material Request Notification!';
    $from = 'sas@sincrositewatch.com';
  

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
//    $id=1;
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p style="">Dear '.$fullnaamee.',</p>';
    $message .= '<p style="">Your Material Requisition for '.$showtitle.' has been Rejected by Head of department</p>';   
      $message .= '<p><span>Regards,</span><br/>sas</p>';
$message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
             $message = '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>Rejected
</div>';
    } else{
        echo 'Unable to send email. Please try again.';
    }
    
//send email code
                                    
                                    
        
    }
}
    
    
    ?>

    <div class="container">
        <div class="grid"> 
            <div class="row">
                
                 <div class="col-lg-12">                                     
                 <ul class="pagination">
   <li>
                <a href="www.daimainfotech.com/sas/user_accounts.php" class="btn btn-default"><i class="fa fa-home"></i>&nbsp;Home </a>
            </li>
            <li >
                <a class="btn btn-default" href="?action=process_request&hod_approve&view_request=<?php echo $_GET['view_request'];?>"  ><i class="fa fa-check"></i>&nbsp; Approve</a>
            </li>
            <li >
                <a class="btn btn-default" href="?action=process_request&hod_reject&view_request=<?php echo $_GET['view_request'];?>"  ><i class="fa fa-arrow-down"></i>&nbsp; Reject</a>
            </li>
             <li >
                <a class="btn btn-default"  href="#"  data-toggle="modal" data-target="#myModalcar_req"  ><i class="fa fa-barcode"></i>&nbsp;Request List</a>
            </li>
</ul>    
            </div>
</div>
            <div id="invoice-container" class="invoice-container">
 
                <div class="row">
                     <div class="col-sm-12">
                        <?php echo $message;?>
                    </div>
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

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <?php
                     $request_idss=$_GET['view_request'];
    $sst = mysql_query("SELECT * FROM tbl_request_spare where request_id='$request_idss'") OR die(mysql_error());
    $wsss = mysql_fetch_array($sst);
    $s = $wsss['requester'];
    $vc=$wsss['store_email'];
    $Request_title = $wsss['Request_title'];
    
    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$s'")or die(mysql_error());
                                    $yunis = mysql_fetch_array($pinformation);
                                    $fm = $yunis['first_name'];
                                    $lm = $yunis['surname']; 
                    ?>

                    </div>
                    <div class="col-sm-6">
                        <h2 class="text-center" ><strong>MATERIAL REQUISITION FORM</strong></h2>
                        <h2 class="text-center" >Title:<?php echo $Request_title; ?></h2>
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
                            <th>Item</th>
                            <th>Specification</th>
                            <th>Description</th> 
                            <th>Department</th>
                            <th>Quantity</th>                                                                                     
                            <th>Units</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">Total</th>


                        </tr>
                    </thead>
                    <tbody>
    <?php
    $request_id = $_GET['view_request'];
    $jd = 1;
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    
 
    
    while ($show_item = mysql_fetch_array($att)) {
        $list_id = $show_item['list_id'];
        $item = $show_item['item'];
        $specification = $show_item['specification'];
        $description = $show_item['description'];
        $unit_price = $show_item['unit_price'];
        $quantity = $show_item['quantity'];
        $unit = $show_item['unit'];
        $request_id = $show_item['request_id'];
        $subtotal = $show_item['subtotal'];
        $department = $show_item['department'];
        $sumitem = mysql_query("SELECT SUM(subtotal) FROM request_item_list where request_id='$request_id'") or die(mysql_error());
        $totals = mysql_fetch_array($sumitem);
        $jumla = $totals['SUM(subtotal)'];
        $VAT = 0;
        ?>
                            <tr>
                                <td class="product"><?php echo $jd++; ?></td>
                                <td class="price"><?php echo $item; ?></td>
                                <td class="product"><?php echo $specification; ?></td>  
                                <td class="amount"><?php echo $description; ?></td>
                                <td class="quantity"><?php echo $department; ?></td>                                   
                                <td class="price text-center"><?php echo $quantity; ?></td>
                                <td class="quantity text-center"><?php echo $unit; ?></td>
                                <td class="quantity text-right"><?php echo number_format($unit_price, 2); ?></td>
                                <td class="amount text-right"><?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td class="total-quantity"></td>
                            <td class="price text-right" colspan="7">SUB TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity"></td>
                            <td class="price text-right" colspan="7">VAT(18%)</td>
                            <td class="amount text-right"><?php echo $VAT; ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="7">TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>

                    </tbody>
                </table>
                <p>
                <div class="col-sm-12">


                </div>
                <div class="col-sm-4">
                    REQUISITION OFFICER<br>
                    NAME: <strong><?php echo $fm . ' ' . $lm; ?></strong> Signature...................<br>
                    SIGNATURE: <strong>--------------------------</strong> Signature................<br>
                    DATE: <strong>--------------------------</strong> Signature..................

                </div>
                <div class="col-sm-4">
                    HEAD OF DEPARTMENT<br>
                    NAME: <strong><?php echo '';?></strong> Signature...................<br>
                    SIGNATURE: <strong>--------------------------</strong> Signature................<br>
                    DATE: <strong>--------------------------</strong> Signature..................

                </div>
                <div class="col-sm-4">
                    STORE DEPARTMENT<br>
                    NAME: <strong><?php echo '';?></strong> Signature...................<br>
                    SIGNATURE: <strong>--------------------------</strong> Signature................<br>
                    DATE: <strong>--------------------------</strong> Signature..................

                </div>
                </p>
                <hr>
            </div>


        </div>
    </div>



    <?php
}
?>






<div id="myModalcar_req" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Manage Request</h5>
            </div>
            <div class="modal-body">
                <div class="row" id="onyeshavitu">
                   <div class="col-lg-12">
                    <table id="table4" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-left">No.</th>
                                <th class="text-left">Items</th>
                                <th class="text-left">Request Date</th> 
                                <th class="text-left">Request by</th>
                                <th class="text-left">HOD Status</th>
                                <th class="text-left">Store Status</th>
                                <th class="text-left">Action</th>

                            </tr>
                        </thead>

                        <tbody>
                          <?php
                            $j = 1;
                            $emp_idd = $_SESSION["emp_file_no"];
                            $accesstore=$_SESSION['store_access'];
                            
                            $emp = mysql_query("SELECT * FROM tbl_contact where emp_file_no='$emp_idd'") OR die(mysql_error());
                            $ror = mysql_fetch_array($emp);
                            $emails = $ror['email'];
                            $ss = mysql_query("SELECT * FROM tbl_request_spare where store_email='$emails' OR hod_email='$emails' ") OR die(mysql_error());
                            $wss = mysql_fetch_array($ss);
                            $store = $wss['store_email'];
                            $hod_email = $wss['hod_email'];
                            if($store==$emails || $accesstore=="YES"){
                           $sst = mysql_query("SELECT * FROM tbl_request_spare WHERE hod_status='Approved' ORDER BY request_id DESC") OR die(mysql_error());
                                while ($wst = mysql_fetch_array($sst)) {
                                    $request_ids = $wst['request_id'];
                                    $requester = $wst['requester'];
                                    $Request_title=$wst['Request_title'];
                                    $store_status=$wst['store_status'];
                                    $hod_status=$wst['hod_status'];
                                    
                                    $at = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_ids'") or die(mysql_error());
                                    $bt = mysql_fetch_array($at);
                                    $item = $bt['item'];
                                    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
                                    $yunis = mysql_fetch_array($pinformation);
                                    $fm = $yunis['first_name'];
                                    $lm = $yunis['surname'];                 
                                if(!empty($Request_title)){
                                    $view=$Request_title;
                                }  else {
                                    $view=$bt['item'];
                                }
                                if($store_status=="Pending"){
                                    $color="bg-red";
                                    
                                } 
                                elseif($hod_status=="Pending"){
                                    $color="bg-blue";
                                }  else {
                                     $color="";
                                   
                                }
                                    
                                    ?>
                            <tr class="<?php echo $color;?>">
                                        <td class="right"><?php echo $j++; ?></td>
                                        <td class="right"><a href="#"><?php echo $view; ?></a></td>                                       
                                        <td class="right"><?php echo $wst['request_date']; ?></td>
                                        <td class="right"><a href="#"><?php echo $fm . ' ' . $lm; ?></a></td>
                                        <td class="right"><?php echo $wst['hod_status']; ?></td>
                                        <td class="right"><?php echo $wst['store_status']; ?></td>                                                                      
                                            <td class="right">
<ul class="showlist">

        <li><a href="?action=process_request&view=<?php echo $request_ids;?>">View</a></li>

        <li><a href="?action=delete_request_item&items_id=<?php echo $request_ids; ?>" data-confirm="Are you sure to delete this item?" id="delete">Delete</a></li>

    </ul>
                                            </td>
                            

                                        <?php 
                                          }
                                        }
                                        
                                        if($hod_email == $emails){
                                       
                                           $sst = mysql_query("SELECT * FROM tbl_request_spare where hod_email='$hod_email' ORDER BY request_id DESC") OR die(mysql_error());
                                while ($wst = mysql_fetch_array($sst)) {
                                    $request_ids = $wst['request_id'];
                                    $requester = $wst['requester'];
                                    $Request_title=$wst['Request_title'];
                                    $store_status=$wst['store_status'];
                                    $hod_status=$wst['hod_status'];
                                    
                                    $at = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_ids'") or die(mysql_error());
                                    $bt = mysql_fetch_array($at);
                                    $item = $bt['item'];
                                    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
                                    $yunis = mysql_fetch_array($pinformation);
                                    $fm = $yunis['first_name'];
                                    $lm = $yunis['surname'];                 
                                if(!empty($Request_title)){
                                    $view=$Request_title;
                                }  else {
                                    $view=$bt['item'];
                                }
                                if($store_status=="Pending"){
                                    $color="bg-red";
                                    
                                } 
                                elseif($hod_status=="Pending"){
                                    $color="bg-blue";
                                }  else {
                                     $color="";
                                   
                                }
                                    
                                    ?>
                            <tr class="<?php echo $color;?>">
                                        <td class="right"><?php echo $j++; ?></td>
                                        <td class="right"><a href="#"><?php echo $view; ?></a></td>                                       
                                        <td class="right"><?php echo $wst['request_date']; ?></td>
                                        <td class="right"><a href="#"><?php echo $fm . ' ' . $lm; ?></a></td>
                                        <td class="right"><?php echo $wst['hod_status']; ?></td>
                                        <td class="right"><?php echo $wst['store_status']; ?></td>                                                                      
                                            <td class="right">
<!--                                                <form action="?action=process_request" method="POST">
                                                    <button type="submit" value="<?php echo $request_ids; ?>" name="store_approve"  class="btn btn-success fg-white" >Process Request</button> | 
                                                    <button type="submit" value="<?php echo $request_ids; ?>" name="print" class="btn btn-danger fg-white">View Items</button>
                                                </form>-->
<ul class="showlist">

        <li><a href="?action=process_request&view_request=<?php echo $request_ids;?>">View</a></li>

        <li><a href="?action=delete_request_item&items_id=<?php echo $request_ids; ?>" data-confirm="Are you sure to delete this item?" id="delete">Delete</a></li>

    </ul>
                                            </td>
                             
                                            
                                            <?php
                                            }
                                        }
                                            ?>
                                    </tr> 
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>