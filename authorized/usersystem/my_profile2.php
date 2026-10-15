<?php
$message = "";

//$markadrees=GetMAC();
$markadrees = 'SINCRO HQ';

$markadreesw = '';
//////////////leave management///////////////
if(isset($_POST['requiredemail'])){
   //   $desc=$_POST['description'];
   $requiredemail=$_POST['requiredemail'];
        $status = "Approved";
         $select_asset = mysql_query("SELECT * FROM tbl_leaves WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
         $rrow = mysql_fetch_array($select_asset);
         $hod_email=$rrow['hod_email'];
         $fs_email=$rrow['fs_email'];
         $emp_file_no=$rrow['emp_file_no'];
         $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
         $de=  mysql_fetch_array($se);
         $employee_email=$de['email'];
         $asa=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
         $qw=  mysql_fetch_array($asa);
         $first_name=$qw['first_name'];
         
         if($hod_email==$requiredemail){;
         $u = mysql_query("UPDATE tbl_leaves SET hod_status='$status',hod_comment='' WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
          //////////////////////////////////////////////////////////
                       
    $to = $employee_email.',eva.mbawala@sincrositewatch.com';
    $admin='joaqim@sincrositewatch.com';
    $subject = 'Leave Request Note';
    $from = 'sas@sincrositewatch.com';
    $new_date=  date("d M y");
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
    $id=1;
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$admin."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
      $message = '<html><body>';
    $message .= '<p>Dear:'.$first_name.'</p>';
    $message .= '<p>Your leave request has been successful approved by  Head of department</p>';
    $message .= '<p>Date Approved:'.$new_date.'</p>';
    $message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo '';
    } else{
        echo '';
    }
          
          /////////////////////////////////////////////////////////////
         }
         
         
         if($fs_email==$requiredemail){
              $u = mysql_query("UPDATE tbl_leaves SET fs_status='$status',supervisor_comm='' WHERE leave_id='".$_POST['leave_id']."'") or die(mysql_error());
               //////////////////////////////////////////////////////////                      
    $to = $employee_email.',eva.mbawala@sincrositewatch.com';;
    $admin='joaqim@sincrositewatch.com';
    $subject = 'Leave Request Note';
    $from = 'sas@sincrositewatch.com';
    $new_date=  date("d M y");
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
    $id=1;
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$admin."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<p>Dear:'.$first_name.'</p>';   
    $message .= '<p>Your leave request has been successful Approved by  Supervisor</p>';
    $message .= '<p>Date Approved:'.$new_date.'</p>';
    $message .= '<p style="color:red">*Note This Message Sent automatically by SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        $message= '<div class="alert alert-success">
  <strong>Success!</strong>Approved</a>.
</div>';
    } else{
        echo '';
    }
          
          /////////////////////////////////////////////////////////////
         } 
}
//////////////////leave management////////////////////



if (isset($_GET['fuel_approve']) || isset($_POST['fuel_approve'])) { 



    $status = "Approved";
    $employee = $_SESSION["emp_file_no"];
    if (isset($_GET['fuel_approve'])) {
        $approveid = $_GET['fuel_approve'];
    }
    if (isset($_POST['fuel_approve'])) {
        $approveid = $_POST['fuel_approve'];
        $quantity = $_POST['quantity'];
        $amount = $_POST['amount'];
        $approve = mysql_query("UPDATE fuel_request SET status='$status',approve_by='$employee',quantity='$quantity',amount='$amount' WHERE refno='$approveid'") or die(mysql_error());
    }




    $approve = mysql_query("UPDATE fuel_request SET status='$status',approve_by='$employee' WHERE refno='$approveid'") or die(mysql_error());
    $chaguarequest = mysql_query("SELECT * FROM fuel_request WHERE refno='$approveid'") or die(mysql_error());
    $onesha = mysql_fetch_array($chaguarequest);
    $quantity = $onesha['quantity'];
    $unit = $onesha['unit'];
    $amount = $onesha['amount'];
    $requester = $onesha['requester'];
    $req_date = $onesha['req_date'];
    $subtotal = $amount * $quantity;
    $details = $onesha['details'];
    $reg_no = $onesha['reg_no'];
    $reportdate=date('Ymd',strtotime($req_date));
    
    $pname= $onesha['pname'];
    $cname= $onesha['cname'];
    $quoitem =$onesha['quoitem'];



    $fueltocash = mysql_query("INSERT INTO cash_request(`request_by`,`request_date`,`approved_by_status`, `received_by_status`,request_status,vehiclenumber,pname,company_name,requestdatereport)"
            . "VALUE('$requester','$req_date','Pending','Pending','Pending','$reg_no','$pname','$cname','$reportdate')") or die(mysql_error());
    if ($fueltocash) {
        $chaguacash = mysql_query("SELECT * FROM cash_request order by cash_id DESC") or die(mysql_error());
        $chaguaid = mysql_fetch_array($chaguacash);
        $cash_id = $chaguaid['cash_id'];
        $refence = $cash_id + 1;
        $identificationnumber = 'SSWRQ' . sprintf("%04d", $cash_id);
        if ($refence) {
            $ingizacashitems = mysql_query("INSERT INTO cash_request_item(`detail`, units,units_price,quantity, `total`, `reference`,quoitem)"
                    . "values('$details','$unit','$amount','$quantity','$subtotal','$refence','$quoitem')") or die(mysql_error());
        }
    }


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

    //SEND EMAILS



    $jinalawombaji = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
    $mwombaji = mysql_fetch_array($jinalawombaji);
    $fm1 = $mwombaji['first_name'];
    $lm1 = $mwombaji['surname'];

    $fullnameez = $fm1 . " " . $lm1;
    $emailing = "pastory.hamaro@sincrositewatch.com";
    $to = $emailing;
    $subject = 'Payment Request Notification!';
    $from = 'sas@sincrositewatch.com';
    $jinalamenager = 'Pastory Hamaro';
    $jinalamwombaji = $fullnameez;
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
    $message .= '<p style="">Please kindly review and approve the new payment Request No.' . $identificationnumber . '.You are required to act on this approved immediatly.</p>';
    $message .= $css;
    $message .= '<table class="table cart table-bordered">
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

    $quantity = $onesha['quantity'];
    $unit = $onesha['unit'];
    $amount = $onesha['amount'];
    $requester = $onesha['requester'];
    $req_date = $onesha['req_date'];
    $subtotal = $amount * $quantity;
    $details = $onesha['details'];

    $message .= ' <tr>
                                <td class="product">1</td>
                                <td class="price">' . $req_date . '</td>
                                <td class="price">' . $details . '</td>
                                <td class="product">' . $amount . '</td> 
                                <td class="product">' . $quantity . '</td> 
                                <td class="product">' . $unit . '</td> 
                                <td class="quantity text-right">' . number_format($subtotal, 2) . '</td>
                            </tr>';

    $message .= ' <tr>
                            <td class="total-quantity" colspan="5"></td>
                            <td class="price text-right" >TOTAL</td>
                            <td class="amount text-right">' . number_format($subtotal, 2) . '</td>
                        </tr>';
    $message .= '</tbody>
                </table>';
    $message .= '<p style="color:#080;font-size:18px;"><a href="http://daimainfotech.com/sas" target="_blank">Click this link to approve or reject the request!</a></p>';
    $message .= '<p style="">Regards,</p>';
    $message .= '<p style="">' . $jinalamwombaji . ' </p>';
    $message .= '<p style=""><br></p>';
    $message .= '<h4 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h4>';
    $message .= '</body></html>';
    // Sending email
    if (mail($to, $subject, $message, $headers)) {
        $message = '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Fuel Request successful Approved!</strong> 
</div>';
    }



    //////////////////email/////////////////////////////////

    echo "<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#fuelrequestnotificationsend').modal('show');
            });
        </script>";
}

if (isset($_GET['fuel_approveacc'])) {
    $approveid = $_GET['fuel_approveacc'];
    $status = "Approved";
    $employee = $_SESSION["emp_file_no"];
    $approve = mysql_query("UPDATE fuel_request SET account_status='$status',approve_by='$employee' WHERE refno='$approveid'") or die(mysql_error());


    echo "<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#fuelrequestnotification').modal('show');
            });
        </script>";
}
if (isset($_GET['fuel_reject'])) {
    $approveid = $_GET['fuel_reject'];
    $status = "Rejected";
    $employee = $_SESSION["emp_file_no"];
    $approve = mysql_query("UPDATE fuel_request SET status='$status',approve_by='$employee' WHERE refno='$approveid'") or die(mysql_error());

    echo "<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#fuelrequestnotification').modal('show');
            });
        </script>";
}
if (isset($_POST['fuel_request'])) {

    $unit = $_POST['unit'];
    $quant = $_POST['quant'];
    $details = $_POST['details'];
    $reqtitle = $_POST['reqtitle'];
    $v_number = $_POST['v_number'];
    $rquest = $_POST['rquest'];
    $cname = $_POST['cname'];
    $pname = $_POST['pname'];
    $quoitem= $_POST['quoitem'];
    $rquestdate = date("d-m-Y H:i");

    $amount = $_POST['amount'];
    $amounts = $amount * $quant;

    if (!empty($reqtitle) AND ! empty($v_number)) {
        $insert_faults = mysql_query("INSERT INTO `fuel_request`(`request_title`, `details`, `quantity`,amount,`unit`, `requester`, `reg_no`,req_date,pname,cname,quoitem)"
                . " VALUES('$reqtitle','$details','$quant','$amount','$unit','$rquest','$v_number','$rquestdate','$pname','$cname','$quoitem')") or die(mysql_error());
        if ($insert_faults) {
            echo "<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#fuelrequestnotification').modal('show');
            });
        </script>";
        } else {
            echo "<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#fuelrequestnotification2').modal('show');
            });
        </script>";
        }
    } else {

        echo "<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#fuelrequestnotification3').modal('show');
            });
        </script>";
    }
    
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
                           
    $to = 'boniface.salim@sincrositewatch.com,nzaro.kimbute@sincrositewatch.com,ekapela@sincrositewatch.com';
    $admin='ekapela@sincrositewatch.com';
    $subject = 'Fuel request notification';
    $from = 'sas@sincrositewatch.com';
    $new_date=  date("d M y");
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
    $id=1;
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$admin."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    // Compose a simple HTML email message
      $message = '<html><body>';
    $message .= '<p>Dear:'.$first_name.'</p>';
      $message .= $css;
    $message .= '<table class="table cart table-bordered">
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

   $unit = $_POST['unit'];
    $quant = $_POST['quant'];
    $details = $_POST['details'];
    $reqtitle = $_POST['reqtitle'];
    $v_number = $_POST['v_number'];
    $rquest = $_POST['rquest'];
    $cname = $_POST['cname'];
    $pname = $_POST['pname'];
    $quoitem= $_POST['quoitem'];
    $rquestdate = date("d-m-Y H:i");

    $amount = $_POST['amount'];
   $subtotal = $amount * $quant;

    $message .= ' <tr>
                                <td class="product">1</td>
                                <td class="price">' . $rquestdate . '</td>
                                <td class="price">' . $details . '</td>
                                <td class="product">' . $amount . '</td> 
                                <td class="product">' . $quant . '</td> 
                                <td class="product">' . $unit . '</td> 
                                <td class="quantity text-right">' . number_format($subtotal, 2) . '</td>
                            </tr>';

    $message .= ' <tr>
                            <td class="total-quantity" colspan="5"></td>
                            <td class="price text-right" >TOTAL</td>
                            <td class="amount text-right">' . number_format($subtotal, 2) . '</td>
                        </tr>';
    $message .= '</tbody>
                </table>';
    $message .= '<p style="color:#080;font-size:18px;"><a href="http://daimainfotech.com/sas" target="_blank">Click this link to approve or reject the request!</a></p>';
    $message .= '<p style="">Regards,</p>';
    $message .= '<p style="">Fuel Manager</p>';
    $message .= '<p style=""><br></p>';
    $message .= '<h4 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h4>';
    $message .= '</body></html>';
    
    
}


if (isset($_POST['register_car_issue'])) {
    $faultsdescr = $_POST['faultsdescr'];
    $datefaults = $_POST['datefaults'];
    $operationcond = $_POST['operationcond'];
    $planresolution = $_POST['planresolution'];
    $reasons = $_POST['reasons'];
    $car_reg_num = $_POST['car_reg_num'];
    $status = "Open";
    $reportdate = date("Ymd", strtotime($datefaults));
    $reportplanresoln = date("Ymd", strtotime($planresolution));
    $possible_causes = $_POST['possible_cause'];

    $insert_faults = mysql_query("INSERT INTO tbl_car_faults(vehicle_reg_num,Reported_issue,possible_causes,fault_reported_date,operation_conditions,planned_resolution_date,reasons_remark,status,reportdate,planresolndate)"
            . " VALUES('$car_reg_num','$faultsdescr','$possible_causes','$datefaults','$operationcond','$planresolution','$reasons','$status','$reportdate','$reportplanresoln')") or die(mysql_error());

    if ($insert_faults) {
        echo "<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#notification').modal('show');
            });
        </script>";
    }
}


if (isset($_POST['attachment'])) {
    $employee_no = $_POST['employee_no'];
    $name = $_POST['name'];

    $kind_id = $_POST['kind_id'];
    $filename = $_FILES['file']['name'];
    $filetype = $_FILES['file']['type'];
    $filesize = $_FILES['file']['size'];
    $select_name_cat = mysql_query("SELECT * FROM tbl_attachment_kind WHERE kind_id='$kind_id'") or die(mysql_error());
    $show = mysql_fetch_array($select_name_cat);
    $category_name = $show['category_name'];
    $attachment_dir = $show['attachment_dir'];
    $target_dir = "authorized/attachments/" . $attachment_dir . "/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);


    if (!empty($kind_id) && !empty($target_file)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $insert = mysql_query("INSERT INTO `tbl_attachments`(`file_name`, `file_type`, `file_size`, `attachment_category`, `employe_no`)"
                    . "VALUES ('$filename','$filetype','$filesize','$kind_id','$employee_no')") or die(mysql_error());
            $message = '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>upload ' . "$filename" . ' to ' . "$attachment_dir" . ' &nbsp;Folder
</div>';
        }
    } else {
        $message = '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">Ã—</a>
    <strong>Error!</strong> 
</div>';
    }
}




