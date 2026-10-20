<?php
require_once __DIR__ . '/../../mysql_compat.php';

if (isset($_POST['relatives'])) {
    $emp_file_no = $_POST['emp_no'];
    $firstname = $_POST['fname'];
    $middlename = $_POST['mname'];
    $surname = $_POST['lname'];
    $date_of_birth = $_POST['bdate'];
    $gender = $_POST['sex'];
    $relation = $_POST['Rname'];
    $relatives = "INSERT INTO tbl_relatives(`emp_file_no`,`firstname`,`middlename`,`surname`,`date_of_birth`,`gender`,`relation`) "
            . "VALUES('$emp_file_no','$firstname','$middlename','$surname','$date_of_birth','$gender','$relation')";
    $show = mysql_query($relatives) or die(mysql_error());
    if ($relatives && $show) {
        echo'<div class="shadow success" style="height: 30px; margin-bottom: 4px; width: 100%; background-color: window; color: #9a165a;">';
        echo'<center>DATA SUCCESSFUL SUBMITED.....!</center>';
        echo'</div>';
    }
}
if (isset($_POST['add_leave'])) {
    $emp_file_no = $_GET['emp_file_no'];
    $sdate = $_POST['sdate'];
    $fdate = $_POST['fdate'];
    $datetime1 = new DateTime($sdate);
    $datetime2 = new DateTime($fdate);
    $interval1 = $datetime1->diff($datetime2);
    $interval = $interval1->format('%R%a days');
    $reason = $_POST['reason'];
    $other_reason = $_POST['other_reason'];
    $r1 = $_POST['r1'];
    $descr = $_POST['descr'];
    $hod_status = 'pending';
    $hrm_status = 'pending';
    $fs_status = 'pending';
    $validate = mysql_query("SELECT SUM(no_of_days) FROM tbl_leaves") or die(mysql_error());
    $row = mysql_fetch_array($validate);
    $no_days1 = $row['SUM(no_of_days)'];
    $no_days = $no_days1 + $interval;
    $day_remain = 28 - $no_days;
    if ($no_days > 28) {
        echo'<div class="shadow error" style="height: 30px; margin-bottom: 4px; width: 100%; background-color:red; color: white;">';
        echo'<center>YOU HAVE ALREADY FINISH YOUR HOLYDAY!</center>';
        echo'</div>';
    } else {

        $relatives = "INSERT INTO tbl_leaves(leave_type,reason,other_reason,description,start_date,end_date,no_of_days,hod_status,fs_status,hrm_status,emp_file_no)"
                . "VALUES('$r1','$reason','$other_reason','$descr','$sdate','$fdate','$interval','$hod_status','$fs_status','$hrm_status','$emp_file_no')";
        $show = mysql_query($relatives) or die(mysql_error());
        if ($relatives && $show) {
            echo'<div class="shadow success" style="height: 30px; margin-bottom: 4px; width: 100%; background-color: window; color: #9a165a;">';
            echo'<center>';
            echo'REQUEST ALREADY SUBMITTED!..';
            echo $day_remain;
            echo 'days Remains';
            echo'</center>';
            echo'</div>';
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
$nationality = $PERSON['nationality'];
$country = $PERSON['country'];
$city = $PERSON['city'];
$district = $PERSON['district'];
$street = $PERSON['street'];
$house_no = $PERSON['house_no'];
$profile_pic = $PERSON['profile_pic'];
//contact
$contactinfo = mysql_query("SELECT * FROM tbl_empley_contact WHERE emp_file_no='$emp_file_no'")or die(mysql_error());
$contact = mysql_fetch_array($contactinfo);
$designation = $contact['designation'];
$telephone_no = $contact['telephone_no'];
$mobile_phone = $contact['mobile_phone'];
$fax_no = $contact['fax_no'];
$postal_addr = $contact['postal_addr'];
$email = $contact['email'];
$email2 = $contact['email2'];
$home_location = $contact['home_location'];
//
$contractinfo = mysql_query("SELECT * FROM tbl_contract_to_work WHERE emp_file_no='$emp_file_no'")or die(mysql_error());
$contract = mysql_fetch_array($contractinfo);
$start_date = $contract['start_date'];
$end_date = $contract['end_date'];
$active = $contract['active'];
$negotiated_terms = $contract['negotiated_terms'];
//assign department
$departmentinfo = mysql_query("SELECT * FROM tbl_assign_to_department WHERE emp_file_no='$emp_file_no'")or die(mysql_error());
$department = mysql_fetch_array($departmentinfo);
$department_id = $department['department_id'];
$position_id = $department['position_id'];
$designation = $department['designation'];


$tbl_department = mysql_query("SELECT * FROM tbl_department WHERE department_id='$department_id'")or die(mysql_error());
$departmentname = mysql_fetch_array($tbl_department);
$department_name = $departmentname['department_name'];
$office_number = $departmentname['office_number'];
$office_phone_number = $departmentname['office_phone_number'];

$tbl_position = mysql_query("SELECT * FROM tbl_position WHERE position_id='$position_id'")or die(mysql_error());
$position = mysql_fetch_array($tbl_position);
$position_name = $position['position_name'];
//SALARY
$tbl_salary = mysql_query("SELECT * FROM tbl_accounts WHERE emp_file_no='$emp_file_no' ") or die(mysql_error());
$salary = mysql_fetch_array($tbl_salary);

$salaryy = $salary['salary'];
$allowance = $salary['allowance'];
$ext_ao_slr = $salary['ext_ao_slr'];
$ext_ao_pension = $salary['ext_ao_pension'];
$ext_ao_tax = $salary['ext_ao_tax'];
$ext_ao_other = $salary['ext_ao_other'];
$remark = $salary['remark'];
//$status=$salary['status'];
$payroll_no = $salary['payroll_no'];
?>
<div class="container" style="">
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
            <img src="<?php echo $profile_pic; ?>" class="span3" style="width: 100%;">
        </div>
        <div style="width:100%; ">
            <div class="span3">
<!-------------------------------------------shortcute action's-------------------------------->
                    <script>
                        $(function () {
                            $("#add_relative").on('click', function () {
                                $.Dialog({
                                    shadow: true,
                                    overlay: false,
                                    draggable: true,
                                    icon: '<span class="icon-user"></span>',
                                    title: 'Draggable window',
                                    width: 500,
                                    padding: 10,
                                    content: 'ADD YOU RELATIVES.',
                                    onShow: function () {
                                        var content = ' <form method="post" action="?action=add_relatives&emp_file_no=<?php echo $emp_file_no; ?>">' +
                                                '<div class="span6">' +
                                                '<div class="input-control text" data-role="datepicker" data-week-start="1">' +
                                                '<input readonly="readonly" name="bdate" placeholder="birthdate" type="text">' +
                                                '<button type="button" class="btn-date"></button>' +
                                                '<div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: none;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">February 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day today"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table></div></div>' +
                                                '</div>' +
                                                '<input type="hidden"  value="<?php echo $emp_file_no; ?>" name="emp_no">' +
                                                '<div class="span6">' +
                                                '<div class="input-control text"><input type="text" placeholder="First Name" name="fname"><button class="btn-clear"></button></div>' +
                                                '<div>' +
                                                '<div class="span6">' +
                                                '<div class="input-control text"><input type="text" placeholder="Middle Name" name="mname"><button class="btn-clear"></button></div>' +
                                                '<div>' +
                                                '<div class="span6">' +
                                                '<div class="input-control text"><input type="text" placeholder="Last Name" name="lname"><button class="btn-clear"></button></div>' +
                                                '<div>' +
                                                '<div class="input-control select" data-role="input-control">' +
                                                '<select name="sex">' +
                                                '<option value="male">male</option>' +
                                                '<option value="female">female</option>' +
                                                '<select name="job">' +
                                                '</div>' +
                                                '<div class="input-control text"><input type="text" placeholder="Relation type" name="Rname"><button class="btn-clear"></button></div>' +
                                                '<div class="form-actions">' +
                                                '<button class="button primary" name="relatives">submit</button>&nbsp;' +
                                                '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> ' +
                                                '</div>' +
                                                '</form>';

                                        $.Dialog.title("ADD YOU RELATIVES.");
                                        $.Dialog.content(content);
                                    }

                                });
                            });

                            $("#add_leave_request").on('click', function () {
                                $.Dialog({
                                    shadow: true,
                                    overlay: false,
                                    draggable: true,
                                    icon: '<span class="icon-accessibility-2"></span>',
                                    title: 'Draggable window',
                                    width: 650,
                                    padding: 10,
                                    content: 'ADD YOU RELATIVES.',
                                    onShow: function () {
                                        var content = ' <form method="post" action="?action=add_relatives&emp_file_no=<?php echo $emp_file_no; ?>">' +
                                                ' <div class="grid">' +
                                                ' <div class="row">' +
                                                ' <div class="span8">' +
                                                ' <div class="span4"> ' +
                                                '<div class="input-control text" data-role="datepicker" data-week-start="1">' +
                                                '<input readonly="readonly" name="sdate" placeholder="From" type="text">' +
                                                '<button type="button" class="btn-date"></button>' +
                                                '<div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: none;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">February 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day today"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>' +
                                                '</div>' +
                                                '</div>' +
                                                ' </div>' +
                                                ' <div class="span4">' +
                                                '<div class="input-control text" data-role="datepicker" data-week-start="1">' +
                                                '<input readonly="readonly" name="fdate" placeholder="To" type="text">' +
                                                '<button type="button" class="btn-date"></button>' +
                                                '<div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: none;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">February 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day today"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>' +
                                                '</div>' +
                                                '</div>' +
                                                ' </div>' +
                                                ' </div>' +
                                                ' </div>' +
                                                ' <div class="row">' +
                                                ' <div class="span8">' +
                                                //
                                                ' <div class="span4"> ' +
                                                '<div class="input-control select"  data-role="input-control">' +
                                                '<select name="reason">' +
                                                '<option>---select reason---</option>' +
                                                '<option value="Sick leave request">Sick leave request</option>' +
                                                '<option value="Annual leave request">Annual leave request</option>' +
                                                '</select>' +
                                                '</div>' +
                                                ' </div>' +
                                                //
                                                ' <div class="span4">' +
                                                ' <div class="input-control text" data-role="input-control">' +
                                                ' <input placeholder="Other reasons" type="text" name="other_reason">' +
                                                ' <button type="button" class="btn-clear" tabindex="-1"></button>' +
                                                ' </div>' +
                                                ' </div>' +
                                                //
                                                ' </div>' +
                                                ' </div>' +
                                                ' <div class="row">' +
                                                ' <div class="span8">' +
                                                '<div class="span4 text-right"><label>Leave type:</label></div>' +
                                                '<div class="span4">' +
                                                //
                                                ' <div class="input-control radio default-style" data-role="input-control">' +
                                                '<label>' +
                                                '<input type="radio" name="r1" value="Paid" checked />' +
                                                '<span class="check"></span>' +
                                                'Paid' +
                                                '</label>' +
                                                '</div>' +
                                                //
                                                ' <div class="input-control radio  default-style" data-role="input-control">' +
                                                '<label>' +
                                                '<input type="radio" name="r1" value="Non Paid" />' +
                                                '<span class="check"></span>' +
                                                'Non Paid' +
                                                '</label>' +
                                                '</div>' +
                                                //
                                                '</div>' +
                                                ' </div>' +
                                                ' </div>' +
                                                ' <div class="row">' +
                                                ' <div class="span8">' +
                                                '<div  class="input-control textarea"  data-role="input-control">' +
                                                '<textarea name="descr" placeholder="description"></textarea>' +
                                                '</div>' +
                                                ' </div>' +
                                                ' </div>' +
                                                '  </div>' +
                                                '<div class="form-actions">' +
                                                '<button class="button primary" name="add_leave">submit</button>&nbsp;' +
                                                '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> ' +
                                                '</div>' +
                                                '  </form>';

                                        $.Dialog.title("ADD YOU LEAVE REQUEST.");
                                        $.Dialog.content(content);
                                    }

                                });
                            });
                        })
                    </script>
                
<!----------------------------------------end shortcute action--------------------------------->
              <div class="bg-white shadow" style="width: 100%;" >
            <nav class="horizontal-menu compact">
                <ul>
                    <li>
                        <a class="" href=""><i class="fg-blue"></i>&nbsp;USER SHORTCUTS</a>
                    </li>                       
                </ul>
            </nav>
        </div>
            <nav class="sidebar">
                        <ul>
                            <li class=""><a href="#" id="add_relative"><i class="icon-user"></i>Add dependants&nbsp;<span class="fg-red">1</span></a></li>
                            <li class=""><a href="#" id="add_leave_request"><i class="icon-accessibility-2"></i>Apply Leave Request</a></li>
                            <li class=""><a href="#"><i class="icon-folder-2"></i>Add Expense Report</a></li>
                            <li class=""><a href="#"><i class="icon-folder"></i>Add Awards</a></li>
                        </ul>
            </nav>
            </div>
        </div>

    </div>
    <div class="span6">
<div class="bg-white shadow" style="width: 100%;" >
            <nav class="horizontal-menu compact">
                <ul>
                    <li>
                        <a class=" " href=""><i class=" fg-blue"></i>&nbsp;PERSONAL INFORMATION</a>
                    </li>                       
                </ul>
            </nav>
        </div>
        <div class="bg-white shadow" style="width: 100%;"> 
                                <table class="span6 bg-white shadow">            
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">First Name:</span></td>
                            <td class="span3 text-left"><?php echo $first_name; ?></td>
                        </tr>  
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">Middle Name:</span></td>
                            <td class="span3 text-left"><?php echo $middle_name; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">Last Name:</span></td>
                            <td class="span3 text-left"><?php echo $surname; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">Date of birth:</span></td>
                            <td class="span3 text-left"><?php echo $date_of_birth; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">Sex/Gender:</span></td>
                            <td class="span3 text-left"><?php echo $gender; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">Marital status:</span></td>
                            <td class="span3 text-left"><?php echo $marital_status; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">Religion:</span></td>
                            <td class="span3 text-left"><?php echo $religion; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">Country:</span></td>
                            <td class="span3 text-left"><?php echo $country; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">Nationality:</span></td>
                            <td class="span3 text-left"><?php echo $nationality; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">City:</span></td>
                            <td class="span3 text-left"><?php echo $city; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">District:</span></td>
                            <td class="span3 text-left"><?php echo $district; ?></td>
                        </tr>
                        <tr>
                            <td class="span2 text-right"><span class="text-bold">Street:</span></td>
                            <td class="span3 text-left"><?php echo $street; ?></td>
                        </tr>
                    </table>
        </div>
    </div>
    
    
    <div class="span5">
<div class="bg-white shadow" style="width: 100%;" >
            <nav class="horizontal-menu compact">
                <ul>
                    <li>
                        <a class=" " href=""><i class="fg-blue"></i>&nbsp;CONTACTS</a>
                    </li>                       
                </ul>
            </nav>
        </div>
        <div class="" style="width: 100%;" >
           <nav class="sidebar">
                        <ul>
                            <li class=""><a href="#"><i class="icon-mobile-2"></i><?php echo $mobile_phone;?></a></li>
                            <li class=""><a href="#"><i class="icon-mobile"></i><?php echo $telephone_no;?></a></li>
                            <li class=""><a href="#"><i class="icon-phone"></i><?php echo $fax_no;?></a></li>
                            <li class=""><a href="#"><i class="icon-mail-2"></i><?php echo $email;?></a></li>
                            <li class=""><a href="#"><i class="icon-mail"></i><?php echo $email2;?></a></li>
                            <li class=""><a href="#"><i class="icon-box"></i><?php echo $postal_addr;?></a></li>
                            <li class=""><a href="#"><i class="icon-location"></i>google map</a></li>

                        </ul>
                    </nav>
        </div>
    </div>
    <div class="span11" style="">
        <div class="span6" style="">
              <div class="bg-white shadow" style="width: 100%;" >
            <nav class="horizontal-menu compact">
                <ul>
                    <li>
                        <a class=" " href=""><i class="fg-blue"></i>&nbsp;OFFICE INFORMATION</a>
                    </li>                       
                </ul>
            </nav>
        </div>
        <div class="" style="width: 100%;" >
                               <table class="span6 shadow">            
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Employee Number:</span></td>
                        <td class="span3 text-left"><?php echo $emp_file_no;?></td>
                    </tr>  
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Employment Mode:</span></td>
                        <td class="span3 text-left"><?php echo $designation;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Term of Contract:</span></td>
                        <td class="span3 text-left"><?php echo $negotiated_terms;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Hire Date:</span></td>
                        <td class="span3 text-left"><?php echo $start_date;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">End Date:</span></td>
                        <td class="span3 text-left"><?php echo $end_date;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Active:</span></td>
                        <td class="span3 text-left"><?php echo $active;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Department:</span></td>
                        <td class="span3 text-left"><?php echo $department_name;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Position</span></td>
                        <td class="span3 text-left"><?php echo $position_name;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Office number:</span></td>
                        <td class="span3 text-left"><?php echo $office_number;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Office phone#</span></td>
                        <td class="span3 text-left"><?php echo $office_phone_number;?></td>
                    </tr>

                </table>
        </div>
        </div>
        
        <div class="span5" style="">
            <div class="bg-white shadow" style="width: 100%;" >
            <nav class="horizontal-menu compact">
                <ul>
                    <li>
                        <a class=" " href=""><i class=" fg-blue"></i>&nbsp;SALARY AND ACCOUNTS INFORMATION</a>
                    </li>                       
                </ul>
            </nav>
        </div>
           <div class="" style="width: 100%;" >
               <table class="span5 shadow">            
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Payroll Number:</span></td>
                        <td class="span2 text-left"><?php echo $payroll_no;?></td>
                    </tr>  
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Salary Amount:</span></td>
                        <td class="span2 text-left">TSh. <?php echo $salaryy;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Allowance:</span></td>
                        <td class="span2 text-left">TSh. <?php echo $allowance;?></td>
                    </tr>                
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Estimated arrear of salary:</span></td>
                        <td class="span2 text-left">TSh. <?php echo $ext_ao_slr;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Estimated arrear of Pension:</span></td>
                        <td class="span2 text-left">Tsh.<?php echo $ext_ao_pension;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Estimated arrear of Tax:</span></td>
                        <td class="span2 text-left">TSh. <?php echo $ext_ao_tax;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Estimated arrear of other:</span></td>
                        <td class="span2 text-left">Tsh.<?php echo $ext_ao_other;?></td>
                    </tr>
                    <tr>
                        <td class="span3 text-right"><span class="text-bold">Remark:</span></td>
                        <td class="span2 text-left"><?php echo $remark;?></td>
                    </tr>


                </table>
        </div>
        </div>
    </div>
     
    
</div>