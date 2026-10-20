<?php
require_once __DIR__ . '/mysql_compat.php';

session_start();
if (!isset($_SESSION['usertype'])) {
    header("location:index.php");
}  else {

?>
<!DOCTYPE html>
<html>
    <head>

<!--        <script src="js/metro/metro-treeview.js"></script>-->
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/iconFont.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">
    <script src="js/script1.js"></script>

        <script src="js/script1.js"></script>

 <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="print">
    <link href="assets/datatables/css/dataTables.bootstrap.css" rel="stylesheet" media="print">
    <link href="assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
 <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" media="print">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    
     <script src="Chart.js"></script>
        <script src="js/jquery/jquery.min.js"></script>                    
        <script src="js/jquery/jquery.widget.min.js"></script>
        <script src="js/jquery/jquery.mousewheel.js"></script>
        <script src="js/load-metro.js"></script>
        <link href="datable/jquery.dataTables.css" rel="stylesheet">
        <script src="datable/jquery.dataTables.js"></script>     
        <link href="js/bootstrap.min.css" rel="stylesheet">  
 <script src="js/bootstrap.min.js"></script>
  <script>
          function approved(url) {
            $('#call_approving').fadeOut(50, function () {
                $('#call_approving').load(url);
                $('#call_approving').fadeIn(50, function () {
                });
            });
        }
           function rejection(url) {
            $('#call_rejection').fadeOut(50, function () {
                $('#call_rejection').load(url);
                $('#call_rejection').fadeIn(50, function () {
                });
            });
        }
 </script>

<script>
        $(document).ready(function() {
    $('#home').DataTable();
    $('#table3').DataTable();
     $('#leave').DataTable();
} );
        </script>
    <script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
//                $('.success').delay(4000).fadeOut('normal');
            });
        </script>
    <style type="text/css">

@media print
{    
    .noprint, .bottom-menu-wrapper,.menusss *
    {
        display: none !important;
    }
}


</style>
<script>
         function edit_issuez(url) {
            $('#letehapa').fadeOut(100, function () {
                $('#letehapa').load(url);
                $('#letehapa').fadeIn(100, function () {
                });
            });
        }
        </script>

    </head>

    <body class="metro" >
 <div class="navigation-bar">
<div class="navigation-bar-content">
     <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>LMS V 1.0</sup></a>
                    <span class="element-divider"></span>

                    <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="?action=home_opm">Home</a>                             
                        </li>
                            <span class="element-divider"></span>
<!--                         <li>
                            <a class="" href="?action=finding" style="font-weight: bold;">Action (s)</a>                                                 
                        </li>
                        <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=view_report" style="font-weight: bold;">Reports</a>                                                 
                        </li>-->
                       
                    </ul>

                    <div class="no-tablet-portrait">
                       
                        <div class="element place-right">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-cog"></span>
                            </a> 
                             <ul style="display: none;" class="dropdown-menu place-right" data-role="dropdown">
                                <li><a href="logout.php">sign out</a></li>
                                                            
                            </ul>
                        </div>
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            <?php ?>
                            <img src="images/mann1.png">
                        </button>
                    </div>
                </div>
</div>
        <div class="bootstrap-iso">
        <div class="container-fluid">
            <div class="row">
                

                  <?php
                        if (isset($_GET['action'])) {
                            include_once 'sincro.php';
                        } 
                        else {
                            include_once 'authorized/leave/home.php';
                        }
                            ?> 

              
            </div>
        </div>
        </div>
        <footer class="">
            <center>
                <div class="bottom-menu-wrapper bg-green">
                    <ul class="horizontal-menu compact">
                        <li>&copy;<a href=""> 2015 sincrositewatch limited</a></li> 

                    </ul>
                </div>
            </center>
        </footer>

 <script src="js/jquery.bootpag.js"></script> 
        <script src="js/jquery.bootpag.min.js"></script> 
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script>
    jQuery(function($){
   $("#date1").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
$("#date2").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
$("#date3").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
$("#date4").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
});
</script>

    </body>
</html>
<?php
}
?>