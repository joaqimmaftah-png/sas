<?php


include_once '../model/db.php';
$category=$_POST['category'];
$b=mysql_query("INSERT INTO tbl_leave_type(leave_type) VALUE('$category')") or die(mysql_error());
if($b){
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>'.$category.' Category has Successfully Added</strong>
</div>';
}

?>