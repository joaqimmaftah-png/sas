<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include '../db.php';
$long=$_POST['longitude'];
$lat=$_POST['latitude'];
$techcian=$_POST['techcian'];
$timeout=date("H:i");
$select=  mysql_query("SELECT * FROM site_attendence WHERE tech_no='$techcian' AND lat_out='' AND long_out=''") OR die(mysql_error());
$res=  mysql_num_rows($select);
if($res>0){
$logout=  mysql_query("UPDATE  site_attendence SET time_out='$timeout',lat_out='$lat',long_out='$long' WHERE tech_no='$techcian'") or die(mysql_error());

if($logout){
    echo ' <div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
  <strong>Thanks!</strong> See you Again. 
</div>';
}
}
else{
    
}