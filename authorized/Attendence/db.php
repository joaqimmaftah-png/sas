<?php
require_once __DIR__ . '/../../mysql_compat.php';

//$mysql_hostname ="185.148.144.251:3306"; 
//$mysql_user ="sincrosi_sincro";
//$mysql_password = "sincrosi_sincro";
$mysql_database = "sincrosi_sincro";
$bd=mysql_connect('185.148.144.251', 'sincrosi_sincro', 'sincrosi_sincro');
//$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("No database selected");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
date_default_timezone_set("Africa/Nairobi");

?>