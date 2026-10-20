<?php
require_once __DIR__ . '/../../mysql_compat.php';

include 'statsdb.php';
$page = mysql_escape_string( strip_tags( $_POST['page'] ) );
$referrer=mysql_escape_string( strip_tags( $_POST['p'] ) );
//$mysql_query=mysql_query("INSERT INTO stats(page) values('$page')") or die(mysql_error());

$add_opm=  mysql_query("INSERT INTO `stats`(`page`,`referrer`) VALUES ('$page','$referrer')") or die(mysql_error());

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

