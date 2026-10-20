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
        $(document).ready(function (e) {
            ////////////////////////
            $("#add_eployee").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/HR/add_employee_info.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#showmessage").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            /////////////////
            ////////////////////////
            $("#contacts").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/HR/add_contact.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#showmessage").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            /////////////////
            ////////////////////////
            $("#department").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/HR/add_department.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#showmessage").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            /////////////////
            ////////////////////////
            $("#salary").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/HR/add_salary.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#showmessage").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            /////////////////
            ////////////////////////
            $("#signup").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/HR/add_accounts.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#showmessage").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            /////////////////
        });
    </script>    

</head>
<?php
require_once __DIR__ . '/../../mysql_compat.php';

$message = "";
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete_employee') {
        $employee_id = $_GET['emp_file_no'];
        $from_tbl_accounts = mysql_query("delete from tbl_accounts where emp_file_no='$employee_id'") or die(mysql_error());
        $from_employee = mysql_query("delete from tbl_employee where emp_file_no='$employee_id'") or die(mysql_error());
        $from_tbl_user_accounts = mysql_query("delete from tbl_user_accounts where emp_file_no='$employee_id'") or die(mysql_error());
        $from_tbl_appraisal = mysql_query("delete from tbl_assign_to_department where emp_file_no='$employee_id'") or die(mysql_error());
        $from_tbl_user_accounts = mysql_query("delete from tbl_user_accounts where emp_file_no='$employee_id'") or die(mysql_error());



        $message = '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>User Successfully Deleted!</strong>
</div>';
    }
    if ($_GET['action'] == 'terminate_employee') {
        $employee_id = $_GET['emp_file_no'];
        $terminated = 'Terminated';
        $insert = mysql_query("UPDATE tbl_employee SET account_status='$terminated' where emp_file_no='$employee_id'") or die(mysql_error());
        $message = '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>User Successful Terminated!</strong>
</div>';
    }
}
?>
<div class="bg-white shadow" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="employee"><i class="icon-home fg-blue"></i>&nbsp;Home</a>
            </li>
            <li>
                <?php
                $shw =  mysql_query("SELECT * FROM tbl_user_accounts ORDER BY user_id DESC") or die(mysql_error());
                  $dsa=  mysql_fetch_array($shw);       
                $empp=$dsa['user_id']+1;
                $emp='SSW'.' '.$empp;
                ?>
                <a href="#"  class="fg-hover-crimson fg-cobalt edit_request" data-toggle="modal"  data-target="#addemployee" data-id="<?php echo $emp;?>" ><i class="icon-user fg-orange fg-hover-crimson" ></i>&nbsp;Add Employee</a>
            </li>
            <!--            <li>
                            <a class="" href="payroll page" class="fg-hover-crimson fg-cobalt"><i class="icon-stats-up fg-blue"></i>&nbsp;Manage Salary</a>
                        </li>          -->
            <!--            <li>
                            <a class="" href="employee"><i class="icon-medal fg-blue"></i>Loan Management</a>                 
                        </li>-->

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
                <th class="text-left">Reg#</th>
                <th class="text-left">Full Name</th>
                <th class="text-left">Gender</th>
                <th class="text-left">Designation</th>
                <th class="text-left">Position</th>
                <th class="text-left">Department</th>
                <th class="text-left">Hire Date</th>
<!--                <th class="text-left">Salary</th>               -->
                <th class="text-left">Phone#</th>
                <th class="text-left">Email 1</th>
<!--                <th class="text-left">Email 2</th>-->
            </tr>
        </thead>

        <tbody>
