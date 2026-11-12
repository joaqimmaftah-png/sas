<?php
/**
 * Handles "Apply Leave Request" submissions (posted by #applyleave via AJAX).
 *
 * Two things are reported separately to the user:
 *   1. whether the request was SAVED in tbl_leaves  (the important one), and
 *   2. whether the notification EMAIL went out (and to whom).
 *
 * A problem with the mail server must never hide or fake the database result.
 */
require_once __DIR__ . '/../../mysql_compat.php';
require_once __DIR__ . '/../../db.php';

// ---------------------------------------------------------------------------
// Small helpers
// ---------------------------------------------------------------------------
if (!function_exists('sas_alert')) {
    function sas_alert($type, $title, $body)
    {
        return '<div class="alert alert-' . $type . '">'
            . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
            . '<strong>' . $title . '</strong> ' . $body
            . '</div>';
    }
}

if (!function_exists('sas_send_leave_notification')) {
    /**
     * Send one leave notification. Returns true when the mail server accepted
     * the message, false otherwise (failure is logged, never thrown).
     */
    function sas_send_leave_notification($to, $subject, $html, $from)
    {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $from . "\r\n"
            . 'Reply-To: ' . $from . "\r\n"
            . 'X-Mailer: PHP/' . phpversion();

        $sent = @mail($to, $subject, $html, $headers);
        if (!$sent) {
            error_log('SAS leave request: could not send notification email to ' . $to);
        }
        return (bool) $sent;
    }
}

$esc = function ($v) {
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
};

// ---------------------------------------------------------------------------
// Input
// ---------------------------------------------------------------------------
$emp_file_no = isset($_POST['employee_no']) ? trim($_POST['employee_no']) : '';
$leave_type  = isset($_POST['leave_type'])  ? trim($_POST['leave_type'])  : '';
$fs          = isset($_POST['fs'])          ? trim($_POST['fs'])          : '';
$hod         = isset($_POST['hod'])         ? trim($_POST['hod'])         : '';
$sdate       = isset($_POST['sdate'])       ? trim($_POST['sdate'])       : '';
$enddate     = isset($_POST['enddate'])     ? trim($_POST['enddate'])     : '';

if ($emp_file_no === '' || $leave_type === '' || $fs === '' || $hod === '' || $sdate === '' || $enddate === '') {
    echo sas_alert('danger', 'Error!..',
        'Please select the leave type, the dates, your supervisor and the head of department before submitting.');
    exit;
}

$d1 = date('Ymd', strtotime($sdate));
$d2 = date('Ymd', strtotime($enddate));
$date1 = strtotime($d1);
$date2 = strtotime($d2);

if ($date2 < $date1) {
    echo sas_alert('danger', 'Error, not saved!..',
        'The "To" date (' . $esc($enddate) . ') is before the "From" date (' . $esc($sdate) . '). Please pick the dates again - nothing was saved.');
    exit;
}

// One day when both dates are the same, otherwise the difference in days.
$n = ($date2 === $date1) ? 1 : ($date2 - $date1) / (60 * 60 * 24);

// ---------------------------------------------------------------------------
// Lookups
// ---------------------------------------------------------------------------
$q = function ($sql) {
    return mysql_query($sql) or die(mysql_error());
};

$ww  = mysql_fetch_array($q("SELECT * FROM tbl_employee WHERE emp_file_no='" . mysql_real_escape_string($fs) . "'"));
$ww2 = mysql_fetch_array($q("SELECT * FROM tbl_employee WHERE emp_file_no='" . mysql_real_escape_string($hod) . "'"));
$ww3 = mysql_fetch_array($q("SELECT * FROM tbl_employee WHERE emp_file_no='" . mysql_real_escape_string($emp_file_no) . "'"));

$fsname   = $ww ? trim($ww['first_name'] . ' ' . $ww['surname']) : '';
$hodname  = $ww2 ? trim($ww2['first_name'] . ' ' . $ww2['surname']) : '';
$yourname = $ww3 ? trim($ww3['first_name'] . ' ' . $ww3['surname']) : '';

$e  = mysql_fetch_array($q("SELECT * FROM tbl_contact WHERE emp_file_no='" . mysql_real_escape_string($fs) . "'"));
$v  = mysql_fetch_array($q("SELECT * FROM tbl_contact WHERE emp_file_no='" . mysql_real_escape_string($hod) . "'"));
$emailf = $e ? trim($e['email']) : '';
$emailh = $v ? trim($v['email']) : '';

$hod_status = 'Pending';
$hrm_status = 'Pending';
$fs_status  = 'Pending';

$a = mysql_fetch_array($q("SELECT * FROM tbl_leave_type WHERE leave_type_id='" . mysql_real_escape_string($leave_type) . "'"));
$leavename = $a ? $a['leave_type'] : '';

$y        = date('Y');
$row      = mysql_fetch_array($q("SELECT SUM(no_of_days) AS days_used FROM tbl_leaves WHERE emp_file_no='" . mysql_real_escape_string($emp_file_no) . "' AND report_date='$y' AND hod_status='Approved' AND fs_status='Approved' AND hrm_status='Approved'"));
$no_used  = $row ? (float) $row['days_used'] : 0;
$no_day_remain = 28 - $no_used;

