<head>
    <style>
ol {
    padding: 20px; 
    list-style-type: disc;

}
ol li {
    float: left;
    margin: 0 10px;
    padding: 0 10px;
}
</style>
</head>

<?php
require_once __DIR__ . '/mysql_compat.php';



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

          include 'authorized/db.php';
$gtt=mysql_query("SELECT DISTINCT(reportdate) FROM  site_attendence WHERE reportdate>20181231 AND reportdate<20190701 ORDER BY reportdate") or die(mysql_error());
       //$too = implode(",", $addresses);
while($alls=  mysql_fetch_array($gtt)){   
$report_date=$alls['reportdate'];
    
//                 
//  
//     
//    $too = implode(", ", $addresses);

      ?>
<!--<ul>
    <li>-->
       <?php //echo $alls['reportdate']?>
      <ol>
          <?php
           $gttz=mysql_query("SELECT DISTINCT(att_id) FROM  site_attendence WHERE reportdate='$report_date' AND site_id=7  AND STR_TO_DATE(time_in, '%H:%i') >= '16:00'") or die(mysql_error()); 
          while($allz=  mysql_fetch_array($gttz)){   

          ?>
          <li>
            <?php echo $allz['att_id']?>  
          </li> 
          <?php
          }
          ?>
        </ol>
<!--    <li>

</ul>-->

<?php
  }
?>
                                                    
                                                