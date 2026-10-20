<?php
/**
 * mysql_compat.php
 *
 * PHP 8.2 compatibility shim.
 *
 * The old `mysql_*` extension (ext/mysql) was removed from PHP entirely in
 * PHP 7.0. This project was written against that old extension. Rather than
 * rewrite every call site, this shim re-implements the small set of
 * mysql_* functions this project actually uses, on top of mysqli, so the
 * existing code keeps working unchanged.
 *
 * It is auto-loaded at the top of every .php file in this project (see the
 * `require_once` line inserted near the top of each file). It only defines
 * functions that don't already exist, so it is safe to include multiple
 * times and safe on any PHP version.
 *
 * Behaviour notes / limitations:
 *  - Old mysql_* code almost always called mysql_query()/mysql_error()/etc.
 *    WITHOUT passing a connection handle, relying on "the last opened
 *    connection". This shim replicates that via a single global default
 *    link, set whenever mysql_connect() is called.
 *  - mysql_connect() returns a real mysqli object. Existing code that does
 *    `$bd = mysql_connect(...)` and later passes `$bd` around as the link
 *    argument continues to work, because mysqli functions accept a mysqli
 *    object too.
 *  - Error suppression (`@mysql_query(...)`) still works the same way.
 *  - mysqli, by default, throws exceptions on SQL errors in PHP 8.1+
 *    driver builds *only if* mysqli_report() has enabled that mode. We
 *    explicitly turn that off below so this old-style "return false and
 *    check mysql_error()" code keeps behaving the way it always did.
 */

// Make mysqli behave like the old mysql extension: return false on
// failure instead of throwing mysqli_sql_exception.
if (function_exists('mysqli_report')) {
    mysqli_report(MYSQLI_REPORT_OFF);
}

// Old MYSQL_* fetch-type constants -> MYSQLI_* equivalents.
if (!defined('MYSQL_ASSOC')) {
    define('MYSQL_ASSOC', MYSQLI_ASSOC);
}
if (!defined('MYSQL_NUM')) {
    define('MYSQL_NUM', MYSQLI_NUM);
}
if (!defined('MYSQL_BOTH')) {
    define('MYSQL_BOTH', MYSQLI_BOTH);
}

$GLOBALS['__mysql_compat_default_link'] = null;
$GLOBALS['__mysql_compat_links'] = [];

/**
 * Resolve which mysqli link to use: the one explicitly passed in, or the
 * last connection opened by mysql_connect()/mysql_pconnect().
 */
function __mysql_compat_link($link = null)
{
    if ($link instanceof mysqli) {
        return $link;
    }
    return $GLOBALS['__mysql_compat_default_link'];
}

if (!function_exists('mysql_connect')) {
    function mysql_connect($host = 'localhost', $user = '', $password = '', $new_link = false, $client_flags = 0)
    {
        // Old ext/mysql allowed "host:port" and "host:/path/to/socket".
        $port = null;
        $socket = null;
        if (strpos($host, ':') !== false) {
            [$hostOnly, $rest] = explode(':', $host, 2);
            if (is_numeric($rest)) {
                $port = (int) $rest;
            } else {
                $socket = $rest;
            }
            $host = $hostOnly;
        }

        // On Windows, "localhost" can trigger a slow IPv6 (::1) lookup/timeout
        // before falling back to IPv4. Use the IPv4 loopback directly.
        if (PHP_OS_FAMILY === 'Windows' && $host === 'localhost') {
            $host = '127.0.0.1';
        }

        // The old ext/mysql reused an existing link when called again with the
        // same host/user/password (unless $new_link was true). Without this,
        // every repeated include of db.php opens a brand-new connection,
        // which makes pages noticeably slower.
        $key = $host . '|' . $port . '|' . $socket . '|' . $user . '|' . md5((string) $password);
        if (!$new_link && isset($GLOBALS['__mysql_compat_links'][$key])
            && @mysqli_ping($GLOBALS['__mysql_compat_links'][$key])) {
            $GLOBALS['__mysql_compat_default_link'] = $GLOBALS['__mysql_compat_links'][$key];
            return $GLOBALS['__mysql_compat_links'][$key];
        }

        $link = mysqli_init();
        // Suppress native warnings; old code checks mysql_error() itself.
        $connected = @$link->real_connect($host, $user, $password, '', $port, $socket, $client_flags);
        if (!$connected) {
            $GLOBALS['__mysql_compat_last_connect_error'] = mysqli_connect_error();
            error_log('mysql_compat: connect to ' . $host . ' as ' . $user . ' failed: [' . mysqli_connect_errno() . '] ' . mysqli_connect_error());
            return false;
        }
        $GLOBALS['__mysql_compat_links'][$key] = $link;
        $GLOBALS['__mysql_compat_default_link'] = $link;
        return $link;
    }
}

