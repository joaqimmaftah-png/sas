<?php
/**
 * SAS - LEAVE RULES (single source of truth)
 * ==========================================
 * Used by the leave request endpoint (authorized/usersystem/add_leave_request.php)
 * and by the notification/validation snippet printed on the leave forms
 * (authorized/usersystem/leave_form_rules.php).
 *
 * 1. Annual leave:  SAS_ANNUAL_LEAVE_DAYS (28 by default) per employee per
 *                   calendar year. Once used up, further ANNUAL requests are
 *                   refused - by the form and, authoritatively, by the server.
 * 2. Other types:   no limit at all (sick, maternity, paternity, casual, ...).
 * 3. Day counting:  inclusive - 12th to 14th = 3 days, 12th to 12th = 1 day.
 *
 * Leave types are identified by name: every type whose name contains
 * "annual" (case insensitive, e.g. "Annual Leave") is limited. Rename a type
 * in tbl_leave_type and the rule follows automatically.
 */
require_once __DIR__ . '/db.php';

// Fallback in case an older db_config.php without the constant is deployed.
if (!defined('SAS_ANNUAL_LEAVE_DAYS')) {
    define('SAS_ANNUAL_LEAVE_DAYS', 28);
}
if (!defined('SAS_ANNUAL_LEAVE_KEYWORD')) {
    define('SAS_ANNUAL_LEAVE_KEYWORD', 'annual');
}

if (!function_exists('sas_leave_to_ts')) {
    /**
     * Read a date in any of the formats this system produces and return a
     * timestamp at midnight, or false when the value is not a real date.
     * Accepted: 2026-11-12, 12.11.2026, 12/11/2026, 12-11-2026, 20261112,
     * plus anything strtotime() understands.
     */
    function sas_leave_to_ts($value)
    {
        $value = trim((string) $value);
        if ($value === '') {
            return false;
        }

        // 2026-11-12
        if (preg_match('/^(\d{4})[-\/.](\d{1,2})[-\/.](\d{1,2})$/', $value, $m)
            && checkdate((int) $m[2], (int) $m[3], (int) $m[1])) {
            return mktime(0, 0, 0, (int) $m[2], (int) $m[3], (int) $m[1]);
        }

        // 12.11.2026 / 12/11/2026 / 12-11-2026  (day first, as the datepicker writes it)
        if (preg_match('/^(\d{1,2})[.\/-](\d{1,2})[.\/-](\d{4})$/', $value, $m)
            && checkdate((int) $m[2], (int) $m[1], (int) $m[3])) {
            return mktime(0, 0, 0, (int) $m[2], (int) $m[1], (int) $m[3]);
        }

        // 20261112
        if (preg_match('/^(\d{4})(\d{2})(\d{2})$/', $value, $m)
            && checkdate((int) $m[2], (int) $m[3], (int) $m[1])) {
            return mktime(0, 0, 0, (int) $m[2], (int) $m[3], (int) $m[1]);
        }

        $ts = strtotime($value);
        if ($ts === false) {
            return false;
        }
        return strtotime(date('Y-m-d', $ts));
    }
}

if (!function_exists('sas_leave_days_between')) {
    /**
     * Number of leave days between two timestamps, both days included:
     * 12th -> 14th = 3 days, 12th -> 12th = 1 day.
     */
    function sas_leave_days_between($start_ts, $end_ts)
    {
        $days = (int) round(($end_ts - $start_ts) / 86400) + 1;
        return $days > 0 ? $days : 1;
    }
}

if (!function_exists('sas_leave_days_label')) {
    /** 3 -> "3", 3.5 -> "3.5" (never "3.00"). */
    function sas_leave_days_label($days)
    {
        $s = number_format((float) $days, 2, '.', '');
        $s = rtrim(rtrim($s, '0'), '.');
        return $s === '' ? '0' : $s;
    }
}

if (!function_exists('sas_leave_annual_type_ids')) {
    /** Ids of every leave type that counts as annual leave. */
    function sas_leave_annual_type_ids()
    {
        static $ids = null;
        if ($ids !== null) {
            return $ids;
        }

        $ids = array();
        $result = @mysql_query("SELECT leave_type_id, leave_type FROM tbl_leave_type");
        if ($result) {
            while ($row = mysql_fetch_array($result)) {
                if (stripos((string) $row['leave_type'], SAS_ANNUAL_LEAVE_KEYWORD) !== false) {
                    $ids[] = (int) $row['leave_type_id'];
                }
            }
        }
        return $ids;
    }
}

if (!function_exists('sas_leave_is_annual')) {
    /** Is this leave type annual leave? Pass the id and/or the type name. */
    function sas_leave_is_annual($leave_type_id, $leave_type_name = '')
    {
        if (stripos((string) $leave_type_name, SAS_ANNUAL_LEAVE_KEYWORD) !== false) {
            return true;
        }

        if ($leave_type_name === '') {
            $id = mysql_real_escape_string((string) $leave_type_id);
            $result = @mysql_query("SELECT leave_type FROM tbl_leave_type WHERE leave_type_id='$id'");
            if ($result && ($row = mysql_fetch_array($result))
                && stripos((string) $row['leave_type'], SAS_ANNUAL_LEAVE_KEYWORD) !== false) {
                return true;
            }
        }

        return in_array((int) $leave_type_id, sas_leave_annual_type_ids(), true);
    }
}

if (!function_exists('sas_leave_annual_used')) {
    /**
     * Annual leave days already taken / booked by an employee in a year.
     * Counts every request that is not rejected (pending + approved), so an
     * employee cannot book the same days twice while they wait for approval.
     */
    function sas_leave_annual_used($emp_file_no, $year)
    {
        $emp  = mysql_real_escape_string((string) $emp_file_no);
        $year = (int) $year;
        $ids  = sas_leave_annual_type_ids();
        $idList = $ids ? implode(',', $ids) : '0';
        $keyword = mysql_real_escape_string(SAS_ANNUAL_LEAVE_KEYWORD);

        $sql = "SELECT SUM(no_of_days) AS days_used FROM tbl_leaves"
            . " WHERE emp_file_no='$emp'"
            . " AND (report_date='$year' OR report_date LIKE '$year%'"
            . "      OR ((report_date IS NULL OR report_date='' OR report_date='0') AND startdate LIKE '$year%'))"
            . " AND (leave_type IN ($idList) OR leave_type LIKE '%$keyword%')"
            . " AND LOWER(COALESCE(fs_status,''))  <> 'rejected'"
            . " AND LOWER(COALESCE(hod_status,'')) <> 'rejected'"
            . " AND LOWER(COALESCE(hrm_status,'')) <> 'rejected'";

        $result = @mysql_query($sql);
        if (!$result) {
            error_log('SAS leave rules: could not read annual leave usage for ' . $emp_file_no . ': ' . mysql_error());
            return 0.0;
        }
        $row = mysql_fetch_array($result);
        return ($row && $row['days_used'] !== null) ? (float) $row['days_used'] : 0.0;
    }
}

if (!function_exists('sas_leave_annual_balance')) {
    /**
     * Allowance / used / remaining for one employee and calendar year.
     * 'remaining' never goes below zero.
     */
    function sas_leave_annual_balance($emp_file_no, $year)
    {
        $allowance = (int) SAS_ANNUAL_LEAVE_DAYS;
        $used      = sas_leave_annual_used($emp_file_no, $year);

        return array(
            'allowance' => $allowance,
            'used'      => $used,
            'remaining' => max(0, $allowance - $used),
        );
    }
}
