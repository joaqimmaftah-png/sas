<?php
require_once __DIR__ . '/mysql_compat.php';
 include 'authorized/db.php'; ?>
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
            $("#btnPrint").live("click", function () {
                var divContents = $("#dvContainer").html();
                var printWindow = window.open('', '', 'height=400,width=800');
                printWindow.document.write('<html><head><title>DIV Contents</title>');
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

        <!-- Local JavaScript -->
        <script src="js/docs.js"></script>
        <script src="js/github.info.js"></script>
        <link href="datable/jquery.dataTables.css" rel="stylesheet">
        <script src="datable/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').dataTable();
            });
        </script>
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



    <title>Accounts Managements | Sincro Automation System</title>

    <style>
    </style>
</head>
<body class="metro" style="background-color: #FFFFFF">
    <header class="" data-load="header_accounts.php"></header>
  
        <!--            home accounts--> 
        <div class="container">
            <div class="grid" style="">
            <div class="row">
<!-------------------------------------CONTENTS------------------------------>
<?php
$request_number=  rand(100, 10000);
?>
<a href="accounts_requesting_form.php?request=<?php echo $request_number;?>"> make request</a>
<!------------------------------------EM\ND CONTENTS------------------------->
      
            </div>               
        </div> 
        </div>
          
        
 
    <!--//-->
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


</body>
</html>