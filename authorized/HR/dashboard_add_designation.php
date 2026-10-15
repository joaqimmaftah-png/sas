<?php
include_once '../model/db.php';
$designation=$_POST['designation'];
$b=mysql_query("INSERT INTO tbl_title(title_name) VALUE('$designation')") or die(mysql_error());
if($b){
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>'.$designation.' Title has Successfully Added</strong>
</div>';
}

?>