if (isset($_POST['request_spares'])) {
    $hod_sel = $_POST['hod_sel'];
    $req_title = $_POST['req_title'];
    if (!empty($hod_sel) AND ! empty($req_title)) {
        $desc = $_POST['desc'];
        $itemm = $_POST['itemm'];
        $P = $_POST['P'];
        $model = $_POST['model'];
        $man = $_POST['man'];
        $units = $_POST['units'];
        $spec = mysql_real_escape_string($_POST['spec']);
        $hod_sel = $_POST['hod_sel'];
        $req_title = $_POST['req_title'];
        $quantity = $_POST['quant'];
        $departmentt = $_POST['department'];
        $request_date = date("d-m-Y H:i:s");
        $requester = $_SESSION["emp_file_no"];
        $partid = $_POST['partid'];


        $show_contacts = mysql_query("SELECT * FROM tbl_contact WHERE email='$hod_sel'") or die(mysql_error());
        $show_email = mysql_fetch_array($show_contacts);
        $hod_email = $show_email['email'];
        $hod_idd = $show_email['emp_file_no'];
        $store_email = "amina.njiku@sincrositewatch.com";
        $store_status = "Pending";
        $hod_status = "Pending";
        $jinalahod = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$hod_idd'")or die(mysql_error());
        $letejina = mysql_fetch_array($jinalahod);
        $fname = $letejina['first_name'];
        $lname = $letejina['surname'];


        $aliyeomba = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
        $muombaji = mysql_fetch_array($aliyeomba);
        $jnamwanzo = $muombaji['first_name'];
        $jnamwisho = $muombaji['surname'];

        $emailing = $hod_sel . ',joaqim@sincrositewatch.com,nadhifa.omar@sincrositewatch.com';
        $to = $emailing;
        $subject = 'Material Request Notification!';
        $from = 'sas@sincrositewatch.com';
        $datee = date("M d Y");

        if (!empty($itemm)) {

            $customers = mysql_query("INSERT INTO tbl_request_spare(`request_date`, `requester`, `store_email`, `hod_email`, `store_status`, `hod_status`,Request_title)"
                    . "VALUE('$request_date','$requester','$store_email', '$hod_sel','$store_status', '$hod_status','$req_title')") or die(mysql_error());


            if ($customers) {
                ////////////////////////////////////
                $select_custid = mysql_query("SELECT * FROM tbl_request_spare ORDER BY request_id DESC") or die(mysql_error());
                $Q = mysql_fetch_array($select_custid);
                $request_id = $Q['request_id'];

                //////////////////////////////////////////////////////////
                for ($i = 0; $i < sizeof($itemm); $i++) {
//                if( !isset($dueDate[$i]) ) $dueDate[$i] = 'NULL' ;


                    $insert = mysql_query("INSERT INTO request_item_list( `item`, `specification`, `model`, `partnumber`, `manufacture`, `description`, `department`, `quantity`,`unit`, `request_id`,`ref_no`)"
                            . "values('$itemm[$i]','$spec[$i]','$model[$i]','$P[$i]','$man[$i]','$desc[$i]','$departmentt[$i]','$quantity[$i]','$units[$i]','$request_id','$partid[$i]')") or die(mysql_error());
                }

                if ($insert) {
                    $fgs = mysql_query("DELETE FROM tbl_request_spare_temporary WHERE requester_id='$requester'") or die(mysql_error());
                }

//SEND EMAILS
                if (!empty($hod_sel)) {
                    $emailing = $hod_sel . ',joaqim@sincrositewatch.com';
                    $to = $emailing;
                    $subject = 'Material Request Notification!';
                    $from = 'sas@sincrositewatch.com';

                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Create email headers

                    $headers .= 'From: ' . $from . "\r\n" .
                            'Reply-To: ' . $from . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                    // Compose a simple HTML email message
                    $message = '<html><body>';
                    $message .= '<p style="text-bold;">Dear ' . $fname . ' ' . $lname . ',</p>';
                    $message .= '<p style="">Please kindly review and approve the new material request.You are required to act on this approved immediatly.</p>';
                    $message .= '<p style="color:#080;font-size:18px;"><a href="http://sas.sincrositewatch.com/" target="_blank">Click this link to approve or reject the request!</a></p>';
                    $message .= '<p style="">Regards,</p>';
                    $message .= '<p style="">' . $jnamwanzo . ' ' . $jnamwisho . '</p>';
                    $message .= '<p style=""><br></p>';
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
                } else {
                    $message = '<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error!</strong>Part Description must be filled.. 
</div>';
                }
            }
        }
    } else {
        $message = '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">X</a>
    <strong>Error!Request title and HOD can not be empty</strong> 
</div>';
    }
}

if (isset($_POST['cash_request'])) {

    $details = $_POST['details'];


    $reqtitle = $_POST['reqtitle'];
    $v_number = $_POST['v_number'];
    $sitename = $_POST['site_cla'];

    $pname = $_POST['pname'];
    $pricee = $_POST['price'];
    $quant = $_POST['quant'];
    $unit = $_POST['unit'];
    $bad_symbols = array(",");
    $price = str_replace($bad_symbols, "", $pricee);
    $rquest = $_POST['rquest'];
    $request_date = date("d-m-Y H:i:s");
    $cname = $_POST['cname'];
    $invnumber = $_POST['invnumber'];
    $tarehyareo = date("d-m-Y");
    $requestdatereport = date("Ymd");
    $vat=$_POST['vat'];
    $ewura=$_POST['ewura_levy'];

    $mzuiet = mysql_query("SELECT * FROM cash_request WHERE request_by='$rquest' AND request_status='Pending Retirement'") or die(mysql_error());
    $mzuie = mysql_query("SELECT * FROM cash_request WHERE request_by='$rquest' AND request_status='Pending Retirement'");
    $ombatena = mysql_num_rows($mzuie);

    while ($rowjj = mysql_fetch_array($mzuiet)) {
        $request_datet = $rowjj['request_date'];
        $convert = explode(' ', $request_datet);
        $testdate = $convert[0];

        if ($tarehyareo == $testdate) {
            $ombatena = 'YES';
        } else {
            $ombatena = '';
        }
    }





    if ($ombatena == 'YES') {
        $r_equest = mysql_query("INSERT INTO cash_request(`request_by`,`request_date`,`approved_by_status`, `received_by_status`,request_status,invoice_number,company_name,pname,requestdatereport,vehiclenumber,sitename,title,`vat`, `ewura_levy`)"
                . "VALUE('$rquest','$request_date','Pending','Pending','Pending','$invnumber','$cname','$pname','$requestdatereport','$v_number','$sitename','$reqtitle','$vat','$ewura')") or die(mysql_error());
        $pinformationn = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$rquest'")or die(mysql_error());
        $yuniss = mysql_fetch_array($pinformationn);
        $fm = $yuniss['first_name'];
        $lm = $yuniss['surname'];



        if ($price) {

            $st = mysql_query("SELECT * FROM cash_request ORDER BY cash_id DESC") or die(mysql_error());
            $QQ = mysql_fetch_array($st);
            $cash_id = $QQ['cash_id'];
            $refence = $cash_id + 1;
            //////////////////////////////////////////////////////////////////////////////////////////
            for ($i = 0; $i < sizeof($details); $i++) {
                $subtotal = $quant[$i] * $price[$i];

                $insert = mysql_query("INSERT INTO cash_request_item(`detail`,units,units_price,quantity,`total`,`reference`)"
                        . "values('$details[$i]','$unit[$i]','$price[$i]','$quant[$i]','$subtotal','$refence')") or die(mysql_error());
            }

            if (!empty($v_number)) {
                $tbl_car_cash_request = mysql_query("INSERT INTO `tbl_car_cash_request`(`Title`, `reference`, `car_id`) VALUES ('$reqtitle','$refence','$v_number')") OR die(mysql_error());
            }
            if (!empty($_POST['quoitem'])) {
                $quoitem = $_POST['quoitem'];
                $tbl_updates = mysql_query("UPDATE `cash_request_item` SET `quoitem`='$quoitem' WHERE `reference`='$refence'") OR die(mysql_error());
            }





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
            $CASH_id = $QQ['cash_id'] + 1;
            $CASH = $QQ['cash_id'];
            $identificationnumber = 'SSWRQ' . sprintf("%04d", $cash_id);
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

            $fullnamee = $fm . " " . $lm;
            $emailing = "pastory.hamaro@sincrositewatch.com";
            $to = $emailing;
            $subject = 'Payment Request Notification!';
            $from = 'sas@sincrositewatch.com';
            $jinalamenager = 'Pastory Hamaro';
            $jinalamwombaji = $fullnamee;
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
            $message .= '<p style="">Please kindly review and approve the new Payment Request No.' . $identificationnumber . '.You are required to act on this approved immediatly.</p>';
            $message .= $css;
            $message .= '<table class="table cart table-bordered">
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
                $message .= ' <tr>
                                <td class="product">' . $jd++ . '</td>
                                <td class="price">' . $request_date . '</td>
                                <td class="price">' . $detail . '</td>
                                <td class="product">' . $units_price . '</td> 
                                <td class="product">' . $qq . '</td> 
                                <td class="product">' . $un . '</td> 
                                <td class="quantity text-right">' . number_format($total, 2) . '</td>
                            </tr>';
            }
            $message .= ' <tr>
                            <td class="total-quantity" colspan="5"></td>
                            <td class="price text-right" >TOTAL</td>
                            <td class="amount text-right">' . number_format(10000, 2) . '</td>
                        </tr>';
            $message .= '</tbody>
                </table>';
            $message .= '<p style="color:#080;font-size:18px;"><a href="http://daimainfotech.com/sas" target="_blank">Click this link to approve or reject the request!</a></p>';
            $message .= '<p style="">Regards,</p>';
            $message .= '<p style="">' . $jinalamwombaji . ' </p>';
            $message .= '<p style=""><br></p>';
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
        } else {
            
        }
    } else {
        $message = '<div class="alert alert-danger success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Error!</strong>Your supposed to submit you pending receipt 
</div>';
    }
}

if (isset($_GET['action']) == 'delete_request_item') {
    $items_id = $_GET['items_id'];
    $request_id = $items_id + 1;

    $s = mysql_query("SELECT * FROM tbl_request_spare WHERE request_id='$items_id'") or die(mysql_error());
    $j = mysql_num_rows($s);
    if ($j > 0) {
        $deletedata1 = mysql_query("DELETE FROM tbl_request_spare WHERE request_id='$items_id' AND hod_status<>'Approved'") or die(mysql_error());

        if ($deletedata1) {
            $deletedata = mysql_query("DELETE FROM request_item_list WHERE request_id='$request_id'") or die(mysql_error());

            $message = '<div class="alert alert-success error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Request Successful Deleted!</strong>
</div>';
        } else {
            $message = '<div class="alert alert-danger error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> You do not have permission to delete this request</strong>
</div>';
        }
    }
}
?>

<?php
$personalinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'")or die(mysql_error());
$PERSON = mysql_fetch_array($personalinfo);
$first_name = $PERSON['first_name'];
$middle_name = $PERSON['middle_name'];
$surname = $PERSON['surname'];
$date_of_birth = $PERSON['date_of_birth'];
$gender = $PERSON['gender'];
$marital_status = $PERSON['marital_status'];
$religion = $PERSON['religion'];

$country = $PERSON['country'];
$city = $PERSON['city'];
$district = $PERSON['district'];
$house_no = $PERSON['house_no'];
$profile_pic = $PERSON['profile_pic'];
//contact
$contactinfo = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'")or die(mysql_error());
$contact = mysql_fetch_array($contactinfo);
$phone = $contact['phone'];
$phone2 = $contact['phone2'];
$postal_addr = $contact['postal_addr'];
$email = $contact['email'];
$email2 = $contact['email2'];
$fax = 'Null';

$position = mysql_query("SELECT * FROM tbl_assign_to_department WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'") or die(mysql_error());
$positions = mysql_fetch_array($position);
$department_id = $positions['department_id'];
$position_id = $positions['position_id'];
$designation_id = $positions['designation'];
$start_date = $positions['start_date'];
$end_date = $positions['end_date'];
$departments = mysql_query("SELECT * FROM tbl_department WHERE department_id='$department_id'") or die(mysql_error());
$positioning = mysql_query("SELECT * FROM tbl_position WHERE position_id='$position_id'") or die(mysql_error());
$tbl_title = mysql_query("SELECT * FROM tbl_title WHERE title_code='$designation_id'") or die(mysql_error());
$dep = mysql_fetch_array($departments);
$pos = mysql_fetch_array($positioning);
$des = mysql_fetch_array($tbl_title);
$department_name = $dep['department_name'];
$position_name = $pos['position_name'];
$designation = $des['title_name'];
///////////////////////////
//SELECT HEAD OF DEPARTMENT AND SUPERVISOR
$show_position_hod = mysql_query("SELECT * FROM tbl_assign_to_department WHERE department_id='$department_id' AND position_id=1") or die(mysql_error());
$show_position_supervisor = mysql_query("SELECT * FROM tbl_assign_to_department WHERE department_id='$department_id' AND position_id=3") or die(mysql_error());
$hod_id = mysql_fetch_array($show_position_hod);
$spv_id = mysql_fetch_array($show_position_supervisor);

///////////////////////////////SALARY
$tbl_salary = mysql_query("SELECT * FROM tbl_accounts WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "' ") or die(mysql_error());
$salary = mysql_fetch_array($tbl_salary);

$salaryy = $salary['salary'];
$allowance = $salary['allowance'];
$travel_allowance = $salary['travel_allowance'];
$Medical_allowance = $salary['Medical_allowance'];
$House_rent_allowance = $salary['House_rent_allowance'];
$Conveyance_allowance = $salary['Conveyance_allowance'];
$remark = $salary['remark'];
$status = $salary['status'];
$payroll_no = $salary['payroll_no'];

//////////////////////////////////////////
$tbl_user_account = mysql_query("SELECT * FROM tbl_user_accounts WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "' ") or die(mysql_error());
$sl = mysql_fetch_array($tbl_user_account);

$access_lever = $sl['access_lever'];
$asset_trackers = $_SESSION['asset_tracker'];
$cash_requesting = $_SESSION['cash_request'];

if ($asset_trackers == 'YES') {
    $disable = '';
    $disable2 = '';
} elseif ($position_id == 1) {
    $disable = 'disabled="disabled"';
    $disable2 = 'disabled';
} else {
    $disable = 'disabled="disabled"';
    $disable2 = 'disabled';
}
?>
<head>
    <script>
        function showtt(str) {
            if (str.length == 0) {
                document.getElementById("tt").innerHTML = "";
                document.getElementById("tt").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("tt").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/usersystem/tt.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
    <script>

        function showitem(str) {
            if (str.length == 0) {
                document.getElementById("searchitem").innerHTML = "";
                document.getElementById("searchitem").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("searchitem").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/usersystem/page_specification.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
    <script>
        function showproject(str) {
            if (str.length == 0) {
                document.getElementById("projectitem").innerHTML = "";
                document.getElementById("projectitem").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("projectitem").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/usersystem/projecttable.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

    <script>
        function showprojectz(str) {
            if (str.length == 0) {
                document.getElementById("projectitemz").innerHTML = "";
                document.getElementById("projectitemz").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("projectitemz").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/usersystem/projecttable.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>


    <script>
        function showactions(str) {
            if (str.length == 0) {
                document.getElementById("pagination").innerHTML = "";
                document.getElementById("pagination").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("pagination").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/usersystem/asset_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
    <script>
        function showsrequest(str) {
            if (str.length == 0) {
                document.getElementById("onyeshaitem").innerHTML = "";
                document.getElementById("onyeshaitem").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("onyeshaitem").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/usersystem/page_show_item.php?qq=" + str, true);
            xmlhttp.send();
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#reportting").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/car_issues.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#kubwaaa").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>  

    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#submitasset").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/page_asset_menagement.php",
                    xhr: function ()
                    {
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                //Do something with upload progress
                                console.log(percentComplete);
                            }
                        }, false);
                        //Download progress
                        xhr.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                //Do something with download progress
                                console.log(percentComplete);
                            }
                        }, false);
                        return xhr;
                    },
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#retedataa").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>  

    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#applyleave").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/add_leave_request.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#depends").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#uploadForm").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/uploadimages.php?employee_no=<?php echo $_SESSION["emp_file_no"]; ?>",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#targetLayer").html(data);
                    },
                    error: function () {
                    }
                });
            }));




        });


    </script>


    <script>
        function showact(str) {
            if (str.length == 0) {
                document.getElementById("solar_action").innerHTML = "";
                document.getElementById("solar_action").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("solar_action").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/usersystem/page_client_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
    <style>
        .bgColor {
            width: 580px;
            height:200px;
            background-color: #F9D735;
        }
        .bgColor label{
            font-weight: bold;
            color: #A0A0A0;
        }
        #targetLayer{
            float:left;
            width:200px;
            height:200px;
            text-align:center;
            line-height:100px;
            font-weight: bold;
            color: #C0C0C0;
            background-color: #F0E8E0;
            overflow:auto;
        }
        #uploadFormLayer{
            float:right;
            padding: 10px;
        }
        .btnSubmit {
            background-color: #3FA849;
            padding:4px;
            border: #3FA849 1px solid;
            color: #FFFFFF;
        }
        .inputFile {
            padding: 3px;
            background-color: #FFFFFF;
        }
    </style>
    <script type="text/javascript">//<![CDATA[ 
        window.onload = function () {

            $(function () {
                $('table').on('click', 'tr a.cross-delete', function (e) {
                    e.preventDefault();
                    $(this).parents('tr').remove();
                });



                $("#add-invoice-row").click(function () {
                    $("#invoice-table").each(function () {
                        var tds = '<tr>';
                        jQuery.each($('tr:last td', this), function () {
                            tds += '<td>' + $(this).html() + '</td>';
                        });
                        tds += '</tr>';
                        if ($('tbody', this).length > 0) {
                            $('tbody', this).append(tds);
                        } else {
                            $(this).append(tds);
                        }
                    });
                });
                $("#add-asset-row").click(function () {
                    $("#asset-table").each(function () {
                        var tds = '<tr>';
                        jQuery.each($('tr:last td', this), function () {
                            tds += '<td>' + $(this).html() + '</td>';
                        });
                        tds += '</tr>';
                        if ($('tbody', this).length > 0) {
                            $('tbody', this).append(tds);
                        } else {
                            $(this).append(tds);
                        }
                    });
                });

                $("#add-cash-row").click(function () {
                    $("#cash-table").each(function () {
                        var tds = '<tr>';
                        jQuery.each($('tr:last td', this), function () {
                            tds += '<td>' + $(this).html() + '</td>';
                        });
                        tds += '</tr>';
                        if ($('tbody', this).length > 0) {
                            $('tbody', this).append(tds);
                        } else {
                            $(this).append(tds);
                        }
                    });
                });




            });
        };




        //]]>  
    </script>


    <!--verifying-->
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#verifying").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/long_lat_calculation.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#site_locaton").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>

    <script>
        function getLocation1() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position)
        {
            document.getElementById("latitude1").value = position.coords.latitude;
            document.getElementById("longitude1").value = position.coords.longitude;
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
            document.getElementById("la").value = position.coords.latitude;
            document.getElementById("lo").value = position.coords.longitude;
        }

    </script>   

    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#signin").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/signin.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#site_locatonz").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script> 
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#signout").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/sign_out_attendence.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#site_locatonz").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#logout_id").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/long_lat_logout.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#site_locaton").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#verify_at_site").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/nipoo.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#nipoo").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>
    <script>
        $(document).on("click", ".view-info", function () {
            var a = $(this).data('a');
            var b = $(this).data('b');
            var c = $(this).data('c');
            var d = $(this).data('d');

            $(".modal-body #a").val(a);
            $(".modal-body #b").val(b);
            $(".modal-body #c").val(c);
            $(".modal-body #d").val(d);

        });
    </script>
