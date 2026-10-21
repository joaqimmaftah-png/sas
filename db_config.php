<?php
/**
 * ============================================================
 *  SAS - SINGLE DATABASE CONFIGURATION  (edit ONLY this file)
 * ============================================================
 * Every script in the system gets its database connection through
 * /db.php, which reads the values below. Nothing else in the project
 * contains a host, username, password or database name.
 *
 * Values can also be overridden by environment variables
 * (SAS_DB_HOST, SAS_DB_PORT, SAS_DB_USER, SAS_DB_PASS, SAS_DB_NAME,
 *  SAS_TIMEZONE, SAS_DEBUG) without touching this file.
 */
if (!function_exists('sas_env')) {
    function sas_env($name, $default)
    {
        $v = getenv($name);
        return ($v !== false && $v !== '') ? $v : $default;
    }
}

$mysql_hostname = sas_env('SAS_DB_HOST', 'sql301.yzz.me');
$mysql_port     = sas_env('SAS_DB_PORT', '');            // leave empty for default 3306
$mysql_user     = sas_env('SAS_DB_USER', 'yzzme_42295087');
$mysql_password = sas_env('SAS_DB_PASS', 'YAS2sWjtziIG');
$mysql_database = sas_env('SAS_DB_NAME', 'yzzme_42295087_sas');

$sas_timezone   = sas_env('SAS_TIMEZONE', 'Africa/Nairobi');

// Set to true (or SAS_DEBUG=1) to show PHP errors on screen while fixing problems.
// Keep false in production: errors are then hidden (blank page instead of a message).
$sas_debug      = in_array(strtolower((string) sas_env('SAS_DEBUG', '0')), ['1', 'true', 'yes', 'on'], true);
