<?php 
include 'authorized/db.php';
$invoice_no=$_GET['invoice_no'];

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
        <script src="js/script.js"></script>

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
    </script>

    <script>
        function getPage(url) {
            $('#showpage').fadeOut(1000, function () {
                $('#showpage').load(url);
                $('#showpage').fadeIn(1000, function () {
                });
            });
        }
        
                function addfield(url) {
            $('#addbox').fadeOut(1000, function () {
                $('#addbox').load(url);
                $('#addbox').fadeIn(1000, function () {
                });
            });
        }
    </script>



    <title>Accounts Managements</title>

    <style>
    </style>
</head>
<body class="metro">
<div class="container">
    <div class="grid">



            <!---------------------------------------------INVOICE INFORMATION-------------------------------------->
            <p><br></p>
            <div class="row">
                <!------------------------------------------invoice info--------------------------------------------->
                <form action="authorized/accounting/process.php?invoice_no=<?php echo $invoice_no;?>" method="post">
                <div class="span6">
                    <div class="row">
                        <div class="span4">
                            <div class="input-control text info-state span4" data-role="input-control">
                                <input placeholder="info" name="info[]" type="text">                           
                            </div>

                        </div>
                        <div class="span2">
                            <div class="input-control text info-state span2" data-role="input-control">
                                <input placeholder="0.00" type="text" name="amounts[]" class="fg-black">                           
                            </div>

                        </div>
                    </div>
                    <div class="row">                      
                <div class="span4">
                    <input value="ADD INVOICE INFORMATION" type="submit" name="submit" class="button large primary">
                </div>
                    </div>

                </div>
                </form>

                <!------------------------------------------------end invoice info---------------------------------------->
            </div>


    </div>
</form>
</div>
    </body>
    </html>
<!----------------------------------end formdata--------------------------------------------->

