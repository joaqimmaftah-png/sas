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

<table class="table cart table-bordered">
    <caption style=" text-align: center;">DAILY QUOTATION SUMMARY REPORTs</caption>
 <tr>
  <th colspan="2" style="text-align: center;background-color: #469BD7;">Week Days</th>
  <th colspan="4" style="text-align: center;">QUOTATION SUMMARY</th>
  <th colspan="4" style="text-align: center;background-color: #3C69AB;">INVOICE SUMMARY</th>  
 </tr>

 <tr>
  <th style="background-color: #469BD7;">Week Day</th>
  <th style="background-color: #469BD7;">Date</th>
  <!--/////////QUOTATION///////////////-->
  <th>TOTAL QUOTATION</th>
  <th>TOTAL AMOUNTS</th>
  <th>APPROVED</th>
  <th>NOT APPROVED</th>
  <!--////////////INVOICE///////////////-->
  <th style="background-color: #3C69AB;">TOTAL INVOICE</th>
  <th style="background-color: #3C69AB;">TOTAL AMOUNTS</th>
  <th style="background-color: #3C69AB;">PAID</th>
  <th style="background-color: #3C69AB;">NOT PAID</th>

 </tr>

                    </thead>
                    <tbody>
                         <?php
//                         12-09-2017
                     $date = date('m/d/Y');
//                       $date = date('09/12/2017');
// parse about any English textual datetime description into a Unix timestamp 
$ts = strtotime($date);
// find the year (ISO-8601 year number) and the current week
$year = date('o',$ts);
$week = date('W',$ts);
// print week for the current date
for($i = 1; $i <= 5; $i++) {
    $ts = strtotime($year.'W'.$week.$i);
    $juma= date("l", $ts);
    $tareh= date("d/m/Y", $ts);
    $treport=date("Ymd", $ts);
    
    $gt= mysql_query("SELECT * FROM tbl_preparedquotation WHERE reportdate='$treport'") or die(mysql_error());
    $prepaired_quotation= mysql_num_rows($gt);
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////
   $vvy= mysql_fetch_array($gt);
   $Quotation_id=$vvy['Quotation_id'].'<br>';
   $gt2= mysql_query("SELECT SUM(Net_Price) FROM  tbl_quotationitem WHERE Quotation_id='$Quotation_id'") or die(mysql_error());
   $summ= mysql_fetch_array($gt2);
   $totalamount=$summ['SUM(Net_Price)'];
   
   $gtr= mysql_query("SELECT * FROM tbl_preparedquotation WHERE reportdate='$treport' AND Work_status=''") or die(mysql_error());
   $notapproved= mysql_num_rows($gtr);
   $approved=$prepaired_quotation-$notapproved;
////////////////////////////////////////////////////////INVOICE//////////////////////////////////////////////////////////////////////////////
     $invoice= mysql_query("SELECT * FROM tblinvoice WHERE reportdate='$treport'") or die(mysql_error());
   $prepaired_invoice= mysql_num_rows($invoice);
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////
   $mnb= mysql_fetch_array($invoice);
   $Invoice_id=$mnb['Invoice_id'];

//   $Quotation_id=$vvyy['Quotation_id'];
   $gt22= mysql_query("SELECT SUM(Total_Price) FROM  tblinvoice_item WHERE Invoice_id='$Invoice_id'") or die(mysql_error());
   $suv= mysql_fetch_array($gt22);
   $invoiceamount=$suv['SUM(Total_Price)'];
   
   $gtrr= mysql_query("SELECT * FROM tbl_preparedquotation WHERE reportdate='$treport' AND Payment=''") or die(mysql_error());
   $notpaid= mysql_num_rows($gtr);
   $paid=$prepaired_invoice-$notpaid;
 ?>
                        <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>
    <td><?php echo $juma;?></td>
     <td><?php echo $tareh;?></td>
     <td><a href="?action=daily&date=<?php echo $treport?>&status="><?php echo $prepaired_quotation;?></a></td>
     <td><?php echo number_format($totalamount,2);?></td>
     <td><?php echo $approved;?></td>
     <td><?php echo $notapproved;?></td>
     <td><?php echo $prepaired_invoice;?></td>
   <td><?php echo number_format($invoiceamount,2);?></td>
  <td><?php echo $paid;?></td>
  <td><?php echo $notpaid;?></td>
 </tr>
 <?php
  }
 ?>
 </tbody>
 </table>

 <hr>
    <!--weekly-->
<table class="table cart table-bordered">
    <caption style=" text-align: center;">WEEKLY QUOTATION SUMMARY REPORT</caption>
 <tr>
     <th colspan="1" style="text-align: center;background-color: #469BD7;">Week Days</th>
  <th colspan="4" style="text-align: center;">QUOTATION SUMMARY</th>
  <th colspan="4" style="text-align: center;background-color: #3C69AB;">INVOICE SUMMARY</th>  
 </tr>

 <tr>
