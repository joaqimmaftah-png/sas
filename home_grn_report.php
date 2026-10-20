<?php
require_once __DIR__ . '/mysql_compat.php';

ob_start();
@session_start();
if(!isset($_SESSION['usertype']))
{
header("location:index.php");	
}
include 'authorized/db.php';
$emp_file_no = $_SESSION["emp_file_no"];
?>
<!DOCTYPE html>
<html>
    <head>
  <!--        <script src="js/metro/metro-treeview.js"></script>--> 
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <!--<link href="css/iconFont.css" rel="stylesheet">-->
        <link href="css/docs.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
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
         function search_site(url) {
            $('#show_rca').fadeOut(1000, function () {
                $('#show_rca').load(url);
                $('#show_rca').fadeIn(1000, function () {
                });
            });
        }
  </script>
    <script type="text/javascript">
            $(document).ready(function () {
                $('.maisha').delay(5000).fadeOut('normal');
                $('.success').delay(4000).fadeOut('normal');
            });
        </script>
        <script type="text/javascript">
$(document).on("click", ".edit_request", function() {
  var id = $(this).data('id');
  var a= $(this).data('a');
  var b= $(this).data('b');
  var c= $(this).data('c');
  var d= $(this).data('d');
  var e= $(this).data('e');
  var f= $(this).data('f');
  var g= $(this).data('g');
   
    
    $(".modal-body #id").val(id);
    $(".modal-body #a").val(a);
    $(".modal-body #b").val(b);
    $(".modal-body #c").val(c);
    $(".modal-body #d").val(d);
    $(".modal-body #e").val(e);
    $(".modal-body #f").val(f);
    $(".modal-body #g").val(g);
});
</script>
<script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
                $('.success').delay(4000).fadeOut('normal');
            });
        </script>
  
        

      

    <title>HRMIS | Sincro Automation System</title>
        <!----------------------------------------------jquery wiqdet------------------------------------>
        <link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
    
    <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.sort.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.filter.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.columnsresize.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxpanel.js"></script>
   <script type="text/javascript" src="scripts/demos.js"></script>
   <!--////////////////////////////////////////EXPORT///////////////////////////////////////-->
       <script type="text/javascript" src="jqwidgets/jqxdata.export.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxgrid.export.js"></script>   
    <!--/////////////////////////////END EXPORT////////////////////////////////////-->
        <script type="text/javascript" src="jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxbargauge.js"></script>
      <script type="text/javascript" src="jqwidgets/jqxchart.core.js"></script>
    <!--////////////////////////////////////////////////////////////////////////////-->

    
</head>
 <body class="metro" style="">
        <div class="navigation-bar shadow">
            <div class="navigation-bar-content">
                <a href="" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>PLO V1.0</sup></a>
                <span class="element-divider"></span>

                <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="">Home</a>                             
                        </li>                      
                       
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
    <div class="container-fluid" style="margin-top:1%;margin-bottom: 1%">            
                    <?php
                        if (isset($_GET['action'])) {
                            include_once 'sincro.php';
                        } 
                         else {
                            include_once 'authorized/GRN_report/goods_received_order_report.php';
                        }
                    ?>                      
               
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
<script src="js/jquery.bootpag.js"></script> 
        <script src="js/jquery.bootpag.min.js"></script> 
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script>
   jQuery(function($){
   $("#date1").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
$("#date2").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
$("#date3").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
$("#date4").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
});
</script>


</body>
</html>