// ---------------------------------------------------------------------------
// Not enough days left -> nothing is saved
// ---------------------------------------------------------------------------
if ($no_day_remain < $n) {
    echo sas_alert('danger', 'Error, not saved!..',
        'You have only ' . $esc($no_day_remain) . ' day(s) remaining for this year, but this request needs '
        . $esc($n) . ' day(s) (' . $esc($sdate) . ' to ' . $esc($enddate) . '). Nothing was saved.');
    exit;
}

// ---------------------------------------------------------------------------
// Save the request
// ---------------------------------------------------------------------------
$hr_email = 'operations@sincrositewatch.com';

$relatives = "INSERT INTO tbl_leaves(leave_type,start_date,end_date,no_of_days,emp_file_no,`hod_status`,fs_status, `hrm_status`,hod_email,fs_email,hr_email, startdate,enddate,report_date)"
    . " VALUES('" . mysql_real_escape_string($leave_type) . "','" . mysql_real_escape_string($sdate) . "','" . mysql_real_escape_string($enddate) . "','" . mysql_real_escape_string($n) . "','" . mysql_real_escape_string($emp_file_no) . "','$hod_status','$fs_status','$hrm_status','" . mysql_real_escape_string($emailh) . "','" . mysql_real_escape_string($emailf) . "','" . mysql_real_escape_string($hr_email) . "', '$d1', '$d2', '$y')";

$show = mysql_query($relatives);

if (!$show) {
    // The request was NOT saved - say so plainly, with the reason.
    $reason = (defined('SAS_DEBUG') && SAS_DEBUG) ? mysql_error() : '';
    echo sas_alert('danger', 'Leave request was NOT saved!..',
        'The database rejected the request. Please try again or contact the administrator (0654491973).'
        . ($reason !== '' ? '<br><small>' . $esc($reason) . '</small>' : ''));
    exit;
}

$leave_id = mysql_insert_id();

// 1) The database result - always shown when the row is saved.
echo sas_alert('success', 'Leave request submitted successfully.',
    'Your ' . $esc($leavename) . ' request from <strong>' . $esc($sdate) . '</strong> to <strong>' . $esc($enddate) . '</strong>'
    . ' (' . $esc($n) . ' day(s)) has been saved and is <strong>waiting for approval</strong>.'
    . ($leave_id ? '<br><small>Reference number: #' . $esc($leave_id) . '</small>' : ''));

// ---------------------------------------------------------------------------
// Notifications (reported separately - a mail failure does not undo the save)
// ---------------------------------------------------------------------------
$recipients = array();
$recipients[] = array('role' => 'Supervisor', 'name' => $fsname,  'email' => $emailf);
$recipients[] = array('role' => 'Head of Department', 'name' => $hodname, 'email' => $emailh);

$sent_ok   = array();
$no_email  = array();
$failed    = array();

foreach ($recipients as $r) {
    if ($r['email'] === '') {
        $no_email[] = $r['role'] . ($r['name'] !== '' ? ' (' . $r['name'] . ')' : '');
        continue;
    }

    $subject = 'Leave Request Note';
    $from    = 'sas@sincrositewatch.com';
    $to      = $r['email'] . ',' . $hr_email;

    $message  = '<html><body>';
    $message .= '<p style="text-bold;">Dear ' . $esc($r['name'] !== '' ? $r['name'] : $r['role']) . '</p>';
    $message .= '<p style="">Please! Assist to approve my leave Request for ' . $esc($leavename)
        . ' from ' . $esc($sdate) . ' to ' . $esc($enddate) . '</p>';
    $message .= '<p style="color:#080;font-size:18px;"><a href="http://sincrositewatch.com/sas/" target="_blank">Click this link to approve or reject the request!</a></p>';
    $message .= '<p style="">Regards,</p>';
    $message .= '<p style="">' . $esc($yourname) . '</p>';
    $message .= '<p style=""><br></p>';
    $message .= '<h4 style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</h4>';
    $message .= '</body></html>';

    if (sas_send_leave_notification($to, $subject, $message, $from)) {
        $sent_ok[] = $r['role'] . ($r['name'] !== '' ? ' (' . $r['name'] . ')' : '');
    } else {
        $failed[] = $r['role'] . ($r['name'] !== '' ? ' (' . $r['name'] . ')' : '');
    }
}

if (!$sent_ok && !$failed && !$no_email) {
    // Defensive: nothing to notify at all.
    echo sas_alert('warning', 'No notification email was sent.',
        'The request is saved, but no notification could be prepared. Please inform your supervisor directly.');
} elseif (!$failed && !$no_email) {
    echo sas_alert('success', 'Notification email sent.',
        'Your supervisor and head of department have been notified by email.');
} else {
    // Request is safe; only the email did not go out.
    $detail = '';
    if ($failed) {
        $detail .= 'The mail server could not deliver the message to: <strong>' . $esc(implode(', ', $failed)) . '</strong>.';
    }
    if ($no_email) {
        $detail .= ($detail !== '' ? ' ' : '')
            . 'No email address is registered for: <strong>' . $esc(implode(', ', $no_email)) . '</strong>, so no notification was sent to them.';
    }

    $title = $sent_ok
        ? 'Request saved, but one notification email was NOT sent.'
        : 'Request saved, but the email was NOT sent.';

    echo sas_alert('warning', $title,
        $detail . ' Your request is still in the system and pending approval - please inform '
        . (count($no_email) + count($failed) > 1 ? 'them' : 'him/her') . ' directly.');
}
?>
