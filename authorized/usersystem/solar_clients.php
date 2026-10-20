<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once '../db.php';

$fname=$_POST['fname'];
$m_name=$_POST['m_name'];
$surname=$_POST['surname'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$phone_number=$_POST['phone_number'];
$phone_number2=$_POST['phone_number2'];
$place_location=$_POST['place_location'];
$empl_client=$_POST['empl_client'];
$date_registration=$_POST['date_registration'];
$payment_term=$_POST['payment_term'];
$package=$_POST['package'];
$deposit=$_POST['deposit'];
$boxx_type=$_POST['boxx_type'];
$boxx_numb=$_POST['boxx_numb'];
$solar_size=$_POST['solar_size'];
$solar_no=$_POST['solar_no'];
$lights=$_POST['lights'];
$phon_charge=$_POST['phon_charge'];
$tv_redio=$_POST['tv_redio'];
$dealer=$_POST['dealer'];
$tv_series=$_POST['tv_series'];



$solar_add_clients=  mysql_query("INSERT INTO `tbl_solar_clients`(`fname`, `middle_name`, `last_name`, `Gender`, `Age`, `phone_no`,phone_no2,`location`,`status`)"
        . " VALUES ('$fname','$m_name','$surname','$gender','$age','$phone_number','$phone_number2','$place_location','Active')") or die(mysql_error());

if($solar_add_clients){
    $client_ids=  mysql_query("SELECT * FROM tbl_solar_clients ORDER  BY client_id DESC") or die(mysql_error());
    $sm=  mysql_fetch_array($client_ids);
    $issd=$sm['client_id'];
    $dt=date('y');
$Ref=$package.$dt.'00'.$issd;
$solar_contract=  mysql_query("INSERT INTO `tbl_solar_contract`(`contract_date`, `payment_model`, `emp_client_agent_type`, `package`, `bbox_type`, `bbox_number`, `solar_size`, `solar_no`, `lights`, `phone_charges`, `tv/radio`, `dealer`, `tv_serial`, `client_id`, `Ref`, `deposit`) "
        . "VALUES ('$date_registration','$payment_term','$empl_client','$package','$boxx_type','$boxx_numb','$solar_size','$solar_no','$lights','$phon_charge','$tv_redio','$dealer','$tv_series','$issd','$Ref','$deposit')") or die(mysql_error());
echo 'Successful';

}