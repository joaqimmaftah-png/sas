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

                $gtu=mysql_query("SELECT DISTINCT(emp_file_no) FROM tbl_attendence") or die(mysql_error());
            while ($ab = mysql_fetch_array($gtu)) {
                $emplid=$ab['emp_file_no'];
                $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emplid'") or die(mysql_error());
                $de=  mysql_fetch_array($se);
                 $addresses[] = $de['email'];
            }
        $too = implode(", ", $addresses);
 
                    $to = 'joaqim@sincrositewatch.com';
                    $subject = 'WEEKLY ATTENDENCE REPORT';
                    $from ='sas@sincrositewatch.com';
                    $CC='joaqim@sincrositewatch.com';
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
                    $message .= '<p style=""> Kindly find summary report for weekly attendence.<br><span style="text-bold;color:#f40;font-size: 14px;">*P=PRESENT; U=UNEXCUSED; E=EXCUSED; L=LEAVE;</span></p>'; 
                    
                    $message.='<table class="table cart table-bordered" style="font-size:13px">
 <caption>WEEKLY ATTENDENCE REPORT</caption>
 <tr>
     <th rowspan="2" style="text-align: center;">No</th>
      <th rowspan="2" style="text-align: center;">Employee</th>';
      $date = date("05/29/2017");
// parse about any English textual datetime description into a Unix timestamp 
$ts = strtotime($date);
// find the year (ISO-8601 year number) and the current week
$year = date('o', $ts);
$week = date('W', $ts);
// print week for the current date
for($i = 1; $i <= 5; $i++) {
    $ts = strtotime($year.'W'.$week.$i);
    $juma= date("l", $ts);
    $tareh= date("d/m/Y", $ts);
    $treport=date("Ymd", $ts);
    $message .= '<th colspan="5" style="text-align: center;">'.$juma.'('.$tareh.')'.'</th>'; 
}
$message.='<th  rowspan="2" style="text-align: center;">Percent</th>
     
 </tr>
 <tr>
     <th>P</th> 
  <th>U</th>
  <th>E</th>
  <th>L</th>
   <th>TO</th>
   
    <th>P</th>
  <th>U</th>
  <th>E</th>
  <th>L</th>
    <th>TO</th>
    
    <th>P</th>  
  <th>U</th>
  <th>E</th>
  <th>L</th>
    <th>TO</th>
    
    <th>P</th>
  <th>U</th>
  <th>E</th>
  <th>L</th>
    <th>TO</th>
    
    <th>P</th>
  <th>U</th>
  <th>E</th>
  <th>L</th>
    <th>TO</th>
  


 </tr>';
