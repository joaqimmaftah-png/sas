<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mysql_hostname = "localhost";
$mysql_user = "daima15_sincro";
$mysql_password = "daima15_sincro";
$mysql_database = "daima15_sincro";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("No database selected");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
date_default_timezone_set("Africa/Nairobi");