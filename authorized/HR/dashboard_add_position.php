<?php
include_once '../model/db.php';
$position=$_POST['position'];
$b=mysql_query("INSERT INTO tbl_position(position_name) VALUE('$position')") or die(mysql_error());
if($b){
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>'.$position.' Position has Successfully Added</strong>
</div>';
}

?>
