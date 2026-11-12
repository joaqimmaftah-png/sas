<?php
/**
 * The "Apply Leave Request" form - UI/UX redesign.
 *
 * This file is the single source of truth for the form markup, its styles and
 * its small amount of presentation JavaScript. Every page that used to carry
 * its own copy of the form now includes this file instead:
 *
 *     <form id="applyleave" action="authorized/usersystem/add_leave_request.php" method="post">
 *         <?php include __DIR__ . '/leave_request_form.php'; ?>
 *     </form>
 *
 * Nothing about the submission contract changed - the posted field names are
 * still sdate, enddate, leave_type, fs, hod, name and employee_no, and the
 * server-side rules in add_leave_request.php are untouched. Only the look,
 * the layout and the live feedback are new.
 *
 * The annual-leave rule text/validation still comes from leave_form_rules.php,
 * which is included below so that every page gets it exactly once.
 */

if (defined('SAS_LEAVE_REQUEST_FORM')) {
    return;
}
define('SAS_LEAVE_REQUEST_FORM', true);

require_once __DIR__ . '/../../mysql_compat.php';

if (!function_exists('sas_lr_esc')) {
    /** HTML-escape a value for output. */
    function sas_lr_esc($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('sas_lr_initials')) {
    /** "Juma Ali Mwinyi" -> "JM" (used by the avatar bubble). */
    function sas_lr_initials($name)
    {
        $name = trim((string) $name);
        if ($name === '') {
            return '?';
        }
        $parts = preg_split('/\s+/', $name);
        $first = substr($parts[0], 0, 1);
        $last  = count($parts) > 1 ? substr($parts[count($parts) - 1], 0, 1) : substr($parts[0], 1, 1);
        return strtoupper($first . $last);
    }
}

// ---------------------------------------------------------------------------
// Who is applying?
// ---------------------------------------------------------------------------
$sas_lr_emp = '';
if (isset($_SESSION['emp_file_no']) && !is_array($_SESSION['emp_file_no'])) {
    $sas_lr_emp = trim((string) $_SESSION['emp_file_no']);
}

$sas_lr_name = '';
$sas_lr_role = '';

if ($sas_lr_emp !== '' && function_exists('mysql_query')) {
    $sas_lr_q = @mysql_query(
        "SELECT * FROM tbl_employee WHERE emp_file_no='" . mysql_real_escape_string($sas_lr_emp) . "' LIMIT 1"
    );
    if ($sas_lr_q && ($sas_lr_row = @mysql_fetch_array($sas_lr_q))) {
        $sas_lr_name = trim($sas_lr_row['first_name'] . ' ' . $sas_lr_row['surname']);
        foreach (array('position', 'position_name', 'job_title', 'department', 'department_name') as $sas_lr_key) {
            if (!empty($sas_lr_row[$sas_lr_key]) && !is_array($sas_lr_row[$sas_lr_key])) {
                $sas_lr_role = trim((string) $sas_lr_row[$sas_lr_key]);
                break;
            }
        }
    }
}
if ($sas_lr_name === '' && isset($first_name) && !is_array($first_name)) {
    $sas_lr_name = trim($first_name . ' ' . (isset($surname) && !is_array($surname) ? $surname : ''));
}

// ---------------------------------------------------------------------------
// Dropdown data
// ---------------------------------------------------------------------------
$sas_lr_types = array();
if (function_exists('mysql_query')) {
    $sas_lr_q = @mysql_query("SELECT leave_type_id, leave_type FROM tbl_leave_type ORDER BY leave_type");
    while ($sas_lr_q && ($sas_lr_row = @mysql_fetch_array($sas_lr_q))) {
        $sas_lr_types[] = array(
            'id'   => $sas_lr_row['leave_type_id'],
            'name' => $sas_lr_row['leave_type'],
        );
    }
}

$sas_lr_people = array();
if (function_exists('mysql_query')) {
    $sas_lr_q = @mysql_query("SELECT emp_file_no, first_name, surname FROM tbl_employee ORDER BY first_name, surname");
    while ($sas_lr_q && ($sas_lr_row = @mysql_fetch_array($sas_lr_q))) {
        $sas_lr_people[] = array(
            'no'   => $sas_lr_row['emp_file_no'],
            'name' => trim($sas_lr_row['first_name'] . ' ' . $sas_lr_row['surname']),
        );
    }
}

// The rules file prints window.SAS_LEAVE_RULES (allowance / used / left) and
// the client-side validation shared by every page.
include __DIR__ . '/leave_form_rules.php';

$sas_lr_year = (int) date('Y');
if (isset($sas_leave_balance) && is_array($sas_leave_balance)) {
    $sas_lr_balance = $sas_leave_balance;
} elseif ($sas_lr_emp !== '') {
    $sas_lr_balance = sas_leave_annual_balance($sas_lr_emp, $sas_lr_year);
} else {
    $sas_lr_balance = array('allowance' => (int) SAS_ANNUAL_LEAVE_DAYS, 'used' => 0, 'remaining' => (int) SAS_ANNUAL_LEAVE_DAYS);
}

$sas_lr_allow     = (float) $sas_lr_balance['allowance'];
$sas_lr_used      = (float) $sas_lr_balance['used'];
$sas_lr_remaining = (float) $sas_lr_balance['remaining'];
$sas_lr_used_pct  = $sas_lr_allow > 0 ? min(100, round(($sas_lr_used / $sas_lr_allow) * 100)) : 0;
$sas_lr_empty     = ($sas_lr_remaining <= 0);
?>
<style type="text/css">
/* ==========================================================================
   Apply Leave Request - redesign
   Everything is scoped to #myModalleave so no other screen is affected.
   ========================================================================== */
#myModalleave .modal-dialog {
    width: 860px;
    max-width: 94vw;
    margin: 42px auto;
}
#myModalleave .modal-content {
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 0;
    border-radius: 16px;
}
#myModalleave .window {
    border: 0 !important;
    border-radius: 16px;
    background: #ffffff;
    min-height: 0;
    min-width: 0;
    -webkit-box-shadow: 0 26px 70px rgba(12, 30, 54, 0.32);
    box-shadow: 0 26px 70px rgba(12, 30, 54, 0.32);
}
#myModalleave .window .caption {
    position: relative;
    top: auto;
    height: auto;
    width: auto;
    border: 0;
    border-radius: 16px 16px 0 0;
    padding: 20px 24px;
    background: #124f86;
    background-image: -webkit-linear-gradient(315deg, #0b2f52 0%, #124f86 55%, #1b6eae 100%);
    background-image: linear-gradient(135deg, #0b2f52 0%, #124f86 55%, #1b6eae 100%);
    cursor: default;
}
#myModalleave .window .caption .title {
    float: none;
    margin: 0;
    font-size: 19px;
    font-weight: 600;
    line-height: 1.3;
    color: #ffffff;
    letter-spacing: 0.01em;
}
#myModalleave .window .content {
    padding: 0;
    box-sizing: border-box;
}
#myModalleave .margin10 {
    margin: 0;
}

