       
    <table style="width:100%">
  <tr>
    <td>stock</td>
    <td>Descr</td> 
    <td>Date</td>
    <td>qun</td>
  </tr>  
       
       
        <?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once '../db.php';
$selet=  mysql_query("SELECT * FROM db1") or die(mysql_error());
$re=mysql_num_rows($selet);

while ($ree=mysql_fetch_array($selet)){
    
    
           $stock=$ree['stock'];
            $descr=mysql_real_escape_string($ree['descr']);
             $date=mysql_real_escape_string($ree['date']);
              $qun=$ree['qun'];
                 $selet1=  mysql_query("SELECT * FROM db3 where stock<>'$stock' AND descr<>'$descr' AND date<>'$date' AND qun<>'$qun'") or die(mysql_error());  
              $reV=mysql_fetch_array($selet1);
              $stock1=$reV['stock'];
            $descr1=$reV['descr'];
             $date1=$reV['date'];
              $qun1=$reV['qun'];
         
   ?>

  <tr>
    <td><?php echo $stock1?></td>
    <td><?php echo $descr1?></td> 
    <td><?php echo $date1?></td>
    <td><?php echo $qun1?></td>
  </tr>
 


<?php
}
?>
</table>