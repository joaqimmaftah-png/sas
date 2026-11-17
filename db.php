<?php
/**
 * SAS - the ONE database connection file.
 *
 * This is the only place in the whole project where a database connection is
 * opened. Include it from anywhere with an absolute (__DIR__) path:
 *
 *     require_once __DIR__ . '/db.php';            // file in the project root
 *     require_once __DIR__ . '/../../db.php';      // file two folders deep
 *
 * It loads db_config.php, opens the connection once per request, selects the
 * database and leaves the usual variable $bd (the link) available to the
 * caller. The old db*.php / statsdb.php / dbcon.php helper files have all been
 * removed: there is no second connection anywhere in the project.
 */
require_once __DIR__ . '/mysql_compat.php';
require_once __DIR__ . '/db_config.php';

if (SAS_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
}

// Capture serious PHP errors (fatals / parse errors) to SAS_ERROR_LOG so that,
// even when SAS_DEBUG is off and errors are hidden from the browser (which
// otherwise shows only a bare "HTTP 500"), the real cause is still recorded
// and can be read from the log file or the host's error log.
if (!function_exists('sas_error_log_write')) {
    function sas_error_log_write($message)
    {
        if (!defined('SAS_ERROR_LOG')) {
            return;
        }
        $line = '[' . date('Y-m-d H:i:s') . '] ' . $message . "\n";
        // Try the local file; also send to the SAPI/system error log as a
        // fallback (on cPanel this lands in the account error log).
        @file_put_contents(SAS_ERROR_LOG, $line, FILE_APPEND);
        @error_log($line);
    }
}

if (!function_exists('sas_log_error')) {
    // Handles non-fatal errors/warnings. With error_reporting(0) these are
    // ignored (return false); fatals are what we care about for a 500.
    function sas_log_error($errno, $errstr, $errfile = '', $errline = 0)
    {
        if (!(error_reporting() & $errno)) {
            return false;
        }
        sas_error_log_write('PHP error (#' . $errno . '): ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
        return true;
    }
}

if (function_exists('set_error_handler')) {
    set_error_handler('sas_log_error');
}

if (function_exists('register_shutdown_function')) {
    register_shutdown_function(function () {
        $e = error_get_last();
        if ($e && isset($e['type'], $e['message'])
            && in_array((int) $e['type'], array(E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR), true)) {
            sas_error_log_write('FATAL (#' . $e['type'] . '): ' . $e['message'] . ' in ' . $e['file'] . ' on line ' . $e['line']);
        }
    });
}

/**
 * Return the single shared database link, opening it on first use.
 * Handy for code that wants an explicit handle:  $r = sas_db();
 */
if (!function_exists('sas_db')) {
    function sas_db()
    {
        if (isset($GLOBALS['__sas_db_link']) && $GLOBALS['__sas_db_link'] instanceof mysqli) {
            return $GLOBALS['__sas_db_link'];
        }

        $host = SAS_DB_HOST . (SAS_DB_PORT !== '' ? ':' . SAS_DB_PORT : '');
        $link = mysql_connect($host, SAS_DB_USER, SAS_DB_PASS)
            or die('Database connection failed. Check db_config.php');
        mysql_select_db(SAS_DB_NAME, $link)
            or die("Database '" . htmlspecialchars(SAS_DB_NAME) . "' could not be selected. Check db_config.php");
        if (function_exists('mysqli_set_charset')) {
            @mysqli_set_charset($link, 'utf8mb4');
        }

        $GLOBALS['__sas_db_link'] = $link;
        $GLOBALS['__mysql_compat_default_link'] = $link; // mysql_*() use this too

        return $link;
    }
}

// The link every script has always used. Opens the connection on first include
// only; any further include of this file simply re-uses it.
$bd = sas_db();

date_default_timezone_set(SAS_TIMEZONE);

// Keep the older name some scripts used for the same link.
if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = $bd;
}
