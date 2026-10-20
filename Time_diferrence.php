
<?php
require_once __DIR__ . '/mysql_compat.php';

$checkTime = strtotime('08:00');
$loginTime = strtotime('09:01');
$diff = $loginTime-$checkTime;
$result['s'] = $diff;
echo gmdate("H:i", (int)$result['s']);

?>
