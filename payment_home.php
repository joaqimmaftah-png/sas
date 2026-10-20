<?php
require_once __DIR__ . '/mysql_compat.php';

session_start();
include 'authorized/db.php';
if (!isset($_SESSION['usertype'])) {
    header("location:index.php");
}  else {
    

?>
<!DOCTYPE html>
<html>
<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
     
         
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
<!--       <link href="css/iconFont.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">-->
        <!-- Load JavaScript Libraries -->
<!-- <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->

    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
/*        background-color: #4CAF50;
        color: white;*/
    }
</style>
  

 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> 
 <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet"> 
        <title>Payment Approve</title>

        

</head>

    <body class="metro" >
        <div class="navigation-bar">
            <div class="navigation-bar-content">
                <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>PAYMENT V1.0</sup></a>
                <span class="element-divider"></span>

                <a class="pull-menu" href="#"></a>
                    <ul class="element-menu">
                        <li>
                            <a class="" style="font-weight: bold;" href="#">Home</a>                             
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
        <div class="container-fluid">
            
            <a href="home_accounts.php" type="button" class="btn btn-success" style="margin:5px 0px 5px 0px">View Report</a> 
            
            <br>
            

                  <?php
                        if (isset($_GET['action'])) {
                            include_once 'sincro.php';
                        } 
                        else {
                            include_once 'authorized/cash/home.php';
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

    
    
   

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src=" https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script>
      $(document).ready(function() {
    $('#example').DataTable();
} );
      
</script>
    </body>
</html>

<?php

  }
  
?>