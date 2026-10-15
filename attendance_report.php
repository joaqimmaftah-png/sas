<?php
                    $yesterday = mktime(0,0,0,date("m"),date("d"),date("Y"));
                    $Thisweek= date("d.m.Y", $yesterday);                   
                    $yesterdays = mktime(0,0,0,date("m"),date("d")-7,date("Y"));
                    $Thisweeks= date("d.m.Y", $yesterdays);
?>
<div class="shadow" style=" height: 30px; width: 100%; background-color: #60A917; border:1px #60A917 solid; color:white;">

    <form method="POST" action="authorized/excell/excel.php">
        <input type="hidden" name="id_excel" value="<?php echo $id_excel; ?>">
        <button  class="btn btn-success" name="excel">Download Excel File</button>
    </form>                                

</div>
<div class="margin5"> 
    <a href="attendance_report.php"></a>
    <div class="shadow" style=" height: 30px; width: 40%; background-color: #60A917; border:1px #60A917 solid; color:white;">
        Week Report <button class="primary">                                   
            <?php echo $Thisweeks ;?>                               
        </button>
        <button class="">                                   
            -                                
        </button>
        <button class="primary">

            <?php echo $Thisweek ;?>                                   
        </button>
    </div>


    <table id="example" class="display  striped bordered table hovered" width="100%" cellspacing="0">
        <thead>
            <tr class="info">
                <th class="text-left">Employee ID</th>
                <th class="text-left">Employee Name</th>
                <th class="text-left">Contracted Hours</th>
                <th class="text-left">Attended Hours</th>
                <th class="text-left">% Presence</th>
                <th class="text-left">Overtime Hours</th>                                                 
                <th class="text-left">Action</th>



            </tr>
        </thead>

        <tbody>
            <?php

            $tbl_attendence = mysql_query("SELECT SUM(time_spend),date1,emp_file_no,time_set FROM tbl_attendence where date1 >='$Thisweeks' AND date1 <='$Thisweek'  GROUP BY emp_file_no")or die(mysql_error());          
            while ($row = mysql_fetch_array($tbl_attendence)) {
                $time_set = $row['time_set']*7;               
                $date1 = $row['date1'];           
                $emp_file_no = $row['emp_file_no'];
                $total_hour=$row['SUM(time_spend)'];
                $overtime=$total_hour-$time_set;
                $persent1=($total_hour/$time_set)*100;
                $persent=  round($persent1,0);
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
                ?>
            <tr class="">
                <td><?php echo $emp_file_no;?></td>
                <td class="right"><?php echo $fullname;?></td>
                <td class="right"><?php echo $time_set;?></td>
                <td class="right"><?php echo $row['SUM(time_spend)'];?></td>
                <td class="right"><?php echo $persent;echo '%';?></td>                   
                <td class="right <?php echo $color;?>"><?php echo $overtime;?></td>
                <td class="right"><a href="">views</a></td>

            </tr> 
            <?php }?>

        </tbody>
    </table>
</div>

