<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Attendance Summary</title>  
        <style>
            table, tr,td,th{
                border: 1px solid black;
                border-collapse: collapse; 

            }
        </style>
    </head> 
    <body>

        <?php
require_once __DIR__ . '/mysql_compat.php';

        /*
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */
        $workdays = array();
        
        include 'authorized/db.php';
        $today = date('Ymd');
        $datez = '20191001';
        $date_end = '20191031';
        $month = date('m');
        $montname = date('M');
        $year = date('Y');
        $day_count = cal_days_in_month(CAL_GREGORIAN, $month, 2019);
        for ($i = 1; $i <= $day_count; $i++) {

            $date = $year . '/' . $month . '/' . $i; //format date
            $get_name = date('l', strtotime($date)); //get week day
            $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
            //if not a weekend add day to array
            if ($day_name != 'Sun' && $day_name != 'Sat') {
                $workdays[] = $i;
            }
        }
        ?>


        <table style="width:100%">
            <tr>
                <th>SN</th>
                <th>Name</th>

                <?php
                for ($i = 1; $i <= $day_count; $i++) {

                    $date = $year . '/' . $month . '/' . $i; //format date
                    $get_name = date('l', strtotime($date)); //get week day
                    $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
                    //if not a weekend add day to array
                    if ($day_name != 'Sun' && $day_name != 'Sat') {
                        ?>

                        <th><?php echo $i; ?></th>

        <?php
    }
}
?>
                <th>ACTUAL</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Ab/With</th>
                <th>Ab/Without</th>
                <th>Late</th>
                <th>Action</th>
            </tr>

