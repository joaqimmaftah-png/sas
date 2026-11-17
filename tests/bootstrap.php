<?php
/**
 * Test bootstrap for the SAS leave module.
 *
 * Connects to the database configured through the SAS_DB_* environment
 * variables (a MySQL service in CI), makes sure the tables the leave module
 * needs exist, and seeds a small, deterministic set of rows so every test case
 * starts from the same state.
 *
 * The connection is the real one used by the application (db.php), so the
 * endpoint under test exercises exactly the same code path as in production.
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../mysql_compat.php';
require_once __DIR__ . '/../db.php';

// Surface the real link used by the mysql_* shim.
sas_db();

/** Execute a statement on the shared link; throw on error. */
function sas_test_exec($sql)
{
    $link = $GLOBALS['__sas_db_link'];
    $r = @$link->query($sql);
    if ($r === false) {
        throw new RuntimeException('SQL failed: ' . $link->error . ' :: ' . $sql);
    }
    return $r;
}

/** Create the minimal schema the leave module touches (idempotent). */
function sas_test_schema()
{
    sas_test_exec(
        'CREATE TABLE IF NOT EXISTS tbl_leave_type ('
        . ' leave_type_id INT AUTO_INCREMENT PRIMARY KEY,'
        . ' leave_type VARCHAR(255) NOT NULL'
        . ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
    );
    sas_test_exec(
        'CREATE TABLE IF NOT EXISTS tbl_employee ('
        . ' emp_file_no VARCHAR(64) PRIMARY KEY,'
        . ' first_name VARCHAR(128), surname VARCHAR(128),'
        . ' position VARCHAR(255), position_name VARCHAR(255),'
        . ' job_title VARCHAR(255), department VARCHAR(255), department_name VARCHAR(255)'
        . ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
    );
    sas_test_exec(
        'CREATE TABLE IF NOT EXISTS tbl_contact ('
        . ' emp_file_no VARCHAR(64) PRIMARY KEY, email VARCHAR(255)'
        . ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
    );
    sas_test_exec(
        'CREATE TABLE IF NOT EXISTS tbl_leaves ('
        . ' leave_id INT AUTO_INCREMENT PRIMARY KEY,'
        . ' leave_type VARCHAR(64), start_date VARCHAR(32), end_date VARCHAR(32),'
        . ' no_of_days VARCHAR(32), emp_file_no VARCHAR(64),'
        . ' hod_status VARCHAR(32), fs_status VARCHAR(32), hrm_status VARCHAR(32),'
        . ' hod_email VARCHAR(255), fs_email VARCHAR(255), hr_email VARCHAR(255),'
        . ' startdate VARCHAR(32), enddate VARCHAR(32), report_date VARCHAR(32)'
        . ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
    );
}

/** Wipe and re-seed so every test starts identical. */
function sas_test_reset()
{
    sas_test_schema();

    sas_test_exec('DELETE FROM tbl_leaves');
    sas_test_exec('DELETE FROM tbl_leave_type');
    sas_test_exec('DELETE FROM tbl_employee');
    sas_test_exec('DELETE FROM tbl_contact');

    // Leave types: id 1 = annual (limited), 2 & 3 unrestricted.
    sas_test_exec("INSERT INTO tbl_leave_type(leave_type_id, leave_type) VALUES (1,'Annual Leave')");
    sas_test_exec("INSERT INTO tbl_leave_type(leave_type_id, leave_type) VALUES (2,'Sick Leave')");
    sas_test_exec("INSERT INTO tbl_leave_type(leave_type_id, leave_type) VALUES (3,'Maternity Leave')");

    // Employees: 001 supervisor, 002 head of department, 003 the applicant.
    sas_test_exec("INSERT INTO tbl_employee(emp_file_no,first_name,surname) VALUES ('EMP001','Juma','Ali')");
    sas_test_exec("INSERT INTO tbl_employee(emp_file_no,first_name,surname) VALUES ('EMP002','Mary','Mwinyi')");
    sas_test_exec("INSERT INTO tbl_employee(emp_file_no,first_name,surname) VALUES ('EMP003','Peter','Khalfan')");

    sas_test_exec("INSERT INTO tbl_contact(emp_file_no,email) VALUES ('EMP001','supervisor@example.com')");
    sas_test_exec("INSERT INTO tbl_contact(emp_file_no,email) VALUES ('EMP002','hod@example.com')");
    sas_test_exec("INSERT INTO tbl_contact(emp_file_no,email) VALUES ('EMP003','applicant@example.com')");
}

/** Minimal assert helpers that exit non-zero on failure. */
function sas_test_assert($cond, $message)
{
    if (!$cond) {
        fwrite(STDERR, 'FAIL: ' . $message . "\n");
        exit(1);
    }
    echo 'ok - ' . $message . "\n";
}

function sas_test_assert_equals($expected, $actual, $message)
{
    if ($expected != $actual) {
        fwrite(STDERR, 'FAIL: ' . $message . "\n');
        fwrite(STDERR, '  expected: ' . var_export($expected, true) . "\n");
        fwrite(STDERR, '  actual:   ' . var_export($actual, true) . "\n");
        exit(1);
    }
    echo 'ok - ' . $message . "\n";
}
