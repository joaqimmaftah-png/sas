<?php
require_once __DIR__ . '/../../mysql_compat.php';

include '../db.php';
$long=$_POST['longitude'];
$lat=$_POST['latitude'];
$techcian=$_POST['techcian'];
$siteid=$_POST['site_cla'];
$timein=  date("H:i");
$datereg=date("Y-m-d");
$datereport=date("Ymd");

$se=mysql_query("SELECT * FROM tbl_class_a_site WHERE s_id='$siteid'") or die(mysql_error());
$ds=  mysql_fetch_array($se);
$longtud=$ds['longtude'];
$latitud=$ds['latitude'];



        
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
if($eneo<=1000){
    $att=  mysql_query("SELECT * FROM site_attendence WHERE tech_no='$techcian' AND date_entry='$datereg' AND time_in<>''") or die(mysql_error());
    $r= mysql_num_rows($att);
    if($r==0){
        $ed=  mysql_query("INSERT INTO `site_attendence`(`tech_no`, `time_in`,`date_entry`, `reportdate`, `lat_in`, `lon_n`,site_id) "
                . "VALUES ('$techcian','$timein','$datereg','$datereport','$lat','$long','$siteid')") or die(mysql_error());
    }
    
 else {
        echo '<div class="alert alert-info">
  <strong>Thanks for login!</strong> .  
</div>'; 
    }
    
    
    
}
else {
    echo ' <div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
  <strong>Error!Out of Range for '.$eneo.' metres,Make sure to login at site 
</div>';
}



?>


