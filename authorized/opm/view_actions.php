<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once 'authorized/db.php';
$messaged='';
$aids = $_GET['aids'];
$pp = mysql_query("SELECT * FROM tbl_action_list where sn='$aids'") or die(mysql_error());
$rowr = mysql_fetch_array($pp);
$opm_id = $rowr['opm_id'];
$Action = $rowr['Action'];
$Requirements = $rowr['Requirements'];
$material_number = $rowr['material_number'];
 $gtt=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id' AND Updatee!='Closed'") or die(mysql_error());
  $ko=  mysql_num_rows($gtt);
  if($ko>0){
      $makestatus='On Progress';
  }
  else {
     $makestatus='Complete'; 
}
if(empty($material_number)){
    $links='Null';
}
 else {
    $links='<ul class="pagination" ><li><a target="_blank" href="user_accounts.php?action=view_edit_request&requester_action='.$material_number.'">View Material</a></li></ul>';
}

$purchase = mysql_query("SELECT * FROM tbl_operational_monitor where opm_id='$opm_id'") or die(mysql_error());
$row = mysql_fetch_array($purchase);
$Description_of_Finding = $row['Description_of_Finding'];
$key_owner = $row['key_owner'];

$pw = mysql_query("SELECT * FROM tbl_action_list where sn='$aids'") or die(mysql_error());

$tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
$rows = mysql_fetch_array($tbl_customer);
$first_name = $rows['first_name'];
$surname = $rows['surname'];


if(isset($_POST['submit_sn'])){
    $namefile='';
    $updates=$_POST['updates'];
    $remarks=$_POST['remarks'];
    $date=$_POST['date'];
    $status=$_POST['status'];
    $dates=$_POST['date'];
    $aids = $_GET['aids'];
    $opdd=$_POST['opdss'];
    
    $target_dir = "attachments/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $namefile=$_FILES["file"]["name"];
    }
    

    
    $myas=  mysql_query("INSERT INTO `tbl_action_update`(`updatee`,`remarks`,dates,`sn`,attachment) VALUES ('$updates','$remarks','$dates','$aids','$namefile')") or die(mysql_error());
    $myass=  mysql_query("UPDATE tbl_action_list SET updatee='$status' WHERE sn='$aids'") or die(mysql_error());
    
    
        if($status=='Closed'){
    
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
//    $itemz=  mysql_query("SELECT * FROM tbl_action_list WHERE sn='$aids'") or die(mysql_error());
//    $W=  mysql_fetch_array($itemz);
//    $Action=$W['Action'];
//    $Requirements=$W['Requirements'];
//    $Responsible=$W['Responsible'];
//    $Start_Date=$W['Start_Date'];
//    $End_Date=$W['End_Date'];
//    $Updatee=$status;
//    $Remarks=$status;
    $reportdate=$W['reportdate'];
//    $Execution_date=date("Ymd");
//    $iu= mysql_query("INSERT INTO `tbl_action_list_report`(`sn`,`Action`, `Requirements`, `Responsible`, `Start_Date`, `Execution_date`, `End_Date`, `Updatee`, `Remarks`, `reportdate`) "
//            . "VALUES ('$aids','$Action','$Requirements','$Responsible','$Start_Date','$Execution_date','$End_Date','$Updatee','$Remarks','$reportdate')") or die(mysql_error());
 /////////////////////////////////////////////////////////Emails config//////////////////////////////////////////////////////////////////////////
    $itemzz=  mysql_query("SELECT * FROM tbl_action_list WHERE dependence='$aids'") or die(mysql_error());
    $Wx=mysql_fetch_array($itemzz);
    $d1=date('Y-m-d',strtotime($Wx['Start_Date']));
    $d2=date('Y-m-d',strtotime($Wx['End_Date']));
    $date1=  strtotime($d1);
    $date2=  strtotime($d2);
    $n=($date2-$date1)/(60*60*24);
    $first=date('Y-m-d');
    $sec=date("Y-m-d",strtotime($first.'+' .$n .'days'));
    $rdate=  date("Ymd",strtotime($sec));
    $myass=  mysql_query("UPDATE tbl_action_list SET Start_Date='$first',`End_Date`='$sec',`reportdate`='$rdate' WHERE dependence='$aids'") or die(mysql_error());
 
    }          
 else {
        
    }
    
     /////////////////////////////////////////////////////////Emails config////////////////////////////////////////
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
   
      $en = mysql_query("SELECT * FROM tbl_operational_monitor where opm_id='$opdd'") or die(mysql_error());
