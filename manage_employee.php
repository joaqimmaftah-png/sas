<head>
    <script>
        function showoption(str) {
            if (str.length == 0) {
                document.getElementById("action").innerHTML = "";
                document.getElementById("action").style.border = "0px";
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
                    document.getElementById("action").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/HR/manage_employee_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>       
</head>
<?php
$message = "";
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete_emloyee') {
        $employee_id = $_GET['emp_file_no'];
        $from_tbl_accounts = mysql_query("delete from tbl_accounts where emp_file_no='$employee_id'") or die(mysql_error());
        $from_employee = mysql_query("delete from tbl_employee where emp_file_no='$employee_id'") or die(mysql_error());
        $from_tbl_empley_contact = mysql_query("delete from tbl_empley_contact where emp_file_no='$employee_id'") or die(mysql_error());
        $from_tbl_contract_to_work = mysql_query("delete from tbl_contract_to_work where emp_file_no='$employee_id'") or die(mysql_error());
        $from_tbl_user_accounts = mysql_query("delete from tbl_user_accounts where emp_file_no='$employee_id'") or die(mysql_error());
        $from_tbl_appraisal = mysql_query("delete from tbl_appraisal where emp_file_no='$employee_id'") or die(mysql_error());
        $message = '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>User Successfully Deleted!</strong>
</div>';
    }
}
?>
<div class="bg-white" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="?action=employee"><i class="icon-home fg-blue"></i>&nbsp;Home</a>
            </li>
            <li>
                    <a href="?action=add_employee"><i class="icon-user fg-orange fg-hover-crimson"></i>&nbsp;Add Employee</a>
            </li>
            <li>
                 <a class="" href="?action=payroll page" class="fg-hover-crimson fg-cobalt"><i class="icon-stats-up fg-blue"></i>&nbsp;Payroll</a>
            </li>
            <li id="action">
                <!--               show data-->
            </li>
            <li>
                <a class="" href="?action=employee"><i class="icon-reply-2 fg-green"></i></a>                 
            </li>

        </ul>
    </nav>
</div>
<div class="container">
    <?php
    echo $message;
    ?>
