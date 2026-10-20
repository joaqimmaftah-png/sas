<?php
// Connection test. Open as db_check.php?key=bfd4fd4e16a302e3  -- DELETE this file when finished.
if (($_GET['key'] ?? '') !== 'bfd4fd4e16a302e3') { http_response_code(403); exit('Forbidden'); }
header('Content-Type: text/plain');
echo 'PHP ' . PHP_VERSION . ', mysqli: ' . (extension_loaded('mysqli') ? 'yes' : 'NO') . "\n";
require __DIR__ . '/db_config.php';
mysqli_report(MYSQLI_REPORT_OFF);
$h = ($mysql_hostname === 'localhost' && PHP_OS_FAMILY === 'Windows') ? '127.0.0.1' : $mysql_hostname;
$l = @mysqli_connect($h, $mysql_user, $mysql_password);
if (!$l) { exit("CONNECT FAILED ($h, user $mysql_user): [" . mysqli_connect_errno() . '] ' . mysqli_connect_error() . "\n"); }
echo "Connected to $h as $mysql_user\n";
echo @mysqli_select_db($l, $mysql_database) ? "Database '$mysql_database' OK\n" : "Database '$mysql_database' NOT FOUND: " . mysqli_error($l) . "\n";
$r = mysqli_query($l, 'SHOW DATABASES'); echo "Databases on server: "; while ($r && ($row = mysqli_fetch_row($r))) echo $row[0] . ' '; echo "\n";
