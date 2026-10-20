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
    <caption style=" text-align: center;">MONTHLY QUOTATION SUMMARY REPORTs</caption>
 <tr>
     <th colspan="2" style="text-align: center;background-color: #469BD7;">Months</th>
     <th colspan="3" style="text-align: center;">QUOTATION SUMMARY</th>
   
 </tr>

 <tr>   
  <th style="background-color: #469BD7;">Month</th>
  <!--<th style="background-color: #469BD7;">Date</th>-->
  <!--/////////QUOTATION///////////////-->
 
  <th>TOTAL QUOTATIONS</th>
  <th>APPROVED</th>
  <th>NOT APPROVED</th>
  <th>TOTAL AMOUNT</th>
        
    
 </tr>

    </thead>
    <tbody>
    <?php
require_once __DIR__ . '/../../mysql_compat.php';

////////////////////////////January//////////////////////////////////////////////////////
    $datejan=201901;
                         
    $jdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejan' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_jan_quotation= mysql_num_rows($jdata);
        
        
    $jdata2= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejan' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_jan_quotation= mysql_num_rows($jdata2);      
    $approved_jan=$prepaired_jan_quotation-$not_approved_jan_quotation; 
    
    while($jdata1=  mysql_fetch_array($jdata)){            
      $quotation_id=$jdata1['Quotation_id'];          
      $resulz = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id'")or die(mysql_error());
      $erweTz=  mysql_fetch_array($resulz);   
      $grandtotal=$erweTz['SUM(Net_Price)'];  
      $grandtotal1+=$grandtotal;
      $grandtotal1a=number_format($grandtotal1,2);    
     
    }
    
////////////////////////////January//////////////////////////////////////////////////////
    ?>     
 <!--///////////////////////////////Jnanuary////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>        
    <td>January <?php echo date(Y);?></td>  
    <td><a href="?action=daily&date=<?php echo $datejan;?>&status="><?php  echo $prepaired_jan_quotation;?></a></td>
    <td><a href="?action=daily_approved&date=<?php echo $datejan;?>&status="><?php  echo $approved_jan;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $datejan;?>&status="><?php  echo $not_approved_jan_quotation;?></a></td> 
    <td><a href="?action=daily&date=<?php echo $datejan;?>&status="><?php echo $grandtotal1a;?></a></td>   
