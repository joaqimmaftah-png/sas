<?php
$message='';
if(isset($_POST['submit'])){
    include 'authorized/db.php';
  require_once 'telerivett/telerivet.php';   
     $group=$_POST['group'];
     $sms=$_POST['sms'];
                    $d = mysql_query("SELECT * FROM tbl_sms WHERE group_sms='$group' ORDER BY id LIMIT 0,48") or die(mysql_error());
                    while ($row = mysql_fetch_array($d)) {
                        $number=$row['number'];
                        
                                            ////////////////send sms////////////
                    
$YOUR_API_KEY = 'byfT5zVOvpwg7I1qR0NJ25FUC2YMyMTZ';
$project_id = 'PJ322166ecc753a9ba';
$tr = new Telerivet_API($YOUR_API_KEY);
$project = $tr->initProjectById($project_id);

$sent_msg = $project->sendMessage(array(
    'content' => $sms, 
    'to_number' => $number
));
                    ////////////////sendsms/////////////
                    }

    
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
                </div>
</div>
<!--/////////////////////////////////////////////////-->
<div class="container" style=" margin-top: 7%;">
    <form role="form" method="POST" action="">
 <div class="form-group">
  <label for="sel1">Select Group:</label>
  <select class="form-control" name="group">
      <option value="sincro">sincro</option>
    <option value="jaribu">jaribu</option>


  </select>
</div>
   <div class="form-group">
  <label for="comment">Message:</label>
  <textarea class="form-control" rows="5" name="sms"></textarea>
</div>

  <input type="submit" name="submit" value="Send Message" class="btn btn-default">
</form>
        </div>





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
