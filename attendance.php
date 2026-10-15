<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        
        <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
    </head>
    <body>
     <div id="container" style="min-width: 310px; max-width: 800px; height: 1000px; margin: 0 auto"></div>   
        <?php
        /*
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */
        $workdays = array();
        include 'authorized/db.php';
        $datez = '20190901';
        $date_end = '20190930';
        $month = date('m');
        $montname=date('M');
        $year = date('Y');
        $day_count = cal_days_in_month(CAL_GREGORIAN,$month, 2019);
        for ($i = 1; $i <= $day_count; $i++) {

            $date = $year . '/' . $month . '/' . $i; //format date
            $get_name = date('l', strtotime($date)); //get week day
            $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars
            //if not a weekend add day to array
            if ($day_name != 'Sun' && $day_name != 'Sat') {
                $workdays[] = $i;
            }
        }

        $selectemploy = mysql_query("SELECT DISTINCT(emp_file_no) FROM tbl_attendence WHERE reportdate>='$datez' AND reportdate<='$date_end'") or die(mysql_error());
        while ($rozee = mysql_fetch_array($selectemploy)) {
            $employee = $rozee['emp_file_no'];
            $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee' ORDER BY first_name ASC")or die(mysql_error());
            $majina = mysql_fetch_array($jina);
            $firstname = $majina['first_name'];
            $sirname = $majina['surname'];
            $selectattend = mysql_query("SELECT * FROM tbl_attendence WHERE reportdate>'$datez' AND reportdate<'$date_end' and emp_file_no='$employee'") or die(mysql_error());
            $numrows = mysql_num_rows($selectattend);

            $selectattendlater = mysql_query("SELECT * FROM tbl_attendence WHERE reportdate>'$datez' AND reportdate<'$date_end' and emp_file_no='$employee' AND remark='YES'") or die(mysql_error());
            $numrowslatecomer = mysql_num_rows($selectattendlater);

            $fullname = strtoupper($firstname . " " . $sirname);
            $qnz = mysql_query("SELECT * FROM tbl_leaves WHERE  startdate>'$datez' AND enddate<'$date_end'  AND emp_file_no='$employee' ");
            $rowa = mysql_num_rows($qnz);

            $totalworkdays = count($workdays);
            $absent = $totalworkdays - ($numrows + $rowa);
            
            
            /////////////////////////graphh////////////////////
            $employeez[]="'.$fullname.'";
            $attendencearray[]=$numrows;
            $leavearray[]=$rowa;
            $absentarray[]=$absent;
            $late[]=$numrowslatecomer;
            ?>
    <?php
}
$employeezn=implode(",",$employeez);
$present= implode(",",$attendencearray);
$leave= implode(",",$leavearray);
$absent= implode(",",$absentarray);
$comer=  implode(",",$late);

?>
   
        
        <script>
            
Highcharts.chart('container', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'OVERALL ATTENDANCE SUMMARY FOR THE MONTH OF <?php echo $montname.' '.$year;?>'
  },
  subtitle: {
    text: 'Source: <a href="www.daimainfotech.com/sas/">Sincro Automation System</a>'
  },
  xAxis: {
    categories: [<?php echo $employeezn;?>],
    title: {
      text: null
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Working Days (exclude Weekend)',
      align: 'high'
    },
    labels: {
      overflow: 'Employee Name'
    }
  },
  tooltip: {
    valueSuffix: 'days'
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'top',
    x: -40,
    y: 80,
    floating: true,
    borderWidth: 1,
    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
    shadow: true
  },
  credits: {
    enabled: false
  },
  series: [{
    name: 'Present',
    data: [<?php echo $present;?>]
  }, {
    name: 'Leave with Justification',
    data: [<?php echo $leave;?>]
  }, {
    name: 'No Justification',
    data: [<?php echo $absent;?>]
  }, {
    name: 'Late',
    data: [<?php echo $comer;?>]
  }
  ]
});
        </script>

    </body>
</html>