</tr>          
        
 <!----------------------------end----------------->
  <!--///////////////////////////////Feb////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php
   $datefeb=201902;
                         
    $jjdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datefeb' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_feb_quotation= mysql_num_rows($jjdata);
    
    
    
    $data2= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datefeb' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_feb_quotation= mysql_num_rows($data2);  
    $approved_feb=$prepaired_feb_quotation-$not_approved_feb_quotation;   
  
    
    
  while($jdata2=  mysql_fetch_array($jjdata)){  
      
      $quotation_id2=$jdata2['Quotation_id'];
      $resul2 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id2'")or die(mysql_error());
      $erweT2=  mysql_fetch_array($resul2);
    
    $grandtotal2=$erweT2['SUM(Net_Price)'];
    
    $grandtotal22+=$grandtotal2;
    $grandtotal22b=number_format($grandtotal22,2);
    
    
  }
    ?>
  
   
  <tr>
    <td>February  <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $datefeb;?>&status="><?php  echo $prepaired_feb_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $datefeb;?>&status="><?php  echo $approved_feb;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $datefeb;?>&status="><?php  echo $not_approved_feb_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $datefeb;?>&status="><?php echo $grandtotal22b;?></a></td>
  </tr>  
  
  <?php
   $datemar=201903;
                         
    $kdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datemar' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_mar_quotation= mysql_num_rows($kdata);  
    
    
    
    $data3= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datemar' AND approved_po='Waiting approval'") or die(mysql_error());  
    $not_approved_mar_quotation= mysql_num_rows($data3);
    $approved_mar=$prepaired_mar_quotation-$not_approved_mar_quotation;
    
    
    while($jdata3=  mysql_fetch_array($kdata)){  
        
    $quotation_id3=$jdata3['Quotation_id'];
    $resul3 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id3'")or die(mysql_error());
    $erweT3=  mysql_fetch_array($resul3);
    
    $grandtotal3=$erweT3['SUM(Net_Price)'];
    $grandtotal33+=$grandtotal3;
    
    $grandtotal33c=  number_format($grandtotal33,2);
    
    
  }  
  ?>
   
  <tr>
    <td>March <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $datemar;?>&status="><?php  echo $prepaired_mar_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $datemar;?>&status="><?php  echo $approved_mar;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $datemar;?>&status="><?php  echo $not_approved_mar_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $datemar;?>&status="><?php echo $grandtotal33c;?></a></td>
  </tr>
  
  
  
   <?php
   $dateapr=201904;
                         
    $adata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateapr' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_apr_quotation= mysql_num_rows($adata);
    
    
    
    $data4= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateapr' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_apr_quotation= mysql_num_rows($data4);
    $approved_apr=$prepaired_apr_quotation-$not_approved_apr_quotation;
    
    
    while($jdata4=  mysql_fetch_array($adata)){
        
    $quotation_id4=$jdata4['Quotation_id'];
    $resul4 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id4'")or die(mysql_error());
    $erweT4=  mysql_fetch_array($resul4);
    $grandtotal4=$erweT4['SUM(Net_Price)'];
    $grandtotal44+=$grandtotal4;
    
    $grandtotal44d=  number_format($grandtotal44,2);
    
  }
  ?>
  <tr>
    <td>April  <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $dateapr;?>&status="><?php  echo $prepaired_apr_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $dateapr;?>&status="><?php  echo $approved_apr;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $dateapr;?>&status="><?php  echo $not_approved_apr_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $dateapr;?>&status="><?php echo $grandtotal44d;?></a></td>
  </tr>
  
  <?php
   $datemay=201905;
                         
    $bdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datemay' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_may_quotation= mysql_num_rows($bdata);
    
    
    $data5= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datemay' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_may_quotation= mysql_num_rows($data5);
    $approved_may=$prepaired_may_quotation-$not_approved_may_quotation;
    
    while($jdata5=  mysql_fetch_array($bdata)){
          
    $quotation_id5=$jdata5['Quotation_id'];
    $resul5 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id5'")or die(mysql_error());
    $erweT5=  mysql_fetch_array($resul5);
    $grandtotal5=$erweT5['SUM(Net_Price)'];
   
    $grandtotal55+=$grandtotal5;
    $grandtotal55e=  number_format($grandtotal55,2);
    
    
    
    }
  ?>
  
  <tr>  
    <td>May <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $datemay;?>&status="><?php  echo $prepaired_may_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $datemay;?>&status="><?php  echo $approved_may;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $datemay;?>&status="><?php  echo $not_approved_may_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $datemay;?>&status="><?php echo $grandtotal55e;?></a></td>
  </tr>
  
  
  
  
  <?php
   $datejune=201906;
                         
    $edata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejune' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_june_quotation= mysql_num_rows($edata);
    
    
    $data6= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejune' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_june_quotation= mysql_num_rows($data6);
    $approved_june=$prepaired_june_quotation-$not_approved_june_quotation;
    
    
    while($jdata6= mysql_fetch_array($edata)){   
        
    $quotation_id6=$jdata6['Quotation_id'];
    
    $resul6 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id6'")or die(mysql_error());
    $erweT6=  mysql_fetch_array($resul6);
    
    $grandtotal6=$erweT6['SUM(Net_Price)']; 
    $grandtotal66+=$grandtotal6;
    $grandtotal66f=number_format($grandtotal66,2);
    
      
    }       
    
  ?>       
  
  <tr>
    <td>June <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $datejune;?>&status="><?php  echo $prepaired_june_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $datejune;?>&status="><?php  echo $approved_june;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $datejune;?>&status="><?php  echo $not_approved_june_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $datejune;?>&status="><?php echo $grandtotal66f;?></a></td>
  </tr>   
  
  
   <?php   
    $datejuly=201907;
                         
    $fdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejuly' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_july_quotation= mysql_num_rows($fdata);
    
    
    $data7= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datejuly' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_july_quotation= mysql_num_rows($data7);
    $approved_july=$prepaired_july_quotation-$not_approved_july_quotation; 
  
    
    while($jdata7=  mysql_fetch_array($fdata)){
        
    $quotation_id7=$jdata7['Quotation_id'];
    $resul7 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id7'")or die(mysql_error());
    $erweT7 =  mysql_fetch_array($resul7);
    $grandtotal7=$erweT7['SUM(Net_Price)'];
    
    $grandtotal77+=$grandtotal7;
    $grandtotal77g=  number_format($grandtotal77,2);
    
    
    }
   ?>
  
  <tr>
    <td>July <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $datejuly;?>&status="><?php  echo $prepaired_july_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $datejuly;?>&status="><?php  echo $approved_july;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $datejuly;?>&status="><?php  echo $not_approved_july_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $datejuly;?>&status="><?php echo $grandtotal77g;?></a></td>
  </tr>
  
   <?php
   
    $dateaug=201908;
                         
    $gdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateaug' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_aug_quotation= mysql_num_rows($gdata);
    
    
    $data8= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateaug' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_aug_quotation= mysql_num_rows($data8);
    $approved_aug=$prepaired_aug_quotation-$not_approved_aug_quotation;
    
    
    while($jdata8=  mysql_fetch_array($gdata)){
        
    
    
    $quotation_id8=$jdata8['Quotation_id'];
    $resul8 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id8'")or die(mysql_error());
    $erweT8 =  mysql_fetch_array($resul8);
    
    $grandtotal8=$erweT8['SUM(Net_Price)'];
    $grandtotal88+=$grandtotal8;
    
    $grandtotal88h=number_format($grandtotal88,2);
    
    }
  ?>
  
  
  
  <tr>
    <td>August <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $dateaug;?>&status="><?php  echo $prepaired_aug_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $dateaug;?>&status="><?php  echo $approved_aug;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $dateaug;?>&status="><?php  echo $not_approved_aug_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $dateaug;?>&status="><?php echo $grandtotal88h;?></a></td>
  </tr>
    
  
   <?php
   
    $datesept=201909;
                         
    $hdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datesept' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_sept_quotation= mysql_num_rows($hdata);
    
    
    
    $data9= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datesept' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_sept_quotation= mysql_num_rows($data9);
    $approved_sept=$prepaired_sept_quotation-$not_approved_sept_quotation;
  
    
    while($jdata9=  mysql_fetch_array($hdata)){
          
    $quotation_id9=$jdata9['Quotation_id'];
    $resul9 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id9'")or die(mysql_error());
    $erweT9 =  mysql_fetch_array($resul9);
    
    $grandtotal9=$erweT9['SUM(Net_Price)'];
     
    $grandtotal99+=$grandtotal9;
    $grandtotal99i=number_format($grandtotal99,2);
    
    }
  ?>
  
  <tr>
    <td>September  <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $datesept;?>&status="><?php  echo $prepaired_sept_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $datesept;?>&status="><?php  echo $approved_sept;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $datesept;?>&status="><?php  echo $not_approved_sept_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $datesept;?>&status="><?php echo $grandtotal99i;?></a></td>
  </tr>
  
  
  
  
   <?php
   
    $dateoct=201910;
                         
    $pdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateoct' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_oct_quotation= mysql_num_rows($pdata);
    
    
    $data10= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$dateoct' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_oct_quotation= mysql_num_rows($data10);
    $approved_oct=$prepaired_oct_quotation-$not_approved_oct_quotation; 
  
    
    while($jdata10=  mysql_fetch_array($pdata)){
        
    $quotation_id10=$jdata10['Quotation_id'];
    $resul10 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id10'")or die(mysql_error());
    $erweT10 =  mysql_fetch_array($resul10);
    $grandtotal10=$erweT10['SUM(Net_Price)'];
     
    $grandtotal100+=$grandtotal10;
    $grandtotal100j=number_format($grandtotal100,2);
    
    }
  ?>
  <tr>
    <td>October  <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $dateoct;?>&status="><?php  echo $prepaired_oct_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $dateoct;?>&status="><?php  echo $approved_oct;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $dateoct;?>&status="><?php  echo $not_approved_oct_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $dateoct;?>&status="><?php echo $grandtotal100j;?></a></td>
  </tr>
  
   <?php
   
    $datenov=201911;
                         
    $qdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datenov' AND approved_po='Cancelled'") or die(mysql_error());
    $prepaired_nov_quotation= mysql_num_rows($qdata);
    
   
    $data11= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datenov' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_nov_quotation= mysql_num_rows($data11);
    $approved_nov=$prepaired_nov_quotation-$not_approved_nov_quotation;
    
    
    while($jdata11=  mysql_fetch_array($qdata)){
        
    $quotation_id11=$jdata11['Quotation_id'];
    $resul11 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id11'")or die(mysql_error());
    $erweT11 =  mysql_fetch_array($resul11);
  
    $grandtotal11=$erweT11['SUM(Net_Price)'];
    $grandtotal111+=$grandtotal11;
    $grandtotal111k=number_format($grandtotal111,2);
    
    
    }
    
    ?>
  
  <tr>
    <td>November  <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $datenov;?>&status="><?php  echo $prepaired_nov_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $datenov;?>&status="><?php  echo $approved_nov;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $datenov;?>&status="><?php  echo $not_approved_nov_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $datenov;?>&status="><?php  echo $grandtotal111k;?></a></td>
     
  </tr>
  
  
  
   <?php
   
    $datedec=201912;
                         
    $zdata= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datedec' AND approved_po!='Cancelled'") or die(mysql_error());
    $prepaired_dec_quotation= mysql_num_rows($zdata);
    
    
    $data12= mysql_query("SELECT * FROM tbl_preparedquotation WHERE month='$datedec' AND approved_po='Waiting approval'") or die(mysql_error());
    $not_approved_dec_quotation= mysql_num_rows($data12); 
    $approved_dec=$prepaired_dec_quotation-$not_approved_dec_quotation;
    
    
   while($jdata12= mysql_fetch_array($zdata)){ 
       
   
    $quotation_id12=$jdata12['Quotation_id'];
    $resul12 = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quotation_id12'")or die(mysql_error());
    $erweT12 =  mysql_fetch_array($resul12); 
    $grandtotal12=$erweT12['SUM(Net_Price)'];
    $grandtotal122+=$grandtotal12;
    $grandtotal122l=  number_format($grandtotal122,2);
    
    
   }
  ?>
  
  <tr> 
    <td>December <?php echo date(Y);?></td>
    <td><a href="?action=daily&date=<?php echo $datedec;?>&status="><?php  echo $prepaired_dec_quotation;?></a></td>  
    <td><a href="?action=daily_approved&date=<?php echo $datedec;?>&status="><?php  echo $approved_dec;?></a></td>
    <td><a href="?action=quot_notapproved&date=<?php echo $datedec;?>&status="><?php  echo $not_approved_dec_quotation;?></a></td>
    <td><a href="?action=daily&date=<?php echo $datedec;?>&status="><?php  echo $grandtotal122l;?></a></td>     
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
//      echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
    }
    ?>
</select>  