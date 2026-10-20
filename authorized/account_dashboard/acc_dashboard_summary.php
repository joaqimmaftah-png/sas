<head>
<style>
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
</style>
</head>


<hr>
    
 <table class="table cart table-bordered">
    <caption style=" text-align: center;">MONTHLY QUOTATION SUMMARY</caption>
 <tr>
     <th colspan="2" style="text-align: center;background-color: #469BD7;">Months</th>
     <th colspan="3" style="text-align: center;">QUOTATION SUMMARY</th>
   
 </tr>

 <tr>  
  <th style="background-color: #469BD7;">Month</th>
  <!--<th style="background-color: #469BD7;">Date</th>-->
  <!--/////////QUOTATION///////////////-->
 
  <th>TOTAL AMOUNTS</th>
  <th>AMOUNT APPROVED</th>
  <th>AMOUNT NOT APPROVED</th>
 

 </tr>

                    </thead>
                    <tbody>
    <?php
require_once __DIR__ . '/../../mysql_compat.php';

////////////////////////////January//////////////////////////////////////////////////////
    $datejan=201901;
                         
    $jdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejan'") or die(mysql_error());
    $prepaired_jan_quotation= mysql_num_rows($jdata);
      
       
    $jdata2= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejan' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_jan_quotation= mysql_num_rows($jdata2);      
    $approved_jan=$prepaired_jan_quotation-$not_approved_jan_quotation;  
////////////////////////////January//////////////////////////////////////////////////////
    ?>     
 <!--///////////////////////////////Jnanuary////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>
    <td>January <?php echo date(Y);?></td>
    <!--<td><?php // echo '201901'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $datejan;?>&status="><?php  echo $prepaired_jan_quotation;?></a></td>-->
    <!--<td><a href="?action=daily_approved&date=<?php echo $datejan;?>&status="><?php  echo $approved_jan;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $datejan;?>&status="><?php  echo $not_approved_jan_quotation;?></a></td>--> 
     
