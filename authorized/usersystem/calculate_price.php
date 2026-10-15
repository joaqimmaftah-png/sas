<?php
$value='2,350.45';
$bad_symbols = array(",");
$value = str_replace($bad_symbols, "", $value);


echo $value;
?>




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

    $descr = $_POST['desc'];
    $item = $_POST['item'];
    $units = $_POST['units'];
    $spec = $_POST['spec'];
//    $amount = $_POST['amount'];
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

        $customers = mysql_query("INSERT INTO tbl_request_spare(`request_date`, `requester`, `store_email`, `hod_email`, `store_status`, `hod_status`)"
                . "VALUE('$request_date','$requester','$store_email', '$hod_email','$store_status', '$hod_status')") or die(mysql_error());


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

//SEND EMAILS
            if (!empty($emailing)) {
                $emailing = $hod_email;
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

    if (isset($_POST['add_assets'])) {
        $employee_no = $_POST['employeename'];
        $depar_id = $_POST['department_id'];
        $register = $_POST['register'];
        $company_asset = $_POST['assetname'];
        $comment = $_POST['comments'];
        if (!empty($employee_no) && !empty($company_asset)) {

            for ($i = 0; $i < sizeof($company_asset); $i++) {
                $insert = mysql_query("INSERT INTO `tbl_employee_asset`(`asset_name`, `note`, `employe_no`,hod_name,department_id) "
                        . "VALUES ('$company_asset[$i]','$comment[$i]','$employee_no','$register','$depar_id')") or die(mysql_error());
            }

            $message = '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull!</strong>
</div>';
        } else {
            $message = '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">Ã—</a>
    <strong>Error!</strong> 
</div>';
        }
    }   
}

    
    if(isset($_POST['cash_request'])){
   
    $details = $_POST['details'];
    $job = $_POST['job'];
    $total = $_POST['total'];
    $rquest = $_POST['rquest'];
    $request_date = date("d-m-Y H:i:s");
    
            $r_equest = mysql_query("INSERT INTO cash_request(`request_by`,`request_date`,`approved_by_status`, `received_by_status`)"
                . "VALUE('$rquest','$request_date','Pending','Pending')") or die(mysql_error());

     if($r_equest){
         
           $st = mysql_query("SELECT * FROM cash_request ORDER BY cash_id DESC") or die(mysql_error());
            $QQ = mysql_fetch_array($st);
            $cash_id = $QQ['cash_id'];
            $refence=$cash_id+1;
    //////////////////////////////////////////////////////////////////////////////////////////
                for ($i = 0; $i < sizeof($details); $i++) {
//                $subtotal = $quantity[$i] * $amount[$i];
                $insert = mysql_query("INSERT INTO cash_request_item(`detail`, `charge_to`, `total`, `reference`)"
                        . "values('$details[$i]','$job[$i]','$total[$i]','$refence')") or die(mysql_error());
            }
            
            
            //SEND EMAILS
            
                $emailing = "joaqim@sincrositewatch.com";
                $to = $emailing;
                $subject = 'Cash Request Notification!';
                $from = 'sas@sincrositewatch.com';
                $jinalamenager='JOAQIM MAFTAH';
                $jinalamwombaji='JOAQIM MAFTAH';
                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // Create email headers

                $headers .= 'From: ' . $from . "\r\n" .
                        'Reply-To: ' . $from . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                // Compose a simple HTML email message
                $message = '<html><body>';
                $message .= '<p style="text-bold;">Dear '.$jinalamenager.',</p>';
                $message .= '<p style="">Please kindly review and approve the new Cash Request.You are required to act on this approved immediatly.</p>';
                $message .= '<p style="color:#080;font-size:18px;"><a href="http://sas.sincrositewatch.com/" target="_blank">Click this link to approve or reject the request!</a></p>';
                $message .= '<p style="">Regards,</p>';
                $message .= '<p style="">' . $jinalamwombaji. ' </p>';
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
                $('table').on('click', 'tr a', function (e) {
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
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#add_assets">Add Company Assets</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalattachment">Attachments</a>
            </li>
            <!--                <li>
                                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalcar_issues">Report Car Issues</a>
                            </li>-->

            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalcar_issues">Request Spare</a>
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
                            <a class="" href=""><i class="icon-home fg-blue"></i>&nbsp;PROFILE PICTURE</a>
                        </li>                       
                    </ul>
                </nav>
            </div>
            <div style="width:100%; ">
                <img src="<?php echo $profile_pic; ?>" class="span3" style="width: 100%; height: 213px;">
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
                            <a class="" href=""><i class="icon-calendar fg-blue"></i>&nbsp;Quick Links</a>
                        </li>                       
                    </ul>
                </nav>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <?php
                    if ($access_lever == 8) {
                        ?>
                        <div class="panel-heading">
                            <a  href="?action=stoock" >
                                <span class="h5"><span class="glyphicon glyphicon-menu-down"></span></span> Store Management
                            </a>
                        </div>                   
                        <?php
                    }
                    ?>
                    <div style="height:1px; background-color:rgb(220,220,220)"></div>
                    <div class="panel-heading">
                        <a  href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#manage_asset" >
                            <span class="h5"><span class="glyphicon glyphicon-menu-down"></span></span> Manage Assets
                        </a>
                    </div> 
                    <div style="height:1px; background-color:rgb(220,220,220)"></div>
                    <div class="panel-heading">
                        <a  href="http://daimainfotech.com/project/" target="_blank" class="fg-hover-crimson fg-cobalt"  >
                            <span class="h5"><span class="glyphicon glyphicon-menu-down"></span></span>Project Management
                        </a>
                    </div> 

                    <div style="height:1px; background-color:rgb(220,220,220)"></div>
                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-cash" aria-expanded="false" aria-controls="collapse-stock">
                            <span class="h5"><span class=" icon-folder"></span></span>&nbsp;Cash Request
                        </a>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse-cash" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                        <div class="list-group">
                            <a href="#" data-toggle="modal" data-target="#cash_request" class="list-group-item"><span class=""></span>&nbsp; Request Form</a>

                        </div>
                        <div class="list-group">
                            <a href="#" data-toggle="modal" data-target="#manage_my_request" class="list-group-item"><span class=""></span>&nbsp;My Request</a>

                        </div>
                        <?php
                        if($_SESSION["emp_file_no"]=='SSW 147' OR $_SESSION["emp_file_no"]=='SSW 122'){
                            
                      
                        ?>
                         <div class="list-group">
                            <a  href="#" data-toggle="modal" data-target="#manage_cash_request" class="list-group-item"><span class=""></span>&nbsp;Manage Request</a>

                        </div>
                        <?php
                          }
                        ?>
                    </div>
                    <div style="height:1px; background-color:rgb(220,220,220)"></div>
                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-notes" aria-expanded="false" aria-controls="collapse-stock">
                            <span class="h5"><span class=" icon-folder"></span></span>&nbsp;Appraisal
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

                    <div style="height:1px; background-color:rgb(220,220,220)"></div>
                    <div style="height: 0px;" aria-expanded="true" id="collapse-people" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-people">
                        <div class="list-group">
                            <a href="" class="list-group-item"><span class=" icon-plus"></span> Add Task</a>
                            <a href="" class="list-group-item"><span class="icon-plus"></span> Add An Events</a>
                        </div>
                    </div>

                    <div style="height:1px; background-color:rgb(220,220,220)"></div>

                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-stock" aria-expanded="false" aria-controls="collapse-stock">
                            <span class="h5"><span class="icon-phone"></span></span>&nbsp; Contacts
                            <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse-stock" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                        <div class="list-group">
                            <a href="../../pages/categories" class="list-group-item"><span class="icon-plus"></span>&nbsp; Add Contact</a>

                        </div>
                    </div>
                    <div style="height:1px; background-color:rgb(220,220,220)"></div>

                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-notes" aria-expanded="false" aria-controls="collapse-stock">
                            <span class="h5"><span class=" icon-folder"></span></span>&nbsp; Notes
                            <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse-notes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                        <div class="list-group">
                            <a href="../../pages/categories" class="list-group-item"><span class="icon-plus"></span>&nbsp; Add Notes</a>

                        </div>
                    </div>
                    <div style="height:1px; background-color:rgb(220,220,220)"></div>

                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-news" aria-expanded="false" aria-controls="collapse-stock">
                            <span class="h5"><span class=" icon-newspaper"></span></span>&nbsp; News
                            <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse-news" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                        <div class="list-group">
                            <a href="../../pages/categories" class="list-group-item"><span class="icon-plus"></span>&nbsp; Add News</a>

                        </div>
                    </div>
                    <div style="height:1px; background-color:rgb(220,220,220)"></div>

                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a   href="JOAQIM" aria-expanded="false" aria-controls="collapse-stock">
                            <span class="h5"><span class=" icon-comments-4"></span></span>&nbsp; Updates
                            <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> 
                        </a>
                    </div>
                </div>

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
<!--////-->

<div id="manage_asset" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Add Employee Asset</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <div class="example">
                            <table   id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Employee Name</th> 
                                        <th class="text-left">Asset Name</th>  
                                        <th class="text-left">Comments/Notes</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $department_id = $positions['department_id'];
                                    $select_asset = mysql_query("SELECT * FROM tbl_employee_asset WHERE department_id='$department_id'") or die(mysql_error());
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $asset_name = $roww['asset_name'];
                                        $asset_id = $roww['asset_id'];
                                        $note = $roww['note'];
                                        $employe_no = $roww['employe_no'];
                                        $trc = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employe_no'") or die(mysql_error());
                                        $jst = mysql_fetch_array($trc);
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="" value="<?php echo $asset_id; ?>" onchange="showasset(this.value)"></td>
                                            <td class="right"><?php echo $jst['first_name'] . ' ' . $jst['surname']; ?></td>
                                            <td class="right"><?php echo $asset_name; ?></td>
                                            <td class="right"><?php echo $note; ?></td>
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
                                        <th class="text-left">Remarks</th> 
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
                <h5 class="modal-title">REQUEST FORM</h5>
            </div>
            <div class="modal-body">
                <div id="kubwaaa">

                </div>

                <form   action=""  method="post">
                    <input type="text" name="requester" value="<?php echo $employee_no; ?>" hidden="">
                    <div class="row" >
                        <div class="col-lg-12"></div>
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
                            <button type="submit" name="request_spares" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-arrow-right"></i>Submit Your Request</button>

                        </div>
                    </div>
                </form>

                <div class="row">

                    <table class="table">
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
                                $aa = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_idd'") or die(mysql_error());
                                $bb = mysql_fetch_array($aa);
                                $item = $bb['item'];
                                $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='" . $_SESSION["emp_file_no"] . "'")or die(mysql_error());
                                $yunis = mysql_fetch_array($pinformation);
                                $fm = $yunis['first_name'];
                                $lm = $yunis['surname'];
                                ?>
                                <tr>
                                    <td class="right"><?php echo $j++; ?></td>
                                    <td class="right"><a href="#"><?php echo $item . "..."; ?></a></td>
                                    <td class="right"><?php echo $ws['request_date']; ?></td>
                                    <td class="right"><?php echo $fm . '' . $lm; ?></td>
                                    <td class="right"><?php echo $ws['hod_status']; ?></td>
                                    <td class="right"><?php echo $ws['store_status']; ?></td>
                                    <?php
                                    if (!empty($item)) {
                                        ?>                                
                                        <td class="right">
                                            <form action="?action=view_edit_request" method="POST">
                                                <button type="submit" value="<?php echo $request_idd; ?>" name="requester_action"  class="btn btn-success fg-white" >View</button>
                                            </form>

                                        </td>
                                    <?php } ?>

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


<div id="myModalcar_req" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Manage Request</h5>
            </div>
            <div class="modal-body">
                <div id="kubwaaa">

                </div>
                <form  id="requestform" action=""  method="post">

                </form>
                <?php ?>
                <div class="row" id="onyeshavitu">

                    <table class="table">
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
                            $emp = mysql_query("SELECT * FROM tbl_contact where emp_file_no='$emp_idd'") OR die(mysql_error());
                            $ror = mysql_fetch_array($emp);
                            $emails = $ror['email'];
                            $ss = mysql_query("SELECT * FROM tbl_request_spare where store_email='$emails' OR hod_email='$emails' ") OR die(mysql_error());
                            $wss = mysql_fetch_array($ss);
                            $store = $wss['store_email'];
                            $hod_email = $wss['hod_email'];

                            if ($store == $emails) {

                                $sst = mysql_query("SELECT * FROM tbl_request_spare where  hod_status='Approved' AND store_email='$store'") OR die(mysql_error());
                                while ($wst = mysql_fetch_array($sst)) {
                                    $request_ids = $wst['request_id'];
                                    $requester = $wst['requester'];
                                    $at = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_ids'") or die(mysql_error());
                                    $bt = mysql_fetch_array($at);
                                    $item = $bt['item'];
                                    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
                                    $yunis = mysql_fetch_array($pinformation);
                                    $fm = $yunis['first_name'];
                                    $lm = $yunis['surname'];
                                    ?>
                                    <tr>
                                        <td class="right"><?php echo $j++; ?></td>
                                        <td class="right"><a href="#"><?php echo $item; ?></a></td>                                       
                                        <td class="right"><?php echo $wst['request_date']; ?></td>
                                        <td class="right"><a href="#"><?php echo $fm . ' ' . $lm; ?></a></td>
                                        <td class="right"><?php echo $wst['hod_status']; ?></td>
                                        <td class="right"><?php echo $wst['store_status']; ?></td> 
                                        <?php
                                        if (!empty($item)) {
                                            ?>                                
                                            <td class="right">
                                                <form action="?action=process_request" method="POST">
                                                    <button type="submit" value="<?php echo $request_ids; ?>" name="store_approve"  class="btn btn-success fg-white" >Process Request</button> | 
                                                    <button type="submit" value="<?php echo $request_ids; ?>" name="print" class="btn btn-danger fg-white">View Items</button>
                                                </form>

                                            </td>
                                        <?php } ?>                                   
                                    </tr> 
                                    <?php
                                }
                            }
//   mwisho wa STORE ACCESSFULL                         
                            if ($hod_email == $emails) {

                                $sst = mysql_query("SELECT * FROM tbl_request_spare where store_status='Pending' AND hod_email='$hod_email'") OR die(mysql_error());
                                while ($wst = mysql_fetch_array($sst)) {
                                    $request_ids = $wst['request_id'];
                                    $requester = $wst['requester'];
                                    $at = mysql_query("SELECT * FROM request_item_list WHERE request_id='$request_ids'") or die(mysql_error());
                                    $bt = mysql_fetch_array($at);
                                    $item = $bt['item'];
                                    $pinformation = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$requester'")or die(mysql_error());
                                    $yunis = mysql_fetch_array($pinformation);
                                    $fm = $yunis['first_name'];
                                    $lm = $yunis['surname'];
                                    ?>
                                    <tr>
                                        <td class="right"><?php echo $j++; ?></td>
                                        <td class="right"><a href="#"><?php echo $item; ?></a></td>                                       
                                        <td class="right"><?php echo $wst['request_date']; ?></td>
                                        <td class="right"><a href="#"><?php echo $fm . ' ' . $lm; ?></a></td>
                                        <td class="right"><?php echo $wst['hod_status']; ?></td>
                                        <td class="right"><?php echo $wst['store_status']; ?></td>  
                                        <?php
                                        if (!empty($item)) {
                                            ?>                                
                                            <td class="right">
                                                <form action="?action=process_request" method="POST">
                                                    <button type="submit" value="<?php echo $request_ids; ?>" name="mafath"  class="btn btn-success fg-white" >Process Request</button> | 
                                                    <button type="submit" value="<?php echo $request_ids; ?>" name="print" class="btn btn-danger fg-white">View Items</button>
                                                </form>

                                            </td>
                                        <?php } ?>                                   
                                    </tr> 
                                    <?php
                                }
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


<!-- Modal -->
<div id="add_assets" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Manage Assets</h5>
            </div>
            <div class="modal-body">
                <form   action=""  method="post">
                    <input type="text" name="register" value="<?php echo $_SESSION["emp_file_no"]; ?>" hidden="">
                    <div class="row" >
                        <div class="col-lg-12"></div>

                        <div class="col-lg-12">
                            <table class="table table-striped table-hover bordered">
                                <tbody>
                                    <tr>
                                        <td colspan="4">

                                            <select class="form-control"  id="kind_id" name="employeename">
                                                <option value="" >----Employee Name---</option>
                                                <?php
                                                $department_id = $positions['department_id'];
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
                                            <input type="text" name="department_id" value="<?php echo $department_id; ?>" hidden="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-striped table-hover bordered" id="asset-table">
                                <thead><tr>

                                        <th>No</th>
                                        <th>Asset Name</th>
                                        <th>Comment</th>
                                        <th></th>
                                    </tr></thead>
                                <tbody  style="font-size:9px">

                                    <tr>

                                        <td style="width:5%">
                                            <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:45%">
                                            <input name="assetname[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>                                           
                                        <td style="width:45%">
                                            <input name="comments[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>                                        
                                        <td style="width:5%">

                                        </td>
                                    </tr>
                                    <tr id="add">
                                        <td style="width:5%">
                                            <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:45%">
                                            <input name="assetname[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>                                           
                                        <td style="width:45%">
                                            <input name="comments[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>                           
                                        <td style="width:5%">

                                            <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
                                        </td>

                                    </tr>


                                </tbody>
                            </table>



                            <button type="button" id="add-asset-row"  class="btn btn-success"   >
                                <span  aria-hidden="true"></span> + add new row&nbsp;
                            </button>
                            <button type="submit" name="add_assets" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-arrow-right"></i>Submit Your Request</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------myModalpayroll------------------------------------------->

<!-- Modal -->
<div id="cash_request" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Cash Request</h5>
            </div>
            <div class="modal-body">
                <form   action=""  method="post">
                    <input type="text" name="rquest" value="<?php echo $_SESSION["emp_file_no"]; ?>" hidden="">
                    <div class="row" >
                        <div class="col-lg-12"></div>

                        <div class="col-lg-12">
                           

                            <table class="table table-striped table-hover bordered" id="cash-table">
                                <thead><tr>

                                        <th>No</th>
                                        <th>DETAILS</th>
                                        <th>CHARGE TO:JOB/ACCOUNT</th>
                                        <th>TOTAL (TSHS)</th>
                                        <th></th>
                                    </tr></thead>
                                <tbody  style="font-size:9px">

                                    <tr>

                                        <td style="width:5%">
                                            <input name="text"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            <input name="text"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:45%">
                                            <input name="details[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>                                           
                                        <td style="width:25%">
                                            <input name="job[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>  
                                         <td style="width:20%">
                                            <input name="total[]"  class="form-control amount editable"  aria-describedby="sizing-addon1"   type="number">

                                        </td> 
                                        <td style="width:5%">

                                        </td>
                                    </tr>
                                    <tr id="add">
                                       <td style="width:5%">
                                            <input name="text"  class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                        </td>
                                        <td style="width:45%">
                                            <input name="details[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>                                           
                                        <td style="width:25%">
                                            <input name="job[]"  class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">

                                        </td>  
                                         <td style="width:20%">
                                            <input name="total[]"  class="form-control amount editable"  aria-describedby="sizing-addon1"   type="number">

                                        </td>                         
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
                    <div class="title">Add Employee Asset</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <div class="example">
                            <table   id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                    $cashlist = mysql_query("SELECT * FROM cash_request") or die(mysql_error());
                                    while ($roww = mysql_fetch_array($cashlist)) {
                                        $request_date = $roww['request_date'];
                                        $request_by = $roww['request_by'];
                                        $approved_by_status = $roww['approved_by_status'];
                                        $received_by_status = $roww['received_by_status'];
                                        $cash_id = $roww['cash_id'];
                                        $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_id' ORDER BY reference LIMIT 1") or die(mysql_error());
                                        $rs = mysql_fetch_array($trcc);
                                        $detail=$rs['detail'];
                                        $tss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'") or die(mysql_error());
                                        $jstt = mysql_fetch_array($tss);
                                        ?>
                                        <tr>
                                            <td class="right">
                                                <form action="?action=cash_request" method="POST">
                                                    <button type="submit" value="<?php echo $cash_id; ?>" name="cash_approve"  class="btn btn-success fg-white" >Approve Cash</button> | 
                                                    <button type="submit" value="<?php echo $cash_id; ?>" name="View_cash" class="btn btn-success fg-white">View</button>
                                                </form>
                                                
                                            </td>
                                            <td class="right"><?php echo $cash_id;?></td>
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
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!--/////////////////Attendance////////////////////////////-->

