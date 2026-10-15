<?php
$messagez='';
     if (isset($_GET['hod_approve'])) {
        $request_id = $_GET['view'];
         $remark=$_POST['remark'];
              $client=$_POST['client'];
              $datt=date('Y-m-d');
        $updatestatus = mysql_query("UPDATE tbl_request_spare SET hod_status='Approved',client_status='$client',remarks='$remark',approve_date='$datt' where request_id='$request_id'");
        if ($updatestatus) {
             
            $request_idss = $_GET['view'];
            $sst = mysql_query("SELECT * FROM tbl_request_spare where request_id='$request_idss'") OR die(mysql_error());
            $wsss = mysql_fetch_array($sst);
            $s = $wsss['requester'];


            $Request_title = $wsss['Request_title'];
            $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
            $tw = mysql_fetch_array($att);
            $titles = $tw['item'];

            if (!empty($Request_title)) {
                $showtitle = $Request_title;
            } else {
                $showtitle = $titles;
            }

            $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$s'")or die(mysql_error());
            $yunis = mysql_fetch_array($pinformation);
            $fm = $yunis['first_name'];
            $lm = $yunis['surname'];
            $fullnaamee = $fm . ' ' . $lm;

            $idss = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$s'")or die(mysql_error());
            $ynn = mysql_fetch_array($idss);
            $fmm = $ynn['email'];


            //send email code goes here
            $emailing = $fmm . 'joaqim@sincrositewatch.com';
            $to = $emailing;
            $subject = 'Material Request Notification!';
            $from = 'sas@sincrositewatch.com';


            // To send HTML mail, the Content-type header must be set
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
//    $id=1;
            $headers .= 'From: ' . $from . "\r\n" .
                    'Reply-To: ' . $from . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            // Compose a simple HTML email message
            $message = '<html><body>';
            $message .= '<p style="">Dear ' . $fullnaamee . ',</p>';
            $message .= '<p style="">Your Material Requisition for ' . $showtitle . ' has been approved by Head of department</p>';
            $message .= '<p><span>Regards,</span><br/>sas</p>';
            $message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
            $message .= '</body></html>';
            // Sending email
            if (mail($to, $subject, $message, $headers)) {
                $messagez = '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>Approved
</div>';
            } else {
                echo 'Unable to send email. Please try again.';
            }

//send email code
        }
    }
    if (isset($_GET['hod_reject'])) {
        $request_id = $_GET['view'];
        $updatestatus = mysql_query("UPDATE tbl_request_spare SET hod_status='Reject' where request_id='$request_id'");
        if ($updatestatus) {

            $request_idss = $_GET['view'];
            $sst = mysql_query("SELECT * FROM tbl_request_spare where request_id='$request_idss'") OR die(mysql_error());
            $wsss = mysql_fetch_array($sst);
            $s = $wsss['requester'];


            $Request_title = $wsss['Request_title'];
            $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
            $tw = mysql_fetch_array($att);
            $titles = $tw['item'];

            if (!empty($Request_title)) {
                $showtitle = $Request_title;
            } else {
                $showtitle = $titles;
            }

            $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$s'")or die(mysql_error());
            $yunis = mysql_fetch_array($pinformation);
            $fm = $yunis['first_name'];
            $lm = $yunis['surname'];
            $fullnaamee = $fm . ' ' . $lm;

            $idss = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$s'")or die(mysql_error());
            $ynn = mysql_fetch_array($idss);
            $fmm = $ynn['email'];


            //send email code goes here
            //send email code goes here
            $emailing = $fmm . 'joaqim@sincrositewatch.com';
            $to = $emailing;
            $subject = 'Material Request Notification!';
            $from = 'sas@sincrositewatch.com';


            // To send HTML mail, the Content-type header must be set
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Create email headers
//    $id=1;
            $headers .= 'From: ' . $from . "\r\n" .
                    'Reply-To: ' . $from . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            // Compose a simple HTML email message
            $message = '<html><body>';
            $message .= '<p style="">Dear ' . $fullnaamee . ',</p>';
            $message .= '<p style="">Your Material Requisition for ' . $showtitle . ' has been Rejected by Head of department</p>';
            $message .= '<p><span>Regards,</span><br/>sas</p>';
            $message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
            $message .= '</body></html>';
            // Sending email
            if (mail($to, $subject, $message, $headers)) {
                $messagez = '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>Rejected
</div>';
            } else {
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
                            <a href="http://daimainfotech.com/sas/user_accounts.php" class="btn btn-default"><i class="fa fa-home"></i>&nbsp;Home </a>
                        </li>
                        <li >
                            <a class="btn btn-default"  href="#"  data-toggle="modal" data-target="#approved_modal"  ><i class="fa fa-check"></i>&nbsp; Approve</a>


    <!--<a class="btn btn-default" href="?action=process_request&store_approve=<?php echo $_GET['view']; ?>&view=<?php echo $_GET['view']; ?>"  ><i class="fa fa-check"></i>&nbsp; Approve</a>-->
                        </li>
                        <li >
                            <a class="btn btn-default" href="?action=process_request&hod_reject&view_request=<?php echo $_GET['view']; ?>"  ><i class="fa fa-arrow-down"></i>&nbsp; Reject</a>
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
    <?php echo $messagez; ?>
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
    $request_idss = $_GET['view'];
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
                            <th>Model</th>
                            <th>Part Number</th>
                            <th>Quantity</th>                                                                                     
                            


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
        $ref_no=$show_item['ref_no'];
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
        
        $zc = mysql_query("SELECT * FROM tbl_spare_parts where part_id='$ref_no'") or die(mysql_error());
        $msc=mysql_fetch_array($zc)
        
        ?>
                            <tr>
                                <td class="product"><?php echo $jd++; ?></td>
                                <td class="price"><?php echo $item; ?></td>
                                <td class="product"><?php echo $msc['description']; ?></td>  
                                <td class="amount"><?php echo $msc['specification']; ?></td>
                                <td class="quantity"><?php echo $msc['model']; ?></td>  
                                 <td class="quantity"><?php echo $msc['part_number']; ?></td>
                                <td class="price text-center"><?php echo $quantity; ?></td>
                                
                            </tr>
                        <?php } ?>

                       

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




<!-------------------------------------------------------------myModalpayroll------------------------------------------->
<div id="approved_modal" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <h4 class="modal-title" id="myModalLabel">APPROVE REQUEST</h4>
                </div>
<form action="?action=hprocess_request&hod_approve&view=<?php echo $_GET['view']; ?>" method="POST">
                <div class="modal-body ">
                    <div class="row" >

                        <div class="col-lg-12">
                             <div class="form-group">
                                              <label for="sel1">CLIENT APPROVE:</label>
                                                <select class="form-control"   name="client" required="">
                                                    
                                                    <option value="YES">YES</option>
                                                   <option value="NO">NO</option>
                                                </select>
                                            </div>
 
<div class="form-group">
                                               
    <input name="remark" placeholder="Remarks"  class="form-control amount editable"   aria-describedby="sizing-addon1" required="" type="text">
                                            </div>
                            <button type="submit" class="btn btn-success" name="add_goods_received" style="color:white"><i class="fa fa-arrow-up"></i>Approve Request</button>

                        </div>
                    </div>               
                </div>
            </form>
        </div>
    </div>
</div>