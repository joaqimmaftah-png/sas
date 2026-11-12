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
