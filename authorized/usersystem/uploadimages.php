<?php
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
    include_once '../db.php';
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "../HR/user_images/".$_FILES['userImage']['name'];
$name=$_FILES['userImage']['name'];
$employee_no=$_GET['employee_no'];
$paths="authorized/HR/user_images/".$_FILES['userImage']['name'];

if(move_uploaded_file($sourcePath,$targetPath)) {
    $update=  mysql_query("UPDATE tbl_employee SET profile_pic='$paths' WHERE emp_file_no='$employee_no'") or die(mysql_error());
?>
<img src="authorized/HR/<?php echo $targetPath; ?>" width="200px" height="200px" />
<?php
}
}
}
?>