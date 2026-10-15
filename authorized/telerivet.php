<?php
$message = "";
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
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
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
        $P= $_POST['P'];
        $model = $_POST['model'];
        $man = $_POST['man'];
        $units = $_POST['units'];
        $spec = $_POST['spec'];       
        $hod_sel = $_POST['hod_sel'];
        $req_title = $_POST['req_title'];
        $quantity = $_POST['quant'];
        $departmentt = $_POST['department'];
        $request_date = date("d-m-Y H:i:s");
        $requester = $_SESSION["emp_file_no"];


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

        $emailing = $hod_sel.',joaqim@sincrositewatch.com';
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

                   
                    $insert = mysql_query("INSERT INTO request_item_list( `item`, `specification`, `model`, `partnumber`, `manufacture`, `description`, `department`, `quantity`,`unit`, `request_id`)"
                            . "values('$itemm[$i]','$spec[$i]','$model[$i]','$P[$i]','$man[$i]','$desc[$i]','$departmentt[$i]','$quantity[$i]','$units[$i]','$request_id')") or die(mysql_error());
                }
                
                if($insert){
                    $fgs=  mysql_query("DELETE FROM tbl_request_spare_temporary WHERE requester_id='$requester'") or die(mysql_error());
                }

//SEND EMAILS
                if (!empty($hod_sel)) {
                    $emailing = $hod_sel.',joaqim@sincrositewatch.com';
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

}
     else {
        $message = '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">X</a>
    <strong>Error!Request title and HOD can not be empty</strong> 
</div>';
    }
}

if (isset($_POST['cash_request'])) {

    $details = $_POST['details'];
//    $job = $_POST['job'];
//    $total = $_POST['total'];
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
    $tarehyareo=date("d-m-Y");
    
    $mzuiet = mysql_query("SELECT * FROM cash_request WHERE request_by='$rquest' AND request_status='Pending Retirement'") or die(mysql_error());
       $mzuie = mysql_query("SELECT * FROM cash_request WHERE request_by='$rquest' AND request_status='Pending Retirement'");
    $ombatena=  mysql_num_rows($mzuie);
    
    while($rowjj= mysql_fetch_array($mzuiet)){
        $request_datet=$rowjj['request_date'];
        $convert=  explode(' ', $request_datet);
        $testdate=$convert[0];
      
        if($tarehyareo==$testdate){
            $ombatena='YES';
        }
 else {
     $ombatena='';
    
 }
    }
    
  
    
 
   
  if($ombatena=='YES'){
           $r_equest = mysql_query("INSERT INTO cash_request(`request_by`,`request_date`,`approved_by_status`, `received_by_status`,request_status,invoice_number,company_name,pname)"
            . "VALUE('$rquest','$request_date','Pending','Pending','Pending','$invnumber','$cname','$pname')") or die(mysql_error());
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

            $insert = mysql_query("INSERT INTO cash_request_item(`detail`, units,units_price,quantity, `total`, `reference`)"
                    . "values('$details[$i]','$unit[$i]','$price[$i]','$quant[$i]','$subtotal','$refence')") or die(mysql_error());
        }
        

       
         //SEND EMAILS
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
     $CASH_id =$QQ['cash_id']+1;
    $CASH =$QQ['cash_id'];
    $identificationnumber='SSWRQ'.sprintf("%04d",$cash_id);
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


//SEND EMAILS

        $fullnamee = $fm . " " . $lm;
        $emailing = "pastory.hamaro@sincrositewatch.com";
        $to = $emailing;
        $subject = 'Cash Request Notification!';
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
        $message .= '<p style="">Please kindly review and approve the new Cash Request No.'.$identificationnumber.'.You are required to act on this approved immediatly.</p>';
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
        $message .= '<p style="color:#080;font-size:18px;"><a href="http://sas.sincrositewatch.com/" target="_blank">Click this link to approve or reject the request!</a></p>';
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
    } 
    
    else{
        
    }
}
elseif($ombatena>0){
               $r_equest = mysql_query("INSERT INTO cash_request(`request_by`,`request_date`,`approved_by_status`, `received_by_status`,request_status,invoice_number,company_name,pname)"
            . "VALUE('$rquest','$request_date','Pending','Pending','Pending','$invnumber','$cname','$pname')") or die(mysql_error());
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

            $insert = mysql_query("INSERT INTO cash_request_item(`detail`, units,units_price,quantity, `total`, `reference`)"
                    . "values('$details[$i]','$unit[$i]','$price[$i]','$quant[$i]','$subtotal','$refence')") or die(mysql_error());
        }
        

       
         //SEND EMAILS
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
     $CASH_id =$QQ['cash_id']+1;
    $CASH =$QQ['cash_id'];
    $identificationnumber='SSWRQ'.sprintf("%04d",$cash_id);
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


