<?php
//session_start();
//if (!isset($_SESSION['usertype'])) {
//    header("location:index.php");
//}  else {
//    
?>
<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="">

        <script type="text/javascript" src="jxquery/jquery.min1.js"></script> 


        <script src="js/jquery.min.js"></script>         
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
        <!--       <link href="css/iconFont.css" rel="stylesheet">
                <link href="css/docs.css" rel="stylesheet">-->
        <!-- Load JavaScript Libraries -->
        <script src="js/jquery/jquery.min.js"></script>                    
        <script src="js/jquery/jquery.widget.min.js"></script>
        <script src="js/jquery/jquery.mousewheel.js"></script>
        <script src="js/metro/metro-input-control.js"></script>
        <script src="js/prettify/prettify.js"></script>       

        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/datatables/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="authorized/usersystem/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="authorized/usersystem/bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="authorized/usersystem/bootstrap/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

        <title>File Management</title>

        <script>
            $(document).ready(function () {
                $('#table').DataTable();
            });
        </script>

        
        
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


    </head>

    <body class="metro" style="background-color: #efeae3;">
        <div class="navigation-bar">
            <div class="navigation-bar-content">
                <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>File System V1.0</sup></a>
                <span class="element-divider"></span>

                <a class="pull-menu" href="#"></a>
                <ul class="element-menu">
                    <li>
                        <a class="" style="font-weight: bold;" href="?">File Database</a>                             
                    </li>                      
                    <span class="element-divider"></span>
                   <li>
                        <a class="" style="font-weight: bold;" href="?action=home_asset">Asset Tracker</a>                             
                    </li>                     
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
            <br>






            
            
            <?php
                        if (isset($_GET['action'])) {
                            include_once 'file_link.php';
                        } 
                        else {
                            include_once 'authorized/asset_tracker/file_management.php';
                        }
            ?> 

<!--///////////////////ASSET MANAGEMENT///////////////////-->
       
 <!--///////////////////////////////////-->           
            
            
            
            
            
            
            
            
<!--modalities-->
       <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Document Overview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This document aims to provide an outline of factors to consider in order for the World Mobile vision to continue to develop with the support, expertise and professional inputs available from Sincro Sitewatch Ltd. <br><br>
        [SSW] All of the required tasks Identified herein are within the capacities of Sincro. Service Level Agreements, tendering and procurement documents for supplies from outside parties can be prepared by an independent consultant working under the Sincro umbrella so that SSW can provide a full operational package for World Mobile in Tanzania and when network expansion grows, beyond. <br><br> Under this arrangement World Mobile will be able to dramatically reduce operational costs, will require only a minimum personnel presence in – country whilst creating a template for rapid execution in other territories. <br> Executive level scrutiny, governance and oversight can be achieved through regular scheduled steering committee meetings held by video link, in country or internationally when required.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>     
<!--endmodal-->

<!--modalities-->
       <!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Document Overview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        In October 2021Sincro and World Mobile installed 5 new Wi Fi hubs at locations in Unguja,  Zanzibar as part of the initial stages to provide low cost connectivity to communities in Unguja and Pemba Islands.<br><br> 
        Whereas for initial trial purposes and expediency the installed sites were connected to mains electricity it is the intention going forward that the majority of sites will be powered by renewable energy, principally solar PV. <br> <br>
        The purpose of the power logging exercise was to provide reliable and trustworthy data that will form the criteria for dimensioning and selection of the Solar Power requirements per site.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>     
<!--endmodal-->
          <!--modalities-->
       <!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Document Overview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          The school is located at Soko Muhogo street, Stone town. It is about 180m away from Forodhani Secondary School, approximately 350m away from Kiponda Secondary School in addition to 420m away from Haile Selassie school.<br><br>
       It is a two storey building with a wall fence and a man-guard security 24/7. There is a Telecom site in the Campus. The neighbouring surrounding are mostly storey buildings. Moreover there are businesses, hotels for instance MaruMaru Hotel approximately 100m away in addition to banks such as DTB, People’s bank of Zanzibar between 100-150m away.
Note: These distance are based on the roads

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>     
<!--endmodal-->

  <!-- Modal -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Document Overview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        The site is a public secondary school located along the Jamatini Road in the Forodhani area. The site is about 200m from Zanzibar ferry terminal near the main port. There are hotels and restaurants such as Spice palace hotel, Golden tulip boutique about 300m. In addition there are other local business nearby
<br>Note: These distance are by road


      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>     
<!--endmodal-->
 <!-- Modal -->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Document Overview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        The school is a public school owned by the government located along the Benjamin Mkapa Road. It is one of the oldest schools hence renovation and reconstruction is ongoing. Opposite the school there is a Public square, the ministry of Tourism is few km away. In addition there is State University of Zanzibar-Vuga Campus about 270m away by road.<br><br>
       The school is a one storey building comprises of classrooms, computer room, offices among others surrounding the ground. The roof is covered by galvanized steel, however there is a balcony which can be used for pole and solar installation.


      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>     
<!--endmodal-->
          <!-- Modal -->
<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Document Overview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       The school is located along the Jang’ombe Road about 200m from the road
The site is located in the residential area and surrounded with tall trees
Moreover there is a Jangómbe  primary and secondary school nearby the site

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>     
<!--endmodal-->

<!--endmodal-->
          <!-- Modal -->
<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Document Overview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
The school is a public school owned by the government located along the sea shore. This is a wall fenced school compound bounded by government institutes and ministry offices around. Moreover there are hotels and lodges such as Kisiwa house about 100m among other business such as banking nearby.
<br><br>
The school is a two storey building with a classroom buildings. School hall as well as a computer lab/room

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>     
<!--endmodal-->
           
<!--endmodal-->
          <!-- Modal -->
<div class="modal fade" id="myModal07" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Document Overview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
The school is closely to Bububu Secondary and Primary school. It is one of the new schools with one storey building, with modern facilities such as computer room. Moreover there are various business located near the school.

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>     
<!--endmodal-->
            
        </div>

        <footer class="">
            <center>
                <div class="bottom-menu-wrapper bg-green">
                    <ul class="horizontal-menu compact">
                        <li>&copy;<a href="">  <?php echo date('Y')?> sincrositewatch limited</a></li> 

                    </ul>
                </div>
            </center>
        </footer>


        <script src="assets/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/js/dataTables.bootstrap.js"></script>


        <script type="text/javascript" src="authorized/usersystem/bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="authorized/usersystem/bootstrap/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
        <script type="text/javascript">
            $('.form_datetime').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });
            $('.form_date').datetimepicker({
                language: '',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
            $('.form_time').datetimepicker({
                language: 'fr',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                minView: 0,
                maxView: 1,
                forceParse: 0
            });
        </script>


<script src="js/jquery.bootpag.js"></script> 
        <script src="js/jquery.bootpag.min.js"></script> 
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script>
    jQuery(function($){
   $("#date1").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
$("#date2").mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
$("#date3").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
$("#date4").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
});
</script>
    </body>
</html>
<?php
//}
?>