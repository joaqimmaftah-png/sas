<?php  
session_start();
include 'authorized/db.php'; 
$emp_file_no=$_SESSION["emp_file_no"];
//$jinaa=mysql_query("SELECT * from tbl_employee where emp_file_no='$emp_file_no'") or die(mysql_error());
//$show=  mysql_fetch_array($jinaa);
//$first_name=$show['first_name'];
//$surname=$show['surname'];
////$jina=$first_name.' ,'.$surname;

?>
<head>
    <script type="text/javascript">
            $(document).ready(function (e) {
                $("#upload_password"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "change_password.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#messages").html(data);
                    },
                    error: function () {
                    }
                });
            }));                    
        });
    </script>
</head>
<div class="navigation-bar">
<div class="navigation-bar-content">
     <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>HR V1.0</sup></a>
                    <span class="element-divider"></span>

                    <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="employee">Home</a>                             
                        </li>
                        <span class="element-divider"></span>
                         <li>
                            <a class="dropdown-toggle" style="font-weight: bold;" href="#">Track Attendance</a>
                             <ul class="dropdown-menu" data-role="dropdown">                               
                                <li><a href="manage_attendence">In and Out Attendance</a></li>
                                <li class="divider"></li>
                                <li><a href="manage_leave_request">Leave Management</a></li>
                            </ul>
                        </li> 

                         <span class="element-divider"></span>
                         <li >
                             <a class="" style="font-weight: bold;" href="perfomance_appraisal">Performance Appraisal</a>                                               
                        </li> 
                         <span class="element-divider"></span>
                         <li>
                            <a class="" href="Goal Management" style="font-weight: bold;">Goal Management</a>                                                 
                        </li> 
                        <span class="element-divider"></span>
                         <li>
                            <a class="" href="Recruitment" style="font-weight: bold;">Recruitment</a>                                                 
                        </li> 
                         <span class="element-divider"></span>
                          <li>
                            <a class="" href="dashboard" style="font-weight: bold;">Dashboard</a>                                                 
                        </li> 
                    </ul>

                    <div class="no-tablet-portrait">
                       
                        <div class="element place-right">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-switch"></span>
                            </a> 
                             <ul style="display: none;" class="dropdown-menu place-right" data-role="dropdown">
                                <li><a href="logout.php">Sign Out</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#changepasssword">Change Password</a></li> 
                                                            
                            </ul>
                        </div>
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            <?php
                            echo $emp_file_no;
                            ?>
                            <img src="images/mann1.png">
                        </button>
                    </div>
                </div>
</div>
<!-- Modal -->
<div id="changepasssword" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Change Password</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <form  id="upload_password" action="change_password.php" method="post">
                            <div class="form-group">
                                <label for="oldpass">Password:</label>
                                <input  type="password"  class="form-control" value=""  name="oldpass">
                                <input  type="hidden"  class="form-control" value="<?php echo $emp_file_no;?>" name="employeenumber">
                                
                            </div>                          
                            <div class="form-group">
                                <label for="newpass">New Password:</label>
                                <input type="password" class="form-control" id="newpass" name="newpass">
                            </div> 
                                 <div class="form-group">
                                <label for="retypepass">Retype Password:</label>
                                <input type="password" class="form-control" id="amount" name="retypepass">
                            </div> 
                            <div class="form-group" id="messages">                              
                               
                            </div> 
                            <button type="submit" class="btn btn-default" name="change">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!----------------------------------model tax------------------------------------------------>