</div>
<div class="margin5">    
    <table id="example" class="display bordered" style="font-size: 12px;" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th></th>
                <th class="text-left">Employee Reg#</th>
                <th class="text-left">Full Name</th>
                <th class="text-left">Designation</th>
                <th class="text-left">Payroll Number</th>
                <th class="text-left">Salary</th>
                <th class="text-left">Department</th>
                <th class="text-left">Phone#</th>
                <th class="text-left">Email 1</th>
                <th class="text-left">Email 2</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include 'authorized/db.php';
            $show = "SELECT * FROM tbl_employee";
            $display = mysql_query($show) or die(mysql_error());
            while ($row = mysql_fetch_array($display)) {
                $emp_file_no = $row['emp_file_no'];
                $first_name = $row['first_name'];
                $surname = $row['surname'];
                $name = "$first_name" . "&nbsp" . "$surname";
                $contact = mysql_query("select * from tbl_empley_contact where tbl_empley_contact.emp_file_no='$emp_file_no'")or die(mysql_error());
                $show_contact = mysql_fetch_array($contact);
//                $designation = $show_contact['designation'];
                $email = $show_contact['email'];
                $mobile_phone = $show_contact['telephone_no'];
                $email2 = $show_contact['email2'];

                $contract_to = mysql_query("SELECT title_name FROM tbl_contract_to_work,tbl_title WHERE tbl_title.title_code=tbl_contract_to_work.title_code AND tbl_contract_to_work.emp_file_no='$emp_file_no'") or die(mysql_error());
                $contact_row = mysql_fetch_array($contract_to);
                $designation = $contact_row['title_name'];


                $salary1 = mysql_query("select * from tbl_accounts where emp_file_no='$emp_file_no'")or die(mysql_error());
                $show_salary = mysql_fetch_array($salary1);
                setlocale(LC_MONETARY,"en_US");           
                $salary = $show_salary['salary'];
                $payroll_no = $show_salary['payroll_no'];

                $position = mysql_query("select department_name from tbl_department,tbl_assign_to_department where "
                        . "tbl_department.department_id=tbl_assign_to_department.department_id AND tbl_assign_to_department.emp_file_no='$emp_file_no'")or die(mysql_error());
                $show_department = mysql_fetch_array($position);
                $department_name = $show_department['department_name'];
                ?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="" value="<?php echo $emp_file_no; ?>" onchange="showoption(this.value)">
                    </td>
                    <td><?php echo $emp_file_no; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $designation; ?></td>
                    <td><?php echo $payroll_no; ?></td>
                    <td><?php echo 'Tshs&nbsp;'.number_format($salary).'&nbsp;/='; ?></td>
                    <td><?php echo $department_name; ?></td>
                    <td><?php echo $mobile_phone; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $email2; ?></td>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div id="myModalexcell" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-file-excel fg-green"></span> 
                    <div class="title">Microsoft Office Excel 97-2003 Worksheet (.xls)</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >
                    <div class="margin10" style="margin-top: 3%;">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="input-control file info-state" data-role="input-control">
                            <input tabindex="-1" style="z-index: 0;" type="file" name="file">
                            <input id="__input_file_wrapper__" readonly="" style="z-index: 1; cursor: default;" type="text">
                            <button type="button" class="btn-file"></button>
                        </div>
                        <div class="form-actions">
                    <button class="button primary" name="employee_excell">Upload File</button>                                           
                       </div>
                    </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!--model linces-->
<?php
if(isset($_POST['employee_excell'])){
    include_once 'authorized/db.php';
$target_file =$_FILES["file"]["name"];
       $extension=explode(".", $target_file);
       $name=$extension[1];
      if($name=="xls"){
    require_once 'Classes/PHPExcel/IOFactory.php';
    $inputFileType = 'Excel5';
    $inputFileName = $_FILES['file']['tmp_name'];
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($inputFileName);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true); //HIZNI COLUMN
    $counter = count($sheetData);
        for ($i = 2; $i <= $counter; $i++) {//TUNAANZA NA ROW YA PILI KUCHUKUA DATA ZETU
   $emp_file_no =$first_name=$middle_name=$surname=$emp_status=$date_of_birth=$gender=$marital_status=$religion=$nationality=$country=$city=$district=$house_no=
   $telephone_no=$mobile_phone=$email=$email2=$postal_addr=$title_code=$start_date=$end_date=$salary="";
   
            $emp_file_no=$sheetData[$i]['A'];
            $first_name=mysql_escape_string($sheetData[$i]['B']);
            $middle_name=mysql_escape_string($sheetData[$i]['C']);
            $surname=  mysql_escape_string($sheetData[$i]['D']);
            $emp_status="Inactive";
            $date_of_birth=$sheetData[$i]['E'];
            $gender=$sheetData[$i]['F'];
            $marital_status=$sheetData[$i]['G'];
            
            $department_id=$sheetData[$i]['H'];
            $Position=$sheetData[$i]['I'];
            
            $religion=$sheetData[$i]['J'];
            $nationality="Tanzanian";
            $country=$sheetData[$i]['K'];
            $city=$sheetData[$i]['L'];
            $district=$sheetData[$i]['M'];
            $house_no=$sheetData[$i]['N'];
            $profile_pic = "images/person.png";
///////////////////////////////////////////////////////////////////
             $title_code=$sheetData[$i]['O'];
             $salary=$sheetData[$i]['P'];
             $start_date=$sheetData[$i]['Q'];
             $end_date=$sheetData[$i]['R'];          
             $telephone_no=$sheetData[$i]['S'];           
             $mobile_phone=$sheetData[$i]['T'];
             $email=$sheetData[$i]['U'];
             $email2=$sheetData[$i]['V'];
             $postal_addr=$sheetData[$i]['W'];
             $status="Active";
               $access_lever = 6;
              $statuss = 'active';         
               $usertype = 'staff';  
     $insertq = "INSERT INTO tbl_employee(emp_file_no,first_name,middle_name,surname,emp_status,date_of_birth,gender,marital_status,religion,nationality,country,city,district,house_no,profile_pic)"
            . " VALUES('$emp_file_no','$first_name','$middle_name','$surname','$emp_status','$date_of_birth','$gender','$marital_status','$religion','$nationality','$country','$city','$district','$house_no','$profile_pic')";
    mysql_query($insertq) or die(mysql_error());
    //////////////////////////////Add Contact/////////////////////////////////////////   
    $insert = "INSERT INTO tbl_empley_contact(emp_file_no,telephone_no,mobile_phone,postal_addr, email,email2)"
            . " VALUES('$emp_file_no','$telephone_no','$mobile_phone','$postal_addr','$email','$email2')";
    mysql_query($insert) or die(mysql_error());
    //////////////////////////////////////Contact Information///////////////////////////////////////////////
    $tbl_accounts = mysql_query("SELECT * FROM tbl_accounts WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
    $rows = mysql_num_rows($tbl_accounts);
    if ($rows == 0) {
        
        $inserty = "INSERT INTO tbl_contract_to_work(emp_file_no,title_code, start_date,end_date)"
                . " VALUES('$emp_file_no','$title_code','$start_date','$end_date')";
        mysql_query($inserty) or die(mysql_error());
            $insert1 = "INSERT INTO tbl_accounts(payroll_no,emp_file_no,salary,status)"
            . " VALUES('$emp_file_no','$emp_file_no','$salary','$status')";
    mysql_query($insert1) or die(mysql_error());
    $user_accounts = mysql_query("INSERT INTO tbl_user_accounts(`emp_file_no`, `password`,usertype,`access_lever`, `status`)"
            . "VALUES('$emp_file_no','','$usertype','$access_lever','$statuss')")or die(mysql_error());

    ///////////////////////Add Department/////////////////////////////////////////////////////////////////
    $insertS = "INSERT INTO tbl_assign_to_department(emp_file_no,department_id,position_id)"
            . " VALUES('$emp_file_no','$department_id','$Position')";
    mysql_query($insertS) or die(mysql_error());
    //////////////////////////////////////////////////////////////////////// 
    $message='<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>User Successfully Created</strong>
</div>';
    }

//////////////////////////////////////end if ya kuchek user on database
        }                  
      }
}
?>