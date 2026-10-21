<?php
/**
 * SAS - the ONE database connection file.
 *
 * Include it from anywhere:   require_once __DIR__ . '/db.php';   (path to this file)
 * It loads db_config.php, opens the connection, selects the database and
 * leaves the usual variable $bd (the link) available to the caller.
 * Every other db*.php / statsdb.php in the project just includes this file.
 */
require_once __DIR__ . '/mysql_compat.php';
require __DIR__ . '/db_config.php';

if ($sas_debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
}

$__sas_host = $mysql_hostname . ($mysql_port !== '' ? ':' . $mysql_port : '');
// mysql_connect() (see mysql_compat.php) re-uses an existing link, so including
// this file many times in one request does not open many connections.
$bd = mysql_connect($__sas_host, $mysql_user, $mysql_password)
    or die('Database connection failed. Check db_config.php');
mysql_select_db($mysql_database, $bd)
    or die("Database '" . htmlspecialchars($mysql_database) . "' could not be selected. Check db_config.php");
if (function_exists('mysqli_set_charset') && $bd instanceof mysqli) {
    @mysqli_set_charset($bd, 'utf8mb4');
}
date_default_timezone_set($sas_timezone);
unset($__sas_host);
