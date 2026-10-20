<?php
require_once __DIR__ . '/mysql_compat.php';

session_start();
if (!isset($_SESSION['usertype'])) {
    header("location:index.php");
}  else {
    
include 'authorized/db.php';
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
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
<!--       <link href="css/iconFont.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">-->
        <!-- Load JavaScript Libraries -->
          

 <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
 <link href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <title> LEAVE REPORT </title>    



        

    </head>

    <body class="metro" style="background-color: #efeae3;">
        <div class="navigation-bar">
            <div class="navigation-bar-content">
                <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>LPO V1.0</sup></a>
                <span class="element-divider"></span>

                <a class="pull-menu" href="#"></a>                    

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
            
              <table id="datatablesreport" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Staff name</th>
                <th>Total leave days</th>
                <th>Total leave taken </th>
                <th>Total leave left</th>
                <th>Year</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
          
            $date=20180101;
            $i=1;
             $selectemploy = mysql_query("SELECT DISTINCT(emp_file_no) FROM  tbl_leaves WHERE startdate>='$date'") or die(mysql_error());
                while ($rozee = mysql_fetch_array($selectemploy)) {
                $employee = $rozee['emp_file_no'];
                
                $qnz = mysql_query("SELECT SUM(no_of_days) FROM tbl_leaves WHERE  startdate>'$date' AND emp_file_no='$employee' AND hod_status='Approved' AND fs_status='Approved' AND hrm_status='Approved'");
                $rowa = mysql_fetch_array($qnz);
                
                $daysremain=28-$rowa['SUM(no_of_days)']; 
                
               $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee' ORDER BY first_name ASC")or die(mysql_error());
               $majina = mysql_fetch_array($jina);
               $firstname = $majina['first_name'];
               $sirname = $majina['surname'];
           
         
              ?>           
            <tr>
                <td data-search="Tiger Nixon"><?php echo $i++;?></td>
                <td><?php echo $firstname.' '.$sirname;?></td>
                <td><?php echo 28 ;?></td>
                <td><?php echo $rowa['SUM(no_of_days)'];?></td>
                <td><?php echo $daysremain;?></td>              
                <td data-order="320800"><?php echo date('Y');?></td>
            </tr>
         <?php
         
         } 
         ?>
          
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Staff name</th>
                <th>Total leave days</th>
                <th>Total leave taken </th>
                <th>Total leave left</th>
                <th>Year</th>
            </tr>
        </tfoot>
      </table>  
      </div>
        
        <footer class="">
            <center>
                <div class="bottom-menu-wrapper bg-green">
                    <ul class="horizontal-menu compact">
                        <li>&copy;<a href=""> 2018 sincrositewatch limited</a></li>   
                    </ul>
                </div>
            </center>
        </footer>


<script src="assets/jquery/jquery-2.1.4.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables/js/dataTables.bootstrap.js"></script>-->




<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="http://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>

<script type=" text/javascript">
if ( $.fn.dataTable.isDataTable( '#datatablesreport' ) ) {
    table = $('#datatablesreport').DataTable({
            
             
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
            
            

        });
}
else {
    table = $('#datatablesreport').DataTable( {       
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdfHtml5'
        ]
        
    } );
}
    </script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            
             
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });

        $('.card .material-datatables label').addClass('form-group');
    });
</script>

</body>

</html>


<?php
}
?>