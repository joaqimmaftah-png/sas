<?php
session_start();
if (!isset($_SESSION['usertype'])) {
    header("location:index.php");
}
include 'authorized/db.php';

$message = "";

?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="utf-8">
         <!--        <script src="js/metro/metro-treeview.js"></script>-->
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <!--<link href="css/iconFont.css" rel="stylesheet">-->
        <link href="css/docs.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">


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

         <script>
        $(document).ready(function() {
    $('#table').DataTable();
    $('#table1').DataTable();
} );
        </script>
         
        <script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
                $('.success').delay(5000).fadeOut('normal');
            });
        </script>
        <script>
            $(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});
</script>

 <script>
                function load_record_page(url) {
                    $('#load_page').fadeOut(1000, function () {
                        $('#load_page').load(url);
                        $('#load_page').fadeIn(1000, function () {
                        });
                    });
                }
        </script>


         <script>
   $(document).on("click", ".view-info", function () {
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
                 var o = $(this).data('o');
                 var p = $(this).data('p');
                 var q = $(this).data('q');
//                 var r = $(this).data('r');
//                 var s = $(this).data('s');
//                 var t = $(this).data('t');
//                 var u = $(this).data('u');
//                 var v = $(this).data('v');
//                 var w = $(this).data('w');
//                 var x = $(this).data('x');
//                 var y = $(this).data('y');
//                 var z = $(this).data('z');
//                 var aa = $(this).data('aa');
//                 var ab = $(this).data('ab');
//                 var ac = $(this).data('ac');
//                 var ad = $(this).data('ad');
//                 var ae = $(this).data('ae');
//                 var af = $(this).data('af');
//                 var ag = $(this).data('ag');
                 
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
                 $(".modal-body #o").val(o);
                 $(".modal-body #p").val(p);
                 $(".modal-body #q").val(q);
//                  $(".modal-body #r").val(r);
//                  $(".modal-body #s").val(s);
//                  $(".modal-body #t").val(t);
//                  $(".modal-body #u").val(u);
//                  $(".modal-body #v").val(v);
//                  $(".modal-body #w").val(w);
//                  $(".modal-body #x").val(x);
//                  $(".modal-body #y").val(y);
//                  $(".modal-body #z").val(z);
//                  $(".modal-body #aa").val(aa);
//                  $(".modal-body #ab").val(ab);
//                  $(".modal-body #ac").val(ac);
//                  $(".modal-body #ad").val(ad);
//                  $(".modal-body #ae").val(ae);
//                  $(".modal-body #af").val(af);
//                  $(".modal-body #ag").val(ag);
//                  $(".modal-body #sn").text(af);
            });
        </script>
        <script>
                function getPage(url) {
                    $('#request_form').fadeOut(1000, function () {
                        $('#request_form').load(url);
                        $('#request_form').fadeIn(1000, function () {
                        });
                    });
                }
                 function maintenance(url) {
                    $('#load_issue').fadeOut(1000, function () {
                        $('#load_issue').load(url);
                        $('#load_issue').fadeIn(1000, function () {
                        });
                    });
                }
        </script>
        <script type="text/javascript">
    $(document).ready(function (e) {
        $("#update_vehicle").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({url: "authorized/car_track/add_driver.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#kubwa").html(data);
                },
                error: function () {
                }
            });
        }));
    });
</script>


        <title>Spare Parts Management | SAS</title>

    </head>

    <body class="metro">
<div class="navigation-bar shadow">
<div class="navigation-bar-content">
    <a href="index.php" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>Fleet V 1.0</sup></a>
                    <span class="element-divider"></span>

                    <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="?action=home">Home</a>                             
                        </li>
                                                 <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=cars_issues" style="font-weight: bold;">Vehicle Faults</a>                                                 
                        </li>                       
                          <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=vehicle schedule services" style="font-weight: bold;">Vehicle Schedule Services</a>                                                 
                        </li>
                         <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=vehicle Insurance and Road Services" style="font-weight: bold;">Statutory Requirements</a>                                                 
                        </li>                       
                        <span class="element-divider"></span>
                         <li>
                            <a class="" style="font-weight: bold;" href="?action=car history">Vehicle History</a>                                                  
                        </li>                          
                         <span class="element-divider"></span>
                         
                        <li>
                            <a class="" style="font-weight: bold;" target="_blank"  href="?action=fuel_history">Fuel History</a>                                                  
                        </li>                          
                         <span class="element-divider"></span> 
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
                        } else {
                            include_once 'authorized/car_track/home.php';
                        }
                            ?>   
              
        </div>
<footer class="navbar-fixed-bottom">
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
 $(".date1").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
$(".date2").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
$("#date3").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
$("#date4").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
});
</script>
 <!--end linces-->

<script src="css/datepicker.css"></script>
<script type="text/javascript">
                        // When the document is ready
                        $(document).ready(function () {

                            $('.f').datepicker({
                                format: "dd-mm-yyyy"
                            });
                            $('.g').datepicker({
                                format: "dd-mm-yyyy"
                            });
                             $('#example3').datepicker({
                                format: "dd-mm-yyyy"
                            });
                             $('#example4').datepicker({
                                format: "dd-mm-yyyy"
                            });

                        });
</script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
var deleteLinks = document.querySelectorAll('.delete');

for (var i = 0; i < deleteLinks.length; i++) {
  deleteLinks[i].addEventListener('click', function(event) {
      event.preventDefault();

      var choice = confirm(this.getAttribute('data-confirm'));

      if (choice) {
        window.location.href = this.getAttribute('href');
      }
  });
}

$('.service').click(function(e) {
    e.preventDefault();
});
</script>
        
</body>
</html>