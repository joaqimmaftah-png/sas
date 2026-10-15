<?php

include_once '../model/db.php';
$benefit=$_POST['benefit'];
$b=mysql_query("INSERT INTO tbl_benefits_category(benefit_name) VALUE('$benefit')") or die(mysql_error());
if($b){
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>'.$benefit.' Category has Successfully Added</strong>
</div>';
}

?>