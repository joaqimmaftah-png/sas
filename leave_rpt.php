<?php
//                    $yesterday = mktime(0,0,0,date("m"),date("d"),date("Y"));
//                    $Thisweek= date("d.m.Y", $yesterday);                   
//                     $yesterdays = mktime(0,0,0,date("m"),date("d")-7,date("Y"));
//                    $Thisweeks= date("d.m.Y", $yesterdays);
?>

<table>
            <tr>
              
                <td class="text-left">Number</td>
                <td class="text-left">startdate</td>
                <td class="text-left">enddate</td>             

            </tr>
       
            <?php
            include 'authorized/db.php';
            $tbl_attendence = mysql_query("SELECT * from tbl_leaves")or die(mysql_error());          
            while ($row = mysql_fetch_array($tbl_attendence)) {
                
           
      
                ?>
            <tr class="">
                <td><?php echo $row['emp_file_no'];?></td>
                <td class="right"><?php echo date('Ymd',strtotime($row['start_date']));?></td>
                <td class="right"><?php echo date('Ymd',strtotime($row['end_date']));?></td>
            
           

            </tr> 
            <?php }?>

        
    </table>