/* ---- header ------------------------------------------------------------ */
#myModalleave .sas-lr-head {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
#myModalleave .sas-lr-head-icon {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: 44px;
    height: 44px;
    margin-right: 14px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.16);
    border: 1px solid rgba(255, 255, 255, 0.22);
    color: #ffffff;
    font-size: 19px;
    line-height: 42px;
    text-align: center;
}
#myModalleave .sas-lr-head-text {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-width: 0;
}
#myModalleave .sas-lr-subtitle {
    margin-top: 3px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.72);
}
#myModalleave .window .caption .btn-close {
    position: absolute;
    top: 50%;
    right: 18px;
    left: auto;
    width: 34px;
    height: 34px;
    min-height: 0;
    margin-top: -17px;
    padding: 0;
    float: none;
    border: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.14);
    color: #ffffff;
    font-size: 20px;
    font-weight: 400;
    line-height: 1;
    opacity: 1;
    text-shadow: none;
    outline: none;
}
#myModalleave .window .caption .btn-close:after {
    content: '\D7';
    position: absolute;
    top: 50%;
    left: 50%;
    height: auto;
    width: auto;
    margin: -12px 0 0 -6px;
    border: 0;
    font-size: 22px;
    line-height: 1;
}
#myModalleave .window .caption .btn-close:hover,
#myModalleave .window .caption .btn-close:active {
    top: 50%;
    right: 18px;
    background: rgba(255, 255, 255, 0.3);
    color: #ffffff;
}

/* ---- body -------------------------------------------------------------- */
#myModalleave .sas-leave-form {
    margin: 0;
    padding: 22px 24px 24px;
    background: #f7f9fc;
    font-family: inherit;
    color: #1f2937;
}
#myModalleave .sas-leave-form label {
    font-weight: 700;
    color: #3b4a60;
}

/* applicant strip */
#myModalleave .sas-lr-identity {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 12px 16px;
    margin-bottom: 18px;
    background: #ffffff;
    border: 1px solid #e4eaf3;
    border-radius: 12px;
}
#myModalleave .sas-lr-avatar {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: 40px;
    height: 40px;
    margin-right: 12px;
    border-radius: 50%;
    background: #1b6eae;
    background-image: -webkit-linear-gradient(315deg, #124f86 0%, #2f8ad4 100%);
    background-image: linear-gradient(135deg, #124f86 0%, #2f8ad4 100%);
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.04em;
    line-height: 40px;
    text-align: center;
}
#myModalleave .sas-lr-identity-text {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-width: 0;
}
#myModalleave .sas-lr-identity-name {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #10233b;
    line-height: 1.35;
}
#myModalleave .sas-lr-identity-meta {
    display: block;
    font-size: 12px;
    color: #6b7a90;
    line-height: 1.4;
}
#myModalleave .sas-lr-tag {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    margin-left: 12px;
    padding: 6px 11px;
    border-radius: 99px;
    background: #eef4ff;
    color: #1b5fa8;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    white-space: nowrap;
}

/* section headings */
#myModalleave .sas-lr-section {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    margin: 4px 0 12px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    color: #8894a8;
}
#myModalleave .sas-lr-section:after {
    content: '';
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    height: 1px;
    margin-left: 12px;
    background: #e3e9f2;
}

/* fields */
#myModalleave .sas-lr-row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin: 0 -8px;
}
#myModalleave .sas-lr-field {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-box-flex: 1;
    -ms-flex: 1 1 220px;
    flex: 1 1 220px;
    min-width: 0;
    padding: 0 8px;
    margin-bottom: 16px;
}
#myModalleave .sas-lr-field-days {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 118px;
    flex: 0 0 118px;
}
#myModalleave .sas-lr-field-full {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
}
#myModalleave .sas-lr-label {
    display: block;
    margin: 0 0 6px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.02em;
    color: #3b4a60;
}
#myModalleave .sas-lr-req {
    color: #d64545;
    font-weight: 700;
}
#myModalleave .sas-lr-help {
    margin: -6px 0 14px;
    font-size: 12px;
    color: #7b8798;
}
#myModalleave .sas-lr-help i {
    color: #9aa6b8;
    margin-right: 5px;
}