<!--  <th style="background-color: #469BD7;">Week Day</th>-->
  <th style="background-color: #469BD7;">Date</th>
  <!--/////////QUOTATION///////////////-->
  <th>TOTAL QUOTATION</th>
  <th>TOTAL AMOUNTS</th>
  <th>APPROVED</th>
  <th>NOT APPROVED</th>
  <!--////////////INVOICE///////////////-->
  <th style="background-color: #3C69AB;">TOTAL INVOICE</th>
    <th style="background-color: #3C69AB;">TOTAL AMOUNTS</th>
  <th style="background-color: #3C69AB;">PAID</th>
  <th style="background-color: #3C69AB;">NOT PAID</th>

 </tr>

                    </thead>
                    <tbody>
                         <?php
//                         12-09-2017
//                    $date = date('2018-01-15');
                       $date = date('Y-m-d');
// parse about any English textual datetime description into a Unix timestamp 
// find the year (ISO-8601 year number) and the current week
$date_string = $date;
$n=date("W", strtotime($date));
// print week for the current date
for($x = 1; $x <= $n; $x++) {
    $week = $x;
        $year = 2019;

        $timestamp = mktime( 0, 0, 0, 1, 1,  $year ) + ( $week * 7 * 24 * 60 * 60 );
        $timestamp_for_monday = $timestamp - 86400 * ( date( 'N', $timestamp ) - 1 );
        $date_for_monday = date( 'Y-m-d', $timestamp_for_monday );
        $enddate=date( 'Y-m-d', $timestamp_for_monday );        
        $stop_date =$enddate;
        $Enddate = date('Y-m-d', strtotime($stop_date . ' +6 day'));
        
        $from=date("Ymd", strtotime($enddate));
        $to=date("Ymd", strtotime($Enddate));
    
    $gt= mysql_query("SELECT * FROM tbl_preparedquotation WHERE reportdate BETWEEN '$from' AND '$to'") or die(mysql_error());
   $prepaired_quotation= mysql_num_rows($gt);
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////
   $vvy= mysql_fetch_array($gt);
   $Quotation_id=$vvy['Quotation_id'];
   $gt2= mysql_query("SELECT SUM(Net_Price) FROM  tbl_quotationitem WHERE Quotation_id='$Quotation_id'") or die(mysql_error());
   $summ= mysql_fetch_array($gt2);
   $totalamount=$summ['SUM(Net_Price)'];
   
   $gtr= mysql_query("SELECT * FROM tbl_preparedquotation WHERE reportdate BETWEEN '$from' AND '$to' AND Work_status=''") or die(mysql_error());
   $notapproved= mysql_num_rows($gtr);
   $approved=$prepaired_quotation-$notapproved;
////////////////////////////////////////////////////////INVOICE//////////////////////////////////////////////////////////////////////////////
     $invoice= mysql_query("SELECT * FROM tblinvoice WHERE reportdate BETWEEN '$from' AND '$to'") or die(mysql_error());
   $prepaired_invoice= mysql_num_rows($invoice);
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////
   $mnb= mysql_fetch_array($invoice);
   $Invoice_id=$mnb['Invoice_id'];

//   $Quotation_id=$vvyy['Quotation_id'];
   $gt22= mysql_query("SELECT SUM(Total_Price) FROM  tblinvoice_item WHERE Invoice_id='$Invoice_id'") or die(mysql_error());
   $suv= mysql_fetch_array($gt22);
   $invoiceamount=$suv['SUM(Total_Price)'];
   
   $gtrr= mysql_query("SELECT * FROM tbl_preparedquotation WHERE reportdate BETWEEN '$from' AND '$to' AND Payment=''") or die(mysql_error());
   $notpaid= mysql_num_rows($gtr);
   $paid=$prepaired_invoice-$notpaid;
 ?>
                        <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>
    <!--<td><?php echo $juma;?></td>-->
    <td><?php echo $enddate.'  '.$Enddate;?></td>
     <td><?php echo $prepaired_quotation;?></td>
     <td><?php echo number_format($totalamount,2);?></td>
     <td><?php echo $approved;?></td>
     <td><?php echo $notapproved;?></td>
     <td><?php echo $prepaired_invoice;?></td>
   <td><?php echo number_format($invoiceamount,2);?></td>
  <td><?php echo $paid;?></td>
  <td><?php echo $notpaid;?></td>
 </tr>
  <?php
}
 ?>
 </tbody>
                </table>
    
    <hr>
    
    <table class="table cart table-bordered">
    <caption style=" text-align: center;">MONTHLY QUOTATION SUMMARY REPORT</caption>
 <tr>
     <th colspan="1" style="text-align: center;background-color: #469BD7;">Months</th>
  <th colspan="4" style="text-align: center;">QUOTATION SUMMARY</th>
  <th colspan="4" style="text-align: center;background-color: #3C69AB;">INVOICE SUMMARY</th>  
 </tr>

 <tr>
  <th style="background-color: #469BD7;">Date</th>
  <!--<th style="background-color: #469BD7;">Date</th>-->
  <!--/////////QUOTATION///////////////-->
  <th>TOTAL QUOTATION</th>
    <th>TOTAL AMOUNTS</th>
  <th>APPROVED</th>
  <th>NOT APPROVED</th>
  <!--////////////INVOICE///////////////-->
  <th style="background-color: #3C69AB;">TOTAL INVOICE</th>
    <th style="background-color: #3C69AB;">TOTAL AMOUNTS</th>
  <th style="background-color: #3C69AB;">PAID</th>
  <th style="background-color: #3C69AB;">NOT PAID</th>

 </tr>

                    </thead>
                    <tbody>
                         <?php
