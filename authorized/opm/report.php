<br>
<div class="col-lg-12">
    <form action="" method="POST">
          <?php
        if($_SESSION['opm_sys']=='YES'){ 
            ?>
        <button type="submit" name="sending_notification" class="btn btn-success" style="color:white"><i class="fa fa-save"></i>&nbsp;Save Data</button>
        <button type="submit" name="summary_report" class="btn btn-success" style="color:white"><i class="fa fa-save"></i>&nbsp;Summary Report</button>
        <?php
        }else{
            
        }
        ?>
    </form>
</div>
<div class="col-lg-12">
    
    <?php
     include_once 'authorized/db.php';
            
             $today = getdate();
   $weekStartDate =$today['mday'] - $today['wday'].'.'.date('m.Y');
   $weekEndDate = ($today['mday'] - $today['wday']+6).'.'.date('m.Y');          
            $pus=mysql_query("SELECT * FROM tbl_action_list where Start_Date BETWEEN CAST('$weekStartDate' AS DATE) AND CAST('$weekEndDate' AS DATE);") or die(mysql_error());
            $yt=  mysql_num_rows($pus);
            
            $pust=mysql_query("SELECT DISTINCT opm_id FROM tbl_action_list where Start_Date BETWEEN CAST('$weekStartDate' AS DATE) AND CAST('$weekEndDate' AS DATE);") or die(mysql_error());
            $yts=  mysql_num_rows($pust);
            $persent1=$yts/100;
            
            $pust=mysql_query("SELECT DISTINCT opm_id FROM tbl_action_list where Updatee='Closed' AND Start_Date BETWEEN CAST('$weekStartDate' AS DATE) AND CAST('$weekEndDate' AS DATE);") or die(mysql_error());
            $tes=  mysql_num_rows($pust);
            $remains=$yt-$tes;
            $persent2=$remains*100/$yt;
    ?>
    
     <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Tasks Open Per Week</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">
          <div class="col-lg-12">
              <div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
    <?php echo $yt;?> Actions Opened this Week(<?php echo $kl=date("d M Y", strtotime($weekStartDate)).'-'.$kl=date("d M Y", strtotime($weekEndDate));?>) From <?php echo $yts;?> Findings
  </div>
</div>
               <div class="progress">
  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $persent1;?>%">
    <?php echo $tes;?> Complete
  </div>
</div>
              <div class="progress">
  <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $persent2;?>%">
    <?php echo $remains;?> Pending
  </div>
</div>
          </div>
          
          <div class="col-lg-12">
    <table id="home" class="table table-striped table-bordered" cellspacing="0"  >
        <thead>
            <tr>
                <th>sn</th>
                <th>Action</th>
                <th>Requirements</th>
                <th>Responsible</th>
                <th>Start</th> 
                <th>End</th>
                <th>Execution Date</th>
                <th>Status</th>
                
               
            </tr>
        </thead>
        <tbody>
            <?php
            include_once 'authorized/db.php';
            
             $today = getdate();
   $weekStartDate =$today['mday'] - $today['wday'].'.'.date('m.Y');
   $weekEndDate = ($today['mday'] - $today['wday']+6).'.'.date('m.Y');
            
            
            $pur=mysql_query("SELECT * FROM tbl_action_list") or die(mysql_error());
            $j=1;
            while ($row = mysql_fetch_array($pur)) {
                $Action = $row['Action'];
                $Requirements = $row['Requirements'];
                $sn= $row['sn'];
                $Execution_date= $row['Execution_date'];
                $End_Date= $row['End_Date'];
                $Start_Date= $row['Start_Date'];
                $Updatee= $row['Updatee'];
                $Responsible= $row['Responsible'];
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_namee = $rows['first_name'];
                $surnamee = $rows['surname'];
                
                $tbl_action_list_report=mysql_query("SELECT * FROM tbl_action_list_report WHERE sn='$sn'") or die(mysql_error());
                $sd=  mysql_fetch_array($tbl_action_list_report);
                $excution=$sd['Execution_date'];

                
                ?>
                <tr>
                    <td>
                        <a href=""><?php echo $j++; ?></a>
                    </td>
                    <td>
                        <a href=""><?php echo $Action; ?></a>
                    </td>
                    <td>
                        <a href=""><?php echo $Requirements; ?></a>
                    </td>
                    <td>
                        <?php echo $first_namee.' '.$surnamee; ?>
                    </td>
                    <td>
                        <?php echo $Start_Date; ?>
                    </td>
                    <td>
                        <?php echo $End_Date; ?>
                    </td>
                    <td>
                        <?php echo $excution; ?>
                    </td>
                     <td>
                        <?php echo $Updatee; ?>
                    </td>
                    
                   
                    
                </tr>
            <?php } ?>
        </tbody>

        
    </table>