#myModalleave .sas-leave-form .form-control {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    display: block;
    width: 100%;
    height: 44px;
    padding: 0 14px;
    border: 1px solid #d9e1ec;
    border-radius: 10px;
    background-color: #ffffff;
    color: #1f2937;
    font-size: 14px;
    line-height: normal;
    -webkit-box-shadow: none;
    box-shadow: none;
    -webkit-transition: border-color 0.15s ease, box-shadow 0.15s ease;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}
#myModalleave .sas-leave-form .form-control:hover {
    border-color: #c3cfe0;
}
#myModalleave .sas-leave-form .form-control:focus {
    border-color: #2f6fed;
    -webkit-box-shadow: 0 0 0 3px rgba(47, 111, 237, 0.15);
    box-shadow: 0 0 0 3px rgba(47, 111, 237, 0.15);
    outline: 0;
}
#myModalleave .sas-leave-form select.form-control {
    height: 44px;
    padding-right: 38px;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%2364748b' d='M1.4 0 6 4.6 10.6 0 12 1.4 6 7.4 0 1.4z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
#myModalleave .sas-leave-form select.form-control::-ms-expand {
    display: none;
}

/* date input + picker button */
#myModalleave .sas-lr-date.input-control.text {
    height: auto;
    width: 100%;
    background: transparent;
    cursor: pointer;
}
#myModalleave .sas-lr-date.input-control.text .btn-date {
    display: block;
    top: 0;
    right: 0;
    width: 44px;
    height: 44px;
    min-height: 0;
    background: transparent;
    color: #8a97a8;
    font-size: 14px;
    line-height: 44px;
    text-align: center;
}
#myModalleave .sas-lr-date.input-control.text .btn-date:after {
    content: none;
}
#myModalleave .sas-lr-date.input-control.text .btn-date:hover {
    color: #1b6eae;
    background: transparent;
}
#myModalleave .sas-lr-date .form-control {
    padding-right: 46px;
    cursor: pointer;
}

/* the calendar popup stays a metro calendar - just soften its frame */
#myModalleave .calendar-dropdown {
    margin-top: 6px;
    padding: 6px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #ffffff;
    -webkit-box-shadow: 0 18px 40px rgba(15, 30, 54, 0.18);
    box-shadow: 0 18px 40px rgba(15, 30, 54, 0.18);
}

/* day counter */
#myModalleave .sas-lr-days {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    display: block;
    height: 44px;
    padding: 0 10px;
    border: 1px dashed #cfdcee;
    border-radius: 10px;
    background: #ffffff;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
}
#myModalleave .sas-lr-days strong {
    display: inline-block;
    font-size: 19px;
    font-weight: 700;
    color: #124f86;
    line-height: 42px;
    vertical-align: top;
}
#myModalleave .sas-lr-days span {
    display: inline-block;
    margin-left: 3px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: #8a97a8;
    line-height: 42px;
    vertical-align: top;
}

/* annual leave balance card */
#myModalleave .sas-lr-balance {
    padding: 16px 18px;
    margin-bottom: 16px;
    border: 1px solid #d9e6f8;
    border-radius: 12px;
    background: #eef4ff;
    background-image: -webkit-linear-gradient(top, #f8fbff 0%, #eaf2ff 100%);
    background-image: linear-gradient(180deg, #f8fbff 0%, #eaf2ff 100%);
}
#myModalleave .sas-lr-balance.is-empty {
    border-color: #f2d2d2;
    background: #fdf0f0;
    background-image: none;
}
#myModalleave .sas-lr-balance-top {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: baseline;
    -ms-flex-align: baseline;
    align-items: baseline;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
#myModalleave .sas-lr-balance-title {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #4b6a90;
}
#myModalleave .sas-lr-balance-value {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    font-size: 12px;
    color: #4b6a90;
}
#myModalleave .sas-lr-balance-value strong {
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
    color: #124f86;
    margin-right: 2px;
}
#myModalleave .sas-lr-balance.is-empty .sas-lr-balance-value strong {
    color: #b02a37;
}
#myModalleave .sas-lr-bar {
    height: 8px;
    margin: 12px 0 8px;
    border-radius: 99px;
    background: #d7e4f7;
    overflow: hidden;
}
#myModalleave .sas-lr-bar span {
    display: block;
    height: 100%;
    width: 0;
    border-radius: 99px;
    background: #2f6fed;
    background-image: -webkit-linear-gradient(left, #2f6fed 0%, #1b6eae 100%);
    background-image: linear-gradient(90deg, #2f6fed 0%, #1b6eae 100%);
    -webkit-transition: width 0.35s ease;
    transition: width 0.35s ease;
}
#myModalleave .sas-lr-balance.is-empty .sas-lr-bar span {
    background: #d64545;
    background-image: none;
}
#myModalleave .sas-lr-balance-meta {
    font-size: 12px;
    color: #5b7091;
}

