<?php
if (isset($_GET['requester_action'])) {
    if (isset($_POST['submit_change'])) {
        $req_title = $_POST['req_title'];
        $hod_sel = $_POST['hod_sel'];
        $list_id = $_POST['list_id'];
        $request_id = $_POST['request_id'];
        $desc = $_POST['desc'];
        $quant = $_POST['quant'];
        $units = $_POST['units'];
        $item = $_POST['item'];
        $spec = $_POST['spec'];
        $department = $_POST['department'];
        $updatee = mysql_query("UPDATE tbl_request_spare SET hod_email='$hod_sel',Request_title='$req_title' WHERE request_id='$request_id'") or die(mysql_error());
        for ($i = 0; $i < sizeof($item); $i++) {
            $updates = mysql_query("UPDATE request_item_list SET item='$item[$i]',specification='$item[$i]',description='$desc[$i]',department='$department[$i]',quantity='$quant[$i]',"
                    . "unit='$units[$i]' WHERE list_id='$list_id[$i]'") or die(mysql_error());
        }
        $message = '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Thank you!Your items has successfully Changed!</strong>
</div>';
    }   

       if (isset($_GET['items_id'])) {
    $items_id = $_GET['items_id'];
    $str = mysql_query("delete  from request_item_list where list_id='$items_id'") or die(mysql_error());
            $message = '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Thank you!Your items has successfully Changed!</strong>
</div>';
    } 
    

    if (isset($_POST['submit_request'])) {
        $hod_sel = $_POST['hod_sel'];
        $req_title = $_POST['req_title'];
        if (!empty($hod_sel) AND ! empty($req_title)) {
            $descr = $_POST['desc'];
            $item = $_POST['item'];
            $units = $_POST['units'];
            $spec = $_POST['spec'];
            $hod_sel = $_POST['hod_sel'];
            $req_title = $_POST['req_title'];
            $quantity = $_POST['quant'];
            $departmentt = $_POST['department'];
            $request_date = date("d-m-Y H:i:s");
            $requester = $_SESSION["emp_file_no"];
            $departments = mysql_query("SELECT * FROM tbl_department WHERE department_id='$departmentt'") or die(mysql_error());
            $jinaladep = mysql_fetch_array($departments);
            $department = $jinaladep['department_name'];

            $show_position_hod = mysql_query("SELECT * FROM tbl_assign_to_department WHERE department_id='$departmentt' AND position_id=1") or die(mysql_error());
            $hod_id = mysql_fetch_array($show_position_hod);
            $hod_idd = $hod_id['emp_file_no'];

            $show_contacts = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$hod_idd'") or die(mysql_error());
            $show_email = mysql_fetch_array($show_contacts);
            $hod_email = $show_email['email'];
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

            $emailing = $hod_email;
            $to = $emailing;
            $subject = 'Material Request Notification!';
            $from = 'sas@sincrositewatch.com';
            $datee = date("M d Y");

            if (!empty($item)) {

                $customers = mysql_query("INSERT INTO tbl_request_spare(`request_date`, `requester`, `store_email`, `hod_email`, `store_status`, `hod_status`,Request_title)"
                        . "VALUE('$request_date','$requester','$store_email', '$hod_sel','$store_status', '$hod_status','$req_title')") or die(mysql_error());


                if ($customers) {
                    ////////////////////////////////////
                    $select_custid = mysql_query("SELECT * FROM tbl_request_spare ORDER BY request_id DESC") or die(mysql_error());
                    $Q = mysql_fetch_array($select_custid);
                    $request_id = $Q['request_id'];

                    //////////////////////////////////////////////////////////
                    for ($i = 0; $i < sizeof($item); $i++) {
//                $subtotal = $quantity[$i] * $amount[$i];
                        $insert = mysql_query("INSERT INTO request_item_list( `item`, `specification`, `description`, `department`,quantity,`unit`,request_id)"
                                . "values('$item[$i]','$spec[$i]','$descr[$i]','$department','$quantity[$i]','$units[$i]','$request_id')") or die(mysql_error());
                    }

//////////////////////////////SEND EMAILS
                    if (!empty($hod_sel)) {
                        $emailing = $hod_sel;
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
    }
    ?>

    <div class="row">
        <div class="col-lg-12">                                     
            <ul class="pagination">
                <li>
                    <a href="sas.sincrositewatch.com/user_accounts.php" class="btn btn-default"><i class="fa fa-home"></i>&nbsp;Home </a>
                </li>
                <li >
                    <a class="btn btn-default" href="#"  data-toggle="modal" data-target="#spare_request"><i class="fa fa-arrow-down"></i>&nbsp; Request Spare</a>
                </li>
            </ul>    
        </div>
    </div>

    <form  id="" action="?action=view_edit_request&requester_action=<?php echo $_GET['requester_action']; ?>"  method="post">

        <div class="row" >
            <div class="col-lg-12">
    <?php
    echo $message;
    ?>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped table-hover bordered">
                    <tbody>
    <?php
    $request_id = $_GET['requester_action'];
    $sel = mysql_query("SELECT * FROM tbl_request_spare WHERE request_id='$request_id'") OR die(mysql_error());
    $show_requestion = mysql_fetch_array($sel);
    $Request_title = $show_requestion['Request_title'];
    $hod_email = $show_requestion['hod_email'];
    $selects = mysql_query("SELECT * FROM tbl_contact WHERE email='$hod_email'") or die(mysql_error());
    $titus = mysql_fetch_array($selects);
    $idnumber = $titus['emp_file_no'];
    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$idnumber'")or die(mysql_error());
    $yunis = mysql_fetch_array($pinformation);
    $fm = $yunis['first_name'];
    $lm = $yunis['surname'];
    ?>
                        <tr>
                            <td style="width:50%">
                                <div class="form-group">
                                    <label for="sel1">Request Title:</label>
                                    <input name="req_title" value="<?php echo $Request_title; ?>" placeholder="This field is Mandatory"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                </div>
                            </td>

                            <td style="width:50%"> 

                                <div class="form-group">
                                    <label for="sel1">Head of Department:</label>
                                    <select class="form-control" id="sel1" name="hod_sel">
                                        <option value="<?php echo $hod_email; ?>"><?php echo $fm . ' ' . $lm; ?></option>
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
                    </tbody>
                </table>

            </div>

            <div class="col-lg-12">

            </div>
            <div class="col-lg-12">

                <table class="table table-striped table-hover bordered" id="invoice-table">
                    <thead><tr>

                            <th>No</th>
                            <th>Item</th>
                            <th>Specification</th>
                            <th>Model</th>
                            <th>Part Number</th>
                            <th>Description</th>                                            
                            <th>Quantity</th>                                                                                     
                            <th>Units</th>
                            
                            <th></th>
                        </tr></thead>
                    <tbody  style="font-size:9px">

    <?php
    $j = 1;
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    while ($show_item = mysql_fetch_array($att)) {
        $list_id = $show_item['list_id'];
        $item = $show_item['item'];
        $ref_no=$show_item['ref_no'];
        
        $mt = mysql_query("SELECT * from tbl_spare_parts WHERE part_id='$ref_no'") or die(mysql_error());
        $mtl = mysql_fetch_array($mt);
        $specc=$mtl['specification'];
        $partz=$mtl['part_number'];
          $modelz=$mtl['model'];
          $descz=$mtl['description'];
        
        $specification = $show_item['specification'];
        if (empty($specification)) {
            $specification = 'Null';
        }
        $description = $show_item['description'];
        $unit_price = $show_item['unit_price'];
        $quantity = $show_item['quantity'];
        $unit = $show_item['unit'];
        $request_id = $show_item['request_id'];
        $department = $show_item['department'];
        ?>
                            <tr>

                                <td style="width:5%">
                                    <input name="text"  id="buying_price" class="form-control amount editable" value="<?php echo $j++; ?>"  aria-describedby="sizing-addon1" type="text">
                                    <input   name="list_id[]"   value="<?php echo $list_id; ?>"  type="text" hidden="">
                                    <input   name="request_id"   value="<?php echo $request_id; ?>"  type="text" hidden="">
                                </td>
                                <td style="width:28%">

                                    <select class="form-control"  id="kind_id" name="item[]">
                                        <option value="<?php echo $item; ?>" ><?php echo $item; ?></option>
        <?php
        $sparenam = mysql_query("SELECT * from tbl_spare_parts ORDER BY part_common_name") or die(mysql_error());
        while ($rowing = mysql_fetch_array($sparenam)) {
            $sparename = $rowing['part_common_name'];
            $part_number = $rowing['part_number'];
            $specificationz = $rowing['specification'];
             $descriptionz = $rowing['description'];
            ?>
                                            <option value="<?php echo $sparename; ?>"><?php echo $sparename; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>                                           
                                <td style="width:27%"> 
                                    <select class="form-control"  id="kind_id" name="spec[]">
                                        <option value="<?php echo $specc; ?>"><?php echo $specc; ?></option>
                                        <?php
                                        $ppp = mysql_query("SELECT * from tbl_spare_parts ORDER BY specification") or die(mysql_error());
                                        while ($show_spec = mysql_fetch_array($ppp)) {
                                            $specifications = $show_spec['specification'];
                                            ?>
                                            <option value="<?php echo $specifications; ?>"><?php echo $specifications; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
 <td style="width:8%">
                                    <input name="" id="buying_price" class="form-control amount editable" value="<?php echo $modelz; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:8%">
                                    <input name="" id="buying_price" class="form-control amount editable" value="<?php echo $partz; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:26%">
                                    <input name="desc[]" id="buying_price" class="form-control amount editable" value="<?php echo $descz; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                
                                <td style="width:7%">
                                    <input name="quant[]" id="buying_price" class="form-control amount editable" value="<?php echo $quantity; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:7%">
                                    <input name="units[]" id="buying_price" class="form-control amount editable" value="<?php echo $unit; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                              
                                <td style="width:5%">
                                   
<a href="?action=view_edit_request&items_id=<?php echo $list_id; ?>&requester_action=<?php echo $request_id; ?>" data-confirm="Are you sure to delete this item?" id="delete" class="cross-delete btn btn-success fg-white" >x</a> 
<!--                                    <a href="?action=requester_action&items_id=<?php echo $list_id; ?>&request_id=<?php echo $request_id; ?>" data-confirm="Are you sure to delete this item?" id="delete" class="cross-delete btn btn-success fg-white" >x</a> -->
                                </td>

                            </tr>
    <?php } ?>
                    </tbody>
                </table>
                <button type="submit"  name="submit_change" class="btn btn-success" style="color:white">Submit Changes</button>

            </div>
        </div>
    </form>

    <?php
} 


else {
    echo 'no file found';
}
?>



<div id="spare_request" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">REQUEST FORM</h5>
            </div>
            <div class="modal-body">
                <div id="kubwaaa">

                </div>

                <form   action="user_accounts.php"  method="post">
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
                                </tbody>
                            </table>

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
                                <tbody  style="font-size:9px">
                                    <tr>

                                        <td style="width:5%">
                                            <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:25%">
<!--                                            <input name="item[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">-->
                                            <select class="form-control"  id="kind_id" name="item[]">
                                                <option value="" >----Select---</option>
<?php
$sparenam = mysql_query("SELECT * from tbl_list_sparetools ORDER BY sparename") or die(mysql_error());
while ($rowing = mysql_fetch_array($sparenam)) {
    $sparename = $rowing['sparename'];
    ?>
                                                    <option value="<?php echo $sparename; ?>"><?php echo $sparename; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>                                           
                                        <td style="width:20%">
                                            <!--<input name="spec[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">-->
                                            <select class="form-control"  id="kind_id" name="spec[]">
                                                <option value="">----Select---</option>
<?php
$ppp = mysql_query("SELECT * from tbl_list_sparetools  where specification<>'' ORDER BY specification") or die(mysql_error());
while ($show_spec = mysql_fetch_array($ppp)) {
    $specifications = $show_spec['specification'];
    ?>
                                                    <option value="<?php echo $specifications; ?>"><?php echo $specifications; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>

                                        <td style="width:22%">

                                            <input name="desc[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:7%">
                                            <input name="quant[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:7%">
                                            <input name="units[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:16%">
                                            <select class="form-control"  id="kind_id" name="department[]">
                                                <option value="">----Select---</option>
<?php
$sp = mysql_query("SELECT * from tbl_department") or die(mysql_error());
while ($ro = mysql_fetch_array($sp)) {
    $departmentname = $ro['department_name'];
    ?>
                                                    <option value="<?php echo $departmentname; ?>"><?php echo $departmentname; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <!--<input name="department[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">-->
                                        </td>
                                        <td style="width:5%">

                                        </td>
                                    </tr>
                                    <tr id="add">
                                        <td style="width:5%">
                                            <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:25%">
                                      <!--                                            <input name="item[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">-->
                                            <select class="form-control"  id="kind_id" name="item[]">
                                                <option value="" >----Select---</option>
<?php
$sparenam = mysql_query("SELECT * from tbl_list_sparetools ORDER BY sparename") or die(mysql_error());
while ($rowing = mysql_fetch_array($sparenam)) {
    $sparename = $rowing['sparename'];
    ?>
                                                    <option value="<?php echo $sparename; ?>"><?php echo $sparename; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>                                           
                                        <td style="width:20%">
                                            <!--<input name="spec[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">-->
                                            <select class="form-control"  id="kind_id" name="spec[]">
                                                <option value="">----Select---</option>
<?php
$ppp = mysql_query("SELECT * from tbl_list_sparetools  where specification<>'' ORDER BY specification") or die(mysql_error());
while ($show_spec = mysql_fetch_array($ppp)) {
    $specifications = $show_spec['specification'];
    ?>
                                                    <option value="<?php echo $specifications; ?>"><?php echo $specifications; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>

                                        <td style="width:22%">

                                            <input name="desc[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:7%">
                                            <input name="quant[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:7%">
                                            <input name="units[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:16%">
                                            <select class="form-control"  id="kind_id" name="department">
                                                <option value="">----Select---</option>
<?php
$sp = mysql_query("SELECT * from tbl_department") or die(mysql_error());
while ($ro = mysql_fetch_array($sp)) {
    $departmentname = $ro['department_name'];
    $department_id = $ro['department_id'];
    ?>
                                                    <option value="<?php echo $department_id; ?>"><?php echo $departmentname; ?></option>

                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <!--<input name="department[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">-->
                                        </td>
                                        <td style="width:5%">

                                            <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
                                        </td>

                                    </tr>


                                </tbody>
                            </table>



                            <button type="button" id="add-invoice-row"  class="btn btn-success"   >
                                <span  aria-hidden="true"></span> + add new row&nbsp;
                            </button>
                            <button type="submit" name="submit_request" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-arrow-right"></i>Submit Your Request</button>

                        </div>
                    </div>
                </form>

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

    if (!empty($Request_title)) {
        $view = $Request_title;
    } else {
        $view = $wekamoja['item'];
    }
    if ($store_status == "Pending") {
        $color = "bg-red";
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

        </div>

    </div>
</div>