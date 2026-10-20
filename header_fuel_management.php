<?php
require_once __DIR__ . '/mysql_compat.php';
  
session_start();
include 'authorized/db.php'; 
$emp_file_no=$_SESSION["emp_file_no"];
?>

<div class="navigation-bar">
<div class="navigation-bar-content">
     <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>Vehicle Fuel V1.1</sup></a>
                    <span class="element-divider"></span>

                    <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="?action=vehicle_fuel_list">Home</a>                             
                        </li>
                                                 <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=vehicle_fuel" style="font-weight: bold;">Fuel Issues</a>                                                 
                        </li>
                          <span class="element-divider"></span>
                         <li>
                            <a class="" href="" style="font-weight: bold;">Vehicle Fuel History</a>                                                 
                        </li>
                            
                         <span class="element-divider"></span>
                    </ul>

                    <div class="no-tablet-portrait">
                       
                        <div class="element place-right">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-switch"></span>
                            </a> 
                             <ul style="display: none;" class="dropdown-menu place-right" data-role="dropdown">
                                <li><a href="logout.php">sign out</a></li>
                                 <li><a href="logout.php">Change Password</a></li>
                                                            
                            </ul>
                        </div>
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            <?php echo $emp_file_no;?>
                            <img src="images/mann1.png">
                        </button>
                    </div>
                </div>
</div>
