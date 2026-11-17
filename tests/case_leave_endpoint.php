<?php
/**
 * End-to-end tests for authorized/usersystem/add_leave_request.php.
 *
 * Each scenario is run in a separate process (tests/endpoint_runner.php) so the
 * endpoint's exit() does not kill the test runner. We assert on the response
 * text and on what actually landed in tbl_leaves.
 */
require __DIR__ . '/bootstrap.php';

/** Run one scenario and return its stdout. */
function sas_endpoint_run($scenario)
{
    $cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(__DIR__ . '/endpoint_runner.php')
        . ' ' . escapeshellarg($scenario);
    $out = array();
    $code = 0;
    exec($cmd . ' 2>/dev/null', $out, $code);
    return implode("\n", $out);
}

/** Count leave rows for an employee. */
function sas_endpoint_leave_count($emp = 'EMP003')
{
    $link = $GLOBALS['__sas_db_link'];
    $stmt = $link->prepare('SELECT COUNT(*) AS n FROM tbl_leaves WHERE emp_file_no = ?');
    $stmt->bind_param('s', $emp);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    return (int) $row['n'];
}

/** The leave_type stored on the most recent leave row for an employee. */
function sas_endpoint_last_leave_type($emp = 'EMP003')
{
    $link = $GLOBALS['__sas_db_link'];
    $stmt = $link->prepare('SELECT leave_type FROM tbl_leaves WHERE emp_file_no = ? ORDER BY leave_id DESC LIMIT 1');
    $stmt->bind_param('s', $emp);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    return $row ? $row['leave_type'] : null;
}

sas_test_reset();

// 1) Valid request posting the leave type by ID -> saved.
$out = sas_endpoint_run('valid_id');
sas_test_assert(strpos($out, 'Leave request submitted successfully') !== false,
    'valid request (by id) is saved');
sas_test_assert_equals(1, sas_endpoint_leave_count(), 'a leave row was inserted');

// 2) Valid request posting the leave type by NAME -> saved (the regression).
sas_test_reset();
$out = sas_endpoint_run('valid_name');
sas_test_assert(strpos($out, 'Leave request submitted successfully') !== false,
    'valid request (by name) is saved');
sas_test_assert_equals(1, sas_endpoint_leave_count(), 'a leave row was inserted for name submission');
sas_test_assert_equals('1', sas_endpoint_last_leave_type(),
    'the canonical leave_type id (not the name) is stored');

// 3) Non-annual type by id -> saved (unrestricted).
sas_test_reset();
$out = sas_endpoint_run('sick_by_id');
sas_test_assert(strpos($out, 'Leave request submitted successfully') !== false,
    'non-annual leave (sick) is saved');
sas_test_assert_equals(1, sas_endpoint_leave_count(), 'sick leave row inserted');

// 4) Unknown leave type -> refused, nothing written.
sas_test_reset();
$out = sas_endpoint_run('invalid');
sas_test_assert(strpos($out, 'Please select a valid leave type from the list') !== false,
    'unknown leave type is refused with the clear message');
sas_test_assert_equals(0, sas_endpoint_leave_count(), 'nothing inserted for unknown type');

// 5) Empty leave type -> the "please select" validation message.
sas_test_reset();
$out = sas_endpoint_run('empty');
sas_test_assert(strpos($out, 'Please select the leave type') !== false,
    'empty leave type is caught by the field check');
sas_test_assert_equals(0, sas_endpoint_leave_count(), 'nothing inserted for empty type');

// 6) Annual leave with the allowance already used up -> refused.
sas_test_reset();
$out = sas_endpoint_run('annual_used_up');
sas_test_assert(strpos($out, 'Annual leave limit reached') !== false,
    'annual request is refused once the allowance is used up');
sas_test_assert_equals(1, sas_endpoint_leave_count(),
    'only the pre-booked row remains, the new request is not inserted');

// 7) Annual request longer than the remaining allowance -> refused.
sas_test_reset();
$out = sas_endpoint_run('annual_over_limit');
sas_test_assert(strpos($out, 'Annual leave limit exceeded') !== false,
    'annual request longer than the allowance is refused');
sas_test_assert_equals(0, sas_endpoint_leave_count(), 'nothing inserted when over limit');

// 8) "To" before "From" -> refused with a date message.
sas_test_reset();
$out = sas_endpoint_run('dates_bad');
sas_test_assert(strpos($out, 'before the "From" date') !== false,
    'end date before start date is refused');
sas_test_assert_equals(0, sas_endpoint_leave_count(), 'nothing inserted for bad dates');

// 9) No leave types configured at all -> a clear admin message.
sas_test_reset();
$out = sas_endpoint_run('no_types');
sas_test_assert(strpos($out, 'No leave types are configured') !== false,
    'empty leave-type table reports the real cause');
sas_test_assert_equals(0, sas_endpoint_leave_count(), 'nothing inserted when no types exist');

echo "ALL leave-endpoint tests passed.\n";
