<?php

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

                $gtu=mysql_query("SELECT DISTINCT(Responsible) FROM tbl_action_list ORDER BY Responsible") or die(mysql_error());
            while ($ab = mysql_fetch_array($gtu)) {
                $emplid=$ab['Responsible'];
                $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emplid'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $addresses[] = $de['email'];
            }
        $too = implode(", ", $addresses);
 
                    $to ='nadhifa.omar@sincrositewatch.com,joaqim@sincrositewatch.com';
                    $subject = 'REPORT SUMMARY OPERATIONAL MONITORING SYSTEM';
                    $from ='sas@sincrositewatch.com';
                    $CC='nadhifa.omar@sincrositewatch.com,joaqim@sincrositewatch.com';
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
    $gtt3 = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible'") or die(mysql_error());
    $zotee = mysql_num_rows($gtt3);
////////////Total number of closed task////////
    $gttz = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND (Updatee='' OR Updatee='On Progress') AND reportdate>='$today'") or die(mysql_error());
    $funguliwa = mysql_num_rows($gttz);
////////////////////////////////////////////////////////////////////   
$malikmuda=mysql_query("SELECT * FROM tbl_action_list_report WHERE Execution_date<=reportdate AND Updatee='Closed' AND Responsible='$Responsible' ") or die(mysql_error());
$malizakwamuda=mysql_num_rows($malikmuda);
//////////////////////////////////////////////////////////////////// 
    $hkumalzakwamuda = mysql_query("SELECT * FROM tbl_action_list_report WHERE Responsible='$Responsible' ") or die(mysql_error());
    $T = mysql_num_rows($hkumalzakwamuda);
    $hmkmlzakmda=$T-$malizakwamuda;
////////////////////////////////////////////////////////////////////
     $gover = mysql_query("SELECT * FROM tbl_action_list WHERE Responsible='$Responsible' AND (Updatee='' OR Updatee='On Progress') AND reportdate<'$today'") or die(mysql_error());
    $overdue = mysql_num_rows($gover);
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
      
      ////////////////////////////////////////////////
      $closed=$malizakwamuda+$hmkmlzakmda;
      
                      $message.=' <tr>
                                <td class="product">'.$j++.'</td>
                                 <td class="product">'.$jinalake.'</td>
                                <td class="product">'.$zotee.'</td>
                                <td class="price">'.$funguliwa.'</td>
                                <td class="price">'.$closed.'</td>
                                <td class="price">'.$funguliwa.'</td>  
                                <td class="price">'.$overdue.'</td>
                                <td class="price">'.$suspended.'</td>                                  
                                <td class="product">'.$hmkmlzakmda.'</td>                                 
                                <td class="price">'. number_format((float)$overall, 2, '.', '').'%</td>
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

 /////////////////////////////////////////End of email//////////////////////////////////////////////////////////        
   
