<?php
require_once __DIR__ . '/mysql_compat.php';

session_start();
include_once 'authorized/db.php';
$employeno= $_SESSION["emp_file_no"];
$jinayetu= mysql_query("SELECT * from tbl_user_accounts where emp_file_no='$employeno'") or die(mysql_error());
$show = mysql_fetch_array($jinayetu);
$name = $show['hints'];


?>
<div class="navigation-bar">
<div class="navigation-bar-content">
     <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>Accounts V1.0</sup></a>
                    <span class="element-divider"></span>

                    <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="?action=accounts_home">Home</a>                             
                        </li>                                              
                         <span class="element-divider"></span>
                          <li>
                            <a class="" href="?action=" style="font-weight: bold;">Dashboard</a>                                                 
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
                            echo $name;
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
                                <input  type="hidden"  class="form-control" value="<?php;?>" name="employeenumber">
                                
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
