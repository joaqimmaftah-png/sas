<?php
/**
 * Runs one add_leave_request.php scenario in its own process and prints the
 * endpoint's response to stdout.
 *
 * The endpoint calls exit() on validation failure, so each scenario must run
 * in a subprocess - this file is that subprocess. The parent
 * (case_leave_endpoint.php) spawns it once per scenario and inspects stdout.
 */

require __DIR__ . '/bootstrap.php';

/** Build the $_POST payload for a scenario. */
function sas_test_scenario($scenario)
{
    $year = (int) date('Y'); // year-independent so the tests never drift

    // A valid request: annual leave by id, 3 days, 12th -> 14th.
    $post = array(
        'employee_no' => 'EMP003',
        'leave_type'  => '1',
        'fs'          => 'EMP001',
        'hod'         => 'EMP002',
        'sdate'       => $year . '-11-12',
        'enddate'     => $year . '-11-14',
    );

    switch ($scenario) {
        case 'valid_name':
            // Legacy request that posts the leave type NAME instead of the id.
            $post['leave_type'] = 'Annual Leave';
            break;
        case 'sick_by_id':
            $post['leave_type'] = '2';
            break;
        case 'invalid':
            $post['leave_type'] = '999';
            break;
        case 'empty':
            $post['leave_type'] = '';
            break;
        case 'annual_used_up':
            $post['leave_type']  = '1';
            $post['sdate']       = $year . '-11-12';
            $post['enddate']     = $year . '-11-12'; // 1 day, but 0 left
            break;
        case 'annual_over_limit':
            $post['leave_type']  = '1';
            $post['sdate']       = $year . '-11-01';
            $post['enddate']     = $year . '-11-30'; // 30 days > 28
            break;
        case 'dates_bad':
            $post['leave_type']  = '1';
            $post['sdate']       = $year . '-11-14';
            $post['enddate']     = $year . '-11-12';
            break;
        case 'no_types':
            $post['leave_type']  = '1';
            break;
    }

    return $post;
}

sas_test_reset();

$scenario = isset($argv[1]) ? $argv[1] : '';

switch ($scenario) {
    case 'no_types':
        sas_test_exec('DELETE FROM tbl_leave_type');
        break;
    case 'annual_used_up':
        // Book the full 28-day allowance for the applicant first.
        $year = (int) date('Y');
        sas_test_exec(
            "INSERT INTO tbl_leaves(leave_type,no_of_days,emp_file_no,report_date,"
            . "fs_status,hod_status,hrm_status) VALUES ('1','28','EMP003','$year','Pending','Pending','Pending')"
        );
        break;
}

$_POST = sas_test_scenario($scenario);

// The endpoint exits after echoing its alert; that is expected.
require __DIR__ . '/../authorized/usersystem/add_leave_request.php';
