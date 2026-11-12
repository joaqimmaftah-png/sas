<?php
/**
 * Prints the leave-rule information and the client-side validation used by the
 * "Apply Leave Request" form (#applyleave).
 *
 * Include it once per page, right after the form's opening tag:
 *
 *     <?php include __DIR__ . '/leave_form_rules.php'; ?>
 *
 * It shows how many annual leave days are left, and blocks the submission -
 * before any request is sent - when:
 *   - the "To" date is before the "From" date,
 *   - the selected leave type is ANNUAL and the request is longer than the
 *     remaining allowance (28 days per calendar year by default).
 *
 * The server re-checks the same rules in add_leave_request.php, so this is a
 * convenience, not the only line of defence.
 */
if (defined('SAS_LEAVE_FORM_RULES_PRINTED')) {
    return;
}
define('SAS_LEAVE_FORM_RULES_PRINTED', true);

require_once __DIR__ . '/../../leave_rules.php';

// Who is applying? Session first, then a page variable of the same name.
$sas_leave_emp = '';
if (isset($_SESSION['emp_file_no']) && !is_array($_SESSION['emp_file_no'])) {
    $sas_leave_emp = trim((string) $_SESSION['emp_file_no']);
} elseif (isset($emp_file_no) && !is_array($emp_file_no) && $emp_file_no !== '') {
    $sas_leave_emp = trim((string) $emp_file_no);
}

$sas_leave_year = (int) date('Y');
if ($sas_leave_emp !== '') {
    $sas_leave_balance = sas_leave_annual_balance($sas_leave_emp, $sas_leave_year);
} else {
    // Unknown user: show the policy, let the server decide.
    $sas_leave_balance = array(
        'allowance' => (int) SAS_ANNUAL_LEAVE_DAYS,
        'used'      => 0,
        'remaining' => (int) SAS_ANNUAL_LEAVE_DAYS,
    );
}

