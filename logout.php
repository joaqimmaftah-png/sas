<?php
session_start();
unset($_SESSION["emp_file_no"]);
//unset($_SESSION["user_name"]);
session_destroy();
header("Location:index.php");
?>