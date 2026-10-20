<?php
require_once __DIR__ . '/mysql_compat.php';
  
session_start();
include 'authorized/db.php'; 
$emp_file_no=$_SESSION["emp_file_no"];
$access_lever=$_SESSION["access_lever"];
$jina=mysql_query("SELECT *  from tbl_user_accounts where emp_file_no='$emp_file_no'") or die(mysql_error());
//$show=  mysql_fetch_array($jina);
//$name=$show['hints'];
?>

<div class="navigation-bar">
<div class="navigation-bar-content">
     <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>Store V 1.0</sup></a>
                    <span class="element-divider"></span>

                    <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="home_store.php">Home</a>                             
                        </li>
                        <span class="element-divider"></span>
                         <li>
                            <a class="" style="font-weight: bold;" href="?full=inventory">Inventory</a>                                                 
                        </li> 

                         <span class="element-divider"></span>
                         <li >
                             <a class="" style="font-weight: bold;" href="?full=sent_spare">Check Sent Spares</a>                                               
                        </li> 
                         <span class="element-divider"></span>
                         <li>
                            <a class="" href="?full=spare_report" style="font-weight: bold;">Generate Report</a>                                                 
                        </li>                         
                         <span class="element-divider"></span>
                    </ul>

                    <div class="no-tablet-portrait">
                       
                        <div class="element place-right">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-switch"></span>
                            </a> 
                             <ul style="display: none;" class="dropdown-menu place-right" data-role="dropdown">
                                <li><a href="logout.php">Sign Out</a></li>
                                 <li><a href="#">Change Password</a></li>                           
                            </ul>
                        </div>
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            <?php echo '';?>
                            <img src="images/mann1.png">
                        </button>
                    </div>
                </div>
</div>
