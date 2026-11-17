# SAS leave module tests

Dependency-free PHP tests for the leave rules and the "Apply Leave Request"
endpoint. No PHPUnit, no Composer - just run them with PHP.

## What they cover

- `case_leave_rules.php` - date parsing, inclusive day counting, the
  annual/non-annual split, the leave-type resolver (by **id or name**), and the
  annual-leave balance.
- `case_leave_endpoint.php` - end-to-end submissions through
  `authorized/usersystem/add_leave_request.php` (valid by id, valid by name,
  unknown type, empty type, annual limit reached/exceeded, bad dates, empty
  type table).
- `lint.php` - `php -l` syntax check of every PHP file in the project.

## Running on local XAMPP

The tests use a **separate test database** (`sas_leave_test` by default) that is
created automatically. They never touch the real application database
(`daima12_sincro`), so it is safe to run them on your machine.

The connection details come from `db_config.php` / the `SAS_DB_*` environment
variables. XAMPP's defaults (host `localhost`, user `root`, empty password)
work out of the box:

```bash
# from the project root (xampp/htdocs/sas)
php tests/lint.php
php tests/run.php
```

If your MySQL credentials differ, export them first:

```bash
SAS_DB_HOST=localhost SAS_DB_USER=root SAS_DB_PASS= SAS_DB_NAME=daima12_sincro \
  php tests/run.php
```

Use `SAS_TEST_DB_NAME` to choose a different test database name:

```bash
SAS_TEST_DB_NAME=sas_leave_test php tests/run.php
```

## In CI

`.github/workflows/ci.yml` runs both `php tests/lint.php` and
`php tests/run.php` against a MySQL service container on every push and PR.
