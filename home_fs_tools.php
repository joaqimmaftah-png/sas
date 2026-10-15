<?php  
session_start();
include 'authorized/db.php'; 
$emp_file_no=$_SESSION["emp_file_no"];
$access_lever=$_SESSION["access_lever"];
$jina=mysql_query("SELECT * from tbl_user_accounts where emp_file_no='$emp_file_no'") or die(mysql_error());
$show=  mysql_fetch_array($jina);
$name=$show['hints'];
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
        <script src="js/github.info.js"></script>
            <!-- Local JavaScript -->
        <script src="js/docs.js"></script>
        <script src="js/github.info.js"></script>
        <link href="datable/jquery.dataTables.css" rel="stylesheet">
        <script src="datable/jquery.dataTables.js"></script>
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

    <script>
        function getPage(url) {
            $('#showpage').fadeOut(1000, function () {
                $('#showpage').load(url);
                $('#showpage').fadeIn(1000, function () {
                });
            });
            $(".error").click(function () {
                $(this).hide().fadeIn(2000);
            });

        }
    </script>
    <!----------------------------------------------jquery wiqdet------------------------------------>
    <link rel="stylesheet" href="jxquery/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="jxquery/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="jxquery/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxgrid.sort.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxgrid.filter.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxgrid.columnsresize.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="jxquery/jqwidgets/jqxpanel.js"></script>
        <script type="text/javascript" src="jxquery/jqwidgets/jqxdata.export.js"></script> 
    <script type="text/javascript" src="jxquery/jqwidgets/jqxgrid.export.js"></script>
     <script type="text/javascript" src="jqwidgets/jqxdatatable.js"></script>
    <title>Home | Sincro automations</title>

    <style>
    </style>
</head>
<body class="metro" style="background-color: #ffffff;">
   <div class="">
       <nav class="navigation-bar">
                <div class="navigation-bar-content">
                    <a href="#" class="element"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>V 1.0</sup></a>
                    <span class="element-divider"></span>
                                        <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="?action=depo_stock">Home</a>                             
                        </li>
                        <span class="element-divider"></span>
                         <li>
                            <a class="" style="font-weight: bold;" href="?action=spare_management">Stock Management</a>                                                 
                        </li> 

                         <span class="element-divider"></span>
                         <li >
                             <a class="" style="font-weight: bold;" href="?action=depo_site">Our Sites</a>                                               
                        </li> 
                         <span class="element-divider"></span>
                         <li>
                            <a class="" href="#" style="font-weight: bold;">Generate Report</a>                                                 
                        </li>                         
                         <span class="element-divider"></span>
                    </ul>
                    <div class="no-tablet-portrait">
                        <span class="element-divider"></span>
                        <div class="element place-right">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-switch"></span>
                            </a>
                            <ul class="dropdown-menu place-right" data-role="dropdown">
                                <li><a href="logout.php">Sign out</a></li>
                                <li><a href="logout.php">Change Password</a></li>
                            </ul>
                        </div>
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            <?php echo $name;?>
                            <img src="images/jo.png">
                        </button>
                    </div>
                </div>
            </nav>
 
   </div>
    <div class="">
        <div class="grid">
            <div class="row" style="margin:0px 2px 0px 2px;">
               
                    <?php
                    if(isset($_GET['action'])){
                        include_once 'sincro.php';
                    }  else {
                        echo '';
}
                    ?>
                
            </div>
        </div>
    </div>

    <footer>
        <center>
            <div class="bottom-menu-wrapper bg-green">
                <ul class="horizontal-menu compact">
                    <li>&copy;<a href=""> 2015 sincrositewatch limited</a></li> 

                </ul>
            </div>
        </center>
    </footer>
    <script src="js/hitua.js"></script>
    <script src="js/hitua.js"></script>
<link href="js/bootstrap.min.css" rel="stylesheet">  
 <script src="js/bootstrap.min.js"></script>


</body>
</html>

