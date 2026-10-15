<?php
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
HeaderingExcel('fuel.xls');// Creating a workbook
$workbook = new excel("-");
// Creating the first worksheet
$worksheet1 =& $workbook->add_worksheet('Fuel Issued Report');
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
 


     $worksheet1->write_string(0,0,"Vehicle Registration#");
   $worksheet1->write_string(0,1,"Issue Date");
   $worksheet1->write_string(0,2,"Amounts");
   $worksheet1->write_string(0,3,"SN");
   $worksheet1->write_string(0,4,"Driver Name");
   $worksheet1->write_string(0,5,"Driver Number");
   $worksheet1->write_string(0,6,"Driver Team");
   $worksheet1->write_string(0,7,"Driver Location");
   $worksheet1->write_string(0,8,"Vendor");
   $worksheet1->write_string(0,9,"Vendor Number");

/////////////////
	
        //$edate=$_POST['edate'];
        //$sdate=$_POST['sdate'];
	$qryreport = mysql_query("SELECT * FROM tbl_fuel_vehicle_list") or die(mysql_error());
	
	$sqlrows=mysql_num_rows($qryreport);
	$j=0;
       
	
	WHILE ($reportdisp=mysql_fetch_array($qryreport)) { 
                   $vehicle_id=$reportdisp['vehicle_id'];
                   $order_number=$reportdisp['order_number'];
	           $j=$j+1;
                    
                    $queryy = "SELECT * FROM tbl_fuel_vehicles where vehicle_id='$vehicle_id'";
                    $rows= mysql_query($queryy) or die("SQL Error 1: " . mysql_error());
                    $row=mysql_fetch_array($rows);
                    $fuel_balance=$row['fuel_balance'];
                    $vehicle_reg_num=$row['vehicle_reg_num'];
                    $vendor=$row['vendor'];
                    $vendor_number=$row['vendor_number'];
                    $driver=$row['driver'];
                    $driver_phone_num=$row['driver_phone_num'];
                    $team=$row['team'];
                    $locations=$row['locations'];
                    $issued_amount=$reportdisp['issued_amount'];
                    $issued_date=$reportdisp['issued_date'];
		
			 $worksheet1->write_string($j,0,"$vehicle_reg_num");
			 $worksheet1->write_string($j,1,"$issued_date");
			 $worksheet1->write_string($j,2,"$issued_amount");
			 $worksheet1->write_string($j,3,"$order_number");
			 $worksheet1->write_string($j,4,"$driver");
                         $worksheet1->write_string($j,5,"$driver_phone_num");
                         $worksheet1->write_string($j,6,"$team");
                         $worksheet1->write_string($j,7,"$locations");
                         $worksheet1->write_string($j,8,"$vendor");
                         $worksheet1->write_string($j,9,"$vendor_number");
	
			
		
			
			 
	}
	
	
	
/////////////////
  
  

  
$workbook->close();
?>