$low = mysql_fetch_array($en);
        $Description_of_Finding = $low['Description_of_Finding'];
                $key_owner = $low['key_owner'];
                $opm_idz = $low['opm_id'];
                
                
                $tbl_cz = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$key_owner'") or die(mysql_error());
                $rez = mysql_fetch_array($tbl_cz);
                $owners= $rez['email'];
                
                
                
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
                $jinalake=$first_name.' '.$surname;
                
                         $gt=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_idz' AND sn='$aids'") or die(mysql_error());
            while ($ab = mysql_fetch_array($gt)) {
                $emplid=$ab['Responsible'];
                
                $tbl_customerzz = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$emplid'") or die(mysql_error());
                $ree = mysql_fetch_array($tbl_customerzz);
                $f = $ree['first_name'];
                $s = $ree['surname'];
                $yy=$f.' '.$s;
                
                $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emplid'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $addresses[] = $de['email'];
            }
         $too = implode(", ", $addresses);
              
          $emailing = $owners;
                    $to = $emailing;
                    $subject = $Description_of_Finding;
                    $from = 'sas@sincrositewatch.com';
                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Create email headers
                    $headers .= 'From: ' . $from . "\r\n" .
                            'Reply-To: ' . $from . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                    // Compose a simple HTML email message
                    $message = '<html>';
                    $message.='<body>';
                    $message.='<head>';
                    $message.=$css;
                    $message.='</head>';
                    $message .= '<p style="text-bold;">Dear Team,</p>';
                    $message .= '<p style="">'.$yy.' has update its action '.$Action.' on the task of '.$Description_of_Finding.' as per below table.</p>';  
                    $message .='<table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>sn</th>
                            <th>Action</th>
                            <th>Requirements</th>                            
                            <th>Responsible</th>
                            <th>Start</th> 
                            <th>Finish</th> 
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody>';
                       $pur=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_idz'") or die(mysql_error());
            $j=1;
            while ($QW = mysql_fetch_array($pur)) {
                $Action = $QW['Action'];
                $Requirements = $QW['Requirements'];
                $sn= $QW['sn'];               
                $End_Date= $QW['End_Date'];
                $Start_Date= $QW['Start_Date'];                
                $Responsible= $QW['Responsible'];
                $Updatee= $QW['Updatee'];
                $tbl_customerz = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $re = mysql_fetch_array($tbl_customerz);
                $first_namee = $re['first_name'];
                $surnamee = $re['surname'];
                $yu=$first_namee.' '.$surnamee;
                      $message.=' <tr>
                                <td class="product">'.$j++.'</td>
                                    <td class="product">'.$Action.'</td>
                                <td class="price">'.$Requirements.'</td>
                                <td class="price">'.$yu.'</td>
                                <td class="product">'.$Start_Date.'</td>                                 
                                <td class="price">'.$End_Date.'</td>
                                <td class="product">'.$Updatee.'</td>     
                            </tr>';
  }
     $message .= '</tbody>
                </table>';
     $message .='<br>';
     $message .='<table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>sn</th>
                            <th>Updates</th>
                            <th>Remarks</th>                            
                            <th>Date</th>                           
                        </tr>
                    </thead>
                    <tbody>';
     $puri=mysql_query("SELECT * FROM tbl_action_update where sn='$aids'") or die(mysql_error());
            $jj=1;
            while ($rowr = mysql_fetch_array($puri)) {
                $updatee = $rowr['updatee'];
                $remarks = $rowr['remarks'];
                $dates= $rowr['dates'];
                
                $message.=' <tr>
                                <td class="product">'.$jj++.'</td>
                                    <td class="product">'.$updatee.'</td>
                                <td class="price">'.$remarks.'</td>
                                <td class="price">'.$dates.'</td>     
                            </tr>';
                
            }
     $message .= '</tbody>
                </table>';
     
                    $message .= '<p style="">Regards,</p>';
                    $message .= '<p style="">sas(Sincro Automation System)</p>';
                    $message .= '<p style=""><br></p>';
                    $message .= '<h2 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h2>';
                    $message .= '</body></html>';
                    // Sending email
                    if (mail($to, $subject, $message, $headers)) {
 
                    } else {
                       
                    }
 /////////////////////////////////////////End of email//////////////////////////////////////////////////////////
    
    
    
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

        $emailing = $hod_sel . ',joaqim@sincrositewatch.com';
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
                $aids = $_GET['aids'];
                $updatelink=  mysql_query("UPDATE tbl_action_list SET material_number='$request_id' WHERE sn='$aids'") or die(mysql_error());

                //////////////////////////////////////////////////////////
                for ($i = 0; $i < sizeof($itemm); $i++) {
//                if( !isset($dueDate[$i]) ) $dueDate[$i] = 'NULL' ;


                    $insert = mysql_query("INSERT INTO request_item_list( `item`, `specification`, `model`, `partnumber`, `manufacture`, `description`, `department`, `quantity`,`unit`, `request_id`)"
                            . "values('$itemm[$i]','$spec[$i]','$model[$i]','$P[$i]','$man[$i]','$desc[$i]','$departmentt[$i]','$quantity[$i]','$units[$i]','$request_id')") or die(mysql_error());
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


if(isset($_GET['delete'])){
    $aidss=$_GET['delete'];
    $delete_update=mysql_query("delete from tbl_action_update where sn='$aidss'") or die(mysql_error());
}

?>

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
        <div class="col-lg-12">
       <?php
       echo $messaged;
       ?>
    </div>
<div class="col-lg-12">
    <br>
    <div class = "well well-sm"><strong>Description of Finding:&nbsp;</strong><?php echo $Description_of_Finding; ?></div>
    <div class = "well well-sm"><strong>Key Owner:&nbsp;</strong><?php echo $first_name . ' ' . $surname; ?></div>
    <div class = "well well-sm"><strong>Action:&nbsp;</strong><?php echo $Action; ?></div>
    <div class = "well well-sm"><strong>Requirements:&nbsp;</strong><?php echo $Requirements; ?></div>
    <div class = "well well-sm"><strong>Status:&nbsp;</strong><?php echo $makestatus; ?></div> 
    <div class = "well well-sm"><strong>Material Requesition:&nbsp;</strong>
        <?php echo $links;?>
    </div> 
</div>

<div class="col-lg-12">
    <table class="table table-striped table-bordered" cellspacing="0"  >
        <thead>
            <tr>
                <th>sn</th>
                <th>Updates</th>
                <th>Remarks</th>
                <th>Date</th>
                <th>Attachment</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $pur=mysql_query("SELECT * FROM tbl_action_update where sn='$aids'") or die(mysql_error());
            $j=1;
            while ($row = mysql_fetch_array($pur)) {
                $updatee = $row['updatee'];
                $remarks = $row['remarks'];
                $sn= $row['sn'];
                $dates= $row['dates'];
                 $attachment= $row['attachment'];
                
                

                
                ?>
                <tr>
                    <td>
                        <a href=""><?php echo $j++; ?></a>
                    </td>
                    <td>
                        <a href=""><?php echo $updatee; ?></a>
                    </td>
                    <td>
                        <a href=""><?php echo $remarks; ?></a>
                    </td>
                    <td>
                        <a href=""><?php echo $dates; ?></a>
                    </td>
                    <td>
                        <a href="attachments/<?php echo $attachment;?>"><?php echo $attachment; ?></a>
                    </td>
                    <td>
                        <a href="?action=view_action&aids=<?php echo $aids;?>&delete=<?php echo $sn;?>">Delete</a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>

        
    </table>
</div>
<div class="col-lg-12">
<form  class="form-horizontal" action=""  method="post" enctype="multipart/form-data">
<div class="col-lg-6">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Update:</span></span>
        <input name="updates"  id="product_name" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">
        <input name="opdss"  value="<?php echo $opm_id;?>" id="product_name" class="form-control editable" placeholder=""   aria-describedby="sizing-addon1" type="hidden">
    </div>
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Remarks:</span></span>
        <input name="remarks" id="product_name"   class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-6">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Date:</span></span>
        <input name="datee"  id="product_name" class="form-control editable" placeholder=""  value="<?php echo $st = date("d.m.Y"); ?>" aria-describedby="sizing-addon1" type="text" disabled="">
        <input name="date"  id="product_name" class="form-control editable" placeholder=""  value="<?php echo $st = date("d.m.Y"); ?>" aria-describedby="sizing-addon1" type="hidden">

    </div>
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Status:</span></span>
        <select class="form-control" name="status" id="fs">
            <option value="On Progress">On Progress</option>
             <option value="Closed">Closed</option>
        </select>

    </div>
</div>
    <div class="col-lg-6">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Attachment</span></span>
        <input name="file" type="file"  id="product_name" class="form-control editable" placeholder=""   aria-describedby="sizing-addon1">
       

    </div>
    
</div>
    <div class="col-lg-12">
<br>
                            <button type="submit" name="submit_sn" class="btn btn-success" style="color:white"><i class="fa fa-save"></i>&nbsp;Save Data</button>
<hr>
    </div>
    </form>
</div>
    
   

    <div class="col-lg-12">
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
                                                    <option value="">Select HOD</option>
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
    
       <div class="col-lg-12">
                <br><br>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Responsive Pure -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6960259539797167"
     data-ad-slot="5444808775"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
            </div> 
