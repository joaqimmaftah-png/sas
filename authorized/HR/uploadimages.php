<?php
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
    include_once '../model/db.php';
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "user_images/".$_FILES['userImage']['name'];
$name=$_FILES['userImage']['name'];
$employee_no=$_GET['employee_no'];
$paths="view/user_images/".$_FILES['userImage']['name'];

if(move_uploaded_file($sourcePath,$targetPath)) {
    $update=  mysql_query("UPDATE tbl_employee SET profile_pic='$paths' WHERE emp_file_no='$employee_no'") or die(mysql_error());

    ?>
<img src="view/<?php echo $targetPath; ?>" width="200px" height="200px" />
<?php
}
}
}
?>