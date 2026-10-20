<!DOCTYPE html>
<html lang="en">
<head>
  <title>SINCRO ATTENDANCE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>OPERATIONAL MONITORING REPORT</h2>
  <p>Overall report</p>            
  <table class="table table-hover">
    <thead>
      <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Total Tasks</th>
                            <th>Open</th>
                           <th>Closed</th>                          
                           <th>Pending</th>
                            <th>Overdue</th>
                            <th>Suspended</th>
                            <th>Completed</th>
                            <th>Work Done(%)</th>
                         
                        </tr>
    </thead>
    <tbody>
        <?php
require_once __DIR__ . '/mysql_compat.php';

          include 'authorized/db.php';
$gtt=mysql_query("SELECT DISTINCT(Responsible) FROM tbl_action_list WHERE reportdate>20180530 ORDER BY Responsible") or die(mysql_error());
                      $today=date("Ymd");
                      $j=1;
                                                while($all=  mysql_fetch_array($gtt)){
                                                     $Responsible=$all['Responsible'];
         $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible' ORDER BY first_name") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
                $jinalake=$first_name.' '.$surname;
                
                /////////////////////////////number of pending task total number of pendind///////////////////////////////
    $gtt3 = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND reportdate>20180530") or die(mysql_error());
    $zotee = mysql_num_rows($gtt3);
////////////Total number of ZILIZOFUNGULIWA////////
    $gttz = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND Updatee='' AND reportdate>20180530") or die(mysql_error());
        $gttz2 = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND Updatee='On Progress' AND reportdate>20180530") or die(mysql_error());
   // $funguliwa = mysql_num_rows($gttz)+mysql_num_rows($gttz2);
    
////////////////////////////////////////////////////////////////////
    
    ////////////Total number ZILIZOFUNGWA////////
    $zfungwa = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND Updatee='Closed' AND reportdate>20180530") or die(mysql_error());
    $fungwa = mysql_num_rows($gttz)+mysql_num_rows($zfungwa);
    
    
     $funguliwa=$zotee-$fungwa;
////////////////////////////////////////////////////////////////////
$malikmuda=mysql_query("SELECT * FROM tbl_action_list_report WHERE Execution_date<=reportdate AND Updatee='Closed' AND Responsible='$Responsible'  AND reportdate>20180530") or die(mysql_error());
$malizakwamuda=mysql_num_rows($malikmuda);
//////////////////////////////////////////////////////////////////// 
    $hkumalzakwamuda = mysql_query("SELECT * FROM tbl_action_list_report WHERE Responsible='$Responsible'  AND reportdate>20180530 ") or die(mysql_error());
    $T = mysql_num_rows($hkumalzakwamuda);
    $hmkmlzakmda=$T-$malizakwamuda;
////////////////////////////////////////////////////////////////////
     $gover1 = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND Updatee='' AND reportdate<'$today' AND reportdate>20180530") or die(mysql_error());
    $gover2 = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND  Updatee='On Progress' AND reportdate<'$today' AND reportdate>20180530") or die(mysql_error());
    $overdue = mysql_num_rows($gover2)+mysql_num_rows($gover1);
//////////////////////////////Suspended////////////////////
     $susp = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND Updatee='Suspended' AND reportdate<'$today'") or die(mysql_error());
    $suspended = mysql_num_rows($susp);
//////////////////////////////////////////////////
      $kznzuri=$zotee-$funguliwa;
      if($kznzuri==0){
          $fpercent=1;
      $overall=$fpercent*100;
      }
 else {
       $fpercent=$malizakwamuda/$kznzuri;
      $overall=$fpercent*100;   
      } 
      $sum=0;
      //////////////////////////////Suspended////////////////////
     $update_n = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND reportdate>20180530") or die(mysql_error());
     while ($sn = mysql_fetch_array($update_n)) {
         $Responsible=$sn['Responsible'];
         $reportdate=$sn['reportdate'];
        $sni=$sn['sn'].'<br>';
          $hkumalzakwamuda = mysql_query("SELECT * FROM tbl_action_list_report WHERE Responsible='$Responsible'  AND reportdate=$reportdate AND sn='$sni' ") or die(mysql_error());
          $sum=mysql_num_rows($hkumalzakwamuda);
        
     }
//////////////////////////////////////////////////
      $total=+$sum;
      
      ////////////////////////////////////////////////
      $closed=$malizakwamuda+$hmkmlzakmda;
        ?>
      <tr>
        <td><?php echo $j++?></td>
        <td><?php echo $jinalake?></td>
        <td class="product"><?php echo $zotee;?></td>
        <td class="price"><?php echo $funguliwa;?></td>
        <td class="price"><?php echo $fungwa;?></td>
        <td class="price"><?php echo $funguliwa;?></td>  
        <td class="price"><?php  echo $overdue;?></td>
        <td class="price"><?php echo $suspended;?></td>                                  
        <td class="product"><?php echo $total;?></td>                                 
        <td class="price"></td>
      </tr>
      <?php
                                               }
      ?>
      
    </tbody>
  </table>
</div>

</body>
</html>