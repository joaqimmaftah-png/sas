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
HeaderingExcel('Weekly Report.xls');// Creating a workbook
$workbook = new excel("-");
// Creating the first worksheet
$worksheet1 =& $workbook->add_worksheet('weekly Report sincrositewatch');
$worksheet1->freeze_panes(1, 0);
  $worksheet1->set_column(0, 0, 25);
  $worksheet1->set_column(1, 1, 20);
  $worksheet1->set_column(1, 2, 20);
  $worksheet1->set_column(1, 3, 20);
  $worksheet1->set_column(1, 4, 20);
   $worksheet1->set_column(1, 5, 20);
    










   $worksheet1->write_string(0,0,"Employee ID");
   $worksheet1->write_string(0,1,"Employee Name");
   $worksheet1->write_string(0,2,"Contracted Hours");
   $worksheet1->write_string(0,3,"Attended Hours");
   $worksheet1->write_string(0,4,"%Presence");
   $worksheet1->write_string(0,5,"Overtime Hours");
   

 






/////////////////
	
                    $yesterday = mktime(0,0,0,date("m"),date("d"),date("Y"));
                    $Thisweek= date("d.m.Y", $yesterday);                   
                     $yesterdays = mktime(0,0,0,date("m"),date("d")-7,date("Y"));
                    $Thisweeks= date("d.m.Y", $yesterdays);
	$qryreport = mysql_query("SELECT SUM(time_spend),date1,emp_file_no,time_set FROM tbl_attendence where date1 >='$Thisweeks' AND date1 <='$Thisweek'  GROUP BY emp_file_no")or die(mysql_error()); 
	
	$sqlrows=mysql_num_rows($qryreport);
	$j=0;
	
	WHILE ($reportdisp=mysql_fetch_array($qryreport)) { 
//            $id=$reportdisp['member_id'];
	$j=$j+1;
                    
                $time_set = $reportdisp['time_set']*7;               
                $date1 = $reportdisp['date1'];           
                $emp_file_no = $reportdisp['emp_file_no'];
                $total_hour=$reportdisp['SUM(time_spend)'];
                $overtime=$total_hour-$time_set;
                $persent1=($total_hour/$time_set)*100;
                $persent=  round($persent1,0)."%";
                if($overtime>=0){
                  $overtime=$total_hour-$time_set;
                  $color="";
                }
               else {
                   $overtime=$total_hour-$time_set;
                  $color="bg-red";
               }
                $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no' ")or die(mysql_error());
                $majina = mysql_fetch_array($jina);
                $firstname = $majina['first_name'];
                $sirname = $majina['surname'];
                $fullname = $firstname . " " . $sirname;

			
			
			
				
			
			
			 $worksheet1->write_string($j,0,"$emp_file_no");
			 $worksheet1->write_string($j,1,"$fullname");
			 $worksheet1->write_string($j,2,"$time_set");
			 $worksheet1->write_string($j,3,"$total_hour");
			 $worksheet1->write_string($j,4,"$persent");
                         $worksheet1->write_string($j,5,"$overtime");
	
			
		
			
			 
	}	
/////////////////  
$workbook->close();
?>