<?php
$j = 1;
$selectemploy = mysql_query("SELECT DISTINCT(emp_file_no) FROM tbl_attendence WHERE reportdate>='20190701' AND reportdate<='20191231'") or die(mysql_error());
while ($rozee = mysql_fetch_array($selectemploy)) {
    $employee = $rozee['emp_file_no'];
    $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee' ORDER BY first_name ASC")or die(mysql_error());
    $majina = mysql_fetch_array($jina);
    $firstname = $majina['first_name'];
    $sirname = $majina['surname'];
     $result=mysql_query("SELECT count(*) as total from tbl_attendence where reportdate BETWEEN $datez AND $date_end and emp_file_no='$employee' and time_in!=''");
    $data=mysql_fetch_array($result);
    $present=$data['total'];
    
    $qnn = mysql_query("SELECT * FROM tbl_leaves WHERE  startdate<'$datez' AND enddate>'$datez'  AND emp_file_no='$employee' ");
    $roww = mysql_fetch_array($qnn);
    $startt=$roww['startdate'];
    if($startt==''){
       $leavezamwezihuu=0; // or your date as well
    }
    else{
$now=strtotime($datez); // or your date as well
$start=$roww['startdate'];
$your_date = strtotime($start);
$datediff = $now - $your_date;
$totaldate=round($datediff / (60 * 60 * 24));
// kutoka tarehe 1 mpaka sasa ni siku ngapi
$startz=strtotime($datez);
$enddate=strtotime($roww['enddate']);
$zamwezi_huu=$enddate - $your_date;
$leavekutokastartdateyareport=round($zamwezi_huu/ (60 * 60 * 24));
$leavezamwezihuu=($leavekutokastartdateyareport-$totaldate);

    }

                
//$now = time(); // or your date as well
//$your_date = strtotime($datez);
//$datediff = $now - $your_date;
//$totaldate=round($datediff / (60 * 60 * 24));
$leo=date('Y-m-d');
$datetime1 = new DateTime($datez);
$datetime2 = new DateTime($leo);
$interval = $datetime1->diff($datetime2);
$woweekends = 0;
for($i=0; $i<=$interval->d; $i++){
    $datetime1->modify('+1 day');
    $weekday = $datetime1->format('w');

    if($weekday !== "0" && $weekday !== "6"){ // 0 for Sunday and 6 for Saturday
        $woweekends++;  
    }

}
$sikuzakazi=$woweekends-1;
$absent=$sikuzakazi-$present;


//$qnz = mysql_query("SELECT * FROM tbl_leaves WHERE  startdate<='$formate_date' AND enddate>='$formate_date'  AND emp_file_no='$employee' ");
//            echo $numb_of_leave = mysql_num_rows($qnz);
                 
              // $totalworkday = count($workdays);
               
    ?>
                <tr>


                    <td><?php echo $j++; ?></td>
                    <td><?php echo$firstname . ' ' . $sirname ?></td>


    <?php
    for ($i = 1; $i <= $day_count; $i++) {

        $date = $year . '/' . $month . '/' . $i; //format date
        $get_name = date('l', strtotime($date)); //get week day
        $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
        //if not a weekend add day to array
        if ($day_name != 'Sun' && $day_name != 'Sat') {
            $today = date('Ymd');
            $formate_date = date('Ymd', strtotime($date));
            $selectattend = mysql_query("SELECT * FROM tbl_attendence WHERE reportdate='$formate_date' and emp_file_no='$employee'") or die(mysql_error());
            $attend = mysql_fetch_array($selectattend);
            $timein = $attend['time_in'];
            
            $onlive = '';
            
//////////////////////////////////////////////CHECK ON LIVE
            $fullname = strtoupper($firstname . " " . $sirname);
            $qnz = mysql_query("SELECT * FROM tbl_leaves WHERE  startdate<='$formate_date' AND enddate>='$formate_date'  AND emp_file_no='$employee' ");
            $rowa = mysql_fetch_array($qnz);
            $startdate=$rowa['startdate'];
            
             
            
          
            $leave_type=$rowa['leave_type'];

            if ($timein != '' AND $today >= $formate_date) {
                $tatus = 'P';
               
                
            } 
            elseif ($timein == '' AND $leave_type!='' AND $today >= $formate_date) {
                 
                     $tatus='L';
                     $dates[]='L';

                    
                     
                    
 
                             
            } elseif ($timein == '' AND $today >= $formate_date) {
                $tatus = 'A';
                
            } else {
                $tatus = '';
            }
            ?>
                    

                            <td><?php
                            echo $tatus;
                            ?></td>
                              
                            <?php
                        }
                    }
                    ?>


                    <td><?php echo $totalworkdays = count($workdays);?></td>
                    <td><?php echo $present;?></td> 
                    <td><?php echo $absent;?></td>
                    
                    <td>
                        
                            <?php
                           
    for ($i = 1; $i <= $day_count; $i++) {

        $date = $year . '/' . $month . '/' . $i; //format date
        $get_name = date('l', strtotime($date)); //get week day
        $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
        //if not a weekend add day to array
        if ($day_name != 'Sun' && $day_name != 'Sat') {
            $today = date('Ymd');
            $formate_date = date('Ymd', strtotime($date));
            $selectattend = mysql_query("SELECT * FROM tbl_attendence WHERE reportdate='$formate_date' and emp_file_no='$employee'") or die(mysql_error());
            $attend = mysql_fetch_array($selectattend);
            $timein = $attend['time_in'];
            
            $onlive = '';
            
//////////////////////////////////////////////CHECK ON LIVE
            $fullname = strtoupper($firstname . " " . $sirname);
            $qnz = mysql_query("SELECT * FROM tbl_leaves WHERE  startdate<='$formate_date' AND enddate>='$formate_date'  AND emp_file_no='$employee' ");
            $rowa = mysql_fetch_array($qnz);
            $startdate=$rowa['startdate'];
            
             
            
          
            $leave_type=$rowa['leave_type'];

          
            if ($timein == '' AND $leave_type!='' AND $today >= $formate_date) {
                echo $tatus='L';
                
            
               
      
            }
          
                        }
                    }
                     
                    ?>
                        
                        
                    </td>
                    <td>Smith</td> 
                    <td>50</td>
                    <td>50</td>
                </tr>
    <?php
}
?>
        </table>

    </body>
</html>
