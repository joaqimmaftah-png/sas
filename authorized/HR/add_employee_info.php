<?php
require_once __DIR__ . '/../../mysql_compat.php';

    include_once __DIR__ . '/../db.php';
    $employ_id = $_POST['employ_id'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $bdate = $_POST['bdate'];
    $gender = $_POST['gender'];
    $marital = $_POST['marital'];
    $religion = $_POST['religion'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $status='Inactive';
    $profile_pic = "images/person.png";
    $ss=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employ_id'") or die(mysql_error());
    $row= mysql_num_rows($ss);
    if($row==0){
        $insertq = "INSERT INTO tbl_employee(emp_file_no,first_name,middle_name,surname,date_of_birth,gender,marital_status,religion,country,city,district,profile_pic)"
            . " VALUES('$employ_id','$fname','$mname','$lname','$bdate','$gender','$marital','$religion','$country','$city','$district','$profile_pic')";
    mysql_query($insertq) or die(mysql_error());
    $register_user=  mysql_query("INSERT INTO tbl_user_accounts(`emp_file_no`,`status`)VALUES('$employ_id','$status')") or die(mysql_error());
    if($insertq){
           echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully!</strong>
</div>'; 
    }
    }  else {
      echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>User With Employee Id <span class="fg-red">'.$employ_id.'</span>  Alredy Exist!</strong>
</div>';   
}
    







?>
