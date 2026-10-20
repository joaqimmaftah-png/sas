<?php
/**
 * Central database settings for the "sas" app.
 * Edit ONLY this file when the database host, user, password or name change.
 * Defaults are the hosting database credentials (sql301.yzz.me).
 * Real environment variables (SAS_DB_HOST, SAS_DB_USER, SAS_DB_PASS, SAS_DB_NAME) override them.
 */
$mysql_hostname = getenv('SAS_DB_HOST') !== false ? getenv('SAS_DB_HOST') : 'sql301.yzz.me';
$mysql_user     = getenv('SAS_DB_USER') !== false ? getenv('SAS_DB_USER') : 'yzzme_42295087';
$mysql_password = getenv('SAS_DB_PASS') !== false ? getenv('SAS_DB_PASS') : 'YAS2sWjtziIG';
$mysql_database = getenv('SAS_DB_NAME') !== false ? getenv('SAS_DB_NAME') : 'yzzme_42295087_sas';