$datez='20200101';
$selectemploy=  mysql_query("SELECT DISTINCT(emp_file_no) FROM tbl_attendence WHERE reportdate>=20200101") or die(mysql_error());
 $ju=1;
 while ($rozee=  mysql_fetch_array($selectemploy)){
     $employee=$rozee['emp_file_no'];
      $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee' ORDER BY first_name ASC")or die(mysql_error());
    $majina = mysql_fetch_array($jina);
    $firstname = $majina['first_name'];
    $sirname = $majina['surname'];
    $fullname = $firstname . " " . $sirname;
        
$message .= '<tr>    
     <td>'.$ju++.'</td>
     <td>'.$fullname.'</td>';
 $date = date("01/01/2020");
// parse about any English textual datetime description into a Unix timestamp 
$ts = strtotime($date);
// find the year (ISO-8601 year number) and the current week
$year = date('o', $ts);
$week = date('W', $ts);
for($i = 1; $i <= 5; $i++) {
    $ts = strtotime($year.'W'.$week.$i);
    $treport=date("Ymd", $ts);
    $qn=  mysql_query("SELECT * FROM tbl_attendence WHERE reportdate='$treport' AND emp_file_no='$employee'");
    $row=  mysql_fetch_array($qn);
    $mudaalioingia=$row['time_in'];
     $kutoka=$row['time_out'];
    $notification = $row['notification'];
    $qnz=  mysql_query("SELECT * FROM tbl_leaves WHERE enddate>='$treport' AND startdate<='$treport'  AND emp_file_no='$employee' AND hod_status='Approved' AND fs_status='Approved' AND hrm_status='Approved'");
    $rowa= mysql_num_rows($qnz);

    
      
    if($notification=='bg-green'){
        $P=$mudaalioingia;
        $T='';
        $bg="background-color:#90EE90;";
        $br='';
        $likizo='';
        $excused='';
        $uexcused='';
        $uexcuseds='';
        $excuseds='';
        $yupolikizo='';
        $marks1=100;

        
    }
    elseif ($notification=='bg-red') {
        $P='';
        $T=$mudaalioingia;
        $bg='';
        $br="background-color:Coral;";
        $likizo='';
        $excused='';
        $uexcused='';
        $uexcuseds='';
        $excuseds='';
        $yupolikizo='';
        $check=explode(':', $mudaalioingia);
        $mudas=$check[0].$check[1];
        $marks1=50;

        
       
}
elseif($mudaalioingia=='00:00' AND $kutoka=='00:00'){
      $P='';
        $T='';
        $bg='';
        $br='';
        $yupolikizo='';
        $likizo='';
        $excused="background-color:#FF9F66;";
        $excuseds='&#10004;';
        $uexcused='';
        $uexcuseds='';
        $marks1=100;

 }
    else{
        $P='';
        $T='';
        $bg='';
        $br='';
        $yupolikizo='';
        $likizo='';
        $excused='';
        $uexcused="background-color:red;";
        $uexcuseds='&#10004;';
        $excuseds='';
        
        $marks1=0;

    }
    
   if($rowa==1){
      $P='';
        $T='';
        $bg='';
        $br='';
        $yupolikizo="&#10004;";
        $likizo="background-color:#FF9F66;";
        $excused="";
        $excuseds='';
        $uexcused='';
        $uexcuseds='';

 }
if(!empty($P)){
   $message.='<td style='."$bg".'>'.$P.'</td> '; 
}   
else {
    $message.='<td style='."$br".'>'.$T.'</td>'; 
}
$message.='<td style='."$uexcused".'>'.$uexcuseds.'</td>
<td style='."$excused".'>'.$excuseds.'</td>
  <td style='."$likizo".'>'.$yupolikizo.'</td>
   <td style='."background-color:DeepSkyBlue".'>'.$kutoka.'</td>';
}

 $treporte=strtotime($year.'W'.$week.'1');
    $treportes=strtotime($year.'W'.$week.'5');
    $tq1=date("Ymd", $treporte);
    $tq2=date("Ymd", $treportes);
    $qncf=mysql_query("SELECT SUM(percent) FROM tbl_attendence WHERE reportdate>='$tq1' AND reportdate<='$tq2' AND emp_file_no='$employee'");
    $rowz=mysql_fetch_array($qncf);
    $sumn=$rowz['SUM(percent)'];
    
    $qnz=  mysql_query("SELECT * FROM tbl_leaves WHERE enddate>='$tq1' AND startdate<='$tq2'  AND emp_file_no='$employee' AND hod_status='Approved' AND fs_status='Approved' AND hrm_status='Approved'");
    $rowaa= mysql_num_rows($qnz);
    if($rowaa>0){
       $jumla=500-$sumn; 
    }
 else {
      $jumla=$rowa*0; 
    }
    $tres=$sumn+$jumla;
    $perce=($tres/5)."%";

$message.='<td>'.$perce.'</td>
 </tr>';
 }
 $message.='</table>';
 $message .= '<p style="font-size:14px;"> POINT SUMMARY.<br><span style="text-bold;color:#f40;font-size: 14px;">100%=TIME IN<08:10;<br>50% = TIME IN >08:10;<br>0% =U= UNEXCUSED;<br>100% = E=EXCUSED;<br>100% =L=LEAVE;</span></p>';
                    $message .= '<p style="">Regards,<br>sas(Sincro Automation System)</p>';
                    $message .= '<p style="color:#f40;">NOTE: This Email has been sent automatic from SAS (Sincro Automation System).</p>';
                    $message .= '<p style="color:#f40;">*This script was design and developed by Joaqim John Maftah (2012-2014)</p>';
                    $message .= '</body></html>';
                    // Sending email
                    if (mail($to, $subject, $message, $headers)) {
 
                    } else {
                       
                    }

 /////////////////////////////////////////End of email//////////////////////////////////////////////////////////        
   
