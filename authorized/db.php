<?php
error_reporting(0);
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "daima12_sincro";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("No database selected");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
date_default_timezone_set("Africa/Nairobi");

?>