</head>
<div class="row">
    <div class="col-lg-12 col-xs-12">

        <div class="bg-white shadow collapse navbar-collapse " id="myNavbar"  style=" margin: 5px 0px 5px 0px;" >

            <nav class="horizontal-menu compact">
                <ul>


                    <li>
                        <a class="" href="#"  data-toggle="modal" data-target="#myModalleave" >Leave Request</a>
                    </li>
                   <!--                <li>
                    <a class="" href="#"  data-toggle="modal" data-target="#manageleave" >Leave Management</a>
                </li>-->
<li>
    <a class="" href="leave_management.php"  target="_blank" >Leave Management</a>
                    </li>

                    <li>
                        <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#manage_asset">Asset Tracker</a>
                    </li>

                    <li>
                        <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#add_faults">Report Vehicle Faults</a>
                    </li>

                    <li>
                        <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalcar_issues">Request Material</a>
                    </li>
                    <li>
                        <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalcar_req">Manage Request</a>
                    </li>
<!--                    <li>
                        <a class="" href="#https://sincrositewatchtz.com/attendance/attendance_hq.php?id" data-toggle="modal" data-target="#myattendence" class="fg-hover-crimson fg-cobalt">
                            Attendance  Form</a>
                    </li>-->
                     <li>
                         <a class="" href="https://sincrositewatchtz.com/attendance/attendance_hq.php?id=<?php echo $_SESSION["emp_file_no"];?>" target="_blank" class="fg-hover-crimson fg-cobalt">
                            Attendance  Form</a>
                    </li>
                    <li>
                        <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalattendence">Attendance Report</a>
                    </li>
                    <li>
                        <a class="" href="page_manage_attenence.php" target="_blank" class="fg-hover-crimson fg-cobalt">Manage Attendance</a>
                    </li>


                </ul>
            </nav>
        </div>

    </div>
    <div class="col-xs-12">
<?php
echo $message;
if (isset($_GET['success']) == 1) {
    echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!</strong>
</div>';
}
?> 
    </div>

</div>
<!-----------------------------contenys-->
<div class="row">
    <!------------------menu ya mwanzo-------------------------------------------------------------------------------------->
    <div class="col-lg-3 col-xs-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="bg-white shadow" style="width: 100%;" >
                    <nav class="horizontal-menu compact">
                        <ul>
                            <li>
                                <a class="" href=""><i class="fa fa-link fg-blue"></i>&nbsp;Quick Links</a>
                            </li>                       
                        </ul>
                    </nav>
                </div>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                          <!--///////////////////Announcements///////////////-->
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
                            <a  href="https://sincrositewatchtz.com/portal/announcement/<?php echo $_SESSION["emp_file_no"];?>" target="_blank" style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;ANNOUNCEMENTS
                            </a>
                        </div> 
                        <!--///////////////////start quotation////datatables////////////////////-->
                        
                        <!--//////////////////////////////////-->
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
                            <a  href="https://sincrositewatchtz.com/portal/home/<?php echo $_SESSION["emp_file_no"];?>" target="_blank" style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;QMSOHS Management system
                            </a>
                        </div> 
                        <!--///////////////////start quotation////datatables////////////////////-->
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
                            <a  href="home_completion.php" target="_blank" style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Work Completion Report
                            </a>
                        </div> 
                        <!--//////////////////End quotation////////////////////////-->
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading" role="tab" id="heading-stock">
                            <a class="sub-menu collapsed" style=" text-decoration: none;" data-toggle="collapse" data-parent="#accordion" href="#collapse-cash" aria-expanded="false" aria-controls="collapse-stock">
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Payment Request
                            </a>
                        </div>
                        <div style="height: 0px;" aria-expanded="false" id="collapse-cash" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">

