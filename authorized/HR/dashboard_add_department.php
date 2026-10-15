<?php
include_once '../model/db.php';
$deparment=$_POST['department'];
if(!empty($deparment)){
$b=mysql_query("INSERT INTO tbl_department(department_name) VALUE('$deparment')") or die(mysql_error());
if($b){
    echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>'.$deparment.' Department has Successfully Added</strong>
</div>';
}
}if(empty($deparment)){
    $selecting='0';
    $selecting=$_POST['selecting'];
    $y= mysql_query("SELECT * FROM tbl_department WHERE department_id='$selecting'") or die(mysql_error());
    $a=mysql_fetch_array($y);
    $department=$a['department_name'];
      echo '<div class="alert alert-success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>'.$deparment.' Department has Successfully Deleted</strong>
</div>';
    $u=  mysql_query("DELETE FROM tbl_department WHERE department_id='$selecting'") or die(mysql_error());
      
}



?>