//SEND EMAILS

        $fullnamee = $fm . " " . $lm;
        $emailing = "pastory.hamaro@sincrositewatch.com";
        $to = $emailing;
        $subject = 'Cash Request Notification!';
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
        $message .= '<p style="">Please kindly review and approve the new Cash Request No.'.$identificationnumber.'.You are required to act on this approved immediatly.</p>';
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
        $message .= '<p style="color:#080;font-size:18px;"><a href="http://sas.sincrositewatch.com/" target="_blank">Click this link to approve or reject the request!</a></p>';
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
    } 
    
    else{
        
    }
}
else{
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
?>
<head>
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
                    
                      xhr: function()
  {
    var xhr = new window.XMLHttpRequest();
    //Upload progress
    xhr.upload.addEventListener("progress", function(evt){
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        //Do something with upload progress
        console.log(percentComplete);
      }
    }, false);
    //Download progress
    xhr.addEventListener("progress", function(evt){
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
            $("#addrelative").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/add_relatives.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#show_message").html(data);
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

    <script>
        function deletee() {
            // 1. Create XHR instance - Start
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } else {
                throw new Error("Ajax is not supported by this browser");
            }
            // 1. Create XHR instance - End

            // 2. Define what to do when XHR feed you the response from the server - Start
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status == 200 && xhr.status < 300) {
                        document.getElementById('show_message').innerHTML = xhr.responseText;
                    }
                }
            }
            // 2. Define what to do when XHR feed you the response from the server - Start

            var employee_no = document.getElementById("employee_no").value;
            var relative_id = document.getElementById("relative_id").value;

            // 3. Specify your action, location and Send to the server - Start 
            xhr.open('POST', 'authorized/usersystem/delete_relative.php');
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("employee_no=" + employee_no + "&relative_id=" + relative_id);
            // 3. Specify your action, location and Send to the server - End
        }
    </script>
    <script>
        function showaction(str) {
            if (str.length == 0) {
                document.getElementById("action_delete").innerHTML = "";
                document.getElementById("action_delete").style.border = "0px";
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
                    document.getElementById("action_delete").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/usersystem/relative_action.php?q=" + str, true);
            xmlhttp.send();
        }
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

            $("#uploadeducation").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/HR/education.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#notifing").html(data);
                    },
                    error: function () {
                    }
                });
            }));



        });


    </script>
<!--    <script>
        function calc() {
    var textValue1 = document.getElementById('quantit').value;
    var textValue2 = document.getElementById('pric').value;

    document.getElementById('amounts').value = textValue1 * textValue2;
}
        
    </script>-->


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


</head>
<div class="navbar-header no-desktop">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <a class="" href="?action=employee"><i  class="icon-list fg-blue"></i>&nbsp;Menu</a> 
    </button>

</div>

<div class="bg-white shadow collapse navbar-collapse " id="myNavbar"  style="width: 100%;" >

    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="#"><i  class="icon-user-2 fg-blue"></i>&nbsp;My Profile</a>
            </li>
            <li >
                <a class="" style="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModaldependant">Add dependants</a>
            </li>

            <li>
                <a class="" href="#"  data-toggle="modal" data-target="#myModalleave" >Leave Request</a>
            </li>
            <li>
                <a class="" href="#"  data-toggle="modal" data-target="#manageleave" >Leave Management</a>
            </li>
            <li>
                <a class="" href="#"  class="fg-hover-crimson fg-cobalt">Pay slips</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#manage_asset">Asset Management</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalattachment">Attachments</a>
            </li>
            <!--                <li>
                                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalcar_issues">Report Car Issues</a>
                            </li>-->

            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalcar_issues">Request Material</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalcar_req">Manage Request</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalattendence">Attendance Report</a>
            </li>

        </ul>
    </nav>
</div>
<div class="" style="width: 100%;margin-top: 3px;">
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
<div class=" container-fluid" style="">

    <div class="row" style=" margin-left: 8px;">
        <div class="span3">
               <div class="bg-white shadow" style="width: 100%;" >
                <nav class="horizontal-menu compact">
                    <ul>
                        <li>
                            <a class="" href=""><i class="icon-calendar fg-blue"></i>&nbsp;Quick Links</a>
                        </li>                       
                    </ul>
                </nav>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div style="height:1px; background-color:rgb(220,220,220)"></div>
                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a class="sub-menu collapsed" style=" text-decoration: none;" data-toggle="collapse" data-parent="#accordion" href="#collapse-cash" aria-expanded="false" aria-controls="collapse-stock">
                            <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp;Cash Request
                        </a>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse-cash" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                        <div class="list-group">
                            <a href="#" data-toggle="modal" data-target="#cash_request" class="list-group-item"><span class=""></span>&nbsp; Request Form</a>

                        </div>
                        <div class="list-group">
                            <a href="#" data-toggle="modal" data-target="#my_request" class="list-group-item"><span class=""></span>&nbsp;My Request</a>

                        </div>
