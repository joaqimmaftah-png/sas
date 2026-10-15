<?php
date_default_timezone_set("Africa/Nairobi");
error_reporting(0);
$mysql_hostname = "185.148.144.251";
$mysql_user = "sincrosi_sincro";
$mysql_password = "sincrosi_sincro"; 
$mysql_database = "sincrosi_sincro";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("No database selected");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
date_default_timezone_set("Africa/Nairobi");

?>