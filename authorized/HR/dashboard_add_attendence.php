<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once __DIR__ . '/../db.php';
$timein=$_POST['timein'];
$timeout=$_POST['timeout'];
$timeid=$_POST['timeid'];
$b=mysql_query("UPDATE  tbl_timeattendence SET time_in='$timein',time_out='$timeout' WHERE time_id='$timeid' ") or die(mysql_error());
if($b){
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Time Successfull Configured</strong>
</div>';
}

?>