/* actions */
#myModalleave .sas-lr-actions {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-top: 4px;
    padding-top: 18px;
    border-top: 1px solid #e3e9f2;
}
#myModalleave .sas-lr-submit {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    display: inline-block;
    height: 46px;
    padding: 0 24px;
    border: 0;
    border-radius: 10px;
    background: #124f86;
    background-image: -webkit-linear-gradient(315deg, #124f86 0%, #1b6eae 100%);
    background-image: linear-gradient(135deg, #124f86 0%, #1b6eae 100%);
    color: #ffffff;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.01em;
    line-height: 46px;
    cursor: pointer;
    -webkit-box-shadow: 0 8px 18px rgba(18, 79, 134, 0.26);
    box-shadow: 0 8px 18px rgba(18, 79, 134, 0.26);
    -webkit-transition: -webkit-transform 0.12s ease, box-shadow 0.15s ease, opacity 0.15s ease;
    transition: transform 0.12s ease, box-shadow 0.15s ease, opacity 0.15s ease;
}
#myModalleave .sas-lr-submit i {
    margin-right: 8px;
}
#myModalleave .sas-lr-submit:hover {
    -webkit-transform: translateY(-1px);
    transform: translateY(-1px);
    -webkit-box-shadow: 0 12px 24px rgba(18, 79, 134, 0.32);
    box-shadow: 0 12px 24px rgba(18, 79, 134, 0.32);
    color: #ffffff;
}
#myModalleave .sas-lr-submit:active {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    -webkit-box-shadow: 0 6px 14px rgba(18, 79, 134, 0.3);
    box-shadow: 0 6px 14px rgba(18, 79, 134, 0.3);
}
#myModalleave .sas-lr-submit[disabled],
#myModalleave .sas-lr-submit.is-busy {
    opacity: 0.7;
    cursor: default;
    -webkit-transform: none;
    transform: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}
#myModalleave .sas-lr-reset {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    height: 46px;
    margin-left: 10px;
    padding: 0 18px;
    border: 1px solid #d9e1ec;
    border-radius: 10px;
    background: #ffffff;
    color: #475569;
    font-size: 13px;
    font-weight: 600;
    line-height: 44px;
    cursor: pointer;
}
#myModalleave .sas-lr-reset:hover {
    border-color: #c3cfe0;
    background: #f7f9fc;
    color: #1f2937;
}
#myModalleave .sas-lr-actions-hint {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 200px;
    flex: 1 1 200px;
    margin-left: 16px;
    font-size: 12px;
    line-height: 1.45;
    color: #8894a8;
    text-align: right;
}

/* server response (#depends) and any alert inside the modal */
#myModalleave .sas-lr-response:empty {
    display: none;
}
#myModalleave #depends {
    margin-top: 16px;
}
#myModalleave .alert {
    position: relative;
    margin: 0 0 10px;
    padding: 13px 16px 13px 44px;
    border: 0;
    border-radius: 10px;
    font-size: 13px;
    line-height: 1.55;
    text-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}
#myModalleave .alert:last-child {
    margin-bottom: 0;
}
#myModalleave .alert > .close {
    float: right;
    margin: -2px -4px 0 8px;
    font-size: 18px;
    line-height: 1;
    color: inherit;
    opacity: 0.55;
    text-shadow: none;
}
#myModalleave .alert > .close:hover {
    opacity: 1;
    color: inherit;
}
#myModalleave .alert:before {
    position: absolute;
    top: 13px;
    left: 15px;
    font-family: FontAwesome;
    font-size: 15px;
    font-weight: 400;
    line-height: 1;
}
#myModalleave .alert-success {
    background: #e4f6ee;
    color: #0f6247;
}
#myModalleave .alert-success:before {
    content: '\f058';
}
#myModalleave .alert-warning {
    background: #fff5e5;
    color: #8a5300;
}
#myModalleave .alert-warning:before {
    content: '\f071';
}
#myModalleave .alert-danger {
    background: #fbe4e4;
    color: #8a1c1c;
}
#myModalleave .alert-danger:before {
    content: '\f057';
}
#myModalleave .alert-info {
    background: #e7effd;
    color: #1e3a5f;
}
#myModalleave .alert-info:before {
    content: '\f05a';
}

/* the live rule message (written by leave_form_rules.php) */
#myModalleave .sas-leave-form [data-sas-leave-note] {
    margin: 12px 0 0;
    padding: 11px 14px;
    border: 0;
    border-left: 3px solid #2f6fed;
    border-radius: 8px;
    background: #e7effd;
    color: #1e3a5f;
    font-size: 12.5px;
    line-height: 1.55;
    text-shadow: none;
    display: block;
}
#myModalleave .sas-leave-form [data-sas-leave-note]:before {
    content: none;
}
#myModalleave .sas-leave-form [data-sas-leave-note].alert-danger {
    border-left-color: #d64545;
    background: #fbe4e4;
    color: #8a1c1c;
}
#myModalleave .sas-leave-form [data-sas-leave-note].alert-success {
    border-left-color: #12805c;
    background: #e4f6ee;
    color: #0f6247;
}

