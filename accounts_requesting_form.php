<?php
session_start();
include 'authorized/db.php';
$cookie_name = "request";
$cookie_value = $_GET['request'];
setcookie($cookie_name, $cookie_value, time() + (60 * 60), "/"); // 86400 = 1 day
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
    <div class="" style="width:100%;">
        <?php
        include 'authorized/db.php';
        if (isset($_POST['send'])) {
            if (!isset($_COOKIE[$cookie_name])) {
                echo "Cookie named '" . $cookie_name . "' is not set!";
            } else {
                $hour = date("H");
                $minute = date("i");
                $second = date("s");
                $date = mktime($hour, $minute, $second);
                $time = date("H:i:s", $date);
                $employee = $_COOKIE[$cookie_name];
                $detail = $_POST['detail'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $datee = date("d.m.Y");
                $mdauliopita = $time - 30;
                $total = $price * $quantity;
                $insert_temporary = mysql_query("INSERT INTO tbl_temporary_accounts_requesting"
                        . "(`request_date`, `details`, `price`, `quantity`, `total`, `emp_file_number`,time_set)"
                        . "values('$datee','$detail','$price','$quantity','$total','$employee','$time')") or die(mysql_error());
            }
        }
        if(isset($_POST['sending'])){           
             if (!isset($_COOKIE[$cookie_name])) {
                echo "Cookie named '" . $cookie_name . "' is not set!";
            } else {
                                    $employee = $_COOKIE[$cookie_name];
                                        $insert_temporary = mysql_query("SELECT * from tbl_temporary_accounts_requesting WHERE emp_file_number='$employee'")or die(mysql_error());
                                        while ($row = mysql_fetch_array($insert_temporary)) {
                                            $tbl_req_idd = $row['tbl_req_idd'];
                                            $details = $row['details'];
                                            $request_date  = $row['request_date'];
                                            $emp_file_number= $row['emp_file_number'];                                     
                                            $price = $row['price'];
                                            $quantity = $row['quantity'];
                                            $total = $row['total'];
                                            $submitdata=mysql_query("INSERT INTO tbl_accounts_requesting"
                                                    . "( `request_date`, `details`, `price`, `quantity`, `total`, `emp_file_number`,tbl_req_idd)"
                                                    . "VALUES('$request_date','$details ','$price','$quantity','$total','$emp_file_number','$tbl_req_idd')") or die(mysql_error());
                             
                                             
                                        }
     
                                                $insert_temporary = mysql_query("SELECT * from tbl_accounts_requesting WHERE emp_file_number='$employee'")or die(mysql_error());
                                                 while ($rows = mysql_fetch_array($insert_temporary)) {
                                                     $tbl_req_idd=$rows['tbl_req_idd'];
                                                     $deteee=  mysql_query("DELETE FROM tbl_temporary_accounts_requesting WHERE tbl_req_idd='$tbl_req_idd'") or die(mysql_error());
                                                 }
            }
            
        }
        ?>
        <div class="grid">
            <div class="row">
                <div class="span6">
                    <form method="post" action="">
                        <fieldset>
                            <legend><center>CASH REQUISITION</center></legend>
                            <div class="span6">
                                <label>DETAILS</label>
                                <div class="input-control textarea">
                                    <textarea name="detail"></textarea>
                                </div>

                            </div>
                            <div class="span6">
                                <div class="span3">
                                    <label>PRICE</label>
                                    <div class="input-control email span3" data-role="input-control">
                                        <input  type="text" name="price">

                                    </div>
                                </div>
                                <div class="span3">
                                    <label>QUANTITY</label>
                                    <div class="input-control number span3" data-role="input-control">
                                        <input  type="text" name="quantity">

                                    </div>
                                </div>

                            </div>
                            <!--                            <div class="span6">
                                                            <label>TOTAL</label>
                                                            <div class="input-control text span6" data-role="input-control">
                                                                <input  type="text" name="total">
                            
                                                            </div>
                                                        </div>-->


                            <div class="span6" style="margin-top: 5px;">
                                <input value="Add" type="submit" name="send">
                            </div>

                        </fieldset>
                    </form>
                </div>
                <div class="span9 offset1" style="margin-top:3%;">
                    <div class="example">
                        <table class="table striped bordered hovered">
                            <thead>
                                <tr>
                                    <th class="text-left">DETAILS</th>
                                    <th class="text-left">PRICE</th>
                                    <th class="text-left">QUANTITY</th>
                                    <th class="text-left">TOTAL</th>
                                    <th class="text-left">REMOVE</th>

                                </tr>
                            </thead>

                            <tbody>             
                                <?php
                                include 'authorized/db.php';
                                if (isset($_POST['send'])) {
                                    if (!isset($_COOKIE[$cookie_name])) {
                                        echo "Cookie named '" . $cookie_name . "' is not set!";
                                    } else {
                                        $employee = $_COOKIE[$cookie_name];
                                            $hour = date("H");
                                            $minute = date("i");
                                            $minute1 = date("i")-30;
                                            $second = date("s");
                                            $date = mktime($hour, $minute, $second);
                                            $date1 = mktime($hour, $minute1, $second);
                                            $time = date("H:i:s", $date);
                                            $time2=date("H:i:s", $date1);
                                           
                            
                                        $insert_temporary = mysql_query("SELECT * from tbl_temporary_accounts_requesting WHERE emp_file_number='$employee'")or die(mysql_error());
                                        while ($row = mysql_fetch_array($insert_temporary)) {
                                            $details = $row['details'];
                                            $price = $row['price'];
                                            $quantity = $row['quantity'];
                                            $total = $row['total'];

                                            ?>
                                            <tr class=" info">
                                                <td class="right"><?php echo $details; ?></td>
                                                <td class="right"><?php echo $price; ?></td>
                                                <td class="right"><?php echo $quantity; ?></td>
                                                <td class="right"><?php echo $total; ?></td>
                                                <td class="right"><a href="#"><i class=" icon-cancel-2 shadow"></i></a></td>
                                            </tr>

                                            <?php
                                                
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <?php 
                        if (isset($_POST['send'])) {
                                        if (isset($_COOKIE[$cookie_name])) {
                                            $employee = $_COOKIE[$cookie_name];
                        ?>
                        <form action="?request=<?php echo $employee;?>" method="POST" >
                            <input type="submit" name="sending" value="SUBMIT CASH">
                        </form>
                        <?php }}?>
                     </div>
                </div>
               
            </div><hr>
<!-------------------------------------contents from database--------------------------------------->
            <div class="row">
                <div class="container">
                                        <?php
                    if(isset($_GET['sending'])){
                                     if (!isset($_COOKIE[$cookie_name])) {
                echo "Cookie named '" . $cookie_name . "' is not set!";
            } else {
                                    $employee = $_COOKIE[$cookie_name];
     
                                                $insert_temporary = mysql_query("SELECT * from tbl_accounts_requesting WHERE emp_file_number='$employee'")or die(mysql_error());
                                                $rows = mysql_fetch_array($insert_temporary);
                                                
            }
                   
                    ?>
                    <h1 class=" text-center">CASH REQUISITION</h1><hr>

                   <span> NAME:JOAQIM MAFTAH</span><span class=" place-right">STAFF NO:SSW001</span>
                   <hr>
                   <div class="example">
                    <table class="table bordered">
                        <thead>
                        <tr>
                            <th class="text-left">No.</th>
                            <th class="text-left">DETAILS</th>
                            <th class="text-left">CHARGE TO:JOB/ACCOUNTS</th>
                            <th class="text-left">TOTAL TSHS</th>                    
                        </tr>
                        </thead>

                        <tbody>
                            <?php
                                    if(isset($_POST['sending'])){           
             if (!isset($_COOKIE[$cookie_name])) {
                echo "Cookie named '" . $cookie_name . "' is not set!";
            } else {
                                    $employee = $_COOKIE[$cookie_name];
                                    $i=0;
                                        $insert_temporary = mysql_query("SELECT * from tbl_temporary_accounts_requesting WHERE emp_file_number='$employee'")or die(mysql_error());
                                        while ($row = mysql_fetch_array($insert_temporary)) {                                           
                                            $details = $row['details'];
                                            $request_date  = $row['request_date'];
                                            $emp_file_number= $row['emp_file_number'];                                     
                                            $price = $row['price'];
                                            $quantity = $row['quantity'];
                                            $total = $row['total'];
                                            $i++;

                            ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td class="right"><?php echo $details;?></td>
                            <td class="right"><?php echo $price."X".$quantity;?></td>
                            <td class="right"><?php echo  $total?></td>                  
                        </tr>
                        <?php 
                                    }
            }
            
        }
                        ?>
                        <tr>
                            <td style="border:0px;"><h4>Requisitioned by</h4></td>
                            <td class="right" style="border:0"></td>
                            <td class="right place-right" style="border:0px;">TOTAL REQUISITIONED</td>
                            <td class="right">700000000000</td>                  
                        </tr>
                        <tr>
                            <td style="border:0px;"></td>
                            <td class="right" style="border:0px;"></td>
                            <td class="right place-right" style="border:0px;">Due (to)/from company CASH IN HAND</td>
                            <td class="right">700000000000</td>                  
                        </tr>
                                                <tr>
                            <td style="border:0px;"></td>
                            <td class="right" style="border:0px;"></td>
                            <td class="right place-right" style="border:0px;">CASH/CHEQUE DETAILS TOTAL PAID</td>
                            <td class="right">700000000000</td>                  
                        </tr>
                        
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                </div>
                   <?php
                    }
                   ?>
                </div>
                
            </div>
<!-----------------------------------------end conents---------------------------------------------->
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