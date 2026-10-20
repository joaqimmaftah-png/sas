<?php
require_once __DIR__ . '/mysql_compat.php';


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
include 'authorized/db.php'; 

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
    $t1=  date("Y-m-d");
    
    $d1=date('Y-m-d',strtotime($E));
    $d2=date('Y-m-d',strtotime($t1));
    $date1=  strtotime($d1);
    $date2=  strtotime($d2);
    $n=($date2-$date1)/(60*60*24);
    
$days_betweenv =$n;
   
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

if($days_betweenv>=30){
          $topmanager='kibaya.erisania@sincrositewatch.com,nzaro.kimbute@sincrositewatch.com,pastory.hamaro@sincrositewatch.com,eva.mbawala@sincrositewatch.com';
          
}
 else {
     $topmanager='';
}
                 
                 
                 

                      
         $emailing =$owners;
                   $to =$too;
                    $subject = $Description_of_Finding;
                    $from ='sas@sincrositewatch.com';
                    $CC=$emailing.','.$topmanager.',nadhifa.omar@sincrositewatch.com,joaqim@sincrositewatch.com,latifa.titus@sincrositewatch.com,fortunatha.paul@sincrositewatch.com,noc_a@sincrositewatch.com';
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
                    $message .= '<p style="color:#f40;">*This script was design and developed by Joaqim John Maftah (2012-2014)</p>';
                    $message .= '</body></html>';
                    // Sending email
                    if (mail($to, $subject, $message, $headers)) {
 
                    } else {
                       
                    }
    
}
      }
}
 /////////////////////////////////////////End of email//////////////////////////////////////////////////////////        
        
 