/* the applicant's earlier requests, below the form */
#myModalleave #show_message {
    padding: 0 24px 24px;
    border-radius: 0 0 16px 16px;
    background: #f7f9fc;
}
#myModalleave .sas-lr-history-title {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    margin: 0 0 12px;
    padding-top: 18px;
    border-top: 1px solid #e3e9f2;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    color: #8894a8;
}
#myModalleave .sas-lr-history-title i {
    margin-right: 8px;
    color: #a8b3c4;
}
#myModalleave .sas-lr-history-title:after {
    content: '';
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    height: 1px;
    margin-left: 12px;
    background: #e3e9f2;
}
#myModalleave #show_message table.table {
    margin: 0;
    border: 1px solid #e4eaf3;
    border-radius: 12px;
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
    font-size: 13px;
}
#myModalleave #show_message table.table thead th:first-child {
    border-radius: 12px 0 0 0;
}
#myModalleave #show_message table.table thead th:last-child {
    border-radius: 0 12px 0 0;
}
#myModalleave #show_message table.table tbody tr:last-child td:first-child {
    border-radius: 0 0 0 12px;
}
#myModalleave #show_message table.table tbody tr:last-child td:last-child {
    border-radius: 0 0 12px 0;
}
#myModalleave #show_message table.table thead th {
    padding: 11px 14px;
    border: 0;
    border-bottom: 1px solid #e4eaf3;
    background: #f3f6fb;
    color: #64748b;
    font-size: 10.5px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    text-align: left;
    white-space: nowrap;
}
#myModalleave #show_message table.table tbody td {
    padding: 12px 14px;
    border: 0;
    border-bottom: 1px solid #eef2f7;
    color: #33425a;
    vertical-align: middle;
    text-align: left;
    white-space: nowrap;
}
#myModalleave #show_message table.table tbody tr:last-child td {
    border-bottom: 0;
}
#myModalleave #show_message table.table tbody tr:hover td {
    background: #f7f9fc;
}
#myModalleave .sas-lr-pill {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 99px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.02em;
    line-height: 1.6;
    background: #eef2f7;
    color: #536273;
}
#myModalleave .sas-lr-pill-ok {
    background: #e4f6ee;
    color: #0f7b52;
}
#myModalleave .sas-lr-pill-bad {
    background: #fbe4e4;
    color: #b02a37;
}
#myModalleave .sas-lr-pill-wait {
    background: #fff5e5;
    color: #a25c00;
}
#myModalleave .sas-lr-empty {
    padding: 22px 14px;
    color: #8894a8;
    font-size: 13px;
    text-align: center;
}

/* small screens */
@media (max-width: 720px) {
    #myModalleave .modal-dialog {
        width: auto;
        max-width: none;
        margin: 12px;
    }
    #myModalleave .window .caption {
        padding: 16px 18px;
    }
    #myModalleave .window .caption .title {
        font-size: 16px;
    }
    #myModalleave .sas-leave-form {
        padding: 18px 16px 20px;
    }
    #myModalleave #show_message {
        padding: 0 16px 18px;
    }
    #myModalleave .sas-lr-field,
    #myModalleave .sas-lr-field-days {
        -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
    }
    #myModalleave .sas-lr-actions-hint {
        margin: 12px 0 0;
        text-align: left;
    }
    #myModalleave .sas-lr-submit,
    #myModalleave .sas-lr-reset {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        text-align: center;
    }
    #myModalleave .sas-lr-tag {
        display: none;
    }
}
</style>

<div class="sas-leave-form" data-sas-leave-form="1">

    <!-- who is applying ---------------------------------------------------- -->
    <div class="sas-lr-identity">
        <div class="sas-lr-avatar" aria-hidden="true"><?php echo sas_lr_esc(sas_lr_initials($sas_lr_name)); ?></div>
        <div class="sas-lr-identity-text">
            <span class="sas-lr-identity-name"><?php echo $sas_lr_name !== '' ? sas_lr_esc($sas_lr_name) : 'Signed-in employee'; ?></span>
            <span class="sas-lr-identity-meta">
                <?php if ($sas_lr_role !== '') { echo sas_lr_esc($sas_lr_role) . ' &middot; '; } ?>
                Employee No: <strong><?php echo $sas_lr_emp !== '' ? sas_lr_esc($sas_lr_emp) : '&mdash;'; ?></strong>
            </span>
        </div>
        <span class="sas-lr-tag"><i class="fa fa-calendar-o"></i> Leave year <?php echo (int) $sas_lr_year; ?></span>
    </div>

    <!-- what are you applying for ------------------------------------------ -->
    <div class="sas-lr-section">Leave type</div>
    <div class="sas-lr-row">
        <div class="sas-lr-field sas-lr-field-full">
            <label class="sas-lr-label" for="leave_type">Type of leave <span class="sas-lr-req">*</span></label>
            <select class="form-control" name="leave_type" id="leave_type" required="required">
                <option value="">Select the type of leave&hellip;</option>
