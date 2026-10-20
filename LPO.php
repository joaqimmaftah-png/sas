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

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="Metro UI CSS Framework">
        <meta name="description" content="Simple responsive css framework">
        <meta name="author" content="Sergey S. Pimenov, Ukraine, Kiev">
        <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui ">

        <script type="text/javascript" src="jxquery/jquery.min1.js"></script> 


        <script src="js/jquery.min.js"></script>         
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
<!--       <link href="css/iconFont.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">-->
        <!-- Load JavaScript Libraries -->
        <script src="js/jquery/jquery.min.js"></script>                    
        <script src="js/jquery/jquery.widget.min.js"></script>
        <script src="js/jquery/jquery.mousewheel.js"></script>
        <script src="js/metro/metro-input-control.js"></script>
        <script src="js/prettify/prettify.js"></script>       

 <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/datatables/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="authorized/usersystem/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
         <script type="text/javascript" src="authorized/usersystem/bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="authorized/usersystem/bootstrap/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

        <title>Local Purchase Order</title>

        <script>
        $(document).ready(function() {
        $('#table').DataTable();
        } );
        </script>
        <script>
   $(document).on("click", ".view-admin", function () {
                 var a = $(this).data('a');
                 var b = $(this).data('b');
                 var c = $(this).data('c');
                 var d = $(this).data('d');
                 var e = $(this).data('e');
                 var f = $(this).data('f');
                 var g = $(this).data('g');
                 var h = $(this).data('h');
                 var i = $(this).data('i');
                 var j = $(this).data('j');
                 var k = $(this).data('k');
                 var l = $(this).data('l');
                 var m = $(this).data('m');
                 var n = $(this).data('n');
                 
                 $(".modal-body #a").val(a);
                 $(".modal-body #b").val(b);
                 $(".modal-body #c").val(c);
                 $(".modal-body #d").val(d);
                 $(".modal-body #e").val(e);
                 $(".modal-body #f").val(f);
                 $(".modal-body #g").val(g);
                 $(".modal-body #h").val(h);
                 $(".modal-body #i").val(i);
                 $(".modal-body #j").val(j);
                 $(".modal-body #k").val(k);
                 $(".modal-body #l").val(l);
                 $(".modal-body #m").val(m);
                 $(".modal-body #n").val(n);
                 $(".modal-body .x").text(h);
                 
            });
        </script>
        

    </head>

    <body class="metro" style="background-color: #efeae3;">
        <div class="navigation-bar">
            <div class="navigation-bar-content">
                <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>LPO V1.0</sup></a>
                <span class="element-divider"></span>

                <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="?action=lpo_report">Home</a>                             
                        </li>                      
                        <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=lpo_supplier" style="font-weight: bold;">Supplier</a>                                                 
                        </li>
                         <span class="element-divider"></span>
                        <li>
                             <a class="" href="home_purchase_report.php" target="_blank" style="font-weight: bold;">Reports</a>                                                 
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
        <div class="container-fluid">
            <br>
                

                  <?php
                        if (isset($_GET['action'])) {
                            include_once 'sincro.php';
                        } 
                        else {
                            include_once 'authorized/LPO/home.php';
                        }
                    ?> 

              
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


<script src="assets/jquery/jquery-2.1.4.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables/js/dataTables.bootstrap.js"></script>


    <script type="text/javascript" src="authorized/usersystem/bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="authorized/usersystem/bootstrap/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
            $('.form_datetime').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });
            $('.form_date').datetimepicker({
                language: '',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
            $('.form_time').datetimepicker({
                language: 'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                minView: 0,
                maxView: 1,
                forceParse: 0
            });
</script>



    </body>
</html>
<?php
}
?>