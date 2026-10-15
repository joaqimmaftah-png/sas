<?php

include_once '../model/db.php';
$attachment=$_POST['attachment'];
$b=mysql_query("INSERT INTO tbl_attachment_kind(category_name) VALUE('$attachment')") or die(mysql_error());
if($b){
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>'.$attachment.' Attachment has Successfully Added</strong>
</div>';
}

?>




