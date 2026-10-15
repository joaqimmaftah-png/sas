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
HeaderingExcel('licence.xls');// Creating a workbook
$workbook = new excel("-");
// Creating the first worksheet
$worksheet1 =& $workbook->add_worksheet('Licence Report');
$worksheet1->freeze_panes(1, 0);
  $worksheet1->set_column(0, 0, 25);
  $worksheet1->set_column(1, 1, 20);
  $worksheet1->set_column(1, 2, 20);
  $worksheet1->set_column(1, 3, 20);
  $worksheet1->set_column(1, 4, 20);
  $worksheet1->set_column(1, 5, 20);
  $worksheet1->set_column(1, 6, 20);

 


     $worksheet1->write_string(0,0,"Vehicle Registration#");
   $worksheet1->write_string(0,1,"Make");
   $worksheet1->write_string(0,2,"Model");
   $worksheet1->write_string(0,3,"Body Type");
   $worksheet1->write_string(0,4,"Color");
   $worksheet1->write_string(0,5,"Previous Renew Date");
   $worksheet1->write_string(0,6,"Next Renew Date");


/////////////////
	
        //$edate=$_POST['edate'];
        //$sdate=$_POST['sdate'];
	$select_from_service=mysql_query("SELECT * FROM tbl_car_licence") or die(mysql_error());
	$j=0;	
	WHILE ($rows= mysql_fetch_array($select_from_service)) { 
	           $j=$j+1;
 $vehicle_reg_numm=$rows['vehicle_reg_num'];
    $query = "SELECT * FROM tbl_car_informations WHERE vehicle_reg_num='$vehicle_reg_numm'";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    $rrow= mysql_fetch_array($resultT);     
        $vehicle_reg_num=$rrow['vehicle_reg_num'];
        $make=$rrow['make'];
        $model=$rrow['model'];
        $body_type=$rrow['body_type']; 
        $color=$rrow['color'];       
        $preview_renew_date=$rows['preview_renew_date'];      
        $next_renew_date=$rows['next_renew_date'];
	
			 $worksheet1->write_string($j,0,"$vehicle_reg_num");
			 $worksheet1->write_string($j,1,"$make");
			 $worksheet1->write_string($j,2,"$model");
			 $worksheet1->write_string($j,3,"$body_type");
			 $worksheet1->write_string($j,4,"$color");
                         $worksheet1->write_string($j,5,"$preview_renew_date");
                         $worksheet1->write_string($j,6,"$next_renew_date");
			 
	}
	
/////////////////

$workbook->close();
?>