<?php
/**
 * ============================================================
 *  SAS - SINGLE DATABASE CONFIGURATION  (edit ONLY this file)
 * ============================================================
 * Every script in the system gets its database connection through
 * /db.php, which reads the values below. Nothing else in the project
 * contains a host, username, password or database name, and nothing else
 * opens a connection.
 *
 * Values can also be overridden by environment variables
 * (SAS_DB_HOST, SAS_DB_PORT, SAS_DB_USER, SAS_DB_PASS, SAS_DB_NAME,
 *  SAS_TIMEZONE, SAS_DEBUG) without touching this file.
 *
 * The values are stored as constants (SAS_DB_HOST ...) so they are available
 * in every scope; the old variables ($mysql_hostname ...) are kept as well so
 * any existing code that still reads them keeps working.
 */
if (!function_exists('sas_env')) {
    function sas_env($name, $default)
    {
        $v = getenv($name);
        return ($v !== false && $v !== '') ? $v : $default;
    }
}

if (!defined('SAS_DB_HOST')) {
    define('SAS_DB_HOST', sas_env('SAS_DB_HOST', 'localhost'));
    define('SAS_DB_PORT', sas_env('SAS_DB_PORT', ''));            // leave empty for default 3306
    define('SAS_DB_USER', sas_env('SAS_DB_USER', 'root'));
    define('SAS_DB_PASS', sas_env('SAS_DB_PASS', ''));
    define('SAS_DB_NAME', sas_env('SAS_DB_NAME', 'daima12_sincro'));
    define('SAS_TIMEZONE', sas_env('SAS_TIMEZONE', 'Africa/Nairobi'));

    // Annual leave allowance per employee, per calendar year (days).
    // Only leave types whose name contains "annual" are limited by this value;
    // every other leave type is unrestricted.
    define('SAS_ANNUAL_LEAVE_DAYS', (int) sas_env('SAS_ANNUAL_LEAVE_DAYS', 28));

    // Leave types whose NAME contains this word count as annual leave (the only
    // limited type). Rename the type in tbl_leave_type or change this keyword.
    define('SAS_ANNUAL_LEAVE_KEYWORD', sas_env('SAS_ANNUAL_LEAVE_KEYWORD', 'annual'));

    // Set to true (or SAS_DEBUG=1) to show PHP errors on screen while fixing problems.
    // Keep false in production: errors are then hidden (blank page instead of a message).
    define('SAS_DEBUG', in_array(strtolower((string) sas_env('SAS_DEBUG', '0')), ['1', 'true', 'yes', 'on'], true));
}

// Backwards-compatible variable names (old code used these directly).
$mysql_hostname = SAS_DB_HOST;
$mysql_port     = SAS_DB_PORT;
$mysql_user     = SAS_DB_USER;
$mysql_password = SAS_DB_PASS;
$mysql_database = SAS_DB_NAME;

$sas_timezone   = SAS_TIMEZONE;
$sas_debug      = SAS_DEBUG;
