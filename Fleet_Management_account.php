<?php
require_once __DIR__ . '/mysql_compat.php';

session_start();
if (!isset($_SESSION['usertype'])) {
    header("location:index.php");
}
include 'authorized/db.php';

$message = "";
if (isset($_POST['category'])) {

    $category = $_POST['category_name'];
    if (!empty($category)) {
        $insert_category = "INSERT INTO tbl_spare_category(category)VALUES('$category')";
        $suceess = mysql_query($insert_category) or die(mysql_error());
        if ($suceess) {
            $message = '<div class="shadow primary margin5 success" style="height: 30px;color:blue;  width: 100%;">
       <center>DATA SUCCESSFUL SUBMITED.....!</center>
       </div>';
        }
    } else {
        $message = '<div class="shadow error margin5" style="height: 30px;color:white; background:red;  width: 100%;">
       <center>Nothing added in database!</center>
       </div>';
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
        <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui ">
        
        <script type="text/javascript" src="jxquery/jquery.min1.js"></script> 
         
         
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

  
        <script src="js/jquery.min.js"></script>         
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
        <link href="css/iconFont.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">
        <link href="js/prettify/prettify.css" rel="stylesheet">
         <link href="js/prettify/prettify.css" rel="stylesheet">
         <link href="css/table-responsive.css" rel="stylesheet" />
        <!-- Load JavaScript Libraries -->
        <script src="js/jquery/jquery.min.js"></script>                    
        <script src="js/jquery/jquery.widget.min.js"></script>
        <script src="js/jquery/jquery.mousewheel.js"></script>
        <script src="js/metro/metro-input-control.js"></script>
        <script src="js/prettify/prettify.js"></script>       
        <!-- Metro UI CSS JavaScript plugins -->
<!--        <script src="js/load-metro.js"></script>-->
        


         <!-- Local JavaScript -->
        <script src="js/docs.js"></script>
        <script src="js/github.info.js"></script>
        <link href="datable/jquery.dataTables.css" rel="stylesheet">
        <script src="datable/jquery.dataTables.js"></script>
        
       
        
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
       

        <script>
                function getPage(url) {
                    $('#request_form').fadeOut(1000, function () {
                        $('#request_form').load(url);
                        $('#request_form').fadeIn(1000, function () {
                        });
                    });
                }
        </script>

        <title>Spare Parts Management | SAS</title>

        <style>
        </style>
        
        <script src="js/hitua.js"></script>
<link href="js/bootstrap.min.css" rel="stylesheet">

 <script src="js/bootstrap.min.js"></script>
    </head>

    <body class="metro" style="background-color: #efeae3;">

        <header class="shadow" data-load="track_header.php"></header>
        <div class="container-desktop">
            <div class="grid">
                <div class="row" style="margin-left:8px; margin-right: 6px;" >
                    <?php
                        if (isset($_GET['action'])) {
                            include_once 'sincro.php';
                        } else {
                            include_once 'authorized/car_track/vehicle_accounts_manage.php';
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
        

 

        
</body>
</html>