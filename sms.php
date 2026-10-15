    <?php
session_start();
include 'authorized/db.php';
$message="";
if(isset($_POST['login'])) {
    include 'authorized/db.php';
$emp_file_no=$_POST['emp_file_no'];
$password1=$_POST['password'];
$password=  md5($password1);

$result = mysql_query("SELECT * FROM tbl_user_accounts WHERE emp_file_no='$emp_file_no' and password='$password'");
$row  = mysql_num_rows($result);
$show=  mysql_fetch_array($result);
$emp_file_no=$show['emp_file_no'];
$usertype=$show['usertype'];
$access_lever=$show['access_lever'];
if($row=1) {
$_SESSION['emp_file_no']= $emp_file_no;
 $_SESSION['access_lever']=$access_lever;
 $_SESSION['usertype']=$usertype;
if($usertype=='HR' and $emp_file_no==$_SESSION['emp_file_no']){ 
        header("Location:home_hrms.php");       
}
if($usertype=='fs' and $emp_file_no==$show['emp_file_no']){ 
        header("Location:home_fs_tools.php?action=depo_stock");       
}
if($usertype=='stores' and $emp_file_no==$show['emp_file_no']){ 
        header("Location:home_store.php");       
}
if($usertype=='accounts' and $emp_file_no==$show['emp_file_no']){ 
        header("Location:home_accounts.php");       
}
if($usertype=='fleet_manager' and $emp_file_no==$show['emp_file_no']){ 
        header("Location:Fleet_management.php?action=home");       
}
if($usertype=='staff' and $emp_file_no==$_SESSION['emp_file_no']){ 
        header("Location:user_accounts.php");       
}
if($usertype=='vehicle_fuel_management' and $emp_file_no==$show['emp_file_no']){ 
        header("Location:vehicle_fuel_management.php");       
}
else {
 $message = '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">Ã—</a>
    <strong>Either Username or Password Error!</strong> 
</div>';
}

} 
}

?>

<?php include 'authorized/db.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="Metro UI CSS Framework">
        <meta name="description" content="Simple responsive css framework">
        <meta name="author" content="Sergey S. Pimenov, Ukraine, Kiev">
        <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui">
        <script type="text/javascript" src="jxquery/jquery.min1.js"></script>
        <script type="text/javascript">
            $("#btnPrint").live("click", function () {
                var divContents = $("#dvContainer").html();
                var printWindow = window.open('', '', 'height=400,width=800');
                printWindow.document.write('<html><head><title>DIV Contents</title>');
                printWindow.document.write('</head><body >');
                printWindow.document.write(divContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
                $('.success').delay(4000).fadeOut('normal');
            });
        </script>
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
        <link href="css/iconFont.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">
        <link href="js/prettify/prettify.css" rel="stylesheet">
        <!-- Load JavaScript Libraries -->
        <script src="js/jquery/jquery.min.js"></script>                    
        <script src="js/jquery/jquery.widget.min.js"></script>
        <script src="js/jquery/jquery.mousewheel.js"></script>
        <script src="js/metro/metro-input-control.js"></script>
        <script src="js/prettify/prettify.js"></script>       
        <!-- Metro UI CSS JavaScript plugins -->
        <script src="js/load-metro.js"></script>

        <!-- Local JavaScript -->
        <script src="js/docs.js"></script>
        <script src="js/github.info.js"></script>
        <link href="datable/jquery.dataTables.css" rel="stylesheet">
        <script src="datable/jquery.dataTables.js"></script>
        <title>Sincro Automation System</title>

        <style>
        </style>
    </head>
    <body class="metro" style="background: url(images/backgroundy.png) fixed">
        
        <div class="margin5" style="margin-top: 15%; margin-left: 2%;">
            <div class="grid">
                <div class="row">
                    <div class="span5">
                        
                    </div>
                    <div class="span6">
                            <div class="window shadow">
    <div class="caption">
    <span class="icon icon-user"></span> 
    <div class="title">User Login</div> 
    <button class="btn-max"></button> 
    <button class="btn-close"></button> 
    </div>
    <div class="content">
        <div class="margin20">
<!--            <img src="" class="polaroid shadow" style="width:100%; height: 100px;">-->
              <?php if($message!="") { echo $message; } ?>
        <form action="" method='post'>
 <label>UserName</label>
<div class="input-control text info-state" data-role="input-control">
    
    <input value="" placeholder="Username:" name="emp_file_no" type="text">
</div>
 <label>Password</label>
<div class="input-control password info-state" data-role="input-control">
    
<input type="password" placeholder="Password" name="password">
</div> 
<div class="form-actions">
<button class="button primary" name='login'>Login</button> 
<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> 
</div>
</form>
            </div>
    </div>
    </div>
                    </div>
            </div>
        </div>
            </div>

    </body>
    <script src="js/hitua.js"></script>
<link href="js/bootstrap.min.css" rel="stylesheet">  
 <script src="js/bootstrap.min.js"></script>
</html>