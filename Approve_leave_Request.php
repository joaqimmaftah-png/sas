<?php
require_once __DIR__ . '/mysql_compat.php';

$message='';
$request_id=$_GET['request_id'];
if(isset($_GET['leave_id'])){
    $message='<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful Approved!..</strong> 
</div>';
    include 'authorized/db.php';
    $leave_id=$_GET['leave_id'];
    $status="Approved";
    $update=mysql_query("UPDATE tbl_leaves SET hod_status='$status' WHERE leave_id='$leave_id'") or die(mysql_error());
    $to = "joaqimmaftah@yahoo.com";
$subject = "";
$txt = "";
$headers = "From: joaqimmaftah@yahoo.com" . "\r\n" .
"CC: joaqimmaftah@yahoo.com";
mail($to,$subject,$txt,$headers);
if($update){
 $to = "joaqimmaftah@yahoo.com";
$subject = "";
$txt = "";
$headers = "From: joaqimmaftah@yahoo.com" . "\r\n" .
"CC: joaqimmaftah@yahoo.com";
mail($to,$subject,$txt,$headers);
}
    
}
else{
    
}
?>



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
        <script src="js/script1.js"></script>
        <script src="js/github.info.js"></script>
        <link href="datable/jquery.dataTables.css" rel="stylesheet">
        <script src="datable/jquery.dataTables.js"></script>

    <title>HRMIS | Sincro Automation System</title>

    <style>
    </style>
</head>
 <body class="metro" style="background-color: #efeae3;">
<div class="navigation-bar shadow" >
<div class="navigation-bar-content">
     <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>VERSION 2.0</sup></a>
                    <span class="element-divider"></span>

<!--                    <a class="pull-menu" href="#"></a>
                    <div class="no-tablet-portrait">
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            <?php
//                            echo "joaqim maftah";
                            ?>
                            <img src="images/mann1.png">
                        </button>
                    </div>-->
                </div>
</div>
<!--/////////////////////////////////////////////////-->
        <div class="container">
            <div class="grid">
                <div class="success" >
                    <?php
                    echo $message;
                    ?>
                    
                </div>
                <div class="row" style="margin-top:10%;">
                    
                </div>
                <div class="row padding20">
                    <div class="span3"></div>
                    <div class="span4">
                        
                        <a href="?leave_id=<?php echo $request_id;?>&request_id=<?php echo $request_id;?>">
                            <button class="command-button primary shadow">
        <i class="icon-share-2 on-left"></i>
        Yes, I agree
        <small>Click this option to Agree</small>
    </button>
                            </a>
                        </div>
                    <div class="span4">
     <a href="#"  data-toggle="modal" data-target="#declined">
    <button class="command-button inverse shadow">
        <i class="icon-share-3 on-right"></i>
        No, I refused
        <small>Use This Option to Comment</small>
    </button>
         </a>
                    </div>
                    <div class="span2"></div>
                </div>
            </div>
        </div>

 <!-- Modal -->
<div id="declined" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Comments</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <form  id="upload_password" action="change_password.php" method="post">
                            <div class="form-group">
  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" id="comment"></textarea>
</div>                                                   
                            <div class="form-group" id="messages">                              
                               
                            </div> 
                            <button type="submit" class="btn btn-default" name="change">Post</button>
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!----------------------------------model tax------------------------------------------------>



<div class="navigation-bar shadow fixed-bottom bg-green" >
<div class="navigation-bar-content">
 <ul class="horizontal-menu compact">
                <li><a href=""></a></li> 

            </ul>
                </div>
</div>
<link href="js/bootstrap.min.css" rel="stylesheet">  
 <script src="js/bootstrap.min.js"></script>
</body>
</html>
