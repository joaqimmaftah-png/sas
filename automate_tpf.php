
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="sincrositewatch.com">
        <meta name="description" content="Vehicle Fuel Management System">
        <meta name="author" content="Joaqim maftah, IT sincrositewatch Ltd">
        <meta name="keywords" content="SAS,fuel Management System">
        <script type="text/javascript" src="jxquery/jquery.min1.js"></script> 

        <script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
                $('.success').delay(5000).fadeOut('normal');
            });
        </script>
        
       
 <link href="js/bootstrap.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script> 
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
        <link href="css/iconFont.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">
        <link href="js/prettify/prettify.css" rel="stylesheet">
        <link href="js/bootstrap.min.css" rel="stylesheet">  

        



        <script>
            $(document).ready(function () {
                $('#example').dataTable();
            });
            $(document).ready(function () {
                $('#example3').dataTable({
                    "scrollY": "200px",
                    "scrollCollapse": true,
                    "paging": false
                });
            });

        </script>
       
        <title>TPF | SAS</title>
        <style>
        </style>
    </head>

    <body class="metro" style="background-color: #efeae3;">
<div class="navigation-bar shadow">
<div class="navigation-bar-content">
     <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>TPF and QTN V1.0</sup></a>
                    <span class="element-divider"></span>

                    <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="?action=vehicle_fuel_list">Home</a>                             
                        </li>
                    
                         <span class="element-divider"></span>
                    </ul>

                    <div class="no-tablet-portrait">
                       
                        <div class="element place-right">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-switch"></span>
                            </a> 
                             <ul style="display: none;" class="dropdown-menu place-right" data-role="dropdown">
                                <li><a href="logout.php">sign out</a></li>
                                 <li><a href="logout.php">Change Password</a></li>
                                                            
                            </ul>
                        </div>
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            
                            <img src="images/mann1.png">
                        </button>
                    </div>
                </div>
</div>
        <div class=" container-fluid ">
            <div class=" grid fluid">
                <div class="row" style="margin-left:8px; margin-right: 6px;" >
                     <?php
require_once __DIR__ . '/mysql_compat.php';

                        if (isset($_GET['action'])) {
                            include_once 'sincro.php';
                        } 
//                        else{
//                            include_once 'authorized/tpf_process/home.php';
//                        }
                            ?>  
                </div>
            </div>
        </div>
<footer class="footer navbar-fixed-bottom  bg-green" style="">
<div class="container" >
<div class="row">
<div class="grid">
    <div class="span12" style="">
<p>Copyright © 2015 Sincrositewatch LTD</p>
</div>
</div>
</div>
</div>
</footer>

 <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="jxquery/jquery.min1.js"></script> 
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
        <script src="chart.js"></script>
        <script src="chart.min.js"></script>
        <script src="canvasjs.min.js"></script>

</body>
</html>