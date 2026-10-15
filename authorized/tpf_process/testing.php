<?php
$str = "20-04-2016";
$str = strtotime(date("d-m-Y")) - (strtotime($str));
$mimi= floor($str/3600/24);
echo $mimi;
if($mimi<7){
   $status="Yes";
   $bg='bg-red'; 
   echo 'yes';
}  else {
               $status="No";
               $bg='';
               echo 'NO';
               }

?>