<?php foreach ($sas_lr_types as $sas_lr_type) { ?>
                <option value="<?php echo sas_lr_esc($sas_lr_type['id']); ?>"><?php echo sas_lr_esc($sas_lr_type['name']); ?></option>
<?php } ?>
            </select>
        </div>
    </div>

    <!-- annual leave balance ------------------------------------------------ -->
    <div class="sas-lr-balance<?php echo $sas_lr_empty ? ' is-empty' : ''; ?>" data-sas-lr-card="1">
        <div class="sas-lr-balance-top">
            <span class="sas-lr-balance-title">Annual leave &middot; <?php echo (int) $sas_lr_year; ?></span>
            <span class="sas-lr-balance-value">
                <strong data-sas-lr-left><?php echo sas_lr_esc(rtrim(rtrim(number_format($sas_lr_remaining, 2, '.', ''), '0'), '.')); ?></strong>
                <span>day(s) left</span>
            </span>
        </div>
        <div class="sas-lr-bar" role="progressbar" aria-valuemin="0" aria-valuemax="<?php echo (int) $sas_lr_allow; ?>" aria-valuenow="<?php echo (int) $sas_lr_used; ?>">
            <span data-sas-lr-bar style="width:<?php echo (int) $sas_lr_used_pct; ?>%"></span>
        </div>
        <div class="sas-lr-balance-meta">
            <strong data-sas-lr-used><?php echo sas_lr_esc(rtrim(rtrim(number_format($sas_lr_used, 2, '.', ''), '0'), '.')); ?></strong>
            of <span data-sas-lr-allow><?php echo sas_lr_esc(rtrim(rtrim(number_format($sas_lr_allow, 2, '.', ''), '0'), '.')); ?></span>
            day(s) already used in <span data-sas-lr-year><?php echo (int) $sas_lr_year; ?></span>
        </div>

        <div class="alert alert-info" data-sas-leave-note role="status" aria-live="polite">Checking your annual leave balance&hellip;</div>
    </div>

    <!-- when ---------------------------------------------------------------- -->
    <div class="sas-lr-section">Leave period</div>
    <div class="sas-lr-row">
        <div class="sas-lr-field">
            <label class="sas-lr-label" for="sdate">From <span class="sas-lr-req">*</span></label>
            <div class="input-control text sas-lr-date" data-role="datepicker" data-week-start="1">
                <input readonly="readonly" name="sdate" id="sdate" type="text" class="form-control" placeholder="dd.mm.yyyy" autocomplete="off">
                <button type="button" class="btn-date" aria-label="Pick the start date"><i class="fa fa-calendar"></i></button>
            </div>
        </div>
        <div class="sas-lr-field">
            <label class="sas-lr-label" for="enddate">To <span class="sas-lr-req">*</span></label>
            <div class="input-control text sas-lr-date" data-role="datepicker" data-week-start="1">
                <input name="enddate" value="" id="enddate" type="text" class="form-control" placeholder="dd.mm.yyyy" autocomplete="off">
                <button type="button" class="btn-date" aria-label="Pick the end date"><i class="fa fa-calendar"></i></button>
            </div>
        </div>
        <div class="sas-lr-field sas-lr-field-days">
            <span class="sas-lr-label">Days</span>
            <div class="sas-lr-days" aria-live="polite"><strong data-sas-lr-days>&ndash;</strong><span>day(s)</span></div>
        </div>
    </div>
    <div class="sas-lr-help"><i class="fa fa-info-circle"></i>Both dates are counted &mdash; the same day in both fields counts as 1 day.</div>

    <!-- approval route ------------------------------------------------------ -->
    <div class="sas-lr-section">Approval route</div>
    <div class="sas-lr-row">
        <div class="sas-lr-field">
            <label class="sas-lr-label" for="fs">Immediate supervisor <span class="sas-lr-req">*</span></label>
            <select class="form-control" name="fs" id="fs" required="required">
                <option value="">Select your supervisor&hellip;</option>
<?php foreach ($sas_lr_people as $sas_lr_person) { ?>
                <option value="<?php echo sas_lr_esc($sas_lr_person['no']); ?>"><?php echo sas_lr_esc($sas_lr_person['name']); ?><?php echo $sas_lr_person['no'] === $sas_lr_emp ? ' (you)' : ''; ?></option>
<?php } ?>
            </select>
        </div>
        <div class="sas-lr-field">
            <label class="sas-lr-label" for="hod">Head of department <span class="sas-lr-req">*</span></label>
            <select class="form-control" name="hod" id="hod" required="required">
                <option value="">Select the head of your department&hellip;</option>
<?php foreach ($sas_lr_people as $sas_lr_person) { ?>
                <option value="<?php echo sas_lr_esc($sas_lr_person['no']); ?>"><?php echo sas_lr_esc($sas_lr_person['name']); ?><?php echo $sas_lr_person['no'] === $sas_lr_emp ? ' (you)' : ''; ?></option>
<?php } ?>
            </select>
        </div>
    </div>

    <!-- hidden contract fields (unchanged) ---------------------------------- -->
    <input type="hidden" value="<?php echo sas_lr_esc($sas_lr_name); ?>" id="name" name="name">
    <input type="hidden" value="<?php echo sas_lr_esc($sas_lr_emp); ?>" id="employee_no" name="employee_no">

    <!-- actions ------------------------------------------------------------- -->
    <div class="sas-lr-actions">
        <button type="submit" class="sas-lr-submit"><i class="fa fa-paper-plane"></i><span data-sas-lr-submit-label>Submit request</span></button>
        <button type="reset" class="sas-lr-reset" data-sas-lr-reset><i class="fa fa-undo"></i> Clear</button>
        <div class="sas-lr-actions-hint">Your supervisor and head of department are notified by email once the request is saved.</div>
    </div>

    <!-- server response ----------------------------------------------------- -->
    <div id="depends" class="sas-lr-response"></div>
</div>