<?php
if ($_SESSION["emp_file_no"] == 'SSW 147' OR $_SESSION["emp_file_no"] == 'SSW 122' OR $_SESSION["emp_file_no"] == 'SSW 211') {
    ?>
                            <div class="list-group">
                                <a  href="#" data-toggle="modal" data-target="#manage_cash_request" class="list-group-item"><span class=""></span>&nbsp;Manage Request</a>

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
                            <a  href="?action=goods_received_note" style=" text-decoration: none;">
                                <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>&nbsp; Goods Received Note
                            </a>
                        </div>
                     <div style="height:1px; background-color:rgb(220,220,220)"></div>
                    <div class="panel-heading">
                            <a  href="?action=stoock" style=" text-decoration: none;">
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
                            <a href="?action=manage_appraisal" class="list-group-item"><span class=""></span>&nbsp; Manage Appraisal</a>

                        </div>
                        <div class="list-group">
                            <a href="?action=fill_appraisal" class="list-group-item"><span class=""></span>&nbsp; My Appraisal</a>

                        </div>
                    </div>









                </div>

            </div>
        </div>
        <div class="span4">
            <div class="bg-white shadow" style="width: 100%;" >
                <nav class="horizontal-menu compact">
                    <ul>
                        <li>
                            <a class=" " href=""><i class="icon-user-2 fg-blue"></i>&nbsp;PERSONAL INFORMATION</a>
                        </li>                       
                    </ul>
                </nav>
            </div>
            <div class="bg-white shadow" style="width: 100%;" >
                <table class="shadow padding20" style="width:100%">            
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
            </div>
        </div>
        <div class="span5">
            <div class="bg-white shadow" style="width: 100%;" >
                <nav class="horizontal-menu compact">
                    <ul>
                        <li>
                            <a class=" " href=""><i class="icon-location fg-blue"></i>&nbsp;CONTACTS</a>
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
        <div class="span4">
                        <div class="bg-white shadow" style="width: 100%;" >
                <nav class="horizontal-menu compact">
                    <ul>
                        <li>
                            <a class="" href=""><i class="icon-home fg-blue"></i>&nbsp;PROFILE PICTURE</a>
                        </li>                       
                    </ul>
                </nav>
            </div>
            <div style="width:100%; " >
                <img src="<?php echo $profile_pic; ?>" class="img-responsive span4" style="width: 100%; height: 220px;">
            </div>
            <div class="bg-white shadow" style="width: 100%;" >
                <nav class="horizontal-menu compact">
                    <ul>
                        <li>
                            <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModaluploadpic"><i class="fg-blue"></i>&nbsp;Change Profile Picture</a>
                        </li>                       
                    </ul>
                </nav>
            </div>
            

        </div>
    </div>   
</div>
<div style="clear: both;"></div>
<div class=" container-fluid">
    <div class="row" style=" margin-left: 8px;">
        <div class="span3">
             <div class="bg-white shadow" style="width: 100%;" >
                <nav class="horizontal-menu compact">
                    <ul>
                        <li>
                            <a class="" href=""><i class="icon-calendar fg-blue"></i>&nbsp;DEFAULTS TIME SLOTS</a>
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
        <div class="span5">
            <div class="bg-white shadow" style="width: 100%;" >
                <nav class="horizontal-menu compact">
                    <ul>
                        <li>
                            <a class="" href=""><i class="icon-calendar fg-blue"></i>&nbsp;EMPLOYMENT</a>
                        </li>                       
                    </ul>
                </nav>
            </div>
            <div class="bg-white shadow" style="width: 100%;" >
                <table class="shadow" style="width:100%">            
                    <tr>
                        <td class=""><span class="text-bold">Employee Number:</span></td>
                        <td class=""><?php echo $_SESSION["emp_file_no"]; ?></td>
                    </tr>  
                    <tr>
                        <td class=""><span class="text-bold">Designation:</span></td>
                        <td class=""><?php echo $designation; ?></td>
                    </tr>                   
                    <tr>
                        <td class=""><span class="text-bold">Hire Date:</span></td>
                        <td class=""><?php echo $start_date; ?></td>
                    </tr>
                    <tr>
                        <td class=""><span class="text-bold">End Date:</span></td>
                        <td class=""><?php echo $end_date; ?></td>
                    </tr>                   
                    <tr>
                        <td class=""><span class="text-bold">Department:</span></td>
                        <td class=""><?php echo $department_name; ?></td>
                    </tr>
                    <tr>
                        <td class=""><span class="text-bold">Position</span></td>
                        <td class=""><?php echo $position_name; ?></td>
                    </tr>
                    <tr>
                        <td class=""><span class="text-bold">Location</span></td>
                        <td class=""><?php echo 'HQ'; ?></td>
                    </tr>
                    <tr>
                        <td class=""><span class="text-bold">Basic Salary</span></td>
                        <td class="">Private</td>
                    </tr>


                </table>
            </div>
        </div>

        <div class="span8">
            <div class="bg-white shadow" style="width: 100%;" >
                <nav class="horizontal-menu compact">
                    <ul>
                        <li>
                            <a class="" href=""><i class="icon-calendar fg-blue"></i>&nbsp;Employee Leave Status</a>
                        </li>                       
                    </ul>
                </nav>
            </div>
            <div style="width: 100%">
                <div style="width:100%">
                    <h5>Days</h5>
                    <canvas style="" id="products_canvas" height="10%" width="20%"></canvas>
                </div>
                <script>
                    products_chart_data = {
                        labels: ["Sick Leave", "Holiday Leave", "Others", "Paternity leave", "Adoption", "Disability", "Maternity", "Annual Leave"],
                        datasets: [
                            {
                                label: 'Sales',
                                fillColor: 'rgba(51, 122, 183,0.9)',
                                strokeColor: 'rgba(51, 122, 183,1)',
                                pointColor: 'rgba(51, 122, 183,1)',
                                pointStrokeColor: '#fff',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(100,180,100,1)',
                                data: [28, 21, 14, 7, 0, 24, 4, 9]
                            }
                        ]
                    }

                    products_context = document.getElementById('products_canvas').getContext('2d');
                    products_chart = new Chart(products_context).Bar(products_chart_data, {responsive: true, animationEasing: 'easeOutBounce', animationSteps: 120});
                </script>
            </div>
        </div>
    </div>
</div>

<!-----------------------------mwisho container--------------------------------->


<!--start popup windows-->
<!-- Modal -->
<div id="myModaldependant" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Add Relatives</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">                       
                        <form id="addrelative" action="authorized/usersystem/add_relatives.php"  method="post">
                            <div class="form-group">                                                             
                                <input  type="hidden"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $_SESSION["emp_file_no"]; ?>" id="employee_no" name="employee_no">
                            </div>                           
                            <div class="form-group">
                                <label for="company_asset">First Name:</label>
                                <input  type="text" class="form-control" value="" id="employee_no" name="fname">
                            </div>  
                            <div class="form-group">
                                <label for="comment">Middle Name:</label>
                                <input  type="text" class="form-control" value="" id="employee_no" name="mname">
                            </div>
                            <div class="form-group">
                                <label for="comment">Last Name:</label>
                                <input  type="text" class="form-control" value="" id="employee_no" name="lname">
                            </div>
                            <div class="form-group">
                                <label for="sel1">Gender:</label>
                                <select class="form-control" name="sex" id="sex">
                                    <option>---select</option>
                                    <option  value="Male">Male</option>
                                    <option  value="Female">Female</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment">Relation Type:</label>
                                <input  type="text" class="form-control" value="" id="Rname" name="Rname">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input  type="text" class="form-control" value="" id="phone" name="phone">
                            </div>
                            <input type="submit" value="Submit Data" class="btn btn-default">
                        </form>


                        <div id="show_message">
                            <div id="action_delete">

                            </div>
                            <div class="example">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-left"></th>
                                            <th class="text-left">ID</th>
                                            <th class="text-left">Full Name</th>  
                                            <th class="text-left">Gender</th>
                                            <th class="text-left">Relationship</th>  
                                            <th class="text-left">Phone</th>
                                        </tr>
                                    </thead>

                                    <tbody>
<?php
$select_asset = mysql_query("SELECT * FROM tbl_relatives WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'") or die(mysql_error());
$i = 0;
while ($roww = mysql_fetch_array($select_asset)) {
    $firstname = $roww['firstname'];
    $surname = $roww['surname'];
    $gender = $roww['gender'];
    $relation = $roww['relation'];
    $fullname = $firstname . '&nbsp;' . $surname;
    $relative_id = $roww['relative_id'];
    $phone = $roww['phone'];
    $i++
    ?>
                                            <tr>
                                                <td><input type="checkbox" name="" value="<?php echo $relative_id; ?>" onchange="showaction(this.value)"></td>
                                                <td class="right"><?php echo $i; ?></td>
                                                <td class="right"><?php echo $fullname; ?></td>
                                                <td class="right"><?php echo $gender; ?></td>
                                                <td class="right"><?php echo $relation; ?></td>
                                                <td class="right"><?php echo $phone; ?></td>
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
<!--applying for leave-->
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

<?php } ?>
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

<?php } ?>
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