</div>

      
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Task Open per Month</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Others</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
</div> 
</div>
   

<?php
if(isset($_POST['sending_notification'])){
    echo $_POST['sending_notification'];

/////////////////////////////////////////////////////////Emails config////////////////////////////////////////
              $css='<style>
    table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
table, th, td {
    border: 1px solid #f2f2f2;
}
</style>';
$todayw=  date("Ymd"); 
$tn = mysql_query("SELECT * FROM tbl_operational_monitor") or die(mysql_error());
while ($sq = mysql_fetch_array($tn)) {   
   $opm_id=$sq['opm_id'];    
      $gtt3=mysql_query("SELECT * FROM tbl_action_list WHERE  reportdate<'$todayw' AND opm_id='$opm_id' AND reportdate<>0 AND Updatee!='Closed' AND Updatee!='Suspended' ORDER BY reportdate LIMIT 1") or die(mysql_error());
      $nmb=mysql_num_rows($gtt3);
      while($nmc=mysql_fetch_array($gtt3)){
          $opm_ida=$nmc['opm_id'];
          $reportds=$nmc['reportdate'];
       $gtt4=mysql_query("SELECT * FROM tbl_action_list WHERE opm_id='$opm_ida' AND reportdate='$reportds' AND Updatee!='Closed' AND Updatee!='Suspended'") or die(mysql_error());
       while ($nm=mysql_fetch_array($gtt4)){     
      $Responsible=$nm['Responsible'];
   $Action=$nm['Action'];
   $opm_idzz=$nm['opm_id'];
    $reportdatez=$nm['reportdate'];
    $E=$nm['End_Date'];
    $sn=$nm['sn'];
    $todayy=  date("Ymd");
$days_betweenv = $todayw-$reportdatez;
   
 $en = mysql_query("SELECT * FROM tbl_operational_monitor where opm_id='$opm_idzz'") or die(mysql_error());
$low = mysql_fetch_array($en);
        $Description_of_Finding = $low['Description_of_Finding'];
                $key_owner = $low['key_owner'];
                $opm_idz = $low['opm_id'];
                
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
                $jinalake=$first_name.' '.$surname;
                
                $ts = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $rowss = mysql_fetch_array($ts);
                $fu = $rowss['first_name'];

                $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$Responsible'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                $too = $de['email'];
                $su=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$key_owner'") or die(mysql_error());
                $deu=  mysql_fetch_array($su);
                 $owners = $deu['email'];


          if($days_betweenv>5){
           $topmanager="";
          }
          else{
          $topmanager='';
          }
                      
          $emailing = $too;
                   $to = $emailing.','.$owners;
                    $subject = $Description_of_Finding;
                    $from ='sas@sincrositewatch.com';
                    $CC='';
                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Create email headers
                    $headers .= 'From: ' . $from . "\r\n" .
                            'Reply-To: ' . $from . "\r\n" .
                            'CC: ' . $CC. "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                    // Compose a simple HTML email message
                    $message = '<html>';
                    $message.='<body>';
                    $message.='<head>';
                    $message.=$css;
                    $message.='</head>';
                    $message .= '<p style="text-bold;">Dear '.$fu.',</p>';
                    $message .= '<p style=""> You holding our task element of '.$Action.' from  '.$Description_of_Finding.' open by '.$jinalake.' for '.$days_betweenv.' days.Please <a href="http://www.daimainfotech.com/sas/">Click this link to Update your task(s)</a></p>'; 
                                        $message .='<table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>sn</th>
                            <th>Action</th>
                            <th>Requirements</th>                            
                            <th>Responsible</th>
                            <th>Start</th> 
                            <th>Finish</th>  
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody>';
                       $pur=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_idz'") or die(mysql_error());
            $j=1;
            while ($QW = mysql_fetch_array($pur)) {
                $Action = $QW['Action'];
                $Requirements = $QW['Requirements'];
                $sn= $QW['sn'];               
                $End_Date= $QW['End_Date'];
                $Start_Date= $QW['Start_Date'];                
                $Responsible= $QW['Responsible'];
                $Updatee= $QW['Updatee'];
                $tbl_customerz = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $re = mysql_fetch_array($tbl_customerz);
                $first_namee = $re['first_name'];
                $surnamee = $re['surname'];
                $yu=$first_namee.' '.$surnamee;
                      $message.=' <tr>
                                <td class="product">'.$j++.'</td>
                                    <td class="product">'.$Action.'</td>
                                <td class="price">'.$Requirements.'</td>
                                <td class="price">'.$yu.'</td>
                                <td class="product">'.$Start_Date.'</td> 
                                <td class="price">'.$End_Date.'</td>  
                                    <td class="price">'.$Updatee.'</td> 
                            </tr>';
  }
     $message .= '</tbody>
                </table>';
                    $message .= '<p style="">Regards,<br>sas(Sincro Automation System)</p>';
                    $message .= '<p style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</p>';
                    $message .= '<p style="color:#f40;">*This script was design and developed by Joaqim John Maftah (2012-2014) from University of Dododma</p>';
                    $message .= '</body></html>';
                    // Sending email
                    if (mail($to, $subject, $message, $headers)) {
 
                    } else {
                       
                    }
    
}
      }
}
 /////////////////////////////////////////End of email//////////////////////////////////////////////////////////        
        
  } 
  
  
  
  
  if(isset($_POST['summary_report'])){
    
    /////////////////////////////////////////////////////////Emails config////////////////////////////////////////
              $css='<style>
    table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
table, th, td {
    border: 1px solid #f2f2f2;
}
</style>';

                $gtu=mysql_query("SELECT DISTINCT(Responsible) FROM tbl_action_list ORDER BY Responsible") or die(mysql_error());
            while ($ab = mysql_fetch_array($gtu)) {
                $emplid=$ab['Responsible'];
                $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emplid'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $addresses[] = $de['email'];
            }
         $too = implode(", ", $addresses);
 
                    $to ='joaqim@sincrositewatch.com';
                    $subject = 'Report Summary Operational Monitoring';
                    $from ='sas@sincrositewatch.com';
                    $CC='';
                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Create email headers
                    $headers .= 'From: ' . $from . "\r\n" .
                            'Reply-To: ' . $from . "\r\n" .
                            'CC: ' . $CC. "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                    // Compose a simple HTML email message
                    $message = '<html>';
                    $message.='<body>';
                    $message.='<head>';
                    $message.=$css;
                    $message.='</head>';
                    $message .= '<p style="text-bold;">Dear team,</p>';
                    $message .= '<p style=""> Kindly find summary report for our Operational Monitoring System.<br><span style="text-bold;color:#f40">*Make sure to contact with task owner for Suspended Task.will count in your overall perfomance</span></p>'; 
                                        $message .='<table class="table cart table-bordered">
                    <thead>
                         <tr>
                         <th>No.</th>
                            <th>Employee Name</th>
                            <th>Total# of Task</th>
                            <th># of Task Open</th>
                            <th># of Task Complete In Time</th>                            
                            <th># of Task Not Complete In Time</th>                             
                            <th># Of Task Overdue Finish date</th>  
                            <th>Performance Overall</th> 
                        </tr>
                    </thead>
                    <tbody>';
                      $gtt=mysql_query("SELECT DISTINCT(Responsible) FROM tbl_action_list ORDER BY Responsible") or die(mysql_error());
                      $today=date("Ymd");
                                                while($all=  mysql_fetch_array($gtt)){
         $Responsible=$all['Responsible'];
         $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible' ORDER BY first_name") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
                $jinalake=$first_name.' '.$surname;

/////////////////////////////number of pending task total number of pendind///////////////////////////////
      $gtt3=mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible'") or die(mysql_error());
      $zotee=mysql_num_rows($gtt3);
////////////Total number of closed task////////
$gttz=mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND (Updatee='' OR Updatee='On Progress') AND reportdate>='$today'") or die(mysql_error());
      $funguliwa=mysql_num_rows($gttz);              
////////////////////////////////////////////////////////////////////   
      
      ////////////Total number of closed task////////
$gttover=mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND Updatee!='Closed' AND Updatee!='Suspended' AND reportdate<'$today'") or die(mysql_error());
      $imepitilizasiku=mysql_num_rows($gttover);              
//////////////////////////////////////////////////////////////////// 
$malikmuda=mysql_query("SELECT a.sn,b.sn,a.snd,a.dates,b.End_Date,b.Responsible,b.Updatee FROM  tbl_action_update a,tbl_action_list b WHERE a.sn=b.sn AND b.Responsible='$Responsible' AND b.Updatee='Closed' AND a.dates=b.End_Date ORDER BY a.snd DESC") or die(mysql_error());
      $malizakwamuda=mysql_num_rows($malikmuda);              
//////////////////////////////////////////////////////////////////// 
$hkumalzakwamuda=mysql_query("SELECT a.sn,b.sn,a.snd,a.dates,b.End_Date,b.Responsible,b.Updatee FROM  tbl_action_update a,tbl_action_list b WHERE a.sn=b.sn AND b.Responsible='$Responsible' AND b.Updatee='Closed' AND a.dates<>b.End_Date ORDER BY a.snd DESC") or die(mysql_error());
      $hmkmlzakmda=mysql_num_rows($hkumalzakwamuda);              
////////////////////////////////////////////////////////////////////
      $kznzuri=$zotee-$funguliwa;
      if($kznzuri==0){
          $fpercent=1;
      $overall=$fpercent*100;
      }
 else {
       $fpercent=$malizakwamuda/$kznzuri;
      $overall=$fpercent*100;   
      } 
                      $message.=' <tr>
                                <td class="product">'.$j++.'</td>
                                    <td class="product">'.$jinalake.'</td>
                                <td class="product">'.$zotee.'</td>
                                <td class="price">'.$funguliwa.'</td>
                                <td class="price">'.$malizakwamuda.'</td>
                                <td class="product">'.$hmkmlzakmda.'</td> 
                                <td class="price">'.$imepitilizasiku.'</td>  
                                <td class="price">'. number_format((float)$overall, 2, '.', '').'%</td>
                            </tr>';
  }
     $message .= '</tbody>
                </table>';
                    $message .= '<p style="">Regards,<br>sas(Sincro Automation System)</p>';
                    $message .= '<p style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</p>';
                    $message .= '<p style="color:#f40;">*This script was design and developed by Joaqim John Maftah (2012-2014) from University of Dododma</p>';
                    $message .= '</body></html>';
                    // Sending email
                    if (mail($to, $subject, $message, $headers)) {
 
                    } else {
                       
                    }

 /////////////////////////////////////////End of email//////////////////////////////////////////////////////////        
   
} 
?>