<?php
if ($cash_requesting == 'YES') {
    ?>
                                <div class="list-group">
                                    <a href="#" data-toggle="modal" data-target="#cash_request" class="list-group-item"><span class=""></span>&nbsp;Request Form</a>

                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="list-group">
                                    <a href="#" data-toggle="modal" data-target="" class="list-group-item"><span class=""></span>&nbsp; Request Form</a>

                                </div>
                                <?php
                            }
                            ?>

                            <div class="list-group">
                                <a href="#" data-toggle="modal" data-target="#my_request" class="list-group-item"><span class=""></span>&nbsp;My Request</a>

                            </div>
                            <?php
                            if ($_SESSION["emp_file_no"] == 'SSW 147' OR $_SESSION["emp_file_no"] == 'SSW 122' OR $_SESSION["emp_file_no"] == 'SSW 211' OR $_SESSION["emp_file_no"] == 'SSW 049' OR $_SESSION["emp_file_no"] == 'SSW 202') {
                                ?>
                                <div class="list-group">
                                    <a  href="payment_home.php" target="_blank" class="list-group-item"><span class=""></span>&nbsp;Manage Request</a>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
<?php
if ($_SESSION['store_access'] == 'YES') {
    ?>

                            <div class="panel-heading">
                                <a  href="home_goods_received_note.php" target="_blank"  style="  text-decoration: none;">
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp; Goods Received Note
                                </a> 
                            </div>
                            <div style="height:1px; background-color:rgb(220,220,220)"></div>
                            <div class="panel-heading">
                                <a  href="home_store.php?action=stoock" target="_blank" style=" text-decoration: none;">
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp; Store Management
                                </a>
                            </div>
                            <div style="height:1px; background-color:rgb(220,220,220)"></div>
                            <div class="panel-heading">

                                <a  href="LPO.php?action=store_lpo" target="_blank" style=" text-decoration: none;">
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp; LPO 
                                </a>
                            </div>
    <?php
} elseif ($_SESSION['operation_director_access'] == 'YES') {
    ?>
                            <div class="panel-heading">

                                <a  href="LPO.php?action=operation_process" target="_blank" style=" text-decoration: none;">
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp; LPO 
                                </a>
                            </div>
                            <?php
                        } elseif ($_SESSION['account_access'] == 'YES') {
                            ?>
                            <div class="panel-heading">

                                <a  href="LPO.php?action=account_lpo" target="_blank" style=" text-decoration: none;">
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp; LPO 
                                </a>
                            </div>
                            <div style="height:1px; background-color:rgb(220,220,220)"></div>
                            <div class="panel-heading">

                                <a  href="LPO.php?action=voucher" target="_blank" style=" text-decoration: none;">
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp; Payment Voucher
                                </a>
                            </div>
    <?php
} else {
    
}
?>
                        <!--
                                            <div style="height:1px; background-color:rgb(220,220,220)"></div>
                                            <div class="panel-heading">
                                                <a  href="#" style=" text-decoration: none;" data-toggle="modal" data-target="#manage_asset" >
                                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Manage Assets
                                                </a>
                                            </div> -->
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
                            <a  href="http://daimainfotech.com/project/" target="_blank" style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Project Management
                            </a>
                        </div> 


                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading" role="tab" id="heading-stock">
                            <a class="sub-menu collapsed" style=" text-decoration: none;" data-toggle="collapse" data-parent="#accordion" href="#collapse-notes" aria-expanded="false" aria-controls="collapse-stock">
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Appraisal
                            </a>
                        </div>
                        <div style="height: 0px;" aria-expanded="false" id="collapse-notes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                            <div class="list-group">
                                <a href="#" class="list-group-item"><span class=""></span>&nbsp; Manage Appraisal</a>

                            </div>
                            <div class="list-group">
                                <a href="#" class="list-group-item"><span class=""></span>&nbsp; My Appraisal</a>

                            </div>
                        </div>
<?php
if ($_SESSION['Solar'] == 'YES') {
    ?>
                            <div style="height:1px; background-color:rgb(220,220,220)"></div>
                            <div class="panel-heading">
                                <a  href="#" data-toggle="modal" data-target="#solar_database"  style=" text-decoration: none;"  >
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Solar Clients Database
                                </a>
                            </div> 
                            <?php
                        }
                        ?>
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
                            <a  href="Fleet_management.php?action=home"    target="_blank" style=" text-decoration: none;">
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp; Fleet Management
                            </a>
                        </div>
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading" role="tab" id="heading-stock">
                            <a class="sub-menu collapsed" style=" text-decoration: none;" data-toggle="collapse" data-parent="#accordion" href="#collapse-notes2" aria-expanded="false" aria-controls="collapse-stock">
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Fuel Request
                            </a>
                        </div>
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div style="height: 0px;" aria-expanded="false" id="collapse-notes2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                            <div class="list-group">
                                <a href="#" data-toggle="modal" data-target="#fuelrequest" class="list-group-item"><span class=""></span>&nbsp; Fuel Request Form</a>

                            </div>  
<?php
if ($_SESSION['manage_fuel'] == 'YES') {    
    ?>
                                <div class="list-group">
                                    <a href="Fleet_management.php?action=fuel_management" target="_blank" class="list-group-item"><span class=""></span>&nbsp; Manage Fuel</a>

                                </div>
                                <?php
                             } elseif ($_SESSION['manage_fuel_acc'] == 'YES') { 
                                ?>
                                <div class="list-group">
                                    <a href="#" data-toggle="modal" data-target="#fuelrequestmanageacc" class="list-group-item"><span class=""></span>&nbsp; Manage Fuel</a>

                                </div>
                                <?php
                            } 
                            else 
                                {     
                                         
                            }
                            ?>

<!--                            <div class="list-group">
                                <a href="#" data-toggle="modal" data-target="#fuelrequesthistory" class="list-group-item"><span class=""></span>&nbsp;Fuel History</a>

                            </div>-->
                        </div>   
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
                            <a  href="opm.php?action=home_opm" target="_blank" style=" text-decoration: none;">
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Operational Monitor
                            </a>
                        </div> 
<?php
if ($_SESSION['noc_operator'] == 'YES') {
    ?>
                            <div style="height:1px; background-color:rgb(220,220,220)"></div>
                            <div class="panel-heading" role="tab" id="heading-stock">
                                <a class="sub-menu collapsed" style=" text-decoration: none;" data-toggle="collapse" data-parent="#accordion" href="#collapse-rca" aria-expanded="false" aria-controls="collapse-stock">
                                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Manage RCA and PM
                                </a>
                            </div>
                            <div style="height: 0px;" aria-expanded="false" id="collapse-rca" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">

                                <div class="list-group">
                                    <a  href="rca_management.php" target="_blank" class="list-group-item" style=" text-decoration: none;">
                                        &nbsp; RCA Management
                                    </a>
                                </div>
                                <div class="list-group">
                                    <a href="pm_management.php" target="_blank" class="list-group-item"><span class=""></span>&nbsp;Manage PM & CM</a>

                                </div>


                            </div>         

    <?php
}
?>
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
<!--                            <a  href="#" data-toggle="modal" data-target="#site_attendence"style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Class A site Attendance
                            </a>-->
<a  href="https://sincrositewatchtz.com/attendance/location.php?id=<?php echo $_SESSION["emp_file_no"];?>" target="_blank" style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Class A site Attendance
                            </a>
                        
                       
                        </div> 
                        
                         <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
<!--                            <a  href="#" data-toggle="modal" data-target="#site_attendence"style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Class A site Attendance
                            </a>-->
<a  href="http://daimainfotech.com/sas/meetings.php" target="_blank" style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Meeting Attendance
                            </a>
                        
                       
                        </div> 
                        
                        
<!--                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
                            <a  href="#" data-toggle="modal" data-target="#site_attendence2"style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Class A site Attendancev2
                            </a>
                        </div> -->
                        <?php
if ($_SESSION['account_access'] == 'YES' OR $_SESSION["emp_file_no"]=='SSW 122' OR $_SESSION["emp_file_no"]=='SSW 211') {
    ?>
                        <!--///////////////////start quotation////////////////////////-->
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
                            <a  href="home_quotation.php" target="_blank" style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Quotation
                            </a>
                        </div> 

                         <!--///////////////////start quotation////////////////////////-->
                        <div style="height:1px; background-color:rgb(220,220,220)"></div>
                        <div class="panel-heading">
                            <a  href="account_dashboard.php" target="_blank" style=" text-decoration: none;"  >
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Account Dashboard
                            </a>
                        </div> 
<?php }?>


                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xs-12 col-md-12">
                <div class="bg-white shadow" style="width: 100%;" >
                    <nav class="horizontal-menu compact">
                        <ul>
                            <li>
                                <a class="" href=""><i class="fa fa-book fg-blue"></i>&nbsp;Employment</a>
                            </li>                       
                        </ul>
                    </nav>
                </div>
                <div class="bg-white shadow" style="width: 100%;" >
                    <table class="table">

                        <tbody>
                            <tr>
                                <td class="">Employee Number:</td>
                                <td class=""><?php echo $_SESSION["emp_file_no"]; ?></td>
                            </tr>  
                            <tr>
                                <td class="">Designation:</td>
                                <td class=""><?php echo $designation; ?></td>
                            </tr>                   
                            <tr>
                                <td class="">Hire Date:</td>
                                <td class=""><?php echo $start_date; ?></td>
                            </tr>
                            <tr>
                                <td class="">End Date:</td>
                                <td class=""><?php echo $end_date; ?></td>
                            </tr>                   
                            <tr>
                                <td class="">Department:</td>
                                <td class=""><?php echo $department_name; ?></td>
                            </tr>
                            <tr>
                                <td class="">Position</td>
                                <td class=""><?php echo $position_name; ?></td>
                            </tr>
                            <tr>
                                <td class="">Location</td>
                                <td class=""><?php echo ''; ?></td>
                            </tr>
                            <tr>
                                <td class="">Basic Salary</td>
                                <td class="">Private</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!------------------mwanzo wa kontent za kati--------------------------------------------------------------------------------------->
    <div class="col-lg-9 col-xs-12 col-md-12 col-sm-12">
        <!---------------------------------content za kati zinaanzia hapax-------------------------------------------------------------->
        <!--end quick link-->
        <div class="row" style=" margin-bottom: 12px; border-bottom: 1px #A0A0A0 solid; padding-bottom: 12px;">
            <div class="col-lg-7 col-xs-12 col-md-12">
                <div class="" style="width: 100%;" >
                    <nav class="horizontal-menu compact">
                        <ul>
                            <li>
                                <a class=" " href=""><i class="icon-user-2 fg-blue"></i>&nbsp;Personal Information</a>
                            </li>                       
                        </ul>
                    </nav>
                </div>
                <div class="" style="width: 100%;" >

                    <table class="" style="width: 100%;">            
                        <tbody>
                            <tr >
                                <td ><span class="text-bold">Employee Number:</span></td>
                                <td><span class="text-left"><?php echo $_SESSION["emp_file_no"]; ?></span></td>
                            </tr> 
                            <tr>
                                <td ><span class="text-bold">First Name:</span></td>
                                <td ><?php echo $first_name; ?></td>
                            </tr>  
                            <tr>
                                <td ><span class="text-bold">Middle Name:</span></td>
                                <td ><?php echo $middle_name; ?></td>
                            </tr>
                            <tr>
                                <td ><span class="text-bold">Last Name:</span></td>
                                <td><?php echo $surname; ?></td>
                            </tr>
                            <tr>
                                <td><span class="text-bold">Date of birth:</span></td>
                                <td><?php echo $date_of_birth; ?></td>
                            </tr>
                            <tr>
                                <td><span class="text-bold">Sex/Gender:</span></td>
                                <td><?php echo $gender; ?></td>
                            </tr>
                            <tr>
                                <td><span class="text-bold">Marital status:</span></td>
                                <td><?php echo $marital_status; ?></td>
                            </tr>
                            <tr>
                                <td><span class="text-bold">Religion:</span></td>
                                <td><?php echo $religion; ?></td>
                            </tr>
                            <tr>
                                <td><span class="text-bold">Country:</span></td>
                                <td><?php echo $country; ?></td>
                            </tr>
                            <tr>
                                <td><span class="text-bold">City:</span></td>
                                <td><?php echo $city; ?></td>
                            </tr>
                            <tr>
                                <td><span class="text-bold">District:</span></td>
                                <td><?php echo $district; ?></td>
                            </tr>
                    </table>
                    </tbody>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12 col-md-12">

                <div class="" style="width: 100%;" >
                    <nav class="horizontal-menu compact">
                        <ul>
                            <li>
                                <a class="" href=""><i class="fa fa-inbox fg-blue"></i>&nbsp;Profile Picture</a>
                            </li>                       
                        </ul>
                    </nav>
                </div>
                <div style="width:100%; padding: 5px 0px 5px 0px;">
                    <img src="<?php echo $profile_pic; ?>" class="img-responsive img-circle  center-block shadow" style="display: block;
                         margin: auto;
                         border-radius: 100%;
                         border: 5px solid #A0A0A0;
                         height: 220px;">
                </div>


            </div>

        </div>
        <div class="row" style=" margin-bottom: 3px;">

            <div class="col-lg-7 col-xs-12 col-md-12">
                <div class="bg-white shadow" style="width: 100%;" >
                    <nav class="horizontal-menu compact">
                        <ul>
                            <li>
                                <a class=" " href=""><i class="icon-location fg-blue"></i>&nbsp;Contacts</a>
                            </li>                       
                        </ul>
                    </nav>
                </div>
                <div class="" style="width: 100%;" >
                    <nav class="sidebar">
                        <ul>
                            <li class=""><a href="#"><i class="icon-mobile"></i><?php echo $phone; ?></a></li>
                            <li class=""><a href="#"><i class="icon-mobile"></i><?php echo $phone2; ?></a></li>
                            <li class=""><a href="#"><i class="icon-mail-2"></i><?php echo $email; ?></a></li>
                            <li class=""><a href="#"><i class="icon-mail"></i><?php echo $email2; ?></a></li>
                            <li class=""><a href="#"><i class="icon-comments-2"></i><?php echo $fax; ?></a></li>
                            <li class=""><a href="#"><i class="icon-box"></i><?php echo $postal_addr; ?></a></li>


                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-5 col-xs-12 col-md-12">     
                <div class="bg-white shadow" style="width: 100%;" >
                    <nav class="horizontal-menu compact">
                        <ul>
                            <li>
                                <a class="" href=""><i class="icon-calendar fg-blue"></i>&nbsp;Defaults Time Slots</a>
                            </li>                       
                        </ul>
                    </nav>
                </div>
                <div class="bg-white shadow" style="width: 100%;" >
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Week Day</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="successE">
                                <td>Monday</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr class="dangerE">
                                <td>Tuesday</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr class="info">
                                <td>Wednesday</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr class="info">
                                <td>Thursday</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr class="warning">
                                <td>Friday</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr class=" active">
                                <td>Saturday</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12">
                <!--            <hr><br>-->
            </div>

            
        </div>
        <!---------------------------------content za kati zinaishia hapa--------------------------------------------------------------->
    </div>
    <!------------------------------------------mwisho wa kontent za kati------------------------------------------------------>
</div>



<!------------------------ends contents-->


<!-- Modal -->
<div id="myModalleave" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Apply Leave Request</div> 

            <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">                       
                        <form id="applyleave" action="authorized/usersystem/add_leave_request.php"  method="post">
                            <table>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="company_asset">From:</label>
                                            <div class="input-control text" data-role="datepicker" data-week-start="1">
                                                <input readonly="readonly" name="sdate" id="sdate"  type="text" class="form-control">
                                                <button type="button" class="btn-date"></button>
                                                <div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: none;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">February 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day today"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>                            
                                    <td>
                                        <div class="form-group">
                                            <label for="company_asset">To:</label>
                                            <div class="input-control text" data-role="datepicker" data-week-start="1">
                                                <input  name="enddate" value="" id="enddate"   type="text" class="form-control">
                                                <button type="button"  class="btn-date"></button>
                                                <div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: none;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">February 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day today"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>
                                                </div>
                                            </div>
                                        </div>
                                    </td> 

                                </tr>                          
                            </table>
                            <div id="depends">
                                <!--                               shows -->
                            </div>
                            <div class="form-group">                                                             
                                <input  type="hidden"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $_SESSION["emp_file_no"]; ?>" id="employee_no" name="employee_no">
                            </div> 
                            <div class="form-group">
                                <label for="sel1">Leave Type:</label>
                                <select class="form-control" name="leave_type" id="leave_type">
                                    <option>---select</option>
<?php
$a = mysql_query("SELECT * FROM tbl_leave_type") or die(mysql_error());
while ($b = mysql_fetch_array($a)) {
    $leave_type = $b['leave_type'];
    $leave_type_id = $b['leave_type_id'];
    ?>
                                        <option  value="<?php echo $leave_type_id; ?>"><?php echo $leave_type; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" id="fs">
                                <label for="fs">Select Your Immediate Supervisor:</label>
                                <select class="form-control" name="fs" id="fs">
                                    <option>---select</option>
                                    <?php
                                    $a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
                                    while ($b = mysql_fetch_array($a)) {
                                        $first_name = $b['first_name'];
                                        $surname = $b['surname'];
                                        $emp_file_noo = $b['emp_file_no'];
                                        ?>
                                        <option  value="<?php echo $emp_file_noo; ?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>

                                    <?php 
                                    
                                    }
                                    ?>
                                </select>
                            </div> 
                            <div class="form-group" >
                                <label for="hod">Select The Head Of your Department:</label>
                                <select class="form-control" name="hod" id="hod">
                                    <option>---select</option>
                                    <?php
                                    $a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
                                    while ($b = mysql_fetch_array($a)) {
                                        $first_name = $b['first_name'];
                                        $surname = $b['surname'];
                                        $emp_file_noo = $b['emp_file_no'];
                                        ?>
                                        <option  value="<?php echo $emp_file_noo; ?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>

                                    <?php } ?>
                                </select>
                            </div> 


                            <input type="submit" value="Submit Request" class="btn btn-default">

                        </form>


                        <div id="show_message">
                            <div id="action_delete">

                            </div>
                            <div class="" style="width:100%;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Start Date</th>
                                            <th class="text-left">End Date</th>
                                            <th class="text-left">Leave Type</th> 
                                            <th class="text-left">Supervisor Status</th> 
                                            <th class="text-left">HOD Status</th>                                             
                                            <th class="text-left">HR Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
<?php
$select_asset = mysql_query("SELECT * FROM tbl_leaves WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'") or die(mysql_error());
while ($roww = mysql_fetch_array($select_asset)) {
    $start_date = $roww['start_date'];
    $end_date = $roww['end_date'];
    $hod_status = $roww['hod_status'];
    $fs_status = $roww['fs_status'];
    $hrm_status = $roww['hrm_status'];
    $leave_id = $roww['leave_type'];
    $b = mysql_query("SELECT * FROM tbl_leave_type WHERE leave_type_id='$leave_id'") or die(mysql_error());
    $a = mysql_fetch_array($b);
    $leave_type = $a['leave_type'];
    ?>
                                            <tr>
                                                <td class="right"><?php echo $start_date; ?></td>
                                                <td class="right"><?php echo $end_date; ?></td>
                                                <td class="right"><?php echo $leave_type; ?></td>
                                                <td class="right"><?php echo $fs_status; ?></td>
                                                <td class="right"><?php echo $hod_status; ?></td>                                               
                                                <td class="right"><?php echo $hrm_status; ?></td>                                               
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
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>

<!--popupwindows-->
<!-------------------------------------------------model linces------------------------------------------------------->
<!-- Modal -->
<div id="myModaluploadpic" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Change Images</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="" style=" height: 250px;">
                        <div class="bgColor">
                            <form id="uploadForm" action="authorized/usersystem/uploadimages.php" method="post">
                                <div id="targetLayer">No Image</div>
                                <div id="uploadFormLayer">
                                    <label>Upload Image File:</label><br/>
                                    <input name="userImage" type="file" class="inputFile" />
                                    <input type="submit" value="Submit" class="btnSubmit" />

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>       
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="manage_asset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Asset Tracker</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-2 col-sm-12 col-md-12">

                        <ul class="treeview" data-role="treeview">
                            <li class="node collapsed">

                                <a style="padding-left: 0px;" href="#"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;Category</a>
                                <ul style="display: none;">
<?php
$select_categories = mysql_query("SELECT * FROM tbl_asset_category") or die(mysql_error());
while ($showing = mysql_fetch_array($select_categories)) {
    $category_id = $showing['cat_id'];
    $categories_name = $showing['category_name'];
    ?>
                                        <li class="node collapsed">
                                            <a style="padding-left: 20px;" href="#"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;<?php echo $categories_name; ?></a>
                                            <ul>
                                        <?php
                                        $select_asset = mysql_query("SELECT * FROM tbl_asset_name where asset_category='$category_id'") or die(mysql_error());
                                        while ($rowing = mysql_fetch_array($select_asset)) {
                                            $ass_name = $rowing['asset_name'];
                                            $asset_ids = $rowing['asset_ids'];
                                            ?>
                                                    <li>
                                                        <a style="padding-left: 30px;" href="#" onclick="asset('sincro.php?action=asset&asset_ids=<?php echo $asset_ids; ?>')">
                                                            <i class="fa fa-plus"></i>&nbsp;<?php echo $ass_name; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
    <?php
}
?>

                                </ul>
                            </li>
                        </ul>

                        <!----------------------Locations------------------>
                        <ul class="treeview" data-role="treeview">
                            <li class="node collapsed">

                                <a style="padding-left: 0px;" href="#"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;Locations</a>
                                <ul style="display: none;">
<?php
$tbl_assets_locations = mysql_query("SELECT * FROM tbl_assets_locations") or die(mysql_error());
while ($lg = mysql_fetch_array($tbl_assets_locations)) {
    $location_id = $lg['location_id'];
    $location_name = $lg['location_name'];
    ?>
                                        <li class="">
                                            <a style="padding-left: 20px;" href="#" onclick="asset('sincro.php?action=asset&asset_ids=<?php echo $location_id; ?>')"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;<?php echo $location_name; ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                        </ul>
                        <!----------------------End locations-------------->
                        <!----------------------Department------------------>
                        <ul class="treeview" data-role="treeview">
                            <li class="node collapsed">

                                <a style="padding-left: 0px;" href="#"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;Departments</a>
                                <ul style="display: none;">
<?php
$tbl_departments = mysql_query("SELECT * FROM tbl_department") or die(mysql_error());
while ($sg = mysql_fetch_array($tbl_departments)) {
    $department_id = $sg['department_id'];
    $department_namee = $sg['department_name'];
    ?>
                                        <li class="">
                                            <a style="padding-left: 20px;" href="#" onclick="asset('sincro.php?action=asset&asset_ids=<?php echo $department_id; ?>')"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;<?php echo $department_namee; ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                        </ul>
                        <!----------------------End Department-------------->
                        <!----------------------Vendor------------------>
                        <ul class="treeview" data-role="treeview">
                            <li class="node collapsed">

                                <a style="padding-left: 0px;" href="#"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;Vendors</a>
                                <ul style="display: none;">
<?php
$tbl_asset_category = mysql_query("SELECT * FROM tbl_asset_category") or die(mysql_error());
while ($rd = mysql_fetch_array($tbl_asset_category)) {
    $category_id = $rd['cat_id'];
    $categories_name = $rd['category_name'];
    ?>
                                        <li class="node collapsed">
                                            <a style="padding-left: 20px;" href="#"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;<?php echo $categories_name; ?></a>
                                            <ul>
                                        <?php
                                        $tbl_vendors = mysql_query("SELECT * FROM tbl_vendors where cat_id='$category_id'") or die(mysql_error());
                                        while ($rs = mysql_fetch_array($tbl_vendors)) {
                                            $vendor_name = $rs['vendor_name'];
                                            $vendor_id = $rs['vendor_id'];
                                            ?>
                                                    <li>
                                                        <a style="padding-left: 30px;" href="#" onclick="asset('sincro.php?action=asset&asset_ids=<?php echo $vendor_id; ?>')">
                                                            <i class="fa fa-plus"></i>&nbsp;<?php echo $vendor_name; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
    <?php
}
?>

                                </ul>
                            </li>
                        </ul>
                        <!----------------------End Vendor-------------->

                    </div>
                    <div class="col-lg-10 col-sm-12 col-md-12" id="divchanges">
                        <!--change these contents-->
                        <div class="row" >
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                                    <li class="<?php echo $disable2; ?>"><a data-toggle="tab" href="#menu1"><i class="fa fa-plus"></i>&nbsp;Asset</a></li>
                                    <li class="<?php echo $disable2; ?>"><a data-toggle="tab" href="#menu2"><i class="fa fa-plus"></i>&nbsp;Category</a></li>
                                    <li class="<?php echo $disable2; ?>"><a data-toggle="tab" href="#menu2"><i class="fa fa-plus"></i>&nbsp;Location</a></li>
                                    <li class="<?php echo $disable2; ?>"><a data-toggle="tab" href="#menu2"><i class="fa fa-plus"></i>&nbsp;Department</a></li>
                                    <li class="<?php echo $disable2; ?>"><a data-toggle="tab" href="#menu2"><i class="fa fa-plus"></i>&nbsp;Vendors</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="alert alert-info">
                                                    <strong>Welcome!</strong> Easily track all assets in your facilities with Asset Track. Record supplier and user information. Know where the asset is located. Scan manufacturer barcodes or produce barcode labels directly from Asset Track. Track condition and location of your fixed assets Track depreciating values of fixed and IT assets Link assets to borrower and track movement Manage asset maintenance records View activity logs and reports
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <br>
                                        <div class="row">
                                            <form action="authorized/usersystem/page_asset_menagement.php" method="post" id="submitasset">
                                                <div class="col-lg-12">
                                                    <button type="submit" name="submitasset" class="btn btn-success" style="color:white"><i class="fa fa-arrow-down"></i>&nbsp;Submit data</button>
                                                    <button class="btn btn-default" ><i class="fa fa-remove"></i> Cancel</button>
                                                    <br />
                                                    <br />
                                                </div>
                                                <div class="col-lg-6">    
                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Asset Name:</span></span>
                                                        <select class="form-control"  id="kind_id" name="assetname">
                                                            <option value="" >----Asset Name:---</option>
<?php
$choseasset = mysql_query("SELECT * from tbl_asset_name") or die(mysql_error());
while ($johh = mysql_fetch_array($choseasset)) {
    $asset_name = $johh['asset_name'];
    $asset_category = $johh['asset_category'];
    ?>
                                                                <option value="<?php echo $asset_category . '@' . $asset_name; ?>"><?php echo $asset_name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Description:</span></span>
                                                        <input name="descriptional"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                                    </div>
                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Model:</span></span>
                                                        <input name="modeli" id="product_name"   class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                                    </div>


                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vendor:</span></span>
                                                        <select class="form-control"  id="kind_id" name="vendor">
                                                            <option value="" >----Vendor:---</option>
<?php
$vendorss = mysql_query("SELECT * from tbl_vendors") or die(mysql_error());
while ($johhs = mysql_fetch_array($vendorss)) {
    $vendor_name = $johhs['vendor_name'];
    $vendor_id = $johhs['vendor_id'];
    ?>
                                                                <option value="<?php echo $vendor_id; ?>"><?php echo $vendor_name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Barcode:</span></span>
                                                        <input name="barcode" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                                    </div>
                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Serial No:</span></span>
                                                        <input name="serialno" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                                    </div>



                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Status:</span></span>
                                                        <select class="form-control"  id="kind_id" name="status">
                                                            <option value="Null" >----Status---</option>                                       
                                                            <option value="Active">Active</option>
                                                            <option value="Disposed">Disposed</option>
                                                            <option value="In Stock">In Stock</option>
                                                            <option value="Active">Missing</option>
                                                            <option value="Reserved">Reserved</option>
                                                            <option value="RMA">RMA</option>
                                                            <option value="Stolen">Stolen</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Purchase Price:</span></span>
                                                        <input name="purchase_price" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                                    </div>

                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Mode of payment:</span></span>
                                                        <select class="form-control"  id="kind_id" name="mode_of_payment">
                                                            <option value="Null" >----Select---</option>                                       
                                                            <option value="Cash">Cash</option>
                                                            <option value="Credit">Credit</option>

                                                        </select>
                                                    </div>
                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Purchase:</span></span>
                                                        <input name="purchase" id="product_name"   class="form-control editable" placeholder="dd/mm/yy"  aria-describedby="sizing-addon1" type="text">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Warranty:</span></span>
                                                        <input name="warranty" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="" aria-describedby="sizing-addon1" type="text">

                                                    </div>


                                                    <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Notes:</span></span>
                                                        <textarea name="notes" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text"></textarea>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <h3>Menu 2</h3>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="alert alert-info">
                                                    <strong>Welcome!</strong> Easily track all assets in your facilities with Asset Track. Record supplier and user information. Know where the asset is located. Scan manufacturer barcodes or produce barcode labels directly from Asset Track. Track condition and location of your fixed assets Track depreciating values of fixed and IT assets Link assets to borrower and track movement Manage asset maintenance records View activity logs and reports
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--mmmmm-->

                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-sm-12 menusss" id="pagination">
                                    <!--                        <ul class="pagination" >
                                                                <li>
                                                                    <a class="btn btn-default" href="#" role="button"><i class="fa fa-file-excel-o"></i>&nbsp;Download Excel</a>        
                                                                </li>
                                                               
                                                                <li>
                                                                    <a href="#" class="btn btn-default" disabled="disabled" ><i class="fa fa-check"></i>&nbsp;Edit</a>
                                                                </li>
                                                                <li >
                                                                    <a href="#" class="btn btn-default" disabled="disabled"><i class="fa fa-remove"></i>&nbsp;Delete</a>
                                                                </li>
                                                                
                                                              
                                                            </ul>-->


                                </div>

                            </div>
                            <div class="col-lg-12">
                                <table id="table3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-left"></th>
                                            <th class="text-left">ID</th>
                                            <th class="text-left">Asset Name</th>
                                            <th class="text-left">Description</th>                                           
                                            <th class="text-left">Model</th>
                                            <th class="text-left">Serial</th>
                                            <th class="text-left">Purchase Price</th>
                                            <th class="text-left">Purchase</th>
                                            <th class="text-left">Status</th>


                                        </tr>
                                    </thead>

                                    <tbody id="retedataa">
<?php
$j = 1;
$selectasset = mysql_query("SELECT * FROM tbl_fixed_asset ORDER BY asset_id DESC") or die(mysql_error());
while ($assetsincro = mysql_fetch_array($selectasset)) {
    $assetid = $assetsincro['asset_id'];
    $assign = $_SESSION["emp_file_no"];
    $idd = $assetid . '@' . $assign;
    ?>
                                            <tr>
                                                <td class=" text-center">

                                                    <input type="checkbox" onchange="showactions(this.value)" value="<?php echo $idd; ?>">

                                                </td>
                                                <td class="right"><?php echo $j++; ?></td>
                                                <td class="right"><a href="#"><?php echo $assetsincro['asset_name']; ?></a></td>                                       
                                                <td class="right"><?php echo $assetsincro['description']; ?></td>
                                                <td class="right"><?php echo $assetsincro['model']; ?></td>
                                                <td class="right"><?php echo $assetsincro['serial_number']; ?></td>
                                                <td class="right"><?php echo $assetsincro['purchase_price']; ?></td>
                                                <td class="right"><?php echo $assetsincro['purchase']; ?></td>
                                                <td class="right"><?php echo $assetsincro['status']; ?></td>

                                            </tr> 
    <?php
}
?>
                                    </tbody>

                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                        <!--End of change contents-->
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--////////////////view assets/////////////-->
<!-- Modal -->
<div id="viewasset" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Asset Tracker</h4>
            </div>
            <div class="modal-body ">
                <div class="row" id="call_asset_view">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--/////////////////Attendance////////////////////////////-->
<!-- Modal -->
<div id="myModalattendence" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">My Attendance</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover table-bordered" cellspacing="0" width="100%" id="attendence">
                            <thead class="">
                                <tr>

                                    <th class="text-left">Employee No.</th>  
                                    <th class="text-left">Employee Name</th>
                                    <th class="text-left">Time In</th>  
                                    <th class="text-left">Time Out</th>
                                    <th class="text-left">Total Hours</th>
                                    <th class="text-left">Required Hours</th>
                                    <th class="text-left">Date</th>
                                    <th class="text-left">Late Comer?</th> 
                                </tr>
                            </thead>

                            <tbody>
<?php
$select_asset = mysql_query("SELECT * FROM tbl_attendence WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "' ORDER BY reportdate DESC") or die(mysql_error());
while ($roww = mysql_fetch_array($select_asset)) {
    $emp_file_no = $roww['emp_file_no'];
    $time_in = $roww['time_in'];
    $time_out = $roww['time_out'];
    $date1 = $roww['date1'];
    $time_spend = $roww['time_spend'];
    $notification = $roww['notification'];
    $remark = $roww['remark'];
    $time_set = "08:00";
    $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "' ")or die(mysql_error());
    $majina = mysql_fetch_array($jina);
    $firstname = $majina['first_name'];
    $sirname = $majina['surname'];
    $fullname = $firstname . " " . $sirname;
    ?>
                                    <tr class="<?php echo $notification; ?>">
                                        <td class="right"><?php echo $_SESSION["emp_file_no"]; ?></td>
                                        <td class="right"><?php echo $fullname; ?></td>
                                        <td class="right"><?php echo $time_in; ?></td>
                                        <td class="right"><?php echo $time_out; ?></td>
                                        <td class="right"><?php echo $time_spend; ?></td>
                                        <td class="right"><?php echo $time_set; ?></td>
                                        <td class="right"><?php echo $date1; ?></td>
                                        <td class="right"><?php echo $remark; ?></td>

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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--//////////////////////End Attendence//////////////////////////////-->

<!--/////////////////Attendance////////////////////////////-->

<!-- Modal -->
<div id="manageleave" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Leave Management</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="margin10">
                            <div id="show_message">
                                <div id="action_delete">

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-hover table-bordered" id="leave">
                            <thead>
                                <tr>
                                    <th class="text-left">Approve/Reject</th>
                                    <th class="text-left">Employee Name</th>
                                    <th class="text-left">Leave Type</th> 
                                    <th class="text-left">Start Date</th>
                                    <th class="text-left">End Date</th> 
                                    <th class="text-left">Days</th>
                                    <th class="text-left">Supervisor Status</th> 
                                    <th class="text-left">HOD Status</th>                                             

                                </tr>
                            </thead>

                            <tbody>
<?php
$select_asset = mysql_query("SELECT * FROM tbl_leaves WHERE hod_email='$email' OR fs_email='$email' ORDER BY leave_id DESC") or die(mysql_error());
while ($roww = mysql_fetch_array($select_asset)) {
    $leave_id = $roww['leave_id'];
    $leave_type = $roww['leave_type'];
    $start_date = $roww['start_date'];
    $end_date = $roww['end_date'];
    $hod_comment = $roww['hod_comment'];
    $supervisor_comm = $roww['supervisor_comm'];
    $no_of_days = $roww['no_of_days'];
    $hod_status = $roww['hod_status'];
    $hrm_status = $roww['hrm_status'];
    $emp_file_noo = $roww['emp_file_no'];
    $a = mysql_query("SELECT * FROM tbl_leave_type WHERE leave_type_id='$leave_type'") or die(mysql_error());
    $b = mysql_fetch_array($a);
    $leave_typee = $b['leave_type'];
    $fs_status = $roww['fs_status'];
    $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_noo' ")or die(mysql_error());
    $majina = mysql_fetch_array($jina);
    $firstname = $majina['first_name'];
    $sirname = $majina['surname'];
    $fullname = $firstname . " " . $sirname;
    ?>
                                    <tr>
                                        <td>
                                            <ul class="showlist">

                                                <li> <a href="#" onclick="approved('authorized/usersystem/leave_approved.php?leave_id=<?php echo $leave_id; ?>&requiredemail=<?php echo $email; ?>')"  data-toggle="modal" data-target="#approve"><i class="fa fa-check"></i>&nbsp;Approve</a></li>
                                                <li> <a href="#" onclick="rejection('authorized/usersystem/leave_management.php?leave_id=<?php echo $leave_id; ?>&requiredemail=<?php echo $email; ?>')"  data-toggle="modal" data-target="#reject"><i class="fa fa-arrow-down fg-green"></i>&nbsp;Reject</a></li>

                                            </ul>        
                                        </td>
                                        <td class="right"><?php echo $fullname; ?></td>
                                        <td class="right"><?php echo $leave_typee; ?></td>
                                        <td class="right"><?php echo $start_date; ?></td>
                                        <td class="right"><?php echo $end_date; ?></td>  
                                        <td class="right"><?php echo $no_of_days; ?></td> 
                                        <td class="right"> 
    <?php
    if (empty($supervisor_comm)) {
        ?>
                                                <a href="#"><?php echo $fs_status; ?></a>
        <?php
    } else {
        echo $supervisor_comm;
    }
    ?>

                                        </td>
                                        <td class="">
                                            <?php
                                            if (empty($hod_comment)) {
                                                ?>
                                                <a href="#"><?php echo $hod_status; ?></a>
                                                <?php
                                            } else {
                                                echo $hod_comment;
                                            }
                                            ?>

                                        </td>                                               

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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--//////////////////////End Attendence//////////////////////////////-->
<!-- Modal -->
<div id="approve" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Ã—</span></button>
                <h4 class="modal-title" id="myModalLabel">Approve Leave Request</h4>
            </div>
            <div class="modal-body">
                <div id="call_approving">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel</button>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Reject -->
<div id="reject" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Ã—</span></button>
                <h4 class="modal-title" id="myModalLabel">Reject Leave Request</h4>
            </div>
            <div class="modal-body">
                <div id="call_rejection">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel</button>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="myModalcar_issues" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <p class="modal-title">                   
                    <button type="button" class="btn btn-primary btn-sm">REQUEST FORM</button>
                    <button data-toggle="modal" data-target="#my_request_history" type="button" class="btn btn-secondary btn-sm">MY REQUEST HISTORY</button>
                    <button type="button" class="btn btn-secondary btn-sm">REQUEST REPORT</button>
                </p>
            </div>
            <div class="modal-body">
                <div id="kubwaaa">

                </div>

                <form   action=""  method="post">
                    <input type="text" name="requester" value="<?php echo $employee_no; ?>" hidden="">
                    <div class="row" >
                        <div class="col-lg-12">
                            <table class="table table-striped table-hover bordered">
                                <tbody>

                                    <tr>
                                        <td style="width:50%">
                                            <div class="form-group">
                                                <label for="sel1">Request Title:</label>
                                                <input name="req_title" placeholder="This field is Mandatory"  class="form-control amount editable" required=""  aria-describedby="sizing-addon1" type="text">
                                            </div>
                                        </td>

                                        <td style="width:50%">   

                                            <div class="form-group">
                                                <label for="sel1">Head of Department:</label>
                                                <select class="form-control" id="sel1" name="hod_sel" required="">
                                                <option value="pastory.hamaro@sincrositewatch.com">Pastory Hamaro</option>    
                                                <!--<option value="nzaro.kimbute@sincrositewatch.com">Nzaro Kimbute</option>-->
<?php
//$selc_hod = mysql_query("SELECT * FROM tbl_assign_to_department WHERE position_id=1") or die(mysql_error());
//while ($wote = mysql_fetch_array($selc_hod)) {
//    $emply_ids = $wote['emp_file_no'];
//
//    $show_contacts = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emply_ids'") or die(mysql_error());
//    $show_email = mysql_fetch_array($show_contacts);
//    $hod_email = $show_email['email'];
//
//    $accinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emply_ids'")or die(mysql_error());
//    $acc = mysql_fetch_array($accinfo);
//    $facc = $acc['first_name'];
//    $lacc = $acc['surname'];
//    ?>
                                                        <!--<option value="<?php // echo $hod_email; ?>"><?php // echo $facc . ' ' . $lacc; ?></option>-->
                                                    <?php // } ?>
                                                </select>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>


                                        <td style="width:50%"> 

                                            <div class="form-group">

                                                <select class="form-control" onchange="showtt(this.value)"  name="" required="">
                                                    <option value="">--select site---</option>
                                                    <option value="Class A">Class A</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            </td>  
                                        <td style="width:50%" id="tt">
                                            <div class="form-group">

                                                <input name="tt" placeholder="TT Number"  class="form-control amount editable"   aria-describedby="sizing-addon1" disabled="" type="text">
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width:50%">
                                            <div class="form-group">
                                                <select class="form-control"  onchange="showitem(this.value)"  name="" required="">
                                                    <option value="" >---Select you material</option>
<?php
$sparenam = mysql_query("SELECT DISTINCT part_common_name from  tbl_spare_parts ORDER BY part_common_name") or die(mysql_error());
while ($rowing = mysql_fetch_array($sparenam)) {
    $sparename = $rowing['part_common_name'];
    $emp_idd = $_SESSION["emp_file_no"];
    ?>
                                                        <option value="<?php echo $sparename . '@' . $emp_idd; ?>"    ><?php echo $sparename; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr> 


                                </tbody>
                            </table>

                            <div id="searchitem">
                                <!--lllllllllll-->
                            </div>

                        </div>



                        <div class="col-lg-12">

                            <table class="table table-striped table-hover bordered" id="invoice-table">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Item</th>
                                        <th>Specification</th>
                                        <th>Description</th>                                            
                                        <th>Quantity</th>                                                                                     
                                        <th>Units</th>
                                        <th>Department</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody  style="font-size:9px" id="onyeshaitem">

                                    <!--weka mambo sawa mkuuu-->

                                </tbody>
                            </table>




                            <button type="submit" name="request_spares" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-arrow-right"></i>Submit Your Request</button>

                        </div>
                    </div>
                </form>


            </div>

        </div>

    </div>
</div>







<div id="myModalcar_req" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Manage Material Request</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12"> 
                        <ul class="pagination">
                            <li>
                                <a href="material_dashboard.php" class="btn btn-default"><i class="fa fa-home"></i>&nbsp;GENERATE REPORT</a>
                            </li>
                        </ul>


                    </div>
                </div>
                <div class="row" id="onyeshavitu">
                    <div class="col-lg-12">
                        <table id="table4" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left">No.</th>
                                    <th class="text-left">Items</th>
                                    <th class="text-left">Request Date</th> 
                                    <th class="text-left">Ref #</th>
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
$accesstore = $_SESSION['store_access'];
$noc_operator=$_SESSION['noc_operator'];

$emp = mysql_query("SELECT * FROM tbl_contact where emp_file_no='$emp_idd'") OR die(mysql_error());
$ror = mysql_fetch_array($emp);
$emails = $ror['email'];
$ss = mysql_query("SELECT * FROM tbl_request_spare where store_email='$emails' OR hod_email='$emails' ") OR die(mysql_error());
$wss = mysql_fetch_array($ss);
$store = $wss['store_email'];
$hod_email = $wss['hod_email'];
if ($store == $emails || $accesstore == "YES") {
    $sst = mysql_query("SELECT * FROM tbl_request_spare WHERE hod_status='Approved' ORDER BY request_id DESC") OR die(mysql_error());
    while ($wst = mysql_fetch_array($sst)) {
        $request_ids = $wst['request_id'];
        $requester = $wst['requester'];
        $Request_title = $wst['Request_title'];
        $store_status = $wst['store_status'];
        $hod_status = $wst['hod_status'];


        $at = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_ids'") or die(mysql_error());
        $bt = mysql_fetch_array($at);
        $item = $bt['item'];
        $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
        $yunis = mysql_fetch_array($pinformation);
        $fm = $yunis['first_name'];
        $lm = $yunis['surname'];
        if (!empty($Request_title)) {
            $view = $Request_title;
        } else {
            $view = $bt['item'];
        }
        if ($store_status == "Pending") {
            $color = "";
        } elseif ($hod_status == "Pending") {
            $color = "bg-blue";
        } else {
            $color = "";
        }
        ?>
                                        <tr class="<?php echo $color; ?>">
                                            <td class="right"><?php echo $j++; ?></td>
                                            <td class="right"><a href="#"><?php echo $view; ?></a></td>                                       
                                            <td class="right"><?php echo $wst['request_date']; ?></td>
                                            <td class="right"><?php echo 'SSWMR' . sprintf("%04d", $request_ids); ?></td>
                                            <td class="right"><a href="#"><?php echo $fm . ' ' . $lm; ?></a></td>
                                            <td class="right"><?php echo $wst['hod_status']; ?></td>
                                            <td class="right"><?php echo $wst['store_status']; ?></td>                                                                      
                                            <td class="right">
                                                <ul class="showlist">

                                                    <li><a href="?action=process_request&view=<?php echo $request_ids; ?>">View</a></li>

                                                                                            <!--<li><a href="?action=delete_request_item&items_id=<?php echo $request_ids; ?>" data-confirm="Are you sure to delete this item?" id="delete">Delete</a></li>-->

                                                </ul>
                                            </td>


        <?php
    }
}

if ($hod_email == $emails || $noc_operator='YES') {

    $sst = mysql_query("SELECT * FROM tbl_request_spare ORDER BY request_id DESC") OR die(mysql_error());
    while ($wst = mysql_fetch_array($sst)) {
        $request_ids = $wst['request_id'];
        $requester = $wst['requester'];
        $Request_title = $wst['Request_title'];
        $store_status = $wst['store_status'];
        $hod_status = $wst['hod_status'];

        $at = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_ids'") or die(mysql_error());
        $bt = mysql_fetch_array($at);
        $item = $bt['item'];
        $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
        $yunis = mysql_fetch_array($pinformation);
        $fm = $yunis['first_name'];
        $lm = $yunis['surname'];
        if (!empty($Request_title)) {
            $view = $Request_title;
        } else {
            $view = $bt['item'];
        }
        if ($store_status == "Pending") {
            $color = "";
        } elseif ($hod_status == "Pending") {
            $color = "bg-blue";
        } else {
            $color = "";
        }
        ?>
                                        <tr class="<?php echo $color; ?>">
                                            <td class="right"><?php echo $j++; ?></td>
                                            <td class="right"><a href="#"><?php echo $view; ?></a></td>                                       
                                            <td class="right"><?php echo $wst['request_date']; ?></td>
                                            <td class="right"><?php echo 'SSWMR' . sprintf("%04d", $request_ids); ?></td>
                                            <td class="right"><a href="#"><?php echo $fm . ' ' . $lm; ?></a></td>
                                            <td class="right"><?php echo $wst['hod_status']; ?></td>
                                            <td class="right"><?php echo $wst['store_status']; ?></td>                                                                      
                                            <td class="right">
                                                <ul class="showlist">

                                                    <li><a href="?action=hprocess_request&view=<?php echo $request_ids; ?>">View</a></li>

                                                        <!--<li><a href="?action=delete_request_item&items_id=<?php echo $request_ids; ?>" data-confirm="Are you sure to delete this item?" id="delete">Delete</a></li>-->

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












<!-------------------------------------------------------------manage cash request------------------------------------------->

<div id="cash_request" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Payment Request</h5>
            </div>
            <div class="modal-body">
                <form  class="form-horizontal" action=""  method="post">
                    <input type="text" name="rquest" value="<?php echo $_SESSION["emp_file_no"]; ?>" hidden="">
                    <div class="row" >
                        <div class="col-lg-12">
                            <table class="table table-striped table-hover bordered">
                                <tbody>

                                    <tr>
                                        <td style="width:50%">
                                            <select class="form-control" required="" data-live-search="true" id="af" name="site_cla">
                                                <option value="">Select Site Name</option>
<?php
$selectsd = mysql_query("SELECT * FROM tbl_class_a_site") or die(mysql_error());
while ($cla = mysql_fetch_array($selectsd)) {
    $names = $cla['sitename'];
    $s_id = $cla['s_id'];
    ?>
                                                    <option value="<?php echo $s_id; ?>"><?php echo $names ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="width:50%"> 

                                            <input name="invnumber" required="" value="" placeholder="Invoice Number(*This field used only for Proformal invoice Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12">
                            <table class="table table-striped table-hover bordered">
                                <tbody>

                                    <tr>
                                        <td style="width:50%">

                                            <input name="cname" required="" placeholder="Company Name(*This field used only for Proformal invoice Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:50%">
                                            <select class="form-control" required="" onchange="showproject(this.value)" data-live-search="true" name="pname" required="">
                                                <option value="">Select Project</option>
                                                <!--                                                <option value="NULL">NOT PROJECT</option>-->

<?php
$selecd = mysql_query("SELECT * FROM tbl_preparedquotation ORDER BY Quotation_id DESC") or die(mysql_error());
while ($clad = mysql_fetch_array($selecd)) {
    $qcode = $clad['Quotation_number'];
    $Quotation_name = $clad['Quotation_name'];
    ?>
                                                    <option value="<?php echo $qcode; ?>"><?php echo $qcode.'-'.$Quotation_name ?></option>
    <?php
    }
    ?>
                                            </select>
                                            <!--<input name="pname" required="" placeholder="Project Number(*This field used only for Project Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">-->
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="width:50%">
                                            <select class="form-control" required="" data-live-search="true" id="af" name="v_number">
                                                <option value="">--Select Vehicle--</option>
                                                <option value="">--Empty--</option>
                                                <?php
                                                $selectsdv = mysql_query("SELECT * FROM tbl_car_monitoring") or die(mysql_error());
                                                while ($clav = mysql_fetch_array($selectsdv)) {
                                                    $vehicle_reg_num = $clav['vehicle_reg_num'];
                                                    $car_id = $clav['car_id'];
                                                    ?>
                                                    <option value="<?php echo $car_id; ?>"><?php echo $vehicle_reg_num ?></option>
                                        <?php                                          
                                        
                                                }
                                        ?>
                                            </select>
                                        </td>
                                        <td style="width:50%"> 

                                            <input name="reqtitle" required="" placeholder="Request Title"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="width:50%"> 

                                            <input name="vat" required="" placeholder="Vat"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:50%"> 

                                            <input name="ewura_levy" required="" placeholder="ewura_levy"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                    </tr> 
                                    
                                    
                                     
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12" id="">
                            <div id="projectitem">

                            </div>

                            <table class="table table-striped table-hover bordered" id="cash-table">
                                <thead><tr>

                                        <th>No</th>
                                        <th>DETAILS</th>                                      
                                        <th>UNIT PRICE</th>
                                        <th>QUANTITY</th>
                                        <th>UNITS</th>
<!--                                        <th>TOTAL (TSHS)</th>-->
                                        <th></th>
                                    </tr></thead>
                                <tbody  style="font-size:9px">

                                    <tr>

                                        <td style="width:5%">
                                            <input name="text" required="" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:39%">
                                            <input name="details[]" required="" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td> 

                                        <td style="width:15%">
                                            <input name="price[]" required="" id="pric" onkeyup="calc()" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>

                                        <td style="width:10%">
                                            <input name="quant[]" required="" id="quantit" onkeyup="calc()" value="1"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:10%">
                                            <input name="unit[]" required=""  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
<!--                                         <td style="width:16%">
                                            <input name="total[]" id="amounts" class="form-control  editable"  aria-describedby="sizing-addon1"   type="number">
                                        </td> -->
                                        <td style="width:5%">

                                        </td>
                                    </tr>
                                    <tr id="add">
                                        <td style="width:5%">
                                            <input name="text" required="" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:39%">
                                            <input name="details[]" required=""  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td> 
                                        <td style="width:15%">
                                            <input name="price[]" required="" id="pric" onkeyup="calc()" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>

                                        <td style="width:10%">
                                            <input name="quant[]" required="" id="quantit" onkeyup="calc()" value="1"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:10%">
                                            <input name="unit[]" required=""  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
<!--                                         <td style="width:16%">
                                            <input name="total[]" id="amounts" onkeyup="calc()" class="form-control  editable"  aria-describedby="sizing-addon1"   type="number">
                                        </td>                    -->
                                        <td style="width:5%">

                                            <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
                                        </td>

                                    </tr>


                                </tbody>
                            </table>



                            <button type="button" id="add-cash-row"  class="btn btn-success"   >
                                <span  aria-hidden="true"></span> + add new row&nbsp;
                            </button>
                            <button type="submit" name="cash_request" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-arrow-right"></i>Submit Your Request</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------myModalpayroll------------------------------------------->


<div id="manage_cash_request" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Manage Payment Request</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <ul class="pagination">
                                <li>
<?php
//                             $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//                             $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

                                    <a href="home_accounts.php" target="_blank" class="btn btn-default"><i class="fa fa-home"></i>&nbsp;GENERATE REPORT</a>
                                </li>
                            </ul>


                        </div>
                    </div>
                    <div class="margin10">
                        <div class="example">
                            <table   id="table6" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Request ID</th> 
                                        <th class="text-left">Request for(Details)</th>
                                        <th class="text-left">Requested by</th> 
                                        <th class="text-left">Amounts(Tshs)</th>
                                        <th class="text-left">Request Date</th>
                                        <th class="text-left">Manager Status</th>
                                        <th class="text-left">Account Status</th>
                                    </tr>
                                </thead>

                                <tbody>
<?php
$cashlist = mysql_query("SELECT * FROM cash_request ORDER BY cash_id DESC") or die(mysql_error());
$m = 1;
while ($roww = mysql_fetch_array($cashlist)) {
    $request_date = $roww['request_date'];
    $request_by = $roww['request_by'];
    $approved_by_status = $roww['approved_by_status'];
    $received_by_status = $roww['received_by_status'];
    $cash_id = $roww['cash_id'];
    $cash_idd = $cash_id + 1;
    $identificationnumber = 'SSWRQ' . sprintf("%04d", $cash_id);
    $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd' ORDER BY reference LIMIT 1") or die(mysql_error());
    $rs = mysql_fetch_array($trcc);
    $detail = $rs['detail'];
    $tss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'") or die(mysql_error());
    $jstt = mysql_fetch_array($tss);
    $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$cash_idd'") or die(mysql_error());
    $totals = mysql_fetch_array($sumitem);
    $jumla = $totals['SUM(total)'];
    ?>
                                        <tr>
                                            <td>
                                        <?php echo $m++; ?>
                                            </td>
                                            <td class="right">

                                        <?php
                                        if ($_SESSION["emp_file_no"] == 'SSW 147' || $_SESSION["emp_file_no"] == 'SSW 050' || $_SESSION["emp_file_no"] == 'SSW 211') {
                                            ?>
                                                    <a href="user_accounts.php?action=cash_account&View_cash=<?php echo $cash_id; ?>"><?php echo $identificationnumber; ?></a>
        <?php
    }
    ?>

    <?php
    if ($_SESSION["emp_file_no"] == 'SSW 122' || $_SESSION["emp_file_no"] == 'SSW 074') {
        ?>
                                                    <a href="user_accounts.php?action=cash_request&View_cash=<?php echo $cash_id; ?>"><?php echo $identificationnumber; ?></a>
                                                    <?php
                                                }
                                                ?>


                                            </td>

                                            <td class="right"><?php echo $output[0] = substr($detail, 0, 50) . '...'; ?></td>
                                            <td class="right"><?php echo $jstt['first_name'] . ' ' . $jstt['surname']; ?></td>
                                            <td class="right"><?php echo number_format($jumla, 2); ?></td>
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

<div id="my_request" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Payment Request History</h4>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <div class="col-lg-12">
                        <table   id="table5" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left"></th>
                                    <th class="text-left">Request ID</th>
                                    <th class="text-left">Request for Title</th>
                                    <th class="text-left">Requested by</th>  
                                    <th class="text-left">Request Date</th>
                                    <th class="text-left">Request Amount</th>
                                    <th class="text-left">Manager Status</th>
                                    <th class="text-left">Account Status</th>
                                </tr>
                            </thead>

                            <tbody>
<?php
$ids = $_SESSION["emp_file_no"];
$cashlist = mysql_query("SELECT * FROM cash_request where request_by='$ids' ORDER BY requestdatereport DESC") or die(mysql_error());
while ($roww = mysql_fetch_array($cashlist)) {
    $request_date = $roww['request_date'];
    $requ_title=$roww['title'];
    $request_by = $roww['request_by'];
    $approved_by_status = $roww['approved_by_status'];
    $received_by_status = $roww['received_by_status'];
    $cash_id = $roww['cash_id'];
    $cash_idd = $cash_id + 1;
    $vat2=$roww['vat'];
    $ewur_levy=$roww['ewura_levy'];
    $identificationnumber = 'SSWRQ' . sprintf("%04d", $cash_id);
    $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd' ORDER BY reference LIMIT 1") or die(mysql_error());
    $rs = mysql_fetch_array($trcc);
    $detail = $rs['detail'];
    $tss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'") or die(mysql_error());
    $jstt = mysql_fetch_array($tss);
    
    
    $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$cash_idd'") or die(mysql_error());
    $totals = mysql_fetch_array($sumitem);
    
    $jumla=$totals['SUM(total)'];
    $vat3=(($vat2/100)*$jumla);
    $total_amount=$jumla+$vat3+$ewur_levy;
    
    
    
    ?>
                                    <tr>
                                        <td class="right">
                                    <?php
                                    if ($_SESSION["emp_file_no"]) {
                                        ?>
                                                <a href="user_accounts.php?action=view_cash_request&View_cash=<?php echo $cash_id; ?>">View</a>
                                        <?php
                                    }
                                    ?>

                                        </td>
                                        <td class="right"><?php echo $identificationnumber; ?></td>
                                        <td class="right"><?php echo $requ_title;?></td>
                                        <td class="right"><?php echo $jstt['first_name'] . ' ' . $jstt['surname']; ?></td>
                                        <td class="right"><?php echo $request_date; ?></td>
                                        <td class="right"><?php echo number_format($total_amount,2); ?></td>
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
            <div class="modal-footer"> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--        <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<!--/////////////////REQUEST HISTORY////////////////////////////-->

<div id="my_request_history" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">My Request History</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left">No.</th>
                                    <th class="text-left">Items</th>
                                    <th class="text-left">Request Date</th>
                                    <th class="text-left">Requested by</th> 
                                    <th class="text-left">HOD Status</th>
                                    <th class="text-left">Store Status</th>
                                    <th class="text-left"></th>

                                </tr>
                            </thead>

                            <tbody>
<?php
$j = 1;
$requester_id = $_SESSION["emp_file_no"];
$sel = mysql_query("SELECT * FROM tbl_request_spare WHERE requester='$requester_id'") OR die(mysql_error());
while ($ws = mysql_fetch_array($sel)) {
    $request_idd = $ws['request_id'];
    $Request_title = $ws['Request_title'];
    $store_status = $ws['store_status'];

    $moja = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_idd' LIMIT 1") or die(mysql_error());
    $wekamoja = mysql_fetch_array($moja);





    $aa = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_idd'") or die(mysql_error());
    $bb = mysql_fetch_array($aa);
    $item = $bb['item'];
    $request_id = $bb['request_id'];

    if (!empty($Request_title)) {
        $view = $Request_title;
    } else {
        $view = $wekamoja['item'];
    }
    if ($store_status == "Pending") {
        $color = "";
    } else {
        $color = "";
    }


    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'")or die(mysql_error());
    $yunis = mysql_fetch_array($pinformation);
    $fm = $yunis['first_name'];
    $lm = $yunis['surname'];
    ?>
                                    <tr class="<?php echo $color; ?>">
                                        <td class="right"><?php echo $j++; ?></td>
                                        <td class="right"><a href="#"><?php echo $output[0] = substr($view, 0, 30) . '..'; ?></a></td>
                                        <td class="right"><?php echo $ws['request_date']; ?></td>
                                        <td class="right"><?php echo $fm . ' ' . $lm; ?></td>
                                        <td class="right"><?php echo $ws['hod_status']; ?></td>
                                        <td class="right"><?php echo $ws['store_status']; ?></td>
                                        <td class="right">


                                            <ul class="showlist">

                                                <li><a href="user_accounts.php?action=view_edit_request&requester_action=<?php echo $request_idd; ?>">View</a></li>

                                                <li><a href="user_accounts.php?action=delete_request_item&items_id=<?php echo $request_idd; ?>" data-confirm="Are you sure to delete this item?" id="delete">Delete</a></li>

                                            </ul>

                                        </td>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>              
            </div>
        </div>
    </div>
</div>

<!--show_modally-->
<!-- Modal -->
<div id="solar_database" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Solar Clients List</h4>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <div class="col-lg-12">

                        <button  data-toggle="modal" data-target="#solar_databases" class="btn btn-success" style="color:white"><i class="fa fa-plus"></i>&nbsp;Submit data</button>

                        <br />

                    </div>
                    <div class="col-lg-12" id="solar_action">

                    </div>
                    <div class="col-lg-12">
                        <!--tables-->
                        <table id="table_solar" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left"></th>
                                    <th class="text-left">Ref#</th>
                                    <th class="text-left">First Name</th>                                                                                     
                                    <th class="text-left">Surname</th>
                                    <th class="text-left">Phone No.</th>
                                    <th class="text-left">Deposit</th>
                                    <th class="text-left">Total Paid</th>
                                    <th class="text-left">Client Type</th>
                                    <th class="text-left">Package</th>
                                    <th class="text-left">Payment Term</th>
                                    <th class="text-left">Status</th>

                                </tr>
                            </thead>

        <tbody id="retedataa">
<?php
$select_solar = mysql_query("SELECT * FROM tbl_solar_clients ORDER BY client_id DESC") or die(mysql_error());
while ($mn = mysql_fetch_array($select_solar)) {
    $client_id = $mn['client_id'];
    $sumdeposite = mysql_query("SELECT SUM(amount) FROM tbl_solar_payment WHERE client_id='$client_id'") or die(mysql_error());
    $lipa = mysql_fetch_array($sumdeposite);
    $kiasi = $lipa['SUM(amount)'];
    $ms = mysql_query("SELECT * FROM tbl_solar_contract WHERE client_id='$client_id'") or die(mysql_error());
    $mt = mysql_fetch_array($ms);
    $kiasichamwanzo = $mt['deposit'];
    $jumla = $kiasichamwanzo + $kiasi;
    ?>
                                    <tr>
                                        <td class=" text-center">

                                            <input type="checkbox" onchange="showact(this.value)" value="<?php echo $client_id; ?>">

                                        </td>                                                
                                        <td class="right"><a href="#"><?php echo $mt['Ref']; ?></a></td>                                       
                                        <td class="right"><?php echo $mn['fname']; ?></td>
                                        <td class="right"><?php echo $mn['last_name']; ?></td>
                                        <td class="right"><?php echo $mn['phone_no']; ?></td>
                                        <td class="right"><?php echo $kiasichamwanzo; ?></td>
                                        <td class="right"><?php echo $kiasi; ?></td>
                                        <td class="right"><?php echo $mt['emp_client_agent_type']; ?></td>
                                        <td class="right"><?php echo $mt['package']; ?></td>
                                        <td class="right"><?php echo $mt['payment_model'] . 'Year(s)'; ?></td>
                                        <td class="right"><?php echo $mn['status']; ?></td>


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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--mwisho wa model-->

<!--solar clients-->
<!-- Modal -->
<div id="solar_databases" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Solar Clients</h4>
            </div>
            <div class="modal-body">

                <div class="row" >
                    <form action="" method="post">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs">

                                <li class="active"><a data-toggle="tab" href="#add_new"><i class="fa fa-plus"></i>&nbsp;Add New</a></li>
                                <li class=""><a data-toggle="tab" href="#contract"><i class="fa fa-plus"></i>&nbsp;Contract terms</a></li>
                                <li class=""><a data-toggle="tab" href="#payments"><i class="fa fa-plus"></i>&nbsp;Payments</a></li>
                            </ul>

                            <div class="tab-content">

                                <div class="col-lg-12">
                                    <br />
                                    <button type="submit" name="submitasset" class="btn btn-success" style="color:white"><i class="fa fa-arrow-down"></i>&nbsp;Submit data</button>
                                    <button class="btn btn-default" ><i class="fa fa-remove"></i> Cancel</button>
                                    <br />
                                    <br />
                                </div>

                                <div id="add_new" class="tab-pane fade in active">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">First Name:</span></span>
                                                <input name="fname"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Middle Name:</span></span>
                                                <input name="m_name"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Surname:</span></span>
                                                <input name="surname"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Gender:</span></span>
                                                <input name="gender"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right"> Age:</span></span>
                                                <input name="age"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Phone Number:</span></span>
                                                <input name="phone_number"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Place/Location:</span></span>
                                                <input name="place_location"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Employee/Client/Agent:</span></span>
                                                <input name="empl_client"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="contract" class="tab-pane fade">
                                    <div class="row">  
                                        <div class="col-lg-6">
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Date of registration or contract:</span></span>
                                                <input name="date_registration"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Payment or Term of Contract:</span></span>
                                                <input name="payment_term"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Package:</span></span>
                                                <input name="package"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Deposit:</span></span>
                                                <input name="deposit"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right"> Bboxx type:</span></span>
                                                <input name="boxx_type"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Bboxx Number:</span></span>
                                                <input name="boxx_numb"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:35%; text-align:right"><span class="text-right">Solar Size:</span></span>
                                                <input name="solar_size"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Solar No:</span></span>
                                                <input name="solar_no"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Lights:</span></span>
                                                <input name="lights"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Phone chargers:</span></span>
                                                <input name="phon_charge"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Tv/Radio:</span></span>
                                                <input name="tv_redio"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Dealer:</span></span>
                                                <input name="dealer"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                            <div class="input-group" style="width:100%; margin:2px 0">
                                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Tv serial:</span></span>
                                                <input name="tv_series"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--mmmmm-->

                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--end solar clients-->
<!-- Modal -->
<div id="edit_payment" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Payment</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="change_contents">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



<!-- Modal/////////////////////////////////////////////////// -->
<!-- Modal/////////////////////////////////////////////////// -->
<div id="site_attendence" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Site Attendence</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="alert alert-info">
                            <strong>Info!</strong> Please click the button bellow to find your current location.
                        </div>
                        <div class="input-group">
                            <button type="button" onclick="getLocation1()" class="btn btn-primary">My Current Location</button>&nbsp;
                            <button  class="btn btn-default" data-toggle="modal" data-target="#myModalverif">Site Attendance Verification</button>
                        </div>

                        <br><br>
                    </div>
                    <hr>
<?php
$y = $_SESSION["emp_file_no"];
$dw = date("Y-m-d");
$select = mysql_query("SELECT * FROM site_attendence WHERE tech_no='$y' AND lat_out=''") OR die(mysql_error());
$res = mysql_num_rows($select);
if ($res > 0) {
    $diu = 'logout_id';
} else {
    $diu = 'verifying';
}
?>
                    <form action="" method="POST" id="<?php echo $diu; ?>">
                        <div class="col-lg-12">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Latitude:</span></span>
                                <input name="techcian"   value="<?php echo $_SESSION["emp_file_no"]; ?>" aria-describedby="sizing-addon1"  type="hidden">
                                <input id="latitude" name="latitude" class="form-control editable " placeholder=""  value="" aria-describedby="sizing-addon1" readonly="" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Longitude:</span></span>
                                <input id="longitude" name="longitude" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" readonly="" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Site Name:</span></span>
                                <select class="form-control" data-live-search="true" id="af" name="site_cla">
                                    <option value="">Select Site Name</option>
<?php
$selectsd = mysql_query("SELECT * FROM tbl_class_a_site") or die(mysql_error());
while ($cla = mysql_fetch_array($selectsd)) {
    $names = $cla['sitename'];
    $s_id = $cla['s_id'];
    ?>
                                        <option value="<?php echo $s_id; ?>"><?php echo $names ?></option>
    <?php
}
?>
                                </select>
                            </div>
                            <hr>
                        </div>
                        <div class="col-lg-12" id="site_locaton">

                        </div>

                        <div class="col-lg-12" >
                            <div class="input-group">
                                <button type="submit" name="verifyin" value="in" class="btn btn-info ">Sign In</button>&nbsp;
                                <button  type="submit" class="btn btn-default ">Sign Out</button>
                            </div>
                            <!--<button type="submit" name="verifyin" value="in" class="btn btn-default" >Sign </button>-->
                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>




<!-- Modal -->
<div id="myattendence" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">HQ ATTENDANCE</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="alert alert-info">
                            <strong>Info!</strong> Please click the button bellow to find your current location.
                        </div>
                        <button type="button" onclick="getLocation1()" class="btn btn-primary">My Current Location</button>
                        <br><br>
                    </div>
                    <hr>
<?php
date_default_timezone_set("Africa/Nairobi");
$time = date("Hi");
if ($time <= 1630) {
    $id = "signin";
    $buton = '<button type="submit" name="verifyin" value="in" class="btn btn-default" >Sign In</button>';
} else {
    $id = "signout";
    $buton = '<button type="submit" name="verifyin" value="relative_id"  class="btn btn-default" >Sign Out</button>';
}
?>
                    <form action="" method="POST" id="<?php echo $id; ?>">
                        <div class="col-lg-12">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Latitude:</span></span>
                                <input name="techcian"   value="<?php echo $_SESSION["emp_file_no"]; ?>" aria-describedby="sizing-addon1"  type="hidden">
                                <input id="latitude1" name="latitude1" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" readonly="" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Longitude:</span></span>
                                <input id="longitude1" name="longitude1" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" readonly="" type="text">

                            </div>
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Location:</span></span>
                                <input id="" name="mac_address" class="form-control editable" placeholder=""  value="<?php echo $markadrees; ?>" aria-describedby="sizing-addon1" readonly="" type="text">

                            </div>
                            <hr>
                        </div>
                        <div class="col-lg-12" id="site_locatonz">

                        </div>
                        <div class="col-lg-12" >
<?php
echo $buton;
?>
                            <!--button-->
                        </div>
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="add_faults" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="">
            <form  action=""  method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">ADD NEW ISSUE</h4>
                </div>

                <div class="modal-body ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <div class="input-control text">
                                    <input type="text" name="" placeholder="Search By Vehicle Registration Number" onkeyup="showResult(this.value)" />
                                    <button class="btn-search"></button>
                                </div>
                            </div>

                            <div class="" id="show_data">
                                <!--                  show data-->
                            </div>
                            <div class="" id="show_form">
                                <!--                  show data-->

                            </div>
                        </div>
                    </div>


                    <div role="tabpanel" class="">
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Faults Description:</span></span>
                            <input name="faultsdescr" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Possible Causes:</span></span>
                            <input name="possible_cause" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Fault Reported Date:</span></span>
                            <input name="datefaults" id="date1" class="form-control editable" placeholder="" value="<?php echo date("d-m-Y") ?>" aria-describedby="sizing-addon1" readonly="" type="text">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Planned Resolution Date:</span></span>
                            <input name="planresolution" id="date2" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" readonly=""  type="text">
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">

                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Operation Conditions:</span></span>
                            <input name="operationcond" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Remark</span></span>
                            <input name="reasons" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">

                        </div>

                        <hr>
                        <div class="input-group" style="width:100%; margin:10px 0">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" name="register_car_issue" class="btn btn-primary">Submit</button>
                        </div>

                    </div>                  
                </div>
            </form>
        </div>
    </div>
</div>

<div id="notification" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
            <strong>Your data was successfully submitted!</strong> .
        </div>

    </div>
</div>

<!-- Modal -->
<div id="myModalverif" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Site Attendance Verification</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12" id="nipoo">

                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>          
                                    <th>Site Name</th>
                                    <th>Token</th>
                                    <th>Sent Time</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
$yy = $_SESSION["emp_file_no"];
$ad = mysql_query("SELECT * FROM site_attendence WHERE tech_no='$yy'") or die(mysql_error());
$bcg = mysql_fetch_array($ad);
$site_id = $bcg['site_id'];
$df = date("Y-m-d");


$adq = mysql_query("SELECT * FROM site_attendance_update WHERE site_id='$site_id' AND date='$df'") or die(mysql_error());
while ($bcgq = mysql_fetch_array($adq)) {
    $confim_id = $bcgq['confim_id'];
    $site_ids = $bcgq['site_id'];
    $ae = mysql_query("SELECT * FROM  tbl_class_a_site WHERE s_id='$site_ids'") or die(mysql_error());
    $bq = mysql_fetch_array($ae);
    $sitename = $bq['sitename'];
    ?>
                                    <tr>
                                        <td><?php echo $sitename; ?></td>
                                        <td><?php echo $bcgq['token_number']; ?></td>
                                        <td><?php echo $bcgq['sent_time']; ?></td>
                                        <td><?php echo $bcgq['date']; ?></td>
                                        <td>
                                            <a href="#"  class="view-info" data-a="<?php echo $confim_id; ?>" data-b="<?php echo $yy; ?>" data-c="<?php echo $sitename; ?>" data-d="<?php echo $site_ids; ?>" data-toggle="modal" data-target="#verified">Verify</a>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->



<div id="verified" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Verify</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" onclick="getLocation1()" class="btn btn-primary">My Current Location</button><hr>
                    </div>
                    <div class="col-lg-12" id="nipoo">

                    </div>
                    <div class="col-lg-12">

                        <form action="" method="POST" id="verify_at_site">
                            <div class="col-lg-12">
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Latitude:</span></span>
                                    <input name="techcian"   value="<?php echo $_SESSION["emp_file_no"]; ?>" aria-describedby="sizing-addon1"  type="hidden">
                                    <input id="la" name="la" class="form-control editable " placeholder=""  value="" aria-describedby="sizing-addon1" readonly="" type="text">

                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Longitude:</span></span>
                                    <input id="lo" name="lo" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" readonly="" type="text">

                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Site Name:</span></span>
                                    <input id="c" name="" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" readonly="" type="text">
                                    <input id="a" name="approved" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1"  type="hidden">
                                    <input id="b" name="approved_by" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1"  type="hidden">
                                    <input id="d" name="siteid" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1"  type="hidden">
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12" id="site_locaton">

                            </div>

                            <div class="col-lg-12" >
                                <div class="input-group">
                                    <button type="submit" name="submit" value="in" class="btn btn-info ">Submit</button>&nbsp;

                                </div>
                                <!--<button type="submit" name="verifyin" value="in" class="btn btn-default" >Sign </button>-->
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!-- fuel request modal -->
<div id="fuelrequest" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fuel Request</h4>
            </div>
            <div class="modal-body">
                <form  class="form-horizontal" action=""  method="post">
                    <input type="hidden" name="rquest" value="<?php echo $_SESSION["emp_file_no"]; ?>">
                    <div class="row" >

                        <div class="col-lg-12">
                            <table class="table table-striped table-hover bordered">
                                <tbody>                                
                                    <tr>
                                        <td style="width:50%">
                                            <select class="form-control" data-live-search="true" id="af" name="v_number" required="">
                                                <option value="">Select Vehicle Regno</option>
<?php
$selectsdv = mysql_query("SELECT * FROM tbl_car_monitoring") or die(mysql_error());
while ($clav = mysql_fetch_array($selectsdv)) {
    $vehicle_reg_num = $clav['vehicle_reg_num'];
    $car_id = $clav['car_id'];
    $driver_name = $clav['driver_name'];
    ?>
                                                    <option value="<?php echo $car_id; ?>"><?php echo $vehicle_reg_num . ' Driver Name: ' . $driver_name ?></option>
    <?php
}
?>
                                            </select>
                                        </td>
                                        <td style="width:50%"> 

                                            <input name="reqtitle" placeholder="Request Title"  required="" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%">

                                            <input name="cname" required="" placeholder="Company Name(*This field used only for Proformal invoice Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:50%">
                                            <select class="form-control" required="" onchange="showprojectz(this.value)" data-live-search="true" name="pname" required="">
                                                <option value="">Select Project</option>
                                                <!--                                                <option value="NULL">NOT PROJECT</option>-->

<?php
$selecd = mysql_query("SELECT * FROM tbl_preparedquotation") or die(mysql_error());
while ($clad = mysql_fetch_array($selecd)) {
    $qcode = $clad['Quotation_number'];
    $qname= $clad['Quotation_name'];
    ?>
        <option value="<?php echo $qcode;?>"><?php echo $qcode.'-'.$qname ?></option>
    <?php
    }
    ?>
                                            </select>
                                            <!--<input name="pname" required="" placeholder="Project Number(*This field used only for Project Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">-->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12">
                            <div id="projectitemz">

                            </div>

                            <table class="table table-striped table-hover bordered" id="cash-table">
                                <thead><tr>


                                        <th>DETAIL</th>                                                                              
                                        <th>QUANTITY</th>
                                        <th>UNIT PRICE</th>
                                        <th>UNIT</th>
                                    </tr>
                                </thead>
                                <tbody  style="font-size:9px">

                                    <tr>


                                        <td style="width:39%">
                                            <input name="details"  class="form-control amount editable" placeholder="" required=""  aria-describedby="sizing-addon1" type="text">

                                        </td>                                      

                                        <td style="width:10%">
                                            <input name="quant" id="quantit" onkeyup="calc()" value="1"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:10%">
                                            <input name="amount" id="quantit" onkeyup="calc()" value="1"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:10%">
                                            <input name="unit"  class="form-control amount editable" value="Ltr" required=""  aria-describedby="sizing-addon1" type="text">
                                    </tr>



                                </tbody>
                            </table>                           
                            <button type="submit" name="fuel_request" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-arrow-right"></i>Submit Your Request</button>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>





<!-- Modal -->
<div id="fuelrequestmanage" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manage Fuel Request</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table   id="tablefuel" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left">Actions</th>
                                    <th class="text-left">Refno</th>
                                    <th class="text-left">Request Title</th>                                                                             
                                    <th class="text-left">Requested by</th> 
                                    <th class="text-left">Quantity</th>
                                    <th class="text-left">Amount</th>
                                    <th class="text-left">Unit</th>
                                    <th class="text-left">Date</th>                                        
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Received by</th>


                                </tr>
                            </thead>

                            <tbody>
<?php
$fuel = mysql_query("SELECT * FROM fuel_request ORDER BY refno DESC") or die(mysql_error());
while ($refrow = mysql_fetch_array($fuel)) {
    $request_date = $refrow['req_date'];
    $requester = $refrow['requester'];
    $request_title = $refrow['request_title'];
    $details = $refrow['details'];
    $refno = $refrow['refno'];
    $amount = $refrow['amount'];

    $quantity = $refrow['quantity'];
    $unit = $refrow['unit'];
    $reg_no = $refrow['reg_no'];
    $req_date = $refrow['req_date'];
    $status = $refrow['status'];
    $receipt = $refrow['receipt'];
    $approve_by = $refrow['approve_by'];
    
    $selectsdvv = mysql_query("SELECT * FROM tbl_car_monitoring WHERE car_id='$reg_no'") or die(mysql_error());
     $clavv = mysql_fetch_array($selectsdvv);
    $vehicle_reg_num = $clavv['vehicle_reg_num'];
    
    

    $refnu = 'SSWFRQ' . sprintf("%04d", $refno);
    $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd' ORDER BY reference LIMIT 1") or die(mysql_error());
    $rs = mysql_fetch_array($trcc);
    $detail = $rs['detail'];
    $tss1 = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'") or die(mysql_error());
    $jna = mysql_fetch_array($tss1);
    $fullname1 = $jna['first_name'] . ' ' . $jna['surname'];
    $tss2 = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$approve_by'") or die(mysql_error());
    $jna2 = mysql_fetch_array($tss2);
    $fullname2 = $jna2['first_name'] . ' ' . $jna2['surname'];
    ?>
                                    <tr>
                                        <td class="right">
                                            <ul class="showlist">

                                                <li><a href="user_accounts.php?fuel_approve=<?php echo $refno; ?>">Approve</a></li>|<li><a href="user_accounts.php?fuel_reject=<?php echo $refno; ?>">Reject</a>
                                                </li></ul>
                                        </td>
                                        <td class="right"><?php echo $refnu; ?></td>
                                        <td class="right"><a href="#"  data-toggle="modal" data-target="#approveform" class="edit_request" data-amount="<?php echo $amount; ?>" data-quantity="<?php echo $quantity; ?>" data-id="<?php echo $refno; ?>" data-detail="<?php echo $details; ?>" data-request_title="<?php echo $request_title; ?>">
                                            <?php echo $request_title. ' '.$vehicle_reg_num; ?></a></td>                                        
                                        <td class="right"><?php echo $fullname1; ?></td>
                                        <td class="right"><?php echo number_format($quantity, 2); ?></td>
                                        <td class="right"><?php echo $amount; ?></td>
                                        <td class="right"><?php echo $unit; ?></td>
                                        <td class="right"><?php echo $req_date; ?></td>                                                                                
                                        <td class="right"><?php echo $status; ?></td>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--//////////////////////////////manage fuel account/////////////////////////////////////-->
<!-- Modal -->

<!-- Modal history -->
<div id="fuelrequesthistory" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fuel Request History</h4>
            </div>
            <div class="modal-body">
                <table   id="table8" class="table table-striped table-bordered table-responsive" style=" font-size: 13px;" cellspacing="0" width="100%">
                    <thead>
                        <tr>

                            <th class="text-left">Refno</th>
                            <th class="text-left">Request Title</th>                                                                             
                            <th class="text-left">Requested by</th> 
                            <th class="text-left">Quantity</th>
                            <th class="text-left">Unit</th>
                            <th class="text-left">Date</th>                                        
                            <th class="text-left">Status</th>
                            <th class="text-left">Received by</th>


                        </tr>
                    </thead>

                    <tbody>
<?php
$naa = $_SESSION["emp_file_no"];
$fuel = mysql_query("SELECT * FROM fuel_request WHERE requester='$naa' ORDER BY refno DESC") or die(mysql_error());
while ($refrow = mysql_fetch_array($fuel)) {
    $request_date = $refrow['req_date'];
    $requester = $refrow['requester'];
    $request_title = $refrow['request_title'];
    $details = $refrow['details'];
    $refno = $refrow['refno'];

    $quantity = $refrow['quantity'];
    $unit = $refrow['unit'];
    $reg_no = $refrow['reg_no'];
    $req_date = $refrow['req_date'];
    $status = $refrow['status'];
    $receipt = $refrow['receipt'];
    $approve_by = $refrow['approve_by'];
    $amount = $refrow['amount'];


    $refnu = 'SSWFRQ' . sprintf("%04d", $refno);
    $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd' ORDER BY reference LIMIT 1") or die(mysql_error());
    $rs = mysql_fetch_array($trcc);
    $detail = $rs['detail'];
    $tss1 = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'") or die(mysql_error());
    $jna = mysql_fetch_array($tss1);
    $fullname1 = $jna['first_name'] . ' ' . $jna['surname'];
    $tss2 = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$approve_by'") or die(mysql_error());
    $jna2 = mysql_fetch_array($tss2);
    $fullname2 = $jna2['first_name'] . ' ' . $jna2['surname'];
    ?>
                            <tr>                        
                                <td class="right"><?php echo $refnu; ?></td>
                                <td class="right"><?php echo $request_title; ?></td>
                                <td class="right"><?php echo $fullname1; ?></td>
                                <td class="right"><?php echo number_format($quantity, 2); ?></td>
                                <td class="right"><?php echo $unit; ?></td>
                                <td class="right"><?php echo $req_date; ?></td>                                                                                  
                                <td class="right"><?php echo $status; ?></td>
                                <td class="right"><?php echo $received_by_status; ?></td>


                            </tr> 
                            <?php
                        }
                        ?>
                    </tbody>

                    <tfoot></tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



<div id="fuelrequestnotification" class="modal fade" role="dialog">
    <div class="modal-dialog">    
        <div class="alert alert-info alert-dismissable">
            <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
            <strong>Your request has been sent successfully!</strong> 
        </div>

    </div>
</div>

<div id="fuelrequestnotification3" class="modal fade" role="dialog">
    <div class="modal-dialog">    
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
            <strong>Request Title and Vehicle Regno can not be empty!</strong> 
        </div>

    </div>
</div>
<div id="fuelrequestnotification2" class="modal fade" role="dialog">
    <div class="modal-dialog">    
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
            <strong>Error Try again!</strong> 
        </div>

    </div>
</div>


<div id="fuelrequestnotificationsend" class="modal fade" role="dialog">
    <div class="modal-dialog">    
        <div class="alert alert-info alert-dismissable">
            <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
            <strong>Request Approved Successful!</strong> 
        </div>

    </div>
</div>



<!-- Modal -->
<div id="approveform" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manage Fuel Request</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class=" col-lg-12">

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="email">Request Title:</label>
                                <input type="text" class="form-control" id="request_title" readonly="">
                                <input type="hidden" name="fuel_approve" class="form-control" id="id">
                            </div>
                            <div class="form-group">
                                <label for="comment">Details:</label>
                                <textarea class="form-control" rows="5" id="detail" readonly="" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Quantity:</label>
                                <input type="text" class="form-control" value="" id="quantity" name="quantity">

                            </div>
                            <div class="form-group">
                                <label for="pwd">Unity Price:</label>
                                <input type="text" class="form-control" value="" id="amount" name="amount">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Total Price:</label>
                                <input type="text" class="form-control" value="" id="tamount" readonly="" name="">
                            </div>

                            <button type="submit"  class="btn btn-default">Update/Approve</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



