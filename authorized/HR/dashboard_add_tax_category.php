<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once __DIR__ . '/../db.php';
$tax=$_POST['tax'];
$b=mysql_query("INSERT INTO tbl_tax_category(taxt_type) VALUE('$tax')") or die(mysql_error());
if($b){
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>'.$tax.' Category has Successfully Added</strong>
</div>';
}

?>


