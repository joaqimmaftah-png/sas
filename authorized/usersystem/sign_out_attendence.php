<?php
require_once __DIR__ . '/../../mysql_compat.php';


include '../db.php';
$long=$_POST['longitude1'];
$lat=$_POST['latitude1'];
$techcian=$_POST['techcian'];
$timeout=  date("H:i");
$datereg=date("Y-m-d");

$longtud='39.254054599999996';
$latitud='-6.763444499999999';


$selectall=  mysql_query("SELECT * FROM tbl_attendence WHERE emp_file_no='$techcian' AND date1='$datereg'") or die(mysql_error());
$mv=mysql_fetch_array($selectall);
$timez=$mv['time_in'];



        
$latitudeFrom = $latitud;
$longitudeFrom = $longtud;

$latitudeTo = $lat;
$longitudeTo = $long;



//Calculate distance from latitude and longitude
$theta = $longitudeFrom - $longitudeTo;
$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
$dist = acos($dist);
$dist = rad2deg($dist);
$miles = $dist * 60 * 1.1515;

$distance = ($miles * 1.609344).' km';
$eneo=$distance*1000;
if($eneo>0){
    

    
    $att=  mysql_query("SELECT * FROM tbl_attendence WHERE emp_file_no='$techcian' AND date1='$datereg'") or die(mysql_error());
    $r= mysql_num_rows($att);
    if($r==1){
 //////////////////////////////////////////////////////////       


    $time_cof = "08";
    $timein = $timez;
    $timeout = $timeout;
    $timedefault = '08:00';
    $time_of_entry = '07:59';
    $kawaida = '08:30';
    $time1 = new DateTime($timein);
    $time2 = new DateTime($timeout);
    $timeof_entry = new DateTime($time_of_entry);
    $time_zero = new DateTime($timedefault);
    $kawaidamuda = new DateTime($kawaida);
    $yupokawaida = $kawaidamuda->diff($time_zero);
    $ontime = (int) $yupokawaida->format('%H%i');
    $entry_time = $timeof_entry->diff($time_zero);
    $mudauliopangwa = (int) $entry_time->format('%H%i');
    $badilimudaalioingia = $time1->diff($time_zero);
    $mudaaliongia = (int) $badilimudaalioingia->format('%H%i');
    $time_spent = $time2->diff($time1);
    $timespent = $time_spent->format('%H:%i');
    
    $gds=  mysql_query("UPDATE tbl_attendence SET time_spend='$timespent',time_out='$timeout' WHERE emp_file_no='$techcian' AND date1='$datereg'") or die(mysql_error());
    echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Thanks for logout!</strong>
</div>';
    }
}
 else {
    echo 'error';
}