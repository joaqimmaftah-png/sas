<?php
require_once __DIR__ . '/mysql_compat.php';

if(isset($_POST['spare_excell'])){
    include_once 'authorized/db.php';
$target_file =$_FILES["file"]["name"];
       $extension=explode(".", $target_file);
       $name=$extension[1];
      if($name=="xls"){
    require_once 'Classes/PHPExcel/IOFactory.php';
    $inputFileType = 'Excel5';
    $inputFileName = $_FILES['file']['tmp_name'];
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($inputFileName);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true); //HIZNI COLUMN
    $counter = count($sheetData);
        for ($i = 2; $i <= $counter; $i++) {//TUNAANZA NA ROW YA PILI KUCHUKUA DATA ZETU
    $siteid= $sitename=$class=$opszone =$zone=$region =$contractor_company =$field_supvisor =$anchor_tenant=$infraowner=$htt_site_class =$grid_status =$ops_site_type 
   =$hybride_active =$station_name =$supplier_name =$shelter_type =$site_type =$guard_at_site =$grid_meter_type =$grid_meter_namba =
   $hta_site_id =$air_condition_type =$air_cond_capacity =$gen_set_type =$gen_set_capacity =
    $gen_set_tank_capacity =$gen_set_consumption =$sincro_ft =$sincro_fs ="";
    
    
        $siteid =mysql_escape_string($sheetData[$i]['A']);
        $sitename = $sheetData[$i]['B'];
        $class=$sheetData[$i]['C'];
        $opszone = $sheetData[$i]['D']; 
        $zone = $sheetData[$i]['E'];
        $region=$sheetData[$i]['F'];
        $contractor_company=$sheetData[$i]['G'];
        $field_supvisor=$sheetData[$i]['H'];
        $anchor_tenant=$sheetData[$i]['I'];
        $infraowner=$sheetData[$i]['J'];
        $htt_site_class=$sheetData[$i]['K'];
        $grid_status =$sheetData[$i]['L'];
        $ops_site_type=$sheetData[$i]['M'];
        $hybride_active=$sheetData[$i]['N'];
        $station_name=$sheetData[$i]['O'];
        $supplier_name=$sheetData[$i]['P'];
        $shelter_type=$sheetData[$i]['Q'];
        $site_type=$sheetData[$i]['R'];
        $guard_at_site=$sheetData[$i]['S'];
        $grid_meter_type=$sheetData[$i]['T'];
        $grid_meter_namba=$sheetData[$i]['U'];
        $hta_site_id =$sheetData[$i]['V'];
        $air_condition_type=$sheetData[$i]['W'];
        $air_cond_capacity=$sheetData[$i]['X'];
        $gen_set_type=$sheetData[$i]['Y'];
        $gen_set_capacity=$sheetData[$i]['Z'];
        $gen_set_tank_capacity=$sheetData[$i]['AA'];
        $gen_set_consumption=$sheetData[$i]['AB'];
        $sincro_ft=$sheetData[$i]['AC'];
        $sincro_fs=$sheetData[$i]['AD'];

        
        
        
$sparepart="INSERT INTO tbl_site( `site_id`, `site_name`, `class`, `operation_zone`, `zone`, `region`, "
        . "`contractor_company`, `field_supervisor`, `anchor_tenants`, `infra_owner`, `htt_site_class`, `grid_status`,"
        . " `ops_site_type`, `hybrid_active`, `station_name`, `supplier_name`, `shelter_name`, `site_type`, "
        . "`guard_at_site`, `grid_meter_type`, `grid_meter_number`, `hta_site_id`, `aircondition_type`, "
        . "`air_condition_capacity`, `gen_set_type`, `gen_set_capacity`, `gen_set_tank_capacity`, "
        . "`genset_consumption`, `sincro_ft`, `sincro_fs`)"
        . "VALUES('$siteid','$sitename','$class','$opszone','$zone','$region','$contractor_company',"
        . "'$field_supvisor','$anchor_tenant','$infraowner','$htt_site_class','$grid_status','$ops_site_type',"
        . "'$hybride_active','$station_name','$supplier_name','$shelter_type','$site_type','$guard_at_site',"
        . "'$grid_meter_type','$grid_meter_namba','$hta_site_id','$air_condition_type','$air_cond_capacity',"
        . "'$gen_set_type','$gen_set_capacity','$gen_set_tank_capacity','$gen_set_consumption','$sincro_ft','$sincro_fs')";
         mysql_query($sparepart) or die(mysql_error());
   $message=' <div class="success"><button name="addspare"  class="shadow button smaller bg-red fg-black">successful added to store database</button></div>' ;
//    }
       
        }
          
          
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
        <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui">
        <script type="text/javascript" src="jxquery/jquery.min1.js"></script>
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



    <title>Spare Parts Management | SAS</title>

    <style>
    </style>
</head>
<body class="metro" style="background-color: #efeae3;">
<button id="uploadigs"  class="button">UPLOAD EXCELL FILE</button>
  <script>
                    $(function(){
                        $("#uploadigs").on('click', function(){
                            $.Dialog({
                                shadow: true,
                                overlay: false,
                                draggable: true,
                                icon: '<span class="icon-file-excel"></span>',
                                title: 'Draggable window',
                                width: 500,
                                padding: 10,
                                content: 'SELECT EXCELL FILE',
                                onShow: function(){
                                    var content = '<form action="" method="post" enctype="multipart/form-data">' +
                                            '<label>SELECT FILE</label>' +
                                            '<div class="input-control file"><input type="file" name="file" /><button class="btn-file"></button></div>' +                                          
                                            '<div class="form-actions">' +
                                            '<button class="button primary" name="spare_excell">UPLOAD FILE</button>&nbsp;'+
                                            
                                            '</div>'+
                                            '</form>';

                                    $.Dialog.title("SELECT EXCELL FILE");
                                    $.Dialog.content(content);
                                }

                            });
                        });
                    })
                </script>
                </body>
                </html>