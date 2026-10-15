<?php
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
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true); //HIZNI COLUMN
    $counter = count($sheetData);
        for ($i = 2; $i <= $counter; $i++) {//TUNAANZA NA ROW YA PILI KUCHUKUA DATA ZETU
           $vehicle_reg_num=$vehicle_type=$owner=$driver_name=$driver_contact=$vehicle_centre=$fault_description=
           $fault_reported_date=$date_reported_accounts=$overlapped_days=$operation_conditions=$planned_resolution_date=
           $actual_resolution_date=$reasons_remark=$status="";
                    
        $vehicle_reg_num =mysql_escape_string($sheetData[$i]['A']);
        $vehicle_type =$sheetData[$i]['B'];
        $owner=$sheetData[$i]['C'];
        $driver_name = $sheetData[$i]['D']; 
        $driver_contact = $sheetData[$i]['E'];       
        $vehicle_centre=$sheetData[$i]['F'];        
        $fault_description=$sheetData[$i]['G'];        
        $fault_reported_date=$sheetData[$i]['H'];
        $date_reported_accounts=$sheetData[$i]['I'];      
        $overlapped_days=$sheetData[$i]['J'];
        $operation_conditions=$sheetData[$i]['K'];        
        $planned_resolution_date =$sheetData[$i]['L'];
        $actual_resolution_date=$sheetData[$i]['M'];       
        $reasons_remark=$sheetData[$i]['O'];
        $status=$sheetData[$i]['N'];
        $sparepart="INSERT INTO tbl_car_monitoring(vehicle_reg_num,vehicle_type,owner,driver_name,driver_contact,vehicle_centre)"
        . "VALUES('$vehicle_reg_num','$vehicle_type','$owner','$driver_name','$driver_contact','$vehicle_centre')";
         mysql_query($sparepart) or die(mysql_error());
         $faults=  mysql_query("INSERT INTO tbl_car_faults(vehicle_reg_num,fault_description,fault_reported_date,date_reported_accounts,overlapped_days,"
                . "operation_conditions,planned_resolution_date,actual_resolution_date,reasons_remark,status)"
                 . "VALUES('$vehicle_reg_num','$fault_description','$fault_reported_date','$date_reported_accounts','$overlapped_days','$operation_conditions','$planned_resolution_date','$actual_resolution_date','$reasons_remark','$status')") or die(mysql_error());
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