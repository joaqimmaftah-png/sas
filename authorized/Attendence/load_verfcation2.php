<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once '../db.php';
$queryy = "SELECT * FROM tbl_site_update ORDER BY id DESC";
$resultTT = mysql_query($queryy) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
$h=1;
while ($rrowz = mysql_fetch_array($resultTT, MYSQL_ASSOC)) {
    //$tech=$rrowz['employee'];
                           
                            $site_name=$rrowz['site_name'];
                            $code=$rrowz['code'];
                            $long=$rrowz['long'];
                            $lat=$rrowz['lat'];
                            $time_in=$rrowz['time_in'];
                            $verify_time=$rrowz['verify_time'];
                            $status=$rrowz['status'];
    
 
                
                $f="color:black";
    $stock[] = array( 
        
                            'No'=>$h++,
                            'site_name'=>$site_name,
                            'code'=>$code,
                            'long'=>$long,
                            'lat'=>$lat,
                            'time_in'=>$time_in,
                            'verify_time'=>$verify_time,
                            'status'=>$status     
    );
}
echo json_encode($stock);
?>
