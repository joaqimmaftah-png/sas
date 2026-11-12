<?php
/**
 * LEGACY leave request endpoint - kept only as a compatibility alias.
 *
 * This file used to hold its own copy of the leave submission logic (its own
 * day counting, no 28-day annual limit, and messages printed before the row
 * was even saved). Nothing in the project posts to it any more; the live form
 * (#applyleave) posts to add_leave_request.php.
 *
 * Any stray request that still arrives here is handled by that endpoint, so
 * the leave rules (annual limit, unrestricted other types, inclusive day
 * counting - see /leave_rules.php) apply everywhere and there is only one
 * place where leave requests are written.
 */
require __DIR__ . '/add_leave_request.php';
