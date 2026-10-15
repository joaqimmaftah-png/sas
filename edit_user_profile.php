<?php
if (isset($_POST['edit'])) {
    $emp_file_no = $_GET['emp_file_no'];
    $original_employee=$_POST['original'];
    $fname1 = $_POST['fname'];
    $mname1 = $_POST['mname'];
    $lname1 = $_POST['lname'];
    $bdate1 = $_POST['bdate'];
    $gender1 = $_POST['gender'];
    $marital1 = $_POST['marital'];
    $religion1 = $_POST['religion'];
    $nationality1 = $_POST['nationality'];
    $country1 = $_POST['country'];
    $city1 = $_POST['city'];
    $district1 = $_POST['district'];
    $street1 = $_POST['street'];
    $house_no1 = $_POST['house'];
    $update_employee_info=mysql_query("UPDATE tbl_employee SET first_name='$fname1', middle_name='$mname1',surname='$lname1',date_of_birth='$bdate1',"
            . "marital_status='$marital1',religion='$religion1',nationality='$nationality1',country='$country1',city='$city1',district='$district1',"
            . "street='$street1',gender='$gender1',house_no='$house_no1',emp_file_no='$original_employee' WHERE emp_file_no='$emp_file_no' ") or die(mysql_error());
    ///start contacT info
//    $designation1 = $_POST['designation'];
    $telephone_no1 = $_POST['telephone_no'];
    $mobile_phone1 = $_POST['mobile_phone'];
    $fax_no1 = $_POST['fax_no'];
    $postal_addr1 = $_POST['postal_addr'];
    $email1 = $_POST['email'];
    $email12 = $_POST['email2'];
    
    
    $update_employe_contact=  mysql_query("UPDATE tbl_empley_contact SET telephone_no='$telephone_no1',mobile_phone='$mobile_phone1',"
                              . "fax_no='$fax_no1',postal_addr='$postal_addr1',email='$email1',emp_file_no='$original_employee' WHERE emp_file_no='$emp_file_no' ")or die(mysql_error());
/////////Contract////////////////////////////////////////
    $title_code=$_POST['job'];
    $job1 = $_POST['job'];
    $sdate1 = $_POST['sdate'];
    $edate1 = $_POST['edate'];
    $description1 = $_POST['description'];
    $position=$_POST['position'];
    $department_id=$_POST['department'];
////////$active1 = $_POST['active'];/////////////////////
    $UPDATE_CONTRACT=  mysql_query("UPDATE tbl_contract_to_work SET title_code='$title_code',start_date='$sdate1',end_date='$edate1',negotiated_terms='$description1',emp_file_no='$original_employee' WHERE emp_file_no='$emp_file_no'") or die(mysql_error());

    $update_assign_to_department= mysql_query("UPDATE tbl_assign_to_department SET department_id='$department_id',position_id='$position',emp_file_no='$original_employee' WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
    //salary
    $payroll_no1 = $_POST['payroll_no'];
    $st_salary1 = $_POST['st_salary'];
    $salary1 = $_POST['salary'];
    $est_pension1 = $_POST['est_pension'];
    $allowance1 = $_POST['allowance'];
    $st_tax1= $_POST['st_tax'];
    $st_other1 = $_POST['st_other'];
    $remark1 = $_POST['remark'];
    $UPDATE_ACCOUNTS=mysql_query("UPDATE tbl_accounts SET payroll_no='$payroll_no1',salary='$salary1', allowance='$allowance1',ext_ao_slr='$st_salary1',"
    ."ext_ao_pension='$est_pension1',ext_ao_tax='$st_tax1',ext_ao_other='$st_other1',remark='$remark1',emp_file_no='$original_employee' WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
    
    if($update_employee_info || $update_employe_contact || $UPDATE_CONTRACT || $UPDATE_ACCOUNTS){
                      echo '<div class="error"> ';                     
    echo '<div class="panel margin5 bordered">';
        echo '<div class="panel-header bg-green fg-white" >';
           echo 'successful Update Information...scroll down to see the change that you make!!';
                      
       echo '</div> ';                           
    echo '</div>';
echo '</div>';
    }
}
?>
<div class="">
    <div class="bg-white" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="?action=employee"><i class="icon-home fg-blue"></i>&nbsp;Home</a>
            </li>
            <li>
                <a class="" href="?action=add_employee" class="fg-hover-crimson fg-cobalt"><i class="icon-plus-2 fg-cobalt fg-hover-crimson"></i>&nbsp;Add Employee</a>
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
    </div>
<div class="container bg-white" style="">

    <!-----------------------------end of main contents -------------------------------------------->

    <form action="?action=edit&emp_file_no=<?php echo $_GET['emp_file_no'];?>" method="post">
        <fieldset>
            <legend><center>Add New Employee</center></legend>
 <?php
                                $emp_file_no = $_GET['emp_file_no'];
                                $SELECT_USER = "SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'";
                                $user_info1 = mysql_query($SELECT_USER) OR die(mysql_error());
                                $user_info = mysql_fetch_array($user_info1);
                                $fname = $user_info['first_name'];
                                $mname = $user_info['middle_name'];
                                $lname = $user_info['surname'];
                                $bdate = $user_info['date_of_birth'];
                                $gender = $user_info['gender'];
                                $marital = $user_info['marital_status'];
                                $religion = $user_info['religion'];
                                $nationality = $user_info['nationality'];
                                $country = $user_info['country'];
                                $city = $user_info['city'];
                                $district = $user_info['district'];
                                $street = $user_info['street'];
                                $house_no = $user_info['house_no'];
                                //start contact info
                                $SELECT_CONTACT = mysql_query("SELECT * FROM tbl_empley_contact where emp_file_no='$emp_file_no'") OR die(mysql_error());
                                $SHOW_CONTACT = mysql_fetch_array($SELECT_CONTACT);
                                $designation = $SHOW_CONTACT['designation'];
                                $telephone_no = $SHOW_CONTACT['telephone_no'];
                                $mobile_phone = $SHOW_CONTACT['mobile_phone'];
                                $fax_no = $SHOW_CONTACT['fax_no'];
                                $postal_addr = $SHOW_CONTACT['postal_addr'];
                                $email = $SHOW_CONTACT['email'];
                                $email2=$SHOW_CONTACT['email2'];
                                //start contract info
                                $SELECT_CONTRACT = mysql_query("SELECT * FROM tbl_contract_to_work where emp_file_no='$emp_file_no'") OR die(mysql_error());
                                $SHOW_CONTRACT = mysql_fetch_array($SELECT_CONTRACT);                           
                                $job1 = $SHOW_CONTRACT['title_code'];
                                $SELECT_CONTRACT1 = mysql_query("SELECT * FROM tbl_title where title_code='$job1'") OR die(mysql_error());
                                $SHOW_CONTRACT1 = mysql_fetch_array($SELECT_CONTRACT1); 
                                $title_name=$SHOW_CONTRACT1['title_name'];
                                $sdate = $SHOW_CONTRACT['start_date'];
                                $edate = $SHOW_CONTRACT['end_date'];
                                $description = $SHOW_CONTRACT['negotiated_terms'];
                                $active = $SHOW_CONTRACT['active'];
                                $title_code=$SHOW_CONTRACT['title_code'];
                                //salary
                                $SELECT_SALARY= mysql_query("SELECT * FROM tbl_accounts WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                                $SHOW_SALARY=  mysql_fetch_array($SELECT_SALARY);
                                $payroll_no = $SHOW_SALARY['payroll_no'];
                                $st_salary = $SHOW_SALARY['ext_ao_slr'];
                                $salary = $SHOW_SALARY['salary'];
                                $est_pension = $SHOW_SALARY['ext_ao_pension'];
                                $allowance = $SHOW_SALARY['allowance'];
                                $st_tax = $SHOW_SALARY['ext_ao_tax'];
                                $st_other = $SHOW_SALARY['ext_ao_other'];
                                $remark = $SHOW_SALARY['remark'];
                                $assign_to_department=  mysql_query("SELECT * FROM tbl_assign_to_department WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                                $mimiZ=  mysql_fetch_array($assign_to_department);
                                $department_id=$mimiZ['department_id']; 
                                $position_id=$mimiZ['position_id']; 
                                $SELECTq = "SELECT * FROM tbl_department where department_id='$department_id'";
                                $mimi2 = mysql_query($SELECTq) or die(mysql_error());
                                $a=mysql_fetch_array($mimi2);
                                $department_ida = $a['department_id'];
                                $department_namea = $a['department_name'];
                                
                                $SELECTw = "SELECT * FROM tbl_position WHERE position_id='$position_id'";
                                 $mimiw = mysql_query($SELECTw) or die(mysql_error());
                                 $m= mysql_fetch_array($mimiw);
                                 $position_idZ = $m['position_id'];
                                 $position_nameZ = $m['position_name'];
                                
                                ?>

            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Employee ID:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="original" value="<?php echo $emp_file_no;?>"> 
                            <input type="text" name="employ_id" value="<?php echo $emp_file_no;?>" hidden="">
                        </div>
                    </div>

                </div> 
                <div class="span7">
                    <div class="span2 text-right">
                        <label>First Name:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="fname" value="<?php echo $fname;?>">
                           
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
                            <input placeholder="" type="text" name="mname" value="<?php echo $mname;?>">
                           
                        </div>
                    </div>
                </div> 
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Last Name:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="lname" value="<?php echo $lname;?>">
                           
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
                                      <div class="input-control text" data-role="input-control">
                            <input placeholder="" value="<?php echo $bdate; ?>" type="text" name="bdate">
                           
                        </div>
            </div>
                </div>
                <div class="span7">

                    <div class="span2 text-right">
                        <label>Gender:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control select" data-role="input-control">
                            <select name="gender" >
                                <option value="<?php echo $gender;?>"><?php echo $gender;?></option>
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
                                <option value="<?php echo $marital;?>"><?php echo $marital;?></option>
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
                                <option value="<?php echo $religion;?>"><?php echo $religion;?></option>
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
                            <input placeholder="" type="text" name="nationality" value="<?php echo $nationality;?>">
                            
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Country:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="country" value="<?php echo $country;?>">
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
                            <input placeholder="" type="text" name="city" value="<?php echo $city;?>">
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>District:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="district" value="<?php echo $district;?>">
                            
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
                            <input placeholder="" type="text" name="street" value="<?php echo $street;?>">
                            
                        </div>
                    </div>
                </div>
                <div class="span7">

                    <div class="span2 text-right">
                        <label>House#:</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="house" value="<?php echo $house_no;?>">
                          
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
                            <input placeholder="" type="text"  name="postal_addr" value="<?php echo $postal_addr;?>">                                                                                                      
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Phone Number1</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="telephone_no" value="<?php echo $telephone_no;?>">                  
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
                            <input placeholder="" type="text"  name="mobile_phone" value="<?php echo $mobile_phone;?>">                                                                                                     
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Fax Number</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="fax_no" value="<?php echo $fax_no;?>">                                                   
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
                            <input placeholder="" type="text"  name="email" value="<?php echo $email;?>">                                                                                                      
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Email 2</label>
                    </div>
                    <div class="span5">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="" type="text" name="email2" value="<?php echo $email2;?>">                                                
                        </div>
                    </div>

                </div>
            </div>                                
            <hr>
            <legend><center>Employee Contract</center></legend>
            <div class="row">
                <div class="span7">
                    <div class="span2 text-right">
                        <label>Job Title:</label>
                    </div>
                    <div class="span5">                                          
                        <div class="input-control select" data-role="input-control">
                            <select name="job">
                                <option value="<?php echo $job1;?>"><?php echo $title_name;?></option>
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
                        <div class="input-control text">
                            <input  type="text" name="sdate" value="<?php echo $sdate; ?>">                         
                    </div>
                     </div>
                    <div class="span1">
                        <label>Enddate:</label>
                    </div>
                    <div class="span2">                                                             

                        <div class="input-control text">
                            <input  type="text" name="edate" value="<?php echo $edate; ?>">
                          </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="span2 text-right">
                    <label>Description:</label>
                </div>
                <div class="span12">
                    <div class="input-control textarea">
                        <textarea name="description" ><?php echo $description;?></textarea>
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
                            <input placeholder="Payroll#" type="text"  name="payroll_no" value="<?php echo $payroll_no;?>">  
                        </div>
                    </div>                                           
                </div> 
                <div class="span7">
                    <div class="span3 text-right">
                        <label>Estimated Arrear of Salary</label>
                    </div>
                    <div class="span4">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input  type="text" name="st_salary" value="<?php echo $st_salary;?>">
                            
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
                            <input  type="text" name="salary" value="<?php echo $salary;?>">                                                   
                        </div>
                    </div>
                </div>
                <div class="span7">
                    <div class="span3 text-right">
                        <label>Estimated Arrear of Pension:</label>
                    </div>
                    <div class="span4">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input  type="text" name="est_pension" value="<?php echo $est_pension;?>">                                                  
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
                            <input placeholder="Allowance" type="text" name="allowance" value="<?php echo $allowance;?>">

                        </div>
                    </div>
                </div><div class="span7">
                    <div class="span3 text-right">
                        <label>Estimated Arrear of Tax</label>
                    </div>
                    <div class="span4">                                                             
                        <div class="input-control text" data-role="input-control">
                            <input placeholder="Estimated arrear of tax" type="text" name="st_tax" value="<?php echo $st_tax;?>">

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
                        <input placeholder="bonus" type="text" name="st_other" value="<?php echo $st_other;?>">
                       
                    </div>
                </div>
            </div>  
                        <div class="row">
                <div class="span2 text-right">
                    <label>Remarks</label>
                </div>
                <div class="span12">                                                                                                                                              
                     <div class="input-control textarea">
                         <textarea name="remark" ><?php echo $remark;?></textarea>
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
                                                     <option value="<?php echo $department_ida; ?>"><?php echo $department_namea; ?></option>
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
                                                    <option value="<?php echo $position_idZ; ?>"><?php echo $position_nameZ; ?></option>
                                                    <?php
                                                    
                                                    include 'authorized/db.php';
                                                    $SELECTy = "SELECT * FROM tbl_position";
                                                    $mimii = mysql_query($SELECTy) or die(mysql_error());
                                                    while ($row = mysql_fetch_array($mimii)) {
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
                                                <input class="span3 primary large" value="Make Change" name="edit" type="submit">
                                            </div>
                                        </div>
                                                                  
                                </div>
             <div class="" style="margin-top: 50px;"></div>
                              
        </fieldset>
    </form>
</div>
