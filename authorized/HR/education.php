<?php
require_once __DIR__ . '/../../mysql_compat.php';

    include_once __DIR__ . '/../db.php';
    $employee_no=$_POST['employee_no'];
    $education=$_POST['education'];
    $fnish=$_POST['fnish'];
    $collg=$_POST['collg'];
    $start=$_POST['start'];
    $fieldofstudy=$_POST['fieldofstudy'];
      $Q=  mysql_query("INSERT INTO `tbl_education`(`employe_no`, `start_date`, `finish_date`, `education`, `school_university_college`,field_of_study) "
              . "VALUES ('$employee_no','$start','$fnish','$education','$collg','$fieldofstudy')") or die(mysql_error());
      echo '<div class="alert alert-success success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull!</strong>
</div>';

?>