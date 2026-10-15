  

 <?php
   
   
    ////////////////////////////////////////////
        include '../db.php';
 /////////////////////////////////////////////////////////////
     $date=date("d M Y");
     $day1 = mktime(0,0,0,date("m"),date("d")-8,date("Y"));
     $dayy1= date("M d Y", $day1);
      $selectdbday1=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy1'") or die(mysql_error());
    $tpfdataday1=mysql_num_rows($selectdbday1);    
    $selectdbqtnday1=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE Quotation_Date='$dayy1'") or die(mysql_error());
    $qtnoday1=mysql_num_rows($selectdbqtnday1);    
    $selectdbqtnapproveday1=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy1' AND aproved_status='Approved'") or die(mysql_error());
    $qtnapproveday1=mysql_num_rows($selectdbqtnapproveday1);
    $tpfrejectday1=0;
    $qtnrejectday1=0;
     
     ///////////////////////////////////////////////////////
     
     $day2 = mktime(0,0,0,date("m"),date("d")-7,date("Y"));
     $dayy2= date("M d Y", $day2);
     
      $selectdbday2=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy2'") or die(mysql_error());
    $tpfdataday2=mysql_num_rows($selectdbday2);    
    $selectdbqtnday2=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE Quotation_Date='$dayy2'") or die(mysql_error());
    $qtnoday2=mysql_num_rows($selectdbqtnday2);    
    $selectdbqtnapproveday2=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy2' AND aproved_status='Approved'") or die(mysql_error());
    $qtnapproveday2=mysql_num_rows($selectdbqtnapproveday2);
    $tpfrejectday2=0;
    $qtnrejectday2=0;
     
     //////////////////////////////////////////////////
     
      $day3 = mktime(0,0,0,date("m"),date("d")-6,date("Y"));
     $dayy3= date("M d Y", $day3);
      $selectdbday3=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy3'") or die(mysql_error());
    $tpfdataday3=mysql_num_rows($selectdbday3);    
    $selectdbqtnday3=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE Quotation_Date='$dayy3'") or die(mysql_error());
    $qtnoday3=mysql_num_rows($selectdbqtnday3);    
    $selectdbqtnapproveday3=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy3' AND aproved_status='Approved'") or die(mysql_error());
    $qtnapproveday3=mysql_num_rows($selectdbqtnapproveday3);
    $tpfrejectday3=0;
    $qtnrejectday3=0;
     ////////////////////////////////////////////////////
     
     $day4 = mktime(0,0,0,date("m"),date("d")-5,date("Y"));
     $dayy4= date("M d Y", $day4);
      $selectdbday4=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy4'") or die(mysql_error());
    $tpfdataday4=mysql_num_rows($selectdbday4);    
    $selectdbqtnday4=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE Quotation_Date='$dayy4'") or die(mysql_error());
    $qtnoday4=mysql_num_rows($selectdbqtnday4);    
    $selectdbqtnapproveday4=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy4' AND aproved_status='Approved'") or die(mysql_error());
    $qtnapproveday4=mysql_num_rows($selectdbqtnapproveday4);
    $tpfrejectday4=0;
    $qtnrejectday4=0;
     
     /////////////////////////////////////////////////////
     
      $day5 = mktime(0,0,0,date("m"),date("d")-4,date("Y"));
     $dayy5= date("M d Y", $day5);
      $selectdbday5=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy5'") or die(mysql_error());
    $tpfdataday5=mysql_num_rows($selectdbday5);    
    $selectdbqtnday5=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE Quotation_Date='$dayy5'") or die(mysql_error());
    $qtnoday5=mysql_num_rows($selectdbqtnday5);    
    $selectdbqtnapproveday5=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy5' AND aproved_status='Approved'") or die(mysql_error());
    $qtnapproveday5=mysql_num_rows($selectdbqtnapproveday5);
        $tpfrejectday5=0;
    $qtnrejectday5=0;
     
     /////////////////////////////////////////////////////////
     
      $day6 = mktime(0,0,0,date("m"),date("d"),date("Y"));
     $dayy6= date("M d Y", $day6);
      $selectdbday6=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy6'") or die(mysql_error());
    $tpfdataday6=mysql_num_rows($selectdbday6);    
    $selectdbqtnday6=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE Quotation_Date='$dayy6'") or die(mysql_error());
    $qtnoday6=mysql_num_rows($selectdbqtnday6);    
    $selectdbqtnapproveday6=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy6' AND aproved_status='Approved'") or die(mysql_error());
    $qtnapproveday6=mysql_num_rows($selectdbqtnapproveday6);
    $tpfrejectday6=0;
    $qtnrejectday6=0;
    
    $day7 = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
     $dayy7= date("M d Y", $day7);
      $selectdbday7=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy6'") or die(mysql_error());
    $tpfdataday7=mysql_num_rows($selectdbday7);    
    $selectdbqtnday7=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE Quotation_Date='$dayy6'") or die(mysql_error());
    $qtnoday7=mysql_num_rows($selectdbqtnday7);    
    $selectdbqtnapproveday7=  mysql_query("SELECT * FROM tbl_tpf_qt WHERE tpf_date='$dayy6' AND aproved_status='Approved'") or die(mysql_error());
    $qtnapproveday7=mysql_num_rows($selectdbqtnapproveday7);
    $tpfrejectday7=0;
    $qtnrejectday7=0;
     
     
     /////////////////////////////////////////////////////////
    
  $contentsms= '<table>

    <tr>
        <th>Description of </th>
        <th>'.$dayy1.'</th>
         <th>'.$dayy2.'</th>
          <th>'.$dayy3.'</th>
           <th>'.$dayy4.'</th>
            <th>'.$dayy5.'</th>
             <th>'.$dayy7.'</th>
            <th>'.$dayy6.'</th>

    </tr>
    <tr>
        <td>No of Quotation Prepared </td>
        <td class="day1">'.$qtnoday1.'</td>
         <td class="day1">'.$qtnoday2.'</td>
         <td class="day1">'.$qtnoday3.'</td>
         <td class="day1">'.$qtnoday4.'</td>
         <td class="day1">'.$qtnoday5.'</td>
          <td class="day1">'.$qtnoday7.'</td>
         <td class="day1">'.$qtnoday6.'</td>
    </tr>
    <tr>
        <td>No of Quotation Declined</td>
        <td class="day1">'.$qtnrejectday1.'</td>
         <td class="day1">'.$qtnrejectday2.'</td>
         <td class="day1">'.$qtnrejectday3.'</td>
         <td class="day1">'.$qtnrejectday4.'</td>
         <td class="day1">'.$qtnrejectday5.'</td>
         <td class="day1">'.$qtnrejectday7.'</td>
         <td class="day1">'.$qtnrejectday6.'</td>
    </tr>
    <tr>
        <td>No of TPF Raised</td>
        <td class="day1">'.$tpfdataday1.'</td>
         <td class="day1">'.$tpfdataday2.'</td>
         <td class="day1">'.$tpfdataday3.'</td>
         <td class="day1">'.$tpfdataday4.'</td>
         <td class="day1">'.$tpfdataday5.'</td>
         <td class="day1">'.$tpfdataday7.'</td>
         <td class="day1">'.$tpfdataday6.'</td>
    </tr>
    <tr>
        <td>No of TPF Approved</td>
        <td class="day1">'.$qtnapproveday1.'</td>
         <td class="day1">'.$qtnapproveday2.'</td>
         <td class="day1">'.$qtnapproveday3.'</td>
         <td class="day1">'.$qtnapproveday4.'</td>
         <td class="day1">'.$qtnapproveday5.'</td>
         <td class="day1">'.$qtnapproveday7.'</td>
         <td class="day1">'.$qtnapproveday6.'</td>
    </tr>
     <tr>
        <td>No of TPF not Approved.</td>
        <td class="day1">'.$qtnrejectday1.'</td>
        <td class="day1">'.$qtnrejectday2.'</td>
         <td class="day1">'.$qtnrejectday3.'</td>
         <td class="day1">'.$qtnrejectday4.'</td>
         <td class="day1">'.$qtnrejectday5.'</td>
         <td class="day1">'.$qtnrejectday7.'</td>
          <td class="day1">'.$qtnrejectday6.'</td>
    </tr>
</table>';
    
    /////////////////////////////////////////////////////////
 $emailing='joaqim@sincrositewatch.com';
    $to = $emailing;
    $subject = 'Daily TPF Report Summary';
    $from = 'sas@sincrositewatch.com';
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Create email headers
    
   
    
    $message = '<html>'
            . '<head>
    <style>
    table {
    border-collapse: collapse;
    width: 70%;
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
</style>
</head>'
            . '<body>';
    $message .= '<p>Dear Team</p>';
    $message .= '<p style="color:#080;font-size:18px;">Below are Daily Tpf Report</p>';
     $message .=$contentsms;
     $message .= '<p>Regards,<br>SAS(Sincro Automation System)</p>';
    $message .= '</body></html>';
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo 'Your mail has been sent successfully.';
    } else{
        echo 'Unable to send email. Please try again.';
    }
    ?>

