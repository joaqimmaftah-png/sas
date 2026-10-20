<?php
require_once __DIR__ . '/mysql_compat.php';

session_start();
$message='';
if(!isset($_SESSION["emp_file_no"]))
{
header("location:index.php");	
}
include 'authorized/db.php'; 
include (dirname(__DIR__).'/authorized/db.php');
$jina=mysql_query("SELECT *  from tbl_employee where emp_file_no='".$_SESSION["emp_file_no"]."'") or die(mysql_error());
$show=  mysql_fetch_array($jina);
$fname=$show['first_name'];
$surname=$show['surname'];
$name=$fname.' '.$surname;
if(isset($_POST['request'])){
    $vehicle_reg_num=$_POST['vregnm'];
    $Reported_issue=$_POST['report_issue'];
    $fault_reported_date=date('M d Y');
    $insertinto=  mysql_query("INSERT INTO tbl_car_faults(vehicle_reg_num,fault_reported_date,Reported_issue)VALUE('$vehicle_reg_num','$fault_reported_date','$Reported_issue')") or die(mysql_error());
    if($insertinto){
        $message='<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> .
</div>';
    }  
}

?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="Sincro Automation System">
        <meta name="description" content="Sincro Automation System">
        <meta name="author" content="Design by joaqim Maftah">
        <meta name="keywords" content="sas,Sincrositewatch,Sincro Automation System">
        <!-- Local JavaScript -->
       
<!--        <script src="js/metro/metro-treeview.js"></script>-->
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/iconFont.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet">
    <script src="js/script1.js"></script>

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
        <script type="text/javascript">
$(document).on("click", ".reject_modall", function() {
    var cash_id = $(this).data('cash_id');
    $(".modal-body #show_cash_id").val(cash_id);
});
</script>
<script type="text/javascript">
$(document).on("click", ".edit_request", function() {
    var id = $(this).data('id');
    var amount= $(this).data('amount');
    var quantity= $(this).data('quantity');
    var request_title= $(this).data('request_title');
    var detail= $(this).data('detail');
    var tamount=amount*quantity;
    var cash_id=$(this).data('cash_id');
    
    $(".modal-body #empp").val(id);
    
    $(".modal-body #amount").val(amount);
    $(".modal-body #quantity").val(quantity);
    $(".modal-body #id").val(id);
    $(".modal-body #request_title").val(request_title);
    $(".modal-body #detail").val(detail);
    $(".modal-body #tamount").val(tamount);
    $(".modal-body #cash_id").val(cash_id);
});
</script>

        <script>
        $(document).ready(function() {
    $('#table').DataTable();
} );
        </script>
        
        

       
        
