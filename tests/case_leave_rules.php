<?php
/**
 * Tests for the leave rules in /leave_rules.php and the leave-type resolver.
 *
 * Covers date parsing, inclusive day counting, the annual/non-annual split,
 * and - importantly - sas_leave_resolve_type(), which accepts a leave type by
 * id OR by name (the fix for "Please select a valid leave type from the list.").
 */
require __DIR__ . '/bootstrap.php';

sas_test_reset();
require_once __DIR__ . '/../leave_rules.php';

$year = (int) date('Y');

// ---- date parsing ---------------------------------------------------------
sas_test_assert(sas_leave_to_ts('2026-11-12') !== false, 'ISO date parses');
sas_test_assert(sas_leave_to_ts('12.11.2026') !== false, 'dd.mm.yyyy parses');
sas_test_assert(sas_leave_to_ts('12/11/2026') !== false, 'dd/mm/yyyy parses');
sas_test_assert(sas_leave_to_ts('20261112') !== false, 'yyyymmdd parses');
sas_test_assert(sas_leave_to_ts('not a date') === false, 'garbage does not parse');
sas_test_assert(sas_leave_to_ts('') === false, 'empty does not parse');

// ---- inclusive day counting ----------------------------------------------
sas_test_assert_equals(1, sas_leave_days_between(
    sas_leave_to_ts('2026-11-12'), sas_leave_to_ts('2026-11-12')), 'same day = 1');
sas_test_assert_equals(3, sas_leave_days_between(
    sas_leave_to_ts('2026-11-12'), sas_leave_to_ts('2026-11-14')), '12th->14th = 3');

// ---- day label ------------------------------------------------------------
sas_test_assert_equals('3', sas_leave_days_label(3), 'label 3 -> "3"');
sas_test_assert_equals('3.5', sas_leave_days_label(3.5), 'label 3.5 -> "3.5"');
sas_test_assert_equals('0', sas_leave_days_label(0), 'label 0 -> "0"');

// ---- leave types configured ----------------------------------------------
sas_test_assert_equals(3, sas_leave_type_count(), 'three leave types configured');

$annualIds = sas_leave_annual_type_ids();
sas_test_assert(in_array(1, $annualIds, true), 'Annual Leave is recognised as annual');
sas_test_assert(!in_array(2, $annualIds, true), 'Sick Leave is not annual');

// ---- annual / non-annual split -------------------------------------------
sas_test_assert(sas_leave_is_annual(1), 'id 1 is annual');
sas_test_assert(!sas_leave_is_annual(2), 'id 2 is not annual');
sas_test_assert(sas_leave_is_annual('Annual Leave'), 'name "Annual Leave" is annual');
sas_test_assert(!sas_leave_is_annual('Sick Leave'), 'name "Sick Leave" is not annual');

// ---- the resolver: id OR name -------------------------------------------
$r = sas_leave_resolve_type('1');
sas_test_assert($r !== null, 'resolve by id "1"');
sas_test_assert_equals(1, $r['leave_type_id'], 'resolved id 1 -> leave_type_id 1');
sas_test_assert_equals('Annual Leave', $r['leave_type'], 'resolved id 1 -> name "Annual Leave"');

$r = sas_leave_resolve_type('2');
sas_test_assert($r !== null && $r['leave_type'] === 'Sick Leave', 'resolve by id "2" -> Sick Leave');

// Legacy/hand-written request that posts the NAME instead of the id.
$r = sas_leave_resolve_type('Annual Leave');
sas_test_assert($r !== null, 'resolve by name "Annual Leave"');
sas_test_assert_equals(1, $r['leave_type_id'], 'name "Annual Leave" resolves to id 1');

$r = sas_leave_resolve_type('Sick Leave');
sas_test_assert($r !== null && $r['leave_type_id'] === 2, 'name "Sick Leave" resolves to id 2');

sas_test_assert(sas_leave_resolve_type('Nope') === null, 'unknown value resolves to null');
sas_test_assert(sas_leave_resolve_type('') === null, 'empty value resolves to null');

// ---- annual balance / used ------------------------------------------------
// A pending annual request of 3 days reduces the balance.
sas_test_exec("INSERT INTO tbl_leaves(leave_type,no_of_days,emp_file_no,report_date,fs_status,hod_status,hrm_status)"
    . " VALUES ('1','3','EMP003','" . $year . "','Pending','Pending','Pending')");
$bal = sas_leave_annual_balance('EMP003', $year);
sas_test_assert_equals(28, $bal['allowance'], 'allowance is 28');
sas_test_assert_equals(3, $bal['used'], '3 days counted as used');
sas_test_assert_equals(25, $bal['remaining'], '25 days remaining');

// A rejected annual request must NOT count against the balance.
sas_test_exec("INSERT INTO tbl_leaves(leave_type,no_of_days,emp_file_no,report_date,fs_status,hod_status,hrm_status)"
    . " VALUES ('1','10','EMP003','" . $year . "','Rejected','Pending','Pending')");
$bal = sas_leave_annual_balance('EMP003', $year);
sas_test_assert_equals(3, $bal['used'], 'rejected request not counted');

// A non-annual request never touches the annual balance.
sas_test_exec("INSERT INTO tbl_leaves(leave_type,no_of_days,emp_file_no,report_date,fs_status,hod_status,hrm_status)"
    . " VALUES ('2','20','EMP003','" . $year . "','Pending','Pending','Pending')");
$bal = sas_leave_annual_balance('EMP003', $year);
sas_test_assert_equals(3, $bal['used'], 'non-annual request not counted');

echo "ALL leave-rules tests passed.\n";