if (!function_exists('mysql_pconnect')) {
    function mysql_pconnect($host = 'localhost', $user = '', $password = '')
    {
        return mysql_connect('p:' . $host, $user, $password);
    }
}

if (!function_exists('mysql_select_db')) {
    function mysql_select_db($database, $link = null)
    {
        $link = __mysql_compat_link($link);
        if (!$link) {
            return false;
        }
        return @mysqli_select_db($link, $database);
    }
}

if (!function_exists('mysql_query')) {
    function mysql_query($query, $link = null)
    {
        $link = __mysql_compat_link($link);
        if (!$link) {
            return false;
        }
        return @mysqli_query($link, $query);
    }
}

if (!function_exists('mysql_error')) {
    function mysql_error($link = null)
    {
        $link = __mysql_compat_link($link);
        if ($link) {
            return mysqli_error($link);
        }
        return $GLOBALS['__mysql_compat_last_connect_error'] ?? '';
    }
}

if (!function_exists('mysql_errno')) {
    function mysql_errno($link = null)
    {
        $link = __mysql_compat_link($link);
        return $link ? mysqli_errno($link) : 0;
    }
}

if (!function_exists('mysql_insert_id')) {
    function mysql_insert_id($link = null)
    {
        $link = __mysql_compat_link($link);
        return $link ? mysqli_insert_id($link) : false;
    }
}

if (!function_exists('mysql_affected_rows')) {
    function mysql_affected_rows($link = null)
    {
        $link = __mysql_compat_link($link);
        return $link ? mysqli_affected_rows($link) : false;
    }
}

if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($result, $type = MYSQL_BOTH)
    {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        return mysqli_fetch_array($result, $type);
    }
}

if (!function_exists('mysql_fetch_assoc')) {
    function mysql_fetch_assoc($result)
    {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        return mysqli_fetch_assoc($result);
    }
}

if (!function_exists('mysql_fetch_row')) {
    function mysql_fetch_row($result)
    {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        return mysqli_fetch_row($result);
    }
}

if (!function_exists('mysql_fetch_object')) {
    function mysql_fetch_object($result)
    {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        return mysqli_fetch_object($result);
    }
}

if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($result)
    {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        return mysqli_num_rows($result);
    }
}

// Old alias some very old code used interchangeably with mysql_num_rows().
if (!function_exists('mysql_numrows')) {
    function mysql_numrows($result)
    {
        return mysql_num_rows($result);
    }
}

if (!function_exists('mysql_num_fields')) {
    function mysql_num_fields($result)
    {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        return mysqli_num_fields($result);
    }
}

if (!function_exists('mysql_free_result')) {
    function mysql_free_result($result)
    {
        if ($result instanceof mysqli_result) {
            mysqli_free_result($result);
        }
        return true;
    }
}

if (!function_exists('mysql_close')) {
    function mysql_close($link = null)
    {
        $link = __mysql_compat_link($link);
        if ($link) {
            @mysqli_close($link);
            if ($GLOBALS['__mysql_compat_default_link'] === $link) {
                $GLOBALS['__mysql_compat_default_link'] = null;
            }
            return true;
        }
        return false;
    }
}

if (!function_exists('mysql_escape_string')) {
    function mysql_escape_string($str)
    {
        $link = __mysql_compat_link(null);
        if ($link) {
            return mysqli_real_escape_string($link, $str);
        }
        // No connection yet: fall back to addslashes() so the call
        // doesn't fatal; behaviour matches old mysql_escape_string()
        // closely enough for this fallback case.
        return addslashes($str);
    }
}

if (!function_exists('mysql_real_escape_string')) {
    function mysql_real_escape_string($str, $link = null)
    {
        $link = __mysql_compat_link($link);
        if ($link) {
            return mysqli_real_escape_string($link, $str);
        }
        return addslashes($str);
    }
}

if (!function_exists('mysql_result')) {
    function mysql_result($result, $row, $field = 0)
    {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        if (mysqli_data_seek($result, $row)) {
            $data = mysqli_fetch_array($result);
            return $data[$field] ?? false;
        }
        return false;
    }
}

if (!function_exists('mysql_data_seek')) {
    function mysql_data_seek($result, $row)
    {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        return mysqli_data_seek($result, $row);
    }
}

if (!function_exists('mysql_field_name')) {
    function mysql_field_name($result, $index)
    {
        if (!($result instanceof mysqli_result)) {
            return false;
        }
        $finfo = mysqli_fetch_field_direct($result, $index);
        return $finfo ? $finfo->name : false;
    }
}

if (!function_exists('mysql_list_fields')) {
    function mysql_list_fields($database, $table, $link = null)
    {
        $link = __mysql_compat_link($link);
        if (!$link) {
            return false;
        }
        return @mysqli_query($link, "SELECT * FROM `$database`.`$table` LIMIT 0");
    }
}