</tr>    

 <!----------------------------end----------------->
  <!--///////////////////////////////Feb////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php
   $datefeb=201902;
                         
    $jjdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datefeb'") or die(mysql_error());
    $prepaired_feb_quotation= mysql_num_rows($jjdata);
    
    
    $data2= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datefeb' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_feb_quotation= mysql_num_rows($data2);
    $approved_feb=$prepaired_feb_quotation-$not_approved_feb_quotation;
  
  ?>
  
   
  <tr>
      <td>February  <?php echo date(Y);?></td>
    <!--<td><?php // echo '201902'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $datefeb;?>&status="><?php  echo $prepaired_feb_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $datefeb;?>&status="><?php  echo $approved_feb;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $datefeb;?>&status="><?php  echo $not_approved_feb_quotation;?></a></td>-->
     
  </tr>
  
  <?php
   $datemar=201903;
                         
    $kdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datemar'") or die(mysql_error());
    $prepaired_mar_quotation= mysql_num_rows($kdata);
    
    
    $data3= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datemar' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_mar_quotation= mysql_num_rows($data3);
    $approved_mar=$prepaired_mar_quotation-$not_approved_mar_quotation;
  
  ?>
   
  <tr>
    <td>March <?php echo date(Y);?></td>
    <!--<td><?php // echo '201903'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $datemar;?>&status="><?php  echo $prepaired_mar_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $datemar;?>&status="><?php  echo $approved_mar;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $datemar;?>&status="><?php  echo $not_approved_mar_quotation;?></a></td>-->
     
  </tr>
  
  
  
   <?php
   $dateapr=201904;
                         
    $adata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateapr'") or die(mysql_error());
    $prepaired_apr_quotation= mysql_num_rows($adata);
    
    
    $data4= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateapr' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_apr_quotation= mysql_num_rows($data4);
    $approved_apr=$prepaired_apr_quotation-$not_approved_apr_quotation;
  
  ?>
  <tr>
    <td>April  <?php echo date(Y);?></td>
    <!--<td><?php // echo '201904'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $dateapr;?>&status="><?php  echo $prepaired_apr_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $dateapr;?>&status="><?php  echo $approved_apr;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $dateapr;?>&status="><?php  echo $not_approved_apr_quotation;?></a></td>-->
     
  </tr>
  
  <?php
   $datemay=201905;
                         
    $bdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datemay'") or die(mysql_error());
    $prepaired_may_quotation= mysql_num_rows($bdata);
    
    
    $data5= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datemay' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_may_quotation= mysql_num_rows($data5);
    $approved_may=$prepaired_may_quotation-$not_approved_may_quotation;
  
  ?>
  
  <tr>
    <td>May <?php echo date(Y);?></td>
    <!--<td><?php // echo '201905'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $datemay;?>&status="><?php  echo $prepaired_may_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $datemay;?>&status="><?php  echo $approved_may;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $datemay;?>&status="><?php  echo $not_approved_may_quotation;?></a></td>-->
     
  </tr>
  
  
  
  
  <?php
   $datejune=201906;
                         
    $edata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejune'") or die(mysql_error());
    $prepaired_june_quotation= mysql_num_rows($edata);
    
    
    $data6= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejune' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_june_quotation= mysql_num_rows($data6);
    $approved_june=$prepaired_june_quotation-$not_approved_june_quotation;
  
  ?>
  
  <tr>
    <td>June <?php echo date(Y);?></td>
    <!--<td><?php // echo '201906'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $datejune;?>&status="><?php  echo $prepaired_june_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $datejune;?>&status="><?php  echo $approved_june;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $datejune;?>&status="><?php  echo $not_approved_june_quotation;?></a></td>-->
     
  </tr>
  
  
  
  
   <?php
   
    $datejuly=201907;
                         
    $fdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejuly'") or die(mysql_error());
    $prepaired_july_quotation= mysql_num_rows($fdata);
    
    
    $data7= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejune' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_july_quotation= mysql_num_rows($data7);
    $approved_july=$prepaired_july_quotation-$not_approved_july_quotation;
  
  ?>
  
  <tr>
    <td>July <?php echo date(Y);?></td>
    <!--<td><?php // echo '201907'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $datejuly;?>&status="><?php  echo $prepaired_july_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $datejuly;?>&status="><?php  echo $approved_july;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $datejuly;?>&status="><?php  echo $not_approved_july_quotation;?></a></td>-->
     
  </tr>
  
   <?php
   
    $dateaug=201908;
                         
    $gdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateaug'") or die(mysql_error());
    $prepaired_aug_quotation= mysql_num_rows($gdata);
    
    
    $data8= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateaug' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_aug_quotation= mysql_num_rows($data8);
    $approved_aug=$prepaired_aug_quotation-$not_approved_aug_quotation;
  
  ?>
  
  
  
  <tr>
      <td>August <?php echo date(Y);?></td>
    <!--<td><?php // echo '201908'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $dateaug;?>&status="><?php  echo $prepaired_aug_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $dateaug;?>&status="><?php  echo $approved_aug;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $dateaug;?>&status="><?php  echo $not_approved_aug_quotation;?></a></td>-->
     
  </tr>
    
  
   <?php
   
    $datesept=201909;
                         
    $hdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datesept'") or die(mysql_error());
    $prepaired_sept_quotation= mysql_num_rows($hdata);
    
    
    $data9= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datesept' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_sept_quotation= mysql_num_rows($data9);
    $approved_sept=$prepaired_sept_quotation-$not_approved_sept_quotation;
  
  ?>
  
  <tr>
    <td>September  <?php echo date(Y);?></td>
    <!--<td><?php // echo '201909'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $datesept;?>&status="><?php  echo $prepaired_sept_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $datesept;?>&status="><?php  echo $approved_sept;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $datesept;?>&status="><?php  echo $not_approved_sept_quotation;?></a></td>-->
     
  </tr>
  
  
  
  
   <?php
   
    $dateoct=201910;
                         
    $pdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateoct'") or die(mysql_error());
    $prepaired_oct_quotation= mysql_num_rows($pdata);
    
    
    $data10= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateoct' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_oct_quotation= mysql_num_rows($data10);
    $approved_oct=$prepaired_oct_quotation-$not_approved_oct_quotation;
  
  ?>
  <tr>
    <td>October  <?php echo date(Y);?></td>
    <!--<td><?php // echo '201910'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $dateoct;?>&status="><?php  echo $prepaired_oct_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $dateoct;?>&status="><?php  echo $approved_oct;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $dateoct;?>&status="><?php  echo $not_approved_oct_quotation;?></a></td>-->
     
  </tr>
  
   <?php
   
    $datenov=201911;
                         
    $qdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datenov'") or die(mysql_error());
    $prepaired_nov_quotation= mysql_num_rows($qdata);
    
    
    $data11= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datenov' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_nov_quotation= mysql_num_rows($data11);
    $approved_nov=$prepaired_nov_quotation-$not_approved_nov_quotation;
  
  ?>
  
  <tr>
      <td>November  <?php echo date(Y);?></td>
    <!--<td><?php // echo '201911'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $datenov;?>&status="><?php  echo $prepaired_nov_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $datenov;?>&status="><?php  echo $approved_nov;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $datenov;?>&status="><?php  echo $not_approved_nov_quotation;?></a></td>-->
     
  </tr>
  
  
  
   <?php
   
    $datedec=201912;
                         
    $zdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datedec'") or die(mysql_error());
    $prepaired_dec_quotation= mysql_num_rows($zdata);
    
    
    $data12= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datedec' AND approved_po='Waiting Approval'") or die(mysql_error());
    $not_approved_dec_quotation= mysql_num_rows($data12);
    $approved_dec=$prepaired_dec_quotation-$not_approved_dec_quotation;
  
  ?>
  
  <tr>
    <td>December <?php echo date(Y);?></td>
    <!--<td><?php // echo '201912'?></td>-->
    <!--<td><a href="?action=daily&date=<?php echo $datedec;?>&status="><?php  echo $prepaired_dec_quotation;?></a></td>-->  
    <!--<td><a href="?action=daily_approved&date=<?php echo $datedec;?>&status="><?php  echo $approved_dec;?></a></td>-->
    <!--<td><a href="?action=quot_notapproved&date=<?php echo $datedec;?>&status="><?php  echo $not_approved_dec_quotation;?></a></td>-->
     
  </tr>
  
  
 <!----------------------------end----------------->
 </tbody>
 
 </table>
    
    
<?php
$monthArray = range(1, 12);
?>
<select name="month">
    <!--<option value="">Select Month</option>-->
    <?php
    foreach ($monthArray as $month) {
        // padding the month with extra zero
        $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
        // you can use whatever year you want
        // you can use 'M' or 'F' as per your month formatting preference
        $fdate = date("F", strtotime("2015-$monthPadding-01"));
//        echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
    }
    ?>
</select>
    