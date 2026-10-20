<?php
require_once __DIR__ . '/../mysql_compat.php';

$mysql_hostname = "localhost";
$mysql_user = "daima15_project";
$mysql_password = "daima15_project";
$mysql_database = "daima15_project";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("No database selected");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
date_default_timezone_set("Africa/Nairobi");

?>