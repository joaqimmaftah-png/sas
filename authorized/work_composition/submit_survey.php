<?php
require_once __DIR__ . '/../../mysql_compat.php';


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../db.php';
if(!empty($_POST['customer'])){
$siteaddress=$_POST['siteaddress'];
$customer=$_POST['customer'];
$workarea=$_POST['workarea'];
$call_received_time=$_POST['call_received_time'];
$Date=$_POST['Date'];
$project=$_POST['project'];
$jobnumber=$_POST['jobnumber'];
$eqp_remain_time=$_POST['eqp_remain_time'];
$repaire=$_POST['repaire'];
$coun_in=$_POST['coun_in'];
$coun_outt=$_POST['coun_outt'];
$service=$_POST['service'];
$timein=$_POST['timein'];
$timeout=$_POST['timeout'];
$Eqpment_refno=$_POST['Eqpment_refno'];
$serialno=$_POST['serialno'];
$inspection=$_POST['inspection'];
$model=$_POST['model'];
$make_type=$_POST['make_type'];
$site_clean=$_POST['site_clean'];
$fuel=$_POST['fuel'];
$closeref=$_POST['closeref'];
$code=rand();
$emplo=$_POST['emplo'];

////
$description=$_POST['description'];
$additional=$_POST['additional'];
$remarks=$_POST['remarks'];
////////////////////////////
$descri=$_POST['descri'];
$partnumber=$_POST['partnumber'];
$units=$_POST['units'];
$quantity=$_POST['quantity'];
$amount=$_POST['amount'];

$selectv=  mysql_query("SELECT * FROM site_survey") or die(mysql_error());
    $rowzv= mysql_numrows($selectv);
    $sno=999+$rowzv+1;
    


$survey=  mysql_query("INSERT INTO `site_survey`(`site_address`, `custeomer_name`, `work_area`, `call_received_time`,"
        . " `Date`, `job_no`, `control_contact_in`, `time_in`, `timeout`, `equipment_ref_no`, `serial_no`, `model`, `make_type`, `closing_ref`, `equipment_remain_time`, `project`, `repair`, `service_route`, `refuel`, `inspection`, `site_clearing`,code,employee_code,completion_no)"
        . " VALUES ('$siteaddress','$customer','$workarea','$call_received_time','$Date','$jobnumber','$coun_in','$timein','$timeout','$Eqpment_refno','$serialno','$model','$make_type','$closeref','$eqp_remain_time','$project','$repaire','$service','$fuel','$inspection','$site_clean','$code','$emplo','$sno')") or die(mysql_error());

if($survey){
    $select=  mysql_query("SELECT * FROM site_survey WHERE code='$code'") or die(mysql_error());
    $rowz=  mysql_fetch_array($select);
    $site_id=$rowz['site_id'];
    
    
    for ($i = 0; $i < sizeof($description); $i++) {

                $insertdescription=mysql_query("INSERT INTO survey_description(item,site_id)"
                        . "values('$description[$i]','$site_id')") or die(mysql_error());
            }
            
            for ($j = 0; $j < sizeof($additional); $j++) {

                $insertdescription=mysql_query("INSERT INTO `survey_addition_work_required`(addition_work,site_id)"
                        . "values('$additional[$j]','$site_id')") or die(mysql_error());
            }
            for ($k = 0; $k < sizeof($remarks); $k++) {

                $insertdescription=mysql_query("INSERT INTO `survey_remarks`(ramarks,site_id)"
                        . "values('$remarks[$k]','$site_id')") or die(mysql_error());
            }
             for ($n= 0; $n < sizeof($descri); $n++) {

                $insertdescription=mysql_query("INSERT INTO `survey_invoice_instruction`( `item`, `partnumber`, `description`, `unit`, `quantity`, `amount`, `site_id`)"
                        . "values('$descri[$n]','$partnumber[$n]','$descri[$n]','$units[$n]','$quantity[$n]','$amount[$n]','$site_id')") or die(mysql_error());
            }
    
     echo '<div class="alert alert-success">
  <strong>Message!</strong> Congraturation your report created successful!
</div>';
}

 

}
 else {
    echo '<div class="alert alert-danger">
  <strong>Error!</strong> Fill the Customer Name.
</div>';
}


?>