<?php
$message = "";
if (isset($_POST['SubmitData'])) {
    include 'authorized/db.php';
    $employ_id = $_POST['employ_id'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $bdate = $_POST['bdate'];
    $gender = $_POST['gender'];
    $marital = $_POST['marital'];
    $religion = $_POST['religion'];
    $nationality = $_POST['nationality'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $street = $_POST['street'];
    $house_no = $_POST['house'];
    $profile_pic = "images/person.png";
    $employe_status = "inactive";
    $insertq = "INSERT INTO tbl_employee(emp_file_no,first_name,middle_name,surname,emp_status,date_of_birth,gender,marital_status,religion,nationality,country,city,district,street,house_no,profile_pic)"
            . " VALUES('$employ_id','$fname','$mname','$lname','$employe_status','$bdate','$gender','$marital','$religion','$nationality','$country','$city','$district','$street','$house_no','$profile_pic')";
    mysql_query($insertq) or die(mysql_error());
    //////////////////////////////Add Contact/////////////////////////////////////////
    $email1 = $_POST['email1'];
    $telephone_no = $_POST['telephone_no'];
    $mobile_phone = $_POST['mobile_phone'];
    $fax_no = $_POST['fax_no'];
    $postal_addr = $_POST['postal_addr'];
    $email = $_POST['email'];
    $insert = "INSERT INTO tbl_empley_contact(emp_file_no,telephone_no,mobile_phone,fax_no, postal_addr, email,email2)"
            . " VALUES('$employ_id','$telephone_no','$mobile_phone','$fax_no','$postal_addr','$email','$email1')";
    mysql_query($insert) or die(mysql_error());
    //////////////////////////////////////Contact Information///////////////////////////////////////////////
    $job = $_POST['job'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $description = $_POST['description'];
    $active = "NO";
//    $payroll_no1 = $_POST['payroll_no'];
    $st_salary = $_POST['st_salary'];
    $salary = $_POST['salary'];
    $est_pension = $_POST['est_pension'];
    $allowance = $_POST['allowance'];
    $st_tax = $_POST['st_tax'];
    $st_other = $_POST['st_other'];
    $remark = $_POST['remark'];
    $access_lever = 6;
    $statuss = 'active';
    $usertype = 'staff';
    $tbl_accounts = mysql_query("SELECT * FROM tbl_accounts WHERE emp_file_no='$employ_id'") or die(mysql_error());
    $rows = mysql_num_rows($tbl_accounts);
    if ($rows == 0) {
        
        $inserty = "INSERT INTO tbl_contract_to_work(emp_file_no,title_code, start_date,end_date, active,negotiated_terms)"
                . " VALUES('$employ_id','$job','$sdate','$edate','$active','$description')";
        mysql_query($inserty) or die(mysql_error());
            $insert1 = "INSERT INTO tbl_accounts(payroll_no,emp_file_no,salary,allowance,ext_ao_slr,ext_ao_pension,ext_ao_tax,ext_ao_other,remark,status)"
            . " VALUES('$employ_id','$employ_id','$salary','$allowance','$st_salary','$est_pension','$st_tax','$st_other','$remark','$active')";
    mysql_query($insert1) or die(mysql_error());
    $user_accounts = mysql_query("INSERT INTO tbl_user_accounts(`emp_file_no`, `password`,usertype,`access_lever`, `status`)VALUES('$employ_id','','$usertype','$access_lever','$statuss')")or die(mysql_error());

    ///////////////////////Add Department/////////////////////////////////////////////////////////////////
    $position = $_POST['position'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $insertS = "INSERT INTO tbl_assign_to_department(emp_file_no,department_id,position_id)"
            . " VALUES('$employ_id','$department','$position')";
    mysql_query($insertS) or die(mysql_error());
    //////////////////////////////////////////////////////////////////////// 
    $message='<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>User Successfully Created</strong>
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
                    <a class="" href="?action=add_employee" class="fg-hover-crimson fg-cobalt"><i class="icon-user fg-cobalt fg-hover-crimson"></i>&nbsp;Add Employee</a>
                </li>
                <li id="action">
                    <!--               show data-->
                </li>
                <li>
                    <a class="" href="#"><i class="icon-reply-2 fg-green"></i></a>                 
                </li>

            </ul>
        </nav>
    </div>
<div class="container">
<?php
    echo $message;
?>
    
</div>
<div class="container bg-white" style=""
    <!-----------------------------end of main contents -------------------------------------------->

    <form action="?action=add_employee" method="post">
        <fieldset>
            <legend><center>Add New Employee</center></legend>


            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Employee ID:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="employ_id">
                            <button type="button" class="btn-clear" tabindex="-1"></button>
                        </div>
                    </div>
                </div> 
                <div class="span7">
                    <div class="span2 text-right">
                        <label>First Name:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="fname">
                            <button type="button" class="btn-clear" tabindex="-1"></button>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Middle Name:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="mname">
                            <button type="button" class="btn-clear" tabindex="-1"></button>
                        </div>
                    </div>
                </div> 
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Last Name:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="lname">
                            <button type="button" class="btn-clear" tabindex="-1"></button>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Birthdate:</label>
                    </div>
                    <div class="span5">                                                                                                         
                        <div class="input-control text" data-role="datepicker" data-date="2013-11-13" data-effect="slide" data-other-days="1">
                            <input readonly="readonly" type="text" name="bdate">
                            <button type="button" class="btn-date"></button>
                            <div class="calendar calendar-dropdown" style="position: absolute; display: none; max-width: 260px; z-index: 1000; top: 100%; left: 0px;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">November 2013</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Su</td><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td></tr><tr><td class="empty"><small class="other-day">27</small></td><td class="empty"><small class="other-day">28</small></td><td class="empty"><small class="other-day">29</small></td><td class="empty"><small class="other-day">30</small></td><td class="empty"><small class="other-day">31</small></td><td class="text-center day"><a href="#">1</a></td><td class="text-center day"><a href="#">2</a></td></tr><tr><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td><td class="text-center day"><a href="#">9</a></td></tr><tr><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a class="selected" href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td><td class="text-center day"><a href="#">16</a></td></tr><tr><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td><td class="text-center day"><a href="#">23</a></td></tr><tr><td class="text-center day"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="text-center day"><a href="#">29</a></td><td class="text-center day"><a href="#">30</a></td></tr></tbody></table></div></div>
                    </div>
                </div>
                <div class="span7">

                    <div class="span2 text-right">
                        <label>Gender:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control select" data-role="input-control">
                            <select name="gender">
                                <option value="1"></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>

                            </select>
                        </div>
                    </div>

                </div>
            </div> 
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Marital Status:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control select" data-role="input-control">
                            <select name="marital">
                                <option value=""></option>
                                <option value="single">Single</option>
                                <option value="marriage">Married</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="span7">

                    <div class="span2 text-right">
                        <label>Religion:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control select" data-role="input-control">
                            <select name="religion">
                                <option value=""></option>
                                <option value="christian">Christian</option>
                                <option value="muslim">Muslim</option>
                            </select>
                        </div>
                    </div>

                </div>

            </div>


            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Nationality:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="nationality">
                            
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Country:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="country">
                            
                        </div>
                    </div>

                </div>
            </div>  
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>City:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="city">
                            <button type="button" class="btn-clear" tabindex="-1"></button>
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>District:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="district">
                            
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Street:</label>
                    </div>

                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="street">
                            
                        </div>
                    </div>
                </div>
                <div class="span7">

                    <div class="span2 text-right">
                        <label>House#:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="house">
                          
                        </div>
                    </div>

                </div>
            </div> 
            <hr>
            <legend><center>Employee Contact Information</center></legend>

            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Postal Address</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text"  name="postal_addr">                                                                                                      
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Phone Number1</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="telephone_no">                  
                        </div>
                    </div>

                </div>
            </div>  
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Phone Number2</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text"  name="mobile_phone">                                                                                                     
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Fax Number</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="fax_no">                                                   
                        </div>
                    </div>

                </div>
            </div>   
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Email 1</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text"  name="email">                                                                                                      
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Email 2</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="email1">                                                
                        </div>
                    </div>

                </div>
            </div>                                
            <hr>
            <legend><center>EMPLOYEE CONTRACT FORM</center></legend>
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Job Title:</label>
                    </div>
                    <div class="span5">                                          
                        <div class="input-control select" data-role="input-control">
                            <select name="job">
                                <option value="">---select-----</option>
                                <?php
                                include 'authorized/db.php';
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
                    </div>
                </div> 
                <div class="span7">
                    <div class="span1">
                        <label>Startdate:</label>
                    </div>
                    <div class="span3">                                                             
                        <div class="input-control text" data-role="datepicker" data-date="2013-11-13" data-effect="slide" data-other-days="1">
                            <input readonly="readonly" type="text" name="sdate">
                            <button type="button" class="btn-date"></button>
                            <div class="calendar calendar-dropdown" style="position: absolute; display: none; max-width: 260px; z-index: 1000; top: 100%; left: 0px;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">November 2013</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Su</td><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td></tr><tr><td class="empty"><small class="other-day">27</small></td><td class="empty"><small class="other-day">28</small></td><td class="empty"><small class="other-day">29</small></td><td class="empty"><small class="other-day">30</small></td><td class="empty"><small class="other-day">31</small></td><td class="text-center day"><a href="#">1</a></td><td class="text-center day"><a href="#">2</a></td></tr><tr><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td><td class="text-center day"><a href="#">9</a></td></tr><tr><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a class="selected" href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td><td class="text-center day"><a href="#">16</a></td></tr><tr><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td><td class="text-center day"><a href="#">23</a></td></tr><tr><td class="text-center day"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="text-center day"><a href="#">29</a></td><td class="text-center day"><a href="#">30</a></td></tr></tbody></table></div></div>
                    </div>

                    <div class="span1">
                        <label>Enddate:</label>
                    </div>
                    <div class="span2">                                                             

                        <div class="input-control text" data-role="datepicker" data-date="2013-11-13" data-effect="slide" data-other-days="1">
                            <input readonly="readonly" type="text" name="edate">
                            <button type="button" class="btn-date"></button>
                            <div class="calendar calendar-dropdown" style="position: absolute; display: none; max-width: 260px; z-index: 1000; top: 100%; left: 0px;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">November 2013</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Su</td><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td></tr><tr><td class="empty"><small class="other-day">27</small></td><td class="empty"><small class="other-day">28</small></td><td class="empty"><small class="other-day">29</small></td><td class="empty"><small class="other-day">30</small></td><td class="empty"><small class="other-day">31</small></td><td class="text-center day"><a href="#">1</a></td><td class="text-center day"><a href="#">2</a></td></tr><tr><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td><td class="text-center day"><a href="#">9</a></td></tr><tr><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a class="selected" href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td><td class="text-center day"><a href="#">16</a></td></tr><tr><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td><td class="text-center day"><a href="#">23</a></td></tr><tr><td class="text-center day"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="text-center day"><a href="#">29</a></td><td class="text-center day"><a href="#">30</a></td></tr></tbody></table></div></div>                                               
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="span2 text-right">
                    <label>Description:</label>
                </div>
                <div class="span12">
                    <div class="input-control textarea">
                        <textarea name="description" placeholder="Negotiated terms...!!!"></textarea>
                    </div>

                </div>

            </div>
            <hr>
            <legend><center>Salary Agreement</center></legend>
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Payroll #</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="Payroll#" type="text"  name="payroll_no">  
                            <input placeholder="Payroll#" hidden="yes" value="<?php echo $employ_id; ?>" type="text"  name="payroll_no"> 

                        </div>
                    </div>                                           
                </div> 
                <div class="span7">
                    <div class="span3 text-right">
                        <label>Estimated arrear of salary</label>
                    </div>
                    <div class="span4">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="Estimated arrear of salary" type="text" name="st_salary">
                            <button type="button" class="btn-clear" tabindex="-1"></button>
                        </div>
                    </div>

                </div>
            </div> 
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Salary</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="Salary" type="text" name="salary">                                                   
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span3 text-right">
                        <label>Estimated arrear of pension:</label>
                    </div>
                    <div class="span4">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="Estimated arrear of pension:" type="text" name="est_pension">                                                  
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Allowance</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="Allowance" type="text" name="allowance">

                        </div>
                    </div>
                </div><div class="span7">
                    <div class="span3 text-right">
                        <label>Estimated arrear of tax</label>
                    </div>
                    <div class="span4">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="Estimated arrear of tax" type="text" name="st_tax">

                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="span2 text-right">
                    <label>Bonus</label>
                </div>
                <div class="span12">                                                                                                                                              
                    <div class="input-control text" data-role="input-control">
                        <input placeholder="bonus" type="text" name="st_other">
                        <button type="button" class="btn-clear" tabindex="-1"></button>
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="span2 text-right">
                    <label>Remarks</label>
                </div>
                <div class="span12">                                                                                                                                              
                    <div class="input-control textarea">
                        <textarea name="remark" placeholder="Comments.."></textarea>
                    </div>
                </div>
            </div> 
            <hr>
            <legend><center>Register Employee to the Department</center></legend>
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Department name:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control select" data-role="input-control">
                            <select name="department">
                                <?php
                                include 'authorized/db.php';
                                $SELECT = "SELECT * FROM tbl_department";
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
                    </div>
                </div> 

                <div class="span7">
                    <div class="span2 text-right">
                        <label>Position:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control select" data-role="input-control">
                            <select name="position">
                                <?php
                                include 'authorized/db.php';
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
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="span12"></div>

            </div>
            <div class="row" style="margin-top: 50px;">

                <div class="span6 text-right">

                </div>
                <div class="span6">
                    <div class="span3">
                        <input class="span3 primary large" value="Submit Data" name="SubmitData" type="submit">
                    </div>
                </div>

            </div>
            <div class="" style="margin-top: 50px;"></div>
        </fieldset>
    </form>
</div>