<script>
        $(document).ready(function() {
    $('#table2').DataTable();
    $('#table3').DataTable();
    $('#table4').DataTable();
    $('#table5').DataTable();
    $('#table6').DataTable();
    $('#table7').DataTable();
    $('#report').DataTable();
    $('#asset').DataTable();
    $('#attendence').DataTable();
    $('#leave').DataTable();
    $('#table_solar').DataTable();
   $('#tablefuel').DataTable();
} );
        </script>
     <script>
         function gettabledata(url) {
            $('#deduction').fadeOut(1000, function () {
                $('#deduction').load(url);
                $('#deduction').fadeIn(1000, function () {
                });
            });
        }
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
         function getpastemployee(url) {
            $('#editinternal').fadeOut(100, function () {
                $('#editinternal').load(url);
                $('#editinternal').fadeIn(100, function () {
                });
            });
        }
                function deleteinternal(url) {
            $('#futakazindan').fadeOut(100, function () {
                $('#futakazindan').load(url);
                $('#futakazindan').fadeIn(100, function () {
                });
            });           
        }
                 function pastemployeeditings(url) {
            $('#editpastkaz').fadeOut(100, function () {
                $('#editpastkaz').load(url);
                $('#editpastkaz').fadeIn(100, function () {
                });
            });
        }
        function deletepastemployment(url) {
            $('#futakazilizopita').fadeOut(80, function () {
                $('#futakazilizopita').load(url);
                $('#futakazilizopita').fadeIn(80, function () {
                });
            });
        }
         function attachment(url) {
            $('#messageattachment').fadeOut(50, function () {
                $('#messageattachment').load(url);
                $('#messageattachment').fadeIn(50, function () {
                });
            });
        }
         function delete_incident(url) {
            $('#deleteattach').fadeOut(50, function () {
                $('#deleteattach').load(url);
                $('#deleteattach').fadeIn(50, function () {
                });
            });
        }
         function addawards(url) {
            $('#addawards').fadeOut(50, function () {
                $('#addawards').load(url);
                $('#addawards').fadeIn(50, function () {
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
        function viewasset(url) {
            $('#call_asset_view').fadeOut(30, function () {
                $('#call_asset_view').load(url);
                $('#call_asset_view').fadeIn(30, function () {
                });
            });
        }
        function asset(url) {
            $('#divchanges').fadeOut(500, function () {
                $('#divchanges').load(url);
                $('#divchanges').fadeIn(500, function () {
                });
            });
        }
        
        function editpayment(url) {
            $('#change_contents').fadeOut(500, function () {
                $('#change_contents').load(url);
                $('#change_contents').fadeIn(500, function () {
                });
            });
        }
    </script>
    <script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
                $('.success').delay(4000).fadeOut('normal');
            });
        </script>
    <style type="text/css">

@media print
{    
    .noprint, .bottom-menu-wrapper,.menusss *
    {
        display: none !important;
    }
}


</style>

    <title>HRMIS | Sincro Automation System</title>

    <style>
    </style>
</head>
 <body class="metro" >
<div class="navigation-bar shadow noprint">
<div class="navigation-bar-content">
     <a href="#" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>V 2.1</sup></a>
                    <span class="element-divider"></span>

                         <div class="navbar-header no-desktop">
        <a class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" href="#"><i  class="fa fa-list fg-white"></i></a> 

</div>
                    <div class="no-tablet-portrait hidden-xs hidden-sm hidden-md">
                       
                        <div class="element place-right">
                            <a class="dropdown-toggle" href="#">
                                <span class="icon-switch"></span>
                            </a> 
                              <ul style="display: none;" class="dropdown-menu place-right" data-role="dropdown">
                                <li><a href="logout.php">Sign Out</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#changepasssword">Change Password</a></li> 
                                                            
                            </ul>
                        </div>
                        <span class="element-divider place-right"></span>
                        <button class="element image-button image-left place-right">
                            <?php
echo $name;
                            ?>
                            <img src="images/mann1.png">
                        </button>
                    </div>
                </div>
</div>
<!--/////////////////////////////////////////////////-->
<!--            <div class="grid">
 <div class="row" style="margin-left:8px; margin-right: 6px;" >
                    <?php
//                            echo $message;
                    ?>
                </div>
                
            </div>-->
        <div class=" container-fluid">

             <?php
    
                           if (isset($_GET['action'])) {
                            include_once 'sincro.php';
                        } 
                        else {
                            include_once 'authorized/usersystem/my_profile.php';
                        }
                        
                 ?>   
           
</div>
<div class="fixed-bottom">
<footer class=" ">
    <center>
        <div class="bottom-menu-wrapper bg-green">
            <ul class="horizontal-menu compact">
                <li>&copy;<a href=""> 2015 sincrositewatch limited</a></li> 

            </ul>
        </div>
    </center>
</footer>
</div>
           
       
      
       
  <!-- Modal -->
<div id="changepasssword" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Change Password</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                        <form  id="upload_password" action="change_password.php" method="post">
                            <div class="form-group">
                                <label for="oldpass">Password:</label>
                                <input  type="password"  class="form-control" value=""  name="oldpass">
                                <input  type="hidden"  class="form-control" value="<?php echo $emp_file_no;?>" name="employeenumber">
                                
                            </div>                          
                            <div class="form-group">
                                <label for="newpass">New Password:</label>
                                <input type="password" class="form-control" id="newpass" name="newpass">
                            </div> 
                                 <div class="form-group">
                                <label for="retypepass">Retype Password:</label>
                                <input type="password" class="form-control" id="amount" name="retypepass">
                            </div> 
                            <div class="form-group" id="messages">                              
                               
                            </div> 
                            <button type="submit" class="btn btn-default" name="change">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!----------------------------------model tax------------------------------------------------>
<script type="text/javascript">
   var deleteLinks = document.querySelectorAll('#delete');

for (var i = 0; i < deleteLinks.length; i++) {
  deleteLinks[i].addEventListener('click', function(event) {
      event.preventDefault();

      var choice = confirm(this.getAttribute('data-confirm'));

      if (choice) {
        window.location.href = this.getAttribute('href');
      }
  });
}
</script>
        <script src="js/jquery.bootpag.js"></script> 
        <script src="js/jquery.bootpag.min.js"></script> 
      

</body>
</html>
