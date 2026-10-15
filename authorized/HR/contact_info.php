
<!-----------------------/////////////php to insert data into tbl_contract_to_work table//////////////////------------------->
<?php
$message="";
if (isset($_POST['contact'])) {
    $employ_id = $_POST['employ_id'];
    $selecting = "select * from tbl_employee where emp_file_no='$employ_id'";
    $show = mysql_query($selecting) or die(mysql_error());
    $check = mysql_num_rows($show);
    if ($check == 1) {
        $email1 = $_POST['email1'];
        $telephone_no = $_POST['telephone_no'];
        $mobile_phone= $_POST['mobile_phone'];
        $fax_no = $_POST['fax_no'];        
        $postal_addr = $_POST['postal_addr'];
        $email = $_POST['email'];
//        $location = $_POST['location'];

        $insert = "INSERT INTO tbl_empley_contact(emp_file_no,telephone_no,mobile_phone,fax_no, postal_addr, email,email2)"
                . " VALUES('$employ_id','$telephone_no','$mobile_phone','$fax_no','$postal_addr','$email','$email1')";
        
        mysql_query($insert) or die(mysql_error());
              if($insert){
       $message=' <div class="">                     
    <div class="panel">
        <div class="panel-header bg-blue fg-white">
           Successful submitted!....click <a href="?action=add_contract&employ_id='.$employ_id.'">NEXT</a> to Continue                   
       </div>                            
     </div>
     </div>'; 


   }
    }
 else {
       
     echo '<div class=""> ';                     
    echo '<div class="panel">';
        echo '<div class="panel-header bg-lightRed fg-white">';
           echo 'Error on uploading data!....click';
                      echo '&nbsp;<a href="?action=add_contract&employ_id=<?php echo "$employ_id"?>">NEXT</a>&nbsp;';echo 'to continue';
       echo '</div> ';                           
    echo '</div>';
echo '</div>';
     
    }
}
?>
<!-----------------------///////////////end of php code////////////////------------------->

<nav class="breadcrumbs">
    <ul>
        <li><a href="#" onclick="getPage('sincro.php?action=employee')">Home</a></li>
        <li><a onclick="getPage('sincro.php?action=add_employee')" href="#"><i class="icon-user"></i>&nbsp;New employee</a></li>
        <li class="active"><a  href="#"><i class="icon-phone"></i>&nbsp;Add contact information</a></li>
        <li><a href="#"><i class="icon-address-book"></i>&nbsp;Employee Contract</a></li>
        <li><a  href="#">Assign Department</a></li>       
        <li><a onclick="getPage('sincro.php?action=employee')" href="#"><i class="icon-reply-2"></i></a></li>
    </ul>
</nav>
<div class="grid"> 
    <div class="row">
        <div class="span11">
            <div class="span1">
            </div>
            <div class="span11">
                <?php if($message!="") { echo $message; } ?>
                <div class="example">
                                        <?php if(isset($_GET['employ_id'])) { 
                       $employ_id=$_GET['employ_id'];                    
                    }
                    ?>
                    <form method="post" action="?action=add_contact&employ_id=<?php echo $employ_id;?>">
                        <fieldset>
                            <legend><center>EMPLOYEE CONTACT INFORMATION</center></legend>
                            <div class="grid"> 
                                <div class="row">
                                    <div class="span10">
                                        <div class="span2 text-right">
                                            <label>Employee ID:</label>
                                        </div>
                                        <div class="span8">  
                                            <div class="input-control text" data-role="input-control">
                                                <input placeholder=""  value="<?php if(isset($_GET['employ_id'])) { echo $_GET['employ_id']; }?>" type="text" name="employ_id">
                                                <button type="button" class="btn-clear" tabindex="-1"></button>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                                <div class="row">
                                    <div class="span10">
                                        <div class="span2 text-right">

                                        </div>
                                        <div class="span8">
                                                <div class="span1">
                                                <label></label>
                                            </div>
                                            <div class="span3">                                                             
                                                <div class="input-control text" data-role="input-control">
                                                    <input placeholder="postal address" type="text"  name="postal_addr">                                                   
                                                    <button type="button" class="btn-clear" tabindex="-1"></button>
                                                </div>
                                            </div>

                                            <div class="span1 text-right">
                                                <label></label>
                                            </div>
                                            <div class="span3">                                                             
                                                <div class="input-control text" data-role="input-control">
                                                    <input placeholder="Phone number1" type="text" name="telephone_no">
                                                    <button type="button" class="btn-clear" tabindex="-1"></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>                                
                                </div>
                                <div class="row">
                                    <div class="span10">
                                        <div class="span2 text-right">

                                        </div>
                                        <div class="span8">
                                            <div class="span1">
                                                <label></label>
                                            </div>
                                            <div class="span3">                                                             
                                                <div class="input-control text" data-role="input-control">
                                                    <input placeholder="phone number2" type="text"  name="mobile_phone">                                                   
                                                    <button type="button" class="btn-clear" tabindex="-1"></button>
                                                </div>
                                            </div>

                                            <div class="span1 text-right">
                                                <label></label>
                                            </div>
                                            <div class="span3">                                                             
                                                <div class="input-control text" data-role="input-control">
                                                    <input placeholder="fax Number" type="text" name="fax_no">
                                                    <button type="button" class="btn-clear" tabindex="-1"></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>                                
                                </div>
                                <div class="row">
                                    <div class="span10">
                                        <div class="span2 text-right">

                                        </div>
                                        <div class="span8">                                       
                                                                                        <div class="span1">
                                                <label></label>
                                            </div>
                                            <div class="span3">                                                             
                                                <div class="input-control text" data-role="input-control">
                                                    <input placeholder="Email 1" type="text"  name="email">                                                   
                                                    <button type="button" class="btn-clear" tabindex="-1"></button>
                                                </div>
                                            </div>

                                            <div class="span1 text-right">
                                                <label></label>
                                            </div>
                                            <div class="span3">                                                             
                                                <div class="input-control text" data-role="input-control">
                                                    <input placeholder="Email 2" type="text" name="email1">
                                                    <button type="button" class="btn-clear" tabindex="-1"></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>                                
                                </div>
<!--                                <div class="row">
                                    <div class="span10">
                                        <div class="span2 text-right">

                                        </div>
                                        <div class="span8">
                                            <div class="input-control textarea">
                                                <textarea name="location" placeholder="drag and drop google map code...!!!"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>                         -->



                                <legend></legend>


                                <div class="row">
                                    <div class="span10">
                                        <div class="span4 text-right">

                                        </div>
                                        <div class="span6">
                                            <div class="span4">
                                                <input class="span4 primary large" name="contact" value="Submit" type="submit">
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>                           
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</di