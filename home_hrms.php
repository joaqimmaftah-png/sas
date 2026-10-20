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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="Metro UI CSS Framework">
        <meta name="description" content="Simple responsive css framework">
        <meta name="author" content="Sergey S. Pimenov, Ukraine, Kiev">
        <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui">
        
        <script type="text/javascript" src="jxquery/jquery.min1.js"></script>
          
        <script type="text/javascript">
            $("#print").live("click", function () {
                var divContents = $("#show").html();
                var printWindow = window.open('', '', 'height=600,width=900');
                printWindow.document.write('<html><head><title>Payslip|sincrositewatch Ltd</title>');
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
        <script src="Chart.js"></script>
        

        <!-- Local JavaScript -->
        <script src="js/docs.js"></script>
        <script src="js/script1.js"></script>
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
            $('#deduction').fadeOut(1000, function () {
                $('#deduction').load(url);
                $('#deduction').fadeIn(1000, function () {
                });
            });
        }
                function getdelete(url) {
            $('#delete').fadeOut(1000, function () {
                $('#delete').load(url);
                $('#delete').fadeIn(1000, function () {
                });
            });
        }
                function getPages(url) {
            $('#updatepayroll').fadeOut(1000, function () {
                $('#updatepayroll').load(url);
                $('#updatepayroll').fadeIn(1000, function () {
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
        function approved(url) {
            $('#call_approving').fadeOut(50, function () {
                $('#call_approving').load(url);
                $('#call_approving').fadeIn(50, function () {
                });
            });
        }
    </script>
   <script type="text/javascript">
$(document).on("click", ".edit_request", function() {
    var id = $(this).data('id');
    $(".modal-body #empp").val(id);
});
</script>
      

    <title>HRMIS | Sincro Automation System</title>
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
        
        <script type="text/javascript" src="jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgauge.js"></script>
    
</head>
 <body class="metro" style="background-color: #efeae3;">

        <header class=" shadow" data-load="header_hrm.php"></header>
        <div class="container-desktop">
            <div class="grid">
                <div class="row" style="margin-left:8px; margin-right: 6px;" >
                    <?php
                        if (isset($_GET['action'])) {
                            include_once 'sincro.php';
                        } else {
                            include_once 'authorized/HR/manage_employee.php';
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
<link href="js/bootstrap.min.css" rel="stylesheet">  
 <script src="js/bootstrap.min.js"></script>
<!-- <link href="js/modalkubwa.css" rel="stylesheet">-->

</body>
</html>