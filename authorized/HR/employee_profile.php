<?php
$message = "";
if (isset($_POST['benefits'])) {
    $employee_no = $_POST['employee_no'];
    $name = $_POST['name'];
    $benefits_id = $_POST['benefits_id'];
    $amount = $_POST['amount'];
    $figuretype = $_POST['figuretype'];
    $select_name = mysql_query("SELECT * FROM tbl_benefits_category WHERE benefit_id='$benefits_id'") or die(mysql_error());
    $show = mysql_fetch_array($select_name);
    $benefit_name = $show['benefit_name'];
    if (!empty($benefits_id) && !empty($amount) && !empty($figuretype)) {
        $insert = mysql_query("INSERT INTO `tbl_benefits`(`employee_id`, `benefit_id`, `amounts`, `amount_category`) "
                . "VALUES ('$employee_no','$benefits_id','$amount','$figuretype')") or die(mysql_error());
        $message = '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Success!</strong>Adding ' . "$benefit_name" . ' benefit to ' . "$name" . '
</div>';
    } else {
        $message = '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">Ã—</a>
    <strong>Error!</strong> 
</div>';
    }
}
if (isset($_POST['tax'])) {
    $employee_no = $_POST['employee_no'];
    $name = $_POST['name'];
    $tax_cat_id = $_POST['tax_cat_id'];
    $amount = $_POST['amount'];
    $figuretype = $_POST['figuretype'];
    $select_name = mysql_query("SELECT * FROM tbl_tax_category WHERE tax_cat_id='$tax_cat_id'") or die(mysql_error());
    $show = mysql_fetch_array($select_name);
    $taxt_type = $show['taxt_type'];
    if (!empty($tax_cat_id) && !empty($amount) && !empty($figuretype)) {
        $insert = mysql_query("INSERT INTO `tbl_tax`(`employee_id`, `tax_cat_id`, `tax_amount`, `figure_category`) "
                . "VALUES ('$employee_no','$tax_cat_id','$amount','$figuretype')") or die(mysql_error());
        $message = '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Success!</strong>Adding ' . "$taxt_type" . ' to ' . "$name" . '
</div>';
    } else {
        $message = '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">Ã—</a>
    <strong>Error!</strong> 
</div>';
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
    $target_dir = "authorized/HR/attachments/" . $attachment_dir . "/";
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
if (isset($_POST['asset'])) {
    $employee_no = $_POST['employee_no'];
    $name = $_POST['name'];
    $company_asset = $_POST['company_asset'];
    $comment = $_POST['comment'];
    if (!empty($employee_no) && !empty($company_asset)) {
        $insert = mysql_query("INSERT INTO `tbl_employee_asset`(`asset_name`, `note`, `employe_no`) "
                . "VALUES ('$company_asset','$comment','$employee_no')") or die(mysql_error());
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

?>





<?php
$emp_file_no = $_GET['emp_file_no'];
$personalinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'")or die(mysql_error());
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
$contactinfo = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emp_file_no'")or die(mysql_error());
$contact = mysql_fetch_array($contactinfo);
$phone = $contact['phone'];
$phone2 = $contact['phone2'];
$postal_addr = $contact['postal_addr'];
$email = $contact['email'];
$email2 = $contact['email2'];
$fax = 'Null';

$position = mysql_query("SELECT * FROM tbl_assign_to_department WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
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

$EMPLOYMENT_HISTORY = mysql_query("SELECT * FROM tbl_employment_history WHERE employee_no='$emp_file_no'") or die(mysql_error());

?>
<head>
    <script>
        function showasset(str) {
            if (str.length == 0) {
                document.getElementById("asset").innerHTML = "";
                document.getElementById("asset").style.border = "0px";
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
                    document.getElementById("asset").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/HR/profile_asset_action.php?q=" + str, true);
            xmlhttp.send();
        }
                function showaction(str) {
            if (str.length == 0) {
                document.getElementById("delete").innerHTML = "";
                document.getElementById("delete").style.border = "0px";
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
                    document.getElementById("delete").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/HR/education_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
    <script>
        function PostData() {
            // 1. Create XHR instance - Start
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            }
            else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            }
            else {
                throw new Error("Ajax is not supported by this browser");
            }
            // 1. Create XHR instance - End

            // 2. Define what to do when XHR feed you the response from the server - Start
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status == 200 && xhr.status < 300) {
                        document.getElementById('message').innerHTML = xhr.responseText;
                    }
                }
            }
            // 2. Define what to do when XHR feed you the response from the server - Start

            var employee_id = document.getElementById("employee_id").value;
            var basic_salary = document.getElementById("basic_salary").value;
            var dearness = document.getElementById("dearness").value;
            var travell = document.getElementById("travell").value;
            var conveyance = document.getElementById("conveyance").value;
            var renthouse = document.getElementById("renthouse").value;
            var medical = document.getElementById("medical").value;
             var deductiond = document.getElementById("deductiond").value;
              var reasons_reduct = document.getElementById("reasons_reduct").value;

            // 3. Specify your action, location and Send to the server - Start 
            xhr.open('POST', 'authorized/HR/payroll_add_action.php');
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("employee_id=" + employee_id + "&basic_salary=" + basic_salary + "&dearness=" + dearness + "&travell=" + travell + "&conveyance=" + conveyance + "&renthouse=" + renthouse + "&medical=" + medical+"&deductiond="+deductiond+"&reasons_reduct="+reasons_reduct);
            // 3. Specify your action, location and Send to the server - End
        }
    </script>
    <script type="text/javascript">
            $(document).ready(function (e) {
                $("#uploadForm"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/uploadimages.php?employee_no=<?php echo $emp_file_no;?>",
                    type: "POST" ,
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
            
             $("#uploadeducation"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/education.php",
                    type: "POST" ,
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


</head>
<div class="navbar-header no-desktop">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <a class="" href="?action=employee"><i  class="icon-list fg-blue"></i>&nbsp;Menu</a>
    </button>

</div>

<div class="bg-white shadow collapse navbar-collapse " id="myNavbar"  style="width: 100%;" >

    <nav class="horizontal-menu compact" >
        <ul>

            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalbenefits"><i  class="icon-accessibility-2 fg-blue"></i>&nbsp;Benefits</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModaltax" ><i  class="icon-clipboard-2 fg-blue"></i>&nbsp;Tax Information</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalpayroll"><i  class="icon-bars fg-blue"></i>&nbsp;Salary Management</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalattachment"><i  class="icon-folder-2 fg-blue"></i>&nbsp;Resume,Training,Certification and Awards</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalasset"><i  class="icon-cart fg-blue"></i>&nbsp;Assets</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModaleducation"><i  class="icon-book fg-blue"></i>&nbsp;Education</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#employment_history"><i  class="icon-copy fg-blue"></i>&nbsp;Employment History</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt"  data-toggle="modal" data-target="#modelincidentlist"><i  class="icon-meter-medium fg-blue"></i>&nbsp;Incident Report</a>
            </li>


        </ul>
    </nav>
</div>
<div class="" style="width: 100%;margin-top: 3px;" style="margin-left: 2.5%;">
    <?php
    echo $message;
    ?>
</div>
<div class=" container-fluid" style="margin-left: 2.5%;">

    <div class="row">
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
                        <td><span class="text-left"><?php echo $emp_file_no; ?></span></td>
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
                        <li class=""><a href="#"><i class="icon-mobile-2"></i><?php echo $phone; ?></a></li>
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
                            <td>8:00</td>
                            <td>17:00</td>
                        </tr>
                        <tr class="dangerE">
                            <td>Tuesday</td>
                            <td>8:00</td>
                            <td>17:00</td>
                        </tr>
                        <tr class="info">
                            <td>Wednesday</td>
                            <td>8:00</td>
                            <td>17:00</td>
                        </tr>
                        <tr class="info">
                            <td>Thursday</td>
                            <td>8:00</td>
                            <td>17:00</td>
                        </tr>
                        <tr class="warning">
                            <td>Friday</td>
                            <td>8:00</td>
                            <td>17:00</td>
                        </tr>
                        <tr class=" active">
                            <td>Saturday</td>
                            <td>8:00</td>
                            <td>17:00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div style="clear: both;"></div>
<div class=" container-fluid" style="margin-left: 2.5%;">
    <div class="row">
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
            <div class="panel-group shadow" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading-people">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-people" aria-expanded="false" aria-controls="collapse-people">
                            <span class="h5"><span class=" icon-calendar"></span></span> Awards
                            <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                    </div>

                    <div style="height: 0px;" aria-expanded="true" id="collapse-people" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-people">
                        <div class="list-group">
                            <a href="#" data-toggle="modal" data-target="#modelaward" class="list-group-item"><span class=" icon-plus"></span> Add Awards</a>

                        </div>
                    </div>

<!--                    <div style="height:1px; background-color:rgb(220,220,220)"></div>

                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-stock" aria-expanded="false" aria-controls="collapse-stock">
                            <span class="h5"><span class="icon-phone"></span></span>&nbsp; Promotions/Penalties
                            <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse-stock" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                        <div class="list-group">
                            <a href="#" data-toggle="modal" data-target="#modelpromotion" class="list-group-item"><span class=" icon-plus-2"></span>&nbsp;Promotions/Penalties</a>

                        </div>
                    </div>-->
<!--                    <div style="height:1px; background-color:rgb(220,220,220)"></div>

                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-notes" aria-expanded="false" aria-controls="collapse-stock">
                            <span class="h5"><span class=" icon-folder"></span></span>&nbsp; Expense Claim
                            <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse-notes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                        <div class="list-group">
                            <a href="#" data-toggle="modal" data-target="#modelexpenseclaim" class="list-group-item"><span class="icon-plus-2"></span>&nbsp; Expense Claim</a>

                        </div>
                    </div>
                    <div style="height:1px; background-color:rgb(220,220,220)"></div>

                    <div class="panel-heading" role="tab" id="heading-stock">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-news" aria-expanded="false" aria-controls="collapse-stock">
                            <span class="h5"><span class=" icon-newspaper"></span></span>&nbsp; Training
                            <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                    </div>
                    <div style="height: 0px;" aria-expanded="false" id="collapse-news" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                        <div class="list-group">
                            <a href="#" data-toggle="modal" data-target="#modeltraining" class="list-group-item"><span class="icon-plus"></span>&nbsp; Add Training</a>

                        </div>
                    </div>-->

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
                        <td class=""><?php echo $emp_file_no; ?></td>
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
                        <td class=""><span class="text-bold">Past Employment</span></td>

                        <td class="">
                            <?php
                            $companyname = array();
                            while ($as = mysql_fetch_array($EMPLOYMENT_HISTORY)) {

                                $companyname[] = $as['company_name'];
                            }
                            $companyname_string = implode(",", $companyname);
                            echo $companyname_string;
                            ?>

                        </td>

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
                        labels: ["Sick Leave", "Holiday Leave", "Vacation Leave", "Paternity leave", "Adoption", "Disability", "Maternity", "Personal days"],
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








<!-- Modal -->
<div id="myModalbenefits" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Add Benefits and Compensation</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <label for="name">Employee Name:</label>
                                <input disabled="" type="text"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $emp_file_no; ?>" id="employee_no" name="employee_no">
                            </div>
                            <div class="form-group">
                                <label for="benefits">Select Benefits (select one):</label>
                                <select class="form-control"  id="benefits" name="benefits_id">
                                    <?php
                                    $select_car = mysql_query("SELECT * from tbl_benefits_category") or die(mysql_error());
                                    while ($rowing = mysql_fetch_array($select_car)) {
                                        $benefit_name = $rowing['benefit_name'];
                                        $benefit_id = $rowing['benefit_id'];
                                        ?>
                                        <option value="<?php echo $benefit_id; ?>"><?php echo $benefit_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amounts:</label>
                                <input type="text" class="form-control" id="amount" name="amount">
                            </div>
                            <div>
                                <div class="input-control radio default-style" data-role="input-control">
                                    <label>
                                        <input name="figuretype" value="Tshs" checked="" type="radio">
                                        <span class="check"></span>
                                        Tshs
                                    </label>
                                </div>
                                <div class="input-control radio  default-style"  data-role="input-control">
                                    <label>
                                        <input name="figuretype" value="$" type="radio">
                                        <span class="check"></span>
                                        Dollar
                                    </label>
                                </div>
                            </div>            
                            <button type="submit" class="btn btn-default" name="benefits">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!----------------------------------model tax------------------------------------------------>
<!-- Modal -->
<div id="myModaltax" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Add Tax Information</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <label for="name">Employee Name:</label>
                                <input disabled="" type="text"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $emp_file_no; ?>" id="employee_no" name="employee_no">
                            </div>
                            <div class="form-group">
                                <label for="tax_cat_id">Select Tax Category:</label>
                                <select class="form-control"  id="taxt_cat" name="tax_cat_id">
                                    <?php
                                    $select_car = mysql_query("SELECT * from tbl_tax_category") or die(mysql_error());
                                    while ($rowing = mysql_fetch_array($select_car)) {
                                        $taxt_type = $rowing['taxt_type'];
                                        $tax_cat_id = $rowing['tax_cat_id'];
                                        ?>
                                        <option value="<?php echo $tax_cat_id; ?>"><?php echo $taxt_type; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amounts:</label>
                                <input type="text" class="form-control" id="amount" name="amount">
                            </div>
                            <div>
                                <div class="input-control radio default-style" data-role="input-control">
                                    <label>
                                        <input name="figuretype" value="Tshs" checked="" type="radio">
                                        <span class="check"></span>
                                        Tshs
                                    </label>
                                </div>
                                <div class="input-control radio  default-style"  data-role="input-control">
                                    <label>
                                        <input name="figuretype" value="$" type="radio">
                                        <span class="check"></span>
                                        Dollar
                                    </label>
                                </div>
                            </div>            
                            <button type="submit" class="btn btn-default" name="tax">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!-------------------------------------------------model linces------------------------------------------------------->

<!-- Modal -->
<div id="myModalattachment" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Resume,Training and Certificate</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <form role="form" method="post" action="" enctype="multipart/form-data"  >
                            <div class="form-group">
                                <label for="name">Employee Name:</label>
                                <input disabled="" type="text"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $emp_file_no; ?>" id="employee_no" name="employee_no">
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

                                <a style="padding-left: 0px;" href="#"><span class="node-toggle"></span><i class="icon-folder fg-yellow"></i>&nbsp;<?php echo $first_name . ' ' . $surname; ?>&nbsp;Attachments</a>
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
                                                $select_node = mysql_query("SELECT * FROM tbl_attachments where attachment_category='$kind_id' AND employe_no='$emp_file_no'") or die(mysql_error());
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
<!-------------------------------------------------------assets------------------------------------------------>
<!-- Modal -->
<div id="myModalasset" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
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
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <label for="name">Employee Name:</label>
                                <input disabled="" type="text"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $emp_file_no; ?>" id="employee_no" name="employee_no">
                            </div>                           
                            <div class="form-group">
                                <label for="company_asset">Company Asset:</label>
                                <input type="text" class="form-control" id="company_asset" name="company_asset">
                            </div>  
                            <div class="form-group">
                                <label for="comment">Note:</label>
                                <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default" name="asset">Submit</button>
                        </form>
                        <div class="bg-white shadow" style="width: 100%;" >
                            <nav class="horizontal-menu compact">
                                <ul>
                                    <li>
                                        <a class=" " href=""><i class="fg-blue"></i>&nbsp;COMPANY ASSET(S)|</a>
                                    </li>
                                    <li id="asset">

                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="example">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Asset Name</th>  
                                        <th class="text-left">Comments</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $select_asset = mysql_query("SELECT * FROM tbl_employee_asset WHERE employe_no='$emp_file_no'") or die(mysql_error());
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $asset_name = $roww['asset_name'];
                                        $asset_id = $roww['asset_id'];
                                        $note = $roww['note'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="" value="<?php echo $asset_id; ?>" onchange="showasset(this.value)"></td>
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
<!-------------------------------------------------------------myModalpayroll------------------------------------------->
<!-- Modal -->
<div id="myModalpayroll" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">

                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Payroll</div> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <div class="bg-white shadow" style="width: 100%;" >
                            <nav class="horizontal-menu compact">
                                <ul>
                                    <li>
                                        <a class="fg-blue" href="#"><i class=" fg-blue"></i>&nbsp;Allowance</a>
                                    </li> 
                                     <li>
                                         <a class="fg-black" href="?action=Pay Slip&emp_file_no=<?php echo $emp_file_no;?>"><i class="icon-file-pdf fg-red"></i>&nbsp;Print Pay Slip</a>
                                    </li> 
                                </ul>
                            </nav>
                        </div>
                        <div  id="message">                    

                        </div>
                        <div id="deduction">
                        <form>
                            <?php
                            $q = mysql_query("SELECT * FROM tbl_accounts WHERE payroll_no='$emp_file_no'") or die(mysql_error());
                            $w = mysql_fetch_array($q);
                            $salary = $w['salary'];
                            $emp_file_no1 = $w['emp_file_no'];
                            $allowance = $w['allowance'];
                            $travel_allowance = $w['travel_allowance'];
                            $Conveyance_allowance = $w['Conveyance_allowance'];
                            $House_rent_allowance = $w['House_rent_allowance'];
                            $Medical_allowance = $w['Medical_allowance'];
                            $reasons_reduct = $w['remark'];
                            $deduction=$w['deduction'];
                            ?>                        
                            <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $emp_file_no1; ?>">
                            <table>
                                <tr class="margin5">
                                    <td><p style=" margin-top: -5px;">Basic Salary</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" class="form-control" id="basic_salary" name="basic_salary" value="<?php echo $salary; ?>">
                                        </div>
                                    </td>

                                    <td><p style=" margin-top: -5px;padding-left: 4%;">Dearness Allowance</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" class="form-control" id="dearness" name="dearness" value="<?php echo $allowance; ?>">
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td><p style=" margin-top: -5px;">Travelling Allowance</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" class="form-control" id="travell" name="travell" value="<?php echo $travel_allowance; ?>">
                                        </div>
                                    </td>

                                    <td><p style=" margin-top: -5px;padding-left: 4%;">Conveyance Allowance</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" class="form-control" id="conveyance" name="conveyance" value="<?php echo $Conveyance_allowance; ?>">
                                        </div>
                                    </td>

                                </tr>
                                <tr class="margin5">
                                    <td><p style=" margin-top: -5px;">House Rent Allowance</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" class="form-control" id="renthouse" name="renthouse" value="<?php echo $House_rent_allowance; ?>">
                                        </div>
                                    </td>

                                    <td><p style=" margin-top: -5px;padding-left: 4%;">Medical Allowance</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" class="form-control" id="medical" name="medical" value="<?php echo $Medical_allowance; ?>">
                                        </div>
                                    </td>

                                </tr>
                            </table>
                            <div class="bg-white shadow" style="width: 100%;" >
                            <nav class="horizontal-menu compact">
                                <ul>
                                    <li >
                                        <a class="fg-blue" href="#"><i class=" fg-blue"></i>&nbsp;Deductions</a>
                                    </li> 
<!--                                    <li>
                                        <a class="" href="#" onclick="getPage('authorized/HR/deduction.php')"><i class=" fg-blue"></i>&nbsp;Deductions</a>
                                    </li> -->
                                </ul>
                            </nav>
                        </div>
                                                        <table>
                                <tr class="margin5">
                                    <td><p style=" margin-top: -5px;">Basic Salary</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" readonly="" class="form-control" value="<?php echo $salary; ?>" id="basic_salary2" name="basic_salary2" >
                                        </div>
                                    </td>

                                    <td><p style=" margin-top: -5px;padding-left: 4%;">Deduction</p></td>
                                    <td> 
                                        <div class="form-group">                                
                                            <input type="text" class="form-control" value="<?php echo $deduction;?>" id="deductiond" name="deductiond" >
                                        </div>
                       
                                    </td>

                                </tr>
                                                            
                            </table>
                            <div class="form-group">
                                <label for="comment">Reason(s):</label>
                                <textarea class="form-control" rows="5" id="reasons_reduct" value="<?php  echo $reasons_reduct;?>" name="reasons_reduct"></textarea>
                                  </div>
                            <input type="button" class="button primary" value ="Update" onclick="PostData()" />
                           

                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
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
                            <form id="uploadForm" action="authorized/HR/uploadimages.php" method="post">
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

<!-----------------------------------educations---------------------->
<!-- Modal -->
<div id="myModaleducation" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Update Education</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="notifing">
                        
                    </div>
                        
                        <form id="uploadeducation" action="authorized/HR/education.php" method="post">
                            <div class="form-group">
                                <label for="name">Employee Name:</label>
                                <input disabled="" type="text"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $emp_file_no; ?>" id="employee_no" name="employee_no">
                            </div>
                            <div class="form-group">
                                <label for="education">Education:</label>
                                <input type="text" class="form-control" id="education" name="education" id="education">
                            </div>
                             <div class="form-group">
                                <label for="education">School/college/University:</label>
                                <input type="text" class="form-control" id="education" name="collg" id="collg">
                            </div>
                            <table>
                                <tr>
                                    <td>
                                         <label for="education">Start Year:</label>
                                          <input type="text" class="form-control" id="education" name="start" id="start">
                                    </td>
                                    <td>
                                         <label for="education">Finish Year:</label>
                                <input type="text" class="form-control" id="education" name="fnish" id="fnish">
                                    </td>
                                </tr>
                            </table>
                            <input type="submit"  value="Submit Data"/>    
                            
                        </form>
                        <div id="delete">
                           
                        </div>
                                                <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Education</th>  
                                        <th class="text-left">College/School</th>
                                        <th class="text-left">Start Date</th>  
                                        <th class="text-left">Finish Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $select_asset = mysql_query("SELECT * FROM tbl_education WHERE employe_no='$emp_file_no'") or die(mysql_error());
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $edu_id = $roww['edu_id'];
                                        $education= $roww['education'];
                                        $finish_date= $roww['finish_date'];
                                        $start_date= $roww['start_date'];
                                        $school_university_college = $roww['school_university_college'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="" value="<?php echo $edu_id; ?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php echo $education; ?></td>
                                            <td class="right"><?php echo $school_university_college; ?></td>
                                            <td class="right"><?php echo $start_date; ?></td>
                                            <td class="right"><?php echo $finish_date; ?></td>
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
<!-------------------------------------------------model linces------------------------------------------------------->

<!---------------------------------end education--------------------->

<!-----------------------------------educations---------------------->