<?php
include_once __DIR__ . '/../db.php';
$terminated = "Terminated";
$show = "SELECT * FROM tbl_employee";
$display = mysql_query($show) or die(mysql_error());
while ($row = mysql_fetch_array($display)) {
    $emp_file_no = $row['emp_file_no'];
    $first_name = $row['first_name'];
    $surname = $row['surname'];
    $name = "$first_name" . "&nbsp" . "$surname";
    $contact = mysql_query("select * from tbl_contact where emp_file_no='$emp_file_no'")or die(mysql_error());
    $show_contact = mysql_fetch_array($contact);
    $email = $show_contact['email'];
    $mobile_phone = $show_contact['phone'];
    $email2 = $show_contact['email2'];
    $gender = $row['gender'];


////////////////////////////////////


    $salary1 = mysql_query("select * from tbl_accounts where emp_file_no='$emp_file_no'")or die(mysql_error());
    $show_salary = mysql_fetch_array($salary1);
    setlocale(LC_MONETARY, "en_US");
    $salary = $show_salary['salary'];
///////////////////////////////////////////////              

    $position = mysql_query("SELECT * FROM tbl_assign_to_department WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
    $positions = mysql_fetch_array($position);
    $department_id = $positions['department_id'];
    $position_id = $positions['position_id'];
    $designation_id = $positions['designation'];
    $start_date = $positions['start_date'];
    $departments = mysql_query("SELECT * FROM tbl_department WHERE department_id='$department_id'") or die(mysql_error());
    $positioning = mysql_query("SELECT * FROM tbl_position WHERE position_id='$position_id'") or die(mysql_error());
    $tbl_title = mysql_query("SELECT * FROM tbl_title WHERE title_code='$designation_id'") or die(mysql_error());
    $dep = mysql_fetch_array($departments);
    $pos = mysql_fetch_array($positioning);
    $des = mysql_fetch_array($tbl_title);
    $department_name = $dep['department_name'];
    $position_name = $pos['position_name'];
    $designation = $des['title_name'];
    ?>
                <tr>
                    <td class="text-center">
                        <nav class="vertical-menu compact">
                            <ul>
                                <li>
                                    <a class="dropdown-toggle" href="#"></a>
                                    <ul class="dropdown-menu" data-role="dropdown">
                                        <li><a href="profile&emp_file_no=<?php echo $emp_file_no; ?>"><i class="icon-user-2"></i>&nbsp;Employee Profile</a></li>
                                        <li><a href="edit&emp_file_no=<?php echo $emp_file_no; ?>"><i class="icon-user-3 fg-green"></i>&nbsp;Edit Profile</a></li>
                                        <li><a href="PaySlips&emp_file_no=<?php echo $emp_file_no; ?>"><i class="icon-new fg-blue"></i>&nbsp;Payslip List</a></li>
                                        <li><a href="terminate_employee&emp_file_no=<?php echo $emp_file_no; ?>"><i class="icon-switch fg-red"></i>&nbsp;Terminate Employee</a></li>
                                        <li><a href="delete_employee&emp_file_no=<?php echo $emp_file_no; ?>"><i class="icon-cancel-2 fg-red"></i>&nbsp;Remove</a></li>
                                        <li><a href="#"><i class="icon-file-pdf fg-red"></i>&nbsp;Export to Pdf</a></li>
                                    </ul>
                                </li>          
                            </ul>
                        </nav>
                    </td>
                    <td><?php echo $emp_file_no; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $gender; ?></td>
                    <td><?php echo $designation; ?></td>
                    <td><?php echo $position_name; ?></td>
                    <td><?php echo $department_name; ?></td>
                    <td><?php echo $start_date; ?></td>

                    <td><?php echo $mobile_phone; ?></td>
                    <td><?php echo $email; ?></td>
    <!--                    <td><?php echo $email2; ?></td>-->

                </tr>
    <?php
}
?>
        </tbody>
    </table>
</div>
<!-- Modal -->
<!-- Modal -->
<div id="addemployee" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Employee</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab9">
                    <li class="active">
                        <a aria-expanded="true" data-toggle="tab" href="#home9">
                            Information
                        </a>
                    </li>

                    <li class="tab-red">
                        <a aria-expanded="false" data-toggle="tab" href="#profile9">
                            Contact
                        </a>
                    </li>

                    <li class="">
                        <a aria-expanded="false" data-toggle="tab" href="#others">
                            Department
                        </a>
                    </li>
                    <li class="">
                        <a aria-expanded="false" data-toggle="tab" href="#salary">
                            Salary
                        </a>
                    </li>
                    <li class="">
                        <a aria-expanded="false" data-toggle="tab" href="#account">
                            Account Setting
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="home9" class="tab-pane active">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="" id="add_eployee" method="POST">
                                 <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">ID No:</span></span>
                                    <input name="" disabled=""  id="empp"  class="form-control editable"  value="" aria-describedby="sizing-addon1" type="text">
                                    <input name="employ_id"  id="empp"  class="form-control editable"  value="" aria-describedby="sizing-addon1" type="hidden">

                                </div>
                                 <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">First Name:</span></span>
                                    <input name="fname" id="product_name"   class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                                 <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Middle Name:</span></span>
                                    <input name="mname" id="product_name"   class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                                 <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Last Name:</span></span>
                                    <input name="lname" id="product_name"   class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                                 <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Birth Date:</span></span>
                                    <div class="input-control text" data-role="datepicker" data-week-start="1" >
                                                <input readonly="readonly" type="text" name="bdate">
                                                <button type="button" class="btn-date"></button>
                                                <div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: block;">
                                                    <table class="bordered">
                                                        <tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">September 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td></tr><tr><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td></tr><tr><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td><td class="text-center day"><a href="#">16</a></td><td class="text-center day today"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td></tr><tr><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td><td class="text-center day"><a href="#">23</a></td><td class="text-center day"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td></tr><tr><td class="text-center day"><a href="#">28</a></td><td class="text-center day"><a href="#">29</a></td><td class="text-center day"><a href="#">30</a></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>
                                                </div>
                                            </div>

                                </div>
                                                           <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Gender:</span></span>
                                    <select class="form-control" name="gender">
                                        <option value="">--Select Gender---</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>

                                            </select>
                                                <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Marital Status:</span></span>
                                                <select class="form-control" name="marital">
                                                    <option value="" >----Marital Status---</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>

                                            </select>
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Religion:</span></span>
                                     
                                            <input type="text" class="form-control" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" name="religion">
                                </div>
                                 <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">District:</span></span>
                                     
                                            <input type="text" class="form-control" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" name="district">
                                </div>
                                 <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">City:</span></span>
                                     <input type="text" class="form-control" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" name="city">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Country:</span></span>
                                     <input type="text" class="form-control" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" name="country">
                                </div>
                                    <div class="input-group text-right" style="width:100%; margin:2px 0">
                                       
                                   <button type="submit" class="btn btn-primary" >Submit Data</button>
                                </div>
                                    
                                    
                                </form>
                            </div>
                        
                            
                        </div>
                    </div>
                    <div id="profile9" class="tab-pane">
                        <div class="row">
                            13
                        </div>
                    </div>
                    <div id="others" class="tab-pane">
                        <div class="row">
                            14
                        </div>
                    </div>
                    <div id="salary" class="tab-pane">
                        <div class="row">
                            14
                        </div>
                    </div>
                    <div id="account" class="tab-pane">
                        <div class="row">
                            14
                        </div>
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--model linces-->

