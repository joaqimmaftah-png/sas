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


echo 'joaqim';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

          include 'authorized/db.php';
$gtt=mysql_query("SELECT DISTINCT(reportdate) FROM  site_attendence WHERE reportdate>20200101 AND reportdate<20200314 ORDER BY reportdate") or die(mysql_error());
       //$too = implode(",", $addresses);
while($alls=  mysql_fetch_array($gtt)){   
$report_date=$alls['reportdate'];
    
?>
<table>
<tr>
    <td>
        <?php echo  date('d-m-Y', strtotime($report_date))?>
    </td>
    <tr>
</table>

<?php
  }
?>
                                                    
                                                