//                    $date = date('2017-12-01');
                       $date = date('Y-m-d');
// parse about any English textual datetime description into a Unix timestamp 
// find the year (ISO-8601 year number) and the current week
$date_string = $date;
$n=date("m", strtotime($date));

// print week for the current date
for($x = 1; $x <= $n; $x++) {
    $month = $x;
        $year = 2019;

        $timestamp = mktime( 0, 0, 0, 1, 1,  $year ) + ( $month *30* 24 * 60 * 60 );
        $timestamp_for_monday = $timestamp - 86400 * ( date( 'N', $timestamp ) - 1 );
        $date_for_monday = date( 'Y-m-d', $timestamp_for_monday );
        $enddate=date( 'Y-m-d', $timestamp_for_monday );        
        $stop_date =$enddate;
        $Enddate = date('Y-m-d', strtotime($stop_date . ' +30 day'));
        
        $fromm=date("Ymd", strtotime($enddate));
        $to=date("Ymd", strtotime($Enddate));
    
    $gt= mysql_query("SELECT * FROM tbl_preparedquotation WHERE reportdate='$treport'") or die(mysql_error());
   $prepaired_quotation= mysql_num_rows($gt);
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////
   $vvy= mysql_fetch_array($gt);
   $Quotation_id=$vvy['Quotation_id'];
   $gt2= mysql_query("SELECT SUM(Net_Price) FROM  tbl_quotationitem WHERE Quotation_id='$Quotation_id'") or die(mysql_error());
   $summ= mysql_fetch_array($gt2);
   $totalamount=$summ['SUM(Net_Price)'];
   
   $gtr= mysql_query("SELECT * FROM tbl_preparedquotation WHERE reportdate='$treport' AND Work_status=''") or die(mysql_error());
   $notapproved= mysql_num_rows($gtr);
   $approved=$prepaired_quotation-$notapproved;
////////////////////////////////////////////////////////INVOICE//////////////////////////////////////////////////////////////////////////////
     $invoice= mysql_query("SELECT * FROM tblinvoice WHERE reportdate='$treport'") or die(mysql_error());
   $prepaired_invoice= mysql_num_rows($invoice);
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////
   $mnb= mysql_fetch_array($invoice);
   $Invoice_id=$mnb['Invoice_id'];

//   $Quotation_id=$vvyy['Quotation_id'];
   $gt22= mysql_query("SELECT SUM(Total_Price) FROM  tblinvoice_item WHERE Invoice_id='$Invoice_id'") or die(mysql_error());
   $suv= mysql_fetch_array($gt22);
   $invoiceamount=$suv['SUM(Total_Price)'];
   
   $gtrr= mysql_query("SELECT * FROM tbl_preparedquotation WHERE reportdate='$treport' AND Payment=''") or die(mysql_error());
   $notpaid= mysql_num_rows($gtr);
   $paid=$prepaired_invoice-$notpaid;
 ?>
                        <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>
     <!--<td><?php echo $juma;?></td>-->
     <td><?php echo $fromm;?></td>
     <td><?php echo $prepaired_quotation;?></td>
     <td><?php echo number_format($totalamount,2);?></td>
     <td><?php echo $approved;?></td>
     <td><?php echo $notapproved;?></td>
     <td><?php echo $prepaired_invoice;?></td>
   <td><?php echo number_format($invoiceamount,2);?></td>
  <td><?php echo $paid;?></td>
  <td><?php echo $notpaid;?></td>
</tr>
  <?php
}
 ?>
 </tbody>
 
 </table><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

