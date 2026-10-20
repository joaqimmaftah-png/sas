<?php
require_once __DIR__ . '/mysql_compat.php';

require __DIR__ . '/db_config.php';
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("No database selected");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
date_default_timezone_set("Africa/Nairobi");
?>