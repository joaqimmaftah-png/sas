<?php
include_once '../model/db.php';
$days=$_POST['days'];
$days_id=$_POST['days_id'];
$b=mysql_query("UPDATE tbl_leave_days SET no_days='$days' WHERE days_id='$days_id'") or die(mysql_error());
if($b){
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>'.$days.' Days Successfully Updated!</strong>
</div>';
}

?>

