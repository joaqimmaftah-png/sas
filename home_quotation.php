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


if(isset($_GET['deleteid'])){
   $quotationid=$_GET['deleteid'];
   
$del=  mysql_query("DELETE FROM `tbl_preparedquotation` WHERE Quotation_id='$quotationid'")or die(mysql_error());
   
$delQitem= mysql_query("DELETE FROM `tbl_quotationitem` WHERE Quotation_id='$quotationid'")or die(mysql_error());
 
$selT=  mysql_query("SELECT * FROM `tblinvoice` WHERE Quotation_id='$quotationid'")or die(mysql_error());
 $naa=  mysql_fetch_array($selT);
 $invoid=$naa['Invoice_id'];
 $invdele=  mysql_query("DELETE FROM `tblinvoice_item` WHERE `Invoice_id`='$invoid'")or die(mysql_error());
 if ($invdele){
 $invodelT=  mysql_query("DELETE FROM `tblinvoice` WHERE Quotation_id='$quotationid'")or die(mysql_error());
 } 
}

?>
<!DOCTYPE html>
<html>
    <head>
    <!--        <script src="js/metro/metro-treeview.js"></script>-->
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <!--<link href="css/iconFont.css" rel="stylesheet">-->
        <link href="css/docs.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    <script src="js/script.js"></script>

 <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="print">
    <link href="assets/datatables/css/dataTables.bootstrap.css" rel="stylesheet" media="print">
    <link href="assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
 <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" media="print">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    
    
        <script src="js/jquery/jquery.min.js"></script>                    
        <script src="js/jquery/jquery.widget.min.js"></script>
        <script src="js/jquery/jquery.mousewheel.js"></script>
        <script src="js/load-metro.js"></script>     
        <link href="js/bootstrap.min.css" rel="stylesheet">  
 <script src="js/bootstrap.min.js"></script>
 


    <script>
        $(document).ready(function() {
    $('#table').DataTable();
} );
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
    
   <script>
   $(document).on("click", ".editdata", function () {
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
                 var r = $(this).data('r');
                 var s = $(this).data('s');
                 var t = $(this).data('t');
                 var u = $(this).data('u');
                 var v = $(this).data('v');
                 var w = $(this).data('w');
                 var x = $(this).data('x');
                 var y = $(this).data('y');
                 var z = $(this).data('z');
                 var aa = $(this).data('aa');
                 var ab = $(this).data('ab');
                 var ac = $(this).data('ac');
                 var ad = $(this).data('ad');
                 var ae = $(this).data('ae');
                 var af = $(this).data('af');
                 var ag = $(this).data('ag');
                 
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
                  $(".modal-body #r").val(r);
                  $(".modal-body #s").val(s);
                  $(".modal-body #t").val(t);
                  $(".modal-body #u").val(u);
                  $(".modal-body #v").val(v);
                  $(".modal-body #w").val(w);
                  $(".modal-body #x").val(x);
                  $(".modal-body #y").val(y);
                  $(".modal-body #z").val(z);
                  $(".modal-body #aa").val(aa);
                  $(".modal-body #ab").val(ab);
                  $(".modal-body #ac").val(ac);
                  $(".modal-body #ad").val(ad);
                  $(".modal-body #ae").val(ae);
                  $(".modal-body #af").val(af);
                  $(".modal-body #ag").val(ag);
                  $(".modal-body #sn").text(af);
            });
        </script>



</head>
 <body class="metro" style="">
        <div class="navigation-bar shadow">
            <div class="navigation-bar-content">
                <a href="" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>QUOTATION V1.0</sup></a>
                <span class="element-divider"></span>

                <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" href="?" style="font-weight: bold;" href="">HOME</a>                             
                        </li>                      
                        <span class="element-divider"></span>
                        <li>
                            <a class="" href="?action=quotationpage" style="font-weight: bold;">QUOTATION</a>                                                 
                        </li>
                        <span class="element-divider"></span>
                         <li>
                            <a class="" href="?action=invoicepage" style="font-weight: bold;">INVOICE</a>                                                 
                        </li>
                         <span class="element-divider"></span>
                         <li>
                          <a class="" href="?action=updatequotation" style="font-weight: bold;">QUOTATION UPDATES</a>                                                 
                        </li>
                        
                        <li>
                          <a class="" href="?action=quotationreport" style="font-weight: bold;">REPORT</a>                                                 
                        </li>
<!--                        <span class="element-divider"></span>
                        <li>
                            <a class="" href="" style="font-weight: bold;">LEAVE MANAGEMENT</a>                                                 
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
    <div class="container-fluid" style="margin-top:1%;margin-bottom: 1%">
           
                
                    <?php
                        if (isset($_GET['action'])) {
                            include_once 'sincro.php';
                        } else {
                            include_once 'authorized/quotation/add_quotation.php';
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

<script src="assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables/js/dataTables.bootstrap.js"></script>


</body>
</html>