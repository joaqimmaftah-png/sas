<?php
$message = "";
if(isset($_POST['edit_employee'])){
    include 'db.php';
    $employee_no = $_POST['employee_no'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $bdate = $_POST['bdate'];
    $gender = $_POST['gender'];
    $marital = $_POST['marital'];
    $religion = $_POST['religion'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $house_no = $_POST['house'];   
        $insertq = "UPDATE tbl_employee SET first_name='$fname',middle_name='$mname',surname='$lname',date_of_birth='$bdate'"
                . ",gender='$gender',marital_status='$marital',religion='$religion',country='$country',city='$city',district='$district',house_no='$house_no' WHERE emp_file_no='$employee_no'";
    mysql_query($insertq) or die(mysql_error());   
    if($insertq){
           echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully! Change Saved</strong>
</div>'; 
    }  
}
if(isset($_POST['contacts'])){
    include 'db.php';
     $email = $_POST['email'];
     $email2 = $_POST['email2'];
    $phone = $_POST['phone'];
    $phone2 = $_POST['phone2'];
    $employee_no = $_POST['employee_no'];
    $postal_addr = $_POST['poster'];
    $insert = "UPDATE tbl_contact SET phone='$phone',phone2='$phone2', postal_addr='$postal_addr',email='$email',email2='$email2' WHERE emp_file_no='$employee_no'";
    mysql_query($insert) or die(mysql_error());
        
     if($insert){
           echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully! Changes Saved</strong>
</div>';
     }
}
if(isset($_POST['payroll'])){
    include 'db.php';
$employee_no = $_POST['employee_no'];
$salary = $_POST['basic_salary'];
$dearness = $_POST['dearness'];
$travell = $_POST['travell'];
$conveyance = $_POST['conveyance'];
$renthouse = $_POST['renthouse'];
$medical = $_POST['medical'];

        $insertinto = mysql_query("UPDATE  tbl_accounts SET salary='$salary',allowance='$dearness',travel_allowance='$travell',Conveyance_allowance='$conveyance',House_rent_allowance='$renthouse',Medical_allowance='$medical' WHERE emp_file_no='$employee_no'") or die(mysql_error());
        if ($insertinto) {
            echo '<div class="alert alert-success  error">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull!Changes Saved</strong></div>';
        }
}
if(isset($_POST['employement'])){
     include 'db.php';    
     $position = $_POST['position'];
    $department = $_POST['department'];
     $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
   $comments = $_POST['comments'];
    $designation = $_POST['designation'];
    $employee_no = $_POST['employee_no'];
    $insertS = "UPDATE  tbl_assign_to_department SET department_id='$department',position_id='$position',designation='$designation',start_date='$sdate',end_date='$edate',comments='$comments' WHERE emp_file_no='$employee_no'";
    mysql_query($insertS) or die(mysql_error());
    if($insertS){
         echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully! Changes Saved</strong>
</div>';
    }
}
if(isset($_POST['staff_account'])){
    
    $employee_no=$_POST['employee_no'];
    $status=$_POST['status'];
    $usertype=$_POST['usertype'];
    $pass=$_POST['password'];
    $password=md5($pass);
            
    $update_staff=  mysql_query("UPDATE  tbl_user_accounts SET password='$password',usertype='$usertype',status='$status' WHERE emp_file_no='$employee_no'") or die(mysql_error());
     if($update_staff){
                echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully! Changes Saved</strong>
</div>'; 
     }   
}

if($_POST["submit"]){
    
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$employee_no=$_POST["employee_no"];
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
                $insertq = "UPDATE tbl_employee SET profile_pic='$target_file' WHERE emp_file_no='$employee_no'";
    mysql_query($insertq) or die(mysql_error());   
    if($insertq){
           echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully! Change Saved</strong>
</div>'; 
    }
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
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
$comments=$positions['comments'];
$departments = mysql_query("SELECT * FROM tbl_department WHERE department_id='$department_id'") or die(mysql_error());
$positioning = mysql_query("SELECT * FROM tbl_position WHERE position_id='$position_id'") or die(mysql_error());
$tbl_title = mysql_query("SELECT * FROM tbl_title WHERE title_code='$designation_id'") or die(mysql_error());
$dep = mysql_fetch_array($departments);
$pos = mysql_fetch_array($positioning);
$des = mysql_fetch_array($tbl_title);
$department_name = $dep['department_name'];
$position_name = $pos['position_name'];
$designation = $des['title_name'];
//SALARY
$tbl_salary = mysql_query("SELECT * FROM tbl_accounts WHERE emp_file_no='$emp_file_no' ") or die(mysql_error());
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

///////////////////////
$accountssetting=mysql_query("SELECT * FROM tbl_user_accounts where emp_file_no='$emp_file_no' ") or die(mysql_error());
$wo=  mysql_fetch_array($accountssetting);
$password=$wo['password'];
$usertype=$wo['usertype'];
$acc_status=$wo['status'];

?>
<div class="navbar-header no-desktop">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <a class="" href="?action=employee"><i  class="icon-list fg-blue"></i>&nbsp;Menu</a> 
    </button>

</div>

<div class="bg-white shadow collapse navbar-collapse " id="myNavbar"  style="width: 100%;" >

    <nav class="horizontal-menu compact" >
        <ul>
            <li>
                <a class="" href="#">Edit Employee Information&nbsp;<i  class="icon-arrow-right-2 fg-red"></i></a>
            </li>

            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#addemployee"><i  class="icon-user-3 fg-blue"></i>&nbsp;Personal Information</a>
            </li>  
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#employementss"><i  class="icon-bookmark-3 fg-blue"></i>&nbsp;Employment</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#employee_contact" ><i  class="icon-phone fg-blue"></i>&nbsp;Contact</a>
            </li>
             <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#salary_infomation"><i  class="icon-bars fg-blue"></i>&nbsp;Salary Information</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#accounts"><i  class="icon-pencil fg-blue"></i>&nbsp;Staff Account</a>
            </li>



        </ul>
    </nav>
</div>
<div class=" container-fluid" style="">
    <div class="">
        <?php echo $message;?>
    </div>
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
                            <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#pic"><i class="fg-blue"></i>&nbsp;Change Profile Picture</a>
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
<div class=" container-fluid">
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
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading-people">
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-people" aria-expanded="false" aria-controls="collapse-people">
                            <span class="h5"><span class=" icon-calendar"></span></span> Calender
                            <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                    </div>

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
                        <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="false" aria-controls="collapse-stock">
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
                        <td class=""><span class="text-bold">Basic Salary</span></td>
                        <td class="">Tshs. <?php  echo number_format($salaryy); ?></td>
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

<!-----------------------------Personal Information--------------------------------->

<!-- Modal -->
<div id="addemployee" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog2">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-user"></span> 
                    <div class="title">Personal Information</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >
                    <div class="margin10" style="margin-top: 3%;">
                        <div class="margin20" id="showmessage">
                            <!--messages-->
                        </div>
                        <form class="form-inline" role="form" action="" method="POST">
                            <div class="form-group">
                                <label for="employ_id">Employee ID</label>
                                <input type="text" readonly="" value="<?php echo $emp_file_no;?>" class="form-control" name="employee_no">
                            </div>
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" value="<?php echo $first_name;?>" class="form-control" name="fname">
                            </div>
                            <div class="form-group">
                                <label for="middle">Middle Name</label>
                                <input type="text" value="<?php echo $middle_name;?>" class="form-control" name="mname" >
                            </div>
                            <div class="form-group">
                                <label for="last">Last Name</label>
                                <input type="text" value="<?php echo $surname;?>" class="form-control" name="lname">
                            </div>
                            <div class="form-group" >
                                <label for="bdate">Birth Date</label>
                                
                                <input  type="text" value="<?php echo $date_of_birth;?>" class="form-control" name="bdate">
                                    
                            </div>



                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="<?php echo $gender;?>"><?php echo $gender;?></option>
                                    <option value="">-------Select-------</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="martial">Marital Status</label>
                                <select class="form-control" name="marital">
                                    <option value="<?php echo $marital_status;?>"><?php echo $marital_status;?></option>
                                    <option value="">-------Select-------</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <input type="text" class="form-control" value="<?php echo $religion;?>" name="religion">
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" value="<?php echo $country;?>" name="country">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" value="<?php echo $city;?>" name="city">
                            </div>
                            <div class="form-group">
                                <label for="district">District</label>
                                <input type="text" class="form-control" value="<?php echo $district;?>" name="district">
                            </div>
                            <div class="form-group">
                                <label for="hnumber">House Number</label>
                                <input type="text" class="form-control" value="<?php echo $house_no;?>" name="house">
                            </div>
                            <div class="" style="margin-top: 8px;">
                                <input type="submit" class="button primary large-size" name="edit_employee" value="Save Changes">
                            </div>

                        </form>



                    </div>
                </div>
                <!---------------------end window------------------>
            </div>
        </div>
    </div>
    </div>
    <!--Personal Information-->
    <!-----------------------------Employements--------------------------------->

<!-- Modal -->
<div id="employementss" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog2">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-user"></span> 
                    <div class="title">Employment Detail</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >
                    <div class="margin10" style="margin-top: 3%;">
                        <div class="margin20" id="showmessage">
                            <!--messages-->
                        </div>
                        <form class="form-inline" action=""  role="form" id="department" method="POST">

                                        <div class="form-group">
                                            <label for="employee_id">Employee Id:</label>
                                            <input type="text" readonly="" class="form-control" value="<?php echo $emp_file_no;?>" name="employee_no">
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Department:</label>
                                            <select class="form-control" name="department">
                                                <option value="<?php echo $department_id; ?>"><?php echo $department_name; ?></option>
                                                <option>----Select Department----</option>
                                                <?php
                                                $SELECT = "SELECT * FROM tbl_department ";
                                                $mimi1 = mysql_query($SELECT) or die(mysql_error());
                                                while ($row = mysql_fetch_array($mimi1)) {
                                                    $department_id = $row['department_id'];
                                                    $department_name = $row['department_name'];
                                                    ?>
                                                    <option value="<?php echo $department_id; ?>"><?php echo $department_name; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="" for="Designation">Designation:</label>
                                            <select class="form-control" name="designation">
                                                 <option value="<?php echo $designation_id; ?>"><?php echo $designation; ?></option>
                                                <option>--------Select------</option>
                                                <?php
                                                $SELECT = "SELECT * FROM tbl_title";
                                                $mimi = mysql_query($SELECT) or die(mysql_error());
                                                while ($row = mysql_fetch_array($mimi)) {
                                                    $title_code = $row['title_code'];
                                                    $title_name = $row['title_name'];
                                                    ?>
                                                    <option value="<?php echo $title_code; ?>"><?php echo $title_name; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="Position">Position:</label>
                                            <select class="form-control" name="position">
                                                 <option value="<?php echo $position_id; ?>"><?php echo $position_name; ?></option>
                                                <option>---Select Position---</option>
                                                <?php
                                                $SELECT = "SELECT * FROM tbl_position";
                                                $mimi = mysql_query($SELECT) or die(mysql_error());
                                                while ($row = mysql_fetch_array($mimi)) {
                                                    $position_id = $row['position_id'];
                                                    $position_name = $row['position_name'];
                                                    ?>
                                                    <option value="<?php echo $position_id; ?>"><?php echo $position_name; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group" >
                                            <label for="Start">Start Date:</label>
                                            <input type="text" class="form-control" value="<?php echo $start_date?>" name="sdate">
                                        </div>
                                        <div class="form-group" >
                                            <label for="End">End Date:</label>
                                            <input type="text" class="form-control" value="<?php echo $end_date;?>" name="edate">
                                        </div>
                                        <div class="form-group" >
                                            <label for="comment">Department Location:</label>
                                            <textarea class="form-control" cols="97" value="<?php echo $comments;?>" name="comments">
                                            <?php echo $comments;?>
                                            </textarea>
                                        </div>
                                        <div class="" style="margin-top: 8px;">
                                            <input type="submit" class="button primary large-size" name="employement" value="Make Change">
                                        </div>



                                    </form>



                    </div>
                </div>
                <!---------------------end window------------------>
            </div>
        </div>
    </div>
    </div>
    <!--Personal Information-->
    <!-----------------------------Employements--------------------------------->

<!-- Modal -->
<div id="employee_contact" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog2">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-user"></span> 
                    <div class="title">Contact Information</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >
                    <div class="margin10" style="margin-top: 3%;">
                        <div class="margin20" id="showmessage">
                            <!--messages-->
                        </div>
                                    
                        <form class="" method="POST" action="" role="form" id="contacts">
                                        <div class="form-group">
                                            <label for="employee_no">Employee Id:</label>
                                            <input type="text" class="form-control" name="employee_no" readonly="" value="<?php echo $emp_file_no;?>" >
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="text" class="form-control" value="<?php echo $email;?>" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email2:</label>
                                            <input type="text" class="form-control" value="<?php echo $email2;?>" name="email2">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone Number:</label>
                                            <input type="tel" class="form-control" value="<?php echo $phone;?>" name="phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone2">Phone Number2:</label>
                                            <input type="tel" class="form-control" value="<?php echo $phone2;?>" name="phone2">
                                        </div>

                                        <div class="form-group">
                                            <label for="poster">Postal Address:</label>
                                            <input type="text" class="form-control" value="<?php echo $postal_addr;?>" name="poster"><br>
                                        </div>
                                        <div class="" style="margin-top: 8px;">
                                            <input type="submit" class="button primary large-size" name="contacts" value="Save Changes">
                                        </div>



                                    </form>

                    </div>
                </div>
                <!---------------------end window------------------>
            </div>
        </div>
    </div>
    </div>
    <!--Personal Information-->
    <!-----------------------------Employements--------------------------------->

<!-- Modal -->
<div id="salary_infomation" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog2">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-user"></span> 
                    <div class="title">Salary Information</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >
                    <div class="margin10" style="margin-top: 3%;">
                        <div class="margin20" id="showmessage">
                            <!--messages-->
                        </div>
                        <form class=""  action="" role="form" method="POST" id="salary">
                                        <div class="form-group">
                                            <label for="employee_id">Employee ID:</label>
                                            <input type="text" readonly="" name="employee_no"  value="<?php echo $emp_file_no;?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Basic Salary</label>
                                            <input type="text" class="form-control" value="<?php echo $salaryy;?>" name="basic_salary">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Dearness Allowance</label>
                                            <input type="text" class="form-control"  value="<?php echo $allowance;?>" name="dearness">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Travelling Allowance</label>
                                            <input type="text" class="form-control"  value="<?php echo $travel_allowance;?>" name="travell">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Conveyance Allowance</label>
                                            <input type="text" class="form-control"  value="<?php echo $Conveyance_allowance;?>" name="conveyance">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">House Rent Allowance</label>
                                            <input type="text" class="form-control"  value="<?php echo $House_rent_allowance;?>" name="renthouse">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Medical Allowance</label>
                                            <input type="text" class="form-control"  value="<?php echo $Medical_allowance?>" name="medical">
                                        </div>
                                        <div class="" style="margin-top: 8px;">
                                            <input type="submit" class="button primary large-size" name="payroll" value="Save Changes">
                                        </div>


                                    </form>          


                    </div>
                </div>
                <!---------------------end window------------------>
            </div>
        </div>
    </div>
    </div>
    <!--Personal Information-->
    <!-----------------------------Employements--------------------------------->

<!-- Modal -->
<div id="accounts" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog2">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-user"></span> 
                    <div class="title">Staff Accounts</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >
                    <div class="margin10" style="margin-top: 3%;">
                        <div class="margin20" id="showmessage">
                            <!--messages-->
                        </div>
                             <form  role="form" method="POST" id="signup">
                                        <div class="form-group">
                                            <label for="email">Employee Id</label>
                                             <input type="text" class="form-control" name="employee_no" value="<?php echo $emp_file_no; ?>"><br>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">User Type</label>
                                            <select class="form-control" name="usertype">
                                                <option value="<?php echo $usertype;?>"><?php echo $usertype;?></option>
                                                <option value="">----Select UserType</option>
                                                <option value="Staff">Staff</option>
                                                <option value="HR">HR</option>
                                                <option value="Admin">Admin</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Password</label>
                                            <input type="text" class="form-control" name="password" value="<?php echo $password; ?>"><br>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="<?php echo $acc_status;?>"><?php echo $acc_status;?></option>
                                                <option value="">---select---</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>

                                            </select>

                                        </div>

                                        <div class="" style="margin-top: 8px;">
                                            <input type="submit" class="button primary large-size" name="staff_account" value="Submit">
                                        </div>


                                    </form>        


                    </div>
                </div>
                <!---------------------end window------------------>
            </div>
        </div>
    </div>
    </div>
    <!--Personal Information-->
    
    <!-- Modal -->
<div id="pic" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog2">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-user"></span> 
                    <div class="title">Profile Picture</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >
                    <div class="margin10" style="margin-top: 3%;">
                        <div class="margin20" id="showmessage">
                            <!--messages-->
                        </div>
                             <form   method="POST" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="email">Upload Picture</label>
                                            <input type="hidden" class="form-control" name="employee_no" value="<?php echo $emp_file_no; ?>">
                                             <input type="file" class="form-control" name="fileToUpload">
                                        </div>


                                        <div class="" style="margin-top: 8px;">
                                            <input type="submit" class="button primary large-size" name="submit" value="Submit">
                                        </div> 


                                    </form>        


                    </div>
                </div>
                <!---------------------end window------------------>
            </div>
        </div>
    </div>
    </div>
    <!--Personal Information-->
