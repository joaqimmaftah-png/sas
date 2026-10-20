<?php
require_once __DIR__ . '/../../mysql_compat.php';

 
  require_once('OLEwriter.php');
  require_once('BIFFwriter.php');
  require_once('Worksheet.php');
  require_once('Workbook.php');
  require_once('../db.php');
  


    function HeaderingExcel($filename) {
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
      }
	  
	  // HTTP headers
HeaderingExcel('vehicle_faults_report.xls');// Creating a workbook
$workbook = new excel("-");
// Creating the first worksheet
$worksheet1 =& $workbook->add_worksheet('Material_Job_Card');
$worksheet1->freeze_panes(1, 0);
  $worksheet1->set_column(0, 0, 25);
  $worksheet1->set_column(1, 1, 20);
  $worksheet1->set_column(1, 2, 20);
  $worksheet1->set_column(1, 3, 20);
  $worksheet1->set_column(1, 4, 20);
   $worksheet1->set_column(1, 5, 20);
   $worksheet1->set_column(1, 6, 20);
   $worksheet1->set_column(1, 7, 20);
   $worksheet1->set_column(1, 8, 20);
   $worksheet1->set_column(1, 9, 20);
   $worksheet1->set_column(1, 10, 20);
   $worksheet1->set_column(1, 11, 20);
   $worksheet1->set_column(1, 12, 20);
   

   $worksheet1->write_string(0,0,"DATE");
   $worksheet1->write_string(0,1,"REG#");
   $worksheet1->write_string(0,2,"SITE");
   $worksheet1->write_string(0,3,"TYPE");
   $worksheet1->write_string(0,4,"MODEL");
   $worksheet1->write_string(0,5,"DRIVER");
   $worksheet1->write_string(0,6,"PURPOSE");
   $worksheet1->write_string(0,7,"ITEM");
   $worksheet1->write_string(0,8,"UNIT");
   $worksheet1->write_string(0,9,"QUANTITY");
   $worksheet1->write_string(0,10,"PRICE");
   $worksheet1->write_string(0,11,"VAT STATUS");
   $worksheet1->write_string(0,12,"TOTAL/VEHICLE");
   
   
////////SELECT STATEMENT/////////
   $selectamounts=  mysql_query("SELECT * FROM tbl_faults_list") or die(mysql_error());
      
// get data and store in a json array
$j=0;
while ($LLow=mysql_fetch_array($selectamounts)) {
    $item=$LLow['fault_description'];
        $units=$LLow['units'];
        $quantity=$LLow['quantity'];
        $VTA_status=$LLow['VTA_status'];
        $price=$LLow['Amounts'];
        $fault_id=$LLow['fault_id'];
        
        
    $query = "SELECT DISTINCT vehicle_reg_num,fault_reported_date,purpose  FROM tbl_car_faults WHERE fault_id='$fault_id'";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    $rrow = mysql_fetch_array($resultT, MYSQL_ASSOC);
    $j=$j+1;
    $vehicle_reg_num=$rrow['vehicle_reg_num'];
    $fault_reported_date=$rrow['fault_reported_date'];
    $purpose=$rrow['purpose'];
      
    $queryy = "SELECT DISTINCT model FROM tbl_car_informations where vehicle_reg_num='$vehicle_reg_num'";
    $rows= mysql_query($queryy) or die("SQL Error 1: " . mysql_error());
    $row=mysql_fetch_array($rows);        
        $model=$row['model'];
        

      $selectdriverinfo=  mysql_query("SELECT DISTINCT vehicle_type,driver_name,vehicle_centre  FROM tbl_car_monitoring WHERE vehicle_reg_num='$vehicle_reg_num'") or die(mysql_error());
        $Low=mysql_fetch_array($selectdriverinfo);
        $vehicle_type=$Low['vehicle_type'];
        $driver_name=$Low['driver_name'];       
        $vehicle_centre=$Low['vehicle_centre']; 
        
        
       
	
			
				
			
			
			 $worksheet1->write_string($j,0,"$fault_reported_date");
			 $worksheet1->write_string($j,1,"$vehicle_reg_num");
			 $worksheet1->write_string($j,2,"$vehicle_centre");
			 $worksheet1->write_string($j,3,"$vehicle_type");
			 $worksheet1->write_string($j,4,"$model");
                         $worksheet1->write_string($j,5,"$driver_name");
                         $worksheet1->write_string($j,6,"$purpose");
			 $worksheet1->write_string($j,7,"$item");
			 $worksheet1->write_string($j,8,"$units");
			 $worksheet1->write_string($j,9,"$quantity");
			 $worksheet1->write_string($j,10,"$price");
                         $worksheet1->write_string($j,11,"$VTA_status");
                         $worksheet1->write_string($j,12,"$price");
	
			
		
			
			 
	}	
/////////////////  
$workbook->close();
?>