$sas_leave_data = array(
    'annualIds' => array_map('intval', sas_leave_annual_type_ids()),
    'allowance' => (int) $sas_leave_balance['allowance'],
    'used'      => (float) $sas_leave_balance['used'],
    'remaining' => (float) $sas_leave_balance['remaining'],
    'year'      => $sas_leave_year,
);
?>
<script type="text/javascript">
window.SAS_LEAVE_RULES = <?php echo json_encode($sas_leave_data); ?>;
</script>
<script type="text/javascript">
(function () {
    'use strict';

    var R = window.SAS_LEAVE_RULES;
    if (!R) {
        return;
    }

    function fmt(n) {
        n = Math.round(Number(n) * 100) / 100;
        return String(n);
    }

    function makeDate(y, m, d) {
        var dt = new Date(y, m - 1, d);
        if (dt.getFullYear() !== y || dt.getMonth() !== m - 1 || dt.getDate() !== d) {
            return null;
        }
        return dt;
    }

    function parseDate(value) {
        value = String(value || '').replace(/^\s+|\s+$/g, '');
        if (!value) {
            return null;
        }
        var m;
        if ((m = value.match(/^(\d{4})[-\/.](\d{1,2})[-\/.](\d{1,2})$/))) {
            return makeDate(+m[1], +m[2], +m[3]);
        }
        if ((m = value.match(/^(\d{1,2})[.\/-](\d{1,2})[.\/-](\d{4})$/))) {
            return makeDate(+m[3], +m[2], +m[1]);
        }
        if ((m = value.match(/^(\d{4})(\d{2})(\d{2})$/))) {
            return makeDate(+m[1], +m[2], +m[3]);
        }
        var d = new Date(value);
        if (isNaN(d.getTime())) {
            return null;
        }
        return new Date(d.getFullYear(), d.getMonth(), d.getDate());
    }

    function isAnnualType(id) {
        var ids = R.annualIds || [], i;
        for (i = 0; i < ids.length; i++) {
            if (Number(ids[i]) === Number(id)) {
                return true;
            }
        }
        return false;
    }

    function leaveForms() {
        var forms = document.getElementsByTagName('form'), out = [], i, f;
        for (i = 0; i < forms.length; i++) {
            f = forms[i];
            if (f.querySelector
                && f.querySelector('select[name="leave_type"]')
                && f.querySelector('input[name="sdate"]')
                && f.querySelector('input[name="enddate"]')) {
                out.push(f);
            }
        }
        return out;
    }

    function typeSelect(form) {
        return form.querySelector('select[name="leave_type"]');
    }

    function isAnnual(form) {
        var sel = typeSelect(form);
        return !!(sel && isAnnualType(sel.value));
    }

    function requestedDays(form) {
        var s = form.querySelector('input[name="sdate"]'),
            e = form.querySelector('input[name="enddate"]');
        var a = parseDate(s ? s.value : ''),
            b = parseDate(e ? e.value : '');
        if (!a || !b) {
            return null;
        }
        if (b.getTime() < a.getTime()) {
            return { error: 'before' };
        }
        return { days: Math.round((b.getTime() - a.getTime()) / 86400000) + 1 };
    }

    function noteBox(form) {
        var box = form.querySelector('[data-sas-leave-note]');
        if (box) {
            return box;
        }
        box = document.createElement('div');
        box.setAttribute('data-sas-leave-note', '1');
        box.className = 'alert alert-info';
        var submit = form.querySelector('input[type="submit"], button[type="submit"]');
        if (submit && submit.parentNode === form) {
            form.insertBefore(box, submit);
        } else {
            form.appendChild(box);
        }
        return box;
    }

    function showNote(form, type, html) {
        var box = noteBox(form);
        box.className = 'alert alert-' + type;
        box.innerHTML = html;
    }

    function annotateOptions(form) {
        var sel = typeSelect(form);
        if (!sel || sel.getAttribute('data-sas-annotated') === '1') {
            return;
        }
        sel.setAttribute('data-sas-annotated', '1');

        var suffix = (R.remaining <= 0)
            ? ' (limit reached)'
            : ' (' + fmt(R.remaining) + ' days left)';

        for (var i = 0; i < sel.options.length; i++) {
            if (isAnnualType(sel.options[i].value)) {
                sel.options[i].text = sel.options[i].text + suffix;
            }
        }
    }

    function isPlaceholder(sel) {
        var v = String(sel.value || '');
        return v === '' || v.charAt(0) === '-';
    }

    function refresh(form) {
        if (!typeSelect(form)) {
            return;
        }

        var req = requestedDays(form);
        var annual = isAnnual(form);

        if (req && req.error === 'before') {
            showNote(form, 'danger',
                '<strong>Check the dates.</strong> The "To" date is before the "From" date.');
            return;
        }

        if (!annual) {
            showNote(form, 'info',
                '<strong>No annual limit.</strong> Only annual leave is limited to '
                + fmt(R.allowance) + ' days per calendar year (' + fmt(R.year) + '); any other leave type is unrestricted.');
            return;
        }

        var text = '<strong>Annual leave ' + fmt(R.year) + ':</strong> ' + fmt(R.allowance)
            + ' day(s) allowance, ' + fmt(R.used) + ' used, <strong>' + fmt(R.remaining) + ' left</strong>.';

        if (req && req.days) {
            text += ' This request: ' + fmt(req.days) + ' day(s).';
            if (R.remaining <= 0) {
                text += ' You have used all your annual leave for this year.';
            } else if (req.days > R.remaining) {
                text += ' That is more than the days you have left.';
            }
        }

        showNote(form, (R.remaining <= 0 || (req && req.days && req.days > R.remaining)) ? 'danger' : 'info', text);
    }

    function validate(form) {
        // keep the note in step with what is about to be submitted
        refresh(form);

        var sel = typeSelect(form);
        if (sel && isPlaceholder(sel)) {
            showNote(form, 'danger', '<strong>Choose a leave type.</strong> Please pick one from the list before submitting.');
            return false;
        }

        var req = requestedDays(form);

        if (req && req.error === 'before') {
            return false;
        }

        if (!req || !isAnnual(form)) {
            return true; // nothing to check, or the server will handle the dates
        }

        if (R.remaining <= 0) {
            showNote(form, 'danger',
                '<strong>Annual leave limit reached.</strong> You have used all ' + fmt(R.allowance)
                + ' annual leave days for ' + fmt(R.year) + ', so no further annual leave can be requested.'
                + ' Please choose another leave type.');
            return false;
        }

        if (req.days > R.remaining) {
            showNote(form, 'danger',
                '<strong>Annual leave limit exceeded.</strong> This request needs ' + fmt(req.days)
                + ' day(s) but you have only ' + fmt(R.remaining) + ' day(s) left for ' + fmt(R.year)
                + ' (of ' + fmt(R.allowance) + '). Reduce the dates or choose another leave type.');
            return false;
        }

        return true;
    }

    // Capture phase: runs BEFORE the page's jQuery submit handler, so a failing
    // check stops the AJAX request from being sent at all.
    document.addEventListener('submit', function (ev) {
        var form = ev.target;
        if (!form || !form.querySelector || !typeSelect(form)) {
            return;
        }
        if (!validate(form)) {
            ev.preventDefault();
            ev.stopPropagation();
        }
    }, true);

    function onChange(ev) {
        var t = ev.target;
        if (t && t.form && typeSelect(t.form)) {
            refresh(t.form);
        }
    }
    document.addEventListener('change', onChange, true);
    document.addEventListener('input', onChange, true);

    function init() {
        var forms = leaveForms(), i;
        for (i = 0; i < forms.length; i++) {
            annotateOptions(forms[i]);
            refresh(forms[i]);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
}());
</script>