<script type="text/javascript">
(function () {
    'use strict';

    var modal = document.getElementById('myModalleave');
    if (!modal) {
        return;
    }

    var form = modal.querySelector('form#applyleave');
    if (!form) {
        return;
    }

    // The styled, inline messages are the single source of truth; the
    // "required" attributes stay for screen readers but must not pop up the
    // browser's own bubbles on top of them.
    form.noValidate = true;

    var R = window.SAS_LEAVE_RULES || null;
    var card = form.querySelector('[data-sas-lr-card]');
    var leftEl = form.querySelector('[data-sas-lr-left]');
    var usedEl = form.querySelector('[data-sas-lr-used]');
    var allowEl = form.querySelector('[data-sas-lr-allow]');
    var barEl = form.querySelector('[data-sas-lr-bar]');
    var daysEl = form.querySelector('[data-sas-lr-days]');
    var submitBtn = form.querySelector('button[type="submit"]');
    var submitLabel = form.querySelector('[data-sas-lr-submit-label]');
    var response = form.querySelector('#depends');

    function fmt(n) {
        n = Math.round(Number(n) * 100) / 100;
        return String(n);
    }

    /* ---- live presentation, fed by leave_form_rules.php ------------------ */
    function paint(state) {
        if (!state) {
            return;
        }
        if (leftEl) {
            leftEl.textContent = fmt(state.remaining);
        }
        if (usedEl) {
            usedEl.textContent = fmt(state.used);
        }
        if (allowEl) {
            allowEl.textContent = fmt(state.allowance);
        }
        if (barEl) {
            var pct = state.allowance > 0 ? Math.round(Math.min(100, (state.used / state.allowance) * 100)) : 0;
            barEl.style.width = pct + '%';
        }
        if (card) {
            if (state.remaining <= 0) {
                card.className = card.className.replace(/\s*is-empty/g, '') + ' is-empty';
            } else {
                card.className = card.className.replace(/\s*is-empty/g, '');
            }
        }
        if (daysEl) {
            daysEl.textContent = state.days ? fmt(state.days) : '\u2013';
        }
    }

    // leave_form_rules.php calls this whenever it recalculates the form.
    window.SAS_LEAVE_ON_UPDATE = paint;

    /* ---- submit feedback ------------------------------------------------- */
    var pending = null;

    function busy(on) {
        if (!submitBtn) {
            return;
        }
        if (on) {
            submitBtn.disabled = true;
            submitBtn.className = submitBtn.className.replace(/\s*is-busy/, '') + ' is-busy';
            if (submitLabel) {
                submitLabel.textContent = 'Submitting\u2026';
            }
        } else {
            submitBtn.disabled = false;
            submitBtn.className = submitBtn.className.replace(/\s*is-busy/g, '');
            if (submitLabel) {
                submitLabel.textContent = 'Submit request';
            }
        }
    }

    function scrollToResponse() {
        if (!response || !response.firstChild) {
            return;
        }
        try {
            response.scrollIntoView({ block: 'nearest' });
        } catch (e) { /* older browsers - ignore */ }
    }

    function isAnnualId(value) {
        var ids = (R && R.annualIds) || [];
        for (var i = 0; i < ids.length; i++) {
            if (String(ids[i]) === String(value)) {
                return true;
            }
        }
        return false;
    }

    // Remember what is being sent so the balance can be adjusted afterwards.
    form.addEventListener('submit', function (ev) {
        // leave_form_rules.php blocks a bad request before we get here; when it
        // does, do not leave the button stuck on "Submitting...".
        if (ev && ev.defaultPrevented) {
            pending = null;
            return;
        }
        var sel = form.querySelector('select[name="leave_type"]');
        var startInput = form.querySelector('input[name="sdate"]');
        var endInput = form.querySelector('input[name="enddate"]');
        pending = {
            days: daysEl && daysEl.textContent !== '\u2013' ? parseFloat(daysEl.textContent) || 0 : 0,
            annual: !!(sel && isAnnualId(sel.value)),
            start: startInput ? startInput.value : '',
            end: endInput ? endInput.value : '',
            typeText: (sel && sel.selectedIndex > -1)
                ? sel.options[sel.selectedIndex].text.replace(/\s*\([^()]*\)\s*$/, '')
                : ''
        };
        busy(true);
    }, false);

    // Any AJAX response ends the "submitting" state.
    if (window.jQuery) {
        window.jQuery(document).ajaxComplete(function (ev, xhr, settings) {
            var url = (settings && settings.url) || '';
            if (url.indexOf('add_leave_request') === -1) {
                return;
            }
            busy(false);

            var html = (xhr && xhr.responseText) || '';
            if (html.indexOf('Leave request submitted successfully') === -1 || !pending) {
                scrollToResponse();
                return;
            }

            // Saved: update the balance, clear the period, add the new row.
            if (pending.annual && R) {
                R.used = Math.round((Number(R.used) + pending.days) * 100) / 100;
                R.remaining = Math.max(0, Math.round((Number(R.allowance) - R.used) * 100) / 100);
            }
            if (window.SAS_LEAVE_API && typeof window.SAS_LEAVE_API.refresh === 'function') {
                window.SAS_LEAVE_API.refresh();
            } else {
                paint(R);
            }

            var s = form.querySelector('input[name="sdate"]');
            var e = form.querySelector('input[name="enddate"]');
            var t = form.querySelector('select[name="leave_type"]');
            if (s) { s.value = ''; }
            if (e) { e.value = ''; }
            if (t) { t.selectedIndex = 0; }
            if (daysEl) { daysEl.textContent = '\u2013'; }
            if (window.SAS_LEAVE_API && typeof window.SAS_LEAVE_API.refresh === 'function') {
                window.SAS_LEAVE_API.refresh();
            }

            addHistoryRow(pending);
            scrollToResponse();
            pending = null;
        });
    }

    /* ---- "Clear" resets the live feedback too ---------------------------- */
    var resetBtn = form.querySelector('[data-sas-lr-reset]');
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            window.setTimeout(function () {
                if (window.SAS_LEAVE_API && typeof window.SAS_LEAVE_API.refresh === 'function') {
                    window.SAS_LEAVE_API.refresh();
                }
                if (daysEl) { daysEl.textContent = '\u2013'; }
            }, 0);
        }, false);
    }

    /* ---- history table: heading, status pills and empty state ------------ */
    // Scoped to this modal: other modals on the same page reuse the id.
    function historyBox() {
        return modal.querySelector('#show_message');
    }

    function pill(text) {
        var span = document.createElement('span');
        var t = String(text || '');
        var kind = '';
        if (/approv|accept|grant/i.test(t)) {
            kind = ' sas-lr-pill-ok';
        } else if (/reject|declin|denied|cancel/i.test(t)) {
            kind = ' sas-lr-pill-bad';
        } else if (/pending|wait|process/i.test(t)) {
            kind = ' sas-lr-pill-wait';
        } else {
            return null;
        }
        span.className = 'sas-lr-pill' + kind;
        span.textContent = t;
        return span;
    }

    function decorateHistory() {
        var box = historyBox();
        if (!box || box.getAttribute('data-sas-lr-decorated') === '1') {
            return;
        }
        box.setAttribute('data-sas-lr-decorated', '1');

        var title = document.createElement('div');
        title.className = 'sas-lr-section sas-lr-history-title';
        var icon = document.createElement('i');
        icon.className = 'fa fa-history';
        title.appendChild(icon);
        title.appendChild(document.createTextNode(' My leave requests'));
        box.insertBefore(title, box.firstChild);

        var rows = box.querySelectorAll('table.table tbody tr');
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            for (var c = 3; c < cells.length; c++) {
                var td = cells[c];
                if (td.getElementsByTagName('span').length) {
                    continue;
                }
                var text = (td.textContent || '').replace(/^\s+|\s+$/g, '');
                if (!text) {
                    continue;
                }
                var p = pill(text);
                if (p) {
                    td.innerHTML = '';
                    td.appendChild(p);
                }
            }
        }
    }

    function addHistoryRow(info) {
        var box = historyBox();
        if (!box || !info) {
            return;
        }
        decorateHistory();
        var tbody = box.querySelector('table.table tbody');
        if (!tbody) {
            return;
        }
        var emptyRow = tbody.querySelector('td.sas-lr-empty');
        if (emptyRow) {
            tbody.innerHTML = '';
        }
        var tr = document.createElement('tr');
        var values = [info.start, info.end, info.typeText];
        for (var i = 0; i < values.length; i++) {
            var td = document.createElement('td');
            td.className = 'right';
            td.textContent = values[i];
            tr.appendChild(td);
        }
        for (var s = 0; s < 3; s++) {
            var statusTd = document.createElement('td');
            statusTd.className = 'right';
            var p = pill('Pending');
            if (p) {
                statusTd.appendChild(p);
            } else {
                statusTd.textContent = 'Pending';
            }
            tr.appendChild(statusTd);
        }
        tbody.appendChild(tr);
    }

    function emptyState() {
        var box = historyBox();
        if (!box || box.getAttribute('data-sas-lr-empty-done') === '1') {
            return;
        }
        var tbody = box.querySelector('table.table tbody');
        if (!tbody || tbody.getElementsByTagName('tr').length) {
            return;
        }
        box.setAttribute('data-sas-lr-empty-done', '1');
        var tr = document.createElement('tr');
        var td = document.createElement('td');
        td.className = 'sas-lr-empty';
        td.colSpan = 6;
        td.innerHTML = '<i class="fa fa-inbox"></i> You have not requested any leave yet.';
        tr.appendChild(td);
        tbody.appendChild(tr);
    }

    /* ---- messages should be announced ------------------------------------ */
    if (response && response.setAttribute) {
        response.setAttribute('aria-live', 'polite');
    }

    function boot() {
        if (window.SAS_LEAVE_API && typeof window.SAS_LEAVE_API.refresh === 'function') {
            window.SAS_LEAVE_API.refresh();
        }
        decorateHistory();
        emptyState();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }

    // Metro's datepicker writes the value with .val(), which does not fire a
    // "change" event - so listen for the pick itself and refresh afterwards.
    if (window.jQuery) {
        window.jQuery(document).on('click', '.calendar-dropdown a, .calendar-dropdown td', function () {
            window.setTimeout(function () {
                if (window.SAS_LEAVE_API && typeof window.SAS_LEAVE_API.refresh === 'function') {
                    window.SAS_LEAVE_API.refresh();
                }
            }, 0);
        });

        // The history lives outside the form, so it may be rendered after us.
        window.jQuery(document).on('show.bs.modal shown.bs.modal', '#myModalleave', function () {
            decorateHistory();
            emptyState();
        });

        window.jQuery(document).on('shown.bs.modal', '#myModalleave', function () {
            var first = form.querySelector('select[name="leave_type"]');
            if (first && document.activeElement !== first) {
                try { first.focus(); } catch (e) { /* ignore */ }
            }
        });
    }
}());
</script>
