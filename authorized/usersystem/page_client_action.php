 
<?php
require_once __DIR__ . '/../../mysql_compat.php';

include '../db.php';

$qs=$_GET['q'];


?>
<ul class="pagination" >
<li>
                                <a  href="#" role="button"><i class="fa fa-file-excel-o"></i>&nbsp;Download Excel</a>        
                            </li>
                           
                            <li >
                                <a href="#" onclick="editpayment('authorized/usersystem/solar_payment_client.php?paymentid=<?php echo $qs; ?>')"  data-toggle="modal" data-target="#edit_payment" ><i class="fa fa-check"></i>&nbsp;Payments</a>
                            </li>
                         
                            <li >
                                <a href="#"   ><i class="fa fa-arrow-down"></i>&nbsp;Report</a>
                            </li>
                            </ul>