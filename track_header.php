<?php  
session_start();
include 'authorized/db.php'; 
$emp_file_no=$_SESSION["emp_file_no"];

?>

<div class="navigation-bar">
<div class="navigation-bar-content">
     <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>Fleet V 1.0</sup></a>
                    <span class="element-divider"></span>

                    <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="?action=home">Home</a>                             
                        </li>
                                                 <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=cars_issues" style="font-weight: bold;">Car Issues</a>                                                 
                        </li>
                        <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=vehicle_rent" style="font-weight: bold;">Car Rental</a>                                                 
                        </li>
                          <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=vehicle schedule services" style="font-weight: bold;">Vehicle Schedule Services</a>                                                 
                        </li>
                         <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=vehicle Insurance and Road Services" style="font-weight: bold;">Manage Vehicle Insurance</a>                                                 
                        </li>                       
                        <span class="element-divider"></span>
                         <li>
                            <a class="" style="font-weight: bold;" href="?action=car history">Car History</a>                                                 
                        </li>                          
                         <span class="element-divider"></span>
                    </ul>

                    <div class="no-tablet-portrait">
                       
                        <div class="element place-right">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-cog"></span>
                            </a> 
                             <ul style="display: none;" class="dropdown-menu place-right" data-role="dropdown">
                                <li><a href="logout.php">sign out</a></li>
                                                            
                            </ul>
                        </div>
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            <?php ?>
                            <img src="images/mann1.png">
                        </button>
                    </div>
                </div>
</div>
