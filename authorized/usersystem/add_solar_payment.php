<?php
require_once __DIR__ . '/../../mysql_compat.php';


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../db.php';
$client_id=$_POST['client_id'];
$Ref=$_POST['Ref'];
$Date=$_POST['Date'];
$amount=$_POST['amount'];
$a = str_replace(',', '', $amount);

$update=  mysql_query("INSERT INTO `tbl_solar_payment`(`reference`, `client_id`, `amount`, `paid_date`) "
        . "VALUES ('$Ref','$client_id','$a','$Date')") or die(mysql_error());

 echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Success!</strong> !
</div>';



