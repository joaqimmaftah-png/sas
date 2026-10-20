<head>
     <script type="text/javascript">
        $(document).ready(function (e) {
            $("#logout_id").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/usersystem/long_lat_logout.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#site_locaton").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script> 
</head>

<?php
require_once __DIR__ . '/../../mysql_compat.php';

include '../db.php';
date_default_timezone_set("Africa/Nairobi");
$long=$_POST['longitude1'];
$lat=$_POST['latitude1'];
$techcian=$_POST['techcian'];
$newTime = strtotime('-10 minutes');
     $timein = date("H:i",$newTime);
$datereg=date("Y-m-d");
$datereport=date("Ymd");
$mac_address=$_POST['mac_address'];
$seds=  mysql_query("SELECT * FROM tbl_user_accounts WHERE com_mac_address='NULL' AND emp_file_no='$techcian'") or die(mysql_error());
$xs=  mysql_fetch_array($seds);

if($xs==0){
   $update_user_account=  mysql_query("UPDATE tbl_user_accounts SET com_mac_address='$mac_address' WHERE emp_file_no='$techcian'") or die(mysql_error()); 
if($update_user_account){
    $seds2=  mysql_query("SELECT * FROM tbl_user_accounts WHERE com_mac_address='$mac_address' AND emp_file_no='$techcian'") or die(mysql_error());
$xs2= mysql_num_rows($seds2);

}
   
   
}
else {
    
}


$longtud='39.254054599999996';
$latitud='-6.763444499999999';
//$latitud='-6.775732';



        
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
    if($r==0){
 //////////////////////////////////////////////////////////       


    $time_cof = "08";
    $newTime = strtotime('-8 minutes');
     $timein = date("H:i",$newTime);
    $timeout = '00:00';
    $timedefault = '00:00';
    $time_of_entry = '08:10';
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
    $ss=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$techcian'") or die(mysql_error());
    $row= mysql_num_rows($ss);
    if($row!=0 ){

    if ($mudauliopangwa > $mudaaliongia) {
        $class = "bg-green";
        $status = "NO";
        $percent=100;
    }  else {
        $class = "bg-red";
        $status = "YES";
        $percent=50;
    }

    $upload = "INSERT INTO tbl_attendence(emp_file_no,time_in,time_out,time_set,date1,time_spend,remark,notification,reportdate,percent)"
            . " values('$techcian','$timein','$timeout','$time_cof','$datereg','$timespent','$status','$class','$datereport','$percent')";
    $updatee = mysql_query($upload) or die(mysql_error());
    echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully!</strong>
</div>';
    } 
///////////////////////////////////     
    }
 else {
       echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>login successful!</strong>
</div>'; 
    }
    
    
    
}
else {
    echo ' <div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
  <strong>Error!try again
</div>';
}



?>