<!--///-->
<div id="myModalattachment" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Resume,Training,Certificate,Awards</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <form role="form" method="post" action="" enctype="multipart/form-data"  >

                            <div class="form-group">
                                <label for="name">Employee Name:</label>
<?php
$personalinfoo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'")or die(mysql_error());
$u = mysql_fetch_array($personalinfoo);
$f = $u['first_name'];
$l = $u['surname'];
?>
                                <input disabled="" type="text"  class="form-control" value="<?php echo $f . ' ' . $l; ?>" id="name" name="name">
                                <input  type="hidden"  class="form-control" value="<?php echo $f . ' ' . $l; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $_SESSION["emp_file_no"]; ?>" id="employee_no" name="employee_no">
                            </div>
                            <div class="form-group">
                                <label for="tax_cat_id">Choose Category:</label>
                                <select class="form-control"  id="kind_id" name="kind_id">
<?php
$select_car = mysql_query("SELECT * from tbl_attachment_kind") or die(mysql_error());
while ($rowing = mysql_fetch_array($select_car)) {
    $category_name = $rowing['category_name'];
    $kind_id = $rowing['kind_id'];
    ?>
                                        <option value="<?php echo $kind_id; ?>"><?php echo $category_name; ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file">Select Attachment:</label>
                                <div class="input-control file">
                                    <input type="file" name="file" />
                                    <button class="btn-file"></button>
                                </div>
                            </div>                             
                            <button type="submit" class="btn btn-default" name="attachment">Submit</button>
                        </form>
                        <div class="bg-white shadow" style="width: 100%;" >
                            <nav class="horizontal-menu compact">
                                <ul>
                                    <li>
                                        <a class=" " href=""><i class="fg-blue"></i>&nbsp;User Attachments</a>
                                    </li>                       
                                </ul>
                            </nav>
                        </div>
                        <ul class="treeview" data-role="treeview">
                            <li class="node collapsed">

                                <a style="padding-left: 0px;" href="#"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;<?php echo $f . ' ' . $l; ?>&nbsp;Attachments</a>
                                <ul style="display: none;">
<?php
$select_attach_category = mysql_query("SELECT * FROM tbl_attachment_kind") or die(mysql_error());
while ($shows = mysql_fetch_array($select_attach_category)) {
    $kind_id = $shows['kind_id'];
    $category_name = $shows['category_name'];
    $attachment_dir = $shows['attachment_dir'];
    ?>
                                        <li class="node collapsed">
                                            <a style="padding-left: 20px;" href="#"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;<?php echo $category_name; ?></a>
                                            <ul>
    <?php
    $select_node = mysql_query("SELECT * FROM tbl_attachments where attachment_category='$kind_id' AND employe_no='" . $_SESSION["emp_file_no"] . "'") or die(mysql_error());
    while ($row = mysql_fetch_array($select_node)) {
        $file_name = $row['file_name'];
        ?>
                                                    <li>
                                                        <a style="padding-left: 30px;" href="#" onclick="window.open('./authorized/HR/attachments/<?php echo $attachment_dir; ?>/<?php echo $file_name; ?>')">
                                            <?php echo $file_name; ?>
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
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!--////////////////////////////////////////////////////////-->
<!-- Modal -->
<div class="modal fade" id="manage_asset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Asset Management</h4>
      </div>
      <div class="modal-body">
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
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Employee:</span></span>
                                    <select class="form-control"  id="kind_id" name="employeename">
                                                <option value="" >----Employee Name---</option>
<?php
$department_id = $positions['department_id'];
$employee_hdd=$_SESSION['hod_system_access'];
if($employee_hdd=='YES'){
      $show='';
}
else{
  
    $show='readonly=""';
}
$emplot = mysql_query("SELECT * from tbl_assign_to_department") or die(mysql_error());
while ($joh = mysql_fetch_array($emplot)) {
    $emp_file = $joh['emp_file_no'];
    $emplott = mysql_query("SELECT * from  tbl_employee where emp_file_no='$emp_file'") or die(mysql_error());
    $ljina = mysql_fetch_array($emplott);
    ?>
                                                    <option value="<?php echo $emp_file; ?>"><?php echo $ljina['first_name'] . ' ' . $ljina['surname']; ?></option>
    <?php
}
?>
                                            </select>
                                </div>
                          <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Owner Department:</span></span>
                                    <input  name="contactname"  id="product_name" class="form-control editable" disabled="" value="<?php echo $department_name;?>" aria-describedby="sizing-addon1" type="text">
                                     <input type="text" name="department_id" value="<?php echo $department_id; ?>" hidden="">
                                      <input type="text" name="registerid" value="<?php echo $_SESSION['emp_file_no']; ?>" hidden="">
                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Asset Name:</span></span>
                                    <input name="assetname" id="product_name" <?php echo $show;?>  class="form-control editable" placeholder="" <?php echo $show;?> value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Description:</span></span>
                                    <input name="descriptional" <?php echo $show;?>  id="product_name" class="form-control editable" placeholder="" <?php echo $show;?> value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Model:</span></span>
                                    <input name="modeli" id="product_name" <?php echo $show;?>  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                   <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vendor:</span></span>
                                    <input name="vendor" id="product_name" <?php echo $show;?>  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                                                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Purchase:</span></span>
                                    <input name="purchase" id="product_name"   class="form-control editable" placeholder="dd/mm/yy"  aria-describedby="sizing-addon1" type="text">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Warranty:</span></span>
                                    <input name="warranty" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="" aria-describedby="sizing-addon1" type="text">

                                </div>


              </div>
              <div class="col-lg-6">
                          <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Barcode:</span></span>
                                    <input name="barcode" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Serial No:</span></span>
                                    <input name="serialno" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Status:</span></span>
                                    <input name="status" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Purchase Price:</span></span>
                                    <input name="purchase_price" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Location:</span></span>
                                    <input name="locations" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                  
                  <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Notes:</span></span>
                                    <textarea name="notes" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text"></textarea>

                                </div>
              </div>
              </form>
              <hr>
              </div>
          
          
                      <div class="row">
                    <div class="col-lg-12">
                        <table id="table3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left"></th>
                                    <th class="text-left">S/N.</th>
                                    <th class="text-left">Asset Name</th>
                                    <th class="text-left">Description</th>
<!--                                    <th class="text-left">Vendor</th> -->
                                    <th class="text-left">Model</th>
                                    <th class="text-left">Serial</th>
                                    
                                      <th class="text-left">Employee Name</th>
                                     
                                    

                                </tr>
                            </thead>

                            <tbody id="retedataa">
<?php
$j = 1;
$selectasset=  mysql_query("SELECT * FROM tbl_employee_asset WHERE department_id='$department_id' ORDER BY asset_id DESC") or die(mysql_error());
while ($assetsincro= mysql_fetch_array($selectasset)) {
    $empo=$assetsincro['employe_no'];
    $persona = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$empo'")or die(mysql_error());
$us = mysql_fetch_array($persona);
$fv = $us['first_name'];
$lv = $us['surname'];
    ?>
                                    <tr>
                                         <td class=" text-center">
                                             <div class="vertical-menu compact" style=" padding-top: 10px;">
        <ul>
            <li>
                <a class="dropdown-toggle" href="#"></a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="#"><i class="icon-user-2"></i>&nbsp;Edit</a></li>
                    <li><a href="#"><i class="icon-user-3 fg-green"></i>&nbsp;Reallocate</a></li>

                </ul>
            </li>          
        </ul>
    </div>
                                        </td>
                                        <td class="right"><?php echo $j++; ?></td>
                                        <td class="right"><a href="#"><?php echo $assetsincro['asset_name']; ?></a></td>                                       
                                        <td class="right"><?php echo $assetsincro['description']; ?></td>
                                        <td class="right"><?php echo $assetsincro['model']; ?></td>
                                        <td class="right"><?php echo $assetsincro['serial_number']; ?></td>
                                        <td class="right"><?php echo $fv.' '.$lv; ?></td>
                                       
                                        
                                       
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
<!--/////////////////Attendance////////////////////////////-->
<!-- Modal -->
<div id="myModalattendence" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">My Attendance</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <div class="bg-white shadow" style="width: 100%;" >
                            <nav class="horizontal-menu compact">
                                <ul>
                                    <li>
                                        <a class=" " href=""><i class="fg-blue"></i>&nbsp;Week</a>
                                    </li>
                                    <li>
                                        <a class=" " href=""><i class="fg-blue"></i>&nbsp;Month</a>
                                    </li>

                                </ul>
                            </nav>
                        </div>

                        <div class="" id="notifing">
                            <table class="table">
                                <thead class="shadow">
                                    <tr>


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
$select_asset = mysql_query("SELECT * FROM tbl_attendence WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'") or die(mysql_error());
while ($roww = mysql_fetch_array($select_asset)) {
    $emp_file_no = $roww['emp_file_no'];
    $time_in = $roww['time_in'];
    $time_out = $roww['time_out'];
    $date1 = $roww['date1'];
    $time_spend = $roww['time_spend'];
    $notification = $roww['notification'];
    $remark = $roww['remark'];
    $time_set = "09:00";
    ?>
                                        <tr class="<?php echo $notification; ?>">
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
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!--//////////////////////End Attendence//////////////////////////////-->

<!--/////////////////Attendance////////////////////////////-->
<!-- Modal -->
<div id="manageleave" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Leave Management</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <div id="show_message">
                            <div id="action_delete">

                            </div>
                            <div class="" style="width:100%;">
                                <table class="table">
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
$select_asset = mysql_query("SELECT * FROM tbl_leaves WHERE hod_email='$email' OR fs_email='$email'") or die(mysql_error());
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
                                                    <nav class="vertical-menu compact">
                                                        <ul>
                                                            <li>
                                                                <a class=" dropdown-toggle" href="#"></a>
                                                                <ul class="dropdown-menu" data-role="dropdown">
                                                                    <li><a href="#" onclick="approved('authorized/usersystem/leave_approved.php?leave_id=<?php echo $leave_id; ?>&requiredemail=<?php echo $email; ?>')"  data-toggle="modal" data-target="#approve"><i class="icon-user-2"></i>&nbsp;Approve</a></li>
                                                                    <li><a href="#" onclick="rejection('authorized/usersystem/leave_management.php?leave_id=<?php echo $leave_id; ?>&requiredemail=<?php echo $email; ?>')"  data-toggle="modal" data-target="#reject"><i class="icon-user-3 fg-green"></i>&nbsp;Reject</a></li>

                                                                </ul>
                                                            </li>          
                                                        </ul>
                                                    </nav>
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
                </div>
            </div>
            <!---------------------end window------------------>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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
                                                <input name="req_title" placeholder="This field is Mandatory"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            </div>
                                        </td>

                                        <td style="width:50%"> 

                                            <div class="form-group">
                                                <label for="sel1">Head of Department:</label>
                                                <select class="form-control" id="sel1" name="hod_sel">
                                                    <option value="">Select Head of department</option>
<?php
$selc_hod = mysql_query("SELECT * FROM tbl_assign_to_department WHERE position_id=1") or die(mysql_error());
while ($wote = mysql_fetch_array($selc_hod)) {
    $emply_ids = $wote['emp_file_no'];

    $show_contacts = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emply_ids'") or die(mysql_error());
    $show_email = mysql_fetch_array($show_contacts);
    $hod_email = $show_email['email'];

    $accinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emply_ids'")or die(mysql_error());
    $acc = mysql_fetch_array($accinfo);
    $facc = $acc['first_name'];
    $lacc = $acc['surname'];
    ?>
                                                        <option value="<?php echo $hod_email; ?>"><?php echo $facc . ' ' . $lacc; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="width:50%">
                                            <div class="form-group">
                                             <select class="form-control"  onchange="showitem(this.value)"  name="">
                                                <option value="" >---Select you material</option>
<?php
$sparenam = mysql_query("SELECT DISTINCT part_common_name from  tbl_spare_parts ORDER BY part_common_name") or die(mysql_error());
while ($rowing = mysql_fetch_array($sparenam)) {
    $sparename = $rowing['part_common_name'];
    $emp_idd = $_SESSION["emp_file_no"];
    ?>
                                                <option value="<?php echo $sparename.'@'.$emp_idd; ?>"    ><?php echo $sparename; ?></option>
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
                                <thead><tr>

                                        <th>No</th>
                                        <th>Item</th>
                                        <th>Specification</th>
                                        <th>Description</th>                                            
                                        <th>Quantity</th>                                                                                     
                                        <th>Units</th>
                                        <th>Department</th>

                                        <th></th>
                                    </tr></thead>
                                <tbody  style="font-size:9px" id="onyeshaitem">

                                   <!--weka mambo sawa mkuuu-->

                                </tbody>
                            </table>



                            <button type="button" id="add-invoice-row"  class="btn btn-success"   >
                                <span  aria-hidden="true"></span> + add new row&nbsp;
                            </button>
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
$accesstore = $_SESSION['store_access'];

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

                                if ($hod_email == $emails) {

                                    $sst = mysql_query("SELECT * FROM tbl_request_spare where hod_email='$hod_email' ORDER BY request_id DESC") OR die(mysql_error());
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
                                            <td class="right"><a href="#"><?php echo $fm . ' ' . $lm; ?></a></td>
                                            <td class="right"><?php echo $wst['hod_status']; ?></td>
                                            <td class="right"><?php echo $wst['store_status']; ?></td>                                                                      
                                            <td class="right">
                                                <ul class="showlist">

                                                    <li><a href="?action=process_request&view_request=<?php echo $request_ids; ?>">View</a></li>

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
                <h5 class="modal-title">Cash Request</h5>
            </div>
            <div class="modal-body">
                <form  class="form-horizontal" action=""  method="post">
                    <input type="text" name="rquest" value="<?php echo $_SESSION["emp_file_no"]; ?>" hidden="">
                    <div class="row" >
                        <div class="col-lg-12">
                            <table class="table table-striped table-hover bordered">
                                <tbody>
                                    <tr>
                                        <td style="width:100%">

                                            <input name="pname" placeholder="Project Number(*This field used only for Project Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
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

                                            <input name="cname" placeholder="Company Name(*This field used only for Proformal invoice Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:50%"> 

                                            <input name="invnumber" placeholder="Invoice Number(*This field used only for Proformal invoice Request)"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12">


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
                                            <input name="text"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:39%">
                                            <input name="details[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td> 

                                        <td style="width:15%">
                                            <input name="price[]" id="pric" onkeyup="calc()" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>

                                        <td style="width:10%">
                                            <input name="quant[]" id="quantit" onkeyup="calc()" value="1"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:10%">
                                            <input name="unit[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
<!--                                         <td style="width:16%">
                                            <input name="total[]" id="amounts" class="form-control  editable"  aria-describedby="sizing-addon1"   type="number">
                                        </td> -->
                                        <td style="width:5%">

                                        </td>
                                    </tr>
                                    <tr id="add">
                                        <td style="width:5%">
                                            <input name="text"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:39%">
                                            <input name="details[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td> 
                                        <td style="width:15%">
                                            <input name="price[]" id="pric" onkeyup="calc()" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>

                                        <td style="width:10%">
                                            <input name="quant[]" id="quantit" onkeyup="calc()" value="1"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>
                                        <td style="width:10%">
                                            <input name="unit[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

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

<div id="my_request" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Cash Request History</h4>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <div class="col-lg-12">
                     <table   id="table5" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                    $ids=$_SESSION["emp_file_no"];
                                    $cashlist = mysql_query("SELECT * FROM cash_request where request_by='$ids'") or die(mysql_error());
                                    while ($roww = mysql_fetch_array($cashlist)) {
                                        $request_date = $roww['request_date'];
                                        $request_by = $roww['request_by'];
                                        $approved_by_status = $roww['approved_by_status'];
                                        $received_by_status = $roww['received_by_status'];
                                        $cash_id = $roww['cash_id'];
                                        $identificationnumber='SSWRQ'.sprintf("%04d",$cash_id);
                                        $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_id' ORDER BY reference LIMIT 1") or die(mysql_error());
                                        $rs = mysql_fetch_array($trcc);
                                        $detail=$rs['detail'];
                                        $tss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'") or die(mysql_error());
                                        $jstt = mysql_fetch_array($tss);
                                        ?>
                                        <tr>
                                            <td class="right">
                                                 <?php
                                                if($_SESSION["emp_file_no"]){
                                                ?>
                                                <a href="?action=view_cash_request&View_cash=<?php echo $cash_id; ?>">View</a>
                                                <?php
                                                }
                                                ?>
                                                 
                                            </td>
                                            <td class="right"><?php echo $identificationnumber;?></td>
                                            <td class="right"><?php echo $jstt['first_name'] . ' ' . $jstt['surname']; ?></td>
                                            <td class="right"><?php echo $request_date;?></td>
                                             <td class="right"><?php echo $approved_by_status;?></td>
                                             <td class="right"><?php echo $received_by_status;?></td>
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
                                        <td class="right"><a href="#"><?php echo $view; ?></a></td>
                                        <td class="right"><?php echo $ws['request_date']; ?></td>
                                        <td class="right"><?php echo $fm . ' ' . $lm; ?></td>
                                        <td class="right"><?php echo $ws['hod_status']; ?></td>
                                        <td class="right"><?php echo $ws['store_status']; ?></td>
                                        <td class="right">


                                            <ul class="showlist">

                                                <li><a href="?action=view_edit_request&requester_action=<?php echo $request_idd; ?>">View</a></li>

                                                <li><a href="?action=delete_request_item&items_id=<?php echo $request_idd; ?>" data-confirm="Are you sure to delete this item?" id="delete">Delete</a></li